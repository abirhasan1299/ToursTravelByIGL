@extends('layout.theme')
@section('title', $tour->title ?? 'Tour Details')

@push('css')
<style>
    /* Carousel Image Height Fix */
    .destination-carousel__item {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        max-height: 500px; /* Adjust this value as needed */
    }

    .destination-carousel__item img {
        width: 100%;
        height: 500px; /* Fixed height */
        object-fit: cover;
        object-position: center;
        transition: transform 0.5s ease;
    }

    .destination-carousel__item:hover img {
        transform: scale(1.05);
    }

    /* Owl Carousel Item Height */
    .destination-carousel .owl-item .item {
        height: 500px;
    }

    .destination-carousel__inner .item {
        height: 500px;
    }

    /* Gallery image specific - remove inline height style */
    .destination-carousel__inner .item .destination-carousel__item img[style*="height"] {
        height: 500px !important;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .destination-carousel__item,
        .destination-carousel__item img,
        .destination-carousel .owl-item .item,
        .destination-carousel__inner .item {
            height: 400px;
            max-height: 400px;
        }
    }

    @media (max-width: 768px) {
        .destination-carousel__item,
        .destination-carousel__item img,
        .destination-carousel .owl-item .item,
        .destination-carousel__inner .item {
            height: 300px;
            max-height: 300px;
        }
    }

    @media (max-width: 480px) {
        .destination-carousel__item,
        .destination-carousel__item img,
        .destination-carousel .owl-item .item,
        .destination-carousel__inner .item {
            height: 250px;
            max-height: 250px;
        }
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

    /* Tour Plan Accordion */
    .faq-accordion .accordion {
        border: 1px solid var(--gotur-border-color, #E5E5E5);
        border-radius: 12px;
        margin-bottom: 15px;
        overflow: hidden;
    }

    .faq-accordion .accordion-title {
        padding: 18px 25px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .faq-accordion .accordion-title h4 {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .faq-accordion .accordion-title__icon {
        width: 24px;
        height: 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .faq-accordion .accordion-title__icon::before {
        content: '\e918';
        font-family: 'icomoon';
        font-size: 12px;
    }

    .faq-accordion .active .accordion-title__icon {
        transform: rotate(90deg);
    }

    .faq-accordion .accordion-content {
        display: none;
        padding: 0 25px 25px 25px;
        border-top: 1px solid var(--gotur-border-color, #E5E5E5);
    }

    .faq-accordion .active .accordion-content {
        display: block;
    }

    /* Include/Exclude Lists */
    .tour-listing-details__list ul,
    .tour-listing-details__amenities__inner ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .tour-listing-details__list li,
    .tour-listing-details__amenities__inner li {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 0;
    }

    .tour-listing-details__list li i,
    .tour-listing-details__amenities__inner li i {
        color: var(--gotur-base, #63AB45);
        font-size: 16px;
        width: 20px;
    }

    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 15px;
        }

        .tour-listing-details__list ul,
        .tour-listing-details__amenities__inner ul {
            grid-template-columns: 1fr;
        }

        .tour-listing-details__title {
            font-size: 24px;
        }

        .tour-listing-details__info-area__info {
            flex-wrap: wrap;
        }

        .tour-listing-details__info-area__info li {
            flex: calc(50% - 15px);
            min-width: 180px;
        }
    }
</style>
@endpush

@section('content')
    <!-- Booking Modal -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-card">
            <div class="modal-header">
                <h2><i class="fas fa-calendar-check"></i> Book This Tour</h2>
                <button class="close-modal" id="closeModalBtn"><i class="fas fa-times"></i></button>
            </div>
            <form method="post" class="booking-form" id="bookingForm" action="@guest {{route('package.booking')}} @endguest @auth {{route('package.booking.user')}} @endauth">
                @csrf
                <div class="form-row">
                    <div class="input-group">
                        <label><i class="fas fa-calendar-alt"></i> Travel Date</label>
                        <input type="date" name="date" id="dateField" required>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-users"></i> Quantity</label>
                        <input type="hidden" name="package_id" value="{{$tour->id}}">
                        <input type="number" name="quantity" id="quantityField" placeholder="Number of travelers" min="1" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group">
                        <label><i class="fas fa-money-bill-wave"></i> Total (BDT)</label>
                        <input type="text" name="total" id="totalField" placeholder="0" disabled>
                    </div>
                    @guest
                    <div class="input-group">
                        <label><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" name="user_name" id="userNameField" placeholder="Enter your full name" required>
                    </div>
                    @endguest
                </div>
                @guest
                <div class="form-row">

                    <div class="input-group">
                        <label><i class="fas fa-envelope"></i> Email Address</label>
                        <input type="email" name="user_email" id="userEmailField" placeholder="your@email.com" required>
                    </div>

                    <div class="input-group">
                        <label><i class="fas fa-phone"></i> Phone Number</label>
                        <input type="tel" name="user_phone" id="userPhoneField" placeholder="+880XXXXXXXXX" required>
                    </div>
                </div>
                @endguest
                <div class="input-group full-width">
                    <label><i class="fas fa-map-marker-alt"></i> Address</label>
                    <input type="text" name="user_address" id="userAddressField" placeholder="Your full address" >
                </div>
                <hr>
                <button type="submit" class="confirm-btn">
                    <span>Confirm Booking</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Page Header -->
    <section class="page-header">
        <div class="page-header__bg" style="background-image: url({{asset('assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div>
        <div class="container">
            <div class="page-header__content">
                <h2 class="page-header__title bw-split-in-right">{{$tour->title}}</h2>
                <ul class="gotur-breadcrumb list-unstyled">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('front.tour-list')}}">Tours</a></li>
                    <li><span>{{$tour->title}}</span></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Tour Details Section -->
    <section class="tour-listing-details section-space" style="margin-top: -80px">
        <div class="container">
            <!-- Destination Info -->
            <div class="tour-listing-details__destination wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                <div class="tour-listing-details__destination__inner">
                    <div class="tour-listing-details__destination__left">
                        <h4 class="tour-listing-details__destination__title">{{$tour->title}}</h4>
                        <div class="tour-listing-details__destination__revue">
                            <div class="tour-listing-details__destination__posted">
                                <i class="icon-pin1"></i>
                                <p class="tour-listing-details__destination__posted-text">
                                    {{$tour->start_location}} → {{$tour->end_location}}
                                </p>
                            </div>
                            <div class="tour-listing-details__destination__posted">
                                @foreach(json_decode($tour->subdestination, true) as $des)
                                    <i class="icon-pin1"></i>
                                    {{$des}}
                                    @if (!$loop->last)
                                        <i class="icon-arrow-right"></i>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tour-listing-details__destination__right">
                        <a href="javascript:void(0)" class="tour-listing-details__destination__btn gotur-btn">
                            Share <i class="icon-share"></i>
                        </a>
                        <div class="tour-listing-details__destination__social__list">
                            <a href="https://twitter.com/intent/tweet?text={{urlencode($tour->title)}}&url={{urlencode(url()->current())}}" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current())}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{urlencode(url()->current())}}&title={{urlencode($tour->title)}}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://wa.me/?text={{urlencode($tour->title . ' - ' . url()->current())}}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Image Carousel -->
            <div class="tour-listing-details__carousel wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='400ms'>
                <div class="destination-carousel">
                    <div class="destination-carousel__inner gotur-owl__carousel gotur-owl__carousel--basic-nav owl-carousel owl-theme" data-owl-options='{
            "items": 1,
            "margin": 30,
            "loop": true,
            "smartSpeed": 700,
            "nav": true,
            "navText": ["<span class=\"icon-arrow-left\"></span>","<span class=\"icon-arrow-right\"></span>"],
            "dots": false,
            "autoplay": true,
            "autoplayTimeout": 5000
        }'>
                        <div class="item">
                            <div class="destination-carousel__item">
                                <img src="{{asset('storage/package/'.$tour->cover_img)}}" alt="{{$tour->title}}">
                            </div>
                        </div>
                        @if($tour->gallery_images)
                            @foreach(json_decode($tour->gallery_images, true) as $image)
                                <div class="item">
                                    <div class="destination-carousel__item">
                                        {{-- Removed inline height style --}}
                                        <img src="{{asset('storage/package/'.$image)}}" alt="{{$tour->title}}">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Info Cards -->
            <div class="tour-listing-details__info-area wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                <ul class="tour-listing-details__info-area__info list-unstyled">
                    <li>
                        <div class="tour-listing-details__info-area__icon">
                            <i class="icon-location"></i>
                        </div>
                        <div class="tour-listing-details__info-area__content">
                            <h5 class="tour-listing-details__info-area__title">Location</h5>
                            <p class="tour-listing-details__info-area__text">{{$tour->end_location}}</p>
                        </div>
                    </li>
                    <li>
                        <div class="tour-listing-details__info-area__icon">
                            <i class="icon-travel-and-tourism"></i>
                        </div>
                        <div class="tour-listing-details__info-area__content">
                            <h5 class="tour-listing-details__info-area__title">Tour Type</h5>
                            <p class="tour-listing-details__info-area__text">{{ucfirst($tour->tour_type)}}</p>
                        </div>
                    </li>
                    <li>
                        <div class="tour-listing-details__info-area__icon">
                            <i class="icon-clock"></i>
                        </div>
                        <div class="tour-listing-details__info-area__content">
                            <h5 class="tour-listing-details__info-area__title">Duration</h5>
                            <p class="tour-listing-details__info-area__text">{{$tour->day}} Days, {{$tour->night}} Nights</p>
                        </div>
                    </li>
                    <li>
                        <div class="tour-listing-details__info-area__icon">
                            <i class="icon-group"></i>
                        </div>
                        <div class="tour-listing-details__info-area__content">
                            <h5 class="tour-listing-details__info-area__title">Max People</h5>
                            <p class="tour-listing-details__info-area__text">{{$tour->max_people}} Travelers</p>
                        </div>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="gotur-btn open-modal-btn">
                            {{config('app.currency')}} {{number_format($tour->amount)}} <small>/ Person</small>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="row gutter-y-30">
                <div class="col-lg-8">
                    <div class="tour-listing-details__content">
                        <!-- Overview -->
                        <div class="tour-listing-details__content__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                            <h4 class="tour-listing-details__title">Overview</h4>
                            <div class="tour-listing-details__text">
                                {!! $tour->detail !!}
                            </div>
                        </div>

                        <!-- What's Included -->
                        <div class="tour-listing-details__content__item tour-listing-details__list wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='600ms'>
                            <h4 class="tour-listing-details__title">What's Included</h4>
                            <div>
                                {!! $tour->include !!}
                            </div>
                        </div>

                        <!-- What's Excluded -->
                        <div class="tour-listing-details__content__item tour-listing-details__amenities wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='700ms'>
                            <h4 class="tour-listing-details__title">What's Excluded</h4>
                            <div class="tour-listing-details__amenities__inner">
                                {!! $tour->exclude !!}
                            </div>
                        </div>

                        <!-- Tour Plan -->
                        <div class="tour-listing-details__content__item tour-listing-details__ture-plan wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='800ms'>
                            <h4 class="tour-listing-details__title">Tour Plan</h4>
                            <div class="faq-page__accordion faq-accordion gotur-accordion" data-grp-name="gotur-accordion">
                                @foreach($activities as $index => $activity)
                                    <div class="accordion {{$index == 0 ? 'active' : ''}} wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='{{800 + ($index * 100)}}ms'>
                                        <div class="accordion-title">
                                            <h4>
                                                {{$activity->title}}
                                                <span class="accordion-title__icon"></span>
                                            </h4>
                                        </div>
                                        <div class="accordion-content">
                                            <div class="inner">
                                                <p>{!! $activity->detail !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="tour-listing-details__sidebar">
                        <!-- Booking Card -->
                        <div class="tour-listing-details__sidebar__item tour-listing-details__sidebar__item-form wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                            <h4 class="tour-listing-details__sidebar__title">Book This Tour</h4>
                            <div class="price-info" style="margin: 20px 0; text-align: center;">
                                <span style="font-size: 32px; font-weight: 800; color: var(--gotur-base);">
                                    {{config('app.currency')}} {{number_format($tour->amount)}}
                                </span>
                                <span style="display: block; font-size: 14px; color: var(--gotur-text);">per person</span>
                            </div>
                            <button type="button" class="gotur-btn open-modal-btn" id="openModalBtn" style="width: 100%;">
                                Book Now <i class="icon-right"></i>
                            </button>
                            <div class="booking-info" style="margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--gotur-border-color);">
                                <p style="font-size: 13px; color: var(--gotur-text); margin-bottom: 8px;">
                                    <i class="fas fa-check-circle" style="color: var(--gotur-base); margin-right: 8px;"></i>
                                    Instant confirmation
                                </p>
                                <p style="font-size: 13px; color: var(--gotur-text); margin-bottom: 0;">
                                    <i class="fas fa-shield-alt" style="color: var(--gotur-base); margin-right: 8px;"></i>
                                    Best price guarantee
                                </p>
                            </div>
                        </div>

                        <!-- Tour Details Card -->
                        <div class="tour-listing-details__sidebar__item wow fadeInUp" data-wow-delay="500ms" data-wow-duration="1500ms">
                            <h4 class="tour-listing-details__sidebar__title">Tour Details</h4>
                            <ul class="tour-details-list" style="list-style: none; padding: 0;">
                                <li style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--gotur-border-color);">
                                    <span><i class="fas fa-tag"></i> Tour ID:</span>
                                    <strong>#{{$tour->id}}</strong>
                                </li>
                                <li style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--gotur-border-color);">
                                    <span><i class="fas fa-clock"></i> Duration:</span>
                                    <strong>{{$tour->day}} Days / {{$tour->night}} Nights</strong>
                                </li>
                                <li style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--gotur-border-color);">
                                    <span><i class="fas fa-users"></i> Max People:</span>
                                    <strong>{{$tour->max_people}}</strong>
                                </li>
                                <li style="display: flex; justify-content: space-between; padding: 10px 0;">
                                    <span><i class="fas fa-language"></i> Language:</span>
                                    <strong>English, Bengali</strong>
                                </li>
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
        // Price calculation
        const ticketPrice = {{$tour->amount}};
        const qtyInput = document.getElementById('quantityField');
        const totalInput = document.getElementById('totalField');

        if (qtyInput && totalInput) {
            function calculateTotal() {
                let qty = parseInt(qtyInput.value) || 0;
                let total = qty * ticketPrice;
                totalInput.value = total.toFixed(2);

                // Highlight effect
                totalInput.style.backgroundColor = '#e8f5e9';
                setTimeout(() => {
                    totalInput.style.backgroundColor = '';
                }, 200);
            }

            qtyInput.addEventListener('input', calculateTotal);
            if (qtyInput.value) calculateTotal();
        }

        // Modal functionality
        const modalOverlay = document.getElementById('modalOverlay');
        const openBtns = document.querySelectorAll('.open-modal-btn');
        const closeBtn = document.getElementById('closeModalBtn');

        function openModal() {
            if (modalOverlay) modalOverlay.classList.add('active');
            // Set default date (tomorrow)
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const dateInput = document.getElementById('dateField');
            if (dateInput) {
                dateInput.value = tomorrow.toISOString().split('T')[0];
            }
        }

        function closeModal() {
            if (modalOverlay) modalOverlay.classList.remove('active');
        }

        openBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                openModal();
            });
        });

        if (closeBtn) closeBtn.addEventListener('click', closeModal);

        if (modalOverlay) {
            modalOverlay.addEventListener('click', function(e) {
                if (e.target === modalOverlay) closeModal();
            });
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modalOverlay && modalOverlay.classList.contains('active')) {
                closeModal();
            }
        });

        // Accordion functionality
        const accordions = document.querySelectorAll('.faq-accordion .accordion');
        accordions.forEach(accordion => {
            const title = accordion.querySelector('.accordion-title');
            title.addEventListener('click', () => {
                const isActive = accordion.classList.contains('active');
                accordions.forEach(a => a.classList.remove('active'));
                if (!isActive) accordion.classList.add('active');
            });
        });
    });
</script>
@endpush
