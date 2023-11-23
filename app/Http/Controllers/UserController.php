<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('administrator.userManagemen', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_user' => 'required',
            'nama_user' => 'required',
            'email_user' => 'required|email|unique:users,email_user',
            'password' => 'required',
        ]);

        try {
            User::create([
                'role_user' => $request->role_user,
                'nama_user' => $request->nama_user,
                'email_user' => $request->email_user,
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('admin.userManagement')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            // Handle any exceptions here, e.g., log the error
            return redirect()->route('admin.userManagement')->with('error', 'Failed to create user');
        }
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            try {
                $user->delete();
                return redirect()->route('admin.userManagement')->with('success', 'User deleted successfully');
            } catch (\Exception $e) {
                // Handle any exceptions here, e.g., log the error
                return redirect()->route('admin.userManagement')->with('error', 'Failed to delete user');
            }
        }

        return redirect()->route('admin.userManagement')->with('error', 'User not found');
    }
}
