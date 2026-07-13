<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Maaz Sikandar — Full Stack Developer</title>

    <link rel="icon" type="image/png" href="{{ asset('img/company logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/company logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/company logo.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <!-- Vendors -->
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/animate-css/animate.css">
    <link rel="stylesheet" href="vendors/popup/magnific-popup.css">
    <link rel="stylesheet" href="vendors/flaticon/flaticon.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <style>
    /* ================================================
       BASE HEADER
    ================================================ */
    .header_area {
        position: fixed !important;
        top: 0; left: 0;
        width: 100%;
        z-index: 1000;
        transition: box-shadow 0.25s ease;
    }
    .header_area .main_menu { background: #fff; }
    .header_area.navbar_fixed .main_menu {
        background: #fff !important;
        box-shadow: 0 2px 16px rgba(0,0,0,0.09) !important;
    }

    /* ================================================
       LOGO
    ================================================ */
    .nav-logo {
        display: inline-flex;
        align-items: center;
        gap: 2px;
        text-decoration: none !important;
        line-height: 1;
        padding: 6px 0;
        flex-shrink: 0;
    }
    .nav-logo .logo-bracket {
        font-size: 1.4rem; font-weight: 900;
        background: linear-gradient(90deg, #ff6b9d, #feca57);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        font-family: 'Courier New', monospace;
    }
    .nav-logo .logo-name {
        font-size: 1.25rem; font-weight: 800;
        background: linear-gradient(90deg, #00d4ff, #0099ff, #667eea, #a78bfa);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        font-family: 'Segoe UI', system-ui, sans-serif;
        letter-spacing: -0.5px;
    }
    .nav-logo .logo-dot {
        font-size: 1.7rem; font-weight: 900;
        background: linear-gradient(90deg, #feca57, #ff6b9d);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-left: 1px;
    }

    /* ================================================
       DESKTOP NAV  (≥ 992px)
    ================================================ */
    .nav-desktop {
        display: none;
        align-items: center;
        gap: 2px;
        margin-left: auto;
    }
    @media (min-width: 992px) {
        .nav-desktop { display: flex; }
        .nav-mobile-toggler { display: none !important; }
    }

    .nav-desktop .nd-link {
        font-size: 0.73rem;
        font-weight: 700;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        color: #555;
        text-decoration: none;
        padding: 0 10px;
        line-height: 80px;
        position: relative;
        white-space: nowrap;
        transition: color 0.2s;
    }
    .nav-desktop .nd-link::after {
        content: '';
        position: absolute;
        bottom: 17px; left: 10px;
        width: 0; height: 2px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
        transition: width 0.2s;
    }
    .nav-desktop .nd-link:hover,
    .nav-desktop .nd-link.active {
        color: #667eea;
    }
    .nav-desktop .nd-link:hover::after,
    .nav-desktop .nd-link.active::after {
        width: calc(100% - 20px);
    }

    /* Hire Me — desktop pill */
    .btn-hire-me {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-left: 10px;
        padding: 0 16px;
        height: 36px;
        border-radius: 8px;
        font-size: 0.73rem;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: #fff !important;
        text-decoration: none;
        background: linear-gradient(135deg, #667eea, #764ba2);
        box-shadow: 0 4px 14px rgba(102,126,234,0.35);
        white-space: nowrap;
        transition: transform 0.2s, box-shadow 0.2s;
        flex-shrink: 0;
    }
    .btn-hire-me::before { content: '↗'; font-size: 0.8rem; }
    .btn-hire-me:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102,126,234,0.45);
        color: #fff !important;
    }

    /* Scrolled: shrink line-height */
    .header_area.navbar_fixed .nav-desktop .nd-link {
        line-height: 70px;
    }
    .header_area.navbar_fixed .nav-desktop .nd-link::after {
        bottom: 14px;
    }

    /* Mid-range: tighten up at 992–1200 */
    @media (min-width: 992px) and (max-width: 1200px) {
        .nav-desktop .nd-link {
            font-size: 0.68rem;
            letter-spacing: 0.3px;
            padding: 0 7px;
        }
        .nav-desktop .nd-link::after { left: 7px; }
        .nav-desktop .nd-link:hover::after,
        .nav-desktop .nd-link.active::after { width: calc(100% - 14px); }
        .btn-hire-me { padding: 0 12px; font-size: 0.68rem; margin-left: 6px; }
    }

    /* ================================================
       DESKTOP NAVBAR WRAPPER
    ================================================ */
    .navbar-desktop-inner {
        display: flex;
        align-items: center;
        width: 100%;
        height: 80px;
        padding: 0 15px;
    }
    .header_area.navbar_fixed .navbar-desktop-inner { height: 70px; }

    /* ================================================
       MOBILE TOGGLER BUTTON  (< 992px)
    ================================================ */
    .nav-mobile-toggler {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
        width: 42px; height: 42px;
        margin-left: auto;
        background: rgba(102,126,234,0.08);
        border: 1.5px solid rgba(102,126,234,0.28);
        border-radius: 8px;
        cursor: pointer;
        flex-shrink: 0;
    }
    .nav-mobile-toggler .bar {
        display: block;
        width: 22px; height: 2px;
        background: #667eea;
        border-radius: 2px;
        transition: transform 0.25s, opacity 0.25s;
        transform-origin: center;
    }
    .nav-mobile-toggler.is-open .bar:nth-child(1) { transform: translateY(7px) rotate(45deg); }
    .nav-mobile-toggler.is-open .bar:nth-child(2) { opacity: 0; transform: scaleX(0); }
    .nav-mobile-toggler.is-open .bar:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

    /* ================================================
       MOBILE DRAWER  (< 992px)
    ================================================ */
    .nav-mobile-drawer {
        position: fixed;
        top: 0; right: 0;
        width: min(320px, 90vw);
        height: 100vh;
        background: #fff;
        box-shadow: -8px 0 40px rgba(0,0,0,0.15);
        z-index: 1100;
        display: flex;
        flex-direction: column;
        transform: translateX(110%);
        transition: transform 0.32s cubic-bezier(0.4,0,0.2,1);
        overflow-y: auto;
    }
    .nav-mobile-drawer.is-open {
        transform: translateX(0);
    }

    /* Drawer overlay */
    .nav-drawer-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15,23,42,0.45);
        backdrop-filter: blur(3px);
        z-index: 1099;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s;
    }
    .nav-drawer-overlay.is-open {
        opacity: 1;
        pointer-events: all;
    }

    /* Drawer header */
    .drawer-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 22px 14px;
        border-bottom: 1px solid #f1f5f9;
    }
    .drawer-close {
        width: 36px; height: 36px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 8px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        cursor: pointer;
        color: #64748b;
        font-size: 18px;
        transition: all 0.2s;
        flex-shrink: 0;
    }
    .drawer-close:hover { background: #fee2e2; color: #ef4444; border-color: #fca5a5; }

    /* Drawer nav links */
    .drawer-nav { padding: 12px 14px; flex: 1; }
    .drawer-nav a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 13px 14px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        text-decoration: none;
        transition: all 0.18s;
        letter-spacing: 0.2px;
    }
    .drawer-nav a i {
        width: 18px;
        text-align: center;
        font-size: 15px;
        color: #94a3b8;
        flex-shrink: 0;
        transition: color 0.18s;
    }
    .drawer-nav a:hover {
        background: #f8faff;
        color: #667eea;
    }
    .drawer-nav a:hover i { color: #667eea; }
    .drawer-nav a.active {
        background: rgba(102,126,234,0.10);
        color: #667eea;
    }
    .drawer-nav a.active i { color: #667eea; }
    .drawer-nav .nav-divider {
        height: 1px;
        background: #f1f5f9;
        margin: 8px 0;
    }

    /* Hire Me — drawer CTA */
    .drawer-hire-me {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin: 8px 14px 0;
        padding: 14px 20px;
        border-radius: 12px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff !important;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: 0.5px;
        text-decoration: none;
        box-shadow: 0 6px 20px rgba(102,126,234,0.38);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .drawer-hire-me:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(102,126,234,0.48);
        color: #fff !important;
    }
    .drawer-hire-me i { font-size: 16px; }

    /* Drawer footer */
    .drawer-footer {
        padding: 16px 22px 24px;
        border-top: 1px solid #f1f5f9;
        margin-top: 12px;
    }
    .drawer-footer p {
        font-size: 11px;
        color: #94a3b8;
        text-align: center;
        margin: 0;
    }

    /* ================================================
       HIDE old Bootstrap collapse on all sizes
    ================================================ */
    #navbarSupportedContent { display: none !important; }
    </style>
</head>

<body>

<!-- ════════════════════════════════════════════════════
     MOBILE DRAWER OVERLAY
════════════════════════════════════════════════════ -->
<div class="nav-drawer-overlay" id="drawerOverlay" onclick="closeDrawer()"></div>

<!-- ════════════════════════════════════════════════════
     MOBILE DRAWER
════════════════════════════════════════════════════ -->
<nav class="nav-mobile-drawer" id="mobileDrawer" role="dialog" aria-label="Navigation menu">

    <!-- Drawer Header -->
    <div class="drawer-header">
        <a class="nav-logo" href="{{ route('home') }}" onclick="closeDrawer()">
            <span class="logo-bracket">{</span>
            <span class="logo-name">CodeEdge <span style="-webkit-text-fill-color:#0099ff;">Labs</span></span>
            <span class="logo-bracket">}</span>
            <span class="logo-dot">&nbsp;.</span>
        </a>
        <button class="drawer-close" onclick="closeDrawer()" aria-label="Close menu">
            <i class="fa fa-xmark"></i>
        </button>
    </div>

    <!-- Hire Me — prominent CTA at top -->
    <div style="padding: 14px 14px 4px;">
        <a href="{{ route('contact') }}" class="drawer-hire-me" onclick="closeDrawer()">
            <i class="fa fa-arrow-up-right-from-square"></i>
            Hire Me
        </a>
    </div>

    <!-- Nav Links -->
    <div class="drawer-nav">
        <div class="nav-divider" style="margin-top:4px;"></div>

        <a href="{{ route('home') }}"
           class="{{ Route::currentRouteName() === 'home' ? 'active' : '' }}"
           onclick="closeDrawer()">
            <i class="fa fa-house"></i> Home
        </a>

        <a href="{{ route('about-us') }}"
           class="{{ Route::currentRouteName() === 'about-us' ? 'active' : '' }}"
           onclick="closeDrawer()">
            <i class="fa fa-user"></i> About
        </a>

        <a href="{{ route('team') }}"
           class="{{ Route::currentRouteName() === 'team' ? 'active' : '' }}"
           onclick="closeDrawer()">
            <i class="fa fa-users"></i> Our Team
        </a>

        <a href="{{ route('portfolio') }}"
           class="{{ Route::currentRouteName() === 'portfolio' ? 'active' : '' }}"
           onclick="closeDrawer()">
            <i class="fa fa-folder-open"></i> Projects
        </a>

        <a href="{{ route('services') }}"
           class="{{ Route::currentRouteName() === 'services' ? 'active' : '' }}"
           onclick="closeDrawer()">
            <i class="fa fa-briefcase"></i> Services
        </a>

        <a href="{{ route('blog') }}"
           class="{{ Route::currentRouteName() === 'blog' ? 'active' : '' }}"
           onclick="closeDrawer()">
            <i class="fa fa-newspaper"></i> Blog
        </a>

        <a href="{{ route('contact') }}"
           class="{{ Route::currentRouteName() === 'contact' ? 'active' : '' }}"
           onclick="closeDrawer()">
            <i class="fa fa-envelope"></i> Contact
        </a>

        <a href="{{ route('careers') }}"
           class="{{ Route::currentRouteName() === 'careers' ? 'active' : '' }}"
           onclick="closeDrawer()">
            <i class="fa fa-person-chalkboard"></i> Careers
        </a>
    </div>

    <!-- Footer -->
    <div class="drawer-footer">
        <p>© {{ date('Y') }} CodeEdge Labs — All rights reserved</p>
    </div>

</nav>

<!-- ════════════════════════════════════════════════════
     HEADER
════════════════════════════════════════════════════ -->
<header class="header_area">
    <div class="main_menu">
        <div class="container box_1620">
            <div class="navbar-desktop-inner">

                <!-- LOGO -->
                <a class="nav-logo" href="{{ route('home') }}">
                    <span class="logo-bracket">{</span>
                    <span class="logo-name">CodeEdge <span style="-webkit-text-fill-color:#0099ff;">Labs</span></span>
                    <span class="logo-bracket">}</span>
                    <span class="logo-dot">&nbsp;.</span>
                </a>

                <!-- ── DESKTOP NAV ── -->
                <nav class="nav-desktop" aria-label="Main navigation">
                    <a href="{{ route('home') }}"
                       class="nd-link {{ Route::currentRouteName() === 'home' ? 'active' : '' }}">Home</a>
                    <a href="{{ route('about-us') }}"
                       class="nd-link {{ Route::currentRouteName() === 'about-us' ? 'active' : '' }}">About</a>
                    <a href="{{ route('team') }}"
                       class="nd-link {{ Route::currentRouteName() === 'team' ? 'active' : '' }}">Our Team</a>
                    <a href="{{ route('portfolio') }}"
                       class="nd-link {{ Route::currentRouteName() === 'portfolio' ? 'active' : '' }}">Projects</a>
                    <a href="{{ route('services') }}"
                       class="nd-link {{ Route::currentRouteName() === 'services' ? 'active' : '' }}">Services</a>
                    <a href="{{ route('blog') }}"
                       class="nd-link {{ Route::currentRouteName() === 'blog' ? 'active' : '' }}">Blog</a>
                    <a href="{{ route('contact') }}"
                       class="nd-link {{ Route::currentRouteName() === 'contact' ? 'active' : '' }}">Contact</a>
                    <a href="{{ route('careers') }}"
                       class="nd-link {{ Route::currentRouteName() === 'careers' ? 'active' : '' }}">Careers</a>

                    <!-- Hire Me pill -->
                    <a href="{{ route('contact') }}" class="btn-hire-me">Hire Me</a>
                </nav>

                <!-- ── MOBILE TOGGLER ── -->
                <button class="nav-mobile-toggler" id="drawerToggler"
                        onclick="openDrawer()" aria-label="Open menu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>

            </div>
        </div>
    </div>
</header>

<!-- ════════════════════════════════════════════════════
     DRAWER SCRIPT
════════════════════════════════════════════════════ -->
<script>
(function () {
    var drawer  = document.getElementById('mobileDrawer');
    var overlay = document.getElementById('drawerOverlay');
    var toggler = document.getElementById('drawerToggler');

    function openDrawer() {
        drawer.classList.add('is-open');
        overlay.classList.add('is-open');
        toggler.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        drawer.classList.remove('is-open');
        overlay.classList.remove('is-open');
        toggler.classList.remove('is-open');
        document.body.style.overflow = '';
    }

    // Expose globally so inline onclick works
    window.openDrawer  = openDrawer;
    window.closeDrawer = closeDrawer;

    // Close on Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeDrawer();
    });
})();
</script>

</body>
</html>
