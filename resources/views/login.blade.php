<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | UniSync</title>

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
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg,
                    #020617,
                    #0f172a,
                    #312e81,
                    #4c1d95);
            position: relative;
        }

        canvas {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .blob1,
        .blob2 {
            position: absolute;
            border-radius: 50%;
            filter: blur(140px);
            z-index: 0;
        }

        .blob1 {
            width: 350px;
            height: 350px;
            background: #ec4899;
            top: -100px;
            left: -100px;
            animation: move1 10s infinite alternate;
        }

        .blob2 {
            width: 400px;
            height: 400px;
            background: #60a5fa;
            bottom: -100px;
            right: -100px;
            animation: move2 12s infinite alternate;
        }

        @keyframes move1 {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(100px, 100px);
            }
        }

        @keyframes move2 {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(-120px, -80px);
            }
        }

        #cursor-glow {
            position: fixed;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle,
                    rgba(236, 72, 153, .25),
                    rgba(96, 165, 250, .15),
                    transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            transform: translate(-50%, -50%);
            z-index: 2;
        }

        .login-container {
            width: 430px;
            padding: 40px;
            border-radius: 30px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, .15);
            box-shadow:
                0 25px 50px rgba(0, 0, 0, .5),
                0 0 30px rgba(168, 85, 247, .4);
            z-index: 10;
            transition: .2s ease;
            animation: floatCard 5s infinite ease-in-out;
        }

        @keyframes floatCard {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo h1 {
            font-size: 40px;
            font-weight: 800;
            background: linear-gradient(90deg,
                    #60a5fa,
                    #a855f7,
                    #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .subtitle {
            text-align: center;
            color: #cbd5e1;
            margin-bottom: 35px;
            font-size: 14px;
        }

        .input-group {
            margin-bottom: 22px;
            transition: .3s;
        }

        .input-group label {
            display: block;
            color: white;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .input-box {
            position: relative;
        }

        .input-box input {
            width: 100%;
            padding: 15px 50px 15px 15px;
            border-radius: 14px;
            border: 2px solid rgba(255, 255, 255, .1);
            background: rgba(255, 255, 255, .05);
            color: white;
            font-size: 15px;
            transition: .3s;
        }

        .input-box input::placeholder {
            color: #94a3b8;
        }

        .input-box input:focus {
            outline: none;
            border-color: #a855f7;
            box-shadow: 0 0 20px rgba(168, 85, 247, .4);
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #cbd5e1;
            cursor: pointer;
            user-select: none;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            color: white;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg,
                    #60a5fa,
                    #a855f7,
                    #ec4899);
            transition: .3s;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(168, 85, 247, .5);
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #cbd5e1;
            font-size: 14px;
        }

        .footer a {
            color: #ec4899;
            text-decoration: none;
            font-weight: 600;
        }

        .footer a:hover {
            color: #60a5fa;
        }

        .typing {
            color: white;
            text-align: center;
            height: 24px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, .5);
            transform: scale(0);
            animation: ripple .6s linear;
        }

        @keyframes ripple {
            to {
                transform: scale(8);
                opacity: 0;
            }
        }

        @media(max-width:500px) {
            .login-container {
                width: 92%;
                padding: 30px;
            }

            .logo h1 {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>

    <canvas id="particles"></canvas>

    <div class="blob1"></div>
    <div class="blob2"></div>
    <div id="cursor-glow"></div>

    <div class="login-container">

        <div class="logo">
            <h1>UniSync</h1>
        </div>

        <div class="typing" id="typing"></div>

        <form method="POST" action="{{ route('login.authenticate') }}">
            @csrf

            <div class="input-group">
                <label>Email Address</label>
                <div class="input-box">
                    <input type="email" name="email"
                        placeholder="Enter your email" required>
                </div>
            </div>

            <div class="input-group">
                <label>Password</label>
                <div class="input-box">
                    <input type="password" id="password"
                        name="password"
                        placeholder="Enter your password"
                        required>

                    <span class="toggle-password"
                        onclick="togglePassword()">
                        👁
                    </span>
                </div>
            </div>

            <button type="submit" class="login-btn">
                Login
            </button>

            <div class="footer">
                Don't have an account?
                <a href="{{ route('register') }}">Register</a>
            </div>

        </form>

    </div>

    <script>
        // Typing Effect
        const text = "Welcome Back to UniSync";
        let i = 0;

        function typeWriter() {
            if (i < text.length) {
                document.getElementById("typing").innerHTML += text.charAt(i);
                i++;
                setTimeout(typeWriter, 70);
            }
        }

        typeWriter();

        // Password Toggle
        function togglePassword() {
            const pass = document.getElementById("password");

            if (pass.type === "password") {
                pass.type = "text";
            } else {
                pass.type = "password";
            }
        }

        // Cursor Glow
        const glow = document.getElementById("cursor-glow");

        document.addEventListener("mousemove", (e) => {
            glow.style.left = e.clientX + "px";
            glow.style.top = e.clientY + "px";
        });

        // 3D Card Effect
        const card = document.querySelector(".login-container");

        document.addEventListener("mousemove", (e) => {

            let x = (window.innerWidth / 2 - e.pageX) / 35;
            let y = (window.innerHeight / 2 - e.pageY) / 35;

            card.style.transform =
                `rotateY(${x}deg) rotateX(${-y}deg)`;
        });

        // Ripple Effect
        document.querySelector('.login-btn')
            .addEventListener('click', function(e) {

                const ripple =
                    document.createElement("span");

                ripple.classList.add("ripple");

                const rect =
                    this.getBoundingClientRect();

                ripple.style.width =
                    ripple.style.height = "50px";

                ripple.style.left =
                    e.clientX - rect.left - 25 + "px";

                ripple.style.top =
                    e.clientY - rect.top - 25 + "px";

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });

        // Particles Background
        const canvas =
            document.getElementById("particles");

        const ctx =
            canvas.getContext("2d");

        canvas.width =
            window.innerWidth;

        canvas.height =
            window.innerHeight;

        let particles = [];

        for (let i = 0; i < 120; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                r: Math.random() * 2,
                dx: (Math.random() - 0.5),
                dy: (Math.random() - 0.5)
            });
        }

        function animateParticles() {

            ctx.clearRect(
                0,
                0,
                canvas.width,
                canvas.height
            );

            ctx.fillStyle =
                "rgba(255,255,255,0.7)";

            particles.forEach(p => {

                ctx.beginPath();
                ctx.arc(
                    p.x,
                    p.y,
                    p.r,
                    0,
                    Math.PI * 2
                );
                ctx.fill();

                p.x += p.dx;
                p.y += p.dy;

                if (
                    p.x < 0 ||
                    p.x > canvas.width
                ) p.dx *= -1;

                if (
                    p.y < 0 ||
                    p.y > canvas.height
                ) p.dy *= -1;
            });

            requestAnimationFrame(
                animateParticles
            );
        }

        animateParticles();

        window.addEventListener(
            "resize",
            () => {
                canvas.width =
                    window.innerWidth;

                canvas.height =
                    window.innerHeight;
            });
    </script>

</body>

</html>