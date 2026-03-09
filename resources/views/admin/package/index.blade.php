@php use Carbon\Carbon; @endphp
@extends('layout.admin')
@section('title','Package')

@section('content')
    @php
        function getDaysFromRange($range) { [$start, $end] = explode(' to ', $range); $startDate = Carbon::parse($start); $endDate = Carbon::parse($end); return $startDate->diffInDays($endDate) + 1; }

    @endphp

{{--    modal form--}}
    @include('admin.partials.create-package')
    @include('admin.partials.edit-package')
{{--end modal form--}}

    <div class="row mt-3">
        <div class="col-12" style="margin: auto;width: 80%;">

            <a href="#package-modal" data-bs-toggle="modal" role="button" class="btn btn-primary mb-2"><i class="ti ti-plus"></i>  Add Package</a>

            <div class="card" >
                <div class="card-body">
                    <table data-tables="basic" class="table table-striped dt-responsive align-middle mb-0" >
                        <thead class="thead-sm text-uppercase fs-xxs">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Days</th>
                            <th>Price</th>
                            <th>Limit</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
@foreach($data as $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->p_name}}</td>
                                <td>{{getDaysFromRange($d->p_date_range)}} Days</td>
                                <td>{{config('app.currency')}} {{$d->p_price}}</td>
                                <td>
                                    {{$d->p_post_limit}}
                                </td>
                                <td>
                                        <span class="badge badge-label text-bg-@php
                                            if($d->p_status=='pending')
                                            {
                                                echo "danger";
                                            }
                                            elseif ($d->p_status=='active')
                                            {
                                                echo "success";
                                            }
                                             @endphp">
                                            {{ucfirst($d->p_status)}}
                                        </span>
                                </td>

                                <td class="d-flex justify-content-center">

                                    <button data-bs-toggle="modal"  class="edit-btn btn btn-sm btn-outline-warning" data-id="{{$d->id}}">
                                        <i class="ti ti-pencil"></i>
                                    </button>
                                   <form action="{{route('admin.package.destroy',$d->id)}}" class="delete-form" method="post">
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
        document.addEventListener("DOMContentLoaded", function () {

            @if ($errors->any())
            var myModal = new bootstrap.Modal(document.getElementById('package-modal'));
            myModal.show();
            @endif

        });
    </script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Package',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3061fd'
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Package Error',
                text: '{{ session('error') }}',
                confirmButtonColor: 'rgb(190,0,0)'
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

    <script>
            $(document).ready(function(){

                // Click Edit Button
                $('.edit-btn').click(function(){
                    let packageId = $(this).data('id');
                    let actionUrl = '/admin/package/edit/' + packageId;

                    $('#package-form').attr('action', actionUrl);

                    $.ajax({
                        url: '/admin/package/getData/' + packageId,
                        type: 'GET',
                        success: function(data){

                            // Populate modal fields
                            $('#modal_package_id').val(data.id);
                            $('#modal_p_name').val(data.p_name);
                            $('#modal_p_detail').summernote('code', data.p_detail);
                            $('#modal_p_benefit').summernote('code', data.p_benefit);
                            $('#modal_p_price').val(data.p_price);
                            $('#modal_p_date_range').val(data.p_date_range);
                            $('#modal_p_post_limit').val(data.p_post_limit);
                            $('#modal_p_status').val(data.p_status);
                            $('#modal_p_credit').val(data.p_credit);

                            // Show modal
                            var modal = new bootstrap.Modal(document.getElementById('edit-package-modal'));
                            modal.show();
                        }
                    });
                });
            });
        </script>

@endpush
