@extends('mitra.components.layouts')

@section('title', 'Tambah Video Pelatihan')

@section('content')
<div class="flex h-full overflow-hidden">
    <!-- Sidebar -->
    @include('mitra.components.sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-auto p-6">
        <div class="bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-800">Tambah Video Pelatihan</h3>
                <a href="{{ route('mitra.training-videos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m0 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>

            <form action="{{ route('mitra.training-videos.store') }}" method="POST">
                @csrf
                <div class="p-6">
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 relative">
                            {{ session('error') }}
                            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                                <span class="sr-only">Tutup</span>
                                ×
                            </button>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Form Fields -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul Video <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       class="w-full px-3 py-2 border {{ $errors->has('title') ? 'border-red-500' : 'border-gray-300' }} rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       id="title"
                                       name="title"
                                       value="{{ old('title') }}"
                                       placeholder="Masukkan judul video">
                                @error('title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- YouTube URL -->
                            <div>
                                <label for="youtube_url" class="block text-sm font-medium text-gray-700 mb-2">
                                    URL YouTube <span class="text-red-500">*</span>
                                </label>
                                <input type="url"
                                       class="w-full px-3 py-2 border {{ $errors->has('youtube_url') ? 'border-red-500' : 'border-gray-300' }} rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       id="youtube_url"
                                       name="youtube_url"
                                       value="{{ old('youtube_url') }}"
                                       placeholder="https://www.youtube.com/watch?v=...">
                                @error('youtube_url')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Masukkan link YouTube yang valid</p>
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Deskripsi
                                </label>
                                <textarea class="w-full px-3 py-2 border {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }} rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                          id="description"
                                          name="description"
                                          rows="4"
                                          placeholder="Masukkan deskripsi video (opsional)">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <div class="flex items-center">
                                    <input class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                           type="checkbox"
                                           id="is_active"
                                           name="is_active"
                                           value="1"
                                           {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="ml-2 block text-sm text-gray-900" for="is_active">
                                        Aktif
                                    </label>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Video akan ditampilkan jika diaktifkan</p>
                            </div>
                        </div>

                        <!-- Video Preview -->
                        <div class="lg:col-span-1">
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm">
                                <div class="px-4 py-3 border-b border-gray-200">
                                    <h5 class="font-medium text-gray-900">Preview Video</h5>
                                </div>
                                <div class="p-4">
                                    <div id="video-preview" class="text-center">
                                        <div class="bg-gray-50 p-8 rounded-lg">
                                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3"
                                                fill="currentColor"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg"
                                                aria-hidden="true"
                                                role="img">
                                                <path d="M10 8.64v6.72c0 .57.62.93 1.11.64l5.19-3.36a.75.75 0 000-1.28l-5.19-3.36a.75.75 0 00-1.11.64z"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C6.48 22 2 17.52 2 12S6.48 2 12 2s10 4.48 10 10-4.48 10-10 10zM4 12c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8-8 3.58-8 8z"/>
                                            </svg>
                                            <p class="text-gray-500 text-sm">
                                                Preview akan muncul setelah memasukkan URL YouTube yang valid
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-lg flex justify-end space-x-3">
                    <a href="{{ route('mitra.training-videos.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md inline-flex items-center gap-2 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        Simpan Video
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlInput = document.getElementById('youtube_url');
    const previewDiv = document.getElementById('video-preview');

    urlInput.addEventListener('input', function() {
        const url = this.value;
        const videoId = extractYouTubeId(url);

        if (videoId) {
            previewDiv.innerHTML = `
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-48 rounded-lg"
                            src="https://www.youtube.com/embed/${videoId}"
                            frameborder="0"
                            allowfullscreen>
                    </iframe>
                </div>
            `;
        } else {
            previewDiv.innerHTML = `
                <div class="bg-gray-50 p-8 rounded-lg">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-gray-500 text-sm">Preview akan muncul setelah memasukkan URL YouTube yang valid</p>
                </div>
            `;
        }
    });

    function extractYouTubeId(url) {
        const regex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
        const matches = url.match(regex);
        return matches ? matches[1] : null;
    }
});
</script>
@endsection
