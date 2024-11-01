@extends('layouts.app') 

@section('body')

<div class="px-4 py-6">
<div class="p-6 bg-white rounded-md shadow-md">
<h2 class="mb-4 text-lg font-semibold text-gray-700 capitalize">Tenencias/Refrendos</h2>
<div class="mb-2">
            <form action="{{ route('tenencias.index') }}" method="GET" class="flex flex-col items-center justify-between space-y-2 md:flex-row md:space-y-0">
                <!-- Campo de búsqueda -->
                <div class="flex items-center w-full md:w-auto">
                    <input type="text" name="search" placeholder="Buscar Tenencia" 
                        class="w-full px-4 py-2 text-gray-700 border rounded-l-md focus:outline-none md:w-48" 
                        value="{{ request('search') }}">
                    <button type="submit" 
                        class="flex items-center px-4 py-2 ml-1 text-white bg-blue-600 border-l-0 rounded-r-md hover:bg-blue-700 focus:outline-none">
                        Buscar
                    </button>
                   
                </div>
            </form>
            <!-- Botones de Imprimir y Nuevo Registro -->
            <div class="flex justify-end ml-2 space-x-2">
                <a href="{{ route('tenencias.create') }}" class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Nuevo registro</a>
            </div>
        </div>

    <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600">#</th>
                    <th class="px-4 py-2 text-left text-gray-600">Vehiculo</th>
                    <th class="px-4 py-2 text-left text-gray-600">Fecha de Pago</th>
                    <th class="px-4 py-2 text-left text-gray-600">Origen</th>
                    <th class="px-4 py-2 text-left text-gray-600">Monto</th>
                    <th class="px-4 py-2 text-left text-gray-600">Año Correspondiente</th>
                    <th class="px-4 py-2 text-left text-gray-600">Estatus</th>
                    <th class="px-4 py-2 text-left text-gray-600">Fecha Vencimiento</th>
                    <th class="px-4 py-2 text-left text-gray-600">Comprobante</th>
                    <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($tenencias as $key => $tenencia)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                        <td class="px-4 py-2 border">
                            {{ $tenencia->automovil->submarca }} {{ $tenencia->automovil->modelo }} 
                        </td>                         
                        <td class="px-4 py-2 border">{{ $tenencia->fecha_pago }}</td>
                        <td class="px-4 py-2 border">{{ $tenencia->origen }}</td>
                        <td class="px-4 py-2 border">{{ $tenencia->monto }}</td>
                        <td class="px-4 py-2 border">{{ $tenencia->año_correspondiente}}</td>
                        <td class="px-4 py-2 border">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium 
                            {{ $tenencia->estatus == 'Activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $tenencia->estatus }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border">{{ $tenencia->fecha_vencimiento }}</td>
                        <td class="px-4 py-2 border">
                        <img src="{{ asset('img/' . $tenencia->comprobante) }}" alt="Foto de usuario" class="object-cover w-16 h-16">
                        </td>
                       
                        
                        <td class="px-4 py-2 border">
                            <div class="flex items-center space-x-2">
                                <!-- Ver -->
                                <a href="tenencias/{{ $tenencia->id_tenencia}}" class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                    </svg>
                                </a>

                                <!-- Editar -->
                                <a href="tenencias/{{ $tenencia->id_tenencia}}/edit" class="inline-flex items-center justify-center w-8 h-8 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-600 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3l5 5-1.5 1.5-5-5M3 21h18M3 21l8-8 5 5-8 8H3z" />
                                    </svg>
                                </a>

                                <!-- Eliminar -->
                                <form action="tenencias/{{ $tenencia->id_tenencia }}" method="POST" class="inline">
                                   {!! csrf_field() !!}
                                   @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-8 h-8 text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white" onclick="return confirm('Seguro que desea borrar el registro?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7H5M10 11v6m4-6v6M7 7h10l-1-1H8l-1 1z" />
                                        </svg>

                                    </button>
                                </form>
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