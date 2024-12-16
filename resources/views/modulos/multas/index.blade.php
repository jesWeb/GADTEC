@extends('layouts.app')

@section('body')
<div class="px-6 py-2">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <ul class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Ir a la gestión de vehículos" class="flex items-center text-gray-700 hover:text-gray-900">
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
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Multas -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Multas
                        </p>
                    </li>
                </ul>
            </nav>
        </div>
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="mb-4 text-lg font-semibold text-gray-700 capitalize">Multas</h2>
        <div class="mb-2">
            <form action="{{ route('multas.index') }}" method="GET" class="flex flex-col items-center justify-between space-y-2 md:flex-row md:space-y-0">
                <!-- Campo de búsqueda -->
                <div class="flex items-center w-full md:w-auto">
                    <input type="text" name="search" placeholder="Buscar multa"
                        title="Introduce el tipo de multa, vehículo o lugar para buscar"
                        class="w-full px-4 py-2 text-gray-700 border rounded-l-md focus:outline-none md:w-48"
                        value="{{ request('search') }}">
                    <button type="submit"
                        class="flex items-center px-4 py-2 ml-1 text-white bg-blue-600 border-l-0 rounded-r-md hover:bg-blue-700 focus:outline-none"
                        title="Realizar búsqueda">
                        Buscar
                    </button>
                </div>
            </form>

            <!-- Botones de Imprimir y Nuevo Registro -->
            <div class="flex justify-end ml-2 space-x-2">
                <a href="{{ route('multas-pdf') }}" target="_blank"
                class="px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700" title="Imprimir reporte de multas">Imprimir</a>
                <a href="{{ route('multas.create') }}"
                class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" title="Registrar nueva multa">Nuevo registro</a>
            </div>
        </div>

        <!-- Tabla de multas -->
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-600">#</th>
                        <th class="px-4 py-2 text-left text-gray-600">Vehículo</th>
                        <th class="px-4 py-2 text-left text-gray-600">Tipo de Multa</th>
                        <th class="px-4 py-2 text-left text-gray-600">Monto</th>
                        <th class="px-4 py-2 text-left text-gray-600">Fecha</th>
                        <th class="px-4 py-2 text-left text-gray-600">Lugar</th>
                        <th class="px-4 py-2 text-left text-gray-600">Estatus</th>
                        <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($multas as $key => $multa)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                            <td class="px-4 py-2 border">
                                {{ $multa->automovil }} 
                            </td>
                            <td class="px-4 py-2 border">{{ $multa->tipo_multa }}</td>
                            <td class="px-4 py-2 border">$ {{ $multa->monto }}</td>
                            <td class="px-4 py-2 border">
                                {{\Carbon\Carbon::parse( $multa->fecha_multa )->locale('es')->format('d-m-Y') }}
                                </td>
                            <td class="px-4 py-2 border">{{ $multa->lugar }}</td>
                            <td class="px-4 py-2 border">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium
                                {{ $multa->estatus == 'Pagada' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $multa->estatus }}
                                </span>
                            </td>

                            <td class="px-4 py-2 border">
                                <div class="flex items-center space-x-2">
                                    <!-- Ver -->
                                    <a href="multas/{{$multa->id_multa}}" class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white" title="Ver detalles de la multa">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                        </svg>
                                    </a>

                                    <!-- Editar -->
                                    <a href="multas/{{$multa->id_multa}}/edit" class="inline-flex items-center justify-center w-8 h-8 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-600 hover:text-white" title="Editar información de la multa">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3l5 5-1.5 1.5-5-5M3 21h18M3 21l8-8 5 5-8 8H3z" />
                                        </svg>
                                    </a>

                                    <!-- Eliminar -->
                                    <form action="multas/{{ $multa->id_multa }}" method="POST"  id="eliminacion-form" class="inline">
                                        @csrf
                                            @method('DELETE')
                                        <button type="submit" onclick="deleteRegister(event)"
                                        class="inline-flex items-center justify-center w-8 h-8 text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white" title="Borrar esta multa">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7H5M10 11v6m4-6v6M7 7h10l-1-1H8l-1 1z" />
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


@section('js')
    {{-- alert creacion --}}
    @if ($mensaje = Session::get('mensaje'))
        <script>
            Swal.fire({
                title: "Multa Registrada",
                text: "{{ $mensaje }}",
                icon: "success"
            });
        </script>
    @endif
    {{-- alerta de editar --}}
    @if ($updateMessaje = Session::get('message'))
        <script>
            Swal.fire({
                title: "Información Actualizada",
                text: "{{ $updateMessaje }}",
                icon: "success"
            });
        </script>
    @endif

    {{-- alerta de eliminacion --}}
    @if (session('eliminar') == 'se ha eliminado correctamente El automovil')
        <script>
            Swal.fire({
                title: "Eliminado!",
                text: "Eliminado correctamente.",
                icon: "success"
            });
        </script>
    @endif
    <script>
        function deleteRegister() {
            event.preventDefault();
            const btndelete = document.getElementById("eliminacion-form")
            Swal.fire({
                title: "¿Estás seguro de eliminar este registro?",
                text: "¡Este cambio no se puede deshacer!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: "Eliminar"
            }).then((result) => {
                if (result.isConfirmed) {
                    btndelete.submit();
                }
            })
        }
    </script>
@endsection
