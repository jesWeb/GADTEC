{{-- este es un toquen crea una proteccion en el formulario csrf tipo segridad --}}
@csrf

<div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
    {{-- Marca --}}
    <div class="">
        <label class="text-gray-700" for="Marca">Marca</label>
        <select name="Marca" class="w-full mt-2 rounded-md form-input focus:border-indigo-600">
            <option value="yes">Sellecciona una opcion </option>
            <option value="not">no</option>
        </select>
    </div>
    {{-- Submarca --}}
    <div class="">
        <label class="text-gray-700" for="Marca">Submarca</label>
        <select name="Marca" class="w-full mt-2 rounded-md form-input focus:border-indigo-600">
            <option value="yes">Sellecciona una opcion </option>
            <option value="not">no</option>
        </select>
    </div>
    {{-- Modelo --}}
    <div>
        <label class="text-gray-700" for="username">Modelo</label>
        <input class="w-full mt-2 rounded-md form-input focus:border-indigo-600" type="text">
    </div>
    {{--No.serie--}}
    <div>
        <label class="text-gray-700" for="NoSerie">No.Serie</label>
        <input class="w-full mt-2 rounded-md form-input focus:border-indigo-600" type="text">
    </div>
    {{--No.Motor--}}
    <div>
        <label class="text-gray-700" for="emailAddress">No.Motor</label>
        <input class="w-full mt-2 rounded-md form-input focus:border-indigo-600" type="text">
    </div>
    {{--Combustible--}}
    <div class="">
        <label class="text-gray-700" for="Tcombustible">Tipo de combustible</label>
        <select name="Marca" class="w-full mt-2 rounded-md form-input focus:border-indigo-600">
            <option >Selecciona una opcion </option>
            <option value="not">Gasolina</option>
        </select>
    </div>
    {{--Kilometraje --}}
    <div>
        <label class="text-gray-700" for="kilometraje">Kilometraje</label>
        <input class="w-full mt-2 rounded-md form-input focus:border-indigo-600" type="number">
    </div>
    {{--Placas--}}
    <div>
        <label class="text-gray-700" for="placas">Placas</label>
        <input class="w-full mt-2 rounded-md form-input focus:border-indigo-600" type="text">
    </div>
    {{--Num_NSI--}}
    <div>
        <label class="text-gray-700" for="NSI">NSI/Repube</label>
        <input class="w-full mt-2 rounded-md form-input focus:border-indigo-600" type="password">
    </div>
    {{-- uso --}}
    <div class="">
        <label class="text-gray-700" for="uso">Tipo de uso</label>
        <select name="Marca" class="w-full mt-2 rounded-md form-input focus:border-indigo-600" >
            <option disabled >Selecciona una opcion </option>
            <option value="not">Carga</option>
            <option value="not">Comisiones</option>
        </select>
    </div>
    {{--responsable --}}
    {{-- foto --}}
    {{--Observacines  --}}

</div>

<div class="flex justify-end mt-4">
    <button type="submit"
        class="px-4 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Registrar</button>
</div>
