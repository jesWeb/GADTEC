<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GADTEC') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Evitar que la pantalla se mueva */
        body, html {
            overflow: hidden;
            height: 100%;
            margin: 0;
        }

        /* Fondo de la pantalla */
        .bg-transparent {
            position: relative;
            background-image: url('{{ asset('img/fondo.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100%;
        }

        /* Capa negra con opacidad encima de la imagen */
        .bg-transparent::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.2); /* Capa negra con opacidad */
            z-index: 0; 
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900">

    <div class="flex items-center justify-center min-h-screen bg-transparent sm:pt-0">
        <div class="relative z-10 w-full px-6 py-4 mt-6 sm:max-w-md">
            {{ $slot }}
        </div>
    </div>

</body>
</html>
