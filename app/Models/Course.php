<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Course\app\Models\CourseCategory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Models\CourseAssignment;
use App\Models\CourseLiveClass;
use App\Models\CourseChapterLesson;

class Course extends Model {
    use HasFactory, SoftDeletes;

    public function scopeActive() {
        return $this->where(['is_approved' => 'approved', 'status' => 'active']);
    }
    public function getFavoriteByClientAttribute() {
        if (auth()->guard('web')->check()) {
            return $this->relationLoaded('favoriteBy') ? in_array(userAuth()->id, $this->favoriteBy->pluck('id')->toArray()) : false;
        }

        return false;
    }

    public function favoriteBy() {
        return $this->belongsToMany(User::class, 'favorite_course_user')->withTimestamps();
    }



    public function levels(): HasMany {
        return $this->hasMany(CourseSelectedLevel::class, 'course_id', 'id');
    }
    public function languages(): HasMany {
        return $this->hasMany(CourseSelectedLanguage::class, 'course_id', 'id');
    }

    public function filtersOptions(): HasMany {
        return $this->hasMany(CourseSelectedFilterOption::class, 'course_id', 'id');
    }

    public function category(): BelongsTo {
        return $this->belongsTo(CourseCategory::class, 'category_id', 'id')->withDefault();
    }

    public function instructor(): BelongsTo {
        return $this->belongsTo(User::class, 'instructor_id', 'id')->withDefault();
    }



    public function chapters(): HasMany {
        return $this->hasMany(CourseChapter::class, 'course_id', 'id');
    }
    public function chapterItems(): HasManyThrough {
        return $this->hasManyThrough(
            CourseChapterItem::class,
            CourseChapter::class,
            'course_id',
            'chapter_id',
            'id',
            'id'
        );
    }

    public function progresses(): HasMany {
        return $this->hasMany(CourseProgress::class, 'course_id', 'id');
    }

    public function reviews(): HasMany {
        return $this->hasMany(CourseReview::class, 'course_id', 'id');
    }
    public function lessons(): HasMany {
        return $this->hasMany(CourseChapterLesson::class, 'course_id', 'id');
    }


    public function quizzes(): HasMany {
        return $this->hasMany(Quiz::class, 'course_id', 'id');
    }

    /**
     * Get assignments for this course.
     */
    public function assignments(): HasMany {
        return $this->hasMany(CourseAssignment::class, 'course_id', 'id');
    }

    /**
     * Get users assigned to this course.
     */
    public function assignedUsers(): HasMany {
        return $this->hasMany(CourseAssignment::class, 'course_id', 'id');
    }

    /**
     * Check if a user is assigned to this course.
     */
    public function isAssignedToUser($userId): bool
    {
        return $this->assignments()->where('user_id', $userId)->exists();
    }
    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public function partnerInstructors(): HasMany {
        return $this->hasMany(CoursePartnerInstructor::class, 'course_id', 'id');
    }

    public function liveClasses(): HasManyThrough {
        return $this->hasManyThrough(
            CourseLiveClass::class,
            CourseChapterLesson::class,
            'course_id', // Foreign key on lessons table
            'lesson_id', // Foreign key on live_classes table
            'id', // Local key on courses table
            'id' // Local key on lessons table
        );
    }
    /**
     * Boot method to handle model events.
     */
    protected static function boot() {
        parent::boot();

        static::deleting(function ($course) {
            // Delete related chapters
            $course->chapters()->each(function ($chapter) {
                $chapter->delete();
            });



            // Delete related levels
            $course->levels()->each(function ($level) {
                $level->delete();
            });

            // Delete related languages
            $course->languages()->each(function ($language) {
                $language->delete();
            });

            // Delete related filter options
            $course->filtersOptions()->each(function ($filterOption) {
                $filterOption->delete();
            });

            // Delete related reviews
            $course->reviews()->each(function ($review) {
                $review->delete();
            });
        });
    }
}
