<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Exams</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #07070C, #0A1A3D);
            color: white;
            overflow-x: hidden;
        }

        /* Background Glow */
        body::before,
        body::after {
            content: "";
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
        }

        body::before {
            width: 350px;
            height: 350px;
            background: rgba(181, 123, 255, 0.25);
            top: -100px;
            left: -100px;
        }

        body::after {
            width: 400px;
            height: 400px;
            background: rgba(255, 79, 216, 0.15);
            bottom: -150px;
            right: -150px;
        }

        .container {
            margin-left: 260px;
            padding: 40px;
        }

        .page-header {
            margin-bottom: 35px;
        }

        .page-header h1 {
            font-size: 40px;
            font-weight: 700;
            background: linear-gradient(90deg,
                    #B57BFF,
                    #4DA3FF,
                    #FF4FD8);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-header p {
            color: #cfcfcf;
            margin-top: 10px;
            font-size: 15px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill,
                    minmax(320px, 1fr));
            gap: 25px;
        }

        .card {
            position: relative;
            overflow: hidden;

            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(15px);

            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 22px;

            padding: 25px;

            transition: all .35s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            border-color: rgba(181, 123, 255, 0.6);

            box-shadow:
                0 0 20px rgba(181, 123, 255, 0.3),
                0 0 40px rgba(77, 163, 255, 0.15);
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg,
                    #B57BFF,
                    #4DA3FF,
                    #FF4FD8);
            transition: .5s;
        }

        .card:hover::before {
            left: 0;
        }

        .exam-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 18px;
            color: white;
        }

        .info {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 25px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 10px 14px;

            background: rgba(255, 255, 255, 0.04);
            border-radius: 10px;
        }

        .label {
            color: #bdbdbd;
            font-size: 14px;
        }

        .value {
            color: white;
            font-weight: 600;
        }

        .btn {
            display: block;
            text-align: center;

            text-decoration: none;
            color: white;

            padding: 14px;
            border-radius: 12px;

            background: linear-gradient(90deg,
                    #6D3BFF,
                    #4DA3FF,
                    #FF4FD8);

            font-weight: 600;
            letter-spacing: .5px;

            transition: .3s;
        }

        .btn:hover {
            transform: scale(1.03);

            box-shadow:
                0 0 20px rgba(181, 123, 255, .5),
                0 0 30px rgba(77, 163, 255, .3);
        }

        @media(max-width: 992px) {
            .container {
                margin-left: 0;
                padding: 25px;
            }
        }

        @media(max-width: 576px) {
            .page-header h1 {
                font-size: 30px;
            }

            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    @include('component.nav')

    <div class="container">

        <div class="page-header"><br><br><br>
            <h1>Available Exams</h1>
            <p>Select an exam and begin your assessment.</p>
        </div>

        <div class="grid">

            @foreach($exams as $exam)

            <div class="card">

                <div class="exam-title">
                    {{ $exam->title }}
                </div>

                <div class="info">

                    <div class="info-item">
                        <span class="label">Type</span>
                        <span class="value">
                            {{ ucfirst(str_replace('_',' ',$exam->type)) }}
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="label">Subject</span>
                        <span class="value">
                            {{ $exam->subject }}
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="label">Total Marks</span>
                        <span class="value">
                            {{ $exam->total_marks }}
                        </span>
                    </div>

                </div>

                <a class="btn"
                    href="{{ route('student.exam.start', $exam->id) }}">
                    🚀 Start Exam
                </a>

            </div>

            @endforeach

        </div>

    </div>

</body>

</html>