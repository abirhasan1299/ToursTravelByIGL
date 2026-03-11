@extends('layout.theme')
@section('title','Home')
@section('content')

        <section class="page-header">
            <div class="page-header__bg" style="background-image: url(assets/images/backgrounds/page-header-bg-1-1.jpg);"></div><!-- /.page-header__bg -->
            <div class="container">
                <div class="page-header__content">
                    <h2 class="page-header__title bw-split-in-right">Pricing plan</h2>
                    <ul class="gotur-breadcrumb list-unstyled">
                        <li><a href="{{route('home')}}">Home</a></li>
                        <li><span>Pricing plan</span></li>
                    </ul><!-- /.thm-breadcrumb list-unstyled -->
                </div><!-- /.page-header__content -->
            </div><!-- /.container -->
        </section><!-- /.page-header -->

        <section class="pricing-one section-space-bottom">
            <div class="container">
                <div class="pricing-one__main-tab-box tabs-box">
                    <div class="pricing-one__top wow fadeInLeft" data-wow-duration='1500ms' data-wow-delay='500ms'>
                        <div class="pricing-one__content">
                            <h3 class="pricing-one__title">Plans & Pricing</h3>
                            <p class="pricing-one__text">Whether your time-saving automation needs are large or small, we’re here to help you scale.</p>
                        </div>
                        <ul class="tab-buttons">
                            <li data-tab="#monthly" class="tab-btn active-btn">MONTHLY</li>
                            <li data-tab="#yearly" class="tab-btn">YEARLY</li>
                        </ul>
                    </div>
                    <div class="tabs-content">
                        <div class="tab active-tab fadeInUp animated" id="monthly">
                            <div class="pricing-one__inner">
                                <div class="pricing-one__row row">
                                    <div class="pricing-one__col-image">
                                        <div class="pricing-one__image">
                                            <img src="assets/images/resources/packag-1-1.jpg" alt="pricing">
                                        </div>
                                    </div>
                                    <div class="pricing-one__col-card">
                                        <div class="pricing-one__card">
                                            <h2 class="pricing-one__card__price">$49<span>/month</span></h2>
                                            <h3 class="pricing-one__card__title">standard</h3>
                                            <p class="pricing-one__card__text">Advanced tools to take your work to the next level.</p>
                                            <ul class="pricing-one__card__list list-unstyled">
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Multi-step Zaps</li>
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Unlimited Premium Apps</li>
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Shared Workspace</li>
                                            </ul>
                                            <a href="contact.blade.php" class="gotur-btn gotur-btn--base pricing-one__card__btn">Choose plan</a>
                                        </div>
                                    </div>
                                    <div class="pricing-one__col-divider">
                                        <div class="pricing-one__col-divider__inner"></div>
                                    </div>
                                    <div class="pricing-one__col-card">
                                        <div class="pricing-one__card">
                                            <h2 class="pricing-one__card__price">$69 <span>/month</span></h2>
                                            <h3 class="pricing-one__card__title">Professional</h3>
                                            <p class="pricing-one__card__text">Advanced tools to take your work to the next level.</p>
                                            <ul class="pricing-one__card__list list-unstyled">
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Multi-step Zaps</li>
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Unlimited Premium Apps</li>
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Shared Workspace</li>
                                            </ul>
                                            <a href="contact.blade.php" class="gotur-btn gotur-btn--base pricing-one__card__btn">Choose plan</a>
                                        </div>
                                    </div>
                                    <div class="pricing-one__col-card pricing-one__col-card--popular">
                                        <div class="pricing-one__card pricing-one__card--popular">
                                            <div class="pricing-one__card__category">MOST POPULAR</div>
                                            <h2 class="pricing-one__card__price">$99 <span>/month</span></h2>
                                            <h3 class="pricing-one__card__title">premium</h3>
                                            <p class="pricing-one__card__text">Advanced tools to take your work to the next level.</p>
                                            <ul class="pricing-one__card__list list-unstyled">
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Multi-step Zaps</li>
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Unlimited Premium Apps</li>
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Shared Workspace</li>
                                            </ul>
                                            <a href="contact.blade.php" class="gotur-btn gotur-btn--base pricing-one__card__btn">Choose plan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab fadeInUp animated" data-wow-delay="200ms" id="yearly" style="display: none;">
                            <div class="pricing-one__inner">
                                <div class="pricing-one__row row">
                                    <div class="pricing-one__col-image">
                                        <div class="pricing-one__image">
                                            <img src="assets/images/resources/packag-1-1.jpg" alt="pricing">
                                        </div>
                                    </div>
                                    <div class="pricing-one__col-card">
                                        <div class="pricing-one__card">
                                            <h2 class="pricing-one__card__price">$49<span>/month</span></h2>
                                            <h3 class="pricing-one__card__title">standard</h3>
                                            <p class="pricing-one__card__text">Advanced tools to take your work to the next level.</p>
                                            <ul class="pricing-one__card__list list-unstyled">
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Multi-step Zaps</li>
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Unlimited Premium Apps</li>
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Shared Workspace</li>
                                            </ul>
                                            <a href="contact.blade.php" class="gotur-btn gotur-btn--base pricing-one__card__btn">Choose plan</a>
                                        </div>
                                    </div>
                                    <div class="pricing-one__col-divider">
                                        <div class="pricing-one__col-divider__inner"></div>
                                    </div>
                                    <div class="pricing-one__col-card">
                                        <div class="pricing-one__card">
                                            <h2 class="pricing-one__card__price">$69 <span>/month</span></h2>
                                            <h3 class="pricing-one__card__title">Professional</h3>
                                            <p class="pricing-one__card__text">Advanced tools to take your work to the next level.</p>
                                            <ul class="pricing-one__card__list list-unstyled">
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Multi-step Zaps</li>
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Unlimited Premium Apps</li>
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Shared Workspace</li>
                                            </ul>
                                            <a href="contact.blade.php" class="gotur-btn gotur-btn--base pricing-one__card__btn">Choose plan</a>
                                        </div>
                                    </div>
                                    <div class="pricing-one__col-card pricing-one__col-card--popular">
                                        <div class="pricing-one__card pricing-one__card--popular">
                                            <div class="pricing-one__card__category">MOST POPULAR</div>
                                            <h2 class="pricing-one__card__price">$99 <span>/month</span></h2>
                                            <h3 class="pricing-one__card__title">premium</h3>
                                            <p class="pricing-one__card__text">Advanced tools to take your work to the next level.</p>
                                            <ul class="pricing-one__card__list list-unstyled">
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Multi-step Zaps</li>
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Unlimited Premium Apps</li>
                                                <li><span class="pricing-one__card__list__icon"><i class="icon-mark"></i></span>Shared Workspace</li>
                                            </ul>
                                            <a href="contact.blade.php" class="gotur-btn gotur-btn--base pricing-one__card__btn">Choose plan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
