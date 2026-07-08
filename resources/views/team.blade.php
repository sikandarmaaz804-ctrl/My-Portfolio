@extends('main')

@section('main-container')

<style>
/* ================================================================
   TEAM PAGE — Professional Redesign
   ================================================================ */

/* ── Hero ──────────────────────────────────────────────────────── */
.team-hero {
    background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
    padding: 130px 0 110px;
    position: relative;
    overflow: hidden;
    text-align: center;
}

/* Animated blobs in background */
.team-hero::before,
.team-hero::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.35;
    animation: blobDrift 8s ease-in-out infinite alternate;
}
.team-hero::before {
    width: 500px; height: 500px;
    background: #667eea;
    top: -150px; left: -100px;
}
.team-hero::after {
    width: 400px; height: 400px;
    background: #764ba2;
    bottom: -120px; right: -80px;
    animation-delay: 2s;
}

@keyframes blobDrift {
    from { transform: translate(0, 0) scale(1); }
    to   { transform: translate(40px, 30px) scale(1.1); }
}

.team-hero h1 {
    color: #fff;
    font-size: 3.8rem;
    font-weight: 900;
    margin-bottom: 1rem;
    letter-spacing: -1px;
    position: relative; z-index: 1;
    animation: fadeInUp 0.8s ease-out both;
}

.team-hero h1 span {
    background: linear-gradient(90deg, #a78bfa, #67e8f9);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.team-hero p {
    color: rgba(255,255,255,0.80);
    font-size: 1.15rem;
    max-width: 580px;
    margin: 0 auto 2.2rem;
    line-height: 1.85;
    position: relative; z-index: 1;
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

.breadcrumb-pill {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 50px;
    padding: 10px 26px;
    display: inline-flex;
    gap: 14px;
    align-items: center;
    position: relative; z-index: 1;
    animation: fadeInUp 0.8s ease-out 0.4s both;
}
.breadcrumb-pill a { color: rgba(255,255,255,0.85); text-decoration: none; font-size:0.9rem; font-weight:500; transition: color 0.2s; }
.breadcrumb-pill a:hover { color: #fff; }
.breadcrumb-pill span { color: rgba(255,255,255,0.4); font-size:0.8rem; }

/* ── Section title ─────────────────────────────────────────────── */
.section-heading {
    text-align: center;
    margin-bottom: 70px;
}
.section-heading .label {
    display: inline-block;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    color: #667eea;
    background: rgba(102,126,234,0.1);
    padding: 6px 18px;
    border-radius: 20px;
    margin-bottom: 18px;
}
.section-heading h2 {
    font-size: 2.6rem;
    font-weight: 900;
    color: #1a1a2e;
    letter-spacing: -0.5px;
    margin-bottom: 18px;
    position: relative;
    display: inline-block;
}
.section-heading h2::after {
    content: '';
    position: absolute;
    bottom: -12px; left: 50%;
    transform: translateX(-50%);
    width: 70px; height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 4px;
}
.section-heading p {
    color: #718096;
    font-size: 1.05rem;
    max-width: 580px;
    margin: 28px auto 0;
    line-height: 1.85;
}

/* ── Team Section ──────────────────────────────────────────────── */
.team-section {
    padding: 110px 0 90px;
    background: #f0f2f8;
    position: relative;
}

/* subtle top wave */
.team-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 80px;
    background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
    clip-path: ellipse(55% 100% at 50% 0%);
}

/* ── Card ──────────────────────────────────────────────────────── */
.team-card {
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(15, 12, 41, 0.10);
    transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1),
                box-shadow 0.4s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
    animation: fadeInUp 0.65s ease-out both;
}

.team-card:hover {
    transform: translateY(-14px);
    box-shadow: 0 30px 70px rgba(102,126,234,0.22);
}

/* ── Photo block — full natural height, nothing cropped ───────── */
.team-img-block {
    position: relative;
    width: 100%;
    overflow: hidden;
    background: linear-gradient(135deg, #1a1a2e, #302b63);
    line-height: 0; /* removes gap under inline img */
}

.team-img-block img {
    width: 100%;
    height: auto;          /* natural height — full picture always visible */
    display: block;
    object-fit: unset;     /* no cropping */
    transition: transform 0.55s cubic-bezier(0.25,0.46,0.45,0.94),
                filter 0.55s ease;
    filter: brightness(1.02) contrast(1.04) saturate(1.08);
    will-change: transform, filter;
}

.team-card:hover .team-img-block img {
    transform: scale(1.05);
    filter: brightness(1.05) contrast(1.06) saturate(1.12);
}

/* Diagonal white wedge at bottom of image — decorative transition */
.team-img-block::after {
    content: '';
    position: absolute;
    bottom: -1px; left: 0; right: 0;
    height: 50px;
    background: #fff;
    clip-path: polygon(0 100%, 100% 100%, 100% 20%, 0 100%);
    z-index: 2;
    pointer-events: none;
}

/* Gradient overlay — fades in on hover */
.team-img-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        180deg,
        transparent 40%,
        rgba(15,12,41,0.55) 100%
    );
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 1;
}

.team-card:hover .team-img-overlay { opacity: 1; }

/* Experience badge — top right corner */
.exp-badge {
    position: absolute;
    top: 16px; right: 16px;
    z-index: 3;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #fff;
    font-size: 11px;
    font-weight: 800;
    padding: 5px 13px;
    border-radius: 20px;
    letter-spacing: 0.4px;
    box-shadow: 0 4px 16px rgba(102,126,234,0.45);
}

/* Hover quick-info strip that slides up over the image */
.team-img-hover-info {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    z-index: 3;
    padding: 14px 20px 22px;
    transform: translateY(10px);
    opacity: 0;
    transition: transform 0.4s ease, opacity 0.4s ease;
}

.team-card:hover .team-img-hover-info {
    transform: translateY(0);
    opacity: 1;
}

.team-img-hover-info .hi-name {
    color: #fff;
    font-size: 1.05rem;
    font-weight: 800;
    margin: 0 0 2px;
    text-shadow: 0 2px 8px rgba(0,0,0,0.4);
}

.team-img-hover-info .hi-pos {
    color: rgba(255,255,255,0.8);
    font-size: 0.82rem;
    font-weight: 500;
    margin: 0;
}

/* ── Card body ─────────────────────────────────────────────────── */
.team-card-body {
    padding: 22px 26px 28px;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.team-name {
    font-size: 1.18rem;
    font-weight: 800;
    color: #1a1a2e;
    margin-bottom: 3px;
}

.team-position {
    font-size: 0.88rem;
    font-weight: 600;
    color: #667eea;
    margin-bottom: 14px;
    letter-spacing: 0.2px;
}

/* Expertise row */
.team-expertise-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 14px;
}

.expertise-icon {
    width: 32px; height: 32px;
    border-radius: 9px;
    background: linear-gradient(135deg, rgba(102,126,234,0.12), rgba(118,75,162,0.12));
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.expertise-icon i {
    font-size: 0.82rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.expertise-text {
    font-size: 0.84rem;
    font-weight: 600;
    color: #4a5568;
    line-height: 1.3;
}

/* Separator */
.card-sep {
    width: 100%; height: 1px;
    background: #f0f0f5;
    margin: 14px 0;
}

/* Description */
.team-desc {
    color: #718096;
    font-size: 0.9rem;
    line-height: 1.78;
    flex: 1;
    margin: 0;
}

/* Footer row inside card */
.card-footer-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 20px;
    padding-top: 16px;
    border-top: 1px solid #f0f0f5;
}

.exp-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: linear-gradient(135deg, rgba(102,126,234,0.08), rgba(118,75,162,0.08));
    border: 1px solid rgba(102,126,234,0.15);
    color: #667eea;
    font-size: 0.8rem;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 20px;
    transition: all 0.3s ease;
}

.team-card:hover .exp-pill {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-color: transparent;
    color: #fff;
    box-shadow: 0 4px 14px rgba(102,126,234,0.35);
}

/* Shine sweep on hover */
.team-card::before {
    content: '';
    position: absolute;
    top: 0; left: -100%;
    width: 60%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255,255,255,0.06),
        transparent
    );
    transform: skewX(-20deg);
    transition: left 0.7s ease;
    z-index: 0;
    pointer-events: none;
}
.team-card:hover::before { left: 160%; }

/* ── Stagger animation delays ──────────────────────────────────── */
.team-col:nth-child(1) .team-card { animation-delay: 0.04s; }
.team-col:nth-child(2) .team-card { animation-delay: 0.11s; }
.team-col:nth-child(3) .team-card { animation-delay: 0.18s; }
.team-col:nth-child(4) .team-card { animation-delay: 0.25s; }
.team-col:nth-child(5) .team-card { animation-delay: 0.32s; }
.team-col:nth-child(6) .team-card { animation-delay: 0.39s; }

/* ── Empty state ───────────────────────────────────────────────── */
.team-empty {
    text-align: center;
    padding: 80px 20px;
    color: #718096;
}
.team-empty i { font-size: 64px; opacity: 0.18; display: block; margin-bottom: 16px; }
.team-empty p  { font-size: 1.1rem; margin: 0; }

/* ── Animations ────────────────────────────────────────────────── */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(34px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── Responsive ────────────────────────────────────────────────── */
@media (max-width: 768px) {
    .team-hero { padding: 110px 0 70px; }
    .team-hero h1 { font-size: 2.4rem; }
    .section-heading h2 { font-size: 2rem; }
    .team-section { padding: 80px 0 60px; }
}
@media (max-width: 576px) {
    .team-hero h1 { font-size: 1.9rem; letter-spacing: -0.5px; }
    .team-hero p  { font-size: 0.97rem; }
    .team-card-body { padding: 18px 20px 22px; }
}
</style>

<!-- ================================================================
     HERO
     ================================================================ -->
<section class="team-hero">
    <div class="container">
        <h1>Our <span>Team</span></h1>
        <p>The talented people behind CodeEdge Labs — a passionate group of developers and designers building digital experiences that matter.</p>
        <div class="breadcrumb-pill">
            <a href="{{ route('home') }}">Home</a>
            <span>/</span>
            <a href="#">Our Team</a>
        </div>
    </div>
</section>

<!-- ================================================================
     TEAM GRID
     ================================================================ -->
<section class="team-section">
    <div class="container" style="position:relative; z-index:1;">

        <div class="section-heading">
            <span class="label">The People</span>
            <h2>Meet the Team</h2>
            <p>Every great product starts with a great team. Here's the crew that makes it happen at CodeEdge Labs.</p>
        </div>

        @if($members->isNotEmpty())
        <div class="row g-4">
            @foreach($members as $member)
            <div class="col-lg-4 col-md-6 team-col">
                <div class="team-card">

                    <!-- ── Image Block ── -->
                    <div class="team-img-block">
                        <img src="{{ asset('uploads/' . $member->photo) }}"
                             alt="{{ $member->name }}"
                             loading="lazy">

                        <!-- Gradient overlay shown on hover -->
                        <div class="team-img-overlay"></div>

                        <!-- Experience badge -->
                        <span class="exp-badge">{{ $member->experience_years }}+ yrs exp</span>

                        <!-- Hover name strip -->
                        <div class="team-img-hover-info">
                            <p class="hi-name">{{ $member->name }}</p>
                            <p class="hi-pos">{{ $member->position }}</p>
                        </div>
                    </div>

                    <!-- ── Card Body ── -->
                    <div class="team-card-body">
                        <h3 class="team-name">{{ $member->name }}</h3>
                        <p class="team-position">{{ $member->position }}</p>

                        <div class="team-expertise-row">
                            <div class="expertise-icon">
                                <i class="fas fa-code"></i>
                            </div>
                            <span class="expertise-text">{{ $member->expertise }}</span>
                        </div>

                        <div class="card-sep"></div>

                        <p class="team-desc">{{ $member->description }}</p>

                        <div class="card-footer-row">
                            <span class="exp-pill">
                                <i class="fas fa-briefcase" style="font-size:0.7rem;"></i>
                                {{ $member->experience_years }}+ Years Experience
                            </span>
                        </div>
                    </div>

                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="team-empty">
            <i class="fas fa-users"></i>
            <p>Team members coming soon. Check back later!</p>
        </div>
        @endif

    </div>
</section>

<!-- ================================================================
     CTA
     ================================================================ -->
<section style="padding: 90px 0; background: #f0f2f8;">
    <div class="container">
        <div style="
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            border-radius: 24px;
            padding: 72px 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        ">
            <!-- Decorative blobs -->
            <div style="position:absolute;top:-80px;right:-80px;width:300px;height:300px;background:rgba(102,126,234,0.15);border-radius:50%;filter:blur(50px);"></div>
            <div style="position:absolute;bottom:-100px;left:-60px;width:350px;height:350px;background:rgba(118,75,162,0.12);border-radius:50%;filter:blur(60px);"></div>

            <h2 style="color:#fff;font-size:2.3rem;font-weight:900;margin-bottom:14px;position:relative;z-index:1;letter-spacing:-0.5px;">
                Want to Join Our Team?
            </h2>
            <p style="color:rgba(255,255,255,0.75);font-size:1.05rem;max-width:500px;margin:0 auto 36px;line-height:1.85;position:relative;z-index:1;">
                We're always looking for passionate developers and designers. Reach out and let's build something great together.
            </p>
            <a href="{{ route('contact') }}" style="
                display:inline-flex; align-items:center; gap:10px;
                padding:16px 46px;
                background: linear-gradient(135deg, #667eea, #764ba2);
                color:#fff;
                border-radius:50px;
                font-size:1rem;
                font-weight:700;
                text-decoration:none;
                position:relative; z-index:1;
                box-shadow: 0 8px 30px rgba(102,126,234,0.45);
                transition: all 0.3s ease;
                letter-spacing: 0.3px;
            "
            onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 18px 40px rgba(102,126,234,0.55)'"
            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 8px 30px rgba(102,126,234,0.45)'">
                <i class="fas fa-paper-plane"></i> Get In Touch
            </a>
        </div>
    </div>
</section>

@endsection
