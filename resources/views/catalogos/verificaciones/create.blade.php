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
                            Registrar Nueva Verificación
                        </p>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

        <div class="p-6 bg-white border rounded-md shadow-md">
            <div class="flex justify-between mb-3">
                <h2 class="mb-4 text-lg font-semibold text-gray-700 capitalize">Verificaciones vehiculares</h2>
                
            </div>
            {{-- formulario --}}
            <form action="{{ route('verificaciones.store') }}" enctype="multipart/form-data" method="POST">

                @csrf
                <div class="m-3 xl:p-10 xl:m-5">
                    {{-- 1 row info --}}
                    <div class="flex flex-col gap-5.5 mt-4 xl:flex-row">
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar
                                Automóvil:</label>
                            <select name="id_automovil" id="id_automovil"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach ($automoviles as $automovil)
                                    <option value="{{ $automovil->id_automovil }}">
                                        {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- engomado --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="engomado">Engomado</label>
                                <select name="engomado"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required title="Selecciona el engomado del automóvil">
                                    <option disabled selected>Selecciona una opción </option>
                                    <option value="Verde">Verde</option>
                                    <option value="Amarillo">Amarillo</option>
                                    <option value="Rojo">Rojo</option>
                                    <option value="Azul">Azul</option>
                                    <option value="Rosa">Rosa</option>
                                </select>
                            </div>
                        </div>
                        {{-- Holograma --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="holograma">Holograma</label>
                                <input type="text" name="holograma" title="Ingresa el holograma del automóvil"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    placeholder="Ingresa el holograma" required title="Ingrese el holograma del vehículo">
                            </div>
                        </div>
                    </div>
                    {{-- 2row info --}}
                    <div class="flex flex-col gap-5.5 mt-4 xl:flex-row">
                        {{-- fecha Verificacion --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label for="fechaV" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Fecha de Verificación
                                </label>
                                <input type="date" name="fechaV" id="fechaV"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    placeholder="Selecciona la fecha de verificación" title="Selecciona la fecha de la verificación" />
                            </div>
                        </div>

                        {{-- Próxima verificación --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="fechaP">Próxima
                                    Verificación</label>
                                <input
                                    class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" name="fechaP" id="fechaP" placeholder="Próxima verificación"
                                    readonly title="La fecha de próxima verificación se calculará automáticamente">
                            </div>
                        </div>

                    </div>
                    {{-- observaciones --}}
                    <div class="w-full xl:m-5 xl:w-2/4 xl:mt-4 xl:mb-4">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="observaciones">Observaciones
                            del
                            vehículo</label>
                        <textarea placeholder="Observaciones ..."
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            name="observaciones" id="" title="Escribe aquí cualquier observación adicional"></textarea>
                    </div>

                    {{-- foto --}}
                    <div class="pt-4 mb-6">
                        <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                            Subir Archivos
                        </label>
                        <div class="mb-8">
                            <input type="file" name="image" id="image" class="sr-only" multiple title="Sube el archivo o foto de la verifación"/>
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

                    <script>
                        document.getElementById('fechaV').addEventListener('change', function() {
                            const fechaUltima = new Date(this.value);

                            if (isNaN(fechaUltima)) {
                                console.error('La fecha ingresada es inválida');
                                return;
                            }

                            const ProximaFecha = new Date(fechaUltima);
                            ProximaFecha.setMonth(fechaUltima.getMonth() + 6);

                            document.getElementById('fechaP').value = ProximaFecha.toISOString().split('T')[0];
                        });

                        
                        
                    </script>

                    {{-- BTN --}}
                    <div class="flex justify-end gap-4 mt-4">
                        <a href="{{ route('verificaciones.index') }}" title="Cancelar registro"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                        <button type="submit" title="Registrar verificación"
                            class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Registrar</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
