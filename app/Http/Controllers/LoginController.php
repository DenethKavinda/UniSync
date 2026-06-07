<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function viewLoginPage()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect('/admin/admindashboard');
            }

            if ($user->role == 'teacher') {
                return redirect('/teacher/teacherdashboard');
            }

            return redirect('/student/home');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }
}
