{{-- este es un toquen crea una proteccion en el formulario csrf tipo segridad --}}
@csrf


<div class="m-3 xl:p-10">

    {{--1 row de info  --}}
    <div class="flex flex-col gap-5.5 xl:flex-row">
        {{-- vehiculo--}}
        <div class="w-full px-3 xl:w-1/2">

            <label class="mb-3 block text-base font-medium text-[#07074D]" for="automovil">Automovil</label>
            <select name="automovil"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                required>
                <option disabled selected>Selecciona una opción </option>
                <option value="Gasolina">carros</option>

            </select>

        </div>
        {{-- seguro--}}
        <div class="w-full px-3 xl:w-1/2">
            <div class="mb-5">
                <label class="mb-3 block text-base font-medium text-[#07074D]" for="combustible">SubMarca</label>
                <select name="Marca"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    required>
                    <option disabled selected>Selecciona una opción </option>
                    <option value="">carros</option>
                </select>
            </div>
        </div>
        {{-- Fecha de siniestro--}}
        <div class="w-full px-3 xl:w-1/2">

            <label class="mb-3 block text-base font-medium text-[#07074D]" for="combustible">Modelo</label>
            <select name="Marca"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                required>
                <option disabled selected>Selecciona una opción </option>
                <option value="Gasolina">carros</option>

            </select>

        </div>
    </div>
    {{-- 2 row de info  --}}
    <div class="flex flex-col gap-5.5 xl:flex-row">
        {{-- estatus --}}
        <div class="w-full px-3 xl:w-1/2">
            <div class="mb-5">
                <label class="mb-3 block text-base font-medium text-[#07074D]" for="serie">No.Serie</label>
                <input
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                    type="text">
            </div>
        </div>
        {{-- responsable --}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="responsable">Responsable</label>
            <select name="Marca"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                required>
                <option disabled selected>Selecciona una opción </option>
                <option value="usuario">Usuario</option>
            </select>
        </div>
        {{-- costo danos estimados--}}
        <div class="w-full px-3 xl:w-1/2">
            <label class="mb-3 block text-base font-medium text-[#07074D]" for="combustible">Tipo de combustible</label>
            <select name="Marca"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                required>
                <option disabled selected>Selecciona una opcion </option>
                <option value="Gasolina">Gasolina</option>
                <option value="Diesel">Diesel</option>
                <option value="Electrico">Electrico</option>
            </select>
        </div>
    </div>

    {{--costo real dano --}}
    {{-- <div>
        <label class="text-gray-700" for="kilometraje">Kilometraje</label>
        <input class="w-full mt-2 rounded-md form-input focus:border-indigo-600" type="number"
            placeholder="Introduce el kilometraje" pattern="^\d*\.?\d+$" min="0" required>
    </div> --}}

    {{-- descipcion --}}
    {{-- <div class="">
        <div class="mb-5">
            <label for="observaciones">Observaciones del vehiculo</label>
            <textarea placeholder="Observaciones ..." class="block w-full bg-blue-500 rounded-sm shadow-sm"
                name="observaciones" id=""></textarea>
        </div>
    </div> --}}

    {{-- Observacines  --}}
    {{-- <div class="">
        <label for="observaciones">Observaciones del vehiculo</label>
        <textarea placeholder="Observaciones ..." class="block w-full bg-blue-500 rounded-sm shadow-sm"
            name="observaciones" id=""></textarea>
    </div> --}}

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
