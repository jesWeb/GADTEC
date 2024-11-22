@extends('layouts.app')

@section('body')
<div class="px-4 py-6">
    <div class="p-6 bg-white rounded-md shadow-md">
        <div class="flex justify-between mb-3">
            <h2 class="mb-4 text-lg font-semibold text-gray-700 capitalize">Verificaciones vehiculares</h2>
            {{-- arrow back --}}
            <div class="py-3">
                <a href="{{ route('seguros.index') }}" class="flex items-center justify-center w-12 h-10 text-white rounded-full shadow ">
                    <img src="/img/arrow-back.svg" alt="">
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
