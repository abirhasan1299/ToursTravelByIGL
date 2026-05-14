@extends('layout.theme')
@section('title', 'Home')

@section('meta_description', $seo->description??"IGL Web Ltd")
@section('meta_keywords', $seo->keywords??"")
@section('meta_robots', $seo->robots??"")
@section('favicon', asset($seo->icon)??asset('assets/images/favicons/favicon-16x16.png'))

@section('og_type', $seo->og_type??"")
@section('og_title', $seo->og_title??"")
@section('og_description', $seo->og_description??"")
@section('og_width', $seo->og_width??"")
@section('og_height', $seo->og_height??"")
@section('meta_image', asset($seo->og_image)??asset('assets/images/igl.png'))

@section('twitter_title', $seo->twitter_title??"")
@section('twitter_meta_description', $seo->twitter_description??"")
@section('twitter_meta_image', asset($seo->twitter_image)??asset('assets/images/igl.png'))

@push('css')
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ================================================
           HERO CAROUSEL — CINEMATIC FULL-SCREEN SLIDER
           ================================================ */
        .hero-carousel {
            position: relative;
            width: 100%;
            height: 90vh;
            min-height: 620px;
            overflow: hidden;
            margin-top: -70px;
            z-index: 1;
        }

        /* Slides wrapper */
        .hc-track {
            position: absolute;
            inset: 0;
        }

        .hc-slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1s ease;
            pointer-events: none;
        }

        .hc-slide.is-active {
            opacity: 1;
            pointer-events: auto;
        }

        /* Ken-Burns zoom on active image */
        .hc-slide__bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            transform: scale(1.08);
            transition: transform 6s ease-out;
        }

        .hc-slide.is-active .hc-slide__bg {
            transform: scale(1);
        }

        /* Multi-layer gradient overlay */
        .hc-slide__overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(to right, rgba(0,0,0,.65) 0%, rgba(0,0,0,.2) 60%, rgba(0,0,0,.1) 100%),
                linear-gradient(to top,   rgba(0,0,0,.7) 0%, transparent 50%);
        }

        /* Slide content */
        .hc-slide__content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 8% 60px;
            padding-top: 100px;
            z-index: 2;
        }

        .hc-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: #fff;
            background: rgba(99,171,69,.85);
            backdrop-filter: blur(6px);
            padding: 6px 16px 6px 10px;
            border-radius: 30px;
            width: fit-content;
            margin-bottom: 22px;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity .6s ease .3s, transform .6s ease .3s;
        }

        .hc-tag::before {
            content: '';
            width: 6px; height: 6px;
            background: #fff;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .hc-slide.is-active .hc-tag {
            opacity: 1;
            transform: translateY(0);
        }

        .hc-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(40px, 6vw, 82px);
            font-weight: 800;
            line-height: 1.07;
            color: #fff;
            max-width: 720px;
            margin-bottom: 20px;
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .7s ease .5s, transform .7s ease .5s;
        }

        .hc-title em {
            font-style: italic;
            color: #8fce72;
        }

        .hc-slide.is-active .hc-title {
            opacity: 1;
            transform: translateY(0);
        }

        .hc-desc {
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 1.75;
            color: rgba(255,255,255,.8);
            max-width: 480px;
            margin-bottom: 36px;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity .6s ease .7s, transform .6s ease .7s;
        }

        .hc-slide.is-active .hc-desc {
            opacity: 1;
            transform: translateY(0);
        }

        /* ---- Nav Arrows ---- */
        .hc-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,.45);
            background: rgba(255,255,255,.12);
            backdrop-filter: blur(8px);
            cursor: pointer;
            transition: all .35s ease;
            outline: none;
        }

        .hc-arrow:hover {
            background: #63AB45;
            border-color: #63AB45;
            transform: translateY(-50%) scale(1.08);
            box-shadow: 0 0 0 6px rgba(99,171,69,.25);
        }

        .hc-arrow--prev { left: 36px; }
        .hc-arrow--next { right: 36px; }

        .hc-arrow svg {
            width: 20px; height: 20px;
            stroke: #fff;
            stroke-width: 2.2;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: transform .3s ease;
        }

        .hc-arrow--prev:hover svg { transform: translateX(-2px); }
        .hc-arrow--next:hover svg { transform: translateX(2px); }

        /* ---- Progress bar indicators ---- */
        .hc-dots {
            position: absolute;
            bottom: 36px;
            left: 8%;
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .hc-dot {
            position: relative;
            width: 40px;
            height: 3px;
            background: rgba(255,255,255,.3);
            border-radius: 3px;
            cursor: pointer;
            overflow: hidden;
        }

        .hc-dot__fill {
            position: absolute;
            left: 0; top: 0;
            height: 100%;
            width: 0%;
            background: #63AB45;
            border-radius: 3px;
            transition: width .3s ease;
        }

        .hc-dot.is-active .hc-dot__fill {
            animation: hcFill var(--hc-duration, 5s) linear forwards;
        }

        @keyframes hcFill {
            from { width: 0% }
            to   { width: 100% }
        }

        .hc-dot.is-done .hc-dot__fill { width: 100%; }

        /* ---- Slide counter ---- */
        .hc-counter {
            position: absolute;
            bottom: 36px;
            right: 36px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: rgba(255,255,255,.6);
            z-index: 10;
            letter-spacing: .08em;
        }

        .hc-counter span { color: #fff; font-size: 22px; font-weight: 700; }

        /* ---- Responsive ---- */
        @media (max-width: 768px) {
            .hero-carousel { height: 88vh; min-height: 560px; }
            .hc-slide__content { padding: 0 6% 80px; padding-top: 130px; }
            .hc-arrow { width: 44px; height: 44px; }
            .hc-arrow--prev { left: 16px; }
            .hc-arrow--next { right: 16px; }
            .hc-dots { left: 6%; bottom: 28px; }
            .hc-counter { right: 20px; bottom: 26px; }
            .hc-desc { font-size: 14px; }
        }

        @media (max-width: 480px) {
            .hc-arrow { display: none; }
            .hc-title { font-size: clamp(32px, 9vw, 52px); }
        }

        /* ================================================
           STATS SECTION
           ================================================ */
        .hero-stats {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 60px;
            padding: 0.9rem 2rem;
            margin-top: -60px;
            margin-bottom: 0;
            max-width: 950px;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            box-shadow: 0 10px 28px -8px rgba(0, 0, 0, 0.15);
            transition: all 0.2s ease;
            position: relative;
            z-index: 10;
        }

        .hero-stat { flex: 1; text-align: center; padding: 0.25rem 0.5rem; min-width: 100px; }
        .hero-stat__num { font-size: 1.8rem; font-weight: 800; line-height: 1.2; color: #1e2a1c; margin-bottom: 0.2rem; letter-spacing: -0.01em; }
        .hero-stat__num sup { font-size: 1rem; font-weight: 700; color: #2b6e2f; top: -0.2em; }
        .hero-stat__lbl { font-size: 0.7rem; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: #2c3e2b; opacity: 0.85; }
        .hero-stat-sep { width: 1px; height: 40px; background: rgba(0,0,0,0.15); flex-shrink: 0; margin: 0 0.25rem; }

        @media (max-width: 900px) {
            .hero-stats { padding: 0.85rem 1.2rem; border-radius: 48px; gap: 0.5rem; max-width: 90%; margin-top: -50px; }
            .hero-stat__num { font-size: 1.6rem; }
            .hero-stat__lbl { font-size: 0.65rem; }
            .hero-stat-sep { height: 34px; }
        }

        @media (max-width: 640px) {
            .hero-stats { flex-wrap: wrap; justify-content: center; background: rgba(255,255,255,0.96); border-radius: 36px; padding: 1rem 1.2rem; gap: 0.8rem 1rem; margin-top: -40px; }
            .hero-stat-sep { display: none; }
            .hero-stat { flex: 0 0 auto; min-width: 110px; padding: 0.3rem 0.2rem; }
        }

        @media (max-width: 560px) {
            .hero-stats { flex-direction: row; flex-wrap: wrap; justify-content: space-evenly; background: rgba(255,255,255,0.98); border-radius: 30px; padding: 0.9rem 0.8rem; margin-top: -30px; }
            .hero-stat { min-width: 85px; flex: 1; }
            .hero-stat__num { font-size: 1.5rem; }
            .hero-stat__num sup { font-size: 0.8rem; }
            .hero-stat__lbl { font-size: 0.6rem; white-space: nowrap; }
        }

        /* ================================================
           REST OF PAGE STYLES (UNCHANGED)
           ================================================ */
        .current-tours {
            background: linear-gradient(180deg, #ffffff 0%, #f8faf7 100%);
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05), 0 1px 8px rgba(0,0,0,0.03);
        }

        .current-tours::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 100%;
            background: url('data:image/svg+xml,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="10" r="2" fill="%2363AB45" opacity="0.05"/><circle cx="90" cy="90" r="2" fill="%2363AB45" opacity="0.05"/></svg>');
            opacity: 0.5;
            pointer-events: none;
        }

        .tour-card { background: #ffffff; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.06); transition: all 0.4s cubic-bezier(0.165,0.84,0.44,1); height: 100%; display: flex; flex-direction: column; border: 1px solid rgba(99,171,69,0.08); }
        .tour-card:hover { transform: translateY(-8px); box-shadow: 0 20px 60px rgba(99,171,69,0.12); border-color: rgba(99,171,69,0.2); }
        .tour-card__image { position: relative; overflow: hidden; padding-top: 70%; }
        .tour-card__img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s cubic-bezier(0.165,0.84,0.44,1); }
        .tour-card:hover .tour-card__img { transform: scale(1.08); }
        .tour-card__badge { position: absolute; top: 20px; left: 20px; background: linear-gradient(135deg,#63AB45 0%,#4f9234 100%); color: #ffffff; padding: 6px 16px; border-radius: 30px; font-size: 12px; font-weight: 600; letter-spacing: 0.5px; text-transform: uppercase; box-shadow: 0 4px 15px rgba(99,171,69,0.3); z-index: 2; }
        .tour-card__badge i { margin-right: 5px; font-size: 11px; }
        .tour-card__price { position: absolute; bottom: 20px; right: 20px; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); padding: 10px 18px; border-radius: 40px; text-align: center; box-shadow: 0 8px 25px rgba(0,0,0,0.12); z-index: 2; border: 1px solid rgba(99,171,69,0.15); }
        .tour-card__price-label { display: block; font-size: 10px; text-transform: uppercase; letter-spacing: 1px; color: #888; margin-bottom: 2px; }
        .tour-card__price-amount { font-size: 24px; font-weight: 700; color: #63AB45; line-height: 1; }
        .tour-card__price-per { font-size: 11px; color: #999; }
        .tour-card__content { padding: 24px 22px 22px; flex: 1; display: flex; flex-direction: column; }
        .tour-card__location { display: flex; align-items: center; gap: 8px; margin-bottom: 12px; }
        .tour-card__location i { color: #63AB45; font-size: 14px; }
        .tour-card__location span { font-size: 13px; color: #666; font-weight: 500; }
        .tour-card__title { font-size: 20px; font-weight: 700; line-height: 1.35; margin-bottom: 15px; }
        .tour-card__title a { color: #1a1a1a; text-decoration: none; transition: color 0.3s ease; }
        .tour-card__title a:hover { color: #63AB45; }
        .tour-card__meta { display: flex; gap: 20px; margin-bottom: 18px; padding-bottom: 18px; border-bottom: 1px solid rgba(99,171,69,0.1); }
        .tour-card__meta-item { display: flex; align-items: center; gap: 6px; }
        .tour-card__meta-item i { color: #63AB45; font-size: 14px; opacity: 0.8; }
        .tour-card__meta-item span { font-size: 13px; color: #666; font-weight: 500; }
        .tour-card__footer { display: flex; align-items: center; justify-content: space-between; margin-top: auto; }
        .tour-card__rating { display: flex; flex-direction: column; gap: 4px; }
        .tour-card__rating .stars { display: flex; gap: 2px; }
        .tour-card__rating .stars i { color: #FFB800; font-size: 12px; }
        .tour-card__rating .stars i.inactive { color: #DDD; }
        .tour-card__rating .rating-text { font-size: 11px; color: #999; }
        .tour-card__btn { display: inline-flex; align-items: center; gap: 8px; padding: 8px 18px; background: rgba(99,171,69,0.08); color: #63AB45; border-radius: 30px; font-size: 13px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; border: 1px solid transparent; }
        .tour-card__btn i { font-size: 11px; transition: transform 0.3s ease; }
        .tour-card__btn:hover { background: #63AB45; color: #ffffff; border-color: #63AB45; transform: translateX(2px); }
        .tour-card__btn:hover i { transform: translateX(3px); }

        .gotur-btn { display: inline-flex; align-items: center; gap: 10px; padding: 14px 36px; border-radius: 50px; font-size: 15px; font-weight: 600; text-decoration: none; transition: all 0.4s cubic-bezier(0.165,0.84,0.44,1); position: relative; overflow: hidden; }
        .gotur-btn--primary { background: linear-gradient(135deg,#63AB45 0%,#4f9234 100%); color: #ffffff; box-shadow: 0 10px 30px rgba(99,171,69,0.25); border: none; }
        .gotur-btn--primary::before { content: ''; position: absolute; top: 50%; left: 50%; width: 0; height: 0; border-radius: 50%; background: rgba(255,255,255,0.2); transform: translate(-50%,-50%); transition: width .6s, height .6s; }
        .gotur-btn--primary:hover { transform: translateY(-3px); box-shadow: 0 15px 40px rgba(99,171,69,0.35); color: #ffffff; }
        .gotur-btn--primary:hover::before { width: 300px; height: 300px; }
        .gotur-btn--primary i { transition: transform 0.3s ease; }
        .gotur-btn--primary:hover i { transform: translateX(5px); }

        .sec-title__tagline { color: #63AB45; font-weight: 600; letter-spacing: 2px; margin-bottom: 10px; }
        .sec-title__title { font-size: clamp(28px,4vw,42px); font-weight: 700; margin-bottom: 0; }
        .sec-title__title span { color: #63AB45; position: relative; display: inline-block; }
        .sec-title__title span::after { content: ''; position: absolute; bottom: 5px; left: 0; width: 100%; height: 8px; background: rgba(99,171,69,0.15); z-index: -1; border-radius: 4px; }

        .about-two { background: #ffffff; box-shadow: 0 12px 30px -10px rgba(0,0,0,0.06), 0 2px 8px rgba(0,0,0,0.02); padding: 80px 0; }
        .cta-five { box-shadow: 0 20px 35px -12px rgba(0,0,0,0.1); position: relative; z-index: 2; }
        .why-choose-one { background: #ffffff; box-shadow: 0 12px 30px -10px rgba(0,0,0,0.05), 0 1px 4px rgba(0,0,0,0.02); }
        .section-space, .section-space-bottom, .about-two, .cta-five, .why-choose-one { position: relative; }
        .container { position: relative; z-index: 2; }

        @media (max-width: 768px) {
            .about-two, .current-tours, .why-choose-one { box-shadow: 0 8px 20px -6px rgba(0,0,0,0.05); }
            .current-tours { padding-top: 50px; padding-bottom: 50px; }
            .tour-card__content { padding: 20px 18px 18px; }
            .tour-card__title { font-size: 18px; }
            .tour-card__price { padding: 8px 14px; }
            .tour-card__price-amount { font-size: 20px; }
            .tour-card__footer { flex-direction: column; align-items: flex-start; gap: 15px; }
            .tour-card__btn { width: 100%; justify-content: center; }
        }

        @media (max-width: 480px) {
            .tour-card__meta { flex-direction: column; gap: 10px; }
        }
    </style>
@endpush

@section('content')

    <!-- =============================================
         HERO CAROUSEL — Custom Cinematic Slider
         ============================================= -->
    <div class="hero-carousel" id="heroCarousel" aria-label="Hero image carousel">

        <div class="hc-track">
            @foreach($photos as $key => $photo)
                <div class="hc-slide {{ $key == 0 ? 'is-active' : '' }}" data-index="{{ $key }}">
                    <div class="hc-slide__bg"
                         style="background-image: url('{{ asset('storage/banner/' . $photo->name) }}')">
                    </div>
                    <div class="hc-slide__overlay"></div>
                    <div class="hc-slide__content">
                        <span class="hc-tag">Discover Your World</span>
                        <h1 class="hc-title">Next Step<br><em>Destination</em></h1>
                        <p class="hc-desc">
                            Embark on unforgettable journeys to the world's most
                            breathtaking destinations. Luxury, adventure & culture.
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Prev / Next arrows -->
        <button class="hc-arrow hc-arrow--prev" id="hcPrev" aria-label="Previous slide">
            <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        </button>
        <button class="hc-arrow hc-arrow--next" id="hcNext" aria-label="Next slide">
            <svg viewBox="0 0 24 24"><polyline points="9 6 15 12 9 18"/></svg>
        </button>

        <!-- Progress-bar dot indicators -->
        <div class="hc-dots" id="hcDots">
            @foreach($photos as $key => $photo)
                <div class="hc-dot {{ $key == 0 ? 'is-active' : '' }}" data-index="{{ $key }}">
                    <div class="hc-dot__fill"></div>
                </div>
            @endforeach
        </div>

        <!-- Slide counter -->
        <div class="hc-counter">
            <span id="hcCurrent">01</span> / {{ str_pad(count($photos), 2, '0', STR_PAD_LEFT) }}
        </div>
    </div>

    <!-- Stats Section -->
    <div class="hero-stats">
        <div class="hero-stat">
            <div class="hero-stat__num"><span class="counter" data-target="1200">0</span><sup>+</sup></div>
            <div class="hero-stat__lbl">Tours</div>
        </div>
        <div class="hero-stat-sep"></div>
        <div class="hero-stat">
            <div class="hero-stat__num"><span class="counter" data-target="340">0</span><sup>+</sup></div>
            <div class="hero-stat__lbl">City</div>
        </div>
        <div class="hero-stat-sep"></div>
        <div class="hero-stat">
            <div class="hero-stat__num"><span class="counter" data-target="50">0</span><sup>K+</sup></div>
            <div class="hero-stat__lbl">Passengers</div>
        </div>
        <div class="hero-stat-sep"></div>
        <div class="hero-stat">
            <div class="hero-stat__num"><span class="counter" data-target="98">0</span><sup>K+</sup></div>
            <div class="hero-stat__lbl">Guest</div>
        </div>
    </div>

    <!-- Top Tours Section -->
    <section class="current-tours section-space" style="margin-top: -50px;">
        <div class="container">
            <div class="sec-title text-center wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                <h6 class="sec-title__tagline bw-split-in-right">Featured Tours</h6>
                <h3 class="sec-title__title bw-split-in-left">
                    Explore Our <span>Current</span> Tours
                </h3>
                <p class="sec-title__desc" style="max-width: 600px; margin: 15px auto 0; color: #666;">
                    Discover handpicked adventures waiting for you. Book now and create unforgettable memories.
                </p>
            </div>

            <div class="row gutter-y-30">
                @forelse($tours ?? [] as $tour)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tour-card wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="{{ $loop->index * 100 + 300 }}ms">
                            <div class="tour-card__image">
                                <a href="{{ route('front.tour.detail', base64_encode($tour->id)) }}">
                                    <img src="{{ asset('storage/package/' . ($tour->cover_img ?? 'defaults/tour-default.jpg')) }}"
                                         alt="{{ $tour->title ?? 'Tour' }}"
                                         class="tour-card__img">
                                </a>
                                <span class="tour-card__badge">
                                    <i class="fas fa-tag"></i> {{ strtoupper($tour->tour_type) ?? 'Adventure' }}
                                </span>
                                <div class="tour-card__price">
                                    <span class="tour-card__price-amount">BDT {{ number_format($tour->amount ?? 0) }}</span>
                                    <span class="tour-card__price-per">/ person</span>
                                </div>
                            </div>
                            <div class="tour-card__content">
                                <div class="tour-card__location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $tour->start_location." to ".$tour->end_location }}</span>
                                </div>
                                <h4 class="tour-card__title">
                                    <a href="{{ route('front.tour.detail', base64_encode($tour->id)) }}">
                                        {{ $tour->title ?? 'Amazing Tour Package' }}
                                    </a>
                                </h4>
                                <div class="tour-card__meta">
                                    <div class="tour-card__meta-item">
                                        <i class="far fa-clock"></i>
                                        <span>{{ $tour->day." Days, ".$tour->night." Night"}}</span>
                                    </div>
                                    <div class="tour-card__meta-item">
                                        <i class="far fa-user"></i>
                                        <span>{{ $tour->max_people ?? '10' }} People</span>
                                    </div>
                                </div>
                                <div class="tour-card__footer">
                                    <div class="tour-card__rating">
                                        <div class="stars">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= ($tour->rating ?? 5) ? '' : ' inactive' }}"></i>
                                            @endfor
                                        </div>
                                        <span class="rating-text">({{ $tour->reviews_count ?? '24' }} reviews)</span>
                                    </div>
                                    <a href="{{ route('front.tour.detail', base64_encode($tour->id)) }}" class="tour-card__btn">
                                        View Details <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h4>No Tours Exist</h4>
                @endforelse
            </div>

            <div class="text-center mt-5 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="600ms">
                <a href="{{ route('front.tour-list') }}" class="gotur-btn gotur-btn--primary">
                    <span>View All Tours</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-two about-two--two section-space" id="about" style="margin-top: -80px;">
        <div class="container">
            <div class="row gutter-y-40">
                <div class="col-lg-6">
                    <div class="about-two__thumb wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='300ms'>
                        <div class="about-two__thumb__item">
                            <img style="width: 500px;" src="{{ asset('assets/images/about/about-2-1.jpg') }}" alt="gotur image">
                        </div>
                        <div class="about-two__thumb__item-small">
                            <img style="width: 200px;" src="{{ asset('assets/images/about/about-s-2-1.jpg') }}" alt="gotur image">
                        </div>
                        <div class="about-two__thumb__funfact">
                            <div class="about-two__thumb__funfact__icon">
                                <i class="icon-icon-4"></i>
                            </div>
                            <div class="about-two__thumb__funfact__content count-box">
                                <h2 class="about-two__thumb__funfact__count">
                                    <span class="count-text" data-stop="{{ $about->exp_years ?? 15 }}" data-speed="2000"></span>
                                    <span>Years</span>
                                </h2>
                                <p class="about-two__thumb__funfact__text">Of Experience</p>
                            </div>
                        </div>
                        <div class="about-two__thumb__item-element">
                            <img src="{{ asset('assets/images/shapes/corki.png') }}" alt="image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-two__right">
                        <div class="sec-title">
                            <h6 class="sec-title__tagline bw-split-in-right">About company</h6>
                            <h3 class="sec-title__title bw-split-in-left">Great Opportunity for Adventure & Travels</h3>
                        </div>
                        <p class="about-two__top__text wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                            {{ $about->company_title ?? 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the Lorem ipsum dolor sit amet consectetur adipiscing elit.' }}
                        </p>
                        <div class="about-two__feature">
                            <div class="row gutter-y-20 gutter-x-20">
                                <div class="col-xl-6 col-lg-12 col-md-6 wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                                    <div class="about-two__feature-vestion">
                                        <div class="about-two__feature_icon">
                                            <i class="icon-flag"></i>
                                        </div>
                                        <div class="about-two__feature-content">
                                            <h5 class="about-two__feature-title">Trusted travel guide</h5>
                                            <p class="about-two__feature-text">Aliquam erat volutpat Nullam imperdiet</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="about-two__feature-vestion wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='400ms'>
                                        <div class="about-two__feature_icon">
                                            <i class="icon-misstion"></i>
                                        </div>
                                        <div class="about-two__feature-content">
                                            <h5 class="about-two__feature-title">Mission & Vision</h5>
                                            <p class="about-two__feature-text">{{ $about->mv ?? 'Ut vehiculadictumst. Maecenas ante. Step' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="about-two__button wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                            <div class="about-two__button__author">
                                <div class="about-two__button__author__thumb">
                                    <img src="{{ asset('storage/author_img/' . ($about->author_img ?? '')) }}" alt="author">
                                </div>
                                <div class="about-two__button__author__content">
                                    <h5 class="about-two__button__author__name">{{ $about->author_name ?? 'TITAN KONOK' }}</h5>
                                    <span class="about-two__button__author__dec">{{ $about->author_designation ?? 'Designation' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-five section-space" style="margin-top:-200px;">
        <div class="cta-five__inner">
            <div class="cta-five__bg wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms" style="background-image: url(assets/images/backgrounds/cta-1-1.jpg);"></div>
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6">
                        <div class="cta-five__funfact wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="400ms">
                            <ul class="cta-five__funfact__list list-unstyled">
                                <li class="cta-five__funfact__item">
                                    <div class="cta-five__funfact__icon"><i class="icon-travel-and-tourism"></i></div>
                                    <div class="cta-five__funfact__content count-box">
                                        <h3 class="cta-five__funfact__count"><span class="count-text" data-stop="{{ $about->tour_success ?? 30 }}" data-speed="1500"></span><span>k+</span></h3>
                                        <p class="cta-five__funfact__text">Tours success</p>
                                    </div>
                                </li>
                                <li class="cta-five__funfact__item">
                                    <div class="cta-five__funfact__icon"><i class="icon-tourist"></i></div>
                                    <div class="cta-five__funfact__content count-box">
                                        <h3 class="cta-five__funfact__count"><span class="count-text" data-stop="{{ $about->happy_traveler ?? 30 }}" data-speed="1500"></span><span>+</span></h3>
                                        <p class="cta-five__funfact__text">Happy Traveler</p>
                                    </div>
                                </li>
                                <li class="cta-five__funfact__item">
                                    <div class="cta-five__funfact__icon"><i class="icon-trophy"></i></div>
                                    <div class="cta-five__funfact__content count-box">
                                        <h3 class="cta-five__funfact__count"><span class="count-text" data-stop="{{ $about->award ?? 30 }}" data-speed="1500"></span><span>+</span></h3>
                                        <p class="cta-five__funfact__text">Awards Winning</p>
                                    </div>
                                </li>
                                <li class="cta-five__funfact__item">
                                    <div class="cta-five__funfact__icon"><i class="icon-quality"></i></div>
                                    <div class="cta-five__funfact__content count-box">
                                        <h3 class="cta-five__funfact__count"><span class="count-text" data-stop="{{ $about->exp_years ?? 30 }}" data-speed="1500"></span><span>+</span></h3>
                                        <p class="cta-five__funfact__text">Our Experience</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="cta-five__shape wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="400ms">
                            <img src="{{ asset('assets/images/shapes/cta-1-1.png') }}" alt>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-one section-space-bottom" style="margin-top:50px;margin-bottom:-100px;">
        <div class="container">
            <div class="row align-items-center gutter-y-40">
                <div class="col-lg-6">
                    <div class="why-choose-one__thumb wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='400ms'>
                        <div class="row align-items-center gutter-y-30">
                            <div class="col-lg-6">
                                <div class="why-choose-one__thumb__item-one">
                                    <img src="{{ asset('assets/images/about/about-s-8-2.jpg') }}" alt="image">
                                </div>
                                <div class="why-choose-one__thumb__item-one">
                                    <img src="{{ asset('assets/images/about/about-s-8-1.jpg') }}" alt="image">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="why-choose-one__thumb__item-two">
                                    <img src="{{ asset('assets/images/about/about-8-1.jpg') }}" alt="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="why-choose-one__content">
                        <div class="sec-title">
                            <h6 class="sec-title__tagline bw-split-in-right">Why Choose Us</h6>
                            <h3 class="sec-title__title bw-split-in-left">Get The <span>Best Travel</span> Experience With Gotur</h3>
                        </div>
                        <p class="why-choose-one__content__text wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='400ms'>It is a long established fact that a reader will be distracted the readable content of a page when looking at layout the point.</p>
                        <ul class="why-choose-one__list">
                            <li><div class="why-choose-one__list__item wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='200ms'><div class="why-choose-one__icon"><i class="icon-flag"></i></div><h5 class="why-choose-one__title">Trusted travel guide</h5></div></li>
                            <li><div class="why-choose-one__list__item wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='400ms'><div class="why-choose-one__icon"><i class="icon-calender"></i></div><h5 class="why-choose-one__title">Instant Booking</h5></div></li>
                            <li><div class="why-choose-one__list__item wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='600ms'><div class="why-choose-one__icon"><i class="icon-travle1"></i></div><h5 class="why-choose-one__title">World Class Travel</h5></div></li>
                            <li><div class="why-choose-one__list__item wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='800ms'><div class="why-choose-one__icon"><i class="icon-perasut"></i></div><h5 class="why-choose-one__title">Paragliding Tour</h5></div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script>
        (function () {
            const INTERVAL = 5000;
            const slides   = Array.from(document.querySelectorAll('.hc-slide'));
            const dots     = Array.from(document.querySelectorAll('.hc-dot'));
            const counter  = document.getElementById('hcCurrent');
            const total    = slides.length;
            let   current  = 0;
            let   timer    = null;

            function pad(n) { return String(n + 1).padStart(2, '0'); }

            function goTo(index) {
                // Remove active from current
                slides[current].classList.remove('is-active');
                dots[current].classList.remove('is-active');
                dots[current].classList.add('is-done');

                current = (index + total) % total;

                // Reset dots after full loop
                if (current === 0) {
                    dots.forEach(d => { d.classList.remove('is-done'); });
                }

                slides[current].classList.add('is-active');
                dots[current].classList.remove('is-done');
                dots[current].classList.add('is-active');

                if (counter) counter.textContent = pad(current);
            }

            function next() { goTo(current + 1); }
            function prev() { goTo(current - 1); }

            function startAuto() {
                clearInterval(timer);
                timer = setInterval(next, INTERVAL);
            }

            // Arrow buttons
            document.getElementById('hcNext')?.addEventListener('click', function () {
                next(); startAuto();
            });
            document.getElementById('hcPrev')?.addEventListener('click', function () {
                prev(); startAuto();
            });

            // Dot clicks
            dots.forEach(function (dot, i) {
                dot.addEventListener('click', function () {
                    goTo(i); startAuto();
                });
            });

            // Pause on hover
            var carousel = document.getElementById('heroCarousel');
            carousel?.addEventListener('mouseenter', function () { clearInterval(timer); });
            carousel?.addEventListener('mouseleave', startAuto);

            // Touch / swipe support
            var touchStartX = 0;
            carousel?.addEventListener('touchstart', function (e) {
                touchStartX = e.changedTouches[0].clientX;
            }, { passive: true });
            carousel?.addEventListener('touchend', function (e) {
                var dx = e.changedTouches[0].clientX - touchStartX;
                if (Math.abs(dx) > 40) { dx < 0 ? next() : prev(); startAuto(); }
            }, { passive: true });

            // Boot
            startAuto();

            // ── Counter animation for hero stats ──────────────────────────
            const counters = document.querySelectorAll('.counter');
            if (counters.length) {
                const obs = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            var el     = entry.target;
                            var target = +el.dataset.target;
                            var count  = 0;
                            var step   = Math.ceil(target / 60);
                            var tick   = setInterval(function () {
                                count = Math.min(count + step, target);
                                el.textContent = count;
                                if (count >= target) clearInterval(tick);
                            }, 20);
                            obs.unobserve(el);
                        }
                    });
                }, { threshold: 0.5 });
                counters.forEach(function (c) { obs.observe(c); });
            }

            // ── Flash messages ─────────────────────────────────────────────
            @if (session('success'))
            if (typeof Swal !== 'undefined') {
                Swal.fire({ icon: 'success', title: 'Success', text: '{{ session('success') }}' });
            } else { alert('{{ session('success') }}'); }
            @endif
                @if (session('error'))
            if (typeof Swal !== 'undefined') {
                Swal.fire({ icon: 'error', title: 'Error', text: '{{ session('error') }}' });
            } else { alert('{{ session('error') }}'); }
            @endif
        })();
    </script>
@endpush
