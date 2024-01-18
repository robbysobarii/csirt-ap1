<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Gallery;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function getContentsBeranda()
    {
        $content = Content::latest()->get();
        $latestContent = Content::latest()->first(); 
        
        $galleries = Gallery::all();
        $carousels = Carousel::all();
        return view('user.beranda', compact('content', 'galleries','carousels','latestContent'));
    }

    public function index()
    {
        $contents = Content::latest()->get();
        return view('administrator.contentManagement', compact('contents'));
    }
    public function storeOrUpdate(Request $request)
    {
        $contentId = $request->input('content_id');
        $formMethod = $request->get('formMethod');

        if ($formMethod == "store" && $request->hasFile('gambar')) {

            $request->validate([
                'judul' => 'required|string',
                'isiKonten' => 'required|string',
                'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'type' => 'required',
            ]);

            $gambarPath = $request->file('gambar')->store('images', 'public');

            $newContent = Content::create([
                'judul' => $request->judul,
                'isi_konten' => $request->isiKonten,
                'gambar' => $gambarPath,
                'type' => $request->type,
            ]);

            return redirect()->route('admin.contentManagement')->with('message', 'Berhasil Menambahkan');
        } else if ($formMethod == "update" && $request->hasFile('gambar')) {

            $content = Content::findOrFail($contentId);

            $request->validate([
                'judul' => 'required|string',
                'isiKonten' => 'required|string',
                'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'type' => 'required',
            ]);

            $contentData = [
                'judul' => $request->judul,
                'isi_konten' => $request->isiKonten,
                'type' => $request->type,
            ];

            if ($request->hasFile('gambar')) {
                Storage::disk('public')->delete($content->gambar);
                $gambarPath = $request->file('gambar')->store('images', 'public');
                $contentData['gambar'] = $gambarPath;
            }

            $content->update($contentData);

            return redirect()->route('admin.contentManagement')->with('message', 'Berhasil diupdate');
        }
    }

    public function show($id)
    {
        $content = Content::findOrFail($id);
        return response()->json($content);
    }

    public function listContent()
    {
        $content = Content::latest()->get();

        return view('user.daftarBerita', compact('content'));
    }

    public function showNews($id)
    {
        $content = Content::find($id);
        if (!$content) {
            abort(404);
        }
        $prevContent = Content::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextContent = Content::where('id', '>', $id)->orderBy('id')->first();
        return view('user.berita', compact('content', 'prevContent', 'nextContent'));
    }

    public function delete($id)
    {

        $content = Content::find($id);

        if ($content) {
            $content->delete();
            return redirect()->route('admin.contentManagement')->with('message', 'Berhasil dihapus');
        }

        return redirect()->route('admin.contentManagement')->with('message', 'Gagal dihapus');
    }

}