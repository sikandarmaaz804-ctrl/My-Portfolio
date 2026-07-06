<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Reply</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #e0f2ff, #f7f9fc);
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .wrapper {
            max-width: 650px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
            animation: fadeIn 1s ease-in-out;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #0ea5e9, #2563eb, #1e40af);
            color: #fff;
            text-align: center;
            padding: 35px 20px;
            position: relative;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
            animation: slideDown 1s ease;
        }

        .header p {
            margin-top: 8px;
            font-size: 14px;
            opacity: 0.9;
        }

        /* Floating glow effect */
        .header::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 120px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            filter: blur(20px);
        }

        /* Content */
        .content {
            padding: 30px;
            color: #333;
            line-height: 1.7;
        }

        .badge {
            display: inline-block;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .message-box {
            margin-top: 20px;
            padding: 18px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border-left: 5px solid #0ea5e9;
            box-shadow: inset 0 0 10px rgba(14,165,233,0.1);
            animation: fadeInUp 0.8s ease;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            padding: 18px;
            background: #f9fafb;
        }

        /* Button (optional future use) */
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background: linear-gradient(135deg, #2563eb, #0ea5e9);
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
        }

        /* Animations (email-safe basic) */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Mobile Responsive */
        @media only screen and (max-width: 600px) {
            .wrapper {
                margin: 10px;
                border-radius: 12px;
            }

            .content {
                padding: 20px;
            }

            .header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>

<div class="wrapper">

    <!-- HEADER -->
    <div class="header">
        <h1>{{ $title ?? 'We Replied to Your Message' }}</h1>
        <p>Professional Support Response</p>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <span class="badge">Official Reply</span>

        <p>Dear <strong>{{ $name ?? 'User' }}</strong>,</p>

        <p>{{ $body ?? 'We have reviewed your request and responded below:' }}</p>

        @if(isset($messageText))
            <div class="message-box">
                {{ $messageText }}
            </div>
        @endif

        <p style="margin-top: 25px;">
            If you need further help, feel free to reply to this email.
        </p>

        <a href="https://affirm-spinner-anaconda.ngrok-free.dev " class="btn">Visit Our Website</a>

        <p style="margin-top: 25px;">
            Regards,<br>
            <strong>{{ config('app.name') }}</strong>
        </p>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        © {{ date('Y') }} {{ config('app.name') }} — All rights reserved.
    </div>

</div>

</body>
</html>