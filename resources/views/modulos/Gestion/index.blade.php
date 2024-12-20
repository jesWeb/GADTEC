
@extends('layouts.app')
@section('body')
    <div class="px-4 py-6">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">Disponibilidad automóviles </h2>
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
                                    @if ($dispo->asignacion)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium
                                            {{ $dispo->asignacion->estatus == 'Reservado' ? 'bg-orange-100 text-orange-800' : 'bg-green-100 text-green-800' }}">

                                            {{ $dispo->asignacion->estatus }}
                                        </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        Disponible
                                    </span>
                                    @endif
                                </td>

                                {{-- acciones --}}
                                <td class="px-4 py-2">
                                    <div class="flex items-center space-x-2 ">

                                        @if ($dispo->asignacion)
                                            <a href="{{ route('gestion', $dispo->asignacion->id_asignacion) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                                </svg>
                                            </a>
                                        @else
                                            <span disable class="text-gray-400"><svg xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                                </svg></span>
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
