@extends('layouts.app')

@section('body')
    <div class="px-4 py-6">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <div class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Ir a la gestión de vehículos"
                            class="flex items-center text-gray-700 hover:text-gray-900">
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
                        <a href="{{ $backRoute ?? route('catalogos.index') }}" title="Volver a Catálogos"
                            class="text-gray-800 hover:text-gray-800">
                            Catálogos
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Seguros -->
                    <li class="flex items-center">
                        <p class="text-gray-800 hover:text-gray-800">
                            Verificaciones
                        </p>
                    </li>
                    </ul>
            </nav>
        </div>
        <div class="p-6 bg-white rounded-md shadow-md">

            <div class="flex justify-between mb-3">
                <h2 class="mb-4 text-lg font-semibold text-gray-700 capitalize">Verificaciones Vehiculares</h2>
            </div>

            <div class="mb-2">
                <div class="flex justify-between">
                    <form action="{{ route('verificaciones.index') }}" method="GET"
                        class="flex flex-col items-center justify-between space-y-2 md:flex-row md:space-y-0">
                        <!-- Campo de búsqueda -->
                        <div class="flex items-center w-full md:w-auto">
                            <input type="text" name="search" placeholder="Buscar Verificación"
                                class="w-full px-4 py-2 text-gray-700 border rounded-l-md focus:outline-none md:w-48"
                                value="{{ request('search') }}" title="Buscar Verificación">
                            <button type="submit"
                                class="flex items-center px-4 py-2 ml-1 text-white bg-blue-600 border-l-0 rounded-r-md hover:bg-blue-700 focus:outline-none"
                                title="Realizar búsqueda">
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Botones Nuevo Registro -->
                <div class="flex justify-end ml-2 space-x-2">
                    {{-- Registro --}}
                    <a href="{{ route('verificaciones.create') }}"
                        class="inline-block px-4 py-3 text-white bg-blue-600 rounded hover:bg-blue-700"
                        title="Nuevo registro de verificación">Nuevo registro</a>
                    {{-- Calendario --}}
                    <button id="btn-calendar"
                        class="inline-flex items-center px-6 py-3 text-base font-medium text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        title="Ver calendario de verificaciones">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" height="24"
                            fill="none" class="svg-icon">
                            <g stroke-width="2" stroke-linecap="round" stroke="#fff">
                                <rect y="5" x="4" width="16" rx="2" height="16"></rect>
                                <path d="m8 3v4"></path>
                                <path d="m16 3v4"></path>
                                <path d="m4 11h16"></path>
                            </g>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">#</th>
                            <th class="px-4 py-2 text-left text-gray-600">Vehículo</th>
                            <th class="px-4 py-2 text-left text-gray-600">Fecha verificación</th>
                            <th class="px-4 py-2 text-left text-gray-600">Fecha próxima verificación</th>
                            <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($verificacion as $key => $vr)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                                <td class="px-4 py-2 border">
                                    {{ $vr->automovil->marca }}-{{ $vr->automovil->submarca }}-{{ $vr->automovil->modelo }}
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ \Carbon\Carbon::parse($vr->fecha_verificacion)->locale('es')->format('d-m-Y') }}

                                </td>
                                <td class="px-4 py-2 border">
                                    {{ \Carbon\Carbon::parse($vr->proxima_verificacion)->locale('es')->format('d-m-Y') }}

                                </td>
                                {{-- acciones --}}
                                <td class="px-4 py-2 border">
                                    <div class="flex items-center space-x-2">
                                        <!-- Ver -->
                                        <a href="{{ route('verificaciones.show', $vr->id_verificacion) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white"
                                            title="Ver detalles de la verificación">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                            </svg>
                                        </a>

                                        <!-- Editar -->
                                        <a href="{{ route('verificaciones.edit', $vr->id_verificacion) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-600 hover:text-white"
                                            title="Editar la verificación">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 3l5 5-1.5 1.5-5-5M3 21h18M3 21l8-8 5 5-8 8H3z" />
                                            </svg>
                                        </a>

                                        <!-- Eliminar -->
                                        <form action="{{ route('verificaciones.destroy', $vr) }}" id="eliminacion-form"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="deleteRegister(event)"
                                                class="inline-flex items-center justify-center w-8 h-8 text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white"
                                                title="Borrar la verificación">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
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
    {{-- alert creación --}}
    @if ($mensaje = Session::get('mensaje'))
        <script>
            Swal.fire({
                title: "Verificación Registrada",
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

    {{-- alerta de eliminación --}}
    @if (session('eliminar') == 'se ha eliminado correctamente El automóvil')
        <script>
            Swal.fire({
                title: "¡Eliminado!",
                text: "Eliminado correctamente",
                icon: "success"
            });
        </script>
    @endif
    <script>
        function deleteRegister() {
            event.preventDefault();
            const form = event.target.closest('form');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás deshacer esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
    {{-- calendar  --}}
    <script>
        const btnAlert = document.getElementById('btn-calendar');
        btnAlert.addEventListener('click', () => {
            Swal.fire({
                title: "Calendario  de verificacion",
                imageUrl: "/img/Verificacion.png",
                imageWidth: 480,
                imageHeight: 320,
                imageAlt: "Custom image"
            });
        });
    </script>
@endsection
