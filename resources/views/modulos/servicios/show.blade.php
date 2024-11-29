@extends('layouts.app')

@section('body')
<div class="container px-4 mx-auto">
    <div class="flex justify-center mt-8">
        <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-lg">
            <h1 class="mb-4 text-3xl font-semibold text-gray-800">Servicios</h1>
            <ol class="flex mb-4 space-x-2 text-gray-500">
                <li class="breadcrumb-item">Detalle de Servicio</li>
            </ol>

            <div class="mb-6">
                <p class="text-lg font-semibold text-gray-800">Automovil:</p>
                <p class="text-xl font-bold text-green-600">
                    {{ $servicio->automovil->submarca . " - " . $servicio->automovil->modelo }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Tipo de Servicio</p>
                <p class="text-gray-600">{{ $servicio->tipo_servicio }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Descripción</p>
                <p class="text-gray-600">{{ $servicio->descripcion }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Fecha de Servicio</p>
                <p class="text-gray-600">
                    {{\Carbon\Carbon::parse(  $servicio->fecha_servicio
 )->locale('es')->format('d-m-Y') }}
                </p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Fecha de Proximo Servicio</p>
                <p class="text-gray-600">{{ $servicio->prox_servicio }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Lugar de Servicio</p>
                <p class="text-gray-600">{{ $servicio->lugar_servicio}}</p>
            </div>



            <div class="flex justify-end mt-6">
                <a class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-200 bg-green-500 rounded-md hover:bg-green-600 focus:outline-none"
                    href="../servicios">
                    <i class="mr-2 fa-solid fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
