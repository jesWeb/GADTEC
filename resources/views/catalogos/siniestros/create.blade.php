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
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <a href="{{route('siniestros.index')}}" title="Volver a la página de siniestros" class="text-gray-800 hover:text-gray-800">
                            Siniestros
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Registrar Nuevo Siniestro
                        </p>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- título --}}
            <h2 class="mb-5 text-xl font-semibold text-gray-700">Registro de Siniestros</h2>
            {{-- formulario --}}
            <form action="{{ route('siniestros.store') }}" method="POST">
                {{-- Token CSRF --}}
                @csrf
                <div class="m-3 xl:p-10">
                    {{-- 1ª fila de información --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row">
                        {{-- Vehículo --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar Automóvil:</label>
                            <select 
                                name="id_automovil" 
                                id="id_automovil" 
                                title="Selecciona el automóvil involucrado en el siniestro"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option selected>Selecciona una opción...</option>
                                @foreach ($automoviles as $automovil)
                                    <option value="{{ $automovil->id_automovil }}">
                                        {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Fecha de siniestro --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="fecha_siniestro">Fecha del Siniestro</label>
                            <input
                                type="date" 
                                name="fecha_siniestro" 
                                title="Selecciona la fecha en la que ocurrió el siniestro"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required>
                        </div>

                        {{-- Responsable --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="id_usuario">Responsable</label>
                            <select 
                                name="id_usuario" 
                                title="Selecciona el usuario responsable del siniestro"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required>
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id_usuario }}">
                                        {{ $usuario->nombre }} {{ $usuario->app }} {{ $usuario->apm }} - {{ $usuario->empresa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 2ª fila de información --}}
                    <div class="flex flex-col gap-5.5 mt-5 xl:flex-row">
                        {{-- Costo daños estimados --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="costo_danos_estimados">Costo de Daños Estimados</label>
                            <input 
                                type="text" 
                                name="costo_danos_estimados" 
                                title="Introduce el costo estimado de los daños en pesos"
                                placeholder="Ejemplo: 15000" 
                                pattern="^\d*([,.]?\d+)?$" 
                                min="0" 
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required>
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mt-6">
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="descripcion">Descripción del Siniestro</label>
                            <textarea 
                                name="descripcion" 
                                title="Escribe una descripción breve y clara del siniestro"
                                placeholder="Ejemplo: Colisión con otro vehículo en carretera"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                required></textarea>
                        </div>
                    </div>

                    {{-- Observaciones --}}
                    <div class="mt-5">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="observaciones">Observaciones Adicionales</label>
                        <textarea 
                            name="observaciones" 
                            title="Agrega observaciones adicionales si es necesario"
                            placeholder="Ejemplo: Ningún pasajero resultó herido"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
                    </div>
                </div>

                {{-- Botones --}}
                <div class="flex justify-end gap-4 mt-4">
                    <a href="{{ route('siniestros.index') }}" title="Cancelar registro"
                       class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancelar
                    </a>
                    <button type="submit" title="Registrar siniestro"
                            class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Registrar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
