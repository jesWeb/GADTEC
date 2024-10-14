@extends('layouts.app')


@section('body')
    <div class="mt-4">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-xl font-semibold text-gray-700">Editar Automovil </h2>
            {{--  --}}
            <form action="{{ route('Automovil.update',$automovil->id) }}" method="POST" enctype="multipart/form-data">
                {{-- este es un toquen crea una proteccion en el formulario csrf tipo segridad --}}
                @csrf
                @method('PATCH')
                <div class="m-3 xl:p-10">
                    {{-- 1 row de info --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-3">
                        {{-- Marca --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="marca">Marca</label>
                                <input type="text" name="marca" id="marca" placeholder="Ingresa la marca"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                            </div>
                        </div>

                        {{-- Submarca --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="submarca">Submarca</label>
                                <input type="text" name="submarca" id="submarca" placeholder="Ingresa la submarca"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                            </div>
                        </div>

                        {{-- Modelo --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="modelo">Modelo</label>
                                <input type="number" name="modelo" id="ano" placeholder="Ingresa el año"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    min="1900" max="2100" required>
                            </div>

                        </div>

                    </div>
                    {{-- 2 row info  --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-3">
                        {{-- No.serie --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="serie">No.Serie</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" name="serie" required>
                            </div>

                        </div>
                        {{-- No.Motor --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="motor">No.Motor</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" name="motor" required>
                            </div>
                        </div>
                        {{-- Combustible --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="combustible">Tipo de
                                    combustible</label>
                                <select name="combustible"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                                    <option disabled selected>Selecciona una opcion </option>
                                    <option value="Gasolina">Gasolina</option>
                                    <option value="Diesel">Diesel</option>
                                    <option value="Electrico">Electrico</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    {{-- 3 row nfo --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-5">
                        {{-- Kilometraje --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="kilometraje">Kilometraje</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="number" placeholder="Introduce el kilometraje" pattern="^\d*\.?\d+$"
                                    min="0" required name="kilometraje">
                            </div>

                        </div>
                        {{-- Placas --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="placas">Placas</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" placeholder="Introduce Placas" required name="placas">
                            </div>

                        </div>
                        {{-- Num_NSI --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="NSI">NSI/Repube</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" placeholder="Introduce NSI" name="NSI" required>
                            </div>

                        </div>
                    </div>
                    {{-- 4 row info --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row ">
                        {{-- uso --}}
                        <div class="w-full px-3 xl:w-1/4">
                            {{-- <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="uso">Tipo de uso</label>
                                <select name="uso"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                                    <option disabled selected>Selecciona una opción </option>
                                    <option value="ninguno">ninguno</option>
                                    <option value="comisiones">Comisiones</option>
                                    <option value="transporte">transporte</option>
                                </select>
                            </div> --}}
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="uso">Tipo de
                                    uso</label>
                                <input type="text" name="uso"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    placeholder="Ingresa el tipo de uso" required>
                            </div>
                        </div>
                        {{-- responsable --}}
                        <div class="w-full px-3 xl:w-1/4">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="responsable">Responsable</label>
                                <input type="text" name="responsable"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required placeholder="Ingresa el nombre del responsable" />
                            </div>

                        </div>
                    </div>
                    {{-- Observacines  --}}
                    <div class="w-full xl:m-5 xl:w-2/4 xl:mt-4 xl:mb-4">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="observaciones">Observaciones
                            del
                            vehiculo</label>
                        <textarea placeholder="Observaciones ..."
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            name="observaciones" id=""></textarea>
                    </div>
                    {{-- foto --}}
                    <div class="pt-4 mb-6">
                        <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                            Subir Archivos
                        </label>
                        <div class="mb-8">
                            <input type="file" name="image" id="image" class="sr-only" multiple />
                            <label for="image"
                                class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                <div>
                                    <span class="mb-2 block text-xl font-semibold text-[#07074D]">
                                        Drop files here
                                    </span>
                                    <span class="mb-2 block text-base font-medium text-[#6B7280]">
                                        Or
                                    </span>
                                    <span
                                        class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                        Browse
                                    </span>
                                    <div id="file-info" class="mt-4">
                                        <span id="file-count">0 archivos seleccionados..</span>
                                        <ul id="file-names" class="pl-5 list-disc"></ul>
                                    </div>
                                </div>

                            </label>
                        </div>
                    </div>

                </div>

                <script>
                    const fileInput = document.getElementById('image');
                    const fileCountDisplay = document.getElementById('file-count');
                    const fileNamesDisplay = document.getElementById('file-names');

                    fileInput.addEventListener('change', function() {
                        const files = fileInput.files;
                        const fileCount = files.length;
                        fileCountDisplay.textContent = `${fileCount} archivos seleccionados`;
                        fileNamesDisplay.innerHTML = '';

                        for (let i = 0; i < fileCount; i++) {
                            const listItem = document.createElement('li');
                            listItem.textContent = files[i].name; // Muestra el nombre del archivo
                            fileNamesDisplay.appendChild(listItem);
                        }
                    });
                </script>

                {{-- BTN --}}
                <div class="flex justify-end gap-4 mt-4">
                    {{-- <button type="button"
                            class="px-6 py-2 font-semibold bg-gray-200 rounded-md hover:bg-red-200 focus:outline-none focus:bg-red-700">
                            Cancelar
                        </button> --}}
                    <button type="submit"
                        class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Registrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
