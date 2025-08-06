<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Ticket Created</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 40px 20px;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
        }

        h1 {
            font-size: 24px;
            color: #4F46E5;
            margin-bottom: 30px;
            text-align: center;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .field {
            flex: 1;
        }

        .label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        .value {
            font-size: 15px;
            color: #333;
            line-height: 1.6;
        }

        .badge {
            display: inline-block;
            padding: 5px 15px;
            font-size: 10px;
            font-weight: bold;
            border-radius: 50px;
            text-transform: uppercase;
        }

        .priority-high {
            background-color: #ffe6e6;
            color: #d82525;
        }

        .priority-medium {
            background-color: #fff3cd;
            color: #f57c00;
        }

        .priority-low {
            background-color: #e8f5e8;
            color: #28a745;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #999;
            margin-top: 40px;
        }

        .footer a {
            color: #4F46E5;
            text-decoration: none;
        }

        @media (max-width: 600px) {
            .row {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>New Ticket Assigned</h1>

        <div class="row">
            <div class="field">
                <span class="label">Title</span>
                <span class="value">{{ $ticket->title }}</span>
            </div>

            <div class="field">
                <span class="label">Priority</span>
                <span class="value">
                    <span class="badge priority-{{ strtolower($ticket->priority) }}">
                        {{ ucfirst($ticket->priority) }}
                    </span>
                </span>
            </div>
        </div>

        <div class="field">
            <span class="label">Description</span>
            <div class="value">{{ $ticket->description }}</div>
        </div>

        @component('mail::button', ['url' => route('ticket.detail', $ticket->id)])
            View Ticket
        @endcomponent

        <div class="footer">
            <p>© {{ now()->year }} ByteTuned Technologies. All rights reserved.</p>
            {{-- <a href="#">Help Center</a>
            <a href="#">Contact Us</a> --}}
        </div>
    </div>
</body>

</html>
