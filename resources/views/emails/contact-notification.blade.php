<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New contact message</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #334155; max-width: 600px; margin: 0 auto; padding: 20px;">
    <h2 style="color: #256af4;">New message from your portfolio</h2>
    <p><strong>From:</strong> {{ $senderName }} &lt;{{ $senderEmail }}&gt;</p>
    @if($contactSubject)
        <p><strong>Subject:</strong> {{ $contactSubject }}</p>
    @endif
    <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 16px 0;">
    <div style="white-space: pre-wrap; background: #f8fafc; padding: 16px; border-radius: 8px;">{{ $message }}</div>
    <p style="margin-top: 24px; font-size: 12px; color: #94a3b8;">You can reply directly to this email to respond to {{ $senderName }}.</p>
</body>
</html>
