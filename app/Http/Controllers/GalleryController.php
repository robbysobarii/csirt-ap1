<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();

        return view('administrator.galeryManagement', ['galleries' => $galleries]);
    }

    public function storeOrUpdate(Request $request)
    {
        $galleryId = $request->input('gallery_id');

        $request->validate([
            'judul' => 'required',
            'caption' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $formMethod = $request->get('formMethod');

        if ($formMethod === "store") {
            // Store new gallery
            $request->validate([
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $gambarPath = $request->file('gambar')->store('images', 'public');

            // Save the file path in the database
            Gallery::create([
                'judul' => $request->judul,
                'caption' => $request->caption,
                'gambar' => $gambarPath,
            ]);

            return redirect()->route('admin.galeryManagement')->with('success', 'New gallery created successfully');
        } elseif ($formMethod === "update") {
            // Update existing gallery
            $gallery = Gallery::find($galleryId);
            if (!$gallery) {
                return redirect()->route('admin.galeryManagement')->with('error', 'Gallery not found');
            }

            // Update gallery data
            $galleryData = [
                'judul' => $request->judul,
                'caption' => $request->caption,
            ];

            // Update the image if a new one is provided
            if ($request->hasFile('gambar')) {
                // Delete the old image
                Storage::disk('public')->delete($gallery->gambar);

                // Store the new image
                $gambarPath = $request->file('gambar')->store('images', 'public');
                $galleryData['gambar'] = $gambarPath;
            }

            $gallery->update($galleryData);

            return redirect()->route('admin.galeryManagement')->with('success', 'Gallery updated successfully');
        }
    }

    public function delete($id)
    {
        $gallery = Gallery::find($id);

        if ($gallery) {
            // Delete the image
            Storage::disk('public')->delete($gallery->gambar);

            $gallery->delete();
            return redirect()->route('admin.galeryManagement')->with('success', 'Gallery deleted successfully');
        }

        return redirect()->route('admin.galeryManagement')->with('error', 'Gallery not found');
    }

    public function getGaleri()
    {
        $galleries = Gallery::all();

        return view('user.beranda', ['galleries' => $galleries]);
    }

    public function showGalery($id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            abort(404);
        }

        // Fetch the previous and next gallery
        $prevGallery = Gallery::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextGallery = Gallery::where('id', '>', $id)->orderBy('id')->first();

        // Pass the data to the view
        return view('user.galery', compact('gallery', 'prevGallery', 'nextGallery'));
    }
    public function show($id)
{
    $gallery = Gallery::find($id);

    if (!$gallery) {
        abort(404);
    }

    return response()->json($gallery);
}

}
