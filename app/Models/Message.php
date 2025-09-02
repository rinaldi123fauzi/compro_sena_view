<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_session_id',
        'content',
        'sender_type',
        'sender_id',
        'is_read',
        'metadata',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'metadata' => 'array',
    ];

    /**
     * Get the chat session this message belongs to
     */
    public function chatSession()
    {
        return $this->belongsTo(ChatSession::class);
    }

    /**
     * Get the sender (admin user) if applicable
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Check if message is from visitor
     */
    public function isFromVisitor(): bool
    {
        return $this->sender_type === 'visitor';
    }

    /**
     * Check if message is from AI
     */
    public function isFromAI(): bool
    {
        return $this->sender_type === 'ai';
    }

    /**
     * Check if message is from admin
     */
    public function isFromAdmin(): bool
    {
        return $this->sender_type === 'admin';
    }
}
