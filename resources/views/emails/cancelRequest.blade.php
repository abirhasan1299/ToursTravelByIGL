<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Cancellation Notice</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #1e293b;
            background-color: #f0f2f8;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }

        /* Header Section */
        .email-header {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .email-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .email-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 150px;
            height: 150px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .cancel-icon {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .cancel-icon svg {
            width: 45px;
            height: 45px;
            color: white;
        }

        .email-header h1 {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .email-header p {
            color: rgba(255,255,255,0.9);
            font-size: 16px;
            position: relative;
            z-index: 1;
        }

        /* Content Section */
        .email-content {
            padding: 40px 30px;
        }

        .greeting {
            margin-bottom: 25px;
        }

        .greeting h2 {
            font-size: 22px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .greeting p {
            color: #64748b;
            font-size: 15px;
        }

        .alert-box {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .alert-box p {
            color: #991b1b;
            font-size: 14px;
            margin: 0;
        }

        /* Booking Details Card */
        .details-card {
            background: #f8fafc;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
            border: 1px solid #e2e8f0;
        }

        .details-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .details-title svg {
            width: 22px;
            height: 22px;
            color: #ef4444;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
        }

        .detail-value {
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
        }

        .amount-value {
            font-size: 24px;
            font-weight: 800;
            color: #ef4444;
        }

        /* Package Items */
        .package-items {
            margin-top: 15px;
        }

        .package-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 14px;
        }

        .package-name {
            color: #475569;
        }

        .package-price {
            font-weight: 600;
            color: #1e293b;
        }

        /* Action Button */
        .action-button {
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-rebook {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-rebook:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        /* Support Section */
        .support-section {
            background: #f1f5f9;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            margin-top: 20px;
        }

        .support-section p {
            color: #475569;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .support-links {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .support-links a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .support-links a:hover {
            text-decoration: underline;
        }

        /* Footer */
        .email-footer {
            background: #f8fafc;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }

        .email-footer p {
            color: #94a3b8;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .social-links {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #667eea;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .email-container {
                margin: 20px;
                border-radius: 20px;
            }

            .email-header {
                padding: 30px 20px;
            }

            .email-content {
                padding: 25px 20px;
            }

            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .amount-value {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
<div class="email-container">
    <!-- Header -->
    <div class="email-header">
        <div class="cancel-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
        <h1>Booking Cancelled</h1>
        <p>Your booking request has been cancelled due to non-payment</p>
    </div>

    <!-- Content -->
    <div class="email-content">
        <!-- Greeting -->
        <div class="greeting">
            <h2>Dear {{ $booking->full_name ?? 'Valued Customer' }},</h2>
            <p>We regret to inform you that your booking request has been automatically cancelled as the payment was not completed within the required timeframe.</p>
        </div>

        <!-- Alert Box -->
        <div class="alert-box">
            <p><strong>⚠️ Important Notice:</strong> Your booking has been cancelled because we did not receive the payment confirmation. The seats have been released and are now available for other customers.</p>
        </div>

        <!-- Booking Details -->
        <div class="details-card">
            <div class="details-title">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                Booking Details
            </div>

            <div class="detail-row">
                <span class="detail-label">Booking ID</span>
                <span class="detail-value">#{{ $booking->id ?? 'N/A' }}</span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Package Name</span>
                <span class="detail-value">{{ $booking->package->title ?? 'N/A' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Destination</span>
                <span class="detail-value">{{ $booking->package->start_location." to ".$booking->package->end_location ?? 'N/A' }}</span>
            </div>


            <div class="detail-row" style="margin-top: 10px; padding-top: 15px; border-top: 2px solid #e2e8f0;">
                <span class="detail-label" style="font-size: 16px;">Total Amount</span>
                <span class="amount-value">{{ config('app.currency', 'BDT') }} {{ number_format($booking->total_amount ?? 0, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="email-footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name', 'Bus Ticket System') }}. All rights reserved.</p>
        <p>This is an automated message, please do not reply to this email.</p>
        <div class="social-links">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                </svg>
            </a>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
                </svg>
            </a>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/>
                    <path d="M7 2v20M17 2v20M2 12h20M2 7h5M2 17h5M17 17h5M17 7h5"/>
                </svg>
            </a>
        </div>
    </div>
</div>
</body>
</html>
