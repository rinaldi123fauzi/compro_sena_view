<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'visitor_name',
        'visitor_email',
        'visitor_ip',
        'status',
        'admin_id',
        'is_ai_handled',
        'transferred_to_admin_at',
        'last_activity_at',
    ];

    protected $casts = [
        'is_ai_handled' => 'boolean',
        'transferred_to_admin_at' => 'datetime',
        'last_activity_at' => 'datetime',
    ];

    /**
     * Get the admin handling this session
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Get all messages in this session
     */
    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at');
    }

    /**
     * Get the latest message in this session
     */
    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }

    /**
     * Check if session needs admin attention
     */
    public function needsAdminAttention(): bool
    {
        return $this->status === 'waiting_for_admin';
    }

    /**
     * Transfer session to admin
     */
    public function transferToAdmin(User $admin = null)
    {
        $this->update([
            'status' => $admin ? 'with_admin' : 'waiting_for_admin',
            'admin_id' => $admin?->id,
            'is_ai_handled' => false,
            'transferred_to_admin_at' => now(),
        ]);
    }
}
