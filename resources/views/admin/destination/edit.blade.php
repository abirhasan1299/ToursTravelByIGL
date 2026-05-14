@extends('layout.admin')
@section('title','Edit Destination')
@section('content')
    <div class="container">
        <div class="row">
            <form style="width: 60%;margin: auto;" action="{{ route('admin.des.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="container py-4">
                    <div class="card shadow border-0 rounded-3">

                        <!-- Header -->
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Edit Destination</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3">

                                <!-- Overview -->
                                <div class="col-md-12">
                                    <label class="form-label">Overview</label>
                                    <textarea name="overview" class="form-control summernote" id="overviewSummernote" rows="3">{{ old('overview', $data->overview) }}</textarea>
                                    @error('overview')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control summernote" id="descriptionSummernote" rows="4">{{ old('description', $data->description) }}</textarea>
                                    @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Country -->
                                <div class="col-md-6">
                                    <label class="form-label">Country</label>
                                    <input type="text" name="country" class="form-control" value="{{ old('country', $data->country) }}">
                                    @error('country')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Price -->
                                <div class="col-md-6">
                                    <label class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" value="{{ old('price', $data->price) }}">
                                    @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Visa -->
                                <div class="col-md-6">
                                    <label class="form-label d-block">Visa Required</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="visa" value="1"
                                            {{ old('visa', $data->visa) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="visa" value="0"
                                            {{ old('visa', $data->visa) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label">No</label>
                                    </div>
                                    @error('visa')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Languages -->
                                <div class="col-md-6">
                                    <label class="form-label">Languages</label>
                                    <select name="languages[]" id="languages" class="form-control" multiple>
                                        @foreach($languages as $lang)
                                            <option value="{{ $lang }}"
                                                {{ in_array($lang, old('languages', $data->languages ?? [])) ? 'selected' : '' }}>
                                                {{ $lang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('languages')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Map Link -->
                                <div class="col-md-12">
                                    <label class="form-label">Map Link</label>
                                    <textarea name="map_link" class="form-control" rows="2">{{ old('map_link', $data->map_link) }}</textarea>
                                    @error('map_link')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Existing Images -->
                                @if($data->images && count($data->images) > 0)
                                    <div class="col-md-12">
                                        <label class="form-label">Current Images</label>
                                        <div class="row">
                                            @foreach($data->images as $index => $image)
                                                <div class="col-md-3 mb-2">
                                                    <div class="position-relative">
                                                        <img src="{{ asset('storage/' . $image->image_name) }}" class="img-fluid rounded" style="height: 100px; object-fit: cover;">
                                                        <div class="form-check mt-1">
                                                            <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $index }}" id="delete_image_{{ $index }}">
                                                            <label class="form-check-label text-danger small" for="delete_image_{{ $index }}">
                                                                Delete
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <small class="text-muted">Check the box to delete specific images</small>
                                    </div>
                                @endif

                                <!-- New Images -->
                                <div class="col-md-12">
                                    <label class="form-label">Add New Images</label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                    <small class="text-muted">You can upload multiple new images (existing images will be preserved unless deleted)</small>
                                    @error('images')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                    @error('images.*')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer text-end">
                            <a href="{{ route('admin.des.index') }}" class="btn btn-secondary px-4 me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4">
                                Update Destination
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

    <style>
        /* Custom styling for Select2 */
        .select2-container--bootstrap-5 .select2-selection {
            min-height: calc(3.5rem + 2px);
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border-radius: 0.375rem;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered {
            padding: 0.375rem 0.75rem;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice {
            background-color: #0d6efd;
            color: white;
            border: none;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice__remove {
            color: white;
            border-right: 1px solid rgba(255,255,255,0.3);
            margin-right: 0.5rem;
            padding-right: 0.5rem;
        }

        .select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #dc3545;
            background-color: transparent;
        }

        .select2-dropdown {
            border-radius: 0.375rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .select2-container--bootstrap-5 .select2-results__option--selected {
            background-color: #0d6efd;
            color: white;
        }

        .select2-container--bootstrap-5 .select2-results__option--highlighted {
            background-color: #e9ecef;
            color: #212529;
        }

        /* Fix for Select2 in modal/card */
        .select2-container {
            width: 100% !important;
            z-index: 1050;
        }

        /* Better spacing for form label */
        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #495057;
        }

        /* Summernote styling improvements */
        .note-editor.note-frame {
            border-radius: 0.375rem;
            border-color: #dee2e6;
        }

        .note-editor.note-frame .note-editing-area .note-editable {
            background-color: #fff;
        }

        .note-toolbar {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
@endpush

@push('js')
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Make sure jQuery is loaded and DOM is ready
        $(document).ready(function() {
            // Destroy existing Summernote instances to prevent double initialization
            if ($('#overviewSummernote').hasClass('note-editor')) {
                $('#overviewSummernote').summernote('destroy');
            }
            if ($('#descriptionSummernote').hasClass('note-editor')) {
                $('#descriptionSummernote').summernote('destroy');
            }

            // Initialize Summernote with proper configuration
            $('#overviewSummernote').summernote({
                height: 200,
                placeholder: 'Enter overview here...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onInit: function() {
                        console.log('Summernote initialized for overview');
                    }
                }
            });

            $('#descriptionSummernote').summernote({
                height: 250,
                placeholder: 'Enter description here...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                callbacks: {
                    onInit: function() {
                        console.log('Summernote initialized for description');
                    }
                }
            });

            // Initialize Select2 with Bootstrap 5 theme
            if (typeof $.fn.select2 !== 'undefined') {
                $('#languages').select2({
                    placeholder: "Select languages",
                    allowClear: true,
                    theme: 'bootstrap-5',
                    width: '100%',
                    closeOnSelect: false,
                    language: {
                        noResults: function() {
                            return "No languages found";
                        }
                    }
                });

                // Fix for Select2 z-index issues if inside modal
                $('#languages').on('select2:open', function() {
                    document.querySelector('.select2-container--bootstrap-5').style.zIndex = 1050;
                });
            } else {
                console.error('Select2 is not loaded');
            }
        });

        // Additional fix for any dynamically added content
        $(window).on('load', function() {
            if ($('#languages').hasClass('select2-hidden-accessible')) {
                $('#languages').select2('destroy');
                $('#languages').select2({
                    placeholder: "Select languages",
                    allowClear: true,
                    theme: 'bootstrap-5',
                    width: '100%',
                    closeOnSelect: false
                });
            }
        });
    </script>

    @if ($errors->any())
        <script>
            // Check if Swal is loaded
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonColor: '#d33'
                });
            } else {
                alert('Validation Error:\n{!! implode('\n', $errors->all()) !!}');
            }
        </script>
    @endif
@endpush
