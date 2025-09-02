<?php

use App\Models\ChatSession;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;

// Find chat session 36
$chatSession = ChatSession::find(36);

if (!$chatSession) {
  echo "Chat session not found!\n";
  exit;
}

echo "Chat Status: " . $chatSession->status . "\n";

// Get admin user
$admin = User::where('email', 'admin@sena.com')->first();

if (!$admin) {
  echo "Admin user not found!\n";
  exit;
}

echo "Admin found: " . $admin->name . "\n";

// Transfer chat to admin if needed
if ($chatSession->status === 'waiting_for_admin') {
  $chatSession->admin_id = $admin->id;
  $chatSession->status = 'with_admin';
  $chatSession->save();

  echo "Chat transferred to admin!\n";

  // Send admin greeting message
  $adminMessage = Message::create([
    'chat_session_id' => $chatSession->id,
    'content' => 'Halo! Saya ' . $admin->name . ' dari tim customer service PT SENA. Ada yang bisa saya bantu?',
    'sender_type' => 'admin',
    'sender_id' => $admin->id,
  ]);

  echo "Admin greeting message created: " . $adminMessage->id . "\n";

  // Broadcast the message
  broadcast(new MessageSent($adminMessage));

  echo "Message broadcasted via WebSocket!\n";
  echo "Channel: chat-session." . $chatSession->id . "\n";
  echo "Event: message.sent\n";
} else {
  echo "Chat is not waiting for admin. Current status: " . $chatSession->status . "\n";
}

echo "Test completed!\n";
