<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3c0008;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px 20px;
            border: 1px solid #ddd;
        }
        .field {
            margin-bottom: 20px;
        }
        .label {
            font-weight: bold;
            color: #3c0008;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .value {
            background-color: white;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
        }
        .message-box {
            background-color: white;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
            white-space: pre-line;
        }
        .footer {
            margin-top: 20px;
            padding: 20px;
            border-top: 2px solid #3c0008;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3c0008;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 15px;
        }
        .info-box {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            padding: 10px;
            border-radius: 4px;
            margin-top: 20px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 style="margin: 0;">📧 New Contact Form Submission</h2>
        </div>
        
        <div class="content">
            <div class="field">
                <div class="label">👤 Name:</div>
                <div class="value">{{ $contactMessage->name }}</div>
            </div>

            <div class="field">
                <div class="label">✉️ Email:</div>
                <div class="value">
                    <a href="mailto:{{ $contactMessage->email }}">{{ $contactMessage->email }}</a>
                </div>
            </div>

            <div class="field">
                <div class="label">📋 Subject:</div>
                <div class="value">{{ $contactMessage->subject }}</div>
            </div>

            <div class="field">
                <div class="label">💬 Message:</div>
                <div class="message-box">{{ $contactMessage->message }}</div>
            </div>

            <div class="field">
                <div class="label">🕐 Submitted At:</div>
                <div class="value">{{ $contactMessage->created_at->format('F d, Y - h:i A') }}</div>
            </div>

            <div class="field">
                <div class="label">🌐 IP Address:</div>
                <div class="value">{{ $contactMessage->ip_address }}</div>
            </div>

            <div class="info-box">
                💡 <strong>Tip:</strong> You can reply directly to this email and it will go to {{ $contactMessage->email }}
            </div>
        </div>

        <div class="footer">
            <p><strong>Scanlen & Holderness</strong></p>
            <p>This message was sent from the contact form on your website.</p>
            <p style="margin-top: 10px;">
                <small>Message ID: #{{ $contactMessage->id }}</small>
            </p>
        </div>
    </div>
</body>
</html>