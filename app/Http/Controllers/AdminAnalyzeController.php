<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAnalyzeController extends Controller
{
    public function viewAnalyzePage()
    {
        return view('admin.adminAnalyze');
    }
}
