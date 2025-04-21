@extends('layouts.mitra')

@section('title', 'Edit Akun - SJAM GAMA FARM')

@section('content')
<div class="h-full flex flex-col items-center justify-center p-4">
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
                <label for="username_baru" class="block mb-2">Username :</label>
                <input type="text" id="username_baru" name="username_baru" value="{{ $user->username }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="alamat" class="block mb-2">Alamat :</label>
                <input type="text" id="alamat" name="alamat" value="{{ $user->alamat }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="no_hp" class="block mb-2">No. HP :</label>
                <input type="tel" id="no_hp" name="no_hp" value="{{ $user->no_hp }}"
                pattern="[0-9]*"
                inputmode="numeric"
                class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="email" class="block mb-2">Email :</label>
                <input type="email" id="email" name="email" autocomplete="off" value="{{ $user->email }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 cursor-pointer">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('no_hp').addEventListener('input', function (e) {
        // Remove non-numeric characters
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
@endsection
