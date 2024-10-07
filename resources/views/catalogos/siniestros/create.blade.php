@extends('layouts.app')

@section('body')

<div class="mt-4">
    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-xl font-semibold text-gray-700">Registro Siniestros </h2>
        {{--  --}}
        <form action="" >
            @include('catalogos.siniestros._form')
        </form>
    </div>
</div>



@endsection
