@extends('main')
@section('main-container')

<style>
/* ============================================
   WELCOME / ABOUT SECTION — Professional
   ============================================ */

/* Section wrapper */
.welcome_area {
    background: #f4f6fb;
    position: relative;
    overflow: hidden;
}

/* Decorative blobs */
.welcome_area::before {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 380px; height: 380px;
    background: radial-gradient(circle, rgba(102,126,234,0.08) 0%, transparent 65%);
    border-radius: 50%;
    pointer-events: none;
}
.welcome_area::after {
    content: '';
    position: absolute;
    bottom: -80px; left: -60px;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(118,75,162,0.07) 0%, transparent 65%);
    border-radius: 50%;
    pointer-events: none;
}

/* ---- Left column card wrapper ---- */
.welcome_text {
    background: #ffffff;
    border-radius: 20px;
    padding: 44px 40px 40px;
    box-shadow: 0 8px 40px rgba(102,126,234,0.09), 0 2px 8px rgba(0,0,0,0.04);
    height: 100%;
    position: relative;
}

/* Accent bar on top of left card */
.welcome_text::before {
    content: '';
    position: absolute;
    top: 0; left: 40px; right: 40px;
    height: 4px;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    border-radius: 0 0 4px 4px;
}

/* ---- Section label pill ---- */
.about-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: linear-gradient(135deg, rgba(102,126,234,0.12), rgba(118,75,162,0.12));
    color: #667eea;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.8px;
    padding: 6px 16px;
    border-radius: 50px;
    margin-bottom: 16px;
}
.about-label i { font-size: 0.7rem; }

/* ---- Section title ---- */
.welcome_text > h4 {
    font-size: 1.65rem;
    font-weight: 800;
    color: #1a202c;
    position: relative;
    padding-bottom: 14px;
    margin-bottom: 18px;
    display: inline-block;
}
.welcome_text > h4::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0;
    width: 48px; height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 2px;
}

/* ---- Bio paragraph ---- */
.welcome_text > p {
    color: #5a6478;
    font-size: 0.95rem;
    line-height: 1.85;
    margin-bottom: 28px;
}
.welcome_text > p strong { color: #2d3748; }

/* ---- Company logo block ---- */
.about-logo-card {
    margin: 0 0 28px;
    padding: 20px;
    background: linear-gradient(135deg, rgba(102,126,234,0.06), rgba(118,75,162,0.06));
    border: 1px solid rgba(102,126,234,0.12);
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 180px;
}
.about-company-logo {
    display: block;
    width: 100%;
    max-width: 420px;
    max-height: 220px;
    object-fit: contain;
    filter: drop-shadow(0 8px 20px rgba(0,0,0,0.08));
}

/* ---- Tech chips ---- */
.about-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 32px;
}
.about-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 14px;
    background: #f7f8fc;
    border: 1.5px solid #e2e8f0;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
    color: #4a5568;
    cursor: default;
    transition: all 0.28s ease;
}
.about-chip i {
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 0.85rem;
}
.about-chip:hover {
    border-color: #667eea;
    background: rgba(102,126,234,0.06);
    color: #667eea;
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(102,126,234,0.14);
}

/* ---- Stat cards row ---- */
.welcome_stats_row {
    margin-bottom: 32px;
}
.wel_item {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    padding: 24px 12px 20px;
    text-align: center;
    position: relative;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 6px 24px rgba(102,126,234,0.28);
}
.wel_item::after {
    content: '';
    position: absolute;
    top: -30%; right: -20%;
    width: 100px; height: 100px;
    background: rgba(255,255,255,0.08);
    border-radius: 50%;
    pointer-events: none;
}
.wel_item:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 36px rgba(102,126,234,0.36);
}
.wel_item i {
    font-size: 1.6rem;
    color: rgba(255,255,255,0.85);
    display: block;
    margin-bottom: 8px;
}
.wel_item h4 {
    font-size: 1.7rem;
    font-weight: 900;
    color: #ffffff;
    margin-bottom: 4px;
    line-height: 1;
    /* Reset any gradient text from parent */
    background: none;
    -webkit-background-clip: unset;
    -webkit-text-fill-color: #ffffff;
    background-clip: unset;
}
.wel_item p {
    font-size: 0.72rem;
    color: rgba(255,255,255,0.8);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.9px;
    margin: 0;
}

/* ---- CTA button ---- */
.about-cta {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 12px 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #ffffff;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.88rem;
    letter-spacing: 0.3px;
    transition: all 0.3s ease;
    box-shadow: 0 8px 22px rgba(102,126,234,0.38);
}
.about-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 32px rgba(102,126,234,0.48);
    color: #ffffff;
    text-decoration: none;
}
.about-cta i { font-size: 0.8rem; transition: transform 0.3s ease; }
.about-cta:hover i { transform: translateX(4px); }

/* ============================================
   RIGHT COLUMN — Skills card
   ============================================ */
.tools_expert {
    background: #ffffff;
    border-radius: 20px;
    padding: 44px 40px 40px;
    box-shadow: 0 8px 40px rgba(102,126,234,0.09), 0 2px 8px rgba(0,0,0,0.04);
    height: 100%;
    position: relative;
}
.tools_expert::before {
    content: '';
    position: absolute;
    top: 0; left: 40px; right: 40px;
    height: 4px;
    background: linear-gradient(90deg, #764ba2 0%, #667eea 100%);
    border-radius: 0 0 4px 4px;
}

/* Skills label pill */
.skills-header {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: linear-gradient(135deg, rgba(102,126,234,0.12), rgba(118,75,162,0.12));
    color: #667eea;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.8px;
    padding: 6px 16px;
    border-radius: 50px;
    margin-bottom: 16px;
}

/* Skills title */
.tools_expert h4.skills-title {
    font-size: 1.65rem;
    font-weight: 800;
    color: #1a202c;
    position: relative;
    padding-bottom: 14px;
    margin-bottom: 30px;
    display: inline-block;
}
.tools_expert h4.skills-title::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0;
    width: 48px; height: 4px;
    background: linear-gradient(90deg, #764ba2, #667eea);
    border-radius: 2px;
}

/* Skill rows */
.skill_item {
    margin-bottom: 20px;
}
.skill_item:last-child { margin-bottom: 0; }

.skill_item h4 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.88rem;
    font-weight: 600;
    color: #2d3748;
    margin-bottom: 9px;
    /* Reset gradient text if inherited */
    background: none;
    -webkit-background-clip: unset;
    -webkit-text-fill-color: #2d3748;
    background-clip: unset;
}

/* Skill name + icon area */
.skill-label {
    display: flex;
    align-items: center;
    gap: 8px;
}
.skill-dot {
    width: 8px; height: 8px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    flex-shrink: 0;
}

/* Percentage badge */
.skill_item h4 .counter {
    font-size: 0.8rem;
    font-weight: 700;
    color: #ffffff;
    background: linear-gradient(135deg, #667eea, #764ba2);
    padding: 2px 9px;
    border-radius: 20px;
    -webkit-text-fill-color: #ffffff;
    display: inline-block;
    min-width: 44px;
    text-align: center;
}

/* Progress track */
.skill_item .progress {
    height: 9px;
    border-radius: 10px;
    background: #edf0f7;
    overflow: hidden;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.06);
}
.skill_item .progress-bar {
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    position: relative;
    transition: width 1.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}
/* Shine effect on bar */
.skill_item .progress-bar::after {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 40%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.22), transparent);
    border-radius: 10px;
}

/* ---- Equal-height columns on desktop ---- */
@media (min-width: 992px) {
    .welcome_inner { align-items: stretch !important; }
    .welcome_inner > [class*="col-"] { display: flex; flex-direction: column; }
    .welcome_text,
    .tools_expert { flex: 1; }

    /* Vertical spacing between sections */
    .welcome_area { padding-top: 90px; padding-bottom: 90px; }
}

/* ---- Tablet ---- */
@media (max-width: 991px) {
    .welcome_text,
    .tools_expert { padding: 36px 28px 32px; }
    .welcome_text { margin-bottom: 28px; }
    .welcome_text::before,
    .tools_expert::before { left: 28px; right: 28px; }
    .wel_item { margin-bottom: 14px; }
}

/* ---- Mobile ---- */
@media (max-width: 767px) {
    .welcome_text,
    .tools_expert { padding: 28px 20px 26px; border-radius: 16px; }
    .welcome_text::before,
    .tools_expert::before { left: 20px; right: 20px; }
    .about-chips { gap: 7px; }
    .about-logo-card { padding: 16px; min-height: 140px; }
}

/* ---- Extra small screens ---- */
@media (max-width: 575px) {
    .about-logo-card { min-height: 120px; }
}

/* ---- Stats cards — stack vertically on small screens ---- */
@media (max-width: 575px) {
    /* Turn the 3-col row into a single column stack */
    .welcome_stats_row {
        flex-direction: column !important;
        gap: 12px;
    }

    /* Each Bootstrap col takes full width */
    .welcome_stats_row > [class*="col-"] {
        flex: 0 0 100% !important;
        max-width: 100% !important;
        width: 100% !important;
    }

    /* Horizontal card layout: icon left, text right */
    .wel_item {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 18px 22px;
        border-radius: 16px;
        text-align: left;
    }

    .wel_item i {
        font-size: 2rem;
        margin-bottom: 0;
        flex-shrink: 0;
    }

    .wel_item h4 {
        font-size: 1.6rem;
        margin-bottom: 2px;
    }

    .wel_item p {
        font-size: 0.72rem;
        margin: 0;
    }
}

/* ---- Chips — evenly spaced on all screens ---- */
@media (max-width: 575px) {
    .about-chips {
        gap: 8px 6px;
    }
    .about-chip {
        font-size: 0.74rem;
        padding: 5px 10px;
        gap: 5px;
    }
}

/* ---- Entrance animations ---- */
@keyframes wa_fadeInLeft {
    from { opacity: 0; transform: translateX(-28px); }
    to   { opacity: 1; transform: translateX(0); }
}
@keyframes wa_fadeInRight {
    from { opacity: 0; transform: translateX(28px); }
    to   { opacity: 1; transform: translateX(0); }
}
.welcome_area .welcome_text { animation: wa_fadeInLeft  0.75s ease-out both; }
.welcome_area .tools_expert { animation: wa_fadeInRight 0.75s ease-out 0.18s both; }

@media (prefers-reduced-motion: reduce) {
    .welcome_area .welcome_text,
    .welcome_area .tools_expert { animation: none; }
}
</style>
        
        <!--================Home Banner Area =================-->

<style>
/* ===== BANNER ENHANCEMENT STYLES ===== */

/* Animated gradient background override */
.home_banner_area {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%) !important;
    background-size: 300% 300% !important;
    animation: gradientShift 8s ease infinite;
    overflow: hidden;
}

@keyframes gradientShift {
    0%   { background-position: 0% 50%; }
    50%  { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Floating particles */
.home_banner_area::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background:
        radial-gradient(circle at 20% 30%, rgba(255,255,255,0.06) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(255,255,255,0.05) 0%, transparent 50%),
        radial-gradient(circle at 50% 10%, rgba(255,255,255,0.04) 0%, transparent 40%);
    pointer-events: none;
    z-index: 0;
}

/* White card — keep existing shadow, add extra glow */
.home_banner_area .box_1620 {
    box-shadow: 0 30px 100px rgba(102,126,234,0.25), 0 10px 40px rgba(0,0,0,0.12) !important;
    position: relative;
    z-index: 1;
}

/* Smooth scroll behavior for mobile */
@media (max-width: 767px) {
    .home_banner_area {
        scroll-margin-top: 80px;
    }
}

/* === Photo frame === */
.home_banner_area .banner_inner .banner_content .media .d-flex {
    padding-right: 70px;
}

.banner-photo-wrap {
    position: relative;
    display: inline-block;
}

.banner-photo-wrap img {
    width: 220px;
    height: 280px;
    object-fit: cover;
    object-position: top;
    border-radius: 20px;
    display: block;
    box-shadow: 0 20px 50px rgba(102,126,234,0.3);
    animation: bannerFloat 4s ease-in-out infinite;
    position: relative;
    z-index: 1;
}

/* Decorative ring behind photo */
.banner-photo-wrap::before {
    content: '';
    position: absolute;
    inset: -10px;
    border-radius: 24px;
    background: linear-gradient(135deg, rgba(102,126,234,0.25) 0%, rgba(118,75,162,0.15) 100%);
    z-index: 0;
    animation: bannerFloat 4s ease-in-out infinite;
    animation-delay: 0.2s;
}

/* Decorative dot grid */
.banner-photo-wrap::after {
    content: '';
    position: absolute;
    width: 80px; height: 80px;
    bottom: -20px; right: -24px;
    background-image: radial-gradient(circle, rgba(102,126,234,0.35) 1.5px, transparent 1.5px);
    background-size: 12px 12px;
    z-index: 2;
    border-radius: 8px;
}

@keyframes bannerFloat {
    0%, 100% { transform: translateY(0px); }
    50%       { transform: translateY(-14px); }
}

/* === Text side === */
.personal_text h6 {
    font-size: 0.85rem !important;
    font-weight: 700 !important;
    text-transform: uppercase;
    letter-spacing: 3px;
    color: #667eea !important;
    margin-bottom: 10px !important;
    display: flex;
    align-items: center;
    gap: 10px;
}

.personal_text h6::before {
    content: '';
    width: 28px; height: 2px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 2px;
    flex-shrink: 0;
}

.personal_text h3 {
    font-size: 3rem !important;
    font-weight: 900 !important;
    color: #1a202c !important;
    line-height: 1.1 !important;
    margin-bottom: 10px !important;
    background: linear-gradient(135deg, #2d3748 0%, #4a5568 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Typing roles wrapper */
.typed-roles-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
}

.typed-roles-wrap .role-dot {
    width: 8px; height: 8px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 50%;
    flex-shrink: 0;
}

.personal_text h4 {
    font-size: 1.1rem !important;
    font-weight: 600 !important;
    color: #667eea !important;
    margin-bottom: 0 !important;
}

.personal_text > p {
    color: #718096 !important;
    font-size: 1rem !important;
    line-height: 1.8 !important;
    margin-bottom: 28px !important;
    max-width: 520px;
}

/* Info list */
.basic_info {
    display: flex;
    flex-wrap: wrap;
    gap: 8px 24px;
    margin-bottom: 28px !important;
}

.basic_info li a {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.88rem !important;
    color: #4a5568 !important;
    font-weight: 500;
    transition: all 0.3s ease;
    white-space: nowrap;
    min-height: 36px; /* Touch-friendly */
    padding: 4px 0;
    -webkit-tap-highlight-color: transparent;
}

.basic_info li a i {
    width: 28px; 
    height: 28px;
    min-width: 28px; /* Prevent shrinking */
    background: linear-gradient(135deg, rgba(102,126,234,0.1) 0%, rgba(118,75,162,0.1) 100%);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: transparent;
    background: linear-gradient(135deg, rgba(102,126,234,0.12), rgba(118,75,162,0.12));
    color: #667eea;
    font-size: 0.8rem;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.basic_info li a:hover { color: #667eea !important; }
.basic_info li a:hover i {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.basic_info li a:active i {
    transform: scale(0.95);
}

/* CTA Buttons row */
.banner-cta-row {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
    margin-bottom: 28px;
}

.banner-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 13px 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white !important;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 700;
    text-decoration: none !important;
    transition: all 0.3s ease;
    box-shadow: 0 8px 24px rgba(102,126,234,0.4);
    min-height: 44px; /* Touch-friendly minimum */
    -webkit-tap-highlight-color: transparent;
    user-select: none;
}

.banner-btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 35px rgba(102,126,234,0.5);
    color: white !important;
}

.banner-btn-primary:active {
    transform: translateY(-1px);
}

.banner-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 28px;
    background: transparent;
    color: #667eea !important;
    border: 2px solid #667eea;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 700;
    text-decoration: none !important;
    transition: all 0.3s ease;
    min-height: 44px; /* Touch-friendly minimum */
    -webkit-tap-highlight-color: transparent;
    user-select: none;
}

.banner-btn-outline:hover {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-color: transparent;
    color: white !important;
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(102,126,234,0.3);
}

.banner-btn-outline:active {
    transform: translateY(-1px);
}

/* Social icons */
.personal_social {
    display: flex !important;
    gap: 10px;
    margin-top: 0 !important;
}

.personal_social li a {
    width: 40px; 
    height: 40px;
    min-width: 40px; /* Prevent shrinking on mobile */
    min-height: 40px;
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(102,126,234,0.1), rgba(118,75,162,0.1));
    display: flex !important;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    font-size: 1rem !important;
    color: #667eea !important;
    -webkit-tap-highlight-color: transparent;
    user-select: none;
}

.personal_social li a:hover {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white !important;
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(102,126,234,0.4);
}

.personal_social li a:active {
    transform: translateY(-2px);
}

/* Available badge */
.available-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(16, 185, 129, 0.1);
    color: #059669;
    font-size: 0.78rem;
    font-weight: 700;
    padding: 5px 14px;
    border-radius: 50px;
    margin-bottom: 18px;
    border: 1.5px solid rgba(16,185,129,0.25);
}

.available-badge .pulse-dot {
    width: 8px; height: 8px;
    background: #10b981;
    border-radius: 50%;
    flex-shrink: 0;
    animation: pulseGreen 1.5s ease-in-out infinite;
}

@keyframes pulseGreen {
    0%, 100% { box-shadow: 0 0 0 0 rgba(16,185,129,0.4); }
    50%       { box-shadow: 0 0 0 6px rgba(16,185,129,0); }
}

/* Divider between info and social */
.banner-divider {
    width: 40px; height: 2px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 2px;
    margin-bottom: 20px;
}

/* Responsive */
@media (max-width: 1199px) {
    .home_banner_area .banner_inner .banner_content .media .d-flex { 
        padding-right: 50px; 
    }
    .banner-photo-wrap img { 
        width: 200px; 
        height: 260px; 
    }
}

@media (max-width: 991px) {
    .personal_text h3 { 
        font-size: 2.4rem !important; 
    }
    .banner-photo-wrap img { 
        width: 180px; 
        height: 230px; 
    }
    .home_banner_area .banner_inner .banner_content .media .d-flex { 
        padding-right: 40px; 
    }
    .personal_text > p {
        font-size: 0.95rem !important;
    }
}

@media (max-width: 767px) {
    /* Stack layout on mobile */
    .home_banner_area .banner_inner .banner_content .media {
        flex-direction: column;
        text-align: center;
    }
    
    .home_banner_area .banner_inner .banner_content .media .d-flex {
        padding-right: 0 !important;
        margin-bottom: 30px;
        display: flex;
        justify-content: center;
    }
    
    .banner-photo-wrap img { 
        width: 200px; 
        height: 260px; 
    }
    
    /* Center text content */
    .personal_text h6 {
        justify-content: center;
    }
    
    .personal_text h3 { 
        font-size: 2rem !important; 
    }
    
    .personal_text h4 {
        font-size: 1rem !important;
    }
    
    .personal_text > p {
        margin-left: auto;
        margin-right: auto;
    }
    
    /* Center buttons */
    .banner-cta-row { 
        justify-content: center;
        gap: 12px; 
    }
    
    /* Center divider */
    .banner-divider {
        margin-left: auto;
        margin-right: auto;
    }
    
    /* Center and adjust info list */
    .basic_info { 
        justify-content: center;
        gap: 8px 16px; 
    }
    
    .basic_info li a {
        font-size: 0.82rem !important;
    }
    
    /* Center social icons */
    .personal_social {
        justify-content: center !important;
    }
}

@media (max-width: 575px) {
    /* Extra small screens */
    .home_banner_area {
        margin-bottom: 120px;
    }
    
    .home_banner_area .box_1620 {
        bottom: -120px;
        padding: 20px !important;
        min-height: auto !important;
    }
    
    .home_banner_area .banner_inner {
        min-height: auto !important;
        padding: 20px 0;
    }
    
    .banner-photo-wrap img { 
        width: 160px; 
        height: 200px; 
    }
    
    .banner-photo-wrap::after {
        width: 60px;
        height: 60px;
        background-size: 10px 10px;
    }
    
    .personal_text h6 {
        font-size: 0.75rem !important;
        letter-spacing: 2px;
    }
    
    .personal_text h6::before {
        width: 20px;
    }
    
    .personal_text h3 { 
        font-size: 1.75rem !important; 
        margin-bottom: 8px !important;
    }
    
    .typed-roles-wrap .role-dot {
        width: 6px;
        height: 6px;
    }
    
    .personal_text h4 {
        font-size: 0.9rem !important;
    }
    
    .personal_text > p {
        font-size: 0.9rem !important;
        margin-bottom: 20px !important;
    }
    
    .available-badge {
        font-size: 0.7rem;
        padding: 4px 12px;
        margin-bottom: 14px;
    }
    
    .available-badge .pulse-dot {
        width: 6px;
        height: 6px;
    }
    
    /* Stack buttons vertically on very small screens */
    .banner-cta-row {
        flex-direction: column;
        width: 100%;
        gap: 10px;
    }
    
    .banner-btn-primary,
    .banner-btn-outline {
        width: 100%;
        max-width: 280px;
        justify-content: center;
        padding: 12px 24px;
        font-size: 0.85rem;
    }
    
    .basic_info {
        flex-direction: column;
        gap: 10px;
        align-items: center;
    }
    
    .basic_info li a {
        font-size: 0.8rem !important;
    }
    
    .basic_info li a i {
        width: 26px;
        height: 26px;
        font-size: 0.75rem;
    }
    
    .personal_social li a {
        width: 38px;
        height: 38px;
        font-size: 0.9rem !important;
    }
    
    .banner-divider {
        margin-top: 16px;
        margin-bottom: 16px;
    }
}

@media (max-width: 400px) {
    /* Ultra small phones */
    .banner-photo-wrap img { 
        width: 140px; 
        height: 180px; 
    }
    
    .personal_text h3 { 
        font-size: 1.5rem !important; 
    }
    
    .personal_text h4 {
        font-size: 0.85rem !important;
    }
    
    .banner-btn-primary,
    .banner-btn-outline {
        padding: 11px 20px;
        font-size: 0.8rem;
    }
}
</style>

        <section class="home_banner_area">
           	<div class="container box_1620">
           		<div class="banner_inner d-flex align-items-center">
					<div class="banner_content">
						<div class="media">
							<div class="d-flex">
								<div class="banner-photo-wrap">
									<img src="{{ asset('img/per.jpeg') }}" alt="Maaz Sikandar">
								</div>
							</div>
							<div class="media-body">
								<div class="personal_text">

									<!-- Available badge -->
									<div class="available-badge">
										<span class="pulse-dot"></span>
										Available for Work
									</div>

									<h6>Hello, I am</h6>
									<h3>Maaz Sikandar</h3>

									<div class="typed-roles-wrap">
										<span class="role-dot"></span>
										<h4 id="typed-role">UI Designer / Developer</h4>
									</div>

									<p>I turn ideas into powerful, scalable web applications — with clean code, elegant design, and a passion for delivering results that matter.</p>

									<!-- CTA Buttons -->
									<div class="banner-cta-row">
										<a href="{{ url('/portfolio') }}" class="banner-btn-primary">
											<i class="fa fa-eye"></i> View My Work
										</a>
										<a href="{{ url('/contact') }}" class="banner-btn-outline">
											<i class="fa fa-paper-plane"></i> Hire Me
										</a>
									</div>

									<div class="banner-divider"></div>

									<ul class="list basic_info">
										<li><a href="#"><i class="lnr lnr-calendar-full"></i> 20 March 2002</a></li>
										<li><a href="#"><i class="lnr lnr-phone-handset"></i> +923015878068</a></li>
										<li><a href="#"><i class="lnr lnr-envelope"></i> sikandarmaaz95@gmail.com</a></li>
										<li><a href="#"><i class="lnr lnr-home"></i> Malakand Sakhakot, Pakistan</a></li>
									</ul>

									<ul class="list personal_social">
										<li><a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
										<li><a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a></li>
										<li><a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a></li>
										<li><a href="#" aria-label="GitHub"><i class="fa-brands fa-github"></i></a></li>
									</ul>

								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
        </section>

<script>
// Simple role typing cycle
(function() {
    var roles = ["UI Designer", "Full-Stack Developer", "Laravel Expert", "Web Craftsman"];
    var el = document.getElementById("typed-role");
    if (!el) return;
    
    // Detect reduced motion preference
    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) {
        el.textContent = roles[0]; // Just show first role
        return;
    }
    
    var i = 0, charIdx = 0, deleting = false;
    
    function tick() {
        var current = roles[i];
        if (!deleting) {
            el.textContent = current.substring(0, charIdx + 1);
            charIdx++;
            if (charIdx === current.length) { 
                deleting = true; 
                setTimeout(tick, 1600); 
                return; 
            }
        } else {
            el.textContent = current.substring(0, charIdx - 1);
            charIdx--;
            if (charIdx === 0) { 
                deleting = false; 
                i = (i + 1) % roles.length; 
            }
        }
        setTimeout(tick, deleting ? 60 : 90);
    }
    
    setTimeout(tick, 600);
})();

// Disable float animation on low-end devices
(function() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        var style = document.createElement('style');
        style.textContent = '.banner-photo-wrap img, .banner-photo-wrap::before { animation: none !important; }';
        document.head.appendChild(style);
    }
})();
</script>

        <!--================End Home Banner Area =================-->
        
        <!--================Welcome Area =================-->
        <section class="welcome_area p_120">
        	<div class="container">
        		<div class="row welcome_inner align-items-center">
        			<div class="col-lg-6">
        				<div class="welcome_text">

        					<div class="about-label">
        						<i class="fa fa-user"></i> About Me
        					</div>

        					<h4>About Myself</h4>
        					<p>I'm a passionate Software Developer with <strong>6+ years of experience</strong> building modern, responsive web applications. I specialize in frontend technologies like React, Bootstrap, and Tailwind, along with backend development using Laravel. I focus on writing clean, efficient code and creating user-friendly digital experiences that solve real-world problems.</p>

        					<div class="about-logo-card">
							<img src="{{ asset('img/company logo.png') }}" alt="Company Logo" class="about-company-logo">
						</div>

						<div class="about-chips">
        						<span class="about-chip"><i class="fa-brands fa-laravel"></i> Laravel</span>
        						<span class="about-chip"><i class="fa-brands fa-react"></i> React</span>
        						<span class="about-chip"><i class="fa-brands fa-php"></i> PHP</span>
        						<span class="about-chip"><i class="fa-brands fa-js"></i> JavaScript</span>
        						<span class="about-chip"><i class="fa-brands fa-python"></i> Python</span>
        						<span class="about-chip"><i class="fa-solid fa-database"></i> MySQL</span>
        					</div>

        					<div class="row g-3 welcome_stats_row">
        						<div class="col-4">
        							<div class="wel_item">
        								<i class="lnr lnr-database"></i>
        								<h4>30k+</h4>
        								<p>Lines of Code</p>
        							</div>
        						</div>
        						<div class="col-4">
        							<div class="wel_item">
        								<i class="lnr lnr-book"></i>
        								<h4>60+</h4>
        								<p>Projects Done</p>
        							</div>
        						</div>
        						<div class="col-4">
        							<div class="wel_item">
        								<i class="lnr lnr-users"></i>
        								<h4>15+</h4>
        								<p>Happy Clients</p>
        							</div>
        						</div>
        					</div>

        					<a href="{{ url('/about-us') }}" class="about-cta">
        						<i class="fa fa-arrow-right"></i> More About Me
        					</a>

        				</div>
        			</div>
        			<div class="col-lg-6">
        				<div class="tools_expert">

        					<div class="skills-header">
        						<i class="fa fa-chart-bar"></i> My Skills
        					</div>

        					<h4 class="skills-title">Technical Expertise</h4>

        					<div class="skill_main">
        						<div class="skill_item">
        							<h4><span class="skill-label"><span class="skill-dot"></span>Full Stack Web Development</span> <span class="counter">95</span></h4>
        							<div class="progress_br">
        								<div class="progress">
        									<div class="progress-bar" role="progressbar" style="width:95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
        								</div>
        							</div>
        						</div>
        						<div class="skill_item">
        							<h4><span class="skill-label"><span class="skill-dot"></span>Laravel Development</span> <span class="counter">95</span></h4>
        							<div class="progress_br">
        								<div class="progress">
        									<div class="progress-bar" role="progressbar" style="width:95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
        								</div>
        							</div>
        						</div>
        						<div class="skill_item">
        							<h4><span class="skill-label"><span class="skill-dot"></span>Web Designing</span> <span class="counter">90</span></h4>
        							<div class="progress_br">
        								<div class="progress">
        									<div class="progress-bar" role="progressbar" style="width:90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
        								</div>
        							</div>
        						</div>
        						<div class="skill_item">
        							<h4><span class="skill-label"><span class="skill-dot"></span>Backend Development</span> <span class="counter">92</span></h4>
        							<div class="progress_br">
        								<div class="progress">
        									<div class="progress-bar" role="progressbar" style="width:92%" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
        								</div>
        							</div>
        						</div>
        						<div class="skill_item">
        							<h4><span class="skill-label"><span class="skill-dot"></span>SEO Optimization</span> <span class="counter">75</span></h4>
        							<div class="progress_br">
        								<div class="progress">
        									<div class="progress-bar" role="progressbar" style="width:75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
        								</div>
        							</div>
        						</div>
        					</div>

        				</div>
        			</div>
        		</div>
        	</div>
        </section>
        <!--================End Welcome Area =================-->
        
        <!--================My Tabs Area =================-->
       <section class="mytabs_area p_120">
    <div class="container">
        <div class="tabs_inner">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab">My Experiences</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab">My Education</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">

                <!-- EXPERIENCE -->
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <ul class="list">

                        <li>
                            <span></span>
                            <div class="media">
                                <div class="d-flex">
                                    <p>2022 - 2024</p>
                                </div>
                                <div class="media-body">
                                    <h4>Full Stack Web Developer</h4>
                                    <p>Scholars Academy (Peshawar & Dargai)<br />
                                    Developed academic and commercial web applications using modern frontend and backend technologies</p>
                                </div>
                            </div>
                        </li>

                        <li>
                            <span></span>
                            <div class="media">
                                <div class="d-flex">
                                    <p>2023 - 2024</p>
                                </div>
                                <div class="media-body">
                                    <h4>Backend Web Developer</h4>
                                    <p>Secretariat, Irrigation Department – Peshawar<br />
                                    Developed internal web-based systems under supervision of Assistant Director IT</p>
                                </div>
                            </div>
                        </li>

                        <li>
                            <span></span>
                            <div class="media">
                                <div class="d-flex">
                                    <p>Present</p>
                                </div>
                                <div class="media-body">
                                    <h4>Full Stack Web Developer</h4>
                                    <p>PSEB Apprenticeship Program (Pakistan Software Export Board)<br />
                                    Developing and maintaining modern web applications with real-world project experience</p>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>

                <!-- EDUCATION (kept same as before unless you want update again) -->
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="list">

                        <li>
                            <span></span>
                            <div class="media">
                                <div class="d-flex">
                                    <p>2020 - 2024</p>
                                </div>
                                <div class="media-body">
                                    <h4>Bachelor of Science in Software Engineering</h4>
                                    <p>Abasyn University Peshawar</p>
                                </div>
                            </div>
                        </li>

                        <li>
                            <span></span>
                            <div class="media">
                                <div class="d-flex">
                                    <p>2023 - 2024</p>
                                </div>
                                <div class="media-body">
                                    <h4>Diploma in Information Technology (DIT)</h4>
                                    <p>AppTech Institute Peshawar</p>
                                </div>
                            </div>
                        </li>

                        <li>
                            <span></span>
                            <div class="media">
                                <div class="d-flex">
                                    <p>2018 - 2020</p>
                                </div>
                                <div class="media-body">
                                    <h4>FSc Pre-Engineering</h4>
                                    <p>Government Higher Secondary School</p>
                                </div>
                            </div>
                        </li>

                        <li>
                            <span></span>
                            <div class="media">
                                <div class="d-flex">
                                    <p>2016 - 2018</p>
                                </div>
                                <div class="media-body">
                                    <h4>Matriculation (Science)</h4>
                                    <p>Allama Iqbal Model School Sakhakot</p>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>

            </div>

        </div>
    </div>
</section>
<style>
	.tabs_inner .list li {
    position: relative;
    padding-left: 25px;
    margin-bottom: 30px;
}

/* Vertical timeline line */
.tabs_inner .list li::before {
    content: "";
    position: absolute;
    left: 0;
    top: 5px;
    width: 2px;
    height: 100%;
    background: #ddd;
}

/* Circle point */
.tabs_inner .list li span {
    position: absolute;
    left: -5px;
    top: 5px;
    width: 12px;
    height: 12px;
    background: #007bff;
    border-radius: 50%;
    z-index: 2;
}

/* Desktop improvement */
@media (min-width: 992px) {
    .tabs_inner .media {
        align-items: flex-start;
    }

    .tabs_inner .media-body h4 {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .tabs_inner .media-body p {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }

    .tabs_inner .d-flex p {
        font-weight: 500;
        color: #333;
        min-width: 140px;
    }
}
</style>
        <!--================End My Tabs Area =================-->
        
        <!--================Feature Area =================-->
        <section class="feature_area p_120">
    <div class="container">

        <div class="main_title">
            <h2>offerings to my clients</h2>
            <p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see some for as low as $.17 each.</p>
        </div>

        <div class="feature_inner row">

            <div class="col-lg-4 col-md-6">
                <div class="feature_item">
                    <i class="fa-brands fa-laravel"></i>
                    <h4>Laravel</h4>
                    <p>Focused on performance and reliability, I develop modern Laravel solutions tailored to real-world business needs.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature_item">
                    <i class="fa-brands fa-js"></i>
                    <h4>Web Designer</h4>
                    <p>Focused on modern UI behavior, I bring designs to life with smooth functionality and responsive interactions.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="feature_item">
                    <i class="fa-brands fa-php"></i>
                    <h4>PHP</h4>
                    <p>Skilled in backend development, I build secure and scalable solutions using core PHP and modern practices.</p>
                </div>
            </div>

        </div>

        <!-- BUTTON BELOW SERVICES -->
        <div class="text-center mt-4">
            <a href="{{ url('/services') }}" class="main_btn">
                View All Services
            </a>
        </div>

    </div>
</section>
        <!--================End Feature Area =================-->
        
        <!--================Home Gallery Area =================-->
 

        <!--================End Home Gallery Area =================-->
        
        <!--================Testimonials Area =================-->
        <!-- <section class="testimonials_area p_120">
        	<div class="container">
        		<div class="main_title">
        			<h2>Testimonials</h2>
        			<p>If you are looking at blank cassettes on the web, you may be very confused at the difference in price. You may see some for as low as $.17 each.</p>
        		</div>
        		<div class="testi_inner">
					<div class="testi_slider owl-carousel">
						<div class="item">
							<div class="testi_item">
								<p>As conscious traveling Paup ers we must always be oncerned about our dear Mother Earth. If you think about it, you travel across her face</p>
								<h4>Fanny Spencer</h4>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star-half-o"></i></a>
							</div>
						</div>
						<div class="item">
							<div class="testi_item">
								<p>As conscious traveling Paup ers we must always be oncerned about our dear Mother Earth. If you think about it, you travel across her face</p>
								<h4>Fanny Spencer</h4>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star-half-o"></i></a>
							</div>
						</div>
						<div class="item">
							<div class="testi_item">
								<p>As conscious traveling Paup ers we must always be oncerned about our dear Mother Earth. If you think about it, you travel across her face</p>
								<h4>Fanny Spencer</h4>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star"></i></a>
								<a href="#"><i class="fa fa-star-half-o"></i></a>
							</div>
						</div>
					</div>
        		</div>
        	</div>
        </section> -->

		 @endsection
        <!--================End Testimonials Area =================-->
        
      