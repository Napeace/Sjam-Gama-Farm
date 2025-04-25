@extends('mitra.components.layouts')

@section('title', 'Login Mitra - SJAM GAMA FARM')

@section('content')
<div class="flex h-[calc(100vh-48px)] w-full">

    <!-- Kiri: Form -->
    <div class="w-1/2 flex items-center justify-center px-16 bg-white z-10">
        <div class="w-full max-w-md">
            <h2 class="text-2xl font-semibold mb-8 text-gray-800">Selamat datang, Admin</h2>

            @if ($errors->has('login_error'))
                <div class="mb-4 text-red-600 font-semibold">
                    {{ $errors->first('login_error') }}
                </div>
            @endif

            <form action="/LoginMitra" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block mb-1 text-sm text-gray-700">Username :</label>
                    <input type="text" name="username" required autocomplete="off"
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-green-500 focus:outline-none">
                </div>

                <div>
                    <label class="block mb-1 text-sm text-gray-700">Password :</label>
                    <div class="relative">
                        <input id="password-input" type="password" name="password" required
                            class="w-full border border-gray-300 rounded px-3 py-2 pr-10 focus:ring-green-500 focus:outline-none">

                        <!-- Ikon mata dengan wrapper flex agar benar-benar center -->
                        <div id="toggle-password"
                            class="absolute right-3 top-0 bottom-0 flex items-center cursor-pointer group">

                            <!-- Mata tertutup (default) -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-400 group-hover:hidden" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M2.808 1.393L1.393 2.808l3.132 3.132C3.132 7.295 1.8 9.148 1 12c1.273 4.091 5.522 7 11 7 1.694 0 3.29-.32 4.722-.894l3.47 3.47 1.415-1.415L2.808 1.393zM12 17c-4.03 0-7.126-2.406-8.288-5 .56-1.29 1.522-2.409 2.722-3.254l1.537 1.537a4 4 0 005.303 5.303l1.537 1.537C13.706 16.68 12.823 17 12 17zm0-10c4.03 0 7.126 2.406 8.288 5-.512 1.18-1.353 2.226-2.428 3.048l1.447 1.447C21.213 14.718 23 13.002 23 12c-1.273-4.091-5.522-7-11-7a10.946 10.946 0 00-3.934.734l1.581 1.581C10.344 6.11 11.159 6 12 6z" />
                            </svg>

                            <!-- Mata terbuka (hover) -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-gray-400 hidden group-hover:block" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path d="M10 3C5 3 1.73 7.11 1 10c.73 2.89 4 7 9 7s8.27-4.11 9-7c-.73-2.89-4-7-9-7zM10 15c-2.76 0-5-2.24-5-5s2.24-5
                                5-5 5 2.24 5 5-2.24 5-5 5z" />
                                <path d="M10 7a3 3 0 100 6 3 3 0 000-6z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 transition text-white px-4 py-2 rounded cursor-pointer">
                    Masuk
                </button>
            </form>
        </div>
    </div>

    <!-- Kanan: Gambar -->
    <div class="w-1/2 bg-cover bg-center relative" style="background-image: url('{{ asset('images/LoginMitra.png') }}')">
        <div class="absolute inset-0 flex flex-col items-center justify-center text-white">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-60 h-60 mb-4 rounded-4xl">
        </div>
        <p class="text-sm font-normal absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white">
            SJAM GAMA FARM ©2025
        </p>
    </div>

</div>

<script>
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password-input');

    togglePassword.addEventListener('mouseenter', () => {
        passwordInput.type = 'text';
    });

    togglePassword.addEventListener('mouseleave', () => {
        passwordInput.type = 'password';
    });
</script>

@endsection
