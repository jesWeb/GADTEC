@extends('layouts.app')

@section('body')
<div class="flex flex-col gap-9">
    <div class="p-6 bg-white border rounded-md shadow-md">
        {{-- titulo --}}
        <h2 class="mb-5 text-xl font-semibold text-gray-700">Registro Siniestros</h2>
        {{-- formulario --}}
        <form action="{{ route('siniestros.update', $EddSin->id_siniestro) }} " method="POST"
            enctype="multipart/form-data"> @csrf
            @method('PATCH')
            <div class="m-3 xl:p-10">
                {{-- 1ª fila de información --}}
                <div class="flex flex-col gap-5.5 xl:flex-row">
                    {{-- vehiculo --}}
                    <div class="w-full px-3 xl:w-1/2">
                        <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar
                            Automóvil:</label>
                        <select name="id_automovil" id="id_automovil" disabled
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                            <option disabled>Selecciona una opción...</option>
                            @foreach ($automoviles as $automovil)
                            <option disavalue="{{ $automovil->id_automovil }}"
                                {{ $EddSin->id_automovil == $automovil->id_automovil ? 'selected' : '' }}>
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
                            type="date" name="fecha_siniestro" value="{{ $EddSin->fecha_siniestro }}">
                    </div>
                    {{-- Responsable --}}
                    <div class="w-full px-3 xl:w-1/2">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="id_usuario">Responsable
                        </label>
                        <select name="id_usuario"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            required>
                            <option disabled {{ old('id_usuario') ? '' : 'selected' }}>Selecciona una opción...</option>
                            @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id_usuario }}"
                                {{ $EddSin->id_usuario == $usuario->id_usuario || old('id_usuario') == $usuario->id_usuario ? 'selected' : '' }}>
                                {{ $usuario->nombre }} {{ $usuario->app }} {{ $usuario->apm }} - {{ $usuario->empresa }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- 2ª fila de información --}}
                <div class="flex flex-col gap-5.5 mt-5 xl:flex-row">
                    {{-- Estatus --}}
                    <div class="w-full px-3 xl:w-1/2">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="estatus">Estatus</label>
                        <select name="estatus"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            required>
                            <option value="Pendiente"
                                {{ old('estatus', $EddSin->estatus) == 'Pendiente' ? 'selected' : '' }}>Pendiente
                            </option>
                            <option value="En Proceso"
                                {{ old('estatus', $EddSin->estatus) == 'En Proceso' ? 'selected' : '' }}>En Proceso
                            </option>
                            <option value="Cerrado"
                                {{ old('estatus', $EddSin->estatus) == 'Cerrado' ? 'selected' : '' }}>Cerrado</option>
                        </select>
                    </div>

                    {{-- Costo daños estimados --}}
                    <div class="w-full px-3 xl:w-1/2">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="costo_danos_estimados">Costo
                            Daños Estimados</label>

                        <input
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            type="text" name="costo_danos_estimados" placeholder="Introduce el costo $Mx"
                            pattern="^\d*([,.]?\d+)?$" min="0"
                            value="{{ number_format($EddSin->costo_danos_estimados, 2, '.', ',') }}"
                            onfocus="this.value = this.value.replace(/[^\d,\.]/g, '')" onblur="formatCurrency(this)">

                    </div>
                </div>

                {{-- Costo daños --}}
                <div class="flex flex-col mt-5 gap-5.5 xl:flex-row">
                    {{-- Descripción --}}
                    <div class="w-full px-3 xl:w-1/2">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="descripcion">Descripción del
                            Siniestro</label>
                        <textarea
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            name="descripcion" required>{{ $EddSin->descripcion }}</textarea>
                    </div>
                </div>

                {{-- Observaciones --}}
                <div class="mt-5">
                    <label class="mb-3 block text-base font-medium text-[#07074D]"
                        for="observaciones">Observaciones</label>
                    <textarea
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        name="observaciones" placeholder="Observaciones...">{{ old('observaciones') }}</textarea>
                </div>
            </div>

            {{-- BTN --}}
            <div class="flex justify-end mt-6 space-x-4">
                <a href="{{ route('siniestros.index') }}"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                <button type="submit"
                    class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Actualizar</button>
            </div>
        </form>

    </div>
</div>
@endsection
