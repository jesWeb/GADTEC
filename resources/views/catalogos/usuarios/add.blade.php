@extends('layouts.app')

@section('body')
<div class="mt-8">
    <div class="mt-4">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <h2 class="mb-6 text-xl font-semibold text-gray-800 capitalize">Alta de Usuario</h2>

            <form action="{{ url('usuarios') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
                    <!-- N° Empleado -->
                    <div>
                        <label for="num_empleado" class="block text-base font-medium text-gray-700">N° Empleado</label>
                        <input type="text" name="num_empleado" id="num_empleado"  value="{{ old('num_empleado') }}" placeholder="ejemplo: 12345" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('num_empleado') }}">
                        @error('num_empleado') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-base font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"  placeholder="ejemplo: Juan" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('nombre') }}">
                        @error('nombre') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Apellido Paterno -->
                    <div>
                        <label for="app" class="block text-base font-medium text-gray-700">Apellido Paterno</label>
                        <input type="text" name="app" id="app" value="{{ old('app') }}"  placeholder="ejemplo: Pérez" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('app') }}">
                        @error('app') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Apellido Materno -->
                    <div>
                        <label for="apm" class="block text-base font-medium text-gray-700">Apellido Materno</label>
                        <input type="text" name="apm" id="apm" value="{{ old('apm') }}"  placeholder="ejemplo: López" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('apm') }}">
                        @error('apm') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Selección de Empresa -->
                    <div>
                        <label for="empresa" class="block text-base font-medium text-gray-700">Selección de Empresa</label>
                        <select name="empresa" id="empresa" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="GÄTSIMED" selected>GÄTSIMED</option>
                            <option value="DYDETEC">DYDETEC</option>
                            <option value="Empresa 3">Empresa 3</option>
                        </select>
                    </div>

                    <!-- Fecha de Nacimiento -->
                    <div>
                        <label for="fn" class="block text-base font-medium text-gray-700">Fecha de Nacimiento</label>
                        <input type="date" name="fn" id="fn" value="{{ old('fn') }}"  class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('fn') }}">
                    </div>

                    <!-- Selección de Sexo -->
                    <div>
                        <label for="gen" class="block text-base font-medium text-gray-700">Selección de Sexo</label>
                        <select name="gen" id="gen" value="{{ old('gen') }}" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="Femenino" selected>Femenino</option>
                            <option value="Masculino">Masculino</option>
                        </select>
                    </div>

                    <!-- E-Mail -->
                    <div>
                        <label for="email" class="block text-base font-medium text-gray-700">E-Mail</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="ejemplo@correo.com" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('email') }}">
                        @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Usuario -->
                    <div>
                        <label for="usuario" class="block text-base font-medium text-gray-700">Usuario</label>
                        <input type="text" name="usuario" id="usuario" value="{{ old('usuario') }}" placeholder="Nombre de Usuario" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('usuario') }}">
                        @error('usuario') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="pass" class="block text-base font-medium text-gray-700">Contraseña</label>
                        <input type="password" name="pass" id="pass" placeholder="Contraseña" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('pass') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Selección de Imagen -->
                    <div class="flex flex-col items-center space-y-4">
                        <label for="foto" class="block text-base font-medium text-gray-700">Seleccionar Imagen</label>

                        <div class="relative w-40 h-40 overflow-hidden transition duration-300 ease-in-out border border-gray-300 border-dashed rounded-lg shadow-lg cursor-pointer bg-gray-50 hover:bg-gray-100 hover:shadow-xl">
                            <input type="file" name="foto" id="foto" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                            <div class="flex flex-col items-center justify-center h-full text-gray-500 transition duration-300 ease-in-out hover:text-indigo-600">
                                <!-- Icono de Cámara -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l2-2m0 0h3.5l1-1h7l1 1H19l2 2m-2 10V8H5v10a2 2 0 002 2h10a2 2 0 002-2zM12 12a3 3 0 110-6 3 3 0 010 6z" />
                                </svg>
                                <span class="text-sm font-medium">Subir imagen</span>
                            </div>
                        </div>

                        @error('foto') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Selección de Estatus -->
                    <div>
                        <label for="estatus" class="block text-base font-medium text-gray-700">Selección de Estatus</label>
                        <select name="estatus" id="estatus" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option selected>Selecciona una opción...</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>

                    <!-- Selección de Rol -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="id_rol" class="block text-base font-medium text-gray-700">Selección de Rol</label>
                        <select name="id_rol" id="id_rol" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id_rol }}">{{ $rol->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end mt-8 space-x-4">
                    <button type="submit"  href="{{ url('usuarios') }}" class="px-5 py-3 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Guardar</button>
                    <a href="{{ url('usuarios') }}" class="px-5 py-3 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                </div>
            </form>
        </div>
</div>

@endsection