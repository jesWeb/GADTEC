@extends('layouts.app')

@section('body')
    <div class="flex flex-col mt-5 gap-9">

        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- titulo --}}
            <h2 class="mb-5 text-xl font-semibold text-gray-700">Solicitud de Vehiculo</h2>
            {{-- formulario --}}
            <form action="{{ route('asignacion.update', $EddtAsig) }}" method="post" enctype='multipart/form-data'>
                @csrf
                @method('PATCH')
                <div class="m-4 xl:p-10">
                    {{-- 1 row de info --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row">
                        {{-- Solicitante --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="solicitante">Solicitante</label>
                                <input
                                type="text"
                                name="solicitante"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                value="{{$EddtAsig->solicitante}}"
                                required />
                            </div>
                        </div>
                        {{-- Teléfono --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="telefono">Teléfono</label>
                                <input
                                 type="text"
                                 name="telefono"
                                 class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                 value="{{$EddtAsig->telefono}}"
                                 required />
                            </div>
                        </div>
                    </div>

                    {{-- 2 row de info --}}
                    <div class="flex flex-col gap-5.5 mt-3 xl:flex-row">
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
                                <input
                                type="text"
                                name="nombre_chofer"
                                value="{{$EddtAsig->nombre_chofer}}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>
                    </div>

                    {{-- 3 row de info --}}
                    <div class="flex flex-col gap-5 mt-3 xl:flex-row">
                        {{-- Vehículo --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="vehiculo">Vehículo</label>
                                <input
                                type="text"
                                name="vehiculo"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                 value="{{$EddtAsig->vehiculo}}"
                                required />
                            </div>
                        </div>
                        {{-- Lugar --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="lugar">Lugar</label>
                                <input
                                 type="text"
                                name="lugar"
                                 class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                 value="{{$EddtAsig->lugar}}"
                                 required />
                            </div>
                        </div>
                    </div>

                    {{-- 4 row de info --}}
                    <div class="flex flex-col gap-5 mt-3 xl:flex-row">
                        {{-- Hora de Salida --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="hora_salida">Hora de
                                    Salida</label>
                                <input
                                type="time"
                                name="hora_salida"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                 value="{{$EddtAsig->hora_salida}}"
                                required />
                            </div>
                        </div>
                        {{-- No. de Licencia --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="no_licencia">No. de
                                    Licencia</label>
                                <input
                                type="text"
                                name="no_licencia"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                 value="{{$EddtAsig->no_licencia}}"
                                required />
                            </div>
                        </div>
                    </div>

                    {{-- 5 row de info --}}
                    <div class="flex flex-col gap-5 mt-3 xl:flex-row">
                        {{-- Condiciones --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="condiciones">Condiciones</label>
                                <textarea
                                name="condiciones"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                 value="{{$EddtAsig->condiciones}}"
                                rows="4"></textarea>
                            </div>
                        </div>
                        {{-- Observaciones --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="observaciones">Observaciones</label>
                                <textarea
                                 name="observaciones"
                                 class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                  value="{{$EddtAsig->observaciones}}"
                                 rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Autorizante --}}
                    <div class="w-full px-3 mt-3">
                        <div class="mb-5">
                            <label class="mb-3 block text-base font-medium text-[#07074D]"
                                for="autorizante">Autorizante</label>
                            <input
                            type="text"
                            name="autorizante"
                            value="{{$EddtAsig->autorizante}}"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            required />
                        </div>
                    </div>
                </div>
                {{-- BTN --}}
                <div class="flex justify-end gap-4 mt-4">
                    <button type="submit"
                        class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Guardar</button>
                </div
            </form>
        </div>
    </div>
@endsection
