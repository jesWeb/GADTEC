@extends('layouts.app')

@section('body')
    @if (session()->has('mensaje'))
        <script>
            Swal.fire({
                title: "Solicitud registrada",
                text: "{{ session('mensaje') }}",
                icon: "success"
            });
        </script>
    @endif

    <div class="px-4 py-6">
        <div class="p-6 bg-white rounded-md shadow-md">

            <div class="flex justify-between mb-3">
                <h2 class="text-2xl font-bold text-gray-800">Historial de tus solicitudes</h2>

            </div>

            <div class="mb-2">
                <form action="{{ route('user.dashboard') }}" method="GET"
                    class="flex flex-col items-center justify-between space-y-2 md:flex-row md:space-y-0">
                    <div class="flex items-center w-full md:w-auto">
                        <input type="text" name="search" placeholder="Buscar Solicitud"
                            title="Ingresa la solicitud que deseas buscar"
                            class="w-full px-4 py-2 text-gray-700 border rounded-l-md focus:outline-none md:w-48"
                            value="{{ request('search') }}">
                        <button type="submit" title="Realizar búsqueda"
                            class="flex items-center px-4 py-2 ml-1 text-white bg-blue-600 border-l-0 rounded-r-md hover:bg-blue-700 focus:outline-none">
                            Buscar
                        </button>

                    </div>
                </form>


                @if ($solicitudes->isEmpty())
                    <p>No tienes solicitudes registradas.</p>
                @else
                    <div class="overflow-x-auto rounded-lg shadow">

                        <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Automovil</th>
                                    <th class="text-center">Motivo</th>
                                    <th class="text-center">Lugar</th>
                                    <th class="text-center">Fecha de Salida</th>
                                    <th class="text-center">Hora de Salida</th>
                                    <th class="text-center">Acciones</th>

                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($solicitudes as $key => $solicitud)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $solicitud->marca }}
                                            {{ $solicitud->submarca }} {{ $solicitud->modelo }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $solicitud->motivo }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $solicitud->lugar }}</td>
                                        <td class="px-4 py-2 border text-center">
                                            {{ date('d-m-Y', strtotime($solicitud->fecha_salida)) }}
                                        </td>
                                        <td class="px-4 py-2 border text-center">
                                            {{ date('h:i A', strtotime($solicitud->hora_salida)) }}
                                        </td>
                                        <td class="px-4 py-2 border text-center">
                                            <div class="flex items-center space-x-2">
                                                <!-- Ver -->
                                                <a href="{{ route('usuario.show', $solicitud->id_asignacion) }}" title="Ver solicitud"
                                                    class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 3C6.48 3 2 12 2 12s4.48 9 10 9 10-9 10-9-4.48-9-10-9zm0 12c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4-4-4z" />
                                                    </svg>
                                                </a>
                                                
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $solicitudes->links() }}
                @endif
            </div>
        </div>

    </div>

@endSection


@yield('js')

{{-- alert creacion --}}
@if ($mensaje = Session::get('mensaje'))
    <script>
        Swal.fire({
            title: "Solicitud registrada",
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
@if (session('eliminar') == 'se ha eliminado correctamente usuario')
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
                    text: "El usuario ha sido eliminado correctamente.",
                    icon: "success"
                });
            }
        });
    }
</script>
