@extends('layouts.app')

@section('body')
    <!-- Librería requerida para validacion del tamaño de la img, está dentro de public -->
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
                            Registrar Check-In
                        </p>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="mt-8">
            <div class="mt-4">
                <div class="p-6 bg-white rounded-lg shadow-lg">
                    <h2 class="text-lg font-semibold text-gray-700 capitalize">Reporte Check-In</h2>
                    @if (auth()->user()->hasRole('Administrador'))
                        <form id="imageForm" action="{{ route('vigilante.update', $asignacion->id_asignacion) }}"
                            method="POST" enctype="multipart/form-data">
                        @elseif(auth()->user()->hasRole('Moderador'))
                            <form id="imageForm" action="{{ route('update.vigilante', $asignacion->id_asignacion) }}"
                                method="POST" enctype="multipart/form-data">
                    @endif
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
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
                            <p class="mt-1 text-gray-600">
                                {{ $asignacion->fecha_asignacion ? date('d/m/Y', strtotime($asignacion->fecha_asignacion)) : 'N/A' }}
                            </p>
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
                    </div>

                    <div class="grid grid-cols-1 gap-4 mt-6 md:grid-cols-2">
                        <!-- Datos de Salida -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-700">Datos de Salida</h3>
                            <div>
                                <label for="km_salida" class="block text-sm font-medium text-gray-700">KM Salida</label>
                                <input type="number" name="km_salida" id="km_salida" value="{{ old('km_salida') }}"
                                    placeholder="Ingrese KM de salida"
                                    title="Ingrese el kilometraje en el que el vehículo salió"
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                    required>
                            </div>

                            <div>
                                <label for="combustible_salida" class="block text-sm font-medium text-gray-700">Combustible
                                    Salida</label>
                                <select name="combustible_salida" id="combustible_salida"
                                    title="Seleccione el nivel de combustible al salir"
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                    required>
                                    <option value="1/4" {{ old('combustible_salida') == '1/4' ? 'selected' : '' }}>
                                        1/4</option>
                                    <option value="1/2" {{ old('combustible_salida') == '1/2' ? 'selected' : '' }}>
                                        1/2</option>
                                    <option value="3/4" {{ old('combustible_salida') == '3/4' ? 'selected' : '' }}>
                                        3/4</option>
                                    <option value="reserva" {{ old('combustible_salida') == 'reserva' ? 'selected' : '' }}>
                                        Reserva</option>
                                    <option value="lleno" {{ old('combustible_salida') == 'lleno' ? 'selected' : '' }}>
                                        Lleno</option>
                                </select>
                            </div>

                            <div>
                                <label for="hora_salida" class="block text-sm font-medium text-gray-700">Hora
                                    Salida</label>
                                <input type="time" name="hora_salida" id="hora_salida"
                                    value="{{ old('hora_salida', $asignacion->hora_salida ?? '') }}"
                                    placeholder="Seleccione la hora de salida"
                                    title="Seleccione la hora en la que el vehículo salió"
                                    class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                    required>
                            </div>




                        </div>


                        <!-- Datos de Llegada -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-700">Datos de Llegada</h3>
                            <div>
                                <label for="km_llegada" class="block text-sm font-medium text-gray-700">KM
                                    Llegada</label>
                                <input type="number" name="km_llegada" id="km_llegada" value="{{ old('km_llegada') }}"
                                    placeholder="Ingrese KM de llegada"
                                    title="Ingrese el kilometraje en el que el vehículo llegó"
                                    class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                    disabled>
                            </div>

                            <div>
                                <label for="combustible_llegada"
                                    class="block text-sm font-medium text-gray-700">Combustible Llegada</label>
                                <select name="combustible_llegada" id="combustible_llegada"
                                    placeholder="Seleccione el nivel de combustible al llegar"
                                    title="Seleccione el nivel de combustible al llegar"
                                    class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                    disabled>
                                    <option value="1/4" {{ old('combustible_llegada') == '1/4' ? 'selected' : '' }}>1/4
                                    </option>
                                    <option value="1/2" {{ old('combustible_llegada') == '1/2' ? 'selected' : '' }}>1/2
                                    </option>
                                    <option value="3/4" {{ old('combustible_llegada') == '3/4' ? 'selected' : '' }}>3/4
                                    </option>
                                    <option value="vacío" {{ old('combustible_llegada') == 'vacío' ? 'selected' : '' }}>
                                        Vacío</option>
                                    <option value="reserva"
                                        {{ old('combustible_llegada') == 'reserva' ? 'selected' : '' }}>Reserva
                                    </option>
                                    <option value="lleno" {{ old('combustible_llegada') == 'lleno' ? 'selected' : '' }}>
                                        Lleno</option>
                                </select>
                            </div>

                            <div>
                                <label for="hora_llegada" class="block text-sm font-medium text-gray-700">Hora
                                    Llegada</label>
                                <input type="time" name="hora_llegada" id="hora_llegada"
                                    value="{{ old('hora_llegada') }}" placeholder="Seleccione la hora de llegada"
                                    title="Seleccione la hora en la que el vehículo llegó"
                                    class="block w-full mt-1 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                    disabled>
                            </div>




                        </div>
                    </div>
                    <!-- Subida de imágenes -->
                    <div class="pt-4 mb-6">
                        <h3 class="mb-5 block text-xl font-semibold text-[#07074D]">
                            Subir Imágenes
                        </h3>
                        <p class="text-sm text-gray-600">Máximo 5 imágenes</p>
                        <div class="flex flex-wrap gap-4 mt-4 pt-4 mb-6" id="imageContainer"></div>
                        <div class="mb-8">
                            <label for="fotografias_salida" id="takePhotoBtn"
                                class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                <div>
                                    <button type="button" name="fotografias_salida[]" id="fotografias_salida"
                                        accept="image/*"
                                        class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                        Buscar
                                    </button>

                                </div>
                            </label>
                        </div>
                    </div>


                    <div class="mt-6">

                        <button type="submit" id="submitBtn" disabled titile="Guardar datos de salida"
                            class="inline-flex items-center px-4 py-2 text-white bg-yellow-600 border border-transparent rounded-md shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            Crear Check-In
                        </button>
                        @if (auth()->user()->hasRole('Administrador'))
                            <a href="{{ route('vigilante.index') }}" titile="Cancelar registro de datos"
                                class="inline-flex items-center px-4 py-2 ml-2 text-white bg-gray-700 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cancelar</a>
                        @elseif(auth()->user()->hasRole('Moderador'))
                            <a href="{{ route('moderador.vigilante') }}" titile="Cancelar registro de datos"
                                class="inline-flex items-center px-4 py-2 ml-2 text-white bg-gray-700 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">Cancelar</a>
                        @endif
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script de validación -->
    <script>
        $(document).ready(function() {
            let maxImages = 5;
            let currentImages = 0;
            const maxFileSize = 15 * 1024 * 1024;

            function updateButtonState() {
                $('#addImageBtn').prop('disabled', currentImages >= maxImages);
                $('#submitBtn').prop('disabled', currentImages === 0);
            }

            function createImageInput(capture = false) {
                const inputFile = $('<input>', {
                    type: 'file',
                    name: 'fotografias_salida[]',
                    accept: 'image/jpeg,image/png',
                    class: 'hidden',
                    capture: capture ? 'environment' :
                        undefined // 'environment' para usar la cámara trasera
                });

                const previewContainer = $(`
            <div class="flex items-center mt-4 space-x-4">
                <img src="#" class="object-cover w-16 h-16 border rounded" alt="Previsualización">
                <button type="button" class="text-red-500 remove-image">Eliminar</button>
            </div>
        `);

                inputFile.on('change', function() {
                    const file = this.files[0];

                    if (file) {
                        if (file.size > maxFileSize) {
                            alert('El archivo supera el tamaño máximo permitido de 6 MB.');
                            inputFile.val('');
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewContainer.find('img').attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file);

                        currentImages++;
                        updateButtonState();
                    }
                });

                previewContainer.find('.remove-image').on('click', function() {
                    inputFile.remove();
                    previewContainer.remove();
                    currentImages--;
                    updateButtonState();
                });

                $('#imageContainer').append(previewContainer);
                inputFile.click();
                $('#imageForm').append(inputFile);
            }

            $('#addImageBtn').on('click', function() {
                if (currentImages < maxImages) {
                    createImageInput();
                }
            });

            $('#takePhotoBtn').on('click', function() {
                if (currentImages < maxImages) {
                    createImageInput(true); // Llama a createImageInput con captura
                }
            });

            // createImageInput(); // Agregar un input por defecto
        });
    </script>
@endsection
