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

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user);
    }
    public function storeOrUpdate(Request $request)
{
    $request->validate([
        'role_user' => 'required',
        'nama_user' => 'required',
        'email_user' => 'required|email|unique:users,email_user',
        'password' => 'required_if:formMethod,store', // Only required for store action
    ]);

    $userId = $request->input('user_id');
    $userData = [
        'role_user' => $request->role_user,
        'nama_user' => $request->nama_user,
        'email_user' => $request->email_user,
    ];

    // Add password to $userData only if it is provided
    if ($request->filled('password')) {
        $userData['password'] = Hash::make($request->password);
    }

    $formMethod = $request->get('formMethod');

    if ($formMethod === "store") {
        // Store new user
        User::create($userData);

        return redirect()->route('superuser')->with('success', 'User created successfully');
    } elseif ($formMethod === "update") {
        // Update existing user
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('superuser')->with('error', 'User not found');
        }

        $user->update($userData);

        return redirect()->route('superuser')->with('success', 'User updated successfully');
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
    public function deleteUsermanagement($id)
    {
        $user = User::find($id);

        if ($user) {
            try {
                $user->delete();
                return redirect()->route('superuser')->with('success', 'User deleted successfully');
            } catch (\Exception $e) {
                // Handle any exceptions here, e.g., log the error
                return redirect()->route('superuser')->with('error', 'Failed to delete user');
            }
        }

        return redirect()->route('superuser')->with('error', 'User not found');
    }
}
