#!/usr/bin/env python3
"""Resolve real/source-only visual assets without inventing faces, office fronts or maps."""
from __future__ import annotations
import io, json, os, re, sys, urllib.error, urllib.parse, urllib.request, zipfile
from pathlib import Path
from PIL import Image, ImageOps

ROOT = Path(__file__).resolve().parents[2]
THEME = ROOT / "site-core" / "garibalde-institucional"
PAGES = THEME / "assets" / "images" / "pages"
SOURCE = ROOT / "site-core" / "source-media"
SITE_URL = os.environ.get("GA_OLD_SITE_URL", "https://garibaldeadvogados.com.br").rstrip("/")
ALLOWED_HOSTS = {"garibaldeadvogados.com.br", "www.garibaldeadvogados.com.br"}
WIKIMEDIA_FILE = "https://upload.wikimedia.org/wikipedia/commons/8/8e/Vista_A%C3%A9rea_de_An%C3%A1polis%2C_2023.jpg"
WIKIMEDIA_PAGE = "https://commons.wikimedia.org/wiki/File:Vista_A%C3%A9rea_de_An%C3%A1polis,_2023.jpg"
WIKIMEDIA_LICENSE = "https://creativecommons.org/licenses/by-sa/4.0/"

def request_bytes(url: str, timeout: int = 90, image_only: bool = False) -> tuple[bytes, str]:
    parsed = urllib.parse.urlparse(url)
    if parsed.scheme != "https":
        raise RuntimeError("Refused non-HTTPS source: " + url)
    headers = {
        "User-Agent": "GaribaldeCorePhotoBuild/1.0 (website asset automation; contact: contato@garibaldeadvogados.com.br)",
        "Accept": "image/webp,image/jpeg,image/png,application/json;q=0.9,*/*;q=0.5" if image_only else "application/json"
    }
    req = urllib.request.Request(url, headers=headers)
    try:
        with urllib.request.urlopen(req, timeout=timeout) as response:
            content_type = (response.headers.get("Content-Type") or "").lower()
            data = response.read()
    except urllib.error.HTTPError as exc:
        detail = exc.read().decode("utf-8", errors="replace")[:1000]
        raise RuntimeError("HTTP " + str(exc.code) + ": " + detail) from exc
    except urllib.error.URLError as exc:
        raise RuntimeError("Download failed: " + str(exc.reason)) from exc
    if image_only and not content_type.startswith("image/"):
        raise RuntimeError("Source did not return an image (" + content_type + ")")
    return data, content_type

def save_webp(data: bytes, destination: Path, max_width: int = 1600, portrait: bool = False) -> tuple[int, int, int]:
    with Image.open(io.BytesIO(data)) as source:
        image = ImageOps.exif_transpose(source).convert("RGB")
        if portrait:
            image.thumbnail((900, 1200), Image.Resampling.LANCZOS)
        elif image.width > max_width:
            height = round(image.height * (max_width / image.width))
            image = image.resize((max_width, height), Image.Resampling.LANCZOS)
        destination.parent.mkdir(parents=True, exist_ok=True)
        image.save(destination, "WEBP", quality=88, method=6)
        return image.width, image.height, destination.stat().st_size

def fetch_location_view(force: bool) -> bool:
    target = PAGES / "LOC-02.webp"
    if target.exists() and target.stat().st_size > 50000 and not force:
        print("SKIP LOC-02.webp: source-verified city photo already exists.")
        return True
    try:
        data, _ = request_bytes(WIKIMEDIA_FILE, image_only=True)
        width, height, size = save_webp(data, target)
        print(f"OK LOC-02.webp: Wikimedia Commons city view {width}x{height}, {size} bytes.")
        return True
    except Exception as exc:
        print("ERROR LOC-02 source download failed: " + str(exc), file=sys.stderr)
        return False

def extract_portrait_from_book() -> bool:
    target = PAGES / "EQ-01.webp"
    if target.exists() and target.stat().st_size > 10000:
        print("SKIP EQ-01.webp: approved portrait already exists.")
        return True
    candidates = [
        SOURCE / "Livro_Visual_Mestre_Garibalde_Amaral_v2_INTEGRADO.docx",
        SOURCE / "Livro_Visual_Mestre_Garibalde_Amaral_v2_INTEGRADO(2).docx",
        ROOT / "Livro_Visual_Mestre_Garibalde_Amaral_v2_INTEGRADO(2).docx",
        ROOT / "site-core" / "Livro_Visual_Mestre_Garibalde_Amaral_v2_INTEGRADO(2).docx",
    ]
    for book in candidates:
        if not book.is_file():
            continue
        try:
            with zipfile.ZipFile(book) as archive:
                name = next((n for n in archive.namelist() if n.lower().endswith("/image6.jpg")), None)
                if not name:
                    continue
                data = archive.read(name)
            width, height, size = save_webp(data, target, portrait=True)
            if width < 500 or height < 700:
                target.unlink(missing_ok=True)
                raise RuntimeError("portrait source resolution too small")
            print("OK EQ-01.webp: imported original portrait image6.JPG from the supplied Master Visual Book.")
            return True
        except Exception as exc:
            print("WARN could not import portrait from " + str(book) + ": " + str(exc), file=sys.stderr)
    # Also accept a previously extracted original supplied by the user.
    direct = SOURCE / "EQ-01.jpg"
    if direct.is_file():
        width, height, size = save_webp(direct.read_bytes(), target, portrait=True)
        print("OK EQ-01.webp: imported supplied original portrait.")
        return True
    print("SOURCE REQUIRED EQ-01.webp: the real team portrait is not available in the source-media folder; no synthetic portrait will be created.")
    return False

def remote_wp_media(terms: list[str], output_name: str, min_width: int = 1200) -> bool:
    target = PAGES / output_name
    if target.exists() and target.stat().st_size > 50000:
        print("SKIP " + output_name + ": real source already exists.")
        return True
    for term in terms:
        endpoint = SITE_URL + "/wp-json/wp/v2/media?" + urllib.parse.urlencode({
            "search": term, "per_page": 40, "media_type": "image"
        })
        try:
            raw, _ = request_bytes(endpoint, image_only=False)
            items = json.loads(raw.decode("utf-8"))
            if not isinstance(items, list):
                continue
            for item in items:
                title = str((item.get("title") or {}).get("rendered", ""))
                alt = str(item.get("alt_text") or "")
                slug = str(item.get("slug") or "")
                caption = str((item.get("caption") or {}).get("rendered", ""))
                text = " ".join([title, alt, slug, caption]).lower()
                # Require a matching asset description and reject old banners/covers/logos.
                if not any(term.lower() in text for term in terms):
                    continue
                if re.search(r"banner|capa|slide|slider|carrossel|logo|logotipo|header|topo|mockup", text):
                    continue
                source_url = str(item.get("source_url") or "")
                parsed = urllib.parse.urlparse(source_url)
                if parsed.scheme != "https" or (parsed.hostname or "").lower() not in ALLOWED_HOSTS:
                    continue
                data, _ = request_bytes(source_url, image_only=True)
                width, height, size = save_webp(data, target)
                if width < min_width or height < 600:
                    target.unlink(missing_ok=True)
                    continue
                print("OK " + output_name + ": imported image from the official website media library (" + term + ").")
                return True
        except Exception as exc:
            print("WARN official media search for '" + term + "' unavailable: " + str(exc), file=sys.stderr)
    print("SOURCE REQUIRED " + output_name + ": no matching real photograph was found in the official site's media library.")
    return False

def main() -> int:
    import argparse
    parser = argparse.ArgumentParser()
    parser.add_argument("--force", action="store_true")
    args = parser.parse_args()
    PAGES.mkdir(parents=True, exist_ok=True)
    ok = True
    # These must always come from a real source, never from the image generator.
    ok = extract_portrait_from_book() and ok
    ok = remote_wp_media(["fachada", "sede do escritório", "fachada escritório"], "LOC-01.webp") and ok
    ok = fetch_location_view(args.force) and ok
    # LOC-03 is implemented as the official Google Maps embed in page-localizacao.php.
    ok = remote_wp_media(["rua do escritório", "acesso ao escritório", "rua senado alfredo nasser"], "LOC-04.webp") and ok
    credits = (
        "# Créditos de fotografia\n\n"
        f"- **LOC-02 — Vista aérea de Anápolis (2023):** Samuel Sousa, 10/06/2023, Wikimedia Commons. "
        f"[Arquivo original]({WIKIMEDIA_PAGE}) · [Licença CC BY-SA 4.0]({WIKIMEDIA_LICENSE}). "
        "A versão WebP do tema foi redimensionada/convertida.\n\n"
        "- EQ-01 vem do retrato original autorizado no Livro Visual Mestre; nunca gerar um rosto sintético como substituição.\n"
        "- LOC-01 e LOC-04 são importados somente quando há fotografias correspondentes na biblioteca oficial do site. Nenhuma fachada/rua é fabricada.\n"
        "- LOC-03 é implementado como mapa interativo real em page-localizacao.php.\n"
    )
    (ROOT / "site-core" / "PHOTO-CREDITS.md").write_text(credits, encoding="utf-8")
    print("Source-only asset import complete.")
    return 0 if ok else 2

if __name__ == "__main__":
    raise SystemExit(main())
