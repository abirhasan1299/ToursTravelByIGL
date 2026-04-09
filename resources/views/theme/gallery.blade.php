@extends('layout.theme')
@section('title', 'Gallery')
@section('meta_description', $seo->description??"IGL Web Ltd")
@section('meta_keywords', $seo->keywords??"")
@section('meta_robots', $seo->robots??"")
@section('favicon', asset('storage/'.$seo->icon??asset('assets/images/favicons/favicon-16x16.png')))

@section('og_type', $seo->og_type??"")
@section('og_title', $seo->og_title??"")
@section('og_description', $seo->og_description??"")
@section('og_width', $seo->og_width??"")
@section('og_height', $seo->og_height??"")
@section('meta_image', asset('storage/'.$seo->og_image??asset('assets/images/igl.png')))

@section('twitter_title', $seo->twitter_title??"")
@section('twitter_meta_description', $seo->twitter_description??"")
@section('twitter_meta_image', asset('storage/'.$seo->twitter_image??asset('assets/images/igl.png')))


@push('css')
<style>
    /* Gallery Page Enhancements */
    .gallery-page {
        background: var(--gotur-white, #fff);
    }

    /* Filter Buttons */
    .gallery-filter {
        margin-bottom: 50px;
        text-align: center;
    }

    .filter-btn {
        display: inline-flex;
        align-items: center;
        padding: 10px 28px;
        margin: 5px;
        background: var(--gotur-gray, #F3F8F6);
        border: none;
        border-radius: 50px;
        font-size: 15px;
        font-weight: 600;
        color: var(--gotur-text, #595959);
        cursor: pointer;
        transition: all 0.3s ease;
        font-family: var(--gotur-font, "Plus Jakarta Sans", sans-serif);
    }

    .filter-btn i {
        margin-right: 8px;
        font-size: 14px;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: var(--gotur-base, #63AB45);
        color: var(--gotur-white, #fff);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(99, 171, 69, 0.3);
    }

    /* Gallery Card Enhancement */
    .gallery-page__card {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        cursor: pointer;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.4s ease;
    }

    .gallery-page__card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .gallery-page__card img {
        width: 100%;
        height: 320px;
        object-fit: cover;
        display: block;
        transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .gallery-page__card:hover img {
        transform: scale(1.1);
    }

    /* Overlay Styles */
    .gallery-page__card__hover {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(99, 171, 69, 0.9) 0%, rgba(247, 146, 30, 0.9) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: all 0.4s ease;
        transform: scale(0.8);
    }

    .gallery-page__card:hover .gallery-page__card__hover {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
    }

    /* Icon Styles */
    .gallery-page__card__icon {
        width: 60px;
        height: 60px;
        background: var(--gotur-white, #fff);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .gallery-page__card__icon__item {
        position: relative;
        width: 24px;
        height: 24px;
        display: block;
    }

    .gallery-page__card__icon__item::before,
    .gallery-page__card__icon__item::after {
        content: '';
        position: absolute;
        background: var(--gotur-base, #63AB45);
        transition: all 0.3s ease;
    }

    .gallery-page__card__icon__item::before {
        width: 2px;
        height: 100%;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
    }

    .gallery-page__card__icon__item::after {
        width: 100%;
        height: 2px;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
    }

    .gallery-page__card__icon:hover {
        transform: rotate(90deg);
        background: var(--gotur-primary, #F7921E);
    }

    .gallery-page__card__icon:hover .gallery-page__card__icon__item::before,
    .gallery-page__card__icon:hover .gallery-page__card__icon__item::after {
        background: var(--gotur-white, #fff);
    }

    /* Card Info Overlay (Optional) */
    .gallery-card-info {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 20px;
        transform: translateY(100%);
        transition: transform 0.4s ease;
    }

    .gallery-page__card:hover .gallery-card-info {
        transform: translateY(0);
    }

    .gallery-card-info h4 {
        color: var(--gotur-white, #fff);
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .gallery-card-info p {
        color: rgba(255,255,255,0.8);
        font-size: 13px;
        margin: 0;
    }

    /* Lightbox Customization */
    .mfp-figure figure {
        margin: 0;
    }

    .mfp-title {
        font-size: 14px;
        text-align: center;
        padding: 10px 0;
    }

    /* Masonry Layout Enhancement */
    .masonry-layout {
        position: relative;
    }

    /* Load More Button */
    .load-more-wrapper {
        text-align: center;
        margin-top: 60px;
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
    .gallery-empty {
        text-align: center;
        padding: 80px 20px;
        background: var(--gotur-gray, #F3F8F6);
        border-radius: 20px;
    }

    .gallery-empty i {
        font-size: 64px;
        color: var(--gotur-base, #63AB45);
        margin-bottom: 20px;
        display: block;
    }

    .gallery-empty h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .gallery-empty p {
        color: var(--gotur-text, #595959);
    }

    /* Responsive Adjustments */
    @media (max-width: 1199px) {
        .gallery-page__card img {
            height: 280px;
        }
    }

    @media (max-width: 768px) {
        .filter-btn {
            padding: 6px 18px;
            font-size: 13px;
        }

        .gallery-page__card img {
            height: 240px;
        }

        .load-more-btn {
            padding: 12px 28px;
            font-size: 14px;
        }
    }

    @media (max-width: 576px) {
        .gallery-filter {
            margin-bottom: 30px;
        }

        .filter-btn {
            padding: 5px 14px;
            font-size: 12px;
            margin: 3px;
        }

        .gallery-page__card img {
            height: 200px;
        }
    }

    /* Animation for Gallery Items */
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

    .gallery-page__card {
        animation: fadeInUp 0.6s ease forwards;
        opacity: 0;
    }

    .gallery-page__card:nth-child(1) { animation-delay: 0.1s; }
    .gallery-page__card:nth-child(2) { animation-delay: 0.2s; }
    .gallery-page__card:nth-child(3) { animation-delay: 0.3s; }
    .gallery-page__card:nth-child(4) { animation-delay: 0.4s; }
    .gallery-page__card:nth-child(5) { animation-delay: 0.5s; }
    .gallery-page__card:nth-child(6) { animation-delay: 0.6s; }
    .gallery-page__card:nth-child(7) { animation-delay: 0.7s; }
    .gallery-page__card:nth-child(8) { animation-delay: 0.8s; }
    .gallery-page__card:nth-child(9) { animation-delay: 0.9s; }
    .gallery-page__card:nth-child(10) { animation-delay: 1s; }
    .gallery-page__card:nth-child(11) { animation-delay: 1.1s; }
    .gallery-page__card:nth-child(12) { animation-delay: 1.2s; }
</style>
@endpush

@section('content')
    <!-- Page Header -->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{asset('assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div>
        <div class="container">
            <div class="page-header__content">
                <h2 class="page-header__title bw-split-in-right">Our Gallery</h2>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-page section-space" >
        <div class="container" style="margin-top: -100px;">
            <!-- Filter Buttons (Optional - Add categories if you have them) -->
            <div class="gallery-filter wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                <button class="filter-btn active" data-filter="all">
                    <i class="fas fa-th-large"></i> All Photos
                </button>
                @php
                    $categories = [];
                    foreach($data as $d) {
                        if(isset($d->category) && !in_array($d->category, $categories)) {
                            $categories[] = $d->category;
                        }
                    }
                @endphp
                @foreach($categories as $category)
                    <button class="filter-btn" data-filter="{{ strtolower(str_replace(' ', '-', $category)) }}">
                        <i class="fas fa-tag"></i> {{ ucfirst($category) }}
                    </button>
                @endforeach
            </div>

            <!-- Gallery Grid -->
            @if(count($data) > 0)
                <div class="row masonry-layout gutter-y-30 gutter-x-30" id="galleryGrid">
                    @foreach ($data as $index => $d)
                        <div class="col-md-6 col-lg-4 gallery-item" data-category="{{ isset($d->category) ? strtolower(str_replace(' ', '-', $d->category)) : 'all' }}">
                            <div class="gallery-page__card wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="{{ 200 + ($index * 100) }}ms">
                                <img src="{{asset('storage/gallery/'.$d->img_name)}}" alt="{{$d->title ?? 'Gallery Image'}}">


                            </div>
                        </div>
                    @endforeach
                </div>


            @else
                <!-- Empty State -->
                <div class="gallery-empty wow fadeInUp" data-wow-duration="1500ms">
                    <i class="fas fa-images"></i>
                    <h3>No Images Found</h3>
                    <p>We're currently updating our gallery. Please check back soon!</p>
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
        // Filter functionality
        const filterBtns = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');

        if (filterBtns.length > 0 && galleryItems.length > 0) {
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Update active state
                    filterBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const filterValue = this.getAttribute('data-filter');

                    // Filter items with animation
                    galleryItems.forEach((item, index) => {
                        if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                            item.style.display = 'block';
                            item.style.animation = 'none';
                            setTimeout(() => {
                                item.style.animation = 'fadeInUp 0.6s ease forwards';
                                item.style.animationDelay = (index * 0.1) + 's';
                            }, 10);
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        }

        // Lightbox/Gallery Popup
        if (typeof $.fn.magnificPopup !== 'undefined') {
            $('.img-popup').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1]
                },
                mainClass: 'mfp-with-zoom',
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out',
                    opener: function(openerElement) {
                        return openerElement.is('img') ? openerElement : openerElement.find('img');
                    }
                },
                image: {
                    titleSrc: function(item) {
                        return item.el.closest('.gallery-page__card').find('img').attr('alt') || 'Gallery Image';
                    }
                }
            });
        }


        // Add hover effect enhancement
        const galleryCards = document.querySelectorAll('.gallery-page__card');
        galleryCards.forEach(card => {
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

            document.querySelectorAll('.gallery-page__card img').forEach(img => {
                if (img.getAttribute('data-src')) {
                    imageObserver.observe(img);
                }
            });
        }
    });
</script>
@endpush
