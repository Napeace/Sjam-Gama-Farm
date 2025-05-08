<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Product;
use App\Models\Review;

class HidroponikController extends Controller
{
    public function index()
    {
        $artikels = Artikel::where('kategori', 'hidroponik')->latest()->get();
        $products = Product::all();
        $reviews = Review::all(); // Add this line to fetch reviews

        return view('customer.hidroponik', compact('artikels', 'products', 'reviews'));
    }
}
