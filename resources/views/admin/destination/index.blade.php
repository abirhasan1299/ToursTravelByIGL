@extends('layout.admin')
@section('title','List Destination')
@section('content')

    <div class="row mt-2">
        <div class="col-12">

            <a href="{{route('admin.des.create')}}" role="button" class="btn btn-primary mb-2"><i class="ti ti-plus"></i>  Add Destination </a>

            <div class="card">
                <div class="card-body">
                    <table data-tables="basic" class="table table-striped dt-responsive align-middle mb-0">
                        <thead class="thead-sm text-uppercase fs-xxs">
                        <tr>
                            <th>SL</th>
                            <th>Country</th>
                            <th>Visa</th>
                            <th>Price</th>
                            <th>Langauage</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->country}}</td>
                                <td>{{ $d->visa ? 'Yes' : 'No' }}</td>
                                <td>{{$d->price}}</td>
                                <td>
                                    @foreach($d->languages as $lang)
                                        <span class="badge bg-primary">{{ $lang }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($d->created_at)->format('d M, Y')}}
                                </td>
                                <td class="d-flex justify-content-center">

                                    <form class="delete-form" action="{{route('admin.des.destroy',$d->id)}}" method="post">
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
    <script>
        document.querySelectorAll('.delete-form').forEach(function(form){

            form.addEventListener('submit', function(e){

                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This record and activity will be deleted!",
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
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#d33'
            });
        </script>
    @endif
@endpush
