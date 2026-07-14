@extends('main')

@section('main-container')

<style>
/* ══ RESET ════════════════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; }

/* ══ HERO BANNER ══════════════════════════════════════════════ */
.contact_banner { min-height: 520px; position: relative; z-index: 1; overflow: hidden; }
.contact_banner .banner_inner {
    background: linear-gradient(135deg, #0f172a 0%, #1a1f3c 100%);
    position: relative; overflow: hidden; width: 100%;
    min-height: 520px; display: flex; align-items: center;
}
.contact_banner .orb {
    position: absolute; border-radius: 50%;
    filter: blur(70px); pointer-events: none; z-index: 0;
}
.contact_banner .orb-1 { width:420px;height:420px;background:rgba(118,109,255,.18);top:-120px;left:-100px; }
.contact_banner .orb-2 { width:320px;height:320px;background:rgba(136,243,255,.12);bottom:-80px;right:-60px; }
.contact_banner .banner_text {
    max-width: 780px; margin: 0 auto; color: #fff;
    text-align: center; position: relative; z-index: 2; padding: 0 20px;
}
.contact_banner .banner_text .eyebrow {
    font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;
    color:rgba(136,243,255,.9);margin-bottom:18px;display:block;
}
.contact_banner .banner_text h2 {
    font-size:52px;font-weight:800;font-family:'Heebo',sans-serif;
    line-height:1.15;margin-bottom:18px;color:#fff;
}
.contact_banner .banner_text h2 span {
    background:linear-gradient(135deg,#a78bfa,#88f3ff);
    -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
}
.contact_banner .banner_text p {
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
</style>

<style>
/* ══ CONTACT SECTION ══════════════════════════════════════════ */
.contact_section { background:#f4f7fc; padding:80px 0 90px; }

/* ══ MAP ══════════════════════════════════════════════════════ */
.map-wrap {
    border-radius:20px;overflow:hidden;
    box-shadow:0 12px 40px rgba(0,0,0,0.10);
    margin-bottom:60px;border:1px solid #e9edf5;
}
.map-wrap iframe { display:block;width:100%;height:380px;border:none; }

/* ══ INFO CARDS ═══════════════════════════════════════════════ */
.info-card-row { margin-bottom:50px; }
.info-card {
    background:#fff;border-radius:18px;border:1px solid #e9edf5;
    padding:34px 28px;text-align:center;height:100%;
    transition:transform .28s,box-shadow .28s,border-color .28s;
}
.info-card:hover { transform:translateY(-6px);box-shadow:0 16px 40px rgba(118,109,255,.13);border-color:#c4b9ff; }
.info-card .ic-icon {
    width:62px;height:62px;
    background:linear-gradient(135deg,rgba(118,109,255,.12),rgba(136,243,255,.12));
    border-radius:18px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;
}
.info-card .ic-icon i {
    font-size:24px;
    background:linear-gradient(135deg,#766dff,#88f3ff);
    -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
}
.info-card h5 {
    font-size:14px;font-weight:700;color:#6b7280;text-transform:uppercase;
    letter-spacing:1px;margin-bottom:10px;font-family:'Roboto',sans-serif;
}
.info-card p,.info-card a {
    font-size:15px;font-weight:600;color:#1e293b;margin:0;
    text-decoration:none;line-height:1.6;transition:color .2s;
}
.info-card a:hover { color:#766dff; }
.info-card .sub-text { font-size:12px;font-weight:400;color:#9ca3af;display:block;margin-top:5px; }

/* ══ SOCIAL STRIP ══════════════════════════════════════════════ */
.social-strip {
    background:linear-gradient(135deg,#0f172a,#1a1f3c);border-radius:20px;
    padding:40px 44px;margin-top:36px;display:flex;align-items:center;
    justify-content:space-between;gap:24px;flex-wrap:wrap;
}
.social-strip .strip-text h4 { font-size:1.25rem;font-weight:800;color:#fff;margin-bottom:5px;font-family:'Heebo',sans-serif; }
.social-strip .strip-text p { font-size:13px;color:rgba(255,255,255,.6);margin:0; }
.social-strip .strip-icons { display:flex;gap:10px;flex-wrap:wrap; }
.social-strip .strip-icons a {
    width:44px;height:44px;border-radius:12px;background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.12);display:flex;align-items:center;
    justify-content:center;color:rgba(255,255,255,0.75);font-size:17px;
    text-decoration:none;transition:all .28s;
}
.social-strip .strip-icons a:hover {
    background:linear-gradient(135deg,#766dff,#88f3ff);border-color:transparent;
    color:#fff;transform:translateY(-4px);box-shadow:0 8px 20px rgba(118,109,255,.4);
}
</style>

<style>
/* ══ WHATSAPP CARD ════════════════════════════════════════════ */
.wa-card {
    background: #fff;
    border-radius: 28px;
    border: 1px solid #e2fbe9;
    box-shadow: 0 20px 60px rgba(37,211,102,.12), 0 4px 20px rgba(0,0,0,.06);
    overflow: hidden;
    position: relative;
}

/* top accent bar */
.wa-card-accent {
    height: 6px;
    background: linear-gradient(90deg, #075e54, #25d366, #128c7e);
}

/* header area */
.wa-card-header {
    background: linear-gradient(135deg, #075e54 0%, #128c7e 50%, #1ebe6a 100%);
    padding: 52px 52px 44px;
    position: relative;
    overflow: hidden;
    text-align: center;
}
.wa-card-header::before {
    content:'';position:absolute;width:380px;height:380px;
    background:rgba(255,255,255,.06);border-radius:50%;
    top:-160px;right:-100px;pointer-events:none;
}
.wa-card-header::after {
    content:'';position:absolute;width:260px;height:260px;
    background:rgba(255,255,255,.04);border-radius:50%;
    bottom:-100px;left:-60px;pointer-events:none;
}
.wa-logo-wrap {
    width: 88px; height: 88px;
    background: rgba(255,255,255,.15);
    border: 3px solid rgba(255,255,255,.3);
    border-radius: 28px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 22px;
    backdrop-filter: blur(8px);
    position: relative; z-index: 1;
    box-shadow: 0 8px 32px rgba(0,0,0,.18);
}
.wa-logo-wrap i { font-size: 42px; color: #fff; }
.wa-card-header .wa-eyebrow {
    font-size: 10px; font-weight: 800; letter-spacing: 3px;
    text-transform: uppercase; color: rgba(255,255,255,.7);
    display: block; margin-bottom: 10px; position: relative; z-index: 1;
}
.wa-card-header h3 {
    font-size: 2rem; font-weight: 800; color: #fff;
    font-family: 'Heebo', sans-serif; margin-bottom: 12px;
    position: relative; z-index: 1; line-height: 1.2;
}
.wa-card-header p {
    font-size: 15px; color: rgba(255,255,255,.82);
    line-height: 1.75; margin: 0; max-width: 460px;
    margin-left: auto; margin-right: auto;
    position: relative; z-index: 1;
}

/* body */
.wa-card-body { padding: 44px 52px 48px; }

/* feature row */
.wa-features { display: flex; gap: 16px; flex-wrap: wrap; margin-bottom: 36px; }
.wa-feature {
    flex: 1; min-width: 140px;
    background: #f8fffe;
    border: 1.5px solid #d1fae5;
    border-radius: 16px;
    padding: 20px 18px;
    text-align: center;
}
.wa-feature .wf-icon {
    width: 44px; height: 44px;
    background: linear-gradient(135deg, rgba(37,211,102,.15), rgba(18,140,126,.12));
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 10px;
}
.wa-feature .wf-icon i { font-size: 18px; color: #059669; }
.wa-feature span { font-size: 12px; font-weight: 700; color: #374151; display: block; }
.wa-feature small { font-size: 11px; color: #6b7280; }

/* divider */
.wa-divider { border: none; border-top: 1.5px solid #f0fdf4; margin: 0 0 36px; }

/* action area */
.wa-action { text-align: center; }
.wa-action p {
    font-size: 14px; color: #6b7280; line-height: 1.75;
    margin-bottom: 28px; max-width: 420px; margin-left: auto; margin-right: auto;
}
.btn-wa-main {
    display: inline-flex; align-items: center; gap: 12px;
    padding: 18px 52px;
    background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
    color: #fff; border: none; border-radius: 50px;
    font-size: 16px; font-weight: 800;
    cursor: pointer; text-decoration: none;
    transition: all .35s;
    box-shadow: 0 12px 36px rgba(37,211,102,.40);
    letter-spacing: .3px; font-family: 'Roboto', sans-serif;
    position: relative; overflow: hidden;
}
.btn-wa-main::before {
    content:''; position:absolute; inset:0;
    background: linear-gradient(135deg, rgba(255,255,255,.15), transparent);
    border-radius:50px;
}
.btn-wa-main i { font-size: 22px; position: relative; z-index: 1; }
.btn-wa-main span { position: relative; z-index: 1; }
.btn-wa-main:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 50px rgba(37,211,102,.55);
    color: #fff; text-decoration: none;
}
.wa-note {
    display: inline-flex; align-items: center; gap: 6px;
    margin-top: 18px; font-size: 12px; color: #9ca3af;
}
.wa-note i { color: #25d366; font-size: 13px; }
</style>

<style>
/* ══ RESPONSIVE ═══════════════════════════════════════════════ */
@media (max-width:991px) {
    .contact_banner .banner_inner,.contact_banner { min-height:420px; }
    .contact_banner .banner_text h2 { font-size:38px; }
    .wa-card-header { padding:40px 36px 36px; }
    .wa-card-body { padding:36px; }
}
@media (max-width:767px) {
    .contact_banner .banner_inner,.contact_banner { min-height:360px; }
    .contact_banner .banner_text h2 { font-size:30px; }
    .contact_banner .banner_text p { font-size:14px; }
    .map-wrap iframe { height:280px; }
    .social-strip { padding:30px 24px; }
    .wa-card-header { padding:36px 24px 30px; }
    .wa-card-body { padding:28px 24px 34px; }
    .wa-features { flex-direction:column; }
    .btn-wa-main { width:100%;justify-content:center;padding:17px 32px; }
}
@media (max-width:575px) {
    .contact_banner .banner_text h2 { font-size:24px; }
    .social-strip { flex-direction:column;text-align:center; }
    .social-strip .strip-icons { justify-content:center; }
    .wa-card-header h3 { font-size:1.6rem; }
}
</style>

{{-- ══════════════════════════════════════════════════════════════
     HERO BANNER
══════════════════════════════════════════════════════════════ --}}
<section class="contact_banner">
    <div class="banner_inner">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="container">
            <div class="banner_text">
                <span class="eyebrow">✦ Get In Touch</span>
                <h2>
                    Let's Start a<br>
                    <span>Conversation</span>
                </h2>
                <p>Have a project idea or a question? Reach out directly on WhatsApp and I'll get back to you as soon as possible.</p>
                <div class="breadcrumb-pill">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <span class="current">Contact Us</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     CONTACT SECTION
══════════════════════════════════════════════════════════════ --}}
<section class="contact_section">
    <div class="container">

        {{-- MAP --}}
        <div class="map-wrap">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3289.4920643377163!2d71.9070826748347!3d34.465039495822566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38d95500645e371b%3A0xac4e794afb868918!2sSakhakot%20Bazar%20district%20malakand!5e0!3m2!1sen!2s!4v1777366152345!5m2!1sen!2s"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        {{-- INFO CARDS --}}
        <div class="row info-card-row">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="info-card">
                    <div class="ic-icon"><i class="lnr lnr-home"></i></div>
                    <h5>Location</h5>
                    <p>Malakand, Sakhakot</p>
                    <span class="sub-text">Pakistan</span>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="info-card">
                    <div class="ic-icon"><i class="lnr lnr-phone-handset"></i></div>
                    <h5>Phone</h5>
                    <a href="tel:+923015878068">+92 301 5878068</a>
                    <span class="sub-text">Mon – Fri, 9am to 6pm</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card">
                    <div class="ic-icon"><i class="lnr lnr-envelope"></i></div>
                    <h5>Email</h5>
                    <a href="mailto:sikandarmaaz95@gmail.com">sikandarmaaz95@gmail.com</a>
                    <span class="sub-text">Send your query anytime</span>
                </div>
            </div>
        </div>

        {{-- WHATSAPP CARD --}}
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <div class="wa-card">
                    <div class="wa-card-accent"></div>

                    {{-- Header --}}
                    <div class="wa-card-header">
                        <div class="wa-logo-wrap">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <span class="wa-eyebrow">✦ Direct Contact</span>
                        <h3>Chat With Us on WhatsApp</h3>
                        <p>The quickest way to reach us. Drop a message and we'll respond promptly — no forms, no waiting, just a real conversation.</p>
                    </div>

                    {{-- Body --}}
                    <div class="wa-card-body">

                        {{-- Feature highlights --}}
                        <div class="wa-features">
                            <div class="wa-feature">
                                <div class="wf-icon"><i class="fa fa-bolt"></i></div>
                                <span>Fast Replies</span>
                                <small>Usually within minutes</small>
                            </div>
                            <div class="wa-feature">
                                <div class="wf-icon"><i class="fa fa-lock"></i></div>
                                <span>Private & Secure</span>
                                <small>End-to-end encrypted</small>
                            </div>
                            <div class="wa-feature">
                                <div class="wf-icon"><i class="fa fa-clock"></i></div>
                                <span>Available Daily</span>
                                <small>Mon – Sat, 9am – 8pm</small>
                            </div>
                            <div class="wa-feature">
                                <div class="wf-icon"><i class="fa fa-handshake"></i></div>
                                <span>Real Support</span>
                                <small>Talk to a real person</small>
                            </div>
                        </div>

                        <hr class="wa-divider">

                        {{-- CTA --}}
                        <div class="wa-action">
                            <p>
                                Whether you have a project in mind, need a quote, or just want to say hello —
                                tap the button below to open WhatsApp and start chatting right away.
                            </p>
                            <a href="https://wa.me/923015878068?text=Hi%2C%20I%20found%20your%20portfolio%20and%20would%20like%20to%20discuss%20a%20project."
                               target="_blank" rel="noopener noreferrer"
                               class="btn-wa-main" aria-label="Open WhatsApp Chat">
                                <i class="fa-brands fa-whatsapp"></i>
                                <span>Open WhatsApp Chat</span>
                            </a>
                            <div class="wa-note">
                                <i class="fa fa-circle-check"></i>
                                Tapping will open WhatsApp with a pre-filled message
                            </div>
                        </div>

                    </div>{{-- /wa-card-body --}}
                </div>{{-- /wa-card --}}

                {{-- SOCIAL STRIP --}}
                <div class="social-strip">
                    <div class="strip-text">
                        <h4>Connect on Social Media</h4>
                        <p>Follow me for updates, projects, and dev insights.</p>
                    </div>
                    <div class="strip-icons">
                        <a href="#" title="Facebook" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" title="Twitter" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" title="LinkedIn" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" title="GitHub" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
