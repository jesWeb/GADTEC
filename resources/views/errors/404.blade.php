<!DOCTYPE html>
<html lang="es-Mx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="flex items-center w-screen h-screen ">
        <div class="container flex flex-col items-center justify-center px-5 text-gray-700 sm:flex sm:flex-col sm:items-center md:flex-row">
            <div class="max-w-md">
                <div class="text-5xl font-bold text-blue-600 font-dark">404</div>
                <p class="text-2xl font-light leading-normal md:text-3xl">Lo sentimos, no pudimos encontrar esta página.
                </p>
                <br>
                <p class="mb-8">Pero no te preocupes, puedes encontrar muchas otras cosas en nuestra página de inicio.
                </p>

                <a href="{{ route('Gestion') }}"
                    class="inline px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg shadow focus:outline-none focus:shadow-outline-blue active:bg-blue-600 hover:bg-blue-700">ir
                    a Homepage</a>
            </div>
            <div class="max-w-lg ml-10">
                <img src="{{ asset('img/404.svg') }}" alt="" class="object-contain w-full m-8 h-50">
            </div>

        </div>
    </div>

</body>

</html>



