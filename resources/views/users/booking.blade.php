{{-- resources/views/front/user/bookings.blade.php --}}
@extends('layout.theme')
@section('title', 'My Bookings')

@section('meta_description', 'View and manage your tour bookings')
@section('meta_keywords', 'bookings, tours, reservations')
@section('meta_robots', 'noindex, nofollow')

@push('css')
    <style>
        /* Bookings Section Styles */
        .bookings-section {
            padding: 120px 0 80px;
            background: linear-gradient(180deg, #f8faf7 0%, #ffffff 100%);
            min-height: 100vh;
        }

        /* Bookings Container */
        .bookings-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Bookings Header */
        .bookings-header {
            margin-bottom: 30px;
        }

        .bookings-header__title {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .bookings-header__title span {
            color: #63AB45;
        }

        .bookings-header__subtitle {
            font-size: 14px;
            color: #666;
        }

        /* Stats Cards */
        .bookings-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(99, 171, 69, 0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(99, 171, 69, 0.1);
            border-color: rgba(99, 171, 69, 0.2);
        }

        .stat-card__icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, rgba(99, 171, 69, 0.1) 0%, rgba(99, 171, 69, 0.05) 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .stat-card__icon i {
            font-size: 24px;
            color: #63AB45;
        }

        .stat-card__value {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .stat-card__label {
            font-size: 13px;
            color: #888;
            font-weight: 500;
        }

        /* Filter Bar */
        .bookings-filter {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .filter-tabs {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 10px 20px;
            background: #ffffff;
            border: 1.5px solid #E5E5E5;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-tab:hover {
            border-color: #63AB45;
            color: #63AB45;
        }

        .filter-tab.active {
            background: #63AB45;
            border-color: #63AB45;
            color: #ffffff;
        }

        .filter-tab.active i {
            color: #ffffff;
        }

        .filter-tab i {
            margin-right: 6px;
            color: #63AB45;
        }

        .search-box {
            position: relative;
            min-width: 280px;
        }

        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #63AB45;
            font-size: 14px;
        }

        .search-box input {
            width: 100%;
            height: 44px;
            padding: 0 16px 0 42px;
            border: 1.5px solid #E5E5E5;
            border-radius: 40px;
            background: #ffffff;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: #63AB45;
            box-shadow: 0 0 0 3px rgba(99, 171, 69, 0.1);
        }

        /* Bookings Table */
        .bookings-table-wrapper {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(99, 171, 69, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .bookings-table {
            width: 100%;
            border-collapse: collapse;
        }

        .bookings-table thead {
            background: linear-gradient(135deg, #fafdf8 0%, #f5faf2 100%);
            border-bottom: 2px solid rgba(99, 171, 69, 0.15);
        }

        .bookings-table th {
            padding: 18px 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #555;
            text-align: left;
            white-space: nowrap;
        }

        .bookings-table td {
            padding: 20px;
            font-size: 14px;
            color: #444;
            border-bottom: 1px solid rgba(99, 171, 69, 0.08);
            vertical-align: middle;
        }

        .bookings-table tbody tr {
            transition: all 0.3s ease;
        }

        .bookings-table tbody tr:hover {
            background: rgba(99, 171, 69, 0.02);
        }

        .bookings-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Tour Info Cell */
        .tour-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .tour-info__image {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .tour-info__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tour-info__details h5 {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .tour-info__details h5 a {
            color: #1a1a1a;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .tour-info__details h5 a:hover {
            color: #63AB45;
        }

        .tour-info__details .booking-id {
            font-size: 11px;
            color: #888;
            font-family: monospace;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .status-badge.confirmed {
            background: rgba(99, 171, 69, 0.1);
            color: #63AB45;
            border: 1px solid rgba(99, 171, 69, 0.2);
        }

        .status-badge.pending {
            background: rgba(255, 165, 2, 0.1);
            color: #ffa502;
            border: 1px solid rgba(255, 165, 2, 0.2);
        }

        .status-badge.cancelled {
            background: rgba(255, 71, 87, 0.1);
            color: #ff4757;
            border: 1px solid rgba(255, 71, 87, 0.2);
        }

        .status-badge.completed {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
            border: 1px solid rgba(52, 152, 219, 0.2);
        }

        .status-badge i {
            font-size: 10px;
        }

        /* Amount Display */
        .booking-amount {
            font-weight: 700;
            color: #63AB45;
            font-size: 16px;
        }

        .booking-amount small {
            font-size: 11px;
            font-weight: 400;
            color: #888;
        }

        /* Action Buttons */
        .booking-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            background: #f5f5f5;
            color: #666;
        }

        .btn-icon:hover {
            background: #63AB45;
            color: #ffffff;
            transform: translateY(-2px);
        }

        .btn-icon.cancel:hover {
            background: #ff4757;
        }

        .btn-icon.view {
            background: rgba(99, 171, 69, 0.1);
            color: #63AB45;
        }

        .btn-icon.view:hover {
            background: #63AB45;
            color: #ffffff;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state__icon {
            width: 100px;
            height: 100px;
            background: rgba(99, 171, 69, 0.08);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }

        .empty-state__icon i {
            font-size: 48px;
            color: #63AB45;
            opacity: 0.6;
        }

        .empty-state h4 {
            font-size: 20px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 14px;
            color: #888;
            margin-bottom: 24px;
        }

        .btn-explore {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            background: linear-gradient(135deg, #63AB45 0%, #4f9234 100%);
            color: #ffffff;
            border-radius: 40px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 171, 69, 0.3);
        }

        .btn-explore:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 171, 69, 0.4);
            color: #ffffff;
        }

        /* Pagination */
        .bookings-pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
            opacity: 1;
        }

        .modal {
            background: #ffffff;
            border-radius: 24px;
            max-width: 450px;
            width: 90%;
            max-height: 90vh;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .modal-overlay.active .modal {
            transform: scale(1);
        }

        .modal-header {
            padding: 24px 24px 16px;
            border-bottom: 1px solid rgba(99, 171, 69, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-header h4 {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-header h4 i {
            color: #ff4757;
            font-size: 20px;
        }

        .modal-close {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f5f5;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: #ff4757;
            color: #ffffff;
        }

        .modal-body {
            padding: 24px;
        }

        .booking-detail-item {
            display: flex;
            margin-bottom: 16px;
        }

        .booking-detail-item__label {
            width: 100px;
            font-size: 13px;
            color: #888;
        }

        .booking-detail-item__value {
            flex: 1;
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .modal-footer {
            padding: 16px 24px 24px;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-modal {
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-modal-cancel {
            background: #f5f5f5;
            color: #666;
        }

        .btn-modal-cancel:hover {
            background: #eeeeee;
        }

        .btn-modal-confirm {
            background: #ff4757;
            color: #ffffff;
        }

        .btn-modal-confirm:hover {
            background: #ff3344;
            transform: translateY(-1px);
        }

        /* Alert Messages */
        .alert {
            padding: 16px 20px;
            border-radius: 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: rgba(99, 171, 69, 0.1);
            border: 1px solid rgba(99, 171, 69, 0.3);
            color: #4f9234;
        }

        .alert-error {
            background: rgba(255, 71, 87, 0.1);
            border: 1px solid rgba(255, 71, 87, 0.3);
            color: #ff4757;
        }

        .alert i {
            font-size: 20px;
        }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #ffffff;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .bookings-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .bookings-table-wrapper {
                overflow-x: auto;
            }

            .bookings-table {
                min-width: 900px;
            }
        }

        @media (max-width: 768px) {
            .bookings-section {
                padding: 100px 0 60px;
            }

            .bookings-header__title {
                font-size: 24px;
            }

            .bookings-filter {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-tabs {
                justify-content: center;
            }

            .search-box {
                min-width: 100%;
            }

            .bookings-stats {
                grid-template-columns: 1fr;
                gap: 12px;
            }
        }

        @media (max-width: 480px) {
            .filter-tab span {
                display: none;
            }

            .filter-tab i {
                margin-right: 0;
                font-size: 16px;
            }

            .filter-tab {
                padding: 10px 16px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="bookings-section" style="margin-top: -80px;">
        <div class="container bookings-container">
            {{-- Header --}}
            <div class="bookings-header">
                <h1 class="bookings-header__title wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                    My <span>Bookings</span>
                </h1>
                <p class="bookings-header__subtitle wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                    View and manage all your tour reservations
                </p>
            </div>

            {{-- Alert Messages --}}
            @if(session('success'))
                <div class="alert alert-success wow fadeInUp" data-wow-duration="1500ms">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error wow fadeInUp" data-wow-duration="1500ms">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{-- Stats Cards --}}
            <div class="bookings-stats wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="400ms">
                <div class="stat-card">
                    <div class="stat-card__icon">
                        <i class="fas fa-suitcase"></i>
                    </div>
                    <div class="stat-card__value">{{ $stats['total'] ?? 0 }}</div>
                    <div class="stat-card__label">Total Bookings</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card__icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-card__value">{{ $stats['confirmed'] ?? 0 }}</div>
                    <div class="stat-card__label">Confirmed</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card__icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-card__value">{{ $stats['pending'] ?? 0 }}</div>
                    <div class="stat-card__label">Pending</div>
                </div>
                <div class="stat-card">
                    <div class="stat-card__icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div class="stat-card__value">BDT {{ number_format($stats['total_amount'] ?? 0) }}</div>
                    <div class="stat-card__label">Total Spent</div>
                </div>
            </div>

            {{-- Filter Bar --}}
            <div class="bookings-filter wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="500ms">
                <div class="filter-tabs">
                    <button class="filter-tab active" data-filter="all">
                        <i class="fas fa-list"></i>
                        <span>All Bookings</span>
                    </button>
                    <button class="filter-tab" data-filter="confirmed">
                        <i class="fas fa-check-circle"></i>
                        <span>Confirmed</span>
                    </button>
                    <button class="filter-tab" data-filter="pending">
                        <i class="fas fa-clock"></i>
                        <span>Pending</span>
                    </button>
                    <button class="filter-tab" data-filter="cancelled">
                        <i class="fas fa-times-circle"></i>
                        <span>Cancelled</span>
                    </button>
                </div>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="booking-search" placeholder="Search by tour name or booking ID...">
                </div>
            </div>

            {{-- Bookings Table --}}
            <div class="bookings-table-wrapper wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="600ms">
                @if(count($bookings ?? []) > 0)
                    <table class="bookings-table" id="bookings-table">
                        <thead>
                        <tr>
                            <th>Tour Details</th>
                            <th>Booking Date</th>
                            <th>Travelers</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $booking)
                            <tr class="booking-row" data-status="{{ $booking->status ?? 'confirmed' }}">
                                <td>
                                    <div class="tour-info">
                                        <div class="tour-info__image">
                                            <img src="{{ asset('storage/package/' . ($booking->package->cover_img ?? 'default.jpg')) }}"
                                                 alt="{{ $booking->package->title ?? 'Tour' }}">
                                        </div>
                                        <div class="tour-info__details">
                                            <h5>
                                                <a href="{{ route('front.tour.detail', base64_encode($booking->package_id)) }}">
                                                    {{ $booking->package->title ?? 'Tour Package' }}
                                                </a>
                                            </h5>
                                            <span class="booking-id">
                                                    <i class="far fa-file-alt"></i> Booking #{{ str_pad($booking->id, 6, '0', STR_PAD_LEFT) }}
                                                </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; flex-direction: column;">
                                        <span><i class="far fa-calendar-alt" style="color: #63AB45; margin-right: 6px;"></i>{{ date('M d, Y', strtotime($booking->date)) }}</span>
                                        <small style="color: #888; font-size: 11px; margin-top: 4px;">
                                            <i class="far fa-clock"></i> {{ $booking->created_at->format('h:i A') }}
                                        </small>
                                    </div>
                                </td>
                                <td>
                                        <span style="font-weight: 500;">
                                            <i class="fas fa-user" style="color: #63AB45; margin-right: 6px;"></i>
                                            {{ $booking->quantity }} {{ Str::plural('Person', $booking->quantity) }}
                                        </span>
                                </td>
                                <td>
                                    <div class="booking-amount">
                                        BDT {{ number_format($booking->quantity*$booking->package->amount) }}
                                        <small>/ total</small>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $status = $booking->status ?? 'confirmed';
                                        $statusIcon = [
                                            'confirmed' => 'check-circle',
                                            'pending' => 'clock',
                                            'cancelled' => 'times-circle',
                                            'completed' => 'check-double'
                                        ][$status] ?? 'info-circle';
                                    @endphp
                                    <span class="status-badge {{ $status }}">
                                            <i class="fas fa-{{ $statusIcon }}"></i>
                                            {{ ucfirst($status) }}
                                        </span>
                                </td>
                                <td>
                                    <div class="booking-actions">
                                        @if(!in_array($booking->status, ['cancelled', 'completed']))
                                            <form action="{{route('user.booking.cancel',$booking->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn-icon cancel" title="Cancel Booking">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>

                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <div class="empty-state__icon">
                            <i class="fas fa-suitcase-rolling"></i>
                        </div>
                        <h4>No Bookings Found</h4>
                        <p>You haven't made any bookings yet. Start exploring our amazing tours!</p>
                        <a href="{{ route('front.tour-list') }}" class="btn-explore">
                            <i class="fas fa-compass"></i> Explore Tours
                        </a>
                    </div>
                @endif
            </div>

            {{-- Pagination --}}
            @if(isset($bookings) && method_exists($bookings, 'links'))
                <div class="bookings-pagination wow fadeInUp" data-wow-duration="1500ms">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </section>

@endsection

@push('js')
    <script>
        // Store bookings data for JavaScript operations
        const bookingsData = @json($bookings ?? []);

        document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            const filterTabs = document.querySelectorAll('.filter-tab');
            const bookingRows = document.querySelectorAll('.booking-row');

            filterTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const filter = this.dataset.filter;

                    // Update active state
                    filterTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    // Filter rows
                    bookingRows.forEach(row => {
                        const status = row.dataset.status;
                        if (filter === 'all' || status === filter) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            });

            // Search functionality
            const searchInput = document.getElementById('booking-search');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();

                    bookingRows.forEach(row => {
                        const tourName = row.querySelector('.tour-info__details h5')?.textContent.toLowerCase() || '';
                        const bookingId = row.querySelector('.booking-id')?.textContent.toLowerCase() || '';

                        if (tourName.includes(searchTerm) || bookingId.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }
        });

        function getStatusIcon(status) {
            const icons = {
                'confirmed': 'check-circle',
                'pending': 'clock',
                'cancelled': 'times-circle',
                'completed': 'check-double'
            };
            return icons[status] || 'info-circle';
        }

        // SweetAlert for success/error messages
        @if(session('success'))
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#63AB45'
            });
        }
        @endif

            @if(session('error'))
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#63AB45'
            });
        }
        @endif
    </script>
@endpush
