<?php

namespace App\Http\Controllers;

use App\Models\Struktural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturalController extends Controller
{
    public function index()
    {
        $strukturalImages = Struktural::all();

        return view('admin.struktural.index', compact('strukturalImages'));
    }


    public function create()
    {
        return view('admin.struktural.create');
    }
    public function edit($id)
    {
        $struktural = Struktural::findOrFail($id);
        return view('admin.struktural.edit', compact('struktural'));
    }


    public function store(Request $request)
    {

        $existingImage = Struktural::first();
        if ($existingImage) {
            return redirect()->back()->with('error', 'Hanya boleh mengunggah satu gambar struktural.');
        }

        $request->validate([
            'image_path' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = $request->file('image_path')->store('struktural', 'public');

        Struktural::create([
            'image_path' => $imagePath
        ]);

        return redirect()->route('admin.struktural.index')->with('success', 'Gambar struktural berhasil diunggah.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $struktural = Struktural::findOrFail($id);

        if ($request->hasFile('image_path')) {
            if ($struktural->image_path) {
                Storage::disk('public')->delete($struktural->image_path);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image_path')->store('struktural', 'public');
            $struktural->image_path = $imagePath;
        }

        $struktural->save();

        return redirect()->route('admin.struktural.index')->with('success', 'Gambar berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $struktural = Struktural::findOrFail($id);

        if ($struktural->image_path) {
            Storage::disk('public')->delete($struktural->image_path);
        }

        $struktural->delete();

        return redirect()->route('admin.struktural.index')->with('success', 'Gambar berhasil dihapus!');
    }
}
