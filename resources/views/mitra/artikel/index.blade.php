@extends('mitra.components.layouts')

@section('title', 'Artikel Hidroponik - SJAM GAMA FARM')

@section('content')
<div class="flex h-full overflow-hidden">

    <!-- Sidebar -->
    @include('mitra.components.sidebar')

    <!-- Konten Artikel -->
    <div class="w-5/6 bg-gray-100 p-6 overflow-y-auto">
        <!-- Judul -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Artikel Hidroponik</h1>
        </div>

        <!-- Tombol floating Home -->
        <a href="{{ route('mitra.dashboard') }}" class="fixed right-24 top-20 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg z-50 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75M4.5 10.5V21h15V10.5" />
            </svg>
        </a>

        <!-- Tombol floating + -->
        <a href="{{ route('mitra.artikel.create') }}" class="fixed right-8 top-20 bg-green-600 hover:bg-green-700 text-white p-3 rounded-full shadow-lg z-50 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </a>

        <!-- Flash Message -->
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Grid Artikel -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($artikels as $artikel)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Gambar Artikel -->
                    <div class="h-48 overflow-hidden">
                        @if($artikel->gambar)
                            <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Konten Artikel -->
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2 line-clamp-2">{{ $artikel->judul }}</h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($artikel->isi), 150) }}
                        </p>

                        <!-- Tombol Aksi -->
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500">{{ $artikel->created_at->format('d M Y') }}</span>
                            <div class="flex space-x-2">
                                <a href="{{ route('mitra.artikel.edit', $artikel) }}" class="text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>

                                <form action="{{ route('mitra.artikel.destroy', $artikel) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 bg-white rounded-lg shadow p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-gray-600">Belum ada artikel. Klik tombol + untuk membuat artikel baru.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
