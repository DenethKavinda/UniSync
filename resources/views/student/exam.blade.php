<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Exams</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #07070c, #0a1a3d);
            color: white;
        }

        .container {
            padding: 40px;
            margin-left: 260px;
        }

        h1 {
            color: #b57bff;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background: linear-gradient(90deg, #b57bff, #4da3ff, #ff4fd8);
            color: white;
            border-radius: 10px;
            text-decoration: none;
        }
    </style>
</head>

<body>

    @include('component.nav')

    <div class="container">

        <h1>Available Exams</h1>

        <div class="grid">

            @foreach($exams as $exam)

            <div class="card">

                <h3>{{ $exam->title }}</h3>

                <p>Type: {{ ucfirst(str_replace('_',' ',$exam->type)) }}</p>
                <p>Subject: {{ $exam->subject }}</p>
                <p>Marks: {{ $exam->total_marks }}</p>

                <a class="btn"
                    href="{{ route('student.exam.start', $exam->id) }}">
                    Start Exam
                </a>

            </div>

            @endforeach

        </div>

    </div>

</body>

</html>