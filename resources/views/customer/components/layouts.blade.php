<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SJAM GAMA FARM')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="vapid-public-key" content="{{ config('webpush.vapid.public_key') }}">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
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
