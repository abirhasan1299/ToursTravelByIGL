@extends('layout.admin')
@section('title', 'List Post')

@section('content')
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="page-title-head d-flex align-items-center mb-4">
            <div class="flex-grow-1">
                <h4 class="page-main-title m-0">Booking Management</h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Paces</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Bookings</a></li>
                    <li class="breadcrumb-item active">All Bookings</li>
                </ol>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <!-- Stats Cards Row -->
                <div class="row">
                    <!-- Total Collection -->
                    <div class="col-md-6 col-xxl-4">
                        <div class="card card-h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h5 class="text-muted fs-sm text-uppercase text-truncate">Total Collection</h5>
                                        <div class="d-flex align-items-center gap-2 my-3">
                                            <div class="avatar-md flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle text-success rounded-circle fs-22">
                                                <i class="ti ti-wallet"></i>
                                            </span>
                                            </div>
                                            <h3 class="mb-0 fw-bold">{{ config('app.currency') }} {{ number_format($collection, 2) }}</h3>
                                        </div>
                                        <p class="mb-0 text-muted">
                                            <i class="ti ti-check me-1 text-success"></i> Successfully received
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-end">
                                            <div id="collection-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pending -->
                    <div class="col-md-6 col-xxl-4">
                        <div class="card card-h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h5 class="text-muted fs-sm text-uppercase text-truncate">Total Pending</h5>
                                        <div class="d-flex align-items-center gap-2 my-3">
                                            <div class="avatar-md flex-shrink-0">
                                            <span class="avatar-title bg-warning-subtle text-warning rounded-circle fs-22">
                                                <i class="ti ti-clock"></i>
                                            </span>
                                            </div>
                                            <h3 class="mb-0 fw-bold">{{ config('app.currency') }} {{ number_format($pending, 2) }}</h3>
                                        </div>
                                        <p class="mb-0 text-muted">
                                            <i class="ti ti-alert-circle me-1 text-warning"></i> Awaiting payment
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-end">
                                            <div id="pending-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Bookings -->
                    <div class="col-md-6 col-xxl-4">
                        <div class="card card-h-100">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h5 class="text-muted fs-sm text-uppercase text-truncate">Total Bookings</h5>
                                        <div class="d-flex align-items-center gap-2 my-3">
                                            <div class="avatar-md flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle text-primary rounded-circle fs-22">
                                                <i class="ti ti-users"></i>
                                            </span>
                                            </div>
                                            <h3 class="mb-0 fw-bold">{{ $data->count() }}</h3>
                                        </div>
                                        <p class="mb-0 text-muted">
                                            <i class="ti ti-calendar me-1 text-primary"></i> All time bookings
                                        </p>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-end">
                                            <div id="bookings-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bookings Table Card -->
                <div class="card mt-4">
                    <div class="card-header justify-content-between">
                        <h4 class="card-title">
                            <i class="ti ti-ticket me-2"></i> All Bookings
                        </h4>
                        <div class="d-flex align-items-center gap-2">
                            <div class="app-search">
                                <input type="search" id="searchInput" class="form-control" placeholder="Search bookings..." />
                                <i class="ti ti-search app-search-icon text-muted"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-custom table-nowrap table-centered table-hover w-100 mb-0" id="bookingsTable">
                                <thead class="bg-light align-middle bg-opacity-25 thead-sm">
                                <tr class="text-uppercase fs-xxs">
                                    <th data-table-sort>SL</th>
                                    <th data-table-sort>Name</th>
                                    <th data-table-sort>Email</th>
                                    <th>Phone</th>
                                    <th>NID</th>
                                    <th>Any Request</th>
                                    <th>Seats</th>
                                    <th data-table-sort>Amount</th>
                                    <th>Method</th>
                                    <th data-table-sort>Status</th>
                                    <th data-table-sort>Joined</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $d)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-xs">
                                                <span class="avatar-title bg-primary-subtle text-primary rounded-circle">
                                                    {{ substr($d->full_name, 0, 1) }}
                                                </span>
                                                </div>
                                                <span class="fw-medium">{{$d->full_name}}</span>
                                            </div>
                                        </td>
                                        <td>{{$d->email}}</td>
                                        <td>{{$d->phone}}</td>
                                        <td>{{$d->nid ?? 'N/A'}}</td>
                                        <td>
                                            @if($d->any_request)
                                                <span class="badge bg-info-subtle text-info" data-bs-toggle="tooltip" title="{{ $d->any_request }}">
                                                <i class="ti ti-message"></i> View
                                            </span>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $seatCodes = is_string($d->seat_code) ? json_decode($d->seat_code, true) : $d->seat_code;
                                                $seatNos = is_string($d->seat_no) ? json_decode($d->seat_no, true) : $d->seat_no;

                                                if (!is_array($seatCodes)) $seatCodes = [$seatCodes];
                                                if (!is_array($seatNos)) $seatNos = [$seatNos];
                                            @endphp
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach($seatCodes as $index => $code)
                                                    <span class="badge bg-secondary-subtle text-secondary">
                                                    <i class="ti ti-chair me-1"></i> {{ $code }} | {{ $seatNos[$index] ?? '' }}
                                                </span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-success">{{ config('app.currency') }} {{ number_format($d->total_amount, 2) }}</span>
                                        </td>
                                        <td>
                                        <span class="badge bg-info-subtle text-info text-uppercase">
                                            <i class="ti ti-{{ $d->method == 'bkash' ? 'mobile' : ($d->method == 'nagad' ? 'mobile' : 'credit-card') }} me-1"></i>
                                            {{$d->method}}
                                        </span>
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = match($d->status) {
                                                    'pending' => 'bg-warning-subtle text-warning',
                                                    'booked' => 'bg-success-subtle text-success',
                                                    default => 'bg-secondary-subtle text-secondary'
                                                };
                                                $statusIcon = match($d->status) {
                                                    'booked' => 'ti ti-check-circle',
                                                    'pending' => 'ti ti-clock',
                                                    default => 'ti ti-question-circle'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">
                                            <i class="{{ $statusIcon }} me-1"></i> {{ucfirst($d->status)}}
                                        </span>
                                        </td>
                                        <td>
                                            <div class="text-nowrap">
                                                <i class="ti ti-calendar me-1 text-muted"></i> {{ \Carbon\Carbon::parse($d->created_at)->format('d M, Y') }}<br>
                                                <small class="text-muted"><i class="ti ti-clock me-1"></i> {{ \Carbon\Carbon::parse($d->created_at)->format('h:i A') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                @if($d->status == 'pending')
                                                    <form class="pay-now" action="{{route('admin.package.confirm',$d->id)}}" method="post" style="display: inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-soft-success" data-bs-toggle="tooltip" title="Confirm Payment">
                                                            <i class="ti ti-cash"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                @if($d->status == 'booked')
                                                    <a href="{{route('bus.payment.info', Crypt::encryptString($d->id))}}" class="btn btn-sm btn-soft-primary" data-bs-toggle="tooltip" title="View Details">
                                                        <i class="ti ti-eye"></i>
                                                    </a>
                                                @endif

                                                <form class="delete-form" action="{{route('bus.booking.cancel',$d->id)}}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-soft-danger" data-bs-toggle="tooltip" title="Cancel Booking">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card-body-->
                </div>
                <!-- end card-->
            </div>
        </div>
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

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchText = this.value.toLowerCase();
                    const table = document.getElementById('bookingsTable');
                    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                    for (let row of rows) {
                        const name = row.cells[1]?.innerText.toLowerCase() || '';
                        const email = row.cells[2]?.innerText.toLowerCase() || '';
                        const phone = row.cells[3]?.innerText.toLowerCase() || '';

                        if (name.includes(searchText) || email.includes(searchText) || phone.includes(searchText)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
            }
        });

        // Delete confirmation
        document.querySelectorAll('.delete-form').forEach(function(form){
            form.addEventListener('submit', function(e){
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Cancel this Booking!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Cancel it!',
                    cancelButtonText: 'Cancel',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-danger me-2',
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((result) => {
                    if(result.isConfirmed){
                        form.submit();
                    }
                });
            });
        });

        // Payment confirmation
        document.querySelectorAll('.pay-now').forEach(function(form){
            form.addEventListener('submit', function(e){
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Confirm payment of full amount?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Confirm Payment!',
                    cancelButtonText: 'Cancel',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-success me-2',
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((result) => {
                    if(result.isConfirmed){
                        form.submit();
                    }
                });
            });
        });

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#126600',
            confirmButtonText: 'OK'
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            confirmButtonColor: '#dc2626',
            confirmButtonText: 'OK'
        });
        @endif
    </script>
@endpush
