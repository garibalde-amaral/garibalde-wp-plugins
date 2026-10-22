#!/usr/bin/env python3
"""Generate canonical, non-sensitive photo masters using a local ComfyUI API.

Requires a running ComfyUI server and a realistic checkpoint that the user is licensed to use.
This program generates only manifest assets with generation_allowed=true. It will never create
the real team portraits, real office/location photos or a fake map.
"""
from __future__ import annotations

import argparse
import io
import json
import os
import random
import sys
import time
import urllib.error
import urllib.parse
import urllib.request
from pathlib import Path
from typing import Any

from PIL import Image, ImageOps

ROOT = Path(__file__).resolve().parents[2]
MANIFEST = ROOT / "site-core" / "photo-manifest-111.json"
THEME = ROOT / "site-core" / "garibalde-institucional"
NEGATIVE = (
    "text, letters, words, typography, watermark, logo, trademark, fake sign, "
    "legible document, personal information, numbers on documents, distorted hands, "
    "extra fingers, deformed people, duplicate objects, blurry, low quality, "
    "oversaturated, sensationalist courtroom, identifiable real person"
)

def request_json(url: str, payload: dict[str, Any] | None = None, timeout: int = 60) -> dict[str, Any]:
    data = None if payload is None else json.dumps(payload).encode("utf-8")
    headers = {"Accept": "application/json"}
    if data is not None:
        headers["Content-Type"] = "application/json"
    req = urllib.request.Request(url, data=data, headers=headers)
    try:
        with urllib.request.urlopen(req, timeout=timeout) as response:
            body = response.read()
    except urllib.error.HTTPError as exc:
        detail = exc.read().decode("utf-8", errors="replace")[:2000]
        raise RuntimeError(f"HTTP {exc.code} calling {url}: {detail}") from exc
    except urllib.error.URLError as exc:
        raise RuntimeError(f"Cannot reach {url}: {exc.reason}") from exc
    try:
        return json.loads(body.decode("utf-8"))
    except json.JSONDecodeError as exc:
        raise RuntimeError(f"Expected JSON from {url}; received non-JSON response.") from exc

def request_bytes(url: str, timeout: int = 120) -> bytes:
    req = urllib.request.Request(url, headers={"Accept": "image/png,application/octet-stream"})
    try:
        with urllib.request.urlopen(req, timeout=timeout) as response:
            return response.read()
    except urllib.error.HTTPError as exc:
        detail = exc.read().decode("utf-8", errors="replace")[:1000]
        raise RuntimeError(f"HTTP {exc.code} downloading generated image: {detail}") from exc

def comfy_workflow(asset: dict[str, Any], checkpoint: str, width: int, height: int) -> dict[str, Any]:
    seed = random.SystemRandom().randrange(1, 2**31 - 1)
    prompt = str(asset.get("prompt") or "").strip()
    if not prompt:
        raise ValueError(f"{asset.get('id')}: no generation prompt.")
    prefix = "GA_MASTERS/" + str(asset["id"])
    return {
        "1": {"class_type": "CheckpointLoaderSimple", "inputs": {"ckpt_name": checkpoint}},
        "2": {"class_type": "CLIPTextEncode", "inputs": {"text": prompt, "clip": ["1", 1]}},
        "3": {"class_type": "CLIPTextEncode", "inputs": {"text": NEGATIVE, "clip": ["1", 1]}},
        "4": {"class_type": "EmptyLatentImage", "inputs": {"width": width, "height": height, "batch_size": 1}},
        "5": {"class_type": "KSampler", "inputs": {
            "seed": seed, "steps": 28, "cfg": 6.0, "sampler_name": "dpmpp_2m",
            "scheduler": "karras", "denoise": 1.0, "model": ["1", 0],
            "positive": ["2", 0], "negative": ["3", 0], "latent_image": ["4", 0]
        }},
        "6": {"class_type": "VAEDecode", "inputs": {"samples": ["5", 0], "vae": ["1", 2]}},
        "7": {"class_type": "SaveImage", "inputs": {"filename_prefix": prefix, "images": ["6", 0]}}
    }

def wait_for_output(base_url: str, prompt_id: str, timeout: int) -> dict[str, Any]:
    deadline = time.monotonic() + timeout
    while time.monotonic() < deadline:
        history = request_json(base_url + "/history/" + urllib.parse.quote(prompt_id), timeout=30)
        info = history.get(prompt_id)
        if info and info.get("outputs"):
            images = info["outputs"].get("7", {}).get("images", [])
            if images:
                return images[0]
            status = info.get("status", {})
            if status.get("status_str") == "error" or status.get("completed") is True:
                raise RuntimeError(f"ComfyUI finished without an image for prompt {prompt_id}.")
        time.sleep(4)
    raise TimeoutError(f"ComfyUI did not finish prompt {prompt_id} within {timeout} seconds.")

def save_webp(base_url: str, output: dict[str, Any], destination: Path, min_width: int) -> dict[str, Any]:
    query = urllib.parse.urlencode({
        "filename": output["filename"],
        "subfolder": output.get("subfolder", ""),
        "type": output.get("type", "output")
    })
    raw = request_bytes(base_url + "/view?" + query)
    destination.parent.mkdir(parents=True, exist_ok=True)
    try:
        with Image.open(io.BytesIO(raw)) as source:
            image = ImageOps.exif_transpose(source).convert("RGB")
            if image.width < min_width or image.height < 600:
                raise RuntimeError(f"Generated image too small ({image.width}x{image.height}); not accepted.")
            image.save(destination, "WEBP", quality=88, method=6)
    except Exception as exc:
        if destination.exists():
            destination.unlink()
        raise RuntimeError(f"Could not validate/convert generated image {output.get('filename')}: {exc}") from exc
    return {"width": image.width, "height": image.height, "bytes": destination.stat().st_size}

def main() -> int:
    parser = argparse.ArgumentParser(description="Generate selected Garibalde photo masters from the manifest.")
    parser.add_argument("--limit", type=int, default=0, help="Limit the number of assets for a smoke test (0 = all 106 eligible assets).")
    parser.add_argument("--force", action="store_true", help="Regenerate even if a canonical file already exists.")
    parser.add_argument("--timeout", type=int, default=900, help="Maximum seconds to wait for one ComfyUI render.")
    parser.add_argument("--width", type=int, default=1536, help="Output width (should be a multiple of 64).")
    parser.add_argument("--height", type=int, default=864, help="Output height (should be a multiple of 64).")
    args = parser.parse_args()

    base_url = os.environ.get("GA_COMFYUI_BASE_URL", "http://127.0.0.1:8188").rstrip("/")
    checkpoint = os.environ.get("GA_COMFYUI_CHECKPOINT", "").strip()
    if not checkpoint or checkpoint.upper().startswith("YOUR_"):
        print("ERROR: set GA_COMFYUI_CHECKPOINT to the exact installed checkpoint filename.", file=sys.stderr)
        return 2
    if args.width % 64 or args.height % 64:
        print("ERROR: width and height must be multiples of 64.", file=sys.stderr)
        return 2
    if not MANIFEST.is_file():
        print(f"ERROR: photo manifest missing: {MANIFEST}", file=sys.stderr)
        return 2

    manifest = json.loads(MANIFEST.read_text(encoding="utf-8"))
    assets = [a for a in manifest["assets"] if a.get("generation_allowed") is True and a.get("prompt")]
    blocked = [a for a in manifest["assets"] if a.get("source_required") is True]
    if args.limit > 0:
        assets = assets[:args.limit]
    report = {
        "manifest_asset_count": len(manifest.get("assets", [])),
        "eligible_total": manifest.get("ai_generation_count"),
        "blocked_source_required": [a["id"] for a in blocked],
        "generated": [],
        "skipped_existing": [],
        "errors": [],
        "review_status": "GENERATED — TECHNICAL AND EDITORIAL REVIEW REQUIRED; NOT AUTO-APPROVED"
    }

    try:
        request_json(base_url + "/system_stats", timeout=15)
    except Exception as exc:
        print(f"ERROR: ComfyUI is not reachable at {base_url}. {exc}", file=sys.stderr)
        print("Start ComfyUI locally or set GA_COMFYUI_BASE_URL to a reachable private endpoint.", file=sys.stderr)
        return 3

    for index, asset in enumerate(assets, start=1):
        destination_folder = str(asset["destination"]).strip("/")
        destination = THEME / destination_folder / str(asset["filename"])
        if destination.exists() and destination.stat().st_size > 50000 and not args.force:
            report["skipped_existing"].append({"id": asset["id"], "file": str(destination.relative_to(ROOT))})
            print(f"[{index}/{len(assets)}] SKIP existing {asset['filename']}")
            continue
        try:
            graph = comfy_workflow(asset, checkpoint, args.width, args.height)
            queued = request_json(base_url + "/prompt", {"prompt": graph}, timeout=60)
            prompt_id = str(queued.get("prompt_id") or "")
            if not prompt_id:
                raise RuntimeError(f"ComfyUI rejected {asset['id']}: {json.dumps(queued)[:1500]}")
            output = wait_for_output(base_url, prompt_id, args.timeout)
            metadata = save_webp(base_url, output, destination, min_width=1200)
            record = {
                "id": asset["id"], "filename": asset["filename"],
                "path": str(destination.relative_to(ROOT)),
                "prompt_id": prompt_id, **metadata,
                "status": "GENERATED_REVIEW_REQUIRED"
            }
            report["generated"].append(record)
            print(f"[{index}/{len(assets)}] OK {asset['id']} -> {destination.name} ({metadata['width']}x{metadata['height']})")
        except Exception as exc:
            report["errors"].append({"id": asset.get("id"), "error": str(exc)})
            print(f"[{index}/{len(assets)}] ERROR {asset.get('id')}: {exc}", file=sys.stderr)
            break

    report_path = ROOT / "site-core" / "photo-generation-report.json"
    report_path.write_text(json.dumps(report, ensure_ascii=False, indent=2) + "\n", encoding="utf-8")
    print(f"Report: {report_path}")
    print(f"Generated: {len(report['generated'])}; skipped existing: {len(report['skipped_existing'])}; blocked for real source: {len(report['blocked_source_required'])}; errors: {len(report['errors'])}")
    print(report["review_status"])
    return 1 if report["errors"] else 0

if __name__ == "__main__":
    raise SystemExit(main())
