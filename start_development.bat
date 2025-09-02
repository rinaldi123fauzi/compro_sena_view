@echo off
echo Starting PT Sena Application...
echo.

echo Starting Laravel development server...
start cmd /k "cd /d C:\laragon\www\PT Sena_Upload && php artisan serve"

echo Waiting for Laravel server to start...
timeout /t 3 /nobreak > nul

echo Starting Vite development server...
start cmd /k "cd /d C:\laragon\www\PT Sena_Upload && npm run dev"

echo.
echo Application is starting...
echo Laravel: http://localhost:8000
echo Vite: http://localhost:5173
echo.
echo Press any key to exit...
pause > nul
