@extends('layouts.app')

@section('body')
    <div class="flex flex-col gap-9">

        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- titulo --}}
            <h2 class="mb-5 text-xl font-semibold text-gray-700">Registro Siniestros</h2>
            {{-- formulario --}}
            <form action="{{route('asignacion.store')}} " method="POST">
                {{-- Token CSRF --}}
                @csrf
                <div class="m-3 xl:p-10">
                    {{-- 1ª fila de información --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row">
                        {{-- Fecha de siniestro --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="fecha_siniestro">Fecha de Siniestro</label>
                            <input
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="date" name="fecha_siniestro" required>
                        </div>

                        {{-- Descripción --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="descripcion">Descripción</label>
                            <textarea
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                name="descripcion" placeholder="Descripción del siniestro..." required></textarea>
                        </div>
                    </div>

                    {{-- 2ª fila de información --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row">
                        {{-- Estatus --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="estatus">Estatus</label>
                            <select name="estatus"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required>
                                <option disabled selected>Selecciona una opción</option>
                                <option value="Pendiente">Pendiente</option>
                                <option value="En Proceso">En Proceso</option>
                                <option value="Cerrado">Cerrado</option>
                            </select>
                        </div>

                        {{-- Costo daños estimados --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="costo_danos_estimados">Costo Daños Estimados</label>
                            <input
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="number" name="costo_danos_estimados" placeholder="Introduce el costo" min="0" required>
                        </div>
                    </div>

                    {{-- Costo real daños --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row">
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="costo_real_danos">Costo Real Daños</label>
                            <input
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="number" name="costo_real_danos" placeholder="Introduce el costo" min="0" required>
                        </div>

                        {{-- Responsable --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="responsable">Responsable</label>
                            <select name="responsable"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required>
                                <option disabled selected>Selecciona una opción</option>
                                <option value="usuario1">Usuario 1</option>
                                <option value="usuario2">Usuario 2</option>
                            </select>
                        </div>
                    </div>

                    {{-- Observaciones --}}
                    <div class="mt-5">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="observaciones">Observaciones</label>
                        <textarea
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            name="observaciones" placeholder="Observaciones..." required></textarea>
                    </div>

                </div>

                {{-- Botones --}}
                <div class="flex justify-end gap-4 mt-4">
                    <button type="button"
                        class="px-6 py-2 font-semibold bg-gray-200 rounded-md hover:bg-red-200 focus:outline-none focus:bg-red-700">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Registrar</button>
                </div>
            </form>

        </div>
    </div>
@endsection
