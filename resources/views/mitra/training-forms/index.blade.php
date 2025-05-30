@extends('mitra.components.layouts')
@section('content')
<div class="h-full overflow-y-auto">
    <div class="flex h-full">
        {{-- Sidebar --}}
        @include('mitra.components.sidebar')

        {{-- Konten utama --}}
        <div class="flex-1 overflow-y-auto px-4 py-6 bg-gradient-to-br from-slate-50 to-blue-50">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-slate-200">
                    <div class="border-b border-slate-200 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-5 flex justify-between items-center">
                        <h4 class="text-xl font-bold tracking-wide">DASHBOARD PELATIHAN</h4>
                        <div class="flex space-x-3">
                            {{-- Tombol Home di header --}}
                            <a href="{{ route('mitra.dashboard') }}" class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-4 py-2 rounded-lg shadow-lg flex items-center justify-center transition-all duration-300 hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75M4.5 10.5V21h15V10.5" />
                                </svg>
                                <span class="ml-2 font-medium">Home</span>
                            </a>

                            {{-- Tombol + di header --}}
                            <a href="{{ route('mitra.training-forms.create') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg shadow-lg flex items-center justify-center transition-all duration-300 hover:scale-105">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span class="ml-2 font-medium">Tambah</span>
                            </a>
                        </div>
                    </div>

                    <div class="p-6">
                        {{-- Success/Error Message --}}
                        @if(session('success'))
                        <div class="bg-emerald-50 border-l-4 border-emerald-400 text-emerald-700 p-4 mb-6 rounded-r-lg" role="alert">
                            <p class="font-medium">{{ session('success') }}</p>
                        </div>
                        @endif
                        @if(session('error'))
                        <div class="bg-rose-50 border-l-4 border-rose-400 text-rose-700 p-4 mb-6 rounded-r-lg" role="alert">
                            <p class="font-medium">{{ session('error') }}</p>
                        </div>
                        @endif

                        {{-- Stats Cards --}}
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                            <div class="bg-gradient-to-br from-indigo-500 via-indigo-600 to-purple-600 text-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-white/20 backdrop-blur-sm">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-indigo-100 text-sm font-medium">Total Pelatihan</p>
                                        <p class="text-3xl font-bold">{{ $allTrainingForms->count() }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-br from-emerald-500 via-emerald-600 to-teal-600 text-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-white/20 backdrop-blur-sm">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-emerald-100 text-sm font-medium">Aktif</p>
                                        <p class="text-3xl font-bold">{{ $allTrainingForms->where('is_active', true)->count() }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-br from-amber-500 via-orange-500 to-red-500 text-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-white/20 backdrop-blur-sm">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-amber-100 text-sm font-medium">Total Pendaftar</p>
                                        <p class="text-3xl font-bold">{{ $allTrainingForms->sum('registrations_count') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-br from-violet-500 via-purple-600 to-pink-600 text-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                <div class="flex items-center">
                                    <div class="p-3 rounded-full bg-white/20 backdrop-blur-sm">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-violet-100 text-sm font-medium">Revenue</p>
                                        {{-- PERBAIKAN: Gunakan approved_registrations_count untuk menghitung revenue --}}
                                        <p class="text-2xl font-bold">
                                            Rp {{ number_format($allTrainingForms->sum(function($form) {
                                                return $form->price * ($form->approved_registrations_count ?? 0);
                                            }), 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Filter Tabs --}}
                        <div class="mb-6">
                            <div class="border-b border-slate-200">
                                <nav class="flex space-x-8">
                                    <a href="{{ route('mitra.training-forms.index') }}"
                                       class="py-3 px-1 border-b-2 font-semibold text-sm transition-colors duration-200 {{ !request('status') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-slate-600 hover:text-slate-800 hover:border-slate-300' }}">
                                        Semua Pelatihan
                                        <span class="ml-2 bg-slate-100 text-slate-700 py-1 px-3 rounded-full text-xs font-medium">{{ $allTrainingForms->count() }}</span>
                                    </a>
                                    <a href="{{ route('mitra.training-forms.index', ['status' => 'active']) }}"
                                       class="py-3 px-1 border-b-2 font-semibold text-sm transition-colors duration-200 {{ request('status') == 'active' ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-slate-600 hover:text-slate-800 hover:border-slate-300' }}">
                                        Aktif
                                        <span class="ml-2 bg-emerald-100 text-emerald-700 py-1 px-3 rounded-full text-xs font-medium">{{ $allTrainingForms->where('is_active', true)->count() }}</span>
                                    </a>
                                    <a href="{{ route('mitra.training-forms.index', ['status' => 'inactive']) }}"
                                       class="py-3 px-1 border-b-2 font-semibold text-sm transition-colors duration-200 {{ request('status') == 'inactive' ? 'border-slate-500 text-slate-600' : 'border-transparent text-slate-600 hover:text-slate-800 hover:border-slate-300' }}">
                                        Nonaktif
                                        <span class="ml-2 bg-slate-100 text-slate-700 py-1 px-3 rounded-full text-xs font-medium">{{ $allTrainingForms->where('is_active', false)->count() }}</span>
                                    </a>
                                </nav>
                            </div>
                        </div>

                        {{-- Card Grid for Training Forms --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
                            @forelse($trainingForms as $form)
                            <div class="group bg-white border border-slate-200 rounded-xl shadow-md overflow-hidden h-auto cursor-pointer
                                     hover:shadow-xl hover:-translate-y-2 transition-all duration-300 ease-in-out
                                     transform hover:scale-[1.02] active:scale-95 hover:border-indigo-200">

                                {{-- Card Header with Training Title & Status --}}
                                <div class="bg-gradient-to-r {{ $form->is_active ? 'from-indigo-500 to-purple-600' : 'from-slate-500 to-slate-600' }} text-white px-4 py-4">
                                    <div class="flex justify-between items-center">
                                        <h5 class="font-bold text-base truncate">{{ $form->title }}</h5>
                                        <span class="bg-white/20 backdrop-blur-sm text-white text-xs px-3 py-1.5 rounded-full font-semibold">
                                            {{ $form->is_active ? 'AKTIF' : 'NONAKTIF' }}
                                        </span>
                                    </div>
                                </div>

                                {{-- Training Image/Icon --}}
                                <div class="w-full h-32 bg-gradient-to-br from-slate-50 to-indigo-50 flex items-center justify-center">
                                    <div class="text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-400 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <p class="text-indigo-600 text-sm font-semibold">Pelatihan</p>
                                    </div>
                                </div>

                                {{-- Card Body --}}
                                <div class="p-4 bg-slate-50">
                                    {{-- Description --}}
                                    @if($form->description)
                                        <div class="mb-3">
                                            <p class="text-slate-600 text-sm line-clamp-2">{{ Str::limit($form->description, 80) }}</p>
                                        </div>
                                    @endif

                                    {{-- Price --}}
                                    <div class="mb-3">
                                        <span class="text-slate-500 text-xs font-medium">Harga:</span>
                                        <p class="font-bold text-xl text-indigo-600">
                                            {{ $form->formatted_price }}
                                        </p>
                                    </div>

                                    {{-- Training Date & Time --}}
                                    <div class="mb-3 text-sm bg-white p-3 rounded-lg shadow-sm border border-slate-100">
                                        <div class="grid grid-cols-1 gap-2">
                                            <div>
                                                <span class="text-slate-500 text-xs font-medium block mb-1">Tanggal Pelatihan:</span>
                                                <p class="font-semibold text-slate-800">{{ $form->training_date->format('d M Y') }}</p>
                                            </div>
                                            @if($form->training_time)
                                            <div>
                                                <span class="text-slate-500 text-xs font-medium block mb-1">Waktu:</span>
                                                <p class="font-semibold text-slate-800">{{ $form->training_time->format('H:i') }} WIB</p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Quota Information --}}
                                    <div class="mb-3 text-sm bg-white p-3 rounded-lg shadow-sm border border-slate-100">
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-slate-500 text-xs font-medium">Kuota:</span>
                                            {{-- PERBAIKAN: Gunakan approved_registrations_count atau actual_current_quota --}}
                                            <p class="font-bold text-lg text-slate-800">{{ $form->approved_registrations_count ?? $form->actual_current_quota }}/{{ $form->max_quota }}</p>
                                        </div>
                                        <div class="w-full bg-slate-200 rounded-full h-2">
                                            {{-- PERBAIKAN: Hitung persentase berdasarkan approved registrations --}}
                                            @php
                                                $approvedCount = $form->approved_registrations_count ?? $form->actual_current_quota;
                                                $percentage = $form->max_quota > 0 ? ($approvedCount / $form->max_quota) * 100 : 0;
                                            @endphp
                                            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2 rounded-full transition-all duration-300" style="width: {{ $percentage }}%"></div>
                                        </div>
                                        {{-- PERBAIKAN: Cek kuota penuh berdasarkan approved registrations --}}
                                        @if($approvedCount >= $form->max_quota)
                                            <div class="mt-2 bg-rose-50 rounded-md p-2 border border-rose-100">
                                                <div class="flex items-center text-rose-700 text-xs">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Kuota penuh
                                                </div>
                                            </div>
                                        @else
                                            <div class="mt-2 bg-emerald-50 rounded-md p-2 border border-emerald-100">
                                                <div class="flex items-center text-emerald-700 text-xs">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    Tersedia {{ $form->max_quota - $approvedCount }} slot
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Actions --}}
                                    <div class="mt-4 grid grid-cols-2 gap-2">
                                        <a href="{{ route('mitra.training-forms.show', $form) }}"
                                           class="inline-flex items-center justify-center px-3 py-2 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 font-semibold text-xs transition-all duration-200 group-hover:-translate-y-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat
                                        </a>

                                        <a href="{{ route('mitra.training-forms.edit', $form) }}"
                                           class="inline-flex items-center justify-center px-3 py-2 bg-emerald-50 text-emerald-700 rounded-lg hover:bg-emerald-100 font-semibold text-xs transition-all duration-200 group-hover:-translate-y-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>

                                        <a href="{{ route('mitra.training-forms.answers', $form) }}"
                                           class="inline-flex items-center justify-center px-3 py-2 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 font-semibold text-xs transition-all duration-200 group-hover:-translate-y-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            Jawaban ({{ $form->registrations_count }})
                                        </a>

                                        <form action="{{ route('mitra.training-forms.toggle', $form) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                    class="cursor-pointer w-full inline-flex items-center justify-center px-3 py-2 bg-amber-50 text-amber-700 rounded-lg hover:bg-amber-100 font-semibold text-xs transition-all duration-200 group-hover:-translate-y-1"
                                                    onclick="return confirm('Yakin ingin mengubah status?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                                </svg>
                                                {{ $form->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                    </div>

                                    {{-- Delete Button (only if no registrations) --}}
                                    @if($form->registrations_count == 0)
                                    <div class="mt-2">
                                        <form action="{{ route('mitra.training-forms.destroy', $form) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pelatihan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cursor-pointer w-full inline-flex items-center justify-center px-3 py-2 bg-rose-50 text-rose-700 rounded-lg hover:bg-rose-100 font-semibold text-xs transition-all duration-200 group-hover:-translate-y-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @empty
                            <div class="col-span-full bg-white rounded-xl p-8 text-center border border-slate-200 shadow-sm">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <p class="text-slate-600 text-lg font-semibold">
                                        @if(request('status') == 'active')
                                            Belum ada pelatihan aktif.
                                        @elseif(request('status') == 'inactive')
                                            Belum ada pelatihan nonaktif.
                                        @else
                                            Belum ada pelatihan.
                                        @endif
                                    </p>
                                    <p class="text-slate-400 mt-1 text-sm">Klik tombol "Tambah" untuk menambahkan pelatihan baru.</p>
                                </div>
                            </div>
                            @endforelse
                        </div>

                        {{-- Pagination --}}
                        @if($trainingForms->hasPages())
                        <div class="mt-8 flex justify-center">
                            {{ $trainingForms->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
