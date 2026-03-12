@extends('layout.theme')
@section('title','FAQ')
@section('content')

<section class="page-header">
            <div class="page-header__bg" style="background-image: url({{asset('assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div><!-- /.page-header__bg -->
            <div class="container">
                <div class="page-header__content">
                    <h2 class="page-header__title bw-split-in-right">FAQS</h2>
                    <ul class="gotur-breadcrumb list-unstyled">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><span>FAQS</span></li>
                    </ul><!-- /.thm-breadcrumb list-unstyled -->
                </div><!-- /.page-header__content -->
            </div><!-- /.container -->
        </section><!-- /.page-header -->
<section class="faq-page section-space tabs-box">
            <div class="container">
                <div class="tabs-box">
                    <div class="row gutter-y-30">
                        <div class="col-lg-4">
                            <div class="faq-page__sidebar">

                                <div class="faq-page__sidebar__item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="500ms">
                                    <div class="faq-page__sidebar__cta">
                                        <img src="{{asset('assets/images/resources/faq-sidebar.png')}}" alt="sidebar">
                                        <div class="faq-page__sidebar__cta__content">
                                            <span class="faq-page__sidebar__sub-title">Special Offer</span><!-- /.faq-page__sidebar__title -->
                                            <h3 class="faq-page__sidebar__title">Explore All Tour Of The World With Us</h3><!-- /.faq-page__sidebar__title -->
                                            <a href="#" class="gotur-btn">Book Now <span class="icon"><i class="icon-right"></i></span></a>
                                        </div><!-- /.faq-page__sidebar__cta__content -->
                                    </div><!-- /.faq-page__sidebar__cta -->
                                </div><!-- /.faq-page__sidebar__item -->
                            </div><!-- /.faq-page__sidebar -->
                        </div><!-- /.col-lg-4 -->
                        <div class="col-lg-8">
                            <div class="tabs-content">

                                <div class="faq-accordion__item tab active-tab" id="itemOne">
                                    <div class="faq-accordion gotur-accordion" data-grp-name="gotur-accordion">
                                        <div class="faq-page__title wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>Frequently Asking Questions</div><!-- /.faq-page__title -->
                                        @foreach($data as $d)

                                        <div class="accordion wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='500ms'>
                                            <div class="accordion-title">
                                                <h4 class="accordion-title__text">
                                                    {{$d->title}}
                                                    <span class="accordion-title__icon"></span></h4>
                                            </div><!-- /.accordian-title -->
                                            <div class="accordion-content">
                                                <div class="inner">
                                                    <p class="inner__text">
                                                        {!! $d->detail !!}
                                                    </p>
                                                </div><!-- /.accordian-content -->
                                            </div>
                                        </div><!-- /.accordian-item -->

                                        @endforeach
                                    </div>
                                </div><!-- /.faq-accordion__item -->


                            </div><!-- /.tabs-content -->
                        </div><!-- /.col-lg-8 -->
                    </div><!-- /.row -->
                </div><!-- /.tabs-box -->

            </div><!-- /.container -->
        </section><!-- /.faq-page -->

@endsection
