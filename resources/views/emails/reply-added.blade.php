<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Ticket Update</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f9fafb;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            padding: 32px;
            color: white;
        }
        .header-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            vertical-align: middle;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            display: inline-block;
            vertical-align: middle;
        }
        .header p {
            margin: 4px 0 0 52px;
            color: #bfdbfe;
            font-size: 14px;
        }
        .content {
            padding: 32px;
        }
        .greeting {
            margin-bottom: 24px;
        }
        .greeting p:first-child {
            font-size: 18px;
            color: #374151;
            margin: 0 0 8px 0;
        }
        .greeting p:last-child {
            color: #6b7280;
            margin: 0;
        }
        .ticket-card {
            background-color: #f9fafb;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 24px;
            border-left: 4px solid #2563eb;
        }
        .ticket-field {
            margin-bottom: 16px;
        }
        .ticket-field:last-child {
            margin-bottom: 0;
        }
        .field-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 4px;
        }
        .field-value {
            color: #111827;
            font-weight: 500;
            margin: 0;
        }
        .reply-message {
            background-color: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            padding: 16px;
            margin-top: 8px;
        }
        .reply-message p {
            color: #1f2937;
            margin: 0;
            line-height: 1.6;
        }
        .action-button {
            text-align: center;
            margin-bottom: 24px;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.2s;
        }
        .btn:hover {
            background-color: #1d4ed8;
        }
        .divider {
            border-top: 1px solid #e5e7eb;
            margin: 24px 0;
        }
        .closing p {
            color: #374151;
            margin: 8px 0;
        }
        .closing p:last-child {
            color: #111827;
            font-weight: 600;
        }
        .footer {
            background-color: #f9fafb;
            padding: 16px 32px;
            border-top: 1px solid #e5e7eb;
            font-size: 12px;
            color: #6b7280;
            text-align: center;
        }
        .footer a {
            color: #6b7280;
            text-decoration: none;
            margin: 0 8px;
        }
        .footer a:hover {
            color: #374151;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="header-icon">
                <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                </svg>
            </div>
            <h1>Support Ticket Update</h1>
            <p>New reply received</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Greeting -->
            <div class="greeting">
                <p>Hello,</p>
                <p>A new reply has been added to your support ticket.</p>
            </div>

            <!-- Ticket Information -->
            <div class="ticket-card">
                <div class="ticket-field">
                    <span class="field-label">Ticket Title:</span>
                    <p class="field-value">{{ $ticket->title }}</p>
                </div>
                
                <div class="ticket-field">
                    <span class="field-label">Reply Message:</span>
                    <div class="reply-message">
                        <p>{{ $reply->message }}</p>
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            {{-- <div class="action-button">
                <a href="#" class="btn">View Ticket</a>
            </div> --}}

            <!-- Divider -->
            <div class="divider"></div>

            <!-- Closing -->
            <div class="closing">
                <p>Thank you for using our support system.</p>
                <p>Best regards,</p>
                <p>Support Ticket Team</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© 2024 ByteTuned Technologies. All rights reserved.</p>
            {{-- <a href="#">Help Center</a>
            <a href="#">Contact Us</a> --}}
        </div>
    </div>
</body>
</html>