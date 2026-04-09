@extends('layout.theme')
@section('title','Sign In | IGL Tour')

@section('meta_description', $seo->description??"IGL Web Ltd")
@section('meta_keywords', $seo->keywords??"")
@section('meta_robots', $seo->robots??"")
@section('favicon', asset('storage/'.$seo->icon??asset('assets/images/favicons/favicon-16x16.png')))

@section('og_type', $seo->og_type??"")
@section('og_title', $seo->og_title??"")
@section('og_description', $seo->og_description??"")
@section('og_width', $seo->og_width??"")
@section('og_height', $seo->og_height??"")
@section('meta_image', asset('storage/'.$seo->og_image??asset('assets/images/igl.png')))

@section('twitter_title', $seo->twitter_title??"")
@section('twitter_meta_description', $seo->twitter_description??"")
@section('twitter_meta_image', asset('storage/'.$seo->twitter_image??asset('assets/images/igl.png')))

@section('content')

    <!-- Main Auth Section -->
    <section class="auth-section">
        <div class="container">
            <div class="auth-wrapper">
                <div class="auth-grid">
                    <!-- Left Side - Image & Benefits -->
                    <div class="auth-info">
                        <div class="auth-info__card">
                            <div class="auth-info__header">
                                <div class="auth-info__icon">
                                    <i class="fas fa-plane-departure"></i>
                                </div>
                                <h3>Why Join IGL Tour?</h3>
                            </div>
                            <ul class="auth-info__list">
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <div>
                                        <strong>Exclusive Deals</strong>
                                        <p>Get access to member-only discounts and special offers</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-map-marked-alt"></i>
                                    <div>
                                        <strong>Personalized Experience</strong>
                                        <p>Save your favorite destinations and get tailored recommendations</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-ticket-alt"></i>
                                    <div>
                                        <strong>Easy Booking</strong>
                                        <p>Book tours and hotels in just a few clicks</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="fas fa-headset"></i>
                                    <div>
                                        <strong>24/7 Support</strong>
                                        <p>Dedicated customer support for all your travel needs</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="auth-info__stats">
                                <div class="stat">
                                    <span class="stat-number">10K+</span>
                                    <span class="stat-label">Happy Travelers</span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat">
                                    <span class="stat-number">500+</span>
                                    <span class="stat-label">Destinations</span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat">
                                    <span class="stat-number">98%</span>
                                    <span class="stat-label">Satisfaction</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Login/Register Form -->
                    <div class="auth-form-container">
                        <div class="auth-tabs">
                            <button class="auth-tab-btn active" data-tab="login">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Sign In</span>
                            </button>
                            <button class="auth-tab-btn" data-tab="register">
                                <i class="fas fa-user-plus"></i>
                                <span>Create Account</span>
                            </button>
                        </div>

                        <!-- Login Form -->
                        <div class="auth-form active" id="login-form">
                            <form action="{{route('admin.verify')}}" method="post" class="auth-form__form">
                                @csrf
                                <div class="form-group">
                                    <label for="login-email">
                                        <i class="fas fa-envelope"></i>
                                        <span>Email Address</span>
                                    </label>
                                    <input type="email" id="login-email" name="email" placeholder="Enter your email" value="{{old('email')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="login-password">
                                        <i class="fas fa-lock"></i>
                                        <span>Password</span>
                                    </label>
                                    <div class="password-wrapper">
                                        <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
                                        <button type="button" class="toggle-password">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="form-options">
                                    <label class="checkbox-label">
                                        <input type="checkbox" name="remember">
                                        <span class="checkmark"></span>
                                        <span>Remember me</span>
                                    </label>
                                    <a href="#" class="forgot-link">Forgot Password?</a>
                                </div>

                                <button type="submit" class="auth-submit-btn">
                                    <span>Sign In</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </form>

                            <div class="auth-divider">
                                <span>Or continue with</span>
                            </div>

                            <div class="social-login">
                                <a href="{{route('google.auth')}}" class="social-btn google-btn">
                                    <i class="fab fa-google"></i>
                                    <span>Google</span>
                                </a>
{{--                                <a href="{{route('github.auth')}}" class="social-btn facebook-btn">--}}
{{--                                    <i class="fab fa-github me-2"></i>--}}
{{--                                    <span>GitHub</span>--}}
{{--                                </a>--}}
                            </div>
                        </div>

                        <!-- Register Form -->
                        <div class="auth-form" id="register-form">
                            <form action="{{route('auth.register.company')}}" method="post" class="auth-form__form">
                                @csrf
                                <div class="form-group">
                                    <label for="reg-name">
                                        <i class="fas fa-user"></i>
                                        <span>Full Name</span>
                                    </label>
                                    <input type="text" id="reg-name" name="username" placeholder="Enter your full name" value="{{old('username')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="reg-email">
                                        <i class="fas fa-envelope"></i>
                                        <span>Email Address</span>
                                    </label>
                                    <input type="email" id="reg-email" name="useremail" placeholder="Enter your email" value="{{old('useremail')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="reg-phone">
                                        <i class="fas fa-phone-alt"></i>
                                        <span>Phone Number</span>
                                    </label>
                                    <input type="tel" value="{{old('phone')}}" id="reg-phone" name="phone" placeholder="Enter your phone number" required>
                                </div>

                                <!-- NEW: Role Selection with Select2 -->
                                <div class="form-group">
                                    <label for="reg-role">
                                        <i class="fas fa-user-tag"></i>
                                        <span>Account Type</span>
                                    </label>
                                    <select id="reg-role" name="role" class="role-select" required>
                                        <option value="">Select Account Type</option>
                                        <option value="user">👤 User - Book tours & hotels</option>
                                        <option value="company">🏢 Company - List & manage tours</option>
                                    </select>
                                    <small class="role-hint" id="roleHint" style="display: none; font-size: 12px; color: #63AB45; margin-top: 8px; display: block;"></small>
                                </div>

                                <!-- Company Name Field (shown only when Company is selected) -->
                                <div class="form-group" id="companyNameGroup" style="display: none;">
                                    <label for="company-name">
                                        <i class="fas fa-building"></i>
                                        <span>Company Name</span>
                                    </label>
                                    <input type="text" id="company-name" name="company_name" placeholder="Enter your company name">
                                </div>

                                <div class="form-group">
                                    <label for="reg-password">
                                        <i class="fas fa-lock"></i>
                                        <span>Password</span>
                                    </label>
                                    <div class="password-wrapper">
                                        <input type="password" id="reg-password" name="password" placeholder="Create a password" required>
                                        <button type="button" class="toggle-password">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="checkbox-label">
                                        <input type="checkbox" required>
                                        <span class="checkmark"></span>
                                        <span>I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></span>
                                    </label>
                                </div>

                                <button type="submit" class="auth-submit-btn">
                                    <span>Create Account</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </form>

                            <div class="auth-divider">
                                <span>Or sign up with</span>
                            </div>

                            <div class="social-login">
                                <a href="{{route('google.auth')}}" class="social-btn google-btn">
                                    <i class="fab fa-google"></i>
                                    <span>Google</span>
                                </a>
{{--                                <a href="#" class="social-btn facebook-btn">--}}
{{--                                    <i class="fab fa-facebook-f"></i>--}}
{{--                                    <span>Facebook</span>--}}
{{--                                </a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('css')
        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- Select2 Bootstrap 5 Theme (optional, for better styling) -->
        <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

        <style>
            /* Hero Section */
            .auth-hero {
                position: relative;
                padding: 80px 0 60px;
                background: linear-gradient(135deg, var(--gotur-base, #63AB45) 0%, #4f9234 100%);
                overflow: hidden;
            }

            .auth-hero__bg {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>');
                background-repeat: no-repeat;
                background-position: bottom;
                background-size: cover;
                opacity: 0.3;
            }

            .auth-hero__content {
                text-align: center;
                position: relative;
                z-index: 1;
            }

            .auth-hero__title {
                font-size: 48px;
                font-weight: 800;
                color: #ffffff;
                margin-bottom: 15px;
                animation: fadeInUp 0.6s ease;
            }

            .auth-hero__subtitle {
                font-size: 18px;
                color: rgba(255, 255, 255, 0.9);
                animation: fadeInUp 0.6s ease 0.1s both;
            }

            /* Main Auth Section */
            .auth-section {
                padding: 80px 0;
                background: linear-gradient(135deg, #f8faf7 0%, #ffffff 100%);
                min-height: calc(100vh - 300px);
            }

            .auth-wrapper {
                max-width: 1200px;
                margin: 0 auto;
            }

            .auth-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 50px;
                align-items: start;
            }

            /* Left Side Info Card */
            .auth-info {
                position: sticky;
                top: 100px;
            }

            .auth-info__card {
                background: #ffffff;
                border-radius: 24px;
                padding: 40px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
                border: 1px solid rgba(99, 171, 69, 0.1);
            }

            .auth-info__header {
                text-align: center;
                margin-bottom: 30px;
            }

            .auth-info__icon {
                width: 70px;
                height: 70px;
                background: linear-gradient(135deg, var(--gotur-base, #63AB45) 0%, #4f9234 100%);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
            }

            .auth-info__icon i {
                font-size: 32px;
                color: #ffffff;
            }

            .auth-info__header h3 {
                font-size: 24px;
                font-weight: 700;
                color: var(--gotur-black, #1D231F);
            }

            .auth-info__list {
                list-style: none;
                padding: 0;
                margin: 0 0 30px;
            }

            .auth-info__list li {
                display: flex;
                gap: 15px;
                margin-bottom: 25px;
                align-items: flex-start;
            }

            .auth-info__list li i {
                width: 24px;
                height: 24px;
                background: rgba(99, 171, 69, 0.1);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 12px;
                color: var(--gotur-base, #63AB45);
                margin-top: 2px;
            }

            .auth-info__list li strong {
                display: block;
                font-size: 16px;
                font-weight: 600;
                color: var(--gotur-black, #1D231F);
                margin-bottom: 5px;
            }

            .auth-info__list li p {
                font-size: 14px;
                color: var(--gotur-text, #595959);
                line-height: 1.5;
                margin: 0;
            }

            .auth-info__stats {
                display: flex;
                align-items: center;
                justify-content: space-around;
                padding-top: 20px;
                border-top: 1px solid #E5E7EB;
            }

            .stat {
                text-align: center;
            }

            .stat-number {
                display: block;
                font-size: 24px;
                font-weight: 800;
                color: var(--gotur-base, #63AB45);
                margin-bottom: 5px;
            }

            .stat-label {
                font-size: 12px;
                color: var(--gotur-text, #595959);
            }

            .stat-divider {
                width: 1px;
                height: 40px;
                background: #E5E7EB;
            }

            /* Right Side Form Container */
            .auth-form-container {
                background: #ffffff;
                border-radius: 24px;
                padding: 40px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
                border: 1px solid rgba(99, 171, 69, 0.1);
            }

            /* Tabs */
            .auth-tabs {
                display: flex;
                gap: 15px;
                margin-bottom: 35px;
                background: #f8faf7;
                padding: 5px;
                border-radius: 60px;
            }

            .auth-tab-btn {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 12px 20px;
                background: transparent;
                border: none;
                border-radius: 50px;
                font-size: 16px;
                font-weight: 600;
                color: var(--gotur-text, #595959);
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .auth-tab-btn i {
                font-size: 16px;
            }

            .auth-tab-btn.active {
                background: var(--gotur-base, #63AB45);
                color: #ffffff;
                box-shadow: 0 5px 15px rgba(99, 171, 69, 0.3);
            }

            /* Forms */
            .auth-form {
                display: none;
            }

            .auth-form.active {
                display: block;
                animation: fadeIn 0.4s ease;
            }

            .form-group {
                margin-bottom: 25px;
            }

            .form-group label {
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 14px;
                font-weight: 600;
                color: var(--gotur-black, #1D231F);
                margin-bottom: 10px;
            }

            .form-group label i {
                color: var(--gotur-base, #63AB45);
                font-size: 14px;
            }

            .form-group input:not([type="checkbox"]),
            .form-group select {
                width: 100%;
                padding: 14px 16px;
                border: 2px solid #E5E7EB;
                border-radius: 12px;
                font-size: 14px;
                font-family: inherit;
                transition: all 0.3s ease;
                background: #ffffff;
            }

            .form-group input:not([type="checkbox"]):focus,
            .form-group select:focus {
                outline: none;
                border-color: var(--gotur-base, #63AB45);
                box-shadow: 0 0 0 4px rgba(99, 171, 69, 0.1);
            }

            /* Select2 Custom Styling */
            .role-select {
                width: 100%;
            }

            .select2-container--bootstrap-5 .select2-selection {
                padding: 10px 16px;
                border-radius: 12px;
                border: 2px solid #E5E7EB;
                min-height: 50px;
            }

            .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
                font-size: 14px;
                color: #1D231F;
            }

            .select2-container--bootstrap-5 .select2-selection--single .select2-selection__placeholder {
                color: #9CA3AF;
            }

            .select2-container--bootstrap-5 .select2-dropdown {
                border-radius: 12px;
                border-color: #E5E7EB;
            }

            .select2-container--bootstrap-5 .select2-results__option--highlighted {
                background: linear-gradient(135deg, #63AB45, #4f9234);
            }

            .password-wrapper {
                position: relative;
            }

            .password-wrapper input {
                padding-right: 45px;
            }

            .toggle-password {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                background: none;
                border: none;
                cursor: pointer;
                color: var(--gotur-text, #595959);
                font-size: 14px;
            }

            /* Checkbox */
            .checkbox-label {
                display: flex;
                align-items: center;
                gap: 10px;
                cursor: pointer;
                position: relative;
                padding-left: 0;
            }

            .checkbox-label input {
                position: absolute;
                opacity: 0;
                cursor: pointer;
            }

            .checkmark {
                width: 18px;
                height: 18px;
                background: #ffffff;
                border: 2px solid #E5E7EB;
                border-radius: 4px;
                display: inline-block;
                position: relative;
                transition: all 0.3s ease;
            }

            .checkbox-label input:checked ~ .checkmark {
                background: var(--gotur-base, #63AB45);
                border-color: var(--gotur-base, #63AB45);
            }

            .checkbox-label input:checked ~ .checkmark:after {
                content: '\f00c';
                font-family: 'Font Awesome 5 Free';
                font-weight: 900;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 10px;
                color: #ffffff;
            }

            .form-options {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 25px;
            }

            .forgot-link {
                font-size: 13px;
                color: var(--gotur-base, #63AB45);
                text-decoration: none;
                font-weight: 500;
            }

            .forgot-link:hover {
                text-decoration: underline;
            }

            /* Submit Button */
            .auth-submit-btn {
                width: 100%;
                padding: 14px;
                background: linear-gradient(135deg, var(--gotur-base, #63AB45) 0%, #4f9234 100%);
                color: #ffffff;
                border: none;
                border-radius: 12px;
                font-size: 16px;
                font-weight: 600;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-bottom: 25px;
            }

            .auth-submit-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(99, 171, 69, 0.3);
                gap: 15px;
            }

            /* Divider */
            .auth-divider {
                position: relative;
                text-align: center;
                margin: 25px 0;
            }

            .auth-divider::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 0;
                right: 0;
                height: 1px;
                background: #E5E7EB;
            }

            .auth-divider span {
                background: #ffffff;
                padding: 0 15px;
                position: relative;
                z-index: 1;
                font-size: 13px;
                color: var(--gotur-text, #595959);
            }

            /* Social Login */
            .social-login {
                display: flex;
                gap: 15px;
            }

            .social-btn {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                padding: 12px;
                border-radius: 12px;
                text-decoration: none;
                font-size: 14px;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .google-btn {
                background: #ffffff;
                border: 2px solid #E5E7EB;
                color: #595959;
            }

            .google-btn:hover {
                border-color: #DB4437;
                color: #DB4437;
                transform: translateY(-2px);
            }

            .facebook-btn {
                background: #ffffff;
                border: 2px solid #E5E7EB;
                color: #595959;
            }

            .facebook-btn:hover {
                border-color: #4267B2;
                color: #4267B2;
                transform: translateY(-2px);
            }

            /* Role hint styling */
            .role-hint {
                font-size: 12px;
                color: #6c757d;
                margin-top: 8px;
                display: block;
            }

            .role-hint i {
                margin-right: 5px;
            }

            /* Animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }

            /* Company field transition */
            #companyNameGroup {
                transition: all 0.3s ease;
                overflow: hidden;
            }

            /* Responsive */
            @media (max-width: 991px) {
                .auth-grid {
                    grid-template-columns: 1fr;
                    gap: 30px;
                }

                .auth-info {
                    position: static;
                }

                .auth-hero__title {
                    font-size: 36px;
                }

                .auth-section {
                    padding: 60px 0;
                }
            }

            @media (max-width: 768px) {
                .auth-hero {
                    padding: 50px 0 40px;
                }

                .auth-hero__title {
                    font-size: 28px;
                }

                .auth-hero__subtitle {
                    font-size: 16px;
                }

                .auth-form-container,
                .auth-info__card {
                    padding: 25px;
                }

                .auth-tabs {
                    gap: 10px;
                }

                .auth-tab-btn {
                    padding: 10px 15px;
                    font-size: 14px;
                }

                .social-login {
                    flex-direction: column;
                }
            }

            @media (max-width: 576px) {
                .form-options {
                    flex-direction: column;
                    gap: 15px;
                    align-items: flex-start;
                }
            }
        </style>
    @endpush

    @push('js')
        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Select2 for Role dropdown
                $('#reg-role').select2({
                    theme: 'bootstrap-5',
                    placeholder: 'Select Account Type',
                    allowClear: false,
                    width: '100%'
                });

                // Tab switching
                const tabBtns = document.querySelectorAll('.auth-tab-btn');
                const loginForm = document.getElementById('login-form');
                const registerForm = document.getElementById('register-form');

                tabBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const tab = this.dataset.tab;

                        tabBtns.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');

                        if (tab === 'login') {
                            loginForm.classList.add('active');
                            registerForm.classList.remove('active');
                        } else {
                            registerForm.classList.add('active');
                            loginForm.classList.remove('active');
                            // Reinitialize Select2 when register tab becomes visible
                            setTimeout(() => {
                                $('#reg-role').select2({
                                    theme: 'bootstrap-5',
                                    placeholder: 'Select Account Type',
                                    width: '100%'
                                });
                            }, 100);
                        }
                    });
                });

                // Role selection handler - Show/Hide Company Name field
                const roleSelect = document.getElementById('reg-role');
                const companyNameGroup = document.getElementById('companyNameGroup');
                const companyNameInput = document.getElementById('company-name');
                const roleHint = document.getElementById('roleHint');

                function handleRoleChange() {
                    const selectedRole = roleSelect.value;

                    if (selectedRole === 'company') {
                        companyNameGroup.style.display = 'block';
                        companyNameInput.setAttribute('required', 'required');
                        roleHint.innerHTML = '<i class="fas fa-info-circle"></i> As a company, you\'ll be able to list and manage your tours, hotels, and packages.';
                        roleHint.style.color = '#63AB45';
                    } else if (selectedRole === 'user') {
                        companyNameGroup.style.display = 'none';
                        companyNameInput.removeAttribute('required');
                        companyNameInput.value = '';
                        roleHint.innerHTML = '<i class="fas fa-info-circle"></i> As a user, you can book tours, hotels, and manage your travel plans.';
                        roleHint.style.color = '#63AB45';
                    } else {
                        companyNameGroup.style.display = 'none';
                        companyNameInput.removeAttribute('required');
                        companyNameInput.value = '';
                        roleHint.innerHTML = '';
                    }
                }

                // Listen for Select2 change event
                $('#reg-role').on('change', function() {
                    handleRoleChange();
                });

                // Also listen for native change
                if (roleSelect) {
                    roleSelect.addEventListener('change', handleRoleChange);
                }

                // Toggle password visibility
                const toggleBtns = document.querySelectorAll('.toggle-password');

                toggleBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const input = this.parentElement.querySelector('input');
                        const icon = this.querySelector('i');

                        if (input.type === 'password') {
                            input.type = 'text';
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        } else {
                            input.type = 'password';
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        }
                    });
                });

                // Form validation with role check
                const registerFormElement = document.querySelector('#register-form form');
                if (registerFormElement) {
                    registerFormElement.addEventListener('submit', function(e) {
                        const selectedRole = $('#reg-role').val();

                        if (!selectedRole) {
                            e.preventDefault();
                            Swal.fire({
                                icon: 'warning',
                                title: 'Account Type Required',
                                text: 'Please select whether you want to register as a User or Company.',
                                confirmButtonColor: '#63AB45'
                            });
                            return false;
                        }

                        if (selectedRole === 'company') {
                            const companyName = companyNameInput.value.trim();
                            if (!companyName) {
                                e.preventDefault();
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Company Name Required',
                                    text: 'Please enter your company name.',
                                    confirmButtonColor: '#63AB45'
                                });
                                return false;
                            }
                        }

                        const submitBtn = this.querySelector('.auth-submit-btn');
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';

                        // Note: Form will submit naturally - this is just visual feedback
                        setTimeout(() => {
                            submitBtn.innerHTML = originalText;
                        }, 2000);
                    });
                }

                // Form validation for login
                const loginFormElement = document.querySelector('#login-form form');
                if (loginFormElement) {
                    loginFormElement.addEventListener('submit', function(e) {
                        const submitBtn = this.querySelector('.auth-submit-btn');
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';

                        setTimeout(() => {
                            submitBtn.innerHTML = originalText;
                        }, 2000);
                    });
                }
            });
        </script>

        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonColor: '#63AB45'
                });
            </script>
        @endif

        @if(session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#63AB45'
                });
            </script>
        @endif

        @if(session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#63AB45'
                });
            </script>
        @endif
    @endpush
@endsection
