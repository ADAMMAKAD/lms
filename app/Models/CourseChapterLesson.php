<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseChapterLesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'chapter_id',
        'chapter_item_id',
        'title',
        'description',
        'content',
        'video_url',
        'duration',
        'order',
        'status',
        'is_free'
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'order' => 'integer',
        'duration' => 'integer'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(CourseChapter::class, 'chapter_id', 'id');
    }

    public function chapterItem(): BelongsTo
    {
        return $this->belongsTo(CourseChapterItem::class, 'chapter_item_id', 'id');
    }
}