<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Sidebar Fixed</title>

    <style>
        :root {
            --dark-purple: #2b0a3d;
            --dark-blue: #0a1a3d;
            --black: #0b0b0f;
            --light-blue: #4da3ff;
            --light-purple: #b57bff;
            --pink: #ff4fd8;
            --white: #ffffff;
        }

        /* RESET */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Segoe UI, sans-serif;
            background: linear-gradient(135deg, var(--black), var(--dark-blue));
            color: white;
            display: flex;
            overflow-x: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, var(--dark-purple), var(--dark-blue));
            padding: 20px 12px;
            transition: 0.35s ease;
            box-shadow: 5px 0 20px rgba(0, 0, 0, 0.5);
        }

        /* COLLAPSED */
        .sidebar.collapsed {
            width: 80px;
        }

        /* LOGO */
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            font-weight: bold;
            color: var(--light-purple);
            margin-bottom: 30px;
            padding-left: 8px;
        }

        /* TOGGLE BUTTON */
        .toggle-btn {
            position: absolute;
            top: 20px;
            right: -14px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            background: var(--pink);
            color: white;
            box-shadow: 0 0 10px var(--pink);
        }

        /* MENU */
        ul {
            list-style: none;
            margin-top: 10px;
        }

        /* LINKS FIX (IMPORTANT PART) */
        ul li a {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 12px;
            margin: 8px 0;

            border-radius: 12px;
            text-decoration: none;
            color: white;

            background: rgba(255, 255, 255, 0.06);

            white-space: nowrap;
            overflow: hidden;

            transition: 0.3s;
        }

        /* REMOVE BLOCK ISSUE */
        ul li a span {
            transition: 0.2s;
        }

        /* HOVER */
        ul li a:hover {
            background: linear-gradient(90deg, var(--light-purple), var(--light-blue));
            transform: translateX(6px);
            box-shadow: 0 0 15px rgba(181, 123, 255, 0.4);
        }

        /* ACTIVE */
        ul li a.active {
            background: linear-gradient(90deg, var(--pink), var(--light-purple));
        }

        /* ICON */
        .icon {
            width: 22px;
            height: 22px;
            fill: white;
            flex-shrink: 0;
        }

        /* COLLAPSE TEXT FIX (KEY FIX) */
        .sidebar.collapsed .text {
            display: none;
        }

        /* CENTER ICON WHEN COLLAPSED */
        .sidebar.collapsed ul li a {
            justify-content: center;
            padding: 14px 0;
        }

        /* REMOVE EXTRA BACKGROUND BLOCK LOOK */
        .sidebar.collapsed ul li a {
            margin: 10px auto;
            width: 50px;
        }

        /* MAIN CONTENT FIX */
        .main {
            margin-left: 260px;
            padding: 30px;
            width: 100%;
            transition: 0.35s ease;
        }

        .sidebar.collapsed~.main {
            margin-left: 80px;
        }

        /* TITLE */
        h1 {
            margin-bottom: 10px;
        }

        /* ANIMATION GLOW */
        .glow {
            position: absolute;
            width: 300px;
            height: 300px;
            background: var(--light-purple);
            filter: blur(120px);
            opacity: 0.15;
            border-radius: 50%;
            animation: float 6s infinite ease-in-out;
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(40px);
            }

            100% {
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <div class="sidebar" id="sidebar">

        <button class="toggle-btn" onclick="toggleSidebar()">≡</button>

        <div class="logo">
            🎓 <span class="text">Teacher Panel</span>
        </div>

        <ul>
            <li>
                <a class="active" href="{{ route('teacherdashboard') }}">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                    </svg>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('examManagement') }}">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 14l-5-5 1.41-1.41L12 14.17l4.59-4.58L18 11l-6 6z" />
                    </svg>
                    <span class="text">Exam Management</span>
                </a>
            </li>

            <li>
                <a href="{{ route('teacherAnalyze') }}">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M3 3v18h18v-2H5V3H3zm7 12h2v3h-2v-3zm4-6h2v9h-2V9zM7 13h2v5H7v-5z" />
                    </svg>
                    <span class="text">Analyze</span>
                </a>
            </li>

            <li>
                <a href="{{ route('teacherNotify') }}">
                    <svg class="icon" viewBox="0 0 24 24">
                        <path d="M12 22c1.1 0 2-.9 2-2h-4a2 2 0 0 0 2 2zm6-6V11a6 6 0 1 0-12 0v5L4 18v1h16v-1l-2-2z" />
                    </svg>
                    <span class="text">Notify</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="main">

    </div>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("collapsed");
        }
    </script>

</body>

</html>