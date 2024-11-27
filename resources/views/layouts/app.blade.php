<!DOCTYPE html>
<html lang="es-Mx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GADTEC') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FilePond JS -->
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    {{--  --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- FilePond CSS -->
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
    <!-- tooltip -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>


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


        @yield('js')

</body>

</html>
