@extends('layouts.app')
@section('body')
<div class="container px-4 mx-auto">
    <div class="flex justify-center mt-8">
        <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-lg">
            {{-- info main --}}
            <h1 class="text-lg font-semibold tracking-wide text-center text-indigo-500 md:m-5">Informacion de
                Automovil
            </h1>
            <div class="flex flex-col gap-5.5 xl:flex-row mb-3">
                <div class="w-full px-3 xl:w-1/2">
                    <div class="mb-6">
                        <p class="text-lg font-semibold text-gray-800">Marca:</p>
                        <p class="text-xl font-bold text-green-600">{{ $automovil->marca }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-lg font-semibold text-gray-800">Submarca</p>
                        <p class="text-gray-600">{{ $automovil->submarca }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-lg font-semibold text-gray-800">Modelo</p>
                        <p class="text-gray-600">{{ $automovil->modelo }}</p>
                    </div>
                </div>
                {{--  --}}
                <div class="">
                    <div class="mb-4">
                        <p class="text-lg font-semibold text-gray-800">Numero de Serie</p>
                        <p class="text-gray-600">{{ $automovil->num_serie }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-lg font-semibold text-gray-800">Numero Motor</p>
                        <p class="text-gray-600">{{ $automovil->num_motor }}</p>
                    </div>

                    <div class="mb-4">
                        <p class="text-lg font-semibold text-gray-800">NSI/Repube</p>
                        <p class="text-gray-600">{{ $automovil->num_nsi }}</p>
                    </div>
                </div>
                <div class="">
                    <div class="mb-4">
                        <p class="text-lg font-semibold text-gray-800">Capacidad de combustible</p>
                        <p class="text-gray-600">{{ $automovil->capacidad_combustible }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-lg font-semibold text-gray-800">Tipo combustible</p>
                        <p class="text-gray-600">{{ $automovil->tipo_combustible }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-lg font-semibold text-gray-800">Tipo de Automovil</p>
                        <p class="text-gray-600">{{ $automovil->tipo_automovil }}</p>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="mb-4">
                    <p class="text-lg font-semibold text-gray-800">Kilometraje</p>
                    <p class="text-gray-600">{{ $automovil->kilometraje }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-lg font-semibold text-gray-800">Placas</p>
                    <p class="text-gray-600">{{ $automovil->placas }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-lg font-semibold text-gray-800">Uso</p>
                    <p class="text-gray-600">{{ $automovil->uso }}</p>
                </div>

            </div>

            <div class="">
                <div class="mb-4">
                    <p class="text-lg font-semibold text-gray-800">Numero de Puertas</p>
                    <p class="text-gray-600">{{ $automovil->num_puertas }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-lg font-semibold text-gray-800">Estatus</p>
                    <p class="text-gray-600">{{ $automovil->estatus }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-lg font-semibold text-gray-800">Fecha de Registro</p>
                    <p class="text-gray-600">{{ $automovil->fecha_registro }}</p>
                </div>
            </div>

            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Responsable:</p>
                <p class="text-gray-600">{{ $automovil->responsable }}</p>
            </div>
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Observaciones</p>
                <p class="text-gray-600">{{ $automovil->observaciones }}</p>
            </div>
            <div class="mb-4">
                <p class="text-lg font-semibold text-gray-800">Fotografias</p>
                <p class="text-gray-600">{{ $automovil->fotografias }}</p>
            </div>

            {{-- btn --}}
            <div class="flex justify-end mt-6 space-x-4">
                <a href="{{ route('Automovil.index') }}"
                    class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Cerrar</a>
            </div>
        </div>

    </div>

</div>
@endsection
