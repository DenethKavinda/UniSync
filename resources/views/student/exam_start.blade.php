<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Start Exam</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #0a1a3d;
            color: white;
        }

        .container {
            padding: 40px;
            margin-left: 260px;
        }

        .question {
            background: rgba(255, 255, 255, 0.05);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 12px;
        }

        input,
        textarea {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            border-radius: 8px;
            border: none;
        }

        .btn {
            padding: 12px 20px;
            background: linear-gradient(90deg, #b57bff, #4da3ff, #ff4fd8);
            border: none;
            color: white;
            border-radius: 10px;
            cursor: pointer;
        }

        .option {
            margin: 5px 0;
        }
    </style>
</head>

<body>

    @include('component.nav')

    <div class="container">

        <h1>{{ $exam->title }}</h1>

        <form method="POST" action="{{ route('student.exam.submit', $exam->id) }}">
            @csrf

            @foreach($exam->questions as $q)

            <div class="question">

                <h3>{{ $q->question }}</h3>

                @if($q->type == 'mcq')

                <label class="option">
                    <input type="radio" name="answers[{{ $q->id }}]" value="A">
                    {{ $q->option_a }}
                </label>

                <label class="option">
                    <input type="radio" name="answers[{{ $q->id }}]" value="B">
                    {{ $q->option_b }}
                </label>

                <label class="option">
                    <input type="radio" name="answers[{{ $q->id }}]" value="C">
                    {{ $q->option_c }}
                </label>

                <label class="option">
                    <input type="radio" name="answers[{{ $q->id }}]" value="D">
                    {{ $q->option_d }}
                </label>

                @else

                <textarea name="answers[{{ $q->id }}]" placeholder="Write your answer..."></textarea>

                @endif

            </div>

            @endforeach

            <button class="btn" type="submit">
                Submit Exam
            </button>

        </form>

    </div>

</body>

</html>