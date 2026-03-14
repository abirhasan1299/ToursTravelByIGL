@extends('layout.admin')
@section('title','List Company')

@section('content')

    @include('admin.partials.booking-modal')

    <div class="row mt-2">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <table data-tables="basic" class="table table-striped dt-responsive align-middle mb-0">
                        <thead class="thead-sm text-uppercase fs-xxs">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->user_name}}</td>
                                <td>{{$d->user_email}}</td>
                                <td>{{$d->user_phone}}</td>
                                <td>{{$d->quantity}}</td>
                                <td>{{$d->quantity*$d->package->amount}}</td>
                                <td>{{$d->user_address}}</td>
                                <td>
                                        <span class="badge badge-label text-bg-@php
                                            if($d->status=='pending')
                                            {
                                                echo "warning";
                                            }

                                            elseif ($d->status=='active')
                                            {
                                                echo "success";
                                            }
                                            elseif ($d->status=='contacted')
                                            {
                                                echo "danger";
                                            }
                                            else
                                            {
                                                echo "info";
                                            }
                                             @endphp">
                                            {{ucfirst($d->status)}}
                                        </span>
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($d->created_at)->format('d M, Y')}}
                                </td>
                                <td class="d-flex justify-content-center">

                                    <a href="#edit-booking-modal" data-bs-toggle="modal" class="btn btn-sm btn-outline-success edit-btn" data-id="{{$d->id}}" role="button">
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
