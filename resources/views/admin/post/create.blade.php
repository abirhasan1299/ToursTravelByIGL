@extends('layout.admin')
@section('title', 'Create New Package')
@push('css')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --primary-light: #eef2ff;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
        }

        body {
            background: #f8fafc;
        }

        /* Form Container */
        .form-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Header Section */
        .page-header {
            background: white;
            border-radius: 1.5rem;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .header-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-gradient);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.3);
        }

        /* Main Card */
        .main-card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            background: white;
        }

        .card-header-custom {
            background: white;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .card-body-custom {
            padding: 2rem;
        }

        /* Form Sections */
        .form-section {
            background: #f8fafc;
            border-radius: 1.25rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .form-section:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title i {
            color: #6366f1;
            font-size: 1.25rem;
        }

        /* Form Controls */
        .form-label {
            font-weight: 500;
            font-size: 0.875rem;
            color: #334155;
            margin-bottom: 0.5rem;
        }

        .form-label .required {
            color: #ef4444;
            margin-left: 0.25rem;
        }

        .form-control, .form-select {
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.625rem 1rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        /* Image Upload Area */
        .image-upload-area {
            border: 2px dashed #e2e8f0;
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #f8fafc;
        }

        .image-upload-area:hover {
            border-color: #6366f1;
            background: #eef2ff;
        }

        .image-preview {
            max-height: 200px;
            border-radius: 0.75rem;
            margin-top: 1rem;
        }

        /* Dual Input Group */
        .dual-input {
            display: flex;
            gap: 1rem;
        }

        .dual-input .input-group-custom {
            flex: 1;
        }

        .input-group-custom .input-label {
            font-size: 0.75rem;
            color: #64748b;
            margin-bottom: 0.25rem;
            display: block;
        }

        /* Select2 Custom */
        .select2-container--default .select2-selection--single {
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            height: 44px;
            padding: 0.5rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 30px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        .btn-save {
            background: var(--primary-gradient);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 500;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
        }

        .btn-reset {
            background: white;
            border: 1.5px solid #e2e8f0;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 500;
            color: #64748b;
        }

        .btn-reset:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        /* Summernote Custom */
        .note-editor.note-frame {
            border-radius: 0.75rem;
            border-color: #e2e8f0;
        }

        .note-editor.note-frame .note-toolbar {
            background: #f8fafc;
            border-radius: 0.75rem 0.75rem 0 0;
        }

        /* Alert */
        .alert-custom {
            border-radius: 1rem;
            border: none;
            background: #fef2f2;
            color: #dc2626;
            padding: 1rem 1.25rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-body-custom {
                padding: 1.25rem;
            }
            .form-section {
                padding: 1rem;
            }
            .dual-input {
                flex-direction: column;
                gap: 0.75rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="form-container">
            <!-- Main Form Card -->
            <div class="main-card">
                <div class="card-header-custom">
                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-2">
                            <i class="ti ti-edit text-primary" style="font-size: 1rem;"></i>
                        </div>
                        <span class="fw-semibold text-secondary">Package Information Form</span>
                    </div>
                </div>

                <div class="card-body-custom">
                    @if ($errors->any())
                        <div class="alert-custom mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <i class="ti ti-alert-circle"></i>
                                <strong>Please fix the following errors:</strong>
                            </div>
                            <ul class="mb-0 mt-2 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data" id="packageForm">
                        @csrf

                        <!-- Section 1: Basic Information -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="ti ti-info-circle"></i>
                                <span>Basic Information</span>
                            </div>

                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label">
                                        Package Title <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           name="title" value="{{ old('title') }}"
                                           placeholder="e.g., Summer Paradise Beach Escape" required>
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label">
                                        Cover Image <span class="required">*</span>
                                    </label>
                                    <div class="image-upload-area" id="imageUploadArea">
                                        <i class="ti ti-cloud-upload" style="font-size: 2.5rem; color: #94a3b8;"></i>
                                        <p class="mt-2 mb-1 fw-medium">Click or drag to upload cover image</p>
                                        <p class="text-muted small mb-0">PNG, JPG or JPEG (Max 5MB)</p>
                                        <div id="imagePreview"></div>
                                    </div>
                                    <input type="file" class="d-none" id="cover_img" name="cover_img" accept="image/*" required>
                                    @error('cover_img')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Amount (BDT) <span class="required">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-1 border-end-0 rounded-start-3">৳</span>
                                        <input type="number" class="form-control @error('amount') is-invalid @enderror border-start-0 rounded-start-0"
                                               name="amount" value="{{ old('amount') }}" min="0" placeholder="Enter amount" required>
                                    </div>
                                    @error('amount')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Duration <span class="required">*</span>
                                    </label>
                                    <div class="dual-input">
                                        <div class="input-group-custom">

                                            <input type="number" class="form-control @error('day') is-invalid @enderror"
                                                   name="day" value="{{ old('day') }}" min="0" placeholder="Days" required>
                                        </div>
                                        <div class="input-group-custom">

                                            <input type="number" class="form-control @error('night') is-invalid @enderror"
                                                   name="night" value="{{ old('night') }}" min="0" placeholder="Nights" required>
                                        </div>
                                    </div>
                                    @error('day')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">
                                        Tour Type <span class="required">*</span>
                                    </label>
                                    <select class="form-select @error('tour_type') is-invalid @enderror" name="tour_type" required>
                                        <option value="" disabled {{ old('tour_type') ? '' : 'selected' }}>Select tour type</option>
                                        <option value="adventure" {{ old('tour_type') == 'adventure' ? 'selected' : '' }}>🏔️ Adventure</option>
                                        <option value="cultural" {{ old('tour_type') == 'cultural' ? 'selected' : '' }}>🏛️ Cultural</option>
                                        <option value="family" {{ old('tour_type') == 'family' ? 'selected' : '' }}>👨‍👩‍👧‍👦 Family</option>
                                        <option value="honeymoon" {{ old('tour_type') == 'honeymoon' ? 'selected' : '' }}>💑 Honeymoon</option>
                                        <option value="beach" {{ old('tour_type') == 'beach' ? 'selected' : '' }}>🏖️ Beach</option>
                                        <option value="wildlife" {{ old('tour_type') == 'wildlife' ? 'selected' : '' }}>🦁 Wildlife</option>
                                    </select>
                                    @error('tour_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">
                                        Maximum People <span class="required">*</span>
                                    </label>
                                    <input type="number" class="form-control @error('max_people') is-invalid @enderror"
                                           name="max_people" value="{{ old('max_people') }}" min="1" placeholder="Maximum participants" required>
                                    @error('max_people')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">
                                        Select Bus <span class="required">*</span>
                                    </label>
                                    <select class="form-select select2 @error('bus_id') is-invalid
                                    @enderror" name="bus_id"   required>
                                       <option value="">---CHOICE BUS---</option>
                                        @foreach($bus as $b)
                                            <option value="{{$b->id}}">{{$b->name}} ({{$b->contact_number}})</option>
                                        @endforeach
                                    </select>
                                    @error('max_people')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Location Details -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="ti ti-map"></i>
                                <span>Location Details</span>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Start Location <span class="required">*</span>
                                    </label>
                                    <select class="form-select select2 @error('start_location') is-invalid @enderror"
                                            name="start_location" required>
                                        <option value="">Select start location</option>
                                        @foreach($state['data'] as $d)
                                            <option value="{{ $d['district'] ?? '' }}"
                                                {{ old('start_location') == ($d['district'] ?? '') ? 'selected' : '' }}>
                                                {{ $d['district'] ?? 'Unknown' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('start_location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        End Location <span class="required">*</span>
                                    </label>
                                    <select class="form-select select2 @error('end_location') is-invalid @enderror"
                                            name="end_location" required>
                                        <option value="">Select end location</option>
                                        @foreach($state['data'] as $d)
                                            <option value="{{ $d['district'] ?? '' }}"
                                                {{ old('end_location') == ($d['district'] ?? '') ? 'selected' : '' }}>
                                                {{ $d['district'] ?? 'Unknown' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('end_location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Include & Exclude -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="ti ti-checklist"></i>
                                <span>Inclusions & Exclusions</span>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="ti ti-check text-success me-1"></i> What's Included
                                    </label>
                                    <textarea class="form-control summernote @error('include') is-invalid @enderror"
                                              name="include" rows="6" placeholder="• Hotel accommodation&#10;• Meals (Breakfast & Dinner)&#10;• Transportation">{{ old('include') }}</textarea>
                                    @error('include')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        <i class="ti ti-x text-danger me-1"></i> What's Excluded
                                    </label>
                                    <textarea class="form-control summernote @error('exclude') is-invalid @enderror"
                                              name="exclude" rows="6" placeholder="• Airfare&#10;• Personal expenses&#10;• Travel insurance">{{ old('exclude') }}</textarea>
                                    @error('exclude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Detailed Description -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="ti ti-article"></i>
                                <span>Tour Details</span>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <label class="form-label">
                                        Detailed Description <span class="required">*</span>
                                    </label>
                                    <textarea class="form-control summernote @error('detail') is-invalid @enderror"
                                              name="detail" rows="8" placeholder="Provide a detailed description of the tour package...">{{ old('detail') }}</textarea>
                                    @error('detail')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <button type="reset" class="btn-reset">
                                <i class="ti ti-refresh me-2"></i>Reset Form
                            </button>
                            <button type="submit" class="btn-save">
                                <i class="ti ti-device-floppy me-2"></i>Save Package
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                theme: 'default',
                width: '100%',
                placeholder: 'Select an option',
                allowClear: true
            });

            // Initialize Summernote
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['codeview', 'help']]
                ]
            });

            // Image upload preview
            const imageUploadArea = document.getElementById('imageUploadArea');
            const coverImageInput = document.getElementById('cover_img');
            const imagePreview = document.getElementById('imagePreview');

            imageUploadArea.addEventListener('click', () => coverImageInput.click());

            coverImageInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.innerHTML = `<img src="${e.target.result}" class="image-preview" alt="Preview">`;
                        imageUploadArea.style.borderColor = '#10b981';
                        imageUploadArea.style.background = '#f0fdf4';
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            });

            // Form reset handler
            document.querySelector('button[type="reset"]').addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to reset all form fields?')) {
                    document.getElementById('packageForm').reset();
                    imagePreview.innerHTML = '';
                    imageUploadArea.style.borderColor = '#e2e8f0';
                    imageUploadArea.style.background = '#f8fafc';
                    $('.select2').val('').trigger('change');
                    $('.summernote').each(function() {
                        $(this).summernote('code', '');
                    });
                }
            });

            // Form validation
            const form = document.getElementById('packageForm');
            form.addEventListener('submit', function(e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Scroll to first error
                    const firstError = document.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
                form.classList.add('was-validated');
            });
        });
    </script>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#6366f1'
            });
        </script>
    @endif
@endpush
