@echo off
setlocal
cd /d "%~dp0"
echo O fluxo unico atual gera as fotos, busca fontes reais, valida o manifesto
echo e monta o ZIP completo em uma unica execucao.
call "%~dp0GERAR-FOTOS-E-MONTAR.bat"
exit /b %ERRORLEVEL%
