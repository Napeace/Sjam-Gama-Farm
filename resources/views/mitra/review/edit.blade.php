@extends('mitra.components.layouts')

@section('title', 'Ubah Review - SJAM GAMA FARM')

@section('content')
<div class="flex h-full">
    <!-- Sidebar (you already have this component) -->
    @include('mitra.components.sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto bg-gray-100 p-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Ubah Review</h1>
                <p class="text-gray-600">Perbarui informasi review Anda</p>
            </div>

            <form action="{{ route('mitra.reviews.update', $review) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Image Upload -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Gambar</label>
                    <div class="flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg p-6 mb-2">
                        <div id="imagePreview" class="{{ $review->image ? '' : 'hidden' }} mb-4">
                            <img src="{{ $review->image ? asset('storage/' . $review->image) : '#' }}" alt="Preview" class="max-h-48 max-w-full">
                        </div>
                        <div class="flex items-center justify-center w-full">
                            <label for="image-upload" class="flex flex-col items-center justify-center w-full h-32 cursor-pointer rounded-lg bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">{{ $review->image ? 'Ganti gambar' : 'Klik untuk unggah' }}</span></p>
                                    <p class="text-xs text-gray-500">PNG, JPG atau GIF (Maks. 2MB)</p>
                                </div>
                                <input id="image-upload" name="image" type="file" class="hidden" accept="image/*" onchange="showPreview(event)"/>
                            </label>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-gray-700 text-sm font-medium mb-2">Deskripsi</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                        placeholder="Tulis deskripsi review disini...">{{ old('description', $review->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end">
                    <a href="{{ route('mitra.reviews.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md mr-2">
                        Batal
                    </a>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showPreview(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                preview.classList.remove('hidden');
                preview.querySelector('img').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
