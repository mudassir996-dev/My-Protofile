<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Portfolio Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #4f46e5; color: #fff; padding: 20px; border-radius: 5px 5px 0 0; text-align: center;">
        <h2 style="margin: 0;">New Contact Form Submission</h2>
    </div>
    <div style="padding: 20px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 5px 5px; background-color: #fafafa;">
        <p><strong>Name:</strong> {{ $contactMessage->name }}</p>
        <p><strong>Email:</strong> <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a></p>
        <p><strong>Subject:</strong> {{ $contactMessage->subject }}</p>
        <hr style="border: none; border-top: 1px solid #ddd; margin: 20px 0;">
        <p><strong>Message:</strong></p>
        <div style="background: #fff; border: 1px solid #eee; padding: 15px; border-radius: 4px; white-space: pre-wrap;">{{ $contactMessage->message }}</div>
    </div>
    <div style="text-align: center; margin-top: 20px; font-size: 12px; color: #666;">
        <p>This message was sent from your portfolio website contact form.</p>
    </div>
</body>
</html>
