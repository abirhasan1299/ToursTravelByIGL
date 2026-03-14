@extends('layout.theme')
@section('title','Gallery')
@section('content')
     <section class="page-header">
            <div class="page-header__bg" style="background-image: url({{asset('assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div><!-- /.page-header__bg -->
            <div class="container">
                <div class="page-header__content">
                    <h2 class="page-header__title bw-split-in-right">Our Gallery</h2>
                    <ul class="gotur-breadcrumb list-unstyled">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><span>Our Gallery</span></li>
                    </ul><!-- /.thm-breadcrumb list-unstyled -->
                </div><!-- /.page-header__content -->
            </div><!-- /.container -->
        </section><!-- /.page-header -->

     <section class="gallery-page section-space">
            <div class="container">
                <div class="row masonry-layout gutter-y-30 gutter-x-30">
@foreach ($data as $d)
    
                    <div class="col-md-6 col-lg-4">
                        <div class="gallery-page__card">
                            <img src="{{asset('storage/gallery/'.$d->img_name)}}" alt="gotur">
                            <div class="gallery-page__card__hover">
                                <a href="{{asset('storage/gallery/'.$d->img_name)}}" class="img-popup">
                                    <div class="gallery-page__card__icon">
                                        <span class="gallery-page__card__icon__item"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
@endforeach
                </div>
            </div>
        </section>
@endsection
