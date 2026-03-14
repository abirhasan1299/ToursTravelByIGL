@extends('layout.admin')
@section('title','List Company')

@section('content')
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
                                <td>{{$d->total}}</td>
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
                                <td class="d-flex justify-content-around">

                                    <a href="#" class="btn btn-sm btn-outline-success" role="button">
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
