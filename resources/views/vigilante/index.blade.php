@extends('layouts.app')

@section('body')
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
                            <td class="px-4 py-2 border">{{ $asignacion->fecha_asignacion ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $asignacion->fecha_estimada_dev ?? 'N/A' }}</td>
                            
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
                                <td class="px-4 py-2 border">{{ $asignacion->checkIns->first()->hora_salida ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border">{{ $asignacion->checkIns->first()->km_llegada ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border">{{ $asignacion->checkIns->first()->combustible_llegada ?? 'N/A' }}</td>
                                <td class="px-4 py-2 border">{{ $asignacion->checkIns->first()->hora_llegada ?? 'N/A' }}</td>
                            @else
                                <td class="px-4 py-2 border" colspan="6">No hay datos de check-in</td>
                            @endif

                            <td>
                                <a href="{{ route('vigilante.edit', $asignacion->id_asignacion) }}" class="inline-flex items-center justify-center w-8 h-8 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-600 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3l5 5-1.5 1.5-5-5M3 21h18M3 21l8-8 5 5-8 8H3z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
