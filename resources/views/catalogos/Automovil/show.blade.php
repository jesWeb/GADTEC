@extends('layouts.app')


@section('body')
    <div class="mx-auto overflow-hidden bg-white shadow-md rounded-xl md:max-w-2xl">
        <div class="gap-5 md:flex md:justify-center md:items-center ">
            {{-- Image --}}
            <div class="md:flex-shrink-0">

                <img class="object-cover h-100 md:w-100" src="{{ asset('img/carros' .$automovil->fotografia) }}"
                 alt="">


            </div>
            {{--  --}}
            <div class="p-8">
                {{-- info main --}}
                <h1 class="text-lg font-semibold tracking-wide text-center text-indigo-500 md:m-5">Información de Automóvil
                </h1>

                <div class="mt-4">
                    {{-- 1st info --}}
                    <div class="flex flex-col">
                        <h2 class="font-semibold tracking-wide uppercase">Marca: {{ $automovil->marca }}</h2>
                        <h3 class="mt-1">Submarca: <span class="font-medium">{{ $automovil->submarca }}</span></h3>
                        <h3 class="mt-1">Modelo: <span class="font-medium">{{ $automovil->modelo }}</span></h3>
                    </div>

                    {{-- 2nd info --}}
                    <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-2">
                        <p>No. Serie: <span>{{ $automovil->serie }}</span></p>
                        <p>No. Motor: <span>{{ $automovil->motor }}</span></p>
                        <p>NSI: <span>{{ $automovil->NSI }}</span></p>
                    </div>

                    <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-2">
                        <p>Kilometraje: <span>{{ $automovil->kilometraje }}</span> Km</p>
                        <p>Responsable: <span>{{ $automovil->responsable }}</span></p>
                    </div>
                </div>

                <p class="mt-2">
                    Observaciones: <br>
                    <span class="text-gray-500">{{ $automovil->observaciones }}</span>
                </p>

                <div class="mt-4">
                    <button
                        class="px-4 py-2 text-white bg-indigo-500 rounded hover:bg-indigo-600 focus:outline-none">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
