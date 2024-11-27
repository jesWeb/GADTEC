@extends('layouts.app')

@section('body')
<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">Editar Multa</h2>

            <form action="{{ route('multas.update', $multa->id_multa) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
                {{method_field('PUT')}}
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2 md:grid-cols-3">
                    <div class="mb-4">
                        <label for="id_automovil" class="block text-sm font-medium text-gray-700">Seleccionar Automóvil:</label>
                        <select name="id_automovil" id="id_automovil" value="{{ old('id_automovil', $multa->id_automovil) }}" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                        <label class="block text-base font-medium text-[#07074D]" for="tipo_multa">Tipo de multa</label>
                        <select class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                name="tipo_multa" id="tipo_multa">
                            <option value="Federal" {{(old('tipo_multa', $multa->tipo_multa) == 'Federal') ? 'selected' : '' }}>Federal</option>
                            <option value="Estatal" {{(old('tipo_multa', $multa->tipo_multa) == 'Estatal') ? 'selected' : '' }} >Estatal</option>
                            <option value="Municipal" {{(old('tipo_multa', $multa->tipo_multa) == 'Municipal') ? 'selected' : '' }}>Municipal</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="num_empleado">Monto</label>
                        <input type="text" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                            name="monto" value="{{ old('monto', $multa->monto) }}" id="monto" placeholder="ejemplo: 12345">
                        <div class="mt-1 text-sm text-red-600">
                            @error('monto')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="fecha_multa">Fecha de multa</label>
                        <input type="date" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                            name="fecha_multa" value="{{ old('fecha_multa', $multa->fecha_multa) }}" id="fecha_multa" placeholder="ejemplo: Juan">
                        <div class="mt-1 text-sm text-red-600">
                            @error('fecha_multa')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="lugar">Lugar</label>
                        <input type="text" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                            name="lugar" value="{{ old('lugar', $multa->lugar) }}" id="lugar" placeholder="ejemplo: Pérez">
                        <div class="mt-1 text-sm text-red-600">
                            @error('lugar')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="empresa">Estatus</label>
                        <select class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                name="estatus" id="estatus">
                            <option value="Pagada" {{(old('estatus', $multa->estatus) == 'Pagada') ? 'selected' : '' }}>Pagada</option>
                            <option value="Pendiente" {{(old('estatus', $multa->estatus) == 'Pendiente') ? 'selected' : '' }} >Pendiente</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    
                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="lugar">Observaciones</label>
                        <input type="text" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                            name="observaciones" value="{{ old('observaciones', $multa->observaciones) }}" id="lugar" placeholder="ejemplo: Pérez">
                        <div class="mt-1 text-sm text-red-600">
                            @error('observaciones')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>


                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="comprobante">Comprobante</label>
                        @if ($multa->comprobante)
                            <img src="{{ asset('img/' . $multa->comprobante) }}" alt="comprobante" class="object-cover w-32 h-32 mt-2 rounded-md">
                        @else
                            <p class="mt-2 text-sm text-gray-500">No hay comprobante cargado.</p>
                        @endif
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="file" name="comprobante" id="comprobante" accept="image/*">
                        <div id="FotografiaFrontalHelp" class="mt-1 text-sm text-red-600">
                            @error('comprobante')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>
                    
                    
                </div>


                <div class="flex justify-end mt-8 space-x-4">
                    <button type="submit" class="px-5 py-3 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Guardar</button>
                    <a href="{{ route('multas.index') }}" class="px-5 py-3 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
