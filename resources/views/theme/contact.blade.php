@extends('layout.theme')
@section('title','Contact')
@section('content')
    <section class="page-header">
            <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg-1-1.jpg);"></div><!-- /.page-header__bg -->
            <div class="container">
                <div class="page-header__content">
                    <h2 class="page-header__title bw-split-in-right">Contact us</h2>
                    <ul class="gotur-breadcrumb list-unstyled">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><span>Contact us</span></li>
                    </ul><!-- /.thm-breadcrumb list-unstyled -->
                </div><!-- /.page-header__content -->
            </div><!-- /.container -->
        </section><!-- /.page-header -->

    <section class="contact-top section-space">
            <div class="container">
                <div class="row gutter-y-30">
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                        <div class="contact-top__item">
                            <div class="contact-top__item__icon">
                                <i class="icon-pin"></i>
                            </div><!-- /.contact-top__item__icon -->
                            <h4 class="contact-top__item__title">Our Address</h4><!-- /.contact-top__item__title -->
                            <p class="contact-top__item__text">{{settings()->app_address??"Null"}}</p><!-- /.contact-top__item__text -->
                        </div><!-- /.contact-top__item -->
                    </div><!-- /.col-lg-4 col-md-6 -->
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                        <div class="contact-top__item">
                            <div class="contact-top__item__icon">
                                <i class="icon-mail-3"></i>
                            </div><!-- /.contact-top__item__icon -->
                            <h4 class="contact-top__item__title"><a href="mailto:{{settings()->app_email??"Null"}}">{{settings()->app_email??"Null"}}</a></h4><!-- /.contact-top__item__title -->
                            <p class="contact-top__item__text">Email us anytime for anykind ofquety.</p><!-- /.contact-top__item__text -->
                        </div><!-- /.contact-top__item -->
                    </div><!-- /.col-lg-4 col-md-6 -->
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='700ms'>
                        <div class="contact-top__item">
                            <div class="contact-top__item__icon">
                                <i class="icon-call-3"></i>
                            </div><!-- /.contact-top__item__icon -->
                            <h4 class="contact-top__item__title">Hot:<a href="tel:{{settings()->app_phone??"Null"}}">{{settings()->app_phone??"Null"}}</a></h4><!-- /.contact-top__item__title -->
                            <p class="contact-top__item__text">Call us any kind suppor,we will wait for it.</p><!-- /.contact-top__item__text -->
                        </div><!-- /.contact-top__item -->
                    </div><!-- /.col-lg-4 col-md-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.contact-top -->

    <section class="contact-page section-space-bottom">
            <div class="container">
                <div class="row gutter-y-30">
                    <div class="col-lg-6 wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='300ms'>
                        <div class="contact-page__map">
                            <div class="google-map google-map__@@extraClassName">
                                <iframe title="template google map" src="{{settings()->app_google_map??"Null"}}" class="map__@@extraClassName" allowfullscreen></iframe>
                            </div>
                            <!-- /.google-map -->
                        </div><!-- /.contact-page__map -->
                    </div><!-- /.col-lg-5 -->
                    <div class="col-lg-6 wow fadeInRight" data-wow-duration='1500ms' data-wow-delay='300ms'>
                        <div class="contact-page__contact">
                            <h2 class="contact-page__title">Ready to Get Started?</h2><!-- /.contact-page__title -->
                            <p class="contact-page__text">For any queries please conatact with us with filling below information</p><!-- /.contact-page__text -->
                            <form action="{{route('front.contact.store')}}" method="post" class="comments-form__form  form-one">
                                @csrf
                                <div class="form-one__group">
                                    <div class="form-one__control">
                                        <label for="name">Your Name*</label>
                                        <input type="text" name="name" id="name" placeholder="Your Name" required>
                                    </div>
                                    <div class="form-one__control">
                                        <label for="email">Your Email*</label>
                                        <input type="email" name="email" id="email" placeholder="Your Email" required>
                                    </div>
                                    <div class="form-one__control form-one__control--full">
                                        <label for="message">Message*</label>
                                        <textarea name="message" id="message" placeholder="Write Message . . " required></textarea>
                                    </div>
                                    <div class="form-one__control form-one__control--full">
                                        <button type="submit" class="gotur-btn gotur-btn--base">Send Message<i class="icon-arrow-right"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div><!-- /.contact-page__contact -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.contact-page -->

@endsection
