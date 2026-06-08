<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterUser;


class AdminController extends Controller
{
    public function viewAdminDashboard()
    {
        $userCount = RegisterUser::count();
        return view('admin.admindashboard', compact('userCount'));
    }
}
