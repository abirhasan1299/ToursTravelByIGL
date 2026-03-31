@extends('layout.admin')
@section('title','List Company')

@section('content')
    <div class="row mt-2">
        <div class="col-12">

            <a href="{{route('admin.create-company')}}" role="button" class="btn btn-primary mb-2"><i class="ti ti-plus"></i> Add Company</a>


@include('admin.partials.edit-user')
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

                                        <button data-id="{{$d->id}}" class="btn btn-sm btn-outline-warning edit-btn" role="button">
                                            <i class="ti ti-pencil"></i>
                                        </button>

                                        <form action="{{route('admin.destroy-company',$d->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" role="button">
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
    <script>
        $(document).ready(function(){

            // Click Edit Button
            $('.edit-btn').click(function(){
                let userid = $(this).data('id');
                let actionUrl = '/admin/users/update/' + userid;

                $('#edit-user-form').attr('action', actionUrl);

                $.ajax({
                    url: '/admin/users/edit/' + userid,
                    type: 'GET',
                    success: function(data){

                        // Populate modal fields
                        $('#name').val(data.name);
                        $('#email').val(data.email);
                        $('#phone').val(data.phone);

                        $('#edit_user_status').val(data.status);


                        // Show modal
                        var modal = new bootstrap.Modal(document.getElementById('edit-user-modal'));
                        modal.show();
                    }
                });
            });
        });
    </script>
@endpush
