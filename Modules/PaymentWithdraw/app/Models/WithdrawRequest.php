<?php

namespace Modules\PaymentWithdraw\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class WithdrawRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'withdraw_method_id',
        'withdraw_amount',
        'total_amount',
        'withdraw_charge',
        'account_info',
        'status',
        'approved_date',
        'admin_feedback'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'withdraw_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'withdraw_charge' => 'decimal:2',
        'approved_date' => 'datetime',
        'account_info' => 'array'
    ];

    /**
     * Get the table associated with the model.
     */
    public function getTable()
    {
        return 'withdraw_requests';
    }

    /**
     * Get the user that owns the withdraw request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the withdraw method that owns the withdraw request.
     */
    public function withdrawMethod()
    {
        return $this->belongsTo(WithdrawMethod::class);
    }

    /**
     * Scope a query to only include pending requests.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include approved requests.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope a query to only include rejected requests.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}