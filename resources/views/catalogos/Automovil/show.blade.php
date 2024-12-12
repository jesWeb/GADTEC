@extends('layouts.app')

@section('body')
    <div class="px-6 py-2">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <div class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Ir a la gestión de vehículos"
                            class="flex items-center text-gray-700 hover:text-gray-900">
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
                        <a href="{{ $backRoute ?? route('catalogos.index') }}" title="Volver a Catálogos"
                            class="text-gray-800 hover:text-gray-800">
                            Catálogos
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <a href="{{ route('Automovil.index') }}" title="Volver a la página de automoviles"
                            class="text-gray-800 hover:text-gray-800">
                            Automóviles
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <p class="text-gray-800 hover:text-gray-800">
                            Ver Detalle de Automóvil
                        </p>
                    </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="container px-4 mx-auto">
            <div class="flex justify-center mt-12">
                <div class="w-full max-w-5xl p-8 bg-white rounded-lg shadow-lg bg-gradient-to-r">

                    <div class="text-center">
                        <h1 class="text-4xl font-extrabold text-gray-800">Detalle del Automóvil</h1>
                        <p class="mt-2 text-lg text-gray-600">Información completa sobre el automóvil seleccionado</p>
                    </div>

                    <!-- Tarjeta de información del automóvil -->
                    <div class="flex p-6 mt-6 bg-white rounded-lg shadow-sm">

                        <!-- Detalles del vehículo -->
                        <div class="w-2/3 ml-6">
                            <p class="text-xl font-bold text-center text-green-600">{{ $automovil->marca }}
                                {{ $automovil->submarca }} {{ $automovil->modelo }}</p>
                            <!-- Carrusel de imágenes -->
                            <div class="w-full">
                                <div class="flex justify-start gap-4 p-4 overflow-x-auto">
                                    @php
                                        $fotografias = json_decode($automovil->fotografias, true);
                                    @endphp

                                    @if ($fotografias)
                                        @foreach ($fotografias as $foto)
<<<<<<< HEAD
                                        <img src="{{ asset('img/automoviles/' . $foto) }}" alt="Imagen del Vehículo" class="w-20 h-auto transition-transform duration-300 transform rounded-lg shadow-md hover:scale-90 hover:shadow-lg">
=======
                                        <img src="{{ url('img/automoviles/' . $foto) }}" alt="Imagen del Vehículo" class="w-20 h-auto transition-transform duration-300 transform rounded-lg shadow-md hover:scale-90 hover:shadow-lg">
                                        <a href="{{ url('img/automoviles/' . $foto) }}" target="_blank" class="text-gray-500" title="Ver foto de automóvil">Ver foto</a> 
>>>>>>> Project
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <!-- Detalles del automóvil usando grid -->
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-3 lg:grid-cols-4">
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Marca:</p>
                                    <p class="text-gray-600">{{ $automovil->marca }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Submarca:</p>
                                    <p class="text-gray-600">{{ $automovil->submarca }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Modelo:</p>
                                    <p class="text-gray-600">{{ $automovil->modelo }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Número de Serie:</p>
                                    <p class="text-gray-600">{{ $automovil->num_serie }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Número de Motor:</p>
                                    <p class="text-gray-600">{{ $automovil->num_motor }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Capacidad de Combustible (Lts):</p>
                                    <p class="text-gray-600">{{ $automovil->capacidad_combustible }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Tipo de Combustible:</p>
                                    <p class="text-gray-600">{{ $automovil->tipo_combustible }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Kilometraje:</p>
                                    <p class="text-gray-600">{{ $automovil->kilometraje }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Color:</p>
                                    <p class="text-gray-600">{{ $automovil->color }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Número de Puertas:</p>
                                    <p class="text-gray-600">{{ $automovil->num_puertas }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Condiciones:</p>
                                    <p class="text-gray-600">{{ $automovil->estatus }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Placas:</p>
                                    <p class="text-gray-600">{{ $automovil->placas }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Fecha de Ingreso:</p>
                                    <p class="text-gray-600">{{ $automovil->fecha_registro }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Tipo de Automóvil:</p>
                                    <p class="text-gray-600">{{ $automovil->tipo_automovil }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Uso:</p>
                                    <p class="text-gray-600">{{ $automovil->uso }}</p>
                                </div>
                                <div class="p-4 bg-white rounded-lg shadow-sm">
                                    <p class="text-lg font-semibold text-gray-800">Responsable:</p>
                                    <p class="text-gray-600">{{ $automovil->responsable }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de regreso -->
                    <div class="flex justify-end mt-6">
                        <a href="{{ route('Automovil.index') }}" title="Volver al listado de automoviles"
                            class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-200 bg-green-500 rounded-md hover:bg-green-600 focus:outline-none">
                            <i class="mr-2 fa-solid fa-arrow-left"></i> Volver
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
