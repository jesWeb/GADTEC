@extends('layouts.app')

@section('body')
    <div class="px-6 py-2">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <ul class="flex items-center space-x-4">
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
                            Gestion
                        </a>
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Incidencias  -->
                    <li class="flex items-center">
                        <p href="{{ route('moderador.index') }}" class="text-gray-800 hover:text-gray-800">
                            Incidencias
                        </p>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="mb-4 text-lg font-semibold text-gray-700 capitalize">Historial de Incidencias</h2>

            @if (session('success'))
                <div id="alerta-success" class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
            @if (auth()->user()->hasRole('Administrador'))
                <div class="mb-2">
                    <form action="{{ route('incidencias.table') }}" method="GET"
                        class="flex flex-col items-center justify-between space-y-2 md:flex-row md:space-y-0">
                        <!-- Campo de búsqueda por fecha -->
                        <div class="flex items-center w-full md:w-auto">
                            <input type="date" name="search" placeholder="Buscar por fecha de incidencia"
                                class="w-full px-4 py-2 text-gray-700 border rounded-l-md focus:outline-none md:w-48"
                                value="{{ request('search') }}">
                            <button type="submit"
                                class="flex items-center px-4 py-2 ml-1 text-white bg-blue-600 border-l-0 rounded-r-md hover:bg-blue-700 focus:outline-none"
                                title="Realizar búsqueda">
                                Buscar
                            </button>
                        </div>
                    </form>

                    <div class="mb-2 text-right">
                        <a href="{{ route('incidenciasAdmin.create') }}" title="Generar nueva incidencia"
                            class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Registrar
                            nueva
                            incidencia</a>
                    </div>

                </div>
            @elseif (auth()->user()->hasRole('Moderador'))
                <div class="mb-2">
                    <form action="{{ route('moderador.index') }}" method="GET"
                        class="flex flex-col items-center justify-between space-y-2 md:flex-row md:space-y-0">
                        <!-- Campo de búsqueda por fecha -->
                        <div class="flex items-center w-full md:w-auto">
                            <input type="date" name="search" placeholder="Buscar por fecha de incidencia"
                                class="w-full px-4 py-2 text-gray-700 border rounded-l-md focus:outline-none md:w-48"
                                value="{{ request('search') }}">
                            <button type="submit"
                                class="flex items-center px-4 py-2 ml-1 text-white bg-blue-600 border-l-0 rounded-r-md hover:bg-blue-700 focus:outline-none"
                                title="Realizar búsqueda">
                                Buscar
                            </button>
                        </div>
                    </form>
                    <div class="mb-2 text-right">
                        <a href="{{ route('moderador.create') }}" title="Generar nueva incidencia"
                            class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Registrar
                            nueva
                            incidencia</a>

                    </div>

                </div>
            @endif



            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">#</th>
                            <th class="px-4 py-2 text-left text-gray-600">Usuario responsable</th>
                            <th class="px-4 py-2 text-left text-gray-600">Fecha y Hora de Registro</th>
                            <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($incidencias as $incidencia)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">
                                    <strong>{{ $incidencia->id_incidencia }}</strong>
                                </td>
                                <td class="px-4 py-2 border">
                                    @if ($incidencia->id_usuario == auth()->id())
                                        <strong class="text-indigo-600">
                                            {{ $incidencia->usuario->nombre }} {{ $incidencia->usuario->app }}
                                            {{ $incidencia->usuario->apm }}
                                        </strong>
                                    @else
                                        <strong class="text-blue-800">
                                            {{ $incidencia->usuario->nombre }} {{ $incidencia->usuario->app }}
                                            {{ $incidencia->usuario->apm }}
                                        </strong>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border">
                                    <strong>{{ $incidencia->created_at->format('d/m/Y g:i A') }}</strong>
                                </td>
                                <td class="px-4 py-2 border">
                                    <div class="flex items-center space-x-2">
                                        @if (auth()->user()->hasRole('Administrador'))
                                            <a href="{{ route('incidenciasAdmin.show', $incidencia->id_incidencia) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white"
                                                title="Ver detalles de la incidencia">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                                </svg>
                                            </a>
                                        @elseif (auth()->user()->hasRole('Moderador'))
                                            <a href="{{ route('moderador.show', $incidencia->id_incidencia) }}"
                                                class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white"
                                                title="Ver detalles de la incidencia">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                                </svg>
                                            </a>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginado -->
            <div class="mt-4">
                {{ $incidencias->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    @if (session('success'))
        <script>
            setTimeout(function() {
                var alerta = document.getElementById('alerta-success');
                if (alerta) {
                    alerta.style.display = 'none';
                }
            }, 3000);
        </script>
    @endif
@endsection
