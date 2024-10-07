{{-- este es un toquen crea una proteccion en el formulario csrf tipo segridad --}}
@csrf
<div class="">

    <div class="grid grid-cols-3 gap-6 m-5 sm:grid-cols-2">
        {{-- vehiculo--}}
        <div class="">
            <label class="text-gray-700" for="combustible">Marca</label>
            <select name="Marca" class="w-full mt-2 rounded-md form-input focus:border-indigo-600" required>
                <option disabled selected>Selecciona una opción </option>
                <option value="Gasolina">carros</option>

            </select>
        </div>
        {{-- seguro--}}
        <div class="">
            <label class="text-gray-700" for="combustible">SubMarca</label>
            <select name="Marca" class="w-full mt-2 rounded-md form-input focus:border-indigo-600" required>
                <option disabled selected>Selecciona una opción </option>
                <option value="Gasolina">carros</option>

            </select>
        </div>
        {{-- Fecha de siniestro--}}
        <div class="">
            <label class="text-gray-700" for="combustible">Modelo</label>
            <select name="Marca" class="w-full mt-2 rounded-md form-input focus:border-indigo-600" required>
                <option disabled selected>Selecciona una opción </option>
                <option value="Gasolina">carros</option>

            </select>
        </div>
        {{-- estatus --}}
        <div>
            <label class="text-gray-700" for="serie">No.Serie</label>
            <input class="w-full mt-2 rounded-md form-input focus:border-indigo-600" type="text">
        </div>
        {{-- descipcion --}}

        <div class="">
            <label for="observaciones">Observaciones del vehiculo</label>
            <textarea placeholder="Observaciones ..." class="block w-full bg-blue-500 rounded-sm shadow-sm" name="observaciones"
                id=""></textarea>
        </div>
        {{-- costo danos estimados--}}
        <div class="">
            <label class="text-gray-700" for="combustible">Tipo de combustible</label>
            <select name="Marca" class="w-full mt-2 rounded-md form-input focus:border-indigo-600" required>
                <option disabled selected>Selecciona una opcion </option>
                <option value="Gasolina">Gasolina</option>
                <option value="Diesel">Diesel</option>
                <option value="Electrico">Electrico</option>
            </select>
        </div>
        {{--costo real dano --}}
        <div>
            <label class="text-gray-700" for="kilometraje">Kilometraje</label>
            <input class="w-full mt-2 rounded-md form-input focus:border-indigo-600" type="number"
                placeholder="Introduce el kilometraje" pattern="^\d*\.?\d+$" min="0" required>
        </div>
        {{-- responsable --}}
        <div class="">
            <label class="text-gray-700" for="responsable">Responsable</label>
            <select name="Marca" class="w-full mt-2 rounded-md form-input focus:border-indigo-600" required>
                <option disabled selected>Selecciona una opción </option>
                <option value="usuario">Usuario</option>
            </select>
        </div>
        {{-- Observacines  --}}
        <div class="">
            <label for="observaciones">Observaciones del vehiculo</label>
            <textarea placeholder="Observaciones ..." class="block w-full bg-blue-500 rounded-sm shadow-sm" name="observaciones"
                id=""></textarea>
        </div>
    </div>
</div>
{{-- btn --}}
<div class="flex justify-end mt-4">
    <button type="submit"
        class="px-4 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Registrar</button>
</div>
