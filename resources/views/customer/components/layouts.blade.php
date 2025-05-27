<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SJAM GAMA FARM')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <!-- Use a specific version of Alpine.js from CDN for more reliability -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    <!-- Load app.js after Alpine is loaded -->
    @vite('resources/js/app.js')
    <style>
        ::-webkit-scrollbar {
            display: none;
        }

        html {
            scrollbar-width: none;
        }

        body {
            overflow-y: auto;
            -ms-overflow-style: none; /* Hide scrollbar for IE and Edge */
        }
    </style>
</head>

<body>
    @yield('content')
</body>
</html>
