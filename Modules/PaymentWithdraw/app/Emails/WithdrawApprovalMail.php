<?php

namespace Modules\PaymentWithdraw\app\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Modules\PaymentWithdraw\app\Models\WithdrawRequest;

class WithdrawApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $withdrawRequest;

    /**
     * Create a new message instance.
     */
    public function __construct(WithdrawRequest $withdrawRequest)
    {
        $this->withdrawRequest = $withdrawRequest;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Withdraw Request Approval',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'paymentwithdraw::emails.withdraw-approval',
            with: [
                'withdrawRequest' => $this->withdrawRequest,
                'user' => $this->withdrawRequest->user,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int,