<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'assigned_by',
        'status',
        'assigned_at',
        'completed_at',
        'notes'
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the user that was assigned the course.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course that was assigned.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the admin who assigned the course.
     * This can be either an Admin or User model.
     */
    public function assignedBy()
    {
        // First try to find in Admin model
        $admin = \App\Models\Admin::find($this->assigned_by);
        if ($admin) {
            return $admin;
        }
        
        // Fallback to User model
        return \App\Models\User::find($this->assigned_by);
    }
    
    /**
     * Get the name of who assigned the course.
     */
    public function getAssignedByNameAttribute(): string
    {
        $assignedBy = $this->assignedBy();
        return $assignedBy ? $assignedBy->name : 'Unknown';
    }

    /**
     * Check if the assignment is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Mark the assignment as completed.
     */
    public function markAsCompleted(): void
    {
        $this->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);
    }

    /**
     * Mark the assignment as in progress.
     */
    public function markAsInProgress(): void
    {
        $this->update(['status' => 'in_progress']);
    }
}
