@extends('layouts.app')

@section('body')
    <div class="flex flex-col mt-5 gap-9">

        <div class="p-6 bg-white border rounded-md shadow-md">
            <div class="flex justify-between mb-3">
                <h2 class="mb-4 text-lg font-semibold text-gray-700 capitalize">Verificaciones vehiculares</h2>
                <div class="py-3">
                    <a href="{{ route('catalogos.index') }}"
                        class="flex items-center justify-center w-12 h-10 text-white rounded-full shadow">
                        <img src="/img/arrow-back.svg" alt="">
                    </a>
                </div>
            </div>
            <form action="{{ route('verificaciones.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="m-3 xl:p-10 xl:m-5">

                    <!-- Mensajes de error -->
                    @if ($errors->any())
                        <div class="p-4 mb-5 text-red-700 bg-red-100 border-l-4 border-red-500">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Selección de automóvil -->
                    <div class="flex flex-col gap-5.5 mt-4 xl:flex-row">
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">
                                Seleccionar Automóvil:
                            </label>
                            <select name="id_automovil" id="id_automovil" required
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option disabled selected>Selecciona una opción...</option>
                                @foreach ($automoviles as $automovil)
                                    <option value="{{ $automovil->id_automovil }}"
                                        {{ old('id_automovil') == $automovil->id_automovil ? 'selected' : '' }}>
                                        {{ $automovil->marca }} {{ $automovil->modelo }} ({{ $automovil->submarca }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Engomado -->
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="engomado">
                                Engomado
                            </label>
                            <select name="engomado" id="engomado" required
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                                <option disabled selected>Selecciona una opción</option>
                                @foreach (['Verde', 'Amarillo', 'Rosa', 'Rojo', 'Azul'] as $color)
                                    <option value="{{ $color }}" {{ old('engomado') == $color ? 'selected' : '' }}>
                                        {{ $color }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Holograma -->
                        <div class="w-full px-3 xl:w-1/2">
                            <label class=" block text-base font-medium text-[#07074D]" for="holograma">
                                Holograma
                            </label>
                            <input type="text" name="holograma" id="holograma" value="{{ old('holograma') }}"
                                class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                placeholder="Ingresa el Holograma" required>
                        </div>
                    </div>

                    <!-- Fechas -->
                    <div class="flex flex-col gap-5.5 mt-4 xl:flex-row">
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="fecha_verificacion" class="mb-3 block text-base font-medium text-[#07074D]">
                                Fecha de Verificación
                            </label>
                            <input type="date" name="fechaV" id="fechaV" value="{{ old('fechaV') }}"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required>
                        </div>
                        <div class="w-full px-3 xl:w-1/2">
                            <div class="xl:mb-5">
                                <label class="block text-base font-medium text-[#07074D]" for="proxima_verificacion">Próxima
                                    Verificación</label>
                                <input
                                    class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    type="text" name="proxima_verificacion" id="fechaP" placeholder="Próxima verificación"
                                     value="{{ old('fechaP', $proximaFecha ?? '') }} "
                                    readonly>
                                </div>
                            </div>

                        </div>

                        <!-- Observaciones -->
                        <div class="w-full xl:m-5 xl:w-2/4 xl:mt-4 xl:mb-4">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="observaciones">
                                Observaciones del vehículo
                            </label>
                            <textarea name="observaciones" id="observaciones" placeholder="Observaciones..."
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">{{ old('observaciones') }}</textarea>
                        </div>

                        <!-- Subir Archivos -->
                        <div class="pt-4 mb-6">
                            <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                                Subir Archivos
                            </label>
                            <input type="file" name="image" id="image" class="sr-only" multiple />
                            <label for="image"
                                class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                <span class="text-xl font-semibold text-[#07074D]">Subir archivo</span>
                            </label>
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end gap-4 mt-4">
                            <a href="{{ route('verificaciones.index') }}"
                                class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Registrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
@endsection
