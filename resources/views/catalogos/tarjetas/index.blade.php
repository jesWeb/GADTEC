@extends('layouts.app')

@section('body')
<div class="px-4 py-6">
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
                        <!-- Tarjetas de Circulación -->
                        <p class="text-gray-500">/</p>
                        <!-- Seguros -->
                        <li class="flex items-center">
                            <p  class="text-gray-800 hover:text-gray-800">
                                Tarjetas de Circulación
                            </p>
                        </li>
                    </ul>
                </nav>
        </div>
        <div class="p-6 bg-white rounded-md shadow-md">
            <div class="flex justify-between mb-3">
                <h2 class="mb-4 text-lg font-semibold text-gray-700 capitalize">Tarjetas de Circulación</h2>
            </div>

            <div class="mb-2">
                <form action="{{ route('tarjetas.index') }}" method="GET"
                    class="flex flex-col items-center justify-between space-y-2 md:flex-row md:space-y-0">
                    <!-- Campo de búsqueda -->
                    <div class="flex items-center w-full md:w-auto">
                        <input type="text" name="search" placeholder="Buscar Tarjeta de Circulación..."
                            class="w-full px-4 py-2 text-gray-700 border rounded-l-md focus:outline-none md:w-48"
                            value="{{ request('search') }}" title="Buscar tarjeta de circulación">
                        <button type="submit"
                            class="flex items-center px-4 py-2 ml-1 text-white bg-blue-600 border-l-0 rounded-r-md hover:bg-blue-700 focus:outline-none"
                            title="Realizar búsqueda">
                            Buscar
                        </button>
                    </div>
                </form>
                <!-- Botón de Nuevo Registro -->
                <div class="flex justify-end ml-2 space-x-2">
                    <a href="{{ route('tarjetas.create') }}"
                        class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" title="Nuevo Registro">
                        Nuevo registro
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">#</th>
                            <th class="px-4 py-2 text-left text-gray-600">Vehículo</th>
                            <th class="px-4 py-2 text-left text-gray-600">Nombre</th>
                            <th class="px-4 py-2 text-left text-gray-600">Número de Tarjeta</th>
                            <th class="px-4 py-2 text-left text-gray-600">Origen</th>
                            <th class="px-4 py-2 text-left text-gray-600">Fecha de Expedición</th>
                            <th class="px-4 py-2 text-left text-gray-600">Fecha de Vigencia</th>
                            <th class="px-4 py-2 text-left text-gray-600">Estatus</th>
                            <th class="px-4 py-2 text-left text-gray-600">Fotografía</th>
                            <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($tarjetas as $key => $tarjeta)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                                <td class="px-4 py-2 border">
                                    {{ $tarjeta->automovil->submarca }} {{ $tarjeta->automovil->marca }}
                                    {{ $tarjeta->automovil->modelo }}
                                </td>
                                <td class="px-4 py-2 border">{{ $tarjeta->nombre }}</td>
                                <td class="px-4 py-2 border">{{ $tarjeta->num_tarjeta }}</td>
                                <td class="px-4 py-2 border">{{ $tarjeta->vehiculo_origen }}</td>
                                <td class="px-4 py-2 border">{{ date('d/m/Y', strtotime($tarjeta->fecha_expedicion)) }}</td>
                                <td class="px-4 py-2 border">{{ date('d/m/Y', strtotime($tarjeta->fecha_vigencia)) }}</td>
                                <td class="px-4 py-2 border">{{ $tarjeta->estatus }}</td>
                                <td class="px-4 py-2 border">
                                    @if ($tarjeta->fotografia_frontal)
                                        <img src="{{ url('img/tarjetas/' . $tarjeta->fotografia_frontal) }}"
                                            alt="Fotografía Frontal" class="object-cover w-16 h-16">
                                    @else
                                        <span class="text-gray-500">N/A</span>
                                    @endif
                                </td>

                                <td class="px-4 py-2 border">
                                    <div class="flex items-center space-x-2">
                                        <!-- Ver -->
                                        <a
                                            href="tarjetas/{{ $tarjeta->id_tarjeta }}" class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white" title="Ver detalles">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                            </svg>
                                        </a>

                                        <!-- Editar -->
                                        <a href="tarjetas/{{ $tarjeta->id_tarjeta }}/edit"
                                            class="inline-flex items-center justify-center w-8 h-8 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-600 hover:text-white" title="Editar tarjeta">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 3l5 5-1.5 1.5-5-5M3 21h18M3 21l8-8 5 5-8 8H3z" />
                                            </svg>
                                        </a>

                                        <!-- Eliminar -->
                                        <form action="tarjetas/{{ $tarjeta->id_tarjeta }}" method="POST" id="eliminacion-form" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="deleteRegister(event)"
                                                class="inline-flex items-center justify-center w-8 h-8 text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white" title="Eliminar tarjeta">
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
</div>
@endsection


@section('js')
    {{-- Alerta de creación --}}
    @if ($mensaje = Session::get('mensaje'))
        <script>
            Swal.fire({
                title: "Tarjeta de Circulación Registrada",
                text: "{{ $mensaje }}",
                icon: "success"
            });
        </script>
    @endif
    {{-- Alerta de edición --}}
    @if ($updateMessaje = Session::get('message'))
        <script>
            Swal.fire({
                title: "Información Actualizada",
                text: "{{ $updateMessaje }}",
                icon: "success"
            });
        </script>
    @endif

    {{-- Alerta de eliminación --}}
    @if (session('eliminar') == 'se ha eliminado correctamente el automóvil')
        <script>
            Swal.fire({
                title: "¡Eliminado!",
                text: "El automóvil ha sido eliminado correctamente.",
                icon: "success"
            });
        </script>
    @endif

    <script>
        function deleteRegister(event) {
            event.preventDefault();
            Swal.fire({
                title: "¿Seguro que deseas eliminar esta tarjeta?",
                text: "Una vez eliminada, no podrás recuperarla.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('eliminacion-form').submit();
                }
            });
        }
    </script>
@endsection
