@extends('layouts.app')
@section('body')
<div class="container mt-5">
    <div class="">
        <a class="mr-5 bg-green-700 flex items-center gap-2 rounded  bg-primary px-4.5 py-2 font-medium text-white transition hover:bg-green-900"
            href="{{ route('siniestros.create') }}">Crear nuevo</a>
    </div>
    <div class="mx-4 overflow-hidden rounded-lg shadow-lg md:mx-10">

        <table class="w-full table-fixed">
            <thead>
                <tr class="bg-gray-100">
                    <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">Automovil</th>
                    <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">Siniestro</th>
                    <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">fecha</th>
                    <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">Status</th>
                    <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($siniestros as $siniestro)
                    <tr>
                        <td class="px-6 py-4 border-b border-gray-200"></td>
                        <td class="px-6 py-4 truncate border-b border-gray-200"></td>
                        <td class="px-6 py-4 border-b border-gray-200"></td>
                        <td class="px-6 py-4 border-b border-gray-200">
                            <span class="px-2 py-1 text-xs text-white bg-green-500 rounded-full">Active</span>
                        </td>
                        {{-- acciones --}}
                        <td>
<<<<<<< HEAD
                            <a href="{{ route('siniestros.edit', ) }}">Editar</a>
                            <a href="{{ route('siniestros.show',) }}">Ver</a>
                            {{-- eliminar --}}
                            <form action="{{ route('siniestros.destroy', ) }}" method="post">
=======
                            <a href="{{ route('Automovil.edit', ) }}">Editar</a>
                            <a href="{{ route('Automovil.show',) }}">Ver</a>
                            {{-- eliminar --}}
                            <form action="{{ route('Automovil.destroy', ) }}" method="post">
>>>>>>> b34e15a (modificamos la estructura de todos los formularios)
                                @csrf
                                @method('DELETE')
                                <button
                                    class="px-3 py-2 font-bold bg-red-400 border border-red-500 rounded text-dark hover:bg-red-700"
                                    type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <!-- Add more rows here -->
            </tbody>
        </table>
    </div>
    <!-- Navegación de paginación -->
    {{-- {{ $cars->links() }} --}}
@endsection
