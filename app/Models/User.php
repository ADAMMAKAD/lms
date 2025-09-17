<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\UserStatus;
use App\Models\Cart;
use App\Models\Course;
use App\Models\CourseAssignment;
use App\Models\CourseProgress;
use App\Models\JitsiSetting;
use App\Models\SocialiteCredential;
use App\Models\ZoomCredential;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Modules\Location\app\Models\Country;
// use Modules\Order\app\Models\Order; // Order functionality removed

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'role',
        'name',
        'email',
        'password',
        'status',
        'is_banned',
        'verification_token',
        'forget_password_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];
    public function favoriteCourses() {
        return $this->belongsToMany(Course::class, 'favorite_course_user')->withTimestamps();
    }

    public function scopeActive($query) {
        return $query->where('status', UserStatus::ACTIVE);
    }

    public function scopeInactive($query) {
        return $query->where('status', UserStatus::DEACTIVE);
    }

    public function scopeBanned($query) {
        return $query->where('is_banned', UserStatus::BANNED);
    }

    public function scopeUnbanned($query) {
        return $query->where('is_banned', UserStatus::UNBANNED);
    }
    public function scopeInstructor($query) {
        return $query->where('role', 'instructor');
    }

    public function socialite() {
        return $this->hasMany(SocialiteCredential::class, 'user_id');
    }




    // Enrollment functionality removed - system is now free

    function country(): BelongsTo {
        return $this->belongsTo(Country::class, 'country_id');
    }
    // function orders(): HasMany {
    //     return $this->hasMany(Order::class, 'buyer_id', 'id');
    // } // Order functionality removed
    function zoom_credential(): HasOne {
        return $this->hasOne(ZoomCredential::class, 'instructor_id', 'id');
    }
    function jitsi_credential(): HasOne {
        return $this->hasOne(JitsiSetting::class, 'instructor_id', 'id');
    }
    public function carts() {
        return $this->hasMany(Cart::class, 'user_id', 'id')->whereHas('course', function ($query) {
            $query->where(['is_approved' => 'approved', 'status' => 'active']);
        });
    }

    // Accessor for cart count
    public function getCartCountAttribute() {
        return $this->carts()->sum('qty');
    }
    public function getCartTotalAttribute() {
        return $this->carts()->join('courses', 'courses.id', '=', 'carts.course_id')->selectRaw('SUM(carts.qty * IFNULL(NULLIF(courses.discount, 0), courses.price)) as total')->value('total') ?? 0;
    }

    public function progresses(): HasMany {
        return $this->hasMany(CourseProgress::class, 'user_id', 'id');
    }

    /**
     * Get courses assigned to this user.
     */
    public function assignedCourses(): HasMany {
        return $this->hasMany(CourseAssignment::class, 'user_id', 'id');
    }

    /**
     * Get courses assigned by this user (if admin).
     */
    public function coursesAssignedByMe(): HasMany {
        return $this->hasMany(CourseAssignment::class, 'assigned_by', 'id');
    }

    /**
     * Check if user has access to a specific course.
     */
    public function hasAccessToCourse($courseId): bool
    {
        return $this->assignedCourses()->where('course_id', $courseId)->exists();
    }

}
