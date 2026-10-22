$ErrorActionPreference = "Stop"
$root = Split-Path -Parent $MyInvocation.MyCommand.Path
$theme = Join-Path $root "garibalde-institucional"
$out = Join-Path $root "garibalde-institucional-2.0.0.zip"
if (!(Test-Path (Join-Path $theme "style.css")) -or !(Test-Path (Join-Path $theme "functions.php"))) {
  throw "Estrutura de tema incompleta: pasta garibalde-institucional não encontrada."
}
if (Test-Path $out) { Remove-Item $out -Force }
Compress-Archive -Path (Join-Path $theme "*") -DestinationPath $out -CompressionLevel Optimal
Write-Host "Pacote criado: $out"
Write-Host "Este arquivo empacota o tema; não instala nem altera a Locaweb."
