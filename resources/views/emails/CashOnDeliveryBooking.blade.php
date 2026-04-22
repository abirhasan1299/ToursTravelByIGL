<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - Cash on Delivery | {{ $booking->invoice_number ?? '#' . $booking->id }}</title>
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
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        /* Main Container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        /* Header Section */
        .email-header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
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

        .logo {
            font-size: 52px;
            margin-bottom: 10px;
            position: relative;
        }

        .email-header h1 {
            font-size: 28px;
            font-weight: 700;
            margin: 10px 0 5px;
            letter-spacing: -0.5px;
            position: relative;
        }

        .email-header p {
            font-size: 14px;
            opacity: 0.95;
            margin: 0;
            position: relative;
        }

        .cod-badge {
            display: inline-block;
            padding: 8px 24px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 700;
            margin-top: 15px;
            background: #ffffff;
            color: #d97706;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            position: relative;
        }

        /* Content Sections */
        .email-content {
            padding: 35px 30px;
        }

        .greeting {
            margin-bottom: 25px;
            text-align: center;
        }

        .greeting h2 {
            color: #1e293b;
            font-size: 24px;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .greeting p {
            color: #64748b;
            font-size: 15px;
        }

        /* Info Cards */
        .info-card {
            background: #ffffff;
            border-radius: 16px;
            margin-bottom: 25px;
            border: 1px solid #e9ecef;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .card-header {
            background: #f8fafc;
            padding: 15px 20px;
            border-bottom: 2px solid #f59e0b;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            font-size: 22px;
        }

        .card-body {
            padding: 20px;
        }

        .info-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            width: 130px;
            font-weight: 600;
            color: #475569;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            flex: 1;
            color: #1e293b;
            font-size: 15px;
            font-weight: 500;
        }

        /* Seat Grid */
        .seat-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 5px;
        }

        .seat-badge {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 6px rgba(245,158,11,0.3);
        }

        /* Amount Box - COD Style */
        .amount-box {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            padding: 25px;
            border-radius: 16px;
            text-align: center;
            margin: 20px 0;
            border: 2px dashed #f59e0b;
        }

        .amount-label {
            font-size: 14px;
            color: #92400e;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .amount-value {
            font-size: 42px;
            font-weight: 800;
            color: #d97706;
            letter-spacing: -1px;
        }

        .payment-note {
            font-size: 13px;
            color: #78350f;
            margin-top: 10px;
            font-weight: 500;
        }

        /* COD Instruction Box */
        .cod-instruction {
            background: #fefce8;
            border-left: 4px solid #f59e0b;
            padding: 18px;
            border-radius: 12px;
            margin: 20px 0;
        }

        .instruction-title {
            font-weight: 700;
            color: #92400e;
            font-size: 15px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .instruction-list {
            margin-left: 20px;
            color: #78350f;
            font-size: 13px;
            line-height: 1.8;
        }

        .instruction-list li {
            margin-bottom: 5px;
        }

        /* Summary Box */
        .summary-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 15px;
            margin: 20px 0;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 14px;
        }

        .summary-label {
            color: #64748b;
            font-weight: 500;
        }

        .summary-value {
            color: #1e293b;
            font-weight: 700;
        }

        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 10px 0;
        }

        /* Button */
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            text-decoration: none;
            padding: 14px 35px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 14px;
            margin: 15px 0;
            text-align: center;
            box-shadow: 0 4px 12px rgba(245,158,11,0.3);
            transition: all 0.3s ease;
        }

        /* Support Box */
        .support-box {
            background: #f0fdf4;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            margin: 20px 0;
        }

        /* Footer */
        .email-footer {
            background: #1e293b;
            padding: 30px;
            text-align: center;
            color: white;
        }

        .footer-text {
            color: #94a3b8;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .footer-links {
            margin: 15px 0;
        }

        .footer-links a {
            color: #f59e0b;
            text-decoration: none;
            font-size: 13px;
            margin: 0 10px;
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
                font-size: 32px;
            }

            .card-title {
                font-size: 16px;
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
<body style="margin: 0; padding: 20px 0; background-color: #f0f2f5; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#f0f2f5">
    <tr>
        <td align="center" style="padding: 20px 10px;">
            <div class="email-container" style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">

                <!-- Header with COD Badge -->
                <div class="email-header" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 40px 30px; text-align: center; color: white; position: relative;">
                    <div class="logo" style="font-size: 52px; margin-bottom: 10px; position: relative;">🚌</div>
                    <h1 style="font-size: 28px; font-weight: 700; margin: 10px 0 5px; letter-spacing: -0.5px; position: relative;">Booking Confirmed!</h1>
                    <p style="font-size: 14px; opacity: 0.95; margin: 0; position: relative;">Your seats have been reserved</p>
                    <div class="cod-badge" style="display: inline-block; padding: 8px 24px; border-radius: 50px; font-size: 14px; font-weight: 700; margin-top: 15px; background: #ffffff; color: #d97706; box-shadow: 0 4px 12px rgba(0,0,0,0.1); position: relative;">
                        💰 CASH ON DELIVERY
                    </div>
                </div>

                <!-- Content -->
                <div class="email-content" style="padding: 35px 30px;">

                    <!-- Greeting -->
                    <div class="greeting" style="margin-bottom: 25px; text-align: center;">
                        <h2 style="color: #1e293b; font-size: 24px; margin-bottom: 8px; font-weight: 700;">Hello {{ $booking->full_name ?? 'Valued Customer' }}! 👋</h2>
                        <p style="color: #64748b; font-size: 15px;">Thank you for booking with us. Your reservation is confirmed with Cash on Delivery.</p>
                    </div>

                    <!-- Booking Summary Card -->
                    <div class="info-card" style="background: #ffffff; border-radius: 16px; margin-bottom: 25px; border: 1px solid #e9ecef; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <div class="card-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 2px solid #f59e0b;">
                            <div class="card-title" style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px;">
                                <span>📋</span> Booking Summary
                            </div>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="info-row" style="display: flex; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                                <div class="info-label" style="width: 130px; font-weight: 600; color: #475569; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Booking ID:</div>
                                <div class="info-value" style="flex: 1; color: #1e293b; font-size: 15px; font-weight: 500;">
                                    <strong style="color: #f59e0b;">#{{ $booking->id }}</strong>
                                </div>
                            </div>

                            <div class="info-row" style="display: flex; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                                <div class="info-label" style="width: 130px; font-weight: 600; color: #475569; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Reference No:</div>
                                <div class="info-value" style="flex: 1; color: #1e293b; font-size: 15px; font-weight: 500;">
                                    {{ $booking->invoice_number ?? 'COD-' . $booking->id . '-' . date('Ymd') }}
                                </div>
                            </div>

                            <div class="info-row" style="display: flex; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                                <div class="info-label" style="width: 130px; font-weight: 600; color: #475569; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Booking Date:</div>
                                <div class="info-value" style="flex: 1; color: #1e293b; font-size: 15px; font-weight: 500;">
                                    {{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y, h:i A') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Details Card -->
                    <div class="info-card" style="background: #ffffff; border-radius: 16px; margin-bottom: 25px; border: 1px solid #e9ecef; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <div class="card-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 2px solid #f59e0b;">
                            <div class="card-title" style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px;">
                                <span>👤</span> Customer Details
                            </div>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="info-row" style="display: flex; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                                <div class="info-label" style="width: 130px; font-weight: 600; color: #475569; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Full Name:</div>
                                <div class="info-value" style="flex: 1; color: #1e293b; font-size: 15px; font-weight: 500;">{{ $booking->full_name ?? 'N/A' }}</div>
                            </div>

                            <div class="info-row" style="display: flex; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                                <div class="info-label" style="width: 130px; font-weight: 600; color: #475569; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Email Address:</div>
                                <div class="info-value" style="flex: 1; color: #1e293b; font-size: 15px; font-weight: 500;">{{ $booking->email ?? 'N/A' }}</div>
                            </div>

                            <div class="info-row" style="display: flex; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                                <div class="info-label" style="width: 130px; font-weight: 600; color: #475569; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Phone Number:</div>
                                <div class="info-value" style="flex: 1; color: #1e293b; font-size: 15px; font-weight: 500;">{{ $booking->phone ?? 'N/A' }}</div>
                            </div>

                            @if($booking->nid)
                                <div class="info-row" style="display: flex; padding: 12px 0;">
                                    <div class="info-label" style="width: 130px; font-weight: 600; color: #475569; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">NID/Passport:</div>
                                    <div class="info-value" style="flex: 1; color: #1e293b; font-size: 15px; font-weight: 500;">{{ $booking->nid }}</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Seat Details Card -->
                    <div class="info-card" style="background: #ffffff; border-radius: 16px; margin-bottom: 25px; border: 1px solid #e9ecef; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <div class="card-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 2px solid #f59e0b;">
                            <div class="card-title" style="font-size: 18px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px;">
                                <span>💺</span> Seat Information
                            </div>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="info-row" style="display: flex; padding: 12px 0;">
                                <div class="info-label" style="width: 130px; font-weight: 600; color: #475569; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px;">Your Seats:</div>
                                <div class="info-value" style="flex: 1; color: #1e293b; font-size: 15px; font-weight: 500;">
                                    <div class="seat-grid" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 5px;">
                                        @php
                                            $seats = is_array($booking->seat_no) ? $booking->seat_no : json_decode($booking->seat_no, true);
                                            if(is_string($seats)) $seats = explode(',', $seats);
                                        @endphp
                                        @if(!empty($seats))
                                            @foreach($seats as $seat)
                                                <span class="seat-badge" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 8px 16px; border-radius: 12px; font-size: 14px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 6px rgba(245,158,11,0.3);">
                                                        🪑 {{ trim($seat) }}
                                                    </span>
                                            @endforeach
                                        @else
                                            {{ $booking->seat_no ?? 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Package & Journey Info -->
                    <div class="summary-box" style="background: #f8fafc; border-radius: 12px; padding: 15px; margin: 20px 0;">
                        <div class="summary-item" style="display: flex; justify-content: space-between; padding: 10px 0; font-size: 14px;">
                            <span class="summary-label" style="color: #64748b; font-weight: 500;">Package ID:</span>
                            <span class="summary-value" style="color: #1e293b; font-weight: 700;">{{ $booking->package->title ?? 'N/A' }}</span>
                        </div>

                        <div class="summary-item" style="display: flex; justify-content: space-between; padding: 10px 0; font-size: 14px;">
                            <span class="summary-label" style="color: #64748b; font-weight: 500;">Destination</span>
                            <span class="summary-value" style="color: #1e293b; font-weight: 700;">{{ $booking->package->start_location." to ".  $booking->package->end_location ?? 'N/A' }}</span>
                        </div>

                        <div class="summary-item" style="display: flex; justify-content: space-between; padding: 10px 0; font-size: 14px;">
                            <span class="summary-label" style="color: #64748b; font-weight: 500;">Payment Method:</span>
                            <span class="summary-value" style="color: #f59e0b; font-weight: 700;">Cash on Delivery (COD)</span>
                        </div>
                        <div class="summary-item" style="display: flex; justify-content: space-between; padding: 10px 0; font-size: 14px;">
                            <span class="summary-label" style="color: #64748b; font-weight: 500;">Pyment Status: </span>
                            <span class="summary-value" style="color: #f59e0b; font-weight: 700;">Pending</span>
                        </div>
                        @if($booking->is_coupon)
                            <div class="summary-item" style="display: flex; justify-content: space-between; padding: 10px 0; font-size: 14px;">
                                <span class="summary-label" style="color: #64748b; font-weight: 500;">Coupon Applied:</span>
                                <span class="summary-value" style="color: #1e293b; font-weight: 700;">{{ $booking->coupon_code }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Amount Box - COD -->
                    <div class="amount-box" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); padding: 25px; border-radius: 16px; text-align: center; margin: 20px 0; border: 2px dashed #f59e0b;">
                        <div class="amount-label" style="font-size: 14px; color: #92400e; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Amount to Pay (Cash on Delivery)</div>
                        <div class="amount-value" style="font-size: 42px; font-weight: 800; color: #d97706; letter-spacing: -1px;">
                            {{ $booking->currency ?? 'BDT' }} {{ number_format($booking->total_amount ?? 0, 2) }}
                        </div>
                        <div class="payment-note" style="font-size: 13px; color: #78350f; margin-top: 10px; font-weight: 500;">
                            💵 Please pay this amount in cash at the time of boarding
                        </div>
                    </div>

                    <!-- COD Instructions -->
                    <div class="cod-instruction" style="background: #fefce8; border-left: 4px solid #f59e0b; padding: 18px; border-radius: 12px; margin: 20px 0;">
                        <div class="instruction-title" style="font-weight: 700; color: #92400e; font-size: 15px; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                            <span>📌</span> Important Instructions for COD Payment
                        </div>
                        <ul class="instruction-list" style="margin-left: 20px; color: #78350f; font-size: 13px; line-height: 1.8;">
                            <li>✓ Keep your Booking ID ready: <strong>#{{ $booking->id }}</strong></li>
                            <li>✓ Carry a valid ID proof (NID/Passport) for verification</li>
                            <li>✓ Exact cash amount is appreciated to avoid change issues</li>
                            <li>✓ Arrive at least 30 minutes before departure time</li>
                            <li>✓ Present this email (digital or print) at the counter</li>
                            <li>✓ Payment is to be made directly to our representative</li>
                        </ul>
                    </div>

                    <!-- Special Request -->
                    @if($booking->any_request)
                        <div class="support-box" style="background: #f0fdf4; border-radius: 12px; padding: 15px; text-align: center; margin: 20px 0;">
                            <div style="display: flex; align-items: center; gap: 10px; justify-content: center;">
                                <span style="font-size: 24px;">📝</span>
                                <div>
                                    <div style="font-weight: 700; color: #166534; font-size: 14px;">Special Request</div>
                                    <div style="font-size: 13px; color: #14532d; margin-top: 5px;">"{{ $booking->any_request }}"</div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>


            </div>
        </td>
</table>


</body>
</html>
