<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\ChatSession;
use App\Models\Message;
use App\Events\MessageSent;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('test:list-sessions', function () {
    $sessions = \App\Models\ChatSession::latest()->take(10)->get(['id', 'session_id', 'visitor_name', 'status']);

    $this->info('Recent Chat Sessions:');
    $this->info('ID | Session ID | Visitor Name | Status');
    $this->info('---|------------|--------------|-------');

    foreach ($sessions as $session) {
        $this->info(sprintf(
            '%s | %s | %s | %s',
            $session->id,
            $session->session_id,
            $session->visitor_name ?: 'No name',
            $session->status
        ));
    }
})->purpose('List recent chat sessions');

Artisan::command('test:visitor-broadcast {chat_id?}', function () {
    $chatId = $this->argument('chat_id');
    $this->info("Received chat_id parameter: " . ($chatId ?? 'null'));

    // Use provided chat ID or create new session
    if ($chatId) {
        // Find existing session
        $session = \App\Models\ChatSession::find($chatId);
        if (!$session) {
            $this->error("Chat session with ID {$chatId} not found!");
            return;
        }
        $this->info("Using existing chat session ID: {$chatId}");
        $this->info("Session found: {$session->session_id}");
    } else {
        // Create a new session
        $this->info('Creating new test chat session...');
        $session = \App\Models\ChatSession::create([
            'session_id' => 'test-' . uniqid(),
            'visitor_name' => 'Debug Test User',
            'visitor_email' => 'debug@test.com',
            'visitor_ip' => '127.0.0.1',
            'status' => 'active',
            'is_ai_handled' => true,
            'last_activity_at' => now(),
        ]);
    }

    $this->info('Chat Session ID: ' . $session->id);

    $message = \App\Models\Message::create([
        'chat_session_id' => $session->id,
        'content' => 'TEST: Real-time message from visitor at ' . now()->toDateTimeString(),
        'sender_type' => 'visitor',
        'sender_id' => null,
    ]);

    $message->load('sender');

    $this->info('Message ID: ' . $message->id);
    $this->info('Broadcasting to channel: chat-session.' . $session->id);

    // Broadcast the message
    broadcast(new \App\Events\MessageSent($message))->toOthers();

    $this->info('✅ Message broadcasted successfully!');
    $this->info('📡 Check WebSocket clients for real-time message!');
    $this->info('🔍 Admin should see this message in ChatDetail component');
})->purpose('Test visitor message broadcasting to admin');

// Enhanced Web Scraping Auto-Refresh Commands
Artisan::command('sena:auto-refresh', function () {
    $this->info('🔄 Starting automatic PT SENA data refresh...');

    try {
        Artisan::call('sena:refresh-data', ['--schedule' => true]);

        $this->info('✅ Automatic refresh completed successfully');
        $this->info('📊 Next refresh scheduled in 1 hour');
    } catch (Exception $e) {
        $this->error('❌ Auto-refresh failed: ' . $e->getMessage());
    }
})->purpose('Automatically refresh PT SENA website data for AI chatbot');

Artisan::command('sena:deep-refresh', function () {
    $this->info('🕷️ Starting deep crawling refresh...');

    try {
        Artisan::call('sena:refresh-data', [
            '--clear-cache' => true,
            '--deep-crawl' => true,
            '--schedule' => true
        ]);

        $this->info('✅ Deep refresh completed successfully');
    } catch (Exception $e) {
        $this->error('❌ Deep refresh failed: ' . $e->getMessage());
    }
})->purpose('Perform deep crawling refresh of PT SENA website data');

Artisan::command('sena:monitor-health', function () {
    $this->info('🏥 Checking PT SENA scraping system health...');

    try {
        $service = app(\App\Services\WebScraperService::class);
        $data = $service->getAllData();

        $health = [
            'company_info' => !empty($data['company']['name']),
            'news_available' => count($data['news'] ?? []) > 0,
            'capabilities_loaded' => count($data['capabilities'] ?? []) >= 3,
            'contact_info' => !empty($data['contact']['phone']),
            'experiences_loaded' => count($data['experiences'] ?? []) > 0,
            'last_update' => $data['last_updated'] ?? 'Unknown'
        ];

        $this->info('📊 HEALTH CHECK RESULTS:');
        $this->info('========================');

        foreach ($health as $component => $status) {
            if ($component === 'last_update') {
                $this->info("🕐 Last Update: {$status}");
            } else {
                $icon = $status ? '✅' : '❌';
                $this->info("{$icon} " . ucfirst(str_replace('_', ' ', $component)) . ": " . ($status ? 'OK' : 'FAILED'));
            }
        }

        $healthScore = round((array_sum(array_slice($health, 0, -1)) / 5) * 100, 2);
        $this->info("\n🎯 Overall Health Score: {$healthScore}%");

        if ($healthScore < 80) {
            $this->warn('⚠️  Health score below 80% - consider running refresh');
        }
    } catch (Exception $e) {
        $this->error('❌ Health check failed: ' . $e->getMessage());
    }
})->purpose('Monitor PT SENA scraping system health');

Artisan::command('sena:analytics', function () {
    $this->info('📈 Generating PT SENA scraping analytics...');

    try {
        $service = app(\App\Services\WebScraperService::class);
        $data = $service->getAllData();

        $this->info('🔍 ANALYTICS SUMMARY:');
        $this->info('====================');

        $this->info("📊 Data Points:");
        $this->info("   • Company Info: " . (!empty($data['company']['name']) ? 'Available' : 'Missing'));
        $this->info("   • Services: " . count($data['capabilities'] ?? []) . " capabilities found");
        $this->info("   • News Articles: " . count($data['news'] ?? []) . " articles");
        $this->info("   • Project Experiences: " . count($data['experiences'] ?? []) . " projects");
        $this->info("   • Contact Details: " . (!empty($data['contact']['phone']) ? 'Complete' : 'Incomplete'));

        if (!empty($data['deep_content'])) {
            $this->info("   • Deep Content: " . count($data['deep_content']) . " pages analyzed");
        }

        $totalKnowledge = strlen(json_encode($data));
        $this->info("💾 Knowledge Base Size: " . round($totalKnowledge / 1024, 2) . " KB");
        $this->info("🧠 Estimated AI Tokens: ~" . round($totalKnowledge / 4));

        $this->info("🕐 Last Updated: {$data['last_updated']}");
    } catch (Exception $e) {
        $this->error('❌ Analytics generation failed: ' . $e->getMessage());
    }
})->purpose('Generate analytics for PT SENA scraping data');
