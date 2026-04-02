@extends('layout.admin')
@section('title','Hotel Booking')

@section('content')

{{--    @include('admin.partials.booking-modal')--}}

    <div class="row mt-2">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <table data-tables="basic" class="table table-striped dt-responsive align-middle mb-0">
                        <thead class="thead-sm text-uppercase fs-xxs">
                        <tr>
                            <th>SL</th>
                            <th>Hotel</th>
                            <th>Days</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Rooms</th>
                            <th>Guests</th>
                            <th>Request</th>
                            <th>Booking Time</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
@foreach($bookings as $d)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$d->hotel->name}} ({{$d->hotel->location}})</td>
                            <td>{{$d->booking_range}}</td>
                            <td>{{$d->email}}</td>
                            <td>{{$d->phone}}</td>
                            <td>{{$d->full_name}}</td>
                            <td>{{$d->total_price}}</td>
                            <td>{{$d->rooms}}</td>
                            <td>{{$d->guest}}</td>
                            <td>{{$d->special_request}}</td>
                            <td>{{\Carbon\Carbon::parse($d->created_at)->format('d M, Y | h:i A')}}</td>
                            <td>
                                <a  class="btn btn-sm btn-outline-success edit-btn"  role="button">
                                    <i class="ti ti-pencil"></i>
                                </a>
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
        $(document).ready(function(){

            $('.edit-btn').click(function(){

                let bookingId = $(this).data('id');
                let actionUrl = '/company/booking/update/' + bookingId;

                $('#booking-form').attr('action', actionUrl);

                $.ajax({
                    url: '/company/booking/data/' + bookingId,
                    type: 'GET',

                    success:function(data){

                        $('#name').val(data.user_name);
                        $('#email').val(data.user_email);
                        $('#phone').val(data.user_phone);
                        $('#date').val(data.date);
                        $('#address').val(data.user_address);
                        $('#quantity').val(data.quantity);
                        $('#ip').val(data.user_ip);
                        $('#booking_status').val(data.status);

                        var modal = new bootstrap.Modal(document.getElementById('edit-booking-modal'));
                        modal.show();
                    }

                });

            });

        });
    </script>
@endpush
