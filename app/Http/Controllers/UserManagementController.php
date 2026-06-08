<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterUser;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of user records.
     */
    public function viewUserManagementPage()
    {
        $users = RegisterUser::all();
        return view('admin.userManagement', compact('users'));
    }

    /**
     * Remove the specified user account from DB storage.
     */
    public function destroy($id)
    {
        $user = RegisterUser::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    /**
     * Update user details or structural access role dynamically in database.
     */
    public function update(Request $request, $id)
    {
        // 1. Run rigorous inputs matching conditions check
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:register_users,email,' . $id,
            'role'  => 'required|in:user,teacher,admin',
        ]);

        // 2. Map data fields and persist update actions
        $user = RegisterUser::findOrFail($id);
        $user->update($validated);

        // 3. Conditional verification sorting background requests vs fallback forms
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'User settings updated successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'User profile information updated successfully.');
    }

    /**
     * Store a newly created user account entry into database memory space.
     */
    public function store(Request $request)
    {
        // 1. Enforce input structural layout conditions rules
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:register_users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:user,teacher,admin',
        ]);

        // 2. Commit encryption processing and save to database context
        RegisterUser::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        return redirect()->route('userManagement')->with('success', 'New user account created successfully.');
    }
}
