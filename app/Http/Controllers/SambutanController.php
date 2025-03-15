<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sambutan;
use Illuminate\Support\Facades\Storage;

class SambutanController extends Controller
{
    public function index()
    {
        $sambutan = Sambutan::first();

        if (!$sambutan) {
            return redirect()->route('admin.sambutan.create')->withErrors('Data sambutan belum tersedia, silakan tambahkan.');
        }

        return view('admin.sambutan.index', compact('sambutan'));
    }

    public function create()
    {
        return view('admin.sambutan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kepala' => 'required|string|max:255',
            'sambutan' => 'required|string',
            'foto_kepala' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $sambutan = new Sambutan();
        $sambutan->nama_kepala = $request->nama_kepala;
        $sambutan->sambutan = $request->sambutan;

        if ($request->hasFile('foto_kepala')) {
            $path = $request->file('foto_kepala')->store('sambutan', 'public');
            $sambutan->foto_kepala = $path;
        }

        $sambutan->save();

        return redirect()->route('admin.sambutan.index')->with('success', 'Sambutan berhasil ditambahkan');
    }

    public function edit()
    {
        $sambutan = Sambutan::first();

        if (!$sambutan) {
            return redirect()->route('admin.sambutan.create')->withErrors('Data tidak ditemukan, silakan tambahkan dulu.');
        }

        return view('admin.sambutan.edit', compact('sambutan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_kepala' => 'required|string|max:255',
            'sambutan' => 'required|string',
            'foto_kepala' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $sambutan = Sambutan::first();

        if (!$sambutan) {
            return redirect()->route('admin.sambutan.create')->withErrors('Data tidak ditemukan, silakan tambahkan dulu.');
        }

        if ($request->hasFile('foto_kepala')) {
            $path = $request->file('foto_kepala')->store('sambutan', 'public');
            $sambutan->foto_kepala = $path;
        }

        $sambutan->nama_kepala = $request->nama_kepala;
        $sambutan->sambutan = $request->sambutan;
        $sambutan->save();

        return redirect()->route('admin.sambutan.index')->with('success', 'Sambutan berhasil diperbarui');
    }
}
