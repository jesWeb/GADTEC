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
                <!-- Solicitudes  -->
                <li class="flex items-center">
                    @if (auth()->user()->hasRole('Administrador'))
                    <a href="{{ route('vigilante.index') }}" title="Volver a la página de vigilante"
                        class="text-gray-800 hover:text-gray-800">
                        Vigilante
                    </a>
                    @elseif(auth()->user()->hasRole('Moderador'))
                    <a href="{{ route('moderador.vigilante') }}" title="Volver a la página de vigilante"
                        class="text-gray-800 hover:text-gray-800">
                        Vigilante
                    </a>
                    @endif
                </li>
                <!-- Separador -->
                <li class="text-gray-500">/</li>
                <!-- Multas  -->
                <li class="flex items-center">
                    <p class="text-gray-800 hover:text-gray-800">
                        Ver Detalle de Asignación
                    </p>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Detalle de la asignación -->
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg font-semibold text-gray-700 capitalize">Detalles de la Asignación - Control Vehicular</h2>

        <div class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2 md:grid-cols-3">
            <!-- Información del Vehículo -->
            <div class="p-4 rounded-lg shadow bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-700">Vehículo Asignado</h3>
                <p><strong>Marca:</strong> {{ $vigilante->automovil->marca ?? 'N/A' }}</p>
                <p><strong>Modelo:</strong> {{ $vigilante->automovil->modelo ?? 'N/A' }}</p>
                <p><strong>Placas:</strong> {{ $vigilante->automovil->placas ?? 'N/A' }}</p>
            </div>

            <!-- Información del Usuario -->
            <div class="p-4 rounded-lg shadow bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-700">Usuario Asignado</h3>
                <p><strong>Nombre:</strong> {{ $vigilante->usuarios->nombre ?? 'N/A' }}</p>
                <p><strong>Rol:</strong> {{ $vigilante->usuarios->rol ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $vigilante->usuarios->email ?? 'N/A' }}</p>
            </div>

            <!-- Información de Asignación -->
            <div class="p-4 rounded-lg shadow bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-700">Detalles de Asignación</h3>
                <p><strong>Fecha de Asignación:</strong>
                    {{ $vigilante->fecha_asignacion ? date('d/m/Y', strtotime($vigilante->fecha_asignacion)) : 'N/A' }}
                </p>
                <p><strong>Fecha Estimada de Devolución:</strong> <span
                        class="text-red-600">{{ $vigilante->fecha_estimada_dev ? date('d/m/Y', strtotime($vigilante->fecha_estimada_dev)) : 'N/A' }}</span>
                </p>
                <p><strong>Motivo:</strong> {{ $vigilante->motivo ?? 'N/A' }}</p>
                <p><strong>Destino:</strong> {{ $vigilante->lugar ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Check-In Details -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-700">Datos de Check-In</h3>
            @if ($vigilante->checkIns->isNotEmpty())
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-600">KM Salida</th>
                            <th class="px-4 py-2 text-left text-gray-600">Combustible Salida</th>
                            <th class="px-4 py-2 text-left text-gray-600">Hora Salida</th>
                            <th class="px-4 py-2 text-left text-gray-600">KM Llegada</th>
                            <th class="px-4 py-2 text-left text-gray-600">Combustible Llegada</th>
                            <th class="px-4 py-2 text-left text-gray-600">Hora Llegada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vigilante->checkIns as $checkIn)
                        <tr>
                            <td class="px-4 py-2 border">{{ $checkIn->km_salida ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $checkIn->combustible_salida ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">
                                {{ $checkIn->hora_salida ? date('H:i', strtotime($checkIn->hora_salida)) : 'N/A' }}
                            </td>
                            <td class="px-4 py-2 border">{{ $checkIn->km_llegada ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">{{ $checkIn->combustible_llegada ?? 'N/A' }}</td>
                            <td class="px-4 py-2 border">
                                {{ $checkIn->hora_llegada ? date('H:i', strtotime($checkIn->hora_llegada)) : 'N/A' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p class="text-red-600">No hay datos de check-ins registrados.</p>
            @endif
        </div>


        
        <div class="flex flex-col gap-5.5 items-center justify-center mt-4 xl:flex-row mb-3">
            <div>
                <h1 class="p-4 text-lg font-semibold text-center text-gray-700">
                    Fotografías de salida del automóvil
                </h1>
                
                <div class="flex gap-4 p-4 ml-4 overflow-x-auto">
                    @php
                        $fotografiasSalida = json_decode($checkIn->fotografias_salida, true);
                    @endphp

                    @if ($fotografiasSalida)
                        @foreach ($fotografiasSalida as $foto)
                            <!-- Images-->
                            <div class="grid gap-5 ">
                                <img 
                                class="w-16 h-max-auto object-cover cursor-pointer rounded-lg 
                                shadow-md hover:scale-90 hover:shadow-lg "
                                src="{{ url('img/salidas/' . $foto) }}"
                                    alt="Img 1" id="img1" />
                                
                            </div>
                        @endforeach

                    @else
                        <p>No hay fotografias Cargadas </p>
                    @endif
                    <!-- The Modal -->
                    <div id="modal"
                        class="hidden fixed top-0 left-0 z-80 
                                w-screen h-screen bg-black/70 flex 
                                justify-center items-center">

                        <!-- The close button -->
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

            </div>

             <!-- Fotografías de regreso -->
             <div class="w-full px-3 xl:w-1/2">
                <h1 class="p-4 text-lg font-semibold text-center text-gray-700">Fotografías de regreso del automóvil
                </h1>
                <div class="flex gap-4 p-4 ml-4 overflow-x-auto">
                    @php
                    $fotografiasRegreso = json_decode($checkIn->fotografias_regreso, true);
                    @endphp


                    @if ($fotografiasRegreso)
                        @foreach ($fotografiasRegreso as $foto)
                        <div class="grid gap-5">
                        <img class="w-16 h-max-auto object-cover cursor-pointer rounded-lg 
                            shadow-md hover:scale-90 hover:shadow-lg " 
                            src="{{ url('img/llegadas/' . $foto) }}"
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
            </div>
                
        </div>
           
    

        <div class="flex justify-end mt-6 space-x-4">
            <!-- Botón cerrar -->

            @if (auth()->user()->hasRole('Administrador'))
            <a href="{{ route('vigilante.index') }}" title="Volver al listado del vigilante"
                class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-200 bg-green-600 rounded-md hover:bg-green-700 focus:outline-none">Cerrar</a>
            @elseif(auth()->user()->hasRole('Moderador'))
            <a href="{{ route('moderador.vigilante') }}" title="Volver al listado del vigilante"
                class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-200 bg-green-600 rounded-md hover:bg-green-700 focus:outline-none">Cerrar</a>
            @endif


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