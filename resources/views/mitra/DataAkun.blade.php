@extends('mitra.components.layouts')

@section('title', 'Akun Admin - SJAM GAMA FARM')

@section('content')
<div class="h-full flex flex-col items-center justify-center p-4">
    <div class="w-full max-w-2xl bg-green-50 rounded-lg p-8">
        <h1 class="text-2xl font-semibold mb-6 text-center">Akun Admin</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6 space-y-3">
            <div class="flex">
                <div class="w-32">Username</div>
                <div class="w-4">:</div>
                <div>{{ $user->username }}</div>
            </div>

            <div class="flex">
                <div class="w-32">No. HP</div>
                <div class="w-4">:</div>
                <div>{{ $user->no_hp ?? '-' }}</div>
            </div>

            <div class="flex">
                <div class="w-32">Email</div>
                <div class="w-4">:</div>
                <div>{{ $user->email ?? '-' }}</div>
            </div>

            <div class="flex">
                <div class="w-32">Alamat</div>
                <div class="w-4">:</div>
                <div>{{ $user->alamat ?? '-' }}</div>
            </div>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('mitra.EditAkun') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                Edit akun
            </a>

            <a href="{{ route('mitra.dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
