{{-- resources/views/admin/youtube-gallery.blade.php --}}
@extends('layout.admin')
@section('title', 'YouTube Video Gallery')

@push('css')
    <style>

        /* Scope all styles under youtube-gallery container */
        .youtube-gallery-section,
        .youtube-gallery-section * {
            box-sizing: border-box;
        }

        /* Reset only gallery-specific elements to avoid theme conflicts */
        .youtube-gallery-section .table-gallery-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            background-color: #f1f5f9;
        }

        .youtube-gallery-section .btn-icon {
            background: none !important;
            border: none !important;
            color: #dc2626 !important;
            transition: opacity 0.2s;
            padding: 6px 10px;
            cursor: pointer;
        }

        .youtube-gallery-section .btn-icon:hover {
            opacity: 0.7;
            color: #b91c1c !important;
        }

        .youtube-gallery-section .upload-area {
            background-color: #f8fafc;
            border: 2px dashed #cbd5e1;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .youtube-gallery-section .upload-area:hover {
            border-color: #3061fd;
            background-color: #f1f5f9;
        }

        .youtube-gallery-section .upload-preview-thumb {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 2px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            background-color: #f1f5f9;
        }

        .youtube-gallery-section .video-name {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .youtube-gallery-section .video-thumbnail {
            width: 120px;
            height: 68px;
            object-fit: cover;
            border-radius: 0.5rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .youtube-gallery-section .btn-preview {
            background: none !important;
            border: none !important;
            color: #3061fd !important;
            transition: opacity 0.2s;
            padding: 6px 10px;
            cursor: pointer;
        }

        .youtube-gallery-section .btn-preview:hover {
            opacity: 0.7;
            color: #1e40af !important;
        }

        .youtube-gallery-section .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .youtube-gallery-section .code-preview {
            background: #f1f5f9;
            padding: 10px;
            border-radius: 8px;
            font-family: monospace;
            font-size: 12px;
            word-break: break-all;
            margin-top: 10px;
            display: none;
        }

        .youtube-gallery-section .youtube-preview {
            margin-top: 15px;
            text-align: center;
        }

        .youtube-gallery-section .youtube-preview iframe {
            max-width: 100%;
            border-radius: 8px;
        }

        .youtube-gallery-section .extract-btn {
            cursor: pointer;
            font-size: 12px;
            color: #3061fd;
        }

        .youtube-gallery-section .extract-btn:hover {
            text-decoration: underline;
        }

        .youtube-gallery-section .video-info {
            max-width: 300px;
        }

        .youtube-gallery-section .video-info small {
            display: block;
            color: #6c757d;
            font-size: 11px;
            word-break: break-all;
        }

        .youtube-gallery-section .embed-code-preview {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-family: monospace;
            font-size: 11px;
            color: #6c757d;
        }

        .youtube-gallery-section .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .youtube-gallery-section .btn-sm-icon {
            padding: 5px 8px;
            font-size: 12px;
        }

        /* Modal specific styles (outside gallery container but need scoping) */
        #codeModal .modal-content {
            border-radius: 0.5rem;
        }

        #codeModal pre {
            background: #f1f5f9 !important;
            padding: 15px !important;
            border-radius: 8px !important;
            overflow-x: auto !important;
            white-space: pre-wrap !important;
            word-wrap: break-word !important;
            margin: 0 !important;
            font-size: 12px !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .youtube-gallery-section .video-thumbnail {
                width: 80px;
                height: 45px;
            }

            .youtube-gallery-section .embed-code-preview {
                max-width: 150px;
                font-size: 10px;
            }

            .youtube-gallery-section .action-buttons {
                flex-direction: column;
                gap: 3px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="youtube-gallery-section">
        <div class="container-fluid py-4">
            <!-- Your content -->
            <div class="container-fluid py-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">
                        <i class="fab fa-youtube me-2" style="color: #ff0000;"></i>
                        YouTube Video Gallery
                    </h4>
                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                <i class="fab fa-youtube me-1"></i> Total: {{ count($videos) }}
            </span>
                </div>

                <!-- Upload Card -->
                <div class="card shadow-sm border-0 rounded-4 mb-5">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3">
                            <i class="fab fa-youtube me-2" style="color: #ff0000;"></i>
                            Add New YouTube Video
                        </h5>

                        <form method="POST" action="{{route('admin.video.store')}}" id="uploadForm">
                            @csrf

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold">
                                        YouTube Embed Code or URL <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="form-control @error('embed_code') is-invalid @enderror"
                                              name="embed_code"
                                              id="embedCode"
                                              rows="4"
                                              placeholder="Paste YouTube embed code or URL here...&#10;&#10;Examples:&#10;&#10;&lt;iframe width=&quot;560&quot; height=&quot;315&quot; src=&quot;https://www.youtube.com/embed/VIDEO_ID&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture&quot; allowfullscreen&gt;&lt;/iframe&gt;&#10;&#10;OR&#10;&#10;https://youtu.be/VIDEO_ID&#10;https://www.youtube.com/watch?v=VIDEO_ID">{{ old('embed_code') }}</textarea>
                                    @error('embed_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        You can paste the full YouTube embed code, video URL, or just the video ID.
                                    </small>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" id="extractBtn">
                                                <i class="fas fa-magic me-1"></i> Extract Video Info
                                            </button>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-danger px-5 py-2" id="uploadSubmitBtn">
                                                <i class="fab fa-youtube me-2"></i>Add Video
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Preview Section -->
                                <div class="col-12" id="previewSection" style="display: none;">
                                    <div class="alert alert-light border rounded-3">
                                        <h6 class="mb-2"><i class="fas fa-eye me-1"></i> Preview:</h6>
                                        <div class="youtube-preview" id="youtubePreview"></div>
                                        <div class="code-preview mt-2" id="codePreview"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Videos Table -->
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-transparent border-0 pt-4 px-4">
                        <h5 class="mb-0">
                            <i class="fab fa-youtube me-2" style="color: #ff0000;"></i>
                            Uploaded Videos
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                <tr>
                                    <th style="width: 140px">Video Preview</th>
                                    <th>Embed Code</th>
                                    <th style="width: 120px" class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($videos as $video)
                                    <tr data-id="{{ $video->id }}">
                                        <td>
                                            <div class="youtube-thumbnail-container">
                                                {!! getYouTubeThumbnailFromEmbed($video->code) !!}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="embed-code-preview">
                                                {{ Str::limit($video->code, 80) }}
                                            </div>
                                            <small class="text-muted">
                                                Video ID: {{ getYouTubeIdFromEmbed($video->code) }}
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons">
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-primary view-code-btn"
                                                        data-code="{{ htmlspecialchars($video->code, ENT_QUOTES) }}"
                                                        title="View Embed Code">
                                                    <i class="fas fa-code"></i>
                                                </button>
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-danger delete-single"
                                                        data-id="{{ $video->id }}"
                                                        data-name="Video {{ $loop->iteration }}"
                                                        title="Delete Video">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5">
                                            <i class="fab fa-youtube fa-3x text-muted mb-3 d-block"></i>
                                            <p class="text-muted mb-2">No YouTube videos added yet</p>
                                            <small class="text-muted">Add your first video using the form above</small>
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

            <!-- View Code Modal -->
            <div class="modal fade" id="codeModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-code me-2"></i>Embed Code
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Video Preview:</label>
                                <div id="modalVideoPreview" class="youtube-preview"></div>
                            </div>
                            <label class="form-label fw-semibold">Embed Code:</label>
                            <pre id="modalCodeContent" style="background: #f1f5f9; padding: 15px; border-radius: 8px; overflow-x: auto; white-space: pre-wrap; word-wrap: break-word; margin: 0; font-size: 12px;"></pre>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="copyCodeBtn">
                                <i class="fas fa-copy me-1"></i>Copy Code
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Font Awesome 6 (Free) CDN for consistent icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <script>
        (function() {
            // Helper function to extract YouTube video ID from various formats
            function extractYouTubeId(input) {
                if (!input) return null;

                // Pattern for youtube.com/watch?v=VIDEO_ID
                let match = input.match(/[?&]v=([^&]+)/);
                if (match) return match[1];

                // Pattern for youtu.be/VIDEO_ID
                match = input.match(/youtu\.be\/([^?&]+)/);
                if (match) return match[1];

                // Pattern for youtube.com/embed/VIDEO_ID
                match = input.match(/youtube\.com\/embed\/([^?&]+)/);
                if (match) return match[1];

                // Pattern for direct video ID (11 characters)
                match = input.match(/^([a-zA-Z0-9_-]{11})$/);
                if (match) return match[1];

                // Extract from iframe src
                match = input.match(/src=["'](?:https?:)?\/\/(?:www\.)?youtube\.com\/embed\/([^"']+)["']/);
                if (match) return match[1].split('?')[0];

                return null;
            }

            // Generate embed iframe from video ID
            function generateEmbedCode(videoId) {
                return `<iframe width="560" height="315" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
            }

            // Generate thumbnail URL from video ID
            function getThumbnailUrl(videoId) {
                return `https://img.youtube.com/vi/${videoId}/mqdefault.jpg`;
            }

            // Generate thumbnail HTML from video ID
            function getThumbnailHtml(videoId) {
                return `<img src="${getThumbnailUrl(videoId)}" alt="YouTube Thumbnail" class="video-thumbnail" onerror="this.src='https://placehold.co/120x68/e2e8f0/64748b?text=No+Thumbnail'">`;
            }

            // Update preview
            function updatePreview(embedCode, videoId = null) {
                const previewSection = document.getElementById('previewSection');
                const youtubePreview = document.getElementById('youtubePreview');
                const codePreview = document.getElementById('codePreview');

                if (embedCode && embedCode.trim()) {
                    previewSection.style.display = 'block';

                    // Display the iframe preview
                    youtubePreview.innerHTML = embedCode;

                    // Also show the code
                    if (codePreview) {
                        codePreview.textContent = embedCode;
                        codePreview.style.display = 'block';
                    }
                } else {
                    previewSection.style.display = 'none';
                }
            }

            // Extract and preview functionality
            const embedCodeTextarea = document.getElementById('embedCode');
            const extractBtn = document.getElementById('extractBtn');

            function extractAndPreview() {
                let input = embedCodeTextarea.value.trim();
                if (!input) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Empty Input',
                        text: 'Please enter a YouTube URL or embed code first.',
                        confirmButtonColor: '#ff0000'
                    });
                    return;
                }

                const videoId = extractYouTubeId(input);

                if (videoId) {
                    const embedCode = generateEmbedCode(videoId);
                    updatePreview(embedCode, videoId);

                    Swal.fire({
                        icon: 'success',
                        title: 'Video Found!',
                        text: `YouTube video ID: ${videoId}`,
                        confirmButtonColor: '#ff0000',
                        timer: 2000,
                        showConfirmButton: false
                    });
                } else {
                    // Check if input is already a full iframe code
                    if (input.includes('<iframe') && input.includes('youtube')) {
                        updatePreview(input);
                        Swal.fire({
                            icon: 'info',
                            title: 'Preview Ready',
                            text: 'Your embed code is ready for preview.',
                            confirmButtonColor: '#ff0000',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Invalid YouTube URL',
                            text: 'Could not extract video ID. Please check your YouTube URL or embed code.',
                            confirmButtonColor: '#ff0000'
                        });
                    }
                }
            }

            extractBtn.addEventListener('click', extractAndPreview);

            // Auto preview on paste (optional)
            let timeout;
            embedCodeTextarea.addEventListener('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    const input = this.value.trim();
                    if (input && (input.includes('youtube') || input.includes('youtu.be') || input.includes('<iframe'))) {
                        const videoId = extractYouTubeId(input);
                        if (videoId) {
                            updatePreview(generateEmbedCode(videoId), videoId);
                        } else if (input.includes('<iframe')) {
                            updatePreview(input);
                        }
                    }
                }, 500);
            });

            // Form submit handler
            const uploadForm = document.getElementById('uploadForm');

            uploadForm.addEventListener('submit', function(e) {
                let embedCode = embedCodeTextarea.value.trim();

                if (!embedCode) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Empty Field',
                        text: 'Please enter a YouTube embed code or URL.',
                        confirmButtonColor: '#ff0000'
                    });
                    return;
                }

                // Try to extract video ID and convert to embed code if it's a URL
                const videoId = extractYouTubeId(embedCode);
                if (videoId && !embedCode.includes('<iframe')) {
                    embedCode = generateEmbedCode(videoId);
                    embedCodeTextarea.value = embedCode;
                }

                // Validate if it's a proper YouTube embed code
                if (!embedCode.includes('youtube.com/embed/') && !embedCode.includes('youtu.be')) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Format',
                        text: 'Please provide a valid YouTube embed code or URL.',
                        confirmButtonColor: '#ff0000'
                    });
                    return;
                }

                // Show loading state
                const submitBtn = document.getElementById('uploadSubmitBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Adding Video...';
            });

            // Single Delete with SweetAlert
            const singleDeleteForm = document.getElementById('singleDeleteForm');

            document.querySelectorAll('.delete-single').forEach(btn => {
                btn.addEventListener('click', async function(e) {
                    e.preventDefault();
                    const videoId = this.dataset.id;
                    const videoName = this.dataset.name || 'this video';

                    const result = await Swal.fire({
                        title: 'Delete Video?',
                        html: `Are you sure you want to delete <strong>"${escapeHtml(videoName)}"</strong>?`,
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
                            text: 'Please wait while we delete the video',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        singleDeleteForm.action = `/admin/video/destroy/${videoId}`;
                        singleDeleteForm.submit();
                    }
                });
            });

            // View Code Modal
            const codeModal = new bootstrap.Modal(document.getElementById('codeModal'));
            const modalCodeContent = document.getElementById('modalCodeContent');
            const modalVideoPreview = document.getElementById('modalVideoPreview');
            const copyCodeBtn = document.getElementById('copyCodeBtn');
            let currentCode = '';

            document.querySelectorAll('.view-code-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    currentCode = this.dataset.code;
                    modalCodeContent.textContent = currentCode;

                    // Also show video preview in modal
                    if (modalVideoPreview) {
                        // Extract video ID from the embed code
                        const videoId = extractYouTubeId(currentCode);
                        if (videoId) {
                            modalVideoPreview.innerHTML = generateEmbedCode(videoId);
                        } else {
                            modalVideoPreview.innerHTML = currentCode;
                        }
                    }

                    codeModal.show();
                });
            });

            copyCodeBtn.addEventListener('click', function() {
                navigator.clipboard.writeText(currentCode).then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Copied!',
                        text: 'Embed code copied to clipboard',
                        confirmButtonColor: '#3061fd',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }).catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Copy Failed',
                        text: 'Please copy manually',
                        confirmButtonColor: '#dc2626'
                    });
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
        })();
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#ff0000',
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
@endpush
