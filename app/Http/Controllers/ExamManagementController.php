<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamManagementController extends Controller
{
    public function viewExamManagementPage()
    {
        return view('teacher.examManagement');
    }
}
