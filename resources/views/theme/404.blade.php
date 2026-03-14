
@extends('layout.theme')
@section('title','About Us')
@section('content')

        <section class="page-header">
            <div class="page-header__bg" style="background-image: url({{asset('assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div><!-- /.page-header__bg -->
            <div class="container">
                <div class="page-header__content">
                    <h2 class="page-header__title bw-split-in-right">Error page</h2>
                    <ul class="gotur-breadcrumb list-unstyled">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><span>404</span></li>
                    </ul><!-- /.thm-breadcrumb list-unstyled -->
                </div><!-- /.page-header__content -->
            </div><!-- /.container -->
        </section><!-- /.page-header -->

        <section class="error-404 section-space">
            <div class="container">
                <div class="error-404__inner">
                    <div class="error-404__thumb">
                        <img src="{{asset('assets/images/shapes/error-1-1.png')}}" alt="error image">
                    </div>
                    <div class="error-404__element-one">
                        <img src="{{asset('assets/images/shapes/shape-1-1.png')}}" alt="error image">
                    </div>
                    <div class="error-404__element-two">
                        <img src="{{asset('assets/images/shapes/shape-1-2.png')}}" alt="error image">
                    </div>
                </div>
                <h3 class="error-404__sub-title wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='300ms'><span>Oops!</span> Page not found</h3>
                <p class="error-404__text wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>The page you are looking for does not exist</p>
                <div class="error-404__btns wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='600ms'>
                    <a href="{{route('home')}}" class="gotur-btn gotur-btn--primary error-404__btn">Back to Home Pages <span class="icon"><i class="icon-right"></i></span><!-- /.icon --></a>
                </div>
            </div><!-- /.container -->
        </section><!-- /.error-404 -->

@endsection
@push('js')
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Message',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3061fd'
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Message Error',
                text: '{{ session('error') }}',
                confirmButtonColor: 'rgb(190,0,0)'
            });
        </script>
    @endif
@endpush
