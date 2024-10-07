{{-- este es un toquen crea una proteccion en el formulario csrf tipo segridad --}}
@csrf
<div class="m-4 xl:p-10">
    {{-- 1 row de info --}}
    <div class="flex flex-col gap-5.5 xl:flex-row">
        {{-- vehiculo --}}
        <div class="w-full px-3 xl:w-1/2">
            <div class="mb-5">
                <label class="mb-3 block text-base font-medium text-[#07074D]" for="vehiculo">Automovil</label>
                <select name="Marca"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    required>
                    <option disabled selected>Selecciona una opción </option>
                    <option value="Gasolina">carros</option>
                </select>
            </div>
        </div>
        {{-- responsable --}}
        <div class="w-full px-3 xl:w-1/2">
            <div class="mb-5">
                <label class="mb-3 block text-base font-medium text-[#07074D]" for="usuario">Solicitante</label>
                <select name="Marca"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    required>
                    <option disabled selected>Selecciona una opción </option>
                    <option value="">persona 1</option>
                </select>
            </div>
        </div>
        {{-- fecha asiganacion --}}
        <div class="w-full px-3 xl:w-1/2">
            <div class="mb-5">
                <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
                    Fecha Reservación
                </label>
                <input type="date" name="date"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
        </div>
    </div>
    {{-- 2 row de informacion --}}
    <div class="flex flex-col gap-5.5 mt-3  xl:flex-row">
        {{-- hora de salida  --}}
        <div class="w-full px-3 xl:w-1/2">
            <div class="mb-5">
                <label class="mb-3 block text-base font-medium text-[#07074D]" for="hora">Hora de salida </label>
                <input
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    type="time" name="hora" id="" required>
            </div>
        </div>
        {{-- destino --}}
        <div class="w-full px-3 xl:w-1/2">
            <div class="mb-5">
                <label class="mb-3 block text-base font-medium text-[#07074D]" for="destino">Destino</label>
                <input
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    type="text" name="destino" required placeholder="Ej. Santa fe, CDMX">
            </div>
        </div>
        {{-- Motivo --}}
        <div class="w-full px-3 xl:w-1/2">
            <div class="mb-5">
                <label class="mb-3 block text-base font-medium text-[#07074D]" for="motivo">Motivo</label>
                <input
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    type="text" name="motivo" required placeholder="Ej. Salida">
            </div>
        </div>
    </div>
    {{-- 3 row de info  --}}
    <div class="flex flex-col gap-5 mt-3 mb-5 xl:flex-row">
        {{-- Motivo --}}
        <div class="w-full px-3 xl:w-1/3">
            <div class="mb-5">
                <label for="date" class="mb-3 block text-base font-medium text-[#07074D]">
                    Fecha Reingreso
                </label>
                <input type="date" name="date"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
            </div>
        </div>
        {{-- Asignante --}}

        <div class="w-full px-3 xl:w-1/3">
            <div class="mb-5">
                <label class="mb-3 block text-base font-medium text-[#07074D]" for="motivo">Asignador</label>
                <input
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    type="text" name="motivo" required placeholder="Ej. Nombre">
            </div>
        </div>

    </div>
    
</div>
{{--BTN--}}
<div class="flex justify-end gap-4 mt-4">
    <button class="px-6 py-2 font-semibold bg-gray-200 rounded-md hover:bg-red-200 focus:outline-none focus:bg-red-700">
        Cancelar
    </button>
    <button type="submit"
        class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Registrar</button>

</div>
