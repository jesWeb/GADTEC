<!-- - Esta es los datos adicionaeles que se incluyen en la vista principal -- -->
<div id="camp_servicios">
    <div>
        <label class="block text-base font-medium text-[#07074D]" for="fecha_servicio">Fecha de Servicio</label>
            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                type="date" name="fecha_servicio" value="{{ old('fecha_servicio') }}" id="fecha_servicio" placeholder="">
            <div id="VehiculoOrigenHelp" class="mt-1 text-sm text-red-600">
                @error('fecha_servicio')<i>{{ $message }}</i>@enderror
            </div>
    </div>

    <div>
        <label class="block text-base font-medium text-[#07074D]" for="prox_servicio">Fecha de Proximo de Servicio</label>
            <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                type="date" name="prox_servicio" value="{{ old('aprox_servicio') }}" id="prox_servicioe">
            <div id="prox_servicioHelp" class="mt-1 text-sm text-red-600">
                @error('prox_servicio')<i>{{ $message }}</i>@enderror
            </div>
    </div>
</div>
