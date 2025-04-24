@extends('layouts.customer')

@section('title', 'Artikel ' . ucfirst($kategori) . ' - SJAM GAMA FARM')

@section('content')
    {{-- Navbar Component --}}
    <x-customer.navbar3 />

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center text-green-700 mb-8">Artikel {{ ucfirst($kategori) }}</h1>

        <div class="max-w-6xl mx-auto">
            @if($artikels->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($artikels as $artikel)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                            @if($artikel->gambar)
                                <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-48 object-cover">
                            @else
                                <img src="{{ asset('images/articles/article-thumb.jpg') }}" alt="Article Thumbnail" class="w-full h-48 object-cover">
                            @endif

                            <div class="p-4">
                                <h2 class="text-xl font-semibold text-green-700 mb-2">{{ $artikel->judul }}</h2>
                                <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">{{ $artikel->created_at->format('d M Y') }}</span>
                                    <a href="/artikel/{{ $artikel->slug }}" class="text-green-600 hover:text-green-800">Baca selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $artikels->links() }}
                </div>
            @else
                <div class="bg-white p-8 rounded-lg shadow-sm text-center">
                    <p class="text-gray-600">Belum ada artikel dalam kategori ini.</p>
                </div>
            @endif

            <div class="mt-8 text-center">
                <a href="/hidroponik" class="text-green-600 hover:text-green-800">
                    &larr; Kembali ke Hidroponik
                </a>
            </div>
        </div>
    </div>

    {{-- Custom Scrollbar Component --}}
    <x-customer.custom-scroll />

    {{-- Footer Component --}}
    <x-customer.footer />
@endsection
