<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::where('kategori', 'hidroponik')->latest()->get();
        return view('mitra.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('mitra.artikel.editor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $artikel = new Artikel();
        $artikel->judul = $request->judul;
        $artikel->isi = $request->isi;
        $artikel->kategori = 'hidroponik';
        $artikel->slug = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('artikel', 'public');
            $artikel->gambar = $gambarPath;
        }

        $artikel->save();

        return redirect()->route('mitra.artikel.hidroponik')
            ->with('success', 'Artikel berhasil dibuat!');
    }

    public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $artikel->judul = $request->judul;
        $artikel->isi = $request->isi;
        $artikel->slug = Str::slug($request->judul);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }

            $gambarPath = $request->file('gambar')->store('artikel', 'public');
            $artikel->gambar = $gambarPath;
        }

        $artikel->save();

        return redirect()->route('mitra.artikel.hidroponik')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Artikel $artikel)
    {
        // Hapus gambar jika ada
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return redirect()->route('mitra.artikel.hidroponik')
            ->with('success', 'Artikel berhasil dihapus!');
    }

    public function edit(Artikel $artikel)
    {
        return view('mitra.artikel.editor', compact('artikel'));
    }
}
