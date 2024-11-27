@extends('layouts.app')

@section('body')
<div class="container px-4 mx-auto">
    <div class="flex justify-center mt-12">
    <div class="w-full max-w-3xl p-8 bg-white rounded-lg shadow-lg bg-gradient-to-r">            
        <!-- Encabezado -->
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-gray-800">Detalle de Tarjeta de Circulación</h1>
                <p class="mt-2 text-lg text-gray-600">Información completa sobre la tarjeta de circulación seleccionada</p>
            </div>

            <!-- Detalles del automóvil -->
            <div class="mt-6 space-y-6">
                <div class="p-6 bg-transparent rounded-lg shadow-sm">
                    <p class="text-xl font-bold text-gray-800">Automóvil</p>
                    <p class="text-xl font-bold text-green-600">{{ $tarjeta->automovil->marca }} {{ $tarjeta->automovil->submarca }}  {{ $tarjeta->automovil->modelo }}</p>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Detalles básicos -->
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Nombre del propietario</p>
                        <p class="text-gray-600">{{ $tarjeta->nombre }}</p>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Número de Tarjeta</p>
                        <p class="text-gray-600">{{ $tarjeta->num_tarjeta }}</p>
                    </div>

                    <!-- Fechas -->
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Fecha de Expedición</p>
                        <p class="text-gray-600">{{ $tarjeta->fecha_expedicion }}</p>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Fecha de Vigencia</p>
                        <p class="text-gray-600">{{ $tarjeta->fecha_vigencia }}</p>
                    </div>

                    <!-- Estatus -->
                    <div class="p-4 bg-white rounded-lg shadow-sm ">
                        <p class="text-lg font-semibold text-gray-800">Estatus</p>
                        <p class="text-gray-600">{{ $tarjeta->estatus }}</p>
                    </div>

                    <!-- Fotografía -->
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Fotografía Frontal</p>
                        <img src="{{ asset('img/' . $tarjeta->fotografia_frontal) }}" alt="Foto frontal" class="object-cover w-16 h-16 mt-4 rounded-lg">
                    </div>
                </div>

                
            </div>

            <!-- Botón de regreso -->
            <div class="flex justify-end mt-8">
                <a href="{{ route('tarjetas.index') }}" 
                   class="inline-flex items-center px-5 py-3 text-sm font-semibold text-white transition duration-200 bg-green-500 rounded-lg shadow bg-gradient-to-r to-green-600 hover:bg-green-600 focus:outline-none"
                   title="Volver al listado de tarjetas">
                    <i class="mr-2 fa-solid fa-arrow-left"></i> Volver
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
