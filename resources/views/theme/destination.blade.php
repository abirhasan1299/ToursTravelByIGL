@extends('layout.theme')
@section('title','Destination')
@section('content')
    <section class="destination-one section-space">
        <div class="container">
            <!-- Section Header -->
            <div class="destination-header text-center wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                <div class="sec-title">
                    <h6 class="sec-title__tagline bw-split-in-right">Explore the World</h6>
                    <h3 class="sec-title__title bw-split-in-left">Popular <span>Destinations</span></h3>
                </div>
                <p class="destination-description">Discover the most breathtaking destinations around the globe. From pristine beaches to majestic mountains, find your next adventure with us.</p>
            </div>

            <!-- Destination Grid -->
            <div class="row gutter-y-30 gutter-x-30">
                @foreach($data as $index => $d)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='{{100 + ($index * 100)}}ms'>
                            <div class="destination-card-one__thumb">

                                <img src="{{asset('storage/'.$d->images->first()?->image_name)}}" alt="{{$d->country}}">

                                <div class="destination-card-one__overlay">
                                    <div class="overlay-content">
                                        <a href="{{route('front.des.about',base64_encode($d->id))}}" class="btn-view">
                                            <i class="fas fa-eye"></i> View Details
                                        </a>
                                    </div>
                                </div>
                                <div class="destination-badge">
                                    <i class="fas fa-map-marker-alt"></i> {{$d->country}}
                                </div>
                            </div>
                            <div class="destination-card-one__content">
                                <h3 class="destination-card-one__title">
                                    <a href="#">{{$d->country}}</a>
                                </h3>
                                <div class="destination-card-one__info" style="margin-left:50px;">
                                </div>
                                <div class="destination-card-one__footer">
                                    <a href="{{route('front.des.about',base64_encode($d->id))}}" class="explore-link">
                                        Explore Now <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    @push('css')
        <style>
            /* Destination Header Styles */
            .destination-header {
                margin-bottom: 50px;
            }

            .destination-description {
                max-width: 700px;
                margin: 15px auto 0;
                color: var(--gotur-text, #595959);
                font-size: 16px;
                line-height: 1.6;
            }

            /* Destination Card Styles */
            .destination-card-one {
                position: relative;
                background: var(--gotur-white, #fff);
                border-radius: 20px;
                overflow: hidden;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.5);
            }

            .destination-card-one:hover {
                transform: translateY(-10px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
            }

            .destination-card-one__thumb {
                position: relative;
                overflow: hidden;
                aspect-ratio: 4/3;
            }

            .destination-card-one__thumb img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .destination-card-one:hover .destination-card-one__thumb img {
                transform: scale(1.1);
            }

            /* Overlay Styles */
            .destination-card-one__overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(99, 171, 69, 0.9) 0%, rgba(79, 137, 55, 0.9) 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: all 0.4s ease;
                z-index: 2;
            }

            .destination-card-one:hover .destination-card-one__overlay {
                opacity: 1;
            }

            .overlay-content {
                transform: translateY(20px);
                transition: transform 0.4s ease;
            }

            .destination-card-one:hover .overlay-content {
                transform: translateY(0);
            }

            .btn-view {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                padding: 10px 20px;
                background: var(--gotur-white, #fff);
                color: var(--gotur-base, #63AB45);
                border-radius: 50px;
                font-size: 14px;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .btn-view:hover {
                background: var(--gotur-black, #1D231F);
                color: var(--gotur-white, #fff);
                transform: translateX(5px);
            }

            /* Badge Styles */
            .destination-badge {
                position: absolute;
                top: 15px;
                right: 15px;
                background: rgba(0, 0, 0, 0.7);
                backdrop-filter: blur(5px);
                color: var(--gotur-white, #fff);
                padding: 6px 12px;
                border-radius: 30px;
                font-size: 12px;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 6px;
                z-index: 3;
                transition: all 0.3s ease;
            }

            .destination-badge i {
                font-size: 12px;
                color: var(--gotur-base, #63AB45);
            }

            .destination-card-one:hover .destination-badge {
                background: var(--gotur-base, #63AB45);
                transform: translateY(-2px);
            }

            .destination-card-one:hover .destination-badge i {
                color: var(--gotur-white, #fff);
            }

            /* Content Styles */
            .destination-card-one__content {
                padding: 20px;
                background: var(--gotur-white, #fff);
                position: relative;
            }

            .destination-card-one__title {
                font-size: 20px;
                font-weight: 700;
                margin-bottom: 12px;
                line-height: 1.3;
            }

            .destination-card-one__title a {
                color: var(--gotur-black, #1D231F);
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .destination-card-one__title a:hover {
                color: var(--gotur-base, #63AB45);
            }

            /* Info Section */
            .destination-card-one__info {
                display: flex;
                gap: 15px;
                margin-bottom: 15px;
                padding-bottom: 15px;
                border-bottom: 1px solid var(--gotur-border-color, #E5E5E5);
            }

            .info-item {
                display: flex;
                align-items: center;
                gap: 6px;
                font-size: 13px;
                color: var(--gotur-text, #595959);
            }

            .info-item i {
                color: var(--gotur-base, #63AB45);
                font-size: 12px;
            }

            /* Footer Styles */
            .destination-card-one__footer {
                margin-top: 5px;
            }

            .explore-link {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                color: var(--gotur-text, #595959);
                font-size: 13px;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .explore-link i {
                font-size: 12px;
                transition: transform 0.3s ease;
            }

            .explore-link:hover {
                color: var(--gotur-base, #63AB45);
            }

            .explore-link:hover i {
                transform: translateX(5px);
            }

            /* View All Button */
            .destination-view-all {
                margin-top: 50px;
            }

            .gotur-btn--outline {
                background: transparent;
                border: 2px solid var(--gotur-base, #63AB45);
                color: var(--gotur-base, #63AB45);
                padding: 12px 30px;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .gotur-btn--outline:hover {
                background: var(--gotur-base, #63AB45);
                color: var(--gotur-white, #fff);
                transform: translateY(-3px);
                box-shadow: 0 10px 20px rgba(99, 171, 69, 0.2);
            }

            /* Responsive Adjustments */
            @media (max-width: 991px) {
                .destination-card-one__title {
                    font-size: 18px;
                }

                .destination-description {
                    font-size: 14px;
                    padding: 0 15px;
                }
            }

            @media (max-width: 768px) {
                .destination-header {
                    margin-bottom: 30px;
                }

                .destination-card-one__info {
                    flex-direction: column;
                    gap: 8px;
                }

                .info-item {
                    font-size: 12px;
                }

                .destination-card-one__content {
                    padding: 15px;
                }

                .destination-view-all {
                    margin-top: 30px;
                }

                .gotur-btn--outline {
                    padding: 10px 25px;
                    font-size: 14px;
                }
            }

            /* Loading Animation for Images */
            .destination-card-one__thumb img {
                opacity: 0;
                animation: fadeIn 0.5s ease forwards;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: scale(0.95);
                }
                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            /* Optional: Hover Glow Effect */
            .destination-card-one {
                position: relative;
            }

            .destination-card-one::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                border-radius: 20px;
                background: linear-gradient(135deg, rgba(99, 171, 69, 0.1) 0%, rgba(79, 137, 55, 0.05) 100%);
                opacity: 0;
                transition: opacity 0.4s ease;
                pointer-events: none;
                z-index: 1;
            }

            .destination-card-one:hover::before {
                opacity: 1;
            }
        </style>
    @endpush

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Add lazy loading for images
                const images = document.querySelectorAll('.destination-card-one__thumb img');

                if ('IntersectionObserver' in window) {
                    const imageObserver = new IntersectionObserver((entries, observer) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                const img = entry.target;
                                img.classList.add('loaded');
                                imageObserver.unobserve(img);
                            }
                        });
                    });

                    images.forEach(img => imageObserver.observe(img));
                }

                // Add hover effect for cards
                const cards = document.querySelectorAll('.destination-card-one');
                cards.forEach(card => {
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
@endsection

