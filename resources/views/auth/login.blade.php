<x-guest-layout>
    <!-- Redirección basada en rol -->
    @if (session('session_rol') == 'Administrador')
    <script>
        window.location.href = "{{ route('admin.dashboard') }}";

    </script>
    @elseif (session('session_rol') == 'Moderador')
    <script>
        window.location.href = "{{ route('moderator.dashboard') }}";

    </script>
    @elseif (session('session_rol') == 'Usuario')
    <script>
        window.location.href = "{{ route('user.dashboard') }}";

    </script>
    @endif

    <style>
        /* Evitar que la pantalla se mueva */
        body {
            overflow: hidden;
            margin: 0;
        }

        /* Fondo de la pantalla */
        .bg-transparent {
            position: relative;
            background-image: url(img/fondo.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Capa negra con opacidad encima de la imagen */
        .bg-transparent::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.2);
            z-index: 0;
        }

    </style>

    <div class="">

        <div class="flex items-center justify-center min-h-screen bg-center bg-cover">
            <!-- Contenedor del formulario -->
            <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg bg-opacity-90">
                <div class="flex flex-col items-center mb-6">
                    <!-- Logo con texto Gadtec -->
                    <div class="flex items-center space-x-2">
                        <svg class="w-12 h-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                                fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path
                                d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                                fill="white" />
                        </svg>
                        <span class="text-2xl font-semibold text-blue-800">GADTEC</span>
                    </div>
                    <h2 class="text-2xl font-semibold text-gray-800">Inicia sesión</h2>
                </div>

                <!-- Formulario -->
                <form action="{{ url('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="usuario" class="block text-sm font-medium text-gray-800">Usuario</label>
                        <input type="text" name="usuario" id="usuario" required autofocus
                            class="block w-full px-4 py-2 mt-1 text-gray-800 placeholder-gray-400 bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="pass" class="block text-sm font-medium text-gray-800">Contraseña</label>
                        <input type="password" name="pass" id="pass" required
                            class="block w-full px-4 py-2 mt-1 text-gray-800 placeholder-gray-800 bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>



                    <button type="submit"
                        class="w-full py-2 mt-4 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Iniciar Sesión
                    </button>
                </form>
            </div>
        </div>

    </div>
</x-guest-layout>
