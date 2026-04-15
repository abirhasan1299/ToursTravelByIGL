{{-- resources/views/bus/checkout.blade.php --}}
@extends('layout.theme')
@section('title', 'Checkout - Complete Your Booking')

@push('css')
    <style>
        :root {
            --primary-color: #63AB45;
            --primary-dark: #4f9234;
            --secondary-color: #ff6b6b;
            --dark-color: #2c3e50;
            --light-bg: #f8faf7;
            --border-color: #e9ecef;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 5px 20px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.12);
        }

        /* Checkout Section */
        .checkout-section {
            padding: 120px 0 80px;
            background: linear-gradient(135deg, #f8faf7 0%, #ffffff 100%);
            min-height: 100vh;
        }

        .checkout-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .checkout-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .checkout-header h1 {
            font-size: 36px;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .checkout-header h1 span {
            color: var(--primary-color);
        }

        .checkout-header p {
            font-size: 16px;
            color: #666;
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 40px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .step-number {
            width: 45px;
            height: 45px;
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            color: #999;
            transition: all 0.3s ease;
        }

        .step.active .step-number {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .step.completed .step-number {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
        }

        .step.completed .step-number::after {
            content: '✓';
            font-size: 20px;
        }

        .step.completed .step-number span {
            display: none;
        }

        .step-text {
            font-weight: 600;
            color: #333;
        }

        .step.active .step-text {
            color: var(--primary-color);
        }

        .step-line {
            width: 80px;
            height: 2px;
            background: var(--border-color);
        }

        /* Main Content Grid */
        .checkout-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 30px;
        }

        /* Left Column - Booking Summary */
        .booking-summary {
            background: white;
            border-radius: 24px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .summary-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            padding: 20px 25px;
            color: white;
        }

        .summary-header h3 {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .summary-header p {
            margin: 5px 0 0;
            font-size: 13px;
            opacity: 0.9;
        }

        .bus-info-details {
            padding: 25px;
            border-bottom: 1px solid var(--border-color);
            background: var(--light-bg);
        }

        .bus-title {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .bus-icon {
            width: 55px;
            height: 55px;
            background: rgba(99, 171, 69, 0.1);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bus-icon i {
            font-size: 28px;
            color: var(--primary-color);
        }

        .bus-title h4 {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }

        .bus-title p {
            margin: 5px 0 0;
            font-size: 13px;
            color: #666;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px dashed var(--border-color);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #666;
            font-size: 14px;
        }

        .info-value {
            font-weight: 600;
            color: #333;
        }

        /* Selected Seats List */
        .seats-list {
            padding: 25px;
            border-bottom: 1px solid var(--border-color);
        }

        .seats-list h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .seats-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }

        .seat-item {
            background: var(--light-bg);
            border: 1.5px solid var(--primary-color);
            border-radius: 12px;
            padding: 10px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .seat-item i {
            color: var(--primary-color);
            font-size: 16px;
        }

        .seat-code {
            font-weight: 800;
            font-size: 18px;
            color: var(--primary-color);
        }

        .seat-number {
            font-size: 13px;
            color: #666;
        }

        /* Price Breakdown */
        .price-breakdown {
            padding: 25px;
            background: var(--light-bg);
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
        }

        .price-row.total {
            border-top: 2px solid var(--border-color);
            margin-top: 10px;
            padding-top: 20px;
            font-size: 20px;
            font-weight: 800;
        }

        .price-row.total .info-value {
            color: var(--primary-color);
            font-size: 24px;
        }

        /* Right Column - Payment Section */
        .payment-section {
            background: white;
            border-radius: 24px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            border: 1px solid var(--border-color);
        }

        .payment-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            padding: 20px 25px;
            color: white;
        }

        .payment-header h3 {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Payment Methods */
        .payment-methods {
            padding: 25px;
        }

        .method-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
        }

        .payment-option {
            border: 2px solid var(--border-color);
            border-radius: 16px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .payment-option:hover {
            border-color: var(--primary-color);
            box-shadow: var(--shadow-sm);
        }

        .payment-option.selected {
            border-color: var(--primary-color);
            background: rgba(99, 171, 69, 0.02);
        }

        .option-radio {
            display: flex;
            align-items: center;
            padding: 20px;
            cursor: pointer;
        }

        .option-radio input {
            width: 20px;
            height: 20px;
            margin-right: 15px;
            cursor: pointer;
            accent-color: var(--primary-color);
        }

        .option-content {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .option-icon {
            width: 50px;
            height: 50px;
            background: rgba(99, 171, 69, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .option-icon i {
            font-size: 28px;
        }

        .option-icon.cod i {
            color: #ff6b6b;
        }

        .option-icon.bkash i {
            color: #e2136e;
        }

        .option-text h5 {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }

        .option-text p {
            font-size: 12px;
            color: #666;
            margin: 5px 0 0;
        }

        /* Bkash Details Form */
        .bkash-details {
            padding: 0 20px 20px 55px;
            display: none;
        }

        .bkash-details.show {
            display: block;
        }

        .bkash-info {
            background: rgba(226, 19, 110, 0.05);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .bkash-number {
            font-size: 20px;
            font-weight: 700;
            color: #e2136e;
            text-align: center;
            margin-bottom: 10px;
        }

        .bkash-number small {
            font-size: 12px;
            font-weight: 400;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 171, 69, 0.1);
        }

        /* Customer Information Form */
        .customer-form {
            padding: 0 25px 25px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        /* Terms Checkbox */
        .terms-checkbox {
            padding: 20px 25px;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .checkbox-label input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--primary-color);
        }

        .checkbox-label span {
            font-size: 14px;
            color: #666;
        }

        .checkbox-label a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        /* Confirm Button */
        .confirm-btn {
            width: calc(100% - 50px);
            margin: 25px;
            padding: 18px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 60px;
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(99, 171, 69, 0.3);
        }

        .confirm-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(99, 171, 69, 0.4);
        }

        .confirm-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Alert Messages */
        .alert-message {
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }

        .alert-error {
            background: rgba(255, 71, 87, 0.1);
            border: 1px solid rgba(255, 71, 87, 0.3);
            color: #ff4757;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .checkout-grid {
                grid-template-columns: 1fr;
            }
            .step-line {
                width: 40px;
            }
        }

        @media (max-width: 768px) {
            .checkout-section {
                padding: 100px 0 60px;
            }
            .checkout-header h1 {
                font-size: 28px;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
            .progress-steps {
                gap: 10px;
            }
            .step-text {
                display: none;
            }
            .step-line {
                width: 30px;
            }
        }

        @media (max-width: 480px) {
            .option-content {
                flex-direction: column;
                text-align: center;
            }
            .bkash-details {
                padding: 0 15px 15px 15px;
            }
        }
    </style>
@endpush

@section('content')
    @php
        // Parse the data if not already passed from controller
        $selectedSeats = $selectedSeats ?? json_decode(request()->query('seats'), true);
        $seatCodes = $seatCodes ?? json_decode(request()->query('seat_codes'), true);
        $seatNumbers = $seatNumbers ?? json_decode(request()->query('seat_numbers'), true);
        $totalSeats = $total_seats ?? request()->query('total_seats');
        $totalAmount = $total_amount ?? request()->query('total_amount');
        $busId = request()->query('bus_id');
        $packageId = request()->query('package_id');

        // Calculate prices
        $seatPrice = $selectedSeats[0]['price'] ?? 43;
        $subtotal = $totalAmount;
        $vat = $subtotal * 0.05;
        $totalWithVat = $subtotal + $vat;
    @endphp
    <section class="checkout-section">
        <div class="container checkout-container">
            {{-- Header --}}
            <div class="checkout-header wow fadeInUp" data-wow-duration="1500ms">
                <h1>Complete Your <span>Booking</span></h1>
                <p>Review your booking details and proceed with payment</p>
            </div>

            {{-- Progress Steps --}}
            <div class="progress-steps wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                <div class="step completed">
                    <div class="step-number"><span>1</span></div>
                    <div class="step-text">Select Seats</div>
                </div>
                <div class="step-line"></div>
                <div class="step active">
                    <div class="step-number"><span>2</span></div>
                    <div class="step-text">Checkout</div>
                </div>
                <div class="step-line"></div>
                <div class="step">
                    <div class="step-number"><span>3</span></div>
                    <div class="step-text">Confirmation</div>
                </div>
            </div>

            {{-- Alert Area --}}
            <div id="alertArea"></div>

            {{-- Checkout Grid --}}
            <div class="checkout-grid">
                {{-- Left Column - Booking Summary --}}
                <div class="booking-summary wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                    <div class="summary-header">
                        <h3>
                            <i class="fas fa-receipt"></i>
                            Booking Summary
                        </h3>
                        <p>Review your booking details</p>
                    </div>

                    <div class="bus-info-details">
                        <div class="bus-title">
                            <div class="bus-icon">
                                <i class="fas fa-bus"></i>
                            </div>
                            <div>
                                <h4>{{ $busInfo->name }}</h4>
                                <p>{{ $busInfo->bus_type ?? 'AC Coach' }} • {{ $busInfo->total_seat }} Seats</p>
                            </div>
                        </div>

                        <div class="info-row">
                            <span class="info-label"><i class="fas fa-map-marker-alt"></i> Start Location</span>
                            <span class="info-value">{{ $startLocation ?? 'Dhaka' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="fas fa-flag-checkered"></i> End Location</span>
                            <span class="info-value">{{ $endLocation ?? 'Cox\'s Bazar' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="fas fa-calendar"></i> Journey Date</span>
                            <span class="info-value">{{ date('F d, Y', strtotime($journeyDate ?? 'now')) }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label"><i class="fas fa-clock"></i> Departure Time</span>
                            <span class="info-value">{{ $departureTime ?? '08:00 AM' }}</span>
                        </div>
                    </div>

                    <div class="seats-list">
                        <h4>
                            <i class="fas fa-chair"></i>
                            Selected Seats ({{ count($selectedSeats) }})
                        </h4>
                        <div class="seats-grid" id="seatsGrid">
                            @foreach($selectedSeats as $seat)
                                <div class="seat-item">
                                    <i class="fas fa-chair"></i>
                                    <span class="seat-code">{{ $seat['code'] }}</span>
                                    <span class="seat-number">Seat #{{ $seat['number'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="price-breakdown">
                        <div class="price-row">
                            <span class="info-label">Ticket Price</span>
                            <span class="info-value">৳ {{ number_format($seatPrice) }} × {{ count($selectedSeats) }}</span>
                        </div>
                        <div class="price-row">
                            <span class="info-label">Subtotal</span>
                            <span class="info-value">৳ {{ number_format($subtotal) }}</span>
                        </div>
                        <div class="price-row">
                            <span class="info-label">VAT (5%)</span>
                            <span class="info-value">৳ {{ number_format($vat) }}</span>
                        </div>
                        <div class="price-row total">
                            <span class="info-label">Total Amount</span>
                            <span class="info-value">৳ {{ number_format($totalAmount) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Right Column - Payment Section --}}
                <div class="payment-section wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                    <div class="payment-header">
                        <h3>
                            <i class="fas fa-credit-card"></i>
                            Payment Method
                        </h3>
                        <p>Choose your preferred payment option</p>
                    </div>

                    <form id="checkoutForm" action="{{ route('bkash.pay') }}" method="get">
                        @csrf
                        <input type="hidden" name="bus_id" value="{{ $busInfo->id }}">
                        <input type="hidden" name="package_id" value="{{ $packageId ?? 0 }}">
                        <input type="hidden" name="selected_seats" value="{{ json_encode($selectedSeats) }}">
                        <input type="hidden" name="total_amount" value="{{ $totalAmount }}">
                        <input type="hidden" name="seat_codes" value="{{ json_encode(array_column($selectedSeats, 'code')) }}">
                        <input type="hidden" name="seat_numbers" value="{{ json_encode(array_column($selectedSeats, 'number')) }}">

                        <div class="payment-methods">
                            <div class="method-title">Select Payment Method</div>

                            {{-- Cash on Delivery Option --}}
                            <div class="payment-option" onclick="selectPayment('cod')">
                                <label class="option-radio">
                                    <input type="radio" name="payment_method" value="cod" id="codRadio" checked>
                                    <div class="option-content">
                                        <div class="option-icon cod">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                        <div class="option-text">
                                            <h5>Cash on Delivery (COD)</h5>
                                            <p>Pay when you receive your ticket</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            {{-- Bkash Option --}}
                            <div class="payment-option" onclick="selectPayment('bkash')">
                                <label class="option-radio">
                                    <input type="radio" name="payment_method" value="bkash" id="bkashRadio">
                                    <div class="option-content">
                                        <div class="option-icon bkash">
                                            <i class="fab fa-bkash"></i>
                                        </div>
                                        <div class="option-text">
                                            <h5>bKash Mobile Banking</h5>
                                            <p>Pay using bKash mobile wallet</p>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            {{-- Bkash Details Form --}}
                            <div class="bkash-details" id="bkashDetails">
                                <div class="bkash-info">
                                    <div class="bkash-number">
                                        017XXXXXXXX
                                        <small>(Merchant bKash Number)</small>
                                    </div>
                                    <p style="font-size: 12px; text-align: center; margin: 0;">
                                        <i class="fas fa-info-circle"></i> Send the amount to this number and enter the transaction ID below
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Transaction ID <span style="color: red;">*</span></label>
                                    <input type="text" name="transaction_id" id="transactionId" placeholder="Enter bKash transaction ID">
                                    <small style="font-size: 11px; color: #666;">Example: 8F7G9H2J1K</small>
                                </div>
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="tel" name="bkash_number" id="bkashNumber" placeholder="Enter your bKash number">
                                </div>
                            </div>
                        </div>

                        {{-- Customer Information --}}
                        <div class="customer-form">
                            <div class="method-title" style="margin-top: 0;">Passenger Information</div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Full Name <span style="color: red;">*</span></label>
                                    <input type="text" name="customer_name" required placeholder="Enter your full name">
                                </div>
                                <div class="form-group">
                                    <label>Email Address <span style="color: red;">*</span></label>
                                    <input type="email" name="customer_email" required placeholder="your@email.com">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Phone Number <span style="color: red;">*</span></label>
                                    <input type="tel" name="customer_phone" required placeholder="01XXXXXXXXX">
                                </div>
                                <div class="form-group">
                                    <label>NID / Passport (Optional)</label>
                                    <input type="text" name="customer_nid" placeholder="Enter your NID number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Special Requests (Optional)</label>
                                <textarea name="special_requests" rows="3" placeholder="Any special requests or requirements?"></textarea>
                            </div>
                        </div>

                        {{-- Terms & Conditions --}}
                        <div class="terms-checkbox">
                            <label class="checkbox-label">
                                <input type="checkbox" id="termsCheckbox" required>
                                <span>I agree to the <a href="#">Terms & Conditions</a> and <a href="#">Cancellation Policy</a></span>
                            </label>
                        </div>

                        {{-- Confirm Button --}}
                        <button type="submit" class="confirm-btn" id="confirmBtn" disabled>
                            <span>Confirm Booking</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        // Payment method selection
        function selectPayment(method) {
            const codRadio = document.getElementById('codRadio');
            const bkashRadio = document.getElementById('bkashRadio');
            const bkashDetails = document.getElementById('bkashDetails');

            if (method === 'cod') {
                codRadio.checked = true;
                bkashDetails.classList.remove('show');

                // Remove required from bkash fields
                document.getElementById('transactionId').removeAttribute('required');
                document.getElementById('bkashNumber').removeAttribute('required');
            } else {
                bkashRadio.checked = true;
                bkashDetails.classList.add('show');

                // Add required to bkash fields when selected
                document.getElementById('transactionId').setAttribute('required', 'required');
                document.getElementById('bkashNumber').setAttribute('required', 'required');
            }

            // Update active state
            document.querySelectorAll('.payment-option').forEach(option => {
                option.classList.remove('selected');
            });
            event.currentTarget.classList.add('selected');
        }

        // Terms checkbox handler
        const termsCheckbox = document.getElementById('termsCheckbox');
        const confirmBtn = document.getElementById('confirmBtn');

        termsCheckbox.addEventListener('change', function() {
            confirmBtn.disabled = !this.checked;
        });

        // Form validation
        const checkoutForm = document.getElementById('checkoutForm');

        checkoutForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

            if (paymentMethod === 'bkash') {
                const transactionId = document.getElementById('transactionId').value;
                const bkashNumber = document.getElementById('bkashNumber').value;

                if (!transactionId || transactionId.length < 8) {
                    showAlert('Please enter a valid bKash transaction ID', 'error');
                    return;
                }

                if (!bkashNumber || bkashNumber.length < 11) {
                    showAlert('Please enter a valid bKash mobile number', 'error');
                    return;
                }
            }

            // Validate customer information
            const customerName = document.querySelector('input[name="customer_name"]').value;
            const customerEmail = document.querySelector('input[name="customer_email"]').value;
            const customerPhone = document.querySelector('input[name="customer_phone"]').value;

            if (!customerName) {
                showAlert('Please enter your full name', 'error');
                return;
            }

            if (!customerEmail || !customerEmail.includes('@')) {
                showAlert('Please enter a valid email address', 'error');
                return;
            }

            if (!customerPhone || customerPhone.length < 11) {
                showAlert('Please enter a valid phone number', 'error');
                return;
            }

            // Show loading state
            confirmBtn.disabled = true;
            confirmBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

            // Submit the form
            this.submit();
        });

        // Show alert message
        function showAlert(message, type = 'error') {
            const alertArea = document.getElementById('alertArea');
            const alertClass = type === 'error' ? 'alert-error' : 'alert-success';
            const icon = type === 'error' ? 'fa-exclamation-circle' : 'fa-check-circle';

            alertArea.innerHTML = `
            <div class="alert-message ${alertClass}">
                <i class="fas ${icon}"></i>
                <span>${message}</span>
            </div>
        `;

            setTimeout(() => {
                alertArea.innerHTML = '';
            }, 4000);
        }

        // Set initial payment method
        document.querySelector('.payment-option').classList.add('selected');

        // WOW animations
        if (typeof WOW !== 'undefined') {
            new WOW().init();
        }
    </script>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#63AB45'
            });
        </script>
    @endif
@endpush
