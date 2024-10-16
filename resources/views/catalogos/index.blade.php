@extends('layouts.app')


@section('body')
<div  class="grid grid-rows-4 gap-4 text-center xl:grid-cols-5 lg:grid-cols-3 md:grid-cols-2 xl:w-full text-slate-700 sm:my-10 ">
    @include('catalogos.cards', ['catalogoCardsData' => $catalogosCardsData])


</div>

@endsection
