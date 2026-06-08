@extends('component.adminSideBar')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Overview')

@section('styles')
<style>
    /* Full-height container ensuring vertical centering for content components */
    .dashboard-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 120px);
        /* Adjusts perfectly inside topbar and footer borders */
        width: 100%;
        padding: 20px;
    }

    /* Centered Main Welcome Profile Card */
    .welcome-card {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        border-radius: 16px;
        padding: 40px 32px;
        text-align: center;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.24);
        backdrop-filter: blur(8px);
        transition: transform 0.2s ease, border-color 0.2s ease;
    }

    .welcome-card:hover {
        transform: translateY(-2px);
        border-color: rgba(157, 91, 250, 0.3);
        /* Accent glowing border hue */
    }

    /* Graphic/Icon styling wrapper */
    .welcome-icon-wrap {
        width: 80px;
        height: 80px;
        background: rgba(157, 91, 250, 0.1);
        border: 1px solid rgba(157, 91, 250, 0.2);
        color: var(--accent);
        font-size: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px auto;
    }

    /* Primary Heading Welcome Message */
    .welcome-heading {
        font-family: 'DM Sans', sans-serif;
        font-size: 26px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .welcome-username {
        color: var(--accent);
        /* Highlights the logged-in administrator's name */
    }

    .welcome-subtext {
        font-size: 14px;
        color: var(--text-muted);
        margin-bottom: 32px;
        line-height: 1.6;
    }

    /* Metrics Indicator Divider Badge */
    .counter-badge {
        background: var(--bg-base);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 16px 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .counter-icon {
        font-size: 24px;
        color: #4da3ff;
        /* Modern blue tone for metrics tracking items */
    }

    .counter-data {
        text-align: left;
    }

    .counter-label {
        font-size: 11px;
        text-transform: uppercase;
        font-weight: 700;
        color: var(--text-muted);
        letter-spacing: 0.5px;
    }

    .counter-number {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-main);
        line-height: 1.2;
    }
</style>
@endsection

@section('content')
<div class="dashboard-container">

    <div class="welcome-card">

        <div class="welcome-icon-wrap">
            <i class="ti ti-dashboard"></i>
        </div>

        <h1 class="welcome-heading">
            Welcome Back, <span class="welcome-username">{{ Auth::user()->name ?? 'Admin' }}</span>!
        </h1>

        <p class="welcome-subtext">
            System status monitoring module is fully calibrated. You have complete root operational clearance to modify system structures, track student results ledger portfolios, and assign user permissions matrices.
        </p>

        <div class="counter-badge">
            <div class="counter-icon">
                <i class="ti ti-users"></i>
            </div>
            <div class="counter-data">
                <div class="counter-label">Total Registered Users</div>
                <div class="counter-number">{{ $userCount ?? 0 }}</div>
            </div>
        </div>

    </div>

</div>
@endsection