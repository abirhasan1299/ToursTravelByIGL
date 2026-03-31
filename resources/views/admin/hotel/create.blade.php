@extends('layout.admin')
@section('title','List Company')

@section('content')
    <div class="contanier">
        <div class="row">
            <form action="{{ route('company.hotel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="container py-4">
                    <div class="card shadow border-0">

                        <!-- Header -->
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="bi bi-plus-circle me-2"></i> Create Listing
                            </h5>
                        </div>

                        <div class="card-body">

                            <!-- Basic Info -->
                            <h6 class="text-muted mb-3">Basic Information</h6>
                            <div class="row g-3 mb-4">

                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="name"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="Name"
                                               value="{{ old('name') }}" required>
                                        <label>Name</label>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text"> BDT </span>
                                        <div class="form-floating">
                                            <input type="number" name="price"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   placeholder="Price"
                                                   value="{{ old('price') }}" required>
                                            <label>Price</label>
                                            @error('price')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Location Info -->
                            <h6 class="text-muted mb-3">Location Details</h6>
                            <div class="row g-3 mb-4">

                                <!-- Address -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="address"
                                               class="form-control @error('address') is-invalid @enderror"
                                               placeholder="Address"
                                               value="{{ old('address') }}">
                                        <label>Address</label>
                                        @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Location -->
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="location"
                                               class="form-control @error('location') is-invalid @enderror"
                                               placeholder="Location"
                                               value="{{ old('location') }}">
                                        <label>City / Area</label>
                                        @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Map URL -->
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="ti ti-globe"></i></span>
                                        <div class="form-floating">
                                            <input type="text" name="map_url"
                                                   class="form-control @error('map_url') is-invalid @enderror"
                                                   placeholder="Map URL"
                                                   value="{{ old('map_url') }}">
                                            <label>Google Map URL</label>
                                            @error('map_url')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Time Info -->
                            <h6 class="text-muted mb-3">Check Time</h6>
                            <div class="row g-3 mb-4">

                                <!-- Check In -->
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Check In</label>
                                    <input type="time" name="checkIn"
                                           class="form-control @error('checkIn') is-invalid @enderror"
                                           value="{{ old('checkIn') }}">
                                    @error('checkIn')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Check Out -->
                                <div class="col-md-6">
                                    <label class="form-label small text-muted">Check Out</label>
                                    <input type="time" name="checkOut"
                                           class="form-control @error('checkOut') is-invalid @enderror"
                                           value="{{ old('checkOut') }}">
                                    @error('checkOut')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <!-- Map Embed -->
                            <h6 class="text-muted mb-3">Map Embed</h6>
                            <div class="mb-4">
                    <textarea name="map_embed_code"
                              class="form-control @error('map_embed_code') is-invalid @enderror"
                              rows="3"
                              placeholder="<iframe ...>">{{ old('map_embed_code') }}</textarea>
                                @error('map_embed_code')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <h6 class="text-muted mb-3">Description</h6>
                            <div class="mb-4">
                    <textarea id="description" name="description"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Images -->
                            <h6 class="text-muted mb-3">Images</h6>
                            <div class="mb-3">
                                <input type="file" name="images[]"
                                       class="form-control @error('images.*') is-invalid @enderror"
                                       multiple accept="image/*">
                                <div class="form-text">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Upload multiple images (JPG, PNG)
                                </div>
                                @error('images.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Facilities -->
                            <h6 class="text-muted mb-3">Facilities</h6>
                            <div class="mb-4">
                                <select name="facilities[]"
                                        class="form-control select2 @error('facilities') is-invalid @enderror"
                                        multiple>

                                    @foreach($facilities as $facility)
                                        <option value="{{ $facility->id }}"
                                            {{ (collect(old('facilities'))->contains($facility->id)) ? 'selected' : '' }}>
                                            {{ $facility->title }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('facilities')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="card-footer bg-light d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Submit
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@push('js')

@endpush
