@extends('layouts.app')

@section('body')
<<div class="px-6 py-2">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mb-4">
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
                        <a href="{{ route('asignacion.index') }}" title="Volver a la página de solicitudes"  class="text-gray-800 hover:text-gray-800">
                            Solicitudes de Autómovil
                        </a>
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Solicitudes  -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Ver Solicitud de Autómovil
                        </p>
                    </li>
                </ul>
            </nav>
        </div>
    <div class="container mx-auto">
        <div class="flex justify-center mt-8">
            <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-xl">
                <!-- Encabezado -->
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-800">Detalle de Solicitud de Automóvil</h1>
                    <p class="mt-2 text-lg text-gray-600">Información completa sobre la solicitud seleccionada</p>
                </div>
            {{-- content --}}
            <article class="flex flex-wrap max-w-3xl mx-auto md:flex-nowrap group">
                {{-- content info --}}
                <div class="mt-6 ml-4 space-y-6">
                    <div class="grid grid-cols-2 gap-6 md:grid-cols-3">
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800">Solicitante:</h4>
                            <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->usuarios->nombre}}
                                {{ $asignacionV->usuarios->app}} {{ $asignacionV->usuarios->apm}}</span>
                        </div>
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800">Automovil: </h4>
                            <span class="mt-2 text-base leading-relaxed text-gray-500 ">
                                {{ $asignacionV->automovil->marca }} {{ $asignacionV->automovil->submarca }}
                                {{ $asignacionV->automovil->modelo }}</span>
                        </div>
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800">Fecha de salida:</h4>
                            <span
                                class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->fecha_salida }}</span>
                        </div>
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800">Hora de salida:</h4>
                            <span
                                class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->hora_salida }}</span>
                        </div>
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800">Lugar de Destino:</h4>
                            <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{$asignacionV->lugar }}</span>
                        </div>
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800">Motivo:</h4>
                            <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->motivo }}</span>
                        </div>
                    

                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800">Nombre del chofer:</h4>
                            <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->nombre_chofer}}</span>
                        </div>
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800">No.Licencia:</h4>
                            <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->no_licencia}}</span>
                        </div>
                
                    
                    <div class="p-4 bg-white rounded-lg shadow-sm">
                        <h4 class="text-lg font-semibold text-gray-800">Requerimientos (adicionales):</h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->requierechofer }}</span>
                    </div>
                </div>
            </div>
        </article>
            {{-- btn --}}
            <div class="flex justify-end mt-6 space-x-4">
                <a href="{{ route('asignacion.index') }}" title="Volver al listado de solicitudes"
                class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-200 bg-green-600 rounded-md hover:bg-green-700 focus:outline-none">Cerrar</a>
            </div>
        </section>
    </div>
</div>

@endsection
