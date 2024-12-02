@extends('layouts.app')
@section('body')
<div class="px-6 py-2">
    <!-- Mapa de sitio -->
    <div class="flex justify-end mt-2 mb-4">
        <nav class="text-sm text-gray-600">
                <div class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Ir a la gestión de vehículos" class="flex items-center text-gray-700 hover:text-gray-900">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                            Gestión
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Catálogos -->
                    <li class="flex items-center">
                        <a href="{{ $backRoute ?? route('catalogos.index') }}" title="Volver a Catálogos" class="text-gray-800 hover:text-gray-800">
                            Catálogos
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <a href="{{route('Automovil.index')}}" title="Volver a la página de automoviles" class="text-gray-800 hover:text-gray-800">
                            Automóviles
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Actualizar Automóvil
                        </p>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="mt-4">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-xl font-semibold text-gray-700">Editar Automovil </h2>
            {{--  --}}
            <form action="{{ route('Automovil.update', $EddCar->id_automovil) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="m-3 xl:p-10">
                    {{-- 1st row of info --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-3">
                        {{-- Marca --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="marca">Marca</label>
                                <input type="text" name="marca" value="{{ $EddCar->marca }}" title="Actualizar la marca del automóvil"
                                    placeholder="Ingresa la marca" disabled
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                            </div>
                        </div>
                        {{-- Submarca --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="submarca">Submarca</label>
                                <input type="text" name="submarca" id="submarca" disabled
                                    value="{{ $EddCar->submarca }}" placeholder="Ingresa la submarca" title="Actualizar la submarca del automóvil"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    </div>
                            </div>

                        </div>
                        {{-- Modelo --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="modelo">Modelo</label>
                                <input type="number" disabled name="modelo" id="modelo" placeholder="Ingresa el año" title="Actualizar el modelo del automóvil"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ old('modelo', $EddCar->modelo) }}" </div>
                            </div>
                        </div>
                    </div>
                    {{-- 2nd row of info --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-5">
                        {{-- No.serie --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="num_serie">No.
                                    Serie</label>
                                <input type="text" disabled name="num_serie" id="serie" title="Actualizar el número de serie del automóvil"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ old('num_serie', $EddCar->num_serie) }}">
                            </div>
                        </div>
                        {{-- No.Motor --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="num_motor">No.
                                    Motor</label>
                                <input type="text" disabled name="num_motor" id="motor" title="Actualizar el número de motor del automóvil" required
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ old('num_motor', $EddCar->num_motor) }}">
                            </div>
                        </div>
                        {{-- Num_NSI --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="num_nsi">NSI/Repube</label>
                                <input type="text" disabled name="num_nsi" title="Actualizar el número de NSI o Repube" required
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ old('NSI', $EddCar->num_nsi) }}">
                            </div>
                        </div>

                    </div>

                    <div class="px-3 py-3 border-b border-stroke dark:border-strokedark"></div>

                    <div class="flex flex-col gap-5.5 xl:flex-row mt-4  mb-4">
                        {{-- Kilometraje --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="kilometraje">Kilometraje</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="number" value="{{ old('kilometraje', $EddCar->kilometraje) }}"
                                    pattern="^\d*\.?\d+$" min="0" step="0.01" required name="kilometraje" title="Actualizar el kilometraje del vehículo">
                            </div>

                        </div>
                        {{-- Capacidad --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="capacidad_combustible">Capacidad de combustible</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="number" name="capacidad_combustible" min="0" step="0.01"
                                    placeholder="10.00" title="Actualizar la capacidad de combustible en litros" required>
                            </div>

                        </div>
                        {{-- Tcombustible --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="tipo_combustible">
                                    Tipo de combustible</label>
                                <select name="tipo_combustible"   title="Actualizar el tipo de combustible del vehículo"
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
                    {{-- 3 row --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-3">
                        {{-- color --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="color">Color</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" name="color" disabled value="{{ old('color', $EddCar->color) }}" title="Actualizar el color del automóvil">
                            </div>
                        </div>
                        {{-- No.Puertas --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="num_puertas">Numero de
                                    Puertas</label>
                                <input
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" name="num_puertas" disabled title="Actualizar el número de puertas del automóvil"
                                    value="{{ old('num_puertas', $EddCar->num_puertas) }}">
                            </div>
                        </div>
                        {{-- Utilidad --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="estatus">
                                    Condiciones
                                </label>
                                <select name="estatus" title="Actualizar las condiciones del automóvil"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                                    <option disabled selected>Selecciona una opcion</option>
                                    {{-- <option value="Nuevo"
                                        {{ old('estatus', $Eddcar->estatus) == 'Nuevo' ? 'selected' : '' }}>Nuevo
                                    </option>
                                    <option value="Usado"
                                        {{ old('estatus', $Eddcar->estatus) == 'Usado' ? 'selected' : '' }}>Usado
                                    </option> --}}
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
                                    type="text" value="{{ old('placas', $EddCar->placas) }}" name="placas" title="Actualizar las placas del automóvil">
                            </div>

                        </div>
                        {{-- fecha ingreso --}}
                        <div class="w-full px-3 xl:w-2/4">
                            <div class="mb-5">
                                <label for="fecha_registro" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Fecha de Ingreso
                                </label>
                                <input type="date" name="fecha_registro" title="Actualizar la fecha de ingreso del automóvil"
                                    value="{{ old('fecha_registro', $EddCar->fecha_registro) }}"
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
                                <select name="tipo_automovil" title="Actualizar el tipo de automóvil"
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
                                <select name="uso" title="Actualizar el uso del automóvil"
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
                                <input type="text" name="responsable" title="Actualizar el responsable del automóvil"
                                    value="{{ old('responsable', $EddCar->responsable) }}"
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
                        <textarea placeholder="Observaciones ..." title="Actualizar las observaciones del automóvil"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            name="observaciones"></textarea>
                    </div>
                    {{-- foto --}}
                    <div class="pt-4 mb-6">
                        <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                            Subir Archivos
                        </label>
                        <div class="mb-8">
                            <input type="file" name="fotografias" id="fotografias" class="sr-only" multiple   title="Actualizar fotografías del automóvil" />
                            <label for="fotografias"
                                class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                <div>
                                    <span
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
                    </div>

                    {{-- BTN --}}
                    <div class="flex justify-end mt-6 space-x-4">
                        <a href="{{ route('Automovil.index') }}" title="Cancelar edición" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                        <button type="submit" title="Actualizar automóvil" class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Actualizar</button>
                    </div>
            </form>

        </div>
    </div>
</div>
@endsection
