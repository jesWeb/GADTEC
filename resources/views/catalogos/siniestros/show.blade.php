@extends('layouts.app')
@section('body')
<div class="px-4 mx-auto">
    <section class="w-full p-6 bg-white rounded-lg shadow-lg">
        {{-- Title --}}
        <div class="mb-10 text-center">
            <h2 class="text-2xl font-semibold tracking-tight text-center text-indigo-500 f text-primary-800 md:m-5">Siniestro -
                {{ $ViewSini->automovil->marca }} {{ $ViewSini->automovil->submarca }}
                {{ $ViewSini->automovil->modelo }}</h2>
        </div>
        {{-- content --}}
        <article class="flex flex-wrap justify-center max-w-3xl mx-auto md:flex-nowrap group">
            {{-- content info --}}
            <div class="">
                <div class="flex justify-around ">
                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">Fecha Siniestro: </h4>
                        <span class="mt-2 text-lg leading-relaxed text-gray-500 ">

                            {{\Carbon\Carbon::parse($ViewSini->fecha_siniestro)->locale('es')->format('d-m-Y') }}</span>
                    </div>
                    <div class="p-5 pb-10">
                        <h4 class="text-lg font-semibold text-gray-800">Estatus:</h4>
                        <span class="mt-2 text-lg leading-relaxed text-gray-500 ">{{ $ViewSini->estatus }}</span>
                    </div>
                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">Responsable: </h4>
                        <span class="mt-2 text-lg leading-relaxed text-gray-500 ">{{ $ViewSini->usuarios->nombre }} {{ $ViewSini->usuarios->app }}
                            {{ $ViewSini->usuarios->apm }}</span>
                    </div>
                </div>
                <div class="flex">
                   <div class="p-5 pb-10">
                        <h4 class="text-lg font-semibold text-gray-800">Costo de Daños:</h4>
                        <span class="mt-2 text-lg leading-relaxed text-gray-500 ">${{ $ViewSini->costo_danos_estimados }} <span >Mxn</span></span>
                    </div>
                    <div class="p-5 pb-10 ">
                        <h4 class="text-lg font-semibold text-gray-800">Descripcion:</h4>
                        <p class="mt-2 text-lg leading-relaxed text-gray-500 ">{{ $ViewSini->descripcion}}</p>
                    </div>

                </div>
            </div>
             {{-- poliza Img --}}
             {{-- <img class="w-full max-h-[400px] object-cover md:w-52"
             src="https://i.ibb.co/Kr4b0zJ/152013403-10158311889099633-8423107287930246533-o.jpg" alt=""> --}}


        </article>
        {{-- btn --}}
        <div class="flex justify-end mt-6 space-x-4">
            <a href="{{ route('siniestros.index') }}"
                class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Cerrar</a>
        </div>
    </section>
</div>

@endsection
