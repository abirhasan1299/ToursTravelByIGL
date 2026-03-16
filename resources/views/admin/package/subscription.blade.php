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

        /* Compact card styles */
        .compact-card .card-header {
            min-height: 100px !important;
            padding: 1rem !important;
        }

        .compact-card .avatar-sm {
            width: 40px;
            height: 40px;
            padding: 8px;
        }

        .compact-card .fs-2 {
            font-size: 1.5rem !important;
        }

        .compact-card .display-4 {
            font-size: 2rem !important;
        }

        .compact-card .feature-box {
            padding: 0.5rem !important;
        }

        .compact-card .feature-box i {
            font-size: 1.2rem !important;
            margin-bottom: 0.2rem !important;
        }

        .compact-card .feature-box span {
            font-size: 0.7rem !important;
        }

        .compact-card .feature-box .h5 {
            font-size: 1rem !important;
            margin-bottom: 0 !important;
        }

        .compact-card .benefits-section,
        .compact-card .details-section {
            margin-bottom: 0.75rem !important;
        }

        .compact-card .benefits-content {
            max-height: 60px !important;
            font-size: 0.8rem !important;
        }

        .compact-card .btn {
            padding: 0.5rem !important;
            font-size: 0.85rem !important;
        }

        /* Benefits content styling */
        .benefits-content ul,
        .benefits-content ol {
            padding-left: 1rem;
            margin-bottom: 0;
        }

        .benefits-content li {
            margin-bottom: 0.2rem;
        }

        .benefits-content p:last-child {
            margin-bottom: 0;
        }

        /* Custom scrollbar for details section */
        .details-content::-webkit-scrollbar {
            width: 3px;
        }

        .details-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .details-content::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 3px;
        }

        /* Glassmorphism effect */
        .bg-white.bg-opacity-20 {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .compact-card .display-4 {
                font-size: 1.5rem !important;
            }

            .compact-card .feature-box {
                padding: 0.3rem !important;
            }
        }

        /* Badge positioning */
        .z-1 {
            z-index: 1;
        }

        .rounded-bl-3 {
            border-bottom-left-radius: 0.75rem;
        }

        .fs-7 {
            font-size: 0.7rem;
        }
    </style>
@endpush
@section('content')
    @include('admin.partials.credit')

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
                                    @if(!empty($dates[1]))
                                        {{Carbon::parse($dates[1])->format('d M, Y')??'------'}}
                                    @endif
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
            <!-- Package Plan - Compact Version -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all rounded-3 overflow-hidden position-relative compact-card">

                    <!-- Popular Badge -->
                    @if(in_array($popularity[array_rand($popularity)], ['POPULAR',"REGULAR","BEGINNERS","STARTING","EXPERTS"]))
                        <div class="position-absolute top-0 end-0 bg-warning text-dark px-2 py-1 rounded-bl-3 fs-7 fw-semibold z-1"
                             style="border-bottom-left-radius: 0.75rem; background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);">
                            <i class="ti ti-star me-1"></i>
                            {{$popularity[array_rand($popularity)]}}
                        </div>
                    @endif

                    <!-- Card Header - Compact -->
                    <div class="card-header border-0 p-3 text-center position-relative"
                         style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 90px !important;">

                        <!-- Decorative Pattern -->
                        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10"
                             style="background-image: url('data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); background-repeat: repeat; background-size: 20px;">
                        </div>

                        <!-- Package Name with Icon - Compact -->
                        <div class="position-relative z-1 d-flex align-items-center justify-content-center gap-2">
                            <div class="d-inline-block bg-white bg-opacity-20 rounded-circle p-2 avatar-sm">
                                <i class="ti ti-package text-white fs-4"></i>
                            </div>
                            <h4 class="fw-bold mb-0 text-white text-uppercase tracking-wide" style="font-size: 1.1rem;">
                                {{ strtoupper($p->p_name) }}
                            </h4>
                        </div>
                    </div>

                    <div class="card-body p-3">

                        <!-- Package Price - Compact -->
                        <div class="text-center mb-3 pb-2 border-bottom border-light">
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="text-muted align-self-start mt-1 small">{{ config('app.currency') }}</span>
                                <h2 class="display-6 fw-bold text-dark mb-0 mx-1">{{ number_format($p->p_price) }}</h2>
                                <span class="text-muted align-self-end mb-1 small">/pkg</span>
                            </div>
                            <span class="badge bg-light text-dark px-2 py-1 rounded-pill mt-1 small">
                                <i class="ti ti-calendar me-1"></i>
                                One time
                            </span>
                        </div>

                        <!-- Package Features - Compact Grid -->
                        <div class="mb-3">
                            <div class="row g-2">
                                <!-- Post Limit -->
                                <div class="col-4">
                                    <div class="bg-light rounded-2 p-2 text-center feature-box">
                                        <i class="ti ti-file-text text-primary d-block" style="font-size: 1.1rem;"></i>
                                        <span class="text-muted small d-block" style="font-size: 0.65rem;">Posts</span>
                                        <span class="fw-semibold small">{{ $p->p_post_limit ?? '∞' }}</span>
                                    </div>
                                </div>

                                <!-- Credit -->
                                <div class="col-4">
                                    <div class="bg-light rounded-2 p-2 text-center feature-box">
                                        <i class="ti ti-crown text-primary d-block" style="font-size: 1.1rem;"></i>
                                        <span class="text-muted small d-block" style="font-size: 0.65rem;">Credits</span>
                                        <span class="fw-semibold small">{{ $p->p_credit }}</span>
                                    </div>
                                </div>

                                <!-- Duration -->
                                <div class="col-4">
                                    <div class="bg-light rounded-2 p-2 text-center feature-box">
                                        <i class="ti ti-clock text-primary d-block" style="font-size: 1.1rem;"></i>
                                        <span class="text-muted small d-block" style="font-size: 0.65rem;">Days</span>
                                        <span class="fw-semibold small">{{ getDaysFromRange($p->p_date_range) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Benefits Section - Compact -->
                        @if($p->p_benefit)
                            <div class="mb-2 details-section">
                                <div class="bg-light bg-opacity-25 rounded-2 p-2">
                                    <div class="benefits-content text-dark small" style="font-size: 0.75rem; line-height: 1.3; max-height: 45px; overflow-y: auto;">
                                        {!! $p->p_benefit !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons - Compact -->
                        <div class="d-flex flex-column gap-2 mt-2">
                            <form action="{{route('buy.plan')}}" method="post" class="delete-form w-100">
                                @csrf
                                <input type="hidden" name="package_id" value="{{$p->id}}">
                                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold rounded-2 hover-lift d-flex align-items-center justify-content-center" style="font-size: 0.8rem;">
                                    <i class="ti ti-rocket me-1"></i>
                                    Buy Now
                                </button>
                            </form>

                            <form action="{{route('company.package.buy.with.credit')}}" method="post" class="delete-form w-100">
                                @csrf
                                <input type="hidden" name="package_id" value="{{$p->id}}">
                                <button type="submit" class="btn btn-outline-primary w-100 py-2 fw-semibold rounded-2 hover-lift d-flex align-items-center justify-content-center" style="font-size: 0.8rem;">
                                    <i class="ti ti-crown me-1"></i>
                                    Use Credits
                                </button>
                            </form>
                        </div>

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
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-danger me-2',
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((result)=>{
                    if(result.isConfirmed){
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
