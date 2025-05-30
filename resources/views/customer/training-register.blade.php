@extends('customer.components.layouts')

@section('title', 'Daftar Pelatihan - ' . $trainingForm->title)

@section('content')
{{-- Custom Scrollbar Component --}}
@include('customer.components.custom-scroll')

<div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50">
    <!-- Header Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="/" class="text-2xl font-bold text-green-600">SJAM GAMA FARM</a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="/hidroponik#pelatihan-section" class="text-gray-600 hover:text-green-600 transition-colors duration-300">
                        ← Kembali ke Daftar Pelatihan
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Training Info Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-green-600 to-emerald-600 p-8 text-white">
                    <h1 class="text-3xl font-bold mb-4">{{ $trainingForm->title }}</h1>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $trainingForm->training_date->format('d F Y') }}</span>
                            </div>
                            @if($trainingForm->training_time)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $trainingForm->training_time->format('H:i') }} WIB</span>
                            </div>
                            @endif
                            @if($trainingForm->location)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>{{ $trainingForm->location }}</span>
                            </div>
                            @endif
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-2xl font-bold">{{ $trainingForm->formatted_price }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Kuota: {{ $trainingForm->available_quota }} dari {{ $trainingForm->max_quota }} tersedia</span>
                            </div>
                        </div>
                    </div>
                    @if($trainingForm->description)
                    <div class="mt-6">
                        <p class="text-green-100">{{ $trainingForm->description }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Error Messages Display -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <strong>Whoops! Ada beberapa masalah dengan input Anda:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Registration Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Form Pendaftaran Pelatihan</h2>

                <form method="POST" action="{{ route('training.register.store', $trainingForm) }}" enctype="multipart/form-data" class="space-y-6" id="registration-form">
                    @csrf

                    <!-- Dynamic Custom Fields -->
                    @if($trainingForm->fields->count() > 0)
                    <div class="space-y-6">
                        @foreach($trainingForm->fields as $field)
                        <div class="space-y-2">
                            <label for="field_{{ $field->id }}" class="block text-sm font-semibold text-gray-700">
                                {{ $field->field_name }}
                                @if($field->is_required)
                                    <span class="text-red-500">*</span>
                                @endif
                            </label>

                            @if($field->field_description)
                                <p class="text-sm text-gray-600">{{ $field->field_description }}</p>
                            @endif

                            @switch($field->field_type)
                                @case('text')
                                    <input type="text"
                                           id="field_{{ $field->id }}"
                                           name="answers[{{ $field->field_name }}]"
                                           value="{{ old('answers.' . $field->field_name) }}"
                                           {{ $field->is_required ? 'required' : '' }}
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-300">
                                    @break

                                @case('email')
                                    <input type="email"
                                           id="field_{{ $field->id }}"
                                           name="answers[{{ $field->field_name }}]"
                                           value="{{ old('answers.' . $field->field_name) }}"
                                           {{ $field->is_required ? 'required' : '' }}
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-300">
                                    @break

                                @case('phone')
                                    <input type="tel"
                                           id="field_{{ $field->id }}"
                                           name="answers[{{ $field->field_name }}]"
                                           value="{{ old('answers.' . $field->field_name) }}"
                                           {{ $field->is_required ? 'required' : '' }}
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-300">
                                    @break

                                @case('textarea')
                                    <textarea id="field_{{ $field->id }}"
                                              name="answers[{{ $field->field_name }}]"
                                              rows="4"
                                              {{ $field->is_required ? 'required' : '' }}
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-300">{{ old('answers.' . $field->field_name) }}</textarea>
                                    @break

                                @case('file')
                                    <input type="file"
                                           id="field_{{ $field->id }}"
                                           name="answers[{{ $field->field_name }}]"
                                           {{ $field->is_required ? 'required' : '' }}
                                           accept=".jpg,.jpeg,.png"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                    <small class="text-gray-500">Format yang diizinkan: JPG, JPEG, PNG (Max: 2MB)</small>
                                    @break
                            @endswitch

                            @error('answers.' . $field->field_name)
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="flex justify-center pt-6">
                        <button type="submit" id="submit-btn"
                            class="cursor-pointer inline-flex items-center justify-center bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold py-4 px-12 rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-xl shadow-lg text-lg group">
                            <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span id="btn-text">Daftar Pelatihan</span>
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
        {{ session('error') }}
    </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registration-form');
    const submitButton = document.getElementById('submit-btn');
    const btnText = document.getElementById('btn-text');

    form.addEventListener('submit', function(e) {
        // Prevent multiple submissions
        if (submitButton.disabled) {
            e.preventDefault();
            return;
        }

        // Show loading state
        submitButton.disabled = true;
        btnText.innerHTML = 'Memproses...';
        submitButton.classList.add('opacity-75');

        // Add loading spinner
        const spinner = document.createElement('div');
        spinner.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        `;
        submitButton.prepend(spinner.firstElementChild);
    });

    // Reset button state if form validation fails (page doesn't redirect)
    setTimeout(function() {
        if (document.querySelector('.text-red-500')) {
            submitButton.disabled = false;
            btnText.innerHTML = 'Daftar Pelatihan';
            submitButton.classList.remove('opacity-75');
            const spinner = submitButton.querySelector('.animate-spin');
            if (spinner) {
                spinner.remove();
            }
        }
    }, 100);

    // File upload validation
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                if (fileSize > 2) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    e.target.value = '';
                }
            }
        });
    });
});
</script>
@endpush
@endsection
