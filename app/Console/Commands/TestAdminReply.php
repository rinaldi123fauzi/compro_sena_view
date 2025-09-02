<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ChatSession;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;

class TestAdminReply extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:admin-reply {chat_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test admin reply for real-time ChatDetail';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $chatId = $this->argument('chat_id');

        $this->info("Testing admin reply for chat ID: {$chatId}");

        // Find chat session
        $chatSession = ChatSession::find($chatId);

        if (!$chatSession) {
            $this->error("Chat session not found!");
            return 1;
        }

        $this->info("Chat Status: " . $chatSession->status);

        // Get admin user
        $admin = User::where('email', 'admin@sena.com')->first();

        if (!$admin) {
            $this->error("Admin user not found!");
            return 1;
        }

        $this->info("Admin found: " . $admin->name);

        // Transfer chat to admin if needed
        if ($chatSession->status === 'waiting_for_admin') {
            $chatSession->admin_id = $admin->id;
            $chatSession->status = 'with_admin';
            $chatSession->save();

            $this->info("✅ Chat transferred to admin!");
        }

        // Send admin reply message
        $adminMessage = Message::create([
            'chat_session_id' => $chatSession->id,
            'content' => 'Halo! Saya ' . $admin->name . ' dari tim customer service PT SENA. Ada yang bisa saya bantu? (Real-time test message)',
            'sender_type' => 'admin',
            'sender_id' => $admin->id,
        ]);

        $this->info("✅ Admin message created: " . $adminMessage->id);

        // Broadcast the message
        broadcast(new MessageSent($adminMessage));

        $this->info("✅ Message broadcasted via WebSocket!");
        $this->info("📡 Channel: chat-session." . $chatSession->id);
        $this->info("🎯 Event: message.sent");
        $this->info("💬 Message: " . $adminMessage->content);

        $this->info("🎉 Test completed! Check ChatDetail for real-time update.");

        return 0;
    }
}
