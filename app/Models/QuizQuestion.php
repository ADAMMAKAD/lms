<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'title',
        'type',
        'grade',
    ];

    protected $casts = [
        'quiz_id' => 'integer',
        'grade' => 'integer',
    ];

    /**
     * Get the quiz that owns the question.
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Get the question answers.
     */
    public function answers(): HasMany
    {
        return $this->hasMany(QuizQuestionAnswer::class, 'question_id');
    }
}