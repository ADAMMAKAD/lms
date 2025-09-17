<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseChapter extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'order',
        'status',
        'is_free'
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'order' => 'integer'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(CourseChapterItem::class, 'chapter_id', 'id');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(CourseChapterLesson::class, 'chapter_id', 'id');
    }

    public function chapterItems(): HasMany
    {
        return $this->hasMany(CourseChapterItem::class, 'chapter_id', 'id');
    }
}