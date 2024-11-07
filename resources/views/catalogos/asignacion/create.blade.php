@extends('layouts.app')

@section('body')
    <div class="flex flex-col mt-5 gap-9">

        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- titulo --}}
            <h2 class="mb-5 text-xl font-semibold text-gray-700">Solicitud de Vehiculo</h2>
            {{-- formulario --}}
            <form action="{{ route('asignacion.store') }}" method="POST">
                @csrf
                <div class="m-4 xl:p-10">
                    {{-- 1 row de info --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row">
                        {{-- usuario   --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="id_usuario"
                                class="mb-3 block text-base font-medium text-[#07074D]">Solicitante:</label>
                            <select name="id_usuario" id="id_usuario"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach ($reservU as $reserv)
                                    <option value="{{ $reserv->id_usuario }}">
                                        {{ $reserv->nombre }} {{ $reserv->app }} {{ $reserv->apm }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- fecha reserv --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="fecha_salida">Fecha de
                                Reservación</label>
                            <input type="date" id="fecha" name="fecha_salida"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required>
                        </div>
                        {{-- Teléfono --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="telefono">Teléfono</label>
                                <input type="text" name="telefono"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required />
                            </div>
                        </div>
                    </div>
                    {{-- 2 row de info --}}
                    <div class="flex flex-col gap-5 mt-3 xl:flex-row">
                        {{-- Vehículo --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar
                                Automóvil:</label>
                            <select name="id_automovil" id="id_automovil"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option selected>Selecciona una opción...</option>
                                @foreach ($auto as $autoR)
                                    <option value="{{ $autoR->id_automovil }}">
                                        {{ $autoR->marca }} {{ $autoR->modelo }} ({{ $autoR->submarca }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Lugar --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="lugar">Destino</label>
                                <input type="text" name="lugar" placeholder="Ingresa el destino"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required />
                            </div>

                            
                        </div>
                        {{-- Motivo --}}
                    <div class="w-full px-3 xl:w-1/2">
                        <div class="mb-5">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="motivo">Motivo</label>
                            <textarea name="motivo" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required></textarea>
                        </div>
                    </div>
                        {{-- estatus  --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="estatus">Estatus</label>
                            <select name="estatus"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required>
                                <option disabled selected>Selecciona una opción</option>
                                <option value="disponible">Disponible</option>
                                <option value="ocupado">Ocupado</option>
                                <option value="reservado">Reservado</option>
                            </select>
                        </div>
                    </div>
                    {{-- 4 row de info --}}
                    <div class="flex flex-col gap-5 mt-3 xl:flex-row">
                        {{-- Hora de Salida --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="hora_salida">Hora de
                                    Salida</label>
                                <input type="time" name="hora_salida"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required />
                            </div>
                        </div>

                    </div>

                    <div class="px-3 py-3 border-b border-stroke dark:border-strokedark"></div>

                    {{--  row de info --}}
                    <div class="flex flex-col gap-5.5 mt-3 xl:flex-row">
                        {{-- Requiere Chofer --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="requierechofer">Requiere Chofer</label>

                                <div class="flex items-center">
                                    <input
                                        type="checkbox"
                                        id="requierechofer"
                                        name="requierechofer"
                                        value="1"
                                        class="mr-2"
                                        onclick="toggleChoferInput()">
                                    <label for="requierechofer" class="text-base font-medium text-[#6B7280]">Si</label>
                                </div>

                                <div class="w-full px-3 xl:w-1/2">
                                    <div id="choferInput" class="hidden ml-4">
                                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="nombre_chofer">
                                            Chofer</label>
                                        <input
                                            type="text"
                                            name="nombre_chofer"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                    </div>
                                </div>
                            </div>

                            <script>
                                function toggleChoferInput() {
                                    const choferInput = document.getElementById('choferInput');
                                    const requiereChofer = document.getElementById('requierechofer');

                                    if (requiereChofer.checked) {
                                        choferInput.classList.remove('hidden');
                                    } else {
                                        choferInput.classList.add('hidden');
                                    }
                                }
                            </script>

                                {{-- No. de Licencia --}}
                                <div class="w-full px-3 xl:w-1/2">
                                    <div class="mb-5">
                                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="no_licencia">No.
                                            de
                                            Licencia</label>
                                        <input type="text" name="no_licencia"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                            required />
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="flex flex-col gap-5.5 mt-3 xl:flex-row">
                                {{-- Autorizante --}}
                                <div class="w-full px-3 ">
                                    <div class="mb-5">
                                        <label class="mb-3 block text-base font-medium text-[#07074D]"
                                            for="autorizante">Autorizante</label>
                                        <input type="text" name="autorizante"
                                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                            required />
                                    </div>
                                </div>

                                {{-- Fecha estimada de devolución --}}
                                <div class="w-full px-3 xl:w-1/2">
                                    <div class="mb-5">
                                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="fecha_estimada_dev">Fecha Estimada de Devolución</label>
                                        <input type="date" name="fecha_estimada_dev" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                                    </div>
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
                                <textarea name="condiciones"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    rows="4"></textarea>
                            </div>
                        </div>

                    </div>
                    {{-- BTN --}}
                    <div class="flex justify-end gap-4 mt-4">
                        <button type="submit"
                            class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Registrar</button>
                    </div>
            </form>
        </div>
    @endsection
