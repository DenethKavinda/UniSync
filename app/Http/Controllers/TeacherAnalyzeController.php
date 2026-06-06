<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherAnalyzeController extends Controller
{
    public function viewAnalyzePage()
    {
        return view('teacher.teacherAnalyze');
    }
}
