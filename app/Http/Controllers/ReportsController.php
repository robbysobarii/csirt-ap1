<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ReportsController extends Controller
{
    public function index()
    {
        $reports = Reports::all();
        $auth = auth()->user();

        return view('administrator.report', compact('reports', 'auth'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $user = User::find($request->user_id);

        $imageName = null;
        if ($request->hasFile('bukti')) {
            $imageName = time() . '.' . $request->bukti->extension();
            $request->bukti->storeAs('images', $imageName, 'public');
        }

        Reports::create([
            'user_id' => $request->user_id,
            'satker' => $request->satker,
            'tanggal' => $request->tanggal,
            'insiden_type' => $request->insiden_type,
            'keterangan' => $request->keterangan,
            'penanganan' => $request->penanganan,
            'nama_user' => $user->nama_user,
            'status' => $request->status,
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
                return redirect()->route('admin.reportManagement')->with('error', 'Failed to delete user');
            }
        }

        return redirect()->route('admin.reportManagement')->with('error', 'User not found');
    }
    public function indexPelapor()
    {
        $auth = auth()->user();
        $reports = Reports::where('user_id', $auth->id)->get();

        return view('pelapor.pelapor', compact('reports','auth'));
    }
    public function indexPimpinan()
    {
        $auth = auth()->user();
        $reports = Reports::all();

        return view('pimpinan.dataReport', compact('reports', 'auth'));
    }
    public function showDashboard()
    {
        $reports = Reports::all();

        $totalPerType = $reports->groupBy('insiden_type')->map->count();
        $totalStatus = $reports->groupBy('status')->map->count();

        return view('pimpinan.dashboard', [
            'totalPerType' => $totalPerType,
            'totalStatus' => $totalStatus,
            'reports' => $reports
        ]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $user = User::find($request->user_id);

        $report = Reports::find($request->report_id);

        // Check if a new image is provided
        if ($request->hasFile('bukti')) {
            // Upload and store the new image
            $imageName = time() . '.' . $request->bukti->extension();
            $request->bukti->storeAs('images', $imageName, 'public');

            // Delete the old image if it exists
            if ($report->bukti) {
                Storage::disk('public')->delete('images/' . $report->bukti);
            }

            // Update the report with the new image
            $report->update([
                'user_id' => $request->user_id,
                'satker' => $request->satker,
                'tanggal' => $request->tanggal,
                'insiden_type' => $request->insiden_type,
                'keterangan' => $request->keterangan,
                'penanganan' => $request->penanganan,
                'nama_user' => $user->nama_user,
                'status' => $request->status,
                'bukti' => $imageName,
            ]);
        } else {
            // No new image provided, update the report without changing the existing image
            $report->update([
                'user_id' => $request->user_id,
                'satker' => $request->satker,
                'tanggal' => $request->tanggal,
                'insiden_type' => $request->insiden_type,
                'keterangan' => $request->keterangan,
                'penanganan' => $request->penanganan,
                'nama_user' => $user->nama_user,
                'status' => $request->status,
            ]);
        }

        return back()->with('success', 'Laporan berhasil ditambahkan');
    }
    public function show($id)
    {
        $report = Reports::find($id);
    
        if (!$report) {
            abort(404);
        }
    
        return response()->json($report);
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $user = User::find($request->user_id);

        if ($request->formMethod === 'store') {
            return $this->storePelapor($request, $user);
        } elseif ($request->formMethod === 'update') {
            return $this->updatePelapor($request, $user);

        }
    }

    protected function storePelapor(Request $request, User $user)
    {
        $imageName = $this->uploadImage($request);

        Reports::create([
            'user_id' => $request->user_id,
            'satker' => $request->satker,
            'tanggal' => $request->tanggal,
            'insiden_type' => $request->insiden_type,
            'keterangan' => $request->keterangan,
            'penanganan' => $request->penanganan,
            'nama_user' => $user->nama_user,
            'status' => $request->status,
            'bukti' => $imageName,
        ]);

        return redirect()->route('pelapor.reportPelapor')->with('success', 'Laporan berhasil ditambahkan');
    }

    protected function updatePelapor(Request $request, User $user)
{
    DB::beginTransaction();

    try {
        $report = Reports::find($request->report_id);

        if (!$report) {
            return back()->with('error', 'Laporan tidak ditemukan');
        }

        // Check if a new image is provided
        $imageName = $this->uploadImage($request);

        // Update the report data
        $report->update([
            'tanggal' => $request->tanggal,
            'insiden_type' => $request->insiden_type,
            'keterangan' => $request->keterangan,
            'penanganan' => $request->penanganan,
            'status' => $request->status,
            'bukti' => $imageName,
        ]);

        // Commit the database transaction
        DB::commit();

        return back()->with('success', 'Laporan berhasil diperbarui');
    } catch (\Exception $e) {
        // An error occurred, rollback the database transaction
        DB::rollback();

        // Output the exception message for debugging
        dd($e->getMessage());

        return back()->with('error', 'Error updating the report: ' . $e->getMessage());
    }
}


protected function uploadImage(Request $request)
{
    // Check if a new image is provided
    if ($request->hasFile('bukti')) {
        // Upload and store the new image
        return $request->bukti->storeAs('images', time() . '.' . $request->bukti->extension(), 'public');
    }

    return null;
}

}



 