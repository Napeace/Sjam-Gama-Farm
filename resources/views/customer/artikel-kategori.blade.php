@extends('layouts.customer')

@section('title', 'Artikel ' . ucfirst($kategori) . ' - SJAM GAMA FARM')

@section('content')
    {{-- Navbar Component --}}
    <x-customer.navbar3 />

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center text-green-700 mb-8">Artikel {{ ucfirst($kategori) }}</h1>

        {{-- Introduction Section --}}
        <div class="max-w-6xl mx-auto mb-12 bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="relative h-64 overflow-hidden">
                <img src="{{ asset('images/hidroponik-banner.png') }}" alt="Hidroponik Banner" class="w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-60"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h2 class="text-2xl font-bold text-white">Hidroponik Kami</h2>
                </div>
            </div>

            <div class="p-6">
                <div class="flex mb-8">
                    <div class="w-1/2 pr-4">
                        <img src="{{ asset('images/artikelutama.png') }}" alt="Soil and Seedling" class="rounded-lg shadow">
                    </div>
                    <div class="w-1/2 pl-4">
                        <p class="text-gray-700 mb-4">
                            Hidroponik menjadi salah satu fokus utama dalam pengembangan pertanian modern di SJAM GAMA FARM. Melalui pendekatan ini, kami menghadirkan solusi bercocok tanam tanpa tanah yang efisien, bersih, dan cocok diterapkan di berbagai kondisi lahan terbatas, termasuk di wilayah perkotaan. Hidroponik memungkinkan siapa saja untuk memulai kegiatan bertani dengan lebih mudah, tanpa harus memiliki lahan luas atau pengalaman bertani sebelumnya.
                        </p>
                        <p class="text-gray-700 mb-4">
                            Di SJAM GAMA FARM, sistem hidroponik yang kami terapkan telah dirancang agar mudah dioperasikan oleh pemula maupun pelaku usaha pertanian skala menengah. Kami menggunakan rangkaian alat dan nutrisi berkualitas tinggi untuk memastikan pertumbuhan tanaman berjalan optimal dan hasil panen maksimal. Selain itu, kami juga menyediakan pendampingan dan edukasi bagi pelanggan yang ingin mengembangkan sistem hidroponik di rumah maupun dalam skala bisnis.
                        </p>
                        {{-- <p class="text-gray-700">
                            Melalui pengembangan sistem hidroponik ini, SJAM GAMA FARM tidak hanya ingin menyediakan hasil pertanian yang sehat dan berkualitas, tetapi juga mendorong masyarakat untuk berperan aktif dalam menciptakan ketahanan pangan secara mandiri. Kami percaya bahwa hidroponik adalah salah satu langkah konkret menuju pertanian masa depan yang berkelanjutan, modern, dan menjangkau semua kalangan.
                        </p> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Articles Section --}}
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold text-green-700 mb-6">Artikel Terkait</h2>

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
