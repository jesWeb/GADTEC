<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GADTEC') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-gray-200 " x-data="{ sidebarOpen: false }">

        @include('layouts.sidebar')

        <div class="flex flex-col flex-1 overflow-hidden">
            @include('layouts.header')
            {{-- Section content  --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 ">
                <div class="container px-6 py-8 mx-auto">
                    @yield('body')
                </div>
            </main>
        </div>
</body>

</html>
