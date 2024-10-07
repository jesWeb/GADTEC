@extends('layouts.app')

@section('body')


<div class="flex flex-col mt-5 gap-9">

    <div class="p-6 bg-white border rounded-md shadow-md">
        {{-- titulo --}}
        <h2 class="mb-5 text-xl font-semibold text-gray-700">
            <h2 class="text-xl font-semibold text-gray-700">Registro Verificaciones</h2>

        </h2>
        {{-- formulario --}}
        <form action="">
            @include('catalogos.verificaciones._form')
        </form>
    </div>
</div>

@endsection
