<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Basic SEO -->
    <meta name="description" content="@yield('meta_description', 'Default description')">
    <meta name="keywords" content="@yield('meta_keywords', 'default, keywords')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">

    <!-- Favicon -->
    <link rel="icon" href="@yield('favicon', asset('favicon.ico'))" type="image/x-icon">

    <!-- Open Graph (Facebook) -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Default Title')">
    <meta property="og:description" content="@yield('meta_description', 'Default description')">
    <meta property="og:image" content="@yield('meta_image', asset('default.jpg'))">

    <!-- Optional image details -->
    <meta property="og:image:width" content="@yield('og_width', '1200')">
    <meta property="og:image:height" content="@yield('og_height', '630')">

    <!-- Twitter SEO -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Default Title')">
    <meta name="twitter:description" content="@yield('meta_description', 'Default description')">
    <meta name="twitter:image" content="@yield('meta_image', asset('default.jpg'))">

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

    <!-- External Links -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/gotur.css')}}">

    <style>
        /* ============================================
           HEADER - FULL WIDTH WITH CONSTRAINED CONTENT
           ============================================ */

        .main-header {
            width: 100% !important;
            max-width: none !important;
            background: #ffffff !important;
            position: relative;
            box-shadow: 0 1px 10px rgba(0,0,0,0.05);
            z-index: 1000;
        }

        .main-header .container-fluid {
            max-width: 1260px !important;
            width: 100% !important;
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 20px !important;
            padding-right: 20px !important;
        }

        .main-header__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            flex-wrap: nowrap;
            gap: 10px;
        }

        .main-header__logo {
            flex-shrink: 0;
        }

        .main-header__logo img {
            max-height: 70px !important;
            width: 180px;
            transition: all 0.3s ease;
        }

        .sticky-header--normal.sticky-header--fixed .main-header__logo img {
            max-height: 55px !important;
        }

        /* ============================================
           NAV WRAPPER & MENU - TIGHTER GAPS
           ============================================ */

        .main-header__nav-wrapper {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            margin: 0;
            overflow: visible;
        }

        .main-header__nav.main-menu {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            width: 100%;
        }

        /* Single definition for menu list - tight gap */
        .main-menu__list {
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
            list-style: none;
            flex-wrap: nowrap;
            gap: 0; /* no gap - using padding on <a> only */
        }

        .main-menu__list > li {
            white-space: nowrap;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .main-menu__list > li > a {
            padding: 8px 9px !important;
            font-size: 13.5px !important;
            font-weight: 500 !important;
            display: inline-block;
        }

        /* ============================================
           AUTH ITEM - INLINE WITH MENU, FIXED WIDTH
           ============================================ */

        .main-menu__list > li.nav-auth-item {
            flex-shrink: 0;
            position: relative; /* scopes dropdown positioning */
            margin-left: 6px;
        }

        /* Login button */
        .main-menu__list > li.nav-auth-item .gotur-btn.main-header__btn {
            padding: 8px 16px !important;
            font-size: 13px !important;
            border-radius: 50px !important;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--gotur-base);
            color: #FFFFFF;
            text-decoration: none;

        }

        /* User avatar */
        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gotur-base, #63AB45) 0%, #4f9234 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 2px solid rgba(99, 171, 69, 0.2);
            overflow: hidden;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(99, 171, 69, 0.3);
        }

        .user-avatar i {
            color: #ffffff;
            font-size: 17px;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Dropdown - anchored to .nav-auth-item (the <li>) */
        .user-dropdown-menu {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            width: 280px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1001;
            border: 1px solid rgba(99, 171, 69, 0.1);
        }

        .nav-auth-item.active .user-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-header {
            padding: 20px;
            border-bottom: 1px solid #E5E7EB;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dropdown-header .user-avatar {
            width: 50px;
            height: 50px;
        }

        .dropdown-user-info h4 {
            font-size: 16px;
            font-weight: 600;
            color: var(--gotur-black, #1D231F);
            margin-bottom: 4px;
        }

        .dropdown-user-info p {
            font-size: 12px;
            color: var(--gotur-text, #595959);
            margin: 0;
        }

        .dropdown-items {
            padding: 10px 0;
        }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: var(--gotur-text, #595959);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .dropdown-item i {
            width: 20px;
            font-size: 16px;
            color: var(--gotur-base, #63AB45);
        }

        .dropdown-item:hover {
            background: rgba(99, 171, 69, 0.05);
            color: var(--gotur-base, #63AB45);
            padding-left: 25px;
        }

        .dropdown-divider {
            height: 1px;
            background: #E5E7EB;
            margin: 8px 0;
        }

        .logout-item { color: #dc2626; }
        .logout-item i { color: #dc2626; }
        .logout-item:hover {
            background: rgba(220, 38, 38, 0.05);
            color: #dc2626;
        }

        /* Right side - mobile toggle only */
        .main-header__right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .mobile-nav__btn {
            display: none;
            cursor: pointer;
        }

        /* ============================================
           RESPONSIVE
           ============================================ */

        @media (max-width: 1200px) {
            .main-menu__list > li > a {
                padding: 8px 7px !important;
                font-size: 13px !important;
            }
        }

        @media (max-width: 992px) {
            .main-header__nav-wrapper { display: none; }
            .mobile-nav__btn { display: block !important; }
            .main-header__logo img { max-height: 50px !important; }
        }

        @media (max-width: 768px) {
            .page-main-content,
            .main-header .container-fluid,
            .main-footer .container {
                padding-left: 15px;
                padding-right: 15px;
            }
        }

        /* ============================================
           FOOTER - PROFESSIONAL DARK DESIGN
           ============================================ */

        .main-footer {
            width: 100% !important;
            max-width: none !important;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
            color: #ffffff !important;
            margin-top: 0;
            position: relative;
        }

        .main-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #63AB45, #4f9234, #63AB45);
        }

        .main-footer * { color: #ffffff !important; }

        .main-footer a {
            color: #cbd5e1 !important;
            transition: all 0.3s ease;
        }

        .main-footer a:hover {
            color: #63AB45 !important;
            transform: translateX(3px);
        }

        .main-footer p,
        .main-footer span,
        .main-footer li { color: #cbd5e1 !important; }

        .footer-widget__title {
            color: #ffffff !important;
            margin-bottom: 25px;
            font-size: 18px;
            font-weight: 700;
            position: relative;
            padding-bottom: 12px;
        }

        .footer-widget__title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: #63AB45;
            border-radius: 3px;
        }

        .footer-widget__about-text,
        .footer-widget__contact-text {
            color: #cbd5e1 !important;
            line-height: 1.7;
        }

        .main-footer__top {
            background: rgba(255, 255, 255, 0.03);
            padding: 5px 0;
        }

        .main-footer__top__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
        }

        .footer-widget__list {
            display: flex;
            gap: 40px;
            margin: 0;
            flex-wrap: wrap;
        }

        .footer-widget__list li {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .footer-widget__list__icon {
            width: 48px;
            height: 48px;
            background: rgba(99, 171, 69, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .footer-widget__list li:hover .footer-widget__list__icon {
            background: #63AB45;
            transform: scale(1.1);
        }

        .footer-widget__list__icon i { font-size: 20px; color: #63AB45 !important; }
        .footer-widget__list li:hover .footer-widget__list__icon i { color: #ffffff !important; }

        .footer-widget__list__subtitle {
            font-size: 12px;
            color: #94a3b8 !important;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-widget__list__content a,
        .footer-widget__list__content p { font-size: 14px; font-weight: 500; }

        .footer-widget__social {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .footer-widget__social a {
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.08);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .footer-widget__social a:hover {
            background: #63AB45;
            transform: translateY(-3px);
        }

        .footer-widget__social a i { font-size: 16px; color: #ffffff !important; }

        .footer-widget__links { list-style: none; padding: 0; margin: 0; }
        .footer-widget__links li { margin-bottom: 12px; }

        .footer-widget__links li a {
            color: #cbd5e1 !important;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            font-size: 14px;
        }

        .footer-widget__links li a:hover {
            color: #63AB45 !important;
            padding-left: 8px;
        }

        .footer-widget__newsletter .form-group__form {
            display: flex;
            margin-bottom: 15px;
            gap: 0;
        }

        .footer-widget__newsletter input {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 12px 16px;
            border-radius: 12px 0 0 12px;
            color: #ffffff !important;
            flex: 1;
            font-size: 14px;
        }

        .footer-widget__newsletter input:focus { outline: none; border-color: #63AB45; }
        .footer-widget__newsletter input::placeholder { color: #94a3b8; }

        .footer-widget__newsletter button {
            border-radius: 0 12px 12px 0;
            background: #63AB45;
            border: none;
            padding: 0 20px;
            transition: all 0.3s ease;
        }

        .footer-widget__newsletter button:hover {
            background: #4f9234;
            transform: translateX(3px);
        }

        .form-group__check { display: flex; align-items: center; gap: 10px; }
        .form-group__check input { width: 16px; height: 16px; cursor: pointer; accent-color: #63AB45; }
        .form-group__check label { color: #cbd5e1 !important; font-size: 12px; margin: 0; cursor: pointer; }
        .form-group__check a { color: #63AB45 !important; }

        .main-footer__bottom { background: #0f172a; padding: 20px 0; }

        .main-footer__bottom__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }

        .main-footer__copyright { color: #94a3b8 !important; font-size: 14px; }

        .scroll-to-target {
            width: 40px; height: 40px;
            background: #63AB45;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.3s ease;
        }

        .scroll-to-target:hover { background: #4f9234; transform: translateY(-3px); }
        .scroll-to-target i { color: #ffffff !important; font-size: 16px; }

        .main-footer__bottom__pyment img {
            height: 30px;
            filter: brightness(0) invert(1);
            opacity: 0.7;
        }

        .main-footer__element-one,
        .main-footer__element-two {
            position: absolute; bottom: 0; opacity: 0.05; pointer-events: none;
        }

        .main-footer__element-one { left: 0; }
        .main-footer__element-two { right: 0; }

        .main-footer .container,
        .main-footer__top .container,
        .main-footer__middle .container,
        .main-footer__bottom .container {
            max-width: 1260px !important;
            width: 100% !important;
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 20px !important;
            padding-right: 20px !important;
        }

        /* MAIN CONTENT */
        .page-main-content {
            max-width: 1260px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            padding-left: 20px;
            padding-right: 20px;
            min-height: 500px;
        }

        @media (max-width: 992px) {
            .footer-widget__list { flex-direction: column; gap: 20px; }
            .main-footer__top__inner { flex-direction: column; text-align: center; }
        }

        @media (max-width: 768px) {
            .main-footer__bottom__inner { flex-direction: column; text-align: center; justify-content: center; }
        }
    </style>

    @stack('css')
</head>

<body class="custom-cursor">

<div class="preloader">
    <div class="preloader__image" style="background-image: url({{asset('assets/images/igl.png')}});"></div>
</div>

<div class="page-wrapper">

    <!-- ==================== HEADER ==================== -->
    <header class="main-header main-header--one sticky-header sticky-header--normal">
        <div class="container-fluid">
            <div class="main-header__inner">

                <!-- Logo -->
                <div class="main-header__logo logo-retina">
                    <a href="{{route('home')}}" class="logo-link">
                        <img  src="{{asset('assets/images/igl.png')}}" alt="{{settings()->app_name ?? 'IGL Tour'}}" class="logo-img">
                    </a>
                </div>

                <!-- Nav + Auth inline -->
                <div class="main-header__nav-wrapper">
                    <nav class="main-header__nav main-menu">
                        <ul class="main-menu__list">
                            <li class="{{ request()->routeIs('home') ? 'current' : '' }}">
                                <a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="{{ request()->routeIs('front.about') ? 'current' : '' }}">
                                <a href="{{route('front.about')}}">About</a>
                            </li>
                            <li class="{{ request()->routeIs('front.tour-list') ? 'current' : '' }}">
                                <a href="{{route('front.tour-list')}}">Tours</a>
                            </li>
                            <li class="{{ request()->routeIs('front.hotel-list') ? 'current' : '' }}">
                                <a href="{{route('front.hotel-list')}}">Hotels</a>
                            </li>
                            <li class="{{ request()->routeIs('front.des') ? 'current' : '' }}">
                                <a href="{{route('front.des')}}">Destinations</a>
                            </li>
                            <li class="{{ request()->routeIs('front.gallery') ? 'current' : '' }}">
                                <a href="{{route('front.gallery')}}">Gallery</a>
                            </li>
                            <li class="{{ request()->routeIs('front.faq') ? 'current' : '' }}">
                                <a href="{{route('front.faq')}}">FAQ</a>
                            </li>
                            <li class="{{ request()->routeIs('front.contact') ? 'current' : '' }}">
                                <a href="{{route('front.contact')}}">Contact</a>
                            </li>

                            <!-- Auth item: acts as a normal <li> but holds dropdown -->
                            <li class="nav-auth-item">
                                @auth
                                    <div class="user-avatar" id="userAvatarBtn">
                                        @if(Auth::user()->avatar)
                                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                                        @else
                                            <i class="fas fa-user"></i>
                                        @endif
                                    </div>
                                    <div class="user-dropdown-menu">
                                        <div class="dropdown-header">
                                            <div class="user-avatar">
                                                @if(Auth::user()->avatar)
                                                    <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                                                @else
                                                    <i class="fas fa-user"></i>
                                                @endif
                                            </div>
                                            <div class="dropdown-user-info">
                                                <h4>{{ Auth::user()->name }}</h4>
                                                <p>{{ Auth::user()->email }}</p>
                                            </div>
                                        </div>
                                        <div class="dropdown-items">
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-user-circle"></i>
                                                <span>My Profile</span>
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-ticket-alt"></i>
                                                <span>My Bookings</span>
                                            </a>

                                            <div class="dropdown-divider"></div>
                                            <a href="{{route('admin.logout')}}" class="dropdown-item logout-item">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <span>Logout</span>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{route('front.login')}}" class="gotur-btn main-header__btn">
                                        <span>Login</span>
                                        <i class="icon-paper-plane"></i>
                                    </a>
                                @endauth
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Mobile toggle -->
                <div class="main-header__right">
                    <div class="mobile-nav__btn mobile-nav__toggler">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="page-main-content">
        @yield('content')
    </main>

    <!-- ==================== FOOTER ==================== -->
    <footer class="main-footer">
        <div class="main-footer__top">
            <div class="container">
                <div class="main-footer__top__inner wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                    <div class="footer-widget__logo logo-retina">
                        <a href="{{route('home')}}"><img src="{{asset('assets/images/igl.png')}}" alt="gotur logo"></a>
                    </div>
                    <ul class="list-unstyled footer-widget__list">
                        <li>
                            <div class="footer-widget__list__icon"><i class="icon-email"></i></div>
                            <div class="footer-widget__list__content">
                                <span class="footer-widget__list__subtitle">Send Email</span>
                                <a href="mailto:{{settings()->app_email??'Null'}}">{{settings()->app_email??'Null'}}</a>
                            </div>
                        </li>
                        <li>
                            <div class="footer-widget__list__icon"><i class="icon-telephone"></i></div>
                            <div class="footer-widget__list__content">
                                <span class="footer-widget__list__subtitle">Call Agent</span>
                                <a href="tel:{{settings()->app_phone??'Null'}}">{{settings()->app_phone??'Null'}}</a>
                            </div>
                        </li>
                        <li>
                            <div class="footer-widget__list__icon"><i class="icon-clock-1"></i></div>
                            <div class="footer-widget__list__content">
                                <span class="footer-widget__list__subtitle">Opening Time</span>
                                <p>{{settings()->app_working_hour??''}}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-footer__middle">
            <div class="container">
                <div class="row gutter-y-40">
                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                        <div class="footer-widget footer-widget--about">
                            <h2 class="footer-widget__title">About {{settings()->app_name}}</h2>
                            <p class="footer-widget__about-text">{{ Illuminate\Support\Str::limit(settings()->app_about??'', 150) }}</p>
                            <div class="footer-widget__social">
                                <a href="{{settings()->app_facebook}}"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                <a href="{{settings()->app_twitter??'#'}}"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                <a href="{{settings()->app_instagram??'#'}}"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                <a href="{{settings()->app_youtube??'#'}}"><i class="fab fa-youtube" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                        <div class="footer-widget footer-widget--links">
                            <h2 class="footer-widget__title">Popular Destinations</h2>
                            <ul class="list-unstyled footer-widget__links">
                                <li><a href="#">Bali, Indonesia</a></li>
                                <li><a href="#">Paris, France</a></li>
                                <li><a href="#">Dubai, UAE</a></li>
                                <li><a href="#">Tokyo, Japan</a></li>
                                <li><a href="#">New York, USA</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="400ms">
                        <div class="footer-widget footer-widget--links">
                            <h2 class="footer-widget__title">Useful Links</h2>
                            <ul class="list-unstyled footer-widget__links">
                                <li><a href="{{route('front.about')}}">About Us</a></li>
                                <li><a href="{{route('front.des')}}">Destinations</a></li>
                                <li><a href="#">Blog & News</a></li>
                                <li><a href="#">Meet Our Guides</a></li>
                                <li><a href="{{route('front.contact')}}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 col-xl-3 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="600ms">
                        <div class="footer-widget footer-widget--contact">
                            <h2 class="footer-widget__title">Newsletter</h2>
                            <p class="footer-widget__contact-text">Subscribe to get exclusive deals and travel inspiration straight to your inbox.</p>
                            <form action="#" data-url="MAILCHIMP_FORM_URL" class="footer-widget__newsletter mc-form">
                                <div class="form-group__form">
                                    <input type="email" name="EMAIL" placeholder="Your email address">
                                    <button type="submit" class="gotur-btn"><i class="fas fa-paper-plane"></i></button>
                                </div>
                                <div class="form-group__check">
                                    <input type="checkbox" name="checkbox" id="check">
                                    <label for="check">I agree to the <a href="{{route('front.faq')}}">Privacy Policy</a></label>
                                </div>
                            </form>
                            <div class="mc-form__response"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-footer__element-one">
                <img src="{{asset('assets/images/shapes/footer-shape-1-1.png')}}" alt="">
            </div>
            <div class="main-footer__element-two">
                <img src="{{asset('assets/images/shapes/footer-shape-1-2.png')}}" alt="">
            </div>
        </div>

        <div class="main-footer__bottom">
            <div class="container">
                <div class="main-footer__bottom__inner">
                    <p class="main-footer__copyright">
                        &copy; Copyright <span class="dynamic-year"></span> {{settings()->app_name}}. All rights reserved.
                    </p>
                    <div class="main-footer__bottom__pyment">
                        Payments Methods
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- ==================== OVERLAYS & POPUPS ==================== -->
<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>
        <div class="logo-box logo-retina">
            <a href="{{route('home')}}" aria-label="logo image">
                <img src="{{asset('assets/images/igl.png')}}" width="200px" height="100px" alt="logo">
            </a>
        </div>
        <div class="mobile-nav__container"></div>
        <ul class="mobile-nav__contact list-unstyled">
            <li>
                <span class="mobile-nav__contact__icon"><i class="fa fa-envelope"></i></span>
                <a href="mailto:{{settings()->app_email}}">{{settings()->app_email}}</a>
            </li>
            <li>
                <span class="mobile-nav__contact__icon"><i class="fa fa-phone-alt"></i></span>
                <a href="tel:{{settings()->app_phone}}">{{settings()->app_phone}}</a>
            </li>
        </ul>
        <div class="mobile-nav__social">
            <a href="{{settings()->app_facebook}}"><i class="fab fa-facebook-f"></i></a>
            <a href="{{settings()->app_twitter}}"><i class="fab fa-twitter"></i></a>
            <a href="{{settings()->app_instagram}}"><i class="fab fa-instagram"></i></a>
            <a href="{{settings()->app_youtube}}"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</div>

<div class="search-popup">
    <div class="search-popup__overlay search-toggler"></div>
    <div class="search-popup__content">
        <form role="search" method="get" class="search-popup__form" action="#">
            <input type="text" id="search" placeholder="Search Here...">
            <button type="submit" aria-label="search submit" class="gotur-btn"><i class="icon-search"></i></button>
        </form>
    </div>
</div>

<div class="header-right-sidebar">
    <div class="header-right-sidebar__overlay header-right-sidebar__toggler"></div>
    <div class="header-right-sidebar__content">
        <span class="header-right-sidebar__close header-right-sidebar__toggler"><i class="fa fa-times"></i></span>
        <div class="header-right-sidebar__logo-box">
            <a href="{{route('home')}}" aria-label="logo image"><img src="{{asset('assets/images/igl.png')}}" width="200" alt=""></a>
        </div>
        <div class="header-right-sidebar__container">
            <div class="header-right-sidebar__container__about">
                <h3 class="header-right-sidebar__container__title">We're Number One Travel Adventure Company</h3>
                <p class="header-right-sidebar__container__text">{{settings()->app_about}}</p>
            </div>
            <div class="header-right-sidebar__container__contact">
                <h3 class="header-right-sidebar__container__title">Contact Us</h3>
                <ul class="header-right-sidebar__container__list list-unstyled">
                    <li class="header-right-sidebar__container__list__item">
                        <div class="header-right-sidebar__container__icon"><i class="icon-email"></i></div>
                        <div class="header-right-sidebar__container__list__content">
                            <span class="header-right-sidebar__container__list__title">Send Email</span>
                            <a href="mail:{{settings()->app_email}}">{{settings()->app_email}}</a>
                        </div>
                    </li>
                    <li class="header-right-sidebar__container__list__item">
                        <div class="header-right-sidebar__container__icon"><i class="icon-telephone"></i></div>
                        <div class="header-right-sidebar__container__list__content">
                            <span class="header-right-sidebar__container__list__title">Call Agent</span>
                            <a href="{{'tel:'.settings()->app_phone}}">{{settings()->app_phone}}</a>
                        </div>
                    </li>
                    <li class="header-right-sidebar__container__list__item">
                        <div class="header-right-sidebar__container__icon"><i class="icon-clock"></i></div>
                        <div class="header-right-sidebar__container__list__content">
                            <span class="header-right-sidebar__container__list__title">Opening Time</span>
                            <p>{{settings()->app_working_hour}}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="scroll-top" class="scroll-top">
    <span id="scroll-top-value" class="scroll-top-value"></span>
</div>

<!-- ==================== SCRIPTS ==================== -->
<script src="{{asset('assets/vendors/jquery/jquery-3.7.1.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
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
<script src="{{asset('assets/vendors/gsap/gsap.js')}}"></script>
<script src="{{asset('assets/vendors/gsap/scrollTrigger.min.js')}}"></script>
<script src="{{asset('assets/vendors/gsap/splittext.min.js')}}"></script>
<script src="{{asset('assets/vendors/gsap/gotur-gsap.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script src="{{asset('assets/js/gotur.js')}}"></script>

@stack('js')

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // User dropdown toggle - now targets .nav-auth-item (the <li>)
        const authItem = document.querySelector('.nav-auth-item');
        const avatarBtn = document.getElementById('userAvatarBtn');

        if (authItem && avatarBtn) {
            avatarBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                authItem.classList.toggle('active');
            });

            document.addEventListener('click', function (e) {
                if (!authItem.contains(e.target)) {
                    authItem.classList.remove('active');
                }
            });
        }

        // Dynamic copyright year
        const yearEl = document.querySelector('.dynamic-year');
        if (yearEl) yearEl.textContent = new Date().getFullYear();

    });
</script>

</body>
</html>
