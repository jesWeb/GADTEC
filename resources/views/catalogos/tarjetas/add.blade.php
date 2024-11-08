@extends('layouts.app') <!-- Extiende el layout principal -->

@section('body')
<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">Alta de Tarjeta de Circulación</h2>

            <form action="{{ route('tarjetas.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div class="mb-4">
                    <label for="id_automovil" class="block text-sm font-medium text-gray-700">Seleccionar Automóvil:</label>
                    <select name="id_automovil" id="id_automovil" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @foreach ($automoviles as $automovil)
                            <option value="{{ $automovil->id_automovil }}" {{ (old('id_automovil', $automovil->id_automovil) == $automovil->id_automovil) ? 'selected' : '' }}>
                                {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_automovil')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="nombre">Nombre</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="nombre" value="{{ old('nombre') }}" id="nombre" placeholder="Ejemplo: Juan Pérez">
                        <div id="NombreHelp" class="mt-1 text-sm text-red-600">
                            @error('nombre')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="num_tarjeta">Número de Tarjeta</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="num_tarjeta" value="{{ old('num_tarjeta') }}" id="num_tarjeta" placeholder="Ejemplo: 123456789">
                        <div id="NumTarjetaHelp" class="mt-1 text-sm text-red-600">
                            @error('num_tarjeta')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="vehiculo_origen">Vehículo de Origen</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="vehiculo_origen" value="{{ old('vehiculo_origen') }}" id="vehiculo_origen" placeholder="Ejemplo: Toyota Corolla">
                        <div id="VehiculoOrigenHelp" class="mt-1 text-sm text-red-600">
                            @error('vehiculo_origen')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="fecha_expedicion">Fecha de Expedición</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="date" name="fecha_expedicion" value="{{ old('fecha_expedicion') }}" id="fecha_expedicion">
                        <div id="FechaExpedicionHelp" class="mt-1 text-sm text-red-600">
                            @error('fecha_expedicion')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="fecha_vigencia">Fecha de Vigencia</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="date" name="fecha_vigencia" value="{{ old('fecha_vigencia') }}" id="fecha_vigencia">
                        <div id="FechaVigenciaHelp" class="mt-1 text-sm text-red-600">
                            @error('fecha_vigencia')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="estatus">Estatus</label>
                        <select class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" name="estatus" id="estatus">
                            <option selected>Selecciona una opción...</option>
                            <option value="Vigente">Vigente</option>
                            <option value="Expirada">Expirada</option>
                            <option value="Suspendida">Suspendida</option>
                        </select>
                        <div id="EstatusHelp" class="mt-1 text-sm text-red-600">
                            @error('estatus')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="fotografia_frontal">Fotografía Frontal</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="file" name="fotografia_frontal" id="fotografia_frontal" accept="image/*">
                        <div id="FotografiaFrontalHelp" class="mt-1 text-sm text-red-600">
                            @error('fotografia_frontal')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                </div>

                <div class="flex justify-end mt-6 space-x-4">
                    <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Guardar</button>
                    <a href="{{ route('tarjetas.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
