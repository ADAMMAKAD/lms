<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ZoomCredential extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructor_id',
        'client_id',
        'client_secret',
    ];

    /**
     * Get the instructor that owns the zoom credential.
     */
    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }
}