@extends('layout.admin')
@section('title', 'Facilities')
@push('css')

@endpush

@section('content')
    @include('admin.partials.create-facility')
    <div class="row mt-2">
        <div class="col-12">

            <a href="#facility-modal" data-bs-toggle="modal"  role="button" class="btn btn-primary mb-2"><i class="ti ti-plus"></i> Add Facility</a>

            <div class="card">
                <div class="card-body">
                    <table data-tables="basic" class="table table-striped dt-responsive align-middle mb-0">
                        <thead class="thead-sm text-uppercase fs-xxs">
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Detail</th>
                            <th>Added</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->title}}</td>
                                <td>{{$d->detail??"Null"}}</td>
                                <td>{{ $d->created_at->diffForHumans() }}</td>
                                <td class="d-flex justify-content-center">

                                    <form action="{{route('admin.facility.destroy',$d->id)}}" class="delete-form" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
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
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Message',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3061fd'
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Message Error',
                text: '{{ session('error') }}',
                confirmButtonColor: 'rgb(190,0,0)'
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var myModal = new bootstrap.Modal(document.getElementById('facility-modal'));
                myModal.show();
            });
        </script>
    @endif

@endpush
