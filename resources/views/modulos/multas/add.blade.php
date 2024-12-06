@extends('layouts.app')

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
                        <a href="{{ route('multas.index') }}" title="Volver a la página de multas"  class="text-gray-800 hover:text-gray-800">
                            Multas
                        </a>
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Multas  -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Registrar Nueva Multa 
                        </p>
                    </li>
                </ul>
            </nav>
        </div>
    <div class="mt-8">
        <div class="mt-4">
            <div class="p-6 bg-white rounded-lg shadow-lg">
                <h2 class="text-lg font-semibold text-gray-700 capitalize">Alta de Multas</h2>

                <form action="{{ route('multas.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2 md:grid-cols-3">
                        <div class="mb-4">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]" title="Selecciona el automóvil relacionado con la multa">Seleccionar Automóvil:</label>
                            <select name="id_automovil" id="id_automovil" 
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                title="Seleccione el automóvil relacionado con la multa">
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
                            <label class="block text-base font-medium text-[#07074D]" for="tipo_multa" title="Selecciona el tipo de multa">Tipo de multa</label>
                            <select class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                    name="tipo_multa" id="tipo_multa" title="Seleccione el tipo de multa">
                                <option value="Federal" selected>Federal</option>
                                <option value="Estatal">Estatal</option>
                                <option value="Municipal">Municipal</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="monto" title="Introduce el monto de la multa">Monto</label>
                            <input type="text" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                name="monto" value="{{ old('monto') }}" id="monto" placeholder="$ 900.00" title="Introduce el monto de la multa">
                            <div class="mt-1 text-sm text-red-600">
                                @error('monto')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="fecha_multa" title="Selecciona la fecha en la que se impuso la multa">Fecha de multa</label>
                            <input type="date" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                name="fecha_multa" value="{{ old('fecha_multa') }}" id="fecha_multa" title="Selecciona la fecha de la multa">
                            <div class="mt-1 text-sm text-red-600">
                                @error('fecha_multa')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="lugar" title="Indica el lugar donde ocurrió la multa">Lugar</label>
                            <input type="text" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                name="lugar" value="{{ old('lugar') }}" id="lugar" placeholder="Edo. Méx" title="Indica el lugar donde ocurrió la multa">
                            <div class="mt-1 text-sm text-red-600">
                                @error('lugar')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="estatus" title="Selecciona el estatus de la multa">Estatus</label>
                            <select class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                    name="estatus" id="estatus" title="Selecciona el estatus de la multa">
                                <option value="Pagada" selected>Pagada</option>
                                <option value="Pendiente">Pendiente</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="observaciones" title="Escribe las observaciones adicionales de la multa">Observaciones</label>
                            <input type="text" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                name="observaciones" value="{{ old('observaciones') }}" id="observaciones" placeholder="Observaciones sobre la multa" title="Escribe las observaciones adicionales de la multa">
                            <div class="mt-1 text-sm text-red-600">
                                @error('observaciones')<i>{{ $message }}</i>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-base font-medium text-[#07074D]" for="comprobante">Comprobante</label>
                                <div class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] mt-4 p-6 text-center">
                                <input class="sr-only" type="file" name="comprobante" id="comprobante"accept="image/*" title="Sube el comprobante del pago en formato de imagen" />
                                <label for="comprobante" class="cursor-pointer">
                                    <div class="flex flex-col items-center">
                                        <span title="Adjunta un archivo de imagen del comprobante de la multa"
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

                    <!-- Botones -->
                    <div class="flex justify-end mt-8 space-x-4">
                        <button type="submit" title="Registrar multa"
                            class="px-5 py-3 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                            title="Guardar la multa">Guardar</button>
                        <a href="{{ route('multas.index') }}" title="Cancelar registro"
                            class="px-5 py-3 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300" 
                            title="Cancelar y regresar a la lista de multas">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
