<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Content;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
{
    // Assuming 'role_user' is a column in the users table
    $users = User::where('role_user', '!=', 'Superuser')->get();
    $formMethod = 'store';

    return view('superuser.superuser', compact('users','formMethod'));
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
        'email' => 'required|email|unique:users,email',
        'password' => 'required_if:formMethod,store', // Only required for store action
    ]);

    $userId = $request->input('user_id');
    $userData = [
        'role_user' => $request->role_user,
        'nama_user' => $request->nama_user,
        'email' => $request->email,
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
    // Check if old password, new password, and profile picture are all empty
    if (
        empty($request->old_password) &&
        empty($request->new_password) &&
        !$request->hasFile('profile_picture')
    ) {
        return redirect()->route('editProfil', ['id' => $id])->with('error', 'No changes made to the profile');
    }

    $request->validate([
        'password' => 'sometimes|required|confirmed',
        'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        $user = User::findOrFail($id);

        // Check if the provided old password matches the hashed password in the database
        if ($request->filled('old_password') && !Hash::check($request->old_password, $user->password)) {
            return redirect()->route('editProfil', ['id' => $user->id])->with('error_oldPass', 'Old password is incorrect');
        }

        $userData = [
            'nama_user' => $user->nama_user,
            'email_user' => $user->email_user,
        ];

        // Check if the new password is provided
        if ($request->filled('new_password')) {
            // Check if new password matches confirmation
            if ($request->new_password !== $request->password_confirmation) {
                return redirect()->route('editProfil', ['id' => $user->id])->with('error_newPass', 'New password and confirmation do not match');
            }

            // Check if new password is the same as the existing password
            if (Hash::check($request->new_password, $user->password)) {
                return redirect()->route('editProfil', ['id' => $user->id])->with('error_newPass', 'New password must be different from the current password');
            }

            // Validate new password confirmation
            $request->validate([
                'password_confirmation' => 'required|same:new_password',
            ]);

            $userData['password'] = Hash::make($request->new_password);
        }

        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $userData['profile_picture'] = $imagePath;
        }

        $user->update($userData);

        return redirect()->route('editProfil', ['id' => $user->id])->with('success', 'Profile updated successfully');
    } catch (\Exception $e) {
        return redirect()->route('editProfil', ['id' => $user->id])->with('error', 'Failed to update profile');
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

    