#!/usr/bin/env python3
"""Build clearly labeled temporary homepage preview crops from the three existing banner files. These are not canonical photo masters and must not replace HOME-01.webp through HOME-04.webp.

The source banners contain baked-in headline text. This script crops that text region away so
the theme can render accessible, editable HTML headlines and one consistent call-to-action.
It does NOT fabricate the 111 photographic masters from the Visual Master Book.
"""
from pathlib import Path
from PIL import Image, ImageOps

ROOT = Path(__file__).resolve().parents[2]
SOURCE = ROOT / "packages"
TARGET = ROOT / "site-core" / "garibalde-institucional" / "assets" / "images" / "home-preview"
ASSETS = (
    ("slide-1.png", "slide-1-preview.webp"),
    ("slide-2.png", "slide-2-preview.webp"),
    ("slide-3.png", "slide-3-preview.webp"),
)

def main() -> None:
    TARGET.mkdir(parents=True, exist_ok=True)
    for source_name, target_name in ASSETS:
        source_path = SOURCE / source_name
        if not source_path.is_file():
            raise FileNotFoundError(f"Missing required prepared homepage source: {source_path}")
        with Image.open(source_path) as source:
            rgb = ImageOps.exif_transpose(source).convert("RGB")
            width, height = rgb.size
            # Remove the baked-in headline panel at the left; keep the actual scene.
            crop_left = min(max(int(width * 0.43), 1), width - 2)
            scene = rgb.crop((crop_left, 0, width, height))
            # Crop/resize to a wide, consistent hero composition without stretching.
            target_ratio = 2.15
            sw, sh = scene.size
            current_ratio = sw / sh
            if current_ratio > target_ratio:
                new_width = int(sh * target_ratio)
                left = max((sw - new_width) // 2, 0)
                scene = scene.crop((left, 0, left + new_width, sh))
            elif current_ratio < target_ratio:
                new_height = int(sw / target_ratio)
                top = max((sh - new_height) // 2, 0)
                scene = scene.crop((0, top, sw, top + new_height))
            scene = scene.resize((1290, 600), Image.Resampling.LANCZOS)
            target_path = TARGET / target_name
            scene.save(target_path, "WEBP", quality=86, method=6)
            print(f"{source_name} -> {target_path.relative_to(ROOT)} ({target_path.stat().st_size} bytes)")

if __name__ == "__main__":
    main()
