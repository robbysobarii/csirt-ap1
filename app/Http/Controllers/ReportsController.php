<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index()
    {
        $reports = Reports::all();
        $users = User::all();
        $roles = $users->pluck('role_user')->unique();
        
        // Retrieve users based on roles using whereIn
        $nama_user = User::whereIn('role_user', $roles)->get(['id', 'nama_user']);

        return view('administrator.report', compact('reports', 'users', 'roles', 'nama_user'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'satker' => 'required',
            'tanggal' => 'required',
            'insiden_type' => 'required',
            'keterangan' => 'required',
            'penanganan' => 'required',
            'nama_user' => 'required',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the user data
        $user = User::find($request->user_id);

        // Upload gambar jika ada
        $imageName = null;
        if ($request->hasFile('bukti')) {
            $imageName = time() . '.' . $request->bukti->extension();
            $request->bukti->storeAs('images', $imageName, 'public'); // Using Storage facade
        }

        Reports::create([
            'user_id' => $request->user_id,
            'satker' => $request->satker,
            'tanggal' => $request->tanggal,
            'insiden_type' => $request->insiden_type,
            'keterangan' => $request->keterangan,
            'penanganan' => $request->penanganan,
            'nama_user' => $user->nama_user, // Store the user's name
            'bukti' => $imageName,
        ]);

        return redirect()->route('admin.reportManagement')->with('success', 'Laporan berhasil ditambahkan');
    }

    public function delete($id)
    {
        $user = Reports::find($id);

        if ($user) {
            try {
                $user->delete();
                return redirect()->route('admin.reportManagement')->with('success', 'User deleted successfully');
            } catch (\Exception $e) {
                // Handle any exceptions here, e.g., log the error
                return redirect()->route('admin.reportManagement')->with('error', 'Failed to delete user');
            }
        }

        return redirect()->route('admin.reportManagement')->with('error', 'User not found');
    }

}
