@extends('layouts.app')
@section('body')

<div class="px-6 py-2">
    <!-- Mapa de sitio -->
    <div class="flex justify-end mt-2 mb-4">
        <nav class="text-sm text-gray-600">
            <ul class="flex items-center space-x-4">
                <li class="flex items-center">
                    <a href="{{ route('Gestion') }}" title="Gestion" class="flex items-center text-gray-700 hover:text-gray-900">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                        Gestión
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="p-6 bg-white rounded-md shadow-md">
        @if(session('success'))
            <div class="py-4 text-center bg-indigo-900 lg:px-4">
                <div class="flex items-center p-2 leading-none text-indigo-100 bg-indigo-800 lg:rounded-full lg:inline-flex" role="alert">
                    <span class="flex px-2 py-1 mr-3 text-xs font-bold uppercase bg-indigo-500 rounded-full">New</span>
                    <span class="flex-auto mr-2 font-semibold text-left">{{ session('success') }}</span>
                    <svg class="w-4 h-4 opacity-75 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/>
                    </svg>
                </div>
            </div>
        @endif

        <h2 class="text-lg font-semibold text-gray-700 capitalize">Gestión: Disponibilidad Automóviles </h2>
        <div class="mt-4 overflow-x-auto rounded-lg shadow overflow-y-autom">
            <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600">#</th>
                        <th class="px-4 py-2 text-left text-gray-600">Vehículo</th>
                        <th class="px-4 py-2 text-left text-gray-600">Placas</th>
                        <th class="px-4 py-2 text-left text-gray-600">Estatus</th>
                        @if(auth()->user()->hasRole('Administrador'))
                            <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                        @endif
                        <th class="px-4 py-2 text-left text-gray-600">Reservas Hoy</th> 
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
                                {{ $dispo->placas ? $dispo->placas : 'No disponible' }}
                            </td>
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
                            @if(auth()->user()->hasRole('Administrador'))
                            <td class="px-4 py-2">
                                <div class="flex items-center space-x-2 ">
                                    <!-- Show -->
                                    @if($dispo->estatus == 'Ocupado')
                                        <a href="{{ route('show.admin', ['id_automovil' => $dispo->id_automovil]) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                            </svg>
                                        </a>
                                    @elseif($dispo->estatus == 'Reservado')
                        
                                        @if ($dispo->num_reservas > 0)
                                            <form action="{{ route('autorizar_reserva', ['id' => $dispo->id_automovil]) }}" method="POST">
                                                @csrf
                                                <select name="hora_salida" class="text-gray-700 bg-white border border-gray-300 rounded-md form-select">
                                                    @foreach ($dispo->asignaciones as $asignacion)
                                                        @if ($asignacion->estatus == 'Reservado' && $asignacion->fecha_salida == date('Y-m-d'))
                                                            <option value="{{ $asignacion->id_asignacion }}">
                                                                {{ date('d-m-Y', strtotime($asignacion->fecha_salida)) }} - {{ $asignacion->hora_salida }} | {{ $asignacion->nombre }} {{ $asignacion->app }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>


                                                <button type="submit" class="px-3 py-1 ml-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700">
                                                    Autorizar
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-500">Sin reservas hoy</span>
                                        @endif


                                    @else
                                        <span class="text-gray-400">
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
                            @endif
                            <td class="px-4 py-2 border">
                                @if ($dispo->num_reservas > 1)
                                    <span class="font-semibold text-red-600">{{ $dispo->num_reservas }} reservas hoy</span>
                                @elseif ($dispo->num_reservas == 1)
                                    1 reserva hoy
                                @else
                                    Sin reservas hoy
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
