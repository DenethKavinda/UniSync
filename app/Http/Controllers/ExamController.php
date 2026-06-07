<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Attempt;
use App\Models\Question;
use App\Models\Answer;

class ExamController extends Controller
{
    public function viewExamPage()
    {
        $exams = Assessment::all();

        return view('student.exam', compact('exams'));
    }

    public function start($id)
    {
        $exam = Assessment::with('questions')->findOrFail($id);

        return view('student.exam_start', compact('exam'));
    }
    public function submit(Request $request, $id)
    {
        $attempt = Attempt::create([
            'assessment_id' => $id,
            'user_id' => auth()->id(),
            'submitted' => true
        ]);

        $score = 0;

        foreach ($request->answers as $question_id => $answer) {

            $question = Question::find($question_id);

            $isCorrect = false;

            if ($question->type == 'mcq') {
                $isCorrect = ($question->correct_answer == $answer);

                if ($isCorrect) {
                    $score += $question->marks;
                }
            }

            Answer::create([
                'attempt_id' => $attempt->id,
                'question_id' => $question_id,
                'answer' => $answer,
                'is_correct' => $isCorrect
            ]);
        }

        $attempt->update(['score' => $score]);

        return redirect()
            ->route('exam')
            ->with('success', 'Exam submitted! Score: ' . $score);
    }
}
