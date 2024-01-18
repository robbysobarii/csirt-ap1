<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Gallery;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ContentController extends Controller
{
    public function show($id)
    {
        $content = Content::find($id);

        return response()->json([
            'id' => $content->id,
            'judul' => $content->judul,
            'isi_konten' => $content->isi_konten,
            'gambar' => $content->gambar,
            'type' => $content->type,
        ]);
    }




    public function index()
    {
        $contents = Content::all();
        return view('administrator.contentManagement', compact('contents'));
    }

    public function getContents()
    {
        $content = Content::latest()->get();
        
        $galleries = Gallery::all();
        $carousels = Carousel::all();

        // Kirim data konten ke tampilan
        return view('user.beranda', compact('content', 'galleries','carousels'));
    }

    public function listContent()
    {
        $content = Content::latest()->get();

        // Kirim data konten ke tampilan
        return view('user.daftarBerita', compact('content'));
    }

    public function showNews($id)
    {
        $content = Content::find($id);
        if (!$content) {
            abort(404);
        }
        // Fetch the previous and next content
        $prevContent = Content::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextContent = Content::where('id', '>', $id)->orderBy('id')->first();

        // Pass the data to the view
        return view('user.berita', compact('content', 'prevContent', 'nextContent'));
    }



    // Controller method
    public function storeOrUpdate(Request $request)
    {
        $contentId = $request->input('content_id');

        $request->validate([
            'judul' => 'required',
            'isiKonten' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required',
        ]);

        $formMethod = $request->get('formMethod');

        if ($formMethod === "store") {
            // Store new content
            $request->validate([
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $gambarPath = $request->file('gambar')->store('images', 'public');
    
            // Save the file path in the database
            $newContent = Content::create([
                'judul' => $request->judul,
                'isi_konten' => $request->isiKonten,
                'gambar' => $gambarPath,
                'type' => $request->type,
            ]);
    
            // Handle the response after creating, for example, redirect with success message
            return redirect()->route('admin.contentManagement')->with('success', 'New content created successfully');
        } else if ($formMethod === "update") {
            // Update existing content
            $content = Content::find($contentId);
            if (!$content) {
                // Handle not found, for example, redirect back with an error message
                return redirect()->route('admin.contentManagement')->with('error', 'Content not found');
            }

            // Update content data
            $contentData = [
                'judul' => $request->judul,
                'isi_konten' => $request->isiKonten,
                'type' => $request->type,
            ];

            // Update the image if a new one is provided
            if ($request->hasFile('gambar')) {
                // Delete the old image
                Storage::disk('public')->delete($content->gambar);

                // Store the new image
                $gambarPath = $request->file('gambar')->store('images', 'public');
                $contentData['gambar'] = $gambarPath;
            }

            $content->update($contentData);

            // Handle the response after updating, for example, redirect with success message
            return redirect()->route('admin.contentManagement')->with('success', 'Content updated successfully');
        }
    }
    

    public function delete($id)
    {

        $content = Content::find($id);

        if ($content) {
            $content->delete();
            return redirect()->route('admin.contentManagement')->with('success', 'Content deleted successfully');
        }

        return redirect()->route('admin.contentManagement')->with('error', 'Content not found');
    }

}