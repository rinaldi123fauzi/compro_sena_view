@echo off
echo Clearing Laravel caches and restarting development servers...

cd /d "c:\laragon\www\SENANEW\PT Sena_Upload"

echo.
echo [1/6] Clearing Laravel caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo.
echo [2/6] Clearing Laravel logs...
if exist "storage\logs\laravel.log" (
    echo. > storage\logs\laravel.log
    echo Laravel log cleared
)

echo.
echo [3/6] Building Vite assets...
npm run build

echo.
echo [4/6] Starting Reverb server...
start "Reverb Server" cmd /k "php artisan reverb:start --host=localhost --port=8080"

timeout /t 3 /nobreak > nul

echo.
echo [5/6] Starting Laravel development server...
start "Laravel Server" cmd /k "php artisan serve --host=localhost --port=8000"

timeout /t 2 /nobreak > nul

echo.
echo [6/6] Starting Vite development server...
start "Vite Server" cmd /k "npm run dev"

echo.
echo ================================================================
echo All servers started successfully!
echo.
echo Laravel App: http://localhost:8000
echo Reverb WebSocket: ws://localhost:8080
echo Vite Dev Server: http://localhost:5173
echo.
echo Debug Tools:
echo - Real-time Debug: http://localhost:8000/debug-realtime.html
echo - Chat Test: http://localhost:8000/test-chat.html
echo ================================================================
echo.
pause
