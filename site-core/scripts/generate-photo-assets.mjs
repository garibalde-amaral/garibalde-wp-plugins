#!/usr/bin/env node
/**
 * GA Core photo asset builder.
 * Generates named local image assets from the Master Visual Book prompts.
 * Secrets are read from the environment and are never written into the repository.
 *
 * Providers:
 *   pollinations: requires POLLINATIONS_API_KEY and may consume service credits.
 *   local-sd: requires a self-hosted AUTOMATIC1111-compatible endpoint.
 */
import fs from "node:fs/promises";
import path from "node:path";
import process from "node:process";

const ROOT = path.resolve(process.cwd(), "site-core");
const CATALOG = path.join(ROOT, "photo-catalog.json");
const PROVIDER = process.env.GA_IMAGE_PROVIDER || "pollinations";
const CATALOG_DATA = JSON.parse(await fs.readFile(CATALOG, "utf8"));
const DEST_BASE = path.join(ROOT, "garibalde-institucional");
const WIDTH = Number(process.env.GA_IMAGE_WIDTH || 1600);
const HEIGHT = Number(process.env.GA_IMAGE_HEIGHT || 900);
const FORCE = process.argv.includes("--force");
const INCLUDE_SOURCE_REQUIRED = process.argv.includes("--include-source-required");
const ONLY_ID = process.env.GA_IMAGE_ONLY_ID || "";

const STYLE = [
  "Photorealistic premium editorial photography for a Brazilian law firm website.",
  "Sophisticated dark espresso, warm graphite, ivory highlights and restrained matte bronze-gold accents.",
  "Natural, believable lighting, clean composition, high-end corporate editorial art direction.",
  "No words, letters, numbers, typography, logo, watermark, signage, seals, badges, document text, fake charts or UI text.",
  "No recognizable clients, no identifiable real staff, no fabricated official Brazilian court facade, no political party symbols.",
  "Wide 16:9 composition with an uncluttered area for a website headline; physically plausible photo, not an illustration, not a website screenshot."
].join(" ");

function promptFor(photo) {
  return photo.scene + " " + STYLE;
}

function destinationFor(photo) {
  return path.join(DEST_BASE, photo.filename);
}

async function exists(file) {
  try { await fs.access(file); return true; } catch { return false; }
}
async function delay(ms) { return new Promise(resolve => setTimeout(resolve, ms)); }

async function generatePollinations(photo, outFile) {
  const key = process.env.POLLINATIONS_API_KEY;
  if (!key) throw new Error("POLLINATIONS_API_KEY ausente; geração não executada.");
  const prompt = encodeURIComponent(promptFor(photo));
  const seed = [...photo.id].reduce((acc, c) => (acc * 33 + c.charCodeAt(0)) >>> 0, 5381);
  const model = encodeURIComponent(process.env.GA_IMAGE_MODEL || "black-forest-labs/flux.1-schnell");
  const url = "https://gen.pollinations.ai/image/" + prompt + "?model=" + model + "&width=" + WIDTH + "&height=" + HEIGHT + "&seed=" + seed + "&nologo=true";
  const attempts = 4;
  for (let n = 1; n <= attempts; n++) {
    try {
      const response = await fetch(url, {
        headers: { Authorization: "Bearer " + key, Accept: "image/jpeg,image/png,image/webp" },
        signal: AbortSignal.timeout(120000)
      });
      if (!response.ok) {
        const message = await response.text().catch(() => "");
        throw new Error("HTTP " + response.status + ": " + message.slice(0, 400));
      }
      const type = (response.headers.get("content-type") || "").toLowerCase();
      if (!type.startsWith("image/")) throw new Error("Resposta não é imagem (" + (type || "content-type ausente") + ").");
      const bytes = Buffer.from(await response.arrayBuffer());
      if (bytes.length < 20000) throw new Error("Arquivo gerado muito pequeno (" + bytes.length + " bytes).");
      await fs.mkdir(path.dirname(outFile), { recursive: true });
      await fs.writeFile(outFile, bytes);
      return { bytes: bytes.length, contentType: type };
    } catch (error) {
      if (n === attempts) throw error;
      await delay(1000 * n * n);
    }
  }
}

async function generateLocalSD(photo, outFile) {
  const endpoint = (process.env.GA_LOCAL_IMAGE_API_URL || "http://127.0.0.1:7860/sdapi/v1/txt2img").replace(/\\/+$/, "");
  const response = await fetch(endpoint, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      prompt: promptFor(photo),
      negative_prompt: "text, letters, watermark, logo, fake map, fake court seal, distorted hands, extra fingers, artificial face, duplicated people, collage, screenshot, poster, infographic",
      width: WIDTH, height: HEIGHT, steps: 28, cfg_scale: 6.5, batch_size: 1
    }),
    signal: AbortSignal.timeout(180000)
  });
  if (!response.ok) throw new Error("Gerador local retornou HTTP " + response.status + ".");
  const payload = await response.json();
  const image = payload.images && payload.images[0];
  if (!image) throw new Error("Gerador local não devolveu imagem.");
  const bytes = Buffer.from(image, "base64");
  if (bytes.length < 20000) throw new Error("Imagem local muito pequena.");
  await fs.mkdir(path.dirname(outFile), { recursive: true });
  await fs.writeFile(outFile, bytes);
  return { bytes: bytes.length, contentType: "image/png" };
}

const photos = CATALOG_DATA.photos.filter(photo => {
  if (ONLY_ID && photo.id !== ONLY_ID) return false;
  if (photo.source_required && !INCLUDE_SOURCE_REQUIRED) return false;
  return true;
});

let generated = 0, skipped = 0, failures = 0;
for (const photo of photos) {
  const outFile = destinationFor(photo);
  if (!FORCE && await exists(outFile)) { skipped++; continue; }
  if (photo.source_required) {
    console.warn("SOURCE REQUIRED — " + photo.id + ": usar fotografia/arquivo real autorizado ou mapa oficial.");
    skipped++;
    continue;
  }
  try {
    const result = PROVIDER === "local-sd"
      ? await generateLocalSD(photo, outFile)
      : await generatePollinations(photo, outFile);
    console.log("OK " + photo.id + " -> " + path.relative(ROOT, outFile) + " (" + result.bytes + " bytes, " + result.contentType + ")");
    generated++;
    await delay(Number(process.env.GA_IMAGE_DELAY_MS || 900));
  } catch (error) {
    failures++;
    console.error("FAIL " + photo.id + ": " + error.message);
  }
}
console.log(JSON.stringify({
  provider: PROVIDER, generated, skipped, failures,
  catalogRecords: CATALOG_DATA.photos.length,
  sourceRequired: CATALOG_DATA.photos.filter(p => p.source_required).map(p => p.id)
}, null, 2));
if (failures) process.exitCode = 1;
