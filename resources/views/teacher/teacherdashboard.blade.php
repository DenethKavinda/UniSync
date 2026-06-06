<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>

    <style>
        :root {
            --dark-purple: #2b0a3d;
            --dark-blue: #0a1a3d;
            --black: #07070c;
            --light-purple: #b57bff;
            --light-blue: #4da3ff;
            --pink: #ff4fd8;
        }

        /* ======================
   GLOBAL
====================== */
        body {
            margin: 0;
            font-family: Segoe UI, sans-serif;
            background: linear-gradient(135deg, var(--black), var(--dark-blue));
            color: white;
            overflow-x: hidden;
            /* important for mobile */
        }

        /* ======================
   WRAPPER
====================== */
        .page-wrapper {
            position: relative;
            width: 100%;
            min-height: 100vh;
        }

        /* ======================
   CENTER CONTENT
====================== */
        .main {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 20px;
            z-index: 2;
        }

        /* ======================
   DASHBOARD BOX (RESPONSIVE FIX)
====================== */
        .dashboard-box {
            text-align: center;

            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);

            padding: 50px 60px;
            border-radius: 20px;

            backdrop-filter: blur(12px);
            box-shadow: 0 0 40px rgba(181, 123, 255, 0.25);

            animation: fadeIn 1s ease;

            max-width: 90%;
        }

        /* ANIMATION */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* TITLE */
        h1 {
            margin: 0 0 12px 0;
            font-size: 38px;

            background: linear-gradient(90deg, #b57bff, #4da3ff, #ff4fd8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p {
            font-size: 16px;
            opacity: 0.85;
        }

        /* ======================
   BLOOM BACKGROUNDS (RESPONSIVE SAFE)
====================== */
        .bloom {
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.25;
            animation: float 10s infinite ease-in-out;
            z-index: 0;
        }

        .bloom.one {
            background: #b57bff;
            top: 10%;
            left: 10%;
        }

        .bloom.two {
            background: #4da3ff;
            bottom: 10%;
            right: 10%;
            animation-delay: 2s;
        }

        .bloom.three {
            background: #ff4fd8;
            top: 40%;
            right: 30%;
            animation-delay: 4s;
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(50px);
            }

            100% {
                transform: translateY(0);
            }
        }

        /* ======================
   FLOATING ICONS (MOBILE SAFE)
====================== */
        .float-icon {
            position: absolute;
            opacity: 0.2;
            animation: floatIcon 18s linear infinite;
            z-index: 0;
        }

        .float-icon svg {
            width: 45px;
            height: 45px;
            fill: white;
        }

        @keyframes floatIcon {
            0% {
                transform: translateY(110vh) rotate(0deg);
            }

            100% {
                transform: translateY(-10vh) rotate(360deg);
            }
        }

        /* POSITIONING */
        .i1 {
            left: 5%;
            animation-duration: 16s;
        }

        .i2 {
            left: 25%;
            animation-duration: 18s;
        }

        .i3 {
            left: 45%;
            animation-duration: 14s;
        }

        .i4 {
            left: 65%;
            animation-duration: 20s;
        }

        .i5 {
            left: 85%;
            animation-duration: 17s;
        }

        /* ======================
   RESPONSIVE DESIGN
====================== */

        /* TABLET */
        @media (max-width: 992px) {
            h1 {
                font-size: 30px;
            }

            .dashboard-box {
                padding: 40px 40px;
            }
        }

        /* MOBILE */
        @media (max-width: 600px) {

            .dashboard-box {
                padding: 25px 20px;
                border-radius: 15px;
            }

            h1 {
                font-size: 24px;
            }

            p {
                font-size: 14px;
            }

            /* reduce floating icons */
            .float-icon svg {
                width: 30px;
                height: 30px;
                opacity: 0.15;
            }

            /* hide some icons for performance */
            .i4,
            .i5 {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="page-wrapper">

        <!-- BACKGROUND -->
        <div class="bloom one"></div>
        <div class="bloom two"></div>
        <div class="bloom three"></div>

        <!-- FLOATING ICONS -->
        <div class="float-icon i1">
            <svg viewBox="0 0 24 24">
                <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3z" />
            </svg>
        </div>

        <div class="float-icon i2">
            <svg viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zm0 7L2 4v14l10 5 10-5V4L12 9z" />
            </svg>
        </div>

        <div class="float-icon i3">
            <svg viewBox="0 0 24 24">
                <path d="M3 3h18v2H3V3zm2 4h14v14H5V7z" />
            </svg>
        </div>

        <div class="float-icon i4">
            <svg viewBox="0 0 24 24">
                <path d="M12 2l4 4h-3v6h-2V6H8l4-4zm-7 9h14v11H5V11z" />
            </svg>
        </div>

        <div class="float-icon i5">
            <svg viewBox="0 0 24 24">
                <path d="M4 6h16v2H4V6zm0 5h10v2H4v-2zm0 5h16v2H4v-2z" />
            </svg>
        </div>

        <!-- SIDEBAR (UNCHANGED) -->
        @include('component.teacherSideBar')

        <!-- CONTENT -->
        <div class="main">
            <div class="dashboard-box">
                <h1>Welcome To Teacher Panel, {{ Auth::user()->name }}</h1>
                <p>Manage exams, analyze performance, and control your dashboard</p>
            </div>
        </div>

    </div>

</body>

</html>