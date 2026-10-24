@echo off
setlocal enabledelayedexpansion
title NextHire AI - Laravel Server

chcp 65001 >nul
cd /d "%~dp0"

REM Semak jika PHP ada dalam PATH atau XAMPP
where php >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    if exist "C:\xampp\php\php.exe" (
        set "PATH=C:\xampp\php;!PATH!"
    ) else if exist "C:\tools\php\php.exe" (
        set "PATH=C:\tools\php;!PATH!"
    ) else (
        echo [RALAT] PHP tidak dijumpai dalam PATH sistem anda!
        pause
        exit /b 1
    )
)

REM Semak fail .env
if not exist ".env" (
    echo [INFO] Menyalin .env.example kepada .env...
    copy ".env.example" ".env" >nul
    call php artisan key:generate --force
)

REM Semak fail database SQLite
if not exist "database\database.sqlite" (
    echo [INFO] Menjana fail database SQLite...
    type nul > "database\database.sqlite"
    call php artisan migrate --force --seed
)

cls
echo ================================================================
echo       NEXTHIRE AI - PHP LARAVEL SERVER
echo ================================================================
echo   Laman Web : http://127.0.0.1:8000
echo   Pangkalan : SQLite (database/database.sqlite)
echo.
echo   Membuka pelayar web secara automatik...
echo   (Tekan Ctrl+C untuk hentikan pelayan)
echo ================================================================
echo.

start "" http://127.0.0.1:8000
php artisan serve --host=127.0.0.1 --port=8000