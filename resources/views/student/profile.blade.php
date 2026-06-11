<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniSync | Profile</title>

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
            background: linear-gradient(135deg, #020617, #0f172a, #312e81, #4c1d95);
            color: white;
            overflow-x: hidden;
            position: relative;
            padding-top: 130px;
            padding-bottom: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

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

        .container {
            width: 90%;
            max-width: 1100px;
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 40px;
            z-index: 1;
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

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 255, 255, 0.18);
        }

        .profile-card {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .avatar-container {
            position: relative;
            margin-bottom: 25px;
        }

        .avatar-container img {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #a855f7;
            box-shadow: 0 0 25px rgba(168, 85, 247, 0.4);
            transition: 0.4s ease;
        }

        .avatar-container img:hover {
            box-shadow: 0 0 35px rgba(236, 72, 153, 0.6);
            border-color: #ec4899;
        }

        .user-info h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            background: linear-gradient(90deg, #60a5fa, #a855f7, #ec4899);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-info p {
            color: #cbd5e1;
            font-size: 15px;
            margin-bottom: 15px;
        }

        .role-tag {
            display: inline-block;
            background: rgba(168, 85, 247, 0.2);
            border: 1px solid rgba(168, 85, 247, 0.4);
            color: #c084fc;
            padding: 4px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .upload-form {
            width: 100%;
            margin-top: 25px;
        }

        .file-input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .file-input {
            width: 100%;
            color: #94a3b8;
            font-size: 13px;
            background: rgba(255, 255, 255, 0.05);
            padding: 10px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            outline: none;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: none;
            color: white;
            font-weight: 600;
            cursor: pointer;
            background: linear-gradient(135deg, #60a5fa, #a855f7, #ec4899);
            box-shadow: 0 0 20px rgba(168, 85, 247, .3);
            transition: .4s;
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 30px rgba(236, 72, 153, .5);
        }

        .guidelines-card h3 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(90deg, #60a5fa, #a855f7);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            min-height: 38px;
        }

        .guidelines-intro {
            color: #94a3b8;
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .guidelines-list {
            list-style: none;
        }

        .guidelines-list li {
            position: relative;
            padding-left: 30px;
            margin-bottom: 20px;
            line-height: 1.6;
            color: #cbd5e1;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
        }

        .guidelines-list li strong {
            color: #fff;
            font-weight: 600;
            margin-right: 5px;
        }

        .guidelines-list li::before {
            content: "✦";
            position: absolute;
            left: 5px;
            top: 0;
            background: linear-gradient(90deg, #60a5fa, #ec4899);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.4);
            color: #4ade80;
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            width: 100%;
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

        @media(max-width: 850px) {
            body {
                padding-top: 180px;
            }

            .container {
                grid-template-columns: 1fr;
                gap: 30px;
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

    <div class="container">
        <div class="card profile-card">
            @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
            @endif

            <div class="avatar-container">
                @if($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="User Avatar">
                @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=160&background=60a5fa&color=fff" alt="Default Avatar">
                @endif
            </div>

            <div class="user-info">
                <h2>{{ $user->name }}</h2>
                <p>{{ $user->email }}</p>
                <span class="role-tag">{{ $user->role }}</span>
            </div>

            <hr style="border: 0; border-top: 1px solid rgba(255,255,255,0.1); margin: 25px 0; width: 100%;">

            <form action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data" class="upload-form">
                @csrf
                <div class="file-input-wrapper">
                    <input type="file" name="profile_image" class="file-input" required>
                </div>
                <button type="submit" class="btn-submit">Update Profile Image</button>
            </form>
        </div>

        <div class="card guidelines-card">
            <h3 id="guideline-title" class="cursor"></h3>
            <p class="guidelines-intro">Welcome to your dashboard terminal. Please align all individual student operational activities with our core institutional structural standard actions:</p>

            <ul class="guidelines-list">
                <li><span><strong>Academic Integrity:</strong> Always hand in original work. Plagiarism or cheating of any sort on exams or notices will lead to an immediate disciplinary board appraisal.</span></li>
                <li><span><strong>Digital Etiquette:</strong> Treat peer interactions and open forums on UniSync respectfully. Cyberbullying or platform misuse will result in strict account suspension.</span></li>
                <li><span><strong>Attendance & Punctuality:</strong> Ensure a 75% minimum physical/online attendance record to sit for semester final examinations.</span></li>
                <li><span><strong>Campus Dress Code:</strong> Adhere to smart-casual standards during active lecture hours and administrative office visits.</span></li>
                <li><span><strong>Security Compliance:</strong> Keep your digital login credentials confidential and physically hold your Student Identification ID visible at all times while on university premises.</span></li>
            </ul>
        </div>
    </div>

    <script>
        const textTarget = "University Handbook";
        let index = 0;

        function typeHeaderAnimation() {
            if (index < textTarget.length) {
                document.getElementById("guideline-title").innerHTML += textTarget.charAt(index);
                index++;
                setTimeout(typeHeaderAnimation, 120);
            }
        }

        window.onload = typeHeaderAnimation;
    </script>

</body>

</html>