@extends('layout.theme')
@section('title', $album->name . ' - Gallery')

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
        /* Back to Albums Button */
        .back-to-albums {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 12px 28px;
            background: rgba(99, 171, 69, 0.12);
            border-radius: 50px;
            color: var(--gotur-base, #63AB45);
            font-weight: 600;
            font-size: 15px;
            transition: all 0.4s ease;
            margin-bottom: 40px;
            text-decoration: none;
            border: 1px solid rgba(99, 171, 69, 0.2);
        }

        .back-to-albums:hover {
            background: var(--gotur-base, #63AB45);
            color: #fff;
            transform: translateX(-6px);
            border-color: transparent;
        }

        /* Album Header */
        .album-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .album-header h1 {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #2A2A2A;
        }

        .album-header p {
            color: #6c757d;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f8f9fa;
            padding: 6px 20px;
            border-radius: 40px;
        }

        /* Perfect Equal Size Grid */
        .gallery-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            justify-content: flex-start;
        }

        .gallery-item {
            flex: 0 0 calc(33.333% - 25px);
            width: calc(33.333% - 25px);
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
        }

        @media (max-width: 992px) {
            .gallery-item {
                flex: 0 0 calc(50% - 25px);
                width: calc(50% - 25px);
            }
        }

        @media (max-width: 576px) {
            .gallery-item {
                flex: 0 0 calc(100% - 25px);
                width: calc(100% - 25px);
            }
        }

        .gallery-page__card {
            position: relative;
            width: 100%;
            height: 280px;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            background: #f0f2f5;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .gallery-page__card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
            transition: transform 0.4s ease;
        }

        .gallery-page__card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .gallery-page__card:hover img {
            transform: scale(1.05);
        }

        .gallery-page__card__hover {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .gallery-page__card:hover .gallery-page__card__hover {
            opacity: 1;
        }

        .gallery-page__card__icon {
            width: 50px;
            height: 50px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            transform: scale(0.8);
        }

        .gallery-page__card:hover .gallery-page__card__icon {
            transform: scale(1);
        }

        .gallery-page__card__icon:hover {
            background: var(--gotur-base, #63AB45);
            transform: scale(1.1);
        }

        .gallery-page__card__icon .gallery-page__card__icon__item {
            width: 22px;
            height: 22px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2363AB45' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7' /%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
        }

        .gallery-page__card__icon:hover .gallery-page__card__icon__item {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23ffffff' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7' /%3E%3C/svg%3E");
        }

        /* ========================================
           CUSTOM LIGHTBOX / MODAL STYLES
        ======================================== */
        .image-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.95);
            cursor: pointer;
        }

        .image-modal.show {
            display: flex !important;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        .modal-content-custom {
            position: relative;
            max-width: 90%;
            max-height: 90%;
            text-align: center;
        }

        .modal-content-custom img {
            max-width: 100%;
            max-height: 85vh;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        }

        .close-modal {
            position: absolute;
            top: -40px;
            right: -40px;
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 30px;
            color: white;
            font-weight: bold;
        }

        .close-modal:hover {
            background: #63AB45;
            transform: rotate(90deg);
        }

        .modal-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 100%;
            display: flex;
            justify-content: space-between;
            pointer-events: none;
        }

        .modal-prev, .modal-next {
            pointer-events: auto;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .modal-prev:hover, .modal-next:hover {
            background: #63AB45;
            transform: scale(1.1);
        }

        .modal-prev {
            margin-left: 30px;
        }

        .modal-next {
            margin-right: 30px;
        }

        .image-counter {
            position: absolute;
            bottom: -40px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.6);
            padding: 5px 15px;
            border-radius: 30px;
            color: white;
            font-size: 14px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .gallery-empty {
            text-align: center;
            padding: 60px;
            background: #f9fafb;
            border-radius: 24px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gallery-item {
            animation: fadeInUp 0.4s ease forwards;
            opacity: 0;
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{asset('assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div>
        <div class="container">
            <div class="page-header__content">
                <h2 class="page-header__title">{{ $album->name }}</h2>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-page section-space" style="padding-top: 0;">
        <div class="container" style="margin-top: -80px;">


            <div class="album-header">
                <h1>{{ $album->name }}</h1>
                <p><i class="fas fa-camera"></i> {{ $photos->count() }} Photos</p>
            </div>

            @if(count($photos) > 0)
                <div class="gallery-grid">
                    @foreach ($photos as $index => $photo)
                        <div class="gallery-item" style="animation-delay: {{ ($index % 12) * 0.04 }}s">
                            <div class="gallery-page__card" data-index="{{ $index }}" data-src="{{ asset('storage/gallery/'.$photo->img_name) }}">
                                <img src="{{ asset('storage/gallery/'.$photo->img_name) }}"
                                     alt="{{ $photo->filename ?? $album->name . ' - Photo ' . ($index+1) }}"
                                     loading="lazy">
                                <div class="gallery-page__card__hover">
                                    <div class="gallery-page__card__icon">
                                        <span class="gallery-page__card__icon__item"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="gallery-empty">
                    <i class="fas fa-images"></i>
                    <h3>No Photos Yet</h3>
                    <p>This album doesn't have any photos at the moment.</p>
                    <a href="{{ route('front.gallery') }}" class="gotur-btn">
                        Browse Other Albums
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Custom Lightbox Modal -->
    <div id="imageModal" class="image-modal">
        <div class="modal-content-custom">
            <span class="close-modal">&times;</span>
            <img id="modalImage" src="" alt="Gallery Image">
            <div class="modal-nav">
                <span class="modal-prev">&#10094;</span>
                <span class="modal-next">&#10095;</span>
            </div>
            <div class="image-counter">
                <span id="currentImageIndex">1</span> / <span id="totalImages">0</span>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        (function() {
            'use strict';

            // Get all gallery images
            const galleryItems = document.querySelectorAll('.gallery-page__card');
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const closeModal = document.querySelector('.close-modal');
            const prevBtn = document.querySelector('.modal-prev');
            const nextBtn = document.querySelector('.modal-next');
            const currentIndexSpan = document.getElementById('currentImageIndex');
            const totalImagesSpan = document.getElementById('totalImages');

            let currentIndex = 0;
            let imagesArray = [];

            // Collect all image URLs
            galleryItems.forEach((item, index) => {
                const imgSrc = item.querySelector('img').src;
                imagesArray.push(imgSrc);
            });

            // Set total images count
            if (totalImagesSpan) {
                totalImagesSpan.textContent = imagesArray.length;
            }

            // Open modal when clicking on any gallery card
            galleryItems.forEach((item, index) => {
                item.addEventListener('click', function(e) {
                    // Don't trigger if clicking on the icon specifically (prevents double trigger)
                    if (e.target.closest('.gallery-page__card__icon')) {
                        e.stopPropagation();
                    }
                    currentIndex = index;
                    openModal(currentIndex);
                });
            });

            // Open modal function
            function openModal(index) {
                if (!modal || !modalImage) return;

                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
                updateModalImage(index);
            }

            // Update modal image
            function updateModalImage(index) {
                if (!modalImage || !currentIndexSpan) return;

                modalImage.src = imagesArray[index];
                modalImage.alt = 'Gallery Image ' + (index + 1);
                currentIndexSpan.textContent = index + 1;
                currentIndex = index;
            }

            // Close modal
            function closeModalFunction() {
                if (!modal) return;

                modal.classList.remove('show');
                document.body.style.overflow = '';
            }

            // Previous image
            function prevImage() {
                let newIndex = currentIndex - 1;
                if (newIndex < 0) {
                    newIndex = imagesArray.length - 1;
                }
                updateModalImage(newIndex);
            }

            // Next image
            function nextImage() {
                let newIndex = currentIndex + 1;
                if (newIndex >= imagesArray.length) {
                    newIndex = 0;
                }
                updateModalImage(newIndex);
            }

            // Event listeners
            if (closeModal) {
                closeModal.addEventListener('click', closeModalFunction);
            }

            if (prevBtn) {
                prevBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    prevImage();
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    nextImage();
                });
            }

            // Close modal when clicking outside the image
            if (modal) {
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        closeModalFunction();
                    }
                });
            }

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (modal && modal.classList.contains('show')) {
                    if (e.key === 'Escape') {
                        closeModalFunction();
                    } else if (e.key === 'ArrowLeft') {
                        prevImage();
                    } else if (e.key === 'ArrowRight') {
                        nextImage();
                    }
                }
            });

        })();
    </script>
@endpush
