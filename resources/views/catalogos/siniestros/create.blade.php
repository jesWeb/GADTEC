@extends('layouts.app')

@section('body')
    <div class="flex flex-col gap-9">
        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- titulo --}}
            <h2 class="mb-5 text-xl font-semibold text-gray-700">Registro Siniestros</h2>
            {{-- formulario --}}
            <form action="{{ route('siniestros.store') }} " method="POST">
                {{-- Token CSRF --}}
                @csrf
                <div class="m-3 xl:p-10">
                    {{-- 1ª fila de información --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row">
                        {{-- vehiculo --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar
                                Automóvil:</label>
                            <select name="id_automovil" id="id_automovil"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option selected>Selecciona una opción...</option>
                                @foreach ($automoviles as $automovil)
                                    <option value="{{ $automovil->id_automovil }}">
                                        {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        {{-- Fecha de siniestro --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="fecha_siniestro">Fecha de
                                Siniestro</label>
                            <input
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="date" name="fecha_siniestro" required>
                        </div>
                        {{-- Responsable --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]"
                                for="id_usuario">Responsable</label>

                            <select name="id_usuario"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required>
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id_usuario }}">
                                        {{ $usuario->nombre }} {{ $usuario->app }} {{ $usuario->apm }} -
                                        {{ $usuario->empresa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 2ª fila de información --}}
                    <div class="flex flex-col gap-5.5 mt-5 xl:flex-row">
                        {{-- Costo daños estimados --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="costo_danos_estimados">Costo
                                Daños Estimados</label>
                            <input
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" pattern="^\d*([,.]?\d+)?$" min="0" name="costo_danos_estimados" placeholder="Introduce el costo"
                                required>
                        </div>
                    </div>


                    <div class="flex flex-col gap-5.5 xl:flex-row mt-6">
                        {{-- Descripción --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]"
                                for="descripcion">Descripción del Siniestro</label>
                            <textarea
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                name="descripcion" placeholder="Descripción del siniestro..." required></textarea>
                        </div>
                    </div>

                    {{-- Observaciones --}}
                    <div class="mt-5">
                        <label class="mb-3 block text-base font-medium text-[#07074D]"
                            for="observaciones">Observaciones Adicionales</label>
                        <textarea
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            name="observaciones" placeholder="Observaciones..." ></textarea>
                    </div>

                </div>
                {{-- BTN --}}
                <div class="flex justify-end gap-4 mt-4">
                    <a href="{{ route('siniestros.index') }}"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Registrar</button>
                </div>
            </form>

        </div>
    </div>
@endsection
