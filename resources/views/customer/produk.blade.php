@extends('customer.components.layouts')

@section('title', 'Produk Hidroponik - SJAM GAMA FARM')

@section('content')
{{-- Navbar Component --}}
@include('customer.components.navbar3')

<div class="bg-green-50 min-h-screen pb-16" x-data="{ openModal: false, currentProduct: null }">
    <div class="container mx-auto pt-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-green-800 text-center mb-2">PRODUK HIDROPONIK</h1>
        <p class="text-center text-green-600 mb-8 max-w-2xl mx-auto">Sayuran hidroponik segar, bebas pestisida, dan kaya nutrisi langsung dari kebun kami</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($products as $product)
            <div @click="currentProduct = {{ json_encode($product) }}; openModal = true"
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
                    <h2 class="text-lg font-bold text-green-800 mb-1">{{ $product->nama }}</h2>
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

    <!-- Product Modal - Perbaikan -->
    <div x-cloak x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <!-- Overlay latar belakang yang terpisah dan hanya menggelapkan area di luar modal -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" @click="openModal = false"></div>

        <!-- Container untuk modal yang memastikan modal berada di tengah layar -->
        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
            <!-- Modal panel - Seluruh card produk -->
            <div x-show="currentProduct"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="relative bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full lg:max-w-2xl z-10">

                <!-- Tombol close yang tidak mempengaruhi visibility modal -->
                <div class="absolute top-4 right-4 z-20">
                    <button @click="openModal = false" class="bg-white rounded-full p-1 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Konten modal yang terlihat jelas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="relative">
                        <template x-if="currentProduct.gambar">
                            <img :src="'/storage/' + currentProduct.gambar" :alt="currentProduct.nama" class="w-full h-64 object-cover">
                        </template>
                        <template x-if="!currentProduct.gambar">
                            <div class="w-full h-64 bg-gradient-to-r from-green-100 to-green-200 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        </template>

                        <div class="absolute top-3 right-3" x-show="currentProduct.status_booking">
                            <div class="font-medium px-2.5 py-1 rounded-full text-xs"
                                :class="currentProduct.status_booking == 'MENERIMA' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700'">
                                <span x-text="currentProduct.status_booking == 'MENERIMA' ? 'Menerima Booking' : 'Booking Penuh'"></span>
                            </div>
                        </div>

                        <div class="absolute -top-1 -left-1 overflow-hidden w-24 h-24 z-10" x-show="currentProduct.status_stok === 'TIDAK TERSEDIA'">
                            <div class="ribbon-content absolute transform -rotate-45 text-center text-white font-bold py-1 right-[-35px] top-[32px] w-[170px] bg-red-600">STOK HABIS</div>
                        </div>
                    </div>

                    <div class="p-6 flex flex-col">
                        <h2 class="text-2xl font-bold text-green-800 mb-2" x-text="currentProduct.nama"></h2>

                        <div class="flex items-center mb-4">
                            <div class="px-2.5 py-1 rounded-full text-xs font-medium mr-2"
                                :class="currentProduct.status_stok === 'TERSEDIA' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600'"
                                x-text="currentProduct.status_stok"></div>

                            <div class="font-bold text-green-800 text-lg ml-auto">
                                <span x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(currentProduct.harga)"></span>
                                <span class="text-sm font-medium text-gray-600">/kg</span>
                            </div>
                        </div>

                        <template x-if="currentProduct.prediksi_panen">
                            <div class="flex items-center text-sm text-gray-600 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Prediksi Panen: <span x-text="new Date(currentProduct.prediksi_panen).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'})"></span>
                            </div>
                        </template>

                        <div class="mb-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Deskripsi</h3>
                            <p class="text-gray-700 text-sm leading-relaxed" x-text="currentProduct.deskripsi"></p>
                        </div>

                        <div class="mt-auto">
                            <template x-if="currentProduct.status_booking === 'MENERIMA'">
                                <a :href="'https://wa.me/6285156422350?text=Halo, saya tertarik dengan produk ' + currentProduct.nama + ' di SJAM GAMA FARM'"
                                    target="_blank"
                                    class="block w-full text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded-md text-sm font-medium transition-colors duration-300">
                                    Pesan Sekarang via WhatsApp
                                </a>
                            </template>
                            <template x-if="currentProduct.status_booking !== 'MENERIMA'">
                                <div class="block w-full text-center bg-gray-300 text-gray-600 py-3 rounded-md text-sm font-medium cursor-not-allowed">
                                    Tidak Tersedia
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
        class="group flex items-center justify-center w-14 h-14 bg-green-600 rounded-full shadow-lg hover:bg-green-700 transition-all duration-300 hover:scale-105 ring-4 ring-green-200">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="h-7 w-7 text-white fill-current">
                <path d="M16 0C7.163 0 0 7.162 0 16c0 2.828.738 5.502 2.057 7.851L0 32l8.386-2.198A15.938 15.938 0 0 0 16 32c8.837 0 16-7.163 16-16S24.837 0 16 0zm0 29.404c-2.52 0-4.934-.674-7.06-1.947l-.505-.295-4.978 1.305 1.332-4.856-.33-.558A13.312 13.312 0 0 1 2.594 16c0-7.407 6.01-13.404 13.406-13.404S29.404 8.593 29.404 16c0 7.396-6 13.404-13.404 13.404zm7.406-9.438c-.404-.202-2.39-1.178-2.76-1.312-.37-.136-.64-.202-.91.202s-1.042 1.312-1.278 1.582c-.235.27-.47.303-.874.101-.404-.202-1.707-.629-3.252-2.006-1.201-1.07-2.013-2.392-2.25-2.796-.235-.405-.025-.625.178-.828.183-.182.404-.47.607-.707.202-.236.27-.404.404-.674.135-.27.068-.505-.034-.707-.102-.202-.91-2.198-1.246-3.008-.33-.791-.667-.683-.91-.693-.235-.01-.505-.012-.775-.012-.27 0-.708.101-1.078.505-.37.404-1.413 1.383-1.413 3.382 0 1.999 1.446 3.933 1.646 4.205.202.27 2.847 4.338 6.907 6.075.965.417 1.717.666 2.31.852.972.308 1.854.265 2.547.16.777-.115 2.39-.961 2.73-1.885.337-.924.337-1.719.235-1.885-.101-.165-.37-.265-.775-.466z"/>
            </svg>
            <span class="absolute right-16 bg-white px-2 py-1 rounded-md shadow-md text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                Chat dengan kami
            </span>
        </a>
    </div>
</div>

<style>
    .ribbon {
        pointer-events: none;
    }
    .ribbon-content {
        box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    }
    /* Hide content until Alpine.js initializes */
    [x-cloak] {
        display: none !important;
    }
</style>

{{-- Custom Scrollbar Component --}}
@include('customer.components.custom-scroll')

@include('customer.components.footer')
@endsection
