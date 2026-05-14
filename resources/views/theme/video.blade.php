@extends('layout.theme')
@section('title', 'Video Gallery')

@section('meta_description', $seo->description ?? 'IGL Web Ltd')
@section('meta_keywords', $seo->keywords ?? '')
@section('meta_robots', $seo->robots ?? '')

@section('favicon', isset($seo->icon) ? asset($seo->icon) : asset('assets/images/favicons/favicon-16x16.png'))

@section('og_type', $seo->og_type ?? '')
@section('og_title', $seo->og_title ?? '')
@section('og_description', $seo->og_description ?? '')
@section('og_width', $seo->og_image_width ?? '1200')
@section('og_height', $seo->og_image_height ?? '630')

@section('meta_image', isset($seo->og_image) ? asset($seo->og_image) : asset('assets/images/igl.png'))

@section('twitter_title', $seo->twitter_title ?? '')
@section('twitter_meta_description', $seo->twitter_description ?? '')
@section('twitter_meta_image', isset($seo->twitter_image) ? asset($seo->twitter_image) : asset('assets/images/igl.png'))

@push('css')
    <style>
        /* Video Gallery Page Styles */
        .video-gallery-page {
            background: var(--gotur-white, #fff);
        }

        /* Section Header */
        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-header__title {
            font-size: 36px;
            font-weight: 700;
            color: var(--gotur-black, #1E1E1E);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-header__title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--gotur-base, #63AB45);
            border-radius: 3px;
        }

        .section-header__subtitle {
            font-size: 16px;
            color: var(--gotur-text, #595959);
            max-width: 600px;
            margin: 20px auto 0;
        }

        /* Video Card Styles */
        .video-card {
            position: relative;
            background: #000;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease;
            cursor: pointer;
            margin-bottom: 30px;
        }

        .video-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Thumbnail Container */
        .video-thumbnail {
            position: relative;
            overflow: hidden;
            background: #000;
            border-radius: 20px;
        }

        .video-thumbnail img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .video-card:hover .video-thumbnail img {
            transform: scale(1.05);
            opacity: 0.8;
        }

        /* Play Button Overlay */
        .play-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.4s ease;
        }

        .video-card:hover .play-overlay {
            opacity: 1;
        }

        .play-btn {
            width: 70px;
            height: 70px;
            background: var(--gotur-base, #63AB45);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 0 0 0 rgba(99, 171, 69, 0.7);
            animation: pulse 2s infinite;
        }

        .play-btn i {
            color: #fff;
            font-size: 28px;
            margin-left: 5px;
        }

        .play-btn:hover {
            transform: scale(1.1);
            background: var(--gotur-primary, #F7921E);
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(99, 171, 69, 0.7);
            }
            70% {
                box-shadow: 0 0 0 15px rgba(99, 171, 69, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(99, 171, 69, 0);
            }
        }

        /* Modal Customization */
        .video-modal .modal-dialog {
            max-width: 1000px;
            margin: 1.75rem auto;
        }

        .video-modal .modal-content {
            background: transparent;
            border: none;
            border-radius: 20px;
        }

        .video-modal .modal-body {
            padding: 0;
            border-radius: 20px;
            overflow: hidden;
        }

        .video-modal .close-btn {
            position: absolute;
            top: -40px;
            right: 0;
            background: rgba(255,255,255,0.2);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            z-index: 10;
        }

        .video-modal .close-btn:hover {
            background: var(--gotur-base, #63AB45);
            transform: rotate(90deg);
        }

        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            background: #000;
            border-radius: 20px;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Animation for Video Items */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .video-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .video-card:nth-child(1) { animation-delay: 0.1s; }
        .video-card:nth-child(2) { animation-delay: 0.2s; }
        .video-card:nth-child(3) { animation-delay: 0.3s; }
        .video-card:nth-child(4) { animation-delay: 0.4s; }
        .video-card:nth-child(5) { animation-delay: 0.5s; }
        .video-card:nth-child(6) { animation-delay: 0.6s; }
        .video-card:nth-child(7) { animation-delay: 0.7s; }
        .video-card:nth-child(8) { animation-delay: 0.8s; }
        .video-card:nth-child(9) { animation-delay: 0.9s; }
        .video-card:nth-child(10) { animation-delay: 1s; }
        .video-card:nth-child(11) { animation-delay: 1.1s; }
        .video-card:nth-child(12) { animation-delay: 1.2s; }

        /* Load More Button */
        .load-more-wrapper {
            text-align: center;
            margin-top: 30px;
        }

        .load-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 14px 35px;
            background: transparent;
            border: 2px solid var(--gotur-base, #63AB45);
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            color: var(--gotur-base, #63AB45);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .load-more-btn i {
            transition: transform 0.3s ease;
        }

        .load-more-btn:hover {
            background: var(--gotur-base, #63AB45);
            color: var(--gotur-white, #fff);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 171, 69, 0.3);
        }

        .load-more-btn:hover i {
            transform: translateX(5px);
        }

        /* Empty State */
        .video-empty {
            text-align: center;
            padding: 80px 20px;
            background: var(--gotur-gray, #F3F8F6);
            border-radius: 20px;
        }

        .video-empty i {
            font-size: 64px;
            color: var(--gotur-base, #63AB45);
            margin-bottom: 20px;
            display: block;
        }

        .video-empty h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .video-empty p {
            color: var(--gotur-text, #595959);
        }

        /* Responsive Adjustments */
        @media (max-width: 1199px) {
            .video-thumbnail img {
                height: 220px;
            }
        }

        @media (max-width: 768px) {
            .video-thumbnail img {
                height: 200px;
            }

            .section-header__title {
                font-size: 28px;
            }

            .play-btn {
                width: 55px;
                height: 55px;
            }

            .play-btn i {
                font-size: 22px;
            }
        }

        @media (max-width: 576px) {
            .video-thumbnail img {
                height: 180px;
            }

            .play-btn {
                width: 50px;
                height: 50px;
            }

            .play-btn i {
                font-size: 20px;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{asset('assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div>
        <div class="container">
            <div class="page-header__content">
                <h2 class="page-header__title bw-split-in-right">Video Gallery</h2>
            </div>
        </div>
    </section>

    <!-- Video Gallery Section -->
    <section class="video-gallery-page section-space">
        <div class="container" style="margin-top: -100px;">
            <!-- Section Header -->
            <div class="section-header wow fadeInUp" data-wow-duration="1500ms">
                <h2 class="section-header__title">Explore Our Videos</h2>
                <p class="section-header__subtitle">Watch our latest videos showcasing events, tutorials, and moments from our community</p>
            </div>

            <!-- Video Grid -->
            @if(count($data) > 0)
                <div class="row" id="videoGrid">
                    @foreach ($data as $index => $video)
                        <div class="col-md-6 col-lg-4 video-item">
                            <div class="video-card" data-video-id="{{ $video->id }}" data-video-code="{{ $video->code ?? $video->url ?? '' }}">
                                <!-- Thumbnail Container -->
                                <div class="video-thumbnail">
                                    @php
                                        // Extract YouTube video ID from various formats
                                        $youtubeId = '';
                                        $videoCode = $video->code ?? $video->url ?? '';

                                        if($videoCode) {
                                            // Check if it's a full iframe or just URL/code
                                            if(strpos($videoCode, '<iframe') !== false) {
                                                // Extract src attribute from iframe
                                                preg_match('/src="([^"]+)"/', $videoCode, $srcMatches);
                                                if(isset($srcMatches[1])) {
                                                    $iframeSrc = $srcMatches[1];
                                                    preg_match('/(?:youtube\.com\/embed\/)([^"?]+)/', $iframeSrc, $idMatches);
                                                    $youtubeId = $idMatches[1] ?? '';
                                                }
                                            } else {
                                                // Direct URL or just video ID
                                                preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $videoCode, $matches);
                                                $youtubeId = $matches[1] ?? (preg_match('/^[a-zA-Z0-9_-]{11}$/', $videoCode) ? $videoCode : '');
                                            }
                                        }
                                    @endphp

                                    @if($youtubeId)
                                        <img src="https://img.youtube.com/vi/{{ $youtubeId }}/maxresdefault.jpg"
                                             alt="Video Thumbnail"
                                             onerror="this.src='https://img.youtube.com/vi/{{ $youtubeId }}/hqdefault.jpg'">
                                    @else
                                        <img src="{{ asset('assets/images/video-placeholder.jpg') }}"
                                             alt="Video Thumbnail">
                                    @endif

                                    <div class="play-overlay">
                                        <div class="play-btn">
                                            <i class="fas fa-play"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Load More Button (Optional - for pagination) -->
                @if(isset($hasMore) && $hasMore)
                    <div class="load-more-wrapper wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="400ms">
                        <button class="load-more-btn" id="loadMoreBtn">
                            Load More Videos <i class="fas fa-arrow-down"></i>
                        </button>
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="video-empty wow fadeInUp" data-wow-duration="1500ms">
                    <i class="fas fa-video"></i>
                    <h3>No Videos Found</h3>
                    <p>We're currently updating our video gallery. Please check back soon!</p>
                    <a href="{{route('home')}}" class="gotur-btn" style="margin-top: 20px; display: inline-block;">
                        Back to Home <i class="icon-right-arrow"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Video Modal -->
    <div class="modal fade video-modal" id="videoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
                <div class="modal-body">
                    <div class="video-wrapper" id="videoWrapper">
                        <!-- YouTube iframe will be injected here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Extract YouTube embed URL from various formats (iframe, URL, or just ID)
            function getYouTubeEmbedUrl(videoCode) {
                if (!videoCode) return null;

                let videoId = null;

                // Case 1: Full iframe code
                if (videoCode.includes('<iframe')) {
                    const srcMatch = videoCode.match(/src="([^"]+)"/);
                    if (srcMatch && srcMatch[1]) {
                        const src = srcMatch[1];
                        const idMatch = src.match(/(?:youtube\.com\/embed\/)([^"?]+)/);
                        if (idMatch && idMatch[1]) {
                            videoId = idMatch[1];
                        }
                    }
                }
                // Case 2: YouTube URL
                else if (videoCode.includes('youtube.com') || videoCode.includes('youtu.be')) {
                    const patterns = [
                        /(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/,
                        /youtube\.com\/watch\?.*v=([a-zA-Z0-9_-]{11})/
                    ];
                    for (const pattern of patterns) {
                        const match = videoCode.match(pattern);
                        if (match && match[1]) {
                            videoId = match[1];
                            break;
                        }
                    }
                }
                // Case 3: Just the video ID (11 characters)
                else if (videoCode.match(/^[a-zA-Z0-9_-]{11}$/)) {
                    videoId = videoCode;
                }

                if (videoId) {
                    return `https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1&playsinline=1&showinfo=0`;
                }

                return null;
            }

            // Video Modal Handler
            const modal = document.getElementById('videoModal');
            const videoWrapper = document.getElementById('videoWrapper');

            if (modal) {
                // Handle video card clicks
                document.querySelectorAll('.video-card').forEach(card => {
                    card.addEventListener('click', function(e) {
                        const videoCode = this.getAttribute('data-video-code');
                        if (videoCode) {
                            const embedUrl = getYouTubeEmbedUrl(videoCode);
                            if (embedUrl) {
                                videoWrapper.innerHTML = `<iframe src="${embedUrl}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>`;

                                // Initialize Bootstrap modal
                                const bsModal = new bootstrap.Modal(modal);
                                bsModal.show();
                            }
                        }
                    });
                });

                // Reset video when modal is closed
                modal.addEventListener('hidden.bs.modal', function() {
                    videoWrapper.innerHTML = '';
                });
            }

            // Load More functionality (if needed)
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            if (loadMoreBtn) {
                let currentPage = 1;
                loadMoreBtn.addEventListener('click', function() {
                    currentPage++;
                    // AJAX call to load more videos
                    fetch(`?page=${currentPage}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.html) {
                                document.getElementById('videoGrid').insertAdjacentHTML('beforeend', data.html);
                                // Re-initialize event listeners for new videos
                                document.querySelectorAll('.video-card:not([data-listener])').forEach(card => {
                                    card.setAttribute('data-listener', 'true');
                                    card.addEventListener('click', function(e) {
                                        const videoCode = this.getAttribute('data-video-code');
                                        if (videoCode && modal) {
                                            const embedUrl = getYouTubeEmbedUrl(videoCode);
                                            if (embedUrl) {
                                                videoWrapper.innerHTML = `<iframe src="${embedUrl}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>`;
                                                const bsModal = new bootstrap.Modal(modal);
                                                bsModal.show();
                                            }
                                        }
                                    });
                                });

                                if (!data.hasMore) {
                                    loadMoreBtn.style.display = 'none';
                                }
                            }
                        })
                        .catch(error => console.error('Error loading more videos:', error));
                });
            }

            // Add hover effect enhancement
            const videoCards = document.querySelectorAll('.video-card');
            videoCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
@endpush
