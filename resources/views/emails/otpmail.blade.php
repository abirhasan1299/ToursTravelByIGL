<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family: Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8; padding:20px 0;">
    <tr>
        <td align="center">

            <!-- Main Container -->
            <table width="500" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 5px 15px rgba(0,0,0,0.08);">

                <!-- Header -->
                <tr>
                    <td style="background:#4f46e5; padding:20px; text-align:center; color:#ffffff;">
                        <h2 style="margin:0;">{{ config('app.name') }}</h2>
                        <p style="margin:5px 0 0; font-size:14px;">Secure Verification</p>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td style="padding:30px; text-align:center;">

                        <h2 style="margin-bottom:10px; color:#333;">Your OTP Code</h2>

                        <p style="color:#666; font-size:15px;">
                            Use the following One-Time Password (OTP) to complete your verification.
                        </p>

                        <!-- OTP Box -->
                        <div style="margin:25px 0;">
                            <span style="
                                display:inline-block;
                                background:#f1f5f9;
                                color:#111;
                                font-size:28px;
                                letter-spacing:8px;
                                padding:15px 25px;
                                border-radius:8px;
                                font-weight:bold;
                            ">
                                {{ $otp }}
                            </span>
                        </div>

                        <p style="color:#999; font-size:14px;">
                            This OTP is valid for <strong>5 minutes</strong>.
                        </p>

                        <p style="color:#999; font-size:13px;">
                            If you did not request this, please ignore this email.
                        </p>

                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td style="background:#f9fafb; padding:15px; text-align:center; font-size:12px; color:#aaa;">
                        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>

</body>
</html>
