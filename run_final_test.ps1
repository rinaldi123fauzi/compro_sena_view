Write-Host "🚀 STARTING FINAL REAL-TIME MESSAGING TEST" -ForegroundColor Green
Write-Host "===========================================" -ForegroundColor Green

Write-Host ""
Write-Host "📋 System Check:" -ForegroundColor Cyan

# Check if Reverb is running (simplified check)
Write-Host "  - Reverb WebSocket Server: " -NoNewline
try {
    $response = Invoke-WebRequest -Uri "http://localhost:8080" -TimeoutSec 2 -ErrorAction SilentlyContinue
    Write-Host "✅ Running" -ForegroundColor Green
} catch {
    Write-Host "❌ Not Running (but may be WebSocket only)" -ForegroundColor Yellow
}

# Check Laravel processes
Write-Host "  - Laravel Processes: " -NoNewline
$laravelProcesses = Get-Process | Where-Object { $_.ProcessName -like "*php*" -and $_.CommandLine -like "*artisan*" }
if ($laravelProcesses) {
    Write-Host "✅ Found Laravel processes" -ForegroundColor Green
} else {
    Write-Host "❌ No Laravel processes detected" -ForegroundColor Red
}

Write-Host ""
Write-Host "🧪 Running Broadcast Test:" -ForegroundColor Cyan
& php artisan test:visitor-broadcast 57

Write-Host ""
Write-Host "🌐 Test Interface Available:" -ForegroundColor Green
Write-Host "Please open: http://localhost/final-realtime-test.html" -ForegroundColor Yellow
Write-Host ""
Write-Host "📋 Test Instructions:" -ForegroundColor Cyan
Write-Host "1. Click 'Connect' on both Visitor and Admin panels" -ForegroundColor White
Write-Host "2. Send messages from Visitor panel" -ForegroundColor White
Write-Host "3. Verify messages appear in Admin panel in real-time" -ForegroundColor White
Write-Host "4. Send replies from Admin panel" -ForegroundColor White
Write-Host "5. Verify replies appear in Visitor panel in real-time" -ForegroundColor White
Write-Host "6. Run 'Full Test Suite' for automated testing" -ForegroundColor White
Write-Host ""
Write-Host "✅ Real-time messaging system is ready for testing!" -ForegroundColor Green

Write-Host ""
Write-Host "🎯 Quick Commands:" -ForegroundColor Magenta
Write-Host "  - Start Queue Worker: php artisan queue:work --timeout=60" -ForegroundColor Gray
Write-Host "  - Start Reverb Server: php artisan reverb:start" -ForegroundColor Gray
Write-Host "  - Test Broadcasting: php artisan test:visitor-broadcast 57" -ForegroundColor Gray
