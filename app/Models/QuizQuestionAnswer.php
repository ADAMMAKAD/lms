<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizQuestionAnswer extends Model
{
    use HasFactory;

    protected $table = 'quiz_question_answers';

    protected $fillable = [
        'title',
        'question_id',
        'correct',
    ];

    protected $casts = [
        'question_id' => 'integer',
        'correct' => 'integer',
    ];

    /**
     * Get the question that owns the answer.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class, 'question_id');
    }
}