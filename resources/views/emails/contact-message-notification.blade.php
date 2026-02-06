<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message - Law Firm</title>
    <style>
        /* Custom styles for email compatibility */
        body {
            font-family: "Poppins", sans-serif;
            line-height: 1.6;
            color: #1e1e1e;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            /* border-radius: 8px; */
            overflow: hidden;
            padding: 10px;
        }
        .email-header {
            background: linear-gradient(135deg, #3c0008, #50010b);;
            color: white;
            padding: 25px 20px;
            text-align: center;
        }
        .email-body {
            background-color: #fff;
            padding: 10px;
        }
        .message-details {
            background-color: #f8f9fa;
            border-left: 4px solid #50010b;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .detail-item {
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #eaeaea;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: 600;
            color: #50010b;
            min-width: 100px;
            display: inline-block;
        }
        .alert{
            background: #ffc107;
            padding: 5px;
            margin: 4px;
        }
        .footer {
            background: linear-gradient(135deg, #50010b, #3c0008);
            padding: 20px;
            text-align: center;
            color: #c5c5c5;
            font-size: 14px;
        }
        .company-name {
            font-weight: 700;
            color: #fff;
            font-size: 18px;
        }
        .timestamp {
            background-color: #fee9f1;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 25px;
            font-size: 14px;
        }
        .message-content {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #eee;
        }
        @media (max-width: 576px) {
            .email-body {
                padding: 20px 15px;
            }
            .detail-item {
                display: block;
            }
            .label {
                display: block;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h2 class="mb-2">New Client Inquiry Received </h2>
            <p class="mb-0">{{ $contactMessage->subject }}</p>
        </div>
        
        <!-- Email Body -->
        <div class="email-body">
            <!-- Timestamp -->
            <div class="timestamp">
                <i class="bi bi-clock me-1"></i> Received on: {{ $contactMessage->created_at->format('F j, Y, g:i a') }}
            </div>
            
            <!-- Intro -->
            <p class="lead">Hello Admin,</p>
            <p>A new message has been submitted through the law firm contact form. Here are the details:</p>
            
            <!-- Message Details -->
            <div class="message-details">
                <h5 class="mb-3" style="color: #50010b;">Contact Information</h5>
                
                <div class="detail-item">
                    <span class="label">Name:</span>
                    <span>{{ $contactMessage->name }}</span>
                </div>
                
                <div class="detail-item">
                    <span class="label">Email:</span>
                    <span>{{ $contactMessage->email }}</span>
                </div>
                
                {{-- <div class="detail-item">
                    <span class="label">Phone:</span>
                    <span>{{ $contactMessage->phone ?? 'Not provided' }}</span>
                </div> --}}
                
                <div class="detail-item">
                    <span class="label">Subject:</span>
                    <span>{{ $contactMessage->subject }}</span>
                </div>
                <div class="detail-item">
                    <span class="label">Message:</span>
                    <div class="message-content">
                        {{ $contactMessage->message }}
                    </div>
                </div>
            </div>
            
            
            <!-- Additional Info -->
            <div class="alert mt-4">
                <small>
                    This message was sent from the contact form on your law firm website. 
                    Please respond within 24 hours for best client service.
                </small>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="company-name mb-2">Scanlen & Holderness </div>
            <p class="mb-1">This is an automated notification from your website contact system.</p>
            <p class="mb-0">
                <small>© {{ date('Y') }} Scanlen & Holderness. All rights reserved.</small>
            </p>
        </div>
    </div>
    
</body>
</html>