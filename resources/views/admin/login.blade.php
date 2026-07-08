<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — Maaz Sikandar</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/mlogo.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
        }

        /* ── FULL-HEIGHT SPLIT LAYOUT ─────────────────────── */
        .login-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* ══ LEFT — FORM PANEL ═══════════════════════════════ */
        .form-panel {
            background: #0f172a;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 52px;
            position: relative;
            overflow: hidden;
        }

        /* subtle grid overlay */
        .form-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 44px 44px;
            pointer-events: none;
        }

        /* glow orbs */
        .form-panel::after {
            content: '';
            position: absolute;
            width: 480px; height: 480px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(99,102,241,0.14) 0%, transparent 70%);
            top: -140px; left: -140px;
            pointer-events: none;
        }

        .form-inner {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
        }

        /* brand mark */
        .form-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 44px;
        }
        .form-brand .brand-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
            background: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.25);
        }
        .form-brand span {
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(226,232,240,0.55);
        }

        /* heading */
        .form-heading h1 {
            font-size: 2.1rem;
            font-weight: 800;
            color: #f8fafc;
            line-height: 1.1;
            margin-bottom: 10px;
        }
        .form-heading p {
            font-size: 0.95rem;
            color: rgba(226,232,240,0.5);
            margin-bottom: 36px;
            line-height: 1.6;
        }

        /* error */
        .error-alert {
            background: rgba(248,113,113,0.1);
            border: 1px solid rgba(248,113,113,0.22);
            border-radius: 14px;
            padding: 13px 16px;
            color: #fca5a5;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
            animation: shake 0.4s ease;
        }
        @keyframes shake {
            0%,100% { transform: translateX(0); }
            20%,60%  { transform: translateX(-6px); }
            40%,80%  { transform: translateX(6px); }
        }

        /* fields */
        .field { margin-bottom: 20px; }
        .field label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #94a3b8;
            margin-bottom: 8px;
            letter-spacing: 0.02em;
        }
        .input-wrap { position: relative; }
        .input-wrap .icon-left {
            position: absolute;
            left: 16px; top: 50%;
            transform: translateY(-50%);
            color: rgba(148,163,184,0.5);
            font-size: 1rem;
            pointer-events: none;
        }
        .input-wrap input {
            width: 100%;
            padding: 14px 46px 14px 46px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.09);
            border-radius: 14px;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            color: #f1f5f9;
            outline: none;
            transition: border-color 0.25s, background 0.25s, box-shadow 0.25s;
        }
        .input-wrap input::placeholder { color: rgba(148,163,184,0.4); }
        .input-wrap input:focus {
            border-color: #6366f1;
            background: rgba(99,102,241,0.08);
            box-shadow: 0 0 0 4px rgba(99,102,241,0.13);
        }
        .toggle-pw {
            position: absolute;
            right: 14px; top: 50%;
            transform: translateY(-50%);
            color: rgba(148,163,184,0.45);
            background: none; border: none;
            padding: 4px; cursor: pointer;
            font-size: 1rem;
            transition: color 0.2s;
        }
        .toggle-pw:hover { color: #f1f5f9; }

        /* submit */
        .btn-login {
            width: 100%;
            margin-top: 10px;
            padding: 15px;
            background: linear-gradient(135deg, #4f46e5, #6366f1, #818cf8);
            background-size: 200% auto;
            border: none;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: background-position 0.4s ease, transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 12px 30px rgba(99,102,241,0.3);
        }
        .btn-login:hover {
            background-position: right center;
            transform: translateY(-2px);
            box-shadow: 0 18px 38px rgba(99,102,241,0.38);
        }
        .btn-login:active  { transform: translateY(0); }
        .btn-login:disabled { opacity: 0.65; cursor: not-allowed; transform: none; }

        /* divider */
        .form-divider {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 32px 0 0;
        }
        .form-divider::before,
        .form-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.07);
        }
        .form-divider span {
            font-size: 12px;
            color: rgba(148,163,184,0.4);
            white-space: nowrap;
        }

        /* footer */
        .form-footer {
            margin-top: 36px;
            text-align: center;
            font-size: 0.82rem;
            color: rgba(148,163,184,0.35);
        }

        /* ══ RIGHT — LOGO PANEL ══════════════════════════════ */
        .logo-panel {
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 48px;
            position: relative;
            overflow: hidden;
        }

        /* very subtle off-white texture rings */
        .logo-panel::before {
            content: '';
            position: absolute;
            width: 700px; height: 700px;
            border-radius: 50%;
            border: 1.5px solid rgba(99,102,241,0.07);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }
        .logo-panel::after {
            content: '';
            position: absolute;
            width: 500px; height: 500px;
            border-radius: 50%;
            border: 1.5px solid rgba(99,102,241,0.05);
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        .logo-content {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 36px;
            width: 100%;
        }

        .logo-img-wrap {
            width: 100%;
            max-width: 420px;
            aspect-ratio: 1 / 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            filter: drop-shadow(0 20px 50px rgba(99,102,241,0.12));
            animation: floatLogo 5s ease-in-out infinite;
        }

        @keyframes floatLogo {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-14px); }
        }

        .logo-tagline {
            text-align: center;
        }
        .logo-tagline h2 {
            font-size: 1.65rem;
            font-weight: 800;
            color: #1e293b;
            letter-spacing: -0.02em;
            margin-bottom: 8px;
        }
        .logo-tagline p {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.65;
            max-width: 320px;
            margin: 0 auto;
        }

        .logo-pills {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }
        .logo-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 16px;
            border-radius: 50px;
            border: 1.5px solid #e2e8f0;
            font-size: 0.82rem;
            font-weight: 600;
            color: #475569;
            background: #f8fafc;
            transition: all 0.2s;
        }
        .logo-pill i { color: #6366f1; font-size: 0.85rem; }
        .logo-pill:hover {
            border-color: #6366f1;
            color: #6366f1;
            background: rgba(99,102,241,0.05);
        }

        /* ── RESPONSIVE ──────────────────────────────────── */

        /* tablet: stack, form on top */
        @media (max-width: 991px) {
            .login-wrapper {
                grid-template-columns: 1fr;
                grid-template-rows: auto auto;
            }
            .form-panel  { order: 1; padding: 52px 36px; }
            .logo-panel  {
                order: 2;
                padding: 52px 36px;
                min-height: 420px;
            }
            .logo-img-wrap {
                max-width: 280px;
            }
            .form-inner { max-width: 480px; }
        }

        @media (max-width: 576px) {
            .form-panel  { padding: 44px 24px; }
            .logo-panel  { padding: 44px 24px; min-height: 360px; }
            .form-heading h1 { font-size: 1.75rem; }
            .logo-img-wrap { max-width: 220px; }
            .logo-tagline h2 { font-size: 1.35rem; }
            .logo-tagline p { font-size: 0.88rem; }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- ══ LEFT: FORM ═══════════════════════════════════════ -->
    <div class="form-panel">
        <div class="form-inner">

            <!-- Brand mark -->
            <div class="form-brand">
                <div class="brand-dot"></div>
                <span>Admin Portal</span>
            </div>

            <!-- Heading -->
            <div class="form-heading">
                <h1>Welcome back 👋</h1>
                <p>Sign in to manage your portfolio, projects, blogs, and messages.</p>
            </div>

            <!-- Error -->
            @if(session('error'))
                <div class="error-alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('admin.login.submit') }}" id="loginForm">
                @csrf

                <div class="field">
                    <label for="email">Email Address</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope icon-left"></i>
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
                        <i class="bi bi-lock icon-left"></i>
                        <input type="password"
                               id="password"
                               name="password"
                               placeholder="Enter your password"
                               autocomplete="current-password"
                               required>
                        <button type="button" class="toggle-pw" onclick="togglePassword()">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="submitBtn">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Sign In
                </button>
            </form>

            <div class="form-divider">
                <span>© {{ date('Y') }} Maaz Sikandar</span>
            </div>

            <div class="form-footer">
                CodeEdge Labs &mdash; All rights reserved
            </div>

        </div>
    </div>

    <!-- ══ RIGHT: LOGO ══════════════════════════════════════ -->
    <div class="logo-panel">
        <div class="logo-content">

            <!-- Logo image — big, centered, fills the panel -->
            <div class="logo-img-wrap">
                <img src="{{ asset('img/mlogo.png') }}" alt="Maaz Sikandar Logo">
            </div>

            <!-- Tagline -->
            <div class="logo-tagline">
                <h2>CodeEdge Labs</h2>
                <p>Building modern, scalable web experiences with clean code and creative design.</p>
            </div>

            <!-- Pills -->
            <div class="logo-pills">
                <span class="logo-pill"><i class="bi bi-lightning-charge-fill"></i> Laravel</span>
                <span class="logo-pill"><i class="bi bi-brush-fill"></i> UI/UX Design</span>
                <span class="logo-pill"><i class="bi bi-code-slash"></i> Full Stack</span>
                <span class="logo-pill"><i class="bi bi-shield-check-fill"></i> Secure</span>
            </div>

        </div>
    </div>

</div>

<script>
    function togglePassword() {
        const pw  = document.getElementById('password');
        const ico = document.getElementById('eyeIcon');
        pw.type   = pw.type === 'password' ? 'text' : 'password';
        ico.className = pw.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
    }

    document.getElementById('loginForm').addEventListener('submit', function () {
        const btn = document.getElementById('submitBtn');
        btn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status"></span> Signing in...`;
        btn.disabled = true;
    });
</script>

</body>
</html>
