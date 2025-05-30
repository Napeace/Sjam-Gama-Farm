@extends('mitra.components.layouts')

@section('title', 'Buat Form Pelatihan - Mitra')

@section('content')
<div class="h-full overflow-y-auto">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-6">
                <div class="flex items-center">
                    <a href="{{ route('mitra.training-forms.index') }}"
                       class="text-gray-500 hover:text-gray-700 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Buat Form Pelatihan</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form action="{{ route('mitra.training-forms.store') }}" method="POST" id="trainingForm">
            @csrf

            <!-- Basic Info Section -->
            <div class="bg-white rounded-lg border border-gray-200 mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Informasi Pelatihan</h2>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Pelatihan <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title') }}"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Contoh: Pelatihan Hidroponik untuk Pemula"
                               required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi Pelatihan
                        </label>
                        <textarea id="description"
                                  name="description"
                                  rows="4"
                                  class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Jelaskan tentang pelatihan ini...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date, Time, Quota -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="training_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Pelatihan <span class="text-red-500">*</span>
                            </label>
                            <input type="date"
                                   id="training_date"
                                   name="training_date"
                                   value="{{ old('training_date') }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   required>
                            @error('training_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="training_time" class="block text-sm font-medium text-gray-700 mb-2">
                                Waktu Pelatihan
                            </label>
                            <input type="time"
                                   id="training_time"
                                   name="training_time"
                                   value="{{ old('training_time') }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('training_time')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="max_quota" class="block text-sm font-medium text-gray-700 mb-2">
                                Kuota Maksimal <span class="text-red-500">*</span>
                            </label>
                            <input type="number"
                                   id="max_quota"
                                   name="max_quota"
                                   value="{{ old('max_quota') }}"
                                   min="1"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="50"
                                   required>
                            @error('max_quota')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Location & Price -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                Lokasi Pelatihan
                            </label>
                            <input type="text"
                                   id="location"
                                   name="location"
                                   value="{{ old('location') }}"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Contoh: Aula Balai Desa">
                            @error('location')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                Harga (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number"
                                   id="price"
                                   name="price"
                                   value="{{ old('price', 0) }}"
                                   min="0"
                                   step="1000"
                                   class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="0 (untuk gratis)"
                                   required>
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Location URL -->
                    <div>
                        <label for="location_url" class="block text-sm font-medium text-gray-700 mb-2">
                            Link Google Maps (Opsional)
                        </label>
                        <input type="url"
                               id="location_url"
                               name="location_url"
                               value="{{ old('location_url') }}"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="https://maps.google.com/...">
                        @error('location_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Fields Section -->
            <div class="bg-white rounded-lg border border-gray-200 mb-6">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">Form Pendaftaran</h2>
                    <button type="button"
                            id="addField"
                            class="cursor-pointer inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Field
                    </button>
                </div>

                <div id="fieldsContainer" class="p-6 space-y-4">
                    <!-- Default fields akan ditambahkan dengan JavaScript -->
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('mitra.training-forms.index') }}"
                   class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Batal
                </a>
                <button type="submit"
                        class="cursor-pointer px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Buat Form Pelatihan
                </button>
            </div>
        </form>
    </main>
</div>
@endsection

@push('scripts')
<script>
    // Perbaikan JavaScript untuk form create
    let fieldCounter = 0;

    function createFieldHTML(index, fieldData = {}) {
        const fieldTypes = {
            'text': 'Text',
            'textarea': 'Textarea',
            'email': 'Email',
            'phone': 'Phone',
            'file': 'File Upload'
        };

        return `
            <div class="field-item border border-gray-200 rounded-lg p-4 relative" data-index="${index}">
                <button type="button" class="absolute top-2 right-2 text-red-500 hover:text-red-700 remove-field">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Field <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            name="fields[${index}][field_name]"
                            value="${fieldData.field_name || ''}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Contoh: Nama Lengkap"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tipe Field <span class="text-red-500">*</span>
                        </label>
                        <select name="fields[${index}][field_type]"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                            ${Object.entries(fieldTypes).map(([value, label]) =>
                                `<option value="${value}" ${fieldData.field_type === value ? 'selected' : ''}>${label}</option>`
                            ).join('')}
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi/Placeholder
                    </label>
                    <input type="text"
                        name="fields[${index}][field_description]"
                        value="${fieldData.field_description || ''}"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Masukkan nama lengkap Anda">
                </div>

                <div class="flex items-center">
                    <input type="hidden" name="fields[${index}][is_required]" value="0">
                    <input type="checkbox"
                        name="fields[${index}][is_required]"
                        value="1"
                        ${fieldData.is_required ? 'checked' : ''}
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label class="ml-2 block text-sm text-gray-700">
                        Field wajib diisi
                    </label>
                </div>
            </div>
        `;
    }

    function addField(fieldData = {}) {
        const container = document.getElementById('fieldsContainer');
        if (!container) {
            console.error('fieldsContainer not found');
            return;
        }

        const fieldHTML = createFieldHTML(fieldCounter, fieldData);
        container.insertAdjacentHTML('beforeend', fieldHTML);
        fieldCounter++;

        console.log('Field added with counter:', fieldCounter);
    }

    function removeField(button) {
        const fieldItem = button.closest('.field-item');
        if (fieldItem) {
            fieldItem.remove();
            console.log('Field removed');
        }
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM Content Loaded');

        // Add Field Button
        const addFieldBtn = document.getElementById('addField');
        if (addFieldBtn) {
            addFieldBtn.addEventListener('click', () => {
                console.log('Add field button clicked');
                addField();
            });
        } else {
            console.error('addField button not found');
        }

        // Remove Field Event Delegation
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-field')) {
                e.preventDefault();
                removeField(e.target.closest('.remove-field'));
            }
        });

        // Add default fields when page loads
        addField({
            field_name: 'Nama Lengkap',
            field_type: 'text',
            field_description: 'Masukkan nama lengkap Anda',
            is_required: true
        });

        addField({
            field_name: 'Email',
            field_type: 'email',
            field_description: 'Masukkan alamat email yang aktif',
            is_required: true
        });

        addField({
            field_name: 'Nomor Telepon',
            field_type: 'phone',
            field_description: 'Masukkan nomor telepon/WhatsApp',
            is_required: true
        });

        // Form validation
        const trainingForm = document.getElementById('trainingForm');
        if (trainingForm) {
            trainingForm.addEventListener('submit', function(e) {
                const fieldsContainer = document.getElementById('fieldsContainer');

                // Debug: Log form data before submit
                const formData = new FormData(trainingForm);
                console.log('Form data before submit:');
                for (let [key, value] of formData.entries()) {
                    console.log(key, value);
                }

                if (!fieldsContainer || fieldsContainer.children.length === 0) {
                    e.preventDefault();
                    alert('Minimal harus ada 1 field dalam form pendaftaran!');
                    return false;
                }

                // Additional validation
                const requiredFields = trainingForm.querySelectorAll('[required]');
                for (let field of requiredFields) {
                    if (!field.value.trim()) {
                        e.preventDefault();
                        alert('Mohon lengkapi semua field yang wajib diisi!');
                        field.focus();
                        return false;
                    }
                }
            });
        }
    });

    // Debug function
    function debugFormData() {
        const form = document.getElementById('trainingForm');
        if (form) {
            const formData = new FormData(form);
            console.log('Current form data:');
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }
        }
}</script>
@endpush
