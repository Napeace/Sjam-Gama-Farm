@extends('mitra.components.layouts')

@section('title', 'Akun Admin - SJAM GAMA FARM')

@section('content')
<div class="h-full flex flex-col items-center justify-center p-4 bg-gradient-to-b from-green-50 to-white">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header section with farm logo/icon -->
        <div class="bg-green-600 p-6 text-white">
            <div class="flex items-center justify-center mb-2">
                <svg class="w-10 h-10 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838l-2.727 1.168 1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                </svg>
                <h1 class="text-2xl font-bold">Akun Admin</h1>
            </div>
            <p class="text-center text-green-100">Informasi Akun Pengelola SJAM GAMA FARM</p>
        </div>

        <!-- Success notification as toast (auto-dismiss) -->
        @if(session('success'))
            <div id="success-toast" class="fixed top-24 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg z-50 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <p>{{ session('success') }}</p>
            </div>

            <script>
                // Auto dismiss the toast after 3 seconds
                setTimeout(function() {
                    const toast = document.getElementById('success-toast');
                    if (toast) {
                        toast.style.transition = 'opacity 0.5s ease-out';
                        toast.style.opacity = '0';
                        setTimeout(function() {
                            toast.remove();
                        }, 500);
                    }
                }, 3000);
            </script>
        @endif

        <!-- Account information card -->
        <div class="p-6">
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-100">
                <!-- Username -->
                <div class="flex mb-4 pb-4 border-b border-gray-100">
                    <div class="w-1/3 flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium text-gray-700">Username</span>
                    </div>
                    <div class="w-2/3 text-gray-800">{{ $user->username }}</div>
                </div>

                <!-- Phone number -->
                <div class="flex mb-4 pb-4 border-b border-gray-100">
                    <div class="w-1/3 flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                        </svg>
                        <span class="font-medium text-gray-700">No. HP</span>
                    </div>
                    <div class="w-2/3 text-gray-800">{{ $user->no_hp ?? '-' }}</div>
                </div>

                <!-- Email -->
                <div class="flex mb-4 pb-4 border-b border-gray-100">
                    <div class="w-1/3 flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                        <span class="font-medium text-gray-700">Email</span>
                    </div>
                    <div class="w-2/3 text-gray-800">{{ $user->email ?? '-' }}</div>
                </div>

                <!-- Address -->
                <div class="flex">
                    <div class="w-1/3 flex items-start pt-1">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium text-gray-700">Alamat</span>
                    </div>
                    <div class="w-2/3 text-gray-800">{{ $user->alamat ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Action buttons -->
        <div class="px-6 pb-6 flex justify-between">
            <a href="{{ route('mitra.EditAkun') }}" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-lg flex items-center transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Edit akun
            </a>

            <a href="{{ route('mitra.dashboard') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-6 rounded-lg flex items-center transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Farm credentials badge -->
    <div class="mt-4 text-center text-sm text-gray-500">
        <p>SJAM GAMA FARM &copy; 2025</p>
    </div>
</div>
@endsection
