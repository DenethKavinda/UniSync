<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | UniSync</title>

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
            color: #fff;
            overflow-x: hidden;
            position: relative;
        }

        /* Glow background */
        .glow1,
        .glow2 {
            position: fixed;
            border-radius: 50%;
            filter: blur(150px);
            z-index: -1;
        }

        .glow1 {
            width: 320px;
            height: 320px;
            background: #ec4899;
            top: -120px;
            left: -120px;
        }

        .glow2 {
            width: 360px;
            height: 360px;
            background: #60a5fa;
            bottom: -120px;
            right: -120px;
        }

        /* HERO */
        .hero {
            text-align: center;
            padding: 120px 20px 60px;
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
        }

        .hero p {
            max-width: 750px;
            margin: 20px auto;
            color: #cbd5e1;
            line-height: 1.8;
            font-size: 18px;
        }

        /* CONTAINER */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        /* INFO CARDS */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            transition: 0.4s;
        }

        .info-card:hover {
            transform: translateY(-10px);
        }

        .info-card h3 {
            margin-bottom: 10px;
        }

        .info-card p {
            color: #cbd5e1;
        }

        /* FORMS */
        .form-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            padding-bottom: 80px;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 35px;
            border-radius: 25px;
            transition: 0.4s;
        }

        .form-card:hover {
            transform: translateY(-5px);
        }

        .form-card h2 {
            margin-bottom: 25px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 15px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            background: rgba(255, 255, 255, 0.06);
            color: white;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 15px rgba(96, 165, 250, 0.3);
        }

        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg,
                    #60a5fa,
                    #a855f7,
                    #ec4899);
            transition: 0.3s;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 25px rgba(168, 85, 247, 0.5);
        }

        /* CURSOR */
        .cursor {
            border-right: 3px solid white;
            animation: blink 0.8s infinite;
        }

        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }

        /* RESPONSIVE */
        @media(max-width:900px) {
            .form-section {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 42px;
            }

            .hero p {
                font-size: 16px;
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
            Need help? Contact UniSync support team or submit your inquiry anytime.
        </p>
    </section>

    <div class="container">

        <!-- INFO -->
        <div class="info-grid">

            <div class="info-card">
                <h3>📞 Hotline</h3>
                <p>+94 11 234 5678</p>
            </div>

            <div class="info-card">
                <h3>📧 Email</h3>
                <p>support@unisync.edu</p>
            </div>

            <div class="info-card">
                <h3>📍 Location</h3>
                <p>Colombo, Sri Lanka</p>
            </div>

        </div>

        <!-- FORMS -->
        <div class="form-section">

            <!-- CONTACT FORM -->
            <div class="form-card">
                <h2>Contact Us</h2>

                <form method="POST" action="{{ route('contact_us.submit') }}">

                    @csrf

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" placeholder="Enter your name" required name="name">
                    </div>

                    <div class="form-group">
                        <label>Telephone</label>
                        <input type="tel" placeholder="Enter telephone number" required name="mobile_no">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" placeholder="Enter email" required name="email">
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea rows="5" placeholder="Write your message" required name="message"></textarea>
                    </div>

                    <button class="btn">Send Message</button>

                </form>
            </div>

            <!-- INQUIRY FORM -->
            <div class="form-card">
                <h2>Inquiry Form</h2>

                <form method="POST" action="{{ route('submit_inquiry') }}">

                    @csrf

                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" placeholder="Enter subject" required name="subject">
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea rows="8" placeholder="Write your inquiry..." required name="message"></textarea>
                    </div>

                    <button class="btn">Submit Inquiry</button>

                </form>
            </div>

        </div>

    </div>

    <script>
        const text = "Contact UniSync";
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