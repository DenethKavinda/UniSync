<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterUser;

class UserManagementController extends Controller
{
    public function viewUserManagementPage()
    {
        return view('admin.userManagement');
    }

    // Delete a user
    public function destroy($id)
    {
        $user = RegisterUser::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
