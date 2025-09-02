<?php

namespace App\Events;

use App\Models\ChatSession;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatTransferredToAdmin implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chatSession;

    /**
     * Create a new event instance.
     */
    public function __construct(ChatSession $chatSession)
    {
        $this->chatSession = $chatSession;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('admin-dashboard'),
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'chat.transferred';
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith(): array
    {
        return [
            'session' => [
                'id' => $this->chatSession->id,
                'session_id' => $this->chatSession->session_id,
                'visitor_name' => $this->chatSession->visitor_name,
                'status' => $this->chatSession->status,
                'transferred_at' => $this->chatSession->transferred_to_admin_at,
                'latest_message' => $this->chatSession->latestMessage?->content,
            ],
        ];
    }
}
