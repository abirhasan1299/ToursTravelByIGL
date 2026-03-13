@extends('layout.admin')
@section('title', 'Gallery')
@push('css')
    <style>
        /* Additional custom polish for gallery */
        .gallery-upload-area {
            background-color: #f8fafc;
            border: 2px dashed #cbd5e1;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .gallery-upload-area:hover {
            border-color: #3061fd;
            background-color: #f1f5f9;
        }
        .gallery-upload-area.dragover {
            border-color: #3061fd;
            background-color: #eef2ff;
        }
        .gallery-card {
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            border-radius: 0.75rem;
            overflow: hidden;
        }
        .gallery-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
        }
        .gallery-img-wrapper {
            height: 200px;
            background-color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .image-checkbox {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 5;
            width: 22px;
            height: 22px;
            accent-color: #3061fd;
            transform: scale(1.1);
            cursor: pointer;
        }
        .delete-selected-btn {
            background: white;
            border: 1px solid #e2e8f0;
            color: #dc2626;
            transition: all 0.15s;
        }
        .delete-selected-btn:hover {
            background: #dc2626;
            color: white;
            border-color: #dc2626;
        }
        .upload-preview-thumb {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 2px solid #fff;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
    </style>
@endpush

@section('content')
    <!-- Assuming your admin layout has a container, we'll embed within the content section -->
    <div class="container-fluid py-4">
        <!-- Page header with elegant actions -->
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4">
            <div>
                <h2 class="fw-semibold text-dark mb-1"><i class="fas fa-images me-2" style="color: #3061fd;"></i>Photo Gallery</h2>
                <p class="text-muted">Manage and organize your uploaded images</p>
            </div>
            <div class="mt-3 mt-md-0">
                <button type="button" class="btn btn-outline-secondary me-2" id="selectAllBtn">
                    <i class="far fa-check-square me-1"></i> Select all
                </button>
                <button type="button" class="btn delete-selected-btn" id="deleteSelectedBtn" disabled>
                    <i class="fas fa-trash-alt me-1"></i> Delete selected
                </button>
            </div>
        </div>

        <!-- Upload card: multiple file upload with preview -->
        <div class="card shadow-sm border-0 rounded-4 mb-5">
            <div class="card-body p-4">
                <h5 class="card-title mb-3"><i class="fas fa-cloud-upload-alt me-2" style="color: #3061fd;"></i>Upload new photos</h5>
                <form method="POST" action="{{route('admin.gallery.store')}}" enctype="multipart/form-data" id="galleryUploadForm">
                    @csrf
                    <div class="gallery-upload-area p-4 text-center rounded-4" id="dropZone">
                        <input type="file" name="photos[]" id="fileInput" multiple accept="image/*" class="d-none">
                        <div class="py-3">
                            <i class="fas fa-image fa-3x text-muted mb-3" style="opacity: 0.6;"></i>
                            <h6 class="fw-semibold">Drag & drop images here or click to browse</h6>
                            <p class="text-muted small mb-2">Supported: JPG, PNG, GIF (max 10MB each)</p>
                            <button type="button" class="btn btn-sm btn-outline-primary px-4" id="browseBtn">
                                <i class="fas fa-folder-open me-1"></i> Choose files
                            </button>
                        </div>
                        <!-- Preview container for selected images -->
                        <div class="row g-2 mt-3 justify-content-center" id="previewContainer"></div>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-5 py-2" id="uploadSubmitBtn" disabled>
                            <i class="fas fa-upload me-2"></i>Upload images
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Gallery grid section: show uploaded photos -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0"><i class="fas fa-photo-video me-2" style="color: #3061fd;"></i>Uploaded photos</h5>
            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">{{ count($photos ?? []) }} items</span>
        </div>

        <div class="row g-4" id="galleryGrid">
            @forelse($photos ?? [] as $photo)
                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2" data-id="{{ $photo->id }}">
                    <div class="card gallery-card h-100 shadow-sm position-relative">
                        <!-- Checkbox for selection -->
                        <input type="checkbox" class="image-checkbox form-check-input" value="{{ $photo->id }}" id="check-{{ $photo->id }}">
                        <div class="gallery-img-wrapper">
                            <img src="{{ asset('storage/gallery/'.$photo->img_name) }}" class="gallery-img" alt="Gallery image">
                        </div>
                        <div class="card-body p-2 d-flex justify-content-between align-items-center bg-white">
                            <small class="text-truncate text-muted" title="{{ $photo->filename }}">{{ $photo->filename }}</small>
                            <button type="button" class="btn btn-sm btn-link text-danger p-0 delete-single" data-id="{{ $photo->id }}" title="Delete">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5 bg-light rounded-4">
                        <i class="far fa-images fa-4x text-muted mb-3"></i>
                        <h6 class="fw-normal text-muted">No photos uploaded yet</h6>
                        <p class="small text-muted">Start by selecting images above</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Hidden form for batch delete (optional but good) -->
        <form method="POST" action="#" id="batchDeleteForm" class="d-none">
            @csrf
            @method('DELETE')
            <input type="hidden" name="ids" id="batchIds">
        </form>
    </div>
@endsection

@push('js')
    <!-- JavaScript for interactivity -->
    <script>
        (function() {
            // DOM elements
            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('fileInput');
            const browseBtn = document.getElementById('browseBtn');
            const previewContainer = document.getElementById('previewContainer');
            const uploadSubmitBtn = document.getElementById('uploadSubmitBtn');
            const selectAllBtn = document.getElementById('selectAllBtn');
            const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
            const galleryGrid = document.getElementById('galleryGrid');
            const batchDeleteForm = document.getElementById('batchDeleteForm');
            const batchIds = document.getElementById('batchIds');

            // Helper: update submit button state based on preview existence
            function updateUploadButton() {
                uploadSubmitBtn.disabled = previewContainer.children.length === 0;
            }

            // Preview selected images (multiple)
            function previewImages(files) {
                previewContainer.innerHTML = ''; // clear previous previews
                if (files.length === 0) {
                    updateUploadButton();
                    return;
                }

                for (let file of files) {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const col = document.createElement('div');
                            col.className = 'col-auto';
                            col.innerHTML = `
                                <div class="position-relative">
                                    <img src="${e.target.result}" class="upload-preview-thumb" alt="preview">
                                    <small class="d-block text-muted mt-1 text-truncate" style="max-width:80px;">${file.name.slice(0,8)}..</small>
                                </div>`;
                            previewContainer.appendChild(col);
                        };
                        reader.readAsDataURL(file);
                    }
                }
                // slight delay to ensure DOM update, then enable button
                setTimeout(updateUploadButton, 50);
            }

            // Browse button triggers file input
            browseBtn.addEventListener('click', () => fileInput.click());

            // On file select via input
            fileInput.addEventListener('change', function(e) {
                previewImages(this.files);
            });

            // Drag & drop events
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => dropZone.classList.add('dragover'));
            });
            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => dropZone.classList.remove('dragover'));
            });
            dropZone.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files; // assign to input (some browsers may need more)
                previewImages(files);
            });

            // Click on drop zone (except buttons) triggers file input
            dropZone.addEventListener('click', (e) => {
                if (e.target.tagName !== 'BUTTON' && e.target.tagName !== 'I') {
                    fileInput.click();
                }
            });

            // Disable upload button initially (no preview)
            updateUploadButton();

            // ------------------------------------------------------------------
            // Gallery selection and delete logic
            // ------------------------------------------------------------------
            const checkboxes = () => document.querySelectorAll('.image-checkbox');
            const anyChecked = () => Array.from(checkboxes()).some(cb => cb.checked);

            // Update delete button state and select all text
            function updateSelectionUI() {
                const checked = anyChecked();
                deleteSelectedBtn.disabled = !checked;
                // Optionally update select all button text
                const allChecked = Array.from(checkboxes()).every(cb => cb.checked);
                selectAllBtn.innerHTML = allChecked ?
                    '<i class="far fa-minus-square me-1"></i> Deselect all' :
                    '<i class="far fa-check-square me-1"></i> Select all';
            }

            // Individual checkbox change
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('image-checkbox')) {
                    updateSelectionUI();
                }
            });

            // Select / deselect all
            selectAllBtn.addEventListener('click', function() {
                const checkboxesList = checkboxes();
                const allChecked = Array.from(checkboxesList).every(cb => cb.checked);
                checkboxesList.forEach(cb => cb.checked = !allChecked);
                updateSelectionUI();
            });

            // Single delete (using SweetAlert as per your layout)
            document.querySelectorAll('.delete-single').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const photoId = this.dataset.id;
                    Swal.fire({
                        title: 'Delete photo?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Perform delete via fetch or redirect to delete route
                            // For demo, we assume route exists. We'll simulate by removing DOM element.
                            // In real implementation, use fetch with CSRF or a form submission.
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/admin/gallery/${photoId}`; // adjust to your route
                            const csrf = document.createElement('input');
                            csrf.name = '_token';
                            csrf.value = '{{ csrf_token() }}';
                            form.appendChild(csrf);
                            const method = document.createElement('input');
                            method.name = '_method';
                            method.value = 'DELETE';
                            form.appendChild(method);
                            document.body.appendChild(form);
                            form.submit();

                        }
                    });
                });
            });

            // Batch delete
            deleteSelectedBtn.addEventListener('click', function() {
                const selected = Array.from(checkboxes()).filter(cb => cb.checked).map(cb => cb.value);
                if (selected.length === 0) return;

                Swal.fire({
                    title: `Delete ${selected.length} photo(s)?`,
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    confirmButtonText: 'Delete',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Use batch delete form
                        batchIds.value = JSON.stringify(selected);
                        batchDeleteForm.submit();
                    }
                });
            });

            // Initial UI update
            updateSelectionUI();
        })();
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
                title: 'Message',
                text: '{{ session('error') }}',
                confirmButtonColor: 'rgb(190,0,0)'
            });
        </script>
    @endif
@endpush
