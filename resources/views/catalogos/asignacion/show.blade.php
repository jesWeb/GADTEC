@extends('layouts.app')

@section('body')
<div class="px-4 mx-auto">
    <section class="w-full p-6 bg-white rounded-lg shadow-lg">
        {{-- Title --}}
        <div class="mb-10 text-center">
            <h2 class="mb-5 text-xl font-semibold tracking-tight text-center text-indigo-500 f text-primary-800 md:m-5">
                Detalles de Reservacion
            </h2>
        </div>
        {{-- content --}}
        <article class="flex flex-wrap max-w-3xl mx-auto md:flex-nowrap group">
            {{-- content info --}}
            <div class="">
                <div class="flex">
                    <div class="p-5 pb-10">
                        <h4 class="text-lg font-semibold text-gray-800">Solicitante:</h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->usuarios->nombre}}
                            {{ $asignacionV->usuarios->app}} {{ $asignacionV->usuarios->apm}}</span>
                    </div>
                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">Automovil: </h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">
                            {{ $asignacionV->automovil->marca }} {{ $asignacionV->automovil->submarca }}
                            {{ $asignacionV->automovil->modelo }}</span>
                    </div>
                    <div class="p-5 pb-10">
                        <h4 class="text-lg font-semibold text-gray-800">Fecha de salida:</h4>
                        <span
                            class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->fecha_salida }}</span>
                    </div>
                    <div class="p-5 pb-10">
                        <h4 class="text-lg font-semibold text-gray-800">Hora de salida:</h4>
                        <span
                            class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->hora_salida }}</span>
                    </div>
                </div>
                <div class="flex">
                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">Lugar de Destino:</h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{$asignacionV->lugar }}</span>
                    </div>
                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">Motivo:</h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->motivo }}</span>
                    </div>
                </div>
                <div class="px-3 py-3 border-b border-stroke dark:border-strokedark"></div>
                <div class="flex">
                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">Requiere chofer:</h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->requierechofer }}</span>
                    </div>
                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">Nombre del chofer:</h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->nombre_chofer}}</span>
                    </div>
                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">No.Licencia:</h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->no_licencia}}</span>
                    </div>
                </div>
                <div class="flex">
                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">Autorizante:</h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->autorizante }}</span>
                    </div>
                </div>
                <div class="px-3 py-3 border-b border-stroke dark:border-strokedark"></div>
                <div class="flex">
                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">Requerimientos (adicionales):</h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $asignacionV->requierechofer }}</span>
                    </div>
                </div>
            </div>

        </article>
        {{-- btn --}}
        <div class="flex justify-end mt-6 space-x-4">
            <a href="{{ route('asignacion.index') }}"
                class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Cerrar</a>
        </div>
    </section>
</div>

@endsection
