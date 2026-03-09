@php use Carbon\Carbon; @endphp
@extends('layout.admin')
@section('title','Package')

@section('content')

    <div class="row mt-3">
        <div class="col-12" >

            <a href="{{route('company.package.create')}}"  role="button" class="btn btn-primary mb-2"><i class="ti ti-plus"></i>  Add Package</a>

            <div class="card" >
                <div class="card-body">
                    <table data-tables="basic" class="table table-striped dt-responsive align-middle mb-0" >
                        <thead class="thead-sm text-uppercase fs-xxs">
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Days</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Subdestination</th>
                            <th>Max People</th>
                            <th>Tour Type</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->title}}</td>
                                <td>{{$d->day." Day ".$d->night." Night"}}</td>
                                <td>{{ config('app.currency')." ".$d->amount}}</td>
                                <td>{{$d->start_location." to ".$d->end_location}}</td>
                                <td>
                                    @foreach(json_decode($d->subdestination, true) as $des)
                                        {{ $des }}
                                        @if (! $loop->last)
                                            <i class="ti ti-arrow-right"></i>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    {{$d->max_people}}
                                </td>
                                <td> {{strtoupper($d->tour_type)}}</td>
                                <td>
                                    <span class="badge bg-{{ $d->status == 'active' ? 'success' : 'danger' }}">
    {{ strtoupper($d->status) }}
</span>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-between">
                                      <a href="{{route('company.package.activity',base64_encode($d->id))}}" class="btn btn-sm btn-info" role="button"><i class="ti ti-calendar"></i> </a>

                                      <a href="#" class="btn btn-sm btn-warning" role="button"><i class="ti ti-pencil"></i></a>

                                      <form action="{{route('company.package.activity.destroy',$d->id)}}" method="post" class="delete-form">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-sm btn-danger" role="button"><i class="ti ti-trash"></i></button>
                                      </form>
                                  </div>
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
                title: 'Package',
                text: '{{ session('success') }}',
                confirmButtonColor: '#126600'
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Package Error',
                text: '{{ session('error') }}',
                confirmButtonColor: 'rgba(98,255,224,0.45)'
            });
        </script>
    @endif
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


@endpush
