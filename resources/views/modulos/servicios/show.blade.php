@extends('layouts.app')

@section('body')
<div class="px-6 py-2">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <ul class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Ir a la gestión de vehículos" class="flex items-center text-gray-700 hover:text-gray-900">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                            Gestion
                        </a>
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Solicitudes  -->
                    <li class="flex items-center">
                        <a href="{{ route('servicios.index') }}" title="Volver a la página de servicios"  class="text-gray-800 hover:text-gray-800">
                            Servicios
                        </a>
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Servicios -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Ver Detalle Servicio
                        </p>
                    </li>
                </ul>
            </nav>
        </div>
    <div class="container px-4 mx-auto">
        <div class="flex justify-center mt-8">
            <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-xl">
                <!-- Encabezado -->
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-800">Detalle de Servicio</h1>
                    <p class="mt-2 text-lg text-gray-600">Información completa sobre el servicio seleccionado</p>
                </div>
                <!-- Información de multas en dos columnas -->
                <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2">
                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Automovil:</p>
                        <p class="text-xl font-bold text-green-600">{{$servicio->automovil->marca . "  " . $servicio->automovil->submarca . "  " . $servicio->automovil->modelo }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Tipo de Servicio</p>
                        <p class="text-gray-600">{{ $servicio->tipo_servicio }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Descripción</p>
                        <p class="text-gray-600">{{ $servicio->descripcion }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Fecha de Servicio</p>
                        <p class="text-gray-600">{{ $servicio->fecha_servicio }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Fecha de Proximo Servicio</p>
                        <p class="text-gray-600">{{ $servicio->prox_servicio }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Lugar de Servicio</p>
                        <p class="text-gray-600">{{ $servicio->lugar_servicio}}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-medium text-gray-800">Comprobante:</p>
                        <img src="{{ asset('img/' . $servicio->comprobante) }}" alt="Comprobante de servicio" class="w-full h-auto rounded-md shadow-sm">
                    </div>
                </div>
                

                <div class="flex justify-end mt-6">
                    <a class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-200 bg-green-500 rounded-md hover:bg-green-600 focus:outline-none" href="../servicios"
                        title="Volver a la lista de servicios">
                        Cerrar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
