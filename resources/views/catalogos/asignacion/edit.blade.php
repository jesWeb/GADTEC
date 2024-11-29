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
                        <a href="{{ route('asignacion.index') }}" title="Volver a la página de solicitudes"  class="text-gray-800 hover:text-gray-800">
                            Solicitudes de Autómovil
                        </a>
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Solicitudes  -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Actualizar Solicitud de Autómovil
                        </p>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- titulo --}}
            <h2 class="mb-5 text-xl font-semibold text-gray-700">Solicitud de Vehículo - {{ $EddtAsig->automovil->marca }}
                {{ $EddtAsig->automovil->submarca }} {{ $EddtAsig->automovil->modelo }} </h2>
            {{-- formulario --}}
            <form action="{{ route('asignacion.update', $EddtAsig) }}" method="post" enctype='multipart/form-data'>
                @csrf
                @method('PATCH')
                <div class="m-4 xl:p-10">
                    {{-- 1 row de info --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row">
                        {{-- Solicitante --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="id_usuario" class="mb-3 block text-base font-medium text-[#07074D]">Solicitante:</label>
                            <select name="id_usuario" id="id_usuario"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                title="Actualizar solicitante">
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach ($reservU as $reserv)
                                    <option value="{{ $reserv->id_usuario }}"
                                        @if(old('id_usuario') == $reserv->id_usuario) selected @endif>
                                        {{ $reserv->nombre }} {{ $reserv->app }} {{ $reserv->apm }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Fecha Reservación --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="fecha_salida">Fecha de
                                Reservación</label>
                            <input type="date" id="fecha" name="fecha_salida"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                value="{{ $EddtAsig->fecha_salida }}" title="Actualizar fecha de reservación">
                        </div>
                        {{-- Hora de Salida --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="hora_salida">Hora de
                                    Salida</label>
                                <input type="time" name="hora_salida"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ $EddtAsig->hora_salida }}" required title="Actualizar hora de salida" />
                            </div>
                        </div>
                    </div>
                    {{-- 3 row de info --}}
                    <div class="flex flex-col gap-5 mt-3 xl:flex-row">
                        {{-- Lugar --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="lugar">Destino</label>
                                <input type="text" name="lugar"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ $EddtAsig->lugar }}" required title="Actualizar destino">
                            </div>
                        </div>
                        {{-- Motivo --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="motivo">Motivo</label>
                                <input type="text" name="motivo"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ $EddtAsig->motivo }}" title="Actualizar motivo de la solicitud">
                            </div>
                        </div>
                        {{-- Teléfono --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="telefono">Teléfono</label>
                                <input type="text" name="telefono"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ old('telefono', $EddtAsig->telefono) }}" title="Actualizar teléfono">
                            </div>
                        </div>
                    </div>
                    {{-- 2 row de info --}}
                    <div class="flex flex-col gap-5 mt-3 xl:flex-row">
                        {{-- Requiere Chofer --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="requierechofer">Requiere
                                    Chofer</label>
                                <select name="requierechofer"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required title="Actualizar opción de chofer">
                                    <option value="ninguno" disabled selected>Selecciona una opción</option>
                                    <option value="sí">Sí</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        {{-- Nombre del Chofer --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="nombre_chofer">Nombre
                                    del Chofer</label>
                                <input type="text" name="nombre_chofer" value="{{ $EddtAsig->nombre_chofer }}"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                                    title="Actualizar nombre del chofer" />
                            </div>
                        </div>
                        {{-- No. de Licencia --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="no_licencia">No. de
                                    Licencia</label>
                                <input type="text" name="no_licencia"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ $EddtAsig->no_licencia }}" required title="Actualizar número de licencia" />
                            </div>
                        </div>
                    </div>
                    {{-- 5 row de info --}}
                    <div class="flex flex-col gap-5 mt-3 xl:flex-row">
                        {{-- Condiciones --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5 h-1/2">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="condiciones">Requerimientos
                                    (adicionales)
                                </label>
                                <textarea name="condiciones"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    rows="4" title="Actualizar condiciones adicionales">{{ $EddtAsig->condiciones }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- BTN --}}
                <div class="flex justify-end gap-4 mt-4">      
                    <button type="submit" title="Actualizar solicitud"
                        class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Actualizar
                    </button>
                    <button type="button" onclick="location.href='{{ route('asignacion.index') }}'"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300"
                        title="Cancelar edición">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
