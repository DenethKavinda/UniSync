<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Start Exam</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", sans-serif;
        }

        body {
            background: linear-gradient(135deg, #07070C, #0A1A3D);
            color: white;
            min-height: 100vh;
        }

        .container {
            margin-left: 260px;
            padding: 30px;
            max-width: 1100px;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;

            background: linear-gradient(90deg,
                    #B57BFF,
                    #4DA3FF,
                    #FF4FD8);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-subtitle {
            margin-top: 8px;
            color: #cfcfcf;
            font-size: 14px;
        }

        .question {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.10);
            border-left: 4px solid #B57BFF;

            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }

        .question h3 {
            font-size: 18px;
            font-weight: 600;
            line-height: 1.8;
            margin-bottom: 20px;
            color: white;
        }

        .option {
            display: flex;
            align-items: flex-start;
            gap: 12px;

            padding: 14px;
            margin-bottom: 10px;

            border-radius: 10px;
            background: rgba(255, 255, 255, 0.03);

            cursor: pointer;
            transition: 0.3s;
        }

        .option:hover {
            background: rgba(181, 123, 255, 0.12);
        }

        .option input[type="radio"] {
            margin-top: 3px;
            accent-color: #B57BFF;
        }

        .option span {
            line-height: 1.6;
            flex: 1;
        }

        textarea {
            width: 100%;
            min-height: 180px;

            padding: 15px;
            border-radius: 10px;

            background: rgba(255, 255, 255, 0.05);
            color: white;

            border: 1px solid rgba(255, 255, 255, 0.10);
            outline: none;
            resize: vertical;
        }

        textarea:focus {
            border-color: #B57BFF;
            box-shadow: 0 0 15px rgba(181, 123, 255, 0.2);
        }

        textarea::placeholder {
            color: #bdbdbd;
        }

        .submit-area {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 50px;
        }

        .btn {
            border: none;
            cursor: pointer;

            padding: 14px 35px;
            border-radius: 10px;

            font-size: 15px;
            font-weight: 600;
            color: white;

            background: linear-gradient(90deg,
                    #B57BFF,
                    #4DA3FF,
                    #FF4FD8);

            transition: 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);

            box-shadow:
                0 0 15px rgba(181, 123, 255, 0.4),
                0 0 25px rgba(77, 163, 255, 0.2);
        }

        @media (max-width: 992px) {
            .container {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    @include('component.nav')

    <div class="container">

        <div class="page-header"><br><br><br>
            <h1 class="page-title">{{ $exam->title }}</h1>

            <p class="page-subtitle">
                Answer all questions and submit your exam when finished.
            </p>
        </div>

        <form method="POST"
            action="{{ route('student.exam.submit', $exam->id) }}">

            @csrf

            @foreach($exam->questions as $index => $q)

            <div class="question">

                <h3>
                    Q{{ $index + 1 }}. {{ $q->question }}
                </h3>

                @if($q->type == 'mcq')

                <label class="option">
                    <input type="radio"
                        name="answers[{{ $q->id }}]"
                        value="A">

                    <span>{{ $q->option_a }}</span>
                </label>

                <label class="option">
                    <input type="radio"
                        name="answers[{{ $q->id }}]"
                        value="B">

                    <span>{{ $q->option_b }}</span>
                </label>

                <label class="option">
                    <input type="radio"
                        name="answers[{{ $q->id }}]"
                        value="C">

                    <span>{{ $q->option_c }}</span>
                </label>

                <label class="option">
                    <input type="radio"
                        name="answers[{{ $q->id }}]"
                        value="D">

                    <span>{{ $q->option_d }}</span>
                </label>

                @else

                <textarea
                    name="answers[{{ $q->id }}]"
                    placeholder="Write your answer here..."></textarea>

                @endif

            </div>

            @endforeach

            <div class="submit-area">
                <button type="submit" class="btn">
                    Submit Exam
                </button>
            </div>

        </form>

    </div>

</body>

</html>