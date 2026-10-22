@echo off
setlocal
cd /d "%~dp0"
where powershell >nul 2>nul
if errorlevel 1 (
  echo PowerShell nao foi encontrado.
  exit /b 1
)
powershell -NoProfile -ExecutionPolicy Bypass -File "%~dp0BUILD-THEME.ps1"
if errorlevel 1 exit /b 1
echo.
echo ZIP criado. Envie somente para homologacao; nao ative em producao sem os testes.
endlocal
