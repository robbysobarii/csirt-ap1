<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use Illuminate\Http\Request;

class NarahubungController extends Controller
{
    public function index()
    {
        try {
            $reports = Reports::latest()->get();
            $auth = auth()->user();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return view('narahubung.Narahubung', compact('reports', 'auth'));
    }
}
