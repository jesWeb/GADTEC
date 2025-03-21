@extends('layouts.app')

@section('body')
<div class="px-6 py-4 min-h-screen">
    <!-- Mapa de sitio -->
    <div class="flex justify-end mt-2 mb-6">
        <nav class="text-sm text-gray-600">
            <ul class="flex items-center space-x-4">
                <li>
                    <a href="{{ route('user.dashboard') }}" class="flex items-center text-gray-700 hover:text-gray-900">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <g id="iconCarrier">
                              <rect x="6" y="3" width="12" height="18" rx="2" stroke="currentColor"></rect>
                              <path d="M9 7H15" stroke="currentColor"></path>
                              <path d="M9 11H15" stroke="currentColor"></path>
                              <path d="M9 15H13" stroke="currentColor"></path>
                              <circle cx="17" cy="17" r="3" stroke="currentColor"></circle>
                              <path d="M17 20V21" stroke="currentColor"></path>
                              <path d="M17 14V15" stroke="currentColor"></path>
                            </g>
                          </svg>
                        Mis solicitudes
                    </a>
                </li>
                <p class="text-gray-500">/</p>
                <li>
                    <span class="text-gray-800 font-semibold">Ver Detalle de Solicitud</span>
                </li>
            </ul>
        </nav>
    </div>

    <div class="container mx-auto px-4">
        <div class="flex justify-center mt-10">
            <div class="w-full max-w-3xl p-8 bg-white rounded-xl shadow-lg border border-gray-200">
                <div class="text-center">
                    <h1 class="text-2xl font-extrabold text-gray-800">Detalle de Solicitud</h1>
                    <p class="mt-2 text-lg text-gray-600">Información completa sobre la solicitud</p>
                </div>

                <div class="p-6 mt-6 bg-gray-50 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Datos de la solicitud -->
                        <div>
                            <h2 class="text-xl font-semibold mb-2 border-b pb-2">Datos de la Solicitud</h2>
                            <p><strong>Fecha de Registro:</strong> {{ $asignacion->fecha_asignacion ?? 'No registrada' }}</p>
                            <p><strong>Fecha de Salida:</strong> {{ $asignacion->fecha_salida ?? 'No registrada' }}</p>
                            <p><strong>Motivo:</strong> {{ $asignacion->motivo ?? 'No especificado' }}</p>
                            <p><strong>Lugar:</strong> {{ $asignacion->lugar ?? 'No registrado' }}</p>
                            <p><strong>Especificaciones:</strong> {{ $asignacion->observaciones ?? 'No registradas' }}</p>
                            <p><strong>Conductor:</strong> {{ $asignacion->nombre_chofer ?? 'No registrado' }}</p>
                            <p><strong>No. de Licencia:</strong> {{ $asignacion->no_licencia ?? 'No registrada' }}</p>
                            <p><strong>Estatus:</strong> <span class="font-semibold text-blue-600">{{ $asignacion->estatus ?? 'No especificado' }}</span></p>
                        </div>

                        <!-- Datos del automóvil -->
                        <div>
                            <h2 class="text-xl font-semibold mb-2 border-b pb-2">Datos del Automóvil</h2>
                            <p><strong>Marca:</strong> {{ $asignacion->automovil->marca ?? 'No asignado' }}</p>
                            <p><strong>Submarca:</strong> {{ $asignacion->automovil->submarca ?? 'No asignado' }}</p>
                            <p><strong>Modelo:</strong> {{ $asignacion->automovil->modelo ?? 'No registrado' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Detalles de entrada/salida -->
                <div class="mt-6 p-6 bg-gray-50 rounded-lg">
                    <h2 class="text-xl font-semibold mb-2 border-b pb-2">Detalles de Entrada/Salida</h2>
                    <p><strong>Hora de Salida:</strong> {{ $asignacion->checkIn->hora_salida ?? 'No registrada' }}</p>
                    <p><strong>Fecha de Salida:</strong> {{ $asignacion->fecha_salida ?? 'No registrada' }}</p>
                    <p><strong>Hora de Entrada:</strong> {{ $asignacion->checkIn->hora_llegada ?? 'No registrada' }}</p>
                    <p><strong>Fecha de Entrada:</strong> {{ $asignacion->checkIn->fecha_llegada ?? 'No registrada' }}</p>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('user.dashboard') }}" class="px-6 py-2 text-white transition duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:outline-none">
                        Cerrar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
