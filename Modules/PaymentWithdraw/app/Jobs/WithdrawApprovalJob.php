<?php

namespace Modules\PaymentWithdraw\app\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Modules\PaymentWithdraw\app\Emails\WithdrawApprovalMail;
use Modules\PaymentWithdraw\app\Models\WithdrawRequest;

class WithdrawApprovalJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $withdrawRequest;

    /**
     * Create a new job instance.
     */
    public function __construct(WithdrawRequest $withdrawRequest)
    {
        $this->withdrawRequest = $withdrawRequest;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send approval email to user
        Mail::to($this->withdrawRequest->user->email)
            ->send(new WithdrawApprovalMail($this->withdrawRequest));

        // Additional logic for withdraw approval can be added here
        // For example: updating user balance, logging transactions, etc.
    }
}