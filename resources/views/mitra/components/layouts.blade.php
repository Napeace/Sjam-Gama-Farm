<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SJAM GAMA FARM')</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tiny.cloud/1/skn71ykaszy2j8ba1bvueseg84bemllqwe5je48my7zayil0/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body class="bg-white h-screen flex flex-col overflow-hidden">
    <!-- Header -->
    <div class="bg-green-900 text-white px-6 py-3 flex items-center gap-2 shrink-0">
        <img src="/images/logo.png" alt="Logo" class="h-6 w-6">
        <div>
            <p class="font-semibold">SJAM GAMA FARM</p>
            <p class="text-xs">Website for Admin</p>
        </div>
    </div>

    <!-- Konten Halaman -->
    <div class="flex-grow overflow-hidden">
        @yield('content')
    </div>
</body>

</html>
