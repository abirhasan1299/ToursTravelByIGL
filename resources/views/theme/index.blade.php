@extends('layout.theme')
@section('title', 'Home')

@push('css')
    <style>
        select{
            border: 0px;
        }
    </style>
@endpush
@section('content')

    <section class="main-slider-one" id="home">
        <div class="main-slider-one__item">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-8 col-md-10">
                        <div class="main-slider-one__content">
                            <h5 class="main-slider-one__sub-title main-three bw-split-in-top">Discover Your</h5>
                            <h2 class="main-slider-one__title main-three bw-split-in-down">
                                {{ $about->hero_header ?? 'Next Step' }}
                                <br> Destination
                            </h2>
                            <p class="main-slider-one__text main-three bw-split-in-down">
                                {{ $about->hero_detail ?? 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the Lorem ipsum dolor sit amet consectetur adipiscing elit.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Centered Search Form with Tabs -->
            <div class="main-slider-one__action-form centered">
                <div class="container">
                    <div class="main-slider-one__form centered-form">
                        <div class="banner-form wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                            <div class="container">
                                <!-- Tab Buttons -->
                                <div class="search-tabs">
                                    <button class="search-tab-btn active" data-tab="tour">
                                        <i class="fas fa-umbrella-beach"></i> Tours
                                    </button>
                                    <button class="search-tab-btn" data-tab="hotel">
                                        <i class="fas fa-hotel"></i> Hotels
                                    </button>
                                </div>

                                <!-- Tour Search Form -->
                                <form class="banner-form__wrapper search-form" id="tourSearchForm" action="{{ route('front.tour-list') }}" method="GET">
                                    <div class="banner-form row gutter-x-30 align-items-center">
                                        <div class="banner-form__control banner-form__col--1">
                                            <i class="icon icon-location"></i>
                                            <label for="tour_location">Location</label>
                                            <select id="location" name="location" class="selectpicker select2" id="tour_location">
                                                <option value="">All Locations</option>
                                                @foreach ($startLocations ?? [] as $s)
                                                    <option value="{{ $s }}">{{ $s }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="banner-form__control banner-form__col--2">
                                            <i class="icon icon-travle"></i>
                                            <label for="tour_type">Tour Type</label>
                                            <select id="tour_type" name="tour_type" class="selectpicker select2" id="tour_type">
                                                <option value="">All Types</option>
                                                @foreach ($tourTypes ?? [] as $t)
                                                    <option value="{{ $t }}">{{ Str::ucfirst($t) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="banner-form__control banner-form__control--date banner-form__col--3">
                                            <i class="icon icon-clock"></i>
                                            <label for="tour_date">Travel Date</label>
                                            <input class="gotur-multi-datepicker" id="tour_date" type="text" name="date" placeholder="Select Date">
                                        </div>
                                        <div class="banner-form__control banner-form__col--4">
                                            <i class="icon icon-group"></i>
                                            <label for="tour_guests">Travelers</label>
                                            <div class="qty-wrapper">
                                                <button type="button" class="banner-form__qty-minus sub" data-target="tour_guests">
                                                    <i class="icon-down-arrow"></i>
                                                </button>
                                                <input id="tour_guests" type="number" value="2" name="guests" min="1" max="20">
                                                <button type="button" class="banner-form__qty-plus add" data-target="tour_guests">
                                                    <i class="icon-down-arrow"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="banner-form__control banner-form__button banner-form__col--5">
                                            <button class="gotur-btn" type="submit">
                                                <i class="fas fa-search"></i> Search
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <!-- Hotel Search Form -->
                                <form class="banner-form__wrapper search-form" id="hotelSearchForm" action="{{ route('front.hotel-list') }}" method="GET" style="display: none;">
                                    <div class="banner-form row gutter-x-30 align-items-center">
                                        <div class="banner-form__control banner-form__col--1">
                                            <i class="icon icon-location"></i>
                                            <label for="hotel_location">Location</label>
                                            <select id="city" name="location" class="selectpicker select2" id="hotel_location">
                                                <option value="">All Locations</option>
                                                @foreach ($hotelLocations ?? [] as $location)
                                                    <option value="{{ $location }}">{{ $location }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="banner-form__control banner-form__col--2">
                                            <i class="fas fa-calendar-alt"></i>
                                            <label for="check_in">Check-in</label>
                                            <input type="date" name="check_in" id="check_in" class="date-input" placeholder="Check-in Date">
                                        </div>
                                        <div class="banner-form__control banner-form__col--3">
                                            <i class="fas fa-calendar-alt"></i>
                                            <label for="check_out">Check-out</label>
                                            <input type="date" name="check_out" id="check_out" class="date-input" placeholder="Check-out Date">
                                        </div>
                                        <div class="banner-form__control banner-form__col--4">
                                            <i class="icon icon-group"></i>
                                            <label for="hotel_guests">Guests</label>
                                            <div class="qty-wrapper">
                                                <button type="button" class="banner-form__qty-minus sub" data-target="hotel_guests">
                                                    <i class="icon-down-arrow"></i>
                                                </button>
                                                <input id="hotel_guests" type="number" value="2" name="guests" min="1" max="20">
                                                <button type="button" class="banner-form__qty-plus add" data-target="hotel_guests">
                                                    <i class="icon-down-arrow"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="banner-form__control banner-form__button banner-form__col--5">
                                            <button class="gotur-btn" type="submit">
                                                <i class="fas fa-search"></i> Search
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @push('css')
                <style>
                    /* Search Tabs Styles */
                    .search-tabs {
                        display: flex;
                        gap: 10px;
                        margin-bottom: 30px;
                        border-bottom: 2px solid var(--gotur-border-color, #E5E5E5);
                        padding-bottom: 0;
                    }

                    .search-tab-btn {
                        background: transparent;
                        border: none;
                        padding: 12px 30px;
                        font-size: 16px;
                        font-weight: 600;
                        color: var(--gotur-text, #595959);
                        cursor: pointer;
                        transition: all 0.3s ease;
                        position: relative;
                        border-radius: 30px 30px 0 0;
                        display: flex;
                        align-items: center;
                        gap: 8px;
                    }

                    .search-tab-btn i {
                        font-size: 18px;
                        transition: all 0.3s ease;
                    }

                    .search-tab-btn:hover {
                        color: var(--gotur-base, #63AB45);
                        background: rgba(99, 171, 69, 0.05);
                    }

                    .search-tab-btn.active {
                        color: var(--gotur-base, #63AB45);
                        background: var(--gotur-white, #fff);
                    }

                    .search-tab-btn.active::after {
                        content: '';
                        position: absolute;
                        bottom: -2px;
                        left: 0;
                        right: 0;
                        height: 3px;
                        background: var(--gotur-base, #63AB45);
                        border-radius: 3px;
                    }

                    /* Form Styles Enhancement */
                    .banner-form__control {
                        position: relative;
                        margin-bottom: 15px;
                    }

                    .banner-form__control i {
                        position: absolute;
                        left: 15px;
                        top: 50%;
                        transform: translateY(-50%);
                        color: var(--gotur-base, #63AB45);
                        font-size: 18px;
                        z-index: 1;
                        pointer-events: none;
                    }

                    .banner-form__control label {
                        position: absolute;
                        left: 45px;
                        top: -10px;
                        background: var(--gotur-white, #fff);
                        padding: 0 5px;
                        font-size: 12px;
                        font-weight: 600;
                        color: var(--gotur-base, #63AB45);
                        z-index: 1;
                        pointer-events: none;
                    }

                    .banner-form__control select,
                    .banner-form__control input {
                        width: 100%;
                        padding: 12px 15px 12px 45px;
                        border: 1px solid var(--gotur-border-color, #E5E5E5);
                        border-radius: 12px;
                        font-size: 14px;
                        font-family: var(--gotur-font, "Plus Jakarta Sans", sans-serif);
                        transition: all 0.3s ease;
                        background: var(--gotur-white, #fff);
                    }

                    .banner-form__control select:focus,
                    .banner-form__control input:focus {
                        outline: none;
                        border-color: var(--gotur-base, #63AB45);
                        box-shadow: 0 0 0 3px rgba(99, 171, 69, 0.1);
                    }

                    /* Quantity Input Styling */
                    .qty-wrapper {
                        position: relative;
                        display: flex;
                        align-items: center;
                    }

                    .banner-form__qty-minus,
                    .banner-form__qty-plus {
                        position: absolute;
                        width: 32px;
                        height: 32px;
                        border-radius: 8px;
                        background: var(--gotur-gray, #F3F8F6);
                        border: 1px solid var(--gotur-border-color, #E5E5E5);
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        transition: all 0.3s ease;
                        z-index: 2;
                    }

                    .banner-form__qty-minus {
                        left: 45px;
                        top: 50%;
                        transform: translateY(-50%);
                    }

                    .banner-form__qty-plus {
                        right: 10px;
                        top: 50%;
                        transform: translateY(-50%);
                    }

                    .banner-form__qty-minus i,
                    .banner-form__qty-plus i {
                        position: static;
                        transform: none;
                        font-size: 12px;
                        margin: 0;
                    }

                    .banner-form__qty-minus:hover,
                    .banner-form__qty-plus:hover {
                        background: var(--gotur-base, #63AB45);
                        border-color: var(--gotur-base, #63AB45);
                    }

                    .banner-form__qty-minus:hover i,
                    .banner-form__qty-plus:hover i {
                        color: var(--gotur-white, #fff);
                    }

                    .banner-form__control input[type="number"] {
                        padding-left: 85px;
                        text-align: center;
                        -moz-appearance: textfield;
                    }

                    .banner-form__control input[type="number"]::-webkit-inner-spin-button,
                    .banner-form__control input[type="number"]::-webkit-outer-spin-button {
                        -webkit-appearance: none;
                        margin: 0;
                    }

                    /* Date Input Styling */
                    .date-input {
                        cursor: pointer;
                    }

                    /* Button Styling */
                    .banner-form__button .gotur-btn {
                        width: 100%;
                        padding: 12px 24px;
                        font-weight: 700;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 8px;
                    }

                    /* Responsive Styles */
                    @media (max-width: 991px) {
                        .search-tabs {
                            justify-content: center;
                        }

                        .search-tab-btn {
                            padding: 10px 20px;
                            font-size: 14px;
                        }

                        .banner-form__control {
                            margin-bottom: 20px;
                        }

                        .banner-form__control select,
                        .banner-form__control input {
                            padding: 10px 12px 10px 45px;
                        }

                        .banner-form__qty-minus {
                            left: 45px;
                        }

                        .banner-form__control input[type="number"] {
                            padding-left: 85px;
                        }
                    }

                    @media (max-width: 768px) {
                        .search-tab-btn {
                            flex: 1;
                            justify-content: center;
                        }

                        .banner-form__control i {
                            left: 12px;
                        }

                        .banner-form__control label {
                            left: 40px;
                            font-size: 10px;
                        }

                        .banner-form__qty-minus {
                            left: 40px;
                        }
                    }

                    /* Animation for form switching */
                    .search-form {
                        transition: all 0.3s ease;
                    }

                    .search-form.fade-out {
                        opacity: 0;
                        transform: translateY(-10px);
                    }

                    .search-form.fade-in {
                        opacity: 1;
                        transform: translateY(0);
                    }
                </style>
            @endpush

            @push('js')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Tab switching functionality
                        const tabBtns = document.querySelectorAll('.search-tab-btn');
                        const tourForm = document.getElementById('tourSearchForm');
                        const hotelForm = document.getElementById('hotelSearchForm');

                        // Set default dates for hotel search
                        const today = new Date();
                        const tomorrow = new Date();
                        tomorrow.setDate(tomorrow.getDate() + 1);
                        const dayAfter = new Date();
                        dayAfter.setDate(dayAfter.getDate() + 2);

                        const checkInInput = document.getElementById('check_in');
                        const checkOutInput = document.getElementById('check_out');

                        if (checkInInput) {
                            checkInInput.value = tomorrow.toISOString().split('T')[0];
                            checkInInput.min = today.toISOString().split('T')[0];
                        }
                        if (checkOutInput) {
                            checkOutInput.value = dayAfter.toISOString().split('T')[0];
                            checkOutInput.min = tomorrow.toISOString().split('T')[0];
                        }

                        // Update check-out min date when check-in changes
                        if (checkInInput && checkOutInput) {
                            checkInInput.addEventListener('change', function() {
                                const checkInDate = new Date(this.value);
                                const minCheckOut = new Date(checkInDate);
                                minCheckOut.setDate(minCheckOut.getDate() + 1);
                                checkOutInput.min = minCheckOut.toISOString().split('T')[0];

                                if (new Date(checkOutInput.value) <= checkInDate) {
                                    checkOutInput.value = minCheckOut.toISOString().split('T')[0];
                                }
                            });
                        }

                        // Tab click handler
                        tabBtns.forEach(btn => {
                            btn.addEventListener('click', function() {
                                const tabId = this.dataset.tab;

                                // Update active class
                                tabBtns.forEach(b => b.classList.remove('active'));
                                this.classList.add('active');

                                // Show/hide forms with animation
                                if (tabId === 'tour') {
                                    hotelForm.style.display = 'none';
                                    tourForm.style.display = 'block';
                                    tourForm.classList.add('fade-in');
                                } else {
                                    tourForm.style.display = 'none';
                                    hotelForm.style.display = 'block';
                                    hotelForm.classList.add('fade-in');
                                }
                            });
                        });

                        // Quantity input handlers
                        function setupQuantityHandler(inputId, minusBtn, plusBtn) {
                            const input = document.getElementById(inputId);
                            if (!input) return;

                            const handleMinus = () => {
                                let value = parseInt(input.value);
                                if (value > parseInt(input.min) || 1) {
                                    input.value = value - 1;
                                    input.dispatchEvent(new Event('change'));
                                }
                            };

                            const handlePlus = () => {
                                let value = parseInt(input.value);
                                if (value < parseInt(input.max) || 20) {
                                    input.value = value + 1;
                                    input.dispatchEvent(new Event('change'));
                                }
                            };

                            if (minusBtn) minusBtn.addEventListener('click', handleMinus);
                            if (plusBtn) plusBtn.addEventListener('click', handlePlus);
                        }

                        // Setup tour guests quantity
                        const tourMinus = document.querySelector('#tourSearchForm .sub[data-target="tour_guests"]');
                        const tourPlus = document.querySelector('#tourSearchForm .add[data-target="tour_guests"]');
                        setupQuantityHandler('tour_guests', tourMinus, tourPlus);

                        // Setup hotel guests quantity
                        const hotelMinus = document.querySelector('#hotelSearchForm .sub[data-target="hotel_guests"]');
                        const hotelPlus = document.querySelector('#hotelSearchForm .add[data-target="hotel_guests"]');
                        setupQuantityHandler('hotel_guests', hotelMinus, hotelPlus);

                        // Form submission with validation
                        tourForm.addEventListener('submit', function(e) {
                            const location = document.getElementById('tour_location').value;
                            if (!location) {
                                e.preventDefault();
                                // Optional: Show warning or just submit with empty location
                                // this.submit(); // Uncomment to submit even without location
                            }
                        });

                        hotelForm.addEventListener('submit', function(e) {
                            const checkIn = document.getElementById('check_in').value;
                            const checkOut = document.getElementById('check_out').value;

                            if (!checkIn || !checkOut) {
                                e.preventDefault();
                                alert('Please select check-in and check-out dates');
                            } else if (new Date(checkIn) >= new Date(checkOut)) {
                                e.preventDefault();
                                alert('Check-out date must be after check-in date');
                            }
                        });

                        // Initialize datepickers if needed
                        if (typeof $.fn.datepicker !== 'undefined') {
                            $('.gotur-multi-datepicker').datepicker({
                                format: 'M d',
                                multidate: true,
                                multidateSeparator: ' - '
                            });
                        }
                    });
                </script>
            @endpush

            <div class="main-slider-one__destinations">
                <div class="container">
                    <div class="destinations-two__inner">
                        <div class="destinations-two__carousel gotur-owl__carousel gotur-owl__carousel--custom-nav gotur-owl__carousel--with-shadow owl-carousel owl-theme"
                            data-owl-nav-prev=".main-slider-one__carousel__nav--left"
                            data-owl-nav-next=".main-slider-one__carousel__nav--right"
                            data-owl-options='{
                        "items": 1,
                        "margin": 30,
                        "loop": true,
                        "smartSpeed": 700,
                        "nav": false,
                        "dots": false,
                        "autoplay": true,
                        "responsive": {
                            "0": {
                                "items": 1
                            },
                            "575": {
                                "items": 2
                            },
                            "768": {
                                "items": 2
                            },
                            "992": {
                                "items": 3
                            }
                        }
                    }'>
                            <div class="item">
                                <div class="destinations-card-two wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='100ms'>
                                    <div class="destinations-card-two__thumb">
                                        <img src="{{ asset('assets/images/main-slider/hero-1-1-image.jpg') }}"
                                            alt="destinations image">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="destinations-card-two wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='100ms'>
                                    <div class="destinations-card-two__thumb">
                                        <img src="{{ asset('assets/images/main-slider/hero-1-2-image.jpg') }}"
                                            alt="destinations image">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="destinations-card-two wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='100ms'>
                                    <div class="destinations-card-two__thumb">
                                        <img src="{{ asset('assets/images/main-slider/hero-1-3-image.jpg') }}"
                                            alt="destinations image">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="destinations-card-two wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='100ms'>
                                    <div class="destinations-card-two__thumb">
                                        <img src="{{ asset('assets/images/main-slider/hero-1-1-image.jpg') }}"
                                            alt="destinations image">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="destinations-card-two wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='100ms'>
                                    <div class="destinations-card-two__thumb">
                                        <img src="{{ asset('assets/images/main-slider/hero-1-2-image.jpg') }}"
                                            alt="destinations image">
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="destinations-card-two wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='100ms'>
                                    <div class="destinations-card-two__thumb">
                                        <img src="{{ asset('assets/images/main-slider/hero-1-3-image.jpg') }}"
                                            alt="destinations image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-slider-one__destinations__hover">
                    <img src="{{ asset('assets/images/shapes/hero-1-1-hover.png') }}" alt="destinations image">
                </div>
            </div>

            <div class="main-slider-one__bottom__nav">
                <button class="main-slider-one__carousel__nav--left"><span class="icon-arrow-left"></span></button>
                <button class="main-slider-one__carousel__nav--right"><span class="icon-arrow-right"></span></button>
            </div>

            <div class="main-slider-one__element">
                <img src="{{ asset('assets/images/shapes/hero-1-2-hover.png') }}" alt="element">
            </div>
            <div class="main-slider-one__element-one">
                <img src="{{ asset('assets/images/shapes/hero-shapr-1-2-2.png') }}" alt="element">
            </div>
            <div class="main-slider-one__element-two">
                <img src="{{ asset('assets/images/shapes/hero-shapr-1-3.png') }}" alt="element">
            </div>
            <div class="main-slider-one__element-three">
                <img src="{{ asset('assets/images/shapes/hero-shapr-1-2-1.png') }}" alt="element">
            </div>
            <div class="main-slider-one__element-four"></div>
            <div class="main-slider-one__element-five">
                <img src="{{ asset('assets/images/shapes/hero-shapr-1-2-a.png') }}" alt="element">
            </div>
        </div>
    </section><!-- /.home section Header-->

    <section class="about-two about-two--two section-space" id="about">
        <div class="container">
            <div class="row gutter-y-40">
                <div class="col-lg-6">
                    <div class="about-two__thumb wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='300ms'>
                        <div class="about-two__thumb__item  ">
                            <img src="{{ asset('assets/images/about/about-2-1.jpg') }}" alt="gotur image">
                        </div><!-- /.about-two__thumb__item -->
                        <div class="about-two__thumb__item-small  ">
                            <img src="{{ asset('assets/images/about/about-s-2-1.jpg') }}" alt="gotur image">
                        </div><!-- /.about-two__thumb__item -->
                        <div class="about-two__thumb__funfact">
                            <div class="about-two__thumb__funfact__icon">
                                <i class="icon-icon-4"></i>
                            </div><!-- /.about-two__thumb__funfact__icon -->
                            <div class="about-two__thumb__funfact__content count-box">
                                <h2 class="about-two__thumb__funfact__count">
                                    <span class="count-text" data-stop="{{ $about->exp_years }}" data-speed="2000">
                                    </span>
                                    <span>Years</span>
                                </h2><!-- /.about-two__thumb__funfact__count -->
                                <p class="about-two__thumb__funfact__text">Of Experience</p>
                                <!-- /.about-two__thumb__funfact__text -->
                            </div><!-- /.about-two__thumb__funfact__content -->
                        </div><!-- /.about-two__thumb__funfact -->
                        <div class="about-two__thumb__item-element">
                            <img src="{{ asset('assets/images/shapes/corki.png') }}" alt=" image">
                        </div><!-- /.about-two__thumb__item -->
                    </div><!-- /.about-two__left -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="about-two__right">
                        <div class="sec-title  ">
                            <h6 class="sec-title__tagline bw-split-in-right">About company</h6>
                            <!-- /.sec-title__tagline -->
                            <h3 class="sec-title__title bw-split-in-left">Great Opportunity for Adventure & Travels</h3>
                            <!-- /.sec-title__title -->
                        </div><!-- /.sec-title -->
                        <p class="about-two__top__text wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                            {{ $about->company_title ?? 'Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the Lorem ipsum dolor sit amet consectetur adipiscing elit.' }}
                        </p><!-- /.about-two__top__text -->
                        <div class="about-two__feature">
                            <div class="row gutter-y-20 gutter-x-20">
                                <div class="col-xl-6 col-lg-12 col-md-6 wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='300ms'>
                                    <div class="about-two__feature-vestion">
                                        <div class="about-two__feature_icon">
                                            <i class="icon-flag"></i>
                                        </div><!-- /.about-two__feature_icon -->
                                        <div class="about-two__feature-content">
                                            <h5 class="about-two__feature-title">Trusted travel guide</h5>
                                            <!-- /.about-two__feature-title -->
                                            <p class="about-two__feature-text">Aliquam erat volutpat Nullam imperdiet</p>
                                            <!-- /.about-two__feature-text -->
                                        </div><!-- /.about-two__feature-content -->
                                    </div><!-- /.about-two__feature-vestion -->
                                </div><!-- /.col-xl-6 col-lg-12 col-md-6 -->
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="about-two__feature-vestion wow fadeInUp" data-wow-duration='1500ms'
                                        data-wow-delay='400ms'>
                                        <div class="about-two__feature_icon">
                                            <i class="icon-misstion"></i>
                                        </div><!-- /.about-two__feature_icon -->
                                        <div class="about-two__feature-content">
                                            <h5 class="about-two__feature-title">Mission & Vision</h5>
                                            <!-- /.about-two__feature-title -->
                                            <p class="about-two__feature-text">
                                                {{ $about->mv ?? 'Ut vehiculadictumst. Maecenas ante. Step' }}</p>
                                            <!-- /.about-two__feature-text -->
                                        </div><!-- /.about-two__feature-content -->
                                    </div><!-- /.about-two__feature-vestion -->
                                </div><!-- /.col-xl-6 col-lg-12 col-md-6 -->
                            </div><!-- /.row -->
                        </div><!-- /.about-two__feature -->
                        <div class="about-two__button wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>

                            <div class="about-two__button__author">
                                <div class="about-two__button__author__thumb">
                                    <img src="{{ asset('storage/author_img/' . $about->author_img) }}" alt="author">
                                </div><!-- /.about-two__button__call__icon -->
                                <div class="about-two__button__author__content">
                                    <h5 class="about-two__button__author__name">{{ $about->author_name ?? 'TITAN KONOK' }}
                                    </h5>
                                    <span
                                        class="about-two__button__author__dec">{{ $about->author_designation ?? 'Designation' }}</span><!-- /.about-two__button__author__dec -->
                                </div><!-- /.about-two__button__call__content -->
                            </div><!-- /.about-two__button__call -->
                        </div><!-- /.about-two__button -->
                    </div><!-- /.about-two__right -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
        <div class="client-carousel  wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>

        </div><!-- /.client-carousel -->
        <div class="about-two__element-one">
            <img src="{{ asset('assets/images/shapes/about-1-1.png') }}" alt>
        </div><!-- /.about-two__element-one -->
        <div class="about-two__element-two">
            <img src="{{ asset('assets/images/shapes/corki.png') }}" alt="gotur image">
        </div><!-- /.about-two__element-one -->
    </section><!-- /.about-two -->

    <section class="destination-filter section-space" id="destination">
        <div class="container">
            <div class="destination-filter__top">
                <div class="sec-title text-center">
                    <h6 class="sec-title__tagline bw-split-in-right">Popular Destination</h6><!-- /.sec-title__tagline -->
                    <h3 class="sec-title__title bw-split-in-left">Popular <span> Destinations</span></h3>
                    <!-- /.sec-title__title -->
                </div><!-- /.sec-title -->
                <p class="destination-filter__top__text">The island of Crete offers a rare mix of splendid beaches, amazing
                    mountain landscap, vibrant towns and cosy villages inhabited by warm-hearted locals, all this spiced</p>
                <!-- /.destination-filter__top__text -->
            </div><!-- /.destination-filter__top -->
            <div class="tabs-box">
                <div class="destination-filter__btn tab-buttons">
                    <button data-tab="#itemOne" class="tab-btn gotur-btn">Europe</button>
                    <button data-tab="#itemTwo" class="tab-btn gotur-btn active-btn">Asia</button>
                    <button data-tab="#itemThree" class="tab-btn gotur-btn">Africa</button>
                    <button data-tab="#itemFour" class="tab-btn gotur-btn">South America</button>
                    <button data-tab="#itemFive" class="tab-btn gotur-btn">Australia</button>
                </div><!-- /.tab-buttons -->
                <div class="tabs-content">
                    <div class="item tab" id="itemOne">
                        <div class="row gutter-y-20 gutter-x-20">
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='100ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{ asset('assets/images/destination/destination-1-1.jpg') }}"
                                            alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a
                                                href="destination-details.html">Bangkok</a></h3>
                                        <!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='300ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{ asset('assets/images/destination/destination-1-2.jpg') }}"
                                            alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a
                                                href="destination-details.html">Tokyo</a></h3>
                                        <!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='500ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{ asset('assets/images/destination/destination-1-3.jpg') }}"
                                            alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a
                                                href="destination-details.html">Kashmir</a></h3>
                                        <!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='600ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{ asset('assets/images/destination/destination-1-4.jpg') }}"
                                            alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a
                                                href="destination-details.html">Indonesia</a></h3>
                                        <!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.item -->
                    <div class="item tab active-tab" id="itemTwo">
                        <div class="row gutter-y-20 gutter-x-20">
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='100ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{ asset('assets/images/destination/destination-1-1.jpg') }}"
                                            alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a
                                                href="destination-details.html">Bangkok</a></h3>
                                        <!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='300ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{ asset('assets/images/destination/destination-1-2.jpg') }}"
                                            alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a
                                                href="destination-details.html">Tokyo</a></h3>
                                        <!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='500ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{ asset('assets/images/destination/destination-1-3.jpg') }}"
                                            alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a
                                                href="destination-details.html">Kashmir</a></h3>
                                        <!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='600ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{ asset('assets/images/destination/destination-1-4.jpg') }}"
                                            alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a
                                                href="destination-details.html">Indonesia</a></h3>
                                        <!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.item -->
                    <div class="item tab" id="itemThree">
                        <div class="row gutter-y-20 gutter-x-20">
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='100ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{ asset('assets/images/destination/destination-1-1.jpg') }}"
                                            alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a
                                                href="destination-details.html">Bangkok</a></h3>
                                        <!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.item -->
                    <div class="item tab" id="itemFour">
                        <div class="row gutter-y-20 gutter-x-20">
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='100ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{ asset('assets/images/destination/destination-1-1.jpg') }}"
                                            alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a
                                                href="destination-details.html">Bangkok</a></h3>
                                        <!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div>


                        </div><!-- /.row -->
                    </div><!-- /.item -->
                    <div class="item tab" id="itemFive">
                        <div class="row gutter-y-20 gutter-x-20">
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='100ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{ asset('assets/images/destination/destination-1-1.jpg') }}"
                                            alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a
                                                href="destination-details.html">Bangkok</a></h3>
                                        <!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms'
                                    data-wow-delay='300ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{ asset('assets/images/destination/destination-1-2.jpg') }}"
                                            alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a
                                                href="destination-details.html">Tokyo</a></h3>
                                        <!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.item -->
                </div><!-- /.tabs-content -->
            </div><!-- /.tabs-box -->
        </div><!-- /.container -->
        <div class="destination-filter__element">
            <img src="{{ asset('assets/images/shapes/plan.png') }}" alt>
        </div><!-- /.destination-filter__element -->
        <div class="destination-filter__element-two">
            <img src="{{ asset('assets/images/shapes/monjil.png') }}" alt>
        </div><!-- /.destination-filter__element -->
    </section><!-- /.destination-filter -->
    <section class="cta-five section-space">
        <div class="cta-five__inner">
            <div class="cta-five__bg wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms"
                style="background-image: url(assets/images/backgrounds/cta-1-1.jpg);"></div><!-- /.cta-five__bg -->
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6">
                        <div class="cta-five__funfact wow fadeInLeft" data-wow-duration="1500ms" data-wow-delay="400ms">
                            <ul class="cta-five__funfact__list list-unstyled">
                                <li class="cta-five__funfact__item">
                                    <div class="cta-five__funfact__icon">
                                        <i class="icon-travel-and-tourism"></i>
                                    </div><!-- /.cta-five__funfact__icon -->
                                    <div class="cta-five__funfact__content count-box">
                                        <h3 class="cta-five__funfact__count">
                                            <span class="count-text" data-stop="{{ $about->tour_success ?? '30' }}"
                                                data-speed="1500"></span>
                                            <span>k+</span>
                                        </h3><!-- /.cta-five__funfact__count -->
                                        <p class="cta-five__funfact__text">Tours success</p>
                                        <!-- /.cta-five__funfact__text -->
                                    </div><!-- /.cta-five__funfact__content -->
                                </li><!-- /.cta-five__funfact__item -->
                                <li class="cta-five__funfact__item">
                                    <div class="cta-five__funfact__icon">
                                        <i class="icon-tourist"></i>
                                    </div><!-- /.cta-five__funfact__icon -->
                                    <div class="cta-five__funfact__content count-box">
                                        <h3 class="cta-five__funfact__count">
                                            <span class="count-text" data-stop="{{ $about->happy_traveler ?? '30' }}"
                                                data-speed="1500"></span>
                                            <span>+</span>
                                        </h3><!-- /.cta-five__funfact__count -->
                                        <p class="cta-five__funfact__text">Happy Traveler</p>
                                        <!-- /.cta-five__funfact__text -->
                                    </div><!-- /.cta-five__funfact__content -->
                                </li><!-- /.cta-five__funfact__item -->
                                <li class="cta-five__funfact__item">
                                    <div class="cta-five__funfact__icon">
                                        <i class="icon-trophy"></i>
                                    </div><!-- /.cta-five__funfact__icon -->
                                    <div class="cta-five__funfact__content count-box">
                                        <h3 class="cta-five__funfact__count">
                                            <span class="count-text" data-stop="{{ $about->award ?? '30' }}"
                                                data-speed="1500"></span>
                                            <span>+</span>
                                        </h3><!-- /.cta-five__funfact__count -->
                                        <p class="cta-five__funfact__text">Awards Winning</p>
                                        <!-- /.cta-five__funfact__text -->
                                    </div><!-- /.cta-five__funfact__content -->
                                </li><!-- /.cta-five__funfact__item -->
                                <li class="cta-five__funfact__item">
                                    <div class="cta-five__funfact__icon">
                                        <i class="icon-quality"></i>
                                    </div><!-- /.cta-five__funfact__icon -->
                                    <div class="cta-five__funfact__content count-box">
                                        <h3 class="cta-five__funfact__count">
                                            <span class="count-text" data-stop="{{ $about->exp_years ?? '30' }}"
                                                data-speed="1500"></span>
                                            <span>+</span>
                                        </h3><!-- /.cta-five__funfact__count -->
                                        <p class="cta-five__funfact__text">Our Experience</p>
                                        <!-- /.cta-five__funfact__text -->
                                    </div><!-- /.cta-five__funfact__content -->
                                </li><!-- /.cta-five__funfact__item -->
                            </ul><!-- /.cta-five__funfact__list -->
                        </div><!-- /.cta-five__thumb -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="cta-five__shape wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="400ms">
                            <img src="{{ asset('assets/images/shapes/cta-1-1.png') }}" alt>
                        </div><!-- /.cta-five__content -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.cta-five__inner -->
    </section><!-- /.cta-five -->

    <section class="why-choose-one section-space-bottom">
        <div class="container">
            <div class="row align-items-center gutter-y-40">
                <div class="col-lg-6">
                    <div class="why-choose-one__thumb wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='400ms'>
                        <div class="row align-items-center gutter-y-30">
                            <div class="col-lg-6">
                                <div class="why-choose-one__thumb__item-one  ">
                                    <img src="{{ asset('assets/images/about/about-s-8-2.jpg') }}" alt="image">
                                </div><!-- /.why-choose-one__thumb__item -->
                                <div class="why-choose-one__thumb__item-one  ">
                                    <img src="{{ asset('assets/images/about/about-s-8-1.jpg') }}" alt="image">
                                </div><!-- /.why-choose-one__thumb__item -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="why-choose-one__thumb__item-two  ">
                                    <img src="{{ asset('assets/images/about/about-8-1.jpg') }}" alt="image">
                                </div><!-- /.why-choose-one__thumb__item -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.why-choose-one__thumb -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="why-choose-one__content">
                        <div class="sec-title ">
                            <h6 class="sec-title__tagline bw-split-in-right">Why Choose Us</h6>
                            <!-- /.sec-title__tagline -->
                            <h3 class="sec-title__title bw-split-in-left"> Get The <span>Best Travel</span> Experience With
                                Gotur</h3><!-- /.sec-title__title -->
                        </div><!-- /.sec-title -->
                        <p class="why-choose-one__content__text wow fadeInLeft" data-wow-duration='1500ms'
                            data-wow-delay='400ms'>It is a long established fact that a reader will be distracted the
                            readable content of a page when looking at layout the point.</p>
                        <!-- /.why-choose-one__content__text -->
                        <ul class="why-choose-one__list">
                            <li>
                                <div class="why-choose-one__list__item wow fadeInLeft" data-wow-duration='1500ms'
                                    data-wow-delay='200ms'>
                                    <div class="why-choose-one__icon">
                                        <i class="icon-flag"></i>
                                    </div><!-- /.why-choose-one__icon -->
                                    <h5 class="why-choose-one__title">Trusted travel guide</h5>
                                    <!-- /.why-choose-one__title -->
                                </div><!-- /.why-choose-one__list__item -->
                            </li>
                            <li>
                                <div class="why-choose-one__list__item wow fadeInLeft" data-wow-duration='1500ms'
                                    data-wow-delay='400ms'>
                                    <div class="why-choose-one__icon">
                                        <i class="icon-calender"></i>
                                    </div><!-- /.why-choose-one__icon -->
                                    <h5 class="why-choose-one__title">Instant Booking</h5><!-- /.why-choose-one__title -->
                                </div><!-- /.why-choose-one__list__item -->
                            </li>
                            <li>
                                <div class="why-choose-one__list__item wow fadeInLeft" data-wow-duration='1500ms'
                                    data-wow-delay='600ms'>
                                    <div class="why-choose-one__icon">
                                        <i class="icon-travle1"></i>
                                    </div><!-- /.why-choose-one__icon -->
                                    <h5 class="why-choose-one__title">World Class Travel</h5>
                                    <!-- /.why-choose-one__title -->
                                </div><!-- /.why-choose-one__list__item -->
                            </li>
                            <li>
                                <div class="why-choose-one__list__item wow fadeInLeft" data-wow-duration='1500ms'
                                    data-wow-delay='800ms'>
                                    <div class="why-choose-one__icon">
                                        <i class="icon-perasut"></i>
                                    </div><!-- /.why-choose-one__icon -->
                                    <h5 class="why-choose-one__title">Paragliding Tour</h5><!-- /.why-choose-one__title -->
                                </div><!-- /.why-choose-one__list__item -->
                            </li>
                        </ul><!-- /.why-choose-one__list -->
                    </div><!-- /.why-choose-one__content -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
        <div class="why-choose-one__element">
            <img src="{{ asset('assets/images/shapes/perasut-1-1.png') }}" alt>
        </div><!-- /.why-choose-one__element -->
    </section><!-- /.why-choose-one -->


@endsection
@push('js')
    <script>
        // Counter animation
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter');
            const speed = 200;

            counters.forEach(counter => {
                const updateCount = () => {
                    const target = parseInt(counter.getAttribute('data-target'));
                    const count = parseInt(counter.innerText);
                    const increment = Math.ceil(target / speed);

                    if (count < target) {
                        counter.innerText = count + increment;
                        setTimeout(updateCount, 20);
                    } else {
                        counter.innerText = target;
                    }
                };

                // Start counter when element is in view
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            updateCount();
                            observer.unobserve(entry.target);
                        }
                    });
                });

                observer.observe(counter);
            });

            // Datepicker initialization
            if ($('.datepicker-input').length) {
                $('.datepicker-input').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoUpdateInput: false,
                    locale: {
                        format: 'DD MMM YYYY'
                    }
                });

                $('.datepicker-input').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD MMM YYYY'));
                });
            }
        });
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Message',
                text: '{{ session('success') }}'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Message',
                text: '{{ session('error') }}'
            });
        @endif

        // Re-initialize Bootstrap Select after page load
        jQuery(document).ready(function($) {
            // Destroy any existing selectpickers
            $('.selectpicker').selectpicker('destroy');

            // Re-initialize
            $('.selectpicker').selectpicker({
                style: 'btn-default',
                size: 4,
                width: '100%',
                container: 'body'
            });

            // Refresh on window resize
            $(window).on('resize', function() {
                $('.selectpicker').selectpicker('refresh');
            });

            // Ensure dropdowns are clickable
            $('.bootstrap-select').on('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#location').select2({
                placeholder: "Select ",
                allowClear: true
            });
            $('#tour_type').select2({
                placeholder: "Select",
                allowClear: true
            });
            $('#city').select2({
                placeholder: "Select",
                allowClear: true
            });
        });
    </script>
@endpush
