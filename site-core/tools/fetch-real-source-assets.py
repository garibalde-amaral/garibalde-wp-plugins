#!/usr/bin/env python3
"""Fetch real/source-only image assets. Never fabricate an office photo or an official map."""
from __future__ import annotations
import argparse, io, os, sys, urllib.request
from pathlib import Path
from PIL import Image, ImageOps

ROOT = Path(__file__).resolve().parents[2]
THEME = ROOT / "site-core" / "garibalde-institucional"
PAGES = THEME / "assets" / "images" / "pages"
SOURCE = ROOT / "site-core" / "source-media"
WIKIMEDIA_FILE = "https://commons.wikimedia.org/wiki/Special:FilePath/Vista_A%C3%A9rea_de_An%C3%A1polis,_2023.jpg?width=1600"
WIKIMEDIA_PAGE = "https://commons.wikimedia.org/wiki/File:Vista_A%C3%A9rea_de_An%C3%A1polis,_2023.jpg"
WIKIMEDIA_LICENSE = "https://creativecommons.org/licenses/by-sa/4.0/"

def save_webp(data: bytes, destination: Path, max_width: int = 1600) -> tuple[int, int, int]:
    with Image.open(io.BytesIO(data)) as source:
        image = ImageOps.exif_transpose(source).convert("RGB")
        if image.width > max_width:
            height = round(image.height * (max_width / image.width))
            image = image.resize((max_width, height), Image.Resampling.LANCZOS)
        destination.parent.mkdir(parents=True, exist_ok=True)
        image.save(destination, "WEBP", quality=88, method=6)
        return image.width, image.height, destination.stat().st_size

def download_location_view(force: bool) -> bool:
    target = PAGES / "LOC-02.webp"
    if target.exists() and target.stat().st_size > 50000 and not force:
        print("SKIP LOC-02.webp: fonte licenciada já existe.")
        return True
    req = urllib.request.Request(WIKIMEDIA_FILE, headers={
        "User-Agent": "GaribaldeCorePhotoBuild/1.0 (site asset generator; contact: contato@garibaldeadvogados.com.br)",
        "Accept": "image/jpeg,image/png,image/webp"
    })
    try:
        with urllib.request.urlopen(req, timeout=90) as response:
            content_type = (response.headers.get("Content-Type") or "").lower()
            data = response.read()
        if not content_type.startswith("image/"):
            raise RuntimeError("Wikimedia redirect did not return an image: " + content_type)
        width, height, size = save_webp(data, target)
        print(f"OK LOC-02.webp: real city view of Anápolis {width}x{height}, {size} bytes.")
        return True
    except Exception as exc:
        print("ERROR LOC-02 source download failed: " + str(exc), file=sys.stderr)
        return False

def import_local_sources() -> list[str]:
    """Import only client-supplied original files, if present; do not create substitute images."""
    imported = []
    mapping = {
        "EQ-01.webp": ("EQ-01.jpg", "EQ-01.jpeg", "EQ-01.png", "image6.JPG"),
        "LOC-01.webp": ("LOC-01.jpg", "LOC-01.jpeg", "LOC-01.png"),
        "LOC-04.webp": ("LOC-04.jpg", "LOC-04.jpeg", "LOC-04.png"),
    }
    for output, candidates in mapping.items():
        target = PAGES / output
        if target.exists() and target.stat().st_size > 50000:
            continue
        source_file = next((SOURCE / name for name in candidates if (SOURCE / name).is_file()), None)
        env_key = {"EQ-01.webp":"GA_EQ01_SOURCE","LOC-01.webp":"GA_LOC01_SOURCE","LOC-04.webp":"GA_LOC04_SOURCE"}[output]
        if not source_file and os.environ.get(env_key):
            candidate = Path(os.environ[env_key]).expanduser()
            if candidate.is_file():
                source_file = candidate
        if source_file:
            try:
                with Image.open(source_file) as source:
                    image = ImageOps.exif_transpose(source).convert("RGB")
                    max_width = 1600
                    if image.width > max_width:
                        h = round(image.height * (max_width / image.width))
                        image = image.resize((max_width,h),Image.Resampling.LANCZOS)
                    target.parent.mkdir(parents=True,exist_ok=True)
                    image.save(target,"WEBP",quality=88,method=6)
                print("OK " + output + " imported from approved source: " + str(source_file))
                imported.append(output)
            except Exception as exc:
                print("ERROR importing " + output + ": " + str(exc), file=sys.stderr)
        else:
            print("SOURCE REQUIRED " + output + ": no approved source file found; it will not be fabricated.")
    return imported

def main() -> int:
    parser = argparse.ArgumentParser()
    parser.add_argument("--force",action="store_true")
    args = parser.parse_args()
    PAGES.mkdir(parents=True,exist_ok=True)
    result = import_local_sources()
    loc_ok = download_location_view(args.force)
    # LOC-03 is a real interactive Google Maps embed, not a generated image file.
    credits = (
        "# Créditos de fotografia\n\n"
        "- **LOC-02 — Vista aérea de Anápolis (2023):** Samuel Sousa, 10/06/2023, Wikimedia Commons. "
        f"[Arquivo original]({WIKIMEDIA_PAGE}) · [Licença CC BY-SA 4.0]({WIKIMEDIA_LICENSE}). "
        "A versão WebP do tema foi redimensionada/convertida; atribuição e indicação da alteração são preservadas.\n\n"
        "- EQ-01, LOC-01 e LOC-04 só são importados de arquivo original/autorizado. Nenhuma imagem sintética é criada para fingir ser o retrato real, a fachada do escritório ou a rua efetiva.\n"
        "- LOC-03 é implementado como mapa interativo real no template da página Localização.\n"
    )
    (ROOT/"site-core"/"PHOTO-CREDITS.md").write_text(credits,encoding="utf-8")
    print("Source-only import complete. Imported local sources: " + (", ".join(result) if result else "none"))
    return 0 if loc_ok else 1
if __name__=="__main__":
    raise SystemExit(main())
