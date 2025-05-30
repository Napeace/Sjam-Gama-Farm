@extends('mitra.components.layouts')

@section('title', 'Detail Form Pelatihan - Mitra')

@section('content')
<div class="h-full overflow-y-auto">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-6">
                <div class="flex items-center">
                    <a href="{{ route('mitra.training-forms.index') }}"
                       class="text-gray-500 hover:text-gray-700 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Detail Form Pelatihan</h1>
                        <div class="flex items-center mt-2 space-x-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $trainingForm->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $trainingForm->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                            <span class="text-sm text-gray-500">
                                Dibuat {{ $trainingForm->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('mitra.training-forms.answers', $trainingForm) }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Lihat Pendaftar
                    </a>
                    <a href="{{ route('mitra.training-forms.edit', $trainingForm) }}"
                       class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Pelatihan</h2>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Title -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $trainingForm->title }}</h3>
                            @if($trainingForm->description)
                                <p class="text-gray-600 leading-relaxed">{{ $trainingForm->description }}</p>
                            @endif
                        </div>

                        <!-- Training Details Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Date & Time -->
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Tanggal & Waktu</p>
                                    <p class="text-sm text-gray-600">
                                        {{ $trainingForm->training_date ? $trainingForm->training_date->format('d F Y') : '-' }}
                                        @if($trainingForm->training_time)
                                            {{ $trainingForm->training_time->format('H:i') }} WIB
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Lokasi</p>
                                    <p class="text-sm text-gray-600">
                                        {{ $trainingForm->location ?: 'Belum ditentukan' }}
                                        @if($trainingForm->location_url)
                                            <a href="{{ $trainingForm->location_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 ml-2">
                                                <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                </svg>
                                            </a>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Harga</p>
                                    <p class="text-sm text-gray-600 font-semibold">{{ $trainingForm->formatted_price }}</p>
                                </div>
                            </div>

                            <!-- Quota -->
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Kuota Peserta</p>
                                    <p class="text-sm text-gray-600">
                                        {{ $trainingForm->actual_current_quota }}/{{ $trainingForm->max_quota }} peserta
                                        <span class="text-xs text-gray-500">(sisa {{ $trainingForm->available_quota }})</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="bg-white rounded-lg border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Form Pendaftaran</h2>
                        <p class="text-sm text-gray-600 mt-1">Field yang akan diisi oleh peserta saat mendaftar</p>
                    </div>

                    <div class="p-6">
                        @if($trainingForm->fields->count() > 0)
                            <div class="space-y-4">
                                @foreach($trainingForm->fields as $field)
                                    <div class="border border-gray-100 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center space-x-2">
                                                    <h4 class="font-medium text-gray-900">{{ $field->field_name }}</h4>
                                                    @if($field->is_required)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                                            Wajib
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                            Opsional
                                                        </span>
                                                    @endif
                                                </div>
                                                @if($field->field_description)
                                                    <p class="text-sm text-gray-600 mt-1">{{ $field->field_description }}</p>
                                                @endif
                                            </div>
                                            <div class="flex-shrink-0 ml-4">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $field->field_type_label }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-500 mt-4">Belum ada field yang ditambahkan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Statistics Card -->
                <div class="bg-white rounded-lg border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Statistik</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <!-- Total Registrations -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Total Pendaftar</p>
                                    <p class="text-2xl font-bold text-blue-600">{{ $trainingForm->registrations->count() }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Quota Progress -->
                        <div>
                            <div class="flex justify-between text-sm text-gray-600 mb-2">
                                <span>Kuota Terisi</span>
                                <span>{{ $trainingForm->actual_current_quota }}/{{ $trainingForm->max_quota }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $trainingForm->max_quota > 0 ? ($trainingForm->current_quota / $trainingForm->max_quota) * 100 : 0 }}%"></div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-sm font-medium text-gray-900 mb-2">Status Form</p>
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 rounded-full {{ $trainingForm->is_active ? 'bg-green-400' : 'bg-red-400' }}"></div>
                                <span class="text-sm text-gray-600">
                                    {{ $trainingForm->is_active ? 'Aktif dan dapat diakses peserta' : 'Nonaktif - tidak dapat diakses peserta' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <!-- Toggle Status -->
                        <div>
                            <form action="{{ route('mitra.training-forms.toggle', $trainingForm) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="cursor-pointer w-full flex items-center justify-center px-4 py-2 text-sm font-medium rounded-md {{ $trainingForm->is_active ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }} focus:outline-none focus:ring-2 focus:ring-offset-2 {{ $trainingForm->is_active ? 'focus:ring-red-500' : 'focus:ring-green-500' }}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($trainingForm->is_active)
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        @endif
                                    </svg>
                                    {{ $trainingForm->is_active ? 'Nonaktifkan' : 'Aktifkan' }} Form
                                </button>
                            </form>
                        </div>

                        <!-- View Public Form -->
                        @if($trainingForm->is_active)
                            <div>
                                <a href="#" target="_blank"
                                class="w-full flex items-center justify-center px-4 py-2 bg-blue-100 text-blue-700 text-sm font-medium rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Form Publik
                                </a>
                            </div>
                        @endif

                        <!-- Delete Form -->
                        @if($trainingForm->registrations->count() === 0)
                            <div>
                                <form action="{{ route('mitra.training-forms.destroy', $trainingForm) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus form pelatihan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full flex items-center justify-center px-4 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Hapus Form
                                    </button>
                                </form>
                            </div>
                        @else
                            <div>
                                <p class="text-xs text-gray-500 text-center">Form tidak dapat dihapus karena sudah memiliki {{ $trainingForm->registrations->count() }} pendaftar</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Registrations -->
                @if($trainingForm->registrations->count() > 0)
                    <div class="bg-white rounded-lg border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">Pendaftar Terbaru</h3>
                        </div>
                        <div class="p-6">
                            <div class="space-y-3">
                                @foreach($trainingForm->registrations->take(5) as $registration)
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                {{ $registration->data['nama_lengkap'] ?? 'Peserta' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $registration->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if($trainingForm->registrations->count() > 5)
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <a href="{{ route('mitra.training-forms.answers', $trainingForm) }}"
                                       class="text-sm text-blue-600 hover:text-blue-800">
                                        Lihat semua {{ $trainingForm->registrations->count() }} pendaftar →
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
@endsection
