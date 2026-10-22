@echo off
setlocal EnableExtensions
title Garibalde Core - Gerar Fotos e Montar Tema
cd /d "%~dp0.."

echo ==========================================================
echo GARIBALDE CORE - GERACAO AUTOMATICA DAS IMAGENS DO LIVRO
echo ==========================================================
echo.
echo O catalogo canonico contem 111 IDs:
echo - 106 imagens editoriais geradas automaticamente por IA local
echo - 5 itens que exigem fonte real/autorizada ou mapa oficial
echo.
echo Nenhuma foto antiga com texto embutido sera reutilizada.
echo Nenhuma fachada, mapa ou retrato real sera inventado pela IA.
echo.

echo.
echo [1/5] Instalando e iniciando automaticamente o motor local de IA...
powershell -NoProfile -ExecutionPolicy Bypass -File "site-core\tools\install-comfyui-photo-engine.ps1"
if errorlevel 1 (
  echo ERRO: nao foi possivel preparar ComfyUI/SDXL. Confira internet, espaco livre e hardware.
  pause
  exit /b 2
)

set "PYTHON_EXE=site-core\toolchain\ComfyUI_windows_portable\python_embeded\python.exe"
if not exist "%PYTHON_EXE%" (
  where python >nul 2>nul
  if errorlevel 1 (
    echo ERRO: Python nao encontrado no ambiente do ComfyUI nem no PATH.
    pause
    exit /b 2
  )
  set "PYTHON_EXE=python"
)

"%PYTHON_EXE%" -c "import PIL" >nul 2>nul
if errorlevel 1 (
  "%PYTHON_EXE%" -m ensurepip --upgrade
  "%PYTHON_EXE%" -m pip install --disable-pip-version-check Pillow
  if errorlevel 1 (
    echo ERRO: nao foi possivel instalar Pillow no Python selecionado.
    pause
    exit /b 2
  )
)

set "GA_COMFYUI_BASE_URL=http://127.0.0.1:8188"
set "GA_COMFYUI_CHECKPOINT=RealVisXL_V4.0.safetensors"

echo.
echo [2/5] Procurando fontes reais e baixando a vista licenciada de Anapolis...
"%PYTHON_EXE%" site-core/tools/fetch-real-source-assets.py
if errorlevel 1 (
  echo AVISO: algum ativo que exige uma fonte real nao foi encontrado.
  echo Nenhuma fachada ou pessoa real sera inventada. O mapa/rota e mantido como alternativa.
)

echo.
echo [3/5] Gerando automaticamente os 106 mestres elegiveis do Livro Visual Mestre.
echo O trabalho usa o checkpoint SDXL local e pode levar bastante tempo conforme o hardware.
"%PYTHON_EXE%" site-core/tools/generate-photo-masters.py
if errorlevel 1 (
  echo.
  echo ERRO: a geracao por IA falhou. Nenhum ZIP final sera considerado valido.
  echo O relatorio de erro esta em site-core\photo-generation-report.json.
  pause
  exit /b 3
)

echo.
echo [4/5] Conferindo os 111 itens canonicos, dimensoes e fontes oficiais...
"%PYTHON_EXE%" site-core/tools/check-photo-assets.py
if errorlevel 1 (
  echo.
  echo ZIP NAO CRIADO: o relatorio acima mostra quais arquivos reais ainda faltam.
  echo Nao substituiremos itens faltantes por fotos genericas, recortes de pranchas
  echo ou banners antigos. O site ativo nao foi alterado.
  pause
  exit /b 4
)

echo.
echo [5/5] Montando o ZIP completo do tema...
powershell -NoProfile -ExecutionPolicy Bypass -File "site-core\BUILD-THEME.ps1"
if errorlevel 1 (
  echo ERRO: falha na montagem do ZIP.
  pause
  exit /b 5
)

echo.
echo SUCESSO: pacote completo pronto em site-core\garibalde-institucional-2.0.0.zip
echo O ZIP ainda deve ser instalado em homologacao e testado; este processo nao altera a Locaweb.
pause
endlocal
