<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Maaz Sikandar — Full Stack Developer</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('img/company logo.jpeg') }}">
    <link rel="shortcut icon" type="image/jpeg" href="{{ asset('img/company logo.jpeg') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/company logo.jpeg') }}">

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
       NAVBAR — Light & Smooth Redesign
       ============================================ */

    /* Base state: light background */
    .header_area {
        position: fixed !important;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 999;
        transition: background 0.3s ease, box-shadow 0.3s ease;
    }

    .header_area .main_menu {
        background: rgba(255, 255, 255, 0.95);
    }

    .header_area .navbar {
        padding: 0 !important;
    }

    /* Scrolled state — light with subtle shadow */
    .header_area.navbar_fixed .main_menu {
        background: rgba(255, 255, 255, 0.98) !important;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
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
        position: relative;
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
        transition: filter 0.3s ease;
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
        transition: filter 0.3s ease;
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

    /* Glow on hover */
    .nav-logo:hover .logo-name { filter: brightness(0.85); }
    .nav-logo:hover .logo-bracket { filter: brightness(1.2); }

    /* ---- Nav links ---- */
    .header_area .navbar .nav .nav-item .nav-link {
        font-size: 0.82rem !important;
        font-weight: 700 !important;
        letter-spacing: 0.8px !important;
        text-transform: uppercase;
        color: #555555 !important;
        position: relative;
        padding: 0 !important;
        line-height: 80px !important;
        transition: color 0.3s ease !important;
    }

    /* Mobile: Dark text on light */
    @media (max-width: 991px) {
        .header_area .navbar .nav .nav-item .nav-link {
            color: #555555 !important;
        }
    }
    .header_area .navbar .nav .nav-item .nav-link::after {
        content: '' !important;
        display: block !important;
        position: absolute;
        bottom: 18px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
        transition: width 0.3s ease !important;
    }

    /* Active link styling */
    .header_area .navbar .nav .nav-item.active .nav-link,
    .header_area .navbar .nav .nav-item.active .nav-link:hover {
        color: #667eea !important;
    }

    .header_area .navbar .nav .nav-item.active .nav-link::after {
        width: 100%;
    }

    /* Hover (only if NOT active) */
    .header_area .navbar .nav .nav-item:not(.active):hover .nav-link {
        color: #667eea !important;
    }

    .header_area .navbar .nav .nav-item:not(.active):hover .nav-link::after {
        width: 100%;
    }

    /* Scrolled link height */
    .header_area.navbar_fixed .main_menu .navbar .nav .nav-item .nav-link {
        line-height: 70px !important;
    }
    .header_area.navbar_fixed .main_menu .navbar .nav .nav-item .nav-link::after {
        bottom: 14px;
    }

    /* ---- Hire Me — Modern gradient button ---- */
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
        color: #ffffff !important;
        background: linear-gradient(135deg, #667eea, #764ba2);
        position: relative;
        overflow: visible;
        transition: all 0.3s ease !important;
        white-space: nowrap;
        box-sizing: border-box;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    /* Arrow icon */
    .header_area .navbar .nav .nav-item.hire-me-item .nav-link::before {
        content: '↗';
        font-size: 0.82rem;
        display: inline-block;
        transition: transform 0.3s ease;
        line-height: 1;
        flex-shrink: 0;
    }
    /* Kill the underline pseudo-element */
    .header_area .navbar .nav .nav-item.hire-me-item .nav-link::after {
        display: none !important;
    }
    .header_area .navbar .nav .nav-item.hire-me-item .nav-link:hover {
        background: linear-gradient(135deg, #764ba2, #667eea) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(102, 126, 234, 0.4) !important;
    }
    .header_area .navbar .nav .nav-item.hire-me-item .nav-link:hover::before {
        transform: translate(2px, -2px);
    }

    /* Dark toggler for mobile */
    .navbar-toggler {
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        padding: 6px !important;
        background: rgba(102, 126, 234, 0.1) !important;
        border: 1.5px solid rgba(102, 126, 234, 0.25) !important;
        border-radius: 8px !important;
        width: 42px;
        height: 42px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 5px;
        cursor: pointer;
        transition: background 0.3s ease, border-color 0.3s ease;
    }
    
    /* Mobile: Light toggler styles */
    @media (max-width: 991px) {
        .navbar-toggler {
            background: rgba(102, 126, 234, 0.08) !important;
            border: 1.5px solid rgba(102, 126, 234, 0.2) !important;
        }
        .navbar-toggler .icon-bar {
            background: #667eea;
        }
        .navbar-toggler:hover,
        .navbar-toggler:focus {
            background: rgba(102, 126, 234, 0.15) !important;
            border-color: rgba(102, 126, 234, 0.35) !important;
        }
    }

    /* Desktop: Light toggler */
    @media (min-width: 992px) {
        .navbar-toggler {
            background: rgba(102, 126, 234, 0.1) !important;
            border: 1.5px solid rgba(102, 126, 234, 0.25) !important;
        }
        .navbar-toggler .icon-bar {
            background: #667eea;
        }
        .navbar-toggler:hover,
        .navbar-toggler:focus {
            background: rgba(102, 126, 234, 0.18) !important;
            border-color: rgba(102, 126, 234, 0.4) !important;
        }
    }

    /* ---- Mobile dropdown panel — Light Background ---- */
    @media (max-width: 991px) {
        .header_area .navbar .nav .nav-item .nav-link {
            line-height: 48px !important;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            color: #555555 !important;
        }
        .header_area .navbar .nav .nav-item .nav-link::after {
            display: none !important;
        }
        .header_area .navbar .nav .nav-item.active .nav-link,
        .header_area .navbar .nav .nav-item:hover .nav-link {
            color: #667eea !important;
        }
        .header_area .navbar-collapse {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 0 0 16px 16px;
            padding: 12px 20px 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }
        /* Mobile scrolled state - stay light */
        .header_area.navbar_fixed .navbar-collapse {
            background: rgba(255, 255, 255, 0.98) !important;
        }
        /* Hire Me on mobile */
        .header_area .navbar .nav .nav-item.hire-me-item {
            margin-left: 0;
            padding: 12px 0 4px;
            border-bottom: none;
        }
        .header_area .navbar .nav .nav-item.hire-me-item .nav-link {
            width: 100%;
            justify-content: center;
            padding: 11px 20px !important;
            line-height: 1 !important;
            border-bottom: none !important;
            color: #ffffff !important;
            background: linear-gradient(135deg, #ff6b9d, #667eea) !important;
            border: none !important;
            margin-top: 8px;
        }
    }
    </style>
</head>

<body>

<!--================Header Menu Area =================-->
<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-dark">
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
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                        onclick="return false;">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- NAV -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">

                        <li class="nav-item {{ Route::currentRouteName() === 'home' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>

                        <li class="nav-item {{ Route::currentRouteName() === 'about-us' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('about-us') }}">About</a>
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