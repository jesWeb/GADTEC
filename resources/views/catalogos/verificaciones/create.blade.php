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
            <form action="{{ route('verificaciones.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="m-3 xl:p-10 xl:m-5">

                    <!-- Mensajes de error -->
                    @if ($errors->any())
                        <div class="p-4 mb-5 text-red-700 bg-red-100 border-l-4 border-red-500">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Selección de automóvil -->
                    <div class="flex flex-col gap-5.5 mt-4 xl:flex-row">
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">
                                Seleccionar Automóvil:
                            </label>
                            <select name="id_automovil" id="id_automovil" required
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach ($automoviles as $automovil)
                                    <option value="{{ $automovil->id_automovil }}"
                                        {{ old('id_automovil') == $automovil->id_automovil ? 'selected' : '' }}>
                                        {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Engomado -->
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="engomado">
                                Engomado
                            </label>
                            <select name="engomado" id="engomado" required
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option disabled selected>Selecciona una opción</option>
                                @foreach (['Verde', 'Amarillo', 'Rosa', 'Rojo', 'Azul'] as $color)
                                    <option value="{{ $color }}" {{ old('engomado') == $color ? 'selected' : '' }}>
                                        {{ $color }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Holograma -->
                        <div class="w-full px-3 xl:w-1/2">
                            <label class=" block text-base font-medium text-[#07074D]" for="holograma">
                                Holograma
                            </label>
                            <input type="text" name="holograma" id="holograma" value="{{ old('holograma') }}"
                                class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                placeholder="Ingresa el Holograma" required>
                        </div>
                    </div>

                    <!-- Fechas -->
                    <div class="flex flex-col gap-5.5 mt-4 xl:flex-row">
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="fecha_verificacion" class="mb-3 block text-base font-medium text-[#07074D]">
                                Fecha de Verificación
                            </label>
                            <input type="date" name="fechaV" id="fechaV" value="{{ old('fechaV') }}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required>
                        </div>
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="block text-base font-medium text-[#07074D]" for="proxima_verificacion">Próxima
                                    Verificación</label>
                                <input
                                    class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" name="proxima_verificacion" id="fechaP" placeholder="Próxima verificación"
                                     value="{{ old('fechaP', $proximaFecha ?? '') }} "
                                    readonly>
                                </div>
                            </div>

                        </div>

                        <!-- Observaciones -->
                        <div class="w-full xl:m-5 xl:w-2/4 xl:mt-4 xl:mb-4">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="observaciones">
                                Observaciones del vehículo
                            </label>
                            <textarea name="observaciones" id="observaciones" placeholder="Observaciones..."
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">{{ old('observaciones') }}</textarea>
                        </div>
                        {{-- foto --}}
                    <div class="pt-4 mb-6">
                        <h3 class="mb-5 block text-xl font-semibold text-[#07074D]">
                            Subir Archivos
                        </h3>
                        <input type="file" name="image[]" id="fotografias" multiple />
                    </div>

                        <!-- Botones -->
                        <div class="flex justify-end gap-4 mt-4">
                            <a href="{{ route('verificaciones.index') }}"
                                class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Registrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
@endsection
