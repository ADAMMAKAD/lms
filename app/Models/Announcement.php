<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model {
    use HasFactory;

    protected $fillable = [
        'course_id',
        'instructor_id',
        'title',
        'announcement',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class, 'course_id', 'id')->withDefault();
    }

    public function instructor(): BelongsTo {
        return $this->belongsTo(User::class, 'instructor_id', 'id')->withDefault();
    }
}