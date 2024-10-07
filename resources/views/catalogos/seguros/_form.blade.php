{{-- este es un toquen crea una proteccion en el formulario csrf tipo segridad --}}
@csrf

<div class="m-3 xl:p-10">
    {{-- 1ra row  --}}
    <div class="flex flex-col gap-5.5 xl:flex-row">
        {{-- vehiculo --}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="vehiculo">Vehiculo</label>
            <select name="Marca"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                required>
                <option disabled selected>Selecciona una opción </option>
                <option value="">carros</option>

            </select>
        </div>
        {{-- Aseguradora --}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="aseguradora">Aseguradora</label>
            <input
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                type="text" placeholder="Nombre">
        </div>

        <div class="w-full px-3 xl:w-1/2">
            <div class="mb-5">
                <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
                    Fecha de Vigencia
                </label>
                <input type="date" name="date"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
        </div>
    </div>
    {{-- 2ra row --}}
    <div class="flex flex-col gap-5.5 xl:flex-row mt-4">
        {{-- Cobertura --}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="cobertura">Cobertura</label>
            <select name="Marca"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                required>
                <option disabled selected>Selecciona una opción </option>
                <option value="">carros</option>
            </select>
        </div>
        {{-- estatus --}}
        <div class="w-full px-3 xl:w-1/2">
            <div class="">
                <label class="mb-3 block text-base font-medium text-[#07074D]" for="uso">Estatus</label>
                <select name="Marca"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    required>
                    <option disabled selected>Selecciona una opción </option>
                    <option value="">Disponible</option>
                </select>
            </div>
        </div>
        {{--  --}}

    </div>
    {{-- 3row info  --}}
    <div class="flex flex-col gap-5.5 xl:flex-row mt-4">
        {{-- Monto --}}
        <div class="w-full px-3 xl:w-1/2">
            <div class="mb-5">
                <label class="mb-3 block text-base font-medium text-[#07074D]" for="monto">Monto</label>
                <input
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                   name="monto" min="0" step="0.01"  type="number" placeholder="$0.00 MXN">
            </div>
        </div>
        {{-- Afiliacion --}}
        <div class="w-full px-3 xl:w-1/2">
            <div class="mb-5">
                <label class="mb-3 block text-base font-medium text-[#07074D]" for="afiliacion">Afilicion</label>
                <select name="Marca"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    required>
                    <option disabled selected>Selecciona una opción </option>
                    <option value="usuario">Usuario</option>
                </select>
            </div>
        </div>
    </div>

    {{-- foto --}}
    <div class="pt-4 mb-6">
        <label class="mb-5 block text-xl font-semibold text-[#07074D]">
            Subir Archivos
        </label>
        <div class="mb-8">
            <input type="file" name="file" id="file" class="sr-only" />
            <label for="file"
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
                </div>
            </label>
        </div>

    </div>

</div>


{{-- BTN --}}
<div class="flex justify-end gap-4 mt-4">
    <button class="px-6 py-2 font-semibold bg-gray-200 rounded-md hover:bg-red-200 focus:outline-none focus:bg-red-700">
        Cancelar
    </button>
    <button type="submit"
        class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Registrar</button>

</div>
