<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | UniSync</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
            inset: 0;
            z-index: 1;
        }

        .blob1,
        .blob2 {
            position: absolute;
            border-radius: 50%;
            filter: blur(150px);
            z-index: 0;
        }

        .blob1 {
            width: 350px;
            height: 350px;
            background: #ec4899;
            top: -100px;
            left: -100px;
        }

        .blob2 {
            width: 400px;
            height: 400px;
            background: #60a5fa;
            bottom: -120px;
            right: -120px;
        }

        #cursor-glow {
            position: fixed;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle,
                    rgba(236, 72, 153, .25),
                    rgba(96, 165, 250, .2),
                    transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            transform: translate(-50%, -50%);
            z-index: 2;
        }

        .register-container {
            width: 450px;
            padding: 40px;
            border-radius: 30px;
            background: rgba(255, 255, 255, .08);
            backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, .15);
            box-shadow:
                0 25px 50px rgba(0, 0, 0, .5),
                0 0 40px rgba(168, 85, 247, .3);
            z-index: 10;
            animation: floatCard 5s infinite ease-in-out;
        }

        @keyframes floatCard {
            50% {
                transform: translateY(-10px);
            }
        }

        h1 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 38px;
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
            margin-bottom: 30px;
            font-size: 14px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            color: white;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .input-box {
            position: relative;
        }

        .input-box input {
            width: 100%;
            padding: 15px;
            border-radius: 14px;
            border: 2px solid rgba(255, 255, 255, .1);
            background: rgba(255, 255, 255, .05);
            color: white;
            font-size: 15px;
            transition: .3s;
        }

        .input-box input:focus {
            outline: none;
            border-color: #a855f7;
            box-shadow: 0 0 20px rgba(168, 85, 247, .4);
        }

        .input-box input::placeholder {
            color: #94a3b8;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: white;
        }

        .register-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 14px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            background: linear-gradient(135deg,
                    #60a5fa,
                    #a855f7,
                    #ec4899);
            transition: .3s;
        }

        .register-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(168, 85, 247, .5);
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #cbd5e1;
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
            text-align: center;
            color: white;
            margin-bottom: 25px;
            font-weight: 600;
            height: 24px;
        }
    </style>
</head>

<body>

    <canvas id="particles"></canvas>

    <div class="blob1"></div>
    <div class="blob2"></div>
    <div id="cursor-glow"></div>

    <div class="register-container">

        <h1>UniSync</h1>

        <div class="typing" id="typing"></div>

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="input-group">
                <label>Name</label>
                <div class="input-box">
                    <input type="text" name="name" placeholder="Enter your full name" required>
                </div>
            </div>

            <div class="input-group">
                <label>Email</label>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
            </div>

            <div class="input-group">
                <label>Password</label>
                <div class="input-box">
                    <input type="password" id="password" name="password" placeholder="Create password" required>
                    <span class="toggle-password" onclick="togglePassword()">👁</span>
                </div>
            </div>

            <button type="submit" class="register-btn">
                Create Account
            </button>

            <div class="footer">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </div>

        </form>

    </div>

    <script>
        const text = "Create Your Student Account";
        let i = 0;

        function typeWriter() {
            if (i < text.length) {
                document.getElementById("typing").innerHTML += text.charAt(i);
                i++;
                setTimeout(typeWriter, 70);
            }
        }

        typeWriter();

        function togglePassword() {
            const password = document.getElementById("password");

            password.type =
                password.type === "password" ?
                "text" :
                "password";
        }

        const glow = document.getElementById("cursor-glow");

        document.addEventListener("mousemove", (e) => {
            glow.style.left = e.clientX + "px";
            glow.style.top = e.clientY + "px";
        });

        const canvas = document.getElementById("particles");
        const ctx = canvas.getContext("2d");

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const particles = [];

        for (let i = 0; i < 100; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                r: Math.random() * 2,
                dx: (Math.random() - 0.5),
                dy: (Math.random() - 0.5)
            });
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            ctx.fillStyle = "rgba(255,255,255,.7)";

            particles.forEach(p => {
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fill();

                p.x += p.dx;
                p.y += p.dy;

                if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
                if (p.y < 0 || p.y > canvas.height) p.dy *= -1;
            });

            requestAnimationFrame(animate);
        }

        animate();
    </script>

</body>

</html>