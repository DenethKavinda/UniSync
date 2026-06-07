<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Marks</title>

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

        .main-content {
            margin-left: var(--sidebar-width);
            padding: 40px 35px;
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            flex: 1;
        }

        /* TITLE */
        .page-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 8px;
            background: linear-gradient(90deg, var(--light-purple), var(--light-blue), var(--pink));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-subtitle {
            color: rgba(255, 255, 255, 0.35);
            font-size: 14px;
            margin-bottom: 32px;
        }

        /* SUCCESS */
        .success-message {
            background: rgba(76, 175, 80, 0.12);
            border: 1px solid rgba(76, 175, 80, 0.35);
            color: #7dff86;
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        /* STATS ROW */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 16px;
            padding: 20px 22px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(181, 123, 255, 0.15);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(90deg, var(--light-purple), var(--light-blue));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1;
            margin-bottom: 6px;
        }

        .stat-label {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.35);
            text-transform: uppercase;
            letter-spacing: 0.05em;
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

        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 22px;
            color: var(--light-blue);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* FILTER ROW */
        .filter-row {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .filter-row input,
        .filter-row select {
            padding: 10px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
            color: white;
            font-size: 13.5px;
            font-family: 'Segoe UI', sans-serif;
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s;
        }

        .filter-row input {
            flex: 1;
            min-width: 180px;
        }

        .filter-row select {
            min-width: 160px;
        }

        .filter-row input:focus,
        .filter-row select:focus {
            border-color: var(--light-purple);
            box-shadow: 0 0 0 3px rgba(181, 123, 255, 0.15);
        }

        .filter-row input::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        .filter-row select option {
            background: #1a1a2e;
            color: white;
        }

        /* TABLE */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        thead tr {
            background: rgba(181, 123, 255, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        thead th {
            padding: 14px 16px;
            text-align: left;
            font-size: 11.5px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: background 0.2s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: rgba(181, 123, 255, 0.06);
        }

        tbody td {
            padding: 14px 16px;
            color: rgba(255, 255, 255, 0.82);
            vertical-align: middle;
        }

        /* STUDENT CELL */
        .student-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--light-purple), var(--pink));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
            color: white;
        }

        .student-name {
            font-weight: 500;
            font-size: 14px;
        }

        .student-email {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.35);
        }

        /* TYPE BADGE */
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 500;
            white-space: nowrap;
        }

        .badge-quiz {
            background: rgba(77, 163, 255, 0.12);
            color: var(--light-blue);
            border: 1px solid rgba(77, 163, 255, 0.2);
        }

        .badge-mid {
            background: rgba(255, 79, 216, 0.1);
            color: var(--pink);
            border: 1px solid rgba(255, 79, 216, 0.2);
        }

        .badge-final {
            background: rgba(181, 123, 255, 0.12);
            color: var(--light-purple);
            border: 1px solid rgba(181, 123, 255, 0.2);
        }

        .badge-assignment {
            background: rgba(255, 200, 80, 0.1);
            color: #ffc850;
            border: 1px solid rgba(255, 200, 80, 0.2);
        }

        /* SCORE BAR */
        .score-cell {
            min-width: 140px;
        }

        .score-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }

        .score-number {
            font-weight: 600;
            font-size: 14px;
        }

        .score-pct {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.4);
        }

        .score-bar-bg {
            width: 100%;
            height: 5px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 10px;
            overflow: hidden;
        }

        .score-bar-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 0.6s ease;
        }

        .fill-high {
            background: linear-gradient(90deg, #4ade80, #22d3ee);
        }

        .fill-mid {
            background: linear-gradient(90deg, var(--light-purple), var(--light-blue));
        }

        .fill-low {
            background: linear-gradient(90deg, var(--pink), #ff8c42);
        }

        /* RESULT BADGE */
        .result-pass {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: rgba(74, 222, 128, 0.12);
            color: #4ade80;
            border: 1px solid rgba(74, 222, 128, 0.25);
        }

        .result-fail {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: rgba(255, 79, 216, 0.1);
            color: var(--pink);
            border: 1px solid rgba(255, 79, 216, 0.25);
        }

        /* EMPTY */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: rgba(255, 255, 255, 0.25);
        }

        .empty-state-icon {
            font-size: 44px;
            margin-bottom: 14px;
        }

        .empty-state p {
            font-size: 14px;
        }

        /* MOBILE */
        .mobile-menu-btn {
            display: none;
        }

        @media (max-width: 1100px) {
            .stats-row {
                grid-template-columns: repeat(2, 1fr);
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

            .stats-row {
                grid-template-columns: 1fr 1fr;
            }

            .page-title {
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

    <div class="main-content">

        <h1 class="page-title">Exam Marks</h1>
        <p class="page-subtitle">Student submission results across all assessments</p>

        @if(session('success'))
        <div class="success-message">✅ {{ session('success') }}</div>
        @endif

        <!-- STATS -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-value">{{ $attempts->count() }}</div>
                <div class="stat-label">Total Submissions</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $attempts->unique('user_id')->count() }}</div>
                <div class="stat-label">Students Attempted</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">
                    {{ $attempts->count() ? round($attempts->avg(fn($a) => $a->assessment->total_marks > 0 ? ($a->score / $a->assessment->total_marks) * 100 : 0)) : 0 }}%
                </div>
                <div class="stat-label">Average Score</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">
                    {{ $attempts->filter(fn($a) => $a->assessment->total_marks > 0 && ($a->score / $a->assessment->total_marks) >= 0.5)->count() }}
                </div>
                <div class="stat-label">Passed</div>
            </div>
        </div>

        <!-- TABLE CARD -->
        <div class="card">

            <div class="card-title">
                All Results
            </div>

            <!-- FILTER -->
            <div class="filter-row">
                <input type="text" id="searchInput" placeholder="🔍  Search student or assessment…" onkeyup="filterTable()">
                <select id="typeFilter" onchange="filterTable()">
                    <option value="">All Types</option>
                    <option value="quiz">Quiz</option>
                    <option value="mid_exam">Mid Exam</option>
                    <option value="final_exam">Final Exam</option>
                    <option value="assignment">Assignment</option>
                </select>
            </div>

            <div class="table-wrapper">
                <table id="marksTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Assessment</th>
                            <th>Type</th>
                            <th>Score</th>
                            <th>Result</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($attempts as $index => $attempt)

                        @php
                        $total = $attempt->assessment->total_marks ?? 0;
                        $score = $attempt->score ?? 0;
                        $pct = $total > 0 ? round(($score / $total) * 100) : 0;
                        $pass = $pct >= 50;
                        $fillClass = $pct >= 75 ? 'fill-high' : ($pct >= 50 ? 'fill-mid' : 'fill-low');
                        $initials = strtoupper(substr($attempt->user->name ?? 'U', 0, 1));
                        $type = $attempt->assessment->type ?? '';
                        $badgeClass = match($type) {
                        'quiz' => 'badge-quiz',
                        'mid_exam' => 'badge-mid',
                        'final_exam' => 'badge-final',
                        default => 'badge-assignment',
                        };
                        @endphp

                        <tr data-name="{{ strtolower($attempt->user->name ?? '') }}"
                            data-title="{{ strtolower($attempt->assessment->title ?? '') }}"
                            data-type="{{ $type }}">

                            <td style="color: rgba(255,255,255,0.3); font-size:13px;">{{ $index + 1 }}</td>

                            <td>
                                <div class="student-cell">
                                    <div class="avatar">{{ $initials }}</div>
                                    <div>
                                        <div class="student-name">{{ $attempt->user->name ?? 'Unknown' }}</div>
                                        <div class="student-email">{{ $attempt->user->email ?? '' }}</div>
                                    </div>
                                </div>
                            </td>

                            <td style="font-weight:500;">{{ $attempt->assessment->title ?? '—' }}</td>

                            <td>
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst(str_replace('_', ' ', $type)) }}
                                </span>
                            </td>

                            <td class="score-cell">
                                <div class="score-top">
                                    <span class="score-number">{{ $score }} / {{ $total }}</span>
                                    <span class="score-pct">{{ $pct }}%</span>
                                </div>
                                <div class="score-bar-bg">
                                    <div class="score-bar-fill {{ $fillClass }}" style="width: {{ $pct }}%"></div>
                                </div>
                            </td>

                            <td>
                                @if($pass)
                                <span class="result-pass">✓ Pass</span>
                                @else
                                <span class="result-fail">✗ Fail</span>
                                @endif
                            </td>

                            <td style="color: rgba(255,255,255,0.4); font-size:13px; white-space:nowrap;">
                                {{ $attempt->created_at->format('d M Y') }}
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-state-icon">📭</div>
                                    <p>No exam submissions yet.</p>
                                </div>
                            </td>
                        </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <script>
        function filterTable() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const type = document.getElementById('typeFilter').value.toLowerCase();
            const rows = document.querySelectorAll('#marksTable tbody tr');

            rows.forEach(row => {
                const name = row.dataset.name || '';
                const title = row.dataset.title || '';
                const rtype = row.dataset.type || '';

                const matchSearch = name.includes(search) || title.includes(search);
                const matchType = type === '' || rtype === type;

                row.style.display = (matchSearch && matchType) ? '' : 'none';
            });
        }

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