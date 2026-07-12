@extends('main')

@section('main-container')

<style>
/* ══ RESET ════════════════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; }

/* ══ HERO BANNER ══════════════════════════════════════════════ */
.contact_banner {
    min-height: 520px;
    position: relative;
    z-index: 1;
    overflow: hidden;
}
.contact_banner .banner_inner {
    background: linear-gradient(135deg, #0f172a 0%, #1a1f3c 100%);
    position: relative;
    overflow: hidden;
    width: 100%;
    min-height: 520px;
    display: flex;
    align-items: center;
}
.contact_banner .orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(70px);
    pointer-events: none;
    z-index: 0;
}
.contact_banner .orb-1 {
    width: 420px; height: 420px;
    background: rgba(118,109,255,.18);
    top: -120px; left: -100px;
}
.contact_banner .orb-2 {
    width: 320px; height: 320px;
    background: rgba(136,243,255,.12);
    bottom: -80px; right: -60px;
}
.contact_banner .banner_text {
    max-width: 780px;
    margin: 0 auto;
    color: #fff;
    text-align: center;
    position: relative;
    z-index: 2;
    padding: 0 20px;
}
.contact_banner .banner_text .eyebrow {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(136,243,255,.9);
    margin-bottom: 18px;
    display: block;
}
.contact_banner .banner_text h2 {
    font-size: 52px;
    font-weight: 800;
    font-family: 'Heebo', sans-serif;
    line-height: 1.15;
    margin-bottom: 18px;
    color: #fff;
}
.contact_banner .banner_text h2 span {
    background: linear-gradient(135deg, #a78bfa, #88f3ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.contact_banner .banner_text p {
    font-size: 16px;
    line-height: 1.8;
    color: rgba(255,255,255,.72);
    margin-bottom: 28px;
    max-width: 560px;
    margin-left: auto;
    margin-right: auto;
}
.breadcrumb-pill {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 50px;
    padding: 10px 28px;
    display: inline-flex;
    gap: 12px;
    align-items: center;
    font-size: 13px;
}
.breadcrumb-pill a {
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    font-weight: 500;
    transition: color .2s;
}
.breadcrumb-pill a:hover { color: #fff; }
.breadcrumb-pill span { color: rgba(255,255,255,0.4); }
.breadcrumb-pill .current { color: #fff; font-weight: 600; }

/* ══ CONTACT SECTION ══════════════════════════════════════════ */
.contact_section {
    background: #f4f7fc;
    padding: 80px 0 90px;
}

/* ══ MAP ══════════════════════════════════════════════════════ */
.map-wrap {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 12px 40px rgba(0,0,0,0.10);
    margin-bottom: 60px;
    border: 1px solid #e9edf5;
}
.map-wrap iframe {
    display: block;
    width: 100%;
    height: 380px;
    border: none;
}

/* ══ INFO CARDS ═══════════════════════════════════════════════ */
.info-card-row {
    margin-bottom: 50px;
}
.info-card {
    background: #fff;
    border-radius: 18px;
    border: 1px solid #e9edf5;
    padding: 34px 28px;
    text-align: center;
    height: 100%;
    transition: transform .28s, box-shadow .28s, border-color .28s;
}
.info-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(118,109,255,.13);
    border-color: #c4b9ff;
}
.info-card .ic-icon {
    width: 62px; height: 62px;
    background: linear-gradient(135deg, rgba(118,109,255,.12), rgba(136,243,255,.12));
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 18px;
}
.info-card .ic-icon i {
    font-size: 24px;
    background: linear-gradient(135deg, #766dff, #88f3ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.info-card h5 {
    font-size: 14px;
    font-weight: 700;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
    font-family: 'Roboto', sans-serif;
}
.info-card p, .info-card a {
    font-size: 15px;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
    text-decoration: none;
    line-height: 1.6;
    transition: color .2s;
}
.info-card a:hover { color: #766dff; }
.info-card .sub-text {
    font-size: 12px;
    font-weight: 400;
    color: #9ca3af;
    display: block;
    margin-top: 5px;
}

/* ══ FORM CARD ════════════════════════════════════════════════ */
.form-card {
    background: #fff;
    border-radius: 20px;
    border: 1px solid #e9edf5;
    padding: 48px 44px;
    box-shadow: 0 4px 24px rgba(0,0,0,.06);
}
.form-card .section-head {
    margin-bottom: 36px;
}
.form-card .section-head .eyebrow {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: #766dff;
    margin-bottom: 10px;
    display: block;
}
.form-card .section-head h3 {
    font-size: 2rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 10px;
    font-family: 'Heebo', sans-serif;
}
.form-card .section-head p {
    font-size: 14px;
    color: #6b7280;
    line-height: 1.75;
    margin: 0;
}

/* ── form controls ── */
.form-card .form-group { margin-bottom: 20px; }
.form-card .form-group label {
    font-size: 12px;
    font-weight: 700;
    color: #374151;
    letter-spacing: .4px;
    text-transform: uppercase;
    margin-bottom: 7px;
    display: block;
}
.form-card .form-control {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 12px 18px;
    font-size: 14px;
    color: #374151;
    background: #f9fafb;
    transition: border-color .22s, background .22s, box-shadow .22s;
    font-family: 'Roboto', sans-serif;
}
.form-card .form-control:focus {
    border-color: #766dff;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(118,109,255,.1);
    outline: none;
}
.form-card textarea.form-control { resize: vertical; min-height: 140px; }

/* ── submit button ── */
.btn-send {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 42px;
    background: linear-gradient(135deg, #766dff 0%, #88f3ff 100%);
    color: #fff;
    border: none;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: .5px;
    cursor: pointer;
    transition: all .3s;
    box-shadow: 0 8px 24px rgba(118,109,255,.35);
    font-family: 'Roboto', sans-serif;
}
.btn-send:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 32px rgba(118,109,255,.50);
    color: #fff;
}
.btn-send i { font-size: 16px; }

/* ── alert ── */
.alert-success-custom {
    background: linear-gradient(135deg, rgba(118,109,255,.1), rgba(136,243,255,.1));
    border: 1.5px solid #766dff;
    border-radius: 12px;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #4f46e5;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 28px;
}
.alert-success-custom i { font-size: 20px; flex-shrink: 0; }

/* ══ SOCIAL STRIP ══════════════════════════════════════════════ */
.social-strip {
    background: linear-gradient(135deg, #0f172a, #1a1f3c);
    border-radius: 20px;
    padding: 40px 44px;
    margin-top: 36px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
}
.social-strip .strip-text h4 {
    font-size: 1.25rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 5px;
    font-family: 'Heebo', sans-serif;
}
.social-strip .strip-text p {
    font-size: 13px;
    color: rgba(255,255,255,.6);
    margin: 0;
}
.social-strip .strip-icons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.social-strip .strip-icons a {
    width: 44px; height: 44px;
    border-radius: 12px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(255,255,255,0.75);
    font-size: 17px;
    text-decoration: none;
    transition: all .28s;
}
.social-strip .strip-icons a:hover {
    background: linear-gradient(135deg, #766dff, #88f3ff);
    border-color: transparent;
    color: #fff;
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(118,109,255,.4);
}

/* ══ PUBLIC NOTICE MODAL ══════════════════════════════════════ */
.notice-overlay {
    position: fixed;
    inset: 0;
    background: rgba(10,14,35,.80);
    backdrop-filter: blur(7px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}
.notice-overlay.hidden { display: none; }
.notice-box {
    background: #fff;
    border-radius: 24px;
    max-width: 560px;
    width: 100%;
    padding: 48px 44px 40px;
    box-shadow: 0 28px 72px rgba(0,0,0,.28);
    text-align: center;
    position: relative;
    animation: noticeIn .38s cubic-bezier(.34,1.56,.64,1) both;
}
@keyframes noticeIn {
    from { opacity: 0; transform: scale(.85) translateY(36px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}
.notice-icon {
    width: 76px; height: 76px;
    background: linear-gradient(135deg, rgba(239,68,68,.14), rgba(251,146,60,.12));
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px;
    border: 2px solid rgba(239,68,68,.18);
}
.notice-icon i { font-size: 32px; color: #ef4444; }
.notice-badge {
    display: inline-block;
    background: linear-gradient(135deg, #ef4444, #f97316);
    color: #fff;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    border-radius: 50px;
    padding: 5px 16px;
    margin-bottom: 16px;
}
.notice-box h4 {
    font-size: 1.3rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 16px;
    font-family: 'Heebo', sans-serif;
    letter-spacing: .3px;
}
.notice-box p {
    font-size: 14px;
    line-height: 1.9;
    color: #4b5563;
    margin: 0 0 30px;
    text-align: left;
}
.btn-notice-ok {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 13px 52px;
    background: linear-gradient(135deg, #766dff 0%, #88f3ff 100%);
    color: #fff;
    border: none;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: all .3s;
    box-shadow: 0 8px 24px rgba(118,109,255,.38);
    font-family: 'Roboto', sans-serif;
}
.btn-notice-ok:hover {
    transform: translateY(-2px);
    box-shadow: 0 14px 32px rgba(118,109,255,.55);
}

/* ══ DISABLED FORM ════════════════════════════════════════════ */
.form-disabled-wrap {
    position: relative;
    pointer-events: none;
    user-select: none;
}
.form-disabled-wrap::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(249,250,251,.62);
    border-radius: 20px;
    z-index: 10;
    cursor: not-allowed;
}
.form-card .form-control:disabled {
    background: #f3f4f6 !important;
    color: #9ca3af !important;
    cursor: not-allowed;
    border-color: #e5e7eb !important;
}
.btn-send:disabled {
    opacity: .5;
    cursor: not-allowed;
    transform: none !important;
    box-shadow: none !important;
    background: #d1d5db !important;
}

/* ══ WHATSAPP CTA BANNER ══════════════════════════════════════ */
.wa-cta {
    background: linear-gradient(135deg, #075e54 0%, #128c7e 60%, #25d366 100%);
    border-radius: 22px;
    padding: 38px 44px;
    margin-top: 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
    box-shadow: 0 16px 48px rgba(37,211,102,.28);
    position: relative;
    overflow: hidden;
}
.wa-cta::before {
    content: '';
    position: absolute;
    width: 260px; height: 260px;
    background: rgba(255,255,255,.05);
    border-radius: 50%;
    top: -80px; right: -60px;
    pointer-events: none;
}
.wa-cta-text { flex: 1; min-width: 200px; }
.wa-cta-text .wa-label {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: rgba(255,255,255,.75);
    display: block;
    margin-bottom: 8px;
}
.wa-cta-text h4 {
    font-size: 1.25rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 6px;
    font-family: 'Heebo', sans-serif;
    line-height: 1.3;
}
.wa-cta-text p {
    font-size: 13px;
    color: rgba(255,255,255,.78);
    margin: 0;
    line-height: 1.65;
}
.btn-whatsapp {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 34px;
    background: #fff;
    color: #075e54;
    border: none;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 800;
    cursor: pointer;
    text-decoration: none;
    transition: all .3s;
    box-shadow: 0 8px 24px rgba(0,0,0,.18);
    white-space: nowrap;
    flex-shrink: 0;
}
.btn-whatsapp i { font-size: 20px; color: #25d366; }
.btn-whatsapp:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 32px rgba(0,0,0,.26);
    color: #075e54;
    background: #f0fdf4;
}

/* ══ RESPONSIVE ═══════════════════════════════════════════════ */
@media (max-width: 991px) {
    .contact_banner .banner_inner { min-height: 420px; }
    .contact_banner { min-height: 420px; }
    .contact_banner .banner_text h2 { font-size: 38px; }
    .form-card { padding: 36px 28px; }
    .wa-cta { padding: 30px 28px; }
}
@media (max-width: 767px) {
    .contact_banner .banner_inner { min-height: 360px; }
    .contact_banner { min-height: 360px; }
    .contact_banner .banner_text h2 { font-size: 30px; }
    .contact_banner .banner_text p { font-size: 14px; }
    .map-wrap iframe { height: 280px; }
    .form-card { padding: 28px 20px; }
    .social-strip { padding: 30px 24px; }
    .wa-cta { flex-direction: column; text-align: center; }
    .btn-whatsapp { width: 100%; justify-content: center; }
}
@media (max-width: 575px) {
    .contact_banner .banner_text h2 { font-size: 24px; }
    .form-card .section-head h3 { font-size: 1.6rem; }
    .btn-send { width: 100%; justify-content: center; }
    .social-strip { flex-direction: column; text-align: center; }
    .social-strip .strip-icons { justify-content: center; }
    .notice-box { padding: 36px 24px 30px; }
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
                <p>Have a project idea, a question, or just want to say hello? I'd love to hear from you. Fill out the form below and I'll get back to you as soon as possible.</p>
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
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        {{-- INFO CARDS --}}
        <div class="row info-card-row">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="info-card">
                    <div class="ic-icon">
                        <i class="lnr lnr-home"></i>
                    </div>
                    <h5>Location</h5>
                    <p>Malakand, Sakhakot</p>
                    <span class="sub-text">Pakistan</span>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="info-card">
                    <div class="ic-icon">
                        <i class="lnr lnr-phone-handset"></i>
                    </div>
                    <h5>Phone</h5>
                    <a href="tel:+923015878068">+92 301 5878068</a>
                    <span class="sub-text">Mon – Fri, 9am to 6pm</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card">
                    <div class="ic-icon">
                        <i class="lnr lnr-envelope"></i>
                    </div>
                    <h5>Email</h5>
                    <a href="mailto:sikandarmaaz95@gmail.com">sikandarmaaz95@gmail.com</a>
                    <span class="sub-text">Send your query anytime</span>
                </div>
            </div>
        </div>

        {{-- CONTACT FORM --}}
        <div class="row justify-content-center">
            <div class="col-lg-9">

                {{-- FORM CARD — permanently disabled --}}
                <div class="form-card form-disabled-wrap" id="formCardWrap">

                    <div class="section-head">
                        <span class="eyebrow">✦ Send a Message</span>
                        <h3>Drop Me a Line</h3>
                        <p>The contact form is currently disabled. If you are a real user and need our services, please reach out to us directly via WhatsApp using the button below.</p>
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Your Name</label>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           class="form-control"
                                           placeholder="e.g. John Doe"
                                           disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email"
                                           id="email"
                                           name="email"
                                           class="form-control"
                                           placeholder="e.g. john@example.com"
                                           disabled>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Contact Number</label>
                            <input type="tel"
                                   id="phone"
                                   name="phone"
                                   class="form-control"
                                   placeholder="e.g. +1 (555) 123-4567"
                                   disabled>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text"
                                   id="subject"
                                   name="subject"
                                   class="form-control"
                                   placeholder="What's this about?"
                                   disabled>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message"
                                      name="message"
                                      class="form-control"
                                      placeholder="Write your message here..."
                                      disabled></textarea>
                        </div>

                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mt-2">
                            <p style="font-size:12px; color:#9ca3af; margin:0;">
                                <i class="fa fa-ban" style="margin-right:5px; color:#ef4444;"></i>
                                This form is currently disabled.
                            </p>
                            <button type="button" class="btn-send" disabled>
                                <i class="fa fa-paper-plane"></i>
                                Send Message
                            </button>
                        </div>

                    </form>
                </div>

                {{-- WHATSAPP CTA --}}
                <div class="wa-cta">
                    <div class="wa-cta-text">
                        <span class="wa-label">✦ Real Users — Contact Us Here</span>
                        <h4>Need Our Services? Chat on WhatsApp</h4>
                        <p>The contact form is temporarily disabled. If you are a genuine user interested in our services, please tap the button and message us directly on WhatsApp — we'll get back to you right away.</p>
                    </div>
                    <a href="https://wa.me/923015878068" target="_blank" rel="noopener noreferrer" class="btn-whatsapp" aria-label="Chat on WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                        Chat on WhatsApp
                    </a>
                </div>

                {{-- SOCIAL STRIP --}}
                <div class="social-strip">
                    <div class="strip-text">
                        <h4>Connect on Social Media</h4>
                        <p>Follow me for updates, projects, and dev insights.</p>
                    </div>
                    <div class="strip-icons">
                        <a href="#" title="Facebook" aria-label="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" title="Twitter" aria-label="Twitter">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                        <a href="#" title="LinkedIn" aria-label="LinkedIn">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="#" title="GitHub" aria-label="GitHub">
                            <i class="fa-brands fa-github"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════
     PUBLIC NOTICE MODAL
══════════════════════════════════════════════════════════════ --}}
<div class="notice-overlay" id="noticeOverlay" role="dialog" aria-modal="true" aria-labelledby="noticeTitle">
    <div class="notice-box">
        <div class="notice-icon">
            <i class="fa fa-triangle-exclamation"></i>
        </div>
        <span class="notice-badge">⚠ Public Notice</span>
        <h4 id="noticeTitle">Public Notice</h4>
        <p>
            An individual is sending harassing content using fake names, email addresses, and phone numbers.<br><br>
            The sender is being traced through their <strong>IP address</strong> by cybercrime experts, and an <strong>FIR has already been registered</strong>. Legal action is in progress, and the individual will be dealt with according to the law.<br><br>
            Please do not believe or share any false information.
        </p>
        <button class="btn-notice-ok" id="noticeOkBtn" onclick="document.getElementById('noticeOverlay').classList.add('hidden')">
            <i class="fa fa-check"></i> I Understand
        </button>
    </div>
</div>

@endsection
