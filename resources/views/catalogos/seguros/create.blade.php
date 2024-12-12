@extends('layouts.app')

@section('body')
 <!-- Librería requerida para validacion del tamaño de la img, está dentro de public -->
 <script type="text/javascript" src="{{ url('js/jquery-3.7.1.min.js') }}"></script>
    <div class="px-6 py-2">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <div class="flex items-center space-x-4">
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
                            Gestión
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Catálogos -->
                    <li class="flex items-center">
                        <a href="{{ $backRoute ?? route('catalogos.index') }}" title="Volver a Catálogos"
                            class="text-gray-800 hover:text-gray-800">
                            Catálogos
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <a href="{{ route('seguros.index') }}" title="Volver a la página de seguros"
                            class="text-gray-800 hover:text-gray-800">
                            Seguros
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <p class="text-gray-800 hover:text-gray-800">
                            Registrar Nuevo Seguro
                        </p>
                    </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- Titulo --}}
            <h2 class="mb-5 text-xl font-semibold text-gray-700">Registro de Seguros</h2>
            {{-- formulario --}}
            <form id="imageForm" action="{{ route('seguros.store') }}" enctype="multipart/form-data" method="POST">
                {{-- este es un toquen crea una proteccion en el formulario csrf tipo segridad --}}
                @csrf

                <div class="m-3 xl:p-10">
                    {{-- 1ra fila --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-5">
                        {{-- Automóvil --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar
                                Automóvil:</label>
                            <select name="id_automovil" id="id_automovil" title="Seleccionar automóvil"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option selected>Selecciona una opción...</option>
                                @foreach ($automoviles as $automovil)
                                    <option value="{{ $automovil->id_automovil }}">
                                        {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Aseguradora --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]"
                                for="aseguradora">Aseguradora</label>
                            <input value="{{ old('aseguradora') }}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="aseguradora" placeholder="Nombre de la aseguradora"
                                title="Ingresa el nombre de la aseguradora" required>
                        </div>
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="cobertura">Cobertura</label>
                            <input value="{{ old('cobertura') }}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="cobertura" placeholder="Ingresa la cobertura"
                                title="Ingresa la cobertura del seguro" required>
                        </div>
                    </div>
                    <div class="px-3 py-3 border-b border-stroke dark:border-strokedark"></div>
                    {{-- 2da fila --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mt-4">
                        {{-- Fecha de vigencia --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="fecha_vigencia">Fecha de
                                Vigencia del seguro</label>
                            <input type="date" name="fecha_vigencia" value="{{ old('fecha_vigencia') }}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required />
                        </div>
                        {{-- Monto --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="monto">Monto
                                Asegurado</label>
                            <input value="{{ old('monto') }}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                name="monto" min="0" step="0.01" type="number" placeholder="$0.00 MXN"
                                title="Ingresa el monto asegurado" required>
                        </div>

                    </div>
                    <div class="px-3 py-3 mt-3 border-b border-stroke dark:border-strokedark"></div>

                    {{-- foto --}}
                    <div class="pt-4 mb-6">
                        <h3 class="mb-5 block text-xl font-semibold text-[#07074D]">
                            Subir Imágenes
                        </h3>
                        <p class="text-sm text-gray-600">Máximo 5 imágenes</p>
                        <div class="flex flex-wrap gap-4 mt-4 pt-4 mb-6" id="imageContainer"></div>
                        <input type="file" name="poliza[]" id="poliza" accept="image/*" class="sr-only" />
                        <div class="mb-8">
                            <label for="poliza"  id="addImageBtn"
                                class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                <div>
                                    <span 
                                        class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                        Buscar
                                    </span>
                                    
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    



                </div>


               

                {{-- Botones --}}
                <div class="flex justify-end gap-4 mt-4">
                    <a href="{{ route('seguros.index') }}" title="Cancelar registro"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300"
                        title="Cancelar registro">Cancelar</a>
                    <button type="submit" title="Registrar seguro"
                        class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        title="Registrar seguro">Registrar</button>
                </div>

            </form>
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
                    name: 'poliza[]',
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

            

            createImageInput(); // Agregar un input por defecto
        });
    </script>
@endsection


   