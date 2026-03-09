@php use Carbon\Carbon; @endphp
@extends('layout.admin')
@section('title','Package')
@push('css')
    <style>
        /* Custom Styles for Package Card */
        .hover-shadow {
            transition: all 0.3s ease;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 30px rgba(0,0,0,0.15) !important;
        }

        .hover-lift {
            transition: all 0.2s ease;
        }

        .hover-lift:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .bg-opacity-20 {
            --bs-bg-opacity: 0.2;
        }

        .tracking-wide {
            letter-spacing: 0.5px;
        }

        /* Custom scrollbar for details section */
        .details-content::-webkit-scrollbar {
            width: 4px;
        }

        .details-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .details-content::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 4px;
        }

        .details-content::-webkit-scrollbar-thumb:hover {
            background: #764ba2;
        }

        /* Benefits content styling */
        .benefits-content ul,
        .benefits-content ol {
            padding-left: 1.2rem;
            margin-bottom: 0;
        }

        .benefits-content li {
            margin-bottom: 0.3rem;
        }

        .benefits-content p:last-child {
            margin-bottom: 0;
        }

        /* Glassmorphism effect */
        .bg-white.bg-opacity-20 {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .display-4 {
                font-size: 2.5rem;
            }

            .col-6 {
                padding: 0 5px;
            }
        }
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
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted fs-base text-uppercase" title="Number of Orders">Current Plan</h5>
                            <h3 class="my-3 py-1 fw-semibold"><span>{{$own_package->userPackage->p_name??'No Plan'}}</span></h3>
                            <p class="mb-0 text-muted">
                                <span class="text-nowrap">Expire Date</span>
                                <span class="text-danger me-2">
                                    <i class="ti ti-calendar"></i>
                                    @php
                                        $dates = explode(' to ', $own_package->userPackage->p_date_range??'');
                                    @endphp
                                    {{Carbon::parse($dates[1])->format('d M, Y')??''}}
                                </span>
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

    <div class="row mb-4 mt-5">
         @php
            $popularity = ['POPULAR',"REGULAR","BEGINNERS","STARTING","EXPERTS"]
         @endphp
@foreach($package as $p)
            <!-- Package Plan -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-lg hover-shadow transition-all rounded-4 overflow-hidden position-relative">

                    <!-- Popular Badge (Optional - can be conditionally shown) -->
                    @if(in_array($popularity[array_rand($popularity)], ['POPULAR',"REGULAR","BEGINNERS","STARTING","EXPERTS"]))
                        <div class="position-absolute top-0 end-0 bg-warning text-dark px-3 py-1 rounded-bl-3 fs-7 fw-semibold z-1"
                             style="border-bottom-left-radius: 1rem; background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);">
                            <i class="ti ti-star me-1"></i>
                            {{$popularity[array_rand($popularity)]}}
                        </div>
                    @endif

                    <!-- Card Header with Gradient Background -->
                    <div class="card-header border-0 p-4 text-center position-relative"
                         style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 140px;">

                        <!-- Decorative Pattern -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10"
                             style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-repeat: repeat;">
                        </div>

                        <!-- Package Name with Icon -->
                        <div class="position-relative z-1">
                            <div class="d-inline-block bg-white bg-opacity-20 rounded-circle p-3 mb-3"
                                 style="background: rgba(255,255,255,0.15); backdrop-filter: blur(5px);">
                                <i class="ti ti-package text-white fs-2"></i>
                            </div>
                            <h3 class="fw-bold mb-1 text-white text-uppercase tracking-wide">
                                {{ strtoupper($p->p_name) }}
                            </h3>
                            <p class="text-white-50 small mb-0">{{'Complete package solution'}}</p>
                        </div>
                    </div>

                    <div class="card-body p-4">

                        <!-- Package Price with Enhanced Styling -->
                        <div class="text-center mb-4 pb-2 border-bottom border-2 border-light">
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="text-muted align-self-start mt-2">{{ config('app.currency') }}</span>
                                <h2 class="display-4 fw-bold text-dark mb-0 mx-1">{{ number_format($p->p_price) }}</h2>
                                <span class="text-muted align-self-end mb-2">/package</span>
                            </div>
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill mt-2">
                    <i class="ti ti-calendar me-1"></i>
                    Billed once
                </span>
                        </div>

                        <!-- Package Features in Grid Layout -->
                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted small fw-semibold mb-3">
                                <i class="ti ti-checklist me-1"></i>
                                What's Included
                            </h6>
                            <div class="row g-3">
                                <!-- Post Limit -->
                                <div class="col-4">
                                    <div class="bg-light rounded-3 p-3 text-center">
                                        <i class="ti ti-file-text text-primary fs-4 mb-2 d-block"></i>
                                        <span class="text-muted small d-block">Post Limit</span>
                                        <span class="fw-bold h5 mb-0">{{ $p->p_post_limit ?? '∞' }}</span>
                                    </div>
                                </div>

                                <!-- Credit  -->
                                <div class="col-4">
                                    <div class="bg-light rounded-3 p-3 text-center">
                                        <i class="ti ti-crown text-primary fs-4 mb-2 d-block"></i>
                                        <span class="text-muted small d-block">Credit</span>
                                        <span class="fw-bold h5 mb-0">{{ $p->p_credit  }} </span>
                                    </div>
                                </div>


                                <!-- Expire Date -->
                                <div class="col-4">
                                    <div class="bg-light rounded-3 p-3 text-center">
                                        <i class="ti ti-clock text-primary fs-4 mb-2 d-block"></i>
                                        <span class="text-muted small d-block">Duration</span>
                                        <span class="fw-bold h5 mb-0">{{ getDaysFromRange($p->p_date_range) }} Days</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Benefits Section with Better Formatting -->
                        @if($p->p_benefit)
                            <div class="mb-4">
                                <h6 class="text-uppercase text-muted small fw-semibold mb-3">
                                    <i class="ti ti-gift me-1"></i>
                                    Benefits
                                </h6>
                                <div class="bg-light bg-opacity-50 rounded-3 p-3">
                                    <div class="benefits-content text-dark" style="font-size: 0.9rem; line-height: 1.6;">
                                        {!! $p->p_benefit !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Details Section with Collapsible Feature -->
                        @if($p->p_detail)
                            <div class="mb-4">
                                <h6 class="text-uppercase text-muted small fw-semibold mb-3">
                                    <i class="ti ti-info-circle me-1"></i>
                                    Details
                                </h6>
                                <div class="details-content text-muted" style="font-size: 0.9rem; line-height: 1.6; max-height: 100px; overflow-y: auto;">
                                    {!! $p->p_detail !!}
                                </div>
                                @if(strlen(strip_tags($p->p_detail)) > 150)
                                    <button class="btn btn-link btn-sm p-0 mt-2 text-primary" onclick="toggleDetails(this)">
                                        <i class="ti ti-chevron-down me-1"></i>
                                        Show more
                                    </button>
                                @endif
                            </div>
                        @endif

                        <!-- Action Buttons - Improved Layout -->
                        <div class="d-flex flex-column gap-2 mt-4">
                            <form action="{{route('buy.plan')}}" method="post" class="delete-form w-100">
                                @csrf
                                <input type="hidden" name="package_id" value="{{$p->id}}">
                                <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold rounded-3 hover-lift d-flex align-items-center justify-content-center">
                                    <i class="ti ti-rocket me-2 fs-5"></i>
                                    Choose This Plan
                                </button>
                            </form>

                            <form action="{{route('company.package.buy.with.credit')}}" method="post" class="delete-form w-100">
                                @csrf
                                <input type="hidden" name="package_id" value="{{$p->id}}">
                                <button type="submit" class="btn btn-outline-primary w-100 py-3 fw-semibold rounded-3 hover-lift d-flex align-items-center justify-content-center">
                                    <i class="ti ti-crown me-2 fs-5"></i>
                                    Use Credit Points
                                </button>
                            </form>
                        </div>

                        <!-- Guarantee Badge -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                <i class="ti ti-shield-check text-success me-1"></i>
                                30-day money-back guarantee
                            </small>
                        </div>

                    </div>

                </div>
            </div>
@endforeach

@endsection

@push('js')
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Message',
                text: '{{ session('success') }}',
                confirmButtonColor: 'rgba(0,83,136,0.71)'
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Message',
                text: '{{ session('error') }}',
                confirmButtonColor: 'rgba(255,0,0,0.61)'
            });
        </script>
    @endif
    <script>

        document.querySelectorAll('.delete-form').forEach(function(form){

            form.addEventListener('submit', function(e){

                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want buy this plan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Go Payment',
                    cancelButtonText: 'Cancel',
                    buttonsStyling:false,
                    customClass:{
                        confirmButton:'btn btn-danger me-2',
                        cancelButton:'btn btn-secondary'
                    }
                }).then((result)=>{

                    if(result.isConfirmed){
                        form.submit();
                    }

                });

            });

        });

    </script>
        <script>
            function toggleDetails(button) {
                const content = button.previousElementSibling;
                if (content.style.maxHeight === '100px' || !content.style.maxHeight) {
                    content.style.maxHeight = content.scrollHeight + 'px';
                    button.innerHTML = '<i class="ti ti-chevron-up me-1"></i>Show less';
                } else {
                    content.style.maxHeight = '100px';
                    button.innerHTML = '<i class="ti ti-chevron-down me-1"></i>Show more';
                }
            }

            // Initialize all detail sections
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.details-content').forEach(function(el) {
                    if (el.scrollHeight > 100) {
                        el.style.maxHeight = '100px';
                    }
                });
            });
        </script>

@endpush
