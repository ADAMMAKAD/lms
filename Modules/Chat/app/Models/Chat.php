<?php

namespace Modules\Chat\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Admin;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'subject',
        'status',
        'priority',
        'user_name',
        'user_email',
        'last_message_at',
        'is_resolved'
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
        'is_resolved' => 'boolean'
    ];

    /**
     * Chat statuses
     */
    const STATUS_OPEN = 'open';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_RESOLVED = 'resolved';
    const STATUS_CLOSED = 'closed';

    /**
     * Chat priorities
     */
    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';
    const PRIORITY_URGENT = 'urgent';

    /**
     * Get the user that owns the chat (nullable for guest users)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin assigned to the chat
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get all messages for this chat
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class)->orderBy('created_at', 'asc');
    }

    /**
     * Get the latest message for this chat
     */
    public function latestMessage(): HasMany
    {
        return $this->hasMany(ChatMessage::class)->latest();
    }

    /**
     * Get unread messages count for admin
     */
    public function unreadMessagesForAdmin(): HasMany
    {
        return $this->hasMany(ChatMessage::class)
            ->where('sender_type', 'user')
            ->where('is_read', false);
    }

    /**
     * Get unread messages count for user
     */
    public function unreadMessagesForUser(): HasMany
    {
        return $this->hasMany(ChatMessage::class)
            ->where('sender_type', 'admin')
            ->where('is_read', false);
    }

    /**
     * Scope for open chats
     */
    public function scopeOpen($query)
    {
        return $query->where('status', self::STATUS_OPEN);
    }

    /**
     * Scope for resolved chats
     */
    public function scopeResolved($query)
    {
        return $query->where('status', self::STATUS_RESOLVED);
    }

    /**
     * Scope for chats assigned to specific admin
     */
    public function scopeAssignedTo($query, $adminId)
    {
        return $query->where('admin_id', $adminId);
    }

    /**
     * Mark chat as resolved
     */
    public function markAsResolved()
    {
        $this->update([
            'status' => self::STATUS_RESOLVED,
            'is_resolved' => true
        ]);
    }

    /**
     * Reopen chat
     */
    public function reopen()
    {
        $this->update([
            'status' => self::STATUS_OPEN,
            'is_resolved' => false
        ]);
    }

    /**
     * Get status badge color
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            self::STATUS_OPEN => 'success',
            self::STATUS_IN_PROGRESS => 'warning',
            self::STATUS_RESOLVED => 'info',
            self::STATUS_CLOSED => 'secondary',
            default => 'primary'
        };
    }

    /**
     * Get priority badge color
     */
    public function getPriorityBadgeAttribute()
    {
        return match($this->priority) {
            self::PRIORITY_LOW => 'success',
            self::PRIORITY_MEDIUM => 'warning',
            self::PRIORITY_HIGH => 'danger',
            self::PRIORITY_URGENT => 'dark',
            default => 'primary'
        };
    }
}