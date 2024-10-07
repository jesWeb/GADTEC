@extends('layouts.app')

@section('body')


<div class="flex flex-col mt-5 gap-9">

    <div class="p-6 bg-white border rounded-md shadow-md">
       {{-- titulo --}}
       <h2 class="mb-5 text-xl font-semibold text-gray-700">Reservación de Automóvil</h2>
        {{-- formulario --}}
        <form action="" >
            @include('catalogos.reservacion._form')
        </form>
    </div>
</div>

@endsection
