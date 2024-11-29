@extends('layouts.app') <!-- Extiende el layout principal -->

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
                    <!-- Tenencias/Refrendos -->
                    <li class="flex items-center">
                        <a href="{{route('tenencias.index')}}" title="Volver a la página de tenencias/refrendos" class="text-gray-800 hover:text-gray-800">
                            Tenencias-Refrendos
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Tenencias/Refrendos -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Registrar Nueva Tenencia o Refrendo
                        </p>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="mt-8">
        <div class="mt-4">
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-2xl font-bold">Alta de Tenencias/Refrendo</h2>

                <form action="{{ route('tenencias.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div class="mb-4">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar Automóvil:</label>                          
                            <select name="id_automovil" id="id_automovil" title="Selecciona un automóvil disponible" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach ($automoviles as $automovil)
                                <option value="{{ $automovil->id_automovil }}" {{ (old('id_automovil') == $automovil->id_automovil) ? 'selected' : '' }}>
                                    {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                </option>
                                @endforeach
                            </select>
                            @error('id_automovil')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    
                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="fecha_pago">Fecha de Pago</label>
                            <input title="Ingresa la fecha de pago de la tenencia" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="date" name="fecha_pago" value="{{ old('fecha_pago') }}" id="fecha_pago">
                            <div class="mt-1 text-sm text-red-600">
                                @error('fecha_pago')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="origen">Vehículo Origen</label>
                            <input title="Indica el lugar de origen del vehículo" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="text" name="origen" value="{{ old('origen') }}" id="origen">
                            <div class="mt-1 text-sm text-red-600">
                                @error('origen')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="monto">Monto</label>
                            <input title="Introduce el monto pagado" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="text" name="monto" value="{{ old('monto') }}" id="monto">
                            <div class="mt-1 text-sm text-red-600">
                                @error('monto')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="año_correspondiente">Año correspondiente</label>
                            <input title="Indica el año correspondiente al pago de la tenencia" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="text" name="año_correspondiente" value="{{ old('año_correspondiente') }}" id="año_correspondiente">
                            <div class="mt-1 text-sm text-red-600">
                                @error('año_correspondiente')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="comprobante">Comprobante</label>
                            <input title="Sube el comprobante del pago en formato de imagen" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="file" name="comprobante" id="comprobante" accept="image/*">
                            <div class="mt-1 text-sm text-red-600">
                                @error('comprobante')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="observaciones">Observaciones</label>
                            <input title="Ingresa cualquier observación adicional sobre el pago" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="text" name="observaciones" value="{{ old('observaciones') }}" id="observaciones">
                            <div class="mt-1 text-sm text-red-600">
                                @error('observaciones')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700"
                        title="Guardar los datos de la tenencia">Guardar</button>
                        <a href="{{ route('tenencias.index') }}" title="Cancelar el registro">
                            <button type="button" class="px-6 py-2 ml-2 font-semibold bg-gray-200 rounded-md hover:bg-red-200 focus:outline-none focus:bg-red-700">Cancelar</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

