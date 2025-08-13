<?php

namespace Modules\PaymentWithdraw\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WithdrawMethod extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'minimum_amount',
        'maximum_amount',
        'withdraw_charge',
        'description',
        'status'
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'minimum_amount' => 'decimal:2',
        'maximum_amount' => 'decimal:2',
        'withdraw_charge' => 'decimal:2',
        'status' => 'boolean'
    ];

    /**
     * Get the table associated with the model.
     */
    public function getTable()
    {
        return 'withdraw_methods';
    }

    /**
     * Scope a query to only include active withdraw methods.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}