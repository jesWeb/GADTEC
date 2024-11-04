@extends('layouts.app') 

@section('body')

<div class="px-4 py-6">
<div class="p-6 bg-white rounded-md shadow-md">
<h2 class="mb-4 text-lg font-semibold text-gray-700 capitalize">Servicios</h2>
    <div class="mb-2">
        <form action="{{ route('servicios.index') }}" method="GET" class="flex flex-col items-center justify-between space-y-2 md:flex-row md:space-y-0">
            <!-- Campo de búsqueda -->
                <div class="flex items-center w-full md:w-auto">
                    <input type="text" name="search" placeholder="Buscar Servicio" 
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
            <a href="{{route("servicios-pdf")}}" target="_blank" teal class="inline-block px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700">Imprimir</a>
            <a href="servicios/create" class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Nuevo registro</a>
        </div>
        
    </div>
    <div class="overflow-x-auto rounded-lg shadow">
        <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600">#</th>
                    <th class="px-4 py-2 text-left text-gray-600">Vehiculo</th>
                    <th class="px-4 py-2 text-left text-gray-600">Tipo de Servicio</th>
                    <th class="px-4 py-2 text-left text-gray-600">Descripcion</th>
                    <th class="px-4 py-2 text-left text-gray-600">Fecha</th>
                    <th class="px-4 py-2 text-left text-gray-600">Proximo Servicio</th>
                    <th class="px-4 py-2 text-left text-gray-600">Costo</th>
                    <th class="px-4 py-2 text-left text-gray-600">Lugar de Servicio</th>
                    <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($servicios as $key => $servicio)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                        <td class="px-4 py-2 border">
                            {{ $servicio->automovil->marca }} {{ $servicio->automovil->submarca }} {{ $servicio->automovil->modelo }} 
                        </td> 
                        <td class="px-4 py-2 border">{{ $servicio ->tipo_servicio }}</td>
                        <td class="px-4 py-2 border">{{ $servicio ->descripcion }}</td>
                        <td class="px-4 py-2 text-center border">
                            @if($servicio->fecha_servicio == '')
                                <!-- Muestra un guión o un texto vacío si el servicio no es programado -->
                                -
                            @else
                                {{ $servicio->fecha_servicio }}
                            @endif
                        </td>
 
                        <td class="px-4 py-2 text-center border">
                            @if($servicio->prox_servicio == '')
                                <!-- Muestra un guión o un texto vacío si el servicio no es programado -->
                                -
                            @else
                                {{ $servicio->prox_servicio }}
                            @endif
                        </>
                        <td class="px-4 py-2 border">{{ $servicio ->costo}}</td>
                        <td class="px-4 py-2 border">{{ $servicio -> lugar_servicio}}</td>
                        <td class="px-4 py-2 border">
                            <div class="flex items-center space-x-2">
                                <!-- Ver -->
                                <a href="servicios/{{ $servicio->id_servicio }}" class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                    </svg>
                                </a>

                                <!-- Eliminar -->
                                <form action="servicios/{{ $servicio->id_servicio }}" method="POST" class="inline">
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