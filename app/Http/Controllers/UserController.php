<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('superuser.superuser', compact('users'));
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'password' => 'sometimes|required',
        ]);

        try {
            // Find the user by ID
            $user = User::findOrFail($id);

            // Update the user attributes
            $user->update([
                'nama_user' => $request->nama_user,
                'email_user' => $request->email_user,
                'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            ]);

            return redirect()->route('editProfil', ['id' => auth()->user()->id])->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            // Handle any exceptions here, e.g., log the error
            return redirect()->route('editProfil', ['id' => auth()->user()->id])->with('error', 'Failed to update profile');
        }
    }
    public function editProfile($id)
    {
        // Retrieve user information based on $id
        $user = User::find($id);

        // Pass the $user data to the view
        return view('editProfile', ['user' => $user]);
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
