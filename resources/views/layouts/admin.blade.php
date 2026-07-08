<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel — @yield('page_title', 'Dashboard')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/company logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/company logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/company logo.png') }}">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #0f172a;
            --sidebar-hover: rgba(255,255,255,0.07);
            --sidebar-active: rgba(99,102,241,0.18);
            --accent: #6366f1;
            --accent-light: #818cf8;
            --accent-hover: #4f46e5;
            --topbar-h: 64px;
            --body-bg: #f1f5f9;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #3b82f6;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--body-bg);
            color: var(--text-main);
            margin: 0;
            overflow-x: hidden;
        }

        /* ─── SIDEBAR ─────────────────────────────── */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            z-index: 1055;
            transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Brand */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 22px 20px 18px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            text-decoration: none;
        }
        .sidebar-brand .brand-icon {
            width: 38px; height: 38px;
            background: var(--accent);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; color: #fff;
            flex-shrink: 0;
        }
        .sidebar-brand .brand-text {
            font-weight: 700; font-size: 16px;
            color: #f8fafc;
            line-height: 1.2;
        }
        .sidebar-brand .brand-text small {
            display: block;
            font-size: 11px; font-weight: 400;
            color: rgba(255,255,255,0.45);
            text-transform: uppercase; letter-spacing: 0.5px;
        }

        /* Nav sections */
        .sidebar-section {
            padding: 18px 16px 6px;
        }
        .sidebar-section-label {
            font-size: 10px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 1px;
            color: rgba(255,255,255,0.3);
            padding: 0 8px;
            margin-bottom: 6px;
        }

        /* Nav links */
        .nav-link-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            border-radius: 10px;
            font-size: 14px; font-weight: 500;
            transition: all 0.2s;
            margin-bottom: 2px;
            position: relative;
        }
        .nav-link-item i {
            font-size: 17px; width: 22px; text-align: center;
            flex-shrink: 0;
        }
        .nav-link-item:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }
        .nav-link-item.active {
            background: var(--sidebar-active);
            color: var(--accent-light);
        }
        .nav-link-item .nav-badge {
            margin-left: auto;
            background: var(--accent);
            color: #fff;
            font-size: 10px; font-weight: 700;
            padding: 2px 7px; border-radius: 20px;
        }

        /* Sidebar footer */
        .sidebar-footer {
            margin-top: auto;
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.07);
        }
        .sidebar-user {
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar-user .avatar {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--accent), #818cf8);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 14px;
            flex-shrink: 0;
        }
        .sidebar-user .user-info .name {
            font-size: 13px; font-weight: 600; color: #f8fafc;
        }
        .sidebar-user .user-info .role {
            font-size: 11px; color: rgba(255,255,255,0.4);
        }

        /* ─── OVERLAY ─────────────────────────────── */
        #sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1054;
            backdrop-filter: blur(2px);
        }
        #sidebar-overlay.active { display: block; }

        /* ─── TOPBAR ──────────────────────────────── */
        #topbar {
            position: fixed;
            top: 0; left: var(--sidebar-width); right: 0;
            height: var(--topbar-h);
            background: #fff;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
            padding: 0 24px;
            gap: 16px;
            z-index: 1040;
            transition: left 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .topbar-toggle {
            display: none;
            background: none; border: none;
            font-size: 22px; color: var(--text-main);
            padding: 4px 8px; cursor: pointer;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .topbar-toggle:hover { background: var(--body-bg); }

        .topbar-breadcrumb {
            font-size: 13px; color: var(--text-muted);
            display: flex; align-items: center; gap: 6px;
        }
        .topbar-breadcrumb .current {
            font-weight: 600; color: var(--text-main);
        }

        .topbar-actions { margin-left: auto; display: flex; align-items: center; gap: 10px; }

        .topbar-btn {
            width: 38px; height: 38px;
            background: var(--body-bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: var(--text-muted);
            text-decoration: none; cursor: pointer;
            font-size: 16px; transition: all 0.2s;
            position: relative;
        }
        .topbar-btn:hover {
            background: #fff;
            color: var(--accent);
            border-color: var(--accent);
        }
        .topbar-btn .dot {
            position: absolute; top: 6px; right: 6px;
            width: 8px; height: 8px;
            background: var(--danger); border-radius: 50%;
            border: 2px solid #fff;
        }

        .topbar-user {
            display: flex; align-items: center; gap: 8px;
            padding: 6px 12px;
            background: var(--body-bg);
            border: 1px solid var(--border);
            border-radius: 10px;
            cursor: pointer; transition: all 0.2s;
            text-decoration: none; color: var(--text-main);
        }
        .topbar-user:hover { border-color: var(--accent); color: var(--accent); }
        .topbar-user .t-avatar {
            width: 28px; height: 28px;
            background: linear-gradient(135deg, var(--accent), #818cf8);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 12px; font-weight: 700;
        }
        .topbar-user .t-name { font-size: 13px; font-weight: 600; }

        /* ─── MAIN CONTENT ────────────────────────── */
        #main-content {
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-h);
            min-height: 100vh;
            transition: margin-left 0.3s cubic-bezier(0.4,0,0.2,1);
        }
        .content-wrapper {
            padding: 28px 28px 20px;
        }

        /* Page header */
        .page-header {
            margin-bottom: 24px;
        }
        .page-header h1 {
            font-size: 22px; font-weight: 700; margin: 0 0 4px;
        }
        .page-header p {
            margin: 0; color: var(--text-muted); font-size: 14px;
        }

        /* ─── CARDS ───────────────────────────────── */
        .admin-card {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            overflow: hidden;
        }
        .admin-card .card-head {
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .admin-card .card-head h5 {
            margin: 0; font-weight: 700; font-size: 15px;
        }
        .admin-card .card-body-p {
            padding: 22px;
        }

        /* Stat cards */
        .stat-card {
            background: var(--card-bg);
            border-radius: 16px;
            border: 1px solid var(--border);
            padding: 22px;
            display: flex; align-items: center; gap: 18px;
            transition: all 0.25s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        }
        .stat-icon {
            width: 54px; height: 54px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px; flex-shrink: 0;
        }
        .stat-icon.purple { background: rgba(99,102,241,0.12); color: var(--accent); }
        .stat-icon.green  { background: rgba(16,185,129,0.12); color: var(--success); }
        .stat-icon.blue   { background: rgba(59,130,246,0.12); color: var(--info); }
        .stat-icon.orange { background: rgba(245,158,11,0.12); color: var(--warning); }
        .stat-info .label { font-size: 13px; color: var(--text-muted); font-weight: 500; margin-bottom: 4px; }
        .stat-info .value { font-size: 28px; font-weight: 700; line-height: 1; }

        /* ─── TABLES ──────────────────────────────── */
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th {
            padding: 12px 16px;
            font-size: 11px; font-weight: 700; letter-spacing: 0.6px;
            text-transform: uppercase; color: var(--text-muted);
            background: #f8fafc;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        .admin-table td {
            padding: 14px 16px;
            font-size: 14px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }
        .admin-table tbody tr:last-child td { border-bottom: none; }
        .admin-table tbody tr:hover { background: #fafbff; }

        /* ─── BADGES ──────────────────────────────── */
        .badge-status {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px; border-radius: 20px;
            font-size: 12px; font-weight: 600;
        }
        .badge-status::before {
            content: ''; width: 6px; height: 6px;
            border-radius: 50%; display: block;
        }
        .badge-status.read   { background: rgba(16,185,129,0.1); color: var(--success); }
        .badge-status.read::before { background: var(--success); }
        .badge-status.unread { background: rgba(245,158,11,0.1); color: var(--warning); }
        .badge-status.unread::before { background: var(--warning); }

        /* ─── BUTTONS ─────────────────────────────── */
        .btn-primary-custom {
            background: var(--accent);
            color: #fff; border: none;
            padding: 9px 18px; border-radius: 10px;
            font-size: 13px; font-weight: 600;
            display: inline-flex; align-items: center; gap: 7px;
            text-decoration: none; cursor: pointer;
            transition: all 0.2s;
        }
        .btn-primary-custom:hover {
            background: var(--accent-hover);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(99,102,241,0.35);
        }
        .btn-ghost {
            background: transparent; color: var(--text-muted);
            border: 1px solid var(--border);
            padding: 9px 16px; border-radius: 10px;
            font-size: 13px; font-weight: 500;
            display: inline-flex; align-items: center; gap: 7px;
            text-decoration: none; cursor: pointer;
            transition: all 0.2s;
        }
        .btn-ghost:hover { border-color: var(--accent); color: var(--accent); background: rgba(99,102,241,0.04); }
        .btn-danger-custom {
            background: rgba(239,68,68,0.1); color: var(--danger);
            border: 1px solid rgba(239,68,68,0.2);
            padding: 7px 14px; border-radius: 8px;
            font-size: 12px; font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
            text-decoration: none; cursor: pointer;
            transition: all 0.2s;
        }
        .btn-danger-custom:hover { background: var(--danger); color: #fff; border-color: var(--danger); }
        .btn-info-custom {
            background: rgba(59,130,246,0.1); color: var(--info);
            border: 1px solid rgba(59,130,246,0.2);
            padding: 7px 14px; border-radius: 8px;
            font-size: 12px; font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
            text-decoration: none; cursor: pointer;
            transition: all 0.2s;
        }
        .btn-info-custom:hover { background: var(--info); color: #fff; border-color: var(--info); }
        .btn-success-custom {
            background: rgba(16,185,129,0.1); color: var(--success);
            border: 1px solid rgba(16,185,129,0.2);
            padding: 7px 14px; border-radius: 8px;
            font-size: 12px; font-weight: 600;
            display: inline-flex; align-items: center; gap: 5px;
            text-decoration: none; cursor: pointer;
            transition: all 0.2s;
        }
        .btn-success-custom:hover { background: var(--success); color: #fff; border-color: var(--success); }

        /* ─── FORMS ───────────────────────────────── */
        .form-label-custom {
            font-size: 13px; font-weight: 600; color: var(--text-main);
            margin-bottom: 6px; display: block;
        }
        .form-control-custom {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 14px; font-family: inherit;
            background: #fff; color: var(--text-main);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .form-control-custom:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }
        select.form-control-custom { appearance: auto; }

        /* ─── ALERTS ──────────────────────────────── */
        .alert-custom {
            padding: 14px 18px; border-radius: 12px;
            font-size: 14px; font-weight: 500;
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 16px;
        }
        .alert-success { background: rgba(16,185,129,0.1); color: #047857; border: 1px solid rgba(16,185,129,0.2); }
        .alert-danger  { background: rgba(239,68,68,0.1); color: #b91c1c; border: 1px solid rgba(239,68,68,0.2); }

        /* ─── FOOTER ──────────────────────────────── */
        .admin-footer {
            padding: 16px 28px;
            border-top: 1px solid var(--border);
            font-size: 13px; color: var(--text-muted);
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 8px;
        }

        /* ─── MODAL ───────────────────────────────── */
        .modal-content {
            border-radius: 18px;
            border: 1px solid var(--border);
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }
        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
        }
        .modal-title { font-size: 16px; font-weight: 700; }
        .modal-body { padding: 24px; }
        .modal-footer { padding: 16px 24px; border-top: 1px solid var(--border); }

        /* ─── MOBILE MENU ─────────────────────────── */
        .topbar-actions-desktop { display: flex; align-items: center; gap: 10px; }
        .topbar-actions-mobile { display: none; position: relative; }
        .topbar-menu-toggle { position: relative; }
        .topbar-mobile-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            min-width: 220px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            padding: 8px;
            z-index: 1050;
            animation: slideDown 0.2s ease;
        }
        .topbar-mobile-dropdown.active { display: block; }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .mobile-menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 8px;
            color: var(--text-main);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            position: relative;
        }
        .mobile-menu-item:hover {
            background: var(--body-bg);
            color: var(--accent);
        }
        .mobile-menu-item.text-danger {
            color: var(--danger);
        }
        .mobile-menu-item.text-danger:hover {
            background: rgba(239,68,68,0.1);
            color: var(--danger);
        }
        .mobile-menu-item i { font-size: 18px; width: 20px; text-align: center; }
        .mobile-menu-item span { flex: 1; }
        .mobile-badge {
            background: var(--accent);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 12px;
            margin-left: auto;
        }
        .mobile-menu-divider {
            height: 1px;
            background: var(--border);
            margin: 6px 0;
        }

        /* ─── RESPONSIVE ──────────────────────────── */
        @media (max-width: 991.98px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.open { transform: translateX(0); }
            #topbar { left: 0; }
            #main-content { margin-left: 0; }
            .topbar-toggle { display: flex; }
            .content-wrapper { padding: 20px 16px; }
        }

        @media (max-width: 767.98px) {
            /* Hide desktop actions, show mobile dropdown */
            .topbar-actions-desktop { display: none; }
            .topbar-actions-mobile { display: block; }
            
            /* Adjust topbar padding for smaller screens */
            #topbar { padding: 0 16px; }
            
            /* Make breadcrumb more compact */
            .topbar-breadcrumb { font-size: 12px; }
        }

        @media (max-width: 575.98px) {
            .stat-card { padding: 16px; gap: 14px; }
            .stat-icon { width: 44px; height: 44px; font-size: 20px; border-radius: 12px; }
            .stat-info .value { font-size: 22px; }
            .admin-footer { flex-direction: column; text-align: center; }
            
            /* Further adjust topbar for very small screens */
            #topbar { padding: 0 12px; gap: 10px; }
            .topbar-breadcrumb span:first-child { display: none; } /* Hide "Admin" text */
            .topbar-breadcrumb i { display: none; } /* Hide chevron */
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- ═══ SIDEBAR ═══════════════════════════════════════════════ -->
<aside id="sidebar">

    <!-- Brand -->
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        <div class="brand-icon"><i class="bi bi-shield-lock-fill"></i></div>
        <div class="brand-text">
            Admin Panel
            <small>Maaz Sikandar</small>
        </div>
    </a>

    <!-- Main Navigation -->
    <div class="sidebar-section">
        <div class="sidebar-section-label">Main</div>

        <a href="{{ route('admin.dashboard') }}"
           class="nav-link-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>
    </div>

    <!-- Content -->
    <div class="sidebar-section">
        <div class="sidebar-section-label">Content</div>

        <a href="{{ route('admin.blogs') }}"
           class="nav-link-item {{ request()->routeIs('admin.blogs') ? 'active' : '' }}">
            <i class="bi bi-journal-richtext"></i> All Blogs
        </a>

        <a href="{{ route('admin.blog') }}"
           class="nav-link-item {{ request()->routeIs('admin.blog') ? 'active' : '' }}">
            <i class="bi bi-plus-circle"></i> New Blog
        </a>

        <a href="{{ route('admin.uploads') }}"
           class="nav-link-item {{ request()->routeIs('admin.uploads') ? 'active' : '' }}">
            <i class="bi bi-images"></i> Media Library
        </a>

        <a href="{{ route('admin.projects.index') }}"
           class="nav-link-item {{ request()->routeIs('admin.projects*') ? 'active' : '' }}">
            <i class="bi bi-folder2-open"></i> Projects
        </a>

        <a href="{{ route('admin.projects.create') }}"
           class="nav-link-item {{ request()->routeIs('admin.projects.create') ? 'active' : '' }}">
            <i class="bi bi-folder-plus"></i> Add Project
        </a>

        <a href="{{ route('admin.team.index') }}"
           class="nav-link-item {{ request()->routeIs('admin.team*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Team Members
        </a>

        <a href="{{ route('admin.team.create') }}"
           class="nav-link-item {{ request()->routeIs('admin.team.create') ? 'active' : '' }}">
            <i class="bi bi-person-plus-fill"></i> Add Member
        </a>

        <a href="{{ route('admin.resume') }}"
           class="nav-link-item {{ request()->routeIs('admin.resume') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-person-fill"></i> Resume
        </a>
    </div>

    <!-- Communications -->
    <div class="sidebar-section">
        <div class="sidebar-section-label">Communications</div>

        <a href="{{ route('admin.messages') }}"
           class="nav-link-item {{ request()->routeIs('admin.messages') || request()->routeIs('admin.contacts*') ? 'active' : '' }}">
            <i class="bi bi-envelope"></i> Messages
            @php $unread = \App\Models\Contact::count(); @endphp
            @if($unread > 0)
                <span class="nav-badge">{{ $unread }}</span>
            @endif
        </a>
    </div>

    <!-- System -->
    <div class="sidebar-section">
        <div class="sidebar-section-label">System</div>

        <a href="{{ route('admin.system') }}"
           class="nav-link-item {{ request()->routeIs('admin.system') ? 'active' : '' }}">
            <i class="bi bi-gear-fill"></i> System Utilities
        </a>
    </div>

    <!-- Footer -->
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="avatar">M</div>
            <div class="user-info">
                <div class="name">Maaz Sikandar</div>
                <div class="role">Administrator</div>
            </div>
        </div>
        <a href="{{ route('admin.logout') }}"
           class="nav-link-item mt-3"
           style="color: rgba(239,68,68,0.7);"
           onclick="event.preventDefault(); confirmAction('Are you sure you want to logout?', '{{ route('admin.logout') }}');">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>

</aside>

<!-- Overlay -->
<div id="sidebar-overlay" onclick="closeSidebar()"></div>

<!-- ═══ TOPBAR ═══════════════════════════════════════════════ -->
<header id="topbar">

    <button class="topbar-toggle" onclick="openSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <div class="topbar-breadcrumb">
        <span>Admin</span>
        <i class="bi bi-chevron-right" style="font-size:11px;"></i>
        <span class="current">@yield('page_title', 'Dashboard')</span>
    </div>

    <div class="topbar-actions">

        <!-- Desktop Actions (hidden on mobile) -->
        <div class="topbar-actions-desktop">
            <!-- Messages shortcut -->
            <a href="{{ route('admin.messages') }}" class="topbar-btn" title="Messages">
                <i class="bi bi-envelope"></i>
                @if(\App\Models\Contact::count() > 0)
                    <span class="dot"></span>
                @endif
            </a>

            <!-- View site -->
            <a href="{{ route('home') }}" target="_blank" class="topbar-btn" title="View Site">
                <i class="bi bi-box-arrow-up-right"></i>
            </a>

            <!-- User -->
            <a href="{{ route('admin.logout') }}"
               class="topbar-user"
               onclick="event.preventDefault(); confirmAction('Are you sure you want to logout?', '{{ route('admin.logout') }}');">
                <div class="t-avatar">M</div>
                <span class="t-name">Logout</span>
                <i class="bi bi-box-arrow-right" style="font-size:13px;"></i>
            </a>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div class="topbar-actions-mobile">
            <button class="topbar-btn topbar-menu-toggle" onclick="toggleMobileMenu()" title="Menu">
                <i class="bi bi-three-dots-vertical"></i>
                @if(\App\Models\Contact::count() > 0)
                    <span class="dot"></span>
                @endif
            </button>

            <!-- Dropdown -->
            <div class="topbar-mobile-dropdown" id="mobileDropdown">
                <a href="{{ route('admin.messages') }}" class="mobile-menu-item">
                    <i class="bi bi-envelope"></i>
                    <span>Messages</span>
                    @if(\App\Models\Contact::count() > 0)
                        <span class="mobile-badge">{{ \App\Models\Contact::count() }}</span>
                    @endif
                </a>
                <a href="{{ route('home') }}" target="_blank" class="mobile-menu-item">
                    <i class="bi bi-box-arrow-up-right"></i>
                    <span>View Site</span>
                </a>
                <div class="mobile-menu-divider"></div>
                <a href="{{ route('admin.logout') }}"
                   class="mobile-menu-item text-danger"
                   onclick="event.preventDefault(); confirmAction('Are you sure you want to logout?', '{{ route('admin.logout') }}');">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>

    </div>
</header>

<!-- ═══ MAIN CONTENT ══════════════════════════════════════════ -->
<main id="main-content">
    <div class="content-wrapper">

        @if(session('success'))
            <div class="alert-custom alert-success">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-custom alert-danger">
                <i class="bi bi-exclamation-circle-fill"></i>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </div>

    <footer class="admin-footer">
        <span>© {{ date('Y') }} Admin Panel — Maaz Sikandar &nbsp;|&nbsp; <strong>CodeEdge Labs</strong></span>
        <span>Built with Laravel & Bootstrap 5</span>
    </footer>
</main>

<!-- ═══ CONFIRM MODAL ════════════════════════════════════════ -->
<div id="confirmModal" aria-hidden="true" style="
    display:none;
    position:fixed;inset:0;
    z-index:9999;
    align-items:center;
    justify-content:center;
    padding:20px;
">
    <!-- Backdrop -->
    <div id="confirmBackdrop" onclick="closeConfirmModal()" style="
        position:absolute;inset:0;
        background:rgba(15,23,42,0.55);
        backdrop-filter:blur(4px);
        -webkit-backdrop-filter:blur(4px);
        animation:fadeIn 0.2s ease;
    "></div>

    <!-- Dialog -->
    <div id="confirmDialog" role="dialog" aria-modal="true" style="
        position:relative;z-index:1;
        background:#fff;
        border-radius:20px;
        padding:36px 32px 28px;
        width:100%;max-width:400px;
        box-shadow:0 32px 80px rgba(0,0,0,0.18), 0 0 0 1px rgba(0,0,0,0.04);
        animation:popIn 0.25s cubic-bezier(0.34,1.56,0.64,1);
        text-align:center;
    ">
        <!-- Icon -->
        <div style="
            width:62px;height:62px;
            border-radius:18px;
            background:rgba(239,68,68,0.08);
            display:flex;align-items:center;justify-content:center;
            margin:0 auto 20px;
        ">
            <i id="confirmIcon" class="bi bi-exclamation-triangle-fill" style="font-size:26px;color:#ef4444;"></i>
        </div>

        <!-- Title -->
        <h5 id="confirmTitle" style="
            font-size:1.1rem;font-weight:700;
            color:#1e293b;margin:0 0 10px;
        ">Confirm Action</h5>

        <!-- Message -->
        <p id="confirmMessage" style="
            font-size:0.92rem;color:#64748b;
            line-height:1.6;margin:0 0 28px;
        ">Are you sure?</p>

        <!-- Buttons -->
        <div style="display:flex;gap:12px;justify-content:center;">
            <button onclick="closeConfirmModal()" style="
                flex:1;
                padding:11px 20px;
                border-radius:12px;
                border:1.5px solid #e2e8f0;
                background:#f8fafc;
                color:#475569;
                font-size:0.92rem;font-weight:600;
                font-family:inherit;
                cursor:pointer;
                transition:all 0.2s;
            "
            onmouseover="this.style.borderColor='#94a3b8';this.style.background='#f1f5f9'"
            onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'"
            >
                Cancel
            </button>
            <button id="confirmOkBtn" onclick="executeConfirmAction()" style="
                flex:1;
                padding:11px 20px;
                border-radius:12px;
                border:none;
                background:linear-gradient(135deg,#ef4444,#dc2626);
                color:#fff;
                font-size:0.92rem;font-weight:700;
                font-family:inherit;
                cursor:pointer;
                box-shadow:0 6px 18px rgba(239,68,68,0.3);
                transition:all 0.2s;
            "
            onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 10px 24px rgba(239,68,68,0.38)'"
            onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 6px 18px rgba(239,68,68,0.3)'"
            >
                <i class="bi bi-check-lg me-1"></i> Confirm
            </button>
        </div>
    </div>
</div>

<style>
@keyframes fadeIn {
    from { opacity:0; } to { opacity:1; }
}
@keyframes popIn {
    from { opacity:0; transform:scale(0.88) translateY(20px); }
    to   { opacity:1; transform:scale(1)    translateY(0);    }
}
</style>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ── Sidebar ────────────────────────────────────────────
    function openSidebar() {
        document.getElementById('sidebar').classList.add('open');
        document.getElementById('sidebar-overlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebar-overlay').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Mobile dropdown toggle
    function toggleMobileMenu() {
        const dropdown = document.getElementById('mobileDropdown');
        dropdown.classList.toggle('active');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('mobileDropdown');
        const toggle   = document.querySelector('.topbar-menu-toggle');
        if (dropdown && toggle && !dropdown.contains(event.target) && !toggle.contains(event.target)) {
            dropdown.classList.remove('active');
        }
    });

    // Close on Escape
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            closeSidebar();
            document.getElementById('mobileDropdown')?.classList.remove('active');
            closeConfirmModal();
        }
    });

    // ── Custom Confirm Modal ───────────────────────────────
    let _confirmCallback = null;

    /**
     * confirmAction(message, hrefOrCallback, options)
     * options: { title, icon, danger }
     */
    function confirmAction(message, hrefOrCallback, options = {}) {
        const modal   = document.getElementById('confirmModal');
        const title   = document.getElementById('confirmTitle');
        const msg     = document.getElementById('confirmMessage');
        const icon    = document.getElementById('confirmIcon');
        const okBtn   = document.getElementById('confirmOkBtn');

        title.textContent = options.title   || 'Confirm Action';
        msg.textContent   = message;

        const isDanger = options.danger !== false; // default true
        const iconClass = options.icon || (isDanger ? 'bi bi-exclamation-triangle-fill' : 'bi bi-question-circle-fill');
        const iconColor = isDanger ? '#ef4444' : '#6366f1';
        const iconBg    = isDanger ? 'rgba(239,68,68,0.08)' : 'rgba(99,102,241,0.08)';
        const btnBg     = isDanger
            ? 'linear-gradient(135deg,#ef4444,#dc2626)'
            : 'linear-gradient(135deg,#4f46e5,#6366f1)';
        const btnShadow = isDanger
            ? '0 6px 18px rgba(239,68,68,0.3)'
            : '0 6px 18px rgba(99,102,241,0.3)';

        icon.className        = iconClass;
        icon.style.color      = iconColor;
        icon.parentElement.style.background = iconBg;
        okBtn.style.background  = btnBg;
        okBtn.style.boxShadow   = btnShadow;
        okBtn.onmouseover = function() {
            this.style.transform  = 'translateY(-1px)';
            this.style.boxShadow  = isDanger
                ? '0 10px 24px rgba(239,68,68,0.38)'
                : '0 10px 24px rgba(99,102,241,0.38)';
        };
        okBtn.onmouseout = function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = btnShadow;
        };

        if (typeof hrefOrCallback === 'function') {
            _confirmCallback = hrefOrCallback;
        } else {
            _confirmCallback = () => { window.location.href = hrefOrCallback; };
        }

        modal.style.display = 'flex';
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        // Focus the cancel button for accessibility
        setTimeout(() => document.querySelector('#confirmModal button')?.focus(), 50);
    }

    function closeConfirmModal() {
        const modal = document.getElementById('confirmModal');
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        _confirmCallback = null;
    }

    function executeConfirmAction() {
        const cb = _confirmCallback;
        closeConfirmModal();
        if (typeof cb === 'function') cb();
    }

    // Form-based confirm helper (for delete forms etc.)
    function confirmForm(message, formId, options = {}) {
        confirmAction(message, () => {
            document.getElementById(formId).submit();
        }, options);
    }
</script>

@stack('scripts')
</body>
</html>
