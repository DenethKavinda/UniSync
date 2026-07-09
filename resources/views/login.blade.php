<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | UniSync</title>
    <!-- Add CSRF token for JavaScript AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            background-clip: text;
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

        /* Modal styling matching the glassmorphism theme */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(2, 6, 23, 0.7);
            backdrop-filter: blur(10px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-card {
            width: 400px;
            padding: 35px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, .15);
            box-shadow: 0 25px 50px rgba(0, 0, 0, .5);
            transform: scale(0.9);
            transition: transform 0.3s ease;
            position: relative;
        }

        .modal-overlay.active .modal-card {
            transform: scale(1);
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #cbd5e1;
            font-size: 20px;
            cursor: pointer;
            background: none;
            border: none;
        }

        .modal-close:hover {
            color: #ec4899;
        }

        .modal-step {
            display: none;
        }

        .modal-step.active {
            display: block;
        }

        .modal-title {
            color: white;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 15px;
            text-align: center;
        }

        .modal-msg {
            font-size: 13px;
            text-align: center;
            margin-bottom: 20px;
        }

        .msg-error {
            color: #f87171;
        }

        .msg-success {
            color: #4ade80;
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

    <!-- MAIN LOGIN CARD -->
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
                <a href="javascript:void(0)" onclick="openForgotModal()">Forgot Password?</a>
                <br><br>
                Don't have an account?
                <a href="{{ route('register') }}">Register</a>
            </div>

        </form>

    </div>

    <!-- FORGOT PASSWORD POPUP MODAL -->
    <div class="modal-overlay" id="forgotModal">
        <div class="modal-card">
            <button class="modal-close" onclick="closeForgotModal()">✕</button>
            <div id="modalNotification" class="modal-msg"></div>

            <!-- STEP 1: Enter Email -->
            <div class="modal-step active" id="step1">
                <div class="modal-title">Forgot Password</div>
                <p style="color: #cbd5e1; font-size: 14px; text-align: center; margin-bottom: 20px;">
                    Enter your registered email below to receive a verification OTP.
                </p>
                <div class="input-group">
                    <label>Email Address</label>
                    <div class="input-box">
                        <input type="email" id="forgotEmail" placeholder="name@example.com">
                    </div>
                </div>
                <button type="button" class="login-btn" onclick="sendOtp()">Send OTP</button>
            </div>

            <!-- STEP 2: Enter OTP -->
            <div class="modal-step" id="step2">
                <div class="modal-title">Verify OTP</div>
                <p style="color: #cbd5e1; font-size: 14px; text-align: center; margin-bottom: 20px;">
                    We sent a 6-digit code to your email. Enter it below.
                </p>
                <div class="input-group">
                    <label>Enter OTP Code</label>
                    <div class="input-box">
                        <input type="text" id="otpCode" placeholder="6-Digit Code" maxlength="6">
                    </div>
                </div>
                <button type="button" class="login-btn" onclick="verifyOtp()">Verify Code</button>
            </div>

            <!-- STEP 3: Reset Password -->
            <div class="modal-step" id="step3">
                <div class="modal-title">New Password</div>
                <p style="color: #cbd5e1; font-size: 14px; text-align: center; margin-bottom: 20px;">
                    Create a strong and secure new password.
                </p>
                <div class="input-group">
                    <label>New Password</label>
                    <div class="input-box">
                        <input type="password" id="newPassword" placeholder="Minimum 8 characters">
                    </div>
                </div>
                <div class="input-group">
                    <label>Confirm New Password</label>
                    <div class="input-box">
                        <input type="password" id="confirmPassword" placeholder="Repeat password">
                    </div>
                </div>
                <button type="button" class="login-btn" onclick="resetPassword()">Reset Password</button>
            </div>
        </div>
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
            if (card) {
                card.style.transform = `rotateY(${x}deg) rotateX(${-y}deg)`;
            }
        });

        // Ripple Effect Generator
        function createRipple(element, event) {
            const ripple = document.createElement("span");
            ripple.classList.add("ripple");
            const rect = element.getBoundingClientRect();
            ripple.style.width = ripple.style.height = "50px";
            ripple.style.left = event.clientX - rect.left - 25 + "px";
            ripple.style.top = event.clientY - rect.top - 25 + "px";
            element.appendChild(ripple);
            setTimeout(() => {
                ripple.remove();
            }, 600);
        }

        document.querySelectorAll('.login-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                createRipple(this, e);
            });
        });

        // --- POPUP WINDOW MODAL LOGIC (FORGOT PASSWORD) ---
        const modal = document.getElementById('forgotModal');
        const notification = document.getElementById('modalNotification');
        let userEmail = "";

        function openForgotModal() {
            modal.classList.add('active');
            switchStep(1);
        }

        function closeForgotModal() {
            modal.classList.remove('active');
            document.getElementById('forgotEmail').value = "";
            document.getElementById('otpCode').value = "";
            document.getElementById('newPassword').value = "";
            document.getElementById('confirmPassword').value = "";
        }

        function switchStep(stepNumber) {
            document.querySelectorAll('.modal-step').forEach(step => step.classList.remove('active'));
            document.getElementById(`step${stepNumber}`).classList.add('active');
            notification.innerHTML = "";
        }

        function showMsg(text, isSuccess = false) {
            notification.innerText = text;
            notification.className = isSuccess ? "modal-msg msg-success" : "modal-msg msg-error";
        }

        // Global headers helper for Fetch API
        const ajaxHeaders = {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        };

        // Step 1: Send Request to Backend to send OTP Email
        function sendOtp() {
            const email = document.getElementById('forgotEmail').value;
            if (!email) return showMsg("Please enter your email address.");

            showMsg("Sending OTP... please wait...", true);

            fetch("{{ route('password.sendOtp') }}", {
                    method: "POST",
                    headers: ajaxHeaders,
                    body: JSON.stringify({
                        email: email
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        userEmail = email; // Keep dynamic track of the email session
                        switchStep(2);
                        showMsg(data.message, true);
                    } else {
                        showMsg(data.message || "Email address not found.");
                    }
                })
                .catch(() => showMsg("An unexpected server error occurred."));
        }

        // Step 2: Validate the OTP submitted by the user
        function verifyOtp() {
            const otp = document.getElementById('otpCode').value;
            if (!otp) return showMsg("Please enter the 6-digit OTP code.");

            fetch("{{ route('password.verifyOtp') }}", {
                    method: "POST",
                    headers: ajaxHeaders,
                    body: JSON.stringify({
                        email: userEmail,
                        otp: otp
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        switchStep(3);
                        showMsg(data.message, true);
                    } else {
                        showMsg(data.message || "Invalid or expired OTP.");
                    }
                })
                .catch(() => showMsg("Verification process encountered an error."));
        }

        // Step 3: Send structural update to target user database entry
        function resetPassword() {
            const newPass = document.getElementById('newPassword').value;
            const confirmPass = document.getElementById('confirmPassword').value;

            if (!newPass || !confirmPass) return showMsg("Please fill out all password fields.");
            if (newPass.length < 8) return showMsg("Password must be at least 8 characters long.");
            if (newPass !== confirmPass) return showMsg("Passwords fields do not match.");

            fetch("{{ route('password.updateReset') }}", {
                    method: "POST",
                    headers: ajaxHeaders,
                    body: JSON.stringify({
                        email: userEmail,
                        password: newPass,
                        password_confirmation: confirmPass
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert("Password updated successfully! You can now log in.");
                        closeForgotModal();
                    } else {
                        showMsg(data.message || "Failed updating credentials.");
                    }
                })
                .catch(() => showMsg("Password processing structural modification failure."));
        }

        // Particles Background
        const canvas = document.getElementById("particles");
        const ctx = canvas.getContext("2d");
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

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
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = "rgba(255,255,255,0.7)";
            particles.forEach(p => {
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fill();
                p.x += p.dx;
                p.y += p.dy;
                if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
                if (p.y < 0 || p.y > canvas.height) p.dy *= -1;
            });
            requestAnimationFrame(animateParticles);
        }
        animateParticles();

        window.addEventListener("resize", () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });
    </script>
</body>

</html>