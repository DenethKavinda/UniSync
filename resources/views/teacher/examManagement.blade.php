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
            --sidebar-width: 260px;
        }

        body {
            background: linear-gradient(135deg, var(--black), var(--dark-blue));
            color: white;
            min-height: 100vh;
            overflow-x: hidden;
            display: flex;
        }

        /* SIDEBAR WRAPPER */
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

        /* MAIN CONTENT AREA */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 40px 35px;
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            flex: 1;
        }

        /* TITLE */
        .page-title {
            font-size: 2.4rem;
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

        /* SUCCESS */
        .success-message {
            background: rgba(76, 175, 80, 0.15);
            border: 1px solid rgba(76, 175, 80, 0.4);
            color: #7dff86;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        /* CARD */
        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 28px;
            box-shadow: 0 0 30px rgba(181, 123, 255, 0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(181, 123, 255, 0.18);
        }

        .card-title {
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 22px;
            color: var(--light-blue);
        }

        /* FORM GRID */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            color: #c0c0d0;
            font-weight: 500;
            letter-spacing: 0.02em;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.06);
            color: white;
            outline: none;
            font-size: 14px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--light-purple);
            box-shadow: 0 0 0 3px rgba(181, 123, 255, 0.2);
        }

        input::placeholder,
        textarea::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        select option {
            background: #1a1a2e;
            color: white;
        }

        /* BUTTON */
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 13px 30px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            color: white;
            background: linear-gradient(90deg,
                    var(--light-purple),
                    var(--light-blue),
                    var(--pink));
            transition: transform 0.25s, box-shadow 0.25s;
            letter-spacing: 0.02em;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(181, 123, 255, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        /* ASSESSMENT GRID */
        .assessment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 18px;
        }

        /* ASSESSMENT CARD */
        .assessment-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 22px;
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .assessment-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(181, 123, 255, 0.18);
        }

        .assessment-card h3 {
            color: var(--light-purple);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 0.78rem;
            font-weight: 500;
            background: rgba(77, 163, 255, 0.15);
            color: var(--light-blue);
            margin-bottom: 8px;
            width: fit-content;
            border: 1px solid rgba(77, 163, 255, 0.25);
        }

        .info {
            color: #c0c0d0;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .question-btn {
            display: inline-block;
            margin-top: 14px;
            padding: 10px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            color: white;
            background: linear-gradient(90deg, #8b5cf6, #3b82f6, #ff4fd8);
            transition: transform 0.2s, box-shadow 0.2s;
            width: fit-content;
        }

        .question-btn:hover {
            transform: scale(1.04);
            box-shadow: 0 6px 18px rgba(139, 92, 246, 0.35);
        }

        /* EMPTY STATE */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px 20px;
            color: rgba(255, 255, 255, 0.35);
            font-size: 15px;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .form-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 900px) {
            :root {
                --sidebar-width: 220px;
            }
        }

        @media (max-width: 768px) {
            .sidebar-wrapper {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }

            .sidebar-wrapper.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 24px 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 1.8rem;
            }

            .assessment-grid {
                grid-template-columns: 1fr;
            }

            /* Mobile menu toggle */
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

        @media (min-width: 769px) {
            .mobile-menu-btn {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn" onclick="toggleSidebar()" aria-label="Toggle menu">&#9776;</button>

    <!-- SIDEBAR -->
    <div class="sidebar-wrapper" id="sidebar">
        @include('component.teacherSidebar')
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <h1 class="page-title">Assessment Management</h1>

        @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
        @endif

        <!-- CREATE ASSESSMENT CARD -->
        <div class="card">
            <h2 class="card-title">Create New Assessment</h2>

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
                        <input type="number" name="duration" placeholder="e.g. 60">
                    </div>

                    <div>
                        <label>Total Marks</label>
                        <input type="number" name="total_marks" placeholder="e.g. 100">
                    </div>

                    <div class="full-width">
                        <label>Description</label>
                        <textarea name="description" placeholder="Enter assessment description"></textarea>
                    </div>

                </div>

                <button class="btn" type="submit">Create Assessment</button>

            </form>
        </div>

        <!-- EXISTING ASSESSMENTS -->
        <div class="card">
            <h2 class="card-title">Existing Assessments</h2>

            <div class="assessment-grid">

                @forelse($assessments as $assessment)

                <div class="assessment-card">
                    <h3>{{ $assessment->title }}</h3>

                    <span class="badge">
                        {{ ucfirst(str_replace('_', ' ', $assessment->type)) }}
                    </span>

                    <div class="info">📚 {{ $assessment->subject }}</div>
                    <div class="info">📝 {{ $assessment->total_marks }} Marks</div>
                    <div class="info">⏰ {{ $assessment->duration }} Minutes</div>
                    <div class="info">📅 {{ $assessment->assessment_date }}</div>

                    <a href="{{ route('assessment.questions', $assessment->id) }}" class="question-btn">
                        📝 Manage Questions
                    </a>
                </div>

                @empty

                <div class="empty-state">
                    No assessments created yet.
                </div>

                @endforelse

            </div>
        </div>

    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const btn = document.querySelector('.mobile-menu-btn');
            if (window.innerWidth <= 768 && !sidebar.contains(e.target) && !btn.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });
    </script>

</body>

</html>