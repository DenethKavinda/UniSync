<?php

namespace App\Http\Controllers;

use App\Models\Attempt;

use Illuminate\Http\Request;

class TeacherExamMarksController extends Controller
{
    public function viewExamMarks()
    {
        $attempts = Attempt::with(['assessment', 'user'])
            ->where('submitted', true)
            ->latest()
            ->get();

        return view('teacher.examMarks', compact('attempts'));
    }
}
