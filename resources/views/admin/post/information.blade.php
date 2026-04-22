@extends('layout.admin')
@section('title', 'Booking Information')

@section('content')
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="page-title-head d-flex align-items-center mb-4">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">Booking Information</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Paces</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bookings</a></li>
                    <li class="breadcrumb-item active">Booking Details</li>
                </ol>
            </div>
        </div>

        @if(isset($booking) && $booking)
            <!-- Stats Cards Row -->
            <div class="row">
                <!-- Booking ID -->
                <div class="col-md-6 col-xxl-3">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="text-muted fs-sm text-uppercase text-truncate">Booking ID</h5>
                                    <div class="d-flex align-items-center gap-2 my-3">
                                        <div class="avatar-md flex-shrink-0">
                                        <span class="avatar-title text-bg-light rounded-circle fs-22">
                                            <i class="ti ti-hash"></i>
                                        </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold">#{{ $booking->id }}</h3>
                                    </div>
                                    <p class="mb-0 text-muted">
                                        Created {{ \Carbon\Carbon::parse($booking->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <div id="booking-id-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Amount -->
                <div class="col-md-6 col-xxl-3">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="text-muted fs-sm text-uppercase text-truncate">Total Amount</h5>
                                    <div class="d-flex align-items-center gap-2 my-3">
                                        <div class="avatar-md flex-shrink-0">
                                        <span class="avatar-title text-bg-light rounded-circle fs-22">
                                            <i class="ti ti-currency-dollar"></i>
                                        </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold">BDT {{ number_format($booking->total_amount, 2) }}</h3>
                                    </div>
                                    <p class="mb-0 text-muted">
                                        {{ $booking->method ?? 'N/A' }}
                                    </p>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <div id="amount-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seats Booked -->
                <div class="col-md-6 col-xxl-3">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="text-muted fs-sm text-uppercase text-truncate">Seats Booked</h5>
                                    <div class="d-flex align-items-center gap-2 my-3">
                                        <div class="avatar-md flex-shrink-0">
                                        <span class="avatar-title text-bg-light rounded-circle fs-22">
                                            <i class="ti ti-chair"></i>
                                        </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold">
                                            @php
                                                $seatsCount = is_array($booking->seat_no) ? count($booking->seat_no) : (is_string($booking->seat_no) ? count(explode(',', $booking->seat_no)) : 0);
                                            @endphp
                                            {{ $seatsCount }}
                                        </h3>
                                    </div>
                                    <p class="mb-0 text-muted">Total seats</p>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <div id="seats-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-md-6 col-xxl-3">
                    <div class="card card-h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h5 class="text-muted fs-sm text-uppercase text-truncate">Status</h5>
                                    <div class="d-flex align-items-center gap-2 my-3">
                                        <div class="avatar-md flex-shrink-0">
                                        <span class="avatar-title text-bg-light rounded-circle fs-22">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                        </div>
                                        <h3 class="mb-0 fw-bold">
                                            @php
                                                $statusBadge = match($booking->status) {
                                                    'pending' => 'bg-warning-subtle text-warning',
                                                    'cancelled' => 'bg-danger-subtle text-danger',
                                                    'booked' => 'bg-success-subtle text-success',
                                                    default => 'bg-secondary-subtle text-secondary'
                                                };
                                                $statusIcon = match($booking->status) {
                                                    'booked' => 'ti ti-check-circle',
                                                    'pending' => 'ti ti-hourglass-half',
                                                    'cancelled' => 'ti ti-circle-x',
                                                    default => 'ti ti-question-circle'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusBadge }} p-2">
                                            <i class="{{ $statusIcon }} me-1"></i> {{ ucfirst($booking->status) }}
                                        </span>
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <div id="status-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Row -->
            <div class="row">
                <!-- Left Column: Customer & Seat Info -->
                <div class="col-xl-6">
                    <!-- Customer Information Card -->
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4 class="card-title">
                                <i class="ti ti-user-circle me-2"></i> Customer Information
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                    <tr>
                                        <th class="ps-0" style="width: 140px;"><i class="ti ti-user me-2 text-muted"></i> Full Name</th>
                                        <td class="text-muted">{{ $booking->full_name ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0"><i class="ti ti-mail me-2 text-muted"></i> Email Address</th>
                                        <td class="text-muted">{{ $booking->email ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0"><i class="ti ti-phone me-2 text-muted"></i> Phone Number</th>
                                        <td class="text-muted">{{ $booking->phone ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0"><i class="ti ti-id me-2 text-muted"></i> NID / Passport</th>
                                        <td class="text-muted">{{ $booking->nid ?? 'N/A' }}</td>
                                    </tr>
                                    @if($booking->any_request)
                                        <tr>
                                            <th class="ps-0"><i class="ti ti-message me-2 text-muted"></i> Special Request</th>
                                            <td class="text-muted">{{ $booking->any_request }}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Seat & Journey Details Card -->
                    <div class="card mt-4">
                        <div class="card-header justify-content-between">
                            <h4 class="card-title">
                                <i class="ti ti-chair me-2"></i> Seat & Journey Details
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                    <tr>
                                        <th class="ps-0" style="width: 140px;"><i class="ti ti-map-pin me-2 text-muted"></i> Package / Bus</th>
                                        <td class="text-muted">Package: #{{ $booking->package_id ?? 'N/A' }} | Bus: #{{ $booking->bus_id ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0"><i class="ti ti-tag me-2 text-muted"></i> Coupon Applied</th>
                                        <td class="text-muted">
                                            @if($booking->is_coupon)
                                                <span class="badge bg-warning-subtle text-warning">
                                                    <i class="ti ti-ticket me-1"></i> {{ $booking->coupon_code ?? 'COUPON' }}
                                                </span>
                                            @else
                                                <span class="text-muted">No coupon applied</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0"><i class="ti ti-chair me-2 text-muted"></i> Seat Numbers</th>
                                        <td class="text-muted">
                                            @php
                                                $seats = is_array($booking->seat_no) ? $booking->seat_no : json_decode($booking->seat_no, true);
                                                if(is_string($seats)) $seats = explode(',', $seats);
                                            @endphp
                                            @if(!empty($seats))
                                                @foreach($seats as $seat)
                                                    <span class="badge bg-primary-subtle text-primary me-1 mb-1 p-2">
                                                        <i class="ti ti-chair me-1"></i> {{ trim($seat) }}
                                                    </span>
                                                @endforeach
                                            @else
                                                {{ $booking->seat_no ?? 'N/A' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0"><i class="ti ti-barcode me-2 text-muted"></i> Seat Codes</th>
                                        <td class="text-muted">{{ $booking->seat_code ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0"><i class="ti ti-credit-card me-2 text-muted"></i> Payment Method</th>
                                        <td class="text-muted">
                                            <span class="badge bg-info-subtle text-info">
                                                <i class="ti ti-{{ $booking->method == 'bkash' ? 'mobile' : ($booking->method == 'nagad' ? 'mobile' : 'credit-card') }} me-1"></i>
                                                {{ ucfirst($booking->method ?? 'N/A') }}
                                            </span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Transaction Details -->
                <div class="col-xl-6">
                    <!-- Transaction Information Card -->
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4 class="card-title">
                                <i class="ti ti-receipt me-2"></i> Transaction Information
                            </h4>
                        </div>
                        <div class="card-body">
                            @if(isset($transaction) && $transaction)
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                        <tr>
                                            <th class="ps-0" style="width: 140px;"><i class="ti ti-fingerprint me-2 text-muted"></i> Transaction ID</th>
                                            <td class="text-muted">
                                                <code class="bg-light p-1 rounded">{{ $transaction->trx_id ?? 'N/A' }}</code>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0"><i class="ti ti-file-invoice me-2 text-muted"></i> Invoice Number</th>
                                            <td class="text-muted">
                                                <strong class="text-primary">#{{ $transaction->invoice_number ?? 'N/A' }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0"><i class="ti ti-id-badge me-2 text-muted"></i> Payment ID</th>
                                            <td class="text-muted">{{ $transaction->payment_id ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0"><i class="ti ti-money-bill me-2 text-muted"></i> Amount Paid</th>
                                            <td class="text-muted">
                                                <strong class="text-success fs-16">{{ $transaction->currency ?? 'USD' }} {{ number_format($transaction->amount ?? 0, 2) }}</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0"><i class="ti ti-chart-line me-2 text-muted"></i> Transaction Status</th>
                                            <td class="text-muted">
                                                @php
                                                    $txnStatus = $transaction->status ?? 'unknown';
                                                    $txnBadge = match($txnStatus) {
                                                        'success', 'paid', 'Completed' => 'bg-success-subtle text-success',
                                                        'pending', 'initiated' => 'bg-warning-subtle text-warning',
                                                        'failed', 'cancelled' => 'bg-danger-subtle text-danger',
                                                        default => 'bg-secondary-subtle text-secondary'
                                                    };
                                                    $txnIcon = match($txnStatus) {
                                                        'success', 'paid', 'Completed' => 'ti ti-check-circle',
                                                        'pending', 'initiated' => 'ti ti-hourglass-half',
                                                        'failed', 'cancelled' => 'ti ti-circle-x',
                                                        default => 'ti ti-question-circle'
                                                    };
                                                @endphp
                                                <span class="badge {{ $txnBadge }} p-2">
                                                    <i class="{{ $txnIcon }} me-1"></i> {{ ucfirst($txnStatus) }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="ps-0"><i class="ti ti-calendar me-2 text-muted"></i> Transaction Date</th>
                                            <td class="text-muted">
                                                {{ isset($transaction->created_at) ? \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, h:i A') : 'N/A' }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                @if($transaction->raw_response)
                                    <div class="mt-4">
                                        <label class="form-label fw-semibold">Raw Response</label>
                                        <div class="position-relative bg-dark rounded p-3">
                                            <button class="btn btn-sm btn-light position-absolute top-0 end-0 m-2" onclick="copyToClipboard(this)">
                                                <i class="ti ti-copy me-1"></i> Copy
                                            </button>
                                            <pre class="text-light mb-0" style="font-size: 12px; overflow-x: auto;">{{ json_encode($transaction->raw_response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="text-center py-4">
                                    <div class="mb-3">
                                        <i class="ti ti-alert-triangle fs-48 text-warning"></i>
                                    </div>
                                    <h5 class="text-muted">No Transaction Details Found</h5>
                                    <p class="text-muted mb-0">Transaction information is not available for this booking.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Activity Timeline Card -->
                    <div class="card mt-4">
                        <div class="card-header justify-content-between">
                            <h4 class="card-title">
                                <i class="ti ti-history me-2"></i> Activity Timeline
                            </h4>
                        </div>
                        <div class="card-body" data-simplebar style="max-height: 400px;">
                            <div class="timeline timeline-users">
                                <div class="timeline-item d-flex align-items-stretch">
                                    <div class="timeline-dot text-bg-primary">
                                        <i class="ti ti-calendar-plus"></i>
                                    </div>
                                    <div class="timeline-content ps-3 pb-4">
                                        <h5 class="mb-1">Booking Created</h5>
                                        <p class="mb-1 text-muted">{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y, h:i A') }}</p>
                                    </div>
                                </div>

                                <div class="timeline-item d-flex align-items-stretch">
                                    <div class="timeline-dot text-bg-info">
                                        <i class="ti ti-refresh"></i>
                                    </div>
                                    <div class="timeline-content ps-3 pb-4">
                                        <h5 class="mb-1">Last Updated</h5>
                                        <p class="mb-1 text-muted">{{ \Carbon\Carbon::parse($booking->updated_at)->format('d M Y, h:i A') }} ({{ \Carbon\Carbon::parse($booking->updated_at)->diffForHumans() }})</p>
                                    </div>
                                </div>

                                @if(isset($transaction) && $transaction)
                                    <div class="timeline-item d-flex align-items-stretch">
                                        <div class="timeline-dot text-bg-success">
                                            <i class="ti ti-credit-card"></i>
                                        </div>
                                        <div class="timeline-content ps-3">
                                            <h5 class="mb-1">Transaction Processed</h5>
                                            <p class="mb-1 text-muted">{{ isset($transaction->created_at) ? \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, h:i A') : 'N/A' }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <!-- No Booking Found -->
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="ti ti-search fs-64 text-muted"></i>
                    </div>
                    <h3 class="fw-bold mb-2">No Booking Found</h3>
                    <p class="text-muted mb-4">The booking details you are looking for do not exist or have been removed.</p>
                    <a href="#" class="btn btn-primary">
                        <i class="ti ti-arrow-left me-2"></i>Back to Bookings
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
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="ti ti-check me-1"></i> Copied!';
                setTimeout(function() {
                    button.innerHTML = originalText;
                }, 2000);
            }).catch(function(err) {
                console.error('Failed to copy: ', err);
            });
        }
    </script>
@endpush
