@extends('layout.theme')
@section('title', 'Gallery Albums')

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
        /* Album Page Styles */
        .album-page {
            background: var(--gotur-white, #fff);
        }

        /* Album Card */
        .album-card {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease;
            background: var(--gotur-white, #fff);
            text-decoration: none;
            display: block;
        }

        .album-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Album Cover Image */
        .album-cover-wrapper {
            position: relative;
            overflow: hidden;
            height: 280px;
        }

        .album-cover {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .album-card:hover .album-cover {
            transform: scale(1.1);
        }

        /* Album Info */
        .album-info {
            padding: 20px;
            text-align: center;
            background: var(--gotur-white, #fff);
        }

        .album-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--gotur-black, #2A2A2A);
            transition: color 0.3s ease;
        }

        .album-card:hover .album-title {
            color: var(--gotur-base, #63AB45);
        }

        .album-stats {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .album-stats span {
            font-size: 13px;
            color: var(--gotur-text, #595959);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .album-stats i {
            color: var(--gotur-base, #63AB45);
            font-size: 14px;
        }

        /* Badge for New Album */
        .album-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--gotur-base, #63AB45);
            color: var(--gotur-white, #fff);
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            z-index: 2;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        /* Empty State */
        .albums-empty {
            text-align: center;
            padding: 80px 20px;
            background: var(--gotur-gray, #F3F8F6);
            border-radius: 20px;
        }

        .albums-empty i {
            font-size: 64px;
            color: var(--gotur-base, #63AB45);
            margin-bottom: 20px;
            display: block;
        }

        .albums-empty h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: var(--gotur-black, #2A2A2A);
        }

        .albums-empty p {
            color: var(--gotur-text, #595959);
            margin-bottom: 20px;
        }

        /* Section Header */
        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .section-subtitle {
            font-size: 16px;
            color: var(--gotur-base, #63AB45);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
            display: inline-block;
        }

        .section-title {
            font-size: 42px;
            font-weight: 700;
            color: var(--gotur-black, #2A2A2A);
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .section-text {
            font-size: 16px;
            color: var(--gotur-text, #595959);
            max-width: 700px;
            margin: 0 auto;
        }

        /* Animation */
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

        .album-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
            margin-bottom: 30px;
        }

        .album-card:nth-child(1) { animation-delay: 0.1s; }
        .album-card:nth-child(2) { animation-delay: 0.2s; }
        .album-card:nth-child(3) { animation-delay: 0.3s; }
        .album-card:nth-child(4) { animation-delay: 0.4s; }
        .album-card:nth-child(5) { animation-delay: 0.5s; }
        .album-card:nth-child(6) { animation-delay: 0.6s; }
        .album-card:nth-child(7) { animation-delay: 0.7s; }
        .album-card:nth-child(8) { animation-delay: 0.8s; }

        /* Responsive */
        @media (max-width: 1199px) {
            .album-cover-wrapper {
                height: 250px;
            }
            .section-title {
                font-size: 36px;
            }
        }

        @media (max-width: 768px) {
            .album-cover-wrapper {
                height: 220px;
            }
            .album-title {
                font-size: 16px;
            }
            .section-title {
                font-size: 28px;
            }
            .section-subtitle {
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            .album-cover-wrapper {
                height: 200px;
            }
            .album-info {
                padding: 15px;
            }
            .album-title {
                font-size: 15px;
            }
            .album-stats span {
                font-size: 12px;
            }
        }

        /* Masonry Layout */
        .masonry-layout {
            position: relative;
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{asset('assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div>
        <div class="container">
            <div class="page-header__content">
                <h2 class="page-header__title bw-split-in-right">Our Gallery Albums</h2>
            </div>
        </div>
    </section>

    <!-- Albums Section -->
    <section class="album-page section-space">
        <div class="container" style="margin-top: -100px;">
            <!-- Section Header -->
            <div class="section-header wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                <span class="section-subtitle">Memories Collection</span>
                <h2 class="section-title">Explore Our Photo Albums</h2>
                <p class="section-text">Discover our collection of memorable moments captured in various events and activities</p>
            </div>

            <!-- Albums Grid -->
            @if(count($albums) > 0)
                <div class="row masonry-layout gutter-y-30" id="albumsGrid">
                    @foreach ($albums as $index => $album)
                        <div class="col-md-6 col-lg-4">
                            <a href="{{route('front.showAlbum',$album->id)}}" class="album-card wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="{{ 200 + ($index * 100) }}ms">
                                <!-- Album Cover -->
                                <div class="album-cover-wrapper">
                                    @if($album->cover_img && file_exists(public_path('storage/album_covers/' . $album->cover_img)))
                                        <img src="{{ asset('storage/album_covers/'.$album->cover_img) }}"
                                             class="album-cover"
                                             alt="{{ $album->name }}">
                                    @else
                                        <div class="album-cover bg-light d-flex align-items-center justify-content-center">
                                            <i class="fas fa-image fa-4x text-muted"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Album Info -->
                                <div class="album-info">
                                    <h3 class="album-title">{{ $album->name }}</h3>
                                    <div class="album-stats">
                                        <span>
                                            <i class="fas fa-images"></i>
                                            {{ $album->gallery->count() ?? 0 }} Photos
                                        </span>

                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="albums-empty wow fadeInUp" data-wow-duration="1500ms">
                    <i class="fas fa-folder-open"></i>
                    <h3>No Albums Found</h3>
                    <p>We're currently organizing our gallery albums. Please check back soon!</p>
                    <a href="{{route('home')}}" class="gotur-btn" style="margin-top: 20px; display: inline-block;">
                        Back to Home <i class="icon-right-arrow"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effect enhancement
            const albumCards = document.querySelectorAll('.album-card');
            albumCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-10px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Lazy loading for images (optional)
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            const src = img.getAttribute('data-src');
                            if (src) {
                                img.src = src;
                                img.removeAttribute('data-src');
                            }
                            observer.unobserve(img);
                        }
                    });
                });

                document.querySelectorAll('.album-cover').forEach(img => {
                    if (img.getAttribute('data-src')) {
                        imageObserver.observe(img);
                    }
                });
            }

            // Stats counter animation
            function animateStats() {
                const stats = document.querySelectorAll('.album-stats span:first-child');
                stats.forEach(stat => {
                    const text = stat.innerText;
                    const number = parseInt(text);
                    if (!isNaN(number) && number > 0) {
                        let current = 0;
                        const increment = number / 50;
                        const updateCounter = () => {
                            if (current < number) {
                                current = Math.ceil(current + increment);
                                stat.innerHTML = `<i class="fas fa-images"></i> ${current} Photos`;
                                setTimeout(updateCounter, 20);
                            } else {
                                stat.innerHTML = `<i class="fas fa-images"></i> ${number} Photos`;
                            }
                        };
                        updateCounter();
                    }
                });
            }

            // Run counter animation when page loads
            setTimeout(animateStats, 500);

            // Initialize WOW.js if available
            if (typeof WOW !== 'undefined') {
                new WOW().init();
            }
        });
    </script>

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
