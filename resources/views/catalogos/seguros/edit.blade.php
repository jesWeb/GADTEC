@extends('layouts.app')

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
                    <!-- Seguros -->
                    <li class="flex items-center">
                        <a href="{{route('seguros.index')}}" title="Volver a la página de seguros" class="text-gray-800 hover:text-gray-800">
                            Seguros
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Seguros -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Actualizar Seguro
                        </p>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- formulario --}}
            <form action="{{ route('seguros.update', $EddSeg->id_seguro) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="m-3 xl:p-10">
                    {{-- 1ra row --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row">
                        {{-- Automóvil --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar
                                Automóvil:</label>
                            <select name="id_automovil" id="id_automovil" disabled
                                title="Actualizar el automóvil"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option value="" disabled {{ is_null($EddSeg->id_automovil) ? 'selected' : '' }}>
                                    Selecciona una opción...</option>
                                @foreach ($automoviles as $automovil)
                                    <option value="{{ $automovil->id_automovil }}"
                                        {{ $automovil->id_automovil == $EddSeg->id_automovil ? 'selected' : '' }}>
                                        {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Aseguradora --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="aseguradora" class="mb-3 block text-base font-medium text-[#07074D]">Aseguradora</label>
                            <input
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="aseguradora" id="aseguradora" placeholder="Nombre de la aseguradora" required
                                value="{{ $EddSeg->aseguradora }}" title="Actualizar la aseguradora">
                        </div>
                        {{-- Cobertura --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="cobertura" class="mb-3 block text-base font-medium text-[#07074D]">Cobertura</label>
                            <input
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="cobertura" id="cobertura" placeholder="Ingresa la cobertura"
                                value="{{ $EddSeg->cobertura }}" title="Actualizar la cobertura">
                        </div>
                    </div>
                    <div class="px-3 py-3"></div>
                    {{-- 2da row --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mt-4">
                        {{-- Fecha de vigencia --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="fecha_vigencia" class="mb-3 block text-base font-medium text-[#07074D]">Fecha de
                                Vigencia del Seguro</label>
                            <input type="date" name="fecha_vigencia" id="fecha_vigencia"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                value="{{ $EddSeg->fecha_vigencia }}" title="Actualizar la fecha de vigencia">
                        </div>
                        {{-- Monto --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="monto" class="mb-3 block text-base font-medium text-[#07074D]">Monto Asegurado</label>
                            <input
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                value="{{ $EddSeg->monto }}" name="monto" id="monto" min="0" step="0.01" type="text"
                                title="Actualizar el monto asegurado">
                        </div>
                        {{-- Estatus --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="estatus" class="mb-3 block text-base font-medium text-[#07074D]">Estatus</label>
                            <select name="estatus" id="estatus"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                title="Actualizar el estatus">
                                <option disabled {{ $EddSeg->estatus ? '' : 'selected' }}>Selecciona una opción</option>
                                <option value="Activo" {{ $EddSeg->estatus === 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Suspendido" {{ $EddSeg->estatus === 'Suspendido' ? 'selected' : '' }}>Suspendido</option>
                                <option value="Baja" {{ $EddSeg->estatus === 'Baja' ? 'selected' : '' }}>Baja</option>
                            </select>
                        </div>
                    </div>
                    <div class="px-3 py-3 mt-3 border-b border-stroke dark:border-strokedark"></div>
                    {{-- Foto --}}
                    <div class="pt-4 mb-6">
                        <label for="poliza" class="mb-5 block text-xl font-semibold text-[#07074D]">
                            Subir Archivo Póliza
                        </label>
                        <div class="mb-8">
                            <input type="file" name="poliza" id="poliza" class="sr-only" multiple />
                            <label for="poliza" title="Actualizar el archivo de la póliza"
                                class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                <div>
                                    <span class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
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
                            const fileInput = document.getElementById('poliza');
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
                </div>
                {{-- BTN --}}
                <div class="flex justify-end mt-6 space-x-4">
                    <a href="{{ route('seguros.index') }}" title="Cancelar la actualización"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                    <button type="submit" title="Actualizar el seguro"
                        class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
