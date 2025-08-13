<?php

namespace Modules\PaymentWithdraw\database\seeders;

use Illuminate\Database\Seeder;
use Modules\PaymentWithdraw\app\Models\WithdrawMethod;

class PaymentWithdrawDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default withdraw methods
        WithdrawMethod::create([
            'name' => 'Bank Transfer',
            'minimum_amount' => 50.00,
            'maximum_amount' => 10000.00,
            'withdraw_charge' => 5.00,
            'description' => 'Withdraw funds via bank transfer',
            'status' => true
        ]);

        WithdrawMethod::create([
            'name' => 'PayPal',
            'minimum_amount' => 10.00,
            'maximum_amount' => 5000.00,
            'withdraw_charge' => 2.50,
            'description' => 'Withdraw funds via PayPal',
            'status' => true
        ]);

        WithdrawMethod::create([
            'name' => 'Stripe',
            'minimum_amount' => 20.00,
            'maximum_amount' => 8000.00,
            'withdraw_charge' => 3.00,
            'description' => 'Withdraw funds via Stripe',
            'status' => true
        ]);
    }
}