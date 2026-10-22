#!/usr/bin/env python3
"""Fail-fast checks for the canonical 111-photo master manifest."""
import json
from collections import Counter
from pathlib import Path

ROOT = Path(__file__).resolve().parents[2]
manifest_path = ROOT / "site-core" / "photo-manifest-111.json"
manifest = json.loads(manifest_path.read_text(encoding="utf-8"))
assets = manifest.get("assets", [])
assert len(assets) == 111, f"expected 111 assets, found {len(assets)}"
ids = [a.get("id") for a in assets]
filenames = [a.get("filename") for a in assets]
assert len(set(ids)) == len(ids), "duplicate canonical asset IDs"
assert len(set(filenames)) == len(filenames), "duplicate canonical filenames"

types = Counter(a.get("type") for a in assets)
assert types.get("primary_page") == 36, f"expected 36 primary-page assets: {types}"
assert types.get("practice_area") == 75, f"expected 75 practice-area assets: {types}"

eligible = [a for a in assets if a.get("generation_allowed") is True]
blocked = [a for a in assets if a.get("source_required") is True]
assert len(eligible) == 106, f"expected 106 AI-eligible assets, got {len(eligible)}"
assert len(blocked) == 5, f"expected 5 source-required assets, got {len(blocked)}"
assert all(not a.get("prompt") for a in blocked), "real-source assets must not have generative prompts"
assert all(a.get("prompt") and a.get("filename", "").endswith(".webp") for a in eligible)


# Real-source and privacy guardrails.
by_id = {a["id"]: a for a in assets}
assert by_id["EQ-01"].get("source_status") == "provided_original_portrait_in_visual_master_book"
assert (ROOT / "site-core/garibalde-institucional/assets/images/pages/EQ-01.webp").is_file(), "real source portrait EQ-01 missing"
assert by_id["LOC-01"].get("source_status") == "pending_real_office_photo"
assert by_id["LOC-02"].get("license") == "CC BY-SA 4.0"
assert by_id["LOC-03"].get("source_status") == "implemented_as_native_live_map_embed"
assert by_id["LOC-04"].get("source_status") == "implemented_as_verified_navigation_links"
assert all(not a.get("prompt") for a in blocked), "real-source assets must not have generative prompts"

areas = {}
for asset in assets:
    if asset.get("type") == "practice_area":
        areas.setdefault(asset["group"], []).append(asset)
assert len(areas) == 15, f"expected 15 practice-area groups, got {len(areas)}"
for group, group_assets in areas.items():
    assert len(group_assets) == 5, f"{group}: expected five options"
    ranks = [a.get("priority") for a in group_assets]
    assert sorted(ranks) == [1, 2, 3, 4, 5], f"{group}: priorities are not 1-5"
    selected = [a for a in group_assets if a.get("selected_for_live_slides")]
    assert len(selected) == 2, f"{group}: exactly two initial carousel images expected"
    assert sorted(a["priority"] for a in selected) == [1, 2], f"{group}: wrong default choices"

print("OK: 111 canonical assets, 36 primary-page briefs, 75 area briefs, 106 eligible for AI generation, 5 requiring real verified sources.")
