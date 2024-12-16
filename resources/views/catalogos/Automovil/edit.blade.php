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
                        <a href="{{ route('Automovil.index') }}" title="Volver a la página de automoviles"
                            class="text-gray-800 hover:text-gray-800">
                            Automóviles
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <p class="text-gray-800 hover:text-gray-800">
                            Actualizar Automóvil
                        </p>
                    </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="mt-4">
            <div class="p-6 bg-white rounded-md shadow-md">
                <h2 class="text-xl font-semibold text-gray-700">Editar Automovil </h2>
                {{--  --}}
                <form id="imageForm" action="{{ route('Automovil.update', $EddCar->id_automovil) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="m-3 xl:p-10">
                        {{-- 1st row of info --}}
                        <div class="flex flex-col gap-5.5 xl:flex-row mb-3">
                            {{-- Marca --}}
                            <div class="w-full px-3 xl:w-1/2">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]"
                                        for="marca">Marca</label>
                                    <input type="text" name="marca" value="{{ $EddCar->marca }}"
                                        title="Actualizar la marca del automóvil" placeholder="Ingresa la marca"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                </div>
                            </div>
                            {{-- Submarca --}}
                            <div class="w-full px-3 xl:w-1/2">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]"
                                        for="submarca">Submarca</label>
                                    <input type="text" name="submarca" id="submarca" value="{{ $EddCar->submarca }}"
                                        placeholder="Ingresa la submarca" title="Actualizar la submarca del automóvil"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        </div>
                                </div>
                            </div> {{-- Modelo --}} <div class="w-full px-3 xl:w-1/2">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]"
                                        for="modelo">Modelo</label>
                                    <input type="number" name="modelo" id="modelo" placeholder="Ingresa el año"
                                        title="Actualizar el modelo del automóvil"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        value="{{ old('modelo', $EddCar->modelo) }}" </div>
                                </div>
                            </div>
                        </div>
                        {{-- 2nd row of info --}}
                        <div class="flex flex-col gap-5.5 xl:flex-row mb-5">
                            {{-- No.serie --}}
                            <div class="w-full px-3 xl:w-1/2">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]" for="num_serie">No.
                                        Serie</label>
                                    <input type="text" name="num_serie" id="serie"
                                        title="Actualizar el número de serie del automóvil"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        value="{{ old('num_serie', $EddCar->num_serie) }}">
                                </div>
                            </div>
                            {{-- No.Motor --}}
                            <div class="w-full px-3 xl:w-1/2">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]" for="num_motor">No.
                                        Motor</label>
                                    <input type="text" name="num_motor" id="motor"
                                        title="Actualizar el número de motor del automóvil"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        value="{{ old('num_motor', $EddCar->num_motor) }}">
                                </div>
                            </div>
                            {{-- Num_NSI --}}
                            <div class="w-full px-3 xl:w-1/2">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]"
                                        for="num_nsi">NSI/Repube</label>
                                    <input type="text" name="num_nsi" title="Actualizar el número de NSI o Repube"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        value="{{ old('NSI', $EddCar->num_nsi) }}">
                                </div>
                            </div>
                        </div>
                        <div class="px-3 py-3 border-b border-stroke dark:border-strokedark"></div>
                        {{-- tercera --}}
                        <div class="flex flex-col gap-5.5 xl:flex-row mt-4  mb-4">
                            {{-- Kilometraje --}}
                            <div class="w-full px-3 xl:w-1/2">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]"
                                        for="kilometraje">Kilometraje</label>
                                    <input
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        type="number" value="{{ old('kilometraje', $EddCar->kilometraje) }}"
                                        pattern="^\d*\.?\d+$" min="0" step="0.01" name="kilometraje"
                                        title="Actualizar el kilometraje del vehículo">
                                </div>

                            </div>
                            {{-- Capacidad --}}
                            <div class="w-full px-3 xl:w-1/2">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]"
                                        for="capacidad_combustible">Capacidad de combustible</label>
                                    <input
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        type="number" name="capacidad_combustible" min="0" step="0.01"
                                        value="{{ old('capacidad_combustible', $EddCar->capacidad_combustible) }}"
                                        placeholder="10.00" title="Actualizar la capacidad de combustible en litros">
                                </div>
                            </div>
                            {{-- Tcombustible --}}
                            <div class="w-full px-3 xl:w-1/2">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]" for="tipo_combustible">
                                        Tipo de combustible</label>
                                    <select name="tipo_combustible" title="Actualizar el tipo de combustible del vehículo"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                        <option value="Gasolina" {{ old('tipo_combustible') == 'Gasolina' ? 'selected' : '' }}>
                                            Gasolina
                                        </option>
                                        <option value="Diésel" {{ old('tipo_combustible') == 'Diésel' ? 'selected' : '' }}>
                                            Diésel
                                        </option>
                                        <option value="Eléctrico" {{ old('tipo_combustible') == 'Eléctrico' ? 'selected' : '' }}>
                                            Diésel
                                        </option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- 3 row --}}
                        <div class="flex flex-col gap-5.5 xl:flex-row mb-3">
                            {{-- color --}}
                            <div class="w-full px-3 xl:w-1/2">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]"
                                        for="color">Color</label>
                                    <input
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        type="text" name="color" value="{{ old('color', $EddCar->color) }}"
                                        title="Actualizar el color del automóvil">
                                </div>
                            </div>
                            {{-- No.Puertas --}}
                            <div class="w-full px-3 xl:w-1/2">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]"
                                        for="num_puertas">Numero de
                                        Puertas</label>
                                    <input
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        type="text" name="num_puertas"
                                        title="Actualizar el número de puertas del automóvil"
                                        value="{{ old('num_puertas', $EddCar->num_puertas) }}">
                                </div>
                            </div>
                            {{-- Utilidad --}}
                            <div class="w-full px-3 xl:w-1/2">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]" for="estatus">
                                        Condiciones
                                    </label>
                                    <select name="estatus" title="Actualizar las condiciones del automóvil"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">

                                        <option value="Nuevo"
                                            {{ old('estatus', $EddCar->estatus) == 'Nuevo' ? 'selected' : '' }}>
                                            Nuevo
                                        </option>
                                        <option value="Usado"
                                            {{ old('estatus', $EddCar->estatus) == 'Usado' ? 'selected' : '' }}>
                                            Usado

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="px-2 py-2 border-b border-stroke dark:border-strokedark"></div>
                        <div class="flex flex-col gap-5.5 xl:flex-row xl:m-5 xl:mt-4 ">
                            {{-- Placas --}}
                            <div class="w-full px-3 xl:w-2/4">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]"
                                        for="placas">Placas</label>
                                    <input
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        type="text" value="{{ old('placas', $EddCar->placas) }}" name="placas"
                                        title="Actualizar las placas del automóvil">
                                </div>

                            </div>
                            {{-- fecha ingreso --}}
                            <div class="w-full px-3 xl:w-2/4">
                                <div class="mb-5">
                                    <label for="fecha_registro" class="mb-3 block text-base font-medium text-[#07074D]">
                                        Fecha de Ingreso
                                    </label>
                                    <input type="date" name="fecha_registro"
                                        title="Actualizar la fecha de ingreso del automóvil"
                                        value="{{ old('fecha_registro', $EddCar->fecha_registro) }}"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                </div>
                            </div>
                        </div>
                        {{-- 4 row info --}}
                        <div class="flex flex-col gap-5.5 xl:flex-row xl:m-5 xl:mt-4 ">
                            {{-- tipo Auto --}}
                            <div class="w-full px-3 xl:w-2/4">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]" for="tipo_automovil">
                                        Tipo
                                        de
                                        Automovil</label>
                                    <select name="tipo_automovil" title="Actualizar el tipo de automóvil"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        required>

                                        <option value="Automovil"
                                            {{ old('tipo_automovil') == 'Automovil' ? 'selected' : '' }}>
                                            Automóvil
                                        </option>
                                        <option value="Camioneta"
                                            {{ old('tipo_automovil') == 'Camioneta' ? 'selected' : '' }}>
                                            Camioneta
                                        </option>
                                        <option value="Motocicleta"
                                            {{ old('tipo_automovil') == 'Motocicleta' ? 'selected' : '' }}>
                                            Motocicleta
                                        </option>
                                    </select>
                                </div>
                            </div>
                            {{-- uso --}}
                            <div class="w-full px-3 xl:w-2/4">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]" for="uso">
                                        Uso</label>
                                    <select name="uso" title="Actualizar el uso del automóvil"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                        <option value="Personal" {{ old('uso') == 'Personal' ? 'selected' : '' }}>
                                            Personal
                                        </option>
                                        <option value="Empresarial" {{ old('uso') == 'Empresarial' ? 'selected' : '' }}>
                                            Empresarial
                                        </option>
                                    </select>
                                </div>
                            </div>
                            {{-- responsable --}}
                            <div class="w-full px-3 xl:w-2/4">
                                <div class="xl:mb-5">
                                    <label class="mb-3 block text-base font-medium text-[#07074D]"
                                        for="responsable">Responsable</label>
                                    <input type="text" name="responsable"
                                        title="Actualizar el responsable del automóvil"
                                        value="{{ old('responsable', $EddCar->responsable) }}"
                                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                        required placeholder="Ingresa el nombre del responsable" />
                                </div>

                            </div>
                        </div>
                        {{-- Observacines  --}}
                        <div class="w-full xl:m-5 xl:w-2/4 xl:mt-4 xl:mb-4">
                            <label class="mb-3 block text-base font-medium text-[#07074D]"
                                for="observaciones">Observaciones del Vehiculo</label>
                            <textarea placeholder="Observaciones ..." title="Actualizar las observaciones del automóvil"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                name="observaciones" value="{{ $EddCar->Observaciones }}">

                            </textarea>
                        </div>

                        <div class="mb-2">
                            <h4 
                            class="p-4 text-lg font-semibold text-center text-gray-700">Imagenes de Automovil</h4>
                            @if($EddCar->fotografias != '') 
                                <div class="flex gap-4 p-4 ml-4 overflow-x-auto">
                                    @php
                                        $fotografias = json_decode($EddCar->fotografias, true);
                                    @endphp

                                    @if ($fotografias)
                                        @foreach ($fotografias as $foto)
                                            <img src="{{ url('img/automoviles/' . $foto) }}" class="w-16 h-auto transition-transform duration-300 transform rounded-lg shadow-md hover:scale-90 hover:shadow-lg" alt="seguro">
                                            <a href="{{ url('img/automoviles/' . $foto) }}" target="_blank" class="text-gray-500" title="Ver archivo de de tarjeta">Ver imagen</a> 
                                        @endforeach
                                    @endif
                                </div>
                            @else
                                <p class="text-gray-500">Sin imagenes</p>
                            @endif
                        </div>

                        {{-- foto --}}
                        <div class="pt-4 mb-6">
                            <h3 class="mb-2 block text-xl font-semibold text-[#07074D]">
                                Subir Imágenes
                            </h3>
                            <p class="text-sm text-gray-600">Máximo 5 imágenes</p>
                            <div class="flex flex-wrap gap-4 mt-4 pt-4 mb-6" id="imageContainer"></div>
                            <input type="file" name="fotografias[]" id="fotografias" accept="image/*" class="sr-only" multiple />
                            <div class="mb-8">
                                <label for="image"  id="addImageBtn"
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

                        {{-- BTN --}}
                        <div class="flex justify-end mt-6 space-x-4">
                            <a href="{{ route('Automovil.index') }}" title="Cancelar edición"
                                class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                            <button type="submit" title="Actualizar automóvil"
                                class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Actualizar</button>
                        </div>
                    </div>
                </form>
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
                    name: 'fotografias[]',
                    accept: 'image/jpeg,image/png',
                    class: 'hidden',

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
                            alert('El archivo supera el tamaño máximo permitido de 10 MB.');
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
