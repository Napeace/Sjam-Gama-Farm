<?php

namespace App\Http\Controllers;

use App\Models\TrainingVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrainingVideoController extends Controller
{
    public function index()
    {
        $videos = TrainingVideo::latest()->paginate(10);
        return view('mitra.training-videos.index', compact('videos'));
    }

    public function create()
    {
        return view('mitra.training-videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_url' => [
                'required',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/'
            ],
            'is_active' => 'boolean'
        ], [
            'youtube_url.regex' => 'URL harus berupa link YouTube yang valid'
        ]);

        try {
            TrainingVideo::create([
                'title' => $request->title,
                'description' => $request->description,
                'youtube_url' => $request->youtube_url,
                'is_active' => $request->has('is_active') ? true : false
            ]);

            return redirect()->route('mitra.training-videos.index')
                ->with('success', 'Video Pelatihan berhasil dibuat!');

        } catch (\Exception $e) {
            Log::error('Error creating training video: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal membuat video pelatihan. Silakan coba lagi.');
        }
    }

    public function show(TrainingVideo $trainingVideo)
    {
        // Increment view count
        $trainingVideo->incrementViewCount();

        // Jika request adalah AJAX, return JSON response
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'view_count' => $trainingVideo->view_count,
                'message' => 'View count incremented'
            ]);
        }

        // Jika bukan AJAX, return view seperti biasa
        return view('mitra.training-videos.show', compact('trainingVideo'));
    }

    public function edit(TrainingVideo $trainingVideo)
    {
        return view('mitra.training-videos.edit', compact('trainingVideo'));
    }

    public function update(Request $request, TrainingVideo $trainingVideo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_url' => [
                'required',
                'url',
                'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/'
            ],
            'is_active' => 'boolean'
        ], [
            'youtube_url.regex' => 'URL harus berupa link YouTube yang valid'
        ]);

        try {
            $trainingVideo->update([
                'title' => $request->title,
                'description' => $request->description,
                'youtube_url' => $request->youtube_url,
                'is_active' => $request->has('is_active') ? true : false
            ]);

            return redirect()->route('mitra.training-videos.index')
                ->with('success', 'Video Pelatihan berhasil diperbarui!');

        } catch (\Exception $e) {
            Log::error('Error updating training video: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui video pelatihan. Silakan coba lagi.');
        }
    }

    public function destroy(TrainingVideo $trainingVideo)
    {
        try {
            $trainingVideo->delete();

            return redirect()->route('mitra.training-videos.index')
                ->with('success', 'Video Pelatihan berhasil dihapus!');

        } catch (\Exception $e) {
            Log::error('Error deleting training video: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus video pelatihan. Silakan coba lagi.');
        }
    }

    /**
     * Toggle video status (active/inactive)
     */
    public function toggleStatus(TrainingVideo $trainingVideo)
    {
        try {
            $trainingVideo->update([
                'is_active' => !$trainingVideo->is_active
            ]);

            $status = $trainingVideo->is_active ? 'diaktifkan' : 'dinonaktifkan';

            return back()->with('success', "Video berhasil {$status}!");

        } catch (\Exception $e) {
            Log::error('Error toggling video status: ' . $e->getMessage());
            return back()->with('error', 'Gagal mengubah status video.');
        }
    }
}
