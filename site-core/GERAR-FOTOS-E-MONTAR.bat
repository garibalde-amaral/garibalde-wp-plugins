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

where python >nul 2>nul
if errorlevel 1 (
  echo ERRO: Python 3 nao foi encontrado. Instale Python 3.10+ e marque "Add Python to PATH".
  pause
  exit /b 2
)

python -c "import PIL" >nul 2>nul
if errorlevel 1 (
  echo Instalando a dependencia Pillow para validar e otimizar as imagens...
  python -m pip install --disable-pip-version-check Pillow
  if errorlevel 1 (
    echo ERRO: nao foi possivel instalar Pillow.
    pause
    exit /b 2
  )
)

echo.
echo [1/4] Procurando fontes reais e baixando a vista licenciada de Anapolis...
python site-core/tools/fetch-real-source-assets.py
if errorlevel 1 (
  echo AVISO: nem todas as fotografias que exigem fonte real foram localizadas.
  echo A geracao de fotos editoriais vai continuar, mas o ZIP final sera bloqueado
  echo se retrato/fachada/acesso reais continuarem ausentes.
)

echo.
echo [2/4] Gerando automaticamente os 106 mestres elegiveis do Livro Visual Mestre.
echo IMPORTANTE: o ComfyUI deve estar aberto e com checkpoint SDXL fotorealistico instalado.
python site-core/tools/generate-photo-masters.py
if errorlevel 1 (
  echo.
  echo ERRO: a geracao por IA falhou. Nenhum ZIP instalavel sera criado.
  echo Abra o ComfyUI, confirme que o checkpoint SDXL aparece em Settings/Models
  echo e execute este arquivo novamente.
  pause
  exit /b 3
)

echo.
echo [3/4] Conferindo os 111 arquivos canonicos, dimensoes e fontes oficiais...
python site-core/tools/check-photo-assets.py
if errorlevel 1 (
  echo.
  echo ZIP NAO CRIADO: o relatorio acima mostra quais arquivos reais ainda faltam.
  echo Nao substituiremos itens faltantes por fotos genericas, recortes de pranchas
  echo ou banners antigos. O site ativo nao foi alterado.
  pause
  exit /b 4
)

echo.
echo [4/4] Montando o ZIP completo do tema...
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
