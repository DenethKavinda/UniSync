<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sidebar</title>
</head>

<body>
    <li><a href="{{ route('admindashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('userManagement') }}">User Management</a></li>
    <li><a href="{{ route('examResult') }}">Exam Result</a></li>
    <li><a href="{{ route('inquiryManagement') }}">Inquiry Management</a></li>
    <li><a href="{{ route('adminNotify') }}">Notify</a></li>
    <li><a href="{{ route('adminAnalyze') }}">Analyze</a></li>

</body>

</html>