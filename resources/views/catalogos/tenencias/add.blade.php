@extends('layouts.app') <!-- Extiende el layout principal -->

@section('body')
<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">Alta de Tenencias/Refrendo</h2>

            <form action="{{ route('tenencias.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div class="mb-4">
                        <label for="id_automovil" class="block text-sm font-medium text-gray-700">Seleccionar Automóvil:</label>
                        <select name="id_automovil" id="id_automovil" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="date" name="fecha_pago" value="{{ old('fecha_pago') }}" id="fecha_pago" placeholder="Ejemplo: Juan Pérez">
                        <div id="NombreHelp" class="mt-1 text-sm text-red-600">
                            @error('fecha_pago')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="origen">Vehiculo Origen</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="origen" value="{{ old('origen') }}" id="origen" placeholder="Ejemplo: 123456789">
                        <div id="NumTarjetaHelp" class="mt-1 text-sm text-red-600">
                            @error('origen')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="monto">Monto</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="monto" value="{{ old('monto') }}" id="monto" placeholder="Ejemplo: Toyota Corolla">
                        <div id="VehiculoOrigenHelp" class="mt-1 text-sm text-red-600">
                            @error('monto')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="año_correspondiente">Año correspondiente</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="año_correspondiente" value="{{ old('año_correspondiente') }}" id="año_correspondiente">
                        <div id="FechaExpedicionHelp" class="mt-1 text-sm text-red-600">
                            @error('año_correspondiente')<i>{{ $message }}</i>@enderror
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
                        <label class="block text-base font-medium text-[#07074D]" for="fecha_vencimiento">Fecha de vencimiento</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="date" name="fecha_vencimiento" value="{{ old('fecha_vencimiento') }}" id="fecha_vencimiento">
                        <div id="FechaVencimientoHelp" class="mt-1 text-sm text-red-600">
                            @error('fecha_vencimiento')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="comprobante">Comprobante</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="file" name="comprobante" id="comprobante" accept="image/*">
                        <div id="FotografiaFrontalHelp" class="mt-1 text-sm text-red-600">
                            @error('comprobante')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="observaciones">Observaciones</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="observaciones" value="{{ old('observaciones') }}" id="observaciones">
                        <div id="ObservacionesHelp" class="mt-1 text-sm text-red-600">
                            @error('observaciones')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                   
                </div>

                <div class="flex justify-end mt-6 space-x-4">
                    <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Guardar</button>
                    <a href="{{ route('tenencias.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
