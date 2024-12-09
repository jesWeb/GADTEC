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
                        <p href="{{ route('vigilante.index') }}" class="text-gray-800 hover:text-gray-800">
                            Vigilante
                        </p>
                    </li>
                    
                </ul>
            </nav>
        </div>
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg font-semibold text-gray-700 capitalize">Bitácora de Vigilante - Control Vehicular</h2>

        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600">Vehículo</th>
                        <th class="px-4 py-2 text-left text-gray-600">Usuario</th>
                        <th class="px-4 py-2 text-left text-gray-600">Fecha de Asignación</th>
                        <th class="px-4 py-2 text-left text-gray-600">Fecha Estimada de Devolución</th>
                        <th class="px-4 py-2 text-left text-gray-600">Destino</th>
                        <th class="px-4 py-2 text-left text-gray-600">Motivo</th>
                        <th class="px-4 py-2 text-left text-gray-600">KM Salida</th>
                        <th class="px-4 py-2 text-left text-gray-600">Combustible Salida</th>
                        <th class="px-4 py-2 text-left text-gray-600">Hora Salida</th>
                        <th class="px-4 py-2 text-left text-gray-600">Fecha de Llegada</th>
                        <th class="px-4 py-2 text-left text-gray-600">KM Llegada</th>
                        <th class="px-4 py-2 text-left text-gray-600">Combustible Llegada</th>
                        <th class="px-4 py-2 text-left text-gray-600">Hora Llegada</th>
                        <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($vigilante as $asignacion)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border" title="Automóvil asignado: {{ $asignacion->automovil->marca ?? 'N/A' }} {{ $asignacion->automovil->modelo ?? '' }}">{{ $asignacion->automovil->marca ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border" title="Usuario asignado: {{ $asignacion->usuarios->nombre ?? 'N/A' }}">{{ $asignacion->usuarios->nombre ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border" title="Fecha de asignación">{{ $asignacion->fecha_asignacion ? date('d/m/Y', strtotime($asignacion->fecha_asignacion)) : 'N/A' }}</td>
                            <td class="px-4 py-2 border" title="Fecha estimada de devolución">
                                <span class="text-red-600">
                                    {{ $asignacion->fecha_estimada_dev ? date('d/m/Y', strtotime($asignacion->fecha_estimada_dev)) : 'N/A' }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border" title="Destino del servicio">{{ $asignacion->lugar ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border" title="Motivo del servicio">{{ $asignacion->motivo ?? 'N/A' }}</td>

                            @if($asignacion->checkIns->isNotEmpty())
                                <td class="px-4 py-2 border" title="Kilómetros al salir">{{ $asignacion->checkIns->first()->km_salida ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border" title="Nivel de combustible al salir">{{ $asignacion->checkIns->first()->combustible_salida ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border" title="Hora de salida">
                                    {{ $asignacion->checkIns->first()->hora_salida ? date('H:i', strtotime($asignacion->checkIns->first()->hora_salida)) : 'N/A' }}
                                </td>                               
                            @else
                                <td class="px-4 py-2 border" colspan="3">No hay datos de check-in</td>
                            @endif

                            <!-- Muestra la fecha de llegada automática si hay un check-in registrado -->
                            <td class="px-4 py-2 border" title="Fecha de llegada">
                                @if($asignacion->checkIns->isNotEmpty() && $asignacion->checkIns->first()->fecha_llegada)
                                    {{ $asignacion->checkIns->first()->fecha_llegada->format('d/m/Y') }}
                                @else
                                    <!-- Mensaje indicando que la fecha está pendiente de ingreso -->
                                    <p class="text-sm font-semibold text-red-600">Fecha pendiente de ingreso</p>
                                @endif
                            </td>

                            @if($asignacion->checkIns->isNotEmpty())
                                <td class="px-4 py-2 border" title="Kilómetros al llegar">{{ $asignacion->checkIns->first()->km_llegada ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border" title="Nivel de combustible al llegar">{{ $asignacion->checkIns->first()->combustible_llegada ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border" title="Hora de llegada">
                                    {{ $asignacion->checkIns->first()->hora_llegada ? date('H:i', strtotime($asignacion->checkIns->first()->hora_llegada)) : 'N/A' }}
                                </td>
                            @else
                                <td class="px-4 py-2 border" colspan="3">No hay datos de check-in</td>
                            @endif

                            <!-- Botones de acciones -->
                            <td class="px-4 py-2 text-center border">
                            
                            
                                @if(isset($asignacion->checkIns->first()->km_salida))
                                    @if($asignacion->checkIns->first()->km_llegada)
                                     <!-- Ver -->
                                     @if(auth()->user()->hasRole('Administrador'))
                                            <a href="{{ route('vigilante.admin', $asignacion->id_asignacion) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white" 
                                                title="Ver detalles de la verificación">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                                </svg>
                                            </a>
                                        @elseif(auth()->user()->hasRole('Moderador'))
                                            <a href="{{ route('vigilante.show', $asignacion->id_asignacion) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white" 
                                                title="Ver detalles de la verificación">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                                </svg>
                                            </a>
                                            @endif
                                    @else

                                    @if(auth()->user()->hasRole('Administrador'))
                                        <a href="{{ route('admin.edit2', $asignacion->id_asignacion) }}" 
                                        class="inline-flex items-center justify-center w-8 h-8 text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white"
                                        title="Editar información de llegada del automóvil">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l-7 7 7 7M22 12H2" />
                                        </svg>


                                        </a>
                                    @elseif(auth()->user()->hasRole('Moderador'))
                                        <a href="{{ route('moderador.edit2', $asignacion->id_asignacion) }}" 
                                        class="inline-flex items-center justify-center w-8 h-8 text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white"
                                        title="Editar información de llegada del automóvil">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l-7 7 7 7M22 12H2" />
                                            </svg>


                                        </a>
                                    @endif

                                    @endif
                                @else 
                                
                                @if(auth()->user()->hasRole('Administrador'))
                                    <a href="{{ route('vigilante.edit', $asignacion->id_asignacion) }}" class="inline-flex items-center justify-center w-8 h-8 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-600 hover:text-white" 
                                        title="Editar información de salida">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3l5 5-1.5 1.5-5-5M3 21h18M3 21l8-8 5 5-8 8H3z" />
                                        </svg>
                                    </a>
                                    @elseif(auth()->user()->hasRole('Moderador'))
                                    <a href="{{ route('moderador.edit', $asignacion->id_asignacion) }}" class="inline-flex items-center justify-center w-8 h-8 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-600 hover:text-white" 
                                        title="Editar información de salida">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3l5 5-1.5 1.5-5-5M3 21h18M3 21l8-8 5 5-8 8H3z" />
                                        </svg>
                                    </a>
                                    @endif
                                @endif
                            </td>
                       
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
