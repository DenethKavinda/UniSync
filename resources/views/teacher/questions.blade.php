<!DOCTYPE html>
<html>

<head>
    <title>Questions</title>

    <style>
        body {
            margin: 0;
            font-family: Segoe UI;
            background: #0f172a;
            color: white;
        }

        .container {
            margin-left: 260px;
            padding: 30px;
        }

        .card {
            background: #1e293b;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 8px;
        }

        .mcq-box {
            display: none;
        }

        button {
            padding: 10px 20px;
            background: #8b5cf6;
            border: none;
            color: white;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    @include('component.teacherSidebar')

    <div class="container">

        <h1>{{ $assessment->title }} - Questions</h1>

        @if(session('success'))
        <p>{{ session('success') }}</p>
        @endif

        <!-- QUESTION FORM -->
        <div class="card">

            <form method="POST"
                action="{{ route('assessment.questions.store',$assessment->id) }}">

                @csrf

                <label>Question Type</label>
                <select name="type" id="type" onchange="toggleFields()">

                    <option value="mcq">MCQ</option>
                    <option value="structured">Structured</option>

                </select>

                <textarea name="question"
                    placeholder="Enter Question"></textarea>

                <!-- MCQ FIELDS -->
                <div id="mcqBox">

                    <input name="option_a" placeholder="Option A">
                    <input name="option_b" placeholder="Option B">
                    <input name="option_c" placeholder="Option C">
                    <input name="option_d" placeholder="Option D">

                    <input name="correct_answer"
                        placeholder="Correct Answer (A/B/C/D)">

                </div>

                <input name="marks" type="number" placeholder="Marks">

                <button type="submit">Add Question</button>

            </form>

        </div>

        <!-- QUESTION LIST -->
        <div class="card">

            <h3>Added Questions</h3>

            @foreach($questions as $q)

            <div style="border-bottom:1px solid #334155; padding:10px">

                <p><b>{{ $q->question }}</b></p>

                <small>{{ $q->type }}</small>

            </div>

            @endforeach

        </div>

    </div>

    <script>
        function toggleFields() {
            let type = document.getElementById('type').value;
            let mcqBox = document.getElementById('mcqBox');

            mcqBox.style.display = (type === 'mcq') ?
                'block' :
                'none';
        }

        toggleFields();
    </script>

</body>

</html>