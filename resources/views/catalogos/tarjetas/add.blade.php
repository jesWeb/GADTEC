@extends('layouts.app') <!-- Extiende el layout principal -->

<!-- Librería requerida para el formulario dinámico, está dentro de public -->
<script type="text/javascript" src="{{ url('js/jquery-3.7.1.min.js') }}"></script>

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
                    <!-- Tarjeta de Circulacións -->
                    <li class="flex items-center">
                        <a href="{{route('tarjetas.index')}}" title="Volver a la página de tarjetas de circulación" class="text-gray-800 hover:text-gray-800">
                            Tarjetas de Circulación
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Tarjeta de Circulación -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Registrar Nueva Tarjeta de Circulación
                        </p>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="mt-8">
        <div class="mt-4">
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h2 class="text-lg font-semibold text-gray-700 capitalize">Alta de Tarjeta de Circulación</h2>

                <form id="imageForm" action="{{ route('tarjetas.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="mb-4">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar
                            Automóvil:</label>
                            <select name="id_automovil" id="id_automovil" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" title="Selecciona un automóvil">
                                <option disabled selected>Selecciona un automovil...</option>
                                @foreach ($automoviles as $automovil)
                                    <option value="{{ $automovil->id_automovil }}" >
                                        {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_automovil')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="nombre">Nombre</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="nombre" value="{{ old('nombre') }}" id="nombre" placeholder="Ejemplo: Juan Pérez" title="Ingresa el nombre del titular">
                            <div id="NombreHelp" class="mt-1 text-sm text-red-600">
                                @error('nombre')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="num_tarjeta">Número de Tarjeta</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="num_tarjeta" value="{{ old('num_tarjeta') }}" id="num_tarjeta" placeholder="Ejemplo: 123456789" title="Ingresa el número de la tarjeta">
                            <div id="NumTarjetaHelp" class="mt-1 text-sm text-red-600">
                                @error('num_tarjeta')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="vehiculo_origen">Vehículo de Origen</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="vehiculo_origen" value="{{ old('vehiculo_origen') }}" id="vehiculo_origen" placeholder="Ejemplo: Puebla" title="Ingresa el vehículo de origen">
                            <div id="VehiculoOrigenHelp" class="mt-1 text-sm text-red-600">
                                @error('vehiculo_origen')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="fecha_expedicion">Fecha de Expedición</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="date" name="fecha_expedicion" value="{{ old('fecha_expedicion') }}" id="fecha_expedicion" title="Selecciona la fecha de expedición">
                            <div id="FechaExpedicionHelp" class="mt-1 text-sm text-red-600">
                                @error('fecha_expedicion')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="fecha_vigencia">Fecha de Vigencia</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="date" name="fecha_vigencia"  value="{{ old('fecha_vigencia') }}" id="fecha_vigencia" readonly title="La fecha de vigencia se calculará automáticamente">
                            <div id="FechaVigenciaHelp" class="mt-1 text-sm text-red-600">
                                @error('fecha_vigencia')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        {{-- foto --}}
                    <div class="pt-4 mb-6">
                        <h3 class="mb-5 block text-xl font-semibold text-[#07074D]">
                            Subir Imágenes
                        </h3>
                        <p class="text-sm text-gray-600">Máximo 5 imágenes</p>
                        <div class="flex flex-wrap gap-4 mt-4 pt-4 mb-6" id="imageContainer"></div>
                        <div class="mb-8">
                            <label for="fotografia_frontal"  id="addImageBtn"
                                class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                <div>
                                    <button type="button" name="fotografia_frontal[]" id="fotografia_frontal" accept="image/*"  class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                        Buscar
                                    </button>

                                </div>
                            </label>
                        </div>
                    </div>



                    </div>
                    <div class="flex justify-end mt-8 space-x-4">
                        <a href="{{ route('tarjetas.index') }}" class="px-5 py-3 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300" title="Cancelar el registro">Cancelar</button>
                        </a>
                        <button type="submit" title="Registrar tarjeta" class="px-5 py-3 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Registrar</button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<script>
   $(document).ready(function() {
        $('#fecha_expedicion').change(function() {      // verifica los cambios de fecha_expedicion

            const fechaExpedicionInput = $(this).val();     // obtiene los datos de fecha_expedicion

            if (fechaExpedicionInput) { // verifica que exista un afecha completa en el campo de fecha_expedicion

                const fechaExpedicion = new Date(fechaExpedicionInput);     // crea constante tipo arreglo de fecha_expedicion

                fechaExpedicion.setFullYear(fechaExpedicion.getFullYear() + 6);    // aumento al año en 6

                const year = fechaExpedicion.getFullYear();     // año
                const mont = String(fechaExpedicion.getMonth() + 1).padStart(2, '0');   // mes - padStar() corta el capo a dos caracteres
                const date = String(fechaExpedicion.getDate()).padStart(2, '0');    // dia - padStar() corta el capo a dos caracteres
                const fechaVigenciaFormateada = `${year}-${mont}-${date}`;  // concatena los datos de la fecha para fecha_vigencia

                // regresa la fecha_vigencia por id
                $('#fecha_vigencia').val(fechaVigenciaFormateada);
            }
        });
    });
</script>

<!-- Script de validación -->
    <script>
        $(document).ready(function() {
            let maxImages = 5;
            let currentImages = 0;
            const maxFileSize = 15 * 1024 * 1024;



            function createImageInput(capture = false) {
                const inputFile = $('<input>', {
                    type: 'file',
                    name: 'fotografia_frontal[]',
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
                    createImageInput(true);
                }
            });



           // createImageInput(); // Agregar un input por defecto
        });
    </script>

@endsection
