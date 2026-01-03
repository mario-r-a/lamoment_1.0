<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; }
        h2 { color: #681d1d; border-bottom: 2px solid #927458; padding-bottom: 10px; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #681d1d; }
        .value { margin-top: 5px; padding: 10px; background-color: #f0f0f0; border-left: 3px solid #927458; }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Contact Form Submission</h2>
        <div class="field">
            <div class="label">Name:</div>
            <div class="value">{{ $first_name }} {{ $last_name }}</div>
        </div>
        <div class="field">
            <div class="label">Email:</div>
            <div class="value">{{ $email }}</div>
        </div>
        <div class="field">
            <div class="label">Subject:</div>
            <div class="value">{{ $subject }}</div>
        </div>
        <div class="field">
            <div class="label">Message:</div>
            <div class="value">{!! nl2br(e($content_message)) !!}</div>
        </div>
        <p style="margin-top: 20px; border-top: 1px solid #ddd; padding-top: 10px; font-size: 12px; color: #666;">
            This is an automated email from Lamoment contact form.
        </p>
    </div>
</body>
</html>