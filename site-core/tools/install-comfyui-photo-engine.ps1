$ErrorActionPreference = "Stop"
$ProgressPreference = "SilentlyContinue"

$toolsDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$siteCoreDir = Split-Path -Parent $toolsDir
$repoRoot = Split-Path -Parent $siteCoreDir
$toolchain = Join-Path $siteCoreDir "toolchain"
$portableRoot = Join-Path $toolchain "ComfyUI_windows_portable"
$extractRoot = Join-Path $toolchain "_comfyui_extract_tmp"
$archive = Join-Path $toolchain "ComfyUI_windows_portable_nvidia.7z"
$extractor = Join-Path $toolchain "7zr.exe"
$comfyDir = Join-Path $portableRoot "ComfyUI"
$modelName = "RealVisXL_V4.0.safetensors"
$modelPath = Join-Path (Join-Path $comfyDir "models\checkpoints") $modelName
$portableUrl = "https://github.com/comfyanonymous/ComfyUI/releases/latest/download/ComfyUI_windows_portable_nvidia.7z"
$extractorUrl = "https://www.7-zip.org/a/7zr.exe"
$modelUrl = "https://huggingface.co/SG161222/RealVisXL_V4.0/resolve/main/RealVisXL_V4.0.safetensors?download=true"
$minimumDiskFree = 18GB

function Download-File([string]$Url, [string]$Destination, [long]$MinimumBytes) {
    if ((Test-Path $Destination) -and ((Get-Item $Destination).Length -ge $MinimumBytes)) {
        Write-Host "Ja existe: $Destination"
        return
    }
    if (Test-Path $Destination) { Remove-Item $Destination -Force }
    $part = "$Destination.part"
    if (Test-Path $part) { Remove-Item $part -Force }
    Write-Host "Baixando: $Url"
    try {
        Start-BitsTransfer -Source $Url -Destination $part -ErrorAction Stop
    } catch {
        if (Test-Path $part) { Remove-Item $part -Force }
        Invoke-WebRequest -Uri $Url -OutFile $part -UseBasicParsing -Headers @{"User-Agent"="Garibalde-Core-Photo-Builder/2.0"}
    }
    if (!(Test-Path $part) -or (Get-Item $part).Length -lt $MinimumBytes) {
        throw "Download incompleto ou inválido: $Url"
    }
    Move-Item $part $Destination -Force
}

if ($env:OS -ne "Windows_NT") { throw "Este instalador é exclusivo para Windows." }
New-Item -ItemType Directory -Path $toolchain -Force | Out-Null
$drive = Get-PSDrive -Name ([System.IO.Path]::GetPathRoot($toolchain).Substring(0,1)) -ErrorAction SilentlyContinue
if ($drive -and $drive.Free -lt $minimumDiskFree) {
    throw "Espaço insuficiente. Reserve pelo menos 18 GB livres para ComfyUI, modelo SDXL e imagens."
}

# If the local API is already running, do not download another engine.
try {
    Invoke-RestMethod -Uri "http://127.0.0.1:8188/system_stats" -TimeoutSec 3 | Out-Null
    Write-Host "ComfyUI já está respondendo em http://127.0.0.1:8188."
    exit 0
} catch {}

if (!(Test-Path (Join-Path $comfyDir "main.py"))) {
    Write-Host "[1/3] Preparando o ComfyUI portátil oficial..."
    Download-File $extractorUrl $extractor 100000
    Download-File $portableUrl $archive 500000000

    if (Test-Path $extractRoot) { Remove-Item $extractRoot -Recurse -Force }
    New-Item -ItemType Directory -Path $extractRoot -Force | Out-Null
    & $extractor x $archive "-o$extractRoot" -y | Out-Host
    if ($LASTEXITCODE -ne 0) { throw "Falha ao extrair o ComfyUI portátil." }

    $runner = Get-ChildItem -Path $extractRoot -Recurse -File -Filter "run_nvidia_gpu.bat" | Select-Object -First 1
    if (!$runner) { throw "O arquivo run_nvidia_gpu.bat não foi encontrado no pacote oficial extraído." }
    $extractedPortable = $runner.Directory.FullName
    New-Item -ItemType Directory -Path $portableRoot -Force | Out-Null
    Get-ChildItem -Path $extractedPortable -Force | ForEach-Object {
        $destination = Join-Path $portableRoot $_.Name
        if (Test-Path $destination) {
            if ((Get-Item $destination).PSIsContainer) { Remove-Item $destination -Recurse -Force } else { Remove-Item $destination -Force }
        }
        Move-Item $_.FullName $destination -Force
    }
    Remove-Item $extractRoot -Recurse -Force -ErrorAction SilentlyContinue
    if (!(Test-Path (Join-Path $comfyDir "main.py"))) {
        throw "A extração terminou, mas a estrutura do ComfyUI está incompleta."
    }
} else {
    Write-Host "ComfyUI portátil já instalado."
}

Write-Host "[2/3] Baixando checkpoint fotorealista SDXL (aprox. 7 GB)..."
New-Item -ItemType Directory -Path (Split-Path -Parent $modelPath) -Force | Out-Null
Download-File $modelUrl $modelPath 5000000000

Write-Host "[3/3] Verificando o motor, modelo e comando de inicialização..."
if (!(Test-Path (Join-Path $portableRoot "run_nvidia_gpu.bat"))) {
    throw "O inicializador oficial do ComfyUI não foi encontrado."
}
if (!(Test-Path $modelPath) -or (Get-Item $modelPath).Length -lt 5000000000) {
    throw "Checkpoint SDXL ausente ou pequeno demais."
}

Write-Host "ComfyUI e checkpoint instalados em:"
Write-Host "  $portableRoot"
Write-Host "  $modelPath"
Write-Host "Modelo: RealVisXL V4.0, publicado sob licença OpenRAIL++."
Write-Host "O uso local é sem cobrança por chamada, mas consome armazenamento, energia e capacidade de processamento."
