@php use Carbon\Carbon; @endphp
@extends('layout.admin')
@section('title','Package')
@push('css')
    <style>
        /* Custom styles for enhanced cards */
        .hover-shadow {
            transition: all 0.3s ease;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
        }

        .hover-lift {
            transition: transform 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .fs-7 {
            font-size: 0.85rem;
        }

        .rounded-bl-3 {
            border-bottom-left-radius: 1rem;
        }

        /* Badge positioning */
        .z-1 {
            z-index: 1;
        }
    </style>
@endpush
@section('content')
    @include('admin.partials.credit')
    @php
        function getDaysFromRange($range) { [$start, $end] = explode(' to ', $range); $startDate = Carbon::parse($start); $endDate = Carbon::parse($end); return $startDate->diffInDays($endDate) + 1; }

    @endphp
    <div class="row h-100 mt-3">
        <div class="col-lg-3 col-md-6 col-xxl-6">
            <div class="card card-h-100 overflow-hidden">
                <div class="card-body pb-0">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="overflow-hidden flex-shrink-0">
                            <h3 class="fw-normal text-reset fs-20 lh-base">
                                <span class="text-muted fs-base text-uppercase h5">Good Day,</span> <br />
                                <b>{{Auth::user()->name}} !</b>
                            </h3>
                        </div>
                        <div class="flex-grow-1 text-end">
                            <img class="d-none d-xxl-inline-block" src="{{ asset('assets/images/svg/email-campaign.svg') }}" width="110" alt="Generic placeholder image" />
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex align-items-center p-2 bg-light bg-opacity-50">
                    <p class="d-flex align-items-center justify-content-between w-100 mb-0">
                                                <span class="me-2"
                                                ><i class="ti ti-calendar fs-15 align-middle"></i>
                                                    <span class="align-middle ms-1 fw-semibold">
                                                        <script>
                                                            document.write(new Date().toLocaleDateString("en-US", { day: "numeric", month: "short", year: "numeric" }))
                                                        </script>
                                                    </span></span
                                                >
                        <span class="text-nowrap"><i class="ti ti-clock fs-15 align-middle"></i><span class="align-middle ms-1 fw-semibold" id="clock-widget"></span></span>
                    </p>
                </div>
                <!-- end card-body -->
            </div>
        </div>
        <!-- end col-->

        <div class="col-lg-3 col-md-6 col-xxl-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted fs-base text-uppercase" title="Number of Orders">Current Plan</h5>
                            <h3 class="my-3 py-1 fw-semibold"><span data-target="9,754">0</span></h3>
                            <p class="mb-0 text-muted">
                                <span class="text-danger me-2"><i class="ti ti-arrow-down"></i> 1.89%</span>
                                <span class="text-nowrap">Expire Date</span>
                            </p>
                        </div>
                        <div class="avatar-md flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle rounded-circle fs-22">
                                                        <i class="ti ti-shopping-cart text-primary"></i>
                                                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card-->
        </div>
        <!-- end col-->

        <div class="col-lg-3 col-md-6 col-xxl-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted fs-base text-uppercase" title="Number of Orders">Credit</h5>
                            <h3 class="my-3 py-1 fw-semibold">
                                <span>
                                    {{$credit->c_credit ?? '0'}}
                                </span>
                            </h3>
                            <p class="mb-0 text-muted">

                                <span class="text-success me-2"><i class="ti ti-calendar"></i>
                                    @if(!empty($credit->updated_at))
                                        {{ $credit->updated_at->diffForHumans() }}
                                    @else
                                        {{'------'}}
                                    @endif
                                </span>

                                <button href="#credit-modal" data-bs-toggle="modal" class="text-nowrap btn btn-sm btn-info">Buy now</button>

                            </p>
                        </div>
                        <div class="avatar-md flex-shrink-0">
                                                    <span class="avatar-title bg-primary-subtle rounded-circle fs-22">
                                                        <i class="ti ti-credit-card text-primary"></i>
                                                    </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card-->
        </div>
        <!-- end col-->

    </div>

    <div class="row mb-4">
@foreach($package as $p)
            <!-- Package Plan -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all rounded-4 overflow-hidden">

                    <!-- Popular Badge (Optional - can be conditionally shown) -->
                    <div class="position-absolute top-0 end-0 bg-primary text-white px-3 py-1 rounded-bl-3 fs-7 fw-semibold z-1" style="border-bottom-left-radius: 1rem;">
                        POPULAR
                    </div>

                    <!-- Card Header with Gradient Background -->
                    <div class="card-header bg-gradient-primary text-white border-0 p-4 text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <!-- Package Name -->
                        <h3 class="fw-bold mb-1 text-white">{{ strtoupper($p->p_name) }}</h3>
                        <p class="text-white-50 mb-0 fs-7">Perfect for growing companies</p>
                    </div>

                    <div class="card-body p-4">

                        <!-- Package Price -->
                        <div class="text-center mb-4">
                            <h2 class="display-5 fw-bold text-dark mb-0">
                                {{config('app.currency')." ".$p->p_price }}
                            </h2>
                            <span class="text-muted small">Per Package</span>
                        </div>

                        <!-- Package Features -->
                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted small fw-semibold mb-3">Key Features</h6>
                            <ul class="list-unstyled">

                                <!-- Post Limit -->
                                <li class="d-flex align-items-center mb-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-1 me-3">
                                        <i class="ti ti-check text-success fs-5"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted small">Post Limit:</span>
                                        <span class="fw-semibold ms-1">{{ $p->p_post_limit ?? 'Unlimited' }}</span>
                                    </div>
                                </li>

                                <!-- Expire Date -->
                                <li class="d-flex align-items-center mb-3">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-1 me-3">
                                        <i class="ti ti-clock text-success fs-5"></i>
                                    </div>
                                    <div>
                                        <span class="text-muted small">Expire In:</span>
                                        <span class="fw-semibold ms-1">{{ getDaysFromRange($p->p_date_range) }} Days</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Benefits Section -->
                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted small fw-semibold mb-2">Benefits</h6>
                            <div class="">
                                {!! $p->p_benefit !!}
                            </div>
                        </div>

                        <!-- Details Section -->
                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted small fw-semibold mb-2">Details</h6>
                            <div class="">
                                {!! $p->p_detail !!}
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="d-grid mt-4">
                            <a href="#" class="btn btn-primary py-3 fw-semibold rounded-pill hover-lift">
                                <i class="ti ti-rocket me-2"></i>
                                Choose This Plan
                            </a>
                        </div>

                        <!-- Guarantee Text -->
                        <p class="text-center text-muted small mt-3 mb-0">
                            <i class="ti ti-shield-check me-1"></i>
                            30-day money-back guarantee
                        </p>
                    </div>
                </div>
            </div>
@endforeach
    </div>
@endsection

@push('js')
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Message',
                text: '{{ session('success') }}',
                confirmButtonColor: '#126600'
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Message',
                text: '{{ session('error') }}',
                confirmButtonColor: 'rgba(98,255,224,0.45)'
            });
        </script>
    @endif
@endpush
