@extends('mitra.components.layouts')

@section('content')
<div class="flex h-full w-full">
    {{-- Sidebar --}}
    @include('mitra.components.sidebar')

    {{-- Main Content --}}
    <div class="flex-1 overflow-y-auto">
        <div class="p-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="border-b border-gray-200 bg-green-800 text-white px-6 py-4">
                    <h4 class="text-xl font-semibold">TAMBAH PRODUK</h4>
                </div>

                <div class="p-6">
                    {{-- Form Errors --}}
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

                    <form action="{{ route('mitra.produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Tipe Produk --}}
                            <div class="col-span-1 md:col-span-2">
                                <label for="tipe_produk" class="block text-sm font-medium text-gray-700 mb-2">Tipe Produk</label>
                                <div class="flex space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="tipe_produk" value="SAYUR"
                                               {{ old('tipe_produk', 'SAYUR') == 'SAYUR' ? 'checked' : '' }}
                                               class="form-radio text-green-600 focus:ring-green-500"
                                               onchange="toggleProductType()">
                                        <span class="ml-2 text-sm font-medium text-gray-700">Sayur Hidroponik</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="tipe_produk" value="ALAT"
                                               {{ old('tipe_produk') == 'ALAT' ? 'checked' : '' }}
                                               class="form-radio text-green-600 focus:ring-green-500"
                                               onchange="toggleProductType()">
                                        <span class="ml-2 text-sm font-medium text-gray-700">Alat Hidroponik</span>
                                    </label>
                                </div>
                            </div>

                            {{-- Foto Produk --}}
                            <div class="col-span-1 md:col-span-2">
                                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Foto Produk</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-md p-6 text-center">
                                    <div id="preview-container" class="hidden mb-4">
                                        <img id="preview-image" src="#" alt="Preview" class="mx-auto h-40 object-cover rounded">
                                    </div>
                                    <label for="gambar" class="cursor-pointer block">
                                        <div class="flex justify-center px-6 pt-5 pb-6">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <span class="text-sm text-gray-600">Upload gambar</span>
                                                <input id="gambar" name="gambar" type="file" class="sr-only" onchange="previewImage()">
                                                <p class="text-xs text-gray-500">PNG, JPG, GIF maksimal 2MB</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            {{-- Nama Produk --}}
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                            </div>

                            {{-- Harga --}}
                            <div>
                                <label for="harga" class="block text-sm font-medium text-gray-700">
                                    <span id="harga-label">Harga (Rp/kg)</span>
                                </label>
                                <div class="relative mt-1">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                                    <input type="number" name="harga" id="harga" value="{{ old('harga') }}" required min="0"
                                           class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                </div>
                            </div>

                            {{-- Deskripsi --}}
                            <div class="col-span-1 md:col-span-2">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" required
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">{{ old('deskripsi') }}</textarea>
                            </div>

                            {{-- Fields untuk Sayur --}}
                            <div id="sayur-fields" class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Status Booking --}}
                                <div>
                                    <label for="status_booking" class="block text-sm font-medium text-gray-700">Status Booking</label>
                                    <select name="status_booking" id="status_booking"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        <option value="MENERIMA" {{ old('status_booking') == 'MENERIMA' ? 'selected' : '' }}>MENERIMA</option>
                                        <option value="FULL BOOKED" {{ old('status_booking') == 'FULL BOOKED' ? 'selected' : '' }}>FULL BOOKED</option>
                                    </select>
                                </div>

                                {{-- Status Stok --}}
                                <div>
                                    <label for="status_stok" class="block text-sm font-medium text-gray-700">Status Stok</label>
                                    <select name="status_stok" id="status_stok"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        <option value="TERSEDIA" {{ old('status_stok') == 'TERSEDIA' ? 'selected' : '' }}>TERSEDIA</option>
                                        <option value="TIDAK TERSEDIA" {{ old('status_stok') == 'TIDAK TERSEDIA' ? 'selected' : '' }}>TIDAK TERSEDIA</option>
                                    </select>
                                </div>

                                {{-- Tanggal Tanam --}}
                                <div>
                                    <label for="tanggal_tanam" class="block text-sm font-medium text-gray-700">Tanggal Tanam</label>
                                    <input type="date" name="tanggal_tanam" id="tanggal_tanam" value="{{ old('tanggal_tanam') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                </div>

                                {{-- Prediksi Panen --}}
                                <div>
                                    <label for="prediksi_panen" class="block text-sm font-medium text-gray-700">Prediksi Panen</label>
                                    <input type="date" name="prediksi_panen" id="prediksi_panen" value="{{ old('prediksi_panen') }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                </div>
                            </div>

                            {{-- Fields untuk Alat --}}
                            <div id="alat-fields" class="col-span-1 md:col-span-2 hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Stok --}}
                                    <div>
                                        <label for="stok" class="block text-sm font-medium text-gray-700">Jumlah Stok</label>
                                        <input type="number" name="stok" id="stok" value="{{ old('stok', 0) }}" min="0"
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring focus:ring-green-500 focus:ring-opacity-50">
                                        <p class="mt-1 text-xs text-gray-500">Status stok akan otomatis disesuaikan berdasarkan jumlah stok</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-8 flex justify-end space-x-3">
                            <a href="{{ route('mitra.produk.index') }}"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
    // Preview gambar
    function previewImage() {
        const preview = document.getElementById('preview-image');
        const container = document.getElementById('preview-container');
        const file = document.getElementById('gambar').files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            container.classList.remove('hidden');
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
            container.classList.add('hidden');
        }
    }

    // Toggle form berdasarkan tipe produk
    function toggleProductType() {
        const tipeSelected = document.querySelector('input[name="tipe_produk"]:checked').value;
        const sayurFields = document.getElementById('sayur-fields');
        const alatFields = document.getElementById('alat-fields');
        const hargaLabel = document.getElementById('harga-label');

        if (tipeSelected === 'SAYUR') {
            sayurFields.classList.remove('hidden');
            alatFields.classList.add('hidden');
            hargaLabel.textContent = 'Harga (Rp/kg)';

            // Set required untuk field sayur
            document.getElementById('status_booking').required = true;
            document.getElementById('status_stok').required = true;
            document.getElementById('stok').required = false;
        } else {
            sayurFields.classList.add('hidden');
            alatFields.classList.remove('hidden');
            hargaLabel.textContent = 'Harga (Rp/unit)';

            // Set required untuk field alat
            document.getElementById('status_booking').required = false;
            document.getElementById('status_stok').required = false;
            document.getElementById('stok').required = true;
        }
    }

    // Jalankan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        toggleProductType();
    });
</script>
@endsection

@push('scripts')
<script>
    // Additional scripts if needed
</script>
@endpush
