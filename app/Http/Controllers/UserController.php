<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['email'] = trim($credentials['email']);
    
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    
        $user = JWTAuth::user();
    
        // Check if the user has the 'role' attribute
        if (!$user->role_user) {
            // Handle the case where the user's role is not set
            return response()->json(['error' => 'Role information not found for the user'], 401);
        }
    
        $role_user = $user->role_user;
    
        // Menentukan rute berdasarkan peran (role) pengguna
        $redirectRoute = $this->getRedirectRouteByRole($role_user);
    
        return response()->json([
            'token' => $token,
            'role' => $role_user,
            'redirect_route' => $redirectRoute,
        ]);
    }
    
    private function getRedirectRouteByRole($role_user)
    {
        switch ($role_user) {
            case 'Admin':
                return 'admin.contentManagement';
            case 'Pelapor':
                return 'pelapor.reportPelapor';
            case 'Pimpinan':
                return 'pimpinan.dashboard';
            case 'Superuser':
                return 'superuser';
            default:
                return 'user.beranda';
        }
    }
    


    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 401);
        }

        return response()->json(compact('user'));
    }

    public function logout()
    {
        JWTAuth::invalidate();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
