@extends('layout.admin')
@section('title', 'Settings Website')
@push('css')

@endpush

@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <form method="post" action="{{route('admin.setting.store')}}" style="width: 70%;margin: auto;" class="mb-5" >
                @csrf
                <!-- Personal Info -->
                <h5 class="mb-3 text-uppercase bg-light-subtle p-1 border-dashed border rounded border-light d-flex justify-content-center align-items-center gap-1">
                    <i class="ti ti-user-circle fs-lg"></i>
                    Website Information
                </h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">App Name</label>
                            <input type="text" class="form-control" name="app_name" placeholder="Website Name" value="{{old('app_name',$data->app_name??'')}}" />
                        </div>
                        @error('app_name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="lastname" class="form-label">App About</label>
                            <input type="text" class="form-control" name="app_about" placeholder="About" value="{{old('app_about',$data->app_about??'')}}" />
                        </div>
                        @error('app_about')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">App Email</label>
                            <input type="email" class="form-control" name="app_email" placeholder="email@gmail.com" value="{{old('app_email',$data->app_email??'')}}" />
                        </div>
                        @error('app_email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">App Phone</label>
                            <input type="text" class="form-control" name="app_phone" placeholder="App Phone" value="{{old('app_phone',$data->app_phone??'')}}" />
                        </div>
                        @error('app_phone')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="useremail" class="form-label">App Currency</label>
                            <input type="text" class="form-control" name="app_currency" placeholder="eg. BDT, USD, AED" value="{{old('app_currency',$data->app_currency??'')}}" />
                        </div>
                        @error('app_currency')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Working Hour</label>
                            <input type="text" class="form-control" name="app_working_hour" placeholder="Working Hour" value="{{old('app_working_hour',$data->app_working_hour??'')}}" />
                        </div>
                        @error('app_working_hour')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="address-line1" class="form-label">Address</label>
                            <input type="text" class="form-control" name="app_address" placeholder="Street, Apartment, Unit, etc." value="{{old('app_address',$data->app_address??'')}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="address-line2" class="form-label">Google Map Link</label>
                            <input type="text" class="form-control" name="app_google_map" placeholder="Optional" value="{{old('app_google_map',$data->app_google_map??'')}}" />
                        </div>
                    </div>
                </div>

                <!-- Social -->
                <h5 class="mb-3 text-uppercase bg-light-subtle p-1 border-dashed border rounded border-light d-flex justify-content-center align-items-center gap-1">
                    <i class="ti ti-world fs-lg"></i>
                    Social
                </h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="social-fb" class="form-label">Facebook</label>
                        <div class="input-group">
                                                                <span class="input-group-text">
                                                                    <svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16"
                                                                        height="16"
                                                                        viewBox="0 0 24 24"
                                                                        fill="none"
                                                                        stroke="currentColor"
                                                                        stroke-width="2"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook"
                                                                    >
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                                                                    </svg>
                                                                </span>
                            <input type="url" class="form-control" name="app_facebook" placeholder="Facebook URL" value="{{old('app_facebook',$data->app_facebook??'')}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="social-tw" class="form-label">Twitter X</label>
                        <div class="input-group">
                                                                <span class="input-group-text">
                                                                    <svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16"
                                                                        height="16"
                                                                        viewBox="0 0 24 24"
                                                                        fill="none"
                                                                        stroke="currentColor"
                                                                        stroke-width="2"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-brand-x"
                                                                    >
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                                                                        <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                                                                    </svg>
                                                                </span>
                            <input type="url" class="form-control" name="app_twitter" placeholder="&#64;username" value="{{old('app_twitter',$data->app_twitter??'')}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="social-insta" class="form-label">Instagram</label>
                        <div class="input-group">
                                                                <span class="input-group-text">
                                                                    <svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16"
                                                                        height="16"
                                                                        viewBox="0 0 24 24"
                                                                        fill="none"
                                                                        stroke="currentColor"
                                                                        stroke-width="2"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-brand-instagram"
                                                                    >
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path d="M4 8a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                                                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                                        <path d="M16.5 7.5v.01" />
                                                                    </svg>
                                                                </span>
                            <input type="text" class="form-control" name="app_instagram" placeholder="Instagram URL" value="{{old('app_instagram',$data->app_instagram??'')}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="social-gh" class="form-label">Youtube</label>
                        <div class="input-group">
                                                                <span class="input-group-text">
                                                                    <svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16"
                                                                        height="16"
                                                                        viewBox="0 0 24 24"
                                                                        fill="none"
                                                                        stroke="currentColor"
                                                                        stroke-width="2"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-brand-youtube"
                                                                    >
                                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                        <path
                                                                            d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5"
                                                                        />
                                                                    </svg>
                                                                </span>
                            <input type="text" class="form-control" name="app_youtube" placeholder="Youtube Link" value="{{old('app_youtube',$data->app_youtube??'')}}" />
                        </div>
                    </div>

                </div>

                <!-- Submit -->
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Message',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3061fd'
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Message',
                text: '{{ session('error') }}',
                confirmButtonColor: 'rgb(190,0,0)'
            });
        </script>
    @endif
@endpush
