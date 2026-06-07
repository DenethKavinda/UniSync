<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Management</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        :root {
            --dark-purple: #2b0a3d;
            --dark-blue: #0a1a3d;
            --black: #07070c;
            --light-purple: #b57bff;
            --light-blue: #4da3ff;
            --pink: #ff4fd8;
            --white: #ffffff;
        }

        body {
            background: linear-gradient(135deg, var(--black), var(--dark-blue));
            color: white;
            min-height: 100vh;
        }

        .container {
            margin-left: 260px;
            padding: 40px;
        }

        .page-title {
            font-size: 2.3rem;
            font-weight: 700;
            margin-bottom: 30px;
            background: linear-gradient(90deg,
                    var(--light-purple),
                    var(--light-blue),
                    var(--pink));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .success-message {
            background: rgba(76, 175, 80, 0.15);
            border: 1px solid rgba(76, 175, 80, 0.4);
            color: #7dff86;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 0 30px rgba(181, 123, 255, 0.15);
        }

        .card-title {
            font-size: 1.4rem;
            margin-bottom: 25px;
            color: var(--light-blue);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .full-width {
            grid-column: 1/-1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #d4d4d4;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, .1);
            background: rgba(255, 255, 255, .08);
            color: white;
            outline: none;
            transition: .3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--light-purple);
            box-shadow: 0 0 15px rgba(181, 123, 255, .4);
        }

        select option {
            color: black;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .btn {
            margin-top: 20px;
            padding: 14px 30px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(90deg,
                    var(--light-purple),
                    var(--light-blue),
                    var(--pink));
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: .3s;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(181, 123, 255, .3);
        }

        .assessment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .assessment-card {
            background: rgba(255, 255, 255, .05);
            border-radius: 18px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, .08);
            transition: .3s;
        }

        .assessment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 25px rgba(181, 123, 255, .2);
        }

        .assessment-card h3 {
            margin-bottom: 10px;
            color: var(--light-purple);
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: .8rem;
            margin-bottom: 15px;
            background: rgba(77, 163, 255, .2);
            color: var(--light-blue);
        }

        .info {
            margin-bottom: 8px;
            color: #d0d0d0;
        }

        .question-btn {
            display: inline-block;
            margin-top: 12px;
            padding: 10px 14px;
            background: linear-gradient(90deg, #8b5cf6, #3b82f6, #ff4fd8);
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .question-btn:hover {
            transform: scale(1.05);
        }

        @media(max-width:768px) {

            .container {
                margin-left: 0;
                padding: 20px;
            }

            .page-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>

    @include('component.teacherSidebar')

    <div class="container">

        <h1 class="page-title">
            Assessment Management
        </h1>

        @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
        @endif

        <!-- Create Assessment -->
        <div class="card">

            <h2 class="card-title">
                Create New Assessment
            </h2>

            <form action="{{ route('assessment.store') }}" method="POST">
                @csrf

                <div class="form-grid">

                    <div>
                        <label>Assessment Title</label>
                        <input type="text" name="title" placeholder="Enter title">
                    </div>

                    <div>
                        <label>Assessment Type</label>
                        <select name="type">
                            <option value="quiz">Quiz</option>
                            <option value="mid_exam">Mid Exam</option>
                            <option value="final_exam">Final Exam</option>
                            <option value="assignment">Assignment</option>
                        </select>
                    </div>

                    <div>
                        <label>Subject</label>
                        <input type="text" name="subject" placeholder="Enter subject">
                    </div>

                    <div>
                        <label>Date</label>
                        <input type="date" name="assessment_date">
                    </div>

                    <div>
                        <label>Duration (Minutes)</label>
                        <input type="number" name="duration" placeholder="Duration">
                    </div>

                    <div>
                        <label>Total Marks</label>
                        <input type="number" name="total_marks" placeholder="Total Marks">
                    </div>

                    <div class="full-width">
                        <label>Description</label>
                        <textarea name="description" placeholder="Enter assessment description"></textarea>
                    </div>

                </div>

                <button class="btn" type="submit">
                    Create Assessment
                </button>

            </form>

        </div>

        <!-- Assessment List -->
        <div class="card">

            <h2 class="card-title">
                Existing Assessments
            </h2>

            <div class="assessment-grid">

                @forelse($assessments as $assessment)

                <div class="assessment-card">

                    <h3>{{ $assessment->title }}</h3>

                    <span class="badge">
                        {{ ucfirst(str_replace('_',' ', $assessment->type)) }}
                    </span>

                    <div class="info">
                        📚 Subject: {{ $assessment->subject }}
                    </div>

                    <div class="info">
                        📝 Marks: {{ $assessment->total_marks }}
                    </div>

                    <div class="info">
                        ⏰ Duration: {{ $assessment->duration }} Minutes
                    </div>

                    <div class="info">
                        📅 Date: {{ $assessment->assessment_date }}
                    </div>

                    <!-- ✅ IMPORTANT BUTTON ADDED -->
                    <a href="{{ route('assessment.questions', $assessment->id) }}"
                        class="question-btn">
                        📝 Manage Questions
                    </a>


                </div>

                @empty

                <div class="assessment-card">
                    No assessments created yet.
                </div>

                @endforelse

            </div>

        </div>

    </div>

</body>

</html>