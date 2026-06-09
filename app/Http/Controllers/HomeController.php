<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class HomeController extends Controller
{
    public function viewHomePage()
    {
        $notices = Notice::latest()->get();
        return view('student.home', compact('notices'));
    }
}
