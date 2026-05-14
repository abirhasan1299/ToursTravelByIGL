@extends('layout.admin')
@section('title','List Post')

@section('content')

    <div class="row mt-2">
        <div class="col-12">

            <a href="{{ route('admin.post.create')  }}"
               class="btn btn-primary mb-2">
                <i class="ti ti-plus"></i> Add Package
            </a>

            <div class="card">
                <div class="card-body">
                    <table data-tables="basic" class="table table-striped dt-responsive align-middle mb-0">
                        <thead class="thead-sm text-uppercase fs-xxs">
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Max People</th>
                            <th>Destination</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->title}}</td>
                                <td>{{$d->amount}}</td>
                                <td>{{$d->max_people}}</td>
                                <td>{{$d->start_location}} to {{$d->end_location}}</td>
                                <td> Days: {{$d->day}}, Nights: {{$d->night}}</td>
                                <td>
                                     <span class="badge badge-label text-bg-@php
                                            if($d->status=='processing')
                                            {
                                                echo "warning";
                                            }
                                            elseif ($d->status=='suspended')
                                            {
                                                echo "danger";
                                            }elseif ($d->status=='reviewing')
                                            {
                                                echo "primary";
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
                                <td class="d-flex justify-content-around">
                                    <a href="{{route('admin.post.show',base64_encode($d->id))}}" class="btn btn-sm btn-outline-primary" role="button">
                                        <i class="ti ti-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.post.edit', base64_encode($d->id)) }}" class="btn btn-sm btn-outline-warning" role="button">
                                        <i class="ti ti-pencil"></i>
                                    </a>

{{--                                    <a href="{{route('admin.post.activity',base64_encode($d->id))}}" class="btn btn-sm btn-outline-info" role="button">--}}
{{--                                        <i class="ti ti-calendar-plus"></i>--}}
{{--                                    </a>--}}

                                    <a href="{{route('admin.post.persons',base64_encode($d->id))}}" class="btn btn-sm btn-outline-secondary" role="button">
                                        <i class="ti ti-user-circle"></i>
                                    </a>

                                    <form class="delete-form" action="{{route('admin.post.destroy',$d->id)}}" method="post">
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
@endpush
