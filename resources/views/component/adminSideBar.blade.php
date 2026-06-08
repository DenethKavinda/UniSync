<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg-base: #0b0c10;
            --bg-surface: #14161d;
            --border-color: rgba(255, 255, 255, 0.08);
            --accent: #9d5bfa;
            --text-main: #ffffff;
            --text-muted: #8a8f98;
            --sidebar-width: 240px;
        }

        body {
            background: var(--bg-base);
            font-family: 'DM Sans', sans-serif;
            color: var(--text-main);
            height: 100vh;
            overflow: hidden;
        }

        .layout {
            display: flex;
            height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--bg-surface);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .sidebar-logo {
            padding: 24px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid var(--border-color);
            font-weight: 700;
            font-size: 16px;
            letter-spacing: -0.5px;
        }

        .sidebar-logo i {
            color: var(--accent);
            font-size: 20px;
        }

        .nav-wrap {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            padding: 10px 12px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            color: var(--text-muted);
            font-size: 14px;
            text-decoration: none;
            margin-bottom: 2px;
            transition: all 0.15s;
        }

        .nav-item:hover {
            color: var(--text-main);
            background: rgba(255, 255, 255, 0.04);
        }

        .nav-item.active {
            color: var(--accent);
            background: rgba(157, 91, 250, 0.08);
            font-weight: 500;
        }

        .nav-icon {
            font-size: 18px;
        }

        .nav-badge {
            margin-left: auto;
            font-size: 11px;
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-main);
            padding: 1px 6px;
            border-radius: 4px;
        }

        .nav-divider {
            height: 1px;
            background: var(--border-color);
            margin: 12px 12px;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border-color);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            margin-bottom: 12px;
        }

        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
        }

        .user-name {
            font-size: 13px;
            font-weight: 500;
        }

        .user-role {
            font-size: 11px;
            color: var(--text-muted);
        }

        .user-actions {
            display: flex;
            gap: 6px;
        }

        .user-action-btn {
            flex: 1;
            padding: 8px;
            border-radius: 6px;
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: 12px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .user-action-btn:hover {
            color: var(--text-main);
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* ── MAIN CONTENT AREA ── */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .topbar {
            height: 56px;
            background: var(--bg-surface);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 500;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 12px;
            height: 32px;
            border-radius: 6px;
            background: var(--bg-base);
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: 13px;
            width: 180px;
        }

        .topbar-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .topbar-btn:hover {
            color: var(--text-main);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .content {
            flex: 1;
            padding: 24px;
            overflow-y: auto;
        }
    </style>
    @yield('styles')
</head>

<body>

    <div class="layout">

        <aside class="sidebar">
            <div class="sidebar-logo">
                <i class="ti ti-shield-check"></i> AdminPanel
            </div>

            <nav class="nav-wrap" aria-label="Main navigation">
                <div class="nav-section-label">Overview</div>

                <a href="{{ route('admindashboard') }}" class="nav-item {{ Route::is('admindashboard') ? 'active' : '' }}">
                    <i class="ti ti-layout-dashboard nav-icon"></i> Dashboard
                </a>

                <a href="{{ route('userManagement') }}" class="nav-item {{ Route::is('userManagement') ? 'active' : '' }}">
                    <i class="ti ti-users nav-icon"></i> User Management
                </a>

                <a href="{{ route('examResult') }}" class="nav-item {{ Route::is('examResult') ? 'active' : '' }}">
                    <i class="ti ti-file-certificate nav-icon"></i> Exam Result
                </a>

                <a href="{{ route('adminAnalyze') }}" class="nav-item {{ Route::is('adminAnalyze') ? 'active' : '' }}">
                    <i class="ti ti-chart-bar nav-icon"></i> Analyze
                </a>

                <div class="nav-divider"></div>
                <div class="nav-section-label">Support</div>

                <a href="{{ route('inquiryManagement') }}" class="nav-item {{ Route::is('inquiryManagement') ? 'active' : '' }}">
                    <i class="ti ti-message-circle nav-icon"></i> Inquiries
                    <span class="nav-badge">{{ \App\Models\Inquiry::count() }}</span>
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="user-card">
                    <div class="avatar">AD</div>
                    <div>
                        <div class="user-name">Admin</div>
                        <div class="user-role">Super Admin</div>
                    </div>
                </div>
                <div class="user-actions">
                    <a href="#" class="user-action-btn">Settings</a>
                    <a href="#" class="user-action-btn">Logout</a>
                </div>
            </div>
        </aside>

        <div class="main">
            <header class="topbar">
                <div class="topbar-title">@yield('page_title', 'Dashboard')</div>
                <div class="topbar-right">
                    <div class="search-bar"><i class="ti ti-search"></i> Search...</div>
                    <button class="topbar-btn"><i class="ti ti-bell"></i></button>
                </div>
            </header>

            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
</body>

</html>