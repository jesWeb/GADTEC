@extends('layouts.app')
@section('body')
<div class="px-6 py-2">
    <!-- Mapa de sitio -->
    <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <div class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Ir a la gestión de vehículos" class="flex items-center text-gray-700 hover:text-gray-900">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                            Gestión
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Catálogos -->
                    <li class="flex items-center">
                        <a href="{{ $backRoute ?? route('catalogos.index') }}" title="Volver a Catálogos" class="text-gray-800 hover:text-gray-800">
                            Catálogos
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Seguros -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Siniestros
                        </p>
                    </li>
                </ul>
            </nav>
    </div>
        <div class="p-6 bg-white rounded-md shadow-md">
            {{-- espacio de titulo y arrow back --}}
            <div class="flex justify-between mb-3">
                <h2 class="mb-4 text-xl font-semibold text-gray-700 capitalize">Siniestros</h2>
            </div>
            <!-- Botones de Imprimir y Nuevo Registro -->
            <div class="mb-3">
                <div class="flex items-center justify-between mb-2 space-y-2 md:flex-row md:space-y-0">
                    {{-- busqueda --}}
                    <div>
                        <form action="{{ route('siniestros.index') }}" method="GET"
                            class="flex flex-col items-center justify-between space-y-2 md:flex-row md:space-y-0">
                            <!-- Campo de búsqueda -->
                            <div class="flex items-center w-full md:w-auto">
                                <input type="text" name="search" placeholder="Buscar Siniestro"
                                    class="w-full px-4 py-2 text-gray-700 border rounded-l-md focus:outline-none md:w-48"
                                    value="{{ request('search') }}" title="Buscar por siniestro">
                                <button type="submit"
                                    class="flex items-center px-4 py-2 ml-1 text-white bg-blue-600 border-l-0 rounded-r-md hover:bg-blue-700 focus:outline-none" 
                                    title="Realizar búsqueda">
                                    Buscar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Btn Nuevo Registro -->
                <div class="flex justify-end ml-2 space-x-3">
                    <a href="{{ route('siniestros.create') }}"
                        class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" title="Crear un nuevo registro de siniestro">Nuevo registro</a>
                </div>
            </div>
            {{-- tables data --}}
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">#</th>
                            <th class="px-4 py-2 text-left text-gray-600">Vehículo</th>
                            <th class="px-4 py-2 text-left text-gray-600">Fecha Siniestro</th>
                            <th class="px-4 py-2 text-left text-gray-600">Responsable</th>
                            <th class="px-4 py-2 text-left text-gray-600">Estatus</th>
                            <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($siniestros as $key => $sin)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                                <td class="px-4 py-2 border" title="Detalles del vehículo">
                                    {{ $sin->automovil->marca }} {{ $sin->automovil->submarca }}
                                    {{ $sin->automovil->modelo }}
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ \Carbon\Carbon::parse($sin->fecha_siniestro )->locale('es')->format('d-m-Y') }}
                                    </td>
                                <td class="px-4 py-2 border">{{ $sin->usuarios->nombre }} {{ $sin->usuarios->app }}
                                    {{ $sin->usuarios->apm }}</td>
                                <td class="px-4 py-2 border" title="Estatus del siniestro">{{ $sin->estatus }}</td>
                                {{-- acciones --}}
                                <td class="px-4 py-2 border">
                                    <div class="flex items-center space-x-2">
                                        <!-- Ver -->
                                        <a href="{{ route('siniestros.show', $sin->id_siniestro) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white" title="Ver siniestro">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                            </svg>
                                        </a>

                                        <!-- Editar -->
                                        <a href="{{ route('siniestros.edit', $sin->id_siniestro) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-600 hover:text-white" title="Editar siniestro">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 3l5 5-1.5 1.5-5-5M3 21h18M3 21l8-8 5 5-8 8H3z" />
                                            </svg>
                                        </a>

                                        <!-- Eliminar -->
                                        <form action="{{ route('siniestros.destroy', $sin) }}" method="POST"
                                            id="{{ $sin->id_siniestro }}" name="del_{{ $sin->id_siniestro }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="del_{{ $sin->id_siniestro }}" onclick="deleteRegister(event, '{{ $sin->id_siniestro }}')"
                                                class="inline-flex items-center justify-center w-8 h-8 text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white" title="Eliminar siniestro">
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
            <!-- Navegación de paginación -->
            {{-- {{ $cars->links() }} --}}
        </div>
    </div>
@endsection


@section('js')
    {{-- alert creacion --}}
    @if ($mensaje = Session::get('mensaje'))
        <script>
            Swal.fire({
                title: "Siniestro Registrado",
                text: "{{ $mensaje }}",
                icon: "success"
            });
        </script>
    @endif
    {{-- alerta de editar --}}
    @if ($updateMessaje = Session::get('message'))
        <script>
            Swal.fire({
                title: "Informacion  Actualizada",
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
                text: "eliminar",
                icon: "success"
            });
        </script>
    @endif
    <script>
        function deleteRegister(event, formId) {
            event.preventDefault();
            const btndelete = document.getElementById(formId);
            Swal.fire({
                title: "Estas seguro de Eliminar el registro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, borrar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    btndelete.submit();
                    Swal.fire({
                        title: "¡Eliminado!",
                        text: "El siniestro ha sido eliminado correctamente.",
                        icon: "success"
                    });
                }
            });
        }
    </script>
@endsection
