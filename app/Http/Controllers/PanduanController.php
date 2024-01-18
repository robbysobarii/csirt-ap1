<?php
// PanduanController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class PanduanController extends Controller
{
    public function showDetail($filename, $name)
    {
        // Ambil isi dokumen dari storage atau sumber lainnya
        $content = Storage::get("file/{$filename}");

        // Tampilkan halaman detail panduan dengan isi dokumen
        return view('user.detailPanduanList', ['content' => $content, 'name' => $name, 'filename' => $filename]);
    }
}

