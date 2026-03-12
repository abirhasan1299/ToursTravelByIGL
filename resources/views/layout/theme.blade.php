<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="IGL TOUR">
    <meta name="description" content="IGL TOUR LTD">
    <title>@yield('title')</title>

    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/images/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/images/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/images/favicons/site.webmanifest')}}">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Just+Another+Hand&amp;family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&amp;display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-select/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/animate/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/jquery-ui/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/jarallax/jarallax.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/nouislider/nouislider.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/nouislider/nouislider.pips.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/gotur-icons/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/daterangepicker-master/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/owl-carousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/owl-carousel/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/owl-carousel/css/owl.theme.default.min.css')}}">

    <!-- template styles -->
    <link rel="stylesheet" href="{{asset('assets/css/gotur.css')}}">
    @stack('css')
</head>

<body class="custom-cursor">

<div class="custom-cursor__cursor"></div>
<div class="custom-cursor__cursor-two"></div>

<div class="preloader">
    <div class="preloader__image" style="background-image: url({{asset('assets/images/loader.png')}});"></div>
</div>
<!-- /.preloader -->
<div class="page-wrapper">


    <header class="main-header main-header--one sticky-header sticky-header--normal">
        <div class="container-fluid">
            <div class="main-header__inner">
                <div class="main-header__logo logo-retina">
                    <a href="#"><img src="{{asset('assets/images/igl.png')}}" alt="" width="" height=""></a>
                </div><!-- /.main-header__logo -->
                <div class="main-header__right">
                    <nav class="main-header__nav main-menu">
                        <ul class="main-menu__list">

                            <li class="dropdown megamenu">
                                <a href="{{route('home')}}">Home</a>
                            </li>


                            <li>
                                <a href="{{route('front.about')}}">about us</a>
                            </li>


                            <li>
                                <a href="{{route('front.tour-list')}}">Tours List</a>
                            </li>

                            <li>
                                <a href="#">destinations</a>
                            </li>

                            <li>
                                <a href="{{route('front.pricing')}}">Pricing</a>
                            </li>

                            <li>
                                <a href="#">Gallery</a>
                            </li>

                            <li>
                                <a href="#">Testimonial</a>
                            </li>

                            <li>
                                <a href="{{route('front.faq')}}">FAQ</a>
                            </li>

                            <li>
                                <a href="{{route('front.contact')}}">Contact</a>
                            </li>
                        </ul>
                    </nav><!-- /.main-header__nav -->
                    <div class="main-header__info">
                        <a href="#" class="search-toggler main-header__info__item"> <i class="icon-search-interface-symbol" aria-hidden="true"></i> <span class="sr-only">Search</span> </a>

                    </div>
                    <div class="main-header__btn-popup main-header__element__btn">
                        <i class="icon-menu-bar"></i>
                    </div><!-- /.mobile-nav__toggler -->
                    <a href="{{route('front.login')}}" class="gotur-btn main-header__btn">Login <i class="icon-paper-plane"></i></a>
                    <div class="mobile-nav__btn mobile-nav__toggler">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div><!-- /.mobile-nav__toggler -->
                </div><!-- /.main-header__right -->
            </div><!-- /.main-header__inner -->
        </div><!-- /.container-fluid -->
    </header><!-- /.main-header -->

        @yield('content')


    <footer class="main-footer">
        <div class="main-footer__top">
            <div class="container">
                <div class="main-footer__top__inner wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                    <div class="footer-widget__logo logo-retina">
                        <a href="#"><img src="{{asset('assets/images/igl.png')}}" width="160" height="80" alt="gotur logo"></a>
                    </div><!-- /.footer-widget__logo -->
                    <ul class="list-unstyled footer-widget__list">
                        <li>
                            <div class="footer-widget__list__icon"><i class="icon-email"></i></div><!-- /.footer-widget__list__icon -->
                            <div class="footer-widget__list__content">
                                <span class="footer-widget__list__subtitle">send email</span>
                                <a href="mailto:{{settings()->app_email??"Null"}}">{{settings()->app_email??"Null"}}</a>
                            </div><!-- /.footer-widget__list__content -->
                        </li>
                        <li>
                            <div class="footer-widget__list__icon"><i class="icon-telephone"></i></div><!-- /.footer-widget__list__icon -->
                            <div class="footer-widget__list__content">
                                <span class="footer-widget__list__subtitle">call agent</span>
                                <a href="tel:{{settings()->app_phone??"Nll"}}">{{settings()->app_phone??"Nll"}}</a>
                            </div><!-- /.footer-widget__list__content -->
                        </li>
                        <li>
                            <div class="footer-widget__list__icon"><i class="icon-clock-1"></i></div><!-- /.footer-widget__list__icon -->
                            <div class="footer-widget__list__content">
                                <span class="footer-widget__list__subtitle">opening time</span>
                                <p>{{settings()->app_working_hour??""}}</p>
                            </div><!-- /.footer-widget__list__content -->
                        </li>
                    </ul><!-- /.list-unstyled -->
                </div><!-- /.main-footer__top__inner -->
            </div><!-- /.container -->
        </div><!-- /.main-footer__top -->
        <div class="main-footer__middle">
            <div class="container">
                <div class="row gutter-y-40">
                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                        <div class="footer-widget footer-widget--about">
                            <h2 class="footer-widget__title">about {{settings()->app_name}}</h2><!-- /.footer-widget__title -->
                            <p class="footer-widget__about-text">{{settings()->app_about??""}} </p><!-- /.footer-widget__about-text -->
                            <div class="footer-widget__social">
                                <a href="{{settings()->app_facebook}}"> <i class="icon-facebook" aria-hidden="true"></i> <span class="sr-only">Facebook</span></a>
                                <a href="{{settings()->app_twitter??""}}"> <i class="fab fa-twitter" aria-hidden="true"></i> <span class="sr-only">Twitter</span></a>
                                <a href="{{settings()->app_instagram??""}}"> <i class="fab fa-instagram" aria-hidden="true"></i> <span class="sr-only">Linked In</span></a>
                                <a href="{{settings()->app_youtube??""}}"> <i class="icon-youtube" aria-hidden="true"></i> <span class="sr-only">Youtube</span></a>
                            </div><!-- /.footer-widget__social -->
                        </div><!-- /.footer-widget -->
                    </div><!-- /.col-lg-4 -->

                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                        <div class="footer-widget footer-widget--links">
                            <h2 class="footer-widget__title">Destinations</h2><!-- /.footer-widget__title -->
                            <ul class="list-unstyled footer-widget__links">
                                <li><a href="#">South America</a></li>
                                <li><a href="#">Middle East</a></li>
                                <li><a href="#">San Franc Rica</a></li>
                                <li><a href="#">New York</a></li>
                                <li><a href="#">Tokyo</a></li>
                            </ul><!-- /.list-unstyled footer-widget__links -->
                        </div><!-- /.footer-widget -->
                    </div><!-- /.col-lg-4 -->

                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="400ms">
                        <div class="footer-widget footer-widget--post">
                            <h2 class="footer-widget__title">useful links</h2><!-- /.footer-widget__title -->
                            <ul class="list-unstyled footer-widget__links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Destination</a></li>
                                <li><a href="#">News & blog</a></li>
                                <li><a href="#">Meet the Guide</a></li>
                                <li><a href="#">Contacts</a></li>
                            </ul><!-- /.list-unstyled footer-widget__links -->
                        </div><!-- /.footer-widget -->
                    </div><!-- /.col-lg-6 -->

                    <div class="col-md-6 col-lg-5 col-xl-3 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="600ms">
                        <div class="footer-widget footer-widget--contact">
                            <h2 class="footer-widget__title">Newsletter</h2><!-- /.footer-widget__title -->
                            <p class="footer-widget__contact-text">Sign up to searing weekly newsletter to get the latest updates.</p><!-- /.footer-widget__about-text -->
                            <form action="#" data-url="MAILCHIMP_FORM_URL" class="footer-widget__newsletter mc-form">
                                <div class="form-group__form">
                                    <input type="email" name="EMAIL" placeholder="Your email address">
                                    <button type="submit" class="gotur-btn"><span class="icon-right-arrow"></span></button>
                                </div><!-- /.form-group -->
                                <div class="form-group__check">
                                    <input type="checkbox" name="checkbox" id="check">
                                    <label for="check">I agree to the <a href="faq.html">Privacy Policy.</a></label>
                                </div><!-- /.form-group -->
                            </form><!-- /.footer-widget__newsletter mc-form -->
                            <div class="mc-form__response"></div><!-- /.mc-form__response -->
                        </div><!-- /.footer-widget -->
                    </div><!-- /.col-lg-5 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            <div class="main-footer__element-one">
                <img src="assets/images/shapes/footer-shape-1-1.png" alt>
            </div><!-- /.main-footer__element-one -->
            <div class="main-footer__element-two">
                <img src="assets/images/shapes/footer-shape-1-2.png" alt>
            </div><!-- /.main-footer__element-one -->
        </div><!-- /.main-footer__middle -->
        <div class="main-footer__bottom">
            <div class="container">
                <div class="main-footer__bottom__inner">
                    <p class="main-footer__copyright">
                        &copy; Copyright <span class="dynamic-year"></span> by {{settings()->app_name}}.
                    </p>
                    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
                            <span class="scroll-to-top__wrapper">
                                <i class="fas fa-arrow-up"></i>
                            </span>
                    </a>
                    <div class="main-footer__bottom__pyment">
                        <a href="#"><img src="{{asset('assets/images/shapes/footer-card-1-1.png')}}" alt="gotur pyment"></a>
                    </div>
                </div><!-- /.main-footer__inner -->
            </div><!-- /.container -->
        </div><!-- /.main-footer__bottom -->
    </footer><!-- /.main-footer -->
</div><!-- /.page-wrapper -->

<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div><!-- /.mobile-nav__overlay -->
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
        <div class="logo-box logo-retina">
            <a href="#" aria-label="logo image"><img src="{{asset('assets/images/igl.png')}}" width="200px" height="100px" alt="logo"></a>
        </div><!-- /.logo-box -->
        <div class="mobile-nav__container"></div><!-- /.mobile-nav__container -->
        <ul class="mobile-nav__contact list-unstyled">
            <li>
                    <span class="mobile-nav__contact__icon">
                        <i class="fa fa-envelope"></i>
                    </span>
                <a href="mailto:needhelp@gotur.com">needhelp@gotur.com</a>
            </li>
            <li>
                    <span class="mobile-nav__contact__icon">
                        <i class="fa fa-phone-alt"></i>
                    </span>
                <a href="tel:+9156980036420">+91 5698 0036 420</a>
            </li>
        </ul><!-- /.mobile-nav__contact -->
        <div class="mobile-nav__social">
            <a href="https://facebook.com/"> <i class="icon-facebook" aria-hidden="true"></i> <span class="sr-only">Facebook</span></a>
            <a href="https://twitter.com/"> <i class="icon-twitter" aria-hidden="true"></i> <span class="sr-only">Twitter</span></a>
            <a href="https://instagram.com/"> <i class="icon-linkedin" aria-hidden="true"></i> <span class="sr-only">Linked In</span></a>
            <a href="https://youtube.com/"> <i class="icon-youtube" aria-hidden="true"></i> <span class="sr-only">Youtube</span></a>
        </div><!-- /.mobile-nav__social -->
    </div><!-- /.mobile-nav__content -->
</div><!-- /.mobile-nav__wrapper -->
<div class="search-popup">
    <div class="search-popup__overlay search-toggler"></div><!-- /.search-popup__overlay -->
    <div class="search-popup__content">
        <form role="search" method="get" class="search-popup__form" action="#">
            <input type="text" id="search" placeholder="Search Here...">
            <button type="submit" aria-label="search submit" class="gotur-btn"> <i class="icon-search"></i> </button>
        </form>
    </div><!-- /.search-popup__content -->
</div><!-- /.search-popup -->
<div class="header-right-sidebar">
    <div class="header-right-sidebar__overlay header-right-sidebar__toggler"></div>
    <div class="header-right-sidebar__content">
        <span class="header-right-sidebar__close header-right-sidebar__toggler"><i class="fa fa-times"></i></span>
        <div class="header-right-sidebar__logo-box">
            <a href="#" aria-label="logo image"> <img src="{{asset('assets/images/logo-landing.png')}}" width="158" alt="gotur"> </a>
        </div>
        <div class="header-right-sidebar__container">
            <div class="header-right-sidebar__container__about wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                <h3 class="header-right-sidebar__container__title">We’re Number One Travel Adventure Company</h3>
                <p class="header-right-sidebar__container__text">It is a long established fact that a reader will be distracted the readable content of a page when looking at layout the point of using lorem the is Ipsum less normal distribution of letters.</p>
            </div>
            <div class="header-right-sidebar__container__contact">
                <h3 class="header-right-sidebar__container__title">Contact Us</h3>
                <ul class="header-right-sidebar__container__list list-unstyled">
                    <li class="header-right-sidebar__container__list__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'>
                        <div class="header-right-sidebar__container__icon">
                            <i class="icon-email"></i>
                        </div>
                        <div class="header-right-sidebar__container__list__content">
                            <span class="header-right-sidebar__container__list__title">send email</span>
                            <a href="mail:{{settings()->app_email}}">{{settings()->app_email}}</a>
                        </div>
                    </li>
                    <li class="header-right-sidebar__container__list__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                        <div class="header-right-sidebar__container__icon">
                            <i class="icon-telephone"></i>
                        </div>
                        <div class="header-right-sidebar__container__list__content">
                            <span class="header-right-sidebar__container__list__title">call agent</span>
                            <a href="{{'tel:'.settings()->app_phone}}">{{settings()->app_phone}}</a>
                        </div>
                    </li>
                    <li class="header-right-sidebar__container__list__item wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='700ms'>
                        <div class="header-right-sidebar__container__icon">
                            <i class="icon-clock"></i>
                        </div>
                        <div class="header-right-sidebar__container__list__content">
                            <span class="header-right-sidebar__container__list__title">opening time</span>
                            <p>{{settings()->app_working_hour}}</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="header-right-sidebar__container__newsletter-box wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='900ms'>
                <h3 class="header-right-sidebar__container__title">get notification</h3>
                <form action="#" data-url="MAILCHIMP_FORM_URL" class="newsletter-box mc-form">
                    <input type="email" name="EMAIL" placeholder="Email">
                    <button type="submit" class="gotur-btn gotur-btn--base">subscribe now</button>
                </form>
                <div class="mc-form__response"></div>
            </div>
        </div>
    </div><!-- /.header-right-sidebar__content -->
</div>


<div id="scroll-top" class="scroll-top">
    <span id="scroll-top-value" class="scroll-top-value"></span>
</div>

<script src="{{asset('assets/vendors/jquery/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendors/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script src="{{asset('assets/vendors/jarallax/jarallax.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-ui/jquery-ui.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-appear/jquery.appear.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-validate/jquery.validate.min.js')}}"></script>
<script src="{{asset('assets/vendors/nouislider/nouislider.min.js')}}"></script>
<script src="{{asset('assets/vendors/wnumb/wNumb.min.js')}}"></script>
<script src="{{asset('assets/vendors/owl-carousel/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/vendors/slick-carousel/slick.min.js')}}"></script>
<script src="{{asset('assets/vendors/wow/wow.js')}}"></script>
<script src="{{asset('assets/vendors/imagesloaded/imagesloaded.min.js')}}"></script>
<script src="{{asset('assets/vendors/isotope/isotope.js')}}"></script>
<script src="{{asset('assets/vendors/countdown/countdown.min.js')}}"></script>
<script src="{{asset('assets/vendors/daterangepicker-master/moment.min.js')}}"></script>
<script src="{{asset('assets/vendors/daterangepicker-master/daterangepicker.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-circleType/jquery.circleType.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-lettering/jquery.lettering.min.js')}}"></script>

<!-- GSAP -->
<script src="{{asset('assets/vendors/gsap/gsap.js')}}"></script>
<script src="{{asset('assets/vendors/gsap/scrollTrigger.min.js')}}"></script>
<script src="{{asset('assets/vendors/gsap/splittext.min.js')}}"></script>
<script src="{{asset('assets/vendors/gsap/gotur-gsap.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- template js -->
<script src="{{asset('assets/js/gotur.js')}}"></script>
@stack('js')
</body>

</html>
