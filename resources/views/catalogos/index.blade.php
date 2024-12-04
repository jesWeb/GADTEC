@extends('layouts.app')


@section('body')
<div class="px-6 py-2">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <ul class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Ir a la gestión de vehículos" class="flex items-center text-gray-700 hover:text-gray-900">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                            Gestion
                        </a>
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Catálogos -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Catálogos
                        </p>
                    </li>
                </ul>
            </nav>
        </div>
    <div  class="grid grid-rows-4 gap-4 text-center xl:grid-cols-5 lg:grid-cols-3 md:grid-cols-2 xl:w-full text-slate-700 sm:my-10 ">
        @include('catalogos.cards', ['catalogoCardsData' => $catalogosCardsData])


    </div>
</div>

@endsection
