<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\RegisterUser;

class ProfileController extends Controller
{
    // Ensure only logged-in users can access these methods
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();
        return view('student.profile', compact('user'));
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /** @var RegisterUser $user */
        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            // Delete old image if it exists
            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }

            // Store the new image in the public storage directory
            $path = $request->file('profile_image')->store('profile_images', 'public');

            // Save the path to the user record
            $user->profile_image = $path;
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile picture updated successfully!');
    }
}
