@extends('layouts.app')

@section('body')
<div class="container px-4 mx-auto">
    <div class="flex justify-center mt-8">
        <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-lg">
            <h1 class="mb-4 text-3xl font-semibold text-gray-800">Usuario</h1>
            <ol class="flex mb-4 space-x-2 text-gray-500">
                <li class="breadcrumb-item">Detalle Usuario</li>
            </ol>

            <div class="mb-6">
                <p class="text-lg font-semibold text-gray-800">N° Empleado:</p>
                <p class="text-xl font-bold text-green-600">{{ $usuario->num_empleado }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Nombre Completo:</p>
                <p class="text-gray-600">{{ $usuario->nombre }} {{ $usuario->app }} {{ $usuario->apm }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">E-Mail:</p>
                <p class="text-gray-600">{{ $usuario->email }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Sexo:</p>
                <p class="text-gray-600">{{ $usuario->gen }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Fecha de Nacimiento:</p>
                <p class="text-gray-600">{{ \Carbon\Carbon::parse($usuario->fn)->format('d/m/Y') }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Estatus:</p>
                <p class="text-gray-600">{{ $usuario->estatus }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Rol Asignado:</p>
                <p class="text-gray-600">{{ $usuario->roles->nombre }}</p>
            </div>

            <div class="flex justify-end mt-6">
                <a class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-200 bg-green-500 rounded-md hover:bg-green-600 focus:outline-none" href="{{ url('usuarios') }}">
                    <i class="mr-2 fa-solid fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
