#!/usr/bin/env python3
"""Verify the canonical photo set before making an installable theme ZIP."""
from __future__ import annotations
import json, sys
from pathlib import Path
from PIL import Image

ROOT = Path(__file__).resolve().parents[2]
SITE = ROOT / "site-core"
THEME = SITE / "garibalde-institucional"
MANIFEST = SITE / "photo-manifest-111.json"
VIRTUAL_ASSETS = {
    "LOC-03": "official Google Maps embed in page-localizacao.php",
    "LOC-04": "verified Google Maps and Waze route links in page-localizacao.php",
}

manifest=json.loads(MANIFEST.read_text(encoding="utf-8"))
missing=[]
invalid=[]
present=[]
virtual=[]
for asset in manifest["assets"]:
    asset_id=asset["id"]
    if asset_id in VIRTUAL_ASSETS:
        page=THEME/"page-localizacao.php"
        code=page.read_text(encoding="utf-8") if page.exists() else ""
        if asset_id == "LOC-03":
            ok = "maps?q=" in code and "output=embed" in code
        elif asset_id == "LOC-04":
            ok = "google.com/maps/dir/" in code and "waze.com/ul" in code
        else:
            ok = False
        if ok:
            virtual.append({"id":asset_id,"implementation":VIRTUAL_ASSETS[asset_id]})
        else:
            invalid.append({"id":asset_id,"error":"real map/navigation component not verified"})
        continue
    dest=THEME/asset["destination"]/asset["filename"]
    if not dest.is_file():
        missing.append({"id":asset_id,"file":str(dest.relative_to(ROOT)),"source_required":bool(asset.get("source_required"))})
        continue
    try:
        with Image.open(dest) as img:
            w,h=img.size
            img.verify()
        with Image.open(dest) as img:
            if asset_id=="EQ-01":
                valid=(w>=500 and h>=700)
            else:
                valid=(w>=1200 and h>=600)
            if not valid:
                invalid.append({"id":asset_id,"file":str(dest.relative_to(ROOT)),"error":f"resolution {w}x{h} too small"})
            else:
                present.append({"id":asset_id,"file":str(dest.relative_to(ROOT)),"width":w,"height":h,"bytes":dest.stat().st_size})
    except Exception as exc:
        invalid.append({"id":asset_id,"file":str(dest.relative_to(ROOT)),"error":str(exc)})

report={
 "manifest_count":len(manifest["assets"]),
 "files_present_and_dimension_valid":len(present),
 "virtual_sources_valid":len(virtual),
 "missing_count":len(missing),
 "invalid_count":len(invalid),
 "missing":missing,
 "invalid":invalid,
 "status":"READY_FOR_HOMOLOGATION" if not missing and not invalid else "INCOMPLETE_NO_INSTALLABLE_PACKAGE"
}
(SITE/"photo-assets-readiness.json").write_text(json.dumps(report,ensure_ascii=False,indent=2)+"\n",encoding="utf-8")
print(json.dumps({k:v for k,v in report.items() if k not in ("missing","invalid")},ensure_ascii=False,indent=2))
if missing:
    print("Missing canonical photo assets:",file=sys.stderr)
    for item in missing:
        print(" - {id}: {file}{suffix}".format(id=item["id"],file=item["file"],suffix=" [REAL SOURCE REQUIRED]" if item["source_required"] else ""),file=sys.stderr)
if invalid:
    print("Invalid photo assets:",file=sys.stderr)
    for item in invalid:
        print(" - {id}: {error}".format(**item),file=sys.stderr)
sys.exit(0 if report["status"]=="READY_FOR_HOMOLOGATION" else 2)
