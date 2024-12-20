@extends('layouts.app') <!-- Extiende el layout principal -->

@section('body')
<!-- Librería requerida para el formulario dinámico, está dentro de public -->
<script type="text/javascript" src="{{ url('js/jquery-3.7.1.min.js') }}"></script>
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

                <form id="imageForm" action="{{ route('servicios.update' , $servicio->id_servicio) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                        <!-- Selección de Automóvil -->
                        <div class="mb-4">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar Automóvil:</label>                                                  
                                <select name="id_automovil" id="id_automovil" class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"  title="Actualizar automóvil">
                                    @foreach ($automoviles as $automovil)
                                        <option value="{{ $automovil->id_automovil }}" {{ (old('id_automovil', $servicio->id_automovil) == $automovil->id_automovil) ? 'selected' : '' }}>
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
                        <div class="mb-2">
                            <h4 
                            class="p-4 text-lg font-semibold text-center text-gray-700">Imagenes de comprobantes</h4>
                            @if($servicio->comprobante != '') 
                                <div class="flex gap-4 p-4 ml-4 overflow-x-auto">
                                    @php
                                        $fotografias = json_decode($servicio->comprobante, true);
                                    @endphp

                                    @if ($fotografias)
                                        @foreach ($fotografias as $foto)
                                            <img src="{{ url('img/servicios/' . $foto) }}" class="w-16 h-auto transition-transform duration-300 transform rounded-lg shadow-md hover:scale-90 hover:shadow-lg" alt="seguro">
                                            <a href="{{ url('img/servicios/' . $foto) }}" target="_blank" class="text-gray-500" title="Ver archivo de de tenencia">Ver imagen</a> 
                                        @endforeach
                                    @else
                                        <p class="text-sm text-gray-500">Sin imagen</p>
                                    @endif
                                </div>
                            
                            @endif
                        </div>
                        
                        {{-- foto --}}
                        <div class="pt-4 mb-6">
                            <h3 class="mb-5 block text-xl font-semibold text-[#07074D]">
                                Subir Imágenes
                            </h3>
                            <p class="text-sm text-gray-600">Máximo 5 imágenes</p>
                            <div class="flex flex-wrap gap-4 mt-4 pt-4 mb-6" id="imageContainer"></div>
                            <div class="mb-8">
                                <label for="comprobante"  id="addImageBtn"
                                    class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                    <div>
                                        <button type="button" name="comprobante[]" id="comprobante" accept="image/*"  class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                            Buscar
                                        </button>
                                        
                                    </div>
                                </label>
                            </div>
                        </div>
  
                    
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end mt-6 space-x-4">
                        <a href="{{ route('servicios.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300" title="Cancelar los cambios">Cancelar</a>
                        <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" title="Guardar los cambios del servicio">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Script de validación -->
    <script>
        $(document).ready(function() {
            let maxImages = 5;
            let currentImages = 0;
            const maxFileSize = 15 * 1024 * 1024;

            function createImageInput(capture = false) {
                const inputFile = $('<input>', {
                    type: 'file',
                    name: 'comprobante[]',
                    accept: 'image/jpeg,image/png',
                    class: 'hidden',

                });

                const previewContainer = $(`
            <div class="flex items-center mt-4 space-x-4">
                <img src="#" class="object-cover w-16 h-16 border rounded" alt="Previsualización">
                <button type="button" class="text-red-500 remove-image">Eliminar</button>
            </div>
        `);

                inputFile.on('change', function() {
                    const file = this.files[0];

                    if (file) {
                        if (file.size > maxFileSize) {
                            alert('El archivo supera el tamaño máximo permitido de 10 MB.');
                            inputFile.val('');
                            return;
                        }

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewContainer.find('img').attr('src', e.target.result);
                        };
                        reader.readAsDataURL(file);

                        currentImages++;
                        updateButtonState();
                    }
                });

                previewContainer.find('.remove-image').on('click', function() {
                    inputFile.remove();
                    previewContainer.remove();
                    currentImages--;
                    updateButtonState();
                });

                $('#imageContainer').append(previewContainer);
                inputFile.click();
                $('#imageForm').append(inputFile);
            }

            $('#addImageBtn').on('click', function() {
                if (currentImages < maxImages) {
                    createImageInput(true);
                }
            });



            // createImageInput(); // Agregar un input por defecto
        });
    </script>

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
@endsection




