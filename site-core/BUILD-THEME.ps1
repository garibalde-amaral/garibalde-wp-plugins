$ErrorActionPreference = "Stop"
$root = Split-Path -Parent $MyInvocation.MyCommand.Path
$theme = Join-Path $root "garibalde-institucional"
$out = Join-Path $root "garibalde-institucional-2.0.0.zip"
$checker = Join-Path (Join-Path $root "tools") "check-photo-assets.py"

if (!(Test-Path (Join-Path $theme "style.css")) -or !(Test-Path (Join-Path $theme "functions.php"))) {
  throw "Estrutura de tema incompleta: pasta garibalde-institucional não encontrada."
}
if (!(Test-Path $checker)) { throw "Validador de fotografias canônicas não encontrado." }
Write-Host "Validando todos os mestres de imagem antes de empacotar..."
python $checker
if ($LASTEXITCODE -ne 0) {
  throw "Pacote NÃO criado: faltam fotografias canônicas ou fontes reais. Execute GERAR-FOTOS-E-MONTAR.bat após preparar ComfyUI e os arquivos reais autorizados."
}
if (Test-Path $out) { Remove-Item $out -Force }
Compress-Archive -Path (Join-Path $theme "*") -DestinationPath $out -CompressionLevel Optimal
Write-Host "Pacote completo criado: $out"
Write-Host "Este arquivo apenas empacota o tema; não instala nem altera a Locaweb."
