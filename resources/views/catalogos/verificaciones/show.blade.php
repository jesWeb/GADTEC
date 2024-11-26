@extends('layouts.app')
@section('body')
<div class="px-4 mx-auto">
    <section class="w-full p-6 bg-white rounded-lg shadow-lg">
        {{-- Title --}}
        <div class="mb-10 text-center">
            <h2 class="mb-5 text-xl font-semibold tracking-tight text-center text-indigo-500 f text-primary-800 md:m-5">
                Detalles de Verificación -
                {{ $MostrarVer->automovil->marca }} {{ $MostrarVer->automovil->submarca }}
                {{ $MostrarVer->automovil->modelo }}</h2>
        </div>
        {{-- content --}}
        <article class="flex flex-wrap max-w-3xl mx-auto md:flex-nowrap group">
            {{-- poliza Img --}}
            <img class="w-full max-h-[400px] object-cover md:w-52"
                src="https://i.ibb.co/Kr4b0zJ/152013403-10158311889099633-8423107287930246533-o.jpg" alt="">
            {{-- content info --}}
            <div class="">
                <div class="flex">
                    <div class="p-5 pb-10">
                        <h4 class="text-lg font-semibold text-gray-800">Fecha de Verificación :</h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $MostrarVer->fechaV }}</span>
                    </div>
                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">Engomado: </h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $MostrarVer->engomado }}</span>
                    </div>
                    <div class="p-5 pb-10">
                        <h4 class="text-lg font-semibold text-gray-800">Holograma:</h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $MostrarVer->holograma }}</span>
                    </div>
                </div>
                <div class="flex">

                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">Próxima Verificación:</h4>
                        <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $MostrarVer->fechaP }}</span>
                    </div>
                </div>
                <div class="">
                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">Observaciones de Verificación:</h4>
                        <span
                            class="mt-2 text-base leading-relaxed text-gray-500 ">{{$MostrarVer->observaciones }}</span>
                    </div>
                </div>
            </div>

        </article>
        {{-- btn --}}
        <div class="flex justify-end mt-6 space-x-4">
            <a href="{{ route('verificaciones.index') }}"
                class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Cerrar</a>
        </div>
    </section>
</div>
@endsection
