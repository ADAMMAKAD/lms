<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseChapterItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'chapter_id',
        'title',
        'description',
        'type',
        'content',
        'order',
        'status',
        'duration'
    ];

    protected $casts = [
        'order' => 'integer',
        'duration' => 'integer'
    ];

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(CourseChapter::class, 'chapter_id', 'id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function lesson(): HasOne
    {
        return $this->hasOne(CourseChapterLesson::class, 'chapter_item_id', 'id');
    }

    public function quiz(): HasOne
    {
        return $this->hasOne(Quiz::class, 'chapter_item_id', 'id');
    }
}