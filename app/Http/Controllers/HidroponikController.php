<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artikel;
use App\Models\Product;
use App\Models\Review;
use App\Models\TrainingVideo;
use App\Models\TrainingForm;

class HidroponikController extends Controller
{
    public function index()
    {
        $artikels = Artikel::where('kategori', 'hidroponik')->latest()->get();
        $products = Product::all();
        $reviews = Review::all();
        $trainingVideos = TrainingVideo::active()
                                ->latest()
                                ->take(9) // Limit untuk carousel (3x3 atau sesuai kebutuhan)
                                ->get();

        // Ambil training forms yang aktif dan belum lewat tanggalnya
        $trainingForms = TrainingForm::active()
                                ->where('training_date', '>=', now()->toDateString())
                                ->orderBy('training_date', 'asc')
                                ->get();

        return view('customer.hidroponik', compact('artikels', 'products', 'reviews', 'trainingVideos', 'trainingForms'));
    }
}
