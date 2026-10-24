# NextHire AI - Direct Laravel Runner
[Console]::OutputEncoding = [System.Text.Encoding]::UTF8
$Host.UI.RawUI.WindowTitle = "NextHire AI - Laravel Server"

$scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
Set-Location $scriptDir

# Check PHP
if (-not (Get-Command php -ErrorAction SilentlyContinue)) {
    if (Test-Path "C:\xampp\php\php.exe") {
        $env:Path = "C:\xampp\php;" + $env:Path
    } elseif (Test-Path "C:\tools\php\php.exe") {
        $env:Path = "C:\tools\php;" + $env:Path
    } else {
        Write-Error "PHP tidak dijumpai dalam PATH sistem!"
        Read-Host "Tekan Enter untuk keluar"
        exit 1
    }
}

if (-not (Test-Path ".env")) {
    Copy-Item ".env.example" ".env"
    php artisan key:generate --force
}

if (-not (Test-Path "database\database.sqlite")) {
    New-Item -ItemType File -Path "database\database.sqlite" -Force | Out-Null
    php artisan migrate --force --seed
}

Write-Host "================================================================" -ForegroundColor Cyan
Write-Host "           🚀 NextHire AI - PHP Laravel Server                  " -ForegroundColor Yellow
Write-Host "================================================================" -ForegroundColor Cyan
Write-Host " Laman Web : http://127.0.0.1:8000" -ForegroundColor Green
Write-Host " Pangkalan : SQLite (database/database.sqlite)"
Write-Host " Membuka pelayar web..."
Write-Host " (Tekan Ctrl+C untuk hentikan pelayan)"
Write-Host "================================================================" -ForegroundColor Cyan

Start-Process "http://127.0.0.1:8000"
php artisan serve --host=127.0.0.1 --port=8000
