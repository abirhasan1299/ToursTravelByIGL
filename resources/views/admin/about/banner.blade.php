{{-- resources/views/admin/gallery.blade.php --}}
@extends('layout.admin')
@section('title', 'Banner Gallery')

@push('css')
    <style>
        .table-gallery-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            background-color: #f1f5f9;
        }
        .btn-icon {
            background: none;
            border: none;
            color: #dc2626;
            transition: opacity 0.2s;
            padding: 6px 10px;
            cursor: pointer;
        }
        .btn-icon:hover {
            opacity: 0.7;
            color: #b91c1c;
        }
        .upload-area {
            background-color: #f8fafc;
            border: 2px dashed #cbd5e1;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .upload-area:hover {
            border-color: #3061fd;
            background-color: #f1f5f9;
        }
        .upload-area.dragover {
            border-color: #3061fd;
            background-color: #eef2ff;
        }
        .upload-preview-thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            background-color: #f1f5f9;
        }
        .image-name {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        /* Fallback untuk gambar broken */
        .table-gallery-img::before,
        .upload-preview-thumb::before {
            content: "📷";
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background-color: #e2e8f0;
            color: #64748b;
            font-size: 1.5rem;
        }
        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-semibold text-dark mb-1">
                    <i class="fas fa-images me-2" style="color: #3061fd;"></i>
                    Banner Gallery
                </h2>
                <p class="text-muted">Manage banner images - upload, view, and delete</p>
            </div>
            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                <i class="fas fa-image me-1"></i> Total: {{ count($photos) }}
            </span>
        </div>

        <!-- Upload Card -->
        <div class="card shadow-sm border-0 rounded-4 mb-5">
            <div class="card-body p-4">
                <h5 class="card-title mb-3">
                    <i class="fas fa-cloud-upload-alt me-2" style="color: #3061fd;"></i>
                    Upload New Banner Images
                </h5>

                <form method="POST" action="{{ route('admin.banner.store') }}" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <div class="upload-area p-4 text-center rounded-4" id="dropZone">
                        <input type="file" name="photos[]" id="fileInput" multiple accept="image/*" class="d-none">
                        <div class="py-3">
                            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3" style="opacity: 0.6;"></i>
                            <h6 class="fw-semibold">Drag & drop images here or click to browse</h6>
                            <p class="text-muted small mb-2">
                                <i class="fas fa-info-circle me-1"></i>
                                Supported: JPG, PNG, WEBP, GIF (max 1MB each)
                            </p>
                            <button type="button" class="btn btn-sm btn-outline-primary px-4" id="browseBtn">
                                <i class="fas fa-folder-open me-1"></i> Choose files
                            </button>
                        </div>
                        <div class="row g-2 mt-3 justify-content-center" id="previewContainer"></div>
                    </div>

                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div id="fileCount" class="text-muted small"></div>
                        <button type="submit" class="btn btn-primary px-5 py-2" id="uploadSubmitBtn" disabled>
                            <i class="fas fa-upload me-2"></i>Upload Images
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Gallery Table -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-transparent border-0 pt-4 px-4">
                <h5 class="mb-0">
                    <i class="fas fa-database me-2" style="color: #3061fd;"></i>
                    Uploaded Banners
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th style="width: 80px">Preview</th>
                            <th>Filename</th>
                            <th>Image Name</th>

                            <th style="width: 100px" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($photos as $photo)
                            <tr data-id="{{ $photo->id }}">
                                <td>
                                    <img src="{{ asset('storage/banner/'.$photo->name) }}"
                                         class="table-gallery-img"
                                         alt="Banner image {{ $photo->filename }}"
                                         loading="lazy"
                                         onerror="this.onerror=null; this.src='{{ asset('images/placeholder.png') }}'; this.style.objectFit='contain'; this.style.padding='8px';">
                                </td>
                                <td class="image-name">
                                    <span class="text-muted">{{ $photo->name ?: 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark">{{ $photo->filename ?: 'No name' }}</span>
                                </td>

                                <td class="text-center">
                                    <button type="button"
                                            class="btn-icon delete-single"
                                            data-id="{{ $photo->id }}"
                                            data-name="{{ $photo->filename ?: $photo->name }}"
                                            title="Delete Banner">
                                        <i class="fas fa-trash-alt fa-lg"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="far fa-images fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted mb-2">No banner images uploaded yet</p>
                                    <small class="text-muted">Upload your first banner image using the form above</small>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Single Delete Form -->
    <form id="singleDeleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('js')
    <!-- Font Awesome 6 (Free) CDN for consistent icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function() {
            // DOM Elements
            const fileInput = document.getElementById('fileInput');
            const browseBtn = document.getElementById('browseBtn');
            const previewContainer = document.getElementById('previewContainer');
            const uploadSubmitBtn = document.getElementById('uploadSubmitBtn');
            const dropZone = document.getElementById('dropZone');
            const fileCount = document.getElementById('fileCount');
            const uploadForm = document.getElementById('uploadForm');

            // Client-side validation before upload
            function validateFiles(files) {
                const errors = [];
                const maxSize = 1 * 1024 * 1024; // 1MB
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];

                    // Check file type
                    if (!allowedTypes.includes(file.type)) {
                        errors.push(`${file.name}: Unsupported format. Only JPG, PNG, WEBP, GIF allowed.`);
                    }

                    // Check file size
                    if (file.size > maxSize) {
                        errors.push(`${file.name}: Exceeds 1MB limit.`);
                    }
                }

                return errors;
            }

            // Update upload button state
            function updateUploadButton() {
                const files = fileInput.files;
                const hasFiles = files.length > 0;
                uploadSubmitBtn.disabled = !hasFiles;

                if (hasFiles) {
                    // Validate files before enabling upload
                    const validationErrors = validateFiles(Array.from(files));
                    if (validationErrors.length > 0) {
                        uploadSubmitBtn.disabled = true;
                        fileCount.innerHTML = `<i class="fas fa-exclamation-triangle text-danger me-1"></i> ${validationErrors.length} file(s) invalid`;
                        fileCount.style.color = '#dc2626';
                    } else {
                        fileCount.innerHTML = `<i class="fas fa-check-circle text-success me-1"></i> ${files.length} file(s) selected (max 1MB each)`;
                        fileCount.style.color = '';
                        uploadSubmitBtn.classList.add('btn-primary');
                        uploadSubmitBtn.classList.remove('btn-secondary');
                    }
                } else {
                    fileCount.innerHTML = '';
                    uploadSubmitBtn.classList.remove('btn-primary');
                    uploadSubmitBtn.classList.add('btn-secondary');
                }
            }

            // Update preview thumbnails
            function updatePreview() {
                previewContainer.innerHTML = '';
                const files = Array.from(fileInput.files);

                if (files.length === 0) {
                    updateUploadButton();
                    return;
                }

                files.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-auto position-relative';
                        col.style.width = '80px';
                        col.innerHTML = `
                            <div class="position-relative" style="width: 70px; margin: 0 auto;">
                                <img src="${e.target.result}" class="upload-preview-thumb" alt="Preview" style="width: 70px; height: 70px; object-fit: cover;">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 start-100 translate-middle rounded-circle p-0 d-flex align-items-center justify-content-center"
                                        style="width: 22px; height: 22px; font-size: 12px; line-height: 1; border: none;"
                                        data-index="${index}">
                                    <i class="fas fa-times fa-xs"></i>
                                </button>
                                <small class="text-muted d-block text-center mt-1" style="font-size: 10px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 70px;">
                                    ${file.name.length > 12 ? file.name.substring(0, 10) + '...' : file.name}
                                </small>
                            </div>
                        `;
                        previewContainer.appendChild(col);

                        const removeBtn = col.querySelector('button');
                        removeBtn.addEventListener('click', (e) => {
                            e.stopPropagation();
                            const dt = new DataTransfer();
                            const newFiles = Array.from(fileInput.files).filter((_, i) => i !== index);
                            newFiles.forEach(f => dt.items.add(f));
                            fileInput.files = dt.files;
                            updatePreview();
                            updateUploadButton();
                        });
                    };
                    reader.readAsDataURL(file);
                });
                updateUploadButton();
            }

            // File input change handler
            fileInput.addEventListener('change', updatePreview);

            // Browse button click handler
            browseBtn.addEventListener('click', (e) => {
                e.preventDefault();
                fileInput.click();
            });

            // Drag and drop handlers
            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.classList.add('dragover');
            });

            dropZone.addEventListener('dragleave', () => {
                dropZone.classList.remove('dragover');
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    const dt = new DataTransfer();
                    Array.from(fileInput.files).forEach(f => dt.items.add(f));
                    Array.from(files).forEach(f => dt.items.add(f));
                    fileInput.files = dt.files;
                    updatePreview();
                }
            });

            // Click on dropzone to open file dialog (but not when clicking on remove buttons)
            dropZone.addEventListener('click', (e) => {
                if (!e.target.closest('button')) {
                    fileInput.click();
                }
            });

            // Form submit handler with client-side validation
            uploadForm.addEventListener('submit', function(e) {
                if (fileInput.files.length === 0) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'No files selected',
                        text: 'Please select at least one image to upload.',
                        confirmButtonColor: '#3061fd'
                    });
                    return;
                }

                // Client-side validation before sending to server
                const validationErrors = validateFiles(Array.from(fileInput.files));
                if (validationErrors.length > 0) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: validationErrors.join('<br>'),
                        confirmButtonColor: '#dc2626'
                    });
                    return;
                }

                // Show loading state
                uploadSubmitBtn.disabled = true;
                uploadSubmitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Uploading...';
            });

            // Single Delete with SweetAlert
            const singleDeleteForm = document.getElementById('singleDeleteForm');

            document.querySelectorAll('.delete-single').forEach(btn => {
                btn.addEventListener('click', async function(e) {
                    e.preventDefault();
                    const photoId = this.dataset.id;
                    const photoName = this.dataset.name || 'this image';

                    const result = await Swal.fire({
                        title: 'Delete Banner Image?',
                        html: `Are you sure you want to delete <strong>"${escapeHtml(photoName)}"</strong>?`,
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    });

                    if (result.isConfirmed) {
                        // Show loading state
                        Swal.fire({
                            title: 'Deleting...',
                            text: 'Please wait while we delete the image',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        singleDeleteForm.action = `/admin/banner/${photoId}`;
                        singleDeleteForm.submit();
                    }
                });
            });

            // Helper function to escape HTML
            function escapeHtml(str) {
                if (!str) return '';
                return str.replace(/[&<>]/g, function(m) {
                    if (m === '&') return '&amp;';
                    if (m === '<') return '&lt;';
                    if (m === '>') return '&gt;';
                    return m;
                }).replace(/[\uD800-\uDBFF][\uDC00-\uDFFF]/g, function(c) {
                    return c;
                });
            }

            // Optional: Refresh image preview for existing photos if they fail to load
            document.querySelectorAll('.table-gallery-img').forEach(img => {
                img.addEventListener('error', function() {
                    if (!this.dataset.fallbackAttempted) {
                        this.dataset.fallbackAttempted = 'true';
                        // Try alternative storage paths
                        const originalSrc = this.src;
                        const possiblePaths = [
                            originalSrc,
                            originalSrc.replace('/storage/banner/', '/storage/'),
                            originalSrc.replace('/banner/', '/'),
                            '/storage/' + originalSrc.split('/').pop(),
                            '{{ asset('images/placeholder.png') }}'
                        ];
                        // Try the first alternate that isn't the current src
                        for (let path of possiblePaths) {
                            if (path !== originalSrc && path !== '{{ asset('images/placeholder.png') }}') {
                                const testImg = new Image();
                                testImg.onload = () => { this.src = path; };
                                testImg.src = path;
                                break;
                            }
                        }
                    }
                });
            });
        })();
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3061fd',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                @if(!session('no_reload'))
                location.reload();
                @endif
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#dc2626'
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            // Format validation errors for better display
            const errorMessages = @json($errors->all());
            let errorHtml = '<ul style="text-align: left; margin: 0;">';
            errorMessages.forEach(error => {
                errorHtml += `<li>${escapeHtml(error)}</li>`;
            });
            errorHtml += '</ul>';

            Swal.fire({
                icon: 'error',
                title: 'Validation Error!',
                html: errorHtml,
                confirmButtonColor: '#dc2626'
            });
        </script>
    @endif

    @if(session('validation_errors'))
        <script>
            const validationErrors = @json(session('validation_errors'));
            let errorHtml = '<div style="text-align: left;"><strong>Please fix the following errors:</strong><br><br>';
            validationErrors.forEach(error => {
                errorHtml += `• ${escapeHtml(error)}<br>`;
            });
            errorHtml += '</div>';

            Swal.fire({
                icon: 'error',
                title: 'Validation Failed!',
                html: errorHtml,
                confirmButtonColor: '#dc2626'
            });
        </script>
    @endif
@endpush
