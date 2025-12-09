@echo off
cls
echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║   CLUB BOLIVAR - SERVIDOR DE DESARROLLO LOCAL            ║
echo ║   PHP 7.4.22 Built-in Server                             ║
echo ╚════════════════════════════════════════════════════════════╝
echo.
echo Iniciando servidor en http://localhost:8000/
echo.
echo Presiona CTRL+C para detener el servidor
echo.
echo ───────────────────────────────────────────────────────────
echo.

cd /d C:\Users\GUILDER\Desktop\PTRABAJO\ClubBolivar

php -S localhost:8000

pause
