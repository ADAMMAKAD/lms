<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseProgress extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the user that owns the course progress.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the course that owns the course progress.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the lesson that owns the course progress.
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(CourseChapterLesson::class, 'lesson_id');
    }
}
