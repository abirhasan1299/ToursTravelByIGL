<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Admin" />
    <meta name="keywords" content="Admin" />
    <meta name="author" content="Admin" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

    <!-- Vector Maps css -->
    <link href="{{ asset('assets/plugins/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('demo.js') }}"></script>

    <!-- Select Plugin CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.min.css')}}" />


    <!-- Vendor css -->
    <link href="{{ asset('assets/css/vendors.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link id="app-style" href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Summernote Plugin CSS -->
    <link href="{{asset('assets/plugins/summernote/summernote-bs5.min.css')}}" rel="stylesheet" />

    <!-- Daterangepicker Plugin CSS -->
    <link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}" type="text/css" />

    <!-- Sweet Alert css-->
    <link href="{{asset('assets/plugins/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

    @stack('css')
</head>

<body>
<!-- Begin page -->
<div class="wrapper">

    <header class="app-topbar">
        <div class="container-fluid topbar-menu">
            <div class="d-flex align-items-center gap-2">
                <!-- Topbar Brand Logo -->
                <div class="logo-topbar" >
                    <!-- Logo light -->
                    <a href="#" class="logo-light">
                                <span class="logo-lg">
                                    <img  src="{{ asset('assets/images/igl.png') }}" alt="logo" />
                                </span>
                        <span class="logo-sm">
                                    <img  src="{{ asset('assets/images/igl.png') }}" alt="small logo" />
                                </span>
                    </a>

                    <!-- Logo Dark -->
                    <a href="#" class="logo-dark">
                                <span class="logo-lg">
                                    <img  src="{{ asset('assets/images/igl.png') }}" alt="dark logo" />
                                </span>
                        <span class="logo-sm">
                                    <img  src="{{ asset('assets/images/igl.png') }}" alt="small logo" />
                                </span>
                    </a>
                </div>

                <!-- Sidebar Menu Toggle Button -->
                <button class="sidenav-toggle-button btn btn-primary btn-icon">
                    <i class="ti ti-menu-4"></i>
                </button>

                <!-- Horizontal Menu Toggle Button -->
                <button class="topnav-toggle-button px-2" data-bs-toggle="collapse" data-bs-target="#topnav-menu">
                    <i class="ti ti-menu-4"></i>
                </button>

                <div id="search-box-rounded" class="app-search d-none d-xl-flex">
                    <input type="search" class="form-control rounded-pill topbar-search" name="search" placeholder="Quick Search..." />
                    <i class="ti ti-search app-search-icon text-muted"></i>
                </div>

            </div>

            <div class="d-flex align-items-center gap-2">
                <div id="theme-dropdown" class="topbar-item d-none d-sm-flex">
                    <div class="dropdown">
                        <button class="topbar-link" data-bs-toggle="dropdown" type="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-sun topbar-link-icon d-none" id="theme-icon-light"></i>
                            <i class="ti ti-moon topbar-link-icon d-none" id="theme-icon-dark"></i>
                            <i class="ti ti-sun-moon topbar-link-icon d-none" id="theme-icon-system"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" data-thememode="dropdown">
                            <label class="dropdown-item cursor-pointer">
                                <input class="form-check-input" type="radio" name="data-bs-theme" value="light" style="display: none" />
                                <i class="ti ti-sun align-middle me-1 fs-16"></i>
                                <span class="align-middle">Light</span>
                            </label>
                            <label class="dropdown-item cursor-pointer">
                                <input class="form-check-input" type="radio" name="data-bs-theme" value="dark" style="display: none" />
                                <i class="ti ti-moon align-middle me-1 fs-16"></i>
                                <span class="align-middle">Dark</span>
                            </label>
                            <label class="dropdown-item cursor-pointer">
                                <input class="form-check-input" type="radio" name="data-bs-theme" value="system" style="display: none" />
                                <i class="ti ti-sun-moon align-middle me-1 fs-16"></i>
                                <span class="align-middle">System</span>
                            </label>
                        </div>
                        <!-- end dropdown-menu-->
                    </div>
                    <!-- end dropdown-->
                </div>

                <div id="fullscreen-toggler" class="topbar-item d-none d-md-flex">
                    <button class="topbar-link" type="button" data-toggle="fullscreen">
                        <i class="ti ti-maximize topbar-link-icon"></i>
                        <i class="ti ti-minimize topbar-link-icon d-none"></i>
                    </button>
                </div>

                <div id="monochrome-toggler" class="topbar-item d-none d-xl-flex">
                    <button id="monochrome-mode" class="topbar-link" type="button" data-toggle="monochrome">
                        <i class="ti ti-palette topbar-link-icon"></i>
                    </button>
                </div>

                <div id="user-dropdown-detailed" class="topbar-item nav-user">
                    <div class="dropdown">
                        <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown" href="#" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ asset('assets/images/users/user-1.jpg') }}" width="32" class="rounded-circle me-lg-2 d-flex" alt="user-image" />
                            <div class="d-lg-flex align-items-center gap-1 d-none">
                                        <span>
                                            <h5 class="my-0 lh-1 pro-username">David Dev</h5>
                                            <span class="fs-xs lh-1">Admin Head</span>
                                        </span>
                                <i class="ti ti-chevron-down align-middle"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- Header -->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome back 👋!</h6>
                            </div>

                            <!-- Divider -->
                            <div class="dropdown-divider"></div>

                            <!-- Logout -->
                            <a href="{{route('admin.logout')}}" class="dropdown-item fw-semibold">
                                <i class="ti ti-logout me-1 fs-lg align-middle"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Topbar End -->
    <div class="sidenav-menu">
        <!-- Brand Logo -->
        <a href="#" class="logo">
        <span class="logo logo-light">
            <span class="logo-lg"><img src="{{ asset('assets/images/igl.png') }}" style="width: 200px;height: 100px;" alt="logo" /></span>
            <span class="logo-sm"><img src="{{ asset('assets/images/igl.png') }}" alt="small logo" /></span>
        </span>

            <span class="logo logo-dark">
            <span class="logo-lg"><img src="{{ asset('assets/images/igl.png') }}" alt="dark logo" /></span>
            <span class="logo-sm"><img src="{{ asset('assets/images/igl.png') }}" alt="small logo" /></span>
        </span>
        </a>

        <!-- Sidebar Hover Menu Toggle Button -->
        <button class="button-on-hover">
            <span class="btn-on-hover-icon"></span>
        </button>

        <!-- Full Sidebar Menu Close Button -->
        <button class="button-close-offcanvas">
            <i class="ti ti-menu-4 align-middle"></i>
        </button>

        <div class="scrollbar" data-simplebar="">
            <div id="user-profile-settings" class="sidenav-user" style="background: url({{asset('assets/images/user-bg-pattern.svg')}})">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="#" class="link-reset">
                            <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user-image" class="rounded-circle mb-2 avatar-md" />
                            <span class="sidenav-user-name fw-bold">David Dev</span>
                            <span class="fs-12 fw-semibold" data-lang="user-role">Art Director</span>
                        </a>
                    </div>
                    <div>
                        <a class="dropdown-toggle drop-arrow-none link-reset sidenav-user-set-icon" data-bs-toggle="dropdown" data-bs-offset="0,12" href="#" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-settings fs-24 align-middle ms-1"></i>
                        </a>

                        <div class="dropdown-menu">
                            <!-- Header -->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome back!</h6>
                            </div>

                            <!-- My Profile -->
                            <a href="#" class="dropdown-item">
                                <i class="ti ti-user-circle me-1 fs-lg align-middle"></i>
                                <span class="align-middle">Profile</span>
                            </a>

                            <!-- Logout -->
                            <a href="{{route('admin.logout')}}" class="dropdown-item text-danger fw-semibold">
                                <i class="ti ti-logout me-1 fs-lg align-middle"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!--- Sidenav Menu -->
            <div id="sidenav-menu">
                <ul class="side-nav">
                    <li class="side-nav-title mt-2" data-lang="main">Main</li>
                    <li class="side-nav-item">
                        <a  href="
                        @if(Auth::user()->role==1)
                            {{route('admin.dashboard')}}
                        @elseif(Auth::user()->role==2)
                            {{route('company.dashboard')}}
                        @endif
                        " class="side-nav-link">
                            <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                            <span class="menu-text" data-lang="dashboards">Dashboards</span>
                        </a>

                    </li>
                    @if(auth()->user()->role==1)

                        {{--                    <li class="side-nav-item">--}}
                        {{--                        <a href="{{route('admin.list-company')}}" class="side-nav-link">--}}
                        {{--                            <span class="menu-icon"><i class="ti ti-building"></i></span>--}}
                        {{--                            <span class="menu-text" data-lang="dashboards">Company</span>--}}
                        {{--                        </a>--}}
                        {{--                    </li>--}}
                        {{--                    <li class="side-nav-item">--}}
                        {{--                        <a href="{{route('admin.package.index')}}" class="side-nav-link">--}}
                        {{--                            <span class="menu-icon"><i class="ti ti-box"></i></span>--}}
                        {{--                            <span class="menu-text" data-lang="dashboards">Company Pricing</span>--}}
                        {{--                        </a>--}}
                        {{--                    </li>--}}
                        <li class="side-nav-item">
                            <a href="{{route('admin.post.index')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-box"></i></span>
                                <span class="menu-text" data-lang="dashboards">Tour Package</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('admin.bus.index')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-bus"></i></span>
                                <span class="menu-text" data-lang="dashboards">Bus & Guide</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('admin.banner.index')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-box"></i></span>
                                <span class="menu-text" data-lang="dashboards">Banners</span>
                            </a>
                        </li>
                        {{--                        <li class="side-nav-item">--}}
                        {{--                            <a href="{{route('admin.booking')}}" class="side-nav-link">--}}
                        {{--                                <span class="menu-icon"><i class="ti ti-calendar-check"></i></span>--}}
                        {{--                                <span class="menu-text" data-lang="dashboards">Hotel Bookings</span>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        <li class="side-nav-item">
                            <a href="{{route('admin.facility.index')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-building"></i></span>
                                <span class="menu-text" data-lang="dashboards">Facilities</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('admin.des.index')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-globe"></i></span>
                                <span class="menu-text" data-lang="dashboards">Destination</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('admin.gallery')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-photo"></i></span>
                                <span class="menu-text" data-lang="dashboards">Gallery</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('admin.video')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-photo"></i></span>
                                <span class="menu-text" data-lang="dashboards">Video Gallery</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{route('admin.contacts.list')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-message"></i></span>
                                <span class="menu-text" data-lang="dashboards">Contact Box</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('admin.about')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-info-circle"></i></span>
                                <span class="menu-text" data-lang="dashboards">About</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('admin.faqs')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-message-question"></i></span>
                                <span class="menu-text" data-lang="dashboards">FAQ</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('admin.seo.index')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-search"></i></span>
                                <span class="menu-text" data-lang="dashboards">SEO</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('admin.themes')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-photo"></i></span>
                                <span class="menu-text" data-lang="dashboards">Themes Images</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('admin.setting')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-settings"></i></span>
                                <span class="menu-text" data-lang="dashboards">Settings</span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->role==2)
                        <li class="side-nav-item">
                            <a href="{{route('company.package.index')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-box"></i></span>
                                <span class="menu-text" data-lang="dashboards">Tour Package</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('company.booking')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-calendar-check"></i></span>
                                <span class="menu-text" data-lang="dashboards">Tour Bookings</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('company.hotel.index')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-buildings"></i></span>
                                <span class="menu-text" data-lang="dashboards">Hotels</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('company.hotel.bookings')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-calendar-check"></i></span>
                                <span class="menu-text" data-lang="dashboards">Hotel Bookings</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="{{route('company.subscription.index')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-crown"></i></span>
                                <span class="menu-text" data-lang="dashboards">Subscription</span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a href="{{route('company.transaction')}}" class="side-nav-link">
                                <span class="menu-icon"><i class="ti ti-credit-card text-primary" ></i></span>
                                <span class="menu-text" data-lang="dashboards">Payment History</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- Sidenav Menu End -->

    <!-- ============================================================== -->
    <!-- Start Main Content -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="container-fluid">
            @yield('content')
        </div>
        <!-- container -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        © {{config('app.company_name')}}
                    </div>
                    <div class="col-md-6">
                        <div class="d-none d-md-flex justify-content-end gap-3">
                            <a href="javascript: void(0);" class="link-reset">About</a>
                            <a href="javascript: void(0);" class="link-reset">Support</a>
                            <a href="javascript: void(0);" class="link-reset">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End of Main Content -->
    <!-- ============================================================== -->
</div>
<!-- END wrapper -->

<!-- Vendor js -->
<script src="{{ asset('assets/js/vendors.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- Apex Chart js -->
<script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>

<!-- Vector Map Js -->
<script src="{{ asset('assets/plugins/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('assets/js/maps/world-merc.js') }}"></script>
<script src="{{ asset('assets/js/maps/world.js') }}"></script>

<!-- Custom table -->
<script src="{{ asset('assets/js/pages/custom-table.js') }}"></script>

<!-- Dashboard js -->
<script src="{{ asset('assets/js/pages/dashboard-ecommerce.js') }}"></script>

<!-- Jquery for Datatables-->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- Datatables js -->
<script src="{{asset('assets/plugins/datatables/dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/responsive.bootstrap5.min.js')}}"></script>

<!-- Page js -->
<script src="{{asset('assets/js/pages/datatables-basic.js')}}"></script>

<!-- Summernote Plugin Js -->
<script src="{{asset('assets/plugins/summernote/summernote-bs5.min.js')}}"></script>

<!-- Summernote Demo Js -->
<script src="{{asset('assets/js/pages/form-summernote.js')}}"></script>

<!-- Daterangepicker Plugin Js -->
<script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>

<!-- Date Range Picker Demo Js -->
<script src="{{asset('assets/js/pages/form-date-range-picker.js')}}"></script>

<!-- Sweet Alerts js -->
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Select2 Plugin Js -->
<script src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>

<script src="{{asset('assets/js/pages/form-select2.js')}}"></script>

<!-- Choices Demo Js-->
<script src="{{asset('assets/js/pages/form-choice.js')}}"></script>

@stack('js')
</body>
</html>
