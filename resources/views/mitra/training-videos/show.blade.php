@extends('mitra.components.layouts')

@section('title', 'Detail Video Pelatihan')

@section('content')
<div class="h-full overflow-y-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <h3 class="text-xl font-semibold text-gray-900">Detail Video Pelatihan</h3>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('mitra.training-videos.edit', $trainingVideo) }}"
                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-amber-700 bg-amber-100 hover:bg-amber-200 border border-amber-300 rounded-md transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <a href="{{ route('mitra.training-videos.index') }}"
                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-md transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Video Player -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="p-0">
                            @if($trainingVideo->youtube_video_id)
                                <div class="relative w-full pb-[56.25%] h-0 overflow-hidden rounded-t-lg">
                                    <iframe class="absolute top-0 left-0 w-full h-full"
                                            src="https://www.youtube.com/embed/{{ $trainingVideo->youtube_video_id }}"
                                            frameborder="0"
                                            allowfullscreen>
                                    </iframe>
                                </div>
                            @else
                                <div class="bg-gray-50 p-12 text-center rounded-t-lg">
                                    <svg class="w-16 h-16 mx-auto text-amber-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.08 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                    <p class="text-gray-500">Video tidak dapat ditampilkan</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Video Info -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h5 class="text-lg font-medium text-gray-900">Informasi Video</h5>
                        </div>
                        <div class="p-6">
                            <h4 class="text-2xl font-semibold text-gray-900 mb-4">{{ $trainingVideo->title }}</h4>

                            @if($trainingVideo->description)
                                <div class="mb-6">
                                    <h6 class="text-sm font-medium text-gray-700 mb-2">Deskripsi:</h6>
                                    <p class="text-gray-600 leading-relaxed">{{ $trainingVideo->description }}</p>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 mb-3">URL YouTube:</p>
                                    <a href="{{ $trainingVideo->youtube_url }}"
                                       target="_blank"
                                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 rounded-md transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                        </svg>
                                        Buka di YouTube
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Status & Stats -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h5 class="text-lg font-medium text-gray-900">Status & Statistik</h5>
                        </div>
                        <div class="p-6 space-y-4">
                            <div>
                                <span class="text-sm font-medium text-gray-700">Status:</span>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $trainingVideo->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $trainingVideo->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>

                            <div>
                                <span class="text-sm font-medium text-gray-700">Total Views:</span>
                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ number_format($trainingVideo->view_count) }}
                                </span>
                            </div>

                            <div>
                                <span class="text-sm font-medium text-gray-700 block mb-1">Dibuat:</span>
                                <span class="text-sm text-gray-500">{{ $trainingVideo->created_at->format('d F Y, H:i') }}</span>
                            </div>

                            <div>
                                <span class="text-sm font-medium text-gray-700 block mb-1">Terakhir Diupdate:</span>
                                <span class="text-sm text-gray-500">{{ $trainingVideo->updated_at->format('d F Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h5 class="text-lg font-medium text-gray-900">Aksi Cepat</h5>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                <a href="{{ route('mitra.training-videos.edit', $trainingVideo) }}"
                                   class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-amber-700 bg-amber-100 hover:bg-amber-200 border border-amber-300 rounded-md transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit Video
                                </a>

                                <form action="{{ route('mitra.training-videos.toggle-status', $trainingVideo) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="cursor-pointer w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium {{ $trainingVideo->is_active ? 'text-red-700 bg-red-50 hover:bg-red-100 border-red-200' : 'text-green-700 bg-green-50 hover:bg-green-100 border-green-200' }} border rounded-md transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if($trainingVideo->is_active)
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"/>
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            @endif
                                        </svg>
                                        {{ $trainingVideo->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>

                                <form action="{{ route('mitra.training-videos.destroy', $trainingVideo) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus video ini? Tindakan ini tidak dapat dibatalkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="cursor-pointer w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 rounded-md transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus Video
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
