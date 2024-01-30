<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Account - Pokémon</title>

    {{-- Rutas css/js --}}
    @vite([
        'resources/css/app.scss',// Bootstrap 
        'resources/css/app.css',
        'resources/css/custom.scss',// CSS principal
        'resources/css/custom.css',
        'resources/js/app.js',
    ])

    {{-- Iconos --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-general-img">

    @yield('general')

</body>

</html>