@extends('layouts.app')

@section('body')

<!-- Simbología de fecha de devolucion -->
<div class="p-4 my-4 border border-gray-300 rounded-lg shadow-sm bg-gray-50">
    <p class="mb-2 text-lg font-semibold text-gray-700">Simbología de Fecha Estimada de Devolución</p>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <!-- Color Rojo representa la fecha estimada del usuario -->
        <div class="flex items-center">
            <span class="mr-2 text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l2 7h7l-5 4 2 7-6-5-6 5 2-7-5-4h7z" />
                </svg>
            </span>
            <span class="font-semibold text-red-600">Fecha Estimada por el Usuario</span>
        </div>

        <!-- Fecha color negra representa la fecha estimada por el sistema -->
        <div class="flex items-center">
            <span class="mr-2 text-black">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12h-6m6 0l-2.25-2.25m2.25 2.25l-2.25 2.25M12 19h-6m6 0l-2.25-2.25m2.25 2.25l-2.25 2.25" />
                </svg>
            </span>
            <span class="font-semibold text-black">Fecha Estimada por el Sistema (5 días de devolución)</span>
        </div>
        
    </div>
</div>

<div class="px-4 py-6">
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg font-semibold text-gray-700 capitalize">Bitácora de Vigilante Control Vehicular</h2>



        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600">Vehículo</th>
                        <th class="px-4 py-2 text-left text-gray-600">Usuario</th>
                        <th class="px-4 py-2 text-left text-gray-600">Fecha de Asignación</th>
                        <th class="px-4 py-2 text-left text-gray-600">Fecha Estimada de Devolución</th>
                        <th class="px-4 py-2 text-left text-gray-600">Fecha de Llegada</th>
                        <th class="px-4 py-2 text-left text-gray-600">Destino</th>
                        <th class="px-4 py-2 text-left text-gray-600">Motivo</th>
                        <th class="px-4 py-2 text-left text-gray-600">KM Salida</th>
                        <th class="px-4 py-2 text-left text-gray-600">Combustible Salida</th>
                        <th class="px-4 py-2 text-left text-gray-600">Hora Salida</th>
                        <th class="px-4 py-2 text-left text-gray-600">KM Llegada</th>
                        <th class="px-4 py-2 text-left text-gray-600">Combustible Llegada</th>
                        <th class="px-4 py-2 text-left text-gray-600">Hora Llegada</th>
                        <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($vigilante as $asignacion)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $asignacion->automovil->marca ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $asignacion->usuarios->nombre ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">
                                {{ $asignacion->fecha_asignacion ? date('d/m/Y', strtotime($asignacion->fecha_asignacion)) : 'N/A' }}
                            </td>
                            <td class="px-4 py-2 border">
                                <span class="text-red-600">
                                    {{ $asignacion->fecha_estimada_dev ? date('d/m/Y', strtotime($asignacion->fecha_estimada_dev)) : 'N/A' }}

                                </span>
                                <hr>
                                    {{ $asignacion->fecha_estimada_dev ? date('d/m/Y', strtotime('+5 days', strtotime($asignacion->fecha_estimada_dev))) : 'N/A' }}
                                </td>

                            
                            <!-- Muestra la fecha de llegada automática si hay un check-in registrado -->
                            <td class="px-4 py-2 border">
                                @if($asignacion->checkIns->isNotEmpty() && $asignacion->checkIns->first()->fecha_llegada)
                                    {{ $asignacion->checkIns->first()->fecha_llegada->format('d/m/Y') }}
                                @else
                                    <!-- Mensaje indicando que la fecha está pendiente de ingreso -->
                                    <p class="text-sm font-semibold text-red-600">Fecha pendiente de ingreso</p>
                                @endif
                            </td>


                            <td class="px-4 py-2 border">{{ $asignacion->lugar ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $asignacion->motivo ?? 'N/A' }}</td>

                            @if($asignacion->checkIns->isNotEmpty())
                                <td class="px-4 py-2 border">{{ $asignacion->checkIns->first()->km_salida ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border">{{ $asignacion->checkIns->first()->combustible_salida ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border">
                                    {{ $asignacion->checkIns->first()->hora_salida ? date('H:i', strtotime($asignacion->checkIns->first()->hora_salida)) : 'N/A' }}
                                </td>                                
                                <td class="px-4 py-2 border">{{ $asignacion->checkIns->first()->km_llegada ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border">{{ $asignacion->checkIns->first()->combustible_llegada ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border">
                                    {{ $asignacion->checkIns->first()->hora_llegada ? date('H:i', strtotime($asignacion->checkIns->first()->hora_llegada)) : 'N/A' }}
                                </td>
                            @else
                                <td class="px-4 py-2 border" colspan="6">No hay datos de check-in</td>
                            @endif

                            <td class="px-4 py-2 text-center border">
                                @if(isset($asignacion->checkIns->first()->km_salida))
                                <a href="{{ route('edit2', $asignacion->id_asignacion) }}" class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3l5 5-1.5 1.5-5-5M3 21h18M3 21l8-8 5 5-8 8H3z" />
                                    </svg>
                                </a>
                                @else  

                                <a href="{{ route('vigilante.edit', $asignacion->id_asignacion) }}" class="inline-flex items-center justify-center w-8 h-8 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-600 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3l5 5-1.5 1.5-5-5M3 21h18M3 21l8-8 5 5-8 8H3z" />
                                    </svg>
                                </a>
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
