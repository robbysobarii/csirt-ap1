<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function showCarousels()
    {
        $carousels = Carousel::latest()->get();
        return view('administrator.carousel', compact('carousels'));
    }

   
    public function storeOrUpdate(Request $request)
{
    $carouselId = $request->input('carousel_id');

    $request->validate([
        'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
    ]);

    $formMethod = $request->get('formMethod');

    if ($formMethod === "store") {
        // Store new gallery
        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $gambarPath = $request->file('image_path')->store('images', 'public');

        // Save the file path in the database
        Carousel::create([
            'heading_caption' => $request->input('heading_caption'), // Use input() method to handle optional fields
            'caption' => $request->input('caption'),
            'image_path' => $gambarPath,
        ]);

        return redirect()->route('admin.carousel')->with('alert', 'Berhasil ditambahkan');
    } elseif ($formMethod === "update") {
        // Update existing gallery
        $carousel = Carousel::find($carouselId);
        if (!$carousel) {
            return redirect()->route('admin.carousel')->with('alert', 'Eror');
        }

        $carouselData = [
            'heading_caption' => $request->input('heading_caption'), // Use input() method to handle optional fields
            'caption' => $request->input('caption'),
        ];

        // Update the image if a new one is provided
        if ($request->hasFile('image_path')) {
            // Delete the old image
            Storage::disk('public')->delete($carousel->image_path);

            // Store the new image
            $gambarPath = $request->file('image_path')->store('images', 'public');
            $carouselData['image_path'] = $gambarPath;
        }

        $carousel->update($carouselData);

        return redirect()->route('admin.carousel')->with('alert', 'Berhasil diupdate');
    }
}


    public function show($id)
    {
        $carousel = Carousel::find($id);
    
        if (!$carousel) {
            abort(404);
        }
    
        return response()->json($carousel);
    }

    

    public function delete($id)
    {
        $carousel = Carousel::find($id);

        if ($carousel) {
            $carousel->delete();
            return redirect()->route('admin.carousel')->with('alert', 'Berhasil dihapus');
        }

        return redirect()->route('admin.carousel')->with('alert', 'Gagal dihapus');
    }
}