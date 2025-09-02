<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ChatSession;
use App\Models\Message;
use App\Events\MessageSent;

class TestVisitorBroadcast extends Command
{
  protected $signature = 'test:visitor-broadcast';
  protected $description = 'Test visitor message broadcasting to admin';

  public function handle()
  {
    $this->info('Creating test chat session...');

    // Create a test visitor message
    $session = ChatSession::create([
      'session_id' => 'test-' . uniqid(),
      'visitor_name' => 'Debug Test User',
      'visitor_email' => 'debug@test.com',
      'visitor_ip' => '127.0.0.1',
      'status' => 'active',
      'is_ai_handled' => true,
      'last_activity_at' => now(),
    ]);

    $this->info('Chat Session ID: ' . $session->id);

    $message = Message::create([
      'chat_session_id' => $session->id,
      'content' => 'TEST: Real-time message from visitor at ' . now()->toDateTimeString(),
      'sender_type' => 'visitor',
      'sender_id' => null,
    ]);

    $message->load('sender');

    $this->info('Message ID: ' . $message->id);
    $this->info('Broadcasting to channel: chat-session.' . $session->id);

    // Broadcast the message
    broadcast(new MessageSent($message))->toOthers();

    $this->info('✅ Message broadcasted successfully!');
    $this->info('📡 Check WebSocket clients for real-time message!');
    $this->info('🔍 Admin should see this message in ChatDetail component');

    return 0;
  }
}
