@extends('layouts.app')

@section('body')
<div class="px-4 py-6">
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg font-semibold text-gray-700 capitalize">Disponibilidad Automóviles</h2>

        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600">#</th>
                        <th class="px-4 py-2 text-left text-gray-600">Vehículo</th>
                        <th class="px-4 py-2 text-left text-gray-600">Estatus</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($disponibilidad as $key => $disponible)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                            <td class="px-4 py-2 border">{{ $disponible->automovil->marca }} {{ $disponible->automovil->modelo }}</td>
                            <td class="px-4 py-2 border">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium 
                                {{ 
                                    $disponible->estatus == 'Disponible' ? 'bg-green-100 text-green-800' : 
                                    ($disponible->estatus == 'Reservado' ? 'bg-yellow-600 text-yellow-600' : 
                                    'bg-red-100 text-red-800') 
                                }}">
                                {{ $disponible->estatus }}
                            </span>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
