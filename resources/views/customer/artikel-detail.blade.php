@extends('layouts.customer')

@section('title', $artikel->judul . ' - SJAM GAMA FARM')

@section('content')
    {{-- Navbar Component --}}
    <x-customer.navbar1 />

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-sm overflow-hidden">
            @if($artikel->gambar)
                <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-64 md:h-96 object-cover">
            @endif

            <div class="p-6">
                <h1 class="text-3xl font-bold text-green-700 mb-4">{{ $artikel->judul }}</h1>
                <div class="text-gray-500 mb-6">
                    <span>{{ $artikel->created_at->format('d M Y') }}</span>
                    <span class="mx-2">•</span>
                    <span>Kategori: {{ ucfirst($artikel->kategori) }}</span>
                </div>

                <div class="prose max-w-none">
                    {!! $artikel->isi !!}
                </div>

                <div class="mt-8 pt-4 border-t border-gray-200">
                    <a href="/hidroponik" class="text-green-600 hover:text-green-800">
                        &larr; Kembali ke Hidroponik
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Scrollbar Component --}}
    <x-customer.custom-scroll />

    {{-- Footer Component --}}
    <x-customer.footer />
@endsection
