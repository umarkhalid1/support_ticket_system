<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Ticket Assigned</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 40px 20px;
            color: #374151;
            line-height: 1.6;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        h1 {
            font-size: 28px;
            color: #1f2937;
            margin-bottom: 40px;
            text-align: center;
            font-weight: 600;
        }

        .ticket-info {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .row:last-child {
            margin-bottom: 0;
        }

        .field {
            flex: 1;
            min-width: 200px;
        }

        .label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .value {
            font-size: 16px;
            color: #1f2937;
            line-height: 1.6;
            font-weight: 500;
        }

        .badge {
            display: inline-block;
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .priority-high {
            background-color: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .priority-medium {
            background-color: #fffbeb;
            color: #d97706;
            border: 1px solid #fed7aa;
        }

        .priority-low {
            background-color: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        .button-container {
            text-align: center;
            margin: 40px 0;
        }

        .view-button {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .divider {
            height: 1px;
            background-color: #e5e7eb;
            margin: 40px 0;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            margin-top: 30px;
        }

        .footer p {
            margin: 8px 0;
        }

        .footer a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        @media (max-width: 600px) {
            body {
                padding: 20px 10px;
            }

            .email-container {
                padding: 30px 20px;
            }

            .row {
                flex-direction: column;
                gap: 20px;
            }

            .field {
                min-width: auto;
            }

            h1 {
                font-size: 24px;
            }

            .ticket-info {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>New Ticket Assigned</h1>
        
        <div class="ticket-info">
            <div class="row">
                <div class="field">
                    <span class="label">Title</span>
                    <div class="value">{{ $ticket->title }}</div>
                </div>
                <div class="field">
                    <span class="label">Priority</span>
                    <div class="value">
                        <span class="badge priority-{{ strtolower($ticket->priority) }}">
                            {{ ucfirst($ticket->priority) }}
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="field">
                    <span class="label">Description</span>
                    <div class="value">{{ $ticket->description }}</div>
                </div>
                <div class="field">
                    <span class="label">Assigned By</span>
                    <div class="value">{{ $ticket->assignBy->name }}</div>
                </div>
            </div>
        </div>

        <div class="button-container">
            @component('mail::button', ['url' => route('ticket.detail', $ticket->id), 'color' => 'primary'])
                View Ticket
            @endcomponent
        </div>

        <div class="divider"></div>

        <div class="footer">
            <p>© {{ now()->year }} ByteTuned Technologies. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
