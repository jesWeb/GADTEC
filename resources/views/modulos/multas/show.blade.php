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
                    <!-- Solicitudes  -->
                    <li class="flex items-center">
                        <a href="{{ route('multas.index') }}" title="Volver a la página de multas"  class="text-gray-800 hover:text-gray-800">
                            Multas
                        </a>
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Multas  -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                           Ver Detalle Multa de Automovil
                        </p>
                    </li>
                </ul>
            </nav>
        </div>
    <div class="container px-4 mx-auto">
        <div class="flex justify-center mt-8">
            <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-xl">
                <!-- Encabezado -->
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-800">Detalle de Multa</h1>
                    <p class="mt-2 text-lg text-gray-600">Información completa sobre la multa seleccionada</p>
                </div>

            <!-- Información de multas en dos columnas -->
            <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2">
                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-xl font-medium text-gray-800">Vehículo:</p>
                        <p class="text-2xl font-semibold text-green-600">{{ $multa->automovil->marca }} {{ $multa->automovil->submarca }} {{ $multa->automovil->modelo }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-xl font-medium text-gray-800">Fecha de pago:</p>
                        <p class="text-lg text-gray-600">{{ $multa->tipo_multa }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-xl font-medium text-gray-800">Monto:</p>
                        <p class="text-lg text-gray-600">$ {{ $multa->monto }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-xl font-medium text-gray-800">Fecha de multa:</p>
                        
                        <p class="text-lg text-gray-600">{{ date('d/m/Y', strtotime($multa->fecha_multa)) }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-xl font-medium text-gray-800">Lugar:</p>
                        <p class="text-lg text-gray-600">{{ $multa->lugar }}</p>
                    </div>

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-xl font-medium text-gray-800">Estatus:</p>
                        <p class="text-lg text-gray-600">{{ $multa->estatus }}</p>
                    </div>
                

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                    <div class="mb-2">
                            <p
                            class="text-xl font-medium text-gray-800">Imagenes de tenencias</p>
                            @if($multa->comprobante != '') 
                            <div class="flex gap-4 p-4 ml-4 overflow-x-auto">
                                @php
                                    $fotografias = json_decode($multa->comprobante, true);
                                @endphp


                                @if ($fotografias)
                                    @foreach ($fotografias as $foto)
                                        <div class="grid gap-5">
                                            <img class="w-16 h-max-auto object-cover cursor-pointer rounded-lg 
                                            shadow-md hover:scale-90 hover:shadow-lg " 
                                            src="{{ url('img/multas/' . $foto) }}"
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

                    <div class="p-6 bg-transparent rounded-lg shadow-sm">
                        <p class="text-xl font-medium text-gray-800">Observaciones:</p>
                        <p class="text-lg text-gray-600">
                            @if($multa->observaciones)
                            <p class="text-gray-600 mt-4 text-lg">{{ $multa->observaciones }} </p>
                            @else
                            <p class="text-gray-500 mt-4 text-sm">No aplica</p>
                            @endif
                        </p>
                    </div>  
                </div> 
            <div class="flex justify-end">
                <a href="../multas" class="px-6 py-3 text-lg font-semibold text-white transition-all duration-200 bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                    title="Volver a la lista de multas">
                    Cerrar
                </a>
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

        function showModal(src) {
            modal.classList.remove('hidden');
            modalImg.src = src;
        }

        function closeModal() {
            modal.classList.add('hidden');
        }
</script>
@endsection
