@extends('layouts.app')

@section('body')
<div class="container px-4 mx-auto">
    <div class="flex justify-center mt-8">
        <div class="w-full max-w-3xl p-8 bg-white shadow-lg rounded-xl">
            <h1 class="pb-4 mb-6 text-4xl font-bold text-gray-800 border-b">Detalles de la Multa</h1>
            
            <ol class="flex mb-6 space-x-2 text-sm text-gray-500">
                <li class="breadcrumb-item">Inicio</li>
                <li>/</li>
                <li class="breadcrumb-item">Detalle Multa</li>
            </ol>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div class="mb-4">
                    <p class="text-xl font-medium text-gray-800">Vehículo:</p>
                    <p class="text-2xl font-semibold text-green-600">{{ $multa->automovil->modelo }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-xl font-medium text-gray-800">Fecha de pago:</p>
                    <p class="text-lg text-gray-600">{{ $multa->tipo_multa }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-xl font-medium text-gray-800">Monto:</p>
                    <p class="text-lg text-gray-600">$ {{ $multa->monto }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-xl font-medium text-gray-800">Fecha de multa:</p>
                    <p class="text-lg text-gray-600">{{ $multa->fecha_multa }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-xl font-medium text-gray-800">Lugar:</p>
                    <p class="text-lg text-gray-600">{{ $multa->lugar }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-xl font-medium text-gray-800">Estatus:</p>
                    <p class="text-lg text-gray-600">{{ $multa->estatus }}</p>
                </div>
            </div>

            <div class="mb-6">
                <p class="text-xl font-medium text-gray-800">Comprobante:</p>
                <img src="{{ asset('img/' . $multa->comprobante) }}" alt="Comprobante de multa" class="w-full h-auto rounded-md shadow-sm">
            </div>

            <div class="mb-6">
                <p class="text-xl font-medium text-gray-800">Observaciones:</p>
                <p class="text-lg text-gray-600">{{ $multa->observaciones }}</p>
            </div>

            <div class="flex justify-end">
                <a href="../multas" class="px-6 py-3 text-lg font-semibold text-white transition-all duration-200 bg-green-500 rounded-lg hover:bg-green-600 focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Volver a multas
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
