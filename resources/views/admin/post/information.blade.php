@extends('layout.admin')
@section('title', 'Booking Information')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            --warning-gradient: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
            --danger-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        body {
            background: #f0f2f8;
        }

        /* Modern Card Design */
        .modern-card {
            background: #ffffff;
            border-radius: 24px;
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .modern-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.12);
        }

        /* Card Headers */
        .card-header-modern {
            background: var(--primary-gradient);
            padding: 20px 28px;
            border-bottom: none;
            position: relative;
            overflow: hidden;
        }

        .card-header-modern::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            pointer-events: none;
        }

        .card-header-modern h3 {
            margin: 0;
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .card-header-modern i {
            margin-right: 12px;
            font-size: 1.5rem;
        }

        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 15px;
        }

        .stat-label {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 5px;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            padding: 24px;
        }

        .info-item {
            padding: 12px 0;
            border-bottom: 1px solid #eef2f6;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .info-item-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-size: 16px;
            flex-shrink: 0;
        }

        .info-item-content {
            flex: 1;
        }

        .info-item-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            color: #94a3b8;
            margin-bottom: 4px;
        }

        .info-item-value {
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
            word-break: break-word;
        }

        /* Badge Styles */
        .badge-modern {
            padding: 8px 18px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            letter-spacing: 0.3px;
        }

        .badge-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(16,185,129,0.3);
        }

        .badge-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(245,158,11,0.3);
        }

        .badge-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(239,68,68,0.3);
        }

        .badge-info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            box-shadow: 0 2px 8px rgba(59,130,246,0.3);
        }

        .badge-secondary {
            background: linear-gradient(135deg, #64748b 0%, #475569 100%);
            color: white;
        }

        /* Seat Badges */
        .seat-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            padding: 6px 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: 14px;
            margin: 4px;
            box-shadow: 0 2px 6px rgba(102,126,234,0.3);
            transition: all 0.2s ease;
        }

        .seat-modern:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(102,126,234,0.4);
        }

        /* JSON Viewer */
        .json-viewer-modern {
            background: #0f172a;
            border-radius: 16px;
            padding: 20px;
            margin-top: 15px;
            position: relative;
            overflow-x: auto;
        }

        .json-viewer-modern pre {
            margin: 0;
            color: #e2e8f0;
            font-family: 'Courier New', 'Monaco', monospace;
            font-size: 12px;
            line-height: 1.6;
        }

        .copy-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255,255,255,0.1);
            border: none;
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .copy-btn:hover {
            background: rgba(255,255,255,0.2);
        }

        /* Timeline */
        .timeline-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid #eef2f6;
        }

        .timeline-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
        }

        .timeline-content {
            flex: 1;
        }

        .timeline-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .timeline-date {
            font-size: 12px;
            color: #94a3b8;
        }

        /* Amount Display */
        .amount-display {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 32px;
            font-weight: 800;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
                padding: 16px;
            }

            .stat-value {
                font-size: 22px;
            }
        }

        /* Print Styles */
        @media print {
            .modern-card {
                box-shadow: none;
                break-inside: avoid;
            }
            .btn, .copy-btn {
                display: none;
            }
        }

        /* Loading Animation */
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        /* Action Buttons */
        .action-buttons {
            position: sticky;
            top: 20px;
            z-index: 100;
        }

        .btn-modern {
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-4 py-4">

        @if(isset($booking) && $booking)
            <!-- Header with Actions -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <h1 class="display-6 fw-bold mb-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        <i class="fas fa-ticket-alt me-2"></i>Booking Details
                    </h1>
                </div>
            </div>

            <!-- Stats Overview -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%); color: #667eea;">
                            <i class="fas fa-hashtag"></i>
                        </div>
                        <div class="stat-label">Booking ID</div>
                        <div class="stat-value">#{{ $booking->id }}</div>
                        <small class="text-muted">Created {{ \Carbon\Carbon::parse($booking->created_at)->diffForHumans() }}</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #10b98120 0%, #05966920 100%); color: #10b981;">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-label">Total Amount</div>
                        <div class="stat-value">BDT {{ number_format($booking->total_amount, 2) }}</div>
                        <small class="text-muted">{{ $booking->method ?? 'N/A' }}</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b20 0%, #d9770620 100%); color: #f59e0b;">
                            <i class="fas fa-chair"></i>
                        </div>
                        <div class="stat-label">Seats Booked</div>
                        <div class="stat-value">
                            @php
                                $seatsCount = is_array($booking->seat_no) ? count($booking->seat_no) : (is_string($booking->seat_no) ? count(explode(',', $booking->seat_no)) : 0);
                            @endphp
                            {{ $seatsCount }}
                        </div>
                        <small class="text-muted">Total seats</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f620 0%, #2563eb20 100%); color: #3b82f6;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-label">Status</div>
                        <div class="stat-value">
                            @php
                                $statusBadge = match($booking->status) {
                                    'pending' => 'badge-warning',
                                    'cancelled' => 'badge-danger',
                                    'booked' => 'badge-success',
                                    default => 'badge-secondary'
                                };
                            @endphp
                            <span class="badge-modern {{ $statusBadge }}">
                                <i class="fas fa-{{ $booking->status == 'booked' ? 'check-circle' : ($booking->status == 'pending' ? 'hourglass-half' : 'times-circle') }}"></i>
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- Left Column: Customer & Seat Info -->
                <div class="col-xl-6">
                    <div class="modern-card">
                        <div class="card-header-modern">
                            <h3 class="mb-0 text-white">
                                <i class="fas fa-user-circle"></i> Customer Information
                            </h3>
                        </div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-item-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="info-item-content">
                                    <div class="info-item-label">Full Name</div>
                                    <div class="info-item-value fw-bold">{{ $booking->full_name ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-item-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-item-content">
                                    <div class="info-item-label">Email Address</div>
                                    <div class="info-item-value">{{ $booking->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-item-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="info-item-content">
                                    <div class="info-item-label">Phone Number</div>
                                    <div class="info-item-value">{{ $booking->phone ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-item-icon">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div class="info-item-content">
                                    <div class="info-item-label">NID / Passport</div>
                                    <div class="info-item-value">{{ $booking->nid ?? 'N/A' }}</div>
                                </div>
                            </div>
                            @if($booking->any_request)
                                <div class="info-item">
                                    <div class="info-item-icon">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <div class="info-item-content">
                                        <div class="info-item-label">Special Request</div>
                                        <div class="info-item-value">{{ $booking->any_request }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modern-card">
                        <div class="card-header-modern">
                            <h3 class="mb-0 text-white">
                                <i class="fas fa-chair"></i> Seat & Journey Details
                            </h3>
                        </div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-item-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-item-content">
                                    <div class="info-item-label">Package ID / Bus ID</div>
                                    <div class="info-item-value">
                                        Package: #{{ $booking->package_id ?? 'N/A' }} | Bus: #{{ $booking->bus_id ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-item-icon">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <div class="info-item-content">
                                    <div class="info-item-label">Coupon Applied</div>
                                    <div class="info-item-value">
                                        @if($booking->is_coupon)
                                            <span class="badge-modern badge-warning">
                                                <i class="fas fa-ticket-alt"></i> {{ $booking->coupon_code ?? 'COUPON' }}
                                            </span>
                                        @else
                                            <span class="text-muted">No coupon applied</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-item-icon">
                                    <i class="fas fa-chair"></i>
                                </div>
                                <div class="info-item-content">
                                    <div class="info-item-label">Seat Numbers</div>
                                    <div class="info-item-value">
                                        @php
                                            $seats = is_array($booking->seat_no) ? $booking->seat_no : json_decode($booking->seat_no, true);
                                            if(is_string($seats)) $seats = explode(',', $seats);
                                        @endphp
                                        @if(!empty($seats))
                                            @foreach($seats as $seat)
                                                <span class="seat-modern">
                                                    <i class="fas fa-chair"></i> {{ trim($seat) }}
                                                </span>
                                            @endforeach
                                        @else
                                            {{ $booking->seat_no ?? 'N/A' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-item-icon">
                                    <i class="fas fa-barcode"></i>
                                </div>
                                <div class="info-item-content">
                                    <div class="info-item-label">Seat Codes</div>
                                    <div class="info-item-value">{{ $booking->seat_code ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-item-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="info-item-content">
                                    <div class="info-item-label">Payment Method</div>
                                    <div class="info-item-value">
                                        <span class="badge-modern badge-info">
                                            <i class="fas fa-{{ $booking->method == 'bkash' ? 'mobile-alt' : ($booking->method == 'nagad' ? 'mobile-alt' : 'credit-card') }}"></i>
                                            {{ ucfirst($booking->method ?? 'N/A') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Transaction Details -->
                <div class="col-xl-6">
                    <div class="modern-card">
                        <div class="card-header-modern">
                            <h3 class="mb-0 text-white">
                                <i class="fas fa-receipt"></i> Transaction Information
                            </h3>
                        </div>
                        @if(isset($transaction) && $transaction)
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-item-icon">
                                        <i class="fas fa-fingerprint"></i>
                                    </div>
                                    <div class="info-item-content">
                                        <div class="info-item-label">Transaction ID</div>
                                        <div class="info-item-value">
                                            <code style="background: #f1f5f9; padding: 4px 8px; border-radius: 8px;">{{ $transaction->trx_id ?? 'N/A' }}</code>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-item-icon">
                                        <i class="fas fa-file-invoice"></i>
                                    </div>
                                    <div class="info-item-content">
                                        <div class="info-item-label">Invoice Number</div>
                                        <div class="info-item-value">
                                            <strong class="text-primary">#{{ $transaction->invoice_number ?? 'N/A' }}</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-item-icon">
                                        <i class="fas fa-id-badge"></i>
                                    </div>
                                    <div class="info-item-content">
                                        <div class="info-item-label">Payment ID</div>
                                        <div class="info-item-value">{{ $transaction->payment_id ?? 'N/A' }}</div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-item-icon">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div class="info-item-content">
                                        <div class="info-item-label">Amount Paid</div>
                                        <div class="info-item-value">
                                            <span class="amount-display">
                                                {{ $transaction->currency ?? 'USD' }} {{ number_format($transaction->amount ?? 0, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-item-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                    <div class="info-item-content">
                                        <div class="info-item-label">Transaction Status</div>
                                        <div class="info-item-value">
                                            @php
                                                $txnStatus = $transaction->status ?? 'unknown';
                                                $txnBadge = match($txnStatus) {
                                                    'success', 'paid', 'Completed' => 'badge-success',
                                                    'pending', 'initiated' => 'badge-warning',
                                                    'failed', 'cancelled' => 'badge-danger',
                                                    default => 'badge-secondary'
                                                };
                                                $txnIcon = match($txnStatus) {
                                                    'success', 'paid', 'Completed' => 'check-circle',
                                                    'pending', 'initiated' => 'hourglass-half',
                                                    'failed', 'cancelled' => 'times-circle',
                                                    default => 'question-circle'
                                                };
                                            @endphp
                                            <span class="badge-modern {{ $txnBadge }}">
                                                <i class="fas fa-{{ $txnIcon }}"></i>
                                                {{ ucfirst($txnStatus) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-item-icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="info-item-content">
                                        <div class="info-item-label">Transaction Date</div>
                                        <div class="info-item-value">
                                            {{ isset($transaction->created_at) ? \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, h:i A') : 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($transaction->raw_response)
                                <div style="padding: 0 24px 24px 24px;">
                                    <div class="json-viewer-modern">
                                        <button class="copy-btn" onclick="copyToClipboard(this)">
                                            <i class="fas fa-copy"></i> Copy JSON
                                        </button>
                                        <pre>{{ json_encode($transaction->raw_response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-exclamation-triangle fa-4x" style="color: #f59e0b;"></i>
                                </div>
                                <h5 class="text-muted">No Transaction Details Found</h5>
                                <p class="text-muted">Transaction information is not available for this booking.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Timeline Card -->
                    <div class="modern-card">
                        <div class="card-header-modern">
                            <h3 class="mb-0 text-white">
                                <i class="fas fa-history"></i> Activity Timeline
                            </h3>
                        </div>
                        <div style="padding: 24px;">
                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fas fa-calendar-plus"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Booking Created</div>
                                    <div class="timeline-date">{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y, h:i A') }}</div>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fas fa-sync-alt"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Last Updated</div>
                                    <div class="timeline-date">{{ \Carbon\Carbon::parse($booking->updated_at)->format('d M Y, h:i A') }} ({{ \Carbon\Carbon::parse($booking->updated_at)->diffForHumans() }})</div>
                                </div>
                            </div>
                            @if(isset($transaction) && $transaction)
                                <div class="timeline-item">
                                    <div class="timeline-icon">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-title">Transaction Processed</div>
                                        <div class="timeline-date">{{ isset($transaction->created_at) ? \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, h:i A') : 'N/A' }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        @else
            <div class="modern-card">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-search fa-5x" style="color: #cbd5e1;"></i>
                    </div>
                    <h3 class="fw-bold mb-2">No Booking Found</h3>
                    <p class="text-muted mb-4">The booking details you are looking for do not exist or have been removed.</p>
                    <a href="#" class="btn btn-primary btn-modern">
                        <i class="fas fa-arrow-left me-2"></i>Back to Bookings
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });

        // Copy to clipboard function
        function copyToClipboard(button) {
            const pre = button.parentElement.querySelector('pre');
            const text = pre.innerText;

            navigator.clipboard.writeText(text).then(function() {
                // Show success feedback
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i> Copied!';
                setTimeout(function() {
                    button.innerHTML = originalText;
                }, 2000);
            }).catch(function(err) {
                console.error('Failed to copy: ', err);
            });
        }
    </script>
@endpush
