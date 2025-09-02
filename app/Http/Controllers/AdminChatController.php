<?php

namespace App\Http\Controllers;

use App\Models\ChatSession;
use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminChatController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        /** @var User|null $admin */
        $admin = Auth::user();
        if (!$admin) {
            return redirect()->route('admin.login');
        }

        $waitingChats = ChatSession::where('status', 'waiting_for_admin')
            ->with(['latestMessage'])
            ->orderBy('transferred_to_admin_at', 'desc')
            ->get();

        $activeChats = ChatSession::where('status', 'with_admin')
            ->where('admin_id', $admin->id)
            ->with(['latestMessage'])
            ->orderBy('last_activity_at', 'desc')
            ->get();

        return Inertia::render('Admin/ChatDashboard', [
            'waitingChats' => $waitingChats,
            'activeChats' => $activeChats,
        ]);
    }

    /**
     * Get all chats for AJAX updates
     */
    public function getAllChats()
    {
        /** @var User|null $admin */
        $admin = Auth::user();
        if (!$admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $waitingChats = ChatSession::where('status', 'waiting_for_admin')
            ->with(['latestMessage'])
            ->orderBy('transferred_to_admin_at', 'desc')
            ->get();

        $activeChats = ChatSession::where('status', 'with_admin')
            ->where('admin_id', $admin->id)
            ->with(['latestMessage'])
            ->orderBy('last_activity_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'waitingChats' => $waitingChats,
            'activeChats' => $activeChats,
        ]);
    }

    /**
     * Take over a chat session
     */
    public function takeChat(Request $request, ChatSession $chatSession)
    {
        if ($chatSession->status !== 'waiting_for_admin') {
            return response()->json(['error' => 'Chat is not available for takeover'], 400);
        }

        /** @var User|null $admin */
        $admin = Auth::user();
        if (!$admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $chatSession->transferToAdmin($admin);

        // Send notification to visitor
        $adminMessage = Message::create([
            'chat_session_id' => $chatSession->id,
            'content' => 'Halo! Saya ' . $admin->name . ' dari tim customer service PT SENA. Ada yang bisa saya bantu?',
            'sender_type' => 'admin',
            'sender_id' => $admin->id,
        ]);

        broadcast(new MessageSent($adminMessage));

        return response()->json([
            'success' => true,
            'message' => 'Chat taken successfully',
            'session' => $chatSession->load('messages.sender'),
        ]);
    }

    /**
     * Send admin message
     */
    public function sendMessage(Request $request, ChatSession $chatSession)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        /** @var User|null $admin */
        $admin = Auth::user();
        if (!$admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($chatSession->admin_id !== $admin->id) {
            return response()->json(['error' => 'Unauthorized to send message in this chat'], 403);
        }

        $message = Message::create([
            'chat_session_id' => $chatSession->id,
            'content' => $request->message,
            'sender_type' => 'admin',
            'sender_id' => $admin->id,
        ]);

        $chatSession->update(['last_activity_at' => now()]);

        broadcast(new MessageSent($message->load('sender')));

        return response()->json([
            'success' => true,
            'message' => $message->load('sender'),
        ]);
    }

    /**
     * Get chat session details
     */
    public function getChatSession(ChatSession $chatSession)
    {
        /** @var User|null $admin */
        $admin = Auth::user();
        if (!$admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($chatSession->admin_id !== $admin->id && $chatSession->status === 'with_admin') {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        return response()->json([
            'success' => true,
            'session' => $chatSession->load(['messages.sender', 'admin']),
        ]);
    }

    /**
     * Close chat session
     */
    public function closeChat(ChatSession $chatSession)
    {
        /** @var User|null $admin */
        $admin = Auth::user();
        if (!$admin) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($chatSession->admin_id !== $admin->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $chatSession->update(['status' => 'closed']);

        // Send closing message
        $closingMessage = Message::create([
            'chat_session_id' => $chatSession->id,
            'content' => 'Terima kasih telah menghubungi PT SENA. Chat session telah ditutup. Jika ada pertanyaan lain, silakan memulai chat baru.',
            'sender_type' => 'admin',
            'sender_id' => $admin->id,
        ]);

        broadcast(new MessageSent($closingMessage->load('sender')));

        return response()->json([
            'success' => true,
            'message' => 'Chat closed successfully',
        ]);
    }

    /**
     * Mark messages as read
     */
    public function markAsRead(ChatSession $chatSession)
    {
        $chatSession->messages()
            ->where('sender_type', 'visitor')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
