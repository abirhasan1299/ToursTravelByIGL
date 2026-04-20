@extends('layout.admin')
@section('title','List Post')

@push('css')
    <style>
        /* Stats Cards */
        .stats-container {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 16px;
            padding: 24px;
            color: white;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.25);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            pointer-events: none;
        }

        .stat-card.collection {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            box-shadow: 0 8px 25px rgba(17, 153, 142, 0.25);
        }

        .stat-card.pending {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            box-shadow: 0 8px 25px rgba(245, 87, 108, 0.25);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.35);
        }

        .stat-card.collection:hover {
            box-shadow: 0 12px 35px rgba(17, 153, 142, 0.35);
        }

        .stat-card.pending:hover {
            box-shadow: 0 12px 35px rgba(245, 87, 108, 0.35);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .stat-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            opacity: 0.85;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .stat-value {
            font-size: 2.8rem;
            font-weight: 700;
            line-height: 1.2;
            position: relative;
            z-index: 1;
        }

        .stat-sub {
            font-size: 0.85rem;
            opacity: 0.8;
            margin-top: 5px;
            position: relative;
            z-index: 1;
        }

        /* Seat Display */
        .seat-display {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .seat-badge {
            display: inline-block;
            background: #e9ecef;
            color: #495057;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-container {
                flex-direction: column;
                gap: 15px;
            }

            .stat-value {
                font-size: 2.2rem;
            }
        }
    </style>
@endpush

@section('content')

    <div class="row mt-2">
        <div class="col-12">
            <!-- Stats Cards -->
            <div class="stats-container">
                <div class="stat-card collection">
                    <div class="stat-icon">
                        <i class="ti ti-wallet"></i>
                    </div>
                    <div class="stat-label">Total Collection</div>
                    <div class="stat-value">{{ config('app.currency') }} {{ number_format($collection, 2) }}</div>
                    <div class="stat-sub">
                        <i class="ti ti-check me-1"></i> Successfully received
                    </div>
                </div>

                <div class="stat-card pending">
                    <div class="stat-icon">
                        <i class="ti ti-clock"></i>
                    </div>
                    <div class="stat-label">Total Pending</div>
                    <div class="stat-value">{{ config('app.currency') }} {{ number_format($pending, 2) }}</div>
                    <div class="stat-sub">
                        <i class="ti ti-alert-circle me-1"></i> Awaiting payment
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="ti ti-users"></i>
                    </div>
                    <div class="stat-label">Total Bookings</div>
                    <div class="stat-value">{{ $data->count() }}</div>
                    <div class="stat-sub">
                        <i class="ti ti-calendar me-1"></i> All time bookings
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table data-tables="basic" class="table table-striped dt-responsive align-middle mb-0">
                        <thead class="thead-sm text-uppercase fs-xxs">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>NID</th>
                            <th>Any Request</th>
                            <th>Seats</th>
                            <th>Amount</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->full_name}}</td>
                                <td>{{$d->email}}</td>
                                <td>{{$d->phone}}</td>
                                <td>{{$d->nid}}</td>
                                <td>{{$d->any_request}}</td>
                                <td>
                                    @php
                                        $seatCodes = is_string($d->seat_code) ? json_decode($d->seat_code, true) : $d->seat_code;
                                        $seatNos = is_string($d->seat_no) ? json_decode($d->seat_no, true) : $d->seat_no;

                                        // Ensure both are arrays
                                        if (!is_array($seatCodes)) $seatCodes = [$seatCodes];
                                        if (!is_array($seatNos)) $seatNos = [$seatNos];
                                    @endphp

                                    <div class="seat-display">
                                        @foreach($seatCodes as $index => $code)
                                            <span class="seat-badge">
                                           {{ $code }} | {{ $seatNos[$index] ?? '' }}
                                       </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td>{{$d->total_amount}}</td>
                                <td>{{strtoupper($d->method)}}</td>
                                <td>
                                <span class="badge badge-label text-bg-@php
                                            if($d->status=='pending')
                                            {
                                                echo "warning";
                                            } elseif ($d->status=='booked')
                                            {
                                                echo "success";
                                            }
                                            else
                                            {
                                                echo "info";
                                            }
                                             @endphp">
                                            {{ucfirst($d->status)}}
                                        </span>
                                </td>
                                <td>{{\Carbon\Carbon::parse($d->created_at)->format('d M, Y | h:i A')}}</td>
                                <td class="d-flex justify-content-around">



                                    @if($d->status=='pending')

                                        <form class="pay-now" action="{{route('admin.package.confirm',$d->id)}}" method="post">
                                            @csrf
                                            <button type="submit"  class="btn btn-sm btn-outline-success" role="button">
                                                <i class="ti ti-cash"></i>
                                            </button>
                                        </form>

                                    @endif
                                        @if($d->status=='booked')
                                            <a href="{{route('bus.payment.info',Crypt::encryptString($d->id))}}"  class="btn btn-sm btn-outline-success" role="button">
                                                    <i class="ti ti-eye"></i>
                                            </a>
                                        @endif

                                    <form class="delete-form" action="{{route('bus.booking.cancel',$d->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"  class="btn btn-sm btn-outline-danger" role="button">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end card-body-->
            </div>
            <!-- end card-->
        </div>
    </div>

@endsection

@push('js')
    <script>
        document.querySelectorAll('.delete-form').forEach(function(form){
            form.addEventListener('submit', function(e){

                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Cancel this Booking !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Cancel it!',
                    cancelButtonText: 'Cancel',
                    buttonsStyling:false,
                    customClass:{
                        confirmButton:'btn btn-danger me-2',
                        cancelButton:'btn btn-secondary'
                    }
                }).then((result)=>{

                    if(result.isConfirmed){
                        form.submit();
                    }

                });

            });

        });
        document.querySelectorAll('.pay-now').forEach(function(form){
            form.addEventListener('submit', function(e){

                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Paid the full amount",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Paid it!',
                    cancelButtonText: 'Cancel',
                    buttonsStyling:false,
                    customClass:{
                        confirmButton:'btn btn-danger me-2',
                        cancelButton:'btn btn-secondary'
                    }
                }).then((result)=>{

                    if(result.isConfirmed){
                        form.submit();
                    }

                });

            });

        });
    </script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Message',
                text: '{{ session('success') }}',
                confirmButtonColor: '#126600'
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Message',
                text: '{{ session('error') }}',
                confirmButtonColor: 'rgba(238,11,45,0.76)'
            });
        </script>
    @endif
@endpush
