<?php

// app/Http/Controllers/GalleryController.php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();

        return view('administrator.galeryManagement', ['galleries' => $galleries]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'caption' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $gambarPath = $request->file('gambar')->store('images', 'public');

        // Save the file path in the database
        Gallery::create([
            'judul' => $request->judul,
            'caption' => $request->caption,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('admin.galeryManagement');
    }
    public function delete($id)
    {

        $content = Gallery::find($id);

        if ($content) {
            $content->delete();
            return redirect()->route('admin.galeryManagement')->with('success', 'Content deleted successfully');
        }

        return redirect()->route('admin.galeryManagement')->with('error', 'Content not found');
    }

    public function getGaleri()
    {
        $galleries = Gallery::all();

        return view('user.beranda', ['galleries' => $galleries]);
    }
    public function showGalery($id)
    {
        $galleries = Gallery::find($id);
        if (!$galleries) {
            abort(404);
        }
        // Fetch the previous and next content
        $prevContent = Gallery::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextContent = Gallery::where('id', '>', $id)->orderBy('id')->first();

        // Pass the data to the view
        return view('user.galery', compact('galleries' , 'prevContent', 'nextContent'));
    }

}
