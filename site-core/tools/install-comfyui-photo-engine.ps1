$ErrorActionPreference = "Stop"
$ProgressPreference = "Continue"

$toolsDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$siteCoreDir = Split-Path -Parent $toolsDir
$repoRoot = Split-Path -Parent $siteCoreDir
$toolchain = Join-Path $siteCoreDir "toolchain"
$portableRoot = Join-Path $toolchain "ComfyUI_windows_portable"
$extractRoot = Join-Path $toolchain "_comfyui_extract_tmp"
$extractor = Join-Path $toolchain "7zr.exe"
$comfyDir = Join-Path $portableRoot "ComfyUI"
$modelName = "RealVisXL_V4.0.safetensors"
$modelPath = Join-Path (Join-Path $comfyDir "models\checkpoints") $modelName
$gpuNames = @()
try { $gpuNames = @(Get-CimInstance Win32_VideoController | ForEach-Object { [string]$_.Name }) } catch {}
$gpuText = $gpuNames -join "; "
$portableFlavor = "nvidia"
if ($gpuText -match "AMD|Radeon") { $portableFlavor = "amd" }
elseif ($gpuText -match "Intel Arc") { $portableFlavor = "intel" }
$portableArchiveName = "ComfyUI_windows_portable_" + $portableFlavor + ".7z"
$archive = Join-Path $toolchain $portableArchiveName
$portableUrl = "https://github.com/Comfy-Org/ComfyUI/releases/latest/download/" + $portableArchiveName
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

# Reuse a running server, but still verify/download the checkpoint below.
$serverAlreadyRunning = $false
try {
    Invoke-RestMethod -Uri "http://127.0.0.1:8188/system_stats" -TimeoutSec 3 | Out-Null
    $serverAlreadyRunning = $true
    Write-Host "ComfyUI já está respondendo em http://127.0.0.1:8188."
} catch {}

if (!(Test-Path (Join-Path $comfyDir "main.py"))) {
    Write-Host "[1/3] Preparando o ComfyUI portátil oficial..."
    Download-File $extractorUrl $extractor 100000
    Download-File $portableUrl $archive 500000000

    if (Test-Path $extractRoot) { Remove-Item $extractRoot -Recurse -Force }
    New-Item -ItemType Directory -Path $extractRoot -Force | Out-Null
    & $extractor x $archive "-o$extractRoot" -y | Out-Host
    if ($LASTEXITCODE -ne 0) { throw "Falha ao extrair o ComfyUI portátil." }

    $runner = Get-ChildItem -Path $extractRoot -Recurse -File -Filter "run_*.bat" |
        Where-Object { $_.Name -match "^run_(nvidia_gpu|amd_gpu|intel_gpu|cpu)\.bat$" } |
        Select-Object -First 1
    if (!$runner) { throw "Nenhum inicializador run_*.bat foi encontrado no pacote oficial extraído." }
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
$runnerCandidates = @(
    (Join-Path $portableRoot "run_nvidia_gpu.bat"),
    (Join-Path $portableRoot "run_amd_gpu.bat"),
    (Join-Path $portableRoot "run_intel_gpu.bat"),
    (Join-Path $portableRoot "run_cpu.bat")
)
if (-not ($runnerCandidates | Where-Object { Test-Path $_ })) {
    throw "Nenhum inicializador oficial do ComfyUI foi encontrado."
}
if (!(Test-Path $modelPath) -or (Get-Item $modelPath).Length -lt 5000000000) {
    throw "Checkpoint SDXL ausente ou pequeno demais."
}

Write-Host "ComfyUI e checkpoint instalados em:"
Write-Host "  $portableRoot"
Write-Host "  $modelPath"
Write-Host "Modelo: RealVisXL V4.0, publicado sob licença OpenRAIL++."
Write-Host "O uso local é sem cobrança por chamada, mas consome armazenamento, energia e capacidade de processamento."

if (!$serverAlreadyRunning) {
    if ($gpuText -match "NVIDIA" -and (Test-Path (Join-Path $portableRoot "run_nvidia_gpu.bat"))) {
        $runnerToUse = Join-Path $portableRoot "run_nvidia_gpu.bat"
    } elseif ($gpuText -match "AMD|Radeon" -and (Test-Path (Join-Path $portableRoot "run_amd_gpu.bat"))) {
        $runnerToUse = Join-Path $portableRoot "run_amd_gpu.bat"
    } elseif ($gpuText -match "Intel Arc" -and (Test-Path (Join-Path $portableRoot "run_intel_gpu.bat"))) {
        $runnerToUse = Join-Path $portableRoot "run_intel_gpu.bat"
    } elseif (Test-Path (Join-Path $portableRoot "run_cpu.bat")) {
        $runnerToUse = Join-Path $portableRoot "run_cpu.bat"
    } else {
        $runnerToUse = $runnerCandidates | Where-Object { Test-Path $_ } | Select-Object -First 1
    }
    Write-Host "Iniciando o motor em segundo plano com: $(Split-Path -Leaf $runnerToUse)"
    Start-Process -FilePath $env:ComSpec -ArgumentList @("/c", ('"' + $runnerToUse + '"')) -WorkingDirectory $portableRoot -WindowStyle Minimized
}
$deadline = (Get-Date).AddMinutes(4)
$ready = $false
while ((Get-Date) -lt $deadline) {
    try {
        Invoke-RestMethod -Uri "http://127.0.0.1:8188/system_stats" -TimeoutSec 5 | Out-Null
        $ready = $true
        break
    } catch {
        Start-Sleep -Seconds 3
    }
}
if (!$ready) {
    throw "O ComfyUI não respondeu em http://127.0.0.1:8188 após a inicialização. Verifique a janela do motor e o driver gráfico."
}
Write-Host "Motor pronto em http://127.0.0.1:8188."
