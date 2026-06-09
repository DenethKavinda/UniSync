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
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg-base);
            color: var(--text-main);
            overflow-x: hidden;
        }

        .layout-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--bg-surface);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }

        .sidebar-header {
            padding: 24px;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.5px;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-nav {
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex: 1;
            overflow-y: auto;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .nav-item:hover {
            color: var(--text-main);
            background-color: rgba(255, 255, 255, 0.02);
        }

        .nav-item.active {
            color: #ffffff;
            background-color: var(--accent);
        }

        .nav-icon {
            font-size: 18px;
        }

        .nav-badge {
            margin-left: auto;
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text-main);
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
        }

        .nav-item.active .nav-badge {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid var(--border-color);
            background-color: rgba(0, 0, 0, 0.1);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
        }

        .user-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-main);
        }

        .user-role {
            font-size: 11px;
            color: var(--text-muted);
        }

        .user-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
            padding: 0 8px;
        }

        .user-action-btn {
            font-size: 12px;
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }

        .user-action-btn:hover {
            color: var(--text-main);
        }

        /* Main Content Styling */
        .main {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .topbar {
            height: 70px;
            background-color: var(--bg-surface);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .topbar-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-main);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: var(--bg-base);
            border: 1px solid var(--border-color);
            padding: 8px 16px;
            border-radius: 20px;
            color: var(--text-muted);
            font-size: 13px;
            width: 240px;
            cursor: pointer;
        }

        .topbar-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 20px;
            cursor: pointer;
            transition: color 0.2s;
            display: flex;
            align-items: center;
        }

        .topbar-btn:hover {
            color: var(--text-main);
        }

        .content {
            padding: 32px;
            flex: 1;
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="layout-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                UniSync Admin
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('admindashboard') }}" class="nav-item {{ Route::is('adminDashboard') ? 'active' : '' }}">
                    <i class="ti ti-dashboard nav-icon"></i> Dashboard
                </a>
                <a href="{{ route('userManagement') }}" class="nav-item {{ Route::is('userManagement') ? 'active' : '' }}">
                    <i class="ti ti-users nav-icon"></i> Users Management
                </a>
                <a href="{{ route('adminNotify') }}" class="nav-item {{ Route::is('noticeManagement') ? 'active' : '' }}">
                    <i class="ti ti-bulletin-board nav-icon"></i> Notices
                </a>
                <a href="{{ route('inquiryManagement') }}" class="nav-item {{ Route::is('inquiryManagement') ? 'active' : '' }}">
                    <i class="ti ti-message-circle nav-icon"></i> Inquiries
                    <span class="nav-badge">{{ \App\Models\Inquiry::count() }}</span>
                </a>
                <a href="{{ route('contactManagement') }}" class="nav-item {{ Route::is('contactManagement') ? 'active' : '' }}">
                    <i class="ti ti-mail nav-icon"></i> Contact Messages
                    <span class="nav-badge">{{ \App\Models\ContactUs::count() }}</span>
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
                    <div class="search-bar"><i class=\"ti ti-search\"></i> Search...</div>
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