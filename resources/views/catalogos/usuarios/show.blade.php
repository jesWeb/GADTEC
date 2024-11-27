@extends('layouts.app')

@section('body')
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
                <div class="flex-shrink-0">
                    <img src="{{ asset('img/' . $usuario->foto) }}" alt="Foto de Usuario" class="object-cover w-20 h-20 border-4 border-indigo-500 rounded-full shadow-lg">
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
@endsection
