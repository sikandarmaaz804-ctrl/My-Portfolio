<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Maaz Sikandar — Full Stack Developer</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/company logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/company logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/company logo.png') }}">

    <!-- Bootstrap CSS (KEEP ORIGINAL) -->
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

    <!-- SweetAlert2 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

    <style>
    /* ============================================
       NAVBAR — Fast, Light, No-Flicker
       ============================================ */

    .header_area {
        position: fixed !important;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 999;
        transition: box-shadow 0.25s ease;
    }

    .header_area .main_menu {
        background: #fff;
    }

    .header_area .navbar {
        padding: 0 !important;
    }

    /* Scrolled state */
    .header_area.navbar_fixed .main_menu {
        background: #fff !important;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08) !important;
    }

    /* ---- Logo ---- */
    .nav-logo {
        display: inline-flex;
        align-items: center;
        gap: 2px;
        text-decoration: none !important;
        line-height: 1;
        padding: 6px 0;
    }

    .nav-logo .logo-bracket {
        font-size: 1.45rem;
        font-weight: 900;
        background: linear-gradient(90deg, #ff6b9d, #feca57);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-family: 'Courier New', monospace;
        line-height: 1;
    }

    .nav-logo .logo-name {
        font-size: 1.3rem;
        font-weight: 800;
        background: linear-gradient(90deg, #00d4ff, #0099ff, #667eea, #a78bfa);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-family: 'Segoe UI', system-ui, sans-serif;
        letter-spacing: -0.5px;
        line-height: 1;
    }

    .nav-logo .logo-dot {
        font-size: 1.8rem;
        font-weight: 900;
        background: linear-gradient(90deg, #feca57, #ff6b9d);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        margin-left: 1px;
    }

    /* ---- Nav links (desktop) ---- */
    .header_area .navbar .nav .nav-item .nav-link {
        font-size: 0.82rem !important;
        font-weight: 700 !important;
        letter-spacing: 0.8px !important;
        text-transform: uppercase;
        color: #555 !important;
        position: relative;
        padding: 0 !important;
        line-height: 80px !important;
        transition: color 0.2s ease !important;
    }

    .header_area .navbar .nav .nav-item .nav-link::after {
        content: '';
        display: block;
        position: absolute;
        bottom: 18px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
        transition: width 0.2s ease !important;
    }

    .header_area .navbar .nav .nav-item.active .nav-link {
        color: #667eea !important;
    }
    .header_area .navbar .nav .nav-item.active .nav-link::after {
        width: 100%;
    }

    .header_area .navbar .nav .nav-item:not(.active):hover .nav-link {
        color: #667eea !important;
    }
    .header_area .navbar .nav .nav-item:not(.active):hover .nav-link::after {
        width: 100%;
    }

    .header_area.navbar_fixed .main_menu .navbar .nav .nav-item .nav-link {
        line-height: 70px !important;
    }
    .header_area.navbar_fixed .main_menu .navbar .nav .nav-item .nav-link::after {
        bottom: 14px;
    }

    /* ---- Hire Me button ---- */
    .header_area .navbar .nav .nav-item.hire-me-item {
        display: flex;
        align-items: center;
        margin-left: 10px;
    }
    .header_area .navbar .nav .nav-item.hire-me-item .nav-link {
        display: inline-flex !important;
        align-items: center;
        gap: 6px;
        padding: 0 18px !important;
        height: 36px !important;
        line-height: 36px !important;
        border-radius: 8px !important;
        font-size: 0.78rem !important;
        font-weight: 700 !important;
        letter-spacing: 1px !important;
        text-transform: uppercase;
        color: #fff !important;
        background: linear-gradient(135deg, #667eea, #764ba2);
        transition: transform 0.2s ease, box-shadow 0.2s ease !important;
        white-space: nowrap;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    .header_area .navbar .nav .nav-item.hire-me-item .nav-link::before {
        content: '↗';
        font-size: 0.82rem;
        line-height: 1;
    }
    .header_area .navbar .nav .nav-item.hire-me-item .nav-link::after {
        display: none !important;
    }
    .header_area .navbar .nav .nav-item.hire-me-item .nav-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(102, 126, 234, 0.4) !important;
    }

    /* ============================================
       MOBILE TOGGLER — Pure CSS, no flicker
       ============================================ */
    .navbar-toggler {
        border: 1.5px solid rgba(102, 126, 234, 0.3) !important;
        outline: none !important;
        box-shadow: none !important;
        padding: 6px !important;
        background: rgba(102, 126, 234, 0.08) !important;
        border-radius: 8px !important;
        width: 42px;
        height: 42px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }
    .navbar-toggler .icon-bar {
        display: block;
        width: 22px;
        height: 2px;
        background: #667eea;
        border-radius: 2px;
        transition: transform 0.25s ease, opacity 0.25s ease;
        transform-origin: center;
    }
    /* Animate to X when open */
    .navbar-toggler[aria-expanded="true"] .icon-bar:nth-child(1) {
        transform: translateY(7px) rotate(45deg);
    }
    .navbar-toggler[aria-expanded="true"] .icon-bar:nth-child(2) {
        opacity: 0;
        transform: scaleX(0);
    }
    .navbar-toggler[aria-expanded="true"] .icon-bar:nth-child(3) {
        transform: translateY(-7px) rotate(-45deg);
    }

    /* ============================================
       MOBILE DROPDOWN — Fast CSS transition
       ============================================ */

    /* Desktop: always show the nav */
    @media (min-width: 992px) {
        .header_area #navbarSupportedContent {
            display: flex !important;
            max-height: none !important;
        }
    }

    /* Mobile: hidden by default, slides open on toggle */
    @media (max-width: 991px) {
        /* Override Bootstrap background */
        .header_area .main_menu,
        .header_area .navbar {
            background: #fff !important;
        }

        .header_area #navbarSupportedContent {
            display: block !important;
            overflow: hidden !important;
            max-height: 0 !important;
            background: #fff;
            border-radius: 0 0 14px 14px;
            padding: 0 16px !important;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            transition: max-height 0.3s ease !important;
            width: 100%;
        }
        .header_area #navbarSupportedContent.nav-open {
            max-height: 600px !important;
            padding: 8px 16px 14px !important;
        }

        /* Nav links on mobile */
        .header_area .navbar .nav .nav-item .nav-link {
            line-height: 46px !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            color: #444 !important;
        }
        .header_area .navbar .nav .nav-item .nav-link::after {
            display: none !important;
        }
        .header_area .navbar .nav .nav-item.active .nav-link,
        .header_area .navbar .nav .nav-item:hover .nav-link {
            color: #667eea !important;
        }

        /* Hire Me on mobile */
        .header_area .navbar .nav .nav-item.hire-me-item {
            margin-left: 0;
            border-bottom: none;
        }
        .header_area .navbar .nav .nav-item.hire-me-item .nav-link {
            width: 100%;
            justify-content: center;
            padding: 11px 20px !important;
            line-height: 1 !important;
            border-bottom: none !important;
            color: #fff !important;
            background: linear-gradient(135deg, #667eea, #764ba2) !important;
            margin-top: 10px;
            border-radius: 8px !important;
        }
    }
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var toggler = document.querySelector('.navbar-toggler');
        var collapse = document.getElementById('navbarSupportedContent');
        if (!toggler || !collapse) return;

        function openMenu() {
            collapse.classList.add('nav-open');
            toggler.setAttribute('aria-expanded', 'true');
        }
        function closeMenu() {
            collapse.classList.remove('nav-open');
            toggler.setAttribute('aria-expanded', 'false');
        }

        toggler.addEventListener('click', function (e) {
            e.stopPropagation();
            collapse.classList.contains('nav-open') ? closeMenu() : openMenu();
        });

        // Close when a nav link is tapped on mobile
        collapse.querySelectorAll('.nav-link').forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth < 992) closeMenu();
            });
        });

        // Close on outside click
        document.addEventListener('click', function (e) {
            if (!toggler.contains(e.target) && !collapse.contains(e.target)) {
                closeMenu();
            }
        });
    });
    </script>
</head>

<body>

<!--================Header Menu Area =================-->
<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light" style="background:#fff;">
            <div class="container box_1620">

                <!-- LOGO -->
                <a class="navbar-brand nav-logo" href="{{ route('home') }}">
                    <span class="logo-bracket">{</span>
                    <span class="logo-name">CodeEdge <span class="text-primary">Labs</span>
                    <span class="logo-bracket">}</span>
                    <span class="logo-dot">&nbsp;.</span>
                </a>

                <!-- TOGGLER -->
                <button class="navbar-toggler"
                        type="button"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- NAV -->
                <div class="navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">

                        <li class="nav-item {{ Route::currentRouteName() === 'home' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>

                        <li class="nav-item {{ Route::currentRouteName() === 'about-us' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('about-us') }}">About</a>
                        </li>

                        <li class="nav-item {{ Route::currentRouteName() === 'team' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('team') }}">Our Team</a>
                        </li>

                        <li class="nav-item {{ Route::currentRouteName() === 'portfolio' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('portfolio') }}">Projects</a>
                        </li>

                        <li class="nav-item {{ Route::currentRouteName() === 'services' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('services') }}">Services</a>
                        </li>

                        <li class="nav-item {{ Route::currentRouteName() === 'blog' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('blog') }}">Blog</a>
                        </li>

                        <li class="nav-item {{ Route::currentRouteName() === 'contact' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>

                        <li class="nav-item hire-me-item">
                            <a class="nav-link" href="{{ route('contact') }}">Hire Me</a>
                        </li>

                    </ul>
                </div>

            </div>
        </nav>
    </div>
</header>
<!--================End Header =================-->