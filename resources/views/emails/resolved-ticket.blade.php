<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Resolved</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="20" cy="80" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }
        
        .success-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
            position: relative;
            z-index: 1;
        }
        
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            line-height: 1.2;
            position: relative;
            z-index: 1;
        }
        
        .content {
            padding: 40px 30px;
            line-height: 1.6;
            color: #374151;
        }
        
        .greeting {
            font-size: 18px;
            font-weight: 500;
            color: #111827;
            margin-bottom: 20px;
        }
        
        .main-message {
            font-size: 16px;
            margin-bottom: 30px;
            background: #f0fdf4;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #10b981;
        }
        
        .ticket-title {
            color: #10b981;
            font-weight: 600;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
            margin: 30px 0;
            border: none;
        }
        
        .details-section {
            background: #f9fafb;
            padding: 25px;
            border-radius: 12px;
            margin: 25px 0;
        }
        
        .details-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        
        .details-title::before {
            content: '📋';
            margin-right: 8px;
        }
        
        .details-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .details-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .details-list li:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 500;
            color: #6b7280;
        }
        
        .detail-value {
            font-weight: 600;
            color: #111827;
        }
        
        .status-badge {
            background: #dcfce7;
            color: #166534;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .cta-section {
            text-align: center;
            margin: 30px 0;
        }
        
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: transform 0.2s ease;
        }
        
        .cta-button:hover {
            transform: translateY(-2px);
        }
        
        .closing-message {
            background: #fef3c7;
            padding: 20px;
            border-radius: 12px;
            border-left: 4px solid #f59e0b;
            margin: 25px 0;
        }
        
        .signature {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }
        
        .signature p {
            margin: 5px 0;
        }
        
        .team-name {
            font-weight: 600;
            color: #10b981;
        }
        
        .footer {
            background: #f9fafb;
            color: #6b7280;
            text-align: center;
            padding: 25px 30px;
            font-size: 14px;
            border-top: 1px solid #e5e7eb;
        }
        
        .footer-links {
            margin-top: 15px;
        }
        
        .footer-links a {
            color: #10b981;
            text-decoration: none;
            margin: 0 10px;
        }
        
        @media (max-width: 600px) {
            body {
                padding: 20px 10px;
            }
            
            .header {
                padding: 30px 20px;
            }
            
            .content {
                padding: 30px 20px;
            }
            
            .header h1 {
                font-size: 24px;
            }
            
            .details-section {
                padding: 20px;
            }
            
            .details-list li {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="success-icon">
                ✅
            </div>
            <h1>Your Ticket Has Been {{ $statusLabel }}!</h1>
        </div>
        
        <div class="content">
            <p class="greeting">Hello {{ $ticket->user->name ?? 'Valued Customer' }},</p>
            
            <div class="main-message">
                <p>We're happy to let you know your support ticket <span class="ticket-title">"{{ $ticket->title }}"</span> has been {{ strtolower($statusLabel) }}.</p>
                
                <p style="margin-bottom: 0;">Our support specialists have thoroughly addressed your concern and implemented the necessary solution.</p>
            </div>
            
            <div class="details-section">
                <div class="details-title">Ticket Summary</div>
                <ul class="details-list">
                    <li>
                        <span class="detail-label">Ticket ID</span>
                        <span class="detail-value">#{{ $ticket->id }}</span>
                    </li>
                    <li>
                        <span class="detail-label">Status</span>
                        <span class="status-badge">{{ ucfirst($ticket->status) }}</span>
                    </li>
                    <li>
                        <span class="detail-label">Submitted</span>
                        <span class="detail-value">{{ $ticket->created_at->format('F d, Y') }}</span>
                    </li>
                    <li>
                        <span class="detail-label">Resolved</span>
                        <span class="detail-value">{{ now()->format('F d, Y') }}</span>
                    </li>
                </ul>
            </div>
            
            {{-- <div class="cta-section">
                <a href="#" class="cta-button">View Ticket Details</a>
            </div> --}}
            
            <div class="closing-message">
                <p><strong>Need Additional Help?</strong></p>
                <p style="margin-bottom: 0;">If you have any follow-up questions or need further assistance, don't hesitate to reopen this ticket or contact our support team. We're here to help!</p>
            </div>
            
            <div class="signature">
                <p>Thank you for choosing our service and giving us the opportunity to assist you.</p>
                <p style="margin-bottom: 0;">Warm regards,</p>
                <p class="team-name">The Support Team</p>
            </div>
        </div>
        
        <div class="footer">
            <p>© {{ now()->year }} ByteTuned Technologies. All rights reserved.</p>
        </div>
    </div>
</body>
</html>