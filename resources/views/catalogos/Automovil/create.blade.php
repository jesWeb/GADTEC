@extends('layouts.app')

@section('body')
    <div class="mt-4">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-xl font-semibold text-gray-700">Registro Automovil</h2>
            {{-- alerta de errores forma dos --}}
            @include('Fragment.errors-form')
            <form action="{{ route('Automovil.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="m-3 xl:p-10 xl:m-5 ">
                    {{-- 1 row de info --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-3">
                        {{-- Marca --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="marca">Marca</label>
                                <input type="text" name="marca" placeholder="Ingresa la marca"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                            </div>
                        </div>
                        {{-- Submarca --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="submarca">Submarca</label>
                                <input type="text" name="submarca" id="submarca" placeholder="Ingresa la submarca"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                            </div>
                        </div>
                        {{-- Modelo --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="modelo">Modelo</label>
                                <input type="number" name="modelo" placeholder="Inresa el Modelo"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                                @error('modelo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    {{-- 2 row info  --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-5">
                        {{-- No.serie --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="num_serie">No.Serie</label>
                                <input
                                    class="w-full
                                    rounded-md border
                                    border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" name="num_serie" placeholder="ejemplo: xxx-xxx-xxx" required>
                            </div>

                        </div>
                        {{-- No.Motor --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="num_motor">No.Motor</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" name="num_motor" required placeholder="ejemplo: xxx-xxx-xxx">
                            </div>
                        </div>
                        {{-- Num_NSI --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="num_nsi">NSI/Repube</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" placeholder="Introduce NSI" name="num_nsi" required>
                            </div>

                        </div>
                    </div>

                    <div class="px-3 py-3 border-b border-stroke dark:border-strokedark"></div>

                    {{--  --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mt-4  mb-4">
                        {{-- Kilometraje --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="kilometraje">Kilometraje</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" placeholder="Introduce el kilometraje" pattern="^\d*([,.]?\d+)?$"
                                    min="0" required name="kilometraje">
                            </div>

                        </div>
                        {{-- Capacidad --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="capacidad_combustible">Capacidad de combustible (Lts)</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="number" name="capacidad_combustible" min="0" step="0.01"
                                    placeholder=" Capacidad" required>
                            </div>

                        </div>
                        {{-- Tcombustible --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="tipo_combustible">
                                    Tipo de combustible</label>
                                <select name="tipo_combustible"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                                    <option disabled selected>Selecciona una opcion </option>
                                    <option value="Gasolina">Gasolina</option>
                                    <option value="Diésel">Diésel</option>
                                    <option value="Eléctrico">Eléctrico</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- 3 row nfo --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-5">
                        {{-- color --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="color">Color</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" name="color" placeholder="Ingresa el Color">
                            </div>
                        </div>
                        {{-- No.Puertas --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="num_puertas">Numero de
                                    Puertas</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" name="num_puertas" placeholder="Ingresa Numero de puertas ">
                            </div>
                        </div>
                        {{-- Utilidad --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="estatus">
                                    Condiciones</label>
                                <select name="estatus"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                                    <option disabled selected>Selecciona una opcion </option>
                                    <option value="Nuevo">Nuevo</option>
                                    <option value="Usado">Usado</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="px-2 py-2 border-b border-stroke dark:border-strokedark"></div>

                    <div class="flex flex-col gap-5.5 xl:flex-row xl:m-5 xl:mt-4 ">
                        {{-- Placas --}}
                        <div class="w-full px-3 xl:w-2/4">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="placas">Placas</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" placeholder="Introduce Placas" required name="placas">
                            </div>
                        </div>
                        {{-- fecha ingreso --}}
                        <div class="w-full px-3 xl:w-2/4">
                            <div class="mb-5">
                                <label for="fecha_registro" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Fecha de Ingreso
                                </label>
                                <input type="date" name="fecha_registro"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>
                    </div>
                    {{-- 4 row info --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row xl:m-5 xl:mt-4 ">
                        {{-- tipo Auto --}}
                        <div class="w-full px-3 xl:w-2/4">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="tipo_automovil"> Tipo
                                    de
                                    Automovil</label>
                                <select name="tipo_automovil"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                                    <option disabled selected>Selecciona una opción</option>
                                    <option value="Automovil">Automóvil - Vehículo de pasajeros</option>
                                    <option value="Camioneta">Camioneta - Vehículo de carga ligera</option>
                                    <option value="Motocicleta">Motocicleta - Dos ruedas</option>
                                </select>
                            </div>
                        </div>
                        {{-- uso --}}
                        <div class="w-full px-3 xl:w-2/4">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="uso">
                                    Uso</label>
                                <select name="uso"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                                    <option disabled selected>Selecciona una opcion </option>
                                    <option value="Personal">Personal</option>
                                    <option value="Empresarial">Empresarial</option>

                                </select>
                            </div>
                        </div>
                        {{-- responsable --}}
                        <div class="w-full px-3 xl:w-2/4">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="responsable">Responsable</label>
                                <input type="text" name="responsable"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required placeholder="Ingresa el nombre del responsable" />
                            </div>

                        </div>
                    </div>
                    {{-- Observacines  --}}
                    <div class="w-full xl:m-5 xl:w-2/4 xl:mt-4 xl:mb-4">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="observaciones">Observaciones
                            del
                            vehiculo</label>
                        <textarea placeholder="Observaciones ..."
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            name="observaciones"></textarea>
                    </div>
                    {{-- foto --}}

                    <div class="pt-4 mb-6">
                        <h3 class="mb-5 block text-xl font-semibold text-[#07074D]">
                            Subir Archivos
                        </h3>
                        <input type="file" name="fotografias" class="filepond" id="fotografias" multiple />
                    </div>

                </div>
                {{-- BTN --}}
                <div class="flex justify-end gap-4 mt-4">
                    <a href="{{ route('Automovil.index') }}"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Registrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const inputElement = document.querySelector('input[id="fotografias"]');
        FilePond.registerPlugin(FilePondPluginImagePreview);
        const pond = FilePond.create(inputElement, {
            allowMultiple: true,
            maxFiles: 5,
            // acceptedFileTypes: ['image/jpeg', 'image/png', 'application/pdf'],
            labelIdle: 'Arrastra y suelta los archivos o haz clic para seleccionarlos',
            imagePreviewMinHeight: 20,
            imagePreviewMaxFileSize: null,
            server: {
                process: {
                 url: '{{ route('Automovil.store') }}',
                     method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },

            }
        });
    </script>
@endsection
