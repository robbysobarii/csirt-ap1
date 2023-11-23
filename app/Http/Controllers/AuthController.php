<?php


// app/Http/Controllers/AuthController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email_user', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $redirectTo = $this->redirectBasedOnRole($user->role_user);
            return redirect()->route($redirectTo);
        }

        return redirect()->route('login')->with('error', 'Invalid login credentials');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function redirectBasedOnRole($role)
    {
        switch ($role) {
            case 'admin':
                return 'admin.contentManagement'; 
            case 'pelapor':
                return 'pelapor.reportPelapor'; 
            case 'pimpinan':
                return 'pimpinan.dashboard'; 
            case 'superuser':
                return 'superuser'; 
            default:
                return 'user.beranda';
        }
    }
}
