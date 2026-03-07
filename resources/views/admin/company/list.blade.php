@extends('layout.admin')
@section('title','List Company')

@section('content')
    <div class="row mt-2">
        <div class="col-12">

            <a href="{{route('admin.create-company')}}" role="button" class="btn btn-primary mb-2"><i class="ti ti-plus"></i> Add Company</a>

            @if(session('success'))
                <div class="alert alert-success text-bg-success alert-dismissible" role="alert">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    <div>{{session('success')}}</div>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <table data-tables="basic" class="table table-striped dt-responsive align-middle mb-0">
                        <thead class="thead-sm text-uppercase fs-xxs">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->email}}</td>
                                    <td>{{$d->phone}}</td>
                                    <td>{{$d->company_id}}</td>
                                    <td>
                                        <span class="badge badge-label text-bg-@php
                                            if($d->status=='pending')
                                            {
                                                echo "warning";
                                            }
                                            elseif ($d->status=='suspended')
                                            {
                                                echo "danger";
                                            }
                                            elseif ($d->status=='active')
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
                                    <td>
                                        {{\Carbon\Carbon::parse($d->create_at)->format('d M, Y')}}
                                    </td>
                                    <td class="d-flex justify-content-around">
                                        <a href="#" class="btn btn-sm btn-outline-success" role="button">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-warning" role="button">
                                            <i class="ti ti-pencil"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-danger" role="button">
                                            <i class="ti ti-trash"></i>
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
