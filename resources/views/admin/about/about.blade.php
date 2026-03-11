@extends('layout.admin')
@section('title', 'About Website')
@push('css')

    <style>

        .form-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .form-control {
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            padding: 12px 20px;
            font-size: 15px;
            transition: all 0.3s ease;
            width: 100%;
            background: #f8fafc;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
            background: white;
        }
        .form-control:hover {
            border-color: #764ba2;
        }


        .image-upload-wrapper {
            border: 2px dashed #d1d5db;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            background: #f9fafb;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .image-upload-wrapper:hover {
            border-color: #667eea;
            background: #f3f4f6;
        }
        .image-upload-wrapper i {
            font-size: 48px;
            color: #667eea;
            margin-bottom: 15px;
        }
        .image-preview {
            max-width: 150px;
            max-height: 150px;
            margin: 15px auto;
            border-radius: 50%;
            border: 3px solid #667eea;
            display: none;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        .stat-item {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            padding: 25px;
            border-radius: 15px;
            color: white;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-value {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .btn-submit {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }

    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="form-card">
            <form action="{{route('admin.about.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Hero Section -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="hero_header">
                                <i class="fas fa-heading mr-2"></i>Hero Header
                            </label>
                            <input type="text" class="form-control" id="hero_header" name="hero_header"
                                   placeholder="Enter hero section header" value="{{ old('hero_header',$data->hero_header??'') }}">
                            <i class="fas fa-pen input-icon"></i>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="hero_detail">
                                <i class="fas fa-align-left mr-2"></i>Hero Detail
                            </label>
                            <textarea class="form-control" id="hero_detail" name="hero_detail"
                                      rows="3" placeholder="Enter hero section detail">{{ old('hero_detail',$data->hero_detail??'') }}</textarea>
                            <i class="fas fa-edit input-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Company Info Section -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="company_title">
                                <i class="fas fa-building mr-2"></i>Company Title
                            </label>
                            <input type="text" class="form-control" id="company_title" name="company_title"
                                   placeholder="Enter company title" value="{{ old('company_title',$data->company_title??'') }}">
                            <i class="fas fa-building input-icon"></i>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="mv">
                                <i class="fas fa-bullseye mr-2"></i>Mission & Vision
                            </label>
                            <textarea class="form-control" id="mv" name="mv" rows="3"
                                      placeholder="Enter mission and vision">{{ old('mv',$data->mv??'') }}</textarea>
                            <i class="fas fa-eye input-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Statistics Section -->
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-value">Years of Experience</div>
                        <input type="number" class="form-control text-center" name="exp_years"
                               value="{{ old('exp_years',$data->exp_years??'') }}" placeholder="Enter years">
                    </div>

                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-value">Tour Success</div>
                        <input type="number" class="form-control text-center" name="tour_success"
                               value="{{ old('tour_success',$data->tour_success??'') }}" placeholder="Enter count">
                    </div>

                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-smile"></i>
                        </div>
                        <div class="stat-value">Happy Travelers</div>
                        <input type="number" class="form-control text-center" name="happy_traveler"
                               value="{{ old('happy_traveler',$data->happy_traveler??'') }}" placeholder="Enter count">
                    </div>

                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <div class="stat-value">Awards</div>
                        <input type="number" class="form-control text-center" name="award"
                               value="{{ old('award',$data->award??'') }}" placeholder="Enter count">
                    </div>
                </div>

                <!-- Author Section -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="author_name">
                                <i class="fas fa-user mr-2"></i>Author Name
                            </label>
                            <input type="text" class="form-control" id="author_name" name="author_name"
                                   placeholder="Enter author name" value="{{ old('author_name',$data->author_name??'') }}">
                            <i class="fas fa-user input-icon"></i>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="author_designation">
                                <i class="fas fa-briefcase mr-2"></i>Author Designation
                            </label>
                            <input type="text" class="form-control" id="author_designation" name="author_designation"
                                   placeholder="Enter designation" value="{{ old('author_designation',$data->author_designation??'') }}">
                            <i class="fas fa-briefcase input-icon"></i>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="author_img">
                                <i class="fas fa-image mr-2"></i>Author Image
                            </label>
                            @if(!empty($data->author_img))

                                <center>
                                    <img class="rounded"  style="width: 100px;height: 50px;" src="{{asset('storage/author_img/'.$data->author_img)}}" >
                                </center>
                                <br>
                            @endif

                            <div class="image-upload-wrapper" onclick="document.getElementById('author_img').click()">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Click to upload author image</p>
                                <img id="imagePreview" class="image-preview" src="#" alt="Preview">
                            </div>
                            <input type="file" class="d-none" id="author_img" name="author_img"
                                   accept="image/*" onchange="previewImage(this)">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                     Save About Information
                </button>
            </form>
        </div>
    </div>
@endsection

@push('js')

    <script>
        // Image preview functionality
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const wrapper = input.previousElementSibling;

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    wrapper.querySelector('p').style.display = 'none';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Initialize select2 if needed
        $(document).ready(function() {
            // Add smooth scroll and animation
            $('.form-control').focus(function() {
                $(this).closest('.form-group').addClass('focused');
            }).blur(function() {
                $(this).closest('.form-group').removeClass('focused');
            });

            // Auto-resize textarea
            $('textarea').each(function() {
                this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
            }).on('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });

            // Add animation to stat items
            $('.stat-item').hover(
                function() {
                    $(this).find('input').css('background', 'rgba(255,255,255,0.2)');
                },
                function() {
                    $(this).find('input').css('background', 'white');
                }
            );
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
@endpush
