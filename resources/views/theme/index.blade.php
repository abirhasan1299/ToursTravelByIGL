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
    <style>
        /* ── Hero Section ── Full width background video ─────────────────── */
        .hero-section {
            position: relative;
            width: 100%;
            min-height: 85vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding-top: 100px;
            margin-bottom: -100px;
            overflow-x: hidden;
            margin-top: -70px;
            z-index: 1;
        }

        /* VIDEO BACKGROUND - Full cover within hero section (edge to edge, no gaps) */
        .hero-video-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            overflow: hidden;

        }

        .hero-video {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translateX(-50%) translateY(-50%);
            object-fit: cover;

        }

        /* Fallback image if video fails - also full cover */
        .hero-video-fallback {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('assets/images/hero-fallback.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -1;
        }

        /* Overlay - full cover */
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,.58) 0%, rgba(0,0,0,.38) 55%, rgba(0,0,0,.7) 100%);
            z-index: -1;

        }

        /* Content container - keeps content within bounds */
        .hero-content-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;

        }

        /* ── Headline ── */
        .hero-content {
            text-align: start;
            max-width: 680px;
            margin: 0 auto 20px auto;
        }

        .hero-content__sub {
            display: inline-block;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--gotur-base, #63AB45);
            margin-bottom: 8px;
        }

        .hero-content__title {
            font-size: clamp(30px, 5vw, 54px);
            font-weight: 700;
            line-height: 1.1;
            color: var(--gotur-white, #fff);
            margin-bottom: 12px;
        }

        .hero-content__title span { color: var(--gotur-base, #63AB45); }

        .hero-content__desc {
            font-size: 15px;
            line-height: 1.6;
            color: rgba(255,255,255,.7);
            margin: 0 auto;
        }

        /* ── Search Card ── */
        .search-card {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
        }

        .search-card__inner {
            background: var(--gotur-white, #fff);
            border-radius: 16px;
            box-shadow: 0 20px 56px rgba(0,0,0,.22);
            padding: 20px 28px 18px;
        }

        /* ── Tabs ── */
        .s-tabs {
            display: flex;
            gap: 2px;
            border-bottom: 2px solid var(--gotur-border-color, #E5E5E5);
            margin-bottom: 18px;
        }

        .s-tab-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 20px 9px;
            border: none;
            background: none;
            font-size: 13px;
            font-weight: 600;
            color: var(--gotur-text-muted, #888);
            cursor: pointer;
            border-bottom: 2px solid transparent;
            margin-bottom: -2px;
            border-radius: 8px 8px 0 0;
            transition: color .2s, border-color .2s, background .2s;
        }
        .s-tab-btn i { font-size: 13px; }
        .s-tab-btn:hover { color: var(--gotur-base, #63AB45); }
        .s-tab-btn.active {
            color: var(--gotur-base, #63AB45);
            border-bottom-color: var(--gotur-base, #63AB45);
            background: rgba(99,171,69,.05);
        }

        /* ── Form grid ── */
        .s-form { display: none; }
        .s-form.active { display: block; }

        .s-form__row {
            display: grid;
            gap: 12px;
            align-items: end;
        }
        #tourSearchForm  .s-form__row { grid-template-columns: 2fr 1.4fr 1.4fr 1fr auto; }
        #hotelSearchForm .s-form__row { grid-template-columns: 2fr 1.2fr 1.2fr 1fr auto; }

        /* Field */
        .s-field { display: flex; flex-direction: column; gap: 4px; }

        .s-field__label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--gotur-base, #63AB45);
            padding-left: 2px;
        }

        .s-field__wrap { position: relative; }

        .s-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gotur-base, #63AB45);
            font-size: 14px;
            pointer-events: none;
            z-index: 5;
        }

        /* Unified Input/Select Styles */
        .s-field__wrap select,
        .s-field__wrap input {
            width: 100%;
            height: 44px;
            padding: 0 14px 0 38px;
            border: 1.5px solid var(--gotur-border-color, #E5E5E5);
            border-radius: 10px;
            background: var(--gotur-gray, #f8faf7);
            font-size: 13px;
            font-family: inherit;
            color: var(--gotur-text, #333);
            transition: border-color .2s, box-shadow .2s, background .2s;
            -webkit-appearance: none;
            appearance: none;
        }

        /* Fix for select2 to match design */
        .s-field__wrap .select2-container {
            width: 100% !important;
        }
        .s-field__wrap .select2-container--default .select2-selection--single {
            height: 44px;
            border: 1.5px solid var(--gotur-border-color, #E5E5E5);
            border-radius: 10px;
            background: var(--gotur-gray, #f8faf7);
            padding-left: 38px;
        }
        .s-field__wrap .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 41px;
            color: var(--gotur-text, #333);
            font-size: 13px;
            padding-left: 0;
        }
        .s-field__wrap .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 41px;
            right: 10px;
        }
        .s-field__wrap .select2-container--default.select2-container--open .select2-selection--single {
            border-color: var(--gotur-base, #63AB45);
            box-shadow: 0 0 0 3px rgba(99,171,69,.1);
        }
        .s-field__wrap .select2-container--default .select2-selection--single:hover {
            border-color: var(--gotur-base, #63AB45);
        }

        /* Custom select arrow */
        .s-field__wrap select {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="%2363AB45" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>');
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 14px;
        }

        .s-field__wrap select:focus,
        .s-field__wrap input:focus {
            outline: none;
            border-color: var(--gotur-base, #63AB45);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(99,171,69,.1);
        }

        /* Submit button */
        .s-btn-submit {
            height: 44px;
            padding: 0 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--gotur-base, #63AB45);
            color: var(--gotur-white, #fff);
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
            transition: background .2s, transform .18s, box-shadow .2s;
            box-shadow: 0 4px 16px rgba(99,171,69,.32);
        }
        .s-btn-submit:hover {
            background: var(--gotur-base2, #4f9234);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(99,171,69,.38);
        }
        .s-btn-submit:active { transform: translateY(0); }

        /* Stats */
        .hero-stats {
            display: flex;
            align-items: center;
            margin-top: 24px;
            margin-bottom: -200px;
            background: rgba(255,255,255,.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,.18);
            border-radius: 14px;
            padding: 14px 32px;
            gap: 0;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;

        }
        .hero-stat {
            flex: 1;
            text-align: center;
            padding: 0 16px;

        }
        .hero-stat__num {
            font-size: 22px;
            font-weight: 700;
            color: var(--gotur-white, #fff);
            line-height: 1;
            margin-bottom: 3px;
        }
        .hero-stat__num sup {
            font-size: 11px;
            color: var(--gotur-base, #63AB45);
            vertical-align: super;
        }
        .hero-stat__lbl {
            font-size: 10px;
            letter-spacing: .07em;
            text-transform: uppercase;
            color: rgba(255,255,255,.5);
        }
        .hero-stat-sep {
            width: 1px;
            height: 32px;
            background: rgba(255,255,255,.18);
            flex-shrink: 0;
        }

        /* Ensure no margins/paddings cause gaps */
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Responsive */
        @media (max-width: 900px) {
            #tourSearchForm  .s-form__row,
            #hotelSearchForm .s-form__row { grid-template-columns: 1fr 1fr; }
            .s-btn-submit { width: 100%; }
            .search-card__inner { padding: 16px 16px 14px; }
            .hero-stats { padding: 12px 16px; max-width: 90%; }
            .hero-stat { padding: 0 10px; }
            .hero-section { min-height: 80vh; padding-top: 80px; }
        }
        @media (max-width: 560px) {
            #tourSearchForm  .s-form__row,
            #hotelSearchForm .s-form__row { grid-template-columns: 1fr; }
            .hero-section { min-height: 75vh; padding-top: 70px; padding-bottom: 30px; }
            .hero-stats { flex-wrap: wrap; gap: 12px; justify-content: center; }
            .hero-stat-sep { display: none; }
            .hero-stat { padding: 0 12px; }
        }
    </style>

    <style>
        /* Current Tours Section Styles */
        .current-tours {
            background: linear-gradient(180deg, #ffffff 0%, #f8faf7 100%);
            position: relative;
            overflow: hidden;
        }

        .current-tours::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100%;
            background: url('data:image/svg+xml,<svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="10" r="2" fill="%2363AB45" opacity="0.05"/><circle cx="90" cy="90" r="2" fill="%2363AB45" opacity="0.05"/></svg>');
            opacity: 0.5;
            pointer-events: none;
        }

        /* Tour Card */
        .tour-card {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(99, 171, 69, 0.08);
        }

        .tour-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(99, 171, 69, 0.12);
            border-color: rgba(99, 171, 69, 0.2);
        }

        /* Tour Card Image */
        .tour-card__image {
            position: relative;
            overflow: hidden;
            padding-top: 70%;
        }

        .tour-card__img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .tour-card:hover .tour-card__img {
            transform: scale(1.08);
        }

        /* Tour Type Badge */
        .tour-card__badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg, #63AB45 0%, #4f9234 100%);
            color: #ffffff;
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(99, 171, 69, 0.3);
            z-index: 2;
            backdrop-filter: blur(4px);
        }

        .tour-card__badge i {
            margin-right: 5px;
            font-size: 11px;
        }

        /* Price Tag */
        .tour-card__price {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 10px 18px;
            border-radius: 40px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            z-index: 2;
            border: 1px solid rgba(99, 171, 69, 0.15);
        }

        .tour-card__price-label {
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            margin-bottom: 2px;
        }

        .tour-card__price-amount {
            font-size: 24px;
            font-weight: 700;
            color: #63AB45;
            line-height: 1;
        }

        .tour-card__price-per {
            font-size: 11px;
            color: #999;
        }

        /* Tour Card Content */
        .tour-card__content {
            padding: 24px 22px 22px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Location */
        .tour-card__location {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .tour-card__location i {
            color: #63AB45;
            font-size: 14px;
        }

        .tour-card__location span {
            font-size: 13px;
            color: #666;
            font-weight: 500;
        }

        /* Title */
        .tour-card__title {
            font-size: 20px;
            font-weight: 700;
            line-height: 1.35;
            margin-bottom: 15px;
        }

        .tour-card__title a {
            color: #1a1a1a;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .tour-card__title a:hover {
            color: #63AB45;
        }

        /* Meta Info */
        .tour-card__meta {
            display: flex;
            gap: 20px;
            margin-bottom: 18px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(99, 171, 69, 0.1);
        }

        .tour-card__meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .tour-card__meta-item i {
            color: #63AB45;
            font-size: 14px;
            opacity: 0.8;
        }

        .tour-card__meta-item span {
            font-size: 13px;
            color: #666;
            font-weight: 500;
        }

        /* Footer */
        .tour-card__footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
        }

        /* Rating */
        .tour-card__rating {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .tour-card__rating .stars {
            display: flex;
            gap: 2px;
        }

        .tour-card__rating .stars i {
            color: #FFB800;
            font-size: 12px;
        }

        .tour-card__rating .stars i.inactive {
            color: #DDD;
        }

        .tour-card__rating .rating-text {
            font-size: 11px;
            color: #999;
        }

        /* View Details Button */
        .tour-card__btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            background: rgba(99, 171, 69, 0.08);
            color: #63AB45;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .tour-card__btn i {
            font-size: 11px;
            transition: transform 0.3s ease;
        }

        .tour-card__btn:hover {
            background: #63AB45;
            color: #ffffff;
            border-color: #63AB45;
            transform: translateX(2px);
        }

        .tour-card__btn:hover i {
            transform: translateX(3px);
        }

        /* View All Button */
        .gotur-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 36px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            overflow: hidden;
        }

        .gotur-btn--primary {
            background: linear-gradient(135deg, #63AB45 0%, #4f9234 100%);
            color: #ffffff;
            box-shadow: 0 10px 30px rgba(99, 171, 69, 0.25);
            border: none;
        }

        .gotur-btn--primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .gotur-btn--primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(99, 171, 69, 0.35);
            color: #ffffff;
        }

        .gotur-btn--primary:hover::before {
            width: 300px;
            height: 300px;
        }

        .gotur-btn--primary i {
            transition: transform 0.3s ease;
        }

        .gotur-btn--primary:hover i {
            transform: translateX(5px);
        }

        /* Sec Title Enhancement */
        .sec-title__tagline {
            color: #63AB45;
            font-weight: 600;
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .sec-title__title {
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 700;
            margin-bottom: 0;
        }

        .sec-title__title span {
            color: #63AB45;
            position: relative;
            display: inline-block;
        }

        .sec-title__title span::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 8px;
            background: rgba(99, 171, 69, 0.15);
            z-index: -1;
            border-radius: 4px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .current-tours {
                padding-top: 50px;
                padding-bottom: 50px;
            }

            .tour-card__content {
                padding: 20px 18px 18px;
            }

            .tour-card__title {
                font-size: 18px;
            }

            .tour-card__price {
                padding: 8px 14px;
            }

            .tour-card__price-amount {
                font-size: 20px;
            }

            .tour-card__footer {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .tour-card__btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .tour-card__meta {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="hero-section" id="home">
        <!-- VIDEO BACKGROUND - FULL COVER EDGE TO EDGE -->
        <div class="hero-video-wrapper">
            <video class="hero-video" autoplay muted loop playsinline poster="{{ asset('assets/images/hero-poster.jpg') }}">
                <source src="{{ asset('assets/video/background.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="hero-video-fallback"></div>
        </div>
        <div class="hero-overlay"></div>

        <!-- Content Container - everything stays within bounds -->
        <div class="hero-content-wrapper">
            <!-- Headline -->
            <div class="hero-content">
                <span class="hero-content__sub">Discover Your</span>
                <h1 class="hero-content__title">
                    {{ $about->hero_header ?? 'Next Step' }}
                    <span>Destination</span>
                </h1>
            </div>

            <!-- Search Card -->
            <div class="search-card">
                <div class="search-card__inner">
                    <div class="s-tabs">
                        <button class="s-tab-btn active" data-tab="tour">
                            <i class="fas fa-umbrella-beach"></i> Tours
                        </button>
                        <button class="s-tab-btn" data-tab="hotel">
                            <i class="fas fa-hotel"></i> Hotels
                        </button>
                    </div>

                    <!-- Tour Form -->
                    <form class="s-form active" id="tourSearchForm" action="{{ route('front.tour-list') }}" method="GET">
                        <div class="s-form__row">
                            <div class="s-field">
                                <span class="s-field__label">Location</span>
                                <div class="s-field__wrap">
                                    <i class="s-icon fas fa-map-marker-alt"></i>
                                    <select name="location" id="location" class="tour-select">
                                        <option value="">All Locations</option>
                                        @foreach ($startLocations as $loc)
                                            <option value="{{ $loc->start_location.' to '.$loc->end_location }}">
                                                {{ $loc->start_location }} to {{ $loc->end_location }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="s-field">
                                <span class="s-field__label">Tour Type</span>
                                <div class="s-field__wrap">
                                    <i class="s-icon fas fa-compass"></i>
                                    <select name="tour_type" id="tour_type" class="tour-select">
                                        <option value="">All Types</option>
                                        @foreach ($tourTypes ?? [] as $t)
                                            <option value="{{ $t }}">{{ Str::ucfirst($t) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="s-field">
                                <span class="s-field__label">Travel Date</span>
                                <div class="s-field__wrap">
                                    <i class="s-icon fas fa-calendar-alt"></i>
                                    <input type="text" name="date" id="tour_date" class="gotur-multi-datepicker" placeholder="Select Date" autocomplete="off">
                                </div>
                            </div>
                            <div class="s-field">
                                <span class="s-field__label">Travelers</span>
                                <div class="s-field__wrap">
                                    <i class="s-icon fas fa-users"></i>
                                    <input type="number" name="guests" id="tour_guests" min="1" max="20" placeholder="2" value="2">
                                </div>
                            </div>
                            <div class="s-field">
                                <span class="s-field__label">&nbsp;</span>
                                <button class="s-btn-submit" type="submit">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Hotel Form -->
                    <form class="s-form" id="hotelSearchForm" action="{{ route('front.hotel-list') }}" method="GET">
                        <div class="s-form__row">
                            <div class="s-field">
                                <span class="s-field__label">Location</span>
                                <div class="s-field__wrap">
                                    <i class="s-icon fas fa-city"></i>
                                    <select name="location" id="city" class="hotel-select">
                                        <option value="">All Locations</option>
                                        @foreach ($hotelLocations ?? [] as $location)
                                            <option value="{{ $location }}">{{ $location }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="s-field">
                                <span class="s-field__label">Check-in</span>
                                <div class="s-field__wrap">
                                    <i class="s-icon fas fa-calendar-check"></i>
                                    <input type="date" name="check_in" id="check_in" autocomplete="off">
                                </div>
                            </div>
                            <div class="s-field">
                                <span class="s-field__label">Check-out</span>
                                <div class="s-field__wrap">
                                    <i class="s-icon fas fa-calendar-times"></i>
                                    <input type="date" name="check_out" id="check_out" autocomplete="off">
                                </div>
                            </div>
                            <div class="s-field">
                                <span class="s-field__label">Guests</span>
                                <div class="s-field__wrap">
                                    <i class="s-icon fas fa-users"></i>
                                    <input type="number" name="guests" min="1" max="20" placeholder="2" value="2">
                                </div>
                            </div>
                            <div class="s-field">
                                <span class="s-field__label">&nbsp;</span>
                                <button class="s-btn-submit" type="submit">
                                    <i class="fas fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Stats -->
            <div class="hero-stats">
                <div class="hero-stat">
                    <div class="hero-stat__num"><span class="counter" data-target="1200">0</span><sup>+</sup></div>
                    <div class="hero-stat__lbl">Tours</div>
                </div>
                <div class="hero-stat-sep"></div>
                <div class="hero-stat">
                    <div class="hero-stat__num"><span class="counter" data-target="340">0</span><sup>+</sup></div>
                    <div class="hero-stat__lbl">Hotels</div>
                </div>
                <div class="hero-stat-sep"></div>
                <div class="hero-stat">
                    <div class="hero-stat__num"><span class="counter" data-target="50">0</span><sup>K+</sup></div>
                    <div class="hero-stat__lbl">Travelers</div>
                </div>
                <div class="hero-stat-sep"></div>
                <div class="hero-stat">
                    <div class="hero-stat__num"><span class="counter" data-target="98">0</span><sup>%</sup></div>
                    <div class="hero-stat__lbl">Satisfaction</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Top Tours --}}
    <section class="current-tours section-space" style="margin-top: 50px;">
        <div class="container">
            {{-- Section Header --}}
            <div class="sec-title text-center wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                <h6 class="sec-title__tagline bw-split-in-right">Featured Tours</h6>
                <h3 class="sec-title__title bw-split-in-left">
                    Explore Our <span>Current</span> Tours
                </h3>
                <p class="sec-title__desc" style="max-width: 600px; margin: 15px auto 0; color: #666;">
                    Discover handpicked adventures waiting for you. Book now and create unforgettable memories.
                </p>
            </div>

            {{-- Tours Grid --}}
            <div class="row gutter-y-30">
                @forelse($tours ?? [] as $tour)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="tour-card wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="{{ $loop->index * 100 + 300 }}ms">
                            {{-- Image Wrapper --}}
                            <div class="tour-card__image">
                                <a href="{{ route('front.tour.detail', base64_encode($tour->id)) }}">
                                    <img src="{{ asset('storage/package/' . ($tour->cover_img ?? 'defaults/tour-default.jpg')) }}"
                                         alt="{{ $tour->title ?? 'Tour' }}"
                                         class="tour-card__img">
                                </a>

                                {{-- Tour Type Badge --}}
                                <span class="tour-card__badge">
                                <i class="fas fa-tag"></i> {{ strtoupper($tour->tour_type) ?? 'Adventure' }}
                            </span>

                                {{-- Price Tag --}}
                                <div class="tour-card__price">
                                    <span class="tour-card__price-amount">BDT {{ number_format($tour->amount ?? 0) }}</span>
                                    <span class="tour-card__price-per">/ person</span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="tour-card__content">
                                {{-- Location --}}
                                <div class="tour-card__location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $tour->start_location." to ".$tour->end_location }}</span>
                                </div>

                                {{-- Title --}}
                                <h4 class="tour-card__title">
                                    <a href="{{ route('front.tour.detail', base64_encode($tour->id)) }}">
                                        {{ $tour->title ?? 'Amazing Tour Package' }}
                                    </a>
                                </h4>

                                {{-- Meta Info --}}
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

                                {{-- Rating & Button --}}
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
                    <h4>No Tourse Exist</h4>
                @endforelse
            </div>

            {{-- View All Button --}}
            <div class="text-center mt-5 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="600ms">
                <a href="{{ route('front.tour-list') }}" class="gotur-btn gotur-btn--primary">
                    <span>View All Tours</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-two about-two--two section-space"  id="about" >
            <div class="row gutter-y-40">
                <div class="col-lg-6">
                    <div class="about-two__thumb wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='300ms'>
                        <div class="about-two__thumb__item">
                            <img src="{{ asset('assets/images/about/about-2-1.jpg') }}" alt="gotur image">
                        </div>
                        <div class="about-two__thumb__item-small">
                            <img src="{{ asset('assets/images/about/about-s-2-1.jpg') }}" alt="gotur image">
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
    <section class="why-choose-one section-space-bottom" style="margin-top:-150px;margin-bottom:-100px;">
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
        document.addEventListener('DOMContentLoaded', function () {
            // --- Tab switching ---
            const tabBtns   = document.querySelectorAll('.s-tab-btn');
            const tourForm  = document.getElementById('tourSearchForm');
            const hotelForm = document.getElementById('hotelSearchForm');

            if (tabBtns.length && tourForm && hotelForm) {
                tabBtns.forEach(btn => {
                    btn.addEventListener('click', function () {
                        tabBtns.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        if (this.dataset.tab === 'tour') {
                            hotelForm.classList.remove('active');
                            tourForm.classList.add('active');
                        } else {
                            tourForm.classList.remove('active');
                            hotelForm.classList.add('active');
                        }
                    });
                });
            }

            // --- Hotel date defaults ---
            const today    = new Date();
            const tomorrow = new Date(); tomorrow.setDate(today.getDate() + 1);
            const dayAfter = new Date(); dayAfter.setDate(today.getDate() + 2);
            const fmt = d => d.toISOString().split('T')[0];

            const ci = document.getElementById('check_in');
            const co = document.getElementById('check_out');
            if (ci && co) {
                ci.min = fmt(today);    ci.value = fmt(tomorrow);
                co.min = fmt(tomorrow); co.value = fmt(dayAfter);
                ci.addEventListener('change', function () {
                    const d = new Date(this.value);
                    d.setDate(d.getDate() + 1);
                    co.min = fmt(d);
                    if (new Date(co.value) <= new Date(this.value)) co.value = fmt(d);
                });
            }

            // --- Hotel form validation ---
            if (hotelForm) {
                hotelForm.addEventListener('submit', function (e) {
                    if (!ci.value || !co.value) {
                        e.preventDefault();
                        alert('Please select check-in and check-out dates.');
                        return;
                    }
                    if (new Date(ci.value) >= new Date(co.value)) {
                        e.preventDefault();
                        alert('Check-out date must be after check-in date.');
                    }
                });
            }

            // --- Counter animation ---
            const counters = document.querySelectorAll('.counter');
            if (counters.length) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const el = entry.target;
                            const target = +el.dataset.target;
                            let count = 0;
                            const step = Math.ceil(target / 60);
                            const tick = setInterval(() => {
                                count = Math.min(count + step, target);
                                el.textContent = count;
                                if (count >= target) clearInterval(tick);
                            }, 20);
                            observer.unobserve(el);
                        }
                    });
                }, { threshold: 0.5 });
                counters.forEach(counter => observer.observe(counter));
            }

            // --- Flatpickr (Datepicker) ---
            if (typeof flatpickr !== 'undefined') {
                flatpickr('#check_in', {
                    minDate: 'today',
                    dateFormat: 'Y-m-d',
                    placeholder: 'Select Date'
                });
            }

            if (typeof flatpickr !== 'undefined') {
                flatpickr('#check_out', {
                    minDate: 'today',
                    dateFormat: 'Y-m-d',
                    placeholder: 'Select Date'
                });
            }

            // --- Select2 Initialization with Theme Matching ---
            if (typeof $.fn.select2 !== 'undefined') {
                const select2Settings = {
                    width: '100%',
                    placeholder: 'Select Option',
                    allowClear: true,
                    dropdownCssClass: 'custom-select2-dropdown',
                    selectionCssClass: 'custom-select2-selection'
                };

                if ($('#location').length) {
                    $('#location').select2({
                        ...select2Settings,
                        placeholder: 'All Locations'
                    });
                }

                if ($('#tour_type').length) {
                    $('#tour_type').select2({
                        ...select2Settings,
                        placeholder: 'All Types'
                    });
                }

                if ($('#city').length) {
                    $('#city').select2({
                        ...select2Settings,
                        placeholder: 'All Locations'
                    });
                }

                // Apply consistent styling
                $('.select2-container--default .select2-selection--single').css({
                    'height': '44px',
                    'border': '1.5px solid #E5E5E5',
                    'border-radius': '10px',
                    'background': '#f8faf7',
                    'padding-left': '38px'
                });

                $('.select2-container--default .select2-selection--single .select2-selection__rendered').css({
                    'line-height': '41px',
                    'color': '#333',
                    'font-size': '13px'
                });
            }

            // --- Flash messages ---
            @if (session('success'))
            if (typeof Swal !== 'undefined') {
                Swal.fire({ icon: 'success', title: 'Success', text: '{{ session('success') }}' });
            } else {
                alert('{{ session('success') }}');
            }
            @endif
                @if (session('error'))
            if (typeof Swal !== 'undefined') {
                Swal.fire({ icon: 'error', title: 'Error', text: '{{ session('error') }}' });
            } else {
                alert('{{ session('error') }}');
            }
            @endif

            // Ensure video plays correctly and covers full width
            const heroVideo = document.querySelector('.hero-video');
            if (heroVideo) {
                heroVideo.play().catch(e => {
                    console.log('Video autoplay failed:', e);
                    const fallback = document.querySelector('.hero-video-fallback');
                    if (fallback) fallback.style.zIndex = '1';
                });
            }
        });
    </script>
@endpush
