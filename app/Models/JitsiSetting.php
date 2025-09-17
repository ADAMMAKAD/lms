<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JitsiSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'api_key',
        'app_id',
        'permissions',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    /**
     * Get the instructor that owns the jitsi setting.
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}