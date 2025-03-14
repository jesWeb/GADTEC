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
        <h2 class="text-lg font-semibold text-gray-700 capitalize">Historial de tus solicitudes</h2>
        
        Historial de solicitudes por usuario
        
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
