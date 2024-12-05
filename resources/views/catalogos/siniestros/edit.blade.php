@extends('layouts.app')

@section('body')
    <div class="px-6 py-2">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <div class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Ir a la gestión de vehículos"
                            class="flex items-center text-gray-700 hover:text-gray-900">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                            Gestión
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Catálogos -->
                    <li class="flex items-center">
                        <a href="{{ $backRoute ?? route('catalogos.index') }}" title="Volver a Catálogos"
                            class="text-gray-800 hover:text-gray-800">
                            Catálogos
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <a href="{{ route('siniestros.index') }}" title="Volver a la página de siniestros"
                            class="text-gray-800 hover:text-gray-800">
                            Siniestros
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <p class="text-gray-800 hover:text-gray-800">
                            Actualizar Siniestro
                        </p>
                    </li>
                    </ul>
                </div>
            </nav>
        </div>
        {{-- formulario --}}
        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- titulo --}}
            <h2 class="mb-5 text-xl font-semibold text-gray-700">Actualizar Siniestro</h2>
            {{-- formulario --}}
            <form action="{{ route('siniestros.update', $EddSin->id_siniestro) }} " method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="m-3 xl:p-10">
                    {{-- 1ª fila de información --}}
                    <div class="flex flex-col gap-5.5 xl:flex-row">
                        {{-- vehiculo --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Seleccionar
                                Automóvil:</label>
                            <select name="id_automovil" id="id_automovil" disabled
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                title="Actualizar automóvil seleccionado">
                                <option disabled>Selecciona una opción...</option>
                                @foreach ($automoviles as $automovil)
                                    <option value="{{ $automovil->id_automovil }}"
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
                                type="date" name="fecha_siniestro" value="{{ $EddSin->fecha_siniestro }}"
                                title="Actualizar la fecha del siniestro">
                        </div>
                        {{-- Responsable --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]"
                                for="id_usuario">Responsable</label>
                            <select name="id_usuario"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required title="Actualizar responsable del siniestro">
                                <option disabled {{ old('id_usuario') ? '' : 'selected' }}>Selecciona una opción...
                                </option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id_usuario }}"
                                        {{ $EddSin->id_usuario == $usuario->id_usuario || old('id_usuario') == $usuario->id_usuario ? 'selected' : '' }}>
                                        {{ $usuario->nombre }} {{ $usuario->app }} {{ $usuario->apm }} -
                                        {{ $usuario->empresa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Aplica deducible --}}
                    <div class="flex flex-col gap-5.5 mt-6 mb-4 xl:flex-row">
                        {{-- Monto Pagado --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="monto">
                                Ingresa el monto pagado:
                            </label>
                            <input value="{{ old('monto', $EddSin->monto) }}" type="number" name="monto" id="monto"
                                pattern="^\d*([,.]?\d+)?$" min="0"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />

                        </div>
                        <div class="w-full px-3 xl:w-1/2">
                            <!-- Contenedor del porcentaje -->
                            <div>
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="porcentaje">
                                    Porcentaje:
                                </label>
                                <select name="porcentaje" id="porcentaje"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">

                                    <option value="5"
                                        {{ old('porcentaje', $EddSin->porcentaje) == '5' ? 'selected' : '' }}>
                                        5%
                                    </option>
                                    <option value="10"
                                        {{ old('porcentaje', $EddSin->porcentaje) == '10%' ? 'selected' : '' }}>10%
                                    </option>
                                    <option value="15"
                                        {{ old('porcentaje', $EddSin->porcentaje) == '15' ? 'selected' : '' }}>15%
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="w-full px-3 xl:w-1/2">
                            <!-- Campo de resultado -->
                            <div>
                                <label class="mb-3 block text-base font-medium text-[#07074D]" for="resultado">
                                    Total con descuento:
                                </label>
                                <input type="text" id="resultado" name="resultado" readonly
                                    value="{{ old('resultado', $EddSin->resultado) }}"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-gray-100 py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                            </div>
                        </div>
                    </div>
                    <script>

                        const porcentaje = document.getElementById("porcentaje");
                        const monto = document.getElementById("monto");
                        const resultado = document.getElementById("resultado");

                        // Calcula el resultado cuando el porcentaje cambia o el monto se modifica
                        function calcularResultado() {
                            const montoValue = parseFloat(monto.value);
                            const porcentajeValue = parseFloat(porcentaje.value);

                            if (!isNaN(montoValue) && !isNaN(porcentajeValue)) {
                                const deducible = montoValue * (porcentajeValue / 100);
                                const total = deducible;

                                resultado.value = total.toFixed(2);
                                resultadoContainer.classList.remove("hidden");
                            } else {
                                resultadoContainer.classList.add("hidden");
                                resultado.value = "";
                            }
                        }

                        //  recalcular resultado
                        porcentaje.addEventListener("change", calcularResultado);
                        monto.addEventListener("input", calcularResultado);
                    </script>

                    {{-- 2ª fila de información --}}
                    <div class="flex flex-col gap-5.5 mt-6 xl:flex-row">
                        {{-- Estatus --}}
                        <div class="w-full px-3 xl:w-1/2">
                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="estatus">Estatus</label>
                            <select name="estatus"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                required title="Actualizar el estatus del siniestro">
                                <option value="Pendiente"
                                    {{ old('estatus', $EddSin->estatus) == 'Pendiente' ? 'selected' : '' }}>Pendiente
                                </option>
                                <option value="En Proceso"
                                    {{ old('estatus', $EddSin->estatus) == 'En Proceso' ? 'selected' : '' }}>En Proceso
                                </option>
                                <option value="Cerrado"
                                    {{ old('estatus', $EddSin->estatus) == 'Cerrado' ? 'selected' : '' }}>
                                    Cerrado</option>
                            </select>
                        </div>

                    </div>

                    {{-- Descripción agragar if  --}}
                    <div class="flex flex-col mt-5 gap-5.5 xl:flex-row">

                        <div class="w-full px-3 xl:w-1/2">

                            <label class="mb-3 block text-base font-medium text-[#07074D]" for="descripcion">Descripción
                                del
                                Siniestro</label>
                            <textarea
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                name="descripcion" required title="Actualizar la descripción del siniestro">{{ $EddSin->descripcion }}</textarea>
                        </div>
                    </div>

                    {{-- Observaciones agregar if --}}
                    <div class="mt-5">
                        <label class="mb-3 block text-base font-medium text-[#07074D]"
                            for="observaciones">Observaciones</label>
                        <textarea
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            name="observaciones" placeholder="Observaciones..." title="Actualizar observaciones adicionales">
                        {{ $EddSin->observaciones }}</textarea>
                    </div>
                </div>

                {{-- BTN --}}
                <div class="flex justify-end mt-6 space-x-4">
                    <a href="{{ route('siniestros.index') }}" title="Cancelar la actualización"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                    <button type="submit" title="Actualizar el siniestro"
                        class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
