@extends('mitra.components.layouts')

@section('title', 'Jawaban Form Pelatihan')

@section('content')
<div class="h-full overflow-y-auto">
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900 mb-1">Jawaban Form Pelatihan</h1>
                        <h2 class="text-gray-600 text-lg">{{ $trainingForm->title }}</h2>
                    </div>
                    <a href="{{ route('mitra.training-forms.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="px-6 pb-6">
                <!-- Info Form -->
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div class="space-y-2">
                        <p class="text-gray-700"><span class="font-semibold">Tanggal Pelatihan:</span> {{ $trainingForm->training_date->format('d F Y') }}</p>
                        @if($trainingForm->training_time)
                            <p class="text-gray-700"><span class="font-semibold">Waktu:</span> {{ $trainingForm->training_time->format('H:i') }} WIB</p>
                        @endif
                        @if($trainingForm->location)
                            <p class="text-gray-700"><span class="font-semibold">Lokasi:</span> {{ $trainingForm->location }}</p>
                        @endif
                    </div>
                    <div class="space-y-2">
                        <p class="text-gray-700"><span class="font-semibold">Kuota:</span> {{ $trainingForm->actual_current_quota }}/{{ $trainingForm->max_quota }}</p>
                        <p class="text-gray-700"><span class="font-semibold">Harga:</span> {{ $trainingForm->formatted_price }}</p>
                        <p class="text-gray-700">
                            <span class="font-semibold">Status:</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $trainingForm->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $trainingForm->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-blue-500 text-white rounded-lg p-6 text-center">
                        <h3 class="text-3xl font-bold mb-1">{{ $registrations->total() }}</h3>
                        <p class="text-blue-100">Total Pendaftar</p>
                    </div>
                    <div class="bg-yellow-500 text-white rounded-lg p-6 text-center">
                        <h3 class="text-3xl font-bold mb-1">{{ $registrations->where('status', 'pending')->count() }}</h3>
                        <p class="text-yellow-100">Pending</p>
                    </div>
                    <div class="bg-green-500 text-white rounded-lg p-6 text-center">
                        <h3 class="text-3xl font-bold mb-1">{{ $registrations->where('status', 'approved')->count() }}</h3>
                        <p class="text-green-100">Disetujui</p>
                    </div>
                    <div class="bg-red-500 text-white rounded-lg p-6 text-center">
                        <h3 class="text-3xl font-bold mb-1">{{ $registrations->where('status', 'rejected')->count() }}</h3>
                        <p class="text-red-100">Ditolak</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Answers List -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Daftar Jawaban Pendaftar</h2>
            </div>

            <div class="p-6">
                @if($registrations->count() > 0)

                    <!-- Filter Status -->
                    <div class="mb-6">
                        <div class="w-full md:w-64">
                            <select id="statusFilter" onchange="filterByStatus()" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Status</option>
                                <option value="pending">Pending</option>
                                <option value="approved">Disetujui</option>
                                <option value="rejected">Ditolak</option>
                            </select>
                        </div>
                    </div>

                    <!-- Registrations -->
                    @foreach($registrations as $registration)
                        <div class="bg-white border border-gray-200 rounded-lg mb-4 registration-item hover:shadow-md transition-shadow duration-200" data-status="{{ $registration->status }}">
                            <div class="p-4 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm text-gray-500">
                                            Mendaftar pada: {{ $registration->registered_at->format('d F Y, H:i') }} WIB
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{
                                            $registration->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                            ($registration->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800')
                                        }}">
                                            {{ $registration->status_label }}
                                        </span>
                                        <div class="relative">
                                            <button type="button" class="cursor-pointer inline-flex items-center px-3 py-1 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dropdown-toggle" onclick="toggleDropdown({{ $registration->id }})">
                                                Aksi
                                                <svg class="ml-2 -mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </button>
                                            <div id="dropdown-{{ $registration->id }}" class="hidden absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                                                <div class="py-1">
                                                    @if($registration->status == 'pending')
                                                        <a href="#" onclick="updateStatus({{ $registration->id }}, 'approved')" class="flex items-center px-4 py-2 text-sm text-green-700 hover:bg-green-50">
                                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                            Disetujui
                                                        </a>
                                                        <a href="#" onclick="updateStatus({{ $registration->id }}, 'rejected')" class="flex items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                            </svg>
                                                            Ditolak
                                                        </a>
                                                    @elseif($registration->status == 'approved')
                                                        <a href="#" onclick="updateStatus({{ $registration->id }}, 'pending')" class="flex items-center px-4 py-2 text-sm text-yellow-700 hover:bg-yellow-50">
                                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                            </svg>
                                                            Set Pending
                                                        </a>
                                                        <a href="#" onclick="updateStatus({{ $registration->id }}, 'rejected')" class="flex items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                            </svg>
                                                            Ditolak
                                                        </a>
                                                    @else
                                                        <a href="#" onclick="updateStatus({{ $registration->id }}, 'pending')" class="flex items-center px-4 py-2 text-sm text-yellow-700 hover:bg-yellow-50">
                                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                            </svg>
                                                            Set Pending
                                                        </a>
                                                        <a href="#" onclick="updateStatus({{ $registration->id }}, 'approved')" class="flex items-center px-4 py-2 text-sm text-green-700 hover:bg-green-50">
                                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                            Disetujui
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4">
                                <!-- Contact Info -->
                                <div class="grid md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-gray-700"><span class="font-semibold">Email:</span> {{ $registration->email ?? 'Email tidak tersedia' }}</p>
                                    </div>
                                </div>

                                <!-- Custom Fields -->
                                @if($registration->answers && count($registration->answers) > 0)
                                    <div class="grid md:grid-cols-2 gap-4">
                                        @foreach($trainingForm->fields as $field)
                                            @php
                                                $answer = $registration->answers[$field->field_name] ?? null;
                                            @endphp
                                            @if($answer)
                                                <div class="mb-3">
                                                    <label class="block font-semibold text-gray-700 mb-1">{{ $field->field_name }}:</label>
                                                    @if($field->field_type == 'file')
                                                        @if($answer)
                                                            <a href="{{ Storage::url($answer) }}" target="_blank" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded-lg hover:bg-blue-200 transition-colors duration-200">
                                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                                </svg>
                                                                Download File
                                                            </a>
                                                        @else
                                                            <span class="text-gray-500">Tidak ada file</span>
                                                        @endif
                                                    @elseif($field->field_type == 'textarea')
                                                        <div class="border border-gray-200 rounded-lg p-3 bg-gray-50">
                                                            {!! nl2br(e($answer)) !!}
                                                        </div>
                                                    @else
                                                        <p class="text-gray-700">{{ $answer }}</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <!-- Pagination -->
                    <div class="flex justify-center mt-6">
                        {{ $registrations->links() }}
                    </div>
                @else
                    <div class="text-center py-16">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pendaftar</h3>
                        <p class="text-gray-500">Form pelatihan ini belum memiliki pendaftar.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- CSRF Token for AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Success Alert -->
<div id="alert-success" class="hidden fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded z-50" role="alert">
    <div class="flex">
        <div class="py-1">
            <svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
            </svg>
        </div>
        <div>
            <p class="font-bold">Success!</p>
            <p class="text-sm" id="alert-success-message">Status berhasil diperbarui</p>
        </div>
    </div>
</div>

<!-- Error Alert -->
<div id="alert-error" class="hidden fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded z-50" role="alert">
    <div class="flex">
        <div class="py-1">
            <svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z"/>
            </svg>
        </div>
        <div>
            <p class="font-bold">Error!</p>
            <p class="text-sm" id="alert-error-message">Terjadi kesalahan</p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Set CSRF token for all AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Show alert function
    function showAlert(type, message) {
        const alertElement = document.getElementById(`alert-${type}`);
        const messageElement = document.getElementById(`alert-${type}-message`);

        if (alertElement && messageElement) {
            messageElement.textContent = message;
            alertElement.classList.remove('hidden');

            // Hide after 5 seconds
            setTimeout(() => {
                alertElement.classList.add('hidden');
            }, 5000);
        } else {
            console.log(`${type.toUpperCase()}: ${message}`);
            alert(message);
        }
    }

    // Toggle dropdown visibility
    function toggleDropdown(registrationId) {
        const dropdown = document.getElementById(`dropdown-${registrationId}`);
        const allDropdowns = document.querySelectorAll('[id^="dropdown-"]');

        // Close all other dropdowns
        allDropdowns.forEach(d => {
            if (d.id !== `dropdown-${registrationId}`) {
                d.classList.add('hidden');
            }
        });

        // Toggle current dropdown
        if (dropdown) {
            dropdown.classList.toggle('hidden');
        }
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.dropdown-toggle') && !event.target.closest('[id^="dropdown-"]')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });

    // Filter by status
    function filterByStatus() {
        const status = document.getElementById('statusFilter')?.value || '';
        const items = document.querySelectorAll('.registration-item');

        items.forEach(item => {
            if (status === '' || item.dataset.status === status) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Update registration status - PERBAIKAN UNTUK ERROR 419
    function updateStatus(registrationId, newStatus) {
        if (confirm('Apakah Anda yakin ingin mengubah status pendaftar ini?')) {
            // Close dropdown
            const dropdown = document.getElementById(`dropdown-${registrationId}`);
            if (dropdown) {
                dropdown.classList.add('hidden');
            }

            // Show loading message
            const loadingMessage = newStatus === 'approved' ? 'Sedang menyetujui...' :
                                newStatus === 'rejected' ? 'Sedang menolak...' : 'Sedang mengubah status...';
            showAlert('success', loadingMessage);

            // Get fresh CSRF token dari meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            // Log untuk debugging
            console.log('CSRF Token:', csrfToken);

            if (!csrfToken) {
                showAlert('error', 'CSRF token tidak ditemukan. Silakan refresh halaman.');
                return;
            }

            // GUNAKAN ROUTE HELPER LARAVEL
            const updateUrl = "{{ route('mitra.training-registrations.update-status', ':id') }}".replace(':id', registrationId);

            console.log('Sending request to:', updateUrl);

            // Prepare request data sebagai JSON
            const requestData = {
                status: newStatus,
                _token: csrfToken
            };

            // Gunakan fetch dengan JSON payload dan header yang benar
            fetch(updateUrl, {
                method: 'PATCH', // Gunakan PATCH langsung
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(requestData)
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);

                // Cek jika response tidak ok
                if (!response.ok) {
                    if (response.status === 419) {
                        throw new Error('CSRF token expired. Silakan refresh halaman dan coba lagi.');
                    } else if (response.status === 404) {
                        throw new Error('Route tidak ditemukan. Pastikan route sudah benar.');
                    } else if (response.status === 403) {
                        throw new Error('Akses ditolak.');
                    } else if (response.status === 422) {
                        throw new Error('Data tidak valid.');
                    } else if (response.status === 500) {
                        throw new Error('Terjadi kesalahan server.');
                    } else {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);

                if (data.success) {
                    showAlert('success', data.message || 'Status berhasil diperbarui');
                    // Reload halaman setelah 1.5 detik
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                } else {
                    showAlert('error', data.message || 'Gagal mengubah status');
                }
            })
            .catch(error => {
                console.error('Error detail:', error);
                showAlert('error', error.message);
            });
        }
    }
</script>
@endpush
