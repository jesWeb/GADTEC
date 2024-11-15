@extends('layouts.app') <!-- Extiende el layout principal -->

@section('body')
<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-lg shadow-md">
            <h2 class="mb-4 text-2xl font-bold">Editar Tarjeta de Circulación</h2>

            <form action="{{ route('tarjetas.update', $tarjeta->id_tarjeta) }}"  method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <!-- Campo para seleccionar el automóvil -->
                    <div class="mb-4">
                        <label for="id_automovil" class="block text-sm font-medium text-gray-700">Seleccionar Automóvil:</label>
                        <select name="id_automovil" id="id_automovil" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @foreach ($automoviles as $automovil)
                                <option value="{{ $automovil->id_automovil }}" {{ (old('id_automovil', $tarjeta->id_automovil) == $automovil->id_automovil) ? 'selected' : '' }}>
                                    {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_automovil')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo para el nombre -->
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                        value="{{ old('nombre', $tarjeta->nombre) }}" required>
                        @error('nombre')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo para el número de tarjeta -->
                    <div class="mb-4">
                        <label for="num_tarjeta" class="block text-sm font-medium text-gray-700">Número de Tarjeta:</label>
                        <input type="text" name="num_tarjeta" id="num_tarjeta" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                        value="{{ old('num_tarjeta', $tarjeta->num_tarjeta) }}" required>
                        @error('num_tarjeta')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo para el vehículo origen -->
                    <div class="mb-4">
                        <label for="vehiculo_origen" class="block text-sm font-medium text-gray-700">Vehículo Origen:</label>
                        <input type="text" name="vehiculo_origen" id="vehiculo_origen" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                        value="{{ old('vehiculo_origen', $tarjeta->vehiculo_origen) }}" required>
                        @error('vehiculo_origen')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo para la fecha de expedición -->
                    <div class="mb-4">
                        <label for="fecha_expedicion" class="block text-sm font-medium text-gray-700">Fecha de Expedición:</label>
                        <input type="date" name="fecha_expedicion" id="fecha_expedicion" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                        value="{{ old('fecha_expedicion', $tarjeta->fecha_expedicion) }}" required>
                        @error('fecha_expedicion')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo para la fecha de vigencia -->
                    <div class="mb-4">
                        <label for="fecha_vigencia" class="block text-sm font-medium text-gray-700">Fecha de Vigencia:</label>
                        <input type="date" name="fecha_vigencia" id="fecha_vigencia" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" 
                        value="{{ old('fecha_vigencia', $tarjeta->fecha_vigencia) }}" required>
                        @error('fecha_vigencia')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo para el estatus -->
                    <div class="mb-4">
                        <label for="estatus" class="block text-sm font-medium text-gray-700">Estatus:</label>
                        <select name="estatus" id="estatus" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Vigente" {{ (old('estatus', $tarjeta->estatus) == 'Vigente') ? 'selected' : '' }}>Vigente</option>
                            <option value="Expirada" {{ (old('estatus', $tarjeta->estatus) == 'Expirada') ? 'selected' : '' }}>Expirada</option>
                            <option value="Suspendida" {{ (old('estatus', $tarjeta->estatus) == 'Suspendida') ? 'selected' : '' }}>Suspendida</option>
                        </select>
                        @error('estatus')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Campo para subir fotografía frontal -->
                    <div class="col-span-2 mb-4">
                        <label for="fotografia_frontal" class="block text-sm font-medium text-gray-700">Fotografía Frontal:</label>
                        @if ($tarjeta->fotografia_frontal)
                            <img src="{{ asset('img/' . $tarjeta->fotografia_frontal) }}" alt="fotografia_frontal" class="object-cover w-32 h-32 mt-2 rounded-md">
                        @else
                            <p class="mt-2 text-sm text-gray-500">No hay comprobante cargado.</p>
                        @endif
                        <input type="file" name="fotografia_frontal" id="fotografia_frontal" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('fotografia_frontal')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Guardar</button>
                    <a href="{{ route('tarjetas.index') }}">
                        <button type="button" class="px-6 py-2 ml-2 font-semibold bg-gray-200 rounded-md hover:bg-red-200 focus:outline-none focus:bg-red-700">Cancelar</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
