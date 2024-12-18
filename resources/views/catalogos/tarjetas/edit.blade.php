@extends('layouts.app') <!-- Extiende el layout principal -->

@section('body')
<!-- Librería requerida para el formulario dinámico, está dentro de public -->
<script type="text/javascript" src="{{ url('js/jquery-3.7.1.min.js') }}"></script>
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
                            Actualizar Tarjeta de Circulación
                        </p>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="mt-8">
        <div class="mt-4">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h2 class="mb-4 text-2xl font-bold">Actualizar Tarjeta de Circulación</h2>

                <form id="imageForm" action="{{ route('tarjetas.update', $tarjeta->id_tarjeta) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <!-- Campo para seleccionar el automóvil -->
                        <div class="mb-4">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar Automóvil:</label>
                            <select disabled name="id_automovil" id="id_automovil" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            title="Actualizar el automóvil asociado">
                                @foreach ($automoviles as $automovil)
                                    <option value="{{ $automovil->id_automovil }}" {{ (old('id_automovil', $tarjeta->id_automovil) == $automovil->id_automovil) ? 'selected' : '' }}>
                                        {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_automovil')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo para el nombre -->
                        <div class="mb-4">
                            <label for="nombre" class="mb-3 block text-base font-medium text-[#07074D]">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            value="{{ old('nombre', $tarjeta->nombre) }}" required title="Actualizar el nombre del propietario de la tarjeta">
                            @error('nombre')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo para el número de tarjeta -->
                        <div class="mb-4">
                            <label for="num_tarjeta" class="mb-3 block text-base font-medium text-[#07074D]">Número de Tarjeta:</label>
                            <input type="text" name="num_tarjeta" id="num_tarjeta" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            value="{{ old('num_tarjeta', $tarjeta->num_tarjeta) }}" required title="Actualizar el número de tarjeta">
                            @error('num_tarjeta')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo para el vehículo origen -->
                        <div class="mb-4">
                            <label for="vehiculo_origen" class="mb-3 block text-base font-medium text-[#07074D]">Vehículo Origen:</label>
                            <input type="text" name="vehiculo_origen" id="vehiculo_origen" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            value="{{ old('vehiculo_origen', $tarjeta->vehiculo_origen) }}" required title="Actualizar el vehículo de origen">
                            @error('vehiculo_origen')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo para la fecha de expedición -->
                        <div class="mb-4">
                            <label for="fecha_expedicion" class="mb-3 block text-base font-medium text-[#07074D]">Fecha de Expedición:</label>
                            <input type="date" name="fecha_expedicion" id="fecha_expedicion" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            value="{{ old('fecha_expedicion', $tarjeta->fecha_expedicion) }}" required title="Actualizar la fecha de expedición de la tarjeta">
                            @error('fecha_expedicion')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo para la fecha de vigencia -->
                        <div class="mb-4">
                            <label for="fecha_vigencia" class="mb-3 block text-base font-medium text-[#07074D]">Fecha de Vigencia:</label>
                            <input type="date" name="fecha_vigencia" id="fecha_vigencia" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            value="{{ old('fecha_vigencia', $tarjeta->fecha_vigencia) }}" required title="Actualizar la fecha de vigencia de la tarjeta">
                            @error('fecha_vigencia')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Campo para el estatus -->
                        <div class="mb-4">
                            <label for="estatus" class="mb-3 block text-base font-medium text-[#07074D]">Estatus:</label>
                            <select name="estatus" id="estatus" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            title="Actualizar el estatus de la tarjeta">
                                <option value="Vigente" {{ (old('estatus', $tarjeta->estatus) == 'Vigente') ? 'selected' : '' }}>Vigente</option>
                                <option value="Expirada" {{ (old('estatus', $tarjeta->estatus) == 'Expirada') ? 'selected' : '' }}>Expirada</option>
                                <option value="Suspendida" {{ (old('estatus', $tarjeta->estatus) == 'Suspendida') ? 'selected' : '' }}>Suspendida</option>
                            </select>
                            @error('estatus')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <h4
                            class="p-4 text-lg font-semibold text-center text-gray-700">Imagenes de tarjetas</h4>
                            @if($tarjeta->fotografia_frontal != '')
                                <div class="flex gap-4 p-4 ml-4 overflow-x-auto">
                                    @php
                                        $fotografias = json_decode($tarjeta->fotografia_frontal, true);
                                    @endphp

                                    @if ($fotografias)
                                        @foreach ($fotografias as $foto)
                                            <img src="{{ url('img/tarjetas/' . $foto) }}" class="w-16 h-auto transition-transform duration-300 transform rounded-lg shadow-md hover:scale-90 hover:shadow-lg" alt="seguro">
                                            <a href="{{ url('img/tarjetas/' . $foto) }}" target="_blank" class="text-gray-500" title="Ver archivo de de tarjeta">Ver imagen</a>
                                        @endforeach
                                    @endif
                                </div>
                            @else
                                <p class="text-gray-500">Sin imagenes</p>
                            @endif
                        </div>
                        <!-- Campo para subir fotografía frontal -->
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


                    <!-- Botones -->
                    <div class="flex justify-end mt-8 space-x-4">

                        <a href="{{ route('tarjetas.index') }}" title="Cancelar la edición" class="px-5 py-3 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</button>
                        </a>
                        <button type="submit" class="px-5 py-3 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        title="Actualizar Tarjeta">Guardar</button>
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



            //createImageInput(); // Agregar un input por defecto
        });
    </script>
@endsection
