@extends('layout.admin')
@section('title', 'Package')
@push('css')
    <style>
        /* Custom Styles */
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            flex: 1;
        }

        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 20px;
            right: -50%;
            width: 80%;
            height: 2px;
            background: #e9ecef;
            z-index: 1;
        }

        .step.active .step-icon {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
        }

        .step-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }

        .step-text {
            font-size: 0.85rem;
        }

        .border-dashed {
            border: 2px dashed #dee2e6 !important;
            transition: all 0.3s ease;
        }

        .border-dashed:hover {
            border-color: #667eea !important;
            background-color: #f8f9ff !important;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
        }

        .nav-tabs .nav-link {
            color: #6c757d;
            border: none;
            border-bottom: 3px solid transparent;
        }

        .nav-tabs .nav-link.active {
            color: #667eea;
            background: none;
            border-bottom: 3px solid #667eea;
        }

        .nav-tabs .nav-link:hover {
            border-bottom: 3px solid #dee2e6;
        }

        .card {
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(102, 126, 234, 0.3) !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <!-- Page Header -->
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary bg-gradient rounded-3 p-3 me-3 shadow-sm">
                        <i class="ti ti-package text-white" style="font-size: 2rem;"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold mb-1">Create New Package</h2>
                        <p class="text-muted mb-0">Fill in the details below to create a new tour package</p>
                    </div>
                </div>

                <!-- Progress Steps -->
                <div class="d-flex justify-content-between mb-4">
                    <div class="step active">
                        <div class="step-icon bg-primary text-white rounded-circle">1</div>
                        <span class="step-text fw-semibold">Basic Info</span>
                    </div>
                    <div class="step">
                        <div class="step-icon bg-light text-muted rounded-circle">2</div>
                        <span class="step-text text-muted">Package Details</span>
                    </div>
                    <div class="step">
                        <div class="step-icon bg-light text-muted rounded-circle">3</div>
                        <span class="step-text text-muted">Settings</span>
                    </div>
                </div>

                <!-- Main Form Card -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                        <ul class="nav nav-tabs card-header-tabs" id="packageTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active px-4 py-3" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab">
                                    <i class="ti ti-info-circle me-2"></i>Basic Info
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link px-4 py-3" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab">
                                    <i class="ti ti-list-details me-2"></i>Details
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link px-4 py-3" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">
                                    <i class="ti ti-settings me-2"></i>Settings
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body p-4">
                        <form action="#" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <div class="tab-content" id="packageTabContent">
                                <!-- Basic Info Tab -->
                                <div class="tab-pane fade show active" id="basic" role="tabpanel">
                                    <!-- Title -->
                                    <div class="mb-4">
                                        <label for="title" class="form-label fw-semibold">
                                            <i class="ti ti-heading text-primary me-2"></i>Package Title
                                        </label>
                                        <input type="text" class="form-control form-control-lg border-2" id="title" name="title"
                                               placeholder="e.g., Summer Beach Paradise" required>
                                        <div class="invalid-feedback">Please enter a package title.</div>
                                    </div>

                                    <!-- Cover Image -->
                                    <div class="mb-4">
                                        <label for="cover_img" class="form-label fw-semibold">
                                            <i class="ti ti-photo text-primary me-2"></i>Cover Image
                                        </label>
                                        <div class="border-2 border-dashed rounded-3 p-4 text-center bg-light"
                                             style="cursor: pointer;" onclick="document.getElementById('cover_img').click();">
                                            <i class="ti ti-cloud-upload" style="font-size: 2.5rem; color: #6c757d;"></i>
                                            <p class="mb-1 fw-semibold">Click to upload cover image</p>
                                            <p class="text-muted small mb-0">PNG, JPG or JPEG (Max 5MB)</p>
                                        </div>
                                        <input type="file" class="d-none" id="cover_img" name="cover_img" accept="image/*" required>
                                    </div>

                                    <!-- Amount & Duration Row -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label for="amount" class="form-label fw-semibold">
                                                <i class="ti ti-currency-taka text-primary me-2"></i>Amount (BDT)
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-2">BDT</span>
                                                <input type="number" class="form-control border-2" id="amount" name="amount" min="0"
                                                       placeholder="Enter amount" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">
                                                <i class="ti ti-clock text-primary me-2"></i>Duration
                                            </label>
                                            <div class="row g-2">
                                                <div class="col-6">
                                                    <input type="number" class="form-control border-2" id="day" name="day" min="0"
                                                           placeholder="Days" required>
                                                </div>
                                                <div class="col-6">
                                                    <input type="number" class="form-control border-2" id="night" name="night" min="0"
                                                           placeholder="Nights" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tour Type & Max People -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label for="tour_type" class="form-label fw-semibold">
                                                <i class="ti ti-category text-primary me-2"></i>Tour Type
                                            </label>
                                            <select class="form-select form-select-lg border-2" id="tour_type" name="tour_type" required>
                                                <option value="" disabled selected>Select tour type</option>
                                                <option value="adventure">🏔️ Adventure</option>
                                                <option value="cultural">🏛️ Cultural</option>
                                                <option value="family">👨‍👩‍👧‍👦 Family</option>
                                                <option value="honeymoon">💑 Honeymoon</option>
                                                <option value="beach">🏖️ Beach</option>
                                                <option value="wildlife">🦁 Wildlife</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="max_people" class="form-label fw-semibold">
                                                <i class="ti ti-users text-primary me-2"></i>Max People
                                            </label>
                                            <input type="number" class="form-control form-control-lg border-2" id="max_people"
                                                   name="max_people" min="1" placeholder="Maximum participants" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Details Tab -->
                                <div class="tab-pane fade" id="details" role="tabpanel">
                                    <!-- Start & End Location -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label for="start_location" class="form-label fw-semibold">
                                                <i class="ti ti-map-pin text-primary me-2"></i>Start Location
                                            </label>
                                            <select class="form-control border-2  select2" data-toggle="select2" id="start_location" name="start_location"
                                                    required>
                                                <option selected disabled>Select Country</option>
                                                @foreach($data as $d)
                                                    <option value="{{$d['name']}}">{{$d['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end_location" class="form-label fw-semibold">
                                                <i class="ti ti-flag text-primary me-2"></i>End Location
                                            </label>
                                            <select class="form-control border-2  select2" data-toggle="select2" id="end_location" name="end_location"
                                                    required>
                                                <option selected disabled>Select Country</option>
                                                @foreach($data as $d)
                                                    <option value="{{$d['name']}}">{{$d['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Include & Exclude -->
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label for="include" class="form-label fw-semibold">
                                                <i class="ti ti-checkbox text-success me-2"></i>What's Included
                                            </label>
                                            <textarea class="form-control summernote border-2" id="include" name="include" rows="4"
                                                      placeholder="• Hotel accommodation&#10;• Meals (Breakfast & Dinner)&#10;• Transportation"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="exclude" class="form-label fw-semibold">
                                                <i class="ti ti-x text-danger me-2"></i>What's Excluded
                                            </label>
                                            <textarea class="form-control border-2 summernote" id="exclude" name="exclude" rows="4"
                                                      placeholder="• Airfare&#10;• Personal expenses&#10;• Travel insurance"></textarea>
                                        </div>
                                    </div>

                                    <!-- Detail -->
                                    <div class="mb-4">
                                        <label for="detail" class="form-label fw-semibold">
                                            <i class="ti ti-article text-primary me-2"></i>Tour Details
                                        </label>
                                        <textarea class="form-control border-2 summernote" id="detail" name="detail" rows="5"
                                                  placeholder="Provide a detailed description of the tour package..."></textarea>
                                    </div>
                                </div>

                                <!-- Settings Tab -->
                                <div class="tab-pane fade" id="settings" role="tabpanel">
                                    <!-- Status & Subdestination -->
                                    <div class="mb-4">
                                        <label for="status" class="form-label fw-semibold">
                                            <i class="ti ti-toggle-left text-primary me-2"></i>Package Status
                                        </label>
                                        <div class="d-flex gap-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status_active"
                                                       value="active" checked>
                                                <label class="form-check-label" for="status_active">
                                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                                    <i class="ti ti-circle-check me-1"></i>Active
                                                </span>
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status_inactive"
                                                       value="inactive">
                                                <label class="form-check-label" for="status_inactive">
                                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                                                    <i class="ti ti-circle-x me-1"></i>Inactive
                                                </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="subdestination" class="form-label fw-semibold">
                                            <i class="ti ti-location text-primary me-2"></i>Subdestination
                                        </label>
                                        <input type="text" class="form-control border-2" id="subdestination" name="subdestination"
                                               placeholder="e.g., Saint Martin, Sylhet">
                                        <div class="form-text text-muted">
                                            <i class="ti ti-info-circle me-1"></i>Optional: Add specific locations within the package
                                        </div>
                                    </div>

                                    <!-- Preview Section -->
                                    <div class="bg-light rounded-3 p-4">
                                        <h6 class="fw-semibold mb-3">
                                            <i class="ti ti-eye me-2"></i>Package Preview
                                        </h6>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-white rounded-2 p-3 flex-grow-1">
                                                <p class="mb-1 fw-bold" id="preview-title">Package Title</p>
                                                <p class="small text-muted mb-0" id="preview-duration">Duration: 0 Days / 0 Nights</p>
                                            </div>
                                            <span class="badge bg-primary" id="preview-price">৳ 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-flex gap-3 justify-content-end mt-4 pt-3 border-top">

                                <button type="reset" class="btn btn-outline-secondary px-4 py-2 rounded-3">
                                    <i class="ti ti-refresh me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-primary px-5 py-2 rounded-3 shadow-sm">
                                    <i class="ti ti-device-floppy me-2"></i>Save Package
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        // Live preview functionality
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const dayInput = document.getElementById('day');
            const nightInput = document.getElementById('night');
            const amountInput = document.getElementById('amount');

            function updatePreview() {
                document.getElementById('preview-title').textContent = titleInput.value || 'Package Title';
                document.getElementById('preview-duration').textContent =
                    `Duration: ${dayInput.value || 0} Days / ${nightInput.value || 0} Nights`;
                document.getElementById('preview-price').textContent =
                    `৳ ${amountInput.value || 0}`;
            }

            titleInput.addEventListener('input', updatePreview);
            dayInput.addEventListener('input', updatePreview);
            nightInput.addEventListener('input', updatePreview);
            amountInput.addEventListener('input', updatePreview);
        });

        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Image upload preview
        document.getElementById('cover_img').addEventListener('change', function(e) {
            if (e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const uploadArea = document.querySelector('.border-dashed');
                    uploadArea.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded-3" style="max-height: 150px;">`;
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
@endpush
