<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniSync | Notices</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg,
                    #020617,
                    #0f172a,
                    #312e81,
                    #4c1d95);
            color: white;
            overflow-x: hidden;
        }

        .glow1,
        .glow2 {
            position: fixed;
            border-radius: 50%;
            filter: blur(150px);
            z-index: -1;
        }

        .glow1 {
            width: 300px;
            height: 300px;
            background: #ec4899;
            top: -100px;
            left: -100px;
        }

        .glow2 {
            width: 350px;
            height: 350px;
            background: #60a5fa;
            bottom: -100px;
            right: -100px;
        }

        .hero {
            text-align: center;
            padding: 100px 20px 60px;
        }

        .hero h1 {
            font-size: 60px;
            font-weight: 800;
            min-height: 80px;

            background: linear-gradient(90deg,
                    #60a5fa,
                    #a855f7,
                    #ec4899);

            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            max-width: 750px;
            margin: 20px auto;
            color: #cbd5e1;
            font-size: 18px;
            line-height: 1.8;
        }

        .search-box {
            max-width: 700px;
            margin: 35px auto;
            display: flex;
            gap: 15px;
        }

        .search-box input {
            flex: 1;
            padding: 16px;
            border: none;
            border-radius: 12px;
            outline: none;
            background: rgba(255, 255, 255, .08);
            color: white;
        }

        .search-box button {
            padding: 16px 25px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg,
                    #60a5fa,
                    #a855f7);
        }

        .stats {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto 70px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .stat-card {
            background: rgba(255, 255, 255, .08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .1);
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            transition: .4s;
        }

        .stat-card:hover {
            transform: translateY(-10px);
        }

        .stat-card h2 {
            font-size: 40px;
            color: #60a5fa;
        }

        .stat-card p {
            color: #cbd5e1;
            margin-top: 10px;
        }

        .section-title {
            text-align: center;
            font-size: 35px;
            margin-bottom: 35px;
        }

        .notice-grid {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
            padding-bottom: 80px;
        }

        .notice-card {
            background: rgba(255, 255, 255, .08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 20px;
            padding: 25px;
            transition: .4s;
        }

        .notice-card:hover {
            transform: translateY(-10px);
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .important {
            background: #f59e0b;
        }

        .urgent {
            background: #ef4444;
        }

        .new {
            background: #22c55e;
        }

        .notice-card h3 {
            margin-bottom: 12px;
        }

        .notice-card p {
            color: #cbd5e1;
            line-height: 1.7;
            margin-bottom: 15px;
        }

        .notice-date {
            color: #94a3b8;
            font-size: 14px;
        }

        .cursor {
            border-right: 3px solid white;
            animation: blink .8s infinite;
        }

        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }

        @media(max-width:768px) {

            .hero h1 {
                font-size: 40px;
            }

            .search-box {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <div class="glow1"></div>
    <div class="glow2"></div>

    @include('component.nav')

    <section class="hero">

        <h1 id="typing" class="cursor"></h1>

        <p>
            Stay informed with the latest university announcements,
            examination updates, academic schedules and important events.
        </p>

        <div class="search-box">
            <input type="text" placeholder="Search notices...">
            <button>Search</button>
        </div>

    </section>

    <section class="stats">

        <div class="stat-card">
            <h2>48</h2>
            <p>Total Notices</p>
        </div>

        <div class="stat-card">
            <h2>12</h2>
            <p>Important Updates</p>
        </div>

        <div class="stat-card">
            <h2>5</h2>
            <p>Urgent Notices</p>
        </div>

    </section>

    <h2 class="section-title">Latest Notices</h2>

    <section class="notice-grid">

        <div class="notice-card">
            <span class="badge urgent">URGENT</span>

            <h3>Examination Schedule Updated</h3>

            <p>
                The final examination timetable has been revised.
                Students are advised to check the latest schedule.
            </p>

            <div class="notice-date">
                Posted: 05 June 2026
            </div>
        </div>

        <div class="notice-card">
            <span class="badge important">IMPORTANT</span>

            <h3>Course Registration Open</h3>

            <p>
                Registration for Semester 2 courses is now open.
                Complete your enrollment before the deadline.
            </p>

            <div class="notice-date">
                Posted: 04 June 2026
            </div>
        </div>

        <div class="notice-card">
            <span class="badge new">NEW</span>

            <h3>University Sports Meet</h3>

            <p>
                Applications are now being accepted for the annual
                university sports festival.
            </p>

            <div class="notice-date">
                Posted: 03 June 2026
            </div>
        </div>

        <div class="notice-card">
            <span class="badge important">IMPORTANT</span>

            <h3>Library Maintenance Notice</h3>

            <p>
                The university digital library system will be unavailable
                due to scheduled maintenance.
            </p>

            <div class="notice-date">
                Posted: 02 June 2026
            </div>
        </div>

    </section>

    <script>
        const text = "University Notice Board";
        let i = 0;

        function typeWriter() {
            if (i < text.length) {
                document.getElementById("typing").innerHTML += text.charAt(i);
                i++;
                setTimeout(typeWriter, 90);
            }
        }

        window.onload = typeWriter;
    </script>

</body>

</html>