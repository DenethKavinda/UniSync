<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Exam Result</title>

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
            text-align: center;
        }

        .box {
            background: rgba(255, 255, 255, 0.05);
            padding: 30px;
            border-radius: 15px;
            display: inline-block;
        }

        h1 {
            color: #b57bff;
        }

        .score {
            font-size: 40px;
            color: #4da3ff;
        }
    </style>
</head>

<body>

    @include('component.studentSidebar')

    <div class="container">

        <div class="box">

            <h1>Exam Result</h1>

            <p class="score">
                {{ $score ?? '0' }} / {{ $total ?? '0' }}
            </p>

            <p>Good Job 👍</p>

        </div>

    </div>

</body>

</html>