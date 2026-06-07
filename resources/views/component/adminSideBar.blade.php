<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
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
            --bg-base: #07070c;
            --bg-dark-blue: #0a1a3d;
            --bg-dark-purple: #2b0a3d;
            --accent-purple: #b57bff;
            --accent-blue: #4da3ff;
            --accent-pink: #ff4fd8;
            --text-white: #ffffff;
            --text-light: #cfcfcf;
            --text-muted: #bdbdbd;
            --success-bg: rgba(76, 175, 80, 0.15);
            --success-text: #7dff86;
            --sidebar-width: 268px;
        }

        html,
        body {
            height: 100%;
            background: var(--bg-base);
            font-family: 'DM Sans', sans-serif;
            color: var(--text-white);
            overflow: hidden;
        }

        /* ── LAYOUT ── */
        .layout {
            display: flex;
            height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            flex-shrink: 0;
            border-right: 1px solid rgba(181, 123, 255, 0.1);
            overflow: hidden;
        }

        .sidebar-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 50% at 10% 0%, rgba(10, 26, 61, 0.98) 0%, transparent 70%),
                radial-gradient(ellipse 60% 60% at 90% 100%, rgba(43, 10, 61, 0.95) 0%, transparent 70%),
                linear-gradient(170deg, #0a1a3d 0%, #07070c 45%, #2b0a3d 100%);
            z-index: 0;
        }

        .sidebar-noise {
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            z-index: 0;
            pointer-events: none;
        }

        .sidebar-glow-top {
            position: absolute;
            top: -60px;
            left: -40px;
            width: 220px;
            height: 220px;
            background: radial-gradient(circle, rgba(181, 123, 255, 0.12) 0%, transparent 70%);
            z-index: 0;
            pointer-events: none;
        }

        .sidebar-glow-bottom {
            position: absolute;
            bottom: -40px;
            right: -40px;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(77, 163, 255, 0.1) 0%, transparent 70%);
            z-index: 0;
            pointer-events: none;
        }

        .sidebar-inner {
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* ── LOGO ── */
        .sidebar-logo {
            padding: 28px 22px 22px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(181, 123, 255, 0.1);
        }

        .logo-mark {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(181, 123, 255, 0.25), rgba(77, 163, 255, 0.2));
            border: 1px solid rgba(181, 123, 255, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            position: relative;
        }

        .logo-mark i {
            font-size: 19px;
            background: linear-gradient(135deg, #b57bff, #4da3ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logo-text-wrap {
            line-height: 1;
        }

        .logo-name {
            font-family: 'Syne', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--text-white);
            letter-spacing: 0.01em;
        }

        .logo-sub {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 3px;
            letter-spacing: 0.04em;
        }

        .logo-status {
            margin-left: auto;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 3px;
        }

        .status-badge {
            font-size: 9px;
            font-weight: 500;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--success-text);
            background: var(--success-bg);
            border: 1px solid rgba(125, 255, 134, 0.2);
            padding: 2px 7px;
            border-radius: 20px;
        }

        /* ── NAV ── */
        .nav-wrap {
            flex: 1;
            padding: 18px 12px;
            overflow-y: auto;
            scrollbar-width: none;
        }

        .nav-wrap::-webkit-scrollbar {
            display: none;
        }

        .nav-section-label {
            font-size: 9.5px;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(181, 123, 255, 0.5);
            padding: 0 12px;
            margin-bottom: 6px;
            margin-top: 14px;
            font-family: 'Syne', sans-serif;
        }

        .nav-wrap .nav-section-label:first-child {
            margin-top: 4px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 12px;
            margin-bottom: 3px;
            cursor: pointer;
            text-decoration: none;
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 400;
            border: 1px solid transparent;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(181, 123, 255, 0.08), transparent);
            opacity: 0;
            transition: opacity 0.2s ease;
            border-radius: inherit;
        }

        .nav-item:hover {
            color: var(--text-white);
            border-color: rgba(181, 123, 255, 0.18);
            background: rgba(181, 123, 255, 0.06);
        }

        .nav-item:hover::before {
            opacity: 1;
        }

        .nav-item:hover .nav-icon {
            color: var(--accent-purple);
        }

        .nav-item.active {
            color: var(--accent-purple);
            background: rgba(181, 123, 255, 0.12);
            border-color: rgba(181, 123, 255, 0.28);
        }

        .nav-item.active::before {
            opacity: 1;
        }

        .nav-item.active .nav-icon {
            color: var(--accent-purple);
        }

        .nav-item.active .nav-label-text {
            font-weight: 500;
        }

        .active-indicator {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 55%;
            border-radius: 3px 0 0 3px;
            background: linear-gradient(180deg, var(--accent-purple), var(--accent-blue));
            opacity: 0;
            transition: opacity 0.2s;
        }

        .nav-item.active .active-indicator {
            opacity: 1;
        }

        .nav-icon {
            font-size: 18px;
            color: rgba(181, 123, 255, 0.4);
            transition: color 0.2s;
            flex-shrink: 0;
            width: 20px;
            text-align: center;
        }

        .nav-badge {
            margin-left: auto;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 20px;
            background: rgba(255, 79, 216, 0.12);
            color: var(--accent-pink);
            border: 1px solid rgba(255, 79, 216, 0.25);
            font-family: 'Syne', sans-serif;
        }

        .nav-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(181, 123, 255, 0.12), transparent);
            margin: 10px 8px;
        }

        /* ── FOOTER ── */
        .sidebar-footer {
            padding: 14px 12px 20px;
            border-top: 1px solid rgba(181, 123, 255, 0.1);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 13px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(181, 123, 255, 0.12);
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 10px;
        }

        .user-card:hover {
            background: rgba(181, 123, 255, 0.08);
            border-color: rgba(181, 123, 255, 0.22);
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(181, 123, 255, 0.3), rgba(77, 163, 255, 0.3));
            border: 1px solid rgba(181, 123, 255, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: var(--accent-purple);
            font-family: 'Syne', sans-serif;
            flex-shrink: 0;
        }

        .user-info {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-white);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .user-actions {
            display: flex;
            gap: 6px;
        }

        .user-action-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px;
            border-radius: 10px;
            background: transparent;
            border: 1px solid rgba(181, 123, 255, 0.15);
            color: var(--text-muted);
            font-size: 12px;
            cursor: pointer;
            transition: all 0.2s;
            font-family: 'DM Sans', sans-serif;
            text-decoration: none;
        }

        .user-action-btn:hover {
            background: rgba(181, 123, 255, 0.08);
            border-color: rgba(181, 123, 255, 0.28);
            color: var(--accent-purple);
        }

        .user-action-btn i {
            font-size: 15px;
        }

        /* ── MAIN CONTENT ── */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            background: var(--bg-base);
        }

        /* ── TOPBAR ── */
        .topbar {
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 28px;
            border-bottom: 1px solid rgba(181, 123, 255, 0.08);
            gap: 16px;
            flex-shrink: 0;
        }

        .topbar-title {
            font-family: 'Syne', sans-serif;
            font-size: 18px;
            font-weight: 600;
            color: var(--text-white);
        }

        .topbar-breadcrumb {
            font-size: 13px;
            color: var(--text-muted);
        }

        .topbar-breadcrumb span {
            color: var(--accent-purple);
        }

        .topbar-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            border: 1px solid rgba(181, 123, 255, 0.15);
            background: transparent;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
        }

        .topbar-btn:hover {
            background: rgba(181, 123, 255, 0.08);
            border-color: rgba(181, 123, 255, 0.28);
            color: var(--accent-purple);
        }

        .topbar-btn i {
            font-size: 17px;
        }

        .notif-dot {
            position: absolute;
            top: 7px;
            right: 7px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--accent-pink);
            border: 1.5px solid var(--bg-base);
        }

        .search-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 14px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(181, 123, 255, 0.12);
            color: var(--text-muted);
            font-size: 13px;
            font-family: 'DM Sans', sans-serif;
            width: 200px;
            transition: all 0.2s;
            cursor: text;
        }

        .search-bar:hover {
            border-color: rgba(181, 123, 255, 0.22);
        }

        .search-bar i {
            font-size: 15px;
        }

        /* ── PAGE VIEW SYSTEM ── */
        .content {
            flex: 1;
            padding: 28px;
            overflow-y: auto;
        }

        .content::-webkit-scrollbar {
            width: 4px;
        }

        .content::-webkit-scrollbar-track {
            background: transparent;
        }

        .content::-webkit-scrollbar-thumb {
            background: rgba(181, 123, 255, 0.2);
            border-radius: 4px;
        }

        /* View display wrapper toggle */
        .view-panel {
            display: none;
        }

        .view-panel.active-panel {
            display: block;
            animation: fadeUp 0.4s ease both;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(10, 26, 61, 0.6), rgba(7, 7, 12, 0.8));
            border: 1px solid rgba(181, 123, 255, 0.12);
            border-radius: 16px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: border-color 0.2s;
        }

        .stat-card:hover {
            border-color: rgba(181, 123, 255, 0.25);
        }

        .stat-card-glow {
            position: absolute;
            top: -20px;
            right: -20px;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            opacity: 0.12;
        }

        .stat-card:nth-child(1) .stat-card-glow {
            background: var(--accent-purple);
        }

        .stat-card:nth-child(2) .stat-card-glow {
            background: var(--accent-blue);
        }

        .stat-card:nth-child(3) .stat-card-glow {
            background: var(--accent-pink);
        }

        .stat-card:nth-child(4) .stat-card-glow {
            background: var(--success-text);
        }

        .stat-icon-wrap {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            font-size: 18px;
        }

        .stat-card:nth-child(1) .stat-icon-wrap {
            background: rgba(181, 123, 255, 0.12);
            color: var(--accent-purple);
        }

        .stat-card:nth-child(2) .stat-icon-wrap {
            background: rgba(77, 163, 255, 0.12);
            color: var(--accent-blue);
        }

        .stat-card:nth-child(3) .stat-icon-wrap {
            background: rgba(255, 79, 216, 0.12);
            color: var(--accent-pink);
        }

        .stat-card:nth-child(4) .stat-icon-wrap {
            background: var(--success-bg);
            color: var(--success-text);
        }

        .stat-value {
            font-family: 'Syne', sans-serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--text-white);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-muted);
        }

        .stat-change {
            font-size: 11px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .stat-change.up {
            color: var(--success-text);
        }

        .stat-change.down {
            color: #ff6b6b;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 14px;
        }

        .card {
            background: linear-gradient(135deg, rgba(10, 26, 61, 0.5), rgba(7, 7, 12, 0.7));
            border: 1px solid rgba(181, 123, 255, 0.1);
            border-radius: 16px;
            padding: 20px;
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .card-title {
            font-family: 'Syne', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-white);
        }

        .card-action {
            font-size: 12px;
            color: var(--accent-purple);
            cursor: pointer;
            text-decoration: none;
            transition: color 0.2s;
        }

        .card-action:hover {
            color: var(--accent-blue);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: var(--text-muted);
            text-align: left;
            padding: 8px 12px;
            border-bottom: 1px solid rgba(181, 123, 255, 0.08);
            font-family: 'Syne', sans-serif;
        }

        .table td {
            font-size: 13px;
            color: var(--text-light);
            padding: 11px 12px;
            border-bottom: 1px solid rgba(181, 123, 255, 0.05);
            transition: background 0.15s;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .table tr:hover td {
            background: rgba(181, 123, 255, 0.04);
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 11px;
            font-weight: 500;
            padding: 3px 9px;
            border-radius: 20px;
        }

        .pill.pass {
            background: var(--success-bg);
            color: var(--success-text);
            border: 1px solid rgba(125, 255, 134, 0.18);
        }

        .pill.fail {
            background: rgba(255, 107, 107, 0.1);
            color: #ff6b6b;
            border: 1px solid rgba(255, 107, 107, 0.2);
        }

        .pill.pending {
            background: rgba(255, 79, 216, 0.1);
            color: var(--accent-pink);
            border: 1px solid rgba(255, 79, 216, 0.2);
        }

        .activity-list {
            display: flex;
            flex-direction: column;
        }

        .activity-item {
            display: flex;
            gap: 12px;
            padding: 11px 0;
            border-bottom: 1px solid rgba(181, 123, 255, 0.06);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 5px;
        }

        .activity-dot.purple {
            background: var(--accent-purple);
        }

        .activity-dot.blue {
            background: var(--accent-blue);
        }

        .activity-dot.pink {
            background: var(--accent-pink);
        }

        .activity-text {
            font-size: 13px;
            color: var(--text-light);
            line-height: 1.5;
        }

        .activity-time {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .online-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--success-text);
            border: 2px solid rgba(125, 255, 134, 0.2);
            flex-shrink: 0;
        }

        /* View Layout placeholders styling */
        .placeholder-view {
            padding: 40px;
            text-align: center;
            border: 1px dashed rgba(181, 123, 255, 0.2);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.01);
        }

        .placeholder-view i {
            font-size: 48px;
            color: var(--accent-purple);
            margin-bottom: 16px;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateX(-8px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .nav-item {
            animation: fadeSlideIn 0.3s ease both;
        }

        .nav-item:nth-child(1) {
            animation-delay: 0.05s;
        }

        .nav-item:nth-child(2) {
            animation-delay: 0.1s;
        }

        .nav-item:nth-child(3) {
            animation-delay: 0.15s;
        }

        .nav-item:nth-child(4) {
            animation-delay: 0.2s;
        }

        .nav-item:nth-child(5) {
            animation-delay: 0.25s;
        }

        .nav-item:nth-child(6) {
            animation-delay: 0.3s;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="layout">

        <aside class="sidebar">
            <div class="sidebar-bg"></div>
            <div class="sidebar-noise"></div>
            <div class="sidebar-glow-top"></div>
            <div class="sidebar-glow-bottom"></div>

            <div class="sidebar-inner">

                <div class="sidebar-logo">
                    <div class="logo-mark">
                        <i class="ti ti-shield-check"></i>
                    </div>
                    <div class="logo-text-wrap">
                        <div class="logo-name">AdminPanel</div>
                        <div class="logo-sub">Control Center</div>
                    </div>
                    <div class="logo-status">
                        <span class="status-badge">Live</span>
                    </div>
                </div>

                <nav class="nav-wrap" aria-label="Main navigation">

                    <div class="nav-section-label">Overview</div>

                    <a href="#" class="nav-item active" data-view="dashboard" onclick="navigateView(this, 'Dashboard')">
                        <i class="ti ti-layout-dashboard nav-icon"></i>
                        <span class="nav-label-text">Dashboard</span>
                        <span class="active-indicator"></span>
                    </a>

                    <a href="#" class="nav-item" data-view="user-management" onclick="navigateView(this, 'User Management')">
                        <i class="ti ti-users nav-icon"></i>
                        <span class="nav-label-text">User Management</span>
                        <span class="active-indicator"></span>
                    </a>

                    <a href="#" class="nav-item" data-view="exam-result" onclick="navigateView(this, 'Exam Result')">
                        <i class="ti ti-file-certificate nav-icon"></i>
                        <span class="nav-label-text">Exam Result</span>
                        <span class="active-indicator"></span>
                    </a>

                    <div class="nav-divider"></div>
                    <div class="nav-section-label">Support</div>

                    <a href="#" class="nav-item" data-view="inquiry-management" onclick="navigateView(this, 'Inquiry Management')">
                        <i class="ti ti-message-circle nav-icon"></i>
                        <span class="nav-label-text">Inquiry Management</span>
                        <span class="nav-badge">3</span>
                        <span class="active-indicator"></span>
                    </a>

                    <a href="#" class="nav-item" data-view="notify" onclick="navigateView(this, 'Notify')">
                        <i class="ti ti-bell nav-icon"></i>
                        <span class="nav-label-text">Notify</span>
                        <span class="active-indicator"></span>
                    </a>

                    <div class="nav-divider"></div>
                    <div class="nav-section-label">Insights</div>

                    <a href="#" class="nav-item" data-view="analyze" onclick="navigateView(this, 'Analyze')">
                        <i class="ti ti-chart-bar nav-icon"></i>
                        <span class="nav-label-text">Analyze</span>
                        <span class="active-indicator"></span>
                    </a>

                </nav>

                <div class="sidebar-footer">
                    <div class="user-card">
                        <div class="avatar">AD</div>
                        <div class="user-info">
                            <div class="user-name">Administrator</div>
                            <div class="user-role">Super Admin</div>
                        </div>
                        <div class="online-indicator" title="Online"></div>
                    </div>
                    <div class="user-actions">
                        <a href="#" class="user-action-btn"><i class="ti ti-settings"></i> Settings</a>
                        <a href="#" class="user-action-btn"><i class="ti ti-logout"></i> Logout</a>
                    </div>
                </div>

            </div>
        </aside>

        <div class="main">

            <header class="topbar">
                <div>
                    <div class="topbar-title" id="page-title">Dashboard</div>
                    <div class="topbar-breadcrumb">Admin / <span id="breadcrumb-active">Dashboard</span></div>
                </div>
                <div class="topbar-right">
                    <div class="search-bar">
                        <i class="ti ti-search"></i>
                        Search...
                    </div>
                    <button class="topbar-btn" title="Notifications">
                        <i class="ti ti-bell"></i>
                        <span class="notif-dot"></span>
                    </button>
                    <button class="topbar-btn" title="Settings">
                        <i class="ti ti-settings"></i>
                    </button>
                </div>
            </header>

            <main class="content">

                <div id="view-dashboard" class="view-panel active-panel">
                    <div class="stat-grid">
                        <div class="stat-card">
                            <div class="stat-card-glow"></div>
                            <div class="stat-icon-wrap"><i class="ti ti-users"></i></div>
                            <div class="stat-value">2,481</div>
                            <div class="stat-label">Total Users</div>
                            <div class="stat-change up"><i class="ti ti-trending-up" style="font-size:13px;"></i> +12% this month</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card-glow"></div>
                            <div class="stat-icon-wrap"><i class="ti ti-file-certificate"></i></div>
                            <div class="stat-value">847</div>
                            <div class="stat-label">Exams Submitted</div>
                            <div class="stat-change up"><i class="ti ti-trending-up" style="font-size:13px;"></i> +8% this week</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card-glow"></div>
                            <div class="stat-icon-wrap"><i class="ti ti-message-circle"></i></div>
                            <div class="stat-value">36</div>
                            <div class="stat-label">Open Inquiries</div>
                            <div class="stat-change down"><i class="ti ti-trending-down" style="font-size:13px;"></i> 3 urgent</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-card-glow"></div>
                            <div class="stat-icon-wrap"><i class="ti ti-chart-line"></i></div>
                            <div class="stat-value">91%</div>
                            <div class="stat-label">Pass Rate</div>
                            <div class="stat-change up"><i class="ti ti-trending-up" style="font-size:13px;"></i> +3% from last</div>
                        </div>
                    </div>

                    <div class="content-grid">
                        <div class="card">
                            <div class="card-header">
                                <span class="card-title">Recent Exam Results</span>
                                <a href="#" class="card-action" onclick="switchToPanel('exam-result', 'Exam Result')">View all →</a>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Exam</th>
                                        <th>Score</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Ashan Perera</td>
                                        <td>Mathematics Final</td>
                                        <td>87 / 100</td>
                                        <td><span class="pill pass"><i class="ti ti-check" style="font-size:10px;"></i> Pass</span></td>
                                    </tr>
                                    <tr>
                                        <td>Dilini Silva</td>
                                        <td>Science Mid-term</td>
                                        <td>54 / 100</td>
                                        <td><span class="pill fail"><i class="ti ti-x" style="font-size:10px;"></i> Fail</span></td>
                                    </tr>
                                    <tr>
                                        <td>Ruwantha Jayawardena</td>
                                        <td>English Literature</td>
                                        <td>92 / 100</td>
                                        <td><span class="pill pass"><i class="ti ti-check" style="font-size:10px;"></i> Pass</span></td>
                                    </tr>
                                    <tr>
                                        <td>Nadeesha Fernando</td>
                                        <td>Physics Advanced</td>
                                        <td>79 / 100</td>
                                        <td><span class="pill pass"><i class="ti ti-check" style="font-size:10px;"></i> Pass</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <span class="card-title">Recent Activity</span>
                            </div>
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-dot purple"></div>
                                    <div class="activity-text-wrap">
                                        <div class="activity-text">New user registration: <strong>Kasun Kalhara</strong></div>
                                        <div class="activity-time">2 mins ago</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-dot blue"></div>
                                    <div class="activity-text-wrap">
                                        <div class="activity-text">Exam <strong>#842</strong> evaluated automatedly</div>
                                        <div class="activity-time">12 mins ago</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-dot pink"></div>
                                    <div class="activity-text-wrap">
                                        <div class="activity-text">Inquiry <strong>#310</strong> updated by Support</div>
                                        <div class="activity-time">45 mins ago</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="view-user-management" class="view-panel">
                    <div class="placeholder-view">
                        <i class="ti ti-users"></i>
                        <h2>User Management Configuration</h2>
                        <p style="color: var(--text-muted); margin-top: 8px;">Manage your student accounts, assignments, and structural permissions here.</p>
                    </div>
                </div>

                <div id="view-exam-result" class="view-panel">
                    <div class="placeholder-view">
                        <i class="ti ti-file-certificate"></i>
                        <h2>Exam Result Databank</h2>
                        <p style="color: var(--text-muted); margin-top: 8px;">Detailed analytical grade-books, certifications issued, and pass-fail distribution matrix blueprints.</p>
                    </div>
                </div>

                <div id="view-inquiry-management" class="view-panel">
                    <div class="placeholder-view">
                        <i class="ti ti-message-circle"></i>
                        <h2>Inquiry Ticket Hub</h2>
                        <p style="color: var(--text-muted); margin-top: 8px;">Review, assign, and respond to platform student support tickets.</p>
                    </div>
                </div>

                <div id="view-notify" class="view-panel">
                    <div class="placeholder-view">
                        <i class="ti ti-bell"></i>
                        <h2>Notification & Broadcast Matrix</h2>
                        <p style="color: var(--text-muted); margin-top: 8px;">Send global configurations, push banners, or email alerts directly to connected terminals.</p>
                    </div>
                </div>

                <div id="view-analyze" class="view-panel">
                    <div class="placeholder-view">
                        <i class="ti ti-chart-bar"></i>
                        <h2>Analytics Hub</h2>
                        <p style="color: var(--text-muted); margin-top: 8px;">Real-time performance distribution patterns and systemic resource tracking charts.</p>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script>
        function navigateView(element, title) {
            // Remove active classes across all layout navigation tabs
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
            });

            // Make clicked link style elements current active state
            element.classList.add('active');

            // Handle Top Header Titles and Global UI updates
            document.getElementById('page-title').innerText = title;
            document.getElementById('breadcrumb-active').innerText = title;

            // Gather the clean layout dataset token
            const targetView = element.getAttribute('data-view');

            // Toggle view visibility maps safely
            document.querySelectorAll('.view-panel').forEach(panel => {
                panel.classList.remove('active-panel');
            });

            const activePanel = document.getElementById(`view-${targetView}`);
            if (activePanel) {
                activePanel.classList.add('active-panel');
            }
        }

        // Bridge function linking interior dashboard links to specific tab panels
        function switchToPanel(viewDataToken, titleName) {
            const correspondingNav = document.querySelector(`.nav-item[data-view="${viewDataToken}"]`);
            if (correspondingNav) {
                navigateView(correspondingNav, titleName);
            }
        }
    </script>
</body>

</html>