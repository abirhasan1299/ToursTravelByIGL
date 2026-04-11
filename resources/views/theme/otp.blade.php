@extends('layout.theme')
@section('title', 'Booking Confirmation')


@push('css')
    <style>
        /* OTP Confirmation Page Styles */
        .otp-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background: linear-gradient(145deg, #f0f5fa 0%, #e6eef7 100%);
        }

        .otp-card {
            max-width: 480px;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            border-radius: 2.5rem;
            box-shadow: 0 25px 45px -15px rgba(0, 30, 70, 0.3),
            0 10px 20px -8px rgba(0, 20, 50, 0.15),
            inset 0 1px 1px rgba(255, 255, 255, 0.7);
            padding: 2.5rem 2rem;
            border: 1px solid rgba(255,255,255,0.6);
            transition: transform 0.2s ease;
        }

        .otp-card:hover {
            transform: scale(1.01);
        }

        /* Icon Styles */
        .otp-icon-wrapper {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--gotur-base, #63AB45), #4e8a36);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.8rem;
            box-shadow: 0 12px 22px -10px rgba(99, 171, 69, 0.3);
        }

        .otp-icon-wrapper i {
            font-size: 2.5rem;
            color: white;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .otp-title {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            background: linear-gradient(145deg, var(--gotur-black, #1D231F), var(--gotur-base, #63AB45));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.3rem;
        }

        .otp-subhead {
            font-size: 0.95rem;
            color: var(--gotur-text, #595959);
            font-weight: 500;
            margin-bottom: 2.2rem;
            border-left: 3px solid var(--gotur-base, #63AB45);
            padding-left: 1rem;
            background: rgba(99, 171, 69, 0.03);
            border-radius: 0 4px 4px 0;
        }

        /* Input Groups */
        .otp-input-group {
            margin-bottom: 1.6rem;
            position: relative;
        }

        .otp-input-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--gotur-black, #1D231F);
            margin-bottom: 0.5rem;
            letter-spacing: -0.2px;
        }

        .otp-input-group label i {
            font-size: 1rem;
            color: var(--gotur-base, #63AB45);
            width: 20px;
        }

        .otp-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .otp-input-wrapper input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 1.5px solid var(--gotur-border-color, #E5E5E5);
            border-radius: 20px;
            font-size: 1rem;
            font-weight: 500;
            background: var(--gotur-white, #fff);
            transition: all 0.2s ease;
            color: var(--gotur-black, #1D231F);
        }

        .otp-input-wrapper input:focus {
            outline: none;
            border-color: var(--gotur-base, #63AB45);
            box-shadow: 0 0 0 4px rgba(99, 171, 69, 0.12);
        }

        .otp-input-wrapper input::placeholder {
            color: #98aecb;
            font-weight: 400;
        }

        .otp-input-wrapper input:disabled {
            background: var(--gotur-gray, #F3F8F6);
            cursor: not-allowed;
            opacity: 0.7;
        }

        .otp-input-icon {
            position: absolute;
            left: 1rem;
            color: var(--gotur-base, #63AB45);
            font-size: 1.1rem;
            pointer-events: none;
            transition: color 0.2s;
        }

        .otp-input-wrapper input:focus + .otp-input-icon {
            color: var(--gotur-base, #63AB45);
        }

        /* Timer Styles */
        .timer-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-top: 0.8rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(115deg, #f0f7e8, #e8f3e0);
            padding: 0.65rem 1rem;
            border-radius: 60px;
            border: 1px solid rgba(99, 171, 69, 0.2);
            box-shadow: inset 0 1px 3px rgba(255,255,255,0.8), 0 6px 14px -8px rgba(99, 171, 69, 0.2);
            width: fit-content;
            margin-left: auto;
            transition: all 0.3s ease;
        }

        .timer-icon {
            background: var(--gotur-base, #63AB45);
            color: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.7rem;
            box-shadow: 0 4px 8px -3px rgba(99, 171, 69, 0.3);
            transition: all 0.3s ease;
        }

        .timer-icon i {
            font-size: 1rem;
        }

        .timer-text {
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
            color: var(--gotur-base, #63AB45);
            background: rgba(255,255,255,0.5);
            padding: 0.2rem 0.7rem;
            border-radius: 40px;
        }

        .timer-display {
            font-weight: 800;
            font-size: 1.5rem;
            font-variant-numeric: tabular-nums;
            background: linear-gradient(145deg, var(--gotur-base, #63AB45), #4e8a36);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-left: 0.4rem;
            min-width: 100px;
            text-align: right;
            font-family: monospace;
        }

        .timer-expired .timer-display {
            background: linear-gradient(145deg, #d32f2f, #f44336);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .timer-expired .timer-container {
            background: linear-gradient(115deg, #ffe8e6, #ffd8d4);
            border-color: rgba(220, 53, 69, 0.3);
        }

        /* Button Styles */
        .confirm-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(105deg, var(--gotur-base, #63AB45), #4e8a36);
            border: none;
            border-radius: 40px;
            font-weight: 700;
            font-size: 1.1rem;
            color: white;
            cursor: pointer;
            box-shadow: 0 18px 28px -14px rgba(99, 171, 69, 0.4);
            transition: all 0.2s ease;
            margin: 1.2rem 0 1rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            letter-spacing: 0.3px;
        }

        .confirm-btn:hover:not(:disabled) {
            background: linear-gradient(105deg, #4e8a36, var(--gotur-base, #63AB45));
            transform: translateY(-2px);
            box-shadow: 0 22px 32px -12px rgba(99, 171, 69, 0.5);
        }

        .confirm-btn:active:not(:disabled) {
            transform: scale(0.98);
        }

        .confirm-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .confirm-btn i {
            transition: transform 0.2s;
        }

        .confirm-btn:hover:not(:disabled) i {
            transform: translateX(4px);
        }

        /* Footer Note */
        .otp-footer {
            text-align: center;
            margin-top: 2rem;
            opacity: 0.6;
            font-size: 0.7rem;
            font-weight: 400;
            color: var(--gotur-text, #595959);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
        }

        .otp-footer i {
            font-size: 0.7rem;
            color: var(--gotur-base, #63AB45);
        }

        .text-danger {
            color: #dc3545;
            font-size: 0.75rem;
            margin-top: 0.25rem;
            display: block;
        }

        /* Resend Button */
        .resend-container {
            text-align: right;
            margin-top: 0.5rem;
        }

        .resend-btn {
            background: transparent;
            border: none;
            color: var(--gotur-base, #63AB45);
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            padding: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: underline;
        }

        .resend-btn:hover:not(:disabled) {
            color: #4e8a36;
            transform: translateX(3px);
        }

        .resend-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .otp-card {
                padding: 1.8rem 1.5rem;
            }

            .otp-title {
                font-size: 1.5rem;
            }

            .timer-display {
                font-size: 1.2rem;
                min-width: 80px;
            }

            .timer-container {
                padding: 0.5rem 0.8rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="otp-container">
        <div class="otp-card">
            <!-- Icon & heading -->
            <div class="otp-icon-wrapper">
                <i class="fas fa-lock"></i>
            </div>
            <h2 class="otp-title">Booking Confirmation</h2>
            <div class="otp-subhead">
                Enter OTP to confirm your booking
            </div>

            <!-- OTP Form -->
            <form action="{{ route('package.otp.verify') }}" method="POST" autocomplete="off" id="otpForm">
                @csrf
                <input type="hidden" name="otp_token" id="otpToken" value="{{ $otpToken ?? '' }}">

                <!-- OTP Field -->
                <div class="otp-input-group">
                    <label>
                        <i class="fas fa-key"></i>
                        One-Time Password
                    </label>
                    <div class="otp-input-wrapper">
                        <input type="text"
                               name="otp"
                               id="otp"
                               placeholder="Enter 6-digit code"
                               inputmode="numeric"
                               autocomplete="one-time-code"
                               maxlength="6"
                               required>
                        <i class="fas fa-shield-alt otp-input-icon"></i>
                    </div>
                    @error('otp')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <!-- Timer Display -->
                    <div class="timer-container" id="timerContainer">
                        <div class="timer-icon" id="timerIcon">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <span class="timer-text">Code Valid</span>
                        <span class="timer-display" id="timerDisplay">04:00</span>
                    </div>

                </div>

                <!-- Confirm Button -->
                <button type="submit" class="confirm-btn" id="confirmBtn">
                    <span>Confirm Booking</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <!-- Security Note -->
                <div class="otp-footer">
                    <i class="fas fa-shield-alt"></i>
                    <span>Secure verification • OTP expires in 4 minutes</span>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function() {
            // Timer persistence using localStorage
            const OTP_EXPIRY_KEY = 'otp_expiry_time';
            const OTP_TOKEN_KEY = 'otp_token';

            // Get stored expiry time
            let storedExpiryTime = localStorage.getItem(OTP_EXPIRY_KEY);
            let currentTime = Math.floor(Date.now() / 1000);
            let timeLeft = 240; // Default 4 minutes (240 seconds)

            // Check if there's a valid stored expiry time
            if (storedExpiryTime) {
                const expiryTime = parseInt(storedExpiryTime);
                const remainingTime = expiryTime - currentTime;

                if (remainingTime > 0) {
                    // Timer still active
                    timeLeft = remainingTime;
                } else {
                    // Timer expired
                    timeLeft = 0;
                    localStorage.removeItem(OTP_EXPIRY_KEY);
                    localStorage.removeItem(OTP_TOKEN_KEY);
                }
            } else {
                // Set new expiry time (current time + 4 minutes)
                const newExpiryTime = currentTime + 240;
                localStorage.setItem(OTP_EXPIRY_KEY, newExpiryTime);
                timeLeft = 240;
            }

            // DOM Elements
            const timerDisplay = document.getElementById('timerDisplay');
            const timerContainer = document.getElementById('timerContainer');
            const timerIcon = document.getElementById('timerIcon');
            const otpInput = document.getElementById('otp');
            const confirmBtn = document.getElementById('confirmBtn');
            const resendBtn = document.getElementById('resendBtn');
            const otpForm = document.getElementById('otpForm');

            let timerRunning = true;
            let timerInterval;

            function formatTime(seconds) {
                const mins = Math.floor(seconds / 60);
                const secs = seconds % 60;
                return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
            }

            function updateTimerDisplay() {
                timerDisplay.textContent = formatTime(timeLeft);

                // Styling changes based on remaining time
                if (timeLeft <= 30) {
                    timerContainer.style.background = 'linear-gradient(115deg, #fff1f0, #ffe8e6)';
                    timerContainer.style.borderColor = 'rgba(220, 53, 69, 0.3)';
                    timerIcon.style.background = '#dc3545';
                    timerIcon.innerHTML = '<i class="fas fa-exclamation-triangle"></i>';
                    timerContainer.classList.add('timer-warning');
                } else if (timeLeft <= 60) {
                    timerContainer.style.background = 'linear-gradient(115deg, #fff8e8, #fff0d8)';
                    timerContainer.style.borderColor = 'rgba(255, 193, 7, 0.3)';
                    timerIcon.style.background = '#ffc107';
                    timerIcon.innerHTML = '<i class="fas fa-hourglass-half"></i>';
                } else {
                    timerContainer.style.background = 'linear-gradient(115deg, #f0f7e8, #e8f3e0)';
                    timerContainer.style.borderColor = 'rgba(99, 171, 69, 0.2)';
                    timerIcon.style.background = 'var(--gotur-base, #63AB45)';
                    timerIcon.innerHTML = '<i class="fas fa-hourglass-half"></i>';
                }

                if (timeLeft <= 0) {
                    timerDisplay.textContent = '00:00';
                    timerContainer.classList.add('timer-expired');
                    timerIcon.style.background = '#6c757d';
                    timerIcon.innerHTML = '<i class="fas fa-hourglass-end"></i>';
                    timerRunning = false;

                    // Disable OTP input and confirm button when timer expires
                    if (otpInput) {
                        otpInput.disabled = true;
                        otpInput.placeholder = 'OTP expired';
                    }
                    if (confirmBtn) {
                        confirmBtn.disabled = true;
                    }
                    if (resendBtn) {
                        resendBtn.disabled = false;
                    }

                    // Clear expired timer from storage
                    localStorage.removeItem(OTP_EXPIRY_KEY);
                    localStorage.removeItem(OTP_TOKEN_KEY);

                    // Stop the timer interval
                    if (timerInterval) {
                        clearInterval(timerInterval);
                    }
                } else {
                    // Enable resend button only after timer expires
                    if (resendBtn && timeLeft > 0) {
                        resendBtn.disabled = true;
                    }
                }
            }

            // Start countdown
            function startTimer() {
                if (timerInterval) {
                    clearInterval(timerInterval);
                }

                timerInterval = setInterval(() => {
                    if (timeLeft > 0 && timerRunning) {
                        timeLeft -= 1;
                        // Update stored expiry time
                        const newExpiryTime = Math.floor(Date.now() / 1000) + timeLeft;
                        localStorage.setItem(OTP_EXPIRY_KEY, newExpiryTime);
                        updateTimerDisplay();
                    } else if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        updateTimerDisplay();
                    }
                }, 1000);
            }

            // Initial timer display and start
            updateTimerDisplay();
            if (timeLeft > 0) {
                startTimer();
            } else {
                // Timer already expired
                if (otpInput) otpInput.disabled = true;
                if (confirmBtn) confirmBtn.disabled = true;
                if (resendBtn) resendBtn.disabled = false;
            }

            // OTP Input Filter (only digits, max 6)
            if (otpInput) {
                otpInput.addEventListener('input', function(e) {
                    this.value = this.value.replace(/\D/g, '').slice(0, 6);
                });
            }


            // Form submission with timer validation
            if (otpForm) {
                otpForm.addEventListener('submit', function(e) {
                    if (timeLeft <= 0) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'OTP Expired',
                            text: 'Your OTP has expired. Please request a new one.',
                            confirmButtonColor: '#63AB45'
                        });
                        return false;
                    }

                    const otpValue = otpInput.value;
                    if (!otpValue || otpValue.length !== 6) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'warning',
                            title: 'Invalid OTP',
                            text: 'Please enter a valid 6-digit OTP',
                            confirmButtonColor: '#63AB45'
                        });
                        return false;
                    }
                });
            }

            // Cleanup interval on page unload
            window.addEventListener('beforeunload', function() {
                if (timerInterval) {
                    clearInterval(timerInterval);
                }
            });

            // Optional: Sync timer across tabs
            window.addEventListener('storage', function(e) {
                if (e.key === OTP_EXPIRY_KEY) {
                    const newExpiryTime = parseInt(e.newValue);
                    const currentTime = Math.floor(Date.now() / 1000);
                    const newTimeLeft = newExpiryTime - currentTime;

                    if (newTimeLeft > 0 && newTimeLeft !== timeLeft) {
                        timeLeft = newTimeLeft;
                        updateTimerDisplay();
                        if (timerRunning && timeLeft > 0) {
                            startTimer();
                        }
                    }
                }
            });
        })();
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#63AB45'
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#63AB45'
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please check your OTP and try again.',
                confirmButtonColor: '#63AB45'
            });
        </script>
    @endif
@endpush
