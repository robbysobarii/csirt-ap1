<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function showCarousels()
    {
        $carousels = Carousel::all();
        return view('administrator.carousel', compact('carousels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading_caption' => 'required',
            'caption' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // Maximum size 10240 KB (10 MB)
        ], [
            'image_path.required' => 'The image is required.',
            'image_path.image' => 'The file must be an image.',
            'image_path.mimes' => 'Invalid image format. Supported formats: jpeg, png, jpg, gif, svg.',
            'image_path.max' => 'The image size should not exceed 10 MB.',
        ]);

        if (!$request->file('image_path')->isValid()) {
            return redirect()->route('admin.carousel')->with('error', 'Invalid image file.');
        }

        $gambarPath = $request->file('image_path')->store('images', 'public');

        Carousel::create([
            'heading_caption' => $request->heading_caption,
            'caption' => $request->caption,
            'image_path' => $gambarPath,
        ]);

        return redirect()->route('admin.carousel')->with('success', 'Carousel added successfully');
    }

    

    public function delete($id)
    {
        $carousel = Carousel::find($id);

        if ($carousel) {
            $carousel->delete();
            return redirect()->route('admin.carousel')->with('success', 'Carousel deleted successfully');
        }

        return redirect()->route('admin.carousel')->with('error', 'Carousel not found');
    }
}
