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
            max-width: 550px;
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
            margin-bottom: 2rem;
            border-left: 3px solid var(--gotur-base, #63AB45);
            padding-left: 1rem;
            background: rgba(99, 171, 69, 0.03);
            border-radius: 0 4px 4px 0;
        }

        .method-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            background: #f5f7fa;
            padding: 0.5rem;
            border-radius: 50px;
        }

        .method-tab {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.8rem 1rem;
            background: transparent;
            border: none;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.9rem;
            color: #666;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .method-tab i { font-size: 1rem; }

        .method-tab.active {
            background: var(--gotur-base, #63AB45);
            color: white;
            box-shadow: 0 4px 12px rgba(99, 171, 69, 0.3);
        }

        .method-tab:not(.active):hover {
            background: rgba(99, 171, 69, 0.1);
            color: var(--gotur-base, #63AB45);
        }

        .contact-info-card {
            background: linear-gradient(135deg, #f8faf7 0%, #f0f5ea 100%);
            border-radius: 20px;
            padding: 1.2rem 1.5rem;
            margin-bottom: 1.8rem;
            border: 1px solid rgba(99, 171, 69, 0.15);
        }

        .contact-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.8rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .contact-title {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 700;
            color: var(--gotur-base, #63AB45);
            font-size: 0.8rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .contact-title i { font-size: 1rem; }

        .edit-contact-btn {
            background: transparent;
            border: none;
            color: var(--gotur-base, #63AB45);
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            padding: 0.3rem 0.8rem;
            border-radius: 30px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .edit-contact-btn:hover {
            background: rgba(99, 171, 69, 0.1);
            transform: translateX(2px);
        }

        .contact-value-wrapper {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.5rem 0;
        }

        .contact-value-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gotur-base, #63AB45);
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            flex-shrink: 0;
        }

        .contact-value-content { flex: 1; }

        .contact-value-label {
            font-size: 0.7rem;
            color: #888;
            letter-spacing: 0.5px;
            margin-bottom: 0.2rem;
            text-transform: uppercase;
        }

        .contact-value {
            font-weight: 700;
            color: #1a1a1a;
            font-size: 1rem;
            word-break: break-all;
        }

        .contact-badge {
            display: inline-block;
            background: rgba(99, 171, 69, 0.15);
            padding: 0.2rem 0.6rem;
            border-radius: 30px;
            font-size: 0.65rem;
            font-weight: 600;
            color: var(--gotur-base, #63AB45);
            margin-left: 0.5rem;
        }

        /* ---- Edit Modal ---- */
        .edit-modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .edit-modal-overlay.active { opacity: 1; visibility: visible; }

        .edit-modal {
            background: white;
            border-radius: 28px;
            max-width: 450px;
            width: 90%;
            padding: 1.8rem;
            box-shadow: 0 30px 50px rgba(0, 0, 0, 0.25);
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }

        .edit-modal-overlay.active .edit-modal { transform: scale(1); }

        .edit-modal h4 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #1a1a1a;
        }

        .edit-modal .modal-subtitle {
            font-size: 0.8rem;
            color: #888;
            margin-bottom: 1rem;
        }

        .method-selector {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.2rem;
            padding: 0.3rem;
            background: #f5f7fa;
            border-radius: 50px;
        }

        .method-option {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.6rem;
            background: transparent;
            border: none;
            border-radius: 40px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .method-option.active {
            background: var(--gotur-base, #63AB45);
            color: white;
        }

        .edit-field { margin-bottom: 1.2rem; }

        .edit-field label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gotur-base, #63AB45);
            margin-bottom: 0.4rem;
            text-transform: uppercase;
        }

        .edit-field input {
            width: 100%;
            padding: 0.9rem 1rem;
            border: 1.5px solid #e5e5e5;
            border-radius: 14px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .edit-field input:focus {
            outline: none;
            border-color: var(--gotur-base, #63AB45);
            box-shadow: 0 0 0 3px rgba(99, 171, 69, 0.1);
        }

        .method-hint {
            font-size: 0.7rem;
            color: #999;
            margin-top: 0.5rem;
            padding: 0.5rem;
            background: #f8f9fa;
            border-radius: 10px;
            text-align: center;
        }

        .modal-actions {
            display: flex;
            gap: 0.8rem;
            margin-top: 1.5rem;
        }

        .modal-actions button {
            flex: 1;
            padding: 0.8rem;
            border-radius: 40px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .modal-cancel { background: #f0f0f0; color: #666; }
        .modal-cancel:hover { background: #e0e0e0; }
        .modal-save { background: var(--gotur-base, #63AB45); color: white; }
        .modal-save:hover { background: #4e8a36; transform: translateY(-1px); }

        /* ---- OTP Input Group ---- */
        .otp-input-group { margin-bottom: 1.6rem; }

        .otp-input-group > label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--gotur-black, #1D231F);
            margin-bottom: 0.5rem;
        }

        .otp-input-group > label i {
            font-size: 1rem;
            color: var(--gotur-base, #63AB45);
            width: 20px;
        }

        .otp-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* FIX: icon is absolute; input gets left padding to clear it */
        .otp-input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gotur-base, #63AB45);
            font-size: 1.1rem;
            pointer-events: none;
            z-index: 1;
        }

        .otp-input-wrapper input {
            flex: 1;
            min-width: 0;
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

        .inline-resend-btn {
            padding: 1rem 1.5rem;
            background: var(--gotur-base, #63AB45);
            border: none;
            border-radius: 20px;
            color: white;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .inline-resend-btn:hover:not(:disabled) {
            background: #4e8a36;
            transform: translateX(2px);
        }

        .inline-resend-btn:disabled { opacity: 0.5; cursor: not-allowed; }

        /* ---- Timer ---- */
        .timer-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 0.8rem;
            background: linear-gradient(115deg, #f0f7e8, #e8f3e0);
            padding: 0.65rem 1rem;
            border-radius: 60px;
            border: 1px solid rgba(99, 171, 69, 0.2);
            width: 100%;
            transition: background 0.4s ease, border-color 0.4s ease;
        }

        .timer-left {
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
            flex-shrink: 0;
            transition: background 0.3s ease;
        }

        .timer-text {
            font-weight: 600;
            font-size: 0.8rem;
            color: var(--gotur-base, #63AB45);
            transition: color 0.3s ease;
        }

        .timer-display {
            font-weight: 800;
            font-size: 1.3rem;
            font-variant-numeric: tabular-nums;
            color: var(--gotur-base, #63AB45);
            font-family: monospace;
            transition: color 0.3s ease;
        }

        /* FIX: expired state on the container itself */
        .timer-container.timer-expired {
            background: linear-gradient(115deg, #ffe8e6, #ffd8d4);
            border-color: rgba(220, 53, 69, 0.2);
        }

        .timer-container.timer-expired .timer-display,
        .timer-container.timer-expired .timer-text { color: #dc3545; }
        .timer-container.timer-expired .timer-icon  { background: #dc3545; }

        .resend-message {
            font-size: 0.7rem;
            color: #888;
            margin-top: 0.5rem;
            text-align: center;
            display: block;
            min-height: 1.2em;
        }

        /* ---- Confirm Button ---- */
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
        }

        .confirm-btn:hover:not(:disabled) {
            background: linear-gradient(105deg, #4e8a36, var(--gotur-base, #63AB45));
            transform: translateY(-2px);
            box-shadow: 0 22px 32px -12px rgba(99, 171, 69, 0.5);
        }

        .confirm-btn:disabled { opacity: 0.6; cursor: not-allowed; }

        .otp-footer {
            text-align: center;
            margin-top: 1.5rem;
            opacity: 0.6;
            font-size: 0.7rem;
            color: var(--gotur-text, #595959);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
        }

        .text-danger {
            color: #dc3545;
            font-size: 0.75rem;
            margin-top: 0.25rem;
            display: block;
        }

        @media (max-width: 576px) {
            .otp-card        { padding: 1.8rem 1.5rem; }
            .otp-title       { font-size: 1.5rem; }
            .timer-display   { font-size: 1.1rem; }
            .otp-input-wrapper  { flex-direction: column; align-items: stretch; }
            .inline-resend-btn  { width: 100%; justify-content: center; }
        }
    </style>
@endpush

@section('content')
    @php
        $currentMethod = session('customer.otp_method', 'email');
        $currentEmail  = $contactEmail ?? session('customer.email', '');
        $currentPhone  = $contactPhone ?? session('customer.phone', '');
        $contactValue  = $currentMethod === 'email' ? $currentEmail : $currentPhone;
    @endphp

    <div class="otp-container">
        <div class="otp-card">
            <h2 class="otp-title">Booking Confirmation</h2>
            <div class="otp-subhead">Enter OTP to confirm your booking</div>

            <!-- Method Selection Tabs -->
            <div class="method-tabs">
                <button type="button" class="method-tab {{ $currentMethod === 'email' ? 'active' : '' }}" data-method="email">
                    <i class="fas fa-envelope"></i> Email
                </button>
                <button type="button" class="method-tab {{ $currentMethod === 'phone' ? 'active' : '' }}" data-method="phone">
                    <i class="fas fa-phone-alt"></i> Phone (SMS)
                </button>
            </div>

            <!-- Contact Information Card -->
            <div class="contact-info-card">
                <div class="contact-header">
                    <div class="contact-title">
                        <i class="fas fa-paper-plane"></i>
                        <span>OTP WILL BE SENT VIA</span>
                    </div>
                    <button type="button" class="edit-contact-btn" id="editContactBtn">
                        <i class="fas fa-edit"></i> Edit Contact
                    </button>
                </div>
                <div class="contact-value-wrapper">
                    <div class="contact-value-icon" id="contactIcon">
                        <i class="{{ $currentMethod === 'email' ? 'fas fa-envelope' : 'fas fa-phone-alt' }}"></i>
                    </div>
                    <div class="contact-value-content">
                        <div class="contact-value-label" id="contactLabel">
                            {{ $currentMethod === 'email' ? 'EMAIL ADDRESS' : 'PHONE NUMBER' }}
                        </div>
                        <div class="contact-value" id="displayContactValue">
                            {{ $contactValue ?: 'Not set' }}
                            <span class="contact-badge" id="methodBadge">
                                <i class="fas {{ $currentMethod === 'email' ? 'fa-envelope' : 'fa-mobile-alt' }}"></i>
                                {{ ucfirst($currentMethod) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Contact Modal -->
            <div class="edit-modal-overlay" id="editModal">
                <div class="edit-modal">
                    <h4>Update Contact Information</h4>
                    <div class="modal-subtitle">Choose how you want to receive the OTP</div>

                    <div class="method-selector">
                        <button type="button" class="method-option" data-modal-method="email">
                            <i class="fas fa-envelope"></i> Email
                        </button>
                        <button type="button" class="method-option" data-modal-method="phone">
                            <i class="fas fa-phone-alt"></i> Phone (SMS)
                        </button>
                    </div>

                    {{-- Not a <form> — submitted via JS fetch to avoid accidental page POST --}}
                    <div id="updateContactForm">
                        <div class="edit-field">
                            <label id="modalFieldLabel">EMAIL ADDRESS</label>
                            <input type="text"
                                   id="editContactValue"
                                   name="contact_value"
                                   placeholder="Enter your contact information"
                                   autocomplete="off">
                        </div>
                        <div class="method-hint" id="modalHint">
                            <i class="fas fa-info-circle"></i>
                            OTP will be sent to this email address
                        </div>
                        <div class="modal-actions">
                            <button type="button" class="modal-cancel" id="cancelEditBtn">Cancel</button>
                            <button type="button" class="modal-save"   id="saveContactBtn">Save &amp; Send OTP</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- OTP Form -->
            <form action="{{ route('bus.otp.cod.verify') }}" method="POST" autocomplete="off" id="otpForm">
                @csrf
                <input type="hidden" name="otp_token"     id="otpToken"           value="{{ $otpToken ?? '' }}">
                <input type="hidden" name="otp_method"    id="otpMethod"          value="{{ $currentMethod }}">
                <input type="hidden" name="contact_value" id="contactValueHidden" value="{{ $contactValue }}">
                <input type="hidden" name="email"         id="emailHidden"        value="{{ $currentEmail }}">
                <input type="hidden" name="phone"         id="phoneHidden"        value="{{ $currentPhone }}">

                <!-- OTP Field -->
                <div class="otp-input-group">
                    <label>
                        <i class="fas fa-key"></i>
                        One-Time Password
                    </label>
                    <div class="otp-input-wrapper">
                        <i class="fas fa-shield-alt otp-input-icon"></i>
                        <input type="text"
                               name="otp"
                               id="otp"
                               placeholder="Enter 6-digit code"
                               inputmode="numeric"
                               autocomplete="one-time-code"
                               maxlength="6"
                               required>
                        <button type="button" class="inline-resend-btn" id="resendOtpBtn">
                            <i class="fas fa-redo-alt"></i> Resend
                        </button>
                    </div>
                    <span class="resend-message" id="resendMessage"></span>
                    @error('otp')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <!-- Timer -->
                    <div class="timer-container" id="timerContainer">
                        <div class="timer-left">
                            <div class="timer-icon" id="timerIcon">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                            <span class="timer-text" id="timerText">Code expires in</span>
                        </div>
                        <span class="timer-display" id="timerDisplay">05:00</span>
                    </div>
                </div>

                <!-- Confirm Button -->
                <button type="submit" class="confirm-btn" id="confirmBtn">
                    <span>Confirm Booking</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <div class="otp-footer">
                    <i class="fas fa-shield-alt"></i>
                    <span>Secure verification &bull; OTP expires in 5 minutes</span>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function () {
            'use strict';

            /* ============================================================
             * STATE
             * ============================================================ */
            let currentMethod = '{{ $currentMethod }}';
            let currentEmail  = @json($currentEmail ?? '');
            let currentPhone  = @json($currentPhone ?? '');

            // Per-token sessionStorage keys so multiple tabs don't share timers
            const OTP_TOKEN_VALUE     = document.getElementById('otpToken').value;
            const OTP_EXPIRY_KEY      = 'otp_expiry_'   + OTP_TOKEN_VALUE;
            const RESEND_COOLDOWN_KEY = 'otp_cooldown_' + OTP_TOKEN_VALUE;

            // FIX: 5-minute expiry
            const OTP_DURATION = 300;

            let timeLeft       = OTP_DURATION;
            let timerRunning   = true;
            let timerInterval  = null;
            let resendCooldown = 0;

            /* ============================================================
             * DOM REFS
             * ============================================================ */
            const timerDisplay        = document.getElementById('timerDisplay');
            const timerContainer      = document.getElementById('timerContainer');
            const timerIcon           = document.getElementById('timerIcon');
            const timerText           = document.getElementById('timerText');
            const otpInput            = document.getElementById('otp');
            const confirmBtn          = document.getElementById('confirmBtn');
            const otpForm             = document.getElementById('otpForm');
            const resendBtn           = document.getElementById('resendOtpBtn');
            const resendMessage       = document.getElementById('resendMessage');
            const editModal           = document.getElementById('editModal');
            const editContactBtn      = document.getElementById('editContactBtn');
            const cancelEditBtn       = document.getElementById('cancelEditBtn');
            const saveContactBtn      = document.getElementById('saveContactBtn');
            const editContactValue    = document.getElementById('editContactValue');
            const displayContactValue = document.getElementById('displayContactValue');
            const contactValueHidden  = document.getElementById('contactValueHidden');
            const contactIcon         = document.getElementById('contactIcon');
            const contactLabel        = document.getElementById('contactLabel');
            const emailHidden         = document.getElementById('emailHidden');
            const phoneHidden         = document.getElementById('phoneHidden');
            const otpMethodHidden     = document.getElementById('otpMethod');
            const modalFieldLabel     = document.getElementById('modalFieldLabel');
            const modalHint           = document.getElementById('modalHint');
            const methodOptions       = document.querySelectorAll('.method-option[data-modal-method]');
            const mainMethodTabs      = document.querySelectorAll('.method-tab[data-method]');

            /* ============================================================
             * HELPERS
             * ============================================================ */
            function escapeHtml(str) {
                if (!str) return '';
                return String(str).replace(/[&<>"']/g, function (m) {
                    return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[m];
                });
            }

            function formatTime(s) {
                return String(Math.floor(s / 60)).padStart(2, '0') + ':' + String(s % 60).padStart(2, '0');
            }

            function csrfToken() {
                return document.querySelector('meta[name="csrf-token"]')?.content
                    || '{{ csrf_token() }}';
            }

            /* ============================================================
             * CONTACT DISPLAY
             * FIX: always sync all 5 hidden fields in one place
             * ============================================================ */
            function updateContactDisplay() {
                const val       = currentMethod === 'email' ? currentEmail : currentPhone;
                const iconCls   = currentMethod === 'email' ? 'fa-envelope'   : 'fa-phone-alt';
                const badgeCls  = currentMethod === 'email' ? 'fa-envelope'   : 'fa-mobile-alt';
                const labelTxt  = currentMethod === 'email' ? 'EMAIL ADDRESS' : 'PHONE NUMBER';
                const badgeTxt  = currentMethod === 'email' ? 'Email'         : 'Phone';

                displayContactValue.innerHTML =
                    escapeHtml(val || 'Not set') +
                    ' <span class="contact-badge"><i class="fas ' + badgeCls + '"></i> ' + badgeTxt + '</span>';

                contactIcon.innerHTML    = '<i class="fas ' + iconCls + '"></i>';
                contactLabel.textContent = labelTxt;

                // Sync hidden fields
                contactValueHidden.value = val  || '';
                emailHidden.value        = currentEmail;
                phoneHidden.value        = currentPhone;
                otpMethodHidden.value    = currentMethod;
            }

            function updateMainTabs() {
                mainMethodTabs.forEach(function (t) {
                    t.classList.toggle('active', t.getAttribute('data-method') === currentMethod);
                });
            }

            /* ============================================================
             * MODAL UI
             * ============================================================ */
            function getActiveModalMethod() {
                const active = document.querySelector('.method-option.active');
                return active ? active.getAttribute('data-modal-method') : currentMethod;
            }

            function updateModalUI() {
                const m = getActiveModalMethod();
                if (m === 'email') {
                    modalFieldLabel.textContent  = 'EMAIL ADDRESS';
                    editContactValue.placeholder = 'Enter your email address';
                    editContactValue.type        = 'email';
                    modalHint.innerHTML          = '<i class="fas fa-info-circle"></i> OTP will be sent to this email address';
                    editContactValue.value       = currentEmail;
                } else {
                    modalFieldLabel.textContent  = 'PHONE NUMBER';
                    editContactValue.placeholder = 'Enter your phone number (e.g. +8801XXXXXXXXX)';
                    editContactValue.type        = 'tel';
                    modalHint.innerHTML          = '<i class="fas fa-info-circle"></i> OTP will be sent via SMS to this phone number';
                    editContactValue.value       = currentPhone;
                }
            }

            /* ============================================================
             * TIMER
             * ============================================================ */
            function disableForm() {
                if (otpInput)   otpInput.disabled   = true;
                if (confirmBtn) confirmBtn.disabled = true;
            }

            function enableForm() {
                if (otpInput)   otpInput.disabled   = false;
                if (confirmBtn) confirmBtn.disabled = false;
            }

            // FIX: reset expired styling directly on timerContainer
            function clearExpiredStyles() {
                timerContainer.classList.remove('timer-expired');
                timerIcon.style.background = 'var(--gotur-base, #63AB45)';
                timerIcon.innerHTML        = '<i class="fas fa-hourglass-half"></i>';
            }

            function applyTimerColor() {
                if (timeLeft <= 0) {
                    timerContainer.classList.add('timer-expired');
                    timerIcon.innerHTML = '<i class="fas fa-hourglass-end"></i>';
                } else if (timeLeft <= 30) {
                    timerIcon.style.background = '#dc3545';
                    timerIcon.innerHTML        = '<i class="fas fa-exclamation-triangle"></i>';
                } else if (timeLeft <= 60) {
                    timerIcon.style.background = '#ffc107';
                    timerIcon.innerHTML        = '<i class="fas fa-hourglass-half"></i>';
                } else {
                    timerIcon.style.background = 'var(--gotur-base, #63AB45)';
                    timerIcon.innerHTML        = '<i class="fas fa-hourglass-half"></i>';
                }
            }

            function updateTimerDisplay() {
                timerDisplay.textContent = formatTime(timeLeft);
                applyTimerColor();

                if (timeLeft <= 0) {
                    timerRunning = false;
                    disableForm();
                    sessionStorage.removeItem(OTP_EXPIRY_KEY);
                    if (timerInterval) { clearInterval(timerInterval); timerInterval = null; }
                } else {
                    enableForm();
                }
            }

            function startTimer() {
                if (timerInterval) { clearInterval(timerInterval); timerInterval = null; }
                if (timeLeft <= 0) { updateTimerDisplay(); return; }

                updateTimerDisplay();

                timerInterval = setInterval(function () {
                    if (!timerRunning || timeLeft <= 0) return;
                    timeLeft--;
                    sessionStorage.setItem(OTP_EXPIRY_KEY, Math.floor(Date.now() / 1000) + timeLeft);
                    updateTimerDisplay();
                }, 1000);
            }

            function initTimer() {
                const stored = sessionStorage.getItem(OTP_EXPIRY_KEY);
                let valid    = false;

                if (stored) {
                    const remaining = parseInt(stored) - Math.floor(Date.now() / 1000);
                    if (remaining > 0 && remaining <= OTP_DURATION) {
                        timeLeft = remaining;
                        valid    = true;
                    } else {
                        sessionStorage.removeItem(OTP_EXPIRY_KEY);
                    }
                }

                if (!valid) {
                    timeLeft = OTP_DURATION;
                    sessionStorage.setItem(OTP_EXPIRY_KEY, Math.floor(Date.now() / 1000) + OTP_DURATION);
                }

                timerRunning = timeLeft > 0;
                if (timeLeft > 0) startTimer();
                else { disableForm(); updateTimerDisplay(); }
            }

            /* Full timer reset — called after every successful OTP dispatch */
            function resetOtpTimer() {
                timeLeft = OTP_DURATION;
                sessionStorage.setItem(OTP_EXPIRY_KEY, Math.floor(Date.now() / 1000) + OTP_DURATION);
                timerRunning = true;
                clearExpiredStyles();
                startTimer();
                otpInput.value      = '';
                otpInput.disabled   = false;
                confirmBtn.disabled = false;
            }

            /* ============================================================
             * RESEND COOLDOWN
             * ============================================================ */
            function updateResendBtnState() {
                if (resendCooldown > 0) {
                    resendBtn.disabled        = true;
                    resendMessage.textContent = 'Resend available in ' + resendCooldown + 's';
                } else {
                    resendBtn.disabled        = false;
                    resendMessage.textContent = '';
                }
            }

            function runCooldownInterval() {
                const iv = setInterval(function () {
                    resendCooldown--;
                    if (resendCooldown <= 0) {
                        resendCooldown = 0;
                        sessionStorage.removeItem(RESEND_COOLDOWN_KEY);
                        clearInterval(iv);
                    } else {
                        sessionStorage.setItem(RESEND_COOLDOWN_KEY, resendCooldown);
                    }
                    updateResendBtnState();
                }, 1000);
            }

            function startResendCooldown() {
                resendCooldown = 30;
                sessionStorage.setItem(RESEND_COOLDOWN_KEY, resendCooldown);
                updateResendBtnState();
                runCooldownInterval();
            }

            function initResendCooldown() {
                const stored = sessionStorage.getItem(RESEND_COOLDOWN_KEY);
                if (stored) {
                    resendCooldown = parseInt(stored);
                    if (resendCooldown > 0) {
                        updateResendBtnState();
                        runCooldownInterval();
                    }
                }
            }

            /* ============================================================
             * RESEND OTP
             * FIX: accept explicit method/email/phone so switchMethod can
             *      pass the NEW values before the closure captures them
             * ============================================================ */
            async function resendOTP(overrideMethod, overrideEmail, overridePhone) {
                const sendMethod  = overrideMethod !== undefined ? overrideMethod : currentMethod;
                const sendEmail   = overrideEmail  !== undefined ? overrideEmail  : currentEmail;
                const sendPhone   = overridePhone  !== undefined ? overridePhone  : currentPhone;
                const sendContact = sendMethod === 'email' ? sendEmail : sendPhone;

                if (resendCooldown > 0) {
                    Swal.fire({ icon: 'warning', title: 'Please wait',
                        text: 'Please wait ' + resendCooldown + ' seconds before requesting again',
                        confirmButtonColor: '#63AB45' });
                    return;
                }

                if (!sendContact) {
                    Swal.fire({ icon: 'error', title: 'Contact Info Missing',
                        text: 'Please update your ' + (sendMethod === 'email' ? 'email' : 'phone number') + ' first.',
                        confirmButtonColor: '#63AB45' });
                    return;
                }

                resendBtn.disabled  = true;
                resendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';

                try {
                    const res  = await fetch('{{ route("bus.otp.resend") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken(),
                            'Accept':       'application/json'
                        },
                        body: JSON.stringify({
                            contact_value: sendContact,
                            otp_method:    sendMethod,
                            otp_token:     OTP_TOKEN_VALUE,
                            email:         sendEmail,
                            phone:         sendPhone
                        })
                    });

                    const data = await res.json();

                    if (data.success) {
                        resetOtpTimer();
                        startResendCooldown();
                        Swal.fire({ icon: 'success', title: 'OTP Sent',
                            text: data.message || ('A new OTP has been sent to your ' +
                                (sendMethod === 'email' ? 'email' : 'phone')),
                            confirmButtonColor: '#63AB45', timer: 3000, showConfirmButton: false });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Failed',
                            text: data.message || 'Failed to send OTP. Please try again.',
                            confirmButtonColor: '#63AB45' });
                    }
                } catch (err) {
                    console.error('Resend error:', err);
                    Swal.fire({ icon: 'error', title: 'Network Error',
                        text: 'Please check your connection and try again.',
                        confirmButtonColor: '#63AB45' });
                } finally {
                    resendBtn.disabled  = false;
                    resendBtn.innerHTML = '<i class="fas fa-redo-alt"></i> Resend';
                }
            }

            /* ============================================================
             * EDIT CONTACT MODAL
             * ============================================================ */
            function openEditModal() {
                methodOptions.forEach(function (o) {
                    o.classList.toggle('active', o.getAttribute('data-modal-method') === currentMethod);
                });
                updateModalUI();
                editModal.classList.add('active');
                document.body.style.overflow = 'hidden';
                setTimeout(function () { editContactValue.focus(); }, 300);
            }

            function closeEditModal() {
                editModal.classList.remove('active');
                document.body.style.overflow = '';
            }

            async function saveContactInfo() {
                const selMethod  = getActiveModalMethod();
                const newContact = editContactValue.value.trim();

                if (!newContact) {
                    Swal.fire({ icon: 'error', title: 'Validation Error',
                        text: 'Please enter a valid ' + (selMethod === 'email' ? 'email address' : 'phone number'),
                        confirmButtonColor: '#63AB45' });
                    return;
                }

                if (selMethod === 'email') {
                    if (!/^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/.test(newContact)) {
                        Swal.fire({ icon: 'error', title: 'Invalid Email',
                            text: 'Please enter a valid email address.', confirmButtonColor: '#63AB45' });
                        return;
                    }
                } else {
                    // FIX: allow + prefix and spaces/hyphens commonly used in phone numbers
                    if (!/^\+?[\d\s\-()\[\]]{7,20}$/.test(newContact)) {
                        Swal.fire({ icon: 'error', title: 'Invalid Phone',
                            text: 'Please enter a valid phone number (7-20 digits, may start with +).',
                            confirmButtonColor: '#63AB45' });
                        return;
                    }
                }

                saveContactBtn.disabled  = true;
                saveContactBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';

                try {
                    const res  = await fetch('{{ route("bus.contact.update") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken(),
                            'Accept':       'application/json'
                        },
                        body: JSON.stringify({
                            contact_value: newContact,
                            otp_method:    selMethod,
                            otp_token:     OTP_TOKEN_VALUE
                        })
                    });

                    const data = await res.json();

                    if (data.success) {
                        // FIX: update state BEFORE any UI/send call
                        currentMethod = selMethod;
                        if (currentMethod === 'email') {
                            currentEmail = newContact;
                        } else {
                            currentPhone = newContact;
                        }

                        updateContactDisplay();
                        updateMainTabs();
                        closeEditModal();
                        resetOtpTimer();
                        startResendCooldown();

                        Swal.fire({ icon: 'success', title: 'Contact Updated',
                            text: 'Your ' + (currentMethod === 'email' ? 'email' : 'phone number') +
                                ' has been updated. A new OTP has been sent.',
                            confirmButtonColor: '#63AB45' });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Update Failed',
                            text: data.message || 'Failed to update contact info.', confirmButtonColor: '#63AB45' });
                    }
                } catch (err) {
                    console.error('Update contact error:', err);
                    Swal.fire({ icon: 'error', title: 'Network Error',
                        text: 'Please check your connection and try again.', confirmButtonColor: '#63AB45' });
                } finally {
                    saveContactBtn.disabled  = false;
                    saveContactBtn.innerHTML = 'Save &amp; Send OTP';
                }
            }

            /* ============================================================
             * METHOD SWITCHING (main tabs)
             * FIX: if the target contact is empty → open modal pre-set to
             *      that method. Otherwise update state first, then resend.
             * ============================================================ */
            function switchMethod(newMethod) {
                if (newMethod === currentMethod) return;

                const targetContact = newMethod === 'email' ? currentEmail : currentPhone;

                if (!targetContact) {
                    // Pre-select the desired method in the modal and open it
                    methodOptions.forEach(function (o) {
                        o.classList.toggle('active', o.getAttribute('data-modal-method') === newMethod);
                    });
                    updateModalUI();
                    editModal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                    setTimeout(function () { editContactValue.focus(); }, 300);
                    return;
                }

                // FIX: update state first so hidden fields are correct even
                //      if the fetch below fails
                currentMethod = newMethod;
                updateContactDisplay();
                updateMainTabs();
                resetOtpTimer();

                // Pass values explicitly to avoid stale-closure issues
                resendOTP(newMethod, currentEmail, currentPhone);
            }

            /* ============================================================
             * EVENT LISTENERS
             * ============================================================ */
            editContactBtn.addEventListener('click', openEditModal);
            cancelEditBtn.addEventListener('click',  closeEditModal);
            saveContactBtn.addEventListener('click', saveContactInfo);
            resendBtn.addEventListener('click', function () { resendOTP(); });

            methodOptions.forEach(function (o) {
                o.addEventListener('click', function () {
                    methodOptions.forEach(function (x) { x.classList.remove('active'); });
                    this.classList.add('active');
                    updateModalUI();
                });
            });

            mainMethodTabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    switchMethod(this.getAttribute('data-method'));
                });
            });

            editModal.addEventListener('click', function (e) {
                if (e.target === editModal) closeEditModal();
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && editModal.classList.contains('active')) closeEditModal();
            });

            otpInput.addEventListener('input', function () {
                if (!this.disabled) this.value = this.value.replace(/\D/g, '').slice(0, 6);
            });

            otpForm.addEventListener('submit', function (e) {
                if (timeLeft <= 0) {
                    e.preventDefault();
                    Swal.fire({ icon: 'error', title: 'OTP Expired',
                        text: 'Your OTP has expired. Please click "Resend" to get a new code.',
                        confirmButtonColor: '#63AB45' });
                    return;
                }
                if (!otpInput.value || otpInput.value.length !== 6) {
                    e.preventDefault();
                    Swal.fire({ icon: 'warning', title: 'Invalid OTP',
                        text: 'Please enter a valid 6-digit OTP.', confirmButtonColor: '#63AB45' });
                    return;
                }
                confirmBtn.disabled  = true;
                confirmBtn.innerHTML = '<span>Processing...</span><i class="fas fa-spinner fa-spin"></i>';
            });

            /* ============================================================
             * INIT
             * ============================================================ */
            initTimer();
            initResendCooldown();

            window.addEventListener('beforeunload', function () {
                if (timerInterval) clearInterval(timerInterval);
            });

        })();
    </script>

    @if(session('success'))
        <script>
            Swal.fire({ icon: 'success', title: 'Success!',
                text: @json(session('success')), confirmButtonColor: '#63AB45' });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({ icon: 'error', title: 'Error!',
                text: @json(session('error')), confirmButtonColor: '#63AB45' });
        </script>
    @endif

    @if($errors->any())
        <script>
            Swal.fire({ icon: 'error', title: 'Verification Failed',
                text: @json($errors->first()), confirmButtonColor: '#63AB45' });
        </script>
    @endif
@endpush
