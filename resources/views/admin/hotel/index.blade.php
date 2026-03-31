@extends('layout.admin')
@section('title','List Company')

@section('content')



    <div class="row mt-2">
        <div class="col-12">

            <a href="{{route('company.hotel.create')}}" role="button" class="btn btn-primary mb-2"><i class="ti ti-plus"></i> Add Hotel </a>

            <div class="card">
                <div class="card-body">
                    <table data-tables="basic" class="table table-striped dt-responsive align-middle mb-0">
                        <thead class="thead-sm text-uppercase fs-xxs">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Address</th>
                            <th>CheckIn</th>
                            <th>CheckOut</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->name}}</td>
                                <td>{{$d->location}}</td>
                                <td>{{$d->price}}</td>
                                <td>{{$d->address}}</td>
                                <td>{{$d->checkIn}}</td>
                                <td>{{$d->checkOut}}</td>

                                <td>
                                    {{\Carbon\Carbon::parse($d->created_at)->format('d M, Y')}}
                                </td>
                                <td class="d-flex justify-content-center">

                                    <a href="#" data-bs-toggle="modal" class="btn btn-sm btn-outline-success edit-btn" data-id="{{$d->id}}" role="button">
                                        <i class="ti ti-pencil"></i>
                                    </a>

                                    <form action="{{route('company.hotel.destroy',$d->id)}}" method="post">
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
