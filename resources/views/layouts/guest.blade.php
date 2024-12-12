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
    {{-- css --}}
    <link rel="stylesheet" href="">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans antialiased text-gray-900">

    <div class="flex items-center justify-center min-h-screen bg-transparent sm:pt-0">
        <div class="relative z-10 w-full px-6 py-4 mt-6 sm:max-w-md">
            {{ $slot }}
        </div>
    </div>

</body>
</html>
