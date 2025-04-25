<div class="w-1/6 bg-white flex flex-col justify-between border-r border-gray-300 py-6">

    <!-- Profil -->
    <div class="flex flex-col items-center">
        <a href="{{ route('mitra.DataAkun') }}" class="block">
            <div class="h-16 w-16 rounded-full overflow-hidden mb-2 hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/profile-user.png') }}" alt="Profil" class="object-cover h-full w-full">
            </div>
        </a>

        <p class="text-sm font-semibold">Admin</p>

        {{-- Link ke Edit Akun --}}
        <a href="{{ route('mitra.DataAkun') }}" class="text-base mt-2 hover:underline">Akun</a>

        <hr class="my-4 w-4/5 border-gray-400" />
    </div>

    <!-- Logout -->
    <form action="{{ route('mitra.logout') }}" method="POST" class="text-center">
        @csrf
        <button type="submit" class="text-red-600 text-sm hover:underline cursor-pointer">logout</button>
    </form>

</div>
