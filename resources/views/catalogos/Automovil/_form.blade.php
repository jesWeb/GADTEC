{{-- este es un toquen crea una proteccion en el formulario csrf tipo segridad --}}
@csrf
<div class="m-3 xl:p-10">
    {{-- `1 row de info --}}
    <div class="flex flex-col gap-5.5 xl:flex-row">
        {{-- Marca --}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="combustible">Marca</label>
            <select name="Marca" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required>
                <option disabled selected>Selecciona una opción </option>
                <option value="Gasolina">carros</option>

            </select>
        </div>
        {{-- subMarca --}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="combustible">SubMarca</label>
            <select name="Marca" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required>
                <option disabled selected>Selecciona una opción </option>
                <option value="Gasolina">carros</option>

            </select>
        </div>
        {{-- Modelo --}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="combustible">Modelo</label>
            <select name="Marca" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required>
                <option disabled selected>Selecciona una opción </option>
                <option value="Gasolina">carros</option>

            </select>
        </div>
    </div>
    {{-- 2 row info  --}}
    <div class="flex flex-col gap-5.5 xl:flex-row">
        {{-- No.serie --}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="serie">No.Serie</label>
            <input class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" type="text">
        </div>
        {{-- No.Motor --}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="motor">No.Motor</label>
            <input class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" type="text">
        </div>
        {{-- Combustible --}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="combustible">Tipo de combustible</label>
            <select name="Marca" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required>
                <option disabled selected>Selecciona una opcion </option>
                <option value="Gasolina">Gasolina</option>
                <option value="Diesel">Diesel</option>
                <option value="Electrico">Electrico</option>
            </select>
        </div>
    </div>
    {{-- 3 row nfo --}}
    <div class="flex flex-col gap-5.5 xl:flex-row">
        {{-- Kilometraje --}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="kilometraje">Kilometraje</label>
            <input class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" type="number"
                placeholder="Introduce el kilometraje" pattern="^\d*\.?\d+$" min="0" required>
        </div>
        {{-- Placas --}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="placas">Placas</label>
            <input class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" type="text"
                placeholder="Introduce Placas" required>
        </div>
        {{-- Num_NSI --}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="NSI">NSI/Repube</label>
            <input class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" type="text"
                placeholder="Introduce NSI" required>
        </div>
    </div>
    {{-- 4 row info --}}
    <div class="flex flex-col gap-5.5 xl:flex-row">
         {{-- uso --}}
        <div class="w-full px-3 xl:w-1/4">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="uso">Tipo de uso</label>
            <select name="Marca" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required>
                <option disabled selected>Selecciona una opción </option>
                <option value="not">Carga</option>
                <option value="comisiones ">Comisiones</option>
            </select>
        </div>
        {{-- responsable --}}
        <div class="w-full px-3 xl:w-1/4">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="responsable">Responsable</label>
            <select name="Marca" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required>
                <option disabled selected>Selecciona una opción </option>
                <option value="usuario">Usuario</option>
            </select>
        </div>
    </div>
     {{-- Observacines  --}}
     <div class="w-full xl:mt-3 xl:w-2/4">
        <label class="mb-3 block text-base font-medium text-[#07074D]" for="observaciones">Observaciones del vehiculo</label>
        <textarea placeholder="Observaciones ..." class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" name="observaciones"
            id=""></textarea>
    </div>
    {{-- fotos --}}
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
    <button type="button"
        class="px-6 py-2 font-semibold bg-gray-200 rounded-md hover:bg-red-200 focus:outline-none focus:bg-red-700">
        Cancelar
    </button>
    <button type="submit"
        class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Registrar</button>
</div>
