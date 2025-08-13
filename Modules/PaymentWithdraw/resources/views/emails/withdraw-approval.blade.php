<!DOCTYPE html>
<html>
<head>
    <title>Withdraw Request Approval</title>
</head>
<body>
    <h2>Withdraw Request Approved</h2>
    
    <p>Dear {{ $user->name }},</p>
    
    <p>Your withdraw request has been approved!</p>
    
    <p><strong>Details:</strong></p>
    <ul>
        <li>Amount: {{ currency($withdrawRequest->withdraw_amount) }}</li>
        <li>Charge: {{ currency($withdrawRequest->withdraw_charge) }}</li>
        <li>Total: {{ currency($withdrawRequest->total_amount) }}</li>
        <li>Method: {{ $withdrawRequest->withdrawMethod->name }}</li>
        <li>Status: {{ ucfirst($withdrawRequest->status) }}</li>
    </ul>
    
    <p>The funds will be transferred to your account within 3-5 business days.</p>
    
    <p>Thank you for using our platform!</p>
    
    <p>Best regards,<br>{{ config('app.name') }} Team</p>
</body>
</html>