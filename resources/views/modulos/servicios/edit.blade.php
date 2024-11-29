@extends('layouts.app') <!-- Extiende el layout principal -->

@section('body')
<div class="px-6 py-2">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <ul class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Ir a la gestión de vehículos" class="flex items-center text-gray-700 hover:text-gray-900">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                            Gestion
                        </a>
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Solicitudes  -->
                    <li class="flex items-center">
                        <a href="{{ route('servicios.index') }}" title="Volver a la página de servicios"  class="text-gray-800 hover:text-gray-800">
                            Servicios
                        </a>
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Servicios -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Actualizar Servicio
                        </p>
                    </li>
                </ul>
            </nav>
        </div>
    <div class="mt-8">
        <div class="mt-4">
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h2 class="text-lg font-semibold text-gray-700 capitalize">Edición de Servicio</h2>

                <form action="{{ route('servicios.update' , $servicio->id_servicio) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <!-- Selección de Automóvil -->
                        <div class="mb-4">
                            <label for="id_automovil" class="block text-sm font-medium text-gray-700">Seleccionar Automóvil:</label>
                            <select name="id_automovil" id="id_automovil" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" title="Selecciona el automóvil a actualizar">
                                @foreach ($automoviles as $automovil)
                                <option value="{{ $automovil->id_automovil }}" {{ (old('id_automovil') == $servicio->id_automovil) ? 'selected' : '' }}>
                                    {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                </option>
                                @endforeach
                            </select>
                            @error('id_automovil')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    
                        <!-- Tipo de Servicio -->
                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="tipo_servicio">Tipo de Servicio</label>
                            <select class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                name="tipo_servicio" id="tipo_servicio" title="Selecciona el tipo de servicio a actualizar">
                                <option selected>Selecciona una opción...</option>
                                <option value="Programado" {{ (old('tipo_servicio', $servicio->tipo_servicio) == 'Programado') ? 'selected' : '' }}>Programado</option>
                                <option value="No programado" {{ (old('tipo_servicio', $servicio->tipo_servicio) == 'No programado') ? 'selected' : '' }}>No programado</option>
                            </select>
                            <div id="tipo_servicioHelp" class="mt-1 text-sm text-red-600">
                                @error('tipo_servicio')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                       <!-- Estatus del Automóvil -->
                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="estatusIn">Estatus del Vehículo</label>
                            <select name="estatusIn" id="estatusIn" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" title="Selecciona el estatus del vehículo">
                                <option value="Disponible" {{ old('estatusIn', $servicio->automovil->estatusIn) == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="En servicio" {{ old('estatusIn', $servicio->automovil->estatusIn) == 'En servicio' ? 'selected' : '' }}>En servicio</option>
                                <option value="Mantenimiento" {{ old('estatusIn', $servicio->automovil->estatusIn) == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                <option value="No disponible" {{ old('estatusIn', $servicio->automovil->estatusIn) == 'No disponible' ? 'selected' : '' }}>No disponible</option>
                            </select>
                        </div>



                        <!-- Descripción -->
                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="descripcion">Descripción</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="text" name="descripcion" value="{{ old('descripcion', $servicio->descripcion) }}" id="descripcion" placeholder="Escribe una descripción del servicio" title="Actualiza la descripción del servicio">
                            <div id="NumTarjetaHelp" class="mt-1 text-sm text-red-600">
                                @error('descripcion')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <!-- Fecha de Servicio -->
                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="fecha_servicio">Fecha de Servicio</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="date" name="fecha_servicio" value="{{ old('fecha_servicio', $servicio->fecha_servicio) }}" id="fecha_servicio" title="Actualiza la fecha del servicio">
                            <div id="VehiculoOrigenHelp" class="mt-1 text-sm text-red-600">
                                @error('monto')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <!-- Fecha de Próximo Servicio -->
                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="prox_servicio">Fecha de Próximo Servicio</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="date" name="prox_servicio" value="{{ old('prox_servicio', $servicio->prox_servicio) }}" id="prox_servicio" title="Actualiza la fecha de próximo servicio">
                            <div id="prox_servicioHelp" class="mt-1 text-sm text-red-600">
                                @error('año_correspondiente')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <!-- Costo -->
                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="costo">Costo</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="text" name="costo" value="{{ old('costo', $servicio->costo) }}" id="costo" title="Actualiza el costo del servicio">
                            <div id="CostoHelp" class="mt-1 text-sm text-red-600">
                                @error('costo')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <!-- Lugar de Servicio -->
                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="lugar_servicio">Lugar de Servicio</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="text" name="lugar_servicio" id="lugar_servicio" value="{{ old('lugar_servicio', $servicio->lugar_servicio) }}" title="Actualiza el lugar de servicio">
                            <div id="FotografiaFrontalHelp" class="mt-1 text-sm text-red-600">
                                @error('lugar_servicio')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                       

                        <!-- Comprobante -->
                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="comprobante">Comprobante</label>
                            @if ($servicio->comprobante)
                                <img src="{{ asset('img/' . $servicio->comprobante) }}" alt="comprobante" class="object-cover w-32 h-32 mt-2 rounded-md">
                            @else
                                <p class="mt-2 text-sm text-gray-500">No hay comprobante cargado.</p>
                            @endif
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="file" name="comprobante" id="comprobante" accept="image/*" title="Actualiza el comprobante del servicio">
                            <div id="FotografiaFrontalHelp" class="mt-1 text-sm text-red-600">
                                @error('comprobante')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>
                    
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end mt-6 space-x-4">
                        <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" title="Guardar los cambios del servicio">Guardar</button>
                        <a href="{{ route('servicios.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300" title="Cancelar los cambios">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    // Al cargar la página, verificamos si el tipo de servicio es "Programado" o "No programado"
    window.onload = function() {
        // Obtenemos el valor del select "Tipo de Servicio"
        var tipoServicio = document.getElementById('tipo_servicio').value;

        // Obtenemos el campo de "Fecha de Próximo Servicio"
        var proxServicioField = document.getElementById('prox_servicio').parentElement;

        // Si el servicio es "Programado", mostramos el campo "Próximo Servicio"
        if (tipoServicio === 'Programado') {
            proxServicioField.style.display = 'block';
        } else {
            proxServicioField.style.display = 'none';
        }

        // Cuando el valor del select cambie, volvemos a ejecutar la misma lógica
        document.getElementById('tipo_servicio').onchange = function() {
            tipoServicio = this.value;
            if (tipoServicio === 'Programado') {
                proxServicioField.style.display = 'block';
            } else {
                proxServicioField.style.display = 'none';
            }
        };
    };
</script>
