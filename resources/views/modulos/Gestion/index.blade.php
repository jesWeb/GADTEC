@extends('layouts.app')
@section('body')

<div class="px-4 py-6">
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg font-semibold text-gray-700 capitalize">Disponibilidad  automóviles </h2>
        {{-- <div class="mb-4 text-right">
            <a href="{{ route('Automovil.create') }}" class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Nuevo registro</a>
        </div> --}}
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
                            <td class="px-4 py-2 border">{{ $disponible->id_automovil}}</td>
                            <td class="px-4 py-2 border">{{ $disponible->estatus }}</td>
                        </tr>
                     @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection

