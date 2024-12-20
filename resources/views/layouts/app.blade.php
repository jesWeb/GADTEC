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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-gray-200" x-data="{ sidebarOpen: false }">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        <div class="flex flex-col flex-1 overflow-hidden">
            {{-- Header --}}
            @include('layouts.header')

            {{-- Section content --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    @yield('body')
                </div>
            </main>
        </div>

        {{-- JS Scripts --}}
        @yield('js')
        @yield('scripts')
    </div>
</body>


</html>
