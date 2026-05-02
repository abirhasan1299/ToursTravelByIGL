{{-- resources/views/admin/gallery.blade.php --}}
@extends('layout.admin')
@section('title', 'Gallery')

@push('css')
    <style>
        .table-gallery-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .btn-icon {
            background: none;
            border: none;
            color: #dc2626;
            transition: opacity 0.2s;
            padding: 6px 10px;
        }
        .btn-icon:hover {
            opacity: 0.7;
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
        .upload-preview-thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-semibold text-dark mb-1"><i class="fas fa-images me-2" style="color: #3061fd;"></i>Photo Gallery</h2>
                <p class="text-muted">Manage uploaded images</p>
            </div>
            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">Total: {{ count($photos) }}</span>
        </div>

        <!-- Upload Card -->
        <div class="card shadow-sm border-0 rounded-4 mb-5">
            <div class="card-body p-4">
                <h5 class="card-title mb-3"><i class="fas fa-cloud-upload-alt me-2" style="color: #3061fd;"></i>Upload New Photo</h5>
                <form method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="upload-area p-4 text-center rounded-4" id="dropZone">
                        <input type="file" name="photos[]" id="fileInput" multiple accept="image/*" class="d-none">
                        <div class="py-3">
                            <i class="fas fa-image fa-3x text-muted mb-3" style="opacity: 0.6;"></i>
                            <h6 class="fw-semibold">Drag & drop images here or click to browse</h6>
                            <p class="text-muted small mb-2">Supported: JPG, PNG, WEBP, GIF (max 2MB each)</p>
                            <button type="button" class="btn btn-sm btn-outline-primary px-4" id="browseBtn">
                                <i class="fas fa-folder-open me-1"></i> Choose files
                            </button>
                        </div>
                        <div class="row g-2 mt-3 justify-content-center" id="previewContainer"></div>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-5 py-2" id="uploadSubmitBtn" disabled>
                            <i class="fas fa-upload me-2"></i>Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Gallery Table -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th style="width: 80px">Preview</th>
                            <th>Filename</th>
                            <th>Uploaded At</th>
                            <th style="width: 100px" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($photos as $photo)
                            <tr data-id="{{ $photo->id }}">
                                <td>
                                    <img src="{{ asset('storage/gallery/'.$photo->img_name) }}" class="table-gallery-img" alt="Gallery image">
                                </td>
                                <td class="text-muted">{{ $photo->filename ?? $photo->img_name }}</td>
                                <td class="text-muted">{{ $photo->created_at ? $photo->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn-icon delete-single" data-id="{{ $photo->id }}" title="Delete">
                                        <i class="ti ti-trash me-3"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="far fa-images fa-3x text-muted mb-3"></i>
                                    <p class="text-muted mb-0">No photos uploaded yet</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <form id="singleDeleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function() {
            // Upload preview logic
            const fileInput = document.getElementById('fileInput');
            const browseBtn = document.getElementById('browseBtn');
            const previewContainer = document.getElementById('previewContainer');
            const uploadSubmitBtn = document.getElementById('uploadSubmitBtn');
            const dropZone = document.getElementById('dropZone');

            function updateUploadButton() {
                uploadSubmitBtn.disabled = fileInput.files.length === 0;
            }

            function updatePreview() {
                previewContainer.innerHTML = '';
                const files = Array.from(fileInput.files);

                files.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.className = 'col-auto';
                        col.innerHTML = `
                            <div class="position-relative">
                                <img src="${e.target.result}" class="upload-preview-thumb" alt="Preview">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-0" style="width: 18px; height: 18px; font-size: 10px; line-height: 1;" data-index="${index}">×</button>
                            </div>
                        `;
                        previewContainer.appendChild(col);

                        const removeBtn = col.querySelector('button');
                        removeBtn.addEventListener('click', () => {
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

            fileInput.addEventListener('change', updatePreview);
            browseBtn.addEventListener('click', () => fileInput.click());

            // Drag and drop
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

            dropZone.addEventListener('click', () => fileInput.click());

            // Single Delete with SweetAlert
            const singleDeleteForm = document.getElementById('singleDeleteForm');

            document.querySelectorAll('.delete-single').forEach(btn => {
                btn.addEventListener('click', async function(e) {
                    e.preventDefault();
                    const photoId = this.dataset.id;

                    const result = await Swal.fire({
                        title: 'Delete photo?',
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    });

                    if (result.isConfirmed) {
                        singleDeleteForm.action = `/admin/gallery/${photoId}`;
                        singleDeleteForm.submit();
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
                location.reload();
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
            Swal.fire({
                icon: 'error',
                title: 'Upload Error!',
                text: '{{ $errors->first() }}',
                confirmButtonColor: '#dc2626'
            });
        </script>
    @endif
@endpush
