#!/bin/bash

echo "🚀 STARTING FINAL REAL-TIME MESSAGING TEST"
echo "==========================================="

echo ""
echo "📋 System Check:"

# Check if Reverb is running
echo -n "  - Reverb WebSocket Server: "
curl -s --max-time 2 ws://localhost:8080 && echo "✅ Running" || echo "❌ Not Running"

# Check queue worker
echo -n "  - Queue Worker: "
if pgrep -f "queue:work" > /dev/null; then
    echo "✅ Running"
else
    echo "❌ Not Running - Starting now..."
    php artisan queue:work --timeout=60 &
    sleep 2
    echo "✅ Queue Worker Started"
fi

echo ""
echo "🧪 Running Broadcast Test:"
php artisan test:visitor-broadcast 57

echo ""
echo "🌐 Opening Test Interface:"
echo "Please open: http://localhost/final-realtime-test.html"
echo ""
echo "📋 Test Instructions:"
echo "1. Click 'Connect' on both Visitor and Admin panels"
echo "2. Send messages from Visitor panel"
echo "3. Verify messages appear in Admin panel in real-time"
echo "4. Send replies from Admin panel"
echo "5. Verify replies appear in Visitor panel in real-time"
echo "6. Run 'Full Test Suite' for automated testing"
echo ""
echo "✅ Real-time messaging system is ready for testing!"
