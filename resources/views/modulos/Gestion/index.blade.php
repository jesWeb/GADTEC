
@extends('layouts.app')
@section('body')

    <div class="px-6 py-2">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <ul class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Gestion" class="flex items-center text-gray-700 hover:text-gray-900">
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
                    
                </ul>
            </nav>
        </div>
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">Gestión: Disponibilidad Automóviles </h2>
            {{-- <div class="mb-4 text-right">
                    <a href="{{ route('Automovil.create') }}" class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Nuevo registro</a>
            </div> --}}
            <div class="mt-4 overflow-x-auto rounded-lg shadow overflow-y-autom">
                <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">#</th>
                            <th class="px-4 py-2 text-left text-gray-600">Vehículo</th>
                            <th class="px-4 py-2 text-left text-gray-600">Placas</th>
                            <th class="px-4 py-2 text-left text-gray-600">Estatus</th>
                            <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($disponibilidad as $key => $dispo)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                                <td class="px-4 py-2 border">
                                    {{ $dispo->marca ? $dispo->marca : 'No disponible' }} -
                                    {{ $dispo->submarca ? $dispo->submarca : '' }} -
                                    {{ $dispo->modelo ? $dispo->modelo : '' }}
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ $dispo->placas ? $dispo->placas : 'No disponible' }}</td>
                                    <td class="px-4 py-2 text-center border">
                                    @if ($dispo->estatus)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium
                                            {{ 
                                                $dispo->estatus == 'Reservado' ? 'bg-orange-100 text-orange-800' : 
                                                ($dispo->estatus == 'Ocupado' ? 'bg-red-100 text-red-800' :
                                                ($dispo->estatus == 'Autorizado' ? 'bg-blue-100 text-blue-800' :
                                                ($dispo->estatus == 'Disponible' ? 'bg-green-100 text-green-800' : ''))) 
                                            }}">
                                            {{ $dispo->estatus }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium 
                                            {{ 
                                                $dispo->estatusIn == 'Mantenimiento' ? 'bg-yellow-100 text-yellow-800' :
                                                ($dispo->estatusIn == 'Disponible' ? 'bg-green-100 text-green-800' : 
                                                ($dispo->estatusIn == 'No disponible' ? 'bg-gray-100 text-gray-800' : 
                                                ($dispo->estatusIn == 'En servicio' ? 'bg-pink-100 text-pink-800' : '')))
                                            }}">
                                            {{ $dispo->estatusIn }}
                                        </span>
                                    @endif
                                </td>


                                {{-- acciones --}}
                                <td class="px-4 py-2">
                                    <div class="flex items-center space-x-2 ">
                                        
                                    @if($dispo->estatus == 'Ocupado')
                                    
                                        <a href="{{ route('show.gestion', ['id_asignacion' => $dispo->id_asignacion]) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                                </svg>
                                        </a>
                                    @elseif($dispo->estatus == 'Reservado')
                                        <a href="{{ route('autorizar', $dispo->id_asignacion) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 text-white border border-[#07074D] bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 hover:text-white hover:border-blue-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="w-5 h-5">
                                                <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zM10.293 16.293a1 1 0 0 1-1.414 0l-2.293-2.293a1 1 0 1 1 1.414-1.414L10 14.586l4.586-4.586a1 1 0 1 1 1.414 1.414l-5 5z"/>
                                            </svg>
                                        </a>
                                    @else
                                        <span disable class="text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                             class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                            </svg>
                                        </span>
                                    @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection



