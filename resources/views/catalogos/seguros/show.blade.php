@extends('layouts.app')

@section('body')
<div class="px-6 py-2">
    <!-- Mapa de sitio -->
    <div class="flex justify-end mt-2 mb-4">
        <nav class="text-sm text-gray-600">
                <div class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Ir a la gestión de vehículos" class="flex items-center text-gray-700 hover:text-gray-900">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                            Gestión
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Catálogos -->
                    <li class="flex items-center">
                        <a href="{{ $backRoute ?? route('catalogos.index') }}" title="Volver a Catálogos" class="text-gray-800 hover:text-gray-800">
                            Catálogos
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Seguros -->
                    <li class="flex items-center">
                        <a href="{{route('seguros.index')}}" title="Volver a la página de seguros" class="text-gray-800 hover:text-gray-800">
                            Seguros
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Seguros -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Ver detalle de Seguro
                        </p>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container px-4 mx-auto">
        <div class="flex justify-center mt-12">
            <div class="w-full max-w-3xl p-8 bg-white rounded-lg shadow-lg bg-gradient-to-r">            
                <div class="text-center">
                    <h1 class="text-4xl font-extrabold text-gray-800">Detalle de Seguro</h1>
                    <p class="mt-2 text-lg text-gray-600">Información completa sobre el seguro seleccionado</p>
                </div>
                    
                <h2 class="text-2xl font-semibold tracking-tight text-center text-green-600 f text-primary-800 md:m-5">
                    Aseguradora -
                        {{ $seguroS->automovil->marca }} {{ $seguroS->automovil->submarca }}
                        {{ $seguroS->automovil->modelo }}</h2>
                
                {{-- content --}}
                <article class="flex flex-wrap max-w-3xl mx-auto md:flex-nowrap group">
                    {{-- poliza Img --}}
                    <img class="w-full max-h-[400px] object-cover md:w-52"
                        src="https://i.ibb.co/Kr4b0zJ/152013403-10158311889099633-8423107287930246533-o.jpg" alt="">
                    {{-- content info --}}
                    <div class="mt-6 ml-4 space-y-6">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="p-4 bg-white rounded-lg shadow-sm">

                                <h4 class="text-lg font-semibold text-gray-800">Aseguradora: </h4>
                                <span class="mt-2 text-lg leading-relaxed text-gray-500 ">{{ $seguroS->aseguradora }}</span>
                            </div>
                            <div class="p-4 bg-white rounded-lg shadow-sm">

                                <h4 class="text-lg font-semibold text-gray-800">Cobertura:</h4>
                                <span class="mt-2 text-lg leading-relaxed text-gray-500 ">{{ $seguroS->cobertura }}</span>
                            </div>
                            <div class="p-4 bg-white rounded-lg shadow-sm">

                                <h4 class="text-lg font-semibold text-gray-800">Estatus:</h4>
                                <span class="mt-2 text-lg leading-relaxed text-gray-500 ">{{ $seguroS->estatus }}</span>
                            </div>
                        

                            <div class="p-4 bg-white rounded-lg shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-800">Monto Asegurado:</h4>
                                <span class="mt-2 text-lg leading-relaxed text-gray-500 ">$ {{ $seguroS->monto }}</span>
                            </div>
                            <div class="p-4 bg-white rounded-lg shadow-sm">
                                <h4 class="text-lg font-semibold text-gray-800">Fecha de Vigencia:</h4>
                                <span class="mt-2 text-lg leading-relaxed text-gray-500 ">{{ $seguroS->fecha_vigencia }}</span>
                            </div>
                        </div>
                    </div>

                </article>
                {{-- btn --}}
                <div class="flex justify-end mt-6 space-x-4">
                    <a href="{{ route('seguros.index') }}" title="Volver al listado de seguros"
                    class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-200 bg-green-600 rounded-md hover:bg-green-700 focus:outline-none">Cerrar</a>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
