<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminNotifyController extends Controller
{
    public function viewNotifyPage()
    {
        return view('admin.adminNotify');
    }
}
