<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'result',
        'user_grade',
        'status',
    ];

    protected $casts = [
        'result' => 'array',
        'user_grade' => 'integer',
    ];

    /**
     * Get the user that owns the quiz result.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the quiz that this result belongs to.
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}