@extends('layout.admin')
@section('title','Edit SEO')

@section('content')
    <div class="container-fluid px-4 py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">

                {{-- Main Card --}}
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">

                    {{-- Header --}}
                    <div class="card-header bg-gradient-primary text-white py-3 px-4">
                        <div class="d-flex align-items-center gap-3">
                            <i class="ti ti-chart-pie-filled fs-1"></i>
                            <div>
                                <h4 class="mb-0 fw-bold">Edit SEO Configuration</h4>
                                <p class="mb-0 opacity-75 small">
                                    Manage meta tags, social sharing, and SEO settings for:
                                    <strong>{{ $seo->page_name ?? 'New Page' }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('admin.seo.update', $seo->id) }}" method="POST" enctype="multipart/form-data" id="seoForm">
                        @csrf
                        @method('PUT')
                        <div class="card-body p-4 p-lg-5">

                            {{-- Error Alerts --}}
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                                    <i class="ti ti-alert-circle"></i>
                                    <strong>Please fix the following errors:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            {{-- Success Message --}}
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                                    <i class="ti ti-check-circle"></i> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- ================= BASIC SEO ================= -->
                            <div class="mb-5">
                                <div class="d-flex align-items-center gap-2 mb-4 pb-1 border-bottom">
                                    <div class="bg-primary rounded-circle p-2 d-flex justify-content-center align-items-center" style="width:40px;height:40px;">
                                        <i class="ti ti-world-search text-white fs-5"></i>
                                    </div>
                                    <h5 class="mb-0 fw-bold">Basic SEO Configuration</h5>
                                    <span class="badge bg-primary ms-2">Required</span>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label"><i class="ti ti-tags me-1"></i> Page Name</label>
                                        <select name="page_name" class="form-control keyword-select" data-toggle="select2">
                                            @foreach($url as $u)
                                                <option value="{{ $u['uri'] }}" {{ old('page_name', $seo->page_name ?? '') == $u['uri'] ? 'selected' : '' }}>
                                                    {{ $u['uri'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="form-text">Select an existing page for SEO settings</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold"><i class="ti ti-robot me-1"></i> Robots Meta</label>
                                        <input type="text" name="robots" class="form-control @error('robots') is-invalid @enderror"
                                               value="{{ old('robots', $seo->robots ?? 'index, follow') }}">
                                        @error('robots')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold"><i class="ti ti-description me-1"></i> Meta Description</label>
                                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $seo->description) }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold"><i class="ti ti-tags me-1"></i> Keywords</label>
                                        <select name="keywords[]" multiple class="form-control keyword-select" data-toggle="select2">
                                            @php
                                                $oldKeywords = old('keywords', isset($seo->keywords) ? explode(',', $seo->keywords) : []);
                                                $keywordOptions = ['seo','marketing','analytics','performance','backlinks','optimization','laravel','bootstrap'];
                                            @endphp
                                            @foreach($keywordOptions as $keyword)
                                                <option value="{{ $keyword }}" {{ in_array($keyword, (array)$oldKeywords) ? 'selected' : '' }}>
                                                    {{ ucfirst($keyword) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold"><i class="ti ti-photo me-1"></i> Favicon</label>
                                        <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror" accept="image/*">
                                        @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                        @if($seo->icon)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $seo->icon) }}" alt="Favicon" class="border rounded p-1" width="32" height="32">
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="remove_icon" value="1" class="form-check-input" id="removeIcon">
                                                    <label class="form-check-label text-danger small" for="removeIcon">Remove current favicon</label>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- ================= OPEN GRAPH ================= -->
                            <div class="mb-5">
                                <div class="d-flex align-items-center gap-2 mb-4 pb-1 border-bottom">
                                    <div class="bg-success rounded-circle p-2 d-flex justify-content-center align-items-center" style="width:40px;height:40px;">
                                        <i class="ti ti-brand-facebook text-white fs-5"></i>
                                    </div>
                                    <h5 class="mb-0 fw-bold">Open Graph (Social Sharing)</h5>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold"><i class="ti ti-type"></i> OG Type</label>
                                        <input type="text" name="og_type" class="form-control" value="{{ old('og_type', $seo->og_type ?? 'website') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold"><i class="ti ti-heading"></i> OG Title</label>
                                        <input type="text" name="og_title" class="form-control" value="{{ old('og_title', $seo->og_title) }}">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold"><i class="ti ti-align-left"></i> OG Description</label>
                                        <textarea name="og_description" class="form-control">{{ old('og_description', $seo->og_description) }}</textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold"><i class="ti ti-image"></i> OG Image</label>
                                        <input type="file" name="og_image" class="form-control" accept="image/*">
                                        @if($seo->og_image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $seo->og_image) }}" alt="OG Image" class="border rounded" style="max-width:200px;">
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="remove_og_image" value="1" class="form-check-input" id="removeOgImage">
                                                    <label class="form-check-label text-danger small" for="removeOgImage">Remove current image</label>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold"><i class="ti ti-ruler"></i> Image Width</label>
                                        <input type="text" name="og_image_width" class="form-control" value="{{ old('og_image_width', $seo->og_image_width ?? '1200') }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold"><i class="ti ti-ruler-2"></i> Image Height</label>
                                        <input type="text" name="og_image_height" class="form-control" value="{{ old('og_image_height', $seo->og_image_height ?? '630') }}">
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- ================= TWITTER CARD ================= -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center gap-2 mb-4 pb-1 border-bottom">
                                    <div class="bg-info rounded-circle p-2 d-flex justify-content-center align-items-center" style="width:40px;height:40px;">
                                        <i class="ti ti-brand-twitter text-white fs-5"></i>
                                    </div>
                                    <h5 class="mb-0 fw-bold">Twitter Card Configuration</h5>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold"><i class="ti ti-card"></i> Twitter Card Type</label>
                                        <input type="text" name="twitter_cart" class="form-control" value="{{ old('twitter_cart', $seo->twitter_cart ?? 'summary_large_image') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold"><i class="ti ti-typography"></i> Twitter Title</label>
                                        <input type="text" name="twitter_title" class="form-control" value="{{ old('twitter_title', $seo->twitter_title) }}">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold"><i class="ti ti-message"></i> Twitter Description</label>
                                        <textarea name="twitter_description" class="form-control">{{ old('twitter_description', $seo->twitter_description) }}</textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold"><i class="ti ti-photo-up"></i> Twitter Image</label>
                                        <input type="file" name="twitter_image" class="form-control" accept="image/*">
                                        @if($seo->twitter_image)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $seo->twitter_image) }}" alt="Twitter Image" class="border rounded" style="max-width:200px;">
                                                <div class="form-check mt-2">
                                                    <input type="checkbox" name="remove_twitter_image" value="1" class="form-check-input" id="removeTwitterImage">
                                                    <label class="form-check-label text-danger small" for="removeTwitterImage">Remove current image</label>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Footer Buttons --}}
                        <div class="card-footer bg-light border-0 py-3 px-4 px-lg-5 d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.seo.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="ti ti-arrow-left"></i> Back
                            </a>
                            <button type="submit" class="btn btn-dark rounded-pill px-5 shadow-sm">
                                <i class="ti ti-device-floppy"></i> Update SEO
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }
        .keyword-select {
            border-radius: 8px;
        }
        .card { transition: transform 0.2s; }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function(){
            $('.keyword-select').select2({ theme: 'default', tags:true, tokenSeparators:[',',' '] });
        });
    </script>
@endpush
