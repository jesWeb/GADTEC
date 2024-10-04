@extends('dashboard.layout')

@section('content')


<div class="mt-4">

    <div class="p-6 bg-white rounded-md shadow-md">
        <h1 class="text-lg font-semibold text-gray-700 capitalize">Registro de Automoviles</h1>
         {{-- formulario --}}
        <form  method="Post" class="mt-3">
            @include('dashboard.admin.Automovil._form')
        </form>
    </div>
</div>

@endsection

