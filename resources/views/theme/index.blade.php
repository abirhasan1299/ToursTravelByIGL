@extends('layout.theme')
@section('title','Home')

@section('content')
    <section class="main-slider-one" id="home">
        <div class="main-slider-one__item">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-8 col-md-10">
                        <div class="main-slider-one__content">
                            <h5 class="main-slider-one__sub-title main-three bw-split-in-top">Discover Your</h5><!-- slider-sub-title -->
                            <h2 class="main-slider-one__title main-three bw-split-in-down">
                                {{$about->hero_header??'Next Step'}}
                                <br> Destination</h2><!-- slider-title -->
                            <p class="main-slider-one__text main-three bw-split-in-down">{{$about->hero_detail??'Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the Lorem ipsum dolor sit amet consectetur adipiscing elit.'}}</p><!-- /.main-slider-one__text -->
                        </div><!-- /.main-slider-one__content -->
                    </div><!-- /.col-xl-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            <div class="main-slider-one__destinations">
                <div class="container">
                    <div class="destinations-two__inner">
                        <div class="destinations-two__carousel gotur-owl__carousel gotur-owl__carousel--custom-nav gotur-owl__carousel--with-shadow owl-carousel owl-theme" data-owl-nav-prev=".main-slider-one__carousel__nav--left" data-owl-nav-next=".main-slider-one__carousel__nav--right" data-owl-options='{
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
                                <div class="destinations-card-two wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                                    <div class="destinations-card-two__thumb">
                                        <img src="{{asset('assets/images/main-slider/hero-1-1-image.jpg')}}" alt="destinations image">
                                    </div><!-- /.destinations-card-two__thumb -->
                                </div><!-- /.destinations-card-two -->
                            </div><!-- /.item -->
                            <div class="item">
                                <div class="destinations-card-two wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                                    <div class="destinations-card-two__thumb">
                                        <img src="{{asset('assets/images/main-slider/hero-1-2-image.jpg')}}" alt="destinations image">
                                    </div><!-- /.destinations-card-two__thumb -->
                                </div><!-- /.destinations-card-two -->
                            </div><!-- /.item -->
                            <div class="item">
                                <div class="destinations-card-two wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                                    <div class="destinations-card-two__thumb">
                                        <img src="{{asset('assets/images/main-slider/hero-1-3-image.jpg')}}" alt="destinations image">
                                    </div><!-- /.destinations-card-two__thumb -->
                                </div><!-- /.destinations-card-two -->
                            </div><!-- /.item -->
                            <div class="item">
                                <div class="destinations-card-two wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                                    <div class="destinations-card-two__thumb">
                                        <img src="{{asset('assets/images/main-slider/hero-1-1-image.jpg')}}" alt="destinations image">
                                    </div><!-- /.destinations-card-two__thumb -->
                                </div><!-- /.destinations-card-two -->
                            </div><!-- /.item -->
                            <div class="item">
                                <div class="destinations-card-two wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                                    <div class="destinations-card-two__thumb">
                                        <img src="{{asset('assets/images/main-slider/hero-1-2-image.jpg')}}" alt="destinations image">
                                    </div><!-- /.destinations-card-two__thumb -->
                                </div><!-- /.destinations-card-two -->
                            </div><!-- /.item -->
                            <div class="item">
                                <div class="destinations-card-two wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                                    <div class="destinations-card-two__thumb">
                                        <img src="{{asset('assets/images/main-slider/hero-1-3-image.jpg')}}" alt="destinations image">
                                    </div><!-- /.destinations-card-two__thumb -->
                                </div><!-- /.destinations-card-two -->
                            </div><!-- /.item -->
                        </div><!-- /.destinations-two__carousel -->
                    </div><!-- /.destinations-two__inner -->
                </div><!-- /.container -->
                <div class="main-slider-one__destinations__hover">
                    <img src="{{asset('assets/images/shapes/hero-1-1-hover.png')}}" alt="destinations image">
                </div><!-- /.destinations-card-two__group-card -->
            </div><!-- /.main-slider-one__dep -->
            <div class="main-slider-one__bottom__nav">
                <button class="main-slider-one__carousel__nav--left"><span class="icon-arrow-left"></span></button>
                <button class="main-slider-one__carousel__nav--right"><span class="icon-arrow-right"></span></button>
            </div>
            <div class="main-slider-one__action-form">
                <div class="container">
                    <div class="main-slider-one__form">
                        <div class="banner-form wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                            <div class="container">
                                <form class="banner-form__wrapper" action="#">
                                    <div class="banner-form row gutter-x-30 align-items-center">
                                        <div class="banner-form__control banner-form__col--1">
                                            <i class="icon icon-location"></i>
                                            <label for="location">Location</label>
                                            <select name="location" class="selectpicker" id="location">
                                                <option value="select">Australia</option>
                                                <option value="spain">Spain</option>
                                                <option value="africa">Africa</option>
                                                <option value="europe">Europe</option>
                                            </select>
                                        </div>
                                        <div class="banner-form__control banner-form__col--2">
                                            <i class="icon icon-travle"></i>
                                            <label for="type2">Activities Type</label>
                                            <select name="type" class="selectpicker" id="type2">
                                                <option value="select">Adventure</option>
                                                <option value="spanis">Booking Type</option>
                                                <option value="africa">Beach</option>
                                                <option value="europe">Discovery</option>
                                            </select>
                                        </div>
                                        <div class="banner-form__control banner-form__control--date banner-form__col--3">
                                            <i class="icon icon-clock"></i>
                                            <label for="date">Activate Day</label>
                                            <input class="gotur-multi-datepicker" id="date" type="text" name="date" placeholder="Fev 5 - 5">
                                        </div>
                                        <div class="banner-form__control banner-form__col--4">
                                            <i class="icon icon-group"></i><!-- / -->
                                            <label for="guests">Traveler</label>
                                            <button type="button" class="banner-form__qty-minus sub">
                                                <i class="icon-down-arrow"></i>
                                            </button>
                                            <input id="guests" type="number" value="2" name="guests" placeholder="2">
                                            <button type="button" class="banner-form__qty-plus add">
                                                <i class="icon-down-arrow"></i>
                                            </button>
                                        </div>
                                        <div class="banner-form__control banner-form__button banner-form__col--5">
                                            <button class="gotur-btn" type="submit">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- banner-form -->
                    </div><!-- /.main-slider-four__form -->
                </div><!-- /.container -->
            </div><!-- /.main-slider-one__action-form -->
            <div class="main-slider-one__element">
                <img src="{{asset('assets/images/shapes/hero-1-2-hover.png')}}" alt="element">
            </div><!-- /.main-slider-one__element -->
            <div class="main-slider-one__element-one">
                <img src="{{asset('assets/images/shapes/hero-shapr-1-2-2.png')}}" alt="element">
            </div><!-- /.main-slider-one__element -->
            <div class="main-slider-one__element-two">
                <img src="{{asset('assets/images/shapes/hero-shapr-1-3.png')}}" alt="element">
            </div><!-- /.main-slider-one__element -->
            <div class="main-slider-one__element-three">
                <img src="{{asset('assets/images/shapes/hero-shapr-1-2-1.png')}}" alt="element">
            </div><!-- /.main-slider-one__element -->
            <div class="main-slider-one__element-four"></div><!-- /.main-slider-one__element -->
            <div class="main-slider-one__element-five">
                <img src="{{asset('assets/images/shapes/hero-shapr-1-2-a.png')}}" alt="element">
            </div><!-- /.main-slider-one__element -->
        </div><!-- /.main-slider-one__item -->
    </section><!-- /.main-slider-one -->

    <section class="about-two about-two--two section-space" id="about">
        <div class="container">
            <div class="row gutter-y-40">
                <div class="col-lg-6">
                    <div class="about-two__thumb wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='300ms'>
                        <div class="about-two__thumb__item  ">
                            <img src="{{asset('assets/images/about/about-2-1.jpg')}}" alt="gotur image">
                        </div><!-- /.about-two__thumb__item -->
                        <div class="about-two__thumb__item-small  ">
                            <img src="{{asset('assets/images/about/about-s-2-1.jpg')}}" alt="gotur image">
                        </div><!-- /.about-two__thumb__item -->
                        <div class="about-two__thumb__funfact">
                            <div class="about-two__thumb__funfact__icon">
                                <i class="icon-icon-4"></i>
                            </div><!-- /.about-two__thumb__funfact__icon -->
                            <div class="about-two__thumb__funfact__content count-box">
                                <h2 class="about-two__thumb__funfact__count">
                                    <span class="count-text" data-stop="{{$about->exp_years}}" data-speed="2000"> </span>
                                    <span>Years</span>
                                </h2><!-- /.about-two__thumb__funfact__count -->
                                <p class="about-two__thumb__funfact__text">Of Experience</p><!-- /.about-two__thumb__funfact__text -->
                            </div><!-- /.about-two__thumb__funfact__content -->
                        </div><!-- /.about-two__thumb__funfact -->
                        <div class="about-two__thumb__item-element">
                            <img src="{{asset('assets/images/shapes/corki.png')}}" alt=" image">
                        </div><!-- /.about-two__thumb__item -->
                    </div><!-- /.about-two__left -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="about-two__right">
                        <div class="sec-title  ">
                            <h6 class="sec-title__tagline bw-split-in-right">About company</h6><!-- /.sec-title__tagline -->
                            <h3 class="sec-title__title bw-split-in-left">Great Opportunity for Adventure & Travels</h3><!-- /.sec-title__title -->
                        </div><!-- /.sec-title -->
                        <p class="about-two__top__text wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>{{$about->company_title??'Lorem ipsum dolor sit amet consectetur adipiscing elit. Mauris nullam the Lorem ipsum dolor sit amet consectetur adipiscing elit.'}}</p><!-- /.about-two__top__text -->
                        <div class="about-two__feature">
                            <div class="row gutter-y-20 gutter-x-20">
                                <div class="col-xl-6 col-lg-12 col-md-6 wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                                    <div class="about-two__feature-vestion">
                                        <div class="about-two__feature_icon">
                                            <i class="icon-flag"></i>
                                        </div><!-- /.about-two__feature_icon -->
                                        <div class="about-two__feature-content">
                                            <h5 class="about-two__feature-title">Trusted travel guide</h5><!-- /.about-two__feature-title -->
                                            <p class="about-two__feature-text">Aliquam erat volutpat Nullam imperdiet</p><!-- /.about-two__feature-text -->
                                        </div><!-- /.about-two__feature-content -->
                                    </div><!-- /.about-two__feature-vestion -->
                                </div><!-- /.col-xl-6 col-lg-12 col-md-6 -->
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="about-two__feature-vestion wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='400ms'>
                                        <div class="about-two__feature_icon">
                                            <i class="icon-misstion"></i>
                                        </div><!-- /.about-two__feature_icon -->
                                        <div class="about-two__feature-content">
                                            <h5 class="about-two__feature-title">Mission & Vision</h5><!-- /.about-two__feature-title -->
                                            <p class="about-two__feature-text">{{$about->mv??'Ut vehiculadictumst. Maecenas ante. Step'}}</p><!-- /.about-two__feature-text -->
                                        </div><!-- /.about-two__feature-content -->
                                    </div><!-- /.about-two__feature-vestion -->
                                </div><!-- /.col-xl-6 col-lg-12 col-md-6 -->
                            </div><!-- /.row -->
                        </div><!-- /.about-two__feature -->
                        <div class="about-two__button wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>

                            <div class="about-two__button__author">
                                <div class="about-two__button__author__thumb">
                                    <img src="{{asset('storage/author_img/'.$about->author_img)}}" alt="author">
                                </div><!-- /.about-two__button__call__icon -->
                                <div class="about-two__button__author__content">
                                    <h5 class="about-two__button__author__name">{{$about->author_name??"TITAN KONOK"}}</h5>
                                    <span class="about-two__button__author__dec">{{$about->author_designation??"Designation"}}</span><!-- /.about-two__button__author__dec -->
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
            <img src="{{asset('assets/images/shapes/about-1-1.png')}}" alt>
        </div><!-- /.about-two__element-one -->
        <div class="about-two__element-two">
            <img src="{{asset('assets/images/shapes/corki.png')}}" alt="gotur image">
        </div><!-- /.about-two__element-one -->
    </section><!-- /.about-two -->

    <section class="destination-filter section-space" id="destination">
        <div class="container">
            <div class="destination-filter__top">
                <div class="sec-title text-center">
                    <h6 class="sec-title__tagline bw-split-in-right">Popular Destination</h6><!-- /.sec-title__tagline -->
                    <h3 class="sec-title__title bw-split-in-left">Popular <span> Destinations</span></h3><!-- /.sec-title__title -->
                </div><!-- /.sec-title -->
                <p class="destination-filter__top__text">The island of Crete offers a rare mix of splendid beaches, amazing mountain landscap, vibrant towns and cosy villages inhabited by warm-hearted locals, all this spiced</p><!-- /.destination-filter__top__text -->
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
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{asset('assets/images/destination/destination-1-1.jpg')}}" alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a href="destination-details.html">Bangkok</a></h3><!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{asset('assets/images/destination/destination-1-2.jpg')}}" alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a href="destination-details.html">Tokyo</a></h3><!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{asset('assets/images/destination/destination-1-3.jpg')}}" alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a href="destination-details.html">Kashmir</a></h3><!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='600ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{asset('assets/images/destination/destination-1-4.jpg')}}" alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a href="destination-details.html">Indonesia</a></h3><!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.item -->
                    <div class="item tab active-tab" id="itemTwo">
                        <div class="row gutter-y-20 gutter-x-20">
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{asset('assets/images/destination/destination-1-1.jpg')}}" alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a href="destination-details.html">Bangkok</a></h3><!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{asset('assets/images/destination/destination-1-2.jpg')}}" alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a href="destination-details.html">Tokyo</a></h3><!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{asset('assets/images/destination/destination-1-3.jpg')}}" alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a href="destination-details.html">Kashmir</a></h3><!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='600ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{asset('assets/images/destination/destination-1-4.jpg')}}" alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a href="destination-details.html">Indonesia</a></h3><!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.item -->
                    <div class="item tab" id="itemThree">
                        <div class="row gutter-y-20 gutter-x-20">
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{asset('assets/images/destination/destination-1-1.jpg')}}" alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a href="destination-details.html">Bangkok</a></h3><!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.item -->
                    <div class="item tab" id="itemFour">
                        <div class="row gutter-y-20 gutter-x-20">
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{asset('assets/images/destination/destination-1-1.jpg')}}" alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a href="destination-details.html">Bangkok</a></h3><!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div>


                        </div><!-- /.row -->
                    </div><!-- /.item -->
                    <div class="item tab" id="itemFive">
                        <div class="row gutter-y-20 gutter-x-20">
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='100ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{asset('assets/images/destination/destination-1-1.jpg')}}" alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a href="destination-details.html">Bangkok</a></h3><!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div><!-- /.col-xl-3 col-lg-4 col-md-4 col-sm-6 -->
                            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                <div class="destination-card-one wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                                    <div class="destination-card-one__thumb">
                                        <img src="{{asset('assets/images/destination/destination-1-2.jpg')}}" alt="destination">
                                        <a href="#" class="destination-card-one__overly"></a>
                                    </div><!-- /.destination-card-one__thumb -->
                                    <div class="destination-card-one__content">
                                        <h3 class="destination-card-one__title"><a href="destination-details.html">Tokyo</a></h3><!-- /.destination-card-one__title -->
                                    </div><!-- /.destination-one__content -->
                                </div><!-- /.destination-one -->
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.item -->
                </div><!-- /.tabs-content -->
            </div><!-- /.tabs-box -->
        </div><!-- /.container -->
        <div class="destination-filter__element">
            <img src="{{asset('assets/images/shapes/plan.png')}}" alt>
        </div><!-- /.destination-filter__element -->
        <div class="destination-filter__element-two">
            <img src="{{asset('assets/images/shapes/monjil.png')}}" alt>
        </div><!-- /.destination-filter__element -->
    </section><!-- /.destination-filter -->
    <section class="cta-five section-space">
        <div class="cta-five__inner">
            <div class="cta-five__bg wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms" style="background-image: url(assets/images/backgrounds/cta-1-1.jpg);"></div><!-- /.cta-five__bg -->
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
                                            <span class="count-text" data-stop="{{$about->tour_success??'30'}}" data-speed="1500"></span>
                                            <span>k+</span>
                                        </h3><!-- /.cta-five__funfact__count -->
                                        <p class="cta-five__funfact__text">Tours success</p><!-- /.cta-five__funfact__text -->
                                    </div><!-- /.cta-five__funfact__content -->
                                </li><!-- /.cta-five__funfact__item -->
                                <li class="cta-five__funfact__item">
                                    <div class="cta-five__funfact__icon">
                                        <i class="icon-tourist"></i>
                                    </div><!-- /.cta-five__funfact__icon -->
                                    <div class="cta-five__funfact__content count-box">
                                        <h3 class="cta-five__funfact__count">
                                            <span class="count-text" data-stop="{{$about->happy_traveler??'30'}}" data-speed="1500"></span>
                                            <span>+</span>
                                        </h3><!-- /.cta-five__funfact__count -->
                                        <p class="cta-five__funfact__text">Happy Traveler</p><!-- /.cta-five__funfact__text -->
                                    </div><!-- /.cta-five__funfact__content -->
                                </li><!-- /.cta-five__funfact__item -->
                                <li class="cta-five__funfact__item">
                                    <div class="cta-five__funfact__icon">
                                        <i class="icon-trophy"></i>
                                    </div><!-- /.cta-five__funfact__icon -->
                                    <div class="cta-five__funfact__content count-box">
                                        <h3 class="cta-five__funfact__count">
                                            <span class="count-text" data-stop="{{$about->award??'30'}}" data-speed="1500"></span>
                                            <span>+</span>
                                        </h3><!-- /.cta-five__funfact__count -->
                                        <p class="cta-five__funfact__text">Awards Winning</p><!-- /.cta-five__funfact__text -->
                                    </div><!-- /.cta-five__funfact__content -->
                                </li><!-- /.cta-five__funfact__item -->
                                <li class="cta-five__funfact__item">
                                    <div class="cta-five__funfact__icon">
                                        <i class="icon-quality"></i>
                                    </div><!-- /.cta-five__funfact__icon -->
                                    <div class="cta-five__funfact__content count-box">
                                        <h3 class="cta-five__funfact__count">
                                            <span class="count-text" data-stop="{{$about->exp_years??'30'}}" data-speed="1500"></span>
                                            <span>+</span>
                                        </h3><!-- /.cta-five__funfact__count -->
                                        <p class="cta-five__funfact__text">Our Experience</p><!-- /.cta-five__funfact__text -->
                                    </div><!-- /.cta-five__funfact__content -->
                                </li><!-- /.cta-five__funfact__item -->
                            </ul><!-- /.cta-five__funfact__list -->
                        </div><!-- /.cta-five__thumb -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="cta-five__shape wow fadeInRight" data-wow-duration="1500ms" data-wow-delay="400ms">
                            <img src="{{asset('assets/images/shapes/cta-1-1.png')}}" alt>
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
                                    <img src="{{asset('assets/images/about/about-s-8-2.jpg')}}" alt="image">
                                </div><!-- /.why-choose-one__thumb__item -->
                                <div class="why-choose-one__thumb__item-one  ">
                                    <img src="{{asset('assets/images/about/about-s-8-1.jpg')}}" alt="image">
                                </div><!-- /.why-choose-one__thumb__item -->
                            </div><!-- /.col-lg-6 -->
                            <div class="col-lg-6">
                                <div class="why-choose-one__thumb__item-two  ">
                                    <img src="{{asset('assets/images/about/about-8-1.jpg')}}" alt="image">
                                </div><!-- /.why-choose-one__thumb__item -->
                            </div><!-- /.col-lg-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.why-choose-one__thumb -->
                </div><!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="why-choose-one__content">
                        <div class="sec-title ">
                            <h6 class="sec-title__tagline bw-split-in-right">Why Choose Us</h6><!-- /.sec-title__tagline -->
                            <h3 class="sec-title__title bw-split-in-left"> Get The <span>Best Travel</span> Experience With Gotur</h3><!-- /.sec-title__title -->
                        </div><!-- /.sec-title -->
                        <p class="why-choose-one__content__text wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='400ms'>It is a long established fact that a reader will be distracted the readable content of a page when looking at layout the point.</p><!-- /.why-choose-one__content__text -->
                        <ul class="why-choose-one__list">
                            <li>
                                <div class="why-choose-one__list__item wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='200ms'>
                                    <div class="why-choose-one__icon">
                                        <i class="icon-flag"></i>
                                    </div><!-- /.why-choose-one__icon -->
                                    <h5 class="why-choose-one__title">Trusted travel guide</h5><!-- /.why-choose-one__title -->
                                </div><!-- /.why-choose-one__list__item -->
                            </li>
                            <li>
                                <div class="why-choose-one__list__item wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='400ms'>
                                    <div class="why-choose-one__icon">
                                        <i class="icon-calender"></i>
                                    </div><!-- /.why-choose-one__icon -->
                                    <h5 class="why-choose-one__title">Instant Booking</h5><!-- /.why-choose-one__title -->
                                </div><!-- /.why-choose-one__list__item -->
                            </li>
                            <li>
                                <div class="why-choose-one__list__item wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='600ms'>
                                    <div class="why-choose-one__icon">
                                        <i class="icon-travle1"></i>
                                    </div><!-- /.why-choose-one__icon -->
                                    <h5 class="why-choose-one__title">World Class Travel</h5><!-- /.why-choose-one__title -->
                                </div><!-- /.why-choose-one__list__item -->
                            </li>
                            <li>
                                <div class="why-choose-one__list__item wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='800ms'>
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
            <img src="{{asset('assets/images/shapes/perasut-1-1.png')}}" alt>
        </div><!-- /.why-choose-one__element -->
    </section><!-- /.why-choose-one -->


@endsection
@push('js')
    <script>
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Message',
            text: '{{ session('success') }}'
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Message',
            text: '{{ session('error') }}'
        });
        @endif
    </script>
@endpush
