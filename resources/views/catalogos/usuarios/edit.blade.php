@extends('layouts.app')

@section('body')
<div class="mt-8">
    <div class="p-6 mx-auto bg-white rounded-lg shadow-lg max-w-7xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-700 capitalize">Editar Usuario</h3>

            <!-- Imagen de Usuario a la derecha -->
            <div>
                <img src="{{ asset('img/' . $usuario->foto) }}" alt="Foto de Usuario" class="object-cover w-16 h-16 border-4 border-indigo-500 rounded-full">
            </div>
        </div>

        <hr class="mb-6">
            <form action="{{ route('usuarios.update', $usuario->id_usuario) }}"  method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="grid grid-cols-1 gap-6 pt-3 sm:grid-cols-2 md:grid-cols-3">
                    <!-- N° Empleado -->
                    <div>
                        <label for="num_empleado" class="block text-base font-medium text-gray-700">N° Empleado</label>
                        <input type="text" name="num_empleado" id="num_empleado"  value="{{ old('num_empleado', $usuario->num_empleado) }}" 
                            placeholder="ejemplo: 12345" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            value="{{ old('num_empleado') }}"
                            title="Actualiza el número de empleado"
                        >
                        @error('num_empleado') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-base font-medium text-gray-700">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $usuario->nombre) }}"  
                        placeholder="ejemplo: Juan"  title="Actualiza el nombre del usuario"
                        class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('nombre') }}">
                        @error('nombre') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                     <!-- Apellido Paterno -->
                     <div>
                        <label for="app" class="block text-base font-medium text-gray-700">Apellido Paterno</label>
                        <input type="text" name="app" id="app" value="{{ old('app', $usuario->app) }}"  
                        placeholder="ejemplo: Pérez" title="Actualiza el apellido paterno"
                        class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('app') }}">
                        @error('app') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Apellido Materno -->
                    <div>
                        <label for="apm" class="block text-base font-medium text-gray-700">Apellido Materno</label>
                        <input type="text" name="apm" id="apm" value="{{ old('apm', $usuario->apm) }}"  
                        placeholder="ejemplo: López" title="Actualiza el apellido materno"
                        class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('apm') }}">
                        @error('apm') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Selección de Empresa -->
                    <div>
                        <label for="empresa" class="block text-base font-medium text-gray-700">Selección de Empresa</label>
                        <select name="empresa" id="empresa" title="Actualiza la empresa a la que pertenece el usuario"
                        class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="GÄTSIMED" {{ $usuario->empresa == 'GÄTSIMED' ? 'selected' : '' }}>GÄTSIMED</option>
                            <option value="DYDETEC" {{ $usuario->empresa == 'DYDETEC' ? 'selected' : '' }}>DYDETEC</option>
                            <option value="Empresa 3" {{ $usuario->empresa == 'Empresa 3' ? 'selected' : '' }}>Empresa 3</option>
                        </select>
                    </div>

                     <!-- Fecha de Nacimiento -->
                     <div>
                        <label for="fn" class="block text-base font-medium text-gray-700">Fecha de Nacimiento</label>
                        <input type="date" name="fn" id="fn" value="{{ old('fn', $usuario->fn) }}" title="Actualiza la fecha de nacimiento del usuario"
                        class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('fn') }}">
                    </div>

                    <!-- Selección de Sexo -->
                    <div>
                        <label for="gen" class="block text-base font-medium text-gray-700">Selección de Sexo</label>
                        <select name="gen" id="gen" title="Actualiza el sexo del usuario"
                         class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="Femenino" {{ $usuario->gen == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="Masculino" {{ $usuario->gen == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        </select>
                    </div>

                    <!-- Selección de Rol -->
                    <div>
                        <label for="rol" class="block text-base font-medium text-gray-700">Selección de Rol</label>
                        <select name="rol" id="rol" title="Actualiza el rol del usuario"
                         class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="Administrador" {{ $usuario->rol == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="Moderador" {{ $usuario->rol == 'Moderador' ? 'selected' : '' }}>Moderador</option>
                            <option value="Vigilante" {{ $usuario->rol == 'Usuario' ? 'selected' : '' }}>Usuario</option>
                        </select>
                    </div>

                     <!-- E-Mail -->
                     <div>
                        <label for="email" class="block text-base font-medium text-gray-700">E-Mail</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}" title="Actualiza el correo electrónico del usuario"
                        placeholder="ejemplo@correo.com" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('email') }}">
                        @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Usuario -->
                    <div>
                        <label for="usuario" class="block text-base font-medium text-gray-700">Usuario</label>
                        <input type="text" name="usuario" id="usuario" value="{{ old('usuario', $usuario->usuario) }}" 
                        placeholder="Nombre de Usuario" title="Actualiza el nombre de usuario" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('usuario') }}">
                        @error('usuario') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="relative col-span-1 md:col-span-2">
                        <label for="pass" class="block text-base font-medium text-gray-700">Contraseña</label>
                        <input type="password" name="pass" id="pass" placeholder="Contraseña" title="Actualiza la contraseña del usuario"
                        class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <button type="button" onclick="togglePassword()"  title="Ver la contraseña del usuario" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                            <!-- Icono de Ojo -->
                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                        @error('pass') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <script>
                        function togglePassword() {
                            const passField = document.getElementById('pass');
                            const eyeIcon = document.getElementById('eye-icon');
                            if (passField.type === 'password') {
                                passField.type = 'text';
                                eyeIcon.setAttribute('stroke', '#1F2937'); // Cambiar color al ver
                            } else {
                                passField.type = 'password';
                                eyeIcon.setAttribute('stroke', 'currentColor'); // Cambiar color al ocultar
                            }
                        }
                    </script>


                    <!-- Selección de Imagen -->
                    <div class="flex flex-col items-center space-y-4">
                        <label for="foto" class="block text-base font-medium text-gray-700">Seleccionar Imagen</label>

                        <div class="relative w-40 h-40 overflow-hidden transition duration-300 ease-in-out border border-gray-300 border-dashed rounded-lg shadow-lg cursor-pointer bg-gray-50 hover:bg-gray-100 hover:shadow-xl">
                            <input type="file" title="Actualizar la foto del usuario" name="foto" id="foto" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
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
                        <select name="estatus" id="estatus" title="Actualizar el estatus del usuario" class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option selected>Selecciona una opción...</option>
                            <option value="Activo" {{ $usuario->estatus == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $usuario->estatus == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    
                    
                </div>

                <hr class="my-6">

                <div class="flex justify-end mt-6">
                    <button type="submit" title="Actualizar los datos del usuario" class="px-6 py-2 text-gray-200 bg-gray-800 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Guardar</button>
                    <a href="{{ route('usuarios.index') }}" title="Cancelar la edición">
                        <button type="button" class="px-6 py-2 ml-2 font-semibold bg-gray-200 rounded-md hover:bg-red-200 focus:outline-none focus:bg-red-700">Cancelar</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
