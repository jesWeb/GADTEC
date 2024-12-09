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
                            Actualizar Tenencia o Refrendo
                        </p>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="mt-8">
        <div class="mt-4">
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-2xl font-bold">Actualizar Tenencia/Refrendo</h2>
                <form action="{{ route('tenencias.update', $tenencia->id_tenencia) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                    
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div class="mb-4">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar Automóvil:</label>                                                  <select name="id_automovil" id="id_automovil" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" title="Actualizar automóvil">
                                    @foreach ($automoviles as $automovil)
                                        <option value="{{ $automovil->id_automovil }}" {{ (old('id_automovil', $tenencia->id_automovil) == $automovil->id_automovil) ? 'selected' : '' }}>
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
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="date" name="fecha_pago" value="{{ old('fecha_pago', $tenencia->fecha_pago) }}" id="fecha_pago" placeholder="Ejemplo: Juan Pérez" title="Actualizar fecha de pago">
                            <div id="NombreHelp" class="mt-1 text-sm text-red-600">
                                @error('fecha_pago')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="origen">Vehículo Origen</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="text" name="origen" value="{{ old('origen', $tenencia->origen) }}" id="origen" placeholder="Ejemplo: 123456789" title="Actualizar vehículo origen">
                            <div id="NumTarjetaHelp" class="mt-1 text-sm text-red-600">
                                @error('origen')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="monto">Monto</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="text" name="monto" value="{{ old('monto', $tenencia->monto) }}" id="monto" placeholder="Ejemplo: 1000" title="Actualizar monto">
                            <div id="VehiculoOrigenHelp" class="mt-1 text-sm text-red-600">
                                @error('monto')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="año_correspondiente">Año correspondiente</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="text" name="año_correspondiente" value="{{ old('año_correspondiente', $tenencia->año_correspondiente) }}" id="año_correspondiente" title="Actualizar año correspondiente">
                            <div id="FechaExpedicionHelp" class="mt-1 text-sm text-red-600">
                                @error('año_correspondiente')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="estatus">Estatus</label>
                            <select class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" name="estatus" id="estatus" title="Actualizar estatus">
                                <option selected>Selecciona una opción...</option>
                                <option value="Vigente" {{ $tenencia->estatus == 'Vigente' ? 'selected' : '' }}>Vigente</option>
                                <option value="Expirada" {{ $tenencia->estatus == 'Expirada' ? 'selected' : '' }}>Expirada</option>
                                <option value="Suspendida" {{ $tenencia->estatus == 'Suspendida' ? 'selected' : '' }}>Suspendida</option>
                            </select>
                            <div id="EstatusHelp" class="mt-1 text-sm text-red-600">
                                @error('estatus')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="observaciones">Observaciones</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="text" name="observaciones" value="{{ old('observaciones', $tenencia->observaciones) }}" id="observaciones" title="Actualizar observaciones">
                            <div id="ObservacionesHelp" class="mt-1 text-sm text-red-600">
                                @error('observaciones')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            @if ($tenencia->comprobante)
                                <img src="{{ url('img/tenencias/' . $tenencia->comprobante) }}" alt="Comprobante" class="object-cover w-16 h-16 rounded-md">
                                <a href="{{ url('img/tenencias/' . $tenencia->comprobante) }}" target="_blank" class="text-gray-500">Ver comprobante</a> 
                            @else
                                <p class="mt-2 text-sm text-gray-500">No hay comprobante cargado.</p>
                            @endif
                        </div>
                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="comprobante">Comprobante</label>
                                <div class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] mt-4 p-6 text-center">
                                <input class="sr-only" type="file" name="comprobante" id="comprobante"accept="image/*" title="Sube el comprobante del pago en formato de imagen" />
                                <label for="comprobante" class="cursor-pointer">
                                    <div class="flex flex-col items-center">
                                        <span title="Actualizar comprobante"
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
                            <div class="mt-1 text-sm text-red-600">
                                @error('comprobante')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>
                        <script>
                            const fileInput = document.getElementById('comprobante');
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
                    <div class="flex justify-end mt-6">
                        <button type="submit"class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700"
                        title="Actualizar Tenencia">Guardar</button>
                        <a href="{{ route('tenencias.index') }}" title="Cancelar la edición">
                            <button type="button" class="px-6 py-2 ml-2 font-semibold bg-gray-200 rounded-md hover:bg-red-200 focus:outline-none focus:bg-red-700">Cancelar</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
