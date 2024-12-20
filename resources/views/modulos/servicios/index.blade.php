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
                    <!-- Servicios -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Servicios
                        </p>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="mb-4 text-lg font-semibold text-gray-700 capitalize">Servicios</h2>
            <div class="mb-2">
                <form action="{{ route('servicios.index') }}" method="GET"
                    class="flex flex-col items-center justify-between space-y-2 md:flex-row md:space-y-0">
                    <!-- Campo de búsqueda -->
                    <div class="flex items-center w-full md:w-auto">
                        <input type="text" name="search" placeholder="Buscar servicio" title="Introduce el tipo de servicio o vehículo para buscar"
                            class="w-full px-4 py-2 text-gray-700 border rounded-l-md focus:outline-none md:w-48"
                            value="{{ request('search') }}">

                        <button type="submit"
                            class="flex items-center px-4 py-2 ml-1 text-white bg-blue-600 border-l-0 rounded-r-md hover:bg-blue-700 focus:outline-none"
                            title="Buscar servicio">
                            Buscar
                        </button>
                    </div>
                </form>
                <!-- Botones de Imprimir y Nuevo Registro -->
                <div class="flex justify-end ml-2 space-x-2">
                    <a href="{{ route('servicios-pdf') }}" target="_blank" class="inline-block px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700" title="Imprimir reporte">
                        Imprimir
                    </a>
                    <a href="servicios/create" class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" title="Registrar nuevo servicio">
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
                            <th class="px-4 py-2 text-left text-gray-600">Tipo de Servicio</th>
                            <th class="px-4 py-2 text-left text-gray-600">Descripción</th>
                            <th class="px-4 py-2 text-left text-gray-600">Fecha</th>
                            <th class="px-4 py-2 text-left text-gray-600">Próximo Servicio</th>
                            <th class="px-4 py-2 text-left text-gray-600">Costo</th>
                            <th class="px-4 py-2 text-left text-gray-600">Lugar de Servicio</th>
                            <th class="px-4 py-2 text-left text-gray-600">Estatus</th>
                            <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($servicios as $key => $servicio)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                                <td class="px-4 py-2 border">
                                    {{ $servicio->automovil }}
                                </td>
                                <td class="px-4 py-2 border">{{ $servicio->tipo_servicio }}</td>
                                <td class="px-4 py-2 border">{{ $servicio->descripcion }}</td>
                                <td class="px-4 py-2 text-center border">
                                    @if ($servicio->fecha_servicio == '')
                                        -
                                    @else
                                        {{ $servicio->fecha_servicio }}
                                    @endif
                                </td>

                                <td class="px-4 py-2 text-center border">
                                    @if ($servicio->prox_servicio == '')
                                        No aplica
                                    @else
                                        {{ $servicio->prox_servicio }}
                                    @endif
                                </td>
                                <td class="px-4 py-2 border">${{ $servicio->costo }}</td>
                                <td class="px-4 py-2 border">{{ $servicio->lugar_servicio }}</td>
                                @if($servicio->estatusIn !='Mantenimiento' && $servicio->estatusIn != 'En servicio')
                                    <td class="px-4 py-2 border">Entregado</td>
                                @else
                                    <td class="px-4 py-2 border">{{ $servicio->estatusIn }}</td>
                                @endif
                                <td class="px-4 py-2 border">
                                    <div class="flex items-center space-x-2">
                                        <!-- Ver -->
                                        <a href="servicios/{{ $servicio->id_servicio }}"
                                            class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white" title="Ver detalles del servicio">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                            </svg>
                                        </a>

                                        <!-- Editar -->
                                        <a href="servicios/{{$servicio->id_servicio}}/edit" class="inline-flex items-center justify-center w-8 h-8 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-600 hover:text-white" title="Editar información del servicio">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3l5 5-1.5 1.5-5-5M3 21h18M3 21l8-8 5 5-8 8H3z" />
                                            </svg>
                                        </a>

                                        <!-- Eliminar -->
                                        <form action="servicios/{{ $servicio->id_servicio }}" method="POST"
                                            id="{{ $servicio->id_servicio }}" name="del_{{ $servicio->id_servicio }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="del_{{ $servicio->id_servicio }}" onclick="deleteRegister(event, '{{ $servicio->id_servicio }}')"
                                                class="inline-flex items-center justify-center w-8 h-8 text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white" title="Eliminar servicio">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7H5M10 11v6m4-6v6M7 7h10l-1-1H8l-1 1z" />
                                                </svg>
                                            </button>
                                        </form>

                                        @if($servicio->estatusIn == 'En servicio' || $servicio->estatusIn == 'Mantenimiento')
                                        <a href="{{ route('liberar', $servicio->id_automovil) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 text-indigo-800 border border-indigo-600 bg-white rounded-md shadow-md hover:bg-white hover:text-white hover:border-blue-950 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                            <svg class="w-6 h-6 text-indigo-800  dark:text-dark" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.757 6 3.24 10.95a1.05 1.05 0 0 0 0 1.549l5.611 5.088m5.73-3.214v1.615a.948.948 0 0 1-1.524.845l-5.108-4.251a1.1 1.1 0 0 1 0-1.646l5.108-4.251a.95.95 0 0 1 1.524.846v1.7c3.312 0 6 2.979 6 6.654v1.329a.7.7 0 0 1-1.345.353 5.174 5.174 0 0 0-4.652-3.191l-.003-.003Z"/>
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
        </div>
    </div>
@endsection

@section('js')
    {{-- alert creacion --}}
    @if ($mensaje = Session::get('mensaje'))
        <script>
            Swal.fire({
                title: "Servicio Registrado",
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
    @if (session('eliminar') == 'se ha eliminado correctamente ')
        <script>
            Swal.fire({
                title: "Eliminado!",
                text: "El registro se ha sido eliminado correctamente.",
                icon: "success"
            });
        </script>
    @endif
    <script>
        function deleteRegister(event, formId) {
            event.preventDefault();

            const btndelete = document.getElementById(formId);
            Swal.fire({
                title: "Estas seguro de eliminar el registro?",
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
                        text: "El servicio ha sido eliminado correctamente.",
                        icon: "success"
                    });
                }
            });
        }
    </script>
@endsection
