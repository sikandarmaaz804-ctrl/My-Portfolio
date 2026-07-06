<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('img/company logo.jpeg') }}">
    <link rel="shortcut icon" type="image/jpeg" href="{{ asset('img/company logo.jpeg') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/company logo.jpeg') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Background decorations */
        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
            z-index: 0;
        }
        .bg-orb-1 {
            width: 400px; height: 400px;
            background: rgba(99,102,241,0.18);
            top: -100px; left: -100px;
            animation: float 8s ease-in-out infinite;
        }
        .bg-orb-2 {
            width: 350px; height: 350px;
            background: rgba(16,185,129,0.1);
            bottom: -80px; right: -80px;
            animation: float 10s ease-in-out infinite reverse;
        }
        .bg-orb-3 {
            width: 200px; height: 200px;
            background: rgba(245,158,11,0.07);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            animation: float 12s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-30px); }
        }
        .bg-orb-2 { animation-name: float2; }
        @keyframes float2 {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(20px); }
        }

        /* Grid pattern overlay */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: 0;
        }

        /* Card */
        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1100px;
            margin: auto;
        }

        .login-card {
            display: grid;
            grid-template-columns: 1fr 1.05fr;
            gap: 0;
            background: rgba(15,23,42,0.96);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 35px 90px rgba(0,0,0,0.45);
            animation: cardIn 0.6s cubic-bezier(0.34,1.56,0.64,1);
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(40px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .hero-panel {
            padding: 52px 40px;
            background: linear-gradient(180deg, rgba(15,23,42,0.98), rgba(17,24,39,0.99));
            border-right: 1px solid rgba(255,255,255,0.08);
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 28px;
        }
        .hero-logo-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
        }
        .hero-logo {
            width: 150px;
            height: 150px;
            border-radius: 30px;
            background: rgba(15,23,42,0.92);
            border: 1px solid rgba(99,102,241,0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 24px 60px rgba(0,0,0,0.32);
            padding: 18px;
            filter: drop-shadow(0 18px 38px rgba(0,0,0,0.24));
        }
        .hero-logo img {
            width: 90%;
            height: auto;
            object-fit: contain;
            object-position: center;
        }
        .hero-logo-label {
            color: rgba(226,232,240,0.9);
            font-size: 0.85rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }
        .hero-panel h1 {
            margin: 0;
            color: #f8fafc;
            font-size: clamp(2rem, 2.4vw, 2.8rem);
            line-height: 1.05;
            text-shadow: 0 2px 18px rgba(0,0,0,0.2);
        }
        .hero-panel p {
            margin: 0;
            color: rgba(226,232,240,0.82);
            font-size: 1rem;
            line-height: 1.8;
            max-width: 380px;
        }
        .hero-badges {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }
        .hero-badge {
            padding: 14px 16px;
            border-radius: 16px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            color: #e2e8f0;
            font-size: 0.92rem;
        }

        .form-panel {
            padding: 46px 42px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand {
            margin-bottom: 28px;
        }
        .brand h1 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            color: #e2e8f0;
        }
        .brand p {
            margin: 10px 0 0;
            font-size: 0.95rem;
            color: rgba(226,232,240,0.65);
        }

        /* Form elements */
        .field {
            margin-bottom: 22px;
        }
        .field label {
            display: block;
            font-size: 0.9rem;
            font-weight: 700;
            color: #cbd5e1;
            margin-bottom: 10px;
        }
        .input-wrap {
            position: relative;
        }
        .input-wrap i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(226,232,240,0.35);
            font-size: 1rem;
        }
        .input-wrap input {
            width: 100%;
            padding: 14px 16px 14px 46px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 16px;
            font-size: 0.95rem;
            color: #f8fafc;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }
        .input-wrap input::placeholder {
            color: rgba(226,232,240,0.35);
        }
        .input-wrap input:focus {
            border-color: #6366f1;
            background: rgba(99,102,241,0.1);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.16);
        }

        .toggle-pw {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(226,232,240,0.45);
            font-size: 1rem;
            cursor: pointer;
            border: none;
            background: none;
            padding: 0;
            transition: color 0.2s;
        }
        .toggle-pw:hover {
            color: #ffffff;
        }
        .input-wrap input.has-toggle {
            padding-right: 46px;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            border: none;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 700;
            color: #ffffff;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s, opacity 0.2s;
            box-shadow: 0 18px 32px rgba(99,102,241,0.24);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 35px rgba(99,102,241,0.3);
        }
        .btn-submit:active {
            transform: translateY(0);
        }
        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .error-alert {
            background: rgba(248,113,113,0.12);
            border: 1px solid rgba(248,113,113,0.25);
            border-radius: 14px;
            padding: 14px 18px;
            color: #fecaca;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 22px;
            animation: shake 0.4s ease;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-6px); }
            40%, 80% { transform: translateX(6px); }
        }

        .login-footer {
            text-align: center;
            margin-top: 28px;
            font-size: 0.88rem;
            color: rgba(226,232,240,0.45);
        }

        @media (max-width: 900px) {
            .login-card {
                grid-template-columns: 1fr;
                gap: 24px;
            }
            .hero-panel,
            .form-panel {
                padding: 32px 26px;
            }
            .hero-panel {
                order: 2;
                border-right: none;
                border-top: 1px solid rgba(255,255,255,0.08);
            }
            .form-panel {
                order: 1;
            }
            .hero-panel h1 {
                font-size: 2.2rem;
            }
            .hero-badges {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 700px) {
            .hero-panel {
                padding: 30px 22px;
            }
            .form-panel {
                padding: 30px 22px;
            }
            .hero-badges {
                grid-template-columns: 1fr;
            }
            .hero-panel p {
                max-width: 100%;
            }
            .hero-logo {
                width: 130px;
                height: 130px;
            }
            .hero-logo img {
                width: 85%;
            }
        }

        @media (max-width: 560px) {
            body {
                padding: 12px;
            }
            .login-card {
                border-radius: 24px;
                box-shadow: 0 24px 60px rgba(0,0,0,0.35);
            }
            .hero-panel {
                padding: 26px 18px;
            }
            .form-panel {
                padding: 26px 18px;
            }
            .hero-panel h1 {
                font-size: 1.75rem;
            }
            .hero-logo {
                width: 110px;
                height: 110px;
            }
            .hero-badge {
                padding: 12px 14px;
                font-size: 0.85rem;
            }
            .input-wrap input {
                padding: 12px 14px 12px 42px;
            }
            .btn-submit {
                padding: 13px;
                font-size: 0.95rem;
            }
            .login-footer {
                margin-top: 20px;
                font-size: 0.82rem;
            }
            .hero-panel {
                text-align: center;
            }
            .hero-logo-wrap {
                width: 100%;
                margin: 0 auto;
            }
            .hero-badges {
                gap: 12px;
            }
        }
    </style>
</head>
<body>

<!-- BG Orbs -->
<div class="bg-orb bg-orb-1"></div>
<div class="bg-orb bg-orb-2"></div>
<div class="bg-orb bg-orb-3"></div>

<div class="login-container">
    <div class="login-card">
        <div class="hero-panel">
            <div class="hero-logo-wrap">
                <div class="hero-logo">
                    <img src="{{ asset('img/mlogo.png') }}" alt="CodeEdge Labs Logo">
                </div>
                <div class="hero-logo-label">CodeEdge Labs</div>
            </div>
            <h1>Welcome Back</h1>
            <p>Sign in to your admin dashboard and manage clients, projects, blogs, and support requests with confidence.</p>
            <div class="hero-badges">
                <div class="hero-badge">Secure access</div>
                <div class="hero-badge">Fast admin workflow</div>
                <div class="hero-badge">Modern interface</div>
                <div class="hero-badge">24/7 control</div>
            </div>
        </div>

        <div class="form-panel">
            <div class="brand">
                <h1>Admin Portal</h1>
                <p>Sign in to access your dashboard</p>
            </div>

            @if(session('error'))
                <div class="error-alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" id="loginForm">
                @csrf

                <div class="field">
                    <label for="email">Email Address</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope"></i>
                        <input type="email"
                               id="email"
                               name="email"
                               placeholder="admin@example.com"
                               value="{{ old('email') }}"
                               autocomplete="email"
                               required>
                    </div>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock"></i>
                        <input type="password"
                               id="password"
                               name="password"
                               placeholder="Enter your password"
                               autocomplete="current-password"
                               class="has-toggle"
                               required>
                        <button type="button" class="toggle-pw" onclick="togglePassword()" id="toggleBtn">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Sign In
                </button>
            </form>

            <div class="login-footer">
                © {{ date('Y') }} Maaz Sikandar — Admin Panel
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const pw  = document.getElementById('password');
        const ico = document.getElementById('eyeIcon');
        if (pw.type === 'password') {
            pw.type = 'text';
            ico.className = 'bi bi-eye-slash';
        } else {
            pw.type = 'password';
            ico.className = 'bi bi-eye';
        }
    }

    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('submitBtn');
        btn.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status"></span>
            Signing in...
        `;
        btn.disabled = true;
    });
</script>

<!-- Bootstrap JS (for potential future use) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
