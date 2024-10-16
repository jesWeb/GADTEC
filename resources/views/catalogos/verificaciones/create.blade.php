@extends('layouts.app')

@section('body')
    <div class="flex flex-col mt-5 gap-9">

        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- titulo --}}
            <h2 class="mb-5 text-xl font-semibold text-gray-700">
                <h2 class="text-xl font-semibold text-gray-700">Registro Verificaciones</h2>

            </h2>
            {{-- formulario --}}
            <form action="{{ route('verificaciones.store') }}" enctype="multipart/form-data" method="POST">
                {{-- @include('catalogos.verificaciones._form') --}}
                {{-- este es un toquen crea una proteccion en el formulario csrf tipo segridad --}}
                @csrf
                <div class="m-4 xl:p-10">
                    {{-- 1 row info --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row">
                        {{-- vehiculo --}}
                        {{-- <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="vehiculo">Vehiculo</label>
            <select name="Marca"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                required>
                <option disabled selected>Selecciona una opción </option>
                <option value="">carros</option>

            </select>
        </div> --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="vehiculo">Vehículo</label>
                            <input type="text" name="vehiculo" id="vehiculo"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                placeholder="Ingresa el vehículo" required>
                        </div>

                        {{-- engomado --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="engomado">Engomado</label>
                            <select name="engomado"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required>
                                <option disabled selected>Selecciona una opción </option>
                                <option value="amarillo">Amarillo</option>
                                <option value="azul">azul</option>
                                <option value="rojo">rojo</option>

                            </select>
                        </div>
                        {{-- Holograma --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="text-gray-700" for="holograma">holograma</label>
                            <input type="text" name="holograma"
                                class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                placeholder="Ingresa el Holograma" required>
                        </div>

                    </div>
                    {{-- 2row info --}}
                    <div class="flex flex-col gap-5.5 mt-4 xl:flex-row">
                        {{-- fecha Verificacion --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="mb-5">
                                <label for="fechaV" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Fecha de Verificacion
                                </label>
                                <input type="date" name="fechaV" id="fechaV"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>

                        {{-- Próxima verificación --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="text-gray-700" for="fechaP">Próxima Verificación</label>
                            <input
                                class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                type="text" name="fechaP" id="fechaP" placeholder="Próxima verificación" readonly>
                        </div>

                    </div>
                    {{-- observaciones --}}
                    <div class="w-full xl:m-5 xl:w-2/4 xl:mt-4 xl:mb-4">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="observaciones">Observaciones
                            del
                            vehiculo</label>
                        <textarea placeholder="Observaciones ..."
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            name="observaciones" id=""></textarea>
                    </div>

                    {{-- foto --}}
                    <div class="pt-4 mb-6">
                        <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                            Subir Archivos
                        </label>
                        <div class="mb-8">
                            <input type="file" name="image" id="image" class="sr-only" multiple />
                            <label for="image"
                                class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                <div>
                                    <span class="mb-2 block text-xl font-semibold text-[#07074D]">
                                        Drop files here
                                    </span>
                                    <span class="mb-2 block text-base font-medium text-[#6B7280]">
                                        Or
                                    </span>
                                    <span
                                        class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                        Browse
                                    </span>
                                    <div id="file-info" class="mt-4">
                                        <span id="file-count">0 archivos seleccionados..</span>
                                        <ul id="file-names" class="pl-5 list-disc"></ul>
                                    </div>
                                </div>

                            </label>
                        </div>
                    </div>


                    <script>
                        document.getElementById('fechaV').addEventListener('change', function() {
                            const fechaUltima = new Date(this.value);

                            if (isNaN(fechaUltima)) {
                                console.error('La fecha ingresada es inválida');
                                return;
                            }

                            const ProximaFecha = new Date(fechaUltima);
                            ProximaFecha.setMonth(fechaUltima.getMonth() + 6);

                            document.getElementById('fechaP').value = ProximaFecha.toISOString().split('T')[0];
                        })
                    </script>


                    {{-- BTn --}}
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
