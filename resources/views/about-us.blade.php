@extends('main')
@section('main-container')

<style>
/* ==================== ABOUT PAGE STYLES ==================== */

/* Hero Banner */
.about-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 120px 0 100px;
    position: relative;
    overflow: hidden;
}

.about-hero::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.1)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
    background-size: cover;
    opacity: 0.3;
}

.about-hero h1 {
    color: white;
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    animation: fadeInUp 0.8s ease-out;
}

.about-hero p {
    color: rgba(255,255,255,0.95);
    font-size: 1.25rem;
    max-width: 600px;
    margin: 0 auto 2rem;
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

.breadcrumb-custom {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    padding: 10px 25px;
    display: inline-flex;
    gap: 15px;
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

.breadcrumb-custom a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s;
}

.breadcrumb-custom a:hover { transform: translateY(-2px); }
.breadcrumb-custom span { color: rgba(255,255,255,0.7); }

/* Section Title */
.section-title {
    text-align: center;
    margin-bottom: 60px;
}

.section-title h2 {
    font-size: 2.4rem;
    font-weight: 800;
    color: #2d3748;
    margin-bottom: 16px;
    position: relative;
    display: inline-block;
}

.section-title h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
}

.section-title p {
    color: #718096;
    font-size: 1.1rem;
    max-width: 620px;
    margin: 24px auto 0;
    line-height: 1.8;
}

/* Profile Section */
.profile-section {
    padding: 100px 0;
    background: white;
}

.profile-card {
    background: white;
    border-radius: 24px;
    padding: 50px 40px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
    animation: fadeInUp 0.8s ease-out;
}

.profile-img-wrapper {
    position: relative;
    margin-bottom: 30px;
}

.profile-img {
    width: 100%;
    max-width: 280px;
    height: auto;
    border-radius: 20px;
    object-fit: cover;
    border: 6px solid #fff;
    box-shadow: 0 15px 40px rgba(102,126,234,0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
}

.profile-content h3 {
    font-size: 2rem;
    font-weight: 800;
    color: #2d3748;
    margin-bottom: 8px;
}

.profile-subtitle {
    font-size: 1.2rem;
    color: #667eea;
    font-weight: 600;
    margin-bottom: 12px;
}

.profile-tagline {
    color: #718096;
    font-size: 1.05rem;
    margin-bottom: 30px;
    line-height: 1.8;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 30px 0;
}

.info-list li {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
    color: #4a5568;
    font-size: 0.97rem;
}

.info-list li:last-child { border-bottom: none; }

.info-list li .icon-box {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, rgba(102,126,234,0.12) 0%, rgba(118,75,162,0.12) 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.info-list li .icon-box i {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 0.9rem;
}

.social-links {
    display: flex;
    gap: 12px;
    margin-top: 28px;
    flex-wrap: wrap;
}

.social-link {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, rgba(102,126,234,0.12) 0%, rgba(118,75,162,0.12) 100%);
    transition: all 0.3s ease;
    text-decoration: none;
}

.social-link i {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 1.1rem;
}

.social-link:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transform: translateY(-4px);
    box-shadow: 0 10px 20px rgba(102,126,234,0.3);
}

.social-link:hover i { -webkit-text-fill-color: white; background: none; }

/* About Text */
.about-text h4 {
    font-size: 1.6rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 16px;
}

.about-text h4::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0;
    width: 50px; height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
}

.about-text p {
    color: #718096;
    font-size: 1rem;
    line-height: 1.9;
    margin-bottom: 30px;
}

.download-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 36px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(102,126,234,0.35);
}

.download-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(102,126,234,0.45);
    color: white;
    text-decoration: none;
}

/* Stats Section */
.stats-section {
    padding: 80px 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

.stats-section::before {
    content: '';
    position: absolute;
    top: -50%; left: -50%;
    width: 200%; height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 60%);
}

.stat-item { text-align: center; padding: 20px; }
.stat-number { font-size: 3rem; font-weight: 800; color: white; line-height: 1; margin-bottom: 8px; }
.stat-label { color: rgba(255,255,255,0.8); font-size: 1rem; font-weight: 500; text-transform: uppercase; letter-spacing: 1px; }

/* Skills Section */
.skills-section {
    padding: 100px 0;
    background: #f8f9fa;
}

.skill-item-modern {
    margin-bottom: 28px;
}

.skill-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.skill-name {
    font-weight: 600;
    color: #2d3748;
    font-size: 0.97rem;
    text-transform: capitalize;
}

.skill-percent {
    font-weight: 700;
    color: #667eea;
    font-size: 0.9rem;
}

.skill-bar {
    height: 8px;
    background: #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
}

.skill-progress {
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    width: 0;
    transition: width 1.5s cubic-bezier(0.165, 0.84, 0.44, 1);
}

/* Tech badges */
.tech-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 30px;
}

.tech-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px;
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    color: #4a5568;
    transition: all 0.3s ease;
}

.tech-badge:hover {
    border-color: #667eea;
    color: #667eea;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(102,126,234,0.15);
}

.tech-badge i {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 1rem;
}

/* Journey Section (Timeline) */
.journey-section {
    padding: 100px 0;
    background: white;
}

.journey-tabs .nav-tabs {
    border-bottom: 2px solid #e2e8f0;
    justify-content: center;
    gap: 40px;
    margin-bottom: 50px;
}

.journey-tabs .nav-tabs .nav-link {
    background: none;
    border: none;
    font-size: 1.1rem;
    font-weight: 700;
    color: #718096;
    padding: 12px 0;
    position: relative;
    transition: color 0.3s ease;
}

.journey-tabs .nav-tabs .nav-link::after {
    content: '';
    position: absolute;
    bottom: -2px; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.journey-tabs .nav-tabs .nav-link.active {
    color: #667eea;
}

.journey-tabs .nav-tabs .nav-link.active::after {
    transform: scaleX(1);
}

.timeline-list {
    list-style: none;
    padding: 0;
    position: relative;
}

.timeline-list::before {
    content: '';
    position: absolute;
    left: 20px; top: 0; bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, #667eea, #764ba2);
}

.timeline-item {
    position: relative;
    padding-left: 70px;
    margin-bottom: 50px;
    animation: fadeInUp 0.6s ease-out both;
}

.timeline-item:nth-child(1) { animation-delay: 0.1s; }
.timeline-item:nth-child(2) { animation-delay: 0.2s; }
.timeline-item:nth-child(3) { animation-delay: 0.3s; }
.timeline-item:nth-child(4) { animation-delay: 0.4s; }

.timeline-icon {
    position: absolute;
    left: 0; top: 0;
    width: 42px; height: 42px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    box-shadow: 0 5px 15px rgba(102,126,234,0.4);
    z-index: 1;
}

.timeline-date {
    display: inline-block;
    padding: 6px 18px;
    background: linear-gradient(135deg, rgba(102,126,234,0.12) 0%, rgba(118,75,162,0.12) 100%);
    border-radius: 20px;
    color: #667eea;
    font-weight: 600;
    font-size: 0.85rem;
    margin-bottom: 14px;
}

.timeline-content h4 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #2d3748;
    margin-bottom: 8px;
}

.timeline-content p {
    color: #718096;
    font-size: 0.97rem;
    line-height: 1.8;
    margin: 0;
}

/* Animation */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media (max-width: 992px) {
    .about-hero h1 { font-size: 2.5rem; }
    .profile-card { padding: 40px 30px; }
}

@media (max-width: 768px) {
    .about-hero { padding: 110px 0 60px; }
    .about-hero h1 { font-size: 2rem; }
    .about-hero p { font-size: 1rem; }
    .section-title h2 { font-size: 1.9rem; }
    .stat-number { font-size: 2.3rem; }
    .profile-img { max-width: 220px; }
    .timeline-item { padding-left: 60px; }
}

@media (max-width: 576px) {
    .about-hero h1 { font-size: 1.75rem; }
    .profile-card { padding: 30px 20px; }
    .profile-img { max-width: 200px; }
}
</style>

<!-- ================= HERO BANNER ================= -->
<section class="about-hero">
    <div class="container">
        <div class="text-center position-relative">
            <h1>About Me</h1>
            <p>Passionate developer crafting modern web experiences with clean code, creative design, and solid engineering.</p>
            <div class="breadcrumb-custom">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="#">About Me</a>
            </div>
        </div>
    </div>
</section>

<!-- ================= PROFILE SECTION ================= -->
<section class="profile-section">
    <div class="container">
        <div class="row align-items-center g-5">

            <!-- Photo + personal card -->
            <div class="col-lg-4 text-center">
                <div class="profile-card">
                    <div class="profile-img-wrapper">
                        <img src="{{ asset('img/per.jpeg') }}" alt="Maaz Sikandar" class="profile-img">
                    </div>
                    <h3>Maaz Sikandar</h3>
                    <p class="profile-subtitle">CEO — CodeEdge Labs</p>
                    <p class="profile-tagline-role" style="font-size:0.92rem; color:#764ba2; font-weight:600; margin-bottom:6px; letter-spacing:0.5px;">
                        UI Designer / Full-Stack Developer
                    </p>
                    <p class="profile-tagline">I turn ideas into powerful, scalable web applications.</p>

                    <ul class="info-list">
                        <li>
                            <div class="icon-box"><i class="lnr lnr-briefcase"></i></div>
                            <span><strong>CEO</strong> — CodeEdge Labs</span>
                        </li>
                        <li>
                            <div class="icon-box"><i class="lnr lnr-calendar-full"></i></div>
                            <span>20 March 2002</span>
                        </li>
                        <li>
                            <div class="icon-box"><i class="lnr lnr-phone-handset"></i></div>
                            <span>+923015878068</span>
                        </li>
                        <li>
                            <div class="icon-box"><i class="lnr lnr-envelope"></i></div>
                            <span>sikandarmaaz95@gmail.com</span>
                        </li>
                        <li>
                            <div class="icon-box"><i class="lnr lnr-home"></i></div>
                            <span>Malakand Sakhakot, Pakistan</span>
                        </li>
                    </ul>

                    <div class="social-links justify-content-center">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="GitHub">
                            <i class="fa-brands fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- About Text -->
            <div class="col-lg-8">
                <div class="about-text">
                    <h4>Who I Am</h4>
                    <p>I'm <strong>Maaz Sikandar</strong>, CEO of <strong>CodeEdge Labs</strong> and a passionate <strong>Software Developer</strong> with 6+ years of experience building modern, responsive web applications. I specialize in frontend technologies like <strong>React, Bootstrap, and Tailwind</strong>, along with backend development using <strong>Laravel</strong>.</p>
                    
                    <p>My expertise spans the full development lifecycle — from concept and design to deployment and maintenance. I focus on writing <strong>clean, efficient code</strong> and creating <strong>user-friendly digital experiences</strong> that solve real-world problems.</p>
                    
                    <p>Currently, I'm working on scalable solutions like a <strong>Library Management System</strong> while continuously learning and improving my skills in modern web technologies, cloud infrastructure, and best development practices.</p>

                    <p>I believe in the power of <strong>collaboration, continuous learning</strong>, and delivering solutions that not only meet but exceed expectations. Whether building from scratch or optimizing existing systems, I bring dedication, technical expertise, and a user-first mindset.</p>

                    @if(!empty($resume))
                        <a href="{{ route('resume.download') }}"
                           class="download-btn"
                           download>
                            <i class="fa fa-download"></i>
                            <span>Download Resume</span>
                        </a>
                    @else
                        <span class="download-btn"
                              style="opacity:0.45; cursor:not-allowed; pointer-events:none;"
                              title="Resume not available yet">
                            <i class="fa fa-download"></i>
                            <span>Download Resume</span>
                        </span>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= TEAM PREVIEW SECTION ================= -->
@if($members->isNotEmpty())
<section style="padding: 90px 0 80px; background: #f0f2f8; position:relative;">
    <div class="container">

        <div class="section-title">
            <h2>Meet Our Team</h2>
            <p>The talented minds at CodeEdge Labs — driven by passion, united by purpose.</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($members as $member)
            <div class="col-lg-4 col-md-6">
                <div class="tp-card">

                    <!-- Full image block -->
                    <div class="tp-img-block">
                        <img src="{{ asset('uploads/' . $member->photo) }}"
                             alt="{{ $member->name }}"
                             loading="lazy">
                        <div class="tp-overlay"></div>
                        <span class="tp-exp-badge">{{ $member->experience_years }}+ yrs</span>
                        <div class="tp-hover-strip">
                            <p class="tp-hs-name">{{ $member->name }}</p>
                            <p class="tp-hs-role">{{ $member->position }}</p>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="tp-body">
                        <h4 class="tp-name">{{ $member->name }}</h4>
                        <p class="tp-role">{{ $member->position }}</p>
                        <span class="tp-tag">
                            <i class="fas fa-code" style="font-size:0.7rem;"></i>
                            {{ $member->expertise }}
                        </span>
                        <p class="tp-desc">{{ Str::limit($member->description, 110) }}</p>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('team') }}" style="
                display:inline-flex; align-items:center; gap:10px;
                padding: 14px 40px;
                background: linear-gradient(135deg, #667eea, #764ba2);
                color:#fff; border-radius:50px;
                font-size:0.95rem; font-weight:700;
                text-decoration:none;
                box-shadow: 0 8px 28px rgba(102,126,234,0.38);
                transition: all 0.3s ease;
            "
            onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 16px 38px rgba(102,126,234,0.48)'"
            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 8px 28px rgba(102,126,234,0.38)'">
                <i class="fa fa-users"></i> View Full Team
            </a>
        </div>

    </div>
</section>

<style>
/* ── Team Preview Cards (About Us page) ── */
.tp-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 6px 28px rgba(15,12,41,0.09);
    transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.4s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
}
.tp-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 28px 64px rgba(102,126,234,0.20);
}

/* shine sweep */
.tp-card::before {
    content: '';
    position: absolute;
    top: 0; left: -100%;
    width: 60%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.06), transparent);
    transform: skewX(-20deg);
    transition: left 0.7s ease;
    z-index: 0;
    pointer-events: none;
}
.tp-card:hover::before { left: 160%; }

.tp-img-block {
    position: relative;
    width: 100%;
    overflow: hidden;
    background: linear-gradient(135deg, #1a1a2e, #302b63);
    line-height: 0;
}
.tp-img-block img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: unset;
    transition: transform 0.55s cubic-bezier(0.25,0.46,0.45,0.94), filter 0.55s ease;
    filter: brightness(1.02) contrast(1.04) saturate(1.08);
}
.tp-card:hover .tp-img-block img {
    transform: scale(1.05);
    filter: brightness(1.05) contrast(1.07) saturate(1.12);
}
.tp-img-block::after {
    content: '';
    position: absolute;
    bottom: -1px; left: 0; right: 0;
    height: 50px;
    background: #fff;
    clip-path: polygon(0 100%, 100% 100%, 100% 20%, 0 100%);
    z-index: 2;
    pointer-events: none;
}
.tp-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(180deg, transparent 40%, rgba(15,12,41,0.55) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 1;
}
.tp-card:hover .tp-overlay { opacity: 1; }

.tp-exp-badge {
    position: absolute; top: 14px; right: 14px; z-index: 3;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #fff; font-size: 11px; font-weight: 800;
    padding: 4px 11px; border-radius: 20px;
    box-shadow: 0 4px 14px rgba(102,126,234,0.4);
    letter-spacing: 0.3px;
}

.tp-hover-strip {
    position: absolute; bottom: 0; left: 0; right: 0; z-index: 3;
    padding: 12px 18px 20px;
    opacity: 0; transform: translateY(8px);
    transition: opacity 0.4s ease, transform 0.4s ease;
}
.tp-card:hover .tp-hover-strip { opacity: 1; transform: translateY(0); }
.tp-hs-name { color:#fff; font-size:1rem; font-weight:800; margin:0 0 2px; text-shadow:0 2px 8px rgba(0,0,0,0.4); }
.tp-hs-role { color:rgba(255,255,255,0.8); font-size:0.8rem; margin:0; }

.tp-body {
    padding: 20px 22px 24px;
    flex: 1; display: flex; flex-direction: column;
}
.tp-name { font-size:1.08rem; font-weight:800; color:#1a1a2e; margin-bottom:2px; }
.tp-role { font-size:0.84rem; font-weight:600; color:#667eea; margin-bottom:10px; }
.tp-tag {
    display:inline-flex; align-items:center; gap:6px;
    background: rgba(102,126,234,0.08);
    border: 1px solid rgba(102,126,234,0.14);
    color:#764ba2; font-size:0.78rem; font-weight:600;
    padding: 4px 12px; border-radius:20px; margin-bottom:12px;
    transition: all 0.3s ease;
}
.tp-card:hover .tp-tag {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-color: transparent; color:#fff;
}
.tp-desc { color:#718096; font-size:0.87rem; line-height:1.75; flex:1; margin:0; }
</style>
@endif

<!-- ================= STATS SECTION ================= -->
<section class="stats-section">    <div class="container">
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">60+</div>
                    <div class="stat-label">Projects Completed</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">30k+</div>
                    <div class="stat-label">Lines of Code</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Team Projects</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">6+</div>
                    <div class="stat-label">Years Experience</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= SKILLS SECTION ================= -->
<section class="skills-section">
    <div class="container">
        <div class="section-title">
            <h2>My Expertise</h2>
            <p>A snapshot of the technologies and skills I work with daily to deliver high-quality, modern web solutions.</p>
        </div>

        <div class="row g-5 align-items-start">

            <!-- Skill Bars -->
            <div class="col-lg-6">
                <div class="skill-item-modern">
                    <div class="skill-info">
                        <span class="skill-name">Full Stack Web Development</span>
                        <span class="skill-percent">95%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-progress" data-width="95"></div>
                    </div>
                </div>
                <div class="skill-item-modern">
                    <div class="skill-info">
                        <span class="skill-name">Laravel Development</span>
                        <span class="skill-percent">95%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-progress" data-width="95"></div>
                    </div>
                </div>
                <div class="skill-item-modern">
                    <div class="skill-info">
                        <span class="skill-name">UI / Web Design</span>
                        <span class="skill-percent">90%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-progress" data-width="90"></div>
                    </div>
                </div>
                <div class="skill-item-modern">
                    <div class="skill-info">
                        <span class="skill-name">Backend Development</span>
                        <span class="skill-percent">92%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-progress" data-width="92"></div>
                    </div>
                </div>
                <div class="skill-item-modern">
                    <div class="skill-info">
                        <span class="skill-name">SEO Optimization</span>
                        <span class="skill-percent">75%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-progress" data-width="75"></div>
                    </div>
                </div>
                <div class="skill-item-modern">
                    <div class="skill-info">
                        <span class="skill-name">Python / Automation</span>
                        <span class="skill-percent">70%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-progress" data-width="70"></div>
                    </div>
                </div>
            </div>

            <!-- Tech Badges -->
            <div class="col-lg-6">
                <h4 class="mb-4" style="font-size:1.5rem; font-weight:700; color:#2d3748;">Technologies I Use</h4>
                <p style="color:#718096; line-height:1.9; margin-bottom:30px;">
                    Over the years I've worked with a diverse set of tools and frameworks. Here are the technologies I'm most comfortable with and use regularly in my projects.
                </p>
                <div class="tech-badges">
                    <span class="tech-badge"><i class="fa-brands fa-laravel"></i> Laravel</span>
                    <span class="tech-badge"><i class="fa-brands fa-php"></i> PHP</span>
                    <span class="tech-badge"><i class="fa-brands fa-js"></i> JavaScript</span>
                    <span class="tech-badge"><i class="fa-brands fa-react"></i> React</span>
                    <span class="tech-badge"><i class="fa-brands fa-html5"></i> HTML5</span>
                    <span class="tech-badge"><i class="fa-brands fa-css3-alt"></i> CSS3</span>
                    <span class="tech-badge"><i class="fa-brands fa-bootstrap"></i> Bootstrap</span>
                    <span class="tech-badge"><i class="fa-brands fa-python"></i> Python</span>
                    <span class="tech-badge"><i class="fa-solid fa-database"></i> MySQL</span>
                    <span class="tech-badge"><i class="fa-brands fa-git-alt"></i> Git</span>
                    <span class="tech-badge"><i class="fa-brands fa-node-js"></i> Node.js</span>
                    <span class="tech-badge"><i class="fa-solid fa-server"></i> REST APIs</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= EXPERIENCE & EDUCATION TIMELINE ================= -->
<section class="journey-section">
    <div class="container">
        <div class="section-title">
            <h2>My Journey</h2>
            <p>A timeline of my professional experience and academic background that shaped who I am as a developer today.</p>
        </div>

        <div class="journey-tabs">
            <ul class="nav nav-tabs" id="journeyTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="exp-tab" data-toggle="tab" href="#experience" role="tab">
                        <i class="fa fa-briefcase me-2"></i> Experience
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="edu-tab" data-toggle="tab" href="#education" role="tab">
                        <i class="fa fa-graduation-cap me-2"></i> Education
                    </a>
                </li>
            </ul>

            <div class="tab-content" id="journeyTabContent">

                <!-- EXPERIENCE -->
                <div class="tab-pane fade show active" id="experience" role="tabpanel">
                    <ul class="timeline-list">

                        <li class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fa fa-code" style="font-size:1rem;"></i>
                            </div>
                            <div class="timeline-content">
                                <span class="timeline-date">Present — PSEB Apprenticeship</span>
                                <h4>Full Stack Web Developer</h4>
                                <p>PSEB Apprenticeship Program (Pakistan Software Export Board) — Developing and maintaining modern web applications with real-world project experience under a national tech initiative.</p>
                            </div>
                        </li>

                        <li class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fa fa-building" style="font-size:0.9rem;"></i>
                            </div>
                            <div class="timeline-content">
                                <span class="timeline-date">2023 – 2024</span>
                                <h4>Backend Web Developer</h4>
                                <p>Secretariat, Irrigation Department – Peshawar — Developed internal web-based systems under the supervision of the Assistant Director IT, modernizing departmental workflows.</p>
                            </div>
                        </li>

                        <li class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fa fa-laptop" style="font-size:0.9rem;"></i>
                            </div>
                            <div class="timeline-content">
                                <span class="timeline-date">2022 – 2024</span>
                                <h4>Full Stack Web Developer</h4>
                                <p>Scholars Academy (Peshawar & Dargai) — Developed academic and commercial web applications using modern frontend and backend technologies for educational and business needs.</p>
                            </div>
                        </li>

                    </ul>
                </div>

                <!-- EDUCATION -->
                <div class="tab-pane fade" id="education" role="tabpanel">
                    <ul class="timeline-list">

                        <li class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fa fa-graduation-cap" style="font-size:0.9rem;"></i>
                            </div>
                            <div class="timeline-content">
                                <span class="timeline-date">2020 – 2024</span>
                                <h4>Bachelor of Science in Software Engineering</h4>
                                <p>Abasyn University Peshawar — Graduated with a focus on software design, algorithms, databases, and modern application development.</p>
                            </div>
                        </li>

                        <li class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fa fa-certificate" style="font-size:0.9rem;"></i>
                            </div>
                            <div class="timeline-content">
                                <span class="timeline-date">2023 – 2024</span>
                                <h4>Diploma in Information Technology (DIT)</h4>
                                <p>AppTech Institute Peshawar — Intensive hands-on training in practical IT skills and professional software development tools.</p>
                            </div>
                        </li>

                        <li class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fa fa-book" style="font-size:0.9rem;"></i>
                            </div>
                            <div class="timeline-content">
                                <span class="timeline-date">2018 – 2020</span>
                                <h4>FSc Pre-Engineering</h4>
                                <p>Government Higher Secondary School — Studied mathematics, physics, and chemistry as the foundation for engineering and technology.</p>
                            </div>
                        </li>

                        <li class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fa fa-school" style="font-size:0.85rem;"></i>
                            </div>
                            <div class="timeline-content">
                                <span class="timeline-date">2016 – 2018</span>
                                <h4>Matriculation (Science)</h4>
                                <p>Allama Iqbal Model School Sakhakot — Completed secondary education with distinction in science subjects.</p>
                            </div>
                        </li>

                    </ul>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- ================= CTA SECTION ================= -->
<section style="padding: 100px 0; background: #f8f9fa;">
    <div class="container">
        <div style="
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 24px;
            padding: 70px 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        ">
            <!-- decorative circles -->
            <div style="position:absolute;top:-60px;right:-60px;width:220px;height:220px;background:rgba(255,255,255,0.08);border-radius:50%;"></div>
            <div style="position:absolute;bottom:-80px;left:-40px;width:280px;height:280px;background:rgba(255,255,255,0.05);border-radius:50%;"></div>

            <h2 style="color:white;font-size:2.5rem;font-weight:800;margin-bottom:16px;position:relative;z-index:1;">
                Let's Work Together
            </h2>
            <p style="color:rgba(255,255,255,0.9);font-size:1.15rem;max-width:560px;margin:0 auto 36px;line-height:1.8;position:relative;z-index:1;">
                Have a project in mind or just want to say hello? I'm always open to discussing new opportunities, creative ideas, and meaningful collaborations.
            </p>
            <a href="{{ route('contact') }}" style="
                display:inline-block;
                padding:16px 48px;
                background:white;
                color:#667eea;
                border-radius:50px;
                font-size:1rem;
                font-weight:700;
                text-decoration:none;
                transition:all 0.3s ease;
                position:relative;
                z-index:1;
                box-shadow:0 10px 30px rgba(0,0,0,0.15);
            " onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 20px 40px rgba(0,0,0,0.25)'"
               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)'">
                Get In Touch
            </a>
        </div>
    </div>
</section>

<!-- ================= SKILL BAR ANIMATION SCRIPT ================= -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Animate skill bars on scroll
    const skillObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                const bars = entry.target.querySelectorAll('.skill-progress');
                bars.forEach(function (bar) {
                    bar.style.width = bar.getAttribute('data-width') + '%';
                });
                skillObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    const skillsSection = document.querySelector('.skills-section');
    if (skillsSection) skillObserver.observe(skillsSection);
});
</script>

@endsection
