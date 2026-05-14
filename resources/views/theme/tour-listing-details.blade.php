@extends('layout.theme')
@section('title', $tour->title ?? 'Tour Details')

@push('css')
    <style>
        /* Tour Plan Accordion - Enhanced */
        .faq-accordion .accordion {
            border: 1px solid var(--gotur-border-color, #E5E5E5);
            border-radius: 12px;
            margin-bottom: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-accordion .accordion:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border-color: var(--gotur-base, #63AB45);
        }

        .faq-accordion .accordion-title {
            padding: 18px 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: var(--gotur-white, #fff);
        }

        .faq-accordion .active .accordion-title {
            background: var(--gotur-gray, #F3F8F6);
            border-bottom: 1px solid var(--gotur-base, #63AB45);
        }

        .faq-accordion .accordion-title h4 {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--gotur-black, #1D231F);
        }

        .faq-accordion .active .accordion-title h4 {
            color: var(--gotur-base, #63AB45);
        }

        .faq-accordion .accordion-title__icon {
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: var(--gotur-base, #63AB45);
        }

        .faq-accordion .accordion-title__icon::before {
            content: '\e918';
            font-family: 'icomoon';
            font-size: 12px;
            transition: transform 0.3s ease;
        }

        .faq-accordion .active .accordion-title__icon {
            transform: rotate(90deg);
            color: var(--gotur-primary, #F7921E);
        }

        .faq-accordion .accordion-content {
            display: none;
            padding: 25px;
            border-top: 1px solid var(--gotur-border-color, #E5E5E5);
            background: var(--gotur-white, #fff);
            animation: accordionSlideDown 0.3s ease;
        }

        @keyframes accordionSlideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .faq-accordion .accordion-content .inner {
            color: var(--gotur-text, #595959);
            line-height: 1.7;
        }

        .faq-accordion .accordion-content .inner p:last-child {
            margin-bottom: 0;
        }

        /* Modal Styles - Enhanced */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(29, 35, 31, 0.85);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            padding: 20px;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-card {
            background: var(--gotur-white, #fff);
            width: 100%;
            max-width: 580px;
            border-radius: 20px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
            padding: 0;
            transform: scale(0.95) translateY(20px);
            transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            opacity: 0;
            overflow: hidden;
        }

        .active .modal-card {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        .modal-header {
            background: var(--gotur-base, #63AB45);
            padding: 20px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-header h2 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--gotur-white, #fff);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modal-header h2 i {
            font-size: 1.4rem;
        }

        .close-modal {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: var(--gotur-white, #fff);
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-modal:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }

        .booking-form {
            padding: 28px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-row .input-group {
            flex: 1;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .input-group.full-width {
            width: 100%;
        }

        .input-group label {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gotur-black, #1D231F);
        }

        .input-group label i {
            color: var(--gotur-base, #63AB45);
            margin-right: 6px;
            width: 18px;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--gotur-border-color, #E5E5E5);
            border-radius: 12px;
            font-size: 14px;
            font-family: var(--gotur-font, "Plus Jakarta Sans", sans-serif);
            transition: all 0.3s ease;
            background: var(--gotur-white, #fff);
        }

        .input-group input:focus,
        .input-group select:focus {
            outline: none;
            border-color: var(--gotur-base, #63AB45);
            box-shadow: 0 0 0 3px rgba(99, 171, 69, 0.1);
        }

        .input-group input:disabled {
            background: var(--gotur-gray, #F3F8F6);
            cursor: not-allowed;
        }

        .confirm-btn {
            width: 100%;
            background: var(--gotur-base, #63AB45);
            color: var(--gotur-white, #fff);
            border: none;
            padding: 14px 24px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .confirm-btn:hover {
            background: var(--gotur-primary, #F7921E);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 171, 69, 0.3);
        }

        .confirm-btn i {
            transition: transform 0.3s ease;
        }

        .confirm-btn:hover i {
            transform: translateX(5px);
        }

        hr {
            margin: 20px 0;
            border: none;
            height: 1px;
            background: var(--gotur-border-color, #E5E5E5);
        }

        /* Share Button Styles */
        .tour-listing-details__destination__right {
            position: relative;
        }

        .tour-listing-details__destination__social__list {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--gotur-white, #fff);
            border-radius: 12px;
            padding: 10px 15px;
            display: flex;
            gap: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 10;
        }

        .tour-listing-details__destination__right:hover .tour-listing-details__destination__social__list {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .tour-listing-details__destination__social__list a {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--gotur-gray, #F3F8F6);
            color: var(--gotur-text, #595959);
            transition: all 0.3s ease;
        }

        .tour-listing-details__destination__social__list a:hover {
            background: var(--gotur-base, #63AB45);
            color: var(--gotur-white, #fff);
            transform: translateY(-2px);
        }

        /* Destination Info Cards Enhancement */
        .tour-listing-details__info-area__info li {
            background: var(--gotur-gray, #F3F8F6);
            padding: 20px 25px;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .tour-listing-details__info-area__info li:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .tour-listing-details__info-area__icon {
            font-size: 28px;
        }

        /* Sidebar Booking Card */
        .tour-listing-details__sidebar__item-form {
            background: var(--gotur-gray, #F3F8F6);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
        }

        .tour-listing-details__sidebar__item-form .gotur-btn {
            width: 100%;
            padding: 15px;
            font-size: 16px;
            font-weight: 700;
        }

        /* Content Sections */
        .tour-listing-details__content__item {
            background: var(--gotur-white, #fff);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--gotur-border-color, #E5E5E5);
        }

        .tour-listing-details__title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 12px;
        }

        .tour-listing-details__title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--gotur-base, #63AB45);
            border-radius: 3px;
        }

        /* Include/Exclude Lists - UPDATED: Badge Style with Clean Grid */
        .tour-listing-details__list ul,
        .tour-listing-details__amenities__inner ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .tour-listing-details__list li,
        .tour-listing-details__amenities__inner li {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
            background: #F0F9EC;
            border-radius: 40px;
            font-size: 14px;
            color: #2C5E1E;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .tour-listing-details__list li i,
        .tour-listing-details__amenities__inner li i {
            color: var(--gotur-base, #63AB45);
            font-size: 14px;
        }

        /* Hover effect for badges */
        .tour-listing-details__list li:hover,
        .tour-listing-details__amenities__inner li:hover {
            background: var(--gotur-base, #63AB45);
            color: white;
            transform: translateY(-2px);
        }

        .tour-listing-details__list li:hover i,
        .tour-listing-details__amenities__inner li:hover i {
            color: white;
        }

        /* Excluded items can have a slightly different badge style */
        .tour-listing-details__amenities__inner li {
            background: #FEF3E2;
            color: #D97706;
        }

        .tour-listing-details__amenities__inner li i {
            color: #D97706;
        }

        .tour-listing-details__amenities__inner li:hover {
            background: #D97706;
            color: white;
        }

        .tour-listing-details__amenities__inner li:hover i {
            color: white;
        }

        /* ========== COMPACT HERO SECTION - SMALLER IMAGE, LESS SCROLLING ========== */

        /* Hero Section - Compact Design */
        .tour-hero-section {
            position: relative;
            margin-top: -60px;
            margin-bottom: 30px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .tour-hero-image {
            width: 100%;
            height: 320px;
            object-fit: cover;
            object-position: center;
        }

        .tour-hero-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.75), transparent);
            padding: 30px 30px 25px;
            color: white;
        }

        .tour-hero-overlay .tour-title {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
            color: white;
            letter-spacing: -0.5px;
        }

        .tour-hero-overlay .tour-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            font-size: 13px;
            opacity: 0.9;
        }

        .tour-hero-overlay .tour-meta i {
            margin-right: 6px;
        }

        /* Quick Stats Bar - Compact */
        .quick-stats-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            background: white;
            border-radius: 16px;
            padding: 5px 15px;
            margin-bottom: 35px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.06);
            border: 1px solid var(--gotur-border-color);
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
        }

        .stat-icon {
            width: 42px;
            height: 42px;
            background: var(--gotur-gray);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gotur-base);
            font-size: 20px;
        }

        .stat-info h6 {
            font-size: 12px;
            color: var(--gotur-text);
            margin: 0 0 3px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-info p {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
            color: var(--gotur-black);
        }

        /* Two Column Layout Improvement */
        .two-column-layout {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 35px;
        }

        /* Sidebar Enhancement */
        .sidebar-sticky {
            position: sticky;
            top: 90px;
        }

        .booking-card {
            background: white;
            border-radius: 20px;
            border: 1px solid var(--gotur-border-color);
            overflow: hidden;
            margin-bottom: 25px;
        }

        .booking-card-header {
            background: var(--gotur-base);
            color: white;
            padding: 18px;
            text-align: center;
        }

        .booking-card-header .price {
            font-size: 32px;
            font-weight: 800;
        }

        .booking-card-header .price small {
            font-size: 13px;
            font-weight: 400;
        }

        .booking-card-body {
            padding: 20px;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0 0 18px 0;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            border-bottom: 1px solid var(--gotur-border-color);
            font-size: 14px;
        }

        .feature-list li i {
            width: 22px;
            color: var(--gotur-base);
            font-size: 14px;
        }

        /* Gallery Grid - Compact */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
            margin-top: 20px;
        }

        .gallery-grid-item {
            border-radius: 12px;
            overflow: hidden;
            aspect-ratio: 1 / 1;
            cursor: pointer;
        }

        .gallery-grid-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-grid-item:hover img {
            transform: scale(1.05);
        }

        .view-all-gallery {
            grid-column: span 4;
            text-align: center;
            padding: 10px;
            background: var(--gotur-gray);
            border-radius: 40px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .view-all-gallery:hover {
            background: var(--gotur-base);
            color: white;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .two-column-layout {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .sidebar-sticky {
                position: static;
            }

            .quick-stats-bar {
                border-radius: 16px;
                flex-direction: column;
            }

            .stat-item {
                justify-content: space-between;
            }

            .gallery-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .view-all-gallery {
                grid-column: span 3;
            }

            .tour-hero-image {
                height: 280px;
            }

            .tour-hero-overlay .tour-title {
                font-size: 24px;
            }
        }

        @media (max-width: 768px) {
            .tour-listing-details__list ul,
            .tour-listing-details__amenities__inner ul {
                gap: 10px;
            }

            .tour-listing-details__list li,
            .tour-listing-details__amenities__inner li {
                font-size: 12px;
                padding: 5px 14px;
            }

            .tour-listing-details__title {
                font-size: 22px;
            }

            .tour-listing-details__info-area__info {
                flex-wrap: wrap;
            }

            .tour-listing-details__info-area__info li {
                flex: calc(50% - 15px);
                min-width: 160px;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .view-all-gallery {
                grid-column: span 2;
            }

            .tour-hero-image {
                height: 220px;
            }

            .tour-hero-overlay {
                padding: 20px 20px 15px;
            }

            .tour-hero-overlay .tour-title {
                font-size: 20px;
            }

            .tour-hero-overlay .tour-meta {
                gap: 12px;
                font-size: 11px;
            }

            .booking-card-header .price {
                font-size: 28px;
            }
        }

        @media (max-width: 480px) {
            .tour-hero-image {
                height: 180px;
            }

            .tour-hero-section {
                margin-top: -40px;
            }

            .stat-item {
                padding: 8px 12px;
            }

            .stat-icon {
                width: 36px;
                height: 36px;
                font-size: 16px;
            }

            .stat-info p {
                font-size: 14px;
            }

            .tour-listing-details__content__item {
                padding: 20px;
            }
        }
    </style>
@endpush

@section('content')

    <!-- Professional Tour Details Section -->
    <section class="tour-listing-details section-space" style="padding-top: 40px; padding-bottom: 60px;">
        <div class="container">
            <!-- Hero Section with Optimized & Smaller Image -->
            <div class="tour-hero-section wow fadeInUp" data-wow-duration='1500ms'>
                <img src="{{asset('storage/package/'.$tour->cover_img)}}" alt="{{$tour->title}}" class="tour-hero-image">
                <div class="tour-hero-overlay">
                    <h1 class="tour-title">{{$tour->title}}</h1>
                    <div class="tour-meta">
                        <span><i class="icon-pin1"></i> {{$tour->start_location}} → {{$tour->end_location}}</span>
                        <span><i class="icon-clock"></i> {{$tour->day}} Days / {{$tour->night}} Nights</span>
                        <span><i class="icon-group"></i> Max {{$tour->max_people}} People</span>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Bar -->
            <div class="quick-stats-bar wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                <div class="stat-item">
                    <div class="stat-icon"><i class="icon-location"></i></div>
                    <div class="stat-info">
                        <h6>Destination</h6>
                        <p>{{$tour->end_location}}</p>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="icon-travel-and-tourism"></i></div>
                    <div class="stat-info">
                        <h6>Tour Type</h6>
                        <p>{{ucfirst($tour->tour_type)}}</p>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="icon-clock"></i></div>
                    <div class="stat-info">
                        <h6>Duration</h6>
                        <p>{{$tour->day}}D / {{$tour->night}}N</p>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon"><i class="icon-price-tag"></i></div>
                    <div class="stat-info">
                        <h6>Travel Date</h6>
                        <p>{{$tour->tour_date??"Null"}}</p>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="two-column-layout">
                <!-- Main Content Column -->
                <div class="tour-listing-details__content">

                    <!-- Overview Section -->
                    <div class="tour-listing-details__content__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='200ms'>
                        <h4 class="tour-listing-details__title">Overview</h4>
                        <div class="tour-listing-details__text">
                            {!! $tour->detail !!}
                        </div>
                    </div>

                    <!-- What's Included - UPDATED: Badge List Style -->
                    <div class="tour-listing-details__content__item tour-listing-details__list wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                        <h4 class="tour-listing-details__title">What's Included</h4>
                        <div>
                            @php
                                // Clean and split the include content by commas
                                $includeText = strip_tags($tour->include);
                                // Split by comma, trim each item, and filter out empty values
                                $includedItems = array_filter(array_map('trim', explode(',', $includeText)));
                            @endphp

                            @if(!empty($includedItems))
                                <ul>
                                    @foreach($includedItems as $item)
                                        <li><i class="fas fa-check-circle"></i> {{ $item }}</li>
                                    @endforeach
                                </ul>
                            @else
                                {!! $tour->include !!}
                            @endif
                        </div>
                    </div>

                    <!-- What's Excluded - UPDATED: Badge List Style -->
                    <div class="tour-listing-details__content__item tour-listing-details__amenities wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='400ms'>
                        <h4 class="tour-listing-details__title">What's Excluded</h4>
                        <div class="tour-listing-details__amenities__inner">
                            @php
                                // Clean and split the exclude content by commas
                                $excludeText = strip_tags($tour->exclude);
                                $excludedItems = array_filter(array_map('trim', explode(',', $excludeText)));
                            @endphp

                            @if(!empty($excludedItems))
                                <ul>
                                    @foreach($excludedItems as $item)
                                        <li><i class="fas fa-times-circle"></i> {{ $item }}</li>
                                    @endforeach
                                </ul>
                            @else
                                {!! $tour->exclude !!}
                            @endif
                        </div>
                    </div>

                    @if($tour->gallery_images && count(json_decode($tour->gallery_images, true)) > 0)
                        <div class="tour-listing-details__content__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='600ms'>
                            <h4 class="tour-listing-details__title">Gallery</h4>
                            <div class="gallery-grid">
                                @php
                                    $galleryImages = json_decode($tour->gallery_images, true);
                                    $displayImages = array_slice($galleryImages, 0, 7);
                                @endphp
                                @foreach($displayImages as $image)
                                    <div class="gallery-grid-item" onclick="openGalleryModal({{$loop->index}})">
                                        <img src="{{asset('storage/package/'.$image)}}" alt="Gallery Image">
                                    </div>
                                @endforeach
                                @if(count($galleryImages) > 7)
                                    <div class="view-all-gallery" onclick="openAllGallery()">
                                        <i class="icon-image"></i> View All {{count($galleryImages)}} Photos
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar Column -->
                <div class="sidebar-sticky">
                    <!-- Booking Card -->
                    <div class="booking-card wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1500ms">
                        <div class="booking-card-header">
                            <div class="price">{{config('app.currency')}} {{number_format($tour->amount)}} <small>/ person</small></div>
                            <small style="font-size: 12px; opacity: 0.9;">Including taxes & fees</small>
                        </div>
                        <div class="booking-card-body">
                            <ul class="feature-list">
                                <li><i class="fas fa-check-circle"></i> Instant confirmation</li>
                                <li><i class="fas fa-shield-alt"></i> Best price guarantee</li>
                                <li><i class="fas fa-headset"></i> 24/7 customer support</li>
                                <li><i class="fas fa-calendar-alt"></i> Free cancellation up to 7 days</li>
                            </ul>
                            <a href="{{ url('bus/layout') }}?bus_id={{ base64_encode($tour->bus->id ?? '') }}&package_id={{ base64_encode($tour->id) }}" class="gotur-btn" style="width: 100%; text-align: center; display: block;">
                                Book Now <i class="icon-right"></i>
                            </a>
                            <div class="share-section" style="margin-top: 18px; text-align: center; padding-top: 12px; border-top: 1px solid var(--gotur-border-color);">
                                <span style="font-size: 12px; color: var(--gotur-text);">Share this tour:</span>
                                <div style="display: flex; justify-content: center; gap: 10px; margin-top: 8px;">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current())}}" target="_blank" style="width: 32px; height: 32px; background: #1877f2; color: white; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 14px;"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://twitter.com/intent/tweet?text={{urlencode($tour->title)}}&url={{urlencode(url()->current())}}" target="_blank" style="width: 32px; height: 32px; background: #1da1f2; color: white; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 14px;"><i class="fab fa-twitter"></i></a>
                                    <a href="https://wa.me/?text={{urlencode($tour->title . ' - ' . url()->current())}}" target="_blank" style="width: 32px; height: 32px; background: #25d366; color: white; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 14px;"><i class="fab fa-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tour Details Card -->
                    <div class="booking-card wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="booking-card-header" style="background: var(--gotur-black, #1D231F);">
                            <h4 style="color: white; margin: 0; font-size: 16px;">Tour Details</h4>
                        </div>
                        <div class="booking-card-body">
                            <ul class="feature-list" style="margin-bottom: 0;">

                                <li><i class="fas fa-clock"></i> <strong>Duration:</strong> <span style="margin-left: auto;">{{$tour->day}} Days / {{$tour->night}} Nights</span></li>
                                <li><i class="fas fa-users"></i> <strong>Max People:</strong> <span style="margin-left: auto;">{{$tour->max_people}}</span></li>
                                <li><i class="fas fa-map-marker-alt"></i> <strong>Start Point:</strong> <span style="margin-left: auto;">{{$tour->start_location}}</span></li>
                                <li><i class="fas fa-flag-checkered"></i> <strong>End Point:</strong> <span style="margin-left: auto;">{{$tour->end_location}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Accordion functionality
            const accordionContainer = document.querySelector('.faq-accordion');
            if (accordionContainer) {
                const accordions = accordionContainer.querySelectorAll('.accordion');

                accordions.forEach(accordion => {
                    const title = accordion.querySelector('.accordion-title');
                    const content = accordion.querySelector('.accordion-content');

                    // Set initial state - only first one open
                    if (!accordion.classList.contains('active')) {
                        if (content) content.style.display = 'none';
                    } else {
                        if (content) content.style.display = 'block';
                    }

                    // Add click handler
                    title.addEventListener('click', function(e) {
                        e.preventDefault();
                        const isCurrentlyActive = accordion.classList.contains('active');

                        if (isCurrentlyActive) {
                            accordion.classList.remove('active');
                            if (content) content.style.display = 'none';
                        } else {
                            accordions.forEach(otherAccordion => {
                                otherAccordion.classList.remove('active');
                                const otherContent = otherAccordion.querySelector('.accordion-content');
                                if (otherContent) otherContent.style.display = 'none';
                            });
                            accordion.classList.add('active');
                            if (content) content.style.display = 'block';
                        }
                    });
                });
            }

            // Sticky sidebar on scroll
            const sidebar = document.querySelector('.sidebar-sticky');
            if (sidebar) {
                let initialOffset = sidebar.offsetTop;
                window.addEventListener('scroll', function() {
                    if (window.innerWidth > 992) {
                        if (window.pageYOffset > initialOffset - 30) {
                            sidebar.style.position = 'sticky';
                            sidebar.style.top = '30px';
                        } else {
                            sidebar.style.position = 'static';
                        }
                    }
                });
            }
        });

        // Gallery modal functions
        function openGalleryModal(index) {
            // You can implement a proper lightbox gallery here
            alert('Gallery viewer will open here with image ' + (index + 1));
        }

        function openAllGallery() {
            alert('Full gallery view will open here');
        }
    </script>
@endpush
