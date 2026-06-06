<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Side Bar(Teacher)</title>
</head>

<body>
    <li><a href="{{ route('teacherdashboard') }}">Teacher Dashboard</a></li>
    <li><a href="{{ route('examManagement') }}">Exam Management</a></li>
    <li><a href="{{ route('teacherAnalyze') }}">Analyze</a></li>
    <li><a href="{{ route('teacherNotify') }}">Notify</a></li>
</body>

</html>