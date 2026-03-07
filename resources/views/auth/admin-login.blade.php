<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Sign In </title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Admin Panel" />
        <meta name="keywords" content="Admin Panel" />
        <meta name="author" content="Admin" />

 <!-- App favicon -->
<link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
 <!-- Theme Config Js -->
<script src="{{asset('assets/js/config.js')}}"></script>

<!-- Vendor css -->
<link href="{{asset('assets/css/vendors.min.css')}}" rel="stylesheet" type="text/css" />

<!-- App css -->
<link id="app-style" href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="position-absolute top-0 end-0">
            <img src="{{asset('assets/images/auth-card-bg.svg')}}" class="auth-card-bg-img" alt="auth-card-bg" />
        </div>
        <div class="position-absolute bottom-0 start-0" style="transform: rotate(180deg)">
            <img src="{{asset('assets/images/auth-card-bg.svg')}}" class="auth-card-bg-img" alt="auth-card-bg" />
        </div>
        <div class="auth-box overflow-hidden align-items-center d-flex">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-5 col-md-6 col-sm-8">
                        <div class="card p-4">
                            @if(session('error'))
                                <div class="alert alert-danger text-bg-danger alert-dismissible" role="alert">
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <div>{{session('error')}}</div>
                                </div>
                            @endif
                            <form action="{{route(('admin.verify'))}}" method="post" autocomplete="off">
                                    @csrf
                                <div class="mb-3">
                                    <label for="userEmail" class="form-label">
                                        Email address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="email" name="email" class="form-control" id="userEmail" placeholder="you&#64;example.com" required />

                                    </div>
                                    @error('email')
                                    <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="userPassword" class="form-label">
                                        Password
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="userPassword" placeholder="••••••••" required  />
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary fw-semibold py-2">Sign In</button>
                                </div>
                            </form>

                        </div>

                        <p class="text-center text-muted mt-4 mb-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            {{config('app.company_name')}}
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- end auth-fluid-->
        <!-- Vendor js -->
        <script src="{{asset('assets/js/vendors.min.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/app.js')}}"></script>



    </body>
</html>
