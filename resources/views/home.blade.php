<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniSync | Home</title>

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
            position: relative;
        }

        /* Animated Background */
        .particles {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -2;
            overflow: hidden;
        }

        .particles span {
            position: absolute;
            display: block;
            width: 8px;
            height: 8px;
            background: rgba(255, 255, 255, .2);
            border-radius: 50%;
            animation: floatParticles 15s linear infinite;
        }

        @keyframes floatParticles {
            0% {
                transform: translateY(100vh) scale(0);
            }

            100% {
                transform: translateY(-100px) scale(1);
            }
        }

        .hero {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .hero-content {
            max-width: 850px;
            animation: fadeUp 1.5s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero h1 {
            font-size: 70px;
            font-weight: 800;
            line-height: 1.1;
            min-height: 90px;

            background: linear-gradient(90deg,
                    #60a5fa,
                    #a855f7,
                    #ec4899);

            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            margin-top: 20px;
            color: #cbd5e1;
            font-size: 20px;
            line-height: 1.8;
            min-height: 90px;
        }

        .btn-group {
            margin-top: 35px;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 35px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            transition: .4s;
        }

        .btn-primary {
            background: linear-gradient(135deg,
                    #60a5fa,
                    #a855f7,
                    #ec4899);
            color: white;
            box-shadow: 0 0 20px rgba(168, 85, 247, .4);
        }

        .btn-primary:hover {
            transform: translateY(-6px);
            box-shadow: 0 0 35px rgba(236, 72, 153, .7);
        }

        .btn-secondary {
            border: 2px solid rgba(255, 255, 255, .2);
            color: white;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, .1);
            transform: translateY(-6px);
        }

        .glow1,
        .glow2 {
            position: fixed;
            border-radius: 50%;
            filter: blur(150px);
            z-index: -1;
            animation: pulse 6s infinite alternate;
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

        @keyframes pulse {
            from {
                transform: scale(1);
            }

            to {
                transform: scale(1.2);
            }
        }

        /* Floating Hero */
        .hero-content {
            animation:
                floatHero 4s ease-in-out infinite,
                fadeUp 1.5s ease;
        }

        @keyframes floatHero {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 28px;
            animation: bounce 2s infinite;
            color: #fff;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            50% {
                transform: translateX(-50%) translateY(10px);
            }
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
                font-size: 45px;
            }

            .hero p {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

    <div class="particles">
        <span style="left:10%;animation-delay:0s"></span>
        <span style="left:20%;animation-delay:2s"></span>
        <span style="left:30%;animation-delay:4s"></span>
        <span style="left:40%;animation-delay:1s"></span>
        <span style="left:50%;animation-delay:6s"></span>
        <span style="left:60%;animation-delay:3s"></span>
        <span style="left:70%;animation-delay:5s"></span>
        <span style="left:80%;animation-delay:2s"></span>
        <span style="left:90%;animation-delay:7s"></span>
    </div>

    <div class="glow1"></div>
    <div class="glow2"></div>

    @include('component.nav')

    <section class="hero">

        <div class="hero-content">

            <h1 id="title" class="cursor"></h1>

            <p id="subtitle"></p>

            <div class="btn-group">
                <a href="{{ route('exam') }}" class="btn btn-primary">
                    Explore Exams
                </a>

                <a href="{{ route('notice') }}" class="btn btn-secondary">
                    View Notices
                </a>
            </div>

        </div>

        <div class="scroll-indicator">
            ↓
        </div>

    </section>

    <script>
        const titleText = "Welcome to UniSync";
        const subText =
            "A modern university system designed for students. Manage exams, notices, courses and academic activities in one place.";

        let i = 0;
        let j = 0;

        function typeTitle() {
            if (i < titleText.length) {
                document.getElementById("title").innerHTML += titleText.charAt(i);
                i++;
                setTimeout(typeTitle, 100);
            } else {
                typeSubtitle();
            }
        }

        function typeSubtitle() {
            if (j < subText.length) {
                document.getElementById("subtitle").innerHTML += subText.charAt(j);
                j++;
                setTimeout(typeSubtitle, 25);
            }
        }

        window.onload = typeTitle;
    </script>

</body>

</html>