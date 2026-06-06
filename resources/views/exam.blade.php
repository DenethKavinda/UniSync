<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniSync | Exams</title>

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
            filter: blur(140px);
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
            padding: 100px 20px 50px;
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
            margin: 40px auto;
            display: flex;
            gap: 15px;
        }

        .search-box input {
            flex: 1;
            padding: 16px;
            border: none;
            outline: none;
            border-radius: 12px;
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
            margin: 50px auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .card {
            background: rgba(255, 255, 255, .08);
            backdrop-filter: blur(12px);
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            transition: .4s;
            border: 1px solid rgba(255, 255, 255, .1);
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card h2 {
            font-size: 40px;
            color: #60a5fa;
        }

        .card p {
            margin-top: 10px;
            color: #cbd5e1;
        }

        .section-title {
            text-align: center;
            font-size: 35px;
            margin-top: 70px;
            margin-bottom: 30px;
        }

        .exam-grid {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 25px;
            padding-bottom: 60px;
        }

        .exam-card {
            background: rgba(255, 255, 255, .08);
            border-radius: 20px;
            padding: 25px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .1);
            transition: .4s;
        }

        .exam-card:hover {
            transform: translateY(-8px);
        }

        .exam-card h3 {
            margin-bottom: 10px;
        }

        .exam-card p {
            color: #cbd5e1;
            margin: 8px 0;
        }

        .exam-card button {
            margin-top: 15px;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            color: white;
            background: linear-gradient(135deg,
                    #60a5fa,
                    #a855f7);
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
            Stay updated with upcoming examinations, schedules,
            deadlines and academic assessments through UniSync.
        </p>

        <div class="search-box">
            <input type="text" placeholder="Search exams...">
            <button>Search</button>
        </div>

    </section>

    <section class="stats">

        <div class="card">
            <h2>25+</h2>
            <p>Upcoming Exams</p>
        </div>

        <div class="card">
            <h2>1200+</h2>
            <p>Registered Students</p>
        </div>

        <div class="card">
            <h2>15</h2>
            <p>Departments</p>
        </div>

    </section>

    <h2 class="section-title">Upcoming Exams</h2>

    <section class="exam-grid">

        <div class="exam-card">
            <h3>Database Management Systems</h3>
            <p>📅 15 June 2026</p>
            <p>⏰ 9:00 AM</p>
            <p>📍 Main Examination Hall</p>
            <button>View Details</button>
        </div>

        <div class="exam-card">
            <h3>Software Engineering</h3>
            <p>📅 18 June 2026</p>
            <p>⏰ 1:00 PM</p>
            <p>📍 Hall B</p>
            <button>View Details</button>
        </div>

        <div class="exam-card">
            <h3>Data Structures</h3>
            <p>📅 22 June 2026</p>
            <p>⏰ 10:00 AM</p>
            <p>📍 Hall C</p>
            <button>View Details</button>
        </div>

    </section>

    <script>
        const text = "Examination Portal";
        let i = 0;

        function typingEffect() {
            if (i < text.length) {
                document.getElementById("typing").innerHTML += text.charAt(i);
                i++;
                setTimeout(typingEffect, 100);
            }
        }

        typingEffect();
    </script>

</body>

</html>