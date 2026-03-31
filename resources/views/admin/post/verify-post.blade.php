@php use Carbon\Carbon; @endphp
@extends('layout.admin')
@section('title', 'Package Verify')

@push('css')
    <style>
        .package-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .info-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: transform 0.2s;
            margin-bottom: 1.5rem;
        }
        .info-card:hover {
            transform: translateY(-3px);
        }
        .info-card .card-header {
            background: transparent;
            border-bottom: 2px solid #e9ecef;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 1rem 1.5rem;
        }
        .info-label {
            font-weight: 600;
            color: #495057;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-value {
            font-size: 1rem;
            color: #212529;
        }
        .badge-status {
            padding: 8px 15px;
            border-radius: 30px;
            font-weight: 500;
        }
        .badge-active {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-inactive {
            background-color: #f8d7da;
            color: #721c24;
        }
        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        .cover-img {
            border-radius: 15px;
            max-height: 300px;
            width: 100%;
            object-fit: cover;
        }
        .subdestination-badge {
            background-color: #e9ecef;
            color: #495057;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            margin: 0 5px 5px 0;
            display: inline-block;
        }
        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }
        .summary-box {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            margin-bottom: 1rem;
        }
        .summary-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: #667eea;
        }
        .summary-label {
            font-size: 0.8rem;
            color: #6c757d;
            text-transform: uppercase;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="package-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="display-6 fw-bold mb-2">{{ $package->title }}</h1>
                    <p class="mb-0 opacity-75">
                        <i class="fas fa-calendar-alt me-2"></i> Created: {{ Carbon::parse($package->created_at)->format('M d, Y') }}
                        <span class="mx-2">|</span>
                        <i class="fas fa-edit me-2"></i> Updated: {{ Carbon::parse($package->updated_at)->format('M d, Y') }}
                    </p>
                </div>
                <div>
                    <a href="{{route('admin.post.index')}}" class="btn btn-light me-2">
                        <i class="ti ti-arrow-left"></i> Back
                    </a>

                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Main Info -->
            <div class="col-lg-8">
                <!-- Cover Image -->
                @if($package->cover_img)
                    <div class="card info-card mb-4">
                        <div class="card-body p-0">
                            <img src="{{ asset('storage/package/' . $package->cover_img) }}" alt="Cover Image" class="cover-img">
                        </div>
                    </div>
                @endif

                <!-- Package Details -->
                <div class="card info-card">
                    <div class="card-header">
                        <i class="fas fa-info-circle me-2"></i> Package Details
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Tour Title</div>
                                <div class="info-value fw-semibold">{{ $package->title }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Tour Type</div>
                                <div class="info-value">
                                    @if($package->tour_type)
                                        <span class="badge bg-info">{{ ucfirst($package->tour_type) }}</span>
                                    @else
                                        <span class="text-muted">Not specified</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Duration</div>
                                <div class="info-value">
                                    @if($package->day && $package->night)
                                        {{ $package->day }} Days / {{ $package->night }} Nights
                                    @elseif($package->day)
                                        {{ $package->day }} Days
                                    @elseif($package->night)
                                        {{ $package->night }} Nights
                                    @else
                                        <span class="text-muted">Not specified</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Max People</div>
                                <div class="info-value">
                                    @if($package->max_people)
                                        <i class="fas fa-users me-1"></i> {{ $package->max_people }} persons
                                    @else
                                        <span class="text-muted">Unlimited</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Start Location</div>
                                <div class="info-value">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $package->start_location }}
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-label">End Location</div>
                                <div class="info-value">
                                    <i class="fas fa-flag-checkered text-success me-1"></i> {{ $package->end_location }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sub Destinations -->
                @php
                    $subdestinations = is_string($package->subdestination) ? json_decode($package->subdestination, true) : $package->subdestination;
                @endphp
                @if(!empty($subdestinations) && is_array($subdestinations))
                    <div class="card info-card">
                        <div class="card-header">
                            <i class="fas fa-location-dot me-2"></i> Sub Destinations
                        </div>
                        <div class="card-body">
                            @foreach($subdestinations as $dest)
                                <span class="subdestination-badge">
                            <i class="fas fa-map-pin me-1"></i> {{ $dest }}
                        </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- What's Included -->
                <div class="card info-card">
                    <div class="card-header">
                        <i class="fas fa-check-circle text-success me-2"></i> What's Included
                    </div>
                    <div class="card-body">
                        {!! $package->include !!}
                    </div>
                </div>

                <!-- What's Excluded -->
                <div class="card info-card">
                    <div class="card-header">
                        <i class="fas fa-times-circle text-danger me-2"></i> What's Excluded
                    </div>
                    <div class="card-body">
                        {!! $package->exclude !!}
                    </div>
                </div>

                <!-- Detailed Description -->
                <div class="card info-card">
                    <div class="card-header">
                        <i class="fas fa-file-alt me-2"></i> Detailed Description
                    </div>
                    <div class="card-body">
                        {!! $package->detail !!}
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar Info -->
            <div class="col-lg-4">
                <!-- Summary Cards -->
                <div class="summary-box">
                    <div class="summary-number">{{config('app.currency')}} {{ number_format($package->amount, 2) }}</div>
                    <div class="summary-label">Package Price</div>
                </div>

                <!-- Status Card -->
                <div class="card info-card">
                    <div class="card-header">
                        <i class="fas fa-chart-line me-2"></i> Status & Information
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="info-label">Current Status</div>
                            <div class="mt-2">
                                @php
                                    $statusClass = '';
                                    $statusText = ucfirst($package->status);
                                    if($package->status == 'active') $statusClass = 'badge-active';
                                    elseif($package->status == 'inactive') $statusClass = 'badge-inactive';
                                    else $statusClass = 'badge-pending';
                                @endphp
                                <span class="badge-status {{ $statusClass }}">{{ $statusText }}</span>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <div class="info-label">Package ID</div>
                            <div class="info-value">#{{ $package->id }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="info-label">Created By (User ID)</div>
                            <div class="info-value">{{ $package->user_id }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="info-label">Created At</div>
                            <div class="info-value">{{ Carbon::parse($package->created_at)->format('F d, Y h:i A') }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="info-label">Last Updated</div>
                            <div class="info-value">{{ Carbon::parse($package->updated_at)->format('F d, Y h:i A') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="card info-card">
                    <div class="card-header">
                        <i class="fas fa-bolt me-2"></i> Verification
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{route('admin.post.active',base64_encode($package->id))}}" class="btn btn-outline-success" role="button">
                                <i class="ti ti-check text-success"></i>  Approve
                            </a>
                            <a href="{{route('admin.post.suspend',base64_encode($package->id))}}" class="btn btn-outline-danger" role="button">
                                <i class="ti ti-x text-danger"></i> Suspended
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>

    </script>
@endpush
