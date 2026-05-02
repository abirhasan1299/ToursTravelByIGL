@push('css')
    <style>
        /* Modern Tour Card Design */
        .tour-card-modern {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(99, 171, 69, 0.08);
        }

        .tour-card-modern:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(99, 171, 69, 0.12);
            border-color: rgba(99, 171, 69, 0.2);
        }

        /* Image Wrapper - Now contains the anchor link */
        .tour-card-modern__image-wrapper {
            position: relative;
            padding-top: 70%; /* 16:9 aspect ratio */
            overflow: hidden;
        }

        /* Image Link - Full coverage anchor */
        .tour-card-modern__image-link {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: block;
            text-decoration: none;
            cursor: pointer;
        }

        .tour-card-modern__image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            pointer-events: none; /* Allows click to pass through to the anchor */
        }

        .tour-card-modern:hover .tour-card-modern__image {
            transform: scale(1.08);
        }

        /* Overlay Gradient */
        .tour-card-modern__overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                to bottom,
                rgba(0, 0, 0, 0.1) 0%,
                rgba(0, 0, 0, 0.02) 40%,
                rgba(0, 0, 0, 0.6) 100%
            );
            pointer-events: none;
            z-index: 1;
        }

        /* Featured Badge - Keep clickable through */
        .tour-card-modern__featured {
            position: absolute;
            top: 16px;
            left: 16px;
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #1a1a1a;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(255, 165, 0, 0.3);
            z-index: 3;
            display: flex;
            align-items: center;
            gap: 5px;
            pointer-events: none; /* Badge doesn't block clicks */
        }

        .tour-card-modern__featured i {
            font-size: 10px;
            color: #1a1a1a;
        }

        /* Tour Type Badge */
        .tour-card-modern__type {
            position: absolute;
            top: 16px;
            right: 16px;
            background: rgba(99, 171, 69, 0.9);
            backdrop-filter: blur(4px);
            color: #ffffff;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 3;
            display: flex;
            align-items: center;
            gap: 5px;
            box-shadow: 0 4px 12px rgba(99, 171, 69, 0.2);
            pointer-events: none; /* Badge doesn't block clicks */
        }

        /* Location Info - Route Display */
        .tour-card-modern__location-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px 16px 16px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, transparent 100%);
            z-index: 2;
            pointer-events: none; /* Location info doesn't block clicks */
        }

        .tour-card-modern__route {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #ffffff;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .route-start,
        .route-end {
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 120px;
        }

        .route-arrow {
            color: #63AB45;
            font-size: 18px;
            flex-shrink: 0;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
        }

        /* Content Section */
        .tour-card-modern__content {
            padding: 20px 18px 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #ffffff;
        }

        /* Title */
        .tour-card-modern__title {
            font-size: 18px;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 15px;
        }

        .tour-card-modern__title a {
            color: #1a1a1a;
            text-decoration: none;
            transition: color 0.3s ease;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .tour-card-modern__title a:hover {
            color: #63AB45;
        }

        /* Meta Info */
        .tour-card-modern__meta {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(99, 171, 69, 0.1);
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #666;
        }

        .meta-item i {
            color: #63AB45;
            font-size: 13px;
            width: 16px;
        }

        /* Footer with Price and Button */
        .tour-card-modern__footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
        }

        /* Price Styling */
        .tour-card-modern__price {
            display: flex;
            flex-direction: column;
        }

        .price-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #999;
            margin-bottom: 2px;
        }

        .price-amount {
            display: flex;
            align-items: baseline;
            gap: 2px;
        }

        .currency {
            font-size: 14px;
            font-weight: 600;
            color: #63AB45;
        }

        .amount {
            font-size: 22px;
            font-weight: 800;
            color: #63AB45;
            line-height: 1;
        }

        .price-per {
            font-size: 10px;
            color: #999;
            margin-top: 2px;
        }

        /* View Details Button */
        .tour-card-modern__btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #63AB45 0%, #4f9234 100%);
            color: #ffffff;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(99, 171, 69, 0.25);
        }

        .tour-card-modern__btn i {
            font-size: 11px;
            transition: transform 0.3s ease;
        }

        .tour-card-modern__btn:hover {
            background: #4f9234;
            transform: translateX(2px);
            box-shadow: 0 6px 16px rgba(99, 171, 69, 0.35);
            color: #ffffff;
        }

        .tour-card-modern__btn:hover i {
            transform: translateX(4px);
        }

        /* Empty State - No Results */
        .no-results-modern {
            text-align: center;
            padding: 60px 30px;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(99, 171, 69, 0.1);
        }

        .no-results-modern__icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(99, 171, 69, 0.1) 0%, rgba(99, 171, 69, 0.05) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }

        .no-results-modern__icon i {
            font-size: 48px;
            color: #63AB45;
            opacity: 0.7;
        }

        .no-results-modern h4 {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .no-results-modern p {
            font-size: 15px;
            color: #666;
            max-width: 400px;
            margin: 0 auto 24px;
            line-height: 1.6;
        }

        .no-results-modern__btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: #63AB45;
            color: #ffffff;
            border-radius: 40px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 171, 69, 0.25);
        }

        .no-results-modern__btn:hover {
            background: #4f9234;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 171, 69, 0.35);
            color: #ffffff;
        }

        /* Cursor pointer on hover over image area */
        .tour-card-modern__image-link {
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .route-start,
            .route-end {
                max-width: 100px;
                font-size: 13px;
            }
        }

        @media (max-width: 992px) {
            .tour-card-modern__meta {
                gap: 12px;
            }

            .meta-item {
                font-size: 11px;
            }

            .tour-card-modern__title {
                font-size: 16px;
            }

            .amount {
                font-size: 20px;
            }
        }

        @media (max-width: 768px) {
            .tour-card-modern__image-wrapper {
                padding-top: 65%;
            }

            .route-start,
            .route-end {
                max-width: 80px;
                font-size: 12px;
            }

            .route-arrow {
                font-size: 14px;
            }

            .tour-card-modern__footer {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .tour-card-modern__btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .tour-card-modern__location-info {
                padding: 15px 12px 12px;
            }

            .route-start,
            .route-end {
                max-width: 70px;
                font-size: 11px;
            }

            .tour-card-modern__meta {
                gap: 10px;
            }
        }
    </style>
@endpush
@if(count($tours) > 0)
    @foreach($tours as $tour)
        <div class="col-lg-4 col-md-6 px-3 py-3">
            <div class="tour-card-modern wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='{{$loop->index * 100}}ms'>
                <div class="tour-card-modern__image-wrapper">
                    {{-- Make the entire image wrapper a clickable link --}}
                    <a href="{{route('front.tour.detail', base64_encode($tour->id))}}" class="tour-card-modern__image-link">
                        <img src="{{asset('storage/package/'.$tour->cover_img)}}" alt="{{$tour->title}}" class="tour-card-modern__image">

                        {{-- Overlay Gradient --}}
                        <div class="tour-card-modern__overlay"></div>

                        {{-- Featured Badge --}}
                        @if($tour->is_featured ?? false)
                            <span class="tour-card-modern__featured">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        @endif

                        {{-- Tour Type Badge --}}
                        <span class="tour-card-modern__type">
                            <i class="fas fa-{{$tour->tour_type == 'adventure' ? 'mountain' : ($tour->tour_type == 'beach' ? 'umbrella-beach' : 'compass')}}"></i>
                            {{ucfirst($tour->tour_type)}}
                        </span>

                        {{-- Location Info - Positioned at bottom of image --}}
                        <div class="tour-card-modern__location-info">
                            <div class="tour-card-modern__route">
                                <span class="route-start">{{$tour->start_location}}</span>
                                <span class="route-arrow"><i class="fas fa-long-arrow-alt-right"></i></span>
                                <span class="route-end">{{$tour->end_location}}</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="tour-card-modern__content">
                    {{-- Title --}}
                    <h3 class="tour-card-modern__title">
                        <a href="{{route('front.tour.detail', base64_encode($tour->id))}}">
                            {{ Str::limit($tour->title, 45) }}
                        </a>
                    </h3>

                    {{-- Meta Info Row --}}
                    <div class="tour-card-modern__meta">
                        <div class="meta-item">
                            <i class="far fa-clock"></i>
                            <span>{{$tour->day}}D / {{$tour->night}}N</span>
                        </div>
                        <div class="meta-item">
                            <i class="far fa-calendar-alt"></i>
                            <span>Daily Tour</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-users"></i>
                            <span>Max {{$tour->max_people}}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-bus"></i>
                            <span>Available Seats: {{\App\Models\Bus::find($tour->bus->id)->getAvailableSeatsCount($tour->id)}}</span>
                        </div>
                    </div>

                    {{-- Price and Action --}}
                    <div class="tour-card-modern__footer">
                        <div class="tour-card-modern__price">
                            <span class="price-label">Starting from</span>
                            <div class="price-amount">
                                <span class="currency">{{config('app.currency')}}</span>
                                <span class="amount">{{number_format($tour->amount)}}</span>
                            </div>
                            <span class="price-per">/ person</span>
                        </div>

                        <a href="{{route('front.tour.detail', base64_encode($tour->id))}}" class="tour-card-modern__btn">
                            <span>View</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12">
        <div class="no-results-modern">
            <div class="no-results-modern__icon">
                <i class="fas fa-map-signs"></i>
            </div>
            <h4>No Tours Found</h4>
            <p>We couldn't find any tours matching your criteria. Try adjusting your filters or explore our other amazing destinations.</p>
            <a href="{{route('front.tour-list')}}" class="no-results-modern__btn">
                <i class="fas fa-redo-alt"></i> Reset Filters
            </a>
        </div>
    </div>
@endif


