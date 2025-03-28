<!-- resources/views/emails/reply_notification.blade.php -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>New Reply on Your Ticket</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f7fc;
                color: #333;
                margin: 0;
                padding: 0;
                text-align: center;
            }

            .email-container {
                width: 100%;
                max-width: 600px;
                background-color: #fff;
                margin: 20px auto;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .email-header {
                background-color: #0073e6;
                padding: 15px;
                border-radius: 8px;
                color: white;
            }

            .email-header h1 {
                font-size: 24px;
                margin: 0;
            }

            .email-body {
                margin: 20px 0;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 8px;
            }

            .email-body p {
                font-size: 16px;
                line-height: 1.6;
                color: #555;
            }

            .ticket-info {
                background-color: #f1f1f1;
                border-left: 5px solid #0073e6;
                padding: 10px;
                margin: 20px 0;
            }

            .ticket-info p {
                font-weight: bold;
                color: #333;
                margin: 0;
            }

            .ticket-info span {
                color: #0073e6;
                font-weight: normal;
            }

            .email-footer {
                background-color: #0073e6;
                color: white;
                padding: 15px;
                border-radius: 8px;
            }

            .email-footer p {
                margin: 0;
                font-size: 14px;
            }

            .btn {
                background-color: #0073e6;
                color: white;
                padding: 12px 20px;
                text-decoration: none;
                border-radius: 5px;
                display: inline-block;
                margin-top: 20px;
            }

            .btn:hover {
                background-color: #005bb5;
            }

            @media (max-width: 600px) {
                .email-container {
                    width: 100%;
                    padding: 10px;
                }

                .email-header h1 {
                    font-size: 20px;
                }
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="email-header">
                <h1>New Reply on Ticket #{{ $ticket->id }}</h1>
            </div>

            <div class="email-body">
                <p>Hello {{ $ticket->user->name }},</p>
                <p>
                    There is a new reply on your ticket titled
                    <strong>"{{ $ticket->title }}"</strong>
                    .
                </p>

                <div class="ticket-info">
                    <p><strong>Reply:</strong></p>
                    <p>{{ $reply->message }}</p>
                </div>

                <p>You can view the details of the ticket by clicking the button below:</p>
                <a href="{{ route('ticket.view', $ticket->id) }}" class="btn">View Ticket</a>
            </div>

            <div class="email-footer">
                <p>Best regards,</p>
                <p>Your Support Team</p>
            </div>
        </div>
    </body>
</html>
