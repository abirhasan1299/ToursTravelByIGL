@extends('layout.theme')
@section('title','Destination')

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

@section('content')
    <section class="destination-section" style="margin-top: -50px;">
        <div class="container">
            <!-- Destination Grid -->
            <div class="destinations-grid">
                @foreach($data as $index => $d)
                    <div class="destination-card">
                        <div class="card-image">
                            <img src="{{asset('storage/'.$d->images->first()?->image_name)}}" alt="{{$d->country}}">
                            <div class="card-overlay">
                                <div class="overlay-content">
                                    <a href="{{route('front.des.about',base64_encode($d->id))}}" class="view-details-btn">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                            <div class="card-badge">
                                <i class="fas fa-map-marker-alt"></i> {{$d->country}}
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="{{route('front.des.about',base64_encode($d->id))}}">{{$d->country}}</a>
                                </h3>
                                <div class="card-rating">
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="rating-count">({{rand(50, 200)}} reviews)</span>
                                </div>
                            </div>

                            <div class="card-stats">
                                <div class="stat-item">
                                    <i class="fas fa-calendar-alt"></i>
                                    <div class="stat-info">
                                        <span class="stat-value">{{rand(5, 30)}}+</span>
                                        <span class="stat-label">Tours</span>
                                    </div>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat-item">
                                    <i class="fas fa-users"></i>
                                    <div class="stat-info">
                                        <span class="stat-value">{{rand(1, 5)}}k+</span>
                                        <span class="stat-label">Travelers</span>
                                    </div>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat-item">
                                    <i class="fas fa-clock"></i>
                                    <div class="stat-info">
                                        <span class="stat-value">{{rand(3, 14)}}</span>
                                        <span class="stat-label">Avg Days</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{route('front.des.about',base64_encode($d->id))}}" class="explore-btn">
                                    <span>Explore Destination</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </section>

    @push('css')
        <style>
            /* Main Section Styles */
            .destination-section {
                padding: 100px 0;
                background: linear-gradient(135deg, #f9faf9 0%, #ffffff 100%);
                position: relative;
                overflow: hidden;
            }

            .destination-section::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 400px;
                background: radial-gradient(circle at 0% 0%, rgba(99, 171, 69, 0.05) 0%, transparent 70%);
                pointer-events: none;
            }

            /* Section Header */
            .section-header {
                margin-bottom: 60px;
                position: relative;
            }

            .section-subtitle {
                margin-bottom: 15px;
            }

            .section-subtitle span {
                display: inline-block;
                padding: 6px 20px;
                background: linear-gradient(135deg, rgba(99, 171, 69, 0.1) 0%, rgba(99, 171, 69, 0.05) 100%);
                color: var(--gotur-base, #63AB45);
                font-size: 13px;
                font-weight: 600;
                letter-spacing: 1px;
                text-transform: uppercase;
                border-radius: 50px;
            }

            .section-title {
                font-size: 42px;
                font-weight: 800;
                color: var(--gotur-black, #1D231F);
                margin-bottom: 20px;
                line-height: 1.2;
            }

            .section-title .highlight {
                color: var(--gotur-base, #63AB45);
                position: relative;
                display: inline-block;
            }

            .section-title .highlight::after {
                content: '';
                position: absolute;
                bottom: 5px;
                left: 0;
                right: 0;
                height: 8px;
                background: rgba(99, 171, 69, 0.2);
                border-radius: 4px;
                z-index: -1;
            }

            .section-description {
                max-width: 650px;
                margin: 0 auto;
                color: var(--gotur-text, #595959);
                font-size: 16px;
                line-height: 1.7;
            }

            /* Destinations Grid */
            .destinations-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
                gap: 30px;
                margin-bottom: 50px;
            }

            /* Destination Card */
            .destination-card {
                background: #ffffff;
                border-radius: 20px;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
                position: relative;
            }

            .destination-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(99, 171, 69, 0.15);
            }

            /* Card Image */
            .card-image {
                position: relative;
                overflow: hidden;
                height: 280px;
                background: #f0f0f0;
            }

            .card-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .destination-card:hover .card-image img {
                transform: scale(1.08);
            }

            /* Card Overlay */
            .card-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(99, 171, 69, 0.92) 0%, rgba(79, 137, 55, 0.92) 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: all 0.4s ease;
                backdrop-filter: blur(5px);
            }

            .destination-card:hover .card-overlay {
                opacity: 1;
            }

            .overlay-content {
                transform: translateY(20px);
                transition: transform 0.4s ease;
                text-align: center;
            }

            .destination-card:hover .overlay-content {
                transform: translateY(0);
            }

            .view-details-btn {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                padding: 12px 28px;
                background: #ffffff;
                color: var(--gotur-base, #63AB45);
                border-radius: 50px;
                font-size: 14px;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .view-details-btn:hover {
                background: var(--gotur-black, #1D231F);
                color: #ffffff;
                transform: translateX(5px);
                gap: 15px;
            }

            /* Card Badge */
            .card-badge {
                position: absolute;
                top: 20px;
                right: 20px;
                background: rgba(0, 0, 0, 0.75);
                backdrop-filter: blur(8px);
                color: #ffffff;
                padding: 6px 14px;
                border-radius: 50px;
                font-size: 12px;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 6px;
                z-index: 2;
                transition: all 0.3s ease;
            }

            .card-badge i {
                color: var(--gotur-base, #63AB45);
                font-size: 11px;
            }

            .destination-card:hover .card-badge {
                background: var(--gotur-base, #63AB45);
                transform: translateY(-2px);
            }

            .destination-card:hover .card-badge i {
                color: #ffffff;
            }

            /* Card Content */
            .card-content {
                padding: 24px;
                background: #ffffff;
            }

            .card-header {
                margin-bottom: 20px;
            }

            .card-title {
                font-size: 22px;
                font-weight: 700;
                margin-bottom: 10px;
                line-height: 1.3;
            }

            .card-title a {
                color: var(--gotur-black, #1D231F);
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .card-title a:hover {
                color: var(--gotur-base, #63AB45);
            }

            .card-rating {
                display: flex;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
            }

            .stars {
                display: flex;
                gap: 3px;
            }

            .stars i {
                color: #FFB800;
                font-size: 12px;
            }

            .rating-count {
                color: var(--gotur-text, #595959);
                font-size: 12px;
            }

            /* Card Stats */
            .card-stats {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 16px 0;
                margin-bottom: 20px;
                border-top: 1px solid #E5E7EB;
                border-bottom: 1px solid #E5E7EB;
            }

            .stat-item {
                display: flex;
                align-items: center;
                gap: 10px;
                flex: 1;
            }

            .stat-item i {
                font-size: 18px;
                color: var(--gotur-base, #63AB45);
                width: 24px;
            }

            .stat-info {
                display: flex;
                flex-direction: column;
            }

            .stat-value {
                font-size: 16px;
                font-weight: 700;
                color: var(--gotur-black, #1D231F);
                line-height: 1.2;
            }

            .stat-label {
                font-size: 11px;
                color: var(--gotur-text, #595959);
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .stat-divider {
                width: 1px;
                height: 30px;
                background: #E5E7EB;
            }

            /* Card Footer */
            .card-footer {
                margin-top: auto;
            }

            .explore-btn {
                display: inline-flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                padding: 12px 20px;
                background: linear-gradient(135deg, #f8faf7 0%, #ffffff 100%);
                color: var(--gotur-base, #63AB45);
                text-decoration: none;
                border-radius: 12px;
                font-weight: 600;
                font-size: 14px;
                transition: all 0.3s ease;
                border: 1px solid rgba(99, 171, 69, 0.2);
            }

            .explore-btn span {
                transition: transform 0.3s ease;
            }

            .explore-btn i {
                transition: transform 0.3s ease;
            }

            .explore-btn:hover {
                background: var(--gotur-base, #63AB45);
                color: #ffffff;
                border-color: transparent;
                transform: translateY(-2px);
            }

            .explore-btn:hover span {
                transform: translateX(-3px);
            }

            .explore-btn:hover i {
                transform: translateX(5px);
            }

            /* View All Button */
            .view-all-wrapper {
                margin-top: 20px;
            }

            .view-all-btn {
                display: inline-flex;
                align-items: center;
                gap: 12px;
                padding: 14px 32px;
                background: transparent;
                border: 2px solid var(--gotur-base, #63AB45);
                color: var(--gotur-base, #63AB45);
                border-radius: 50px;
                font-weight: 600;
                font-size: 15px;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .view-all-btn:hover {
                background: var(--gotur-base, #63AB45);
                color: #ffffff;
                transform: translateY(-3px);
                box-shadow: 0 10px 25px rgba(99, 171, 69, 0.2);
                gap: 15px;
            }

            /* Responsive Design */
            @media (max-width: 1200px) {
                .destinations-grid {
                    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                    gap: 25px;
                }
            }

            @media (max-width: 991px) {
                .destination-section {
                    padding: 70px 0;
                }

                .section-title {
                    font-size: 36px;
                }

                .card-image {
                    height: 250px;
                }

                .card-title {
                    font-size: 20px;
                }
            }

            @media (max-width: 768px) {
                .destination-section {
                    padding: 50px 0;
                }

                .section-title {
                    font-size: 30px;
                }

                .section-description {
                    font-size: 14px;
                    padding: 0 15px;
                }

                .destinations-grid {
                    grid-template-columns: 1fr;
                    gap: 20px;
                }

                .card-image {
                    height: 230px;
                }

                .card-content {
                    padding: 20px;
                }

                .card-stats {
                    padding: 12px 0;
                }

                .stat-item i {
                    font-size: 16px;
                }

                .stat-value {
                    font-size: 14px;
                }
            }

            @media (max-width: 576px) {
                .destination-section {
                    padding: 40px 0;
                }

                .section-title {
                    font-size: 26px;
                }

                .section-subtitle span {
                    font-size: 11px;
                    padding: 4px 16px;
                }

                .card-image {
                    height: 200px;
                }

                .card-title {
                    font-size: 18px;
                }

                .view-all-btn {
                    padding: 10px 24px;
                    font-size: 13px;
                }
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

            .destination-card {
                animation: fadeInUp 0.6s ease forwards;
                opacity: 0;
            }


        </style>
    @endpush

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add intersection observer for cards
                const cards = document.querySelectorAll('.destination-card');

                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const cardObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            cardObserver.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                cards.forEach(card => {
                    cardObserver.observe(card);
                });

                // Lazy loading for images
                const images = document.querySelectorAll('.card-image img');

                if ('IntersectionObserver' in window) {
                    const imageObserver = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                const img = entry.target;
                                if (img.dataset.src) {
                                    img.src = img.dataset.src;
                                }
                                imageObserver.unobserve(img);
                            }
                        });
                    });

                    images.forEach(img => imageObserver.observe(img));
                }
            });
        </script>
    @endpush
@endsection
