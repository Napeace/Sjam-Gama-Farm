@extends('mitra.components.layouts')
@section('content')
<div class="h-full overflow-y-auto">
    <div class="flex h-full">
        {{-- Sidebar --}}
        @include('mitra.components.sidebar')

        {{-- Konten utama --}}
        <div class="flex-1 overflow-y-auto px-4 py-6 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="border-b border-gray-200 bg-green-600 text-white px-6 py-4 flex justify-between items-center">
                        <h4 class="text-xl font-semibold">PRODUK</h4>
                        <div class="flex space-x-2">
                            {{-- Tombol Home di header --}}
                            <a href="{{ route('mitra.dashboard') }}" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg shadow flex items-center justify-center transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75M4.5 10.5V21h15V10.5" />
                                </svg>
                                <span class="ml-1">Home</span>
                            </a>

                            {{-- Tombol + di header --}}
                            <a href="{{ route('mitra.produk.create') }}" class="bg-green-600 hover:bg-green-700 text-white p-2 rounded-lg shadow flex items-center justify-center transition-all duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span class="ml-1">Tambah</span>
                            </a>
                        </div>
                    </div>

                    <div class="p-6">
                        {{-- Success/Error Message --}}
                        @if(session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                        @endif

                        {{-- Card Grid for Products - Enhanced Hover Effects --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @forelse($products as $product)
                            <div class="group bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden h-auto cursor-pointer
                                     hover:shadow-xl hover:-translate-y-2 transition-all duration-300 ease-in-out
                                     transform hover:scale-[1.02] active:scale-95">

                                {{-- Card Header with Product Name --}}
                                <div class="bg-gradient-to-r from-green-500 to-teal-500 text-white px-4 py-3">
                                    <h5 class="font-semibold text-base truncate">{{ $product->nama }}</h5>
                                </div>

                                {{-- Product Image with improved styling --}}
                                <div class="w-full h-40 bg-white p-2">
                                    @if($product->gambar)
                                        <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}"
                                             class="w-full h-full object-contain rounded-md transition-transform duration-300 group-hover:scale-105">
                                    @else
                                        <div class="w-full h-full bg-gray-50 flex items-center justify-center rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                {{-- Card Body with improved design --}}
                                <div class="p-4 bg-gray-50">
                                    {{-- Price --}}
                                    <div class="mb-3">
                                        <span class="text-gray-500 text-xs font-medium">Harga:</span>
                                        <p class="font-bold text-xl text-green-600">Rp. {{ number_format($product->harga, 0, ',', '.') }}<span class="text-sm font-medium text-gray-600">/kg</span></p>
                                    </div>

                                    {{-- Status Badges Row - Redesigned --}}
                                    <div class="flex flex-wrap gap-2 mb-3">
                                        @if($product->status_booking == 'MENERIMA')
                                            <span class="px-2 py-1 text-xs font-medium rounded-md bg-green-100 text-green-800 border border-green-200 flex items-center
                                                     hover:bg-green-200 transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                                DAPAT DIBOOKING
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-medium rounded-md bg-red-100 text-red-800 border border-red-200 flex items-center
                                                     hover:bg-red-200 transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                TIDAK DAPAT DIBOOKING
                                            </span>
                                        @endif
                                        @if($product->status_stok == 'TERSEDIA')
                                            <span class="px-2 py-1 text-xs font-medium rounded-md bg-blue-100 text-blue-800 border border-blue-200 flex items-center
                                                     hover:bg-blue-200 transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z"></path></svg>
                                                STOK TERSEDIA
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs font-medium rounded-md bg-yellow-100 text-yellow-800 border border-yellow-200 flex items-center
                                                     hover:bg-yellow-200 transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"></path></svg>
                                                STOK TIDAK TERSEDIA
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Dates - Redesigned --}}
                                    <div class="grid grid-cols-2 gap-2 mb-3 text-sm bg-white p-3 rounded-lg shadow-sm">
                                        <div>
                                            <span class="text-gray-500 text-xs font-medium block mb-1">Tanggal Tanam:</span>
                                            <p class="font-medium text-green-800">{{ $product->tanggal_tanam ? $product->tanggal_tanam->format('d/m/Y') : '-' }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500 text-xs font-medium block mb-1">Prediksi Panen:</span>
                                            <p class="font-medium text-green-800">{{ $product->prediksi_panen ? $product->prediksi_panen->format('d/m/Y') : '-' }}</p>
                                        </div>
                                    </div>

                                    {{-- Actions - Redesigned with hover effects --}}
                                    <div class="mt-3 flex justify-between gap-2">
                                        <a href="{{ route('mitra.produk.edit', $product->id) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-green-100 text-green-700 rounded-lg
                                                 hover:bg-green-200 font-medium text-sm transition-all duration-200 group-hover:-translate-y-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>

                                        <form action="{{ route('mitra.produk.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-100 text-red-700 rounded-lg
                                                     hover:bg-red-200 font-medium text-sm transition-all duration-200 group-hover:-translate-y-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-span-full bg-white rounded-lg p-8 text-center border border-gray-200 shadow-sm">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-gray-600 text-lg font-medium">Belum ada produk.</p>
                                    <p class="text-gray-400 mt-1 text-sm">Klik tombol "+" untuk menambahkan produk baru.</p>
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
