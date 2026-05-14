@extends('layout.theme')
@section('title', $data->country)
@push('css')
    <style>
        /* Language Item Styles */
        .language-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            gap: 15px;
        }

        /* Language Badges Wrapper */
        .language-badges-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: flex-end;
            align-items: center;
        }

        /* Update existing language-badge styles */
        .language-badge {
            display: inline-block;
            background: rgba(99, 171, 69, 0.1);
            color: var(--gotur-base, #63AB45);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            margin: 0;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .language-badge:hover {
            background: var(--gotur-base, #63AB45);
            color: white;
            transform: translateY(-2px);
        }

        /* Update list item styles */
        .destination-details__sidebar__list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid var(--gotur-border-color, #E5E5E5);
            transition: all 0.3s ease;
        }

        .destination-details__sidebar__list li:hover {
            transform: translateX(5px);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .language-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .language-badges-wrapper {
                justify-content: flex-start;
            }

            .destination-details__sidebar__list li {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
        /* Destination Hero Section */
        .destination-hero {
            position: relative;
            min-height: 500px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 60px;
            border-radius: 0 0 30px 30px;
            overflow: hidden;
        }

        .destination-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.3) 100%);
            z-index: 1;
        }

        .destination-hero__content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: var(--gotur-white, #fff);
            padding: 60px 20px;
        }

        .destination-hero__title {
            font-size: 56px;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: fadeInUp 0.8s ease;
        }

        .destination-hero__breadcrumb {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 16px;
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .destination-hero__breadcrumb a {
            color: var(--gotur-white, #fff);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .destination-hero__breadcrumb a:hover {
            color: var(--gotur-base, #63AB45);
        }

        .destination-hero__breadcrumb span {
            color: var(--gotur-base, #63AB45);
        }

        /* Main Content Styles */
        .destination-details {
            padding: 60px 0;
        }

        .destination-details__content__item {
            background: var(--gotur-white, #fff);
            border-radius: 20px;
            padding: 35px;
            margin-bottom: 35px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--gotur-border-color, #E5E5E5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .destination-details__content__item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .destination-details__title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
            color: var(--gotur-black, #1D231F);
        }

        .destination-details__title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--gotur-base, #63AB45);
            border-radius: 3px;
        }

        .destination-details__text {
            color: var(--gotur-text, #595959);
            line-height: 1.8;
            font-size: 16px;
        }

        /* Gallery Styles */
        .destination-details__content__thumb {
            margin-top: 10px;
        }

        .gallery-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            aspect-ratio: 4/3;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(99, 171, 69, 0.85);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay i {
            color: white;
            font-size: 32px;
            transform: scale(0.8);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay i {
            transform: scale(1);
        }

        /* Sidebar Styles */
        .destination-details__sidebar {
            position: sticky;
            top: 100px;
        }

        .destination-details__sidebar__item {
            background: var(--gotur-white, #fff);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--gotur-border-color, #E5E5E5);
            transition: all 0.3s ease;
        }

        .destination-details__sidebar__item:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .destination-details__sidebar__title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--gotur-base, #63AB45);
            display: inline-block;
            color: var(--gotur-black, #1D231F);
        }

        .destination-details__sidebar__list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .destination-details__sidebar__list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid var(--gotur-border-color, #E5E5E5);
            transition: all 0.3s ease;
        }

        .destination-details__sidebar__list li:last-child {
            border-bottom: none;
        }

        .destination-details__sidebar__list li:hover {
            transform: translateX(5px);
        }

        .destination-details__sidebar__text {
            font-weight: 600;
            color: var(--gotur-black, #1D231F);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .destination-details__sidebar__text i {
            color: var(--gotur-base, #63AB45);
            font-size: 16px;
        }

        .destination-details__sidebar__list li span {
            color: var(--gotur-text, #595959);
            font-weight: 500;
        }

        /* Language Badges */
        .language-badge {
            display: inline-block;
            background: rgba(99, 171, 69, 0.1);
            color: var(--gotur-base, #63AB45);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            margin: 0 3px;
            transition: all 0.3s ease;
        }

        .language-badge:hover {
            background: var(--gotur-base, #63AB45);
            color: white;
            transform: translateY(-2px);
        }

        /* Price Highlight */
        .price-highlight {
            font-size: 24px;
            font-weight: 800;
            color: var(--gotur-base, #63AB45);
        }

        .price-highlight small {
            font-size: 14px;
            font-weight: 400;
            color: var(--gotur-text, #595959);
        }

        /* Map Container */
        .destination-details__sidebar__item-map {
            padding: 0;
            overflow: hidden;
            border-radius: 20px;
        }

        .destination-details__sidebar__item-map iframe {
            width: 100%;
            height: 300px;
            border: none;
            transition: transform 0.3s ease;
        }

        .destination-details__sidebar__item-map:hover iframe {
            transform: scale(1.02);
        }

        /* Quick Stats Cards */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 35px;
        }

        .stat-card {
            background: var(--gotur-white, #fff);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            border: 1px solid var(--gotur-border-color, #E5E5E5);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--gotur-base, #63AB45);
            box-shadow: 0 10px 25px rgba(99, 171, 69, 0.1);
        }

        .stat-card i {
            font-size: 32px;
            color: var(--gotur-base, #63AB45);
            margin-bottom: 10px;
            display: inline-block;
        }

        .stat-card h4 {
            font-size: 24px;
            font-weight: 800;
            color: var(--gotur-black, #1D231F);
            margin-bottom: 5px;
        }

        .stat-card p {
            font-size: 13px;
            color: var(--gotur-text, #595959);
            margin: 0;
        }

        /* Animations */
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

        /* Responsive Styles */
        @media (max-width: 991px) {
            .destination-hero__title {
                font-size: 40px;
            }

            .destination-details__title {
                font-size: 28px;
            }

            .stats-cards {
                grid-template-columns: repeat(2, 1fr);
                gap: 15px;
            }
        }

        @media (max-width: 768px) {
            .destination-hero {
                min-height: 400px;
            }

            .destination-hero__title {
                font-size: 32px;
            }

            .destination-details__content__item {
                padding: 25px;
            }

            .destination-details__title {
                font-size: 24px;
            }

            .stats-cards {
                grid-template-columns: 1fr;
            }

            .destination-details__sidebar {
                position: static;
                margin-top: 30px;
            }
        }

        /* Print Styles */
        @media print {
            .destination-hero::before {
                background: none;
            }

            .destination-hero__content {
                color: black;
            }

            .destination-hero__breadcrumb a {
                color: black;
            }
        }
    </style>
@endpush

@section('content')

    <!-- Main Content -->
    <section class="destination-details">
        <div class="container">

            <div class="row gutter-y-30">
                <div class="col-lg-8">
                    <div class="destination-details__content">
                        <!-- Overview Section -->
                        <div class="destination-details__content__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='400ms'>
                            <h3 class="destination-details__title">Overview</h3>
                            <div class="destination-details__text">
                                {!! $data->overview !!}
                            </div>

                            @if($data->best_time_to_visit)
                                <div class="best-time mt-4">
                                    <h5><i class="fas fa-calendar-alt" style="color: var(--gotur-base); margin-right: 8px;"></i> Best Time to Visit</h5>
                                    <p class="mt-2">{{$data->best_time_to_visit}}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Top Destinations Section -->
                        <div class="destination-details__content__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                            <h3 class="destination-details__title">Top Destinations</h3>
                            <div class="destination-details__text">
                                {!! $data->description !!}
                            </div>
                        </div>

                        <!-- Gallery Section -->
                        @if($data->images && $data->images->count() > 0)
                            <div class="destination-details__content__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='600ms'>
                                <h3 class="destination-details__title">Photo Gallery</h3>
                                <div class="destination-details__content__thumb">
                                    <div class="row gutter-y-30">
                                        @foreach($data->images as $index => $img)
                                            <div class="col-md-6 col-sm-6">
                                                <div class="gallery-item" data-image="{{asset('storage/'.$img->image_name)}}">
                                                    <img src="{{asset('storage/'.$img->image_name)}}" alt="Gallery Image {{$index + 1}}">
                                                    <div class="gallery-overlay">
                                                        <i class="fas fa-search-plus"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Travel Tips Section (Optional) -->
                        @if($data->travel_tips)
                            <div class="destination-details__content__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='700ms'>
                                <h3 class="destination-details__title">Travel Tips</h3>
                                <div class="destination-details__text">
                                    {!! $data->travel_tips !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <aside class="destination-details__sidebar">
                        <!-- Information Card -->
                        <div class="destination-details__sidebar__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='400ms'>
                            <h4 class="destination-details__sidebar__title">Quick Information</h4>
                            <ul class="destination-details__sidebar__list">
                                <li>
                                    <p class="destination-details__sidebar__text">
                                        <i class="fas fa-flag"></i> Country:
                                    </p>
                                    <span>{{$data->country}}</span>
                                </li>
                                <li>
                                    <p class="destination-details__sidebar__text">
                                        <i class="fas fa-passport"></i> Visa Requirements:
                                    </p>
                                    <span class="{{$data->visa ? 'text-success' : 'text-danger'}}">
                                        <i class="fas {{$data->visa ? 'fa-check-circle' : 'fa-times-circle'}}"></i>
                                        {{$data->visa ? 'Required' : 'Not Required'}}
                                    </span>
                                </li>
                                <li>
                                    <p class="destination-details__sidebar__text">
                                        <i class="fas fa-money-bill-wave"></i> Average Cost:
                                    </p>
                                    <span class="price-highlight">
                                        {{config('app.currency')}} {{number_format($data->price ?? 0)}}
                                        <small>/person</small>
                                    </span>
                                </li>
                                <li>
                                    <p class="destination-details__sidebar__text">
                                        <i class="fas fa-language"></i> Languages:
                                    </p>
                                    <span>
                                        @if($data->languages && is_array($data->languages))
                                            @foreach($data->languages as $lang)
                                                <span class="language-badge">{{ $lang }}</span>
                                            @endforeach
                                        @else
                                            <span class="language-badge">English</span>
                                        @endif
                                    </span>
                                </li>

                            </ul>
                        </div>

                        <!-- Map Card -->
                        @if($data->map_link)
                            <div class="destination-details__sidebar__item destination-details__sidebar__item-map wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                                <h4 class="destination-details__sidebar__title" style="padding: 20px 20px 0 20px; margin-bottom: 0;">Location Map</h4>
                                <div style="margin-top: 20px;">
                                    {!! $data->map_link !!}
                                </div>
                            </div>
                        @endif


                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lightbox Gallery Functionality
            const galleryItems = document.querySelectorAll('.gallery-item');
            const lightboxModal = document.createElement('div');
            lightboxModal.className = 'lightbox-modal';
            lightboxModal.innerHTML = `
            <div class="lightbox-close">&times;</div>
            <div class="lightbox-prev"><i class="fas fa-chevron-left"></i></div>
            <div class="lightbox-next"><i class="fas fa-chevron-right"></i></div>
            <div class="lightbox-content">
                <img id="lightboxImage" src="" alt="">
            </div>
            <div class="lightbox-counter"></div>
        `;
            document.body.appendChild(lightboxModal);

            let currentIndex = 0;
            const images = Array.from(galleryItems).map(item => item.dataset.image || item.querySelector('img').src);

            function openLightbox(index) {
                currentIndex = index;
                const img = lightboxModal.querySelector('#lightboxImage');
                img.src = images[currentIndex];
                lightboxModal.querySelector('.lightbox-counter').textContent = `${currentIndex + 1} / ${images.length}`;
                lightboxModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeLightbox() {
                lightboxModal.classList.remove('active');
                document.body.style.overflow = '';
            }

            function nextImage() {
                currentIndex = (currentIndex + 1) % images.length;
                const img = lightboxModal.querySelector('#lightboxImage');
                img.src = images[currentIndex];
                lightboxModal.querySelector('.lightbox-counter').textContent = `${currentIndex + 1} / ${images.length}`;
            }

            function prevImage() {
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                const img = lightboxModal.querySelector('#lightboxImage');
                img.src = images[currentIndex];
                lightboxModal.querySelector('.lightbox-counter').textContent = `${currentIndex + 1} / ${images.length}`;
            }

            galleryItems.forEach((item, index) => {
                item.addEventListener('click', () => openLightbox(index));
            });

            lightboxModal.querySelector('.lightbox-close').addEventListener('click', closeLightbox);
            lightboxModal.querySelector('.lightbox-next').addEventListener('click', nextImage);
            lightboxModal.querySelector('.lightbox-prev').addEventListener('click', prevImage);

            lightboxModal.addEventListener('click', (e) => {
                if (e.target === lightboxModal) closeLightbox();
            });

            document.addEventListener('keydown', (e) => {
                if (!lightboxModal.classList.contains('active')) return;
                if (e.key === 'ArrowLeft') prevImage();
                if (e.key === 'ArrowRight') nextImage();
                if (e.key === 'Escape') closeLightbox();
            });

            // Add scroll animation for sidebar
            const sidebar = document.querySelector('.destination-details__sidebar');
            if (sidebar) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 100) {
                        sidebar.style.top = '80px';
                    } else {
                        sidebar.style.top = '100px';
                    }
                });
            }
        });
    </script>

    <style>
        /* Lightbox Modal Styles */
        .lightbox-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .lightbox-modal.active {
            opacity: 1;
            visibility: visible;
        }

        .lightbox-content {
            max-width: 90%;
            max-height: 90%;
            position: relative;
        }

        .lightbox-content img {
            max-width: 100%;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 10px;
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 40px;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10000;
        }

        .lightbox-close:hover {
            color: var(--gotur-base, #63AB45);
            transform: rotate(90deg);
        }

        .lightbox-prev,
        .lightbox-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.2);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 24px;
        }

        .lightbox-prev:hover,
        .lightbox-next:hover {
            background: var(--gotur-base, #63AB45);
        }

        .lightbox-prev {
            left: 30px;
        }

        .lightbox-next {
            right: 30px;
        }

        .lightbox-counter {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .lightbox-prev,
            .lightbox-next {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .lightbox-prev {
                left: 10px;
            }

            .lightbox-next {
                right: 10px;
            }
        }
    </style>
@endpush
