<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Attempt;  // add this at the top with other imports

use App\Models\Question;


class ExamManagementController extends Controller
{
    public function viewExamManagementPage()
    {
        $assessments = Assessment::latest()->get();

        return view(
            'teacher.examManagement',
            compact('assessments')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'subject' => 'required'
        ]);

        Assessment::create([
            'title' => $request->title,
            'type' => $request->type,
            'subject' => $request->subject,
            'description' => $request->description,
            'assessment_date' => $request->assessment_date,
            'duration' => $request->duration,
            'total_marks' => $request->total_marks
        ]);

        return redirect()
            ->route('examManagement')
            ->with('success', 'Assessment Created Successfully');
    }


    public function questionPage($id)
    {
        $assessment = Assessment::findOrFail($id);
        $questions = Question::where('assessment_id', $id)->get();

        return view('teacher.questions', compact(
            'assessment',
            'questions'
        ));
    }

    public function storeQuestion(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'question' => 'required'
        ]);

        Question::create([
            'assessment_id' => $id,
            'type' => $request->type,
            'question' => $request->question,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'correct_answer' => $request->correct_answer,
            'marks' => $request->marks ?? 1
        ]);

        return back()->with('success', 'Question added successfully');
    }






    public function examMarks()
    {
        $attempts = Attempt::with(['assessment', 'user'])
            ->where('submitted', true)
            ->latest()
            ->get();

        return view('teacher.examMarks', compact('attempts'));
    }
}
