@extends('layouts.app')
@section('body')
    <div class="mt-4">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-xl font-semibold text-gray-700">Editar Automovil </h2>
            {{--  --}}
            <form action="{{route('Automovil.update',$EddCar->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="m-3 xl:p-10">

                    {{-- 1st row of info --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-3">

                        {{-- Marca --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="marca">Marca</label>
                                <input
                                type="text"
                                name="marca"
                                value="{{$EddCar->marca}}"
                                placeholder="Ingresa la marca"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                >
                            </div>
                        </div>

                        {{-- Submarca --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="submarca">Submarca</label>
                                <input
                                 type="text"
                                  name="submarca"
                                  id="submarca"
                                  value="{{$EddCar->submarca}}"
                                  placeholder="Ingresa la submarca"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"

                            </div>
                        </div>

                        {{-- Modelo --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="modelo">Modelo</label>
                                <input type="number" name="modelo" id="modelo" placeholder="Ingresa el año"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                  value="{{$EddCar->modelo}}"
                            </div>
                        </div>
                    </div>

                    {{-- 2nd row of info --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-3">

                        {{-- No.serie --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="serie">No.
                                    Serie</label>
                                <input type="text" name="serie" id="serie"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ old('serie', $EddCar->serie) }}">
                            </div>
                        </div>

                        {{-- No.Motor --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="motor">No.
                                    Motor</label>
                                <input type="text" name="motor" id="motor" required
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ old('motor',$EddCar->motor) }}">
                            </div>
                        </div>

                        {{-- Combustible --}}
                        <div class="w-full px-3 xl:w-1/2">
                            {{-- <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="combustible">Tipo de
                                    combustible</label>
                                <select name="combustible"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    required>
                                    <option disabled selected>Selecciona una opción</option>
                                    <option value="Gasolina"
                                        {{ old('combustible', $$EddCar->combustible) == 'Gasolina' ? 'selected' : '' }}>
                                        Gasolina</option>
                                    <option value="Diesel"
                                        {{ old('combustible', $$EddCar->combustible) == 'Diesel' ? 'selected' : '' }}>Diesel
                                    </option>
                                    <option value="Electrico"
                                        {{ old('combustible', $$EddCar->combustible) == 'Electrico' ? 'selected' : '' }}>
                                        Eléctrico</option>
                                </select>
                            </div> --}}
                        </div>

                    </div>
                    {{-- 3 row --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-3">
                        {{-- Kilometraje --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="kilometraje">Kilometraje</label>
                                <input type="number" placeholder="Introduce el kilometraje" min="0" required
                                    name="kilometraje"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ old('kilometraje', $EddCar->kilometraje) }}">
                            </div>
                        </div>

                        {{-- Placas --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="placas">Placas</label>
                                <input type="text" placeholder="Introduce Placas" required name="placas"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ old('placas', $EddCar->placas) }}">
                            </div>
                        </div>

                        {{-- Num_NSI --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="NSI">NSI/Repube</label>
                                <input type="text" placeholder="Introduce NSI" name="NSI" required
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    value="{{ old('NSI', $EddCar->NSI) }}">
                            </div>
                        </div>
                    </div>
                    {{-- 4 row  --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row mb-3">
                        {{-- Uso --}}
                        <div class="w-full px-3 xl:w-1/4">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="uso">Tipo de
                                    uso</label>
                                <input type="text" name="uso" required
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    placeholder="Ingresa el tipo de uso" >
                            </div>
                        </div>

                        {{-- Responsable --}}
                        <div class="w-full px-3 xl:w-1/4">
                            <div class="xl:mb-5">
                                <label class="mb-3 block text-base font-medium text-[#07074D]"
                                    for="responsable">Responsable</label>
                                <input type="text" name="responsable" required
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    placeholder="Ingresa el nombre del responsable"
                                    value="{{ old('responsable', $EddCar->responsable) }}" />
                            </div>
                        </div>
                    </div>


                    {{-- Observaciones --}}
                    <div class="w-full xl:m-5 xl:w-2/4 xl:mt-4 xl:mb-4">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="observaciones">Observaciones
                            del vehículo</label>
                        <textarea placeholder="Observaciones ..."
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            name="observaciones">{{ old('observaciones', $EddCar->observaciones) }}</textarea>
                    </div>

                    {{-- File Upload --}}
                    <div class="mb-8">
                        <input type="file" name="image" id="image" class="sr-only" multiple />
                        <label for="image"
                            class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                            <div>
                                <span class="mb-2 block text-xl font-semibold text-[#07074D]">Drop files here</span>
                                <span class="mb-2 block text-base font-medium text-[#6B7280]">Or</span>
                                <span
                                    class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">Browse</span>
                                <div id="file-info" class="mt-4">
                                    <span id="file-count">0 archivos seleccionados.</span>
                                    <ul id="file-names" class="pl-5 list-disc"></ul>
                                </div>
                            </div>
                        </label>
                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection
