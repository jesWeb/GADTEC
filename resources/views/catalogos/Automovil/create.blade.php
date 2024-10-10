@extends('layouts.app')

@section('body')
    <div class="mt-4">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-xl font-semibold text-gray-700">Registro Automovil</h2>
            {{--  --}}
            <form action="{{ route('Automovil.store') }}" method="POST">
                {{-- este es un toquen crea una proteccion en el formulario csrf tipo segridad --}}
                @csrf
                @include('catalogos.Automovil._form')

            </form>
        </div>
    </div>
@endsection
