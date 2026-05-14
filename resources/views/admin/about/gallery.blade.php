{{-- resources/views/admin/gallery.blade.php --}}
@extends('layout.admin')
@section('title', 'Gallery Albums')

@push('css')
    <style>
        .album-card {
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
            border-radius: 1rem;
            overflow: hidden;
        }
        .album-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
        }
        .album-cover {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        .album-card .card-body {
            background: white;
        }
        .delete-album-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
            background: rgb(78 78 78 / 0.9);
            border: none;
            color: white;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            opacity: 0;
        }
        .album-card:hover .delete-album-btn {
            opacity: 1;
        }
        .delete-album-btn:hover {
            background: #ed6a6a;
            transform: scale(1.05);
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
        .cover-preview {
            width: 120px;
            height: 120px;
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
                <h2 class="fw-semibold text-dark mb-1"><i class="fas fa-images me-2" style="color: #3061fd;"></i>Gallery Albums</h2>
                <p class="text-muted">Manage photo albums and categories</p>
            </div>
            <span class="badge bg-light text-dark px-3 py-2 rounded-pill">Total Albums: {{ count($albums) }}</span>
        </div>

        <!-- Create Album Card -->
        <div class="card shadow-sm border-0 rounded-4 mb-5">
            <div class="card-body p-4">
                <h5 class="card-title mb-3"><i class="fas fa-plus-circle me-2" style="color: #3061fd;"></i>Create New Album</h5>
                <form method="POST" action="{{route('admin.album.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="album_name" class="form-label fw-semibold">Album Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   class="form-control @error('album_name') is-invalid @enderror"
                                   id="album_name"
                                   name="album_name"
                                   placeholder="e.g., Summer Events, Conference 2024, Team Building"
                                   required>
                            @error('album_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="cover_image" class="form-label fw-semibold">Cover Image <span class="text-danger">*</span></label>
                            <div class="upload-area p-3 text-center rounded-4" id="dropZone">
                                <input type="file" name="cover_image" id="cover_image" accept="image/*" class="d-none" required>
                                <div id="coverPreviewArea">
                                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                    <p class="text-muted small mb-0">Click or drag to upload cover image</p>
                                    <p class="text-muted small">JPG, PNG, WEBP (max 2MB)</p>
                                </div>
                            </div>
                            @error('cover_image')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-5 py-2">
                            <i class="fas fa-folder-plus me-2"></i>Create Album
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Albums Grid -->
        <div class="row g-4">
            @forelse($albums as $album)
                <div class="col-md-4 col-lg-3">
                    <div class="card album-card shadow-sm border-0 h-100 position-relative">
                        <button type="button" class="delete-album-btn" data-id="{{ $album->id }}" data-name="{{ $album->name }}">
                            <i class="ti ti-trash"></i>
                        </button>
                        <a href="{{route('admin.album.show',$album->id)}}" class="text-decoration-none">
                            @if($album->cover_img)
                                <img src="{{ asset('storage/album_covers/'.$album->cover_img) }}"
                                     class="album-cover"
                                     alt="{{ $album->name }}">
                            @else
                                <div class="album-cover bg-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-image fa-4x text-muted"></i>
                                </div>
                            @endif
                            <div class="card-body text-center">
                                <h6 class="card-title text-dark fw-semibold mb-2">{{ $album->name }}</h6>

                            </div>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="far fa-folder-open fa-4x text-muted mb-3"></i>
                        <p class="text-muted mb-0">No albums created yet. Create your first album above!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <form id="deleteAlbumForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function() {
            // Cover image preview logic
            const coverInput = document.getElementById('cover_image');
            const dropZone = document.getElementById('dropZone');
            const coverPreviewArea = document.getElementById('coverPreviewArea');

            function previewCoverImage(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    coverPreviewArea.innerHTML = `
                        <div class="position-relative d-inline-block">
                            <img src="${e.target.result}" class="cover-preview" alt="Cover preview">
                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle p-0"
                                    style="width: 24px; height: 24px; font-size: 12px;" id="removeCoverBtn">
                                ×
                            </button>
                        </div>
                    `;

                    const removeBtn = document.getElementById('removeCoverBtn');
                    if (removeBtn) {
                        removeBtn.addEventListener('click', (e) => {
                            e.stopPropagation();
                            coverInput.value = '';
                            coverPreviewArea.innerHTML = `
                                <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                <p class="text-muted small mb-0">Click or drag to upload cover image</p>
                                <p class="text-muted small">JPG, PNG, WEBP (max 2MB)</p>
                            `;
                        });
                    }
                };
                reader.readAsDataURL(file);
            }

            coverInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    previewCoverImage(this.files[0]);
                }
            });

            // Drag and drop for cover image
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
                if (files.length > 0 && files[0].type.startsWith('image/')) {
                    coverInput.files = files;
                    previewCoverImage(files[0]);
                }
            });

            dropZone.addEventListener('click', () => coverInput.click());

            // Delete Album with SweetAlert
            const deleteAlbumForm = document.getElementById('deleteAlbumForm');

            document.querySelectorAll('.delete-album-btn').forEach(btn => {
                btn.addEventListener('click', async function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const albumId = this.dataset.id;
                    const albumName = this.dataset.name;

                    const result = await Swal.fire({
                        title: 'Delete Album?',
                        html: `Are you sure you want to delete album <strong>"${albumName}"</strong>?<br><span class="text-danger">This will also delete all photos inside this album!</span>`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        confirmButtonText: 'Yes, delete album!',
                        cancelButtonText: 'Cancel'
                    });

                    if (result.isConfirmed) {
                        deleteAlbumForm.action = `/admin/album/destroy/${albumId}`;
                        deleteAlbumForm.submit();
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
                title: 'Error!',
                text: '{{ $errors->first() }}',
                confirmButtonColor: '#dc2626'
            });
        </script>
    @endif
@endpush
