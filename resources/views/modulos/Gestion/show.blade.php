@extends('layouts.app')
@section('body')
    <div class="px-4 py-6">

        <div class="p-6 bg-white rounded-md shadow-md">
            <div class="flex justify-between mb-3">
                {{-- ttulo --}}
                @foreach ($dispo as $titulo)
                    <h1 class="text-lg font-semibold text-gray-700 capitalize">
                        {{ $titulo->automovil->marca }} {{ $titulo->automovil->submarca }} {{ $titulo->automovil->modelo }}
                    </h1>
                @endforeach
                {{-- arrow back --}}
                <div class="">
                    <a href="{{ route('Gestion') }}"
                        class="flex items-center justify-center w-10 h-10 text-white rounded-full shadow ">
                        <img src="/img/arrow-back.svg" alt="">
                    </a>
                </div>
            </div>
            {{--  --}}
            <section class="mt-5">
                <div class="overflow-x-auto overflow-y-auto rounded-lg shadow">
                    <table class="min-w-full bg-white border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-600">#</th>
                                <th class="px-4 py-2 text-left text-gray-600">Fechas Reservadas</th>
                                <th class="px-4 py-2 text-left text-gray-600">Horario de Salida</th>
                                <th class="px-4 py-2 text-left text-gray-600">Horario de llegada</th>
                                <th class="px-4 py-2 text-left text-gray-600">Estatus</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($dispo as $key => $salidas)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($salidas->fecha_salida)->format('d-m-y') }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($salidas->hora_salida)->format('h:i A') }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        {{ \Carbon\Carbon::parse($salidas->hora_llegada)->format('h:i A') }}
                                    </td>

                                    <td class="px-4 py-2 border">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium
                                             {{ $salidas->estatus == 'Reservado' ? 'bg-orange-100 text-orange-400' : ($salidas->estatus == 'Ocupado' ? 'bg-red-100 text-red-800' : '') }}">
                                            {{ $salidas->estatus }}
                                        </span>

                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </section>
        </div>
    </div>
@endsection
