@extends('layouts.app')

@section('body')
    <!-- Librería requerida para el kilometraje durante el viaje, está dentro de public -->
    <script type="text/javascript" src="{{ url('js/jquery-3.7.1.min.js') }}"></script>
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
                        @if(auth()->user()->hasRole('Administrador'))
                            <a href="{{ route('vigilante.index') }}" title="Volver a la página de vigilante"  class="text-gray-800 hover:text-gray-800">
                                Vigilante
                            </a>
                        @elseif(auth()->user()->hasRole('Moderador'))
                            <a href="{{ route('moderador.vigilante') }}" title="Volver a la página de vigilante"  class="text-gray-800 hover:text-gray-800">
                                Vigilante
                            </a>
                        @endif
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Multas  -->
                    <li class="flex items-center">
                        <p class="text-gray-800 hover:text-gray-800">
                            Registrar Check-Out
                        </p>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="mt-8">
            <div class="mt-4">
                <div class="p-6 bg-white rounded-lg shadow-lg">
                    <h2 class="text-lg font-semibold text-gray-700 capitalize">Reporte Check-In</h2>

                @if(auth()->user()->hasRole('Administrador'))
                    <form action="{{ route('admin.update2', $asignacion->checkIns->first()->id_check) }}" enctype="multipart/form-data" method="POST">
                @elseif(auth()->user()->hasRole('Moderador'))
                    <form action="{{ route('moderador.update2', $asignacion->checkIns->first()->id_check) }}" enctype="multipart/form-data" method="POST">
                @endif
                    @csrf
                    @method('PUT')

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <!-- Información General -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Vehículo</label>
                                <p class="mt-1 text-gray-600">{{ $asignacion->automovil->marca ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Usuario</label>
                                <p class="mt-1 text-gray-600">{{ $asignacion->usuarios->nombre ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Asignación</label>
                                <p class="mt-1 text-gray-600">{{ $asignacion->fecha_asignacion ?? 'N/A' }}</p>
                            </div>
                            <!-- Campo de fecha_estimada_dev -->
                            <div>
                                <label for="fecha_estimada_dev" class="block text-sm font-medium text-gray-700">Fecha
                                    estimada de devolución</label>
                                <input type="date" name="fecha_estimada_dev" id="fecha_estimada_dev"
                                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    value="{{ old('fecha_estimada_dev', $asignacion->fecha_estimada_dev ?? '') }}">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Destino</label>
                                <p class="mt-1 text-gray-600">{{ $asignacion->lugar ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Motivo</label>
                                <p class="mt-1 text-gray-600">{{ $asignacion->motivo ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kilometros empleados durante el
                                    viaje</label>
                                <input type="text" id="resultado"
                                    class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                    title="Kilometros empleados en viaje" readonly>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 mt-6 md:grid-cols-2">
                            <!-- Datos de Salida -->
                            <div class="space-y-4">
                                <h3 class="mt-6 text-lg font-medium text-gray-700">Datos de Salida</h3>
                                <div>
                                    <label for="km_salida" class="block text-sm font-medium text-gray-700">KM Salida</label>
                                    <input type="number" name="km_salida" id="km_salida"
                                        value="{{ old('km_salida', $asignacion->checkIns->first()->km_salida) }}"
                                        class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                        placeholder="Kilómetros de salida" disabled
                                        title="Kilómetros al momento de la salida">
                                </div>
                                <div>
                                    <label for="combustible_salida"
                                        class="block text-sm font-medium text-gray-700">Combustible Salida</label>
                                    <select name="combustible_salida" id="combustible_salida"
                                        class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                        disabled title="Nivel de combustible en el momento de la salida">
                                        <option value="1/4"
                                            {{ old('combustible_salida', $asignacion->checkIns->first()->combustible_salida) == '1/4' ? 'selected' : '' }}>
                                            1/4</option>
                                        <option value="1/2"
                                            {{ old('combustible_salida', $asignacion->checkIns->first()->combustible_salida) == '1/2' ? 'selected' : '' }}>
                                            1/2</option>
                                        <option value="3/4"
                                            {{ old('combustible_salida', $asignacion->checkIns->first()->combustible_salida) == '3/4' ? 'selected' : '' }}>
                                            3/4</option>
                                        <option value="reserva"
                                            {{ old('combustible_salida', $asignacion->checkIns->first()->combustible_salida) == 'reserva' ? 'selected' : '' }}>
                                            Reserva</option>
                                        <option value="lleno"
                                            {{ old('combustible_salida', $asignacion->checkIns->first()->combustible_salida) == 'lleno' ? 'selected' : '' }}>
                                            Lleno</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="hora_salida" class="block text-sm font-medium text-gray-700">Hora
                                        Salida</label>
                                    <input type="time" name="hora_salida" id="hora_salida"
                                        value="{{ old('hora_salida', $asignacion->checkIns->first()->hora_salida) }}"
                                        class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                        placeholder="Hora de salida" disabled title="Hora exacta de salida">
                                </div>
                            </div>

                            <!-- Datos de Llegada -->
                            <div class="space-y-4">
                                <h3 class="mt-6 text-lg font-medium text-gray-700">Datos de Llegada</h3>

                                <!-- Kilómetros de llegada -->
                                <div>
                                    <label for="km_llegada" class="block text-sm font-medium text-gray-700">KM
                                        Llegada</label>
                                    <input type="number" name="km_llegada" id="km_llegada"
                                        value="{{ old('km_llegada', $asignacion->checkIns->first()->km_llegada) }}"
                                        class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                        placeholder="Kilómetros de llegada" required
                                        title="Kilómetros al momento de la llegada">
                                </div>

                                <!-- Combustible de llegada -->
                                <div>
                                    <label for="combustible_llegada"
                                        class="block text-sm font-medium text-gray-700">Combustible Llegada</label>
                                    <select name="combustible_llegada" id="combustible_llegada"
                                        class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                        title="Nivel de combustible en el momento de la llegada">
                                        <option value="1/4"
                                            {{ old('combustible_llegada', $asignacion->checkIns->first()->combustible_llegada) == '1/4' ? 'selected' : '' }}>
                                            1/4</option>
                                        <option value="1/2"
                                            {{ old('combustible_llegada', $asignacion->checkIns->first()->combustible_llegada) == '1/2' ? 'selected' : '' }}>
                                            1/2</option>
                                        <option value="3/4"
                                            {{ old('combustible_llegada', $asignacion->checkIns->first()->combustible_llegada) == '3/4' ? 'selected' : '' }}>
                                            3/4</option>
                                        <option value="reserva"
                                            {{ old('combustible_llegada', $asignacion->checkIns->first()->combustible_llegada) == 'reserva' ? 'selected' : '' }}>
                                            Reserva</option>
                                        <option value="lleno"
                                            {{ old('combustible_llegada', $asignacion->checkIns->first()->combustible_llegada) == 'lleno' ? 'selected' : '' }}>
                                            Lleno</option>
                                    </select>
                                </div>

                                <!-- Hora de llegada -->
                                <div>
                                    <label for="hora_llegada" class="block text-sm font-medium text-gray-700">Hora
                                        Llegada</label>
                                    <input type="time" name="hora_llegada" id="hora_llegada"
                                        value="{{ old('hora_llegada', $asignacion->checkIns->first()->hora_llegada) }}"
                                        class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                        placeholder="Hora de llegada" required title="Hora exacta de llegada">
                                </div>
                            </div>

                        </div>
                        {{-- foto --}}
                        <div class="pt-4 mb-6">
                            <h3 class="mb-5 block text-xl font-semibold text-[#07074D]">
                                Subir Archivos
                            </h3>
                            <input type="file" name="fotografias_regreso[]" id="fotografias_regreso" class="sr-only"
                                multiple />
                            <div class="mb-8">
                                <label for="fotografias_regreso"
                                    class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                    <div>
                                        <span
                                            class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                            Buscar
                                        </span>
                                        <div id="file-info" class="mt-4">
                                            <span id="file-count">0 archivos seleccionados..</span>
                                            <ul id="file-names" class="pl-5 list-disc"></ul>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <script>
                            const fileInput = document.getElementById('fotografias_regreso');
                            const fileCountDisplay = document.getElementById('file-count');
                            const fileNamesDisplay = document.getElementById('file-names');

                            fileInput.addEventListener('change', function() {
                                const files = fileInput.files;
                                const fileCount = files.length;
                                fileCountDisplay.textContent = `${fileCount} archivos seleccionados`;
                                fileNamesDisplay.innerHTML = '';

                                for (let i = 0; i < fileCount; i++) {
                                    const listItem = document.createElement('li');
                                    listItem.textContent = files[i].name;
                                    fileNamesDisplay.appendChild(listItem);
                                }
                            });
                        </script>
                        <div class="flex justify-end mt-6">
                        
                            

                                @if(auth()->user()->hasRole('Administrador'))
                                <button type="submit" titile="Guardar datos de llegada"
                                class="inline-flex items-center px-4 py-2 text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Check-Out
                            </button>
                            <a href="{{ route('vigilante.index') }}" titile="Cancelar registro de datos"
                                class="inline-flex items-center px-4 py-2 ml-2 text-white bg-gray-700 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cancelar</a>
                        
                    
                    @elseif(auth()->user()->hasRole('Moderador'))
                    <button type="submit" titile="Guardar datos de llegada"
                                class="inline-flex items-center px-4 py-2 text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Check-Out
                            </button>
                        <a href="{{ route('moderador.vigilante') }}" titile="Cancelar registro de datos" class="inline-flex items-center px-4 py-2 text-white bg-gray-700 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cancelar</a>
                    @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function calcularKm() {
                const km_salida = parseFloat($('#km_salida').val()) || 0;
                const km_llegada = parseFloat($('#km_llegada').val()) || 0;

                const resultado = km_llegada - km_salida;

                $('#resultado').val(resultado);
            }

            $('#km_salida, #km_llegada').on('input', calcularKm);
        });
    </script>
@endsection
