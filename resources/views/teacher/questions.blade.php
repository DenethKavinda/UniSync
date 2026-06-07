<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions</title>

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
            --sidebar-width: 260px;
        }

        body {
            background: linear-gradient(135deg, var(--black), var(--dark-blue));
            color: white;
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
        }

        .sidebar-wrapper {
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            background: rgba(20, 10, 40, 0.95);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        .container {
            margin-left: var(--sidebar-width);
            padding: 40px 35px;
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            flex: 1;
        }

        /* TITLE */
        h1 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 28px;
            background: linear-gradient(90deg, var(--light-purple), var(--light-blue), var(--pink));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
        }

        /* SUCCESS */
        p.success {
            background: rgba(76, 175, 80, 0.12);
            border: 1px solid rgba(76, 175, 80, 0.35);
            color: #7dff86;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        /* CARD */
        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 28px;
            box-shadow: 0 0 30px rgba(181, 123, 255, 0.08);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(181, 123, 255, 0.15);
        }

        .card h3 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--light-blue);
        }

        /* FORM ELEMENTS */
        label {
            display: block;
            margin-bottom: 7px;
            font-size: 12.5px;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 500;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            color: white;
            outline: none;
            font-size: 14px;
            font-family: 'Segoe UI', sans-serif;
            margin: 0 0 16px 0;
            transition: border-color 0.25s, box-shadow 0.25s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--light-purple);
            box-shadow: 0 0 0 3px rgba(181, 123, 255, 0.18);
        }

        input::placeholder,
        textarea::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        select option {
            background: #1a1a2e;
            color: white;
        }

        /* MCQ BOX */
        .mcq-box {
            display: none;
            animation: fadeIn 0.25s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* BUTTON */
        button[type="submit"] {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 28px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            color: white;
            background: linear-gradient(90deg, var(--light-purple), var(--light-blue), var(--pink));
            transition: transform 0.2s, box-shadow 0.2s;
            letter-spacing: 0.02em;
            margin-top: 4px;
            width: auto;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(181, 123, 255, 0.3);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        /* QUESTION LIST ITEMS */
        .question-item {
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            padding: 16px 0;
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .question-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .question-item:first-child {
            padding-top: 0;
        }

        .q-number {
            min-width: 30px;
            height: 30px;
            border-radius: 8px;
            background: rgba(181, 123, 255, 0.15);
            color: var(--light-purple);
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .q-body p {
            font-size: 14.5px;
            color: rgba(255, 255, 255, 0.88);
            line-height: 1.5;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .q-body small {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 500;
            background: rgba(77, 163, 255, 0.12);
            color: var(--light-blue);
            border: 1px solid rgba(77, 163, 255, 0.2);
        }

        /* MOBILE */
        .mobile-menu-btn {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar-wrapper {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .sidebar-wrapper.open {
                transform: translateX(0);
            }

            .container {
                margin-left: 0;
                width: 100%;
                padding: 24px 18px;
            }

            h1 {
                font-size: 1.7rem;
            }

            .mobile-menu-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                position: fixed;
                top: 16px;
                left: 16px;
                z-index: 200;
                width: 40px;
                height: 40px;
                border-radius: 10px;
                background: rgba(30, 10, 60, 0.9);
                border: 1px solid rgba(255, 255, 255, 0.1);
                cursor: pointer;
                font-size: 20px;
                color: white;
            }
        }
    </style>
</head>

<body>

    <button class="mobile-menu-btn" onclick="toggleSidebar()" aria-label="Toggle menu">&#9776;</button>

    <div class="sidebar-wrapper" id="sidebar">
        @include('component.teacherSidebar')
    </div>

    <div class="container">

        <h1>{{ $assessment->title }} - Questions</h1>

        @if(session('success'))
        <p class="success">{{ session('success') }}</p>
        @endif

        <!-- QUESTION FORM -->
        <div class="card">

            <h3>Add New Question</h3>

            <form method="POST" action="{{ route('assessment.questions.store', $assessment->id) }}">
                @csrf

                <label>Question Type</label>
                <select name="type" id="type" onchange="toggleFields()">
                    <option value="mcq">MCQ</option>
                    <option value="structured">Structured</option>
                </select>

                <label>Question</label>
                <textarea name="question" placeholder="Enter Question"></textarea>

                <!-- MCQ FIELDS -->
                <div id="mcqBox" class="mcq-box">
                    <label>Options</label>
                    <input name="option_a" placeholder="Option A">
                    <input name="option_b" placeholder="Option B">
                    <input name="option_c" placeholder="Option C">
                    <input name="option_d" placeholder="Option D">
                    <label>Correct Answer</label>
                    <input name="correct_answer" placeholder="Correct Answer (A/B/C/D)">
                </div>

                <label>Marks</label>
                <input name="marks" type="number" placeholder="Marks">

                <button type="submit">Add Question</button>

            </form>

        </div>

        <!-- QUESTION LIST -->
        <div class="card">

            <h3>Added Questions</h3>

            @foreach($questions as $index => $q)
            <div class="question-item">
                <div class="q-number">{{ $index + 1 }}</div>
                <div class="q-body">
                    <p>{{ $q->question }}</p>
                    <small>{{ $q->type }}</small>
                </div>
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

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
        }

        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const btn = document.querySelector('.mobile-menu-btn');
            if (window.innerWidth <= 768 && btn && !sidebar.contains(e.target) && !btn.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });
    </script>

</body>

</html>