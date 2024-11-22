@extends('layouts.app')

@section('body')
<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">Alta de Multas</h2>

            <form action="{{ route('multas.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2 md:grid-cols-3">
                    <div class="mb-4">
                        <label for="id_automovil" class="block text-base font-medium text-[#07074D]">Seleccionar Automóvil:</label>
                        <select name="id_automovil" id="id_automovil"                                 
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">

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
                        <label class="block text-base font-medium text-[#07074D]" for="empresa">Tipo de multa</label>
                        <select class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                name="tipo_multa" id="tipo_multa">
                            <option value="Federal" selected>Federal</option>
                            <option value="Estatal">Estatal</option>
                            <option value="Municipal">Municipal</option>
                            <option value="Guardia Nacional">Guardia Nacional</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="num_empleado">Monto</label>
                        <input type="text" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                            name="monto" value="{{ old('monto') }}" id="monto" placeholder="$ 900.00">
                        <div class="mt-1 text-sm text-red-600">
                            @error('monto')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="fecha_multa">Fecha de multa</label>
                        <input type="date" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                            name="fecha_multa" value="{{ old('fecha_multa') }}" id="fecha_multa" >
                        <div class="mt-1 text-sm text-red-600">
                            @error('fecha_multa')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="lugar">Lugar</label>
                        <input type="text" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                            name="lugar" value="{{ old('lugar') }}" id="lugar" placeholder="Edo. Méx"> 
                        <div class="mt-1 text-sm text-red-600">
                            @error('lugar')<i>{{ $message }}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="empresa">Estatus</label>
                        <select class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                name="estatus" id="estatus">
                            <option value="Pagada" selected>Pagada</option>
                            <option value="Pendiente">Pendiente</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    
                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="observaciones">Observaciones</label>
                        <input type="text" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                            name="observaciones" value="{{ old('observaciones') }}" id="observaciones">
                        <div class="mt-1 text-sm text-red-600">
                            @error('observaciones')<i>{{ $message }}</i>@enderror
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
                    
                    
                </div>

                

                <!-- Botones -->
                <div class="flex justify-end mt-8 space-x-4">
                    <button type="submit"
                        class="px-5 py-3 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Guardar</button>
                    <a href="{{ route('multas.index') }}"
                        class="px-5 py-3 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
