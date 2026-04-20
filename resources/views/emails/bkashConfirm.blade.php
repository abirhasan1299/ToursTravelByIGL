<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - {{ $booking->invoice_number ?? '#' . $booking->id }}</title>
    <style>
        /* Email Client Safe Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f7fb;
            margin: 0;
            padding: 0;
        }

        /* Main Container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }

        /* Header Section */
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .logo {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .email-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 10px 0 5px;
            letter-spacing: -0.5px;
        }

        .email-header p {
            font-size: 14px;
            opacity: 0.9;
            margin: 0;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 15px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
        }

        /* Content Sections */
        .email-content {
            padding: 30px;
        }

        .greeting {
            margin-bottom: 25px;
        }

        .greeting h2 {
            color: #1e293b;
            font-size: 22px;
            margin-bottom: 8px;
        }

        .greeting p {
            color: #64748b;
            font-size: 15px;
        }

        /* Info Cards */
        .info-card {
            background: #f8fafc;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
            display: inline-block;
        }

        .info-row {
            display: flex;
            padding: 10px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .info-label {
            width: 120px;
            font-weight: 600;
            color: #475569;
            font-size: 13px;
        }

        .info-value {
            flex: 1;
            color: #1e293b;
            font-size: 14px;
            font-weight: 500;
        }

        /* Seat Grid */
        .seat-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .seat-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Amount Box */
        .amount-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 16px;
            text-align: center;
            margin: 20px 0;
        }

        .amount-label {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 5px;
        }

        .amount-value {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .amount-currency {
            font-size: 18px;
            font-weight: 600;
        }

        /* Transaction Details */
        .transaction-details {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 15px;
            margin-top: 15px;
        }

        .transaction-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 13px;
        }

        .transaction-label {
            color: #64748b;
            font-weight: 500;
        }

        .transaction-value {
            color: #1e293b;
            font-weight: 600;
        }

        /* Timeline */
        .timeline {
            margin: 20px 0;
        }

        .timeline-step {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .timeline-icon {
            width: 36px;
            height: 36px;
            background: #e2e8f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 14px;
        }

        .timeline-icon.completed {
            background: #10b981;
            color: white;
        }

        .timeline-content {
            flex: 1;
        }

        .timeline-title {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
        }

        .timeline-date {
            font-size: 12px;
            color: #94a3b8;
        }

        /* Button */
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 14px;
            margin: 20px 0;
            text-align: center;
        }

        /* Footer */
        .email-footer {
            background: #f8fafc;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .footer-text {
            color: #94a3b8;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .social-links {
            margin: 15px 0;
        }

        .social-links a {
            color: #667eea;
            text-decoration: none;
            margin: 0 10px;
            font-size: 18px;
        }

        /* Responsive */
        @media only screen and (max-width: 480px) {
            .email-content {
                padding: 20px;
            }

            .info-row {
                flex-direction: column;
            }

            .info-label {
                width: 100%;
                margin-bottom: 5px;
            }

            .amount-value {
                font-size: 28px;
            }
        }

        /* Utility Classes */
        .text-center {
            text-align: center;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body style="margin: 0; padding: 20px 0; background-color: #f4f7fb; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#f4f7fb">
    <tr>
        <td align="center" style="padding: 20px 10px;">
            <div class="email-container" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">

                <!-- Header -->
                <div class="email-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 30px; text-align: center; color: white;">
                    <div class="logo" style="font-size: 48px; margin-bottom: 10px;">🎫</div>
                    <h1 style="font-size: 28px; font-weight: 700; margin: 10px 0 5px; letter-spacing: -0.5px;">Booking Confirmed!</h1>
                    <p style="font-size: 14px; opacity: 0.9; margin: 0;">Thank you for choosing us</p>
                    @php
                        $statusColor = match($booking->status) {
                            'booked', 'paid', 'confirmed' => '#10b981',
                            'pending' => '#f59e0b',
                            'cancelled' => '#ef4444',
                            default => '#64748b'
                        };
                    @endphp
                    <div class="status-badge" style="display: inline-block; padding: 8px 20px; border-radius: 50px; font-size: 13px; font-weight: 600; margin-top: 15px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px);">
                        📍 Status: {{ ucfirst($booking->status) }}
                    </div>
                </div>

                <!-- Content -->
                <div class="email-content" style="padding: 30px;">

                    <!-- Greeting -->
                    <div class="greeting" style="margin-bottom: 25px;">
                        <h2 style="color: #1e293b; font-size: 22px; margin-bottom: 8px;">Hello {{ $booking->full_name ?? 'Valued Customer' }}! 👋</h2>
                        <p style="color: #64748b; font-size: 15px;">Your booking has been successfully confirmed. Please find the details below.</p>
                    </div>

                    <!-- Booking Info Card -->
                    <div class="info-card" style="background: #f8fafc; border-radius: 16px; padding: 20px; margin-bottom: 25px; border: 1px solid #e2e8f0;">
                        <div class="card-title" style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #667eea; display: inline-block;">
                            📋 Booking Information
                        </div>

                        <div class="info-row" style="display: flex; padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                            <div class="info-label" style="width: 120px; font-weight: 600; color: #475569; font-size: 13px;">Booking ID:</div>
                            <div class="info-value" style="flex: 1; color: #1e293b; font-size: 14px; font-weight: 500;">
                                <strong>#{{ $booking->id }}</strong>
                            </div>
                        </div>

                        <div class="info-row" style="display: flex; padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                            <div class="info-label" style="width: 120px; font-weight: 600; color: #475569; font-size: 13px;">Invoice No:</div>
                            <div class="info-value" style="flex: 1; color: #1e293b; font-size: 14px; font-weight: 500;">
                                {{ $transaction->invoice_number ?? '#' . $booking->id }}
                            </div>
                        </div>

                        <div class="info-row" style="display: flex; padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                            <div class="info-label" style="width: 120px; font-weight: 600; color: #475569; font-size: 13px;">Booking Date:</div>
                            <div class="info-value" style="flex: 1; color: #1e293b; font-size: 14px; font-weight: 500;">
                                {{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y, h:i A') }}
                            </div>
                        </div>
                    </div>

                    <!-- Customer Info Card -->
                    <div class="info-card" style="background: #f8fafc; border-radius: 16px; padding: 20px; margin-bottom: 25px; border: 1px solid #e2e8f0;">
                        <div class="card-title" style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #667eea; display: inline-block;">
                            👤 Customer Details
                        </div>

                        <div class="info-row" style="display: flex; padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                            <div class="info-label" style="width: 120px; font-weight: 600; color: #475569; font-size: 13px;">Full Name:</div>
                            <div class="info-value" style="flex: 1; color: #1e293b; font-size: 14px; font-weight: 500;">{{ $booking->full_name ?? 'N/A' }}</div>
                        </div>

                        <div class="info-row" style="display: flex; padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                            <div class="info-label" style="width: 120px; font-weight: 600; color: #475569; font-size: 13px;">Email Address:</div>
                            <div class="info-value" style="flex: 1; color: #1e293b; font-size: 14px; font-weight: 500;">{{ $booking->email ?? 'N/A' }}</div>
                        </div>

                        <div class="info-row" style="display: flex; padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                            <div class="info-label" style="width: 120px; font-weight: 600; color: #475569; font-size: 13px;">Phone Number:</div>
                            <div class="info-value" style="flex: 1; color: #1e293b; font-size: 14px; font-weight: 500;">{{ $booking->phone ?? 'N/A' }}</div>
                        </div>

                        @if($booking->nid)
                            <div class="info-row" style="display: flex; padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                                <div class="info-label" style="width: 120px; font-weight: 600; color: #475569; font-size: 13px;">NID/Passport:</div>
                                <div class="info-value" style="flex: 1; color: #1e293b; font-size: 14px; font-weight: 500;">{{ $booking->nid }}</div>
                            </div>
                        @endif
                    </div>

                    <!-- Seat Details Card -->
                    <div class="info-card" style="background: #f8fafc; border-radius: 16px; padding: 20px; margin-bottom: 25px; border: 1px solid #e2e8f0;">
                        <div class="card-title" style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #667eea; display: inline-block;">
                            💺 Seat Information
                        </div>

                        <div class="info-row" style="display: flex; padding: 10px 0; border-bottom: 1px solid #e2e8f0;">
                            <div class="info-label" style="width: 120px; font-weight: 600; color: #475569; font-size: 13px;">Seat Numbers:</div>
                            <div class="info-value" style="flex: 1; color: #1e293b; font-size: 14px; font-weight: 500;">
                                <div class="seat-grid" style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px;">
                                    @php
                                        $seats = is_array($booking->seat_no) ? $booking->seat_no : json_decode($booking->seat_no, true);
                                        if(is_string($seats)) $seats = explode(',', $seats);
                                    @endphp
                                    @if(!empty($seats))
                                        @foreach($seats as $seat)
                                            <span class="seat-badge" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 6px 14px; border-radius: 10px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
                                                    🪑 {{ trim($seat) }}
                                                </span>
                                        @endforeach
                                    @else
                                        {{ $booking->seat_no ?? 'N/A' }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="info-row" style="display: flex; padding: 10px 0;">
                            <div class="info-label" style="width: 120px; font-weight: 600; color: #475569; font-size: 13px;">Seat Codes:</div>
                            <div class="info-value" style="flex: 1; color: #1e293b; font-size: 14px; font-weight: 500;">{{ $booking->seat_code ?? 'N/A' }}</div>
                        </div>
                    </div>

                    <!-- Payment & Amount -->
                    <div class="amount-box" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; border-radius: 16px; text-align: center; margin: 20px 0;">
                        <div class="amount-label" style="font-size: 14px; opacity: 0.9; margin-bottom: 5px;">Total Amount Paid</div>
                        <div class="amount-value" style="font-size: 36px; font-weight: 800; letter-spacing: -1px;">
                            {{ $transaction->currency ?? 'USD' }} {{ number_format($booking->total_amount ?? 0, 2) }}
                        </div>
                        <div class="amount-currency" style="font-size: 18px; font-weight: 600; margin-top: 5px;">
                            Payment Method: {{ ucfirst($booking->method ?? 'N/A') }}
                        </div>
                    </div>

                    <!-- Transaction Details -->
                    @if(isset($transaction) && $transaction)
                        <div class="transaction-details" style="background: #f1f5f9; border-radius: 12px; padding: 15px; margin-top: 15px;">
                            <div class="card-title" style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display: block; border-bottom: none; padding-bottom: 0;">
                                💳 Transaction Details
                            </div>
                            <div class="transaction-item" style="display: flex; justify-content: space-between; padding: 8px 0; font-size: 13px;">
                                <span class="transaction-label" style="color: #64748b; font-weight: 500;">Transaction ID:</span>
                                <span class="transaction-value" style="color: #1e293b; font-weight: 600;">{{ $transaction->trx_id ?? 'N/A' }}</span>
                            </div>
                            <div class="transaction-item" style="display: flex; justify-content: space-between; padding: 8px 0; font-size: 13px;">
                                <span class="transaction-label" style="color: #64748b; font-weight: 500;">Payment ID:</span>
                                <span class="transaction-value" style="color: #1e293b; font-weight: 600;">{{ $transaction->payment_id ?? 'N/A' }}</span>
                            </div>
                            <div class="transaction-item" style="display: flex; justify-content: space-between; padding: 8px 0; font-size: 13px;">
                                <span class="transaction-label" style="color: #64748b; font-weight: 500;">Transaction Status:</span>
                                <span class="transaction-value" style="color: #1e293b; font-weight: 600;">{{ ucfirst($transaction->status ?? 'N/A') }}</span>
                            </div>
                            <div class="transaction-item" style="display: flex; justify-content: space-between; padding: 8px 0; font-size: 13px;">
                                <span class="transaction-label" style="color: #64748b; font-weight: 500;">Transaction Date:</span>
                                <span class="transaction-value" style="color: #1e293b; font-weight: 600;">{{ isset($transaction->created_at) ? \Carbon\Carbon::parse($transaction->created_at)->format('d F Y, h:i A') : 'N/A' }}</span>
                            </div>
                        </div>
                    @endif

                    <!-- Coupon Information -->
                    @if($booking->is_coupon)
                        <div class="info-card" style="background: #fef3c7; border-radius: 16px; padding: 15px; margin: 20px 0; border: 1px solid #fde68a;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <span style="font-size: 24px;">🏷️</span>
                                <div>
                                    <div style="font-weight: 700; color: #92400e;">Coupon Applied!</div>
                                    <div style="font-size: 13px; color: #78350f;">Code: {{ $booking->coupon_code }}</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Special Request -->
                    @if($booking->any_request)
                        <div class="info-card" style="background: #f0fdf4; border-radius: 16px; padding: 15px; margin: 20px 0; border: 1px solid #bbf7d0;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <span style="font-size: 24px;">📝</span>
                                <div>
                                    <div style="font-weight: 700; color: #166534;">Special Request</div>
                                    <div style="font-size: 13px; color: #14532d;">"{{ $booking->any_request }}"</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Timeline -->
                    <div class="timeline" style="margin: 20px 0;">
                        <div class="card-title" style="font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 15px;">
                            📅 Booking Timeline
                        </div>

                        <div class="timeline-step" style="display: flex; align-items: center; margin-bottom: 15px;">
                            <div class="timeline-icon completed" style="width: 36px; height: 36px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 14px; color: white;">
                                ✓
                            </div>
                            <div class="timeline-content" style="flex: 1;">
                                <div class="timeline-title" style="font-weight: 600; color: #1e293b; font-size: 14px;">Booking Created</div>
                                <div class="timeline-date" style="font-size: 12px; color: #94a3b8;">{{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y, h:i A') }}</div>
                            </div>
                        </div>

                        @if(isset($transaction) && $transaction)
                            <div class="timeline-step" style="display: flex; align-items: center; margin-bottom: 15px;">
                                <div class="timeline-icon completed" style="width: 36px; height: 36px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 14px; color: white;">
                                    💳
                                </div>
                                <div class="timeline-content" style="flex: 1;">
                                    <div class="timeline-title" style="font-weight: 600; color: #1e293b; font-size: 14px;">Payment Processed</div>
                                    <div class="timeline-date" style="font-size: 12px; color: #94a3b8;">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d F Y, h:i A') }}</div>
                                </div>
                            </div>
                        @endif

                        <div class="timeline-step" style="display: flex; align-items: center; margin-bottom: 15px;">
                            <div class="timeline-icon" style="width: 36px; height: 36px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 14px;">
                                📧
                            </div>
                            <div class="timeline-content" style="flex: 1;">
                                <div class="timeline-title" style="font-weight: 600; color: #1e293b; font-size: 14px;">Confirmation Email Sent</div>
                                <div class="timeline-date" style="font-size: 12px; color: #94a3b8;">{{ now()->format('d F Y, h:i A') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="text-center" style="text-align: center;">
                        <a href="{{ url('/my-bookings/' . $booking->id) }}" class="btn" style="display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; text-decoration: none; padding: 12px 30px; border-radius: 50px; font-weight: 600; font-size: 14px; margin: 20px 0; text-align: center;">
                            🎟️ View My Booking
                        </a>
                    </div>

                    <!-- Note -->
                    <div style="background: #fefce8; border-left: 4px solid #eab308; padding: 15px; border-radius: 8px; margin: 20px 0;">
                        <div style="font-size: 13px; color: #854d0e;">
                            <strong>📌 Important Note:</strong> Please keep this email for your records. Present your booking ID or ID card at the counter for verification.
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="email-footer" style="background: #f8fafc; padding: 25px 30px; text-align: center; border-top: 1px solid #e2e8f0;">
                    <div class="footer-text" style="color: #94a3b8; font-size: 12px; margin-bottom: 10px;">
                        Need help? Contact our support team
                    </div>
                    <div style="margin: 10px 0;">
                        <a href="mailto:support@example.com" style="color: #667eea; text-decoration: none; font-size: 14px;">📧 support@example.com</a>
                        <span style="color: #cbd5e1; margin: 0 10px;">|</span>
                        <a href="tel:+1234567890" style="color: #667eea; text-decoration: none; font-size: 14px;">📞 +1 234 567 890</a>
                    </div>
                    <div class="social-links" style="margin: 15px 0;">
                        <a href="#" style="color: #667eea; text-decoration: none; margin: 0 10px; font-size: 18px;">📘</a>
                        <a href="#" style="color: #667eea; text-decoration: none; margin: 0 10px; font-size: 18px;">📷</a>
                        <a href="#" style="color: #667eea; text-decoration: none; margin: 0 10px; font-size: 18px;">🐦</a>
                    </div>
                    <div class="footer-text" style="color: #94a3b8; font-size: 12px; margin-bottom: 10px;">
                        &copy; {{ date('Y') }} Your Company Name. All rights reserved.
                    </div>
                    <div class="footer-text" style="color: #cbd5e1; font-size: 11px;">
                        This is an automated message, please do not reply directly to this email.
                    </div>
                </div>

            </div>
        </td>
    </tr>
</table>

</body>
</html>
