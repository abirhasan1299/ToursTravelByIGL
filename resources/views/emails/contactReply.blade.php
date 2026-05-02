{{-- resources/views/emails/contact-notification.blade.php --}}
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Inquiry - IGL Tours & Travel</title>
    <style>
        /* Classic, reliable email styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f7fb;
            line-height: 1.5;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.08);
        }
        /* Header with travel-inspired design */
        .email-header {
            background: linear-gradient(135deg, #0B2B40 0%, #1A4A5F 100%);
            padding: 32px 32px 28px;
            text-align: center;
            border-bottom: 4px solid #F9B23F;
        }
        .logo {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.3px;
            color: white;
            margin-bottom: 12px;
            display: inline-block;
        }
        .logo span {
            color: #F9B23F;
            font-weight: 800;
        }
        .tagline {
            color: rgba(255,255,255,0.85);
            font-size: 14px;
            font-weight: 400;
            border-top: 1px solid rgba(255,255,255,0.2);
            display: inline-block;
            padding-top: 10px;
            margin-top: 6px;
        }
        .alert-badge {
            background-color: #F9B23F;
            color: #0B2B40;
            font-size: 13px;
            font-weight: bold;
            padding: 6px 14px;
            border-radius: 40px;
            display: inline-block;
            margin-bottom: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        /* Main content */
        .email-body {
            padding: 36px 32px 32px;
        }
        .greeting {
            font-size: 24px;
            font-weight: 700;
            color: #0B2B40;
            margin-bottom: 10px;
        }
        .intro-text {
            color: #4a5b6e;
            font-size: 16px;
            margin-bottom: 28px;
            border-left: 3px solid #F9B23F;
            padding-left: 16px;
        }
        /* Details card */
        .details-card {
            background-color: #F9FCFE;
            border-radius: 20px;
            border: 1px solid #e6edf4;
            overflow: hidden;
            margin-bottom: 32px;
        }
        .details-header {
            background-color: #F0F6FA;
            padding: 14px 24px;
            border-bottom: 1px solid #e2eaf1;
        }
        .details-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: #1A4A5F;
            letter-spacing: 0.3px;
            margin: 0;
        }
        .details-table {
            width: 100%;
            padding: 8px 0;
        }
        .details-row {
            border-bottom: 1px solid #edf2f7;
        }
        .details-label {
            padding: 16px 0 12px 24px;
            width: 100px;
            font-weight: 600;
            color: #2c3e4e;
            vertical-align: top;
            font-size: 14px;
        }
        .details-value {
            padding: 16px 24px 12px 12px;
            color: #1f2f3e;
            font-size: 15px;
            word-break: break-word;
        }
        .message-box {
            background-color: #FEFCF5;
            border-left: 4px solid #F9B23F;
            margin: 16px 24px 24px 24px;
            padding: 20px;
            border-radius: 14px;
        }
        .message-label {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.8px;
            color: #b88b2c;
            margin-bottom: 10px;
        }
        .message-content {
            font-size: 15px;
            color: #1e2f3c;
            line-height: 1.6;
            white-space: pre-wrap;
        }
        /* CTA / action */
        .action-button {
            text-align: center;
            margin: 30px 0 20px;
        }
        .btn-reply {
            background-color: #0B2B40;
            color: white;
            padding: 12px 28px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            display: inline-block;
            transition: background 0.2s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .btn-reply:hover {
            background-color: #1A4A5F;
        }
        /* Footer */
        .email-footer {
            background-color: #F8FAFE;
            padding: 24px 32px;
            text-align: center;
            border-top: 1px solid #e9eef3;
            font-size: 13px;
            color: #6f7e8f;
        }
        .footer-links {
            margin-bottom: 12px;
        }
        .footer-links a {
            color: #1A4A5F;
            text-decoration: none;
            margin: 0 8px;
            font-weight: 500;
        }
        hr {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 16px 0;
        }
        @media (max-width: 600px) {
            .email-body {
                padding: 24px 20px;
            }
            .details-label {
                display: block;
                width: auto;
                padding: 12px 24px 4px 24px;
            }
            .details-value {
                display: block;
                padding: 0 24px 12px 24px;
            }
            .message-box {
                margin: 16px 16px 24px 16px;
            }
        }
    </style>
</head>
<body>
<div class="email-container">
    <!-- Header with brand identity -->
    <div class="email-header">
        <div class="alert-badge">✈️ New Inquiry</div>
        <div class="logo">IGL <span>TRAVEL</span></div>
        <div class="tagline">explore beyond boundaries</div>
    </div>

    <!-- Body Content -->
    <div class="email-body">
        <div class="greeting">
            Hello {{$user->customer_name}},
        </div>
        <div class="intro-text">
            A new contact form submission has been received from <strong>{{ $details['name'] ?? 'a visitor' }}</strong>. Please review the details below and respond at your earliest convenience.
        </div>

        <!-- Visitor details card -->
        <div class="details-card">
            <div class="details-header">
                <h3>📋 Contact Information</h3>
            </div>
            <table class="details-table" cellpadding="0" cellspacing="0" role="presentation">
                <tr class="details-row">
                    <td class="details-label">Full Name</td>
                    <td class="details-value"><strong>{{ $details['name'] ?? 'Not provided' }}</strong></td>
                </tr>
                <tr class="details-row">
                    <td class="details-label">Email Address</td>
                    <td class="details-value">
                        <a href="mailto:{{ $details['email'] ?? '' }}" style="color:#1A4A5F; text-decoration:none; font-weight:500;">
                            {{ $details['email'] ?? 'Not provided' }}
                        </a>
                    </td>
                </tr>
                <tr class="details-row">
                    <td class="details-label">Phone Number</td>
                    <td class="details-value">{{ $details['phone'] ?? 'Not provided' }}</td>
                </tr>
                @if(!empty($details['subject']))
                    <tr class="details-row">
                        <td class="details-label">Subject</td>
                        <td class="details-value">{{ $details['subject'] }}</td>
                    </tr>
                @endif
            </table>

            <!-- Dedicated message block -->
            <div class="message-box">
                <div class="message-label">💬 Message</div>
                <div class="message-content">
                    {{ $details['message'] ?? 'No message content provided.' }}
                </div>
            </div>
        </div>

        <!-- Quick action buttons (optional) -->
        <div class="action-button">
            <a href="mailto:{{ $details['email'] ?? '' }}" class="btn-reply">
                ✉️  Reply to {{ explode(' ', trim($details['name'] ?? ''))[0] ?? 'Visitor' }}
            </a>
        </div>
        <div style="text-align: center; font-size: 13px; color: #8899aa; margin-top: 8px;">
            or call: {{ $details['phone'] ?? 'the number above' }}
        </div>
    </div>

    <!-- Footer with travel inspiration & legal -->
    <div class="email-footer">
        <div class="footer-links">
            <a href="#">Explore Packages</a> •
            <a href="#">Support Center</a> •
            <a href="#">IGL Dashboard</a>
        </div>
        <p style="margin: 8px 0 0px;">
            IGL Tours & Travel — Crafting journeys since 2012
        </p>
        <p style="font-size: 12px; margin-top: 12px;">
            This is an automated notification from your website contact form. <br>
            For immediate assistance, log into your admin panel.
        </p>
        <hr>
        <p style="font-size: 11px;">
            {{ config('app.name')}} | {{ strtoupper(config('app.env')) }}
        </p>
    </div>
</div>
</body>
</html>
