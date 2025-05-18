@extends('mitra.components.layouts')

@section('title', 'Daftar Review - SJAM GAMA FARM')

@section('content')
<div class="flex h-full">
    <!-- Sidebar (you already have this component) -->
    @include('mitra.components.sidebar')

    <!-- Main Content -->
    <div class="flex-1 overflow-y-auto bg-gray-100 p-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Daftar Review</h1>

                <div class="flex space-x-4">
                    <!-- Tombol Home -->
                    <a href="{{ route('mitra.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75M4.5 10.5V21h15V10.5" />
                        </svg>
                    </a>

                    <!-- Tombol + -->
                    <a href="{{ route('mitra.reviews.create') }}" class="bg-green-600 hover:bg-green-700 text-white p-3 rounded-full shadow-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Flash Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Reviews List -->
            @if($reviews->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($reviews as $review)
                        <div class="bg-gray-50 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow">
                            <div class="mb-3">
                                @if($review->image)
                                    <img src="{{ asset('storage/' . $review->image) }}" alt="Review Image" class="w-full h-48 object-cover rounded-md">
                                @else
                                    <div class="w-full h-48 bg-gray-200 rounded-md flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <p class="text-gray-700 mb-3 line-clamp-3">{{ $review->description }}</p>
                            <div class="text-xs text-gray-500 mb-3">
                                Dibuat: {{ $review->created_at->format('d M Y, H:i') }}
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('mitra.reviews.edit', $review) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded-md text-sm">
                                    Ubah
                                </a>
                                <form action="{{ route('mitra.reviews.destroy', $review) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus review ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-500 text-lg">Belum ada review yang ditambahkan</p>
                    <a href="{{ route('mitra.reviews.create') }}" class="inline-block mt-3 text-green-600 hover:text-green-800 font-medium">
                        Tambahkan review pertama Anda
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
