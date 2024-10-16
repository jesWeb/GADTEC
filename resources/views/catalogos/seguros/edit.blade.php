@extends('layouts.app')

@section('body')
    <div class="flex flex-col gap-9">

        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- titulo --}}
            <h2 class="mb-5 text-xl font-semibold text-gray-700">Registro de Seguros</h2>
            {{-- formulario --}}
            <form action="{{ route('seguros.store') }}" method="POST">
                {{-- este es un toquen crea una proteccion en el formulario csrf tipo segridad --}}
                @csrf

                <div class="m-3 xl:p-10">
                    {{-- 1ra row --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row">
                        {{-- Automóvil --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="automovil">Automóvil</label>
                            <input
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="automovil" placeholder="Marca y modelo" required>
                        </div>
                        {{-- Aseguradora --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]"
                                for="aseguradora">Aseguradora</label>
                            <input
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="aseguradora" placeholder="Nombre de la aseguradora" required>
                        </div>
                    </div>
                    {{-- 2da row --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mt-4">
                        {{-- Fecha de Siniestro --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="fechaSiniestro">Fecha de
                                Siniestro</label>
                            <input type="date" name="fechaSiniestro"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required />
                        </div>
                        {{-- Estatus --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="estatus">Estatus</label>
                            <select name="estatus"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required>
                                <option disabled selected>Selecciona una opción</option>
                                <option value="pendiente">Pendiente</option>
                                <option value="resuelto">Resuelto</option>
                            </select>
                        </div>
                    </div>
                    {{-- 3ra row --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mt-4">
                        {{-- Responsable --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]"
                                for="responsable">Responsable</label>
                            <input
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="responsable" placeholder="Nombre del responsable" required>
                        </div>
                        {{-- Costo Estimado --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="costoEstimado">Costo
                                Estimado</label>
                            <input
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                name="costoEstimado" min="0" step="0.01" type="number" placeholder="$0.00 MXN"
                                required>
                        </div>
                    </div>
                    {{-- 4ta row --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mt-4">
                        {{-- Costo Final --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="costoFinal">Costo
                                Final</label>
                            <input
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                name="costoFinal" min="0" step="0.01" type="number" placeholder="$0.00 MXN"
                                required>
                        </div>
                        {{-- Descripción --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]"
                                for="descripcion">Descripción</label>
                            <textarea
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                name="descripcion" placeholder="Descripción del siniestro" required></textarea>
                        </div>
                    </div>
                    {{-- Observaciones --}}
                    <div class="flex flex-col mt-4">
                        <div class="w-full px-3">
                            <label class="mb-3 block text-base font-medium text-[#07074D]"
                                for="observaciones">Observaciones</label>
                            <textarea
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                name="observaciones" placeholder="Observaciones adicionales"></textarea>
                        </div>
                    </div>
                </div>



                {{-- BTN --}}
                <div class="flex justify-end gap-4 mt-4">
                    {{-- <button class="px-6 py-2 font-semibold bg-gray-200 rounded-md hover:bg-red-200 focus:outline-none focus:bg-red-700">
        Cancelar
    </button> --}}
                    <button type="submit"
                        class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Registrar</button>

                </div>

            </form>
        </div>
    </div>
@endsection
