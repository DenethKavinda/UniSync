<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterUser;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function viewRegisterPage()
    {
        return view('register');
    }

    public function storeRegisterUsers(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:register_users',
            'password' => 'required|string|min:8',

        ]);

        // Create a new user in the database
        $user = RegisterUser::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'user', // Set a default role for the user, you can modify this as needed
        ]);

        // Redirect to a desired page after successful registration
        return redirect()->route('login')->with('success', 'Registration successful!');
    }
}
