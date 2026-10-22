@echo off
setlocal
echo Garibalde Core Institucional - validacao local
echo.
echo Este arquivo NAO instala no servidor e NAO altera WordPress/Locaweb.
echo O tema precisa ser compactado de site-core\garibalde-institucional para ZIP.
echo.
where php >nul 2>nul
if errorlevel 1 (
  echo PHP nao encontrado no PATH. Instale PHP CLI ou execute php -l nos arquivos em ambiente equivalente.
  exit /b 2
)
for %%F in (site-core\garibalde-institucional\*.php) do (
  echo Verificando %%F
  php -l "%%F"
  if errorlevel 1 exit /b 1
)
echo.
echo Validacao sintatica concluida para os arquivos PHP listados.
echo Isso nao substitui testes WordPress, tema ativo, plugins, links e homologacao em staging.
endlocal
