@extends('layouts.app')

@section('body')
<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold text-gray-700 capitalize">Reporte Check-In</h2>

            <form action="{{ route('vigilante.update', $asignacion->id_asignacion) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Vehículo</label>
                        <p class="mt-1 text-gray-600">{{ $asignacion->automovil->marca ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Usuario</label>
                        <p class="mt-1 text-gray-600">{{ $asignacion->usuarios->nombre ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fecha de Asignación</label>
                        <p class="mt-1 text-gray-600">{{ $asignacion->fecha_asignacion ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fecha Estimada de Devolución</label>
                        <p class="mt-1 text-gray-600">{{ $asignacion->fecha_estimada_dev ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Destino</label>
                        <p class="mt-1 text-gray-600">{{ $asignacion->lugar ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Motivo</label>
                        <p class="mt-1 text-gray-600">{{ $asignacion->motivo ?? 'N/A' }}</p>
                    </div>

                    <!-- Campos de Check-In -->
                    <div>
                        <label for="km_salida" class="block text-sm font-medium text-gray-700">KM Salida</label>
                        <input type="number" name="km_salida" id="km_salida" value="{{ old('km_salida') }}" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200" required>
                    </div>
                    <div>
                        <label for="combustible_salida" class="block text-sm font-medium text-gray-700">Combustible Salida</label>
                        <input type="text" name="combustible_salida" id="combustible_salida" value="{{ old('combustible_salida') }}" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200" required>
                    </div>
                    <div>
                        <label for="hora_salida" class="block text-sm font-medium text-gray-700">Hora Salida</label>
                        <input type="time" name="hora_salida" id="hora_salida" 
                            value="{{ old('hora_salida', $asignacion->hora_salida ?? '') }}" 
                            class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200" 
                            required>
                    </div>

                    <div>
                        <label for="km_llegada" class="block text-sm font-medium text-gray-700">KM Llegada</label>
                        <input type="number" name="km_llegada" id="km_llegada" value="{{ old('km_llegada') }}" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200" required>
                    </div>
                    <div>
                        <label for="combustible_llegada" class="block text-sm font-medium text-gray-700">Combustible Llegada</label>
                        <input type="text" name="combustible_llegada" id="combustible_llegada" value="{{ old('combustible_llegada') }}" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200" required>
                    </div>
                    <div>
                        <label for="hora_llegada" class="block text-sm font-medium text-gray-700">Hora Llegada</label>
                        <input type="time" name="hora_llegada" id="hora_llegada" value="{{ old('hora_llegada') }}" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring focus:ring-yellow-200" required>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 text-white bg-yellow-600 border border-transparent rounded-md shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        Crear Check-In
                    </button>
                    <a href="{{ route('vigilante.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
