<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt; // Import the Crypt facade

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Get the email and password values
        $encryptedEmail = $request->input('email');
        $encryptedPassword = $request->input('password');

        // Decrypt the values on the server side (Note: Laravel's decrypt is used here)
        $originalEmail = decrypt($encryptedEmail);
        $originalPassword = decrypt($encryptedPassword);

        // Use the original values for authentication
        $credentials = [
            'email' => $originalEmail,
            'password' => $originalPassword,
        ];

        dd($credentials);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            $redirectTo = Role::redirectBasedOnRole($user->role_user);
            return redirect()->route($redirectTo);
        }

        return redirect()->route('user.laporkanInsiden')->with('error', 'Please check your username and password');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.laporkanInsiden');
    }
}
