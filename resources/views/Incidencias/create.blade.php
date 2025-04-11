@extends('layouts.app')

@section('body')
    <div class="container mx-auto px-6 py-8">
        <!-- Mapa de sitio -->
        <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <ul class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Ir a la gestión de vehículos"
                            class="flex items-center text-gray-700 hover:text-gray-900">
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
                    <!-- Incidencias  -->
                    <li class="flex items-center">
                        <p href="{{ route('incidencias.index') }}" class="text-gray-800 hover:text-gray-800">
                            Incidencias
                        </p>
                    </li>
                    <!-- Separador -->
                    <li class="text-gray-500">/</li>
                    <!-- Crear Incidencia  -->
                    <li class="flex items-center">
                        <p href="{{ route('incidencias.create') }}" class="text-gray-800 hover:text-gray-800">
                            Registrar Incidencia
                        </p>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="max-w-4xl mx-auto bg-white border rounded-lg shadow-lg p-8">

            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Registrar Nueva Incidencia</h2>


            <form method="POST" action="{{ route('incidencias.store') }}">
                @csrf
                <div class="mb-6">
                    <label for="descripcion" class="block text-gray-700 font-medium mb-2">Descripción de la
                        incidencia</label>
                    <textarea name="descripcion" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                        rows="6" required></textarea>
                </div>

                <div class="flex justify-end gap-4 mt-4">
                    <a href="{{ route('incidencias.index') }}"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Volver al listado</a>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Registrar Incidencia</button>
                </div>
            </form>
        </div>
    </div>
@endsection
