<?php

use App\Models\ChatSession;
use App\Models\Message;
use App\Events\MessageSent;

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

$message = Message::create([
  'chat_session_id' => $session->id,
  'content' => 'TEST: Real-time message from visitor',
  'sender_type' => 'visitor',
  'sender_id' => null,
]);

$message->load('sender');

echo 'Chat Session ID: ' . $session->id . PHP_EOL;
echo 'Message ID: ' . $message->id . PHP_EOL;
echo 'Broadcasting to channel: chat-session.' . $session->id . PHP_EOL;

// Broadcast the message
broadcast(new MessageSent($message))->toOthers();

echo 'Message broadcasted successfully!' . PHP_EOL;
echo 'Test completed - Check WebSocket clients for real-time message!' . PHP_EOL;
