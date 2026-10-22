@echo off
setlocal
cd /d "%~dp0"
echo.
echo GARIBALDE — GERADOR DE FOTOGRAFIAS-MESTRAS
echo.
where python >nul 2>nul
if errorlevel 1 (
  echo ERRO: Python 3 nao encontrado.
  echo Instale Python 3.10+ e tente novamente.
  pause
  exit /b 2
)
python -m pip install --disable-pip-version-check Pillow
if errorlevel 1 (
  echo ERRO: nao foi possivel instalar a dependencia Pillow.
  pause
  exit /b 2
)
python tools\test-photo-manifest.py
if errorlevel 1 (
  echo ERRO: o manifesto de 111 imagens nao passou na validacao.
  pause
  exit /b 1
)
echo.
echo O ComfyUI deve estar iniciado e ter um checkpoint SDXL compativel instalado.
echo O gerador detectara automaticamente o checkpoint SDXL quando possivel.
echo 106 ativos serao gerados sem dados sensiveis; EQ-01 usa retrato real incluido.
echo Fotos reais ausentes de localizacao nunca serao inventadas.
echo.
python tools\generate-photo-masters.py %*
set GENERATION_EXIT=%ERRORLEVEL%
echo.
if not "%GENERATION_EXIT%"=="0" (
  echo A geracao nao foi concluida. Veja site-core\photo-generation-report.json.
  echo Nao houve instalacao no WordPress/Locaweb.
  pause
  exit /b %GENERATION_EXIT%
)
echo Geracao concluida. ZIP candidato criado somente se todos os arquivos geraveis existirem.
echo A aprovacao visual/editorial continua obrigatoria antes da producao.
pause
exit /b 0
