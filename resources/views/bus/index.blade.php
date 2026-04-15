@extends('layout.admin')
@section('title','Bus List')

@section('content')
    <div class="row mt-2">
        <div class="col-12">

            <div class="d-flex justify-content-between mt-2">
                <div>
                    <h4>Current Bus List</h4>
                </div>
                <div>
                    <a href="{{route('admin.bus.create')}}" role="button" class="btn btn-primary mb-2"><i class="ti ti-bus me-1"></i> Add Bus </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table data-tables="basic" class="table table-striped dt-responsive align-middle mb-0">
                        <thead class="thead-sm text-uppercase fs-xxs">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Seat</th>
                            <th>Bus Type</th>
                            <th>Driver</th>
                            <th>Experience</th>
                            <th>Model</th>
                            <th>Contact Number</th>
                            <th>Registration</th>
                            <th>Notes</th>
                            <th>Status</th>
                            <th>Added In</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->name}}</td>
                                <td>{{$d->total_seat}}</td>
                                <td>{{ucfirst($d->bus_type)}}</td>
                                <td>{{$d->driver_name}}</td>
                                <td>{{$d->driver_exp}}</td>
                                <td>{{$d->model}}</td>
                                <td>{{$d->contact_number}}</td>
                                <td>{{$d->reg_number}}</td>
                                <td>{{$d->notes}}</td>
                                <td>
                                        <span class="badge badge-label text-bg-@php
                                            if($d->status=='inactive')
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
                                    {{\Carbon\Carbon::parse($d->created_at)->format('d M, Y')}}
                                </td>
                                <td class="d-flex justify-content-between">

                                    <a href="{{route('admin.bus.edit',$d->id)}}"  class="btn btn-sm btn-outline-success edit-btn" role="button">
                                        <i class="ti ti-pencil"></i>
                                    </a>

                                    <form class="delete-form" action="{{route('admin.bus.destroy',$d->id)}}" method="post">
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
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33'
            });
        </script>
    @endif
    <script>
        document.querySelectorAll('.delete-form').forEach(function(form){
            form.addEventListener('submit', function(e){

                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This record will be deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
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
@endpush
