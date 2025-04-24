@extends('layouts.mitra')

@section('title', 'Dashboard Mitra - SJAM GAMA FARM')

@section('content')
<div class="flex h-full overflow-hidden" x-data="{ open: false, title: '' }">

    <!-- Sidebar -->
    <x-mitra.sidebar />

    <!-- Konten Utama -->
    <div class="w-5/6 grid grid-cols-3 grid-rows-2 gap-1 p-1 bg-green-600 h-full">
        @php
            $cards = [
                ['title' => 'Hidroponik', 'image' => 'Hidroponik.png'],
                ['title' => 'Peternakan', 'image' => 'Peternakan.png'],
                ['title' => 'Microgreen', 'image' => 'Microgreen.png'],
                ['title' => 'Biogas', 'image' => 'Biogas.png'],
                ['title' => 'Pupuk', 'image' => 'Pupuk.png'],
                ['title' => 'Perikanan', 'image' => 'Perikanan.png'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="relative group overflow-hidden rounded shadow-lg cursor-pointer"
                @click="open = true; title = '{{ $card['title'] }}'" role="button" tabindex="0">
                <img src="{{ asset('images/' . $card['image']) }}" alt="{{ $card['title'] }}"
                    class="object-cover w-full h-full scale-105 group-hover:scale-110 transition duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-center justify-center">
                        <h2 class="text-white text-lg font-bold drop-shadow-md text-center">{{ $card['title'] }}</h2>
                    </div>
                </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div x-show="open" x-transition class="fixed inset-0 flex items-center justify-center z-50" aria-modal="true" role="dialog">
        <div class="absolute inset-0 bg-black opacity-70" @click="open = false" aria-hidden="true"></div>
        <div class="relative bg-gray-800 bg-opacity-60 rounded-xl max-w-xs w-64 py-8 px-4 shadow-lg z-10" @keydown.escape.window="open = false">
            <!-- Tombol close -->
            <button @click="open = false" class="absolute -top-3 -right-3 bg-black rounded-full p-2 hover:bg-gray-800 focus:outline-none cursor-pointer" aria-label="Tutup modal">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Isi modal -->
            <div class="text-center">
                <h3 class="text-xl font-bold text-white mb-6 -mt-4" x-text="title"></h3>

                <!-- Menu jika Hidroponik -->
                <template x-if="title === 'Hidroponik'">
                    <ul class="space-y-6">
                        <li>
                            <a href="#" class="block py-2 text-white hover:text-gray-300 border-b border-gray-500">Produk</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 text-white hover:text-gray-300 border-b border-gray-500">Video</a>
                        </li>
                        <li>
                            <a href="{{ route('mitra.artikel.hidroponik') }}" class="block py-2 text-white hover:text-gray-300 border-b border-gray-500">Artikel</a>
                        </li>
                        <li>
                            <a href="#" class="block py-2 text-white hover:text-gray-300">Review</a>
                        </li>
                    </ul>
                </template>

                <!-- Menu Coming Soon untuk lainnya -->
                <template x-if="title !== 'Hidroponik'">
                    <div class="py-4 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-3 text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-lg font-medium">Fitur ini belum tersedia</p>
                        <p class="text-sm mt-2 text-gray-300">Maaf, fitur ini masih dalam pengembangan dan akan segera hadir.</p>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>
@endsection
