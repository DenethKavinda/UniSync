<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    public function viewExamResultPage()
    {
        return view('admin.examResult');
    }
}
