@extends('layouts.app')

@section('body')
    <div class="flex flex-col mt-5 gap-9">

        <div class="p-6 bg-white border rounded-md shadow-md">
            <div class="flex justify-between mb-3">
                <h2 class="mb-4 text-lg font-semibold text-gray-700 capitalize">Verificaciones vehiculares</h2>
                {{-- arrow back --}}
                <div class="py-3">
                    <a href="{{ route('catalogos.index') }}"
                        class="flex items-center justify-center w-12 h-10 text-white rounded-full shadow ">
                        <img src="/img/arrow-back.svg" alt="">
                    </a>
                </div>
            </div>
            {{-- formulario --}}
            <form action="{{ route('verificaciones.store') }}" enctype="multipart/form-data" method="POST">

                @csrf
                <div class="m-3 xl:p-10 xl:m-5">
                    {{-- 1 row info --}}
                    <div class="flex flex-col gap-5.5 mt-4 xl:flex-row">
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar
                                Automóvil:</label>
                            <select name="id_automovil" id="id_automovil"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach ($automoviles as $automovil)
                                    <option value="{{ $automovil->id_automovil }}">
                                        {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        {{-- engomado --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="engomado">Engomado</label>
                                <select name="engomado"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                                    <option disabled selected>Selecciona una opción </option>
                                    <option value="amarillo">Amarillo</option>
                                    <option value="azul">azul</option>
                                    <option value="rojo">rojo</option>

                                </select>
                            </div>
                        </div>
                        {{-- Holograma --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="holograma">Holograma</label>
                                <input type="text" name="holograma"
                                    class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    placeholder="Ingresa el Holograma" required>
                            </div>
                        </div>
                    </div>
                    {{-- 2row info --}}
                    <div class="flex flex-col gap-5.5 mt-4 xl:flex-row">
                        {{-- fecha Verificacion --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label for="fechaV" class="mb-3 block text-base font-medium text-[#07074D]">
                                    Fecha de Verificacion
                                </label>
                                <input type="date" name="fechaV" id="fechaV"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>

                        {{-- Próxima verificación --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="fechaP">Próxima
                                    Verificación</label>
                                <input
                                    class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" name="fechaP" id="fechaP" placeholder="Próxima verificación"
                                    readonly>
                            </div>
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
                    {{-- BTN --}}
                    <div class="flex justify-end gap-4 mt-4">
                        <a href="{{ route('verificaciones.index') }}"
                            class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                        <button type="submit"
                            class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Registrar</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
