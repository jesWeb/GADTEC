@extends('layouts.app')

@section('body')
    <div class="flex flex-col mt-5 gap-9">

        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- titulo --}}
            <h2 class="mb-5 text-xl font-semibold text-gray-700">Solicitud de Vehiculo - {{ $EddtAsig->automovil->marca }}
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
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach ($reservU  as $reserv)
                                    <option value="{{ $reserv->id_usuario }}"
                                        @if(old('id_usuario') == $reserv->id_usuario) selected @endif>
                                        {{ $reserv->nombre }} {{ $reserv->app }} {{ $reserv->apm }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- fecha Reservacion --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="fecha_salida">Fecha de
                                Reservación</label>
                            <input type="date" id="fecha" name="fecha_salida"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                value="{{ $EddtAsig->fecha_salida }}">
                        </div>
                        {{-- Hora de Salida --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="hora_salida">Hora de
                                    Salida</label>
                                <input type="time" name="hora_salida"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ $EddtAsig->hora_salida }}" required />
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
                                    value="{{ $EddtAsig->lugar }}" required />
                            </div>
                        </div>
                        {{-- Motivo --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="motivo">Motivo</label>
                                <input type="text" name="motivo"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ $EddtAsig->motivo }}"></input>
                            </div>
                        </div>
                        {{-- Teléfono --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="telefono">Teléfono</label>
                                <input type="text" name="telefono"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ old('telefono', $EddtAsig->telefono) }}" />
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
                                    required>
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
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>
                        {{-- No. de Licencia --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="no_licencia">No. de
                                    Licencia</label>
                                <input type="text" name="no_licencia"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ $EddtAsig->no_licencia }}" required />
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
                                    value="{{ $EddtAsig->condiciones }}" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- BTN --}}
                <div class="flex justify-end gap-4 mt-4">      
                    <button type="submit" title="Actualizar solicitud"
                        class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Guardar</button>
                        <a href="{{ route('asignacion.index') }}" title="Cancelar edición" 
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                </div
            </form>
        </div>
    </div>
@endsection
