@extends('layouts.app')

@section('body')

<div class="flex flex-col gap-9">

    <div class="p-6 bg-white border rounded-md shadow-md">
       {{-- titulo --}}
       <h2 class="mb-5 text-xl font-semibold text-gray-700">Registro Siniestros</h2>
        {{-- formulario --}}
        <form action="" >
            @include('catalogos.siniestros._form')
        </form>
    </div>
</div>




@endsection
