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
                            Seguros
                        </p>
                    </li>
                </ul>
            </nav>
    </div>

    <div class="px-4 py-6">
        <div class="p-6 bg-white rounded-md shadow-md">
            <div class="flex justify-between mb-2 ">
                <h2 class="text-lg font-semibold text-gray-700 capitalize">Seguros vehiculares</h2>
            </div>

            <div class="mb-2">
                <form action="{{ route('seguros.index') }}" method="GET" class="flex flex-col items-center justify-between space-y-2 md:flex-row md:space-y-0">
                    <!-- Campo de búsqueda -->
                    <div class="flex items-center w-full md:w-auto">
                        <input type="text" name="search" placeholder="Buscar Seguro" title="Buscar seguro"
                        class="w-full px-4 py-2 text-gray-700 border rounded-l-md focus:outline-none md:w-48" value="{{ request('search') }}">
                        <button type="submit" class="flex items-center px-4 py-2 ml-1 text-white bg-blue-600 border-l-0 rounded-r-md hover:bg-blue-700 focus:outline-none" title="Realizar búsqueda">
                            Buscar
                        </button>
                    </div>
                </form>
                <!-- Botones de Imprimir y Nuevo Registro -->
                <div class="flex justify-end ml-2 space-x-2">
                    <a href="{{ route('seguros.create') }}" class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" title="Nuevo registro de seguro">Nuevo registro</a>
                </div>
            </div>

            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">#</th>
                            <th class="px-4 py-2 text-left text-gray-600">Automóvil</th>
                            <th class="px-4 py-2 text-left text-gray-600">Aseguradora</th>
                            <th class="px-4 py-2 text-left text-gray-600">Fecha Vigencia</th>
                            <th class="px-4 py-2 text-left text-gray-600">Estatus</th>
                            <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($seguro as $key => $seg)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                                <td class="px-4 py-2 border">{{ $seg->automovil->marca }} {{ $seg->automovil->submarca }} {{ $seg->automovil->modelo }}</td>
                                <td class="px-4 py-2 border">{{ $seg->aseguradora }}</td>
                                <td class="px-4 py-2 border">{{ $seg->fecha_vigencia }}</td>
                                <td class="px-4 py-2 border">{{ $seg->estatus }}</td>

                                {{-- acciones --}}
                                <td class="px-4 py-2 border">
                                    <div class="flex items-center space-x-2">
                                        <!-- Ver -->
                                        <a href="{{ route('seguros.show', $seg->id_seguro) }}" class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white" title="Ver seguro">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                            </svg>
                                        </a>

                                        <!-- Editar -->
                                        <a href="{{ route('seguros.edit', $seg->id_seguro) }}" class="inline-flex items-center justify-center w-8 h-8 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-600 hover:text-white" title="Editar seguro">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3l5 5-1.5 1.5-5-5M3 21h18M3 21l8-8 5 5-8 8H3z" />
                                            </svg>
                                        </a>

                                        <!-- Eliminar -->
                                        <form action="{{ route('seguros.destroy', $seg) }}" method="POST" id="eliminacion-form" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="deleteRegister(event)" class="inline-flex items-center justify-center w-8 h-8 text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white" title="Borrar seguro">
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
            <!-- Navegación de paginación -->
            {{-- {{ $cars->links() }} --}}
        </div>
    </div>
</div>
@endsection

@section('js')
    {{-- alerta agregar --}}
    @if ($mensaje = Session::get('mensaje'))
        <script>
            swal.fire({
                title: 'Seguro Registrado',
                text: '{{ $mensaje }}',
                icon: 'success'
            })
        </script>
    @endif
    {{-- alerta de editar --}}
    @if ($updateMessaje = Session::get('mensajeAct'))
        <script>
            Swal.fire({
                title: "Información Actualizada",
                text: "{{ $updateMessaje }}",
                icon: "success"
            });
        </script>
    @endif
    {{-- alerta de eliminación --}}

    @if (session('mensajeDel') == 'Se ha eliminado correctamente')
        <script>
            Swal.fire({
                title: "Registro Eliminado!",
                text: "{{ session('mensajeDel') }}",
                icon: "success"
            });
        </script>
    @endif

    <script>
        function deleteRegister() {
            event.preventDefault();
            const btndelete = document.getElementById("eliminacion-form");
            Swal.fire({
                title: "¿Estás seguro de eliminar el registro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, borrar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    btndelete.submit();
                }
            });
        }
    </script>
@endsection
