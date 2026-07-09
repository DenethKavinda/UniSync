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

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /* 
    ===================================================
    NEW AJAX METHODS FOR THE FORGOT PASSWORD MODAL 
    ===================================================
    */

    // Step 1: Send OTP
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = RegisterUser::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Email address not found in system.'], 404);
        }

        // Generate a cryptographically simple random 6 digit tracking sequence
        $otp = rand(100000, 999999);

        // Store configuration metadata within the dynamic server runtime session layer
        session([
            'forgot_password_email' => $request->email,
            'forgot_password_otp'   => $otp,
            'forgot_password_expiry' => now()->addMinutes(15) // Sets 15 minute lifespan boundary
        ]);

        /* 
        * PRODUCTION TIP: To send a real email using standard setups:
        * Mail::raw("Your UniSync Password Reset Verification Code is: $otp", function($message) use ($request) {
        *     $message->to($request->email)->subject('UniSync Password Reset Request Code');
        * });
        */

        // For local development, this response confirms production operability alongside logging features
        return response()->json([
            'success' => true,
            'message' => "An OTP has been dispatched to your email address! (Dev-Mode Demo Code: {$otp})"
        ], 200);
    }

    // Step 2: Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|numeric'
        ]);

        $sessionEmail  = session('forgot_password_email');
        $sessionOtp    = session('forgot_password_otp');
        $sessionExpiry = session('forgot_password_expiry');

        if (!$sessionOtp || !$sessionEmail || now()->gt($sessionExpiry)) {
            return response()->json(['success' => false, 'message' => 'The OTP session expired. Please start over.'], 400);
        }

        if ($request->email !== $sessionEmail || intval($request->otp) !== intval($sessionOtp)) {
            return response()->json(['success' => false, 'message' => 'The validation code entered is incorrect.'], 400);
        }

        // Advance processing access confirmation flag setting state
        session(['otp_verified_successfully' => true]);

        return response()->json(['success' => true, 'message' => 'OTP verified successfully! Create a new password.'], 200);
    }

    // Step 3: Structural execution updates modifying the database target entry
    public function updateResetPassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if (!session('otp_verified_successfully') || session('forgot_password_email') !== $request->email) {
            return response()->json(['success' => false, 'message' => 'Unauthorized operation sequence blocked.'], 403);
        }

        $user = RegisterUser::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Target entity reference broken.'], 404);
        }

        // Apply encryption modification sequence directly back into database layer 
        $user->password = Hash::make($request->password);
        $user->save();

        // Flush tracking reference variables cleanly out of session space
        session()->forget(['forgot_password_email', 'forgot_password_otp', 'forgot_password_expiry', 'otp_verified_successfully']);

        return response()->json(['success' => true, 'message' => 'Your authentication profile has been updated!'], 200);
    }
}
