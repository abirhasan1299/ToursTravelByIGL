@extends('layout.theme')
@section('title','Tour List')
@section('content')

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
                                <div class="tour-listing-details__destination__ratings-box">
                                    <span>(17 Review)</span>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                </div>
                                <div class="tour-listing-details__destination__posted">
                                    <i class="icon-pin1"></i>
                                    <p class="tour-listing-details__destination__posted-text">
                                        {{$tour->start_location." to ".$tour->end_location}}
                                    </p>
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
                                    <form class="sidebar-two__form__inner contact-form-validated" action="#" novalidate="novalidate">
                                        <div class="sidebar-two__form__control">
                                            <label for="checkin">Date:</label>
                                            <input class="gotur-datepicker" id="checkin" type="text" name="checkin">
                                            <i class="icon-calendar"></i>
                                        </div>

                                        <div class="sidebar-two__form__control">
                                            <label for="checkout">Quantity</label>
                                            <input id="checkout" type="text" min="1" max="{{$tour->max_people}}" name="ticket_no" placeholder="Tickets Need">
                                        </div>

                                        <div class="sidebar-two__form__total">Total:
                                            <span id="total_amount">0</span>
                                        </div>
                                        <button type="submit" class="gotur-btn gotur-btn--base">Book Now <i class="icon-right"></i></button>
                                    </form>
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
        const ticketPrice = {{$tour->amount}};

        const qtyInput = document.getElementById('checkout');
        const totalAmount = document.getElementById('total_amount');

        qtyInput.addEventListener('input', function () {
            let qty = parseInt(this.value) || 0;
            let total = qty * ticketPrice;
            totalAmount.textContent = total;
        });
    </script>
@endpush
