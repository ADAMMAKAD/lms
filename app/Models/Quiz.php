<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'chapter_item_id',
        'instructor_id',
        'chapter_id',
        'course_id',
        'title',
        'time',
        'attempt',
        'pass_mark',
        'total_mark',
        'status',
    ];

    protected $casts = [
        'instructor_id' => 'integer',
        'chapter_id' => 'integer',
        'course_id' => 'integer',
        'chapter_item_id' => 'integer',
    ];

    /**
     * Get the course that owns the quiz.
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the user (instructor) that created the quiz.
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    /**
     * Get the quiz questions.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(QuizQuestion::class);
    }

    /**
     * Get the quiz results.
     */
    public function results(): HasMany
    {
        return $this->hasMany(QuizResult::class);
    }
}