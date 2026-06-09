<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class TeacherNotifyController extends Controller
{
    public function viewNotifyPage()
    {
        $notices = Notice::latest()->get();
        return view('teacher.teacherNotify', compact('notices'));
    }
}
