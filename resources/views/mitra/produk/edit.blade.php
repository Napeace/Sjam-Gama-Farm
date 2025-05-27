@extends('mitra.components.layouts')

@section('content')
<div class="flex h-full overflow-hidden">
    <!-- Sidebar -->
    @include('mitra.components.sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto">
        <div class="px-4 py-6 max-w-7xl mx-auto">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="border-b border-gray-200 bg-green-800 text-white px-6 py-4">
                    <h4 class="text-xl font-semibold">UBAH PRODUK</h4>
                </div>
                <div class="p-6">
                    <!-- Form Errors -->
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                            <p class="font-bold">Terjadi kesalahan:</p>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('mitra.produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Tipe Produk Section -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Tipe Produk</label>
                            <div class="flex space-x-4">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="tipe_produk" value="SAYUR"
                                           {{ old('tipe_produk', $product->tipe_produk) == 'SAYUR' ? 'checked' : '' }}
                                           class="sr-only" onchange="toggleProductType()">
                                    <div class="flex items-center space-x-2 px-4 py-2 border-2 rounded-lg transition-all duration-200 sayur-option">
                                        <div class="w-4 h-4 rounded-full border-2 flex items-center justify-center">
                                            <div class="w-2 h-2 rounded-full bg-green-600 hidden sayur-dot"></div>
                                        </div>
                                        <span class="text-sm font-medium">Sayur Hidroponik</span>
                                    </div>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="tipe_produk" value="ALAT"
                                           {{ old('tipe_produk', $product->tipe_produk) == 'ALAT' ? 'checked' : '' }}
                                           class="sr-only" onchange="toggleProductType()">
                                    <div class="flex items-center space-x-2 px-4 py-2 border-2 rounded-lg transition-all duration-200 alat-option">
                                        <div class="w-4 h-4 rounded-full border-2 flex items-center justify-center">
                                            <div class="w-2 h-2 rounded-full bg-green-600 hidden alat-dot"></div>
                                        </div>
                                        <span class="text-sm font-medium">Alat Hidroponik</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Image Upload Section -->
                        <div class="col-span-1 md:col-span-2">
                            <div class="mb-6">
                                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Foto Produk</label>
                                <div class="flex items-center justify-center">
                                    <div class="w-full">
                                        <div class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center">
                                            <div id="preview-container" class="{{ $product->gambar ? '' : 'hidden' }} mb-4">
                                                <img id="preview-image" src="{{ $product->gambar ? asset('storage/' . $product->gambar) : '#' }}" alt="{{ $product->nama }}" class="mx-auto h-40 object-cover">
                                            </div>
                                            <label for="gambar" class="cursor-pointer">
                                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6">
                                                    <div class="space-y-1 text-center">
                                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        </svg>
                                                        <div class="flex text-sm text-gray-600">
                                                            <span class="relative bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                                                {{ $product->gambar ? 'Ganti gambar' : 'Upload gambar' }}
                                                            </span>
                                                            <input id="gambar" name="gambar" type="file" class="sr-only" onchange="previewImage()">
                                                        </div>
                                                        <p class="text-xs text-gray-500">
                                                            PNG, JPG, GIF up to 2MB
                                                        </p>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Basic Information -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $product->nama) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">
                                    <span id="harga-label">Harga (Rp/kg)</span>
                                </label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="number" name="harga" id="harga" value="{{ old('harga', $product->harga) }}" required class="pl-12 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                </div>
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">{{ old('deskripsi', $product->deskripsi) }}</textarea>
                            </div>
                        </div>

                        <!-- Dynamic Fields based on Product Type -->
                        <div id="sayur-fields" class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6" style="display: none;">
                            <div>
                                <label for="status_booking" class="block text-sm font-medium text-gray-700 mb-1">Status Booking</label>
                                <select name="status_booking" id="status_booking" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                    <option value="MENERIMA" {{ old('status_booking', $product->status_booking) == 'MENERIMA' ? 'selected' : '' }}>MENERIMA</option>
                                    <option value="FULL BOOKED" {{ old('status_booking', $product->status_booking) == 'FULL BOOKED' ? 'selected' : '' }}>FULL BOOKED</option>
                                </select>
                            </div>

                            <div>
                                <label for="status_stok" class="block text-sm font-medium text-gray-700 mb-1">Status Stok</label>
                                <select name="status_stok" id="status_stok" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                    <option value="TERSEDIA" {{ old('status_stok', $product->status_stok) == 'TERSEDIA' ? 'selected' : '' }}>TERSEDIA</option>
                                    <option value="TIDAK TERSEDIA" {{ old('status_stok', $product->status_stok) == 'TIDAK TERSEDIA' ? 'selected' : '' }}>TIDAK TERSEDIA</option>
                                </select>
                            </div>

                            <div>
                                <label for="tanggal_tanam" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Tanam</label>
                                <div class="relative">
                                    <input type="date" name="tanggal_tanam" id="tanggal_tanam" value="{{ old('tanggal_tanam', $product->tanggal_tanam ? $product->tanggal_tanam->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                </div>
                            </div>

                            <div>
                                <label for="prediksi_panen" class="block text-sm font-medium text-gray-700 mb-1">Prediksi Panen</label>
                                <div class="relative">
                                    <input type="date" name="prediksi_panen" id="prediksi_panen" value="{{ old('prediksi_panen', $product->prediksi_panen ? $product->prediksi_panen->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                </div>
                            </div>
                        </div>

                        <div id="alat-fields" class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6" style="display: none;">
                            <div>
                                <label for="stok" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Stok</label>
                                <input type="number" name="stok" id="stok" value="{{ old('stok', $product->stok) }}" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <a href="{{ route('mitra.produk.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mr-4">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const preview = document.getElementById('preview-image');
        const container = document.getElementById('preview-container');
        const file = document.getElementById('gambar').files[0];
        const reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
            container.classList.remove('hidden');
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            // Don't hide if there was already an image
            if (!('{{ $product->gambar }}')) {
                preview.src = "";
                container.classList.add('hidden');
            }
        }
    }

    function toggleProductType() {
        const sayurRadio = document.querySelector('input[name="tipe_produk"][value="SAYUR"]');
        const alatRadio = document.querySelector('input[name="tipe_produk"][value="ALAT"]');
        const sayurFields = document.getElementById('sayur-fields');
        const alatFields = document.getElementById('alat-fields');
        const hargaLabel = document.getElementById('harga-label');

        // Update visual radio buttons
        const sayurOption = document.querySelector('.sayur-option');
        const alatOption = document.querySelector('.alat-option');
        const sayurDot = document.querySelector('.sayur-dot');
        const alatDot = document.querySelector('.alat-dot');

        if (sayurRadio.checked) {
            // Show Sayur fields
            sayurFields.style.display = 'grid';
            alatFields.style.display = 'none';
            hargaLabel.textContent = 'Harga (Rp/kg)';

            // Update radio button styles
            sayurOption.classList.add('border-green-500', 'bg-green-50');
            sayurOption.classList.remove('border-gray-300');
            sayurDot.classList.remove('hidden');

            alatOption.classList.remove('border-green-500', 'bg-green-50');
            alatOption.classList.add('border-gray-300');
            alatDot.classList.add('hidden');

        } else if (alatRadio.checked) {
            // Show Alat fields
            sayurFields.style.display = 'none';
            alatFields.style.display = 'grid';
            hargaLabel.textContent = 'Harga (Rp/unit)';

            // Update radio button styles
            alatOption.classList.add('border-green-500', 'bg-green-50');
            alatOption.classList.remove('border-gray-300');
            alatDot.classList.remove('hidden');

            sayurOption.classList.remove('border-green-500', 'bg-green-50');
            sayurOption.classList.add('border-gray-300');
            sayurDot.classList.add('hidden');
        }
    }

    // Initialize form on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleProductType();
    });
</script>
@endsection
