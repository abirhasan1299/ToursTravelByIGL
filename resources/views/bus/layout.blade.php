
{{-- resources/views/bus/layout.blade.php --}}
@extends('layout.theme')
@section('title', 'Select Bus Seats - ' . $bus_info->name)

@push('css')
    <style>
        /* Bus Layout Section */
        .bus-layout-section {
            padding: 120px 0 80px;
            background: linear-gradient(180deg, #f8faf7 0%, #ffffff 100%);
            min-height: 100vh;
        }

        .bus-layout-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .bus-header {
            margin-bottom: 30px;
            text-align: center;
        }

        .bus-header__title {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .bus-header__title span {
            color: #63AB45;
        }

        .bus-header__subtitle {
            font-size: 14px;
            color: #666;
        }

        /* Main Content Layout - Two Columns */
        .main-content-wrapper {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        /* Left Column - Seat Layout */
        .left-column {
            flex: 2;
            min-width: 300px;
        }

        /* Right Column - Bus Details */
        .right-column {
            flex: 1;
            min-width: 300px;
        }

        /* Bus Card */
        .bus-card {
            background: #ffffff;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid rgba(99, 171, 69, 0.12);
            padding: 30px;
        }

        /* Selected Summary Card - Top Section */
        .selected-summary-card {
            background: linear-gradient(135deg, #fafdf8 0%, #f5faf2 100%);
            border-radius: 24px;
            border: 1px solid rgba(99, 171, 69, 0.15);
            padding: 25px 30px;
            margin-bottom: 30px;
        }

        .summary-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .summary-header h4 {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .summary-header h4 i {
            color: #63AB45;
            font-size: 22px;
        }

        .clear-seats-btn {
            padding: 10px 22px;
            background: rgba(255, 71, 87, 0.1);
            color: #ff4757;
            border: 1px solid rgba(255, 71, 87, 0.2);
            border-radius: 40px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .clear-seats-btn:hover {
            background: #ff4757;
            color: #ffffff;
        }

        .selected-seats-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
            min-height: 60px;
        }

        .selected-seat-tag {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 20px;
            background: #ffffff;
            border-radius: 50px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
            border: 1.5px solid rgba(99, 171, 69, 0.2);
        }

        .selected-seat-tag .tag-code {
            font-weight: 700;
            font-size: 16px;
            color: #63AB45;
        }

        .selected-seat-tag .tag-number {
            font-size: 13px;
            color: #888;
        }

        .selected-seat-tag i {
            color: #ff4757;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .selected-seat-tag i:hover {
            transform: scale(1.2);
        }

        .no-seats-message {
            color: #aaa;
            font-size: 15px;
            font-style: italic;
        }

        .summary-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 25px;
            border-top: 1.5px solid rgba(99, 171, 69, 0.15);
            flex-wrap: wrap;
            gap: 20px;
        }

        .total-price {
            display: flex;
            flex-direction: column;
        }

        .total-price__label {
            font-size: 13px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .total-price__amount {
            font-size: 34px;
            font-weight: 800;
            color: #63AB45;
            line-height: 1.2;
        }

        .total-price__amount small {
            font-size: 15px;
            font-weight: 400;
            color: #888;
        }

        .proceed-btn {
            padding: 18px 45px;
            background: linear-gradient(135deg, #63AB45 0%, #4f9234 100%);
            color: #ffffff;
            border: none;
            border-radius: 60px;
            font-size: 17px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(99, 171, 69, 0.3);
        }

        .proceed-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(99, 171, 69, 0.4);
        }

        .proceed-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .proceed-btn i {
            transition: transform 0.3s ease;
        }

        .proceed-btn:hover:not(:disabled) i {
            transform: translateX(6px);
        }

        /* Bus Info Card (Right Side) */
        .bus-info-card {
            background: #ffffff;
            border-radius: 24px;
            border: 1px solid rgba(99, 171, 69, 0.12);
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .bus-info-header {
            background: linear-gradient(135deg, #63AB45 0%, #4f9234 100%);
            padding: 20px;
            text-align: center;
        }

        .bus-info-header h3 {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
        }

        .bus-info-header p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.9);
            margin: 5px 0 0;
        }

        .bus-info-body {
            padding: 25px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background: rgba(99, 171, 69, 0.1);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .info-icon i {
            font-size: 24px;
            color: #63AB45;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .info-value small {
            font-size: 13px;
            font-weight: 400;
            color: #888;
        }

        /* Driver Special Section */
        .driver-special {
            background: rgba(52, 152, 219, 0.05);
            border-radius: 16px;
            padding: 15px;
            margin-top: 10px;
        }

        .driver-special .info-item {
            padding: 10px 0;
        }

        /* Legend */
        .seat-legend {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 30px;
            margin-bottom: 25px;
            flex-wrap: wrap;
            padding: 15px;
            background: #f8faf7;
            border-radius: 60px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 500;
            color: #555;
        }

        .legend-color {
            width: 35px;
            height: 35px;
            border-radius: 10px;
        }

        .legend-color.available {
            background: #ffffff;
            border: 2.5px solid #63AB45;
        }

        .legend-color.selected {
            background: #63AB45;
            border: 2.5px solid #63AB45;
        }

        .legend-color.booked {
            background: #ff4757;
            border: 2.5px solid #ff4757;
        }

        .legend-color.driver {
            background: #3498db;
            border: 2.5px solid #3498db;
        }

        /* Bus Layout Grid */
        .bus-layout {
            padding: 10px 0;
        }

        /* Front of Bus Indicator */
        .bus-front-indicator {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .bus-front-line {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        .line-decoration {
            flex: 1;
            height: 2px;
            background: linear-gradient(90deg, transparent, #63AB45, transparent);
        }

        .bus-front-text {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #63AB45;
            padding: 5px 20px;
            background: rgba(99, 171, 69, 0.08);
            border-radius: 30px;
        }

        /* Driver Seat Container */
        .driver-seat-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
            padding-right: 20px;
        }

        .driver-seat-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .driver-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #3498db;
        }

        .driver-seat {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #3498db;
            border: 3px solid #2980b9;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            cursor: default;
        }

        .driver-seat .seat-icon {
            font-size: 28px;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .driver-seat .seat-label {
            font-size: 12px;
            font-weight: 600;
            color: #ffffff;
            text-transform: uppercase;
        }

        /* Seat Grid */
        .seat-grid {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .seat-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .row-label {
            width: 45px;
            text-align: center;
            font-size: 15px;
            font-weight: 700;
            color: #888;
            text-transform: uppercase;
        }

        .seats-wrapper {
            display: flex;
            gap: 12px;
        }

        /* Seat Styles */
        .seat {
            width: 70px;
            height: 75px;
            border-radius: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            border: 2.5px solid transparent;
        }

        .seat:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .seat-available {
            background: #ffffff;
            border-color: #63AB45;
            box-shadow: 0 2px 8px rgba(99, 171, 69, 0.1);
        }

        .seat-available:hover {
            background: rgba(99, 171, 69, 0.05);
            border-color: #4f9234;
        }

        .seat-selected {
            background: #63AB45;
            border-color: #63AB45;
            box-shadow: 0 6px 20px rgba(99, 171, 69, 0.35);
        }

        .seat-selected .seat-number,
        .seat-selected .seat-code {
            color: #ffffff;
        }

        .seat-booked {
            background: #ff4757;
            border-color: #ff4757;
            cursor: not-allowed;
            opacity: 0.85;
        }

        .seat-booked:hover {
            transform: none;
            box-shadow: none;
        }

        .seat-booked .seat-number,
        .seat-booked .seat-code {
            color: #ffffff;
        }

        .seat-number {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            line-height: 1.3;
        }

        .seat-code {
            font-size: 12px;
            font-weight: 600;
            color: #888;
            text-transform: uppercase;
        }

        .seat-selected .seat-code,
        .seat-booked .seat-code {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Aisle Space */
        .aisle-space {
            width: 45px;
        }

        /* Back of Bus */
        .bus-back-indicator {
            text-align: center;
            margin-top: 25px;
        }

        .bus-back-text {
            font-size: 12px;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        /* Alert Styles */
        .alert-message {
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }

        .alert-warning {
            background: rgba(255, 165, 2, 0.1);
            border: 1px solid rgba(255, 165, 2, 0.3);
            color: #e67e22;
        }

        .alert-success {
            background: rgba(99, 171, 69, 0.1);
            border: 1px solid rgba(99, 171, 69, 0.3);
            color: #63AB45;
        }

        /* Responsive */
        @media (max-width: 1100px) {
            .seat {
                width: 60px;
                height: 65px;
            }
            .seat-number {
                font-size: 14px;
            }
            .seat-code {
                font-size: 11px;
            }
        }

        @media (max-width: 992px) {
            .main-content-wrapper {
                flex-direction: column;
            }
            .left-column, .right-column {
                width: 100%;
            }
            .seat {
                width: 55px;
                height: 60px;
            }
            .driver-seat {
                width: 60px;
                height: 60px;
            }
        }

        @media (max-width: 768px) {
            .bus-layout-section {
                padding: 100px 0 60px;
            }
            .bus-card {
                padding: 20px;
            }
            .selected-summary-card {
                padding: 20px;
            }
            .seat {
                width: 48px;
                height: 52px;
            }
            .seats-wrapper {
                gap: 8px;
            }
            .seat-row {
                gap: 8px;
            }
            .row-label {
                width: 35px;
                font-size: 13px;
            }
            .aisle-space {
                width: 30px;
            }
            .summary-footer {
                flex-direction: column;
                text-align: center;
            }
            .proceed-btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .seat {
                width: 42px;
                height: 48px;
            }
            .seats-wrapper {
                gap: 5px;
            }
            .seat-row {
                gap: 5px;
            }
            .legend-item {
                font-size: 11px;
            }
            .legend-color {
                width: 28px;
                height: 28px;
            }
            .driver-seat {
                width: 55px;
                height: 55px;
            }
            .driver-seat .seat-icon {
                font-size: 22px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="bus-layout-section" style="margin-top: -100px;">
        <div class="container bus-layout-container">
            {{-- Header --}}
            <div class="bus-header">
                <h1 class="bus-header__title wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                    Select Your <span>Seats</span>
                </h1>
                <p class="bus-header__subtitle wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                    {{ $bus_info->name }} • {{ $bus_info->total_seat }} Seats
                    {{-- Display max people limit --}}
                    @if(isset($max_people) && $max_people > 0)
                        • Max <strong>{{ $max_people }}</strong> {{ Str::plural('seat', $max_people) }}
                    @endif
                </p>
            </div>

            {{-- Alert Area --}}
            <div id="alertArea"></div>

            {{-- Selected Seats Summary - TOP SECTION --}}
            <div class="selected-summary-card wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="400ms">
                <div class="summary-header">
                    <h4>
                        <i class="fas fa-ticket-alt"></i>
                        Selected Seats (<span id="selectedCount">0</span>)
                        @if(isset($max_people) && $max_people > 0)
                            <span style="font-size: 14px; font-weight: normal; color: #666;">/ Max {{ $max_people }}</span>
                        @endif
                    </h4>
                    <button class="clear-seats-btn" id="clearSeatsBtn" onclick="clearAllSeats()">
                        <i class="fas fa-trash-alt"></i> Clear All
                    </button>
                </div>

                <div class="selected-seats-list" id="selectedSeatsList">
                    <span class="no-seats-message">No seats selected</span>
                </div>

                <div class="summary-footer">
                    <div class="total-price">
                        <span class="total-price__label">Total Amount</span>
                        <span class="total-price__amount">
                            ৳ <span id="totalPrice">0</span>
                            <small>/ total</small>
                        </span>
                    </div>
                    <button class="proceed-btn" id="proceedBtn" onclick="proceedToCheckout()" disabled>
                        <span>Proceed to Checkout</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>

            {{-- Main Content: Left (Seat Layout) + Right (Bus Details) --}}
            <div class="main-content-wrapper">
                {{-- Left Column - Seat Layout --}}
                <div class="left-column">
                    <div class="bus-card wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="500ms">
                        {{-- Legend --}}
                        <div class="seat-legend">
                            <div class="legend-item">
                                <div class="legend-color available"></div>
                                <span>Available</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color selected"></div>
                                <span>Selected</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color booked"></div>
                                <span>Booked</span>
                            </div>
                        </div>

                        {{-- Bus Layout --}}
                        <div class="bus-layout">
                            {{-- Front of Bus --}}
                            <div class="bus-front-indicator">
                                <div class="bus-front-line">
                                    <span class="line-decoration"></span>
                                    <span class="bus-front-text">
                                        <i class="fas fa-chevron-left"></i> FRONT <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="line-decoration"></span>
                                </div>
                            </div>

                            {{-- Seat Grid --}}
                            <div class="seat-grid" id="seatGrid">
                                {{-- Seats will be generated by JavaScript --}}
                            </div>

                            {{-- Back of Bus --}}
                            <div class="bus-back-indicator">
                                <span class="bus-back-text">
                                    <i class="fas fa-minus"></i> BACK <i class="fas fa-minus"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column - Bus Details --}}
                <div class="right-column">
                    <div class="bus-info-card wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="600ms">
                        <div class="bus-info-header">
                            <h3>{{ $bus_info->name }}</h3>
                            <p>{{ strtoupper($bus_info->bus_type) ?? 'AC Coach' }} • {{ $bus_info->total_seat }} Seats of Bus</p>
                        </div>

                        <div class="bus-info-body">
                            {{-- Driver Information --}}
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Guide Assistant</div>
                                    <div class="info-value">{{ $bus_info->driver_name ?? 'John Anderson' }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Experience</div>
                                    <div class="info-value">{{ $bus_info->driver_exp ?? '10' }}+ years</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-chair"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Total Seats</div>
                                    <div class="info-value">{{ $bus_info->total_seat }} seats</div>
                                </div>
                            </div>

                            {{-- Contact Information --}}
                            @if(isset($bus_info->contact_number) && $bus_info->contact_number)
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Contact Number</div>
                                        <div class="info-value">{{ $bus_info->contact_number }}</div>
                                    </div>
                                </div>
                            @endif

                            {{-- Status Badge --}}
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="info-content">
                                    <div class="info-label">Bus Status</div>
                                    <div class="info-value">
                                        @if($bus_info->status == 'active')
                                            <span style="color: #63AB45;">● OPEN</span>
                                        @elseif($bus_info->status == 'inactive')
                                            <span style="color: #ff4757;">● CLOSED</span>
                                        @else
                                            <span style="color: #f39c12;">● MAINTAINENCE</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Driver Special Notes --}}
                            <div class="driver-special">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="info-content">
                                        <div class="info-label">Special Note</div>
                                        <div class="info-value">
                                            <small>
                                                {{$bus_info->notes}}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        // Configuration from PHP
        const ROWS = {{ $bus_info->total_row ?? 10 }};
        const COLS = {{ $bus_info->total_column ?? 4 }};
        const SEAT_PRICE = {{ $package_info->amount ?? 0 }};
        const BUS_ID = {{ $bus_info->id }};
        const PACKAGE_ID = {{ request()->get('package_id') ? base64_decode(request()->get('package_id')) : 0 }};

        {{-- MAX PEOPLE LIMIT from database --}}
        const MAX_PEOPLE = {{ isset($package_info->max_people) && $package_info->max_people > 0 ? $package_info->max_people : 999 }};

        // Row labels (A-J for 10 rows)
        const ROW_LABELS = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O'];

        // Already booked seats from database
        const BOOKED_SEATS = @json($bookedSeats ?? []);

        // Selected seats storage
        let selectedSeats = [];

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            generateSeatLayout();
            updateSelectedDisplay();
        });

        // Generate seat layout
        function generateSeatLayout() {
            const seatGrid = document.getElementById('seatGrid');
            seatGrid.innerHTML = '';

            for (let row = 0; row < ROWS; row++) {
                const rowLabel = ROW_LABELS[row];
                const rowDiv = document.createElement('div');
                rowDiv.className = 'seat-row';

                // Row label
                const labelDiv = document.createElement('div');
                labelDiv.className = 'row-label';
                labelDiv.textContent = rowLabel;
                rowDiv.appendChild(labelDiv);

                // Left side seats (2 seats)
                const leftSeatsWrapper = document.createElement('div');
                leftSeatsWrapper.className = 'seats-wrapper';

                for (let col = 0; col < 2; col++) {
                    const seatNumber = (row * 4 + col + 1);
                    const seatCode = rowLabel + (col + 1);
                    leftSeatsWrapper.appendChild(createSeatElement(seatNumber, seatCode, row, col));
                }
                rowDiv.appendChild(leftSeatsWrapper);

                // Aisle space
                const aisleDiv = document.createElement('div');
                aisleDiv.className = 'aisle-space';
                rowDiv.appendChild(aisleDiv);

                // Right side seats (2 seats)
                const rightSeatsWrapper = document.createElement('div');
                rightSeatsWrapper.className = 'seats-wrapper';

                for (let col = 2; col < 4; col++) {
                    const seatNumber = (row * 4 + col + 1);
                    const seatCode = rowLabel + (col + 1);
                    rightSeatsWrapper.appendChild(createSeatElement(seatNumber, seatCode, row, col));
                }
                rowDiv.appendChild(rightSeatsWrapper);

                seatGrid.appendChild(rowDiv);
            }
        }

        // Create individual seat element
        function createSeatElement(seatNumber, seatCode, row, col) {
            const seatDiv = document.createElement('div');
            seatDiv.className = 'seat';
            seatDiv.dataset.seatNumber = seatNumber;
            seatDiv.dataset.seatCode = seatCode;
            seatDiv.dataset.row = row;
            seatDiv.dataset.col = col;

            // Check if seat is already booked
            if (BOOKED_SEATS.includes(seatCode)) {
                seatDiv.classList.add('seat-booked');
                seatDiv.onclick = null;
            } else {
                seatDiv.classList.add('seat-available');
                seatDiv.onclick = function() { toggleSeat(this); };
            }

            // Seat number display
            const numberSpan = document.createElement('span');
            numberSpan.className = 'seat-number';
            numberSpan.textContent = seatNumber;
            seatDiv.appendChild(numberSpan);

            // Seat code display (A1, A2, etc.)
            const codeSpan = document.createElement('span');
            codeSpan.className = 'seat-code';
            codeSpan.textContent = seatCode;
            seatDiv.appendChild(codeSpan);

            return seatDiv;
        }

        // Toggle seat selection with MAX_PEOPLE limit
        function toggleSeat(seatElement) {
            const seatCode = seatElement.dataset.seatCode;
            const seatNumber = parseInt(seatElement.dataset.seatNumber);

            if (seatElement.classList.contains('seat-booked')) {
                showAlert('This seat is already booked!', 'warning');
                return;
            }

            if (seatElement.classList.contains('seat-selected')) {
                // Deselect
                seatElement.classList.remove('seat-selected');
                seatElement.classList.add('seat-available');
                selectedSeats = selectedSeats.filter(s => s.code !== seatCode);
            } else {
                // Check MAX_PEOPLE limit before selecting
                if (selectedSeats.length >= MAX_PEOPLE) {
                    // Show SweetAlert for max limit reached
                    Swal.fire({
                        icon: 'warning',
                        title: 'Maximum Seats Reached',
                        text: `You can only select up to ${MAX_PEOPLE} seat${MAX_PEOPLE > 1 ? 's' : ''} per booking.`,
                        confirmButtonColor: '#63AB45',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Select
                seatElement.classList.remove('seat-available');
                seatElement.classList.add('seat-selected');
                selectedSeats.push({
                    code: seatCode,
                    number: seatNumber,
                    price: SEAT_PRICE
                });
            }

            updateSelectedDisplay();
        }

        // Update selected seats display
        function updateSelectedDisplay() {
            const selectedList = document.getElementById('selectedSeatsList');
            const selectedCount = document.getElementById('selectedCount');
            const totalPriceSpan = document.getElementById('totalPrice');
            const proceedBtn = document.getElementById('proceedBtn');

            // Update count
            selectedCount.textContent = selectedSeats.length;

            // Update list
            if (selectedSeats.length === 0) {
                selectedList.innerHTML = '<span class="no-seats-message">No seats selected</span>';
                proceedBtn.disabled = true;
            } else {
                let html = '';
                // Sort by seat code
                const sortedSeats = [...selectedSeats].sort((a, b) => a.code.localeCompare(b.code));

                sortedSeats.forEach(seat => {
                    html += `
                        <div class="selected-seat-tag">
                            <span class="tag-code">${seat.code}</span>
                            <span class="tag-number">Seat #${seat.number}</span>
                            <i class="fas fa-times-circle" onclick="removeSeat('${seat.code}')"></i>
                        </div>
                    `;
                });
                selectedList.innerHTML = html;
                proceedBtn.disabled = false;
            }

            // Update total price
            const totalPrice = selectedSeats.length * SEAT_PRICE;
            totalPriceSpan.textContent = totalPrice.toLocaleString();
        }

        // Remove single seat
        function removeSeat(seatCode) {
            const seatElement = document.querySelector(`[data-seat-code="${seatCode}"]`);
            if (seatElement) {
                seatElement.classList.remove('seat-selected');
                seatElement.classList.add('seat-available');
            }

            selectedSeats = selectedSeats.filter(s => s.code !== seatCode);
            updateSelectedDisplay();
        }

        // Clear all selected seats
        function clearAllSeats() {
            document.querySelectorAll('.seat-selected').forEach(seat => {
                seat.classList.remove('seat-selected');
                seat.classList.add('seat-available');
            });

            selectedSeats = [];
            updateSelectedDisplay();
            showAlert('All seats cleared', 'success');
        }

        // Show alert message
        function showAlert(message, type = 'warning') {
            const alertArea = document.getElementById('alertArea');
            const alertClass = type === 'warning' ? 'alert-warning' : 'alert-success';
            const icon = type === 'warning' ? 'fa-exclamation-circle' : 'fa-check-circle';

            alertArea.innerHTML = `
                <div class="alert-message ${alertClass}">
                    <i class="fas ${icon}"></i>
                    <span>${message}</span>
                </div>
            `;

            setTimeout(() => {
                alertArea.innerHTML = '';
            }, 3000);
        }

        // Proceed to checkout
        function proceedToCheckout() {
            if (selectedSeats.length === 0) {
                showAlert('Please select at least one seat', 'warning');
                return;
            }

            // Prepare booking data
            const bookingData = {
                bus_id: BUS_ID,
                package_id: PACKAGE_ID,
                seats: selectedSeats,
                total_seats: selectedSeats.length,
                total_amount: selectedSeats.length * SEAT_PRICE,
                seat_codes: selectedSeats.map(s => s.code),
                seat_numbers: selectedSeats.map(s => s.number)
            };

            // Submit via form
            submitBookingForm(bookingData);
        }

        // Submit booking form
        function submitBookingForm(bookingData) {
            const form = document.createElement('form');
            form.method = 'GET';
            form.action = '{{ route("bus.checkout") }}';

            // CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            // Add all booking data
            for (const [key, value] of Object.entries(bookingData)) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = typeof value === 'object' ? JSON.stringify(value) : value;
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit();
        }

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

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#63AB45'
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#63AB45'
            });
        </script>
    @endif
@endpush

