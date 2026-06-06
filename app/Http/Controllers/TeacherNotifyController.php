<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherNotifyController extends Controller
{
    public function viewNotifyPage()
    {
        return view('teacher.teacherNotify');
    }
}
