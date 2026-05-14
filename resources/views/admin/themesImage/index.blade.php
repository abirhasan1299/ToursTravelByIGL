@extends('layout.admin')
@section('title','Theme Images Settings')

@section('content')
    <div class="container-fluid px-4 py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">

                {{-- Main Card --}}
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    {{-- Header --}}
                    <div class="card-header bg-gradient-primary text-white py-3 px-4">
                        <div class="d-flex align-items-center gap-3">
                            <i class="ti ti-photo fs-1"></i>
                            <div>
                                <h4 class="mb-0 fw-bold">Theme Images Settings</h4>
                                <p class="mb-0 opacity-75 small">
                                    Manage the main background image used across the theme layout.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form action="{{route('admin.themes.store')}}" method="POST" enctype="multipart/form-data" id="themeImagesForm">
                        @csrf
                        <div class="card-body p-4 p-lg-5">

                            {{-- Error Alerts --}}
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                    <i class="ti ti-alert-circle"></i>
                                    <strong>Please fix the following errors:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            {{-- Success Message --}}
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                                    <i class="ti ti-check-circle"></i> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            {{-- Global Info --}}
                            <div class="alert alert-info bg-info bg-opacity-10 border-0 rounded-3 mb-4">
                                <i class="ti ti-info-circle me-2"></i>
                                <strong>Note:</strong> Upload an image in JPG, PNG, or WebP format. Recommended size: 1920x1080px for optimal display as a background.
                            </div>

                            {{-- Single Image Field --}}
                            <div class="row g-4">
                                <div class="col-md-8 col-lg-6 mx-auto">
                                    <div class="card h-100 border rounded-3 shadow-sm overflow-hidden">
                                        <div class="card-header bg-light py-3">
                                            <label class="fw-bold mb-0 fs-5"><i class="ti ti-photo me-2 text-primary"></i> Theme Background Image</label>
                                        </div>
                                        <div class="card-body text-center">
                                            {{-- File Input --}}
                                            <input type="file" name="theme_background_img" class="form-control @error('theme_background_img') is-invalid @enderror" accept="image/*">
                                            @error('theme_background_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            {{-- Preview of Existing Image --}}
                                            @if(isset($img['img']))
                                                <div class="mt-4">
                                                    <p class="text-muted small mb-2">Current Image:</p>
                                                    <img src="{{ asset($img['img']) }}" alt="Theme Background" class="img-fluid border rounded shadow-sm" style="max-height: 180px; object-fit: cover; width: 100%;">
                                                </div>
                                            @else
                                                <div class="mt-4 text-muted">
                                                    <i class="ti ti-cloud-upload fs-1 opacity-50"></i>
                                                    <p class="small mb-0">No image uploaded yet. Please choose an image above.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Footer Buttons --}}
                        <div class="card-footer bg-light border-0 py-3 px-4 px-lg-5 d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="ti ti-arrow-left"></i> Back to Dashboard
                            </a>
                            <button type="submit" class="btn btn-dark rounded-pill px-5 shadow-sm">
                                <i class="ti ti-device-floppy"></i> Update Theme Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.08) !important;
        }
        .form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.15);
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function(){
            // Optional: Display selected file name for better UX
            $('input[type="file"]').on('change', function(){
                let fileName = $(this).val().split('\\').pop();
                if(fileName) {
                    // Remove any existing filename hint
                    $(this).nextAll('.form-text.text-muted').remove();
                    // Show new filename hint
                    $(this).after('<div class="form-text text-muted mt-1">Selected: ' + fileName + '</div>');
                }
            });
        });
    </script>
@endpush
