<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::all();
        return view('admin.carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    // Menyimpan data carousel baru
    public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|max:2048', 
        'slide_number' => 'required|integer|unique:carousels,slide_number', 
    ]);

    $carousel = new Carousel();

    if ($request->hasFile('image')) {
    
        $imagePath = $request->file('image')->store('carousels', 'public');

        $carousel->image_path = $imagePath;  
    }

    $carousel->slide_number = $request->slide_number;

    $carousel->save();

    return redirect()->route('admin.carousel.index')->with('success', 'Carousel successfully added');
}

    public function edit($id)
    {

        $carousel = Carousel::findOrFail($id);
    
        return view('admin.carousel.edit', compact('carousel'));
    }
 
    public function update(Request $request, Carousel $carousel)
    {
          $request->validate([
            'slide_number' => 'required|integer|between:1,3',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        $carousel->slide_number = $request->slide_number;
    
        if ($request->hasFile('image')) {
           
            if ($carousel->image_path) {
                Storage::delete('public/' . $carousel->image_path);
            }
    
            $path = $request->file('image')->store('carousel', 'public');
            $carousel->image_path = $path;
        }
    
        $carousel->save();
    
        return redirect()->route('admin.carousel.index')->with('success', 'Slide berhasil diperbarui!');
    }

    public function destroy($id)
    {

        $carousel = Carousel::findOrFail($id);

        if ($carousel->image_path) {
            Storage::disk('public')->delete($carousel->image_path);
        }

        $carousel->delete();

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel successfully deleted');
    }
}
