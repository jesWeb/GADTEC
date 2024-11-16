@extends('layouts.app') <!-- Extiende el layout principal -->

@section('body')
<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">Editar Tenencia/Refrendo</h2>

            <form action="{{ route('tenencias.update' , $tenencia->id_tenencia) }}"  method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                {{ method_field('PUT') }}
                
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div class="mb-4">
                    <label for="id_automovil" class="block text-sm font-medium text-gray-700">Seleccionar Automóvil:</label>
                    <select name="id_automovil" id="id_automovil" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                               type="date" name="fecha_pago" value="{{ old('fecha_pago', $tenencia->fecha_pago) }}" id="fecha_pago" placeholder="Ejemplo: Juan Pérez">
                        <div id="NombreHelp" class="mt-1 text-sm text-red-600">
                            @error('fecha_pago')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="origen">Vehiculo Origen</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="origen" value="{{ old('origen', $tenencia->origen) }}" id="origen" placeholder="Ejemplo: 123456789">
                        <div id="NumTarjetaHelp" class="mt-1 text-sm text-red-600">
                            @error('origen')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="monto">Monto</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="monto" value="{{ old('monto', $tenencia->monto) }}" id="monto" placeholder="Ejemplo: Toyota Corolla">
                        <div id="VehiculoOrigenHelp" class="mt-1 text-sm text-red-600">
                            @error('monto')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="año_correspondiente">Año correspondiente</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="año_correspondiente" value="{{ old('año_correspondiente', $tenencia->año_correspondiente) }}" id="año_correspondiente">
                        <div id="FechaExpedicionHelp" class="mt-1 text-sm text-red-600">
                            @error('año_correspondiente')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                 

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="estatus">Estatus</label>
                        <select class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" name="estatus" id="estatus">
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
                        <label class="block text-base font-medium text-[#07074D]" for="fecha_vencimiento">Fecha de vencimiento</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="date" name="fecha_vencimiento" value="{{ old('fecha_vencimiento', $tenencia->fecha_vencimiento) }}" id="fecha_vencimiento">
                        <div id="FechaVencimientoHelp" class="mt-1 text-sm text-red-600">
                            @error('fecha_vencimiento')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="comprobante">Comprobante</label>
                        @if ($tenencia->comprobante)
                            <img src="{{ asset('img/' . $tenencia->comprobante) }}" alt="Comprobante" class="object-cover w-32 h-32 mt-2 rounded-md">
                        @else
                            <p class="mt-2 text-sm text-gray-500">No hay comprobante cargado.</p>
                        @endif
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="file" name="comprobante" id="comprobante" accept="image/*">
                        <div id="FotografiaFrontalHelp" class="mt-1 text-sm text-red-600">
                            @error('comprobante')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="observaciones">Observaciones</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="observaciones" value="{{ old('observaciones', $tenencia->observaciones) }}"
                               id="observaciones">
                        <div id="ObservacionesHelp" class="mt-1 text-sm text-red-600">
                            @error('observaciones')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                   
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Guardar</button>
                    <a href="{{ route('tenencias.index') }}">
                        <button type="button" class="px-6 py-2 ml-2 font-semibold bg-gray-200 rounded-md hover:bg-red-200 focus:outline-none focus:bg-red-700">Cancelar</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
