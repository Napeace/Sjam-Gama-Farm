@extends('mitra.components.layouts')

@section('title', 'Dashboard Mitra - SJAM GAMA FARM')

@section('content')
<div class="h-full flex flex-col overflow-hidden">
    <!-- Navbar -->
    @include('mitra.components.navbar')

    <!-- Main Container -->
    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        @include('mitra.components.sidebar')

        <!-- Main Content -->
        <div x-data="{ open: false, title: '' }" class="flex-1 bg-gradient-to-b from-green-600 to-green-900 p-8 overflow-hidden">

            <!-- Cards Grid -->
            <div id="mainContent" class="grid grid-cols-3 gap-3 w-full">
                @php
                    $cards = [
                        [
                            'title' => 'Hidroponik',
                            'image' => 'Hidroponik.png',
                            'description' => 'Kelola produk, video, dan artikel terkait sistem hidroponik',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>'
                        ],
                        [
                            'title' => 'Peternakan',
                            'image' => 'Peternakan.png',
                            'description' => 'Kelola informasi dan produk peternakan',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>'
                        ],
                        [
                            'title' => 'Microgreen',
                            'image' => 'Microgreen.png',
                            'description' => 'Kelola produk dan artikel microgreen',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>'
                        ],
                        [
                            'title' => 'Biogas',
                            'image' => 'Biogas.png',
                            'description' => 'Kelola informasi dan produk biogas',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>'
                        ],
                        [
                            'title' => 'Pupuk',
                            'image' => 'Pupuk.png',
                            'description' => 'Kelola produk dan artikel pupuk organik',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>'
                        ],
                        [
                            'title' => 'Perikanan',
                            'image' => 'Perikanan.png',
                            'description' => 'Kelola informasi dan produk perikanan',
                            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>'
                        ],
                    ];
                @endphp

                @foreach ($cards as $card)
                <div class="group cursor-pointer" @click="open = true; title = '{{ $card['title'] }}'" role="button" tabindex="0">
                    <div class="group relative overflow-hidden rounded-lg shadow-lg bg-white bg-opacity-10 backdrop-blur-sm h-full">
                        <!-- Card Content Container -->
                        <div class="relative h-40 overflow-hidden">
                            <div class="absolute inset-0 bg-black opacity-40 group-hover:opacity-30 transition-opacity duration-450"></div>
                            <img src="{{ asset('images/' . $card['image']) }}" alt="{{ $card['title'] }}" class="object-cover w-full h-full">
                        </div>

                        <!-- Card Info -->
                        <div class="p-3 relative z-10 bg-gray-800 bg-opacity-70">
                            <div class="flex items-center justify-between mb-1">
                                <h2 class="text-lg font-bold text-white drop-shadow-md">{{ $card['title'] }}</h2>
                                <div class="p-1.5 bg-green-600 rounded-full text-white shadow-lg">
                                    {!! $card['icon'] !!}
                                </div>
                            </div>
                            <p class="text-green-100 text-xs">{{ $card['description'] }}</p>

                            <!-- Hover effect -->
                            <div class="mt-2 flex justify-end">
                                <span class="inline-flex items-center text-white text-xs font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    Buka Menu
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Modal -->
            <div
                x-show="open"
                x-transition.opacity
                class="fixed inset-0 flex items-center justify-center z-50"
                aria-modal="true"
                role="dialog"
            >
                <div class="absolute inset-0 bg-black opacity-70" @click="open = false" aria-hidden="true"></div>
                <div
                    class="relative bg-gradient-to-b from-green-700 to-green-900 rounded-xl max-w-sm w-full py-8 px-6 shadow-2xl z-10"
                    @keydown.escape.window="open = false"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                >
                    <!-- Tombol close -->
                    <button @click="open = false" class="absolute -top-3 -right-3 bg-red-600 rounded-full p-2 hover:bg-red-700 focus:outline-none cursor-pointer shadow-lg transition-colors duration-200" aria-label="Tutup modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Isi modal -->
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-white mb-6" x-text="title"></h3>

                        <!-- Menu jika Hidroponik -->
                        <template x-if="title === 'Hidroponik'">
                            <ul class="space-y-3">
                                <li>
                                    <a href="{{ route('mitra.produk.index') }}" class="py-3 px-4 text-white hover:bg-green-600 rounded-lg transition-colors duration-200 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                        Produk
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('mitra.training-forms.index') }}" class="py-3 px-4 text-white hover:bg-green-600 rounded-lg transition-colors duration-200 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z" />
                                        </svg>
                                        Form Pelatihan
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('mitra.training-videos.index') }}" class=" py-3 px-4 text-white hover:bg-green-600 rounded-lg transition-colors duration-200 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Video Pelatihan
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('mitra.artikel.hidroponik') }}" class=" py-3 px-4 text-white hover:bg-green-600 rounded-lg transition-colors duration-200 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                        </svg>
                                        Artikel
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('mitra.reviews.index') }}" class=" py-3 px-4 text-white hover:bg-green-600 rounded-lg transition-colors duration-200 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        </svg>
                                        Review
                                    </a>
                                </li>
                            </ul>
                        </template>

                        <!-- Menu Coming Soon untuk lainnya -->
                        <template x-if="title !== 'Hidroponik'">
                            <div class="py-6 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-yellow-300 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <p class="text-xl font-medium">Fitur Segera Hadir!</p>
                                <p class="text-green-100 mt-3">Fitur ini sedang dalam pengembangan dan akan tersedia dalam waktu dekat.</p>
                                <button @click="open = false" class="mt-6 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 cursor-pointer transition-colors duration-200 shadow-lg">
                                    Kembali
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('Alpine:init', () => {
    // Make sure Alpine.js is initialized properly
    console.log('Alpine initialized');
});

document.addEventListener('DOMContentLoaded', function() {
    // Optional: Add smooth appearing animation for cards
    const cards = document.querySelectorAll('#mainContent > div');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('animate-fadeIn');
        }, 100 * index);
    });
});

document.head.insertAdjacentHTML('beforeend', `
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out forwards;
        }
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
    </style>
`);
</script>
@endsection
