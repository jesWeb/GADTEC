@extends('layouts.app')

@section('body')
    <div class="px-6 py-2">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <ul class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <!-- Flecha de regresar -->
                        <a href="{{ route('Gestion') }}" title="Volver a la página de gestión" class="flex items-center text-gray-600 hover:text-gray-900">
                            <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                            Regresar a Gestión
                        </a>
                    </li>
                    <li class="text-gray-500">/</li>
                    <li class="flex items-center">
                        <p class="text-gray-800 hover:text-gray-800">
                            Historial del automóvil
                        </p>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="p-6 bg-white rounded-md shadow-md">
            <!-- Información del automóvil -->
            <div class="flex justify-between mb-3">
                @foreach ($auto as $aut)
                    <h1 class="text-lg font-semibold text-gray-700 capitalize">
                        {{ $aut->automovil }} - Historial de Asignaciones
                    </h1>
                @endforeach
            </div>

            <!-- Tabla del historial -->
            <section class="mt-5">
                <div class="overflow-x-auto overflow-y-auto rounded-lg shadow">
                    <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-600">Fecha</th>
                                <th class="px-4 py-2 text-left text-gray-600">Solicitante</th>
                                <th class="px-4 py-2 text-left text-gray-600">Chofer</th>
                                <th class="px-4 py-2 text-left text-gray-600">Horario de Salida</th>
                                <th class="px-4 py-2 text-left text-gray-600">Horario de Llegada</th>
                                <th class="px-4 py-2 text-left text-gray-600">Kilometraje</th>
                                <th class="px-4 py-2 text-left text-gray-600">Combustible</th>
                                <th class="px-4 py-2 text-left text-gray-600">Estatus</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($dispo as $key => $salidas)
                               
                                    
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2 border">{{ date('d/m/Y', strtotime($salidas->fecha)) }}</td>
                                            <td class="px-4 py-2 border">{{ $salidas->solicitante}}</td>
                                            <td class="px-4 py-2 border">
                                                @if ($salidas->chofer == 1 )
                                                    {{ $salidas->chofer }}

                                                @else
                                                    <span class="text-gray-600">Sin chofer</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2 border">{{ $salidas->hora_salida }}</td>
                                           
                                                <td class="px-4 py-2 border" title="Hora de llegada">
                                                {{ $salidas->hora_llegada  }}
                                                </td>
                                                <td class="px-4 py-2 border" title="Kilómetros al llegar">{{ $salidas->kilometraje }}</td>
                                                <td class="px-4 py-2 border" title="Nivel de combustible al llegar">{{ ucfirst($salidas->combustible) }}</td>

                                            
                                                
                                           
                                            <td class="px-4 py-2 border">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium
                                                        {{ $salidas->estatus == 'Reservado' ? 'bg-orange-100 text-orange-400' : ($salidas->estatus == 'Ocupado' ? 'bg-red-100 text-red-800' : '') }}">
                                                    {{ $salidas->estatus }}
                                                </span>
                                            </td>
                                        </tr>
         
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection
