@extends('layout.admin')
@section('title','List Destination')
@section('content')
    <div class="container">
        <div class="row">
            <form style="width: 60%;margin: auto;" action="{{ route('admin.des.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="container py-4">
                    <div class="card shadow border-0 rounded-3">

                        <!-- Header -->
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Add New Destination</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3">

                                <!-- Overview -->
                                <div class="col-md-12">
                                    <label class="form-label">Overview</label>
                                    <textarea name="overview" class="form-control summernote" rows="3">{{ old('overview') }}</textarea>
                                    @error('overview')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-md-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control summernote" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Country -->
                                <div class="col-md-6">
                                    <label class="form-label">Country</label>
                                    <select name="country" id="country" class="form-control select2">
                                        <option value="">Select </option>
                                        @foreach($country as $c)
                                            <option value="{{ $c['name'] }}"
                                                {{ (collect(old('languages'))->contains($c['name'])) ? 'selected' : '' }}>
                                                {{ $c['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Price -->
                                <div class="col-md-6">
                                    <label class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                                    @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Visa -->
                                <div class="col-md-6">
                                    <label class="form-label d-block">Visa Required</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="visa" value="1"
                                            {{ old('visa', 1) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="visa" value="0"
                                            {{ old('visa') == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label">No</label>
                                    </div>
                                    @error('visa')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Languages -->
                                <div class="col-md-6">
                                    <label class="form-label">Languages</label>
                                    <select name="languages[]" id="languages" class="form-control select2" multiple>
                                        @foreach($languages as $lang)
                                            <option value="{{ $lang }}"
                                                {{ (collect(old('languages'))->contains($lang)) ? 'selected' : '' }}>
                                                {{ $lang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Map Link -->
                                <div class="col-md-12">
                                    <label class="form-label">Map Link</label>
                                    <textarea name="map_link" class="form-control" rows="2">{{ old('map_link') }}</textarea>
                                    @error('map_link')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Images -->
                                <div class="col-md-12">
                                    <label class="form-label">Destination Images</label>
                                    <input type="file" name="images[]" class="form-control" multiple>
                                    <small class="text-muted">You can upload multiple images</small>
                                    @error('images')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                    @error('images.*')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-success px-4">
                                Save Destination
                            </button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#languages').select2({
            placeholder: "Select languages",
            allowClear: true
        });
        $('#country').select2({
            placeholder: "Select Country",
            allowClear: true
        });
    </script>
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#d33'
            });
        </script>
    @endif
@endpush
