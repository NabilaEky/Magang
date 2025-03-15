<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

class BeritaController extends Controller
{
    public function boot()
{
    Paginator::useBootstrap();
}
    public function index(Request $request)
{
    $query = Berita::query();

    $query->when($request->filled('search'), function ($q) use ($request) {
        $q->where('judul', 'like', '%' . $request->search . '%');
    });

    $query->when($request->filled('month'), function ($q) use ($request) {
        $q->whereMonth('tanggal', $request->month);
    });

    $query->when($request->filled('year'), function ($q) use ($request) {
        $q->whereYear('tanggal', $request->year);
    });

    $berita = $query->latest()->paginate(5);

    $routes = [
        'dashboard*' => 'dashboard.berita-terkini',
        'dashboard-beranda' => 'dashboard-beranda',
        'admin-home' => 'admin-home'
    ];
    
    foreach ($routes as $route => $view) {
        if ($request->is($route)) {
            return view($view, compact('berita'));
        }
    }
    
    return view('admin.berita.index', compact('berita'));
}

    public function create()
    {
        return view('admin.berita.create');
    }


    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Berita $berita)
    {
        return view('admin.berita.show', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita)
    {
        $data = $this->validateRequest($request);


        if ($request->hasFile('gambar')) {
            if ($berita->gambar) {
                Storage::disk('public')->delete($berita->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }


        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }
    public function destroy(Berita $berita)
    {
        if ($berita->gambar) {
            Storage::disk('public')->delete($berita->gambar);
        }
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'tanggal' => 'required|date',
            'caption' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    }
}
