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
                                    Manage images used across the theme layout, hero sections, and about pages.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form action="#" method="POST" enctype="multipart/form-data" id="themeImagesForm">
                        @csrf
                        @method('PUT')
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
                                <strong>Note:</strong> All image fields are <span class="text-danger">required</span> for a complete theme setup. Upload images in JPG, PNG, or WebP format. Recommended size: 1920x1080px for backgrounds, 800x800px for icons and thumbnails.
                            </div>

                            {{-- 11 IMAGE FIELDS GRID --}}
                            <div class="row g-4">

                                {{-- 1. theme_background_img --}}
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border rounded-3 shadow-sm overflow-hidden">
                                        <div class="card-header bg-light py-2">
                                            <label class="fw-bold mb-0"><i class="ti ti-photo me-1 text-primary"></i> Theme Background Image</label>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" name="theme_background_img" class="form-control @error('theme_background_img') is-invalid @enderror" accept="image/*">
                                            @error('theme_background_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if(isset($settings['theme_background_img']) && $settings['theme_background_img'])
                                                <div class="mt-3">
                                                    <img src="{{ asset($settings['theme_background_img']) }}" alt="Theme Background" class="img-fluid border rounded" style="max-height: 100px; object-fit: cover; width: 100%;">
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" name="remove_theme_background_img" value="1" class="form-check-input" id="removeThemeBg">
                                                        <label class="form-check-label text-danger small" for="removeThemeBg">Remove current image</label>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- 2. about_large_img --}}
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border rounded-3 shadow-sm overflow-hidden">
                                        <div class="card-header bg-light py-2">
                                            <label class="fw-bold mb-0"><i class="ti ti-photo me-1 text-primary"></i> About Large Image</label>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" name="about_large_img" class="form-control @error('about_large_img') is-invalid @enderror" accept="image/*">
                                            @error('about_large_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if(isset($settings['about_large_img']) && $settings['about_large_img'])
                                                <div class="mt-3">
                                                    <img src="{{ asset($settings['about_large_img']) }}" alt="About Large" class="img-fluid border rounded" style="max-height: 100px; object-fit: cover; width: 100%;">
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" name="remove_about_large_img" value="1" class="form-check-input" id="removeAboutLarge">
                                                        <label class="form-check-label text-danger small" for="removeAboutLarge">Remove current image</label>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- 3. about_small_img --}}
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border rounded-3 shadow-sm overflow-hidden">
                                        <div class="card-header bg-light py-2">
                                            <label class="fw-bold mb-0"><i class="ti ti-photo me-1 text-primary"></i> About Small Image</label>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" name="about_small_img" class="form-control @error('about_small_img') is-invalid @enderror" accept="image/*">
                                            @error('about_small_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if(isset($settings['about_small_img']) && $settings['about_small_img'])
                                                <div class="mt-3">
                                                    <img src="{{ asset($settings['about_small_img']) }}" alt="About Small" class="img-fluid border rounded" style="max-height: 100px; object-fit: cover; width: 100%;">
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" name="remove_about_small_img" value="1" class="form-check-input" id="removeAboutSmall">
                                                        <label class="form-check-label text-danger small" for="removeAboutSmall">Remove current image</label>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- 4. bd_travels_bg --}}
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border rounded-3 shadow-sm overflow-hidden">
                                        <div class="card-header bg-light py-2">
                                            <label class="fw-bold mb-0"><i class="ti ti-photo me-1 text-primary"></i> BD Travels Background</label>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" name="bd_travels_bg" class="form-control @error('bd_travels_bg') is-invalid @enderror" accept="image/*">
                                            @error('bd_travels_bg')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if(isset($settings['bd_travels_bg']) && $settings['bd_travels_bg'])
                                                <div class="mt-3">
                                                    <img src="{{ asset($settings['bd_travels_bg']) }}" alt="BD Travels BG" class="img-fluid border rounded" style="max-height: 100px; object-fit: cover; width: 100%;">
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" name="remove_bd_travels_bg" value="1" class="form-check-input" id="removeBdTravelsBg">
                                                        <label class="form-check-label text-danger small" for="removeBdTravelsBg">Remove current image</label>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- 5. choose_round_img --}}
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border rounded-3 shadow-sm overflow-hidden">
                                        <div class="card-header bg-light py-2">
                                            <label class="fw-bold mb-0"><i class="ti ti-photo me-1 text-primary"></i> Choose Round Image</label>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" name="choose_round_img" class="form-control @error('choose_round_img') is-invalid @enderror" accept="image/*">
                                            @error('choose_round_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if(isset($settings['choose_round_img']) && $settings['choose_round_img'])
                                                <div class="mt-3">
                                                    <img src="{{ asset($settings['choose_round_img']) }}" alt="Choose Round" class="img-fluid border rounded-circle" style="max-height: 100px; width: 100px; object-fit: cover;">
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" name="remove_choose_round_img" value="1" class="form-check-input" id="removeChooseRound">
                                                        <label class="form-check-label text-danger small" for="removeChooseRound">Remove current image</label>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- 6. choose_taller_img --}}
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border rounded-3 shadow-sm overflow-hidden">
                                        <div class="card-header bg-light py-2">
                                            <label class="fw-bold mb-0"><i class="ti ti-photo me-1 text-primary"></i> Choose Taller Image</label>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" name="choose_taller_img" class="form-control @error('choose_taller_img') is-invalid @enderror" accept="image/*">
                                            @error('choose_taller_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if(isset($settings['choose_taller_img']) && $settings['choose_taller_img'])
                                                <div class="mt-3">
                                                    <img src="{{ asset($settings['choose_taller_img']) }}" alt="Choose Taller" class="img-fluid border rounded" style="max-height: 120px; object-fit: cover; width: 100%;">
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" name="remove_choose_taller_img" value="1" class="form-check-input" id="removeChooseTaller">
                                                        <label class="form-check-label text-danger small" for="removeChooseTaller">Remove current image</label>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- 7. choose_glass_img --}}
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border rounded-3 shadow-sm overflow-hidden">
                                        <div class="card-header bg-light py-2">
                                            <label class="fw-bold mb-0"><i class="ti ti-photo me-1 text-primary"></i> Choose Glass Image</label>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" name="choose_glass_img" class="form-control @error('choose_glass_img') is-invalid @enderror" accept="image/*">
                                            @error('choose_glass_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if(isset($settings['choose_glass_img']) && $settings['choose_glass_img'])
                                                <div class="mt-3">
                                                    <img src="{{ asset($settings['choose_glass_img']) }}" alt="Choose Glass" class="img-fluid border rounded" style="max-height: 100px; object-fit: cover; width: 100%;">
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" name="remove_choose_glass_img" value="1" class="form-check-input" id="removeChooseGlass">
                                                        <label class="form-check-label text-danger small" for="removeChooseGlass">Remove current image</label>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- 8. about_us_bg_img --}}
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border rounded-3 shadow-sm overflow-hidden">
                                        <div class="card-header bg-light py-2">
                                            <label class="fw-bold mb-0"><i class="ti ti-photo me-1 text-primary"></i> About Us Background Image</label>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" name="about_us_bg_img" class="form-control @error('about_us_bg_img') is-invalid @enderror" accept="image/*">
                                            @error('about_us_bg_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if(isset($settings['about_us_bg_img']) && $settings['about_us_bg_img'])
                                                <div class="mt-3">
                                                    <img src="{{ asset($settings['about_us_bg_img']) }}" alt="About Us BG" class="img-fluid border rounded" style="max-height: 100px; object-fit: cover; width: 100%;">
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" name="remove_about_us_bg_img" value="1" class="form-check-input" id="removeAboutUsBg">
                                                        <label class="form-check-label text-danger small" for="removeAboutUsBg">Remove current image</label>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- 9. about_us_single_girl_img --}}
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border rounded-3 shadow-sm overflow-hidden">
                                        <div class="card-header bg-light py-2">
                                            <label class="fw-bold mb-0"><i class="ti ti-photo me-1 text-primary"></i> About Us Single Girl Image</label>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" name="about_us_single_girl_img" class="form-control @error('about_us_single_girl_img') is-invalid @enderror" accept="image/*">
                                            @error('about_us_single_girl_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if(isset($settings['about_us_single_girl_img']) && $settings['about_us_single_girl_img'])
                                                <div class="mt-3">
                                                    <img src="{{ asset($settings['about_us_single_girl_img']) }}" alt="Single Girl" class="img-fluid border rounded" style="max-height: 100px; object-fit: cover; width: 100%;">
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" name="remove_about_us_single_girl_img" value="1" class="form-check-input" id="removeSingleGirl">
                                                        <label class="form-check-label text-danger small" for="removeSingleGirl">Remove current image</label>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- 10. additional placeholder (if needed – per your image list we have 9 so far, but you mentioned 11. Adding two extra consistent fields to reach 11) --}}
                                {{-- 10. theme_overlay_img --}}
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border rounded-3 shadow-sm overflow-hidden">
                                        <div class="card-header bg-light py-2">
                                            <label class="fw-bold mb-0"><i class="ti ti-photo me-1 text-primary"></i> Theme Overlay Image</label>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" name="theme_overlay_img" class="form-control @error('theme_overlay_img') is-invalid @enderror" accept="image/*">
                                            @error('theme_overlay_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if(isset($settings['theme_overlay_img']) && $settings['theme_overlay_img'])
                                                <div class="mt-3">
                                                    <img src="{{ asset($settings['theme_overlay_img']) }}" alt="Theme Overlay" class="img-fluid border rounded" style="max-height: 100px; object-fit: cover; width: 100%;">
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" name="remove_theme_overlay_img" value="1" class="form-check-input" id="removeThemeOverlay">
                                                        <label class="form-check-label text-danger small" for="removeThemeOverlay">Remove current image</label>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- 11. footer_pattern_img --}}
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border rounded-3 shadow-sm overflow-hidden">
                                        <div class="card-header bg-light py-2">
                                            <label class="fw-bold mb-0"><i class="ti ti-photo me-1 text-primary"></i> Footer Pattern Image</label>
                                        </div>
                                        <div class="card-body">
                                            <input type="file" name="footer_pattern_img" class="form-control @error('footer_pattern_img') is-invalid @enderror" accept="image/*">
                                            @error('footer_pattern_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror

                                            @if(isset($settings['footer_pattern_img']) && $settings['footer_pattern_img'])
                                                <div class="mt-3">
                                                    <img src="{{ asset($settings['footer_pattern_img']) }}" alt="Footer Pattern" class="img-fluid border rounded" style="max-height: 100px; object-fit: cover; width: 100%;">
                                                    <div class="form-check mt-2">
                                                        <input type="checkbox" name="remove_footer_pattern_img" value="1" class="form-check-input" id="removeFooterPattern">
                                                        <label class="form-check-label text-danger small" for="removeFooterPattern">Remove current image</label>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Note: All 11 fields are required, client-side hint --}}
                            <div class="alert alert-warning mt-4 mb-0 rounded-3 bg-warning bg-opacity-10 border-warning">
                                <i class="ti ti-alert-triangle me-2"></i>
                                <strong>Important:</strong> All 11 image fields are required. To keep an existing image unchanged, simply leave the file input empty. Check the "Remove" box if you want to delete the current image entirely.
                            </div>
                        </div>

                        {{-- Footer Buttons --}}
                        <div class="card-footer bg-light border-0 py-3 px-4 px-lg-5 d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="ti ti-arrow-left"></i> Back to Dashboard
                            </a>
                            <button type="submit" class="btn btn-dark rounded-pill px-5 shadow-sm">
                                <i class="ti ti-device-floppy"></i> Update Theme Images
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
        .rounded-circle {
            border-radius: 50% !important;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function(){
            // Optional: additional client-side validation or preview functionality
            $('input[type="file"]').on('change', function(){
                let fileName = $(this).val().split('\\').pop();
                if(fileName) {
                    $(this).next('.form-text').remove();
                    $(this).after('<div class="form-text text-muted mt-1">Selected: ' + fileName + '</div>');
                }
            });
        });
    </script>
@endpush
