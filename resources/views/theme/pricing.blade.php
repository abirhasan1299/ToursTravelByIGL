@extends('layout.theme')
@section('title','Pricing & Plan')
@section('content')

        <section class="page-header">
            <div class="page-header__bg" style="background-image: url({{asset('assets/images/backgrounds/page-header-bg-1-1.jpg')}});"></div><!-- /.page-header__bg -->
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
                    <div class="pricing-one__top wow fadeInLeft justify-content-center" data-wow-duration='1500ms' data-wow-delay='500ms'>
                        <div class="pricing-one__content">
                            <h3 class="pricing-one__title">Plans & Pricing</h3>
                            <p class="pricing-one__text">Whether your time-saving automation needs are large or small, we're here to help you scale.</p>
                        </div>
                    </div>

                    <div class="tab active-tab fadeInUp animated">
                            <div class="pricing-one__inner">
                                <div class="pricing-one__row row">
                                    @foreach($packages as $index => $p)
                                        @php
                                            $popularity = ['POPULAR', 'REGULAR', 'BEGINNERS', 'STARTING', 'EXPERTS'];
                                            $randomPopularity = $popularity[array_rand($popularity)];
                                            $isPopular = $randomPopularity == 'POPULAR';
                                            $featureIcons = ['icon-mark', 'icon-check', 'icon-tick', 'icon-verified', 'icon-success'];
                                        @endphp

                                        <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='{{500 + ($index * 100)}}ms'>
                                            <div class="pricing-one__card {{$isPopular ? 'pricing-one__card--popular' : ''}}">
                                                @if($isPopular)
                                                    <div class="pricing-one__card__category">MOST POPULAR</div>
                                                @endif

                                                <h2 class="pricing-one__card__price">
                                                    {{ config('app.currency') }} {{ number_format($p->p_price) }}
                                                    <span>/package</span>
                                                </h2>

                                                <h3 class="pricing-one__card__title">{{ $p->p_name }}</h3>

                                                <p class="pricing-one__card__text">
                                                    Complete package solution for your business needs
                                                </p>

                                                <ul class="pricing-one__card__list list-unstyled">
                                                    <li>
                                                <span class="pricing-one__card__list__icon">
                                                    <i class="{{$featureIcons[array_rand($featureIcons)]}}"></i>
                                                </span>
                                                        Post Limit: <strong>{{ $p->p_post_limit ?? 'Unlimited' }}</strong>
                                                    </li>
                                                    <li>
                                                <span class="pricing-one__card__list__icon">
                                                    <i class="{{$featureIcons[array_rand($featureIcons)]}}"></i>
                                                </span>
                                                        Credits: <strong>{{ $p->p_credit }}</strong>
                                                    </li>
                                                    <li>
                                                <span class="pricing-one__card__list__icon">
                                                    <i class="{{$featureIcons[array_rand($featureIcons)]}}"></i>
                                                </span>
                                                        Duration: <strong>{{ getDaysFromRange($p->p_date_range) }} Days</strong>
                                                    </li>

                                                    @if($p->p_benefit)
                                                        @php
                                                            // Extract first 3 benefits if they exist
                                                            $benefits = strip_tags($p->p_benefit);
                                                            $benefitLines = explode("\n", $benefits);
                                                            $benefitLines = array_slice(array_filter($benefitLines), 0, 3);
                                                        @endphp

                                                        @foreach($benefitLines as $benefit)
                                                            @if(trim($benefit))
                                                                <li>
                                                            <span class="pricing-one__card__list__icon">
                                                                <i class="{{$featureIcons[array_rand($featureIcons)]}}"></i>
                                                            </span>
                                                                    {{ Str::limit(trim($benefit), 40) }}
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>

                                                <form action="{{route('buy.plan')}}" method="post" class="delete-form">
                                                    @csrf
                                                    <input type="hidden" name="package_id" value="{{$p->id}}">
                                                    <button type="submit" class="gotur-btn gotur-btn--base pricing-one__card__btn">
                                                        Choose Plan
                                                    </button>
                                                </form>

                                                <form action="{{route('company.package.buy.with.credit')}}" method="post" class="delete-form mt-2">
                                                    @csrf
                                                    <input type="hidden" name="package_id" value="{{$p->id}}">
                                                    <button type="submit" class="gotur-btn gotur-btn--base-outline pricing-one__card__btn-outline">
                                                        Use Credit Points
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </section>

@endsection
@push('js')
    <script>
        // Initialize WOW.js for animations
        document.addEventListener('DOMContentLoaded', function() {
            // Simple fade-in animation on scroll
            const wowElements = document.querySelectorAll('.wow');

            function checkWow() {
                wowElements.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    const windowHeight = window.innerHeight;

                    if (rect.top <= windowHeight - 100) {
                        el.style.visibility = 'visible';
                    }
                });
            }

            // Initial check
            checkWow();

            // Check on scroll
            window.addEventListener('scroll', checkWow);
        });

        // SweetAlert confirmation
        document.querySelectorAll('.delete-form').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Confirm Purchase',
                    text: "Are you sure you want to purchase this plan?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, proceed',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#667eea',
                    cancelButtonColor: '#6b6b84',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
@push('css')
    <style>
        /* Pricing Section Styles */
        .pricing-one {
            padding: 80px 0;
            background: linear-gradient(135deg, #f8faff 0%, #f0f4ff 100%);
        }

        .pricing-one__top {
            text-align: center;
            margin-bottom: 60px;
        }

        .pricing-one__title {
            font-size: 42px;
            font-weight: 700;
            color: #1e1e2f;
            margin-bottom: 15px;
            text-transform: capitalize;
        }

        .pricing-one__text {
            font-size: 16px;
            color: #6b6b84;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .pricing-one__row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 0 -15px;
        }

        /* Card Styles */
        .pricing-one__card {
            background: #fff;
            border-radius: 30px;
            padding: 40px 30px;
            margin-bottom: 30px;
            position: relative;
            transition: all 0.4s ease;
            border: 2px solid transparent;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .pricing-one__card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 50px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
        }

        .pricing-one__card--popular {
            border: 2px solid #667eea;
            box-shadow: 0 20px 40px rgba(102, 126, 234, 0.2);
            position: relative;
            overflow: hidden;
        }

        .pricing-one__card--popular::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            opacity: 0.03;
            border-radius: 50%;
        }

        .pricing-one__card__category {
            position: absolute;
            top: 20px;
            right: 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            font-size: 12px;
            font-weight: 600;
            padding: 5px 15px;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pricing-one__card__price {
            font-size: 48px;
            font-weight: 800;
            color: #1e1e2f;
            margin-bottom: 15px;
            line-height: 1;
        }

        .pricing-one__card__price span {
            font-size: 16px;
            font-weight: 400;
            color: #6b6b84;
            margin-left: 5px;
        }

        .pricing-one__card__title {
            font-size: 28px;
            font-weight: 700;
            color: #1e1e2f;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .pricing-one__card__text {
            font-size: 14px;
            color: #6b6b84;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .pricing-one__card__list {
            margin-bottom: 30px;
            flex-grow: 1;
        }

        .pricing-one__card__list li {
            font-size: 15px;
            color: #1e1e2f;
            padding: 8px 0;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #f0f0f5;
        }

        .pricing-one__card__list li:last-child {
            border-bottom: none;
        }

        .pricing-one__card__list__icon {
            width: 24px;
            height: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
        }

        .pricing-one__card__list__icon i {
            color: #667eea;
            font-size: 18px;
        }

        .pricing-one__card__list li strong {
            color: #667eea;
            margin-left: 5px;
            font-weight: 600;
        }

        .pricing-one__card__btn {
            width: 100%;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
        }

        .pricing-one__card__btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .pricing-one__card__btn-outline {
            width: 100%;
            padding: 12px 30px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-radius: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 2px solid #667eea;
            background: transparent;
            color: #667eea;
        }

        .pricing-one__card__btn-outline:hover {
            background: #667eea;
            color: #fff;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .pricing-one {
                padding: 50px 0;
            }

            .pricing-one__title {
                font-size: 32px;
            }

            .pricing-one__card {
                padding: 30px 20px;
            }

            .pricing-one__card__price {
                font-size: 36px;
            }

            .pricing-one__card__title {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            .pricing-one__card {
                margin: 0 15px 30px;
            }
        }

        /* Animation Classes */
        .wow {
            visibility: hidden;
        }

        .fadeInLeft {
            animation-name: fadeInLeft;
        }

        .fadeInUp {
            animation-name: fadeInUp;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
