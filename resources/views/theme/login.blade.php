@extends('layout.theme')
@section('title','Home')
@section('content')

   <section class="page-header">
            <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg-1-1.jpg);"></div><!-- /.page-header__bg -->
            <div class="container">
                <div class="page-header__content">
                    <h2 class="page-header__title bw-split-in-right">Sign In</h2>
                    <ul class="gotur-breadcrumb list-unstyled">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><span>Sign In</span></li>
                    </ul><!-- /.thm-breadcrumb list-unstyled -->
                </div><!-- /.page-header__content -->
            </div><!-- /.container -->
        </section><!-- /.page-header -->

   <section class="login-page section-space">
            <div class="container">
                <div class="row gutter-y-40 align-items-center">
                    <div class="col-lg-6">
                        <div class="login-page__thumb  ">
                            <img src="{{asset('assets/images/resources/login-1-1.jpg')}}" alt="gotur image">
                        </div><!-- /.login-page__thumb -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                        <div class="login-page__content wow fadeInRight" data-wow-duration='1500ms' data-wow-delay='300ms'>
                            <div class="login-page__content__bg" style="background-image: url({{asset('assets/images/shapes/bg-login.png')}});"></div><!-- /.login-page__content__bg -->
                            <div class="login-page__main-tab-box tabs-box">
                                <div class="login-page__top">
                                    <div class="login-page__top__left">
                                        <h2 class="login-page__top__section-title">welcome</h2><!-- /.login-page__top__section-title -->
                                        <p class="login-page__top__section-subtitle">sign in your account</p><!-- /.login-page__top__section-subtitle -->
                                    </div><!-- /.login-page__top__left -->
                                    <div class="login-page__top__btn tab-buttons">
                                        <button data-tab="#login" class="tab-btn gotur-btn active-btn">log in</button>
                                        <button data-tab="#register" class="tab-btn gotur-btn">register</button>
                                    </div><!-- /.login-page__top__btn -->
                                </div><!-- /.login-page__top -->
                                <div class="tabs-content">
                                    <div class="tabs-content__item tab active-tab" id="login">
                                        <form class="contact-form-validated form-one" action="#">
                                            <div class="login-page__group">
                                                <div class="login-page__input-box">
                                                    <i class="icon-email"></i>
                                                    <input type="text" name="name" placeholder="your email">
                                                </div>
                                                <div class="login-page__input-box">
                                                    <i class="icon-padlock"></i>
                                                    <input type="password" placeholder="password" class="login-page__password">
                                                    <span class="toggle-password pass-field-icon fa fa-fw fa-eye-slash"></span>
                                                </div>
                                                <div class="login-page__input-box login-page__input-box--bottom">
                                                    <div class="login-page__input-box__inner">
                                                        <input id="remember-policy2" class="login-page__input-box__toggle" type="checkbox">
                                                        <label class="remember-policy" for="remember-policy2">remember me</label>
                                                    </div>
                                                    <a href="#" class="login-page__form__forgot">forgot password?</a>
                                                </div>
                                                <div class="login-page__input-box">
                                                    <div class="login-page__input-box__btn">
                                                        <button type="submit" class="gotur-btn">log in</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <p class="login-page__form__text">don’t have an account?<a href="#">register</a></p>
                                    </div><!-- /.tabs-content__item -->
                                    <div class="tabs-content__item tab" id="register">
                                        <form class="contact-form-validated form-one" action="#">
                                            <div class="login-page__group">
                                                <div class="login-page__input-box">
                                                    <i class="icon-email"></i>
                                                    <input type="text" name="name" placeholder="your email">
                                                </div>
                                                <div class="login-page__input-box">
                                                    <i class="icon-padlock"></i>
                                                    <input type="password" placeholder="password" class="login-page__password">
                                                    <span class="toggle-password pass-field-icon fa fa-fw fa-eye-slash"></span>
                                                </div>
                                                <div class="login-page__input-box login-page__input-box--bottom">
                                                    <div class="login-page__input-box__inner">
                                                        <input id="remember-policy" class="login-page__input-box__toggle" type="checkbox">
                                                        <label class="remember-policy" for="remember-policy">remember me</label>
                                                    </div>
                                                    <a href="#" class="login-page__form__forgot">forgot password?</a>
                                                </div>
                                                <div class="login-page__input-box">
                                                    <div class="login-page__input-box__btn">
                                                        <button type="submit" class="gotur-btn">register</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <p class="login-page__form__text">don’t have an account?<a href="{{route('front.login')}}">log in</a></p>
                                    </div><!-- /.tabs-content__item -->
                                </div><!-- /.tabs-content -->
                            </div>
                        </div><!-- /.login-page__content -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.login-page -->
@endsection
