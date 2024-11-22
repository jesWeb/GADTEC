@extends('layouts.app')

@section('body')
    <div class="flex flex-col mt-5 gap-9">
        <div class="p-6 bg-white border rounded-md shadow-md">
            {{-- Titulo --}}
            <h2 class="mb-5 text-xl font-semibold text-gray-700">
                <span class="text-xl font-semibold text-gray-700">Detalles de Verificación</span>
            </h2>

            {{-- Información --}}
            <div class="m-4 xl:p-10">
                {{-- Fila con tres campos de información --}}
                <div class="flex flex-col gap-5 xl:flex-row">
                    {{-- Automóvil seleccionado --}}
                    <div class="w-full px-3 xl:w-1/3">
                        <h4 for="id_automovil" class="mb-3 block text-base font-medium text-[#07074D]">Automóvil:</h4>
                        <p class="text-base text-gray-600">{{ $MostrarVer->automovil->marca }} {{ $MostrarVer->automovil->modelo }} ({{ $MostrarVer->automovil->submarca }})</p>
                    </div>

                    {{-- Engomado --}}
                    <div class="w-full px-3 xl:w-1/3">
                        <h4 class="mb-3 block text-base font-medium text-[#07074D]" for="engomado">Engomado</h4>
                        <p class="text-base text-gray-600">{{ $MostrarVer->engomado }}</p>
                    </div>

                    {{-- Holograma --}}
                    <div class="w-full px-3 xl:w-1/3">
                        <h4 class="text-base font-medium text-[#07074D]" for="holograma">Holograma</h4>
                        <p class="text-base text-gray-600">{{ $MostrarVer->holograma }}</p>
                    </div>
                </div>

                {{-- Fila con dos campos --}}
                <div class="flex flex-col gap-2 mt-6 xl:flex-row">
                    {{-- Fecha de Verificación --}}
                    <div class="w-full px-3 xl:w-1/2">
                        <label for="fechaV" class="mb-3 block text-base font-medium text-[#07074D]">Fecha de Verificación</label>
                        <p class="text-base text-gray-600">{{ $MostrarVer->fechaV }}</p>
                    </div>

                    {{-- Próxima Verificación --}}
                    <div class="w-full px-3 xl:w-1/2">
                        <label for="fechaP" class="mb-3 block text-base font-medium text-[#07074D]">Próxima Verificación</label>
                        <p class="text-base text-gray-600">{{ $MostrarVer->fechaP }}</p>
                    </div>
                </div>

                {{-- Observaciones --}}
                <div class="mt-4">
                    <label class="mb-3 block text-base font-medium text-[#07074D]" for="observaciones">Observaciones del vehículo</label>
                    <p class="text-base text-gray-600">{{ $MostrarVer->observaciones }}</p>
                </div>

                {{-- Archivos (si se subieron) --}}
                {{-- @if($EddVer->files && $EddVer->files->count() > 0)
                    <div class="mt-4">
                        <label class="mb-3 block text-base font-medium text-[#07074D]" for="files">Archivos Subidos</label>
                        <ul class="pl-5 list-disc">
                            @foreach ($EddVer->files as $file)
                                <li>
                                    <a href="{{ route('files.download', $file->id) }}" class="text-blue-500">{{ $file->file_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
            </div>

            {{-- Botón de Cerrar --}}
            <div class="flex justify-end gap-4 mt-6">
                <a href="{{ route('verificaciones.index') }}"
                    class="px-6 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Cerrar</a>
            </div>
        </div>
    </div>
@endsection
