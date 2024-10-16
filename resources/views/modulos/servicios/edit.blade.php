@extends('layouts.app') <!-- Extiende el layout principal -->

@section('body')
<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">Editar de Servicio</h2>

            <form action="{{ url('servicios/' . $servicio->id_servicio) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div class="mb-4">
                        <label for="id_automovil" class="block text-sm font-medium text-gray-700">Seleccionar Automóvil:</label>
                        <select name="id_automovil" id="id_automovil" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                   

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="tipo_servicio">Tipo de Servicio</label>
                        <select class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                            name="tipo_servicio" id="tipo_servicio">
                            <option selected>Selecciona una opción...</option>
                            <option value="Programado" {{ (old('tipo_servicio', $servicio->tipo_servicio) == 'Programado') ? 'selected' : '' }}>Programado</option>
                            <option value="No programado" {{ (old('tipo_servicio', $servicio->tipo_servicio) == 'No programado') ? 'selected' : '' }}>No programado</option>
                        </select>
                        <div id="tipo_servicioHelp" class="mt-1 text-sm text-red-600">
                            @error('tipo_servicio')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="descripcion">Descripción</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="descripcion" value="{{ old('descripcion', $servicio->descripcion) }}" id="descripcion" placeholder="Escribe......">
                        <div id="NumTarjetaHelp" class="mt-1 text-sm text-red-600">
                            @error('descripcion')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="fecha_servicio">Fecha de Servicio</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="date" name="fecha_servicio" value="{{ old('fecha_servicio', $servicio->fecha_servicio) }}" id="fecha_servicio" placeholder="">
                        <div id="VehiculoOrigenHelp" class="mt-1 text-sm text-red-600">
                            @error('monto')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="prox_servicio">Fecha de Proximo de Servicio</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="date" name="prox_servicio" value="{{ old('prox_servicio', $servicio->prox_servicio) }}" id="prox_servicioe">
                        <div id="prox_servicioHelp" class="mt-1 text-sm text-red-600">
                            @error('año_correspondiente')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                
                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="costo">Costo</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="costo" value="{{ old('costo', $servicio->costo) }}" id="costo">
                        <div id="CostoHelp" class="mt-1 text-sm text-red-600">
                            @error('costo')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="lugar_servicio">Lugar de Servicio</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="lugar_servicio" id="lugar_servicio" value="{{ old('lugar_servicio', $servicio->lugar_servicio) }}" >
                        <div id="FotografiaFrontalHelp" class="mt-1 text-sm text-red-600">
                            @error('lugar_servicio')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>
                   
                </div>

                <div class="flex justify-end mt-6 space-x-4">
                    <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Guardar</button>
                    <a href="{{ url('servicios') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
