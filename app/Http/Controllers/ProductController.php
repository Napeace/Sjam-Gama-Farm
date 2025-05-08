<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products for Mitra.
     */
    public function index()
    {
        $products = Product::all();
        return view('mitra.produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('mitra.produk.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'status_booking' => 'required|string|in:MENERIMA,FULL BOOKED',
            'status_stok' => 'required|string|in:TERSEDIA,TIDAK TERSEDIA',
            'tanggal_tanam' => 'nullable|date',
            'prediksi_panen' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk', 'public');
            $validated['gambar'] = $gambarPath;
        }

        Product::create($validated);

        return redirect()->route('mitra.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return view('mitra.produk.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'status_booking' => 'required|string|in:MENERIMA,FULL BOOKED',
            'status_stok' => 'required|string|in:TERSEDIA,TIDAK TERSEDIA',
            'tanggal_tanam' => 'nullable|date',
            'prediksi_panen' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }
            $gambarPath = $request->file('gambar')->store('produk', 'public');
            $validated['gambar'] = $gambarPath;
        }

        $product->update($validated);

        return redirect()->route('mitra.produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        // Delete the product image if exists
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }

        $product->delete();

        return redirect()->route('mitra.produk.index')->with('success', 'Produk berhasil dihapus');
    }

    /**
     * Display a listing of the products for Customer (public view).
     */
    public function publicIndex()
    {
        $products = Product::all();
        return view('customer.produk', compact('products'));
    }
}
