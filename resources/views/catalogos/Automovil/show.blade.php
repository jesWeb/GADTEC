@extends('layouts.app')
@section('body')
    <div class="container px-4 mx-auto">
        <div class="flex justify-center mt-8">
            <section class="w-full p-6 bg-white rounded-lg shadow-lg">
                {{-- info main --}}
                <h1 class="text-lg font-semibold tracking-wide text-center text-indigo-500 md:m-5">Informacion de
                    Automovil
                </h1>
                {{-- info --}}
                <div class="flex items-center mb-8 space-x-8">
                    {{-- img --}}
                    <div class="flex-shrink-0">
                        <img src="https://picsum.photos/250/500" alt="">
                    </div>
                    {{-- info --}}
                    <div class="flex-grow">

                        <div class="">


                            <p class="text-lg font-semibold text-gray-800">Marca: <span
                                    class="text-gray-600">{{ $automovil->marca }}</span> </p>


                            <p class="text-lg font-semibold text-gray-800">Submarca: <span
                                    class="text-gray-600">{{ $automovil->submarca }}</span> </p>

                            <p class="text-lg ">Modelo: <span class="text-gray-600">{{ $automovil->modelo }}</span></p>



                        </div>
                        <div class="">
                            <div class="mb-4">
                                <p class="text-lg font-semibold text-gray-800">Numero de Serie</p>
                                <p class="text-gray-600">{{ $automovil->num_serie }}</p>
                            </div>

                            <div class="text-center">
                                <p class="text-lg font-semibold text-gray-800">Numero Motor</p>
                                <p class="text-gray-600">{{ $automovil->num_motor }}</p>
                            </div>

                            <div class="mb-4">
                                <p class="text-lg font-semibold text-gray-800">NSI/Repube</p>
                                <p class="text-gray-600">{{ $automovil->num_nsi }}</p>
                            </div>
                        </div>


                        <div class="mb-4">
                            <p class="text-lg font-semibold text-gray-800">Numero de Serie</p>
                            <p class="text-gray-600">{{ $automovil->num_serie }}</p>
                        </div>

                        <div class="text-center">
                            <p class="text-lg font-semibold text-gray-800">Numero Motor</p>
                            <p class="text-gray-600">{{ $automovil->num_motor }}</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-lg font-semibold text-gray-800">NSI/Repube</p>
                            <p class="text-gray-600">{{ $automovil->num_nsi }}</p>
                        </div>

                    </div>

                    <div class="flex justify-center gap-6 px-2 py-2 m-3 ">
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
                    <div class="flex justify-center gap-6 px-2 py-2 m-3 ">
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





                    <div class="flex justify-center gap-6 px-2 py-2 m-3 align-middle">
                        <div class="text-center">
                            <p class="text-lg font-semibold text-gray-800">Numero de Puertas</p>
                            <p class="text-gray-600">{{ $automovil->num_puertas }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-lg font-semibold text-gray-800">Estatus</p>
                            <p class="text-gray-600">{{ $automovil->estatus }}</p>
                        </div>
                        <div class="">
                            <p class="text-lg font-semibold text-gray-800">Fecha de Registro</p>
                            <p class="text-gray-600">{{ $automovil->fecha_registro }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-center gap-6 px-2 py-2 m-3">

                        <div class="">
                            <p class="text-lg font-semibold text-gray-800">Responsable:</p>
                            <p class="text-gray-600">{{ $automovil->responsable }}</p>
                        </div>
                        <div class="mb-4">
                            <p class="text-lg font-semibold text-gray-800">Observaciones</p>
                            <p class="text-gray-600">{{ $automovil->observaciones }}</p>
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

    </div>
@endsection
