@extends('layouts.app')

@section('body')
<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold text-[#07074D] capitalize">Editar Rol</h2>

            <form action="{{ url('roles/' .$rol->id_rol) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="clave">Clave</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="clave" value="{{ $rol->clave }}" id="clave" placeholder="ejemplo: 173883-M">
                        <div id="ClaveHelp" class="text-sm text-red-600 mt-1">
                            @error('clave')<i>{{$message}}</i>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-base font-medium text-[#07074D]" for="nombre">Nombre</label>
                        <input class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                               type="text" name="nombre" value="{{ $rol->nombre }}" id="nombre" placeholder="ejemplo: Administrador">
                        <div id="NombreHelp" class="text-sm text-red-600 mt-1">
                            @error('nombre')<i>{{$message}}</i>@enderror
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-base font-medium text-[#07074D]" for="descripcion">Descripción</label>
                    <textarea class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                              name="descripcion" id="descripcion" placeholder="ejemplo: Edita y Elimina">{{ $rol->descripcion }}</textarea>
                </div>

                <div class="mt-4">
                    <label class="block text-base font-medium text-[#07074D]" for="estatus">Selección de Estatus</label>
                    <select class="w-full mt-2 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" name="estatus" id="estatus">
                        <option selected>Selecciona una opción...</option>
                        <option value="Activo" {{ $rol->estatus == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ $rol->estatus == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="flex justify-end mt-6 space-x-4">
                    <button type="submit" class="px-4 py-2 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Guardar</button>
                    <a href="{{ url('roles') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
