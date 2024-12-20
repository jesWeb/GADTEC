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
                    <!-- Tenencias/Refrendos -->
                    <li class="flex items-center">
                        <a href="{{route('tenencias.index')}}" title="Volver a la página de tenencias/refrendos" class="text-gray-800 hover:text-gray-800">
                            Tenencias-Refrendos
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Tenencias/Refrendos -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Ver Detalle Tenencia o Refrendo
                        </p>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container px-4 mx-auto">
        <div class="flex justify-center mt-12">
            <div class="w-full max-w-3xl p-8 bg-white rounded-lg shadow-lg bg-gradient-to-r">            
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-800">Detalle de Tenencia/Refrendo</h1>
                    <p class="mt-2 text-lg text-gray-600">Información completa sobre la tenencia o refrendo seleccionado</p>
                </div>
                
                <!-- Detalles del automóvil -->
                <div class="mt-6 space-y-6">
                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-lg font-semibold text-gray-800">Vehiculo</p>
                        <p class="text-xl font-bold text-green-600">{{ $tenencia->automovil->marca }} {{ $tenencia->automovil->submarca }} {{ $tenencia->automovil->modelo }}</p>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Detalles básicos -->
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <p class="text-lg font-semibold text-gray-800">Fecha de pago:</p>
                            <p class="text-gray-600">{{ date('d/m/Y', strtotime($tenencia->fecha_pago)) }}</p>
                        </div>

                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <p class="text-lg font-semibold text-gray-800">Origen:</p>
                            <p class="text-gray-600">{{ $tenencia->origen }}</p>
                        </div>

                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <p class="text-lg font-semibold text-gray-800">Monto:</p>
                            <p class="text-gray-600">$ {{ $tenencia->monto }}</p>
                        </div>

                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <p class="text-lg font-semibold text-gray-800">Año Correspondiente:</p>
                            <p class="text-gray-600">{{ $tenencia->año_correspondiente }}</p>
                        </div>
                
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <p class="text-lg font-semibold text-gray-800">Estatus:</p>
                            <p class="text-gray-600">{{ $tenencia->estatus }}</p>
                        </div>

        
                
            
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <p class="text-lg font-semibold text-gray-800">Comprobante:</p>
                            @if($tenencia->comprobante != '') 
                                <div class="flex gap-4 p-4 ml-4 overflow-x-auto">
                                    @php
                                        $fotografias = json_decode($tenencia->comprobante, true);
                                    @endphp

                                    @if ($fotografias != '')
                                            @foreach ($fotografias as $foto)
                                            <div class="grid gap-5">
                                                <img class="w-16 h-max-auto object-cover cursor-pointer rounded-lg 
                                                        shadow-md hover:scale-90 hover:shadow-lg " 
                                                        src="{{ url('img/tenencias/' . $foto) }}"
                                                            alt="Img 1" id="img1" />
                                                            
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No hay fotografias Cargadas </p>
                                    @endif
                                    <div id="modal"
                                        class="hidden  fixed top-0 left-0 z-80 
                                            w-screen h-screen bg-black/70 flex
                                            justify-center items-center">
                                        <!-- Boton de cerrar -->
                                        <a class="fixed z-90 top-6 right-8 
                                        text-white text-5xl font-bold" 
                                            href="javascript:void(0)"
                                            onclick="closeModal()">
                                            ×
                                        </a>

                                        <!-- Medida de imagen -->
                                        <img id="modal-img"
                                            class="max-w-[900px] max-h-[700px] object-cover"/>
                                    </div>
                                </div>
                            
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-200 bg-green-500 rounded-md hover:bg-green-600 focus:outline-none" href="../tenencias"
                        title="Volver al listado de tenencias">
                        <i class="mr-2 fa-solid fa-arrow-left"></i> Volver
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
                
    // obtener todos los elementos de la img
        var images = document.querySelectorAll('.grid img');

    // recorre cada elemento de la img
        images.forEach(function (img) {
                    
            // agregar cada evento de elementos en cada clic en la img
            img.addEventListener('click', function () {
                showModal(img.src);
            });
        });

        // obtener el id del modal
        var modal = document.getElementById("modal");

        // obtener la etiqueta de la img
        var modalImg = document.getElementById("modal-img");

        // Cuando se hace clic en la img
        function showModal(src) {
            modal.classList.remove('hidden');
            modalImg.src = src;
        }

        // Esta funcion es para cerrar
            function closeModal() {
                modal.classList.add('hidden');
        }
</script>
@endsection
