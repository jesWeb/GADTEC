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
                    <!-- Verificaciones Vehiculares -->
                    <li class="flex items-center">
                        <a href="{{route('verificaciones.index')}}" title="Volver a la página de verificaciones" class="text-gray-800 hover:text-gray-800">
                            Verificaciones
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Verificaciones Vehiculares -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Ver Detalle Verificación
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
                    <h1 class="text-4xl font-extrabold text-gray-800">Detalle de Verificación</h1>
                    <p class="mt-2 text-lg text-gray-600">Información completa sobre la verificación seleccionada</p>
                </div>
                {{-- Title --}}
                <h2 class="text-2xl font-semibold tracking-tight text-center text-green-600 f text-primary-800 md:m-5">
                    Detalles de Verificación -
                    {{ $MostrarVer->automovil->marca }} {{ $MostrarVer->automovil->submarca }}
                    {{ $MostrarVer->automovil->modelo }}</h2>

            {{-- content --}}
            <article class="flex flex-wrap max-w-3xl mx-auto md:flex-nowrap group">
                {{-- poliza Img --}}
                <div class="">
                    <div class="">
                        @php
                            $fotografias = json_decode($MostrarVer->image, true);
                        @endphp

                        @if ($fotografias)
                            @foreach ($fotografias as $foto)
                                <img src="{{ url('img/verificaciones/' . $foto) }}" class="w-full max-h-[400px] object-cover md:w-52" alt="seguro">
                                <a href="{{ url('img/verificaciones/' . $foto) }}" target="_blank" class="text-gray-500" title="Ver archivo de seguro">Ver imagen</a> 
                            @endforeach
                        @endif
                    </div>
                </div>
                {{-- content info --}}
                <div class="mt-6 ml-4 space-y-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800">Fecha de Verificación:</h4>
                            <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ \Carbon\Carbon::parse( $MostrarVer->fecha_verificacion )->locale('es')->format('d-m-Y') }}</span>
                        </div>
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800">Engomado: </h4>
                            <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $MostrarVer->engomado }}</span>
                        </div>
                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800">Holograma:</h4>
                            <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ $MostrarVer->holograma }}</span>
                        </div>


                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800">Próxima Verificación:</h4>
                            <span class="mt-2 text-base leading-relaxed text-gray-500 ">{{ \Carbon\Carbon::parse( $MostrarVer->proxima_verificacion )->locale('es')->format('d-m-Y') }}</span>
                        </div>

                        <div class="p-4 bg-white rounded-lg shadow-sm">
                            <h4 class="text-lg font-semibold text-gray-800">Observaciones de Verificación:</h4>
                            <span
                                class="mt-2 text-base leading-relaxed text-gray-500 ">{{$MostrarVer->observaciones }}</span>
                        </div>
                    </div>
                </div>

            </article>
            {{-- btn --}}
            <div class="flex justify-end mt-6 space-x-4">
                <a href="{{ route('verificaciones.index') }}" title="Volver al listado de verificaciones"
                class="inline-flex items-center justify-center px-4 py-2 text-white transition duration-200 bg-green-600 rounded-md hover:bg-green-700 focus:outline-none">Cerrar</a>
            </div>
        </section>
    </div>
</div>
@endsection
