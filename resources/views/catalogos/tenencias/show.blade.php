@extends('layouts.app')

@section('body')
<div class="container px-4 mx-auto">
    <div class="flex justify-center mt-8">
        <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-lg">
            <h1 class="mb-4 text-3xl font-semibold text-gray-800">Rol</h1>
            <ol class="flex mb-4 space-x-2 text-gray-500">
                <li class="breadcrumb-item">Detalle Tenecias/Refrendo</li>
            </ol>

            <div class="mb-6">
                <p class="text-lg font-semibold text-gray-800">Vehiculo</p>
                <p class="text-xl font-bold text-green-600">{{ $tenencia->automovil->modelo }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Fecha de pago:</p>
                <p class="text-gray-600">{{ $tenencia->fecha_pago }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Origen:</p>
                <p class="text-gray-600">{{ $tenencia->origen }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Monto:</p>
                <p class="text-gray-600">{{ $tenencia->monto }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Año Correspondiente:</p>
                <p class="text-gray-600">{{ $tenencia->año_correspondiente }}</p>
            </div>
            
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Estatus:</p>
                <p class="text-gray-600">{{ $tenencia->estatus }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Fecha de vencimiento:</p>
                <p class="text-gray-600">{{ $tenencia-> fecha_vencimiento }}</p>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Fecha de vencimiento:</p>
                <img src="{{ asset('img/' . $tenencia->comprobante) }}" alt="Foto de usuario" class="object-cover w-100 h-100">
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
