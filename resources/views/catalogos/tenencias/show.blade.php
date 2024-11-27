@extends('layouts.app')

@section('body')
<div class="container px-4 mx-auto">
    <div class="flex justify-center mt-12">
        <div class="w-full max-w-3xl p-8 bg-white rounded-lg shadow-lg bg-gradient-to-r">            
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-gray-800">Detalle de Tenencia/Refrendo</h1>
                <p class="mt-2 text-lg text-gray-600">Información completa sobre la tenencia o refrendo seleccionado</p>
            </div>
            
            <!-- Detalles del automóvil -->
            <div class="mt-6 space-y-6">
                <div class="p-6 bg-transparent rounded-lg shadow-sm">
                    <p class="text-lg font-semibold text-gray-800">Vehiculo</p>
                    <p class="text-xl font-bold text-green-600">{{ $tenencia->automovil->modelo }}</p>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Detalles básicos -->
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Fecha de pago:</p>
                        <p class="text-gray-600">{{ $tenencia->fecha_pago }}</p>
                    </div>

                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Origen:</p>
                        <p class="text-gray-600">{{ $tenencia->origen }}</p>
                    </div>

                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Monto:</p>
                        <p class="text-gray-600">$ {{ $tenencia->monto }}</p>
                    </div>

                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Año Correspondiente:</p>
                        <p class="text-gray-600">{{ $tenencia->año_correspondiente }}</p>
                    </div>
            
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Estatus:</p>
                        <p class="text-gray-600">{{ $tenencia->estatus }}</p>
                    </div>

       
            
        
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Comprobante:</p>
                        <img src="{{ asset('img/' . $tenencia->comprobante) }}" alt="Comprobante" class="object-cover w-16 h-16">
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <a class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-200 bg-green-500 rounded-md hover:bg-green-600 focus:outline-none" href="../tenencias">
                    <i class="mr-2 fa-solid fa-arrow-left"></i> Volver
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
