@extends('layouts.app')


@section('body')
    <div class="mx-auto overflow-hidden bg-white shadow-md rounded-xl md:max-w-2xl">
        <div class="gap-5 md:flex md:justify-center md:items-center ">
            {{-- Image --}}
            <div class="md:flex-shrink-0">
                <img class="object-cover w-full h-48 md:w-48" src="{{asset('img/carros/' . $automovil ->image) }}" style="width: 200px;" alt="">
            </div>
            {{--  --}}
            <div class="p-8">
                {{-- info main --}}
                <h1 class="text-lg font-semibold tracking-wide text-center text-indigo-500 md:m-5">Informacion de Automovil
                </h1>
                <div class="mt-4">
                    <div class="inline-flex items-center ">
                        <h2 class="font-semibold tracking-wide uppercase ">Marca: {{ $automovil->marca }}</h2>
                        <h3 class="">Submarca: <span
                                class="mt-1 text-lg font-medium leading-tight ">{{ $automovil->submarca }}</span>
                        </h3>
                        <h3 class="">Modelo: <span
                                class="mt-1 font-medium leading-tight ">{{ $automovil->modelo }}</span>
                        </h3>
                    </div>
                    {{-- 2 info --}}
                    <div class="inline-flex items-center gap-5 mt-5">
                        <p>No.Serie : <br> <span>{{ $automovil->serie }}</span> </p>
                        <p>No.Motor : <br> <span>{{ $automovil->motor }}</span> </p>
                        <p>NSI : <br> <span>{{ $automovil->NSI }}</span> </p>
                    </div>

                    <div class="inline-flex items-center mt-5">
                        <p>Kilometraje: <br> <span>{{ $automovil->kilometraje }}</span> Km</p>
                        <p>Responsable: <span></span> <br> <span>{{ $automovil->responsable }}</span></p>
                    </div>

                </div>
                {{--  --}}
                <p class="mt-2 ">
                 observaciones : <br>
                 <span class="text-gray-500"> {{ $automovil->observaciones }}</span>
                </p>

                <div class="mt-4">
                    <button
                        class="px-4 py-2 text-white bg-indigo-500 rounded hover:bg-indigo-600 focus:outline-none">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
