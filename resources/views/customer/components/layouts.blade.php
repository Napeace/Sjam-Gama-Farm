<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SJAM GAMA FARM')</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
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
