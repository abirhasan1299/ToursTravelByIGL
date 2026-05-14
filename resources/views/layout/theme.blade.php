
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
    <meta name="twitter:title" content="@yield('twitter_title', 'Default Title')">
    <meta name="twitter:description" content="@yield('twitter_meta_description', 'Default description')">
    <meta name="twitter:image" content="@yield('twitter_meta_image', asset('default.jpg'))">

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
        body {
            position: relative;
            z-index: 1;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: url("{{ asset('assets/images/backgrounds/bg-prime.jpg') }}") no-repeat center center;
            background-size: cover;
            filter: blur(6px);
            transform: scale(1.05);
            z-index: -2;
        }

        body::after {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.2);
            z-index: -1;
        }

        /* ============================================
           HEADER — STICKY + FULL WIDTH
           ============================================ */

        .main-header {
            width: 100% !important;
            max-width: none !important;
            background: #ffffff !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 9999 !important;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            transition: box-shadow 0.3s ease, padding 0.3s ease;
        }

        .main-header.scrolled {
            box-shadow: 0 4px 24px rgba(0,0,0,0.13) !important;
        }

        .page-wrapper {
            padding-top: 88px;
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
            height: 72px;
            transition: height 0.3s ease;
        }

        .main-header.scrolled .main-header__inner {
            height: 60px;
        }

        .main-header__logo { flex-shrink: 0; }

        .main-header__logo img {
            max-height: 60px !important;
            width: auto;
            transition: all 0.3s ease;
        }

        .main-header.scrolled .main-header__logo img {
            max-height: 46px !important;
        }

        /* ============================================
           DESKTOP NAV
           ============================================ */

        .main-header__nav-wrapper {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            overflow: visible;
        }

        .main-header__nav.main-menu {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            width: 100%;
        }

        .main-menu__list {
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
            list-style: none;
            flex-wrap: nowrap;
            gap: 2px;
        }

        .main-menu__list > li {
            white-space: nowrap;
            margin: 0;
            display: flex;
            align-items: center;
            position: relative;
        }

        .main-menu__list > li > a {
            padding: 6px 11px !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            color: #374151 !important;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            border-radius: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .main-menu__list > li > a:hover,
        .main-menu__list > li.current > a {
            color: #63AB45 !important;
            background: rgba(99,171,69,0.08);
        }

        /* ============================================
           GALLERY DROPDOWN — DESKTOP (FIXED)
           ============================================ */

        .nav-gallery-item {
            position: relative;
        }

        /* Chevron icon next to Gallery */
        .nav-gallery-item > a .nav-chevron {
            font-size: 10px;
            opacity: 0.6;
            transition: transform 0.25s ease, opacity 0.25s ease;
        }

        .nav-gallery-item:hover > a .nav-chevron {
            transform: rotate(180deg);
            opacity: 1;
        }

        /* Dropdown panel - important: higher z-index and proper pointer-events */
        .nav-gallery-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%) translateY(-6px);
            width: 200px;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 16px 44px rgba(0,0,0,0.12);
            border: 1px solid rgba(99,171,69,0.12);
            padding: 6px 0;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.22s ease, transform 0.22s ease, visibility 0.22s ease;
            z-index: 10002;
            pointer-events: none;
        }

        /* Small arrow tip */
        .nav-gallery-dropdown::before {
            content: '';
            position: absolute;
            top: -7px;
            left: 50%;
            transform: translateX(-50%);
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            border-bottom: 7px solid #ffffff;
            filter: drop-shadow(0 -2px 2px rgba(0,0,0,0.06));
        }

        /* Hover state: ensure dropdown remains interactive */
        .nav-gallery-item:hover .nav-gallery-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
            pointer-events: auto;
        }

        /* Also keep dropdown visible when hovering directly over the dropdown itself
           to prevent disappearing when moving cursor from link to dropdown */
        .nav-gallery-dropdown:hover {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
            pointer-events: auto;
        }

        .nav-gallery-dropdown a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            font-size: 13px;
            font-weight: 500;
            color: #374151 !important;
            text-decoration: none;
            transition: all 0.2s ease;
            border-radius: 0;
            background: #ffffff;
        }

        .nav-gallery-dropdown a i {
            width: 18px;
            font-size: 13px;
            color: #63AB45;
            text-align: center;
            flex-shrink: 0;
        }

        .nav-gallery-dropdown a:hover {
            background: rgba(99,171,69,0.07);
            color: #63AB45 !important;
            padding-left: 22px;
        }

        .nav-gallery-dropdown a:first-child { border-radius: 8px 8px 0 0; }
        .nav-gallery-dropdown a:last-child  { border-radius: 0 0 8px 8px; }

        /* ============================================
           AUTH ITEM
           ============================================ */

        .main-menu__list > li.nav-auth-item {
            flex-shrink: 0;
            position: relative;
            margin-left: 8px;
        }

        .main-menu__list > li.nav-auth-item .gotur-btn.main-header__btn {
            padding: 9px 20px !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            border-radius: 50px !important;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #63AB45;
            color: #ffffff !important;
            text-decoration: none;
            box-shadow: 0 3px 12px rgba(99,171,69,0.35);
            transition: all 0.25s ease;
        }

        .main-menu__list > li.nav-auth-item .gotur-btn.main-header__btn:hover {
            background: #4f9234;
            box-shadow: 0 5px 18px rgba(99,171,69,0.45);
            transform: translateY(-1px);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #63AB45 0%, #4f9234 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 2.5px solid rgba(99,171,69,0.25);
            overflow: hidden;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(99,171,69,0.35);
            border-color: #63AB45;
        }

        .user-avatar i  { color: #fff; font-size: 17px; }
        .user-avatar img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }

        .user-dropdown-menu {
            position: absolute;
            top: calc(100% + 14px);
            right: 0;
            width: 285px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.14);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px) scale(0.97);
            transition: all 0.25s cubic-bezier(0.4,0,0.2,1);
            z-index: 10001;
            border: 1px solid rgba(99,171,69,0.12);
        }

        .nav-auth-item.active .user-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .dropdown-header {
            padding: 18px 20px;
            border-bottom: 1px solid #E5E7EB;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .dropdown-header .user-avatar { width: 48px; height: 48px; }

        .dropdown-user-info h4 {
            font-size: 15px;
            font-weight: 600;
            color: #1D231F;
            margin-bottom: 3px;
        }

        .dropdown-user-info p {
            font-size: 12px;
            color: #6b7280;
            margin: 0;
        }

        .dropdown-items { padding: 8px 0; }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 20px;
            color: #4b5563;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .dropdown-item i {
            width: 20px;
            font-size: 15px;
            color: #63AB45;
        }

        .dropdown-item:hover {
            background: rgba(99,171,69,0.06);
            color: #63AB45;
            padding-left: 24px;
        }

        .dropdown-divider { height: 1px; background: #E5E7EB; margin: 6px 0; }

        .logout-item { color: #dc2626 !important; }
        .logout-item i { color: #dc2626 !important; }
        .logout-item:hover { background: rgba(220,38,38,0.05) !important; color: #dc2626 !important; }

        .main-header__right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        /* ============================================
           HAMBURGER BUTTON
           ============================================ */

        .mobile-nav__btn {
            display: none;
            cursor: pointer;
            border: none;
            background: transparent;
            padding: 0;
        }

        .hamburger-box {
            width: 46px;
            height: 46px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            background: #ffffff;
            border: 2px solid rgba(99,171,69,0.3);
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
            transition: all 0.25s ease;
        }

        .hamburger-box span {
            display: block;
            width: 22px;
            height: 2.5px;
            background: #63AB45;
            border-radius: 3px;
            transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
            transform-origin: center;
        }

        .mobile-nav__btn:hover .hamburger-box {
            background: rgba(99,171,69,0.07);
            border-color: #63AB45;
            box-shadow: 0 0 0 3px rgba(99,171,69,0.12);
        }

        .mobile-nav__btn.is-open .hamburger-box {
            background: #63AB45;
            border-color: #63AB45;
            box-shadow: 0 4px 16px rgba(99,171,69,0.4);
        }

        .mobile-nav__btn.is-open .hamburger-box span { background: #ffffff; }
        .mobile-nav__btn.is-open .hamburger-box span:nth-child(1) { transform: translateY(7.5px) rotate(45deg); }
        .mobile-nav__btn.is-open .hamburger-box span:nth-child(2) { opacity: 0; transform: scaleX(0); }
        .mobile-nav__btn.is-open .hamburger-box span:nth-child(3) { transform: translateY(-7.5px) rotate(-45deg); }

        /* ============================================
           RESPONSIVE BREAKPOINTS
           ============================================ */

        @media (max-width: 1200px) {
            .main-menu__list > li > a {
                padding: 6px 8px !important;
                font-size: 13px !important;
            }
        }

        @media (max-width: 992px) {
            .main-header__nav-wrapper { display: none !important; }
            .mobile-nav__btn { display: flex !important; }
            .page-wrapper { padding-top: 72px; }
            .main-header__inner { height: 60px; }
            .main-header__logo img { max-height: 46px !important; }
        }

        @media (max-width: 768px) {
            .page-wrapper { padding-top: 64px; }
            .main-header__inner { height: 54px; }
            .page-main-content,
            .main-header .container-fluid,
            .main-footer .container {
                padding-left: 15px;
                padding-right: 15px;
            }
        }

        /* ============================================
           FOOTER
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
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #63AB45, #4f9234, #63AB45);
        }

        .main-footer * { color: #ffffff !important; }
        .main-footer a { color: #cbd5e1 !important; transition: all 0.3s ease; }
        .main-footer a:hover { color: #63AB45 !important; transform: translateX(3px); }
        .main-footer p, .main-footer span, .main-footer li { color: #cbd5e1 !important; }

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
            bottom: 0; left: 0;
            width: 40px; height: 3px;
            background: #63AB45;
            border-radius: 3px;
        }

        .footer-widget__about-text,
        .footer-widget__contact-text { color: #cbd5e1 !important; line-height: 1.7; }

        .main-footer__top { background: rgba(255,255,255,0.03); padding: 5px 0; }

        .main-footer__top__inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
        }

        .footer-widget__list { display: flex; gap: 40px; margin: 0; flex-wrap: wrap; }
        .footer-widget__list li { display: flex; align-items: center; gap: 15px; }

        .footer-widget__list__icon {
            width: 48px; height: 48px;
            background: rgba(99,171,69,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .footer-widget__list li:hover .footer-widget__list__icon { background: #63AB45; transform: scale(1.1); }
        .footer-widget__list__icon i { font-size: 20px; color: #63AB45 !important; }
        .footer-widget__list li:hover .footer-widget__list__icon i { color: #ffffff !important; }
        .footer-widget__list__subtitle { font-size: 12px; color: #94a3b8 !important; text-transform: uppercase; letter-spacing: 1px; }
        .footer-widget__list__content a, .footer-widget__list__content p { font-size: 14px; font-weight: 500; }

        .footer-widget__social { display: flex; gap: 12px; margin-top: 20px; }
        .footer-widget__social a { width: 38px; height: 38px; background: rgba(255,255,255,0.08); display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; transition: all 0.3s ease; }
        .footer-widget__social a:hover { background: #63AB45; transform: translateY(-3px); }
        .footer-widget__social a i { font-size: 16px; color: #ffffff !important; }

        .footer-widget__links { list-style: none; padding: 0; margin: 0; }
        .footer-widget__links li { margin-bottom: 3px; }
        .footer-widget__links li a { color: #cbd5e1 !important; text-decoration: none; transition: all 0.3s ease; display: inline-block; font-size: 14px; }
        .footer-widget__links li a:hover { color: #63AB45 !important; padding-left: 8px; }

        .footer-widget__newsletter .form-group__form { display: flex; margin-bottom: 15px; gap: 0; }
        .footer-widget__newsletter input { background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); padding: 12px 16px; border-radius: 12px 0 0 12px; color: #ffffff !important; flex: 1; font-size: 14px; }
        .footer-widget__newsletter input:focus { outline: none; border-color: #63AB45; }
        .footer-widget__newsletter input::placeholder { color: #94a3b8; }
        .footer-widget__newsletter button { border-radius: 0 12px 12px 0; background: #63AB45; border: none; padding: 0 20px; transition: all 0.3s ease; }
        .footer-widget__newsletter button:hover { background: #4f9234; transform: translateX(3px); }

        .form-group__check { display: flex; align-items: center; gap: 10px; }
        .form-group__check input { width: 16px; height: 16px; cursor: pointer; accent-color: #63AB45; }
        .form-group__check label { color: #cbd5e1 !important; font-size: 12px; margin: 0; cursor: pointer; }
        .form-group__check a { color: #63AB45 !important; }

        .main-footer__bottom {
            background: #0a101c;
            padding: 25px 0 30px;
            border-top: 1px solid rgba(99,171,69,0.25);
            position: relative;
        }

        .main-footer__bottom__inner { display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; gap: 25px; }
        .main-footer__bottom__payment { width: 100%; margin: 0 auto; }
        .payment-icons-wrapper { width: 100%; background: none !important; padding: 0 !important; border-radius: 0 !important; display: block; }
        .main-footer__bottom__payment img { width: 100% !important; max-width: none !important; height: auto !important; filter: none !important; -webkit-filter: none !important; opacity: 1 !important; display: block; margin: 0 auto; object-fit: contain; }

        .main-footer__copyright { margin: 0; color: #cbd5e1 !important; font-size: 14px; line-height: 1.6; max-width: 900px; width: 100%; }
        .main-footer__copyright p { margin: 0 0 8px 0; color: #e2e8f0 !important; }

        .main-footer__credits { color: #94a3b8 !important; font-size: 13px; display: flex; flex-wrap: wrap; justify-content: center; gap: 12px; row-gap: 8px; }
        .main-footer__credits .credit-sep { color: #63AB45; font-weight: 400; opacity: 0.7; }
        .main-footer__credits a { color: #a5f3c3 !important; text-decoration: none; font-weight: 500; transition: all 0.2s ease; border-bottom: 1px dotted transparent; }
        .main-footer__credits a:hover { color: #63AB45 !important; border-bottom-color: #63AB45; transform: translateY(-1px); }

        @media (max-width: 768px) {
            .main-footer__credits { flex-direction: column; gap: 8px; }
            .main-footer__credits .credit-sep { display: none; }
            .main-footer__copyright { font-size: 13px; }
        }

        @media (max-width: 480px) {
            .main-footer__bottom { padding: 20px 0; }
        }

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

        .page-main-content { max-width: 1260px; width: 100%; margin-left: auto; margin-right: auto; padding-left: 20px; padding-right: 20px; min-height: 500px; }

        @media (max-width: 992px) {
            .footer-widget__list { flex-direction: column; gap: 20px; }
            .main-footer__top__inner { flex-direction: column; text-align: center; }
        }

        @media (max-width: 768px) {
            .main-footer__bottom__inner { flex-direction: column; text-align: center; justify-content: center; }
        }

        /* ============================================
           MOBILE DRAWER NAV
           ============================================ */

        .mobile-drawer-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15,23,42,0.55);
            z-index: 10099;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.35s ease, visibility 0.35s ease;
            backdrop-filter: blur(2px);
        }

        .mobile-drawer-overlay.active { opacity: 1; visibility: visible; }

        .mobile-drawer {
            position: fixed;
            top: 0; right: 0;
            width: 300px;
            max-width: 88vw;
            height: 100%;
            background: #ffffff;
            z-index: 10100;
            display: flex;
            flex-direction: column;
            transition: transform 0.38s cubic-bezier(0.4,0,0.2,1);
            box-shadow: -8px 0 40px rgba(0,0,0,0.18);
            overflow-y: auto;
            transform: translateX(100%);
        }

        .mobile-drawer.active { transform: translateX(0); }

        .mobile-drawer__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 18px;
            background: linear-gradient(135deg, #f8fdf5 0%, #ffffff 100%);
            border-bottom: 2px solid rgba(99,171,69,0.12);
            flex-shrink: 0;
        }

        .mobile-drawer__header img { height: 42px; width: auto; }

        .mobile-drawer__close {
            width: 38px; height: 38px;
            border: none;
            background: rgba(99,171,69,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }

        .mobile-drawer__close:hover { background: #63AB45; }
        .mobile-drawer__close:hover i { color: #fff; }
        .mobile-drawer__close i { font-size: 13px; color: #63AB45; transition: color 0.2s ease; }

        .mobile-drawer__nav { flex: 1; padding: 8px 12px; }
        .mobile-drawer__nav ul { list-style: none; margin: 0; padding: 0; }
        .mobile-drawer__nav ul li { margin-bottom: 2px; }

        .mobile-drawer__nav ul li a {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            font-size: 15px;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
            transition: all 0.22s ease;
            border-radius: 10px;
            gap: 10px;
        }

        .mobile-drawer__nav ul li a::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #d1d5db;
            flex-shrink: 0;
            transition: all 0.22s ease;
        }

        .mobile-drawer__nav ul li a:hover,
        .mobile-drawer__nav ul li.current a {
            color: #63AB45;
            background: rgba(99,171,69,0.08);
            padding-left: 20px;
        }

        .mobile-drawer__nav ul li a:hover::before,
        .mobile-drawer__nav ul li.current a::before {
            background: #63AB45;
            transform: scale(1.4);
        }

        /* GALLERY ACCORDION — MOBILE DRAWER */
        .mobile-drawer__nav ul li.drawer-gallery-item > a {
            justify-content: space-between;
        }

        .mobile-drawer__nav ul li.drawer-gallery-item > a::before {
            display: none;
        }

        .drawer-gallery-chevron {
            font-size: 11px;
            color: #9ca3af;
            transition: transform 0.25s ease, color 0.25s ease;
            margin-left: auto;
            flex-shrink: 0;
        }

        .drawer-gallery-item.is-open > a .drawer-gallery-chevron {
            transform: rotate(180deg);
            color: #63AB45;
        }

        .drawer-gallery-sub {
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease;
        }

        .drawer-gallery-item.is-open .drawer-gallery-sub {
            max-height: 200px;
        }

        .drawer-gallery-sub a {
            padding-left: 34px !important;
            font-size: 14px !important;
            color: #6b7280 !important;
        }

        .drawer-gallery-sub a::before {
            width: 4px !important;
            height: 4px !important;
            background: #d1d5db !important;
        }

        .drawer-gallery-sub a:hover {
            color: #63AB45 !important;
            padding-left: 38px !important;
        }

        .drawer-gallery-sub a:hover::before { background: #63AB45 !important; }

        .mobile-drawer__divider { height: 1px; background: linear-gradient(90deg,transparent,#E5E7EB,transparent); margin: 4px 18px; flex-shrink: 0; }

        .mobile-drawer__auth { padding: 14px 16px; flex-shrink: 0; }

        .mobile-drawer__user { display: flex; align-items: center; gap: 12px; padding: 12px 14px; background: linear-gradient(135deg, rgba(99,171,69,0.08) 0%, rgba(79,146,52,0.04) 100%); border-radius: 14px; margin-bottom: 10px; border: 1px solid rgba(99,171,69,0.12); }
        .mobile-drawer__user .user-avatar { width: 44px; height: 44px; flex-shrink: 0; }
        .mobile-drawer__user-info h5 { font-size: 14px; font-weight: 700; color: #1D231F; margin: 0 0 2px; }
        .mobile-drawer__user-info p { font-size: 11px; color: #6b7280; margin: 0; }

        .mobile-drawer__user-links { list-style: none; margin: 0 0 8px; padding: 0; display: flex; flex-direction: column; gap: 2px; }
        .mobile-drawer__user-links li a { display: flex; align-items: center; gap: 10px; padding: 10px 14px; font-size: 14px; font-weight: 500; color: #374151; text-decoration: none; border-radius: 10px; transition: all 0.2s ease; }
        .mobile-drawer__user-links li a i { width: 18px; color: #63AB45; font-size: 15px; text-align: center; }
        .mobile-drawer__user-links li a:hover { background: rgba(99,171,69,0.08); color: #63AB45; }
        .mobile-drawer__user-links li.logout-item a { color: #dc2626; }
        .mobile-drawer__user-links li.logout-item a i { color: #dc2626; }
        .mobile-drawer__user-links li.logout-item a:hover { background: rgba(220,38,38,0.06); }

        .mobile-drawer__login-btn { display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 13px 20px; background: linear-gradient(135deg, #63AB45, #4f9234); color: #ffffff !important; border-radius: 50px; font-size: 15px; font-weight: 600; text-decoration: none; box-shadow: 0 4px 16px rgba(99,171,69,0.4); transition: all 0.25s ease; }
        .mobile-drawer__login-btn:hover { background: linear-gradient(135deg, #4f9234, #3d7228); box-shadow: 0 6px 20px rgba(99,171,69,0.5); transform: translateY(-1px); color: #ffffff !important; }

        .mobile-drawer__contacts { padding: 14px 16px; border-top: 1px solid #E5E7EB; flex-shrink: 0; display: flex; flex-direction: column; gap: 8px; }
        .mobile-drawer__contacts a { display: flex; align-items: center; gap: 10px; font-size: 13px; color: #6b7280; text-decoration: none; padding: 6px 10px; border-radius: 8px; transition: all 0.2s ease; }
        .mobile-drawer__contacts a:hover { color: #63AB45; background: rgba(99,171,69,0.06); }
        .mobile-drawer__contacts a i { width: 16px; color: #63AB45; font-size: 13px; text-align: center; }

        .mobile-drawer__social { display: flex; gap: 10px; padding: 12px 16px 20px; flex-shrink: 0; align-items: center; }
        .mobile-drawer__social-label { font-size: 12px; color: #9ca3af; font-weight: 500; margin-right: 4px; }
        .mobile-drawer__social a { width: 36px; height: 36px; background: rgba(99,171,69,0.1); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; transition: all 0.22s ease; text-decoration: none; }
        .mobile-drawer__social a:hover { background: #63AB45; transform: translateY(-2px); }
        .mobile-drawer__social a i { font-size: 14px; color: #63AB45; transition: color 0.2s ease; }
        .mobile-drawer__social a:hover i { color: #ffffff; }

        @media (min-width: 993px) {
            .mobile-drawer, .mobile-drawer-overlay { display: none !important; }
        }

        @media (max-width: 992px) {
            .footer-widget__list { flex-direction: column; gap: 20px; }
            .main-footer__top__inner { flex-direction: column; text-align: center; }
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
                        <img src="{{asset('assets/images/igl.png')}}" alt="{{settings()->app_name ?? 'IGL Tour'}}" class="logo-img">
                    </a>
                </div>

                <!-- Nav + Auth inline (desktop only) -->
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
                                <a href="{{route('front.tour-list')}}">Packages</a>
                            </li>
                            <li class="{{ request()->routeIs('front.des') ? 'current' : '' }}">
                                <a href="{{route('front.des')}}">Tours Spot</a>
                            </li>

                            {{-- ── Gallery with dropdown (FIXED) ── --}}
                            <li class="nav-gallery-item">
                                <a href="javascript:void(0);">
                                    Gallery
                                    <i class="fas fa-chevron-down nav-chevron"></i>
                                </a>
                                <div class="nav-gallery-dropdown">
                                    <a href="{{ route('front.gallery') }}">
                                        <i class="fas fa-images"></i>
                                        Photo Gallery
                                    </a>
                                    <a href="{{route('front.videos')}}">
                                        <i class="fas fa-play-circle"></i>
                                        Video Gallery
                                    </a>
                                </div>
                            </li>

                            <li class="{{ request()->routeIs('front.faq') ? 'current' : '' }}">
                                <a href="{{route('front.faq')}}">FAQ</a>
                            </li>
                            <li class="{{ request()->routeIs('front.contact') ? 'current' : '' }}">
                                <a href="{{route('front.contact')}}">Contact</a>
                            </li>

                            <!-- Auth item -->
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
{{--                                            <a href="{{route('user.profile')}}" class="dropdown-item">--}}
{{--                                                <i class="fas fa-user-circle"></i>--}}
{{--                                                <span>My Profile</span>--}}
{{--                                            </a>--}}
                                            <a href="{{route('user.bookings')}}" class="dropdown-item">
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
                    <button class="mobile-nav__btn" id="mobileDrawerToggle" type="button" aria-label="Open menu">
                        <div class="hamburger-box">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>
                </div>

            </div>
        </div>
    </header>

    <!-- ==================== MOBILE DRAWER ==================== -->
    <div class="mobile-drawer-overlay" id="mobileDrawerOverlay"></div>

    <div class="mobile-drawer" id="mobileDrawer">

        <!-- Drawer header -->
        <div class="mobile-drawer__header">
            <a href="{{route('home')}}">
                <img src="{{asset('assets/images/igl.png')}}" alt="{{settings()->app_name ?? 'IGL Tour'}}">
            </a>
            <button class="mobile-drawer__close" id="mobileDrawerClose" aria-label="Close menu">
                <i class="fa fa-times"></i>
            </button>
        </div>

        <!-- Drawer nav links -->
        <nav class="mobile-drawer__nav">
            <ul>
                <li class="{{ request()->routeIs('home') ? 'current' : '' }}">
                    <a href="{{route('home')}}">Home</a>
                </li>
                <li class="{{ request()->routeIs('front.about') ? 'current' : '' }}">
                    <a href="{{route('front.about')}}">About</a>
                </li>
                <li class="{{ request()->routeIs('front.tour-list') ? 'current' : '' }}">
                    <a href="{{route('front.tour-list')}}">Tours</a>
                </li>
                <li class="{{ request()->routeIs('front.des') ? 'current' : '' }}">
                    <a href="{{route('front.des')}}">Destinations</a>
                </li>

                {{-- Gallery accordion for mobile --}}
                <li class="drawer-gallery-item" id="drawerGalleryItem">
                    <a href="javascript:void(0);" id="drawerGalleryToggle">
                        Gallery
                        <i class="fas fa-chevron-down drawer-gallery-chevron"></i>
                    </a>
                    <div class="drawer-gallery-sub">
                        <a href="{{ route('front.gallery') }}">
                            <i class="fas fa-images" style="width:16px;color:#63AB45;margin-right:6px;"></i>
                            Photo Gallery
                        </a>
                        <a href="{{route('front.videos')}}">
                            <i class="fas fa-play-circle" style="width:16px;color:#63AB45;margin-right:6px;"></i>
                            Video Gallery
                        </a>
                    </div>
                </li>

                <li class="{{ request()->routeIs('front.faq') ? 'current' : '' }}">
                    <a href="{{route('front.faq')}}">FAQ</a>
                </li>
                <li class="{{ request()->routeIs('front.contact') ? 'current' : '' }}">
                    <a href="{{route('front.contact')}}">Contact</a>
                </li>
            </ul>
        </nav>

        <div class="mobile-drawer__divider"></div>

        <!-- Drawer auth section -->
        <div class="mobile-drawer__auth">
            @auth
                <div class="mobile-drawer__user">
                    <div class="user-avatar">
                        @if(Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}">
                        @else
                            <i class="fas fa-user"></i>
                        @endif
                    </div>
                    <div class="mobile-drawer__user-info">
                        <h5>{{ Auth::user()->name }}</h5>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <ul class="mobile-drawer__user-links">
                    <li>
                        <a href="{{route('user.profile')}}">
                            <i class="fas fa-user-circle"></i>
                            My Profile
                        </a>
                    </li>
                    <li>
                        <a href="{{route('user.bookings')}}">
                            <i class="fas fa-ticket-alt"></i>
                            My Bookings
                        </a>
                    </li>
                    <li class="logout-item">
                        <a href="{{route('admin.logout')}}">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            @else
                <a href="{{route('front.login')}}" class="mobile-drawer__login-btn">
                    <i class="icon-paper-plane"></i>
                    Login
                </a>
            @endauth
        </div>

        <!-- Drawer contact info -->
        <div class="mobile-drawer__contacts">
            <a href="mailto:{{settings()->app_email}}">
                <i class="fa fa-envelope"></i>
                {{settings()->app_email}}
            </a>
            <a href="tel:{{settings()->app_phone}}">
                <i class="fa fa-phone-alt"></i>
                {{settings()->app_phone}}
            </a>
        </div>

        <!-- Drawer social icons -->
        <div class="mobile-drawer__social">
            <a href="{{settings()->app_facebook??'#'}}" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="{{settings()->app_twitter??'#'}}" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="{{settings()->app_instagram??'#'}}" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="{{settings()->app_youtube??'#'}}" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
        </div>

    </div>
    <!-- ==================== END MOBILE DRAWER ==================== -->

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
                                @foreach(destination() as $item)
                                    <li><a href="{{route('front.des.about',base64_encode($item->id))}}">{{ $item->country }}</a></li>
                                @endforeach
                                <li><a href="{{route('front.des')}}">View More</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="400ms">
                        <div class="footer-widget footer-widget--links">
                            <h2 class="footer-widget__title">Useful Links</h2>
                            <ul class="list-unstyled footer-widget__links">
                                <li><a href="{{route('front.about')}}">About Us</a></li>
                                <li><a href="{{route('front.des')}}">Destinations</a></li>
                                <li><a href="{{route('front.tour-list')}}">Tours</a></li>
                                <li><a href="{{route('front.contact')}}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 col-xl-3 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="600ms">
                        <div class="footer-widget footer-widget--contact">
                            <h2 class="footer-widget__title">Newsletter</h2>
                            <p class="footer-widget__contact-text">Subscribe to get exclusive deals and travel inspiration straight to your inbox.</p>
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
                    <div class="main-footer__bottom__payment">
                        <div class="payment-icons-wrapper">
                            <img style="filter:none !important; -webkit-filter:none !important; opacity:1 !important;"
                                 src="{{asset('assets/images/payment/pay.png')}}"
                                 alt="SSLCommerz Payment Methods" />
                        </div>
                    </div>
                    <div class="main-footer__copyright">
                        <p>Copyright © {{ date('Y') }} All rights reserved by IGL Group</p>
                        <div class="main-footer__credits">
                            <span>Domain Registration by: <a href="https://iglweb.com/web/domains-services.php">IGL Web Ltd</a></span>
                            <span class="credit-sep">|</span>
                            <span>Web Hosting by: <a href="https://iglweb.com/web/domains-services.php">IGL Web Ltd</a></span>
                            <span class="credit-sep">|</span>
                            <span>Web Design & Development by: <a href="https://iglweb.com/web/domains-services.php">IGL Web Ltd</a></span>
                        </div>
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

        // Desktop user dropdown
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

        // Mobile drawer logic
        const drawerToggle  = document.getElementById('mobileDrawerToggle');
        const drawer        = document.getElementById('mobileDrawer');
        const drawerOverlay = document.getElementById('mobileDrawerOverlay');
        const drawerClose   = document.getElementById('mobileDrawerClose');

        function openDrawer() {
            drawer.classList.add('active');
            drawerOverlay.classList.add('active');
            if(drawerToggle) drawerToggle.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function closeDrawer() {
            drawer.classList.remove('active');
            drawerOverlay.classList.remove('active');
            if(drawerToggle) drawerToggle.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        if (drawerToggle) {
            drawerToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                drawer.classList.contains('active') ? closeDrawer() : openDrawer();
            });
        }

        if (drawerClose)   drawerClose.addEventListener('click', closeDrawer);
        if (drawerOverlay) drawerOverlay.addEventListener('click', closeDrawer);

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeDrawer();
        });

        // Mobile Gallery accordion
        const galleryToggle = document.getElementById('drawerGalleryToggle');
        const galleryItem   = document.getElementById('drawerGalleryItem');

        if (galleryToggle && galleryItem) {
            galleryToggle.addEventListener('click', function (e) {
                e.preventDefault();
                galleryItem.classList.toggle('is-open');
            });
        }

        // Fix for desktop gallery dropdown: ensure dropdown stays open when moving mouse from link to dropdown
        const galleryItemDesktop = document.querySelector('.nav-gallery-item');
        const dropdownMenu = document.querySelector('.nav-gallery-dropdown');

        if (galleryItemDesktop && dropdownMenu) {
            // Add a small delay to prevent flickering when moving between link and dropdown
            let timeoutId;

            galleryItemDesktop.addEventListener('mouseenter', function() {
                clearTimeout(timeoutId);
            });

            galleryItemDesktop.addEventListener('mouseleave', function(e) {
                // Check if the mouse is moving to the dropdown
                const relatedTarget = e.relatedTarget;
                if (dropdownMenu.contains(relatedTarget)) {
                    return;
                }
                timeoutId = setTimeout(() => {
                    // The dropdown will still hide via CSS, but we ensure no forced hiding
                }, 100);
            });

            dropdownMenu.addEventListener('mouseenter', function() {
                clearTimeout(timeoutId);
            });

            dropdownMenu.addEventListener('mouseleave', function() {
                // Allow CSS to handle hiding naturally
            });
        }
    });
</script>

</body>
</html>
