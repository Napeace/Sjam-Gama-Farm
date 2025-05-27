@extends('customer.components.layouts')

@section('title', 'Produk Hidroponik - SJAM GAMA FARM')

@section('content')
{{-- Navbar Component --}}
@include('customer.components.navbar3')

<div class="bg-green-50 min-h-screen pb-16" x-data="{ openModal: false, currentProduct: null }">
    <div class="container mx-auto pt-8 px-4 sm:px-6 lg:px-8">
        {{-- <h1 class="text-4xl font-bold text-green-800 text-center mb-2">PRODUK KAMI</h1>
        <p class="text-center text-green-600 mb-12 max-w-3xl mx-auto">Produk berkualitas tinggi untuk kebutuhan hidroponik dan konsumsi sehari-hari</p> --}}

        <!-- SECTION PRODUK SAYUR -->
        <div class="mb-16">
            <div class="flex items-center mb-8">
                <div class="flex-grow h-px bg-green-200"></div>
                <h2 class="text-3xl font-bold text-green-800 px-6 bg-green-50">SAYUR HIDROPONIK</h2>
                <div class="flex-grow h-px bg-green-200"></div>
            </div>
            <p class="text-center text-green-600 mb-8 max-w-2xl mx-auto">Sayuran hidroponik segar, bebas pestisida, dan kaya nutrisi langsung dari kebun kami</p>

            @if($sayurProducts->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach($sayurProducts as $product)
                    <div @click="currentProduct = {{ json_encode(array_merge($product->toArray(), ['type' => 'sayur'])) }}; openModal = true"
                        class="bg-white rounded-xl overflow-visible shadow-md hover:shadow-xl transition-all duration-300 h-full flex flex-col relative transform hover:-translate-y-1 cursor-pointer">
                        <div class="relative">
                            @if($product->gambar)
                                <img src="{{ Storage::url($product->gambar) }}" alt="{{ $product->nama }}" class="w-full h-48 object-cover {{ $product->status_stok === 'TIDAK TERSEDIA' ? 'brightness-75' : '' }}">
                            @else
                                <div class="w-full h-48 bg-gradient-to-r from-green-100 to-green-200 flex items-center justify-center {{ $product->status_stok === 'TIDAK TERSEDIA' ? 'brightness-75' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="absolute top-3 right-3">
                                <div class="group relative font-medium px-2.5 py-1 rounded-full text-xs {{ $product->status_booking == 'MENERIMA' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                    {{ $product->status_booking == 'MENERIMA' ? 'Menerima Booking' : 'Booking Penuh' }}
                                    <span class="absolute left-1/2 transform -translate-x-1/2 -translate-y-1 z-10 bg-white border border-gray-200 text-gray-700 text-xs rounded p-2 w-48 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none shadow-md">
                                        {{ $product->status_booking == 'MENERIMA' ? 'Produk ini tersedia untuk dipesan' : 'Produk ini sudah terbooking penuh untuk saat ini' }}
                                    </span>
                                </div>
                            </div>

                            @if($product->status_stok === 'TIDAK TERSEDIA')
                            <div class="ribbon absolute -top-1 -left-1 overflow-hidden w-24 h-24 z-10">
                                <div class="ribbon-content absolute transform -rotate-45 text-center text-white font-bold py-1 right-[-35px] top-[32px] w-[170px] bg-red-600">STOK HABIS</div>
                            </div>
                            @endif
                        </div>

                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-green-800 mb-1">{{ $product->nama }}</h3>
                            <p class="text-gray-700 mb-4 text-sm leading-relaxed flex-grow">{{ Str::limit($product->deskripsi, 120) }}</p>

                            <div class="mt-auto space-y-3">
                                @if($product->prediksi_panen)
                                <div class="flex items-center text-xs text-gray-600 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Panen: {{ $product->prediksi_panen->format('d M Y') }}
                                </div>
                                @endif

                                <div class="flex items-center justify-between">
                                    <div class="font-bold text-green-800 text-lg">
                                        Rp {{ number_format($product->harga, 0, ',', '.') }}<span class="text-sm font-medium text-gray-600">/kg</span>
                                    </div>

                                    <div class="px-2.5 py-1 {{ $product->status_stok === 'TERSEDIA' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }} rounded-full text-xs font-medium">
                                        {{ $product->status_stok }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($product->status_booking === 'MENERIMA')
                        <a @click.stop href="https://wa.me/6285156422350?text=Halo, saya tertarik dengan produk {{ $product->nama }} di SJAM GAMA FARM"
                            target="_blank"
                            class="block w-full text-center bg-green-600 hover:bg-green-700 text-white py-2.5 text-sm font-medium transition-colors duration-300">
                            Pesan Sekarang
                        </a>
                        @else
                        <div class="block w-full text-center bg-gray-300 text-gray-600 py-2.5 text-sm font-medium cursor-not-allowed">
                            Tidak Tersedia
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M9 21H4a2 2 0 01-2-2v-4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Produk Sayur</h3>
                    <p class="text-gray-600">Produk sayur hidroponik akan segera tersedia</p>
                </div>
            @endif
        </div>

        <!-- SECTION PRODUK ALAT -->
        <div class="mb-16">
            <div class="flex items-center mb-8">
                <div class="flex-grow h-px bg-blue-200"></div>
                <h2 class="text-3xl font-bold text-blue-800 px-6 bg-blue-50">ALAT HIDROPONIK</h2>
                <div class="flex-grow h-px bg-blue-200"></div>
            </div>
            <p class="text-center text-blue-600 mb-8 max-w-2xl mx-auto">Alat dan perlengkapan hidroponik berkualitas untuk mendukung budidaya tanaman Anda</p>

            @if($alatProducts->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                    @foreach($alatProducts as $product)
                    <div @click="currentProduct = {{ json_encode(array_merge($product->toArray(), ['type' => 'alat'])) }}; openModal = true"
                        class="bg-white rounded-xl overflow-visible shadow-md hover:shadow-xl transition-all duration-300 h-full flex flex-col relative transform hover:-translate-y-1 cursor-pointer">
                        <div class="relative">
                            @if($product->gambar)
                                <img src="{{ Storage::url($product->gambar) }}" alt="{{ $product->nama }}" class="w-full h-48 object-cover {{ $product->status_stok === 'TIDAK TERSEDIA' ? 'brightness-75' : '' }}">
                            @else
                                <div class="w-full h-48 bg-gradient-to-r from-blue-100 to-blue-200 flex items-center justify-center {{ $product->status_stok === 'TIDAK TERSEDIA' ? 'brightness-75' : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="absolute top-3 right-3">
                                <div class="font-medium px-2.5 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                                    Stok: {{ $product->stok }}
                                </div>
                            </div>

                            @if($product->status_stok === 'TIDAK TERSEDIA')
                            <div class="ribbon absolute -top-1 -left-1 overflow-hidden w-24 h-24 z-10">
                                <div class="ribbon-content absolute transform -rotate-45 text-center text-white font-bold py-1 right-[-35px] top-[32px] w-[170px] bg-red-600">STOK HABIS</div>
                            </div>
                            @endif
                        </div>

                        <div class="p-4 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-blue-800 mb-1">{{ $product->nama }}</h3>
                            <p class="text-gray-700 mb-4 text-sm leading-relaxed flex-grow">{{ Str::limit($product->deskripsi, 120) }}</p>

                            <div class="mt-auto space-y-3">
                                <div class="flex items-center justify-between">
                                    <div class="font-bold text-blue-800 text-lg">
                                        Rp {{ number_format($product->harga, 0, ',', '.') }}<span class="text-sm font-medium text-gray-600">/pcs</span>
                                    </div>

                                    <div class="px-2.5 py-1 {{ $product->status_stok === 'TERSEDIA' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }} rounded-full text-xs font-medium">
                                        {{ $product->status_stok }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($product->status_stok === 'TERSEDIA')
                        <a @click.stop href="https://wa.me/6285156422350?text=Halo, saya tertarik dengan produk {{ $product->nama }} di SJAM GAMA FARM"
                            target="_blank"
                            class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-2.5 text-sm font-medium transition-colors duration-300">
                            Pesan Sekarang
                        </a>
                        @else
                        <div class="block w-full text-center bg-gray-300 text-gray-600 py-2.5 text-sm font-medium cursor-not-allowed">
                            Stok Habis
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Produk Alat</h3>
                    <p class="text-gray-600">Produk alat hidroponik akan segera tersedia</p>
                </div>
            @endif
        </div>

        <div class="mt-12 max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold text-green-800 mb-4 text-center">Informasi Pembelian</h2>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Status Booking</h3>
                        <p class="text-gray-600">Produk dengan status "Menerima Booking" dapat dipesan, sedangkan "Booking Penuh" menandakan produk sudah habis terjual untuk masa panen saat ini.</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Prediksi Panen</h3>
                        <p class="text-gray-600">Tanggal yang tercantum adalah perkiraan kapan produk akan dipanen dan siap dikirim kepada pelanggan.</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Cara Pemesanan</h3>
                        <p class="text-gray-600">Klik tombol "Pesan Sekarang" pada produk yang ingin Anda beli atau hubungi kami melalui tombol WhatsApp di pojok kanan bawah untuk pemesanan dan informasi pengiriman.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Modal - Fixed untuk membedakan tipe produk -->
    <div x-cloak x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        <!-- Overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="openModal = false"></div>

        <!-- Modal Container -->
        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
            <!-- Modal Panel -->
            <div x-show="currentProduct"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-2xl z-10">

                <!-- Close Button -->
                <div class="absolute top-4 right-4 z-20">
                    <button @click="openModal = false" class="bg-white rounded-full p-1 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Image Section -->
                    <div class="relative">
                        <template x-if="currentProduct.gambar">
                            <img :src="'/storage/' + currentProduct.gambar" :alt="currentProduct.nama" class="w-full h-64 object-cover">
                        </template>
                        <template x-if="!currentProduct.gambar">
                            <div class="w-full h-64 bg-gradient-to-r flex items-center justify-center"
                                 :class="currentProduct.type === 'sayur' ? 'from-green-100 to-green-200' : 'from-blue-100 to-blue-200'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16"
                                     :class="currentProduct.type === 'sayur' ? 'text-green-500' : 'text-blue-500'"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          :d="currentProduct.type === 'sayur' ? 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z' : 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'" />
                                </svg>
                            </div>
                        </template>

                        <!-- Status Badge - Hanya untuk produk sayur -->
                        <div class="absolute top-3 right-3" x-show="currentProduct.type === 'sayur' && currentProduct.status_booking">
                            <div class="font-medium px-2.5 py-1 rounded-full text-xs"
                                :class="currentProduct.status_booking == 'MENERIMA' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700'">
                                <span x-text="currentProduct.status_booking == 'MENERIMA' ? 'Menerima Booking' : 'Booking Penuh'"></span>
                            </div>
                        </div>

                        <!-- Stock Badge - Hanya untuk produk alat -->
                        <div class="absolute top-3 right-3" x-show="currentProduct.type === 'alat' && currentProduct.stok">
                            <div class="font-medium px-2.5 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                                Stok: <span x-text="currentProduct.stok"></span>
                            </div>
                        </div>

                        <!-- Out of Stock Ribbon -->
                        <div class="absolute -top-1 -left-1 overflow-hidden w-24 h-24 z-10"
                             x-show="(currentProduct.type === 'sayur' && currentProduct.status_stok === 'TIDAK TERSEDIA') || (currentProduct.type === 'alat' && currentProduct.status_stok === 'TIDAK TERSEDIA')">
                            <div class="ribbon-content absolute transform -rotate-45 text-center text-white font-bold py-1 right-[-35px] top-[32px] w-[170px] bg-red-600">STOK HABIS</div>
                        </div>
                    </div>

                    <!-- Product Info Section -->
                    <div class="p-6 flex flex-col">
                        <h2 class="text-2xl font-bold mb-2"
                            :class="currentProduct.type === 'sayur' ? 'text-green-800' : 'text-blue-800'"
                            x-text="currentProduct.nama"></h2>

                        <!-- Status and Price -->
                        <div class="flex items-center mb-4">
                            <div class="px-2.5 py-1 rounded-full text-xs font-medium mr-2"
                                :class="((currentProduct.type === 'sayur' && currentProduct.status_stok === 'TERSEDIA') || (currentProduct.type === 'alat' && currentProduct.status_stok === 'TERSEDIA')) ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600'"
                                x-text="currentProduct.type === 'sayur' ? currentProduct.status_stok : currentProduct.status_stok"></div>

                            <div class="font-bold text-lg ml-auto"
                                 :class="currentProduct.type === 'sayur' ? 'text-green-800' : 'text-blue-800'">
                                <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(currentProduct.harga)"></span>
                                <span class="text-sm font-medium text-gray-600" x-text="currentProduct.type === 'sayur' ? '/kg' : '/pcs'"></span>
                            </div>
                        </div>

                        <!-- Harvest Prediction - Hanya untuk produk sayur -->
                        <template x-if="currentProduct.type === 'sayur' && currentProduct.prediksi_panen">
                            <div class="flex items-center text-sm text-gray-600 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Prediksi Panen:&nbsp;<span x-text="new Date(currentProduct.prediksi_panen).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'})"></span>
                            </div>
                        </template>

                        <!-- Description -->
                        <div class="mb-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Deskripsi</h3>
                            <p class="text-gray-700 text-sm leading-relaxed" x-text="currentProduct.deskripsi"></p>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-auto">
                            <!-- Button untuk produk sayur -->
                            <template x-if="currentProduct.type === 'sayur'">
                                <template x-if="currentProduct.status_booking === 'MENERIMA'">
                                <a :href="'https://wa.me/6285156422350?text=Halo, saya tertarik dengan produk ' + currentProduct.nama + ' di SJAM GAMA FARM'"
                                    target="_blank"
                                    class="block w-full text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg text-sm font-medium transition-colors duration-300">
                                    Pesan Sekarang
                                </a>
                            </template>
                            <template x-if="currentProduct.status_booking !== 'MENERIMA'">
                                <div class="block w-full text-center bg-gray-300 text-gray-600 py-3 rounded-lg text-sm font-medium cursor-not-allowed">
                                    Tidak Tersedia
                                </div>
                            </template>
                        </template>

                        <!-- Button untuk produk alat -->
                        <template x-if="currentProduct.type === 'alat'">
                            <div>
                                <template x-if="currentProduct.status_stok === 'TERSEDIA'">
                                    <a :href="'https://wa.me/6285156422350?text=Halo, saya tertarik dengan produk ' + currentProduct.nama + ' di SJAM GAMA FARM'"
                                        target="_blank"
                                        class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg text-sm font-medium transition-colors duration-300">
                                        Pesan Sekarang
                                    </a>
                                </template>
                                <template x-if="currentProduct.status_stok !== 'TERSEDIA'">
                                    <div class="block w-full text-center bg-gray-300 text-gray-600 py-3 rounded-lg text-sm font-medium cursor-not-allowed">
                                        Stok Habis
                                    </div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- WhatsApp Floating Button -->
    <div class="fixed bottom-6 right-6 z-40">
        <a href="https://wa.me/6285156422350" target="_blank"
        class="group flex items-center justify-center w-14 h-14 bg-green-600 rounded-full shadow-lg hover:bg-green-700 transition-all duration-300 hover:scale-105 ring-4 ring-green-200 relative">

            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="h-7 w-7 text-white fill-current">
                <path d="M16 0C7.163 0 0 7.162 0 16c0 2.828.738 5.502 2.057 7.851L0 32l8.386-2.198A15.938 15.938 0 0 0 16 32c8.837 0 16-7.163 16-16S24.837 0 16 0zm0 29.404c-2.52 0-4.934-.674-7.06-1.947l-.505-.295-4.978 1.305 1.332-4.856-.33-.558A13.312 13.312 0 0 1 2.594 16c0-7.407 6.01-13.404 13.406-13.404S29.404 8.593 29.404 16c0 7.396-6 13.404-13.404 13.404zm7.406-9.438c-.404-.202-2.39-1.178-2.76-1.312-.37-.136-.64-.202-.91.202s-1.042 1.312-1.278 1.582c-.235.27-.47.303-.874.101-.404-.202-1.707-.629-3.252-2.006-1.201-1.07-2.013-2.392-2.25-2.796-.235-.405-.025-.625.178-.828.183-.182.404-.47.607-.707.202-.236.27-.404.404-.674.135-.27.068-.505-.034-.707-.102-.202-.91-2.198-1.246-3.008-.33-.791-.667-.683-.91-.693-.235-.01-.505-.012-.775-.012-.27 0-.708.101-1.078.505-.37.404-1.413 1.383-1.413 3.382 0 1.999 1.446 3.933 1.646 4.205.202.27 2.847 4.338 6.907 6.075.965.417 1.717.666 2.31.852.972.308 1.854.265 2.547.16.777-.115 2.39-.961 2.73-1.885.337-.924.337-1.719.235-1.885-.101-.165-.37-.265-.775-.466z"/>
            </svg>

            <!-- Tooltip -->
            <span class="pointer-events-none absolute right-16 bg-white px-2 py-1 rounded-md shadow-md text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                Chat dengan kami
            </span>
        </a>
    </div>
</div>

{{-- Footer --}}
@include('customer.components.footer')

{{-- Custom Scrollbar Component --}}
@include('customer.components.custom-scroll')

<style>
    .ribbon {
        position: absolute;
        overflow: hidden;
    }

    .ribbon-content {
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

@endsection
