<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Notification;

class ProductController extends Controller
{
    /**
     * Display a listing of the products for Mitra.
     */
    public function index(Request $request)
    {
        // Ambil semua produk untuk perhitungan count
        $allProducts = Product::all();

        // Query untuk produk yang akan ditampilkan
        $query = Product::query();

        // Filter berdasarkan tipe produk jika ada
        if ($request->has('tipe') && in_array($request->tipe, ['SAYUR', 'ALAT'])) {
            $query->where('tipe_produk', $request->tipe);
        }

        $products = $query->orderBy('created_at', 'desc')->get();

        return view('mitra.produk.index', compact('products', 'allProducts'));
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
        $baseValidation = [
            'nama' => 'required|string|max:255',
            'tipe_produk' => 'required|string|in:SAYUR,ALAT',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Validation berbeda berdasarkan tipe produk
        if ($request->tipe_produk === 'SAYUR') {
            $validation = array_merge($baseValidation, [
                'status_booking' => 'required|string|in:MENERIMA,FULL BOOKED',
                'status_stok' => 'required|string|in:TERSEDIA,TIDAK TERSEDIA',
                'tanggal_tanam' => 'nullable|date',
                'prediksi_panen' => 'nullable|date',
            ]);
        } else {
            $validation = array_merge($baseValidation, [
                'stok' => 'required|integer|min:0',
            ]);
        }

        $validated = $request->validate($validation);

        // Set default values berdasarkan tipe produk
        if ($validated['tipe_produk'] === 'ALAT') {
            $validated['status_booking'] = 'MENERIMA';
            $validated['status_stok'] = $validated['stok'] > 0 ? 'TERSEDIA' : 'TIDAK TERSEDIA';
        }

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk', 'public');
            $validated['gambar'] = $gambarPath;
        }

        Product::create($validated);

        $message = $validated['tipe_produk'] === 'SAYUR' ? 'Produk sayur berhasil ditambahkan' : 'Produk alat berhasil ditambahkan';

        return redirect()->route('mitra.produk.index')->with('success', $message);
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
        $baseValidation = [
            'nama' => 'required|string|max:255',
            'tipe_produk' => 'required|string|in:SAYUR,ALAT',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Validation berbeda berdasarkan tipe produk
        if ($request->tipe_produk === 'SAYUR') {
            $validation = array_merge($baseValidation, [
                'status_booking' => 'required|string|in:MENERIMA,FULL BOOKED',
                'status_stok' => 'required|string|in:TERSEDIA,TIDAK TERSEDIA',
                'tanggal_tanam' => 'nullable|date',
                'prediksi_panen' => 'nullable|date',
            ]);
        } else {
            $validation = array_merge($baseValidation, [
                'stok' => 'required|integer|min:0',
            ]);
        }

        $validated = $request->validate($validation);

        // Simpan status stok lama sebelum diupdate
        $oldStockStatus = $product->stock_status;
        $oldStok = $product->stok;

        // Set status stok untuk produk alat berdasarkan stok
        if ($validated['tipe_produk'] === 'ALAT') {
            $validated['status_stok'] = $validated['stok'] > 0 ? 'TERSEDIA' : 'TIDAK TERSEDIA';
        }

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

        // Cek perubahan status stok menjadi TERSEDIA
        $newStockStatus = $product->fresh()->stock_status;

        if ($oldStockStatus !== 'TERSEDIA' && $newStockStatus === 'TERSEDIA') {
            // Buat notifikasi baru
            Notification::create([
                'title' => 'Produk Tersedia',
                'message' => "Produk {$product->nama} sekarang tersedia untuk dibeli!",
                'category' => 'produk',
                'image_url' => $product->gambar ? asset('storage/' . $product->gambar) : null,
                'link_url' => route('produk.index') . "?highlight={$product->id}",
                'is_read' => false,
                'visitor_id' => null, // null berarti notifikasi untuk semua pengunjung
            ]);
        }

        $message = $validated['tipe_produk'] === 'SAYUR' ? 'Produk sayur berhasil diperbarui' : 'Produk alat berhasil diperbarui';

        return redirect()->route('mitra.produk.index')->with('success', $message);
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

        $productType = $product->tipe_produk;
        $product->delete();

        $message = $productType === 'SAYUR' ? 'Produk sayur berhasil dihapus' : 'Produk alat berhasil dihapus';

        return redirect()->route('mitra.produk.index')->with('success', $message);
    }

    /**
     * Display a listing of the products for Customer (public view).
     */
    public function publicIndex(Request $request)
    {
        // Ambil produk berdasarkan tipe
        $sayurProducts = Product::where('tipe_produk', 'SAYUR')
                            ->orderBy('created_at', 'desc')
                            ->get();

        $alatProducts = Product::where('tipe_produk', 'ALAT')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('customer.produk', compact('sayurProducts', 'alatProducts'));
    }

    /**
     * Get products by type for API or AJAX calls
     */
    public function getByType($type)
    {
        if (!in_array($type, ['SAYUR', 'ALAT'])) {
            return response()->json(['error' => 'Invalid product type'], 400);
        }

        $products = Product::where('tipe_produk', $type)->get();

        return response()->json($products);
    }
}
