<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews for Mitra.
     */
    public function index()
    {
        $reviews = Review::all();
        return view('mitra.review.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new review.
     */
    public function create()
    {
        return view('mitra.review.create');
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reviews', 'public');
            $validated['image'] = $imagePath;
        }

        Review::create($validated);

        return redirect()->route('mitra.reviews.index')->with('success', 'Review berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified review.
     */
    public function edit(Review $review)
    {
        return view('mitra.review.edit', compact('review'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($review->image) {
                Storage::disk('public')->delete($review->image);
            }
            $imagePath = $request->file('image')->store('reviews', 'public');
            $validated['image'] = $imagePath;
        }

        $review->update($validated);

        return redirect()->route('mitra.reviews.index')->with('success', 'Review berhasil diperbarui');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review)
    {
        // Delete the review image if exists
        if ($review->image) {
            Storage::disk('public')->delete($review->image);
        }

        $review->delete();

        return redirect()->route('mitra.reviews.index')->with('success', 'Review berhasil dihapus');
    }

    /**
     * Display a listing of the reviews for Customer (public view).
     */
    public function publicIndex()
    {
        $reviews = Review::all();
        return view('customer.reviews', compact('reviews'));
    }
}
