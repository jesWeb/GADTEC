@extends('layouts.app')

@section('body')
    <div class="px-4 mx-auto">
        <section class="w-full p-6 bg-white rounded-lg shadow-lg">
            {{-- Title --}}
            <div class="mb-10 text-center">
                <h2 class="text-2xl font-semibold tracking-tight text-center text-indigo-500 f text-primary-800 md:m-5">Aseguradora -
                    {{ $seguroS->automovil->marca }} {{ $seguroS->automovil->submarca }}
                    {{ $seguroS->automovil->modelo }}</h2>
            </div>
            {{-- content --}}
            <article class="flex flex-wrap max-w-3xl mx-auto md:flex-nowrap group">
                {{-- poliza Img --}}
                <img class="w-full max-h-[400px] object-cover md:w-52"
                    src="https://i.ibb.co/Kr4b0zJ/152013403-10158311889099633-8423107287930246533-o.jpg" alt="">
                {{-- content info --}}
                <div class="">
                    <div class="flex">
                        <div class="p-5 pb-10 ">
                            <h4 class="text-lg font-semibold text-gray-800">Aseguradora: </h4>
                            <span class="mt-2 text-lg leading-relaxed text-gray-500 ">{{ $seguroS->aseguradora }}</span>
                        </div>
                        <div class="p-5 pb-10">
                            <h4 class="text-lg font-semibold text-gray-800">Cobertura:</h4>
                            <span class="mt-2 text-lg leading-relaxed text-gray-500 ">{{ $seguroS->cobertura }}</span>
                        </div>
                        <div class="p-5 pb-10">
                            <h4 class="text-lg font-semibold text-gray-800">Estatus:</h4>
                            <span class="mt-2 text-lg leading-relaxed text-gray-500 ">{{ $seguroS->estatus }}</span>
                        </div>
                    </div>
                    <div class="flex">

                        <div class="p-5 pb-10 ">
                            <h4 class="text-lg font-semibold text-gray-800">Monto Asegurado:</h4>
                            <span class="mt-2 text-lg leading-relaxed text-gray-500 ">{{ $seguroS->monto }}</span>
                        </div>
                        <div class="p-5 pb-10 ">
                            <h4 class="text-lg font-semibold text-gray-800">Fecha de Vigencia:</h4>
                            <span class="mt-2 text-lg leading-relaxed text-gray-500 ">
                            {{ \Carbon\Carbon::parse($seguroS->fecha_vigencia)->locale('es')->format('d-m-Y') }}
                            </span>
                        </div>
                    </div>
                </div>

            </article>
            {{-- btn --}}
            <div class="flex justify-end mt-6 space-x-4">
                <a href="{{ route('seguros.index') }}"
                    class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Cerrar</a>
            </div>
        </section>
    </div>
@endsection
