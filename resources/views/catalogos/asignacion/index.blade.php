@extends('layouts.app')
@section('body')
    <div class="px-4 py-6">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">Solicitud de Vehículo</h2>
            <div class="mb-4 text-right">
                <a href="{{ route('asignacion.create') }}"class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" 
                title="Generar nueva solicitud">Nueva Solicitud</a>
            </div>
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">#</th>
                            <th class="px-4 py-2 text-left text-gray-600">Vehículo</th>
                            <th class="px-4 py-2 text-left text-gray-600">Solicitante</th>
                            <th class="px-4 py-2 text-left text-gray-600">Fecha de Salida</th>
                            <th class="px-4 py-2 text-left text-gray-600">Hora de Salida</th>
                            <th class="px-4 py-2 text-left text-gray-600">Destino</th>
                            <th class="px-4 py-2 text-left text-gray-600">Estatus</th>
                            <th class="px-4 py-2 text-left text-gray-600">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($reservacion as $key => $reserv)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                                <td class="px-4 py-2 border">{{ $reserv->automovil->marca}} {{ $reserv->automovil->submarca}} {{ $reserv->automovil->modelo}}</td>
                                <td class="px-4 py-2 border">{{ $reserv->usuarios->nombre}} {{ $reserv->usuarios->app}} {{ $reserv->usuarios->apm}}</td>
                                <td class="px-4 py-2 border">{{ $reserv->fecha_salida }}</td>
                                <td class="px-4 py-2 border">{{ date('H:i', strtotime($reserv->hora_salida)) }}</td>
                                <td class="px-4 py-2 border">{{ $reserv->lugar }}</td>
                                <td class="px-4 py-2 border">{{ $reserv->estatus}}</td>
                                {{-- acciones --}}
                                <td class="px-4 py-2 border">
                                    <div class="flex justify-center space-x-2">
                                        <!-- Ver -->
                                        <a href="{{ route('asignacion.show', $reserv->id_asignacion) }}" class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white"
                                            title="Visualizar solicitud">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                                            </svg>
                                        </a>

                                        <!-- Editar -->
                                        <a href="{{ route('asignacion.edit', $reserv->id_asignacion) }}" 
                                            class="inline-flex items-center justify-center w-8 h-8 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-600 hover:text-white"
                                            title="Editar solicitud">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 3l5 5-1.5 1.5-5-5M3 21h18M3 21l8-8 5 5-8 8H3z" />
                                            </svg>
                                        </a>

                                        <!-- Eliminar -->
                                        <form action="{{ route('asignacion.destroy', $reserv->id_asignacion) }}" method="POST"  id="eliminacion-form" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="deleteRegister(event)"
                                                class="inline-flex items-center justify-center w-8 h-8 text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white"
                                                title="Borrar solicitud">
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
                title: "Asignacion Registrada",
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
        function deleteRegister() {
            event.preventDefault();
            const btndelete = document.getElementById("eliminacion-form");
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
                        text: "El automóvil ha sido eliminado correctamente.",
                        icon: "success"
                    });
                }
            });
        }
    </script>
