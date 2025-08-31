<?php

namespace Modules\Chat\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Admin;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'sender_id',
        'sender_type',
        'message',
        'attachment_path',
        'attachment_name',
        'attachment_type',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime'
    ];

    /**
     * Sender types
     */
    const SENDER_TYPE_USER = 'user';
    const SENDER_TYPE_ADMIN = 'admin';
    const SENDER_TYPE_GUEST = 'guest';

    /**
     * Get the chat that owns the message
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    /**
     * Get the user sender (polymorphic)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the admin sender (polymorphic)
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'sender_id');
    }

    /**
     * Get the sender (polymorphic relationship)
     */
    public function sender()
    {
        if ($this->sender_type === self::SENDER_TYPE_USER) {
            return $this->user();
        } elseif ($this->sender_type === self::SENDER_TYPE_ADMIN) {
            return $this->admin();
        }
        return null;
    }

    /**
     * Get sender name
     */
    public function getSenderNameAttribute()
    {
        if ($this->sender_type === self::SENDER_TYPE_USER && $this->user) {
            return $this->user->name;
        } elseif ($this->sender_type === self::SENDER_TYPE_ADMIN && $this->admin) {
            return $this->admin->name;
        } elseif ($this->sender_type === self::SENDER_TYPE_GUEST) {
            return $this->chat->user_name ?? 'Guest';
        }
        return 'Unknown';
    }

    /**
     * Get sender avatar
     */
    public function getSenderAvatarAttribute()
    {
        if ($this->sender_type === self::SENDER_TYPE_USER && $this->user) {
            return $this->user->image ?? asset('frontend/img/default-avatar.png');
        } elseif ($this->sender_type === self::SENDER_TYPE_ADMIN && $this->admin) {
            return $this->admin->image ?? asset('backend/img/default-avatar.png');
        }
        return asset('frontend/img/default-avatar.png');
    }

    /**
     * Check if message has attachment
     */
    public function hasAttachment()
    {
        return !empty($this->attachment_path);
    }

    /**
     * Get attachment URL
     */
    public function getAttachmentUrlAttribute()
    {
        if ($this->hasAttachment()) {
            return asset('uploads/chat/' . $this->attachment_path);
        }
        return null;
    }

    /**
     * Mark message as read
     */
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    /**
     * Scope for unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for messages by sender type
     */
    public function scopeBySenderType($query, $senderType)
    {
        return $query->where('sender_type', $senderType);
    }

    /**
     * Scope for messages with attachments
     */
    public function scopeWithAttachments($query)
    {
        return $query->whereNotNull('attachment_path');
    }
}