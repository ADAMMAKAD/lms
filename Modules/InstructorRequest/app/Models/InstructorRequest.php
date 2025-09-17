<?php

namespace Modules\InstructorRequest\app\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InstructorRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'certificate',
        'identity_scan',
        'payout_account',
        'payout_information',
        'extra_information',
    ];

    protected $casts = [
        'payout_information' => 'array',
        'extra_information' => 'array',
    ];

    /**
     * Get the user that owns the instructor request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}