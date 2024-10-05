@extends('layouts.app')

@section('body')

<div class="mt-4">
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-xl font-semibold text-gray-700">Registro Automovil</h2>
        {{--  --}}
        <form action="" >
            @include('catalogos.Automovil._form')
        </form>
    </div>
</div>



@endsection
