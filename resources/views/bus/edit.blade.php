@extends('layout.admin')
@section('title', 'Edit Bus')
@push('css')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            --primary-light: #eef2ff;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
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

        /* Input Group */
        .input-group-custom {
            position: relative;
        }

        .input-group-custom .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            z-index: 10;
        }

        .input-group-custom .form-control {
            padding-left: 2.5rem;
        }

        /* Bus Type Badges */
        .bus-type-option {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            background: white;
        }

        .bus-type-option:hover {
            border-color: #6366f1;
            background: #eef2ff;
        }

        .bus-type-option input {
            display: none;
        }

        .bus-type-option.active {
            background: var(--primary-gradient);
            border-color: #6366f1;
            color: white;
        }

        .bus-type-option.active i {
            color: white;
        }

        /* Status Toggle */
        .status-toggle {
            display: flex;
            gap: 1rem;
            padding: 0.5rem 0;
        }

        .status-option {
            flex: 1;
            position: relative;
        }

        .status-option input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 2;
        }

        .status-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem;
            border: 1.5px solid #e2e8f0;
            border-radius: 0.75rem;
            background: white;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .status-option input:checked + .status-label {
            border-color: #10b981;
            background: #f0fdf4;
            color: #10b981;
        }

        .status-option input:checked + .status-label i {
            color: #10b981;
        }

        /* Experience Slider */
        .exp-slider {
            padding: 0.5rem 0;
        }

        .exp-value {
            display: inline-block;
            background: var(--primary-gradient);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: 500;
            margin-top: 0.5rem;
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

        .btn-update {
            background: var(--primary-gradient);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 500;
            color: white;
            transition: all 0.2s ease;
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
        }

        .btn-cancel {
            background: white;
            border: 1.5px solid #e2e8f0;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
        }

        .btn-cancel:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #64748b;
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
            .status-toggle {
                flex-direction: column;
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
                        <span class="fw-semibold text-secondary">Edit Bus Information</span>
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

                    <form action="{{ route('admin.bus.update', $bus->id) }}" method="POST" id="busForm">
                        @csrf
                        @method('PUT')

                        <!-- Section 1: Bus Information -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="ti ti-bus"></i>
                                <span>Bus Information</span>
                            </div>

                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label">
                                        Bus Name <span class="required">*</span>
                                    </label>
                                    <div class="input-group-custom">
                                        <i class="ti ti-id input-icon"></i>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               name="name" value="{{ old('name', $bus->name) }}"
                                               placeholder="e.g., Green Line Volvo - G-1234" required>
                                    </div>
                                    @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Total Seats <span class="required">*</span>
                                    </label>
                                    <div class="input-group-custom">
                                        <i class="ti ti-chair input-icon"></i>
                                        <input type="number" class="form-control @error('total_seat') is-invalid @enderror"
                                               name="total_seat" value="{{ old('total_seat', $bus->total_seat) }}" min="1" max="100"
                                               placeholder="Number of seats" readonly>
                                    </div>
                                    @error('total_seat')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Bus Type <span class="required">*</span>
                                    </label>
                                    <div class="d-flex gap-2 flex-wrap" id="busTypeGroup">
                                        <label class="bus-type-option flex-fill text-center {{ old('bus_type', $bus->bus_type) == 'ac' ? 'active' : '' }}" data-type="ac">
                                            <input type="radio" name="bus_type" value="ac" {{ old('bus_type', $bus->bus_type) == 'ac' ? 'checked' : '' }} required>
                                            <i class="ti ti-snowflake" style="font-size: 1.25rem;"></i>
                                            <span class="d-block small mt-1">AC</span>
                                        </label>
                                        <label class="bus-type-option flex-fill text-center {{ old('bus_type', $bus->bus_type) == 'non-ac' ? 'active' : '' }}" data-type="non-ac">
                                            <input type="radio" name="bus_type" value="non-ac" {{ old('bus_type', $bus->bus_type) == 'non-ac' ? 'checked' : '' }}>
                                            <i class="ti ti-wind" style="font-size: 1.25rem;"></i>
                                            <span class="d-block small mt-1">Non-AC</span>
                                        </label>
                                        <label class="bus-type-option flex-fill text-center {{ old('bus_type', $bus->bus_type) == 'sleeper' ? 'active' : '' }}" data-type="sleeper">
                                            <input type="radio" name="bus_type" value="sleeper" {{ old('bus_type', $bus->bus_type) == 'sleeper' ? 'checked' : '' }}>
                                            <i class="ti ti-bed" style="font-size: 1.25rem;"></i>
                                            <span class="d-block small mt-1">Sleeper</span>
                                        </label>
                                        <label class="bus-type-option flex-fill text-center {{ old('bus_type', $bus->bus_type) == 'luxury' ? 'active' : '' }}" data-type="luxury">
                                            <input type="radio" name="bus_type" value="luxury" {{ old('bus_type', $bus->bus_type) == 'luxury' ? 'checked' : '' }}>
                                            <i class="ti ti-crown" style="font-size: 1.25rem;"></i>
                                            <span class="d-block small mt-1">Luxury</span>
                                        </label>
                                    </div>
                                    @error('bus_type')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">
                                        Status <span class="required">*</span>
                                    </label>
                                    <div class="status-toggle">
                                        <div class="status-option">
                                            <input type="radio" name="status" value="active" id="statusActive"
                                                   {{ old('status', $bus->status) == 'active' ? 'checked' : '' }} required>
                                            <label for="statusActive" class="status-label">
                                                <i class="ti ti-circle-check" style="font-size: 1.25rem;"></i>
                                                <span>Active</span>
                                            </label>
                                        </div>
                                        <div class="status-option">
                                            <input type="radio" name="status" value="inactive" id="statusInactive"
                                                {{ old('status', $bus->status) == 'inactive' ? 'checked' : '' }}>
                                            <label for="statusInactive" class="status-label">
                                                <i class="ti ti-circle-x" style="font-size: 1.25rem;"></i>
                                                <span>Inactive</span>
                                            </label>
                                        </div>
                                        <div class="status-option">
                                            <input type="radio" name="status" value="maintenance" id="statusMaintenance"
                                                {{ old('status', $bus->status) == 'maintenance' ? 'checked' : '' }}>
                                            <label for="statusMaintenance" class="status-label">
                                                <i class="ti ti-tool" style="font-size: 1.25rem;"></i>
                                                <span>Maintenance</span>
                                            </label>
                                        </div>
                                    </div>
                                    @error('status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Driver Information -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="ti ti-user-circle"></i>
                                <span>Driver Information</span>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        Driver Name <span class="required">*</span>
                                    </label>
                                    <div class="input-group-custom">
                                        <i class="ti ti-user input-icon"></i>
                                        <input type="text" class="form-control @error('driver_name') is-invalid @enderror"
                                               name="driver_name" value="{{ old('driver_name', $bus->driver_name) }}"
                                               placeholder="Full name of driver" required>
                                    </div>
                                    @error('driver_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Driving Experience (Years) <span class="required">*</span>
                                    </label>
                                    <div class="exp-slider">
                                        <input type="range" class="form-range" id="experienceSlider"
                                               name="driver_exp" min="0" max="40" step="1"
                                               value="{{ old('driver_exp', $bus->driver_exp) }}">
                                        <div class="d-flex justify-content-between mt-2">
                                            <span class="small text-muted">0 years</span>
                                            <span class="exp-value" id="expValue">{{ old('driver_exp', $bus->driver_exp) }} years</span>
                                            <span class="small text-muted">40+ years</span>
                                        </div>
                                    </div>
                                    @error('driver_exp')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Additional Information (Optional) -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="ti ti-info-circle"></i>
                                <span>Additional Information (Optional)</span>
                            </div>

                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label">
                                        Bus Model / Make
                                    </label>
                                    <input type="text" class="form-control" name="model" value="{{ old('model', $bus->model) }}"
                                           placeholder="e.g., Volvo B9R, Scania, Tata">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Registration Number
                                    </label>
                                    <input type="text" class="form-control" name="reg_number" value="{{ old('reg_number', $bus->reg_number) }}"
                                           placeholder="e.g., DHAKA-METRO-1234">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">
                                        Contact Number
                                    </label>
                                    <input type="tel" class="form-control" name="contact_number" value="{{ old('contact_number', $bus->contact_number) }}"
                                           placeholder="Driver/Operator contact number">
                                </div>


                                <div class="col-12">
                                    <label class="form-label">
                                        Additional Notes
                                    </label>
                                    <textarea class="form-control" name="notes" rows="3"
                                              placeholder="Any additional information about the bus or driver...">{{ old('notes', $bus->notes) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('admin.bus.index') }}" class="btn-cancel">
                                <i class="ti ti-x me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn-update">
                                <i class="ti ti-device-floppy me-2"></i>Update Bus
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
            // Bus type selection styling
            $('.bus-type-option').click(function() {
                $(this).addClass('active').siblings().removeClass('active');
            });

            // Experience slider handler
            const slider = document.getElementById('experienceSlider');
            const expValue = document.getElementById('expValue');

            if (slider) {
                slider.addEventListener('input', function() {
                    const years = this.value;
                    expValue.textContent = years + (years == 1 ? ' year' : ' years');
                });
            }

            // Form validation on submit
            $('#busForm').on('submit', function(e) {
                let isValid = true;

                // Check required fields
                const requiredFields = ['name', 'total_seat', 'bus_type', 'status', 'driver_name', 'driver_exp'];
                requiredFields.forEach(field => {
                    const input = $(`[name="${field}"]`);
                    if (input.is(':radio')) {
                        if (!$(`input[name="${field}"]:checked`).length) {
                            isValid = false;
                            input.closest('.form-section').find('.section-title').addClass('text-danger');
                        }
                    } else if (!input.val()) {
                        isValid = false;
                        input.addClass('is-invalid');
                    } else {
                        input.removeClass('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please fill in all required fields.',
                        confirmButtonColor: '#6366f1'
                    });

                    // Scroll to first error
                    const firstError = $('.is-invalid').first();
                    if (firstError.length) {
                        firstError[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        });
    </script>
@endpush
