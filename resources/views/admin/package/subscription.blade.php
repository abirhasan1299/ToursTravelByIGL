@php use Carbon\Carbon; @endphp
@extends('layout.admin')
@section('title','Package')
@push('css') @endpush
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
                            <h3 class="my-3 py-1 fw-semibold"><span data-target="2,754"></span></h3>
                            <p class="mb-0 text-muted">
                                <span class="text-success me-2"><i class="ti ti-calendar"></i> 2 days ago</span>
                                <button href="#credit-modal" data-bs-toggle="modal" class="text-nowrap btn btn-sm btn-info">Buy</button>
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

            <div class="col-xl-3 col-md-6">
                <div class="card h-100 my-4 my-lg-0">
                    <div class="card-body p-lg-4 pb-0 text-center">

                        <!-- Package Name -->
                        <h3 class="fw-bold mb-1">{{ strtoupper($p->p_name) }}</h3>
                        <p class="text-muted mb-3">Perfect for growing companies</p>

                        <!-- Package Price -->
                        <div class="my-4">
                            <h1 class="display-6 fw-bold mb-0">
                                {{config('app.currency')." ".$p->p_price }}
                            </h1>
                            <small class="text-muted">Per Package</small>
                        </div>

                        <!-- Package Features -->
                        <ul class="list-unstyled text-start fs-sm mb-0">

                            <!-- Post Limit -->
                            <li class="mb-2">
                                <i class="ti ti-check text-success me-2 fs-5"></i>
                                Post Limit : {{ $p->p_post_limit ?? 'Unlimited' }}
                            </li>

                            <!-- Expire Date -->
                            <li class="mb-2">
                                <i class="ti ti-check text-success me-2 fs-5"></i>
                                Expire In : {{ getDaysFromRange($p->p_date_range) }} Days
                            </li>

                            <!-- Benefits -->
                            <li class="mb-2">
                                <i class="ti ti-check text-success me-2 fs-5"></i>
                                {!! $p->p_benefit !!}
                            </li>

                            <!-- Details -->
                            <li class="mb-2">
                                <i class="ti ti-check text-success me-2 fs-5"></i>
                                {!! $p->p_detail !!}
                            </li>

                        </ul>

                    </div>

                    <!-- Button -->
                    <div class="card-footer bg-transparent px-5 pb-4">
                        <a href="#" class="btn btn-outline-dark w-100 py-2 fw-semibold rounded-pill">
                            Choose Plan
                        </a>
                    </div>
                </div>
            </div>
@endforeach
    </div>
@endsection

@push('js') @endpush
