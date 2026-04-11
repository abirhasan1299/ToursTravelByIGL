{{-- resources/views/front/user/profile.blade.php --}}
@extends('layout.theme')
@section('title', 'My Profile')

@section('meta_description', 'Manage your profile settings and personal information')
@section('meta_keywords', 'profile, user account, settings')
@section('meta_robots', 'noindex, nofollow')

@push('css')
    <style>
        /* Profile Section Styles */
        .profile-section {
            padding: 120px 0 80px;
            background: linear-gradient(180deg, #f8faf7 0%, #ffffff 100%);
            min-height: 100vh;
        }

        /* Profile Container */
        .profile-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* Profile Header */
        .profile-header {
            margin-bottom: 30px;
        }

        .profile-header__title {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .profile-header__title span {
            color: #63AB45;
        }

        .profile-header__subtitle {
            font-size: 14px;
            color: #666;
        }

        /* Profile Card */
        .profile-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            border: 1px solid rgba(99, 171, 69, 0.1);
            margin-bottom: 30px;
        }

        /* Profile Tabs */
        .profile-tabs {
            display: flex;
            padding: 0 24px;
            border-bottom: 2px solid rgba(99, 171, 69, 0.1);
            background: #fafdf8;
        }

        .profile-tab {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 18px 24px;
            border: none;
            background: none;
            font-size: 15px;
            font-weight: 600;
            color: #888;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
            transition: all 0.3s ease;
        }

        .profile-tab i {
            font-size: 16px;
        }

        .profile-tab:hover {
            color: #63AB45;
        }

        .profile-tab.active {
            color: #63AB45;
            border-bottom-color: #63AB45;
            background: rgba(99, 171, 69, 0.03);
        }

        /* Profile Content */
        .profile-content {
            padding: 32px;
        }

        .profile-pane {
            display: none;
        }

        .profile-pane.active {
            display: block;
        }

        /* Avatar Upload */
        .profile-avatar-wrapper {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(99, 171, 69, 0.1);
        }

        .profile-avatar {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #63AB45;
            box-shadow: 0 4px 15px rgba(99, 171, 69, 0.2);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-avatar__overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(99, 171, 69, 0.8);
            padding: 6px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0;
        }

        .profile-avatar:hover .profile-avatar__overlay {
            opacity: 1;
        }

        .profile-avatar__overlay i {
            color: #ffffff;
            font-size: 14px;
        }

        .profile-avatar-info h4 {
            font-size: 18px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .profile-avatar-info p {
            font-size: 13px;
            color: #888;
            margin-bottom: 8px;
        }

        .profile-avatar-info .btn-change-avatar {
            padding: 6px 16px;
            background: rgba(99, 171, 69, 0.1);
            color: #63AB45;
            border: 1px solid rgba(99, 171, 69, 0.2);
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-avatar-info .btn-change-avatar:hover {
            background: #63AB45;
            color: #ffffff;
        }

        /* Form Styles */
        .profile-form {
            max-width: 600px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .form-label i {
            color: #63AB45;
            margin-right: 6px;
            font-size: 13px;
        }

        .form-control-wrapper {
            position: relative;
        }

        .form-control-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #63AB45;
            font-size: 15px;
            pointer-events: none;
            z-index: 2;
        }

        .form-control {
            width: 100%;
            height: 48px;
            padding: 0 16px 0 46px;
            border: 1.5px solid #E5E5E5;
            border-radius: 12px;
            background: #fafdf8;
            font-size: 14px;
            color: #333;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #63AB45;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(99, 171, 69, 0.1);
        }

        .form-control:disabled,
        .form-control[readonly] {
            background: #f5f5f5;
            color: #888;
            cursor: not-allowed;
        }

        /* Password Strength */
        .password-strength {
            margin-top: 8px;
        }

        .strength-bar {
            height: 4px;
            background: #E5E5E5;
            border-radius: 2px;
            margin-bottom: 4px;
            overflow: hidden;
        }

        .strength-bar-fill {
            height: 100%;
            width: 0;
            border-radius: 2px;
            transition: width 0.3s ease, background 0.3s ease;
        }

        .strength-bar-fill.weak {
            width: 33%;
            background: #ff4757;
        }

        .strength-bar-fill.medium {
            width: 66%;
            background: #ffa502;
        }

        .strength-bar-fill.strong {
            width: 100%;
            background: #63AB45;
        }

        .strength-text {
            font-size: 11px;
            color: #888;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid rgba(99, 171, 69, 0.1);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 28px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #63AB45 0%, #4f9234 100%);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(99, 171, 69, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 171, 69, 0.4);
        }

        .btn-secondary {
            background: #f5f5f5;
            color: #666;
            border: 1px solid #E5E5E5;
        }

        .btn-secondary:hover {
            background: #eeeeee;
        }

        .btn-outline-primary {
            background: transparent;
            color: #63AB45;
            border: 1.5px solid #63AB45;
        }

        .btn-outline-primary:hover {
            background: #63AB45;
            color: #ffffff;
        }

        /* Account Info Card */
        .info-card {
            background: #fafdf8;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 24px;
            border: 1px solid rgba(99, 171, 69, 0.1);
        }

        .info-card__title {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-card__title i {
            color: #63AB45;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px dashed rgba(99, 171, 69, 0.1);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-item__label {
            font-size: 13px;
            color: #888;
        }

        .info-item__value {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .badge-success {
            background: rgba(99, 171, 69, 0.1);
            color: #63AB45;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Alert Messages */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: rgba(99, 171, 69, 0.1);
            border: 1px solid rgba(99, 171, 69, 0.3);
            color: #4f9234;
        }

        .alert-error {
            background: rgba(255, 71, 87, 0.1);
            border: 1px solid rgba(255, 71, 87, 0.3);
            color: #ff4757;
        }

        .alert i {
            font-size: 20px;
        }

        /* Loading Spinner */
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #ffffff;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .profile-section {
                padding: 100px 0 60px;
            }

            .profile-tabs {
                padding: 0 16px;
            }

            .profile-tab {
                padding: 14px 16px;
                font-size: 13px;
            }

            .profile-content {
                padding: 24px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .profile-avatar-wrapper {
                flex-direction: column;
                text-align: center;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .profile-header__title {
                font-size: 24px;
            }

            .profile-tab span {
                display: none;
            }

            .profile-tab i {
                font-size: 18px;
            }

            .profile-tab {
                padding: 14px 20px;
            }
        }
    </style>
@endpush

@section('content')
    <section class="profile-section" style="margin-top: -80px;">
        <div class="container profile-container">
            {{-- Profile Header --}}
            <div class="profile-header">
                <h1 class="profile-header__title wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
                    My <span>Profile</span>
                </h1>
                <p class="profile-header__subtitle wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                    Manage your account settings and personal information
                </p>
            </div>

            {{-- Alert Messages --}}
            @if(session('success'))
                <div class="alert alert-success wow fadeInUp" data-wow-duration="1500ms">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error wow fadeInUp" data-wow-duration="1500ms">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            {{-- Profile Card --}}
            <div class="profile-card wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="400ms">
                {{-- Tabs --}}
                <div class="profile-tabs">
                    <button class="profile-tab active" data-tab="profile">
                        <i class="fas fa-user"></i>
                        <span>Profile Info</span>
                    </button>
                    <button class="profile-tab" data-tab="password">
                        <i class="fas fa-lock"></i>
                        <span>Change Password</span>
                    </button>
                    <button class="profile-tab" data-tab="account">
                        <i class="fas fa-shield-alt"></i>
                        <span>Account</span>
                    </button>
                </div>

                {{-- Profile Content --}}
                <div class="profile-content">
                    {{-- Profile Info Pane --}}
                    <div class="profile-pane active" id="profile-pane">
                        <form action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data" class="profile-form">
                            @csrf
                            @method('PUT')

                            {{-- Avatar Upload --}}
                            <div class="profile-avatar-wrapper">
                                <div class="profile-avatar">
                                    <img src="{{ \Illuminate\Support\Facades\Auth::user()->avatar ? asset('storage/avatars/'.$user->avatar) : asset('assets/images/default-avatar.png') }}"
                                         alt="Profile Avatar"
                                         id="avatar-preview">
                                    <div class="profile-avatar__overlay" onclick="document.getElementById('avatar-input').click()">
                                        <i class="fas fa-camera"></i>
                                    </div>
                                    <input type="file"
                                           id="avatar-input"
                                           name="avatar"
                                           accept="image/*"
                                           style="display: none;"
                                           onchange="previewAvatar(this)">
                                </div>
                                <div class="profile-avatar-info">
                                    <h4>{{ \Illuminate\Support\Facades\Auth::user()->name }}</h4>
                                    <p>{{\Illuminate\Support\Facades\Auth::user()->email }}</p>
                                    <button type="button" class="btn-change-avatar" onclick="document.getElementById('avatar-input').click()">
                                        <i class="fas fa-upload"></i> Change Photo
                                    </button>
                                </div>
                            </div>

                            {{-- Form Fields --}}
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-user"></i> Full Name
                                    </label>
                                    <div class="form-control-wrapper">
                                        <i class="fas fa-user-circle"></i>
                                        <input type="text"
                                               name="name"
                                               class="form-control"
                                               value="{{ old('name', \Illuminate\Support\Facades\Auth::user()->name) }}"
                                               placeholder="Enter your full name"
                                               required>
                                    </div>
                                    @error('name')
                                    <small style="color: #ff4757; margin-top: 5px; display: block;">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-envelope"></i> Email Address
                                    </label>
                                    <div class="form-control-wrapper">
                                        <i class="fas fa-at"></i>
                                        <input type="email"
                                               name="email"
                                               class="form-control"
                                               value="{{ old('email', \Illuminate\Support\Facades\Auth::user()->email) }}"
                                               placeholder="Enter your email"
                                               required>
                                    </div>
                                    @error('email')
                                    <small style="color: #ff4757; margin-top: 5px; display: block;">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-phone"></i> Phone Number
                                    </label>
                                    <div class="form-control-wrapper">
                                        <i class="fas fa-phone-alt"></i>
                                        <input type="tel"
                                               name="phone"
                                               class="form-control"
                                               value="{{ old('phone', \Illuminate\Support\Facades\Auth::user()->phone) }}"
                                               placeholder="Enter your phone number"
                                               required>
                                    </div>
                                    @error('phone')
                                    <small style="color: #ff4757; margin-top: 5px; display: block;">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            {{-- Form Actions --}}
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary" id="save-profile-btn">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Change Password Pane --}}
                    <div class="profile-pane" id="password-pane">
                        <form action="{{route('users.password.update')}}" method="POST" class="profile-form">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-lock"></i> Current Password
                                </label>
                                <div class="form-control-wrapper">
                                    <i class="fas fa-key"></i>
                                    <input type="password"
                                           name="current_password"
                                           class="form-control"
                                           placeholder="Enter current password"
                                           required>
                                </div>
                                @error('current_password')
                                <small style="color: #ff4757; margin-top: 5px; display: block;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-lock"></i> New Password
                                </label>
                                <div class="form-control-wrapper">
                                    <i class="fas fa-key"></i>
                                    <input type="password"
                                           name="password"
                                           id="new-password"
                                           class="form-control"
                                           placeholder="Enter new password"
                                           required
                                           onkeyup="checkPasswordStrength()">
                                </div>
                                <div class="password-strength" id="password-strength">
                                    <div class="strength-bar">
                                        <div class="strength-bar-fill" id="strength-bar-fill"></div>
                                    </div>
                                    <span class="strength-text" id="strength-text">Enter a strong password</span>
                                </div>
                                @error('password')
                                <small style="color: #ff4757; margin-top: 5px; display: block;">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-check-circle"></i> Confirm Password
                                </label>
                                <div class="form-control-wrapper">
                                    <i class="fas fa-check"></i>
                                    <input type="password"
                                           name="password_confirmation"
                                           class="form-control"
                                           placeholder="Confirm new password"
                                           required>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-key"></i> Update Password
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Account Info Pane --}}
                    <div class="profile-pane" id="account-pane">
                        <div class="info-card">
                            <h4 class="info-card__title">
                                <i class="fas fa-info-circle"></i> Account Information
                            </h4>
                            <div class="info-item">
                                <span class="info-item__label">Member Since</span>
                                <span class="info-item__value">{{ \Illuminate\Support\Facades\Auth::user()->created_at->format('F d, Y') }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-item__label">Account Status</span>
                                <span class="info-item__value">
                                    <span class="badge-success">
                                        <i class="fas fa-check-circle"></i> Active
                                    </span>
                                </span>
                            </div>

                            <div class="info-item">
                                <span class="info-item__label">Total Bookings</span>
                                <span class="info-item__value">{{ 0 }}</span>
                            </div>
                        </div>

                        <div class="info-card">
                            <h4 class="info-card__title">
                                <i class="fas fa-shield-alt"></i> Security
                            </h4>
                            <div class="info-item">
                                <span class="info-item__label">Two-Factor Authentication</span>
                                <span class="info-item__value">
                                    <span style="color: #888;">
                                        <i class="fas fa-times-circle"></i> Not Enabled
                                    </span>
                                </span>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const tabs = document.querySelectorAll('.profile-tab');
            const panes = document.querySelectorAll('.profile-pane');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const targetTab = this.dataset.tab;

                    // Update active states
                    tabs.forEach(t => t.classList.remove('active'));
                    panes.forEach(p => p.classList.remove('active'));

                    this.classList.add('active');
                    document.getElementById(targetTab + '-pane').classList.add('active');
                });
            });

            // Show password pane if there are validation errors
            @if($errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation'))
            tabs.forEach(t => t.classList.remove('active'));
            panes.forEach(p => p.classList.remove('active'));
            document.querySelector('[data-tab="password"]').classList.add('active');
            document.getElementById('password-pane').classList.add('active');
            @endif
        });

        // Avatar preview function
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Password strength checker
        function checkPasswordStrength() {
            const password = document.getElementById('new-password').value;
            const strengthBar = document.getElementById('strength-bar-fill');
            const strengthText = document.getElementById('strength-text');

            let strength = 0;

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[$@#&!]+/)) strength++;

            strengthBar.classList.remove('weak', 'medium', 'strong');

            if (password.length === 0) {
                strengthBar.style.width = '0';
                strengthText.textContent = 'Enter a strong password';
            } else if (strength <= 2) {
                strengthBar.classList.add('weak');
                strengthText.textContent = 'Weak password';
            } else if (strength <= 4) {
                strengthBar.classList.add('medium');
                strengthText.textContent = 'Medium password';
            } else {
                strengthBar.classList.add('strong');
                strengthText.textContent = 'Strong password';
            }
        }



        // Form submission loading state
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<span class="spinner"></span> Saving...';
                    submitBtn.disabled = true;

                    // Re-enable after 5 seconds in case of error
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 5000);
                }
            });
        });

        // Flash messages with SweetAlert
        @if(session('success'))
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#63AB45'
            });
        }
        @endif

            @if(session('error'))
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#63AB45'
            });
        }
        @endif
    </script>
@endpush
