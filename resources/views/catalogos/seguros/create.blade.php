@extends('layouts.app')

@section('body')
<div class="flex flex-col gap-9">

    <div class="p-6 bg-white border rounded-md shadow-md">
        {{-- titulo --}}
        <h2 class="mb-5 text-xl font-semibold text-gray-700">Registro de Seguros</h2>
        {{-- formulario --}}
        <form action="{{ route('seguros.store') }}" method="POST">
            {{-- este es un toquen crea una proteccion en el formulario csrf tipo segridad --}}
            @csrf

            <div class="m-3 xl:p-10">
                {{-- 1ra row --}}
                <div class="flex flex-col gap-5.5 xl:flex-row mb-5">
                    {{-- Automóvil --}}
                    <div class="w-full px-3 xl:w-1/2">
                        <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar
                            Automóvil:</label>
                        <select name="id_automovil" id="id_automovil"
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
                        <input
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            type="text" name="aseguradora" placeholder="Nombre de la aseguradora" required>
                    </div>
                    <div class="w-full px-3 xl:w-1/2">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="cobertura">Cobertura</label>
                        <input
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            type="text" name="cobertura" placeholder="Ingresa la cobertura" required>
                    </div>
                </div>
                <div class="px-3 py-3 border-b border-stroke dark:border-strokedark"></div>
                {{-- 2da row --}}
                <div class="flex flex-col gap-5.5 xl:flex-row mt-4">
                    {{-- Fecha de vigencia --}}
                    <div class="w-full px-3 xl:w-1/2">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="fecha_vigencia">Fecha de
                            Vigencia del seguro</label>
                        <input type="date" name="fecha_vigencia"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            required />
                    </div>
                    {{-- Monto --}}
                    <div class="w-full px-3 xl:w-1/2">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="monto">Monto
                            Asegurado</label>
                        <input
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            name="monto" min="0" step="0.01" type="number" placeholder="$0.00 MXN" required>
                    </div>
                    {{-- Estatus --}}
                    <div class="w-full px-3 xl:w-1/2">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="estatus">Estatus</label>
                        <select name="estatus"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            required>
                            <option disabled selected>Selecciona una opción</option>
                            <option value="Activo">Activo</option>
                            <option value="Suspensdido">Suspensdido</option>
                            <option value="Baja">Baja</option>
                        </select>
                    </div>
                </div>
                <div class="px-3 py-3 mt-3 border-b border-stroke dark:border-strokedark"></div>
                {{-- foto --}}
                <div class="pt-4 mb-6">
                    <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                        Subir Archivos
                    </label>
                    <div class="mb-8">
                        <input type="file" name="poliza" id="fotografias" class="sr-only" multiple />
                        <label for="poliza"
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

            </div>

            <script>
                const fileInput = document.getElementById('fotografias');
                const fileCountDisplay = document.getElementById('file-count');
                const fileNamesDisplay = document.getElementById('file-names');

                fileInput.addEventListener('change', function () {
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
                <a href="{{ route('seguros.index') }}"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                <button type="submit"
                    class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Registrar</button>
            </div>

        </form>
    </div>
</div>
@endsection
