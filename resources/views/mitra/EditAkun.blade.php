@extends('layouts.mitra')

@section('title', 'Edit Akun - SJAM GAMA FARM')

@section('content')
<div class="h-full flex flex-col items-center justify-center p-4 relative">
    <div class="w-full max-w-md">
        <h1 class="text-2xl font-semibold mb-8 text-center">Edit Akun</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mitra.updateAkun') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="username_baru" class="block mb-2">Username baru :</label>
                <input type="text" id="username_baru" name="username_baru"  autocomplete="off" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="password_lama" class="block mb-2">Password lama :</label>
                <input type="password" id="password_lama" name="password_lama" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-6">
                <label for="password_baru" class="block mb-2">Password baru :</label>
                <input type="password" id="password_baru" name="password_baru" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 cursor-pointer">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <!-- Home Icon in bottom left corner -->
    <a href="{{ route('mitra.dashboard') }}" class="absolute bottom-4 left-4 text-green-700 hover:text-green-900">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
    </a>
</div>

@endsection
