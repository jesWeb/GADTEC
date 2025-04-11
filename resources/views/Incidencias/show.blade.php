@extends('layouts.app')

@section('body')
    <div class="px-6 py-2">
          <!-- Mapa de sitio -->
          <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <ul class="flex items-center space-x-4">
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
                            Gestion
                        </a>
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Incidencias  -->
                    <li class="flex items-center">
                        <p href="{{ route('incidencias.index') }}" class="text-gray-800 hover:text-gray-800">
                            Incidencias
                        </p>
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Crear Incidencia  -->
                    <li class="flex items-center">
                        <p class="text-gray-800 hover:text-gray-800">
                            Detalle de Incidencia
                        </p>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-6 text-2xl font-semibold text-gray-700 border-b pb-2 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405M15 17l-1.405-1.405M15 17V3m0 14H9m0 0H4m5 0l1.405 1.405M9 17l1.405 1.405" />
                </svg>
                Detalles de la Incidencia
            </h2>

            <div class="mb-6 flex justify-end">
                <div class="text-right">
                    <p class="text-sm text-gray-500 uppercase">Fecha y Hora de Registro</p>
                    <p class="text-sm text-gray-800 font-medium">
                        {{ $incidencia->created_at->format('d/m/Y h:i A') }}
                    </p>
                </div>
            </div>
            
            <div class="mb-6">
                <p class="text-sm text-gray-500 uppercase">Descripción de la Incidencia</p>
                <div class="p-4 mt-2 bg-gray-50 border border-gray-200 rounded-md text-gray-700 leading-relaxed">
                    {!! nl2br(e($incidencia->descripcion)) !!}
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-4">
                <a href="{{ route('incidencias.index') }}"
                    class="inline-flex items-center px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 transition">

                    Volver al historial
                </a>
            </div>

        </div>
    </div>
@endsection
