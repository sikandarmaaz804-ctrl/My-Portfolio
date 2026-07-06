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

/* ══ RESPONSIVE ═══════════════════════════════════════════════ */
@media (max-width: 991px) {
    .contact_banner .banner_inner { min-height: 420px; }
    .contact_banner { min-height: 420px; }
    .contact_banner .banner_text h2 { font-size: 38px; }
    .form-card { padding: 36px 28px; }
}
@media (max-width: 767px) {
    .contact_banner .banner_inner { min-height: 360px; }
    .contact_banner { min-height: 360px; }
    .contact_banner .banner_text h2 { font-size: 30px; }
    .contact_banner .banner_text p { font-size: 14px; }
    .map-wrap iframe { height: 280px; }
    .form-card { padding: 28px 20px; }
    .social-strip { padding: 30px 24px; }
}
@media (max-width: 575px) {
    .contact_banner .banner_text h2 { font-size: 24px; }
    .form-card .section-head h3 { font-size: 1.6rem; }
    .btn-send { width: 100%; justify-content: center; }
    .social-strip { flex-direction: column; text-align: center; }
    .social-strip .strip-icons { justify-content: center; }
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
                <div class="form-card">

                    <div class="section-head">
                        <span class="eyebrow">✦ Send a Message</span>
                        <h3>Drop Me a Line</h3>
                        <p>Whether you have a project in mind, a question, or just want to connect — I'm all ears. Complete the form and I'll reply within 24 hours.</p>
                    </div>

                    {{-- SUCCESS ALERT (Centered & Well-Designed) --}}
                    @if(session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Message Sent!',
                                html: '<p style="font-size: 16px; color: #666; margin: 10px 0;">{{ session('success') }}</p>',
                                showConfirmButton: true,
                                confirmButtonText: 'Great!',
                                confirmButtonColor: '#766dff',
                                allowOutsideClick: false,
                                backdrop: 'rgba(0,0,0,0.4)',
                                customClass: {
                                    container: 'swal-custom-container',
                                    popup: 'swal-custom-popup',
                                    title: 'swal-custom-title',
                                    confirmButton: 'swal-custom-button'
                                }
                            });
                        });
                    </script>
                    <style>
                        .swal-custom-popup {
                            border-radius: 20px !important;
                            box-shadow: 0 10px 40px rgba(118, 109, 255, 0.2) !important;
                            border: 2px solid #766dff !important;
                            background: linear-gradient(135deg, #ffffff 0%, #f8f7ff 100%) !important;
                        }
                        .swal-custom-title {
                            font-size: 28px !important;
                            font-weight: 800 !important;
                            color: #766dff !important;
                            margin-bottom: 15px !important;
                        }
                        .swal-custom-button {
                            background: linear-gradient(135deg, #766dff, #818cf8) !important;
                            border: none !important;
                            border-radius: 10px !important;
                            padding: 12px 40px !important;
                            font-weight: 700 !important;
                            font-size: 15px !important;
                            box-shadow: 0 5px 15px rgba(118, 109, 255, 0.3) !important;
                            transition: all 0.3s ease !important;
                        }
                        .swal-custom-button:hover {
                            transform: translateY(-2px) !important;
                            box-shadow: 0 8px 20px rgba(118, 109, 255, 0.4) !important;
                        }
                    </style>
                    @endif

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
                                           value="{{ old('name') }}"
                                           required>
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
                                           value="{{ old('email') }}"
                                           required>
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
                                   value="{{ old('phone') }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text"
                                   id="subject"
                                   name="subject"
                                   class="form-control"
                                   placeholder="What's this about?"
                                   value="{{ old('subject') }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message"
                                      name="message"
                                      class="form-control"
                                      placeholder="Write your message here..."
                                      required>{{ old('message') }}</textarea>
                        </div>

                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mt-2">
                            <p style="font-size:12px; color:#9ca3af; margin:0;">
                                <i class="fa fa-lock" style="margin-right:5px; color:#766dff;"></i>
                                Your information is safe and will never be shared.
                            </p>
                            <button type="submit" class="btn-send">
                                <i class="fa fa-paper-plane"></i>
                                Send Message
                            </button>
                        </div>

                    </form>
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

@endsection
