@extends('mitra.components.layouts')
@section('title', isset($artikel) ? 'Edit Artikel - SJAM GAMA FARM' : 'Tambah Artikel - SJAM GAMA FARM')
@section('content')
<div class="flex h-full overflow-hidden">
    <!-- Sidebar -->
    @include('mitra.components.sidebar')

    <!-- Konten Editor -->
    <div id="mainContent" class="flex-1 bg-gray-100 p-6 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                {{ isset($artikel) ? 'Edit Artikel' : 'Tambah Artikel Baru' }}
            </h1>
            <a href="{{ route('mitra.artikel.hidroponik') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
                Kembali
            </a>
        </div>

        <!-- Form Editor -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ isset($artikel) ? route('mitra.artikel.update', $artikel) : route('mitra.artikel.store') }}"
                method="POST"
                enctype="multipart/form-data"
                id="artikelForm">
                @csrf
                @if(isset($artikel))
                @method('PUT')
                @endif

                <!-- Judul -->
                <div class="mb-4">
                    <label for="judul" class="block text-gray-700 font-medium mb-2">Judul</label>
                    <input type="text"
                        id="judul"
                        name="judul"
                        autocomplete="off"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        value="{{ isset($artikel) ? $artikel->judul : old('judul') }}"
                        required>
                    @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload Gambar -->
                <div class="mb-4">
                    <label for="gambar" class="block text-gray-700 font-medium mb-2">Gambar Cover</label>
                    <!-- Preview gambar -->
                    <div class="mb-3" id="image-preview-container">
                        @if(isset($artikel) && $artikel->gambar)
                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Preview" class="w-40 h-auto rounded mb-2" id="image-preview">
                        @else
                        <img src="" alt="Preview" class="w-40 h-auto rounded mb-2 hidden" id="image-preview">
                        @endif
                        <p class="text-sm text-gray-500 mt-1" id="preview-text">
                            @if(isset($artikel) && $artikel->gambar)
                            Upload gambar baru untuk mengganti
                            @endif
                        </p>
                    </div>
                    <div class="flex items-center">
                        <label for="gambar" class="cursor-pointer bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Pilih Gambar
                        </label>
                        <input type="file"
                            id="gambar"
                            name="gambar"
                            class="hidden"
                            accept="image/*">
                        <span id="file-name" class="ml-3 text-gray-600 text-sm">Belum ada file dipilih</span>
                    </div>
                    @error('gambar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konten -->
                <div class="mb-6">
                    <label for="isi" class="block text-gray-700 font-medium mb-2">Konten</label>
                    <textarea id="isi"
                        name="isi"
                        rows="15"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>{{ isset($artikel) ? $artikel->isi : old('isi') }}</textarea>
                    @error('isi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end">
                    <button type="button" id="submitArtikel" class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded cursor-pointer">
                        {{ isset($artikel) ? 'Perbarui' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/skn71ykaszy2j8ba1bvueseg84bemllqwe5je48my7zayil0/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const sidebarToggle = document.getElementById('sidebarToggle');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            setTimeout(function() {
                adjustLayout();
            }, 50);
        });
    }

    function adjustLayout() {
        const isSidebarExpanded = sidebar && !sidebar.classList.contains('sidebar-collapsed');
        const viewportWidth = window.innerWidth;

        // Sesuaikan lebar konten berdasarkan status sidebar
        if (isSidebarExpanded) {
            mainContent.classList.remove('w-5/6');
            mainContent.classList.add('w-4/6');
        } else {
            mainContent.classList.remove('w-4/6');
            mainContent.classList.add('w-5/6');
        }

        // Sesuaikan ukuran form untuk layar kecil
        if (viewportWidth < 640) {
            const form = document.querySelector('#artikelForm');
            form.classList.remove('w-full');
            form.classList.add('w-full');
        }
    }

    adjustLayout();
    window.addEventListener('resize', adjustLayout);

    // Inisialisasi TinyMCE
    tinymce.init({
        selector: '#isi',
        plugins: [
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons',
            'image', 'link', 'lists', 'media', 'searchreplace',
            'table', 'visualblocks', 'wordcount', 'code', 'fullscreen', 'preview'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | ' +
                 'link image media table | code fullscreen preview | ' +
                 'align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        height: 500,
        menubar: true,
        branding: false,
        promotion: false,
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
        images_upload_handler: function (blobInfo, progress) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = function () {
                    resolve(reader.result);
                };
                reader.readAsDataURL(blobInfo.blob());
            });
        },
        templates: [
            { title: 'Template artikel', description: 'Template dasar untuk artikel', content: '<h2>Judul Bagian</h2><p>Isi paragraf artikel...</p>' }
        ],
        setup: function(editor) {
            editor.on('init', function() {
                const noticeElements = document.querySelectorAll('.tox-notification');
                noticeElements.forEach(function(notice) {
                    if (notice.textContent.includes('domain is not registered')) {
                        notice.style.display = 'none';
                    }
                });
            });
        }
    });

    // Event handler untuk tombol submit
    document.getElementById('submitArtikel').addEventListener('click', function() {
        tinymce.triggerSave();
        document.getElementById('artikelForm').submit();
    });

    // Fungsi untuk preview gambar
    const fileInput = document.getElementById('gambar');
    fileInput.addEventListener('change', function() {
        const fileName = this.files[0]?.name;
        document.getElementById('file-name').textContent = fileName || 'Belum ada file dipilih';

        if (this.files && this.files[0]) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('image-preview');
            const previewText = document.getElementById('preview-text');
            
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
                previewText.textContent = 'Preview gambar yang akan diunggah';
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});
</script>
@endpush
@endsection