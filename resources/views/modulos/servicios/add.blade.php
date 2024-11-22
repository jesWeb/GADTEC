@extends('layouts.app')

@section('body')
<!-- Librería requerida para el formulario dinámico, está dentro de public -->
<script type="text/javascript" src="{{ url('js/jquery-3.7.1.min.js') }}"></script>

<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-lg shadow-lg sm:px-4 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-800">Alta de Servicios</h2>
            <p class="mt-2 text-sm text-gray-500">Rellena los campos para registrar un nuevo servicio para el automóvil seleccionado.</p>

            <!-- Formulario -->
                <form action="{{ route('servicios.store') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1 md:grid-cols-2">
                        <!-- Selección de Automóvil -->
                        <div class="mb-4">
                            <label for="id_automovil" class="block text-base font-medium text-gray-700">Seleccionar Automóvil:</label>
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

                        <!-- Tipo de Servicio -->
                        <div>
                            <label class="block text-base font-medium text-gray-700" for="tipo_servicio">Tipo de Servicio</label>
                            <select class="w-full px-6 py-3 mt-2 text-base font-medium text-gray-600 bg-white border border-gray-300 rounded-md focus:border-indigo-500 focus:shadow-md"
                                    name="tipo_servicio" id="tipo_servicio">
                                <option selected>Selecciona una opción...</option>
                                <option value="Programado">Programado</option>
                                <option value="No programado">No programado</option>
                            </select>
                            <div id="tipo_servicioHelp" class="mt-1 text-sm text-red-600">
                                @error('tipo_servicio')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                         <!-- Fecha de Servicio -->
                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="fecha_servicio">Fecha de Servicio</label>
                            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                type="date" name="fecha_servicio" value="{{ old('fecha_servicio') }}" id="fecha_servicio" placeholder="">
                            <div id="VehiculoOrigenHelp" class="mt-1 text-sm text-red-600">
                                @error('fecha_servicio')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <!-- Campos dinámicos según el tipo de servicio -->
                        <div id="camp_servicios"></div>

                        <!-- Descripción -->
                        <div id="descripcion-container" class="md:col-span-1">
                            <label class="block text-base font-medium text-gray-700" for="descripcion">Descripción</label>
                            <input class="w-full px-6 py-3 mt-2 text-base font-medium text-gray-600 bg-white border border-gray-300 rounded-md focus:border-indigo-500 focus:shadow-md"
                                type="text" name="descripcion" value="{{ old('descripcion') }}" id="descripcion" placeholder="Escribe...">
                            <div id="descripcionHelp" class="mt-1 text-sm text-red-600">
                                @error('descripcion')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <!-- Costo -->
                        <div>
                            <label class="block text-base font-medium text-gray-700" for="costo">Costo</label>
                            <input class="w-full px-6 py-3 mt-2 text-base font-medium text-gray-600 bg-white border border-gray-300 rounded-md focus:border-indigo-500 focus:shadow-md"
                                type="text" name="costo" value="{{ old('costo') }}" id="costo">
                            <div id="costoHelp" class="mt-1 text-sm text-red-600">
                                @error('costo')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <!-- Lugar de Servicio -->
                        <div>
                            <label class="block text-base font-medium text-gray-700" for="lugar_servicio">Lugar de Servicio</label>
                            <input class="w-full px-6 py-3 mt-2 text-base font-medium text-gray-600 bg-white border border-gray-300 rounded-md focus:border-indigo-500 focus:shadow-md"
                                type="text" name="lugar_servicio" id="lugar_servicio">
                            <div id="lugar_servicioHelp" class="mt-1 text-sm text-red-600">
                                @error('lugar_servicio')<i>{{ $message }}</i>@enderror
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
                    <div class="flex justify-end mt-6 space-x-4">
                        <a href="{{ route('servicios.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                        <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Guardar</button>
                    </div>
                </form>


        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#tipo_servicio").on('change', function() {
            var camp_servicios = $(this).find(":selected").val();
            if(camp_servicios == 'Programado'){
                $("#camp_servicios").load("{{ route('js_tipo_servicio') }}");
            } else {
                $("#camp_servicios").html('');
            }
        });
    });
</script>

@endsection
