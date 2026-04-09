@extends('layout.theme')
@section('title','About Us')

@section('meta_description', $seo->description??"IGL Web Ltd")
@section('meta_keywords', $seo->keywords??"")
@section('meta_robots', $seo->robots??"")
@section('favicon', asset('storage/'.$seo->icon??asset('assets/images/favicons/favicon-16x16.png')))

@section('og_type', $seo->og_type??"")
@section('og_title', $seo->og_title??"")
@section('og_description', $seo->og_description??"")
@section('og_width', $seo->og_width??"")
@section('og_height', $seo->og_height??"")
@section('meta_image', asset('storage/'.$seo->og_image??asset('assets/images/igl.png')))

@section('twitter_title', $seo->twitter_title??"")
@section('twitter_meta_description', $seo->twitter_description??"")
@section('twitter_meta_image', asset('storage/'.$seo->twitter_image??asset('assets/images/igl.png')))

@section('content')
        <section class="page-header">
            <div class="page-header__bg" style="background-image: url({{asset('assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div><!-- /.page-header__bg -->
            <div class="container">
                <div class="page-header__content">
                    <h2 class="page-header__title bw-split-in-right">About us</h2>
                    <ul class="gotur-breadcrumb list-unstyled">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><span>About us</span></li>
                    </ul><!-- /.thm-breadcrumb list-unstyled -->
                </div><!-- /.page-header__content -->
            </div><!-- /.container -->
        </section><!-- /.page-header -->

        <section class="cta-two">
            <div class="cta-two__bg wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms" style="background-image: url({{asset('assets/images/backgrounds/cta-bg-1-1.jpg')}});"></div><!-- /.cta-two__bg -->
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6"></div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="cta-two__content wow fadeInRight" data-wow-duration='1500ms' data-wow-delay='400ms'>
                            <div class="cta-two__content__inner">
                                <div class="sec-title text-center">
                                    <h6 class="sec-title__tagline bw-split-in-right">What We’re Offering</h6><!-- /.sec-title__tagline -->
                                    <h3 class="sec-title__title bw-split-in-left">Get 30% Discount Every Tour</h3><!-- /.sec-title__title -->
                                </div><!-- /.sec-title -->
                                <div class="time-wepper" data-leading-zeros="true" data-enable-days="true" data-deadline-date="dynamicDate">
                                </div>
                                <div class="cta-two__btn">
                                    <a href="{{route('front.tour-list')}}" class="gotur-btn gotur-btn--base">Start Booking <span class="icon"><i class="icon-right"></i></span></a>
                                </div><!-- /.cta-two__btn -->
                            </div><!-- /.cta-two__content__inner -->
                        </div><!-- /.cta-two__content -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            <div class="cta-two__thumb wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='400ms'>
                <div class="cta-two__thumb__item">
                    <img src="{{asset('assets/images/resources/cta-man-1-1.png')}}" alt="cta image">
                </div><!-- /.cta-two__thumb__item -->
                <div class="cta-two__thumb__popup">
                    <img src="{{asset('assets/images/shapes/cta-1-1-popup.png')}}" alt="cta image">
                </div><!-- /.cta-two__thumb__popup -->
                <div class="cta-two__thumb__element"></div><!-- /.cta-two__thumb__element -->
            </div><!-- /.cta-two__thumb -->
            <div class="cta-two__element">
                <img src="{{asset('assets/images/shapes/cta-1-1-bg-shape.png')}}" alt>
            </div><!-- /.cta-two__element -->
        </section><!-- /.cta-two -->

        <section class="about-one section-space " style="margin-top:-120px;" id="about" >
            <div class="container">
                <div class="row gutter-y-40">
                    <div class="col-lg-6">
                        <div class="about-one__thumb wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='300ms'>
                            <div class="about-one__thumb__item  ">
                                <img src="{{asset('assets/images/about/about-1-1.jpg')}}" alt="">
                            </div><!-- /.about-one__thumb__item -->
                            <div class="about-one__thumb__item-small  ">
                                <img src="{{asset('assets/images/about/about-s-1-1.jpg')}}" alt="gotur image">
                            </div><!-- /.about-one__thumb__item -->
                            <div class="about-one__thumb__item-popup">
                                <img src="{{asset('assets/images/shapes/about-1-3.png')}}" alt="gotur image">
                            </div><!-- /.about-one__thumb__item -->
                        </div><!-- /.about-one__left -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="about-one__right">
                            <div class="sec-title  ">
                                <h6 class="sec-title__tagline bw-split-in-right">About gotur</h6><!-- /.sec-title__tagline -->
                                <h3 class="sec-title__title bw-split-in-left">Travel place for Your & your Family</h3><!-- /.sec-title__title -->
                            </div><!-- /.sec-title -->
                            <p class="about-one__top__text wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>It is a long established fact that a reader will be distracted the readable content of a page when looking at layout the point.</p><!-- /.about-one__top__text -->
                            <div class="about-one__feature">
                                <div class="row gutter-y-20">
                                    <div class="col-xl-6 col-lg-12 col-md-6 wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                                        <ul class="about-one__feature-list">
                                            <li><i class="icon-check-star"></i> Easy & Quick Booking</li>
                                            <li><i class="icon-check-star"></i> Best Price Guarantee</li>
                                        </ul><!-- /.about-one__feature-list -->
                                    </div><!-- /.col-xl-6 col-lg-12 col-md-6 -->
                                    <div class="col-xl-6 col-lg-12 col-md-6 wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='400ms'>
                                        <div class="about-one__feature-vestion">
                                            <div class="about-one__feature_icon">
                                                <i class="icon-misstion"></i>
                                            </div><!-- /.about-one__feature_icon -->
                                            <div class="about-one__feature-content">
                                                <h5 class="about-one__feature-title">Mission & Vision</h5><!-- /.about-one__feature-title -->
                                                <p class="about-one__feature-text">Ut vehiculadictumst. Maecenas ante.</p><!-- /.about-one__feature-text -->
                                            </div><!-- /.about-one__feature-content -->
                                        </div><!-- /.about-one__feature-vestion -->
                                    </div><!-- /.col-xl-6 col-lg-12 col-md-6 -->
                                </div><!-- /.row -->
                            </div><!-- /.about-one__feature -->
                            <div class="about-one__button wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>

                                <div class="about-one__button__call">
                                    <div class="about-one__button__call__icon">
                                        <i class="icon-telephone"></i>
                                    </div><!-- /.about-one__button__call__icon -->
                                    <div class="about-one__button__call__content">
                                        <span>Call Us Now</span>
                                        <a href="tel:+208-555-0112">+208-555-0112</a>
                                    </div><!-- /.about-one__button__call__content -->
                                </div><!-- /.about-one__button__call -->
                            </div><!-- /.about-one__button -->
                        </div><!-- /.about-one__right -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            <div class="about-one__element-one">
                <img src="{{asset('assets/images/shapes/about-1-1.png')}}" alt>
            </div><!-- /.about-one__element-one -->
            <div class="about-one__element-two">
                <img src="{{asset('assets/images/shapes/about-1-2.png')}}" alt>
            </div><!-- /.about-one__element-one -->
        </section><!-- /.about-one -->

        <section style="margin-top:-220px;" class="how-to-work section-space">
            <div class="container">
                <div class="sec-title text-center">
                    <h6 class="sec-title__tagline bw-split-in-right">How It Works</h6><!-- /.sec-title__tagline -->
                    <h3 class="sec-title__title bw-split-in-left">How It Works Step by Step</h3><!-- /.sec-title__title -->
                </div><!-- /.sec-title -->
                <div class="row gutter-y-40">
                    <div class="col-lg-4 col-md-6">
                        <div class="how-to-work__item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                            <div class="how-to-work__icon">
                                <i class="icon-icon-1"></i>
                                <span class="how-to-work__icon__count"></span>
                            </div><!-- /.how-to-work__icon -->
                            <h4 class="how-to-work__title">Select Destination </h4><!-- /.how-to-work__title -->
                            <p class="how-to-work__text">In a free hour, when our power of choice is untrammelled and when nothing prevents dolor sit amet, consectetur</p><!-- /.how-to-work__text -->
                        </div><!-- /.how-to-work__item -->
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="how-to-work__item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="500ms">
                            <div class="how-to-work__icon">
                                <i class="icon-icon-2"></i>
                                <span class="how-to-work__icon__count"></span>
                            </div><!-- /.how-to-work__icon -->
                            <h4 class="how-to-work__title">Make an Appointments</h4><!-- /.how-to-work__title -->
                            <p class="how-to-work__text">Integer feugiat tortor non there are many other nullam In a free hour, when our power of choice is untrammelled</p><!-- /.how-to-work__text -->
                        </div><!-- /.how-to-work__item -->
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="how-to-work__item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="700ms">
                            <div class="how-to-work__icon">
                                <i class="icon-like"></i>
                                <span class="how-to-work__icon__count"></span>
                            </div><!-- /.how-to-work__icon -->
                            <h4 class="how-to-work__title">Enjoy Our Tour</h4><!-- /.how-to-work__title -->
                            <p class="how-to-work__text">In a free hour, when our power of choice is untrammelled and when nothing preventsnon there</p><!-- /.how-to-work__text -->
                        </div><!-- /.how-to-work__item -->
                    </div><!-- /.col-lg-4 -->
                </div><!-- /.row -->
                <div class="how-to-work__shape">
                    <img src="{{asset('assets/images/shapes/line-how-to.png')}}" alt>
                </div><!-- /.how-to-work__shape -->
            </div><!-- /.container -->
            <div class="how-to-work__element">
                <img src="{{asset('assets/images/resources/how-lagges.png')}}" alt>
            </div><!-- /.how-to-work__element -->
        </section><!-- /.how-to-work -->


@endsection
