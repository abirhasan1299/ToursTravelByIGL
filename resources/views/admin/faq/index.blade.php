@extends('layout.admin')
@section('title', 'Faqs')
@push('css')
@endpush

@section('content')
    @include('admin.partials.create-faq')
    @include('admin.partials.edit-faq')
    <div class="row mt-2">
        <div class="col-12">

            <a href="#faq-modal" data-bs-toggle="modal"  role="button" class="btn btn-primary mb-2"><i class="ti ti-plus"></i> Add FAQ</a>

            <div class="card">
                <div class="card-body">
                    <table data-tables="basic" class="table table-striped dt-responsive align-middle mb-0">
                        <thead class="thead-sm text-uppercase fs-xxs">
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Added</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
@foreach($data as $d)
    <tr>
                         <td>{{$loop->iteration}}</td>
                         <td>{{\Illuminate\Support\Str::limit($d->title, 20)}}</td>
                         <td>
                             <span class="badge badge-label text-bg-@php
                                            if($d->status=='pending')
                                            {
                                                echo "danger";
                                            }
                                            elseif ($d->status=='active')
                                            {
                                                echo "success";
                                            }
                                             @endphp">
                                            {{ucfirst($d->status)}}
                                        </span>
                         </td>
                         <td>{{ $d->created_at->diffForHumans() }}</td>
                         <td class="d-flex justify-content-center">

                             <button data-bs-toggle="modal"  class="edit-btn btn btn-sm btn-outline-warning" data-id="{{$d->id}}">
                                 <i class="ti ti-pencil"></i>
                             </button>
                             <form action="{{route('admin.faqs.destroy',$d->id)}}" class="delete-form" method="post">
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
                var myModal = new bootstrap.Modal(document.getElementById('faq-modal'));
                myModal.show();
            });
        </script>
    @endif

    <script>
        $(document).ready(function(){

            $('.summernote').summernote({
                height: 200
            });

            // Click Edit Button
            $('.edit-btn').click(function(){
                let faqId = $(this).data('id');
                let actionUrl = '/admin/faqs/update/' + faqId;

                $('#edit-form-faq').attr('action', actionUrl);

                $.ajax({
                    url: '/admin/faqs/edit/' + faqId,
                    type: 'GET',
                    success: function(data){

                        // Populate modal fields
                        $('#title').val(data.title);
                        $('#detail').summernote('code', data.detail);
                        $('#edit_status').val(data.status);


                        // Show modal
                        var modal = new bootstrap.Modal(document.getElementById('edit-faq-modal'));
                        modal.show();
                    }
                });
            });
        });
    </script>
@endpush
