@extends('main')

@section('main-container')

<style>
/* ══ RESET ════════════════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; }

/* ══ HERO BANNER ══════════════════════════════════════════════ */
.careers_banner { min-height: 520px; position: relative; z-index: 1; overflow: hidden; }
.careers_banner .banner_inner {
    background: linear-gradient(135deg, #0f172a 0%, #1a1f3c 100%);
    position: relative; overflow: hidden; width: 100%;
    min-height: 520px; display: flex; align-items: center;
}
.careers_banner .orb {
    position: absolute; border-radius: 50%;
    filter: blur(70px); pointer-events: none; z-index: 0;
}
.careers_banner .orb-1 { width:420px;height:420px;background:rgba(99,102,241,.20);top:-140px;left:-80px; }
.careers_banner .orb-2 { width:320px;height:320px;background:rgba(139,92,246,.14);bottom:-80px;right:-60px; }
.careers_banner .banner_text {
    max-width: 780px; margin: 0 auto; color: #fff;
    text-align: center; position: relative; z-index: 2; padding: 0 20px;
}
.careers_banner .banner_text .eyebrow {
    font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;
    color:rgba(167,139,250,.9);margin-bottom:18px;display:block;
}
.careers_banner .banner_text h2 {
    font-size:52px;font-weight:800;font-family:'Heebo',sans-serif;
    line-height:1.15;margin-bottom:18px;color:#fff;
}
.careers_banner .banner_text h2 span {
    background:linear-gradient(135deg,#a78bfa,#818cf8);
    -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
}
.careers_banner .banner_text p {
    font-size:16px;line-height:1.8;color:rgba(255,255,255,.72);
    margin-bottom:28px;max-width:560px;margin-left:auto;margin-right:auto;
}
.breadcrumb-pill {
    background:rgba(255,255,255,0.1);backdrop-filter:blur(10px);
    border:1px solid rgba(255,255,255,0.15);border-radius:50px;
    padding:10px 28px;display:inline-flex;gap:12px;align-items:center;font-size:13px;
}
.breadcrumb-pill a { color:rgba(255,255,255,0.8);text-decoration:none;font-weight:500;transition:color .2s; }
.breadcrumb-pill a:hover { color:#fff; }
.breadcrumb-pill span { color:rgba(255,255,255,0.4); }
.breadcrumb-pill .current { color:#fff;font-weight:600; }

/* ══ MAIN SECTION ══════════════════════════════════════════════ */
.careers_section { background:#f4f7fc; padding:80px 0 90px; }

/* ══ WHY JOIN CARDS ══════════════════════════════════════════ */
.why-card {
    background:#fff;border-radius:18px;border:1px solid #e9edf5;
    padding:30px 24px;text-align:center;height:100%;
    transition:transform .28s,box-shadow .28s,border-color .28s;
}
.why-card:hover {
    transform:translateY(-6px);
    box-shadow:0 16px 40px rgba(99,102,241,.13);
    border-color:#c4b9ff;
}
.why-card .wc-icon {
    width:60px;height:60px;
    background:linear-gradient(135deg,rgba(99,102,241,.12),rgba(139,92,246,.10));
    border-radius:18px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;
}
.why-card .wc-icon i {
    font-size:24px;
    background:linear-gradient(135deg,#667eea,#764ba2);
    -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
}
.why-card h5 { font-size:15px;font-weight:700;color:#1e293b;margin-bottom:8px; }
.why-card p  { font-size:13px;line-height:1.75;color:#64748b;margin:0; }

/* ══ APPLICATION CARD ════════════════════════════════════════ */
.app-card {
    background:#fff;
    border-radius:24px;
    border:1px solid #e2e8f0;
    overflow:hidden;
    box-shadow:0 4px 24px rgba(0,0,0,.07);
}
.app-card-header {
    background:linear-gradient(135deg,#1e1b4b 0%,#312e81 50%,#4338ca 100%);
    padding:44px 52px 40px;
    position:relative;overflow:hidden;text-align:center;
}
.app-card-header::before {
    content:'';position:absolute;width:350px;height:350px;
    background:rgba(255,255,255,.05);border-radius:50%;
    top:-140px;right:-80px;pointer-events:none;
}
.app-card-header .ach-icon {
    width:72px;height:72px;
    background:rgba(255,255,255,.15);
    border:2px solid rgba(255,255,255,.25);
    border-radius:22px;
    display:flex;align-items:center;justify-content:center;
    margin:0 auto 20px;position:relative;z-index:1;
    backdrop-filter:blur(8px);
}
.app-card-header .ach-icon i { font-size:32px;color:#fff; }
.app-card-header span.eyebrow {
    display:block;font-size:10px;font-weight:800;letter-spacing:3px;
    text-transform:uppercase;color:rgba(199,210,254,.85);margin-bottom:10px;
    position:relative;z-index:1;
}
.app-card-header h3 {
    font-size:1.9rem;font-weight:800;color:#fff;
    font-family:'Heebo',sans-serif;margin-bottom:12px;
    position:relative;z-index:1;line-height:1.2;
}
.app-card-header p {
    font-size:14px;color:rgba(255,255,255,.78);line-height:1.75;
    max-width:500px;margin:0 auto;position:relative;z-index:1;
}
.app-card-body { padding:44px 52px 52px; }

/* ══ FORM STYLES ═══════════════════════════════════════════════ */
.form-section-title {
    font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:1.2px;
    color:#94a3b8;margin:0 0 20px;padding-bottom:10px;
    border-bottom:1px solid #e2e8f0;display:block;
}
.field-group { margin-bottom:22px; }
.field-label {
    display:block;font-size:13px;font-weight:700;color:#1e293b;margin-bottom:7px;
}
.field-label .req { color:#ef4444;margin-left:3px; }
.field-input {
    width:100%;padding:12px 16px;
    border:1.5px solid #e2e8f0;border-radius:12px;
    font-size:14px;font-family:inherit;
    background:#fff;color:#1e293b;
    transition:border-color .2s,box-shadow .2s;
    outline:none;
}
.field-input:focus {
    border-color:#6366f1;
    box-shadow:0 0 0 4px rgba(99,102,241,.10);
}
textarea.field-input { resize:vertical;min-height:110px; }
.field-hint { font-size:12px;color:#94a3b8;margin-top:5px; }
.is-invalid { border-color:#ef4444 !important; }
.error-msg { font-size:12px;color:#ef4444;margin-top:5px; }

/* Submit button */
.btn-submit-app {
    display:inline-flex;align-items:center;gap:10px;
    padding:16px 48px;
    background:linear-gradient(135deg,#4f46e5,#7c3aed);
    color:#fff;border:none;border-radius:50px;
    font-size:15px;font-weight:800;letter-spacing:.3px;
    cursor:pointer;transition:all .3s;
    box-shadow:0 10px 30px rgba(99,102,241,.38);
    font-family:inherit;position:relative;overflow:hidden;
}
.btn-submit-app::before {
    content:'';position:absolute;inset:0;
    background:linear-gradient(135deg,rgba(255,255,255,.12),transparent);
    border-radius:50px;
}
.btn-submit-app span,
.btn-submit-app i { position:relative;z-index:1; }
.btn-submit-app:hover {
    transform:translateY(-3px);
    box-shadow:0 16px 40px rgba(99,102,241,.50);
}

/* ══ SUCCESS ALERT ════════════════════════════════════════════ */
.success-alert {
    display:flex;gap:14px;align-items:flex-start;
    background:linear-gradient(135deg,rgba(16,185,129,.08),rgba(5,150,105,.06));
    border:1.5px solid rgba(16,185,129,.25);
    border-radius:16px;padding:20px 24px;margin-bottom:28px;
}
.success-alert .sa-icon {
    width:42px;height:42px;flex-shrink:0;
    background:rgba(16,185,129,.12);border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    font-size:18px;color:#059669;
}
.success-alert .sa-body strong { display:block;font-size:14px;font-weight:700;color:#064e3b;margin-bottom:4px; }
.success-alert .sa-body p { font-size:13px;color:#065f46;line-height:1.65;margin:0; }

/* ══ RESPONSIVE ═══════════════════════════════════════════════ */
@media (max-width:991px) {
    .careers_banner .banner_inner,.careers_banner { min-height:420px; }
    .careers_banner .banner_text h2 { font-size:38px; }
    .app-card-header { padding:36px 36px 32px; }
    .app-card-body { padding:36px; }
}
@media (max-width:767px) {
    .careers_banner .banner_inner,.careers_banner { min-height:360px; }
    .careers_banner .banner_text h2 { font-size:28px; }
    .app-card-header { padding:32px 24px 28px; }
    .app-card-body { padding:28px 20px 36px; }
    .btn-submit-app { width:100%;justify-content:center; }
}
@media (max-width:575px) {
    .careers_banner .banner_text h2 { font-size:22px; }
    .app-card-header h3 { font-size:1.5rem; }
}
</style>

{{-- ══════════════════════════════════════════════════════════════
     HERO BANNER
══════════════════════════════════════════════════════════════ --}}
<section class="careers_banner">
    <div class="banner_inner">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="container">
            <div class="banner_text">
                <span class="eyebrow">✦ We're Hiring</span>
                <h2>
                    Join Our<br>
                    <span>Creative Team</span>
                </h2>
                <p>Are you a talented programmer looking for your next opportunity? We'd love to hear from you. Fill out the form below and let's build something great together.</p>
                <div class="breadcrumb-pill">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span class="current">Careers</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     WHY JOIN US
══════════════════════════════════════════════════════════════ --}}
<section class="careers_section">
    <div class="container">

        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <span style="font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:#6366f1;">Why Work With Us</span>
                <h2 style="font-size:2rem;font-weight:800;color:#1e293b;margin-top:8px;font-family:'Heebo',sans-serif;">
                    A Place Where Talent Thrives
                </h2>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="why-card">
                    <div class="wc-icon"><i class="fa fa-rocket"></i></div>
                    <h5>Exciting Projects</h5>
                    <p>Work on real-world, cutting-edge web applications that reach thousands of users.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="why-card">
                    <div class="wc-icon"><i class="fa fa-graduation-cap"></i></div>
                    <h5>Continuous Learning</h5>
                    <p>We invest in our team's growth through mentorship, resources, and new challenges.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="why-card">
                    <div class="wc-icon"><i class="fa fa-users"></i></div>
                    <h5>Collaborative Culture</h5>
                    <p>Thrive in a supportive, open team environment where every voice matters.</p>
                </div>
            </div>
        </div>

        {{-- APPLICATION FORM --}}
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="app-card">

                    {{-- Card Header --}}
                    <div class="app-card-header">
                        <div class="ach-icon"><i class="fa fa-file-code"></i></div>
                        <span class="eyebrow">✦ Job Application</span>
                        <h3>Apply as a Programmer</h3>
                        <p>Fill in the details below. All fields are required. We'll reach out to you via email or WhatsApp.</p>
                    </div>

                    {{-- Card Body --}}
                    <div class="app-card-body">

                        {{-- Success message --}}
                        @if(session('success'))
                        <div class="success-alert">
                            <div class="sa-icon"><i class="fa fa-circle-check"></i></div>
                            <div class="sa-body">
                                <strong>Application Submitted!</strong>
                                <p>{{ session('success') }}</p>
                            </div>
                        </div>
                        @endif

                        <form action="{{ route('careers.store') }}" method="POST" novalidate>
                            @csrf

                            <span class="form-section-title">Personal Information</span>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="field-group">
                                        <label class="field-label" for="name">
                                            Full Name <span class="req">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="name"
                                            name="name"
                                            class="field-input @error('name') is-invalid @enderror"
                                            placeholder="e.g. John Doe"
                                            value="{{ old('name') }}"
                                            required
                                        >
                                        @error('name')
                                            <div class="error-msg"><i class="fa fa-circle-xmark"></i> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="field-group">
                                        <label class="field-label" for="email">
                                            Email Address <span class="req">*</span>
                                        </label>
                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            class="field-input @error('email') is-invalid @enderror"
                                            placeholder="you@example.com"
                                            value="{{ old('email') }}"
                                            required
                                        >
                                        @error('email')
                                            <div class="error-msg"><i class="fa fa-circle-xmark"></i> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="whatsapp">
                                    WhatsApp Number <span class="req">*</span>
                                </label>
                                <input
                                    type="tel"
                                    id="whatsapp"
                                    name="whatsapp"
                                    class="field-input @error('whatsapp') is-invalid @enderror"
                                    placeholder="+92 300 0000000"
                                    value="{{ old('whatsapp') }}"
                                    required
                                >
                                <div class="field-hint">Include your country code (e.g. +92 for Pakistan).</div>
                                @error('whatsapp')
                                    <div class="error-msg"><i class="fa fa-circle-xmark"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <span class="form-section-title" style="margin-top:8px;">Education & Skills</span>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="field-group">
                                        <label class="field-label" for="education">
                                            Education <span class="req">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="education"
                                            name="education"
                                            class="field-input @error('education') is-invalid @enderror"
                                            placeholder="e.g. BS Computer Science — FAST NUCES"
                                            value="{{ old('education') }}"
                                            required
                                        >
                                        @error('education')
                                            <div class="error-msg"><i class="fa fa-circle-xmark"></i> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="field-group">
                                        <label class="field-label" for="expertise">
                                            Primary Expertise / Role <span class="req">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="expertise"
                                            name="expertise"
                                            class="field-input @error('expertise') is-invalid @enderror"
                                            placeholder="e.g. Laravel Full Stack Developer"
                                            value="{{ old('expertise') }}"
                                            required
                                        >
                                        @error('expertise')
                                            <div class="error-msg"><i class="fa fa-circle-xmark"></i> {{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="experience">
                                    Experience <span class="req">*</span>
                                </label>
                                <textarea
                                    id="experience"
                                    name="experience"
                                    class="field-input @error('experience') is-invalid @enderror"
                                    placeholder="Describe your work experience: years of experience, previous roles, projects, technologies used…"
                                    required
                                >{{ old('experience') }}</textarea>
                                @error('experience')
                                    <div class="error-msg"><i class="fa fa-circle-xmark"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <span class="form-section-title" style="margin-top:8px;">About You</span>

                            <div class="field-group">
                                <label class="field-label" for="introduction">
                                    Short Bio / Introduce Yourself <span class="req">*</span>
                                </label>
                                <textarea
                                    id="introduction"
                                    name="introduction"
                                    class="field-input @error('introduction') is-invalid @enderror"
                                    style="min-height:130px;"
                                    placeholder="Tell us a bit about yourself — your passion, what drives you, and why you'd be a great fit for our team…"
                                    required
                                >{{ old('introduction') }}</textarea>
                                @error('introduction')
                                    <div class="error-msg"><i class="fa fa-circle-xmark"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn-submit-app">
                                    <i class="fa fa-paper-plane"></i>
                                    <span>Submit Application</span>
                                </button>
                                <p style="font-size:12px;color:#94a3b8;margin-top:14px;">
                                    <i class="fa fa-lock" style="color:#6366f1;"></i>
                                    Your information is kept private and will only be used for hiring purposes.
                                </p>
                            </div>

                        </form>
                    </div>{{-- /card body --}}
                </div>{{-- /app-card --}}

            </div>
        </div>

    </div>
</section>

@endsection
