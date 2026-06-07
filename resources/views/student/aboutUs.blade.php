<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniSync | About Us</title>

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

            background: linear-gradient(90deg,
                    #60a5fa,
                    #a855f7,
                    #ec4899);

            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            -webkit-text-fill-color: transparent;

            min-height: 80px;
        }

        .hero p {
            max-width: 850px;
            margin: 20px auto;
            color: #cbd5e1;
            font-size: 18px;
            line-height: 1.8;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        .section-title {
            text-align: center;
            font-size: 35px;
            margin-bottom: 30px;
        }

        .about-card,
        .feature-card,
        .mission-card,
        .stat-card {
            background: rgba(255, 255, 255, .08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 20px;
        }

        .about-card {
            padding: 40px;
            text-align: center;
            margin-bottom: 50px;
        }

        .about-card p {
            color: #cbd5e1;
            line-height: 1.9;
        }

        .mission-grid,
        .feature-grid,
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 60px;
        }

        .mission-card,
        .feature-card,
        .stat-card {
            padding: 30px;
            text-align: center;
            transition: .4s;
        }

        .mission-card:hover,
        .feature-card:hover,
        .stat-card:hover {
            transform: translateY(-10px);
        }

        .mission-card h3,
        .feature-card h3 {
            margin-bottom: 15px;
        }

        .mission-card p,
        .feature-card p {
            color: #cbd5e1;
            line-height: 1.8;
        }

        .stat-card h2 {
            font-size: 40px;
            color: #60a5fa;
            margin-bottom: 10px;
        }

        .stat-card p {
            color: #cbd5e1;
        }

        footer {
            text-align: center;
            padding: 40px 20px;
            color: #94a3b8;
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

            .section-title {
                font-size: 28px;
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
            UniSync is a modern university management platform designed to
            simplify academic operations and improve the student experience.
        </p>
    </section>

    <div class="container">

        <div class="about-card">
            <h2 class="section-title">Who We Are</h2>

            <p>
                UniSync is a smart university management system that helps
                students, lecturers, and administrators manage academic
                activities efficiently. From examinations and notices to
                course management and student records, everything is
                available through one modern platform.
            </p>
        </div>

        <h2 class="section-title">Mission & Vision</h2>

        <div class="mission-grid">

            <div class="mission-card">
                <h3>🎯 Our Mission</h3>
                <p>
                    To provide a seamless and user-friendly academic
                    management experience for students and staff.
                </p>
            </div>

            <div class="mission-card">
                <h3>🚀 Our Vision</h3>
                <p>
                    To become the leading digital university management
                    platform that transforms higher education.
                </p>
            </div>

        </div>

        <h2 class="section-title">Platform Features</h2>

        <div class="feature-grid">

            <div class="feature-card">
                <h3>📝 Exam Management</h3>
                <p>View schedules, results and examination updates.</p>
            </div>

            <div class="feature-card">
                <h3>📢 Notice Board</h3>
                <p>Receive important announcements instantly.</p>
            </div>

            <div class="feature-card">
                <h3>📚 Course Access</h3>
                <p>Manage academic resources from one place.</p>
            </div>

            <div class="feature-card">
                <h3>👨‍🎓 Student Portal</h3>
                <p>Track academic progress and activities.</p>
            </div>

        </div>

        <h2 class="section-title">UniSync in Numbers</h2>

        <div class="stats">

            <div class="stat-card">
                <h2>1000+</h2>
                <p>Students</p>
            </div>

            <div class="stat-card">
                <h2>50+</h2>
                <p>Lecturers</p>
            </div>

            <div class="stat-card">
                <h2>100+</h2>
                <p>Courses</p>
            </div>

            <div class="stat-card">
                <h2>24/7</h2>
                <p>Accessibility</p>
            </div>

        </div>

    </div>

    <footer>
        © 2026 UniSync | Empowering Modern Education
    </footer>

    <script>
        const text = "About UniSync";
        let i = 0;

        function typeWriter() {
            if (i < text.length) {
                document.getElementById("typing").innerHTML += text.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            }
        }

        window.onload = typeWriter;
    </script>

</body>

</html>