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
                    <!-- Verificaciones Vehiculares -->
                    <li class="flex items-center">
                        <a href="{{route('verificaciones.index')}}" title="Volver a la página de verificaciones" class="text-gray-800 hover:text-gray-800">
                            Verificaciones 
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Verificaciones Vehiculares -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Actualizar Verificación
                        </p>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- Titulo --}}
            <h2 class="mb-5 text-xl font-semibold text-gray-700">
                Actualizar Verificación
            </h2>
            {{-- Formulario --}}
            <form action="{{ route('verificaciones.update', $EddVer->id_verificacion) }}" method="post" enctype='multipart/form-data'>
                @csrf
                @method('PATCH')
                <div class="m-4 xl:p-10">
                    {{-- 1er row de información --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row">
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]" title="Selecciona un automóvil de la lista">Seleccionar Automóvil:</label>
                            <select name="id_automovil" id="id_automovil" disabled
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                title="El automóvil seleccionado está deshabilitado para edición">
                                <option value="" disabled {{ is_null($EddVer->id_automovil) ? 'selected' : '' }}>
                                    Selecciona una opción...</option>
                                @foreach ($automoviles as $automovil)
                                    <option value="{{ $automovil->id_automovil }}"
                                        {{ $automovil->id_automovil == $EddVer->id_automovil ? 'selected' : '' }}>
                                        {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Engomado --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="engomado" title="El engomado del vehículo">Engomado:</label>
                            <select name="engomado" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" disabled title="Este campo está deshabilitado para edición">
                                <option value="" disabled {{ is_null($EddVer->engomado) ? 'selected' : '' }}>
                                    Selecciona una opción</option>
                                <option value="amarillo" {{ $EddVer->engomado == 'amarillo' ? 'selected' : '' }}>Amarillo</option>
                                <option value="azul" {{ $EddVer->engomado == 'azul' ? 'selected' : '' }}>Azul</option>
                                <option value="rojo" {{ $EddVer->engomado == 'rojo' ? 'selected' : '' }}>Rojo</option>
                            </select>
                        </div>
                        {{-- Holograma --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="text-gray-700" for="holograma" title="Número de holograma del vehículo">Holograma:</label>
                            <input type="text" name="holograma" value="{{ $EddVer->holograma }}"
                                class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                placeholder="Introduce el holograma" title="Número del holograma del vehículo">
                        </div>
                    </div>
                    {{-- 2do row de información --}}
                    <div class="flex flex-col gap-5.5 mt-4 xl:flex-row">
                        {{-- Fecha de Verificación --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label for="fechaV" class="mb-3 block text-base font-medium text-[#07074D]" title="Fecha de la verificación realizada">Fecha de Verificación:</label>
                                <input type="date" name="fechaV" value="{{ $EddVer->fechaV }}" id="fechaV"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                    placeholder="Selecciona la fecha" title="Fecha de verificación realizada" />
                            </div>
                        </div>

                        {{-- Próxima Verificación --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="text-gray-700" for="fechaP" title="Fecha en la que debe realizarse la próxima verificación">Próxima Verificación:</label>
                            <input
                                class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="fechaP" value="{{ $EddVer->fechaP }}" placeholder="Próxima verificación" readonly title="Fecha estimada para la próxima verificación">
                        </div>
                    </div>
                    {{-- Observaciones --}}
                    <div class="w-full xl:m-5 xl:w-2/4 xl:mt-4 xl:mb-4">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="observaciones" title="Observaciones adicionales del vehículo">Observaciones del vehículo:</label>
                        <textarea placeholder="Observaciones ..."
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            name="observaciones" value="{{ $EddVer->observaciones }}" title="Escribe cualquier observación relevante sobre el vehículo">
                    </textarea>
                    </div>

                    {{-- Foto --}}
                    <div class="pt-4 mb-6">
                        <label class="mb-5 block text-xl font-semibold text-[#07074D]" title="Sube archivos relacionados con la verificación">
                            Subir Archivos
                        </label>
                        <div class="mb-8">
                            <input type="file" name="image" id="image" class="sr-only" multiple title="Selecciona uno o más archivos"/>
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

                    {{-- Botón --}}
                    <div class="flex justify-end gap-4 mt-4">
                        <button type="submit"
                            class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700" 
                            title="Registrar verificación">
                            Guardar
                        </button>
                        <a href="{{ route('verificaciones.index') }}" title="Cancelar la edición">
                        <button type="button" class="px-6 py-2 ml-2 font-semibold bg-gray-200 rounded-md hover:bg-red-200 focus:outline-none focus:bg-red-700">Cancelar</button>
                    </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
