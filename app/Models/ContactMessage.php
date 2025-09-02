<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'email',
    'phone',
    'company',
    'subject',
    'message',
    'ip_address',
    'user_agent',
    'status',
    'replied_at',
    'replied_by'
  ];

  protected $casts = [
    'replied_at' => 'datetime',
    'created_at' => 'datetime',
    'updated_at' => 'datetime'
  ];

  /**
   * Get the user who replied to this message
   */
  public function repliedBy()
  {
    return $this->belongsTo(User::class, 'replied_by');
  }

  /**
   * Scope for unread messages
   */
  public function scopeUnread($query)
  {
    return $query->where('status', 'unread');
  }

  /**
   * Scope for read messages
   */
  public function scopeRead($query)
  {
    return $query->where('status', 'read');
  }

  /**
   * Scope for replied messages
   */
  public function scopeReplied($query)
  {
    return $query->where('status', 'replied');
  }

  /**
   * Mark message as read
   */
  public function markAsRead()
  {
    $this->update(['status' => 'read']);
  }

  /**
   * Mark message as replied
   */
  public function markAsReplied($userId = null)
  {
    $this->update([
      'status' => 'replied',
      'replied_at' => now(),
      'replied_by' => $userId
    ]);
  }
}
