<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SJAM GAMA FARM')</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('scripts')
</head>

<body class="bg-white h-screen flex flex-col overflow-hidden">

    <!-- Konten Halaman -->
    <div class="flex-grow overflow-hidden">
        @yield('content')
    </div>
</body>

</html>
