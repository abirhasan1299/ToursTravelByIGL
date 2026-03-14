<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation · OTP timer</title>
    <!-- Google Font & icons via Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(145deg, #f0f5fa 0%, #e6eef7 100%);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .card {
            max-width: 480px;
            width: 100%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 2.5rem;
            box-shadow:
                0 25px 45px -15px rgba(0, 30, 70, 0.3),
                0 10px 20px -8px rgba(0, 20, 50, 0.15),
                inset 0 1px 1px rgba(255, 255, 255, 0.7);
            padding: 2.5rem 2rem;
            border: 1px solid rgba(255,255,255,0.6);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: scale(1.01);
        }

        /* header */
        .lock-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #162b4a, #203f6e);
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.8rem;
            box-shadow: 0 12px 22px -10px #1a3152;
        }

        .lock-icon i {
            font-size: 2.2rem;
            color: white;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        h2 {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            background: linear-gradient(145deg, #162b48, #1f3f6b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.3rem;
        }

        .subhead {
            font-size: 0.95rem;
            color: #3d5675;
            font-weight: 500;
            margin-bottom: 2.2rem;
            border-left: 3px solid #2f5aa0;
            padding-left: 1rem;
            background: rgba(47, 90, 160, 0.03);
            border-radius: 0 4px 4px 0;
        }

        /* input groups */
        .input-group {
            margin-bottom: 1.6rem;
            position: relative;
        }

        .input-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: #1f3a6b;
            margin-bottom: 0.5rem;
            letter-spacing: -0.2px;
        }

        .input-group label i {
            font-size: 1rem;
            color: #2f5aa0;
            width: 20px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 1.5px solid #e0eaf4;
            border-radius: 20px;
            font-size: 1rem;
            font-weight: 500;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(4px);
            transition: all 0.2s ease;
            box-shadow: 0 2px 6px rgba(0, 30, 50, 0.02);
            color: #0b1e33;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: #2f5aa0;
            background: white;
            box-shadow: 0 8px 20px -12px #1e3c72, 0 0 0 4px rgba(47,90,160,0.12);
        }

        .input-wrapper input::placeholder {
            color: #98aecb;
            font-weight: 400;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            color: #6f8bb0;
            font-size: 1.1rem;
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-wrapper input:focus + .input-icon {
            color: #1f3f6b;
        }

        /* ===== NEW TIMER STYLES (awesome & prominent) ===== */
        .timer-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-top: 0.5rem;
            margin-bottom: 1.2rem;
            background: linear-gradient(115deg, #eef4fc, #e6f0fd);
            padding: 0.65rem 1rem;
            border-radius: 60px;
            border: 1px solid rgba(47, 90, 160, 0.15);
            box-shadow: inset 0 1px 3px rgba(255,255,255,0.8), 0 6px 14px -8px #203354;
            width: fit-content;
            margin-left: auto;
        }

        .timer-icon {
            background: #203f6e;
            color: white;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.7rem;
            box-shadow: 0 4px 8px -3px #10243f;
        }

        .timer-icon i {
            font-size: 1rem;
        }

        .timer-text {
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
            color: #1a3557;
            background: rgba(255,255,255,0.5);
            padding: 0.2rem 0.7rem;
            border-radius: 40px;
            backdrop-filter: blur(2px);
        }

        .timer-display {
            font-weight: 800;
            font-size: 1.5rem;
            font-variant-numeric: tabular-nums;
            background: linear-gradient(145deg, #162e50, #1e3d6b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-left: 0.4rem;
            min-width: 100px;
            text-align: right;
            text-shadow: 0 2px 5px rgba(47,90,160,0.2);
        }

        .timer-display i {
            font-size: 1rem;
            margin-right: 0.2rem;
            color: #3d6192;
            -webkit-text-fill-color: initial;
        }

        /* when timer ends (optional style, will be updated via js) */
        .timer-expired .timer-display {
            background: linear-gradient(145deg, #a13d3d, #b15555);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* password requirements pills */
        .password-requirements {
            margin: 0.2rem 0 1.2rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: #4b6791;
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .req-item {
            display: inline-flex;
            align-items: center;
            background: #ecf3fc;
            padding: 0.2rem 1rem;
            border-radius: 30px;
            gap: 0.3rem;
            transition: all 0.1s ease;
        }

        /* main CTA button */
        .reset-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(105deg, #162e50, #1f4277);
            border: none;
            border-radius: 40px;
            font-weight: 700;
            font-size: 1.1rem;
            color: white;
            cursor: pointer;
            box-shadow: 0 18px 28px -14px #10233f, 0 4px 12px rgba(0, 20, 50, 0.3);
            transition: all 0.2s ease;
            margin: 1.2rem 0 1rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            letter-spacing: 0.3px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .reset-btn i {
            font-size: 1.2rem;
            transition: transform 0.2s;
        }

        .reset-btn:hover {
            background: linear-gradient(105deg, #1d3860, #254e89);
            box-shadow: 0 22px 32px -12px #0c1f38;
            transform: scale(1.01);
        }

        .reset-btn:hover i {
            transform: translateX(4px);
        }

        .reset-btn:active {
            transform: scale(0.98);
        }

        /* footer now only contains subtle secure badge, no extra links */
        .footer-note {
            text-align: center;
            margin-top: 2rem;
            opacity: 0.6;
            font-size: 0.7rem;
            font-weight: 400;
            color: #3f5a7c;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
        }

        .footer-note i {
            font-size: 0.7rem;
            color: #3460a0;
        }
        .text-danger{
            color: #ff1a1a;
            padding:2px;
            font-family: 'Consolas';
        }

        /* removed any old links, only clean */
    </style>
</head>
<body>
<div class="card">
    <!-- Icon & heading -->
    <div class="lock-icon">
        <i class="fas fa-lock"></i>
    </div>
    <h2>Booking  Confirmation</h2>
    <div class="subhead">
        Enter OTP and Confirm Booking
    </div>

    <!-- Form starts -->
    <form action="{{route('package.otp.verify')}}" method="post" autocomplete="off">
        @csrf
        <!-- OTP field + NEW AWESOME TIMER (4 minutes) -->
        <div class="input-group">
            <label><i class="fas fa-key"></i> One-time password</label>
            <div class="input-wrapper">
                <input type="text" name="otp" id="otp" placeholder="6-digit code" inputmode="numeric" autocomplete="one-time-code">
                <i class="fas fa-shield-halfling input-icon"></i>
            </div>
            @error('otp')
            <small class="text-danger">{{$message}}</small>
            @enderror
            <!-- 4-minute timer – looking awesome! -->
            <div class="timer-container" id="timerContainer">
                <div class="timer-icon">
                    <i class="fas fa-hourglass-half" id="timerIcon"></i>
                </div>
                <span class="timer-text">code valid</span>
                <span class="timer-display" id="timerDisplay">04:00</span>
            </div>
        </div>

        <!-- main action button -->
        <button type="submit" class="reset-btn">
            <span>Confirm Booking</span>
            <i class="fas fa-arrow-right"></i>
        </button>

        <!-- only a small secure footer (no back/resend links) -->
        <div class="footer-note">
            <i class="fas fa-shield-alt"></i> end-to-end encrypted
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<!-- timer script: 4 minutes (240 seconds) countdown with awesome look -->
<script>
    (function() {
        // --- 4-minute timer logic (awesome + visual update) ---
        const timerDisplay = document.getElementById('timerDisplay');
        const timerContainer = document.getElementById('timerContainer');
        const timerIcon = document.getElementById('timerIcon');
        let timeLeft = 240; // 4 minutes = 240 seconds
        let timerRunning = true;

        function formatTime(seconds) {
            const mins = Math.floor(seconds / 60);
            const secs = seconds % 60;
            return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }

        function updateTimerDisplay() {
            timerDisplay.textContent = formatTime(timeLeft);
            // subtle style when less than 30 seconds
            if (timeLeft <= 30) {
                timerContainer.style.background = 'linear-gradient(115deg, #fff1f0, #ffe8e6)';
                timerContainer.style.borderColor = 'rgba(190, 70, 70, 0.3)';
                timerIcon.style.background = '#b14545';
                timerIcon.innerHTML = '<i class="fas fa-exclamation-triangle"></i>';
            } else {
                timerContainer.style.background = 'linear-gradient(115deg, #eef4fc, #e6f0fd)';
                timerContainer.style.borderColor = 'rgba(47, 90, 160, 0.15)';
                timerIcon.style.background = '#203f6e';
                timerIcon.innerHTML = '<i class="fas fa-hourglass-half"></i>';
            }

            if (timeLeft <= 0) {
                timerDisplay.textContent = '00:00';
                timerContainer.classList.add('timer-expired');
                timerIcon.style.background = '#7a4b4b';
                timerIcon.innerHTML = '<i class="fas fa-hourglass-end"></i>';
                timerRunning = false;
            }
        }

        // countdown each second
        const timerInterval = setInterval(() => {
            if (timeLeft > 0) {
                timeLeft -= 1;
                updateTimerDisplay();
            } else {
                clearInterval(timerInterval);
                // optional: also change icon permanently
            }
        }, 1000);

        // initial display
        updateTimerDisplay();

        // ----- OTP input filter (only digits, max 6) -----
        const otpInput = document.getElementById('otp');
        if (otpInput) {
            otpInput.addEventListener('input', function(e) {
                this.value = this.value.replace(/\D/g, '').slice(0, 6);
            });
        }

        // ----- password match hint (enhances UX, but not required for task) -----
        const newPwd = document.getElementById('new_password');
        const confirmPwd = document.getElementById('confirm_password');
        const matchPill = document.getElementById('matchPill');

        function updateMatchHint() {
            if (!newPwd || !confirmPwd || !matchPill) return;
            const newVal = newPwd.value;
            const confirmVal = confirmPwd.value;
            if (newVal && confirmVal && newVal === confirmVal) {
                matchPill.style.color = '#1e7e34';
                matchPill.innerHTML = '<i class="fas fa-circle-check" style="color:#1e7e34;"></i> match';
            } else if (newVal || confirmVal) {
                matchPill.style.color = '#b84a4a';
                matchPill.innerHTML = '<i class="fas fa-circle-exclamation" style="color:#b84a4a;"></i> must match';
            } else {
                matchPill.style.color = '#4b6791';
                matchPill.innerHTML = '<i class="fas fa-circle-check"></i> match';
            }
        }

        if (newPwd && confirmPwd) {
            newPwd.addEventListener('input', updateMatchHint);
            confirmPwd.addEventListener('input', updateMatchHint);
        }

        // Cleanup: not strictly necessary, but for completeness
        window.addEventListener('beforeunload', function() {
            clearInterval(timerInterval);
        });
    })();
</script>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Message',
            text: "{{ session('success') }}"
        });
    </script>
@endif
@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Message',
            text: "{{ session('error') }}"
        });
    </script>
@endif
</body>
</html>
