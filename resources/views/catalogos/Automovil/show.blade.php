@extends('layouts.app')
@section('body')
    <div class="px-4 mx-auto">
        {{--  --}}
        <section class="w-full p-6 bg-white rounded-lg shadow-lg minh-screen">
            {{-- info main --}}
            <h1 class="text-lg font-semibold tracking-wide text-center text-indigo-500 md:m-5">Informacion de
                Automovil
            </h1>

            <div class="flex flex-col mt-3 md:flex-row">
                <!-- img -->
                {{-- @if ($MostrarVer->image)
                <img src="{{asset('img/' . $MostrarVer->image) }}" alt=""
                    class="w-full max-h-[400px] object-cover md:w-52 ">
                @else --}}
                <div class="mb-6 mr-0 md:mr-8 md:mb-0">
                    <img class="w-1/2 mx-auto md:w-full max-h-[400px]  max-w-[400px]" src="{{asset('img/' . $automovil->fotografias) }}"  alt="can_help_banner">
                </div>
                <!--  -->

                <div class="flex flex-col flex-wrap flex-1 -mx-2 -mb-4 sm:flex-row">

                    <div class="w-full px-2 mb-4 sm:w-1/2 ">
                        <div class="h-full px-6 py-4 border border-t-0 border-l-0 border-zinc-500 rounded-br-xl">

                            <div class="flex flex-col">
                                <p class="text-lg font-semibold text-gray-800 ">Marca:</p>
                                <span class="text-gray-600">{{ $automovil->marca }}</span>
                                <p class="text-lg font-semibold text-gray-800 ">Submarca:</p>
                                <span class="text-gray-600">{{ $automovil->submarca }}</span>
                                <p class="text-lg ">Modelo:</p>
                                <span class="text-gray-600">{{ $automovil->modelo }}</span>
                            </div>

                        </div>
                    </div>
                    <div class="w-full px-2 mb-4 sm:w-1/2 ">
                        <div class="h-full px-6 py-4 border border-t-0 border-l-0 border-zinc-500 rounded-br-xl">
                            <div class="flex flex-col ">
                                <p class="text-lg font-semibold text-gray-800">Numero de Serie :</p>
                                <span class="text-gray-600 ">{{ $automovil->num_serie }}</span>
                                <p class="text-lg font-semibold text-gray-800">Numero de Motor :</p>
                                <span class="text-gray-600 ">{{ $automovil->num_motor }}</span>
                                <p class="text-lg font-semibold text-gray-800">Repube / NSI :</p>
                                <span class="text-gray-600 ">{{ $automovil->num_nsi }}</span>

                            </div>
                        </div>
                    </div>

                    <div class="w-full px-2 mb-4 sm:w-1/2 ">
                        <div class="h-full px-6 py-4 border border-t-0 border-l-0 border-zinc-500 rounded-br-xl">
                            <div class="flex mt-4 space-x-5 ">
                                <div class="flex flex-col">
                                    <p class="text-lg font-semibold text-gray-800 ">Capacidad de combustible (Lts): </p>
                                    <span class="text-gray-600 ">{{ $automovil->capacidad_combustible }}</span>
                                    <p class="text-lg font-semibold text-gray-800 ">Tipo de combustible : </p>
                                    <span class="text-gray-600 ">{{ $automovil->tipo_combustible }}</span>
                                    <p class="text-lg font-semibold text-gray-800 ">Kilometraje :</p>
                                    <span class="text-gray-600 ">{{ $automovil->kilometraje }}</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="w-full px-2 mb-4 sm:w-1/2 ">
                        <div class="h-full px-6 py-4 border border-t-0 border-l-0 border-zinc-500 rounded-br-xl">
                            <div class="flex mt-4 space-x-5 ">
                                <div class="flex flex-col">
                                    <p class=" mb-1.5 inline text-lg font-semibold text-gray-800">Color : </p><span
                                        class="text-gray-600 ">{{ $automovil->color }}</span>
                                    <p class=" mt-1.5 inline text-lg font-semibold text-gray-800">Numero de Puertas : </p>
                                    <span class="text-gray-600 ">{{ $automovil->num_puertas }}</span>
                                    <p class=" mb-1.5 inline text-lg font-semibold text-gray-800">Condiciones: </p> <span
                                        class="text-gray-600 ">{{ $automovil->estatus }}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="w-full px-2 mb-4 sm:w-1/2 ">
                        <div class="h-full px-6 py-4 border border-t-0 border-l-0 border-zinc-500 rounded-br-xl">
                            <div class="flex mt-4 space-x-5 ">
                                <div class="flex flex-col">
                                    <p class="text-lg font-semibold text-gray-800 ">Placas : </p> <span
                                        class="text-gray-600 ">{{ $automovil->placas }}</span>
                                    <p class="font-semibold text-gray-800 inlinext-lg">Fecha de Ingreso :</p> <span
                                        class="text-gray-600 ">{{ $automovil->fecha_registro }}</span>
                                    <p class="text-lg font-semibold text-gray-800 ">Tipo de Automovil : </p> <span
                                        class="text-gray-600 ">{{ $automovil->tipo_automovil }}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="w-full px-2 mb-4 sm:w-1/2 ">
                        <div class="h-full px-6 py-4 border border-t-0 border-l-0 border-zinc-500 rounded-br-xl">
                            <div class="flex mt-4 space-x-5 ">
                                <div class="flex flex-col">
                                    <p class="inline text-lg font-semibold text-gray-800">Uso : <span
                                            class="p-2 text-gray-600">{{ $automovil->uso }}</span> </p>
                                    <p class="inline text-lg font-semibold text-gray-800">Responsable : <span
                                            class="p-2 text-gray-600">{{ $automovil->responsable }}</span> </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>



            {{-- btn --}}
            <div class="flex justify-end mt-6 space-x-4">
                <a href="{{ route('Automovil.index') }}"
                    class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Cerrar</a>
            </div>
        </section>
    </div>
@endsection
