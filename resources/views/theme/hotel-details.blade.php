{{-- resources/views/hotels/show.blade.php --}}
@extends('layout.theme')
@section('title', $hotel->name ?? 'Hotel Details')

@section('meta_description', $hotel->description)

@section('meta_image', asset('storage/'.$hotel->images[0]->cover_img??""))
@section('meta_robots', $seo->robots??'index, follow')

@section('favicon', '')

@section('og_type', 'website')
@section('og_title', $hotel->name)
@section('og_description', $hotel->description)
@section('og_width', '1200')
@section('og_height', '630')

@section('twitter_title', $hotel->name)
@section('twitter_meta_description', $hotel->description)
@section('twitter_meta_image', $hotel->images[0]->cover_img??"")


@push('css')
    <style>
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
        .input-group select,
        .input-group textarea {
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
        .input-group select:focus,
        .input-group textarea:focus {
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
        .hotel-details__destination__right {
            position: relative;
        }

        .hotel-details__destination__social__list {
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

        .hotel-details__destination__right:hover .hotel-details__destination__social__list {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .hotel-details__destination__social__list a {
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

        .hotel-details__destination__social__list a:hover {
            background: var(--gotur-base, #63AB45);
            color: var(--gotur-white, #fff);
            transform: translateY(-2px);
        }

        /* Image Gallery Styles - Large Main + Thumbnail Grid */
        .hotel-gallery {
            margin-bottom: 40px;
        }

        .gallery-main {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .gallery-main img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-main:hover img {
            transform: scale(1.05);
        }

        .gallery-overlay {
            position: absolute;
            bottom: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            backdrop-filter: blur(5px);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .gallery-overlay:hover {
            background: var(--gotur-base, #63AB45);
        }

        .gallery-thumbnails {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .thumbnail-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            aspect-ratio: 16/10;
            transition: all 0.3s ease;
        }

        .thumbnail-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .thumbnail-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .thumbnail-item:hover img {
            transform: scale(1.1);
        }

        .thumbnail-item.active {
            border: 3px solid var(--gotur-base, #63AB45);
            box-shadow: 0 0 0 3px rgba(99, 171, 69, 0.3);
        }

        .thumbnail-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            padding: 8px;
            color: white;
            font-size: 12px;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .thumbnail-item:hover .thumbnail-overlay {
            opacity: 1;
        }

        /* Lightbox Modal for Fullscreen View */
        .lightbox-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.95);
            z-index: 2000;
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
            z-index: 2001;
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

        /* Info Cards */
        .hotel-details__info-area__info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 40px;
        }

        .hotel-details__info-area__info li {
            flex: 1;
            min-width: 180px;
            background: var(--gotur-gray, #F3F8F6);
            padding: 20px 25px;
            border-radius: 16px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .hotel-details__info-area__info li:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .hotel-details__info-area__icon {
            font-size: 32px;
            color: var(--gotur-base, #63AB45);
        }

        .hotel-details__info-area__content h5 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--gotur-text, #595959);
        }

        .hotel-details__info-area__content p {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
            color: var(--gotur-black, #1D231F);
        }

        /* Content Sections */
        .hotel-details__content__item {
            background: var(--gotur-white, #fff);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--gotur-border-color, #E5E5E5);
        }

        .hotel-details__title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 12px;
        }

        .hotel-details__title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--gotur-base, #63AB45);
            border-radius: 3px;
        }

        /* Amenities Grid */
        .amenities-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .amenity-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--gotur-gray, #F3F8F6);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .amenity-item:hover {
            transform: translateX(5px);
            background: var(--gotur-base, #63AB45);
            color: white;
        }

        .amenity-item:hover i {
            color: white;
        }

        .amenity-item i {
            font-size: 20px;
            color: var(--gotur-base, #63AB45);
            width: 30px;
        }

        .amenity-item span {
            font-size: 14px;
            font-weight: 500;
        }

        /* Map Container */
        .map-container {
            border-radius: 16px;
            overflow: hidden;
            margin-top: 20px;
        }

        .map-container iframe {
            width: 100%;
            height: 400px;
            border: none;
        }

        /* Check Times */
        .check-times {
            display: flex;
            gap: 20px;
            margin-top: 15px;
        }

        .check-time-card {
            flex: 1;
            background: var(--gotur-gray, #F3F8F6);
            padding: 15px;
            border-radius: 12px;
            text-align: center;
        }

        .check-time-card i {
            font-size: 24px;
            color: var(--gotur-base, #63AB45);
            margin-bottom: 8px;
            display: block;
        }

        .check-time-card .label {
            font-size: 12px;
            color: var(--gotur-text, #595959);
            display: block;
        }

        .check-time-card .time {
            font-size: 18px;
            font-weight: 700;
            color: var(--gotur-black, #1D231F);
        }

        /* Sidebar Styles */
        .hotel-details__sidebar__item {
            background: var(--gotur-white, #fff);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid var(--gotur-border-color, #E5E5E5);
        }

        .hotel-details__sidebar__title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--gotur-base, #63AB45);
            display: inline-block;
        }

        .price-big {
            font-size: 42px;
            font-weight: 800;
            color: var(--gotur-base, #63AB45);
            line-height: 1;
        }

        .price-big small {
            font-size: 16px;
            font-weight: 400;
            color: var(--gotur-text, #595959);
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 15px;
            }

            .amenities-grid {
                grid-template-columns: 1fr;
            }

            .hotel-details__title {
                font-size: 24px;
            }

            .gallery-main img {
                height: 300px;
            }

            .gallery-thumbnails {
                grid-template-columns: repeat(2, 1fr);
            }

            .check-times {
                flex-direction: column;
            }

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

@section('content')
    <!-- Booking Modal -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-card">
            <div class="modal-header">
                <h2><i class="fas fa-calendar-check"></i> Book This Hotel</h2>
                <button class="close-modal" id="closeModalBtn"><i class="fas fa-times"></i></button>
            </div>
            <form method="post" class="booking-form" id="bookingForm" action="{{route('front.booking.hotel')}}">
                @csrf
                <div class="form-row ">
                   <div class="input-group">
                       <label><i class="fas fa-clock"></i> Duration</label>
                       <input class="gotur-multi-datepicker" id="date" type="text"
                              name="booking_range" placeholder="Feb 5 - 5" >
                   </div>
                </div>
                <div class="form-row">
                    <div class="input-group">
                        <label><i class="fas fa-hotel"></i> Hotel</label>
                        <input type="hidden" name="hotel_id" value="{{$hotel->id}}">
                        <input type="text" value="{{$hotel->name}}" disabled>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-users"></i> Guests</label>
                        <input type="number" name="guest" id="guestsField" placeholder="Number of guests" min="1" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="input-group">
                        <label><i class="fas fa-bed"></i> Rooms</label>
                        <input type="number" name="rooms" id="roomsField" placeholder="Number of rooms" min="1" required>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-money-bill-wave"></i> Total Price</label>
                        <input type="text" name="total_price" id="totalField" placeholder="0" readonly>
                    </div>
                </div>
                @guest
                <div class="form-row">
                    <div class="input-group">
                        <label><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" name="full_name" id="userNameField" placeholder="Enter your full name" required>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-envelope"></i> Email Address</label>
                        <input type="email" name="email" id="userEmailField" placeholder="your@email.com" required>
                    </div>
                </div>
                @endguest
                <div class="form-row">
                    @guest
                    <div class="input-group">
                        <label><i class="fas fa-phone"></i> Phone Number</label>
                        <input type="tel" name="phone" id="userPhoneField" placeholder="+880XXXXXXXXX" required>
                    </div>
                    @endguest
                    <div class="input-group">
                        <label><i class="fas fa-comment"></i> Special Requests</label>
                        <textarea name="special_request" id="specialRequestsField" rows="2" placeholder="Any special requests?"></textarea>
                    </div>
                </div>
                <hr>
                <button type="submit" class="confirm-btn">
                    <span>Confirm Booking</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Lightbox Modal for Fullscreen Gallery -->
    <div class="lightbox-modal" id="lightboxModal">
        <div class="lightbox-close" id="lightboxClose">&times;</div>
        <div class="lightbox-prev" id="lightboxPrev"><i class="fas fa-chevron-left"></i></div>
        <div class="lightbox-next" id="lightboxNext"><i class="fas fa-chevron-right"></i></div>
        <div class="lightbox-content">
            <img id="lightboxImage" src="" alt="">
        </div>
        <div class="lightbox-counter" id="lightboxCounter"></div>
    </div>



    <!-- Hotel Details Section -->
    <section class="hotel-listing-details section-space">
        <div class="container">
            <!-- Hotel Header with Location and Share -->
            <div class="hotel-details__destination wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                <div class="hotel-details__destination__inner" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; margin-bottom: 30px;">
                    <div class="hotel-details__destination__left">
                        <h4 class="hotel-details__destination__title" style="font-size: 28px; font-weight: 700; margin-bottom: 10px;">{{$hotel->name}}</h4>
                        <div class="hotel-details__destination__revue">
                            <div class="hotel-details__destination__posted" style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                                <div style="display: flex; align-items: center; gap: 5px;">
                                    <i class="fas fa-map-marker-alt" style="color: var(--gotur-base);"></i>
                                    <span>{{$hotel->location}}</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 5px;">
                                    <i class="fas fa-address-card" style="color: var(--gotur-base);"></i>
                                    <span>{{$hotel->address}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hotel-details__destination__right">
                        <a href="javascript:void(0)" class="hotel-details__destination__btn gotur-btn">
                            Share <i class="icon-share"></i>
                        </a>
                        <div class="hotel-details__destination__social__list">
                            <a href="https://twitter.com/intent/tweet?text={{urlencode($hotel->name)}}&url={{urlencode(url()->current())}}" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current())}}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{urlencode(url()->current())}}&title={{urlencode($hotel->name)}}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://wa.me/?text={{urlencode($hotel->name . ' - ' . url()->current())}}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Gallery: Large Main + Thumbnail Grid -->
            @php
                $allImages = [];

                // Check if hotel has images relationship and get the first image as cover
                if($hotel->images && $hotel->images->count() > 0) {
                    // Get all image names from the relationship
                    foreach($hotel->images as $image) {
                        $allImages[] = $image->image_name; // Adjust field name if different (image, path, etc.)
                    }
                }
            @endphp

            @if(count($allImages) > 0)
                <div class="hotel-gallery wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='400ms'>
                    <!-- Main Large Image -->
                    <div class="gallery-main" id="galleryMain">
                        <img id="mainGalleryImage" src="{{asset('storage/'.$allImages[0])}}" alt="{{$hotel->name}}">
                        <div class="gallery-overlay" id="openLightboxBtn">
                            <i class="fas fa-expand-alt"></i>
                            <span>View All {{count($allImages)}} Photos</span>
                        </div>
                    </div>

                    <!-- Thumbnail Grid -->
                    <div class="gallery-thumbnails">
                        @foreach($allImages as $index => $image)
                            <div class="thumbnail-item {{$index == 0 ? 'active' : ''}}" data-index="{{$index}}" data-image="{{asset('storage/'.$image)}}">
                                <img src="{{asset('storage/'.$image)}}" alt="Gallery {{$index + 1}}">
                                @if($index == 3 && count($allImages) > 4)
                                    <div class="thumbnail-overlay">
                                        +{{count($allImages) - 4}} more
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Quick Info Cards -->
            <div class="hotel-details__info-area wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                <ul class="hotel-details__info-area__info list-unstyled">
                    <li>
                        <div class="hotel-details__info-area__icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="hotel-details__info-area__content">
                            <h5>Location</h5>
                            <p>{{$hotel->location}}</p>
                        </div>
                    </li>
                    <li>
                        <div class="hotel-details__info-area__icon">
                            <i class="fas fa-address-card"></i>
                        </div>
                        <div class="hotel-details__info-area__content">
                            <h5>Address</h5>
                            <p>{{Str::limit($hotel->address, 30)}}</p>
                        </div>
                    </li>
                    <li>
                        <div class="hotel-details__info-area__icon">
                            BDT
                        </div>
                        <div class="hotel-details__info-area__content">
                            <h5>Price Per Night</h5>
                            <p> {{number_format($hotel->price)}}</p>
                        </div>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="gotur-btn open-modal-btn" style="display: inline-flex; align-items: center; gap: 8px;">
                            Book Now <i class="fas fa-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="row gutter-y-30">
                <div class="col-lg-8">
                    <div class="hotel-details__content">
                        <!-- Check-in/Check-out Times -->
                        <div class="hotel-details__content__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                            <h4 class="hotel-details__title">Check-in & Check-out</h4>
                            <div class="check-times">
                                <div class="check-time-card">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span class="label">Check-in Time</span>
                                    <span class="time">{{$hotel->checkIn}}</span>
                                </div>
                                <div class="check-time-card">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span class="label">Check-out Time</span>
                                    <span class="time">{{$hotel->checkOut}}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="hotel-details__content__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='600ms'>
                            <h4 class="hotel-details__title">About This Hotel</h4>
                            <div class="hotel-details__text">
                                {!! $hotel->description ?? '<p>Experience comfort and luxury at '.$hotel->name.'. Our hotel offers modern amenities, exceptional service, and a prime location to make your stay unforgettable.</p>' !!}
                            </div>
                        </div>

                        <!-- Amenities -->
                        @if($hotel->amenities)
                            <div class="hotel-details__content__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='700ms'>
                                <h4 class="hotel-details__title">Hotel Amenities</h4>
                                <div class="amenities-grid">
                                    {!! $hotel->amenities !!}
                                </div>
                            </div>
                        @endif

                        <!-- Map Location -->
                        @if($hotel->map_url || $hotel->map_embed_code)
                            <div class="hotel-details__content__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='800ms'>
                                <h4 class="hotel-details__title">Location Map</h4>
                                <div class="map-container">
                                    @if($hotel->map_embed_code)
                                        {!! $hotel->map_embed_code !!}
                                    @elseif($hotel->map_url)
                                        <iframe src="{{$hotel->map_url}}" allowfullscreen loading="lazy"></iframe>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="hotel-details__sidebar">
                        <!-- Booking Card -->
                        <div class="hotel-details__sidebar__item wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                            <h4 class="hotel-details__sidebar__title">Book This Hotel</h4>
                            <div class="price-info" style="margin: 20px 0; text-align: center;">
                                <span class="price-big">
                                    {{config('app.currency', '$')}} {{number_format($hotel->price)}}
                                </span>
                                <span style="display: block; font-size: 14px; color: var(--gotur-text);">per night</span>
                            </div>
                            <button type="button" class="gotur-btn open-modal-btn" style="width: 100%; padding: 15px; font-size: 16px; font-weight: 700;">
                                Book Now <i class="fas fa-arrow-right"></i>
                            </button>
                            <div class="booking-info" style="margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--gotur-border-color);">
                                <p style="font-size: 13px; color: var(--gotur-text); margin-bottom: 8px;">
                                    <i class="fas fa-check-circle" style="color: var(--gotur-base); margin-right: 8px;"></i>
                                    Free cancellation up to 24 hours before check-in
                                </p>
                                <p style="font-size: 13px; color: var(--gotur-text); margin-bottom: 8px;">
                                    <i class="fas fa-credit-card" style="color: var(--gotur-base); margin-right: 8px;"></i>
                                    No prepayment needed - pay at the hotel
                                </p>
                                <p style="font-size: 13px; color: var(--gotur-text); margin-bottom: 0;">
                                    <i class="fas fa-shield-alt" style="color: var(--gotur-base); margin-right: 8px;"></i>
                                    Best price guarantee
                                </p>
                            </div>
                        </div>

                        <!-- Hotel Details Card -->
                        <div class="hotel-details__sidebar__item wow fadeInUp" data-wow-delay="500ms" data-wow-duration="1500ms">
                            <h4 class="hotel-details__sidebar__title">Hotel Details</h4>
                            <ul class="hotel-details-list" style="list-style: none; padding: 0;">
                                <li style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--gotur-border-color);">
                                    <span><i class="fas fa-tag"></i> Hotel ID:</span>
                                    <strong>#{{$hotel->id}}</strong>
                                </li>
                                <li style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--gotur-border-color);">
                                    <span><i class="fas fa-clock"></i> Check-in:</span>
                                    <strong>{{$hotel->checkIn}}</strong>
                                </li>
                                <li style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--gotur-border-color);">
                                    <span><i class="fas fa-clock"></i> Check-out:</span>
                                    <strong>{{$hotel->checkOut}}</strong>
                                </li>
                                <li style="display: flex; justify-content: space-between; padding: 12px 0;">
                                    <span><i class="fas fa-language"></i> Languages:</span>
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
            // Gallery Images Array
            const galleryImages = @json($allImages);
            const imageBasePath = "{{asset('storage/hotels/')}}";
            let currentImageIndex = 0;

            // Price calculation
            const roomPrice = {{$hotel->price}};
            const roomsField = document.getElementById('roomsField');
            const guestsField = document.getElementById('guestsField');
            const checkInField = document.getElementById('checkInField');
            const checkOutField = document.getElementById('checkOutField');
            const totalField = document.getElementById('totalField');

            function calculateTotal() {
                let rooms = parseInt(roomsField?.value) || 0;
                let nights = 1;

                if (checkInField && checkOutField && checkInField.value && checkOutField.value) {
                    const checkIn = new Date(checkInField.value);
                    const checkOut = new Date(checkOutField.value);
                    const diffTime = Math.abs(checkOut - checkIn);
                    nights = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    if (nights === 0) nights = 1;
                }

                let total = rooms * roomPrice * nights;
                if (totalField) totalField.value = total.toFixed(2);
            }

            if (roomsField) roomsField.addEventListener('input', calculateTotal);
            if (checkInField) checkInField.addEventListener('change', calculateTotal);
            if (checkOutField) checkOutField.addEventListener('change', calculateTotal);

            // Set default dates
            const tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            const dayAfter = new Date();
            dayAfter.setDate(dayAfter.getDate() + 2);

            if (checkInField) checkInField.value = tomorrow.toISOString().split('T')[0];
            if (checkOutField) checkOutField.value = dayAfter.toISOString().split('T')[0];
            if (roomsField) roomsField.value = 1;
            if (guestsField) guestsField.value = 2;

            setTimeout(calculateTotal, 100);

            // Gallery Functionality
            const mainImage = document.getElementById('mainGalleryImage');
            const thumbnails = document.querySelectorAll('.thumbnail-item');
            const openLightboxBtn = document.getElementById('openLightboxBtn');
            const lightboxModal = document.getElementById('lightboxModal');
            const lightboxImage = document.getElementById('lightboxImage');
            const lightboxClose = document.getElementById('lightboxClose');
            const lightboxPrev = document.getElementById('lightboxPrev');
            const lightboxNext = document.getElementById('lightboxNext');
            const lightboxCounter = document.getElementById('lightboxCounter');

            // Thumbnail click handler
            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    const index = parseInt(this.dataset.index);
                    const imageUrl = this.dataset.image;

                    // Update main image
                    if (mainImage) mainImage.src = imageUrl;

                    // Update active class
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    currentImageIndex = index;
                });
            });

            // Open lightbox
            function openLightbox(index) {
                currentImageIndex = index;
                updateLightboxImage();
                lightboxModal.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function updateLightboxImage() {
                if (galleryImages && galleryImages[currentImageIndex]) {
                    lightboxImage.src = imageBasePath + '/' + galleryImages[currentImageIndex];
                    lightboxCounter.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
                }
            }

            function nextImage() {
                if (currentImageIndex < galleryImages.length - 1) {
                    currentImageIndex++;
                    updateLightboxImage();
                }
            }

            function prevImage() {
                if (currentImageIndex > 0) {
                    currentImageIndex--;
                    updateLightboxImage();
                }
            }

            if (openLightboxBtn) {
                openLightboxBtn.addEventListener('click', () => openLightbox(currentImageIndex));
            }

            if (lightboxClose) {
                lightboxClose.addEventListener('click', () => {
                    lightboxModal.classList.remove('active');
                    document.body.style.overflow = '';
                });
            }

            if (lightboxPrev) lightboxPrev.addEventListener('click', prevImage);
            if (lightboxNext) lightboxNext.addEventListener('click', nextImage);

            // Keyboard navigation for lightbox
            document.addEventListener('keydown', function(e) {
                if (lightboxModal && lightboxModal.classList.contains('active')) {
                    if (e.key === 'ArrowLeft') prevImage();
                    if (e.key === 'ArrowRight') nextImage();
                    if (e.key === 'Escape') {
                        lightboxModal.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                }
            });

            // Close lightbox on overlay click
            if (lightboxModal) {
                lightboxModal.addEventListener('click', function(e) {
                    if (e.target === lightboxModal) {
                        lightboxModal.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                });
            }

            // Modal functionality
            const modalOverlay = document.getElementById('modalOverlay');
            const openBtns = document.querySelectorAll('.open-modal-btn');
            const closeBtn = document.getElementById('closeModalBtn');

            function openModal() {
                if (modalOverlay) modalOverlay.classList.add('active');
                calculateTotal();
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
        });
    </script>
@endpush
