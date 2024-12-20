@extends('layouts.app')

@section('body')
<div class="px-6 py-2">
    <!-- Mapa de sitio -->
    <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <div class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Ir a la gestión de vehículos" class="flex items-center text-gray-700 hover:text-gray-900">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                            Gestión
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Catálogos -->
                    <li class="flex items-center">
                        <a href="{{ $backRoute ?? route('catalogos.index') }}" title="Volver a Catálogos" class="text-gray-800 hover:text-gray-800">
                            Catálogos
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <a href="{{route('usuarios.index')}}" title="Volver a la página de usuarios" class="text-gray-800 hover:text-gray-800">
                            Usuarios
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Ver Detalle de Usuario
                        </p>
                    </li>
                </ul>
            </nav>
    </div>
    <div class="container px-4 mx-auto">
        <div class="flex justify-center mt-8">
            <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-xl">
                <!-- Contenedor para el título y la imagen del usuario -->
                <div class="flex items-center justify-between mb-6">
                    <!-- Encabezado -->
                    <div class="text-start">
                        <h1 class="text-4xl font-extrabold text-gray-800">Detalle de Usuario</h1>
                        <p class="mt-2 text-lg text-gray-600">Información completa sobre el usuario seleccionado</p>
                    </div>

                    <!-- Imagen de Usuario a la derecha -->
                    <div class="grid gap-5">
                        <img src="{{ url('img/usuarios/' . $usuario->foto) }}" alt="Foto de Usuario" class="w-16 h-16 object-cover border-4 border-indigo-500 cursor-pointer rounded-full
                            shadow-md hover:scale-90 hover:shadow-lg ">
                    </div>
                    
                    <div id="modal"
                        class="hidden  fixed top-0 left-0 z-80 
                        w-screen h-screen bg-black/70 flex
                        justify-center items-center">
                        <!-- Boton de cerrar -->
                        <a class="fixed z-90 top-6 right-8 
                        text-white text-5xl font-bold" 
                        href="javascript:void(0)"
                        onclick="closeModal()">
                            ×
                        </a>

                        <!-- Medida de imagen -->
                        <img id="modal-img"
                            class="max-w-[900px] max-h-[700px] object-cover"/>
                    </div>
                </div>

                <!-- Información del Usuario en dos columnas -->
                <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2">
                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Nombre Completo:</p>
                        <p class="text-gray-600">{{ $usuario->nombre }} {{ $usuario->app }} {{ $usuario->apm }}</p>
                    </div>
                    
                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">N° Empleado:</p>
                        <p class="text-xl font-bold text-green-600">{{ $usuario->num_empleado }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">E-Mail:</p>
                        <p class="text-gray-600">{{ $usuario->email }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Sexo:</p>
                        <p class="text-gray-600">{{ $usuario->gen }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Fecha de Nacimiento:</p>
                        <p class="text-gray-600">{{ (new DateTime($usuario->fn))->format('d/m/Y') }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Estatus:</p>
                        <p class="text-gray-600">{{ $usuario->estatus }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Rol Asignado:</p>
                        <p class="text-gray-600">{{ $usuario->rol }}</p>
                    </div>
                </div>

                <!-- Botón Volver -->
                <div class="flex justify-end mt-6">
                    <a class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-200 bg-green-500 rounded-md shadow-md hover:bg-green-600 focus:outline-none hover:shadow-lg" href="{{ url('usuarios') }}" title="Volver a la lista de usuarios">
                        <i class="mr-2 fa-solid fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
                
    // obtener todos los elementos de la img
        var images = document.querySelectorAll('.grid img');

    // recorre cada elemento de la img
        images.forEach(function (img) {
                    
            // agregar cada evento de elementos en cada clic en la img
            img.addEventListener('click', function () {
                showModal(img.src);
            });
        });

        // obtener el id del modal
        var modal = document.getElementById("modal");

        // obtener la etiqueta de la img
        var modalImg = document.getElementById("modal-img");

        // Cuando se hace clic en la img
        function showModal(src) {
            modal.classList.remove('hidden');
            modalImg.src = src;
        }

        // Esta funcion es para cerrar
            function closeModal() {
                modal.classList.add('hidden');
        }
</script>
@endsection