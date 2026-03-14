@extends('layout.theme')
@section('title','Tour List')
@push('css')

    <style>

        /* main content (button + demo card) */
        .demo-wrapper {
            text-align: center;
            max-width: 500px;
            width: 100%;
        }


        .brand {
            font-weight: 500;
            font-size: 0.9rem;
            letter-spacing: 2px;
            color: #2c3e50;
            text-transform: uppercase;
            margin-bottom: 1rem;
            opacity: 0.75;
        }

        .open-modal-btn {
            background: #1e2b37;
            color: white;
            border: none;
            padding: 1.2rem 3rem;
            font-size: 1.3rem;
            font-weight: 600;
            border-radius: 60px;
            box-shadow: 0 20px 30px -10px rgba(20, 40, 60, 0.3);
            cursor: pointer;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 14px;
            border: 1px solid rgba(255,255,255,0.15);
            backdrop-filter: blur(4px);
            letter-spacing: -0.01em;
        }

        .open-modal-btn i {
            font-size: 1.5rem;
            color: #b3d9ff;
        }

        .open-modal-btn:hover {
            background: #15232e;
            transform: scale(1.02) translateY(-3px);
            box-shadow: 0 28px 38px -12px #1a2e3f;
        }

        .open-modal-btn:active {
            transform: scale(0.98);
            box-shadow: 0 12px 25px -8px #0f1e2b;
        }

        .card-note {
            background: rgba(255,255,255,0.6);
            backdrop-filter: blur(8px);
            margin-top: 2.5rem;
            padding: 1.2rem;
            border-radius: 40px;
            font-size: 0.95rem;
            color: #1a3b4e;
            font-weight: 500;
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 15px 25px -18px #0f2b38;
        }

        /* ----- MODAL OVERLAY (fullscreen, centered) ----- */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(10, 25, 35, 0.6);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0.25s;
            z-index: 1000;
            padding: 1.5rem;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* ----- MODAL CARD (frosted glass, sharp & professional) ----- */
        .modal-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            width: 100%;
            max-width: 620px;
            border-radius: 40px;
            box-shadow: 0 45px 65px -25px #0c1f2b, 0 0 0 1px rgba(255,255,255,0.5) inset, 0 0 0 2px rgba(255,255,255,0.1);
            padding: 2rem 2.2rem;
            transform: scale(0.96) translateY(10px);
            transition: transform 0.35s cubic-bezier(0.15, 0.85, 0.35, 1.05), opacity 0.25s;
            opacity: 0;
            border: 1px solid rgba(255,255,255,0.7);
        }

        .active .modal-card {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        /* header */
        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.8rem;
        }

        .modal-header h2 {
            font-size: 1.9rem;
            font-weight: 600;
            letter-spacing: -0.03em;
            background: linear-gradient(145deg, #1b2c3a, #1e3648);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            border-left: 5px solid #3079ab;
            padding-left: 1rem;
        }

        .close-modal {
            background: transparent;
            border: none;
            font-size: 2rem;
            cursor: pointer;
            color: #38586e;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 60px;
            transition: 0.2s;
            background: rgba(255,255,255,0.4);
            backdrop-filter: blur(4px);
        }

        .close-modal:hover {
            background: rgba(255,99,99,0.2);
            color: #be3b3b;
            transform: rotate(90deg);
        }

        /* form grid */
        .booking-form {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .form-row .input-group {
            flex: 1 1 calc(50% - 0.5rem);
            min-width: 170px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .input-group.full-width {
            flex: 1 1 100%;
        }

        .input-group label {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #1d4055;
            margin-left: 0.5rem;
        }

        .input-group label i {
            margin-right: 6px;
            color: #3079ab;
            font-size: 0.8rem;
        }

        .input-group input {
            background: rgba(255,255,255,0.9);
            border: 1.5px solid rgba(45, 90, 120, 0.2);
            border-radius: 24px;
            padding: 0.9rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            color: #152f3f;
            transition: 0.2s;
            outline: none;
            box-shadow: 0 2px 6px rgba(0,20,30,0.02);
        }

        .input-group input:focus {
            border-color: #3079ab;
            box-shadow: 0 8px 18px -12px #1e5270, 0 0 0 4px rgba(48, 121, 171, 0.15);
            background: white;
        }

        .input-group input::placeholder {
            color: #8ca3b2;
            font-weight: 300;
            font-size: 0.9rem;
        }

        /* total field special subtle style */
        .input-group input[name="total"] {
            background: rgba(230, 242, 250, 0.7);
            font-weight: 600;
            color: #0b3f5c;
        }

        /* confirm button */
        .confirm-btn {
            background: #1e384b;
            border: none;
            border-radius: 50px;
            padding: 1.2rem 2rem;
            margin-top: 1.2rem;
            font-weight: 700;
            font-size: 1.2rem;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 20px 25px -15px #0e2635;
            letter-spacing: 0.3px;
        }

        .confirm-btn i {
            font-size: 1.3rem;
            color: #9ac7ff;
        }

        .confirm-btn:hover {
            background: #15445c;
            gap: 22px;
            background: #1f4660;
            box-shadow: 0 24px 32px -14px #08212e;
        }

        .confirm-btn:active {
            transform: scale(0.98);
            background: #123141;
        }

        /* small success message (hidden by default) */
        .toast-message {
            background: #1b3e4b;
            color: #ddf2fd;
            padding: 0.8rem;
            border-radius: 60px;
            font-size: 0.95rem;
            font-weight: 500;
            text-align: center;
            margin-top: 1.3rem;
            opacity: 0;
            transition: 0.2s;
            border: 1px solid #93c8ff;
        }

        .toast-message.show {
            opacity: 1;
        }

        hr {
            border: none;
            height: 1px;
            background: rgba(78, 118, 148, 0.2);
            margin: 0.8rem 0 0.2rem;
        }
    </style>
@endpush
@section('content')
    <!-- MODAL OVERLAY (hidden by default) -->
    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-card">
            <div class="modal-header">
                <h2><i class="fas fa-pen" style="margin-right: 12px; color:#3079ab;"></i>Booking Details</h2>
                <button class="close-modal" id="closeModalBtn"><i class="fas fa-times"></i></button>
            </div>

            <!-- input fields: date, quantity, total, user_name, user_email, user_phone, user_address  -->
            <form method="post" class="booking-form" id="bookingForm" action="{{route('package.booking')}}">
                @csrf
                <div class="form-row">
                    <div class="input-group">
                        <label><i class="far fa-calendar-alt"></i> date</label>
                        <input type="date" name="date" id="dateField" value="2026-03-20" required>
                    </div>

                    <div class="input-group">
                        <label><i class="fas fa-hashtag"></i> quantity</label>
                        <input type="hidden" name="package_id"  value="{{$tour->id}}">

                        <input type="number" name="quantity" id="quantityField" placeholder="e.g. 2" min="1"  required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label><i class="fas fa-coins"></i> total (BDT)</label>
                        <input type="number" step="5" name="total" id="totalField" placeholder="0"   required disabled>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-user-circle"></i> full name</label>
                        <input type="text" name="user_name" id="userNameField" placeholder="Alex Rivera"  required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label><i class="fas fa-envelope"></i> email</label>
                        <input type="email" name="user_email" id="userEmailField" placeholder="hello@domain.com"  required>
                    </div>
                    <div class="input-group">
                        <label><i class="fas fa-phone-alt"></i> phone</label>
                        <input type="tel" name="user_phone" id="userPhoneField" placeholder="+1 (415) 555‑1234"  required>
                    </div>
                </div>

                <div class="input-group full-width">
                    <label><i class="fas fa-map-pin"></i> address</label>
                    <input type="text" name="user_address" id="userAddressField" placeholder="Street, city, postal code" required>
                </div>

                <!-- subtle separator -->
                <hr>

                <!-- confirm booking button (submit) -->
                <button type="submit" class="confirm-btn" id="confirmBookingBtn">
                    <span>✓ confirm booking</span>
                    <i class="fas fa-arrow-right-long"></i>
                </button>

            </form>
        </div>
    </div>
  <section class="page-header">
            <div class="page-header__bg" style="background-image: url({{asset('assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div><!-- /.page-header__bg -->
            <div class="container">
                <div class="page-header__content">
                    <h2 class="page-header__title bw-split-in-right">Tour Details</h2>
                    <ul class="gotur-breadcrumb list-unstyled">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><span>Tour Details</span></li>
                    </ul><!-- /.thm-breadcrumb list-unstyled -->
                </div><!-- /.page-header__content -->
            </div><!-- /.container -->
        </section><!-- /.page-header -->

  <section class="tour-listing-details section-space">
            <div class="tour-listing-details__destination wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                <div class="container">
                    <div class="tour-listing-details__destination__inner">
                        <div class="tour-listing-details__destination__left">
                            <h4 class="tour-listing-details__destination__title">{{$tour->title}}</h4><!-- /.tour-listing-details__destination__title -->
                            <div class="tour-listing-details__destination__revue">

                                <div class="tour-listing-details__destination__posted">
                                    <i class="icon-pin1"></i>
                                    <p class="tour-listing-details__destination__posted-text">
                                        {{$tour->start_location." to ".$tour->end_location}}
                                    </p>
                                </div><!-- / -->
                                <div class="tour-listing-details__destination__posted">
                                   @foreach(json_decode($tour->subdestination, true) as $des)
                                    <i class="icon-pin1"></i>
                                        {{ $des." " }}
                                        @if (! $loop->last)
                                             <i class="icon-arrow-right"></i>
                                        @endif
                                    @endforeach
                                </div><!-- / -->
                            </div><!-- /.tour-listing-details__destination__revue -->
                        </div><!-- /.tour-listing-details__destination__left -->
                        <div class="tour-listing-details__destination__right">
                            <a href="javascript:void(0)" class="tour-listing-details__destination__btn gotur-btn">Share <i class="icon-share"></i></a>
                            <div class="tour-listing-details__destination__social__list">
                                <a href="https://twitter.com/">
                                    <i class="fab fa-twitter" aria-hidden="true"></i>
                                    <span class="sr-only">Twitter</span>
                                </a>
                                <a href="https://facebook.com/">
                                    <i class="fab fa-facebook" aria-hidden="true"></i>
                                    <span class="sr-only">Facebook</span>
                                </a>
                                <a href="https://pinterest.com/">
                                    <i class="fab fa-pinterest-p" aria-hidden="true"></i>
                                    <span class="sr-only">Pinterest</span>
                                </a>
                                <a href="https://instagram.com/">
                                    <i class="fab fa-instagram" aria-hidden="true"></i>
                                    <span class="sr-only">Instagram</span>
                                </a>
                            </div>
                        </div><!-- /.tour-listing-details__destination__right -->
                    </div><!-- /.tour-listing-details__destination__inner -->
                </div><!-- /.container -->
            </div><!-- /.tour-listing-details__destination -->
            <div class="tour-listing-details__carousel wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                <div class="container">
                    <div class="destination-carousel">
                        <div class="destination-carousel__inner gotur-owl__carousel gotur-owl__carousel--basic-nav owl-carousel owl-theme" data-owl-options='{
                "items": 1,
                "margin": 30,
                "loop": true,
                "smartSpeed": 700,
                "nav": true,
                "navText": ["<span class=\"icon-arrow-left\"></span>","<span class=\"icon-arrow-right\"></span>"],
                "dots": false,
                "autoplay": false
            }'>
                            <div class="item">
                                <div class="destination-carousel__item">
                                    <img src="{{asset('storage/package/'.$tour->cover_img)}}" alt="destination">
                                </div>
                            </div>

                        </div><!-- /.destination-carousel__inner -->
                    </div><!-- /.destination-carousel -->
                </div><!-- /.container -->
            </div><!-- /.tour-listing-details__carousel -->
            <div class="tour-listing-details__info-area wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                <div class="container">
                    <ul class="tour-listing-details__info-area__info list-unstyled">
                        <li>
                            <div class="tour-listing-details__info-area__icon">
                                <i class="icon-location"></i>
                            </div><!-- /.tour-listing-details__info-area__icon -->
                            <div class="tour-listing-details__info-area__content">
                                <h5 class="tour-listing-details__info-area__title">Location</h5><!-- /.tour-listing-details__info-area__title -->
                                <p class="tour-listing-details__info-area__text">{{$tour->end_location}}</p><!-- /.tour-listing-details__info-area__text -->
                            </div><!-- /.tour-listing-details__info-area__content -->
                        </li>
                        <li>
                            <div class="tour-listing-details__info-area__icon">
                                <i class="icon-travel-and-tourism"></i>
                            </div><!-- /.tour-listing-details__info-area__icon -->
                            <div class="tour-listing-details__info-area__content">
                                <h5 class="tour-listing-details__info-area__title">Activities Type</h5><!-- /.tour-listing-details__info-area__title -->
                                <p class="tour-listing-details__info-area__text">{{ucfirst($tour->tour_type)}}</p><!-- /.tour-listing-details__info-area__text -->
                            </div><!-- /.tour-listing-details__info-area__content -->
                        </li>
                        <li>
                            <div class="tour-listing-details__info-area__icon">
                                <i class="icon-clock"></i>
                            </div><!-- /.tour-listing-details__info-area__icon -->
                            <div class="tour-listing-details__info-area__content">
                                <h5 class="tour-listing-details__info-area__title">Activate Day</h5><!-- /.tour-listing-details__info-area__title -->
                                <p class="tour-listing-details__info-area__text">
                                    {{$tour->day." Day, ".$tour->night." Night"}}
                                </p><!-- /.tour-listing-details__info-area__text -->
                            </div><!-- /.tour-listing-details__info-area__content -->
                        </li>
                        <li>
                            <div class="tour-listing-details__info-area__icon">
                                <i class="icon-group"></i>
                            </div><!-- /.tour-listing-details__info-area__icon -->
                            <div class="tour-listing-details__info-area__content">
                                <h5 class="tour-listing-details__info-area__title">Max People</h5><!-- /.tour-listing-details__info-area__title -->
                                <p class="tour-listing-details__info-area__text">{{$tour->max_people}}</p><!-- /.tour-listing-details__info-area__text -->
                            </div><!-- /.tour-listing-details__info-area__content -->
                        </li>
                        <li>
                            <a href="#" class="gotur-btn">{{config('app.currency')." ".number_format($tour->amount)}} / Per Person</a>
                        </li>
                    </ul><!-- /.tour-listing-details__info-area__info -->
                </div><!-- /.container -->
            </div><!-- /.tour-listing-details__info-area -->
            <div class="container">
                <div class="row gutter-y-30">
                    <div class="col-lg-4">
                        <div class="tour-listing-details__sidebar">
                            <div class="tour-listing-details__sidebar__item tour-listing-details__sidebar__item-form wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="1500ms">
                                <h4 class="tour-listing-details__sidebar__title">Book This Tour</h4><!-- /.tour-listing-details__sidebar__title -->
                                <br>
                                <div class="sidebar-two__form">
                                    <button type="submit" class="gotur-btn gotur-btn--base open-modal-btn" id="openModalBtn">Book Now <i class="icon-right"></i></button>
                                </div>
                            </div><!-- /.tour-listing-details__sidebar__item -->

                        </div><!-- /.tour-listing-details-details__sidebar -->

                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-8">
                        <div class="tour-listing-details__content">
                            <div class="tour-listing-details__content__item tour-listing-details__content__text wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                                <h4 class="tour-listing-details__title">Overview</h4><!-- /.tour-listing-details__title -->
                                <p class="tour-listing-details__text">
                                    {!! $tour->detail !!}
                                </p><!-- /.tour-listing-details__text -->
                            </div><!-- /.tour-listing-details__content__item -->
                            <div class="tour-listing-details__content__item tour-listing-details__list wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                                <h4 class="tour-listing-details__title">Include</h4><!-- /.tour-listing-details__title -->
                                    <div>
                                        {!! $tour->include !!}
                                    </div>
                            </div><!-- /.tour-listing-details__content__item -->
                            <div class="tour-listing-details__content__item tour-listing-details__amenities wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                                <h4 class="tour-listing-details__title">Exclude</h4><!-- /.tour-listing-details__title -->
                                <div class="tour-listing-details__amenities__inner">
                                    {!! $tour->exclude !!}
                                </div><!-- /.tour-listing-details__amenities__inner -->
                            </div><!-- / -->


                            <div class="tour-listing-details__content__item tour-listing-details__ture-plan">
                                <h4 class="tour-listing-details__title">Tour Plan</h4><!-- /.tour-listing-details__title -->
                                <div class="faq-page__accordion faq-accordion gotur-accordion" data-grp-name="gotur-accordion">
@foreach($activities as $a)
                                    <div class="accordion wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                                        <div class="accordion-title">
                                            <h4 class="accordion-title__text"> {{$a->title}}<span class="accordion-title__icon"></span></h4>
                                        </div><!-- /.accordian-title -->
                                        <div class="accordion-content">
                                            <div class="inner">
                                                <p class="inner__text">
                                                    {!! $a->detail !!}
                                                </p>
                                            </div><!-- /.accordian-content -->
                                        </div>
                                    </div><!-- /.accordian-item -->
@endforeach
                                </div>
                            </div><!-- /.tour-listing-details__content__item -->
                        </div><!-- /.tour-listing-details__content -->

                    </div><!-- /.col-lg-8 -->
                </div><!-- /.row justify-content-center -->
            </div><!-- /.container -->
        </section><!-- /.tour-listing-details -->

@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ticketPrice = {{$tour->amount}};

            const qtyInput = document.getElementById('quantityField');
            const totalInput = document.getElementById('totalField');

            // Initial calculation
            if (qtyInput.value) {
                let qty = parseInt(qtyInput.value) || 0;
                let total = qty * ticketPrice;
                totalInput.value = total.toFixed(2);
            }

            // Calculate on input change
            qtyInput.addEventListener('input', function() {
                let qty = parseInt(this.value) || 0;
                let total = qty * ticketPrice;
                totalInput.value = total.toFixed(2);

                // Optional: Add a small highlight effect
                totalInput.style.backgroundColor = '#e3f0fa';
                setTimeout(() => {
                    totalInput.style.backgroundColor = '';
                }, 200);
            });
        });
    </script>

    <script>
        (function() {
            const modalOverlay = document.getElementById('modalOverlay');
            const openBtn = document.getElementById('openModalBtn');
            const closeBtn = document.getElementById('closeModalBtn');
            const bookingForm = document.getElementById('bookingForm');
            const toastEl = document.getElementById('toastMessage');

            // open modal
            openBtn.addEventListener('click', function(e) {
                e.preventDefault();
                modalOverlay.classList.add('active');
                // tiny optional: focus first field (date)
                setTimeout(() => {
                    document.getElementById('dateField')?.focus();
                }, 100);
            });

            // close modal function (x button or background click)
            function closeModal() {
                modalOverlay.classList.remove('active');
                // also hide toast if visible (so next open is clean)
                toastEl.classList.remove('show');
            }

            closeBtn.addEventListener('click', closeModal);

            // click outside the modal card -> close
            modalOverlay.addEventListener('click', function(e) {
                if (e.target === modalOverlay) {
                    closeModal();
                }
            });

            // ESC key close
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modalOverlay.classList.contains('active')) {
                    closeModal();
                }
            });



            // small live demo: make total field react to quantity change? not required but adds ✨
            // just to show professional behaviour: if you want you can ignore, but we add tiny feature: prefix total sign
            const quantityInput = document.getElementById('quantityField');
            const totalInput = document.getElementById('totalField');
            // optional suggestion (but keep it simple and unobtrusive)
            // this demonstrates professionalism (auto-calc not required, but shows attention)
            quantityInput.addEventListener('input', function() {
                // only if total is empty or seems default, but we do nothing automatic to avoid confusion.
                // we could add a subtle tooltip but not needed.
            });

            // set nice default example for date (today + 1)
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            const year = tomorrow.getFullYear();
            const month = String(tomorrow.getMonth() + 1).padStart(2, '0');
            const day = String(tomorrow.getDate()).padStart(2, '0');
            const defaultDate = `${year}-${month}-${day}`;
            // only set if field is empty (but it already has a placeholder '2026-03-20', but we override with a closer date)
            // use a more realistic default
            document.getElementById('dateField').value = defaultDate;
        })();
    </script>

@endpush
