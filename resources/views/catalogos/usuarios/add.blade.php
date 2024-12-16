@extends('layouts.app')

@section('body')
<div class="px-6 py-2">
    <!-- Mapa de sitio -->
    <div class="flex justify-end mt-2 mb-4">
            <nav class="text-sm text-gray-600">
                <div class="flex items-center space-x-4">
                    <li class="flex items-center">
                        <a href="{{ route('Gestion') }}" title="Ir a la gestión de vehículos" class="flex items-center text-gray-700 hover:text-gray-900">
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                            Gestión
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Catálogos -->
                    <li class="flex items-center">
                        <a href="{{ $backRoute ?? route('catalogos.index') }}" title="Volver a Catálogos" class="text-gray-800 hover:text-gray-800">
                            Catálogos
                        </a>
                    </li>
                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <a href="{{route('usuarios.index')}}" title="Volver a la página de usuarios" class="text-gray-800 hover:text-gray-800">
                            Usuarios
                        </a>
                    </li>

                    <!-- Separador -->
                    <p class="text-gray-500">/</p>
                    <!-- Usuarios -->
                    <li class="flex items-center">
                        <p  class="text-gray-800 hover:text-gray-800">
                            Registrar Nuevo Usuario
                        </p>
                    </li>
                </ul>
            </nav>
    </div>

        <div class="mt-8">
            <div class="mt-4">
                <div class="p-6 bg-white rounded-lg shadow-lg">
                    <h2 class="mb-6 text-xl font-semibold text-gray-800 capitalize">Alta de Usuario</h2>

                    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
                            <!-- N° Empleado -->
                            <div>
                                <label for="num_empleado" class="block text-base font-medium text-gray-700">N° Empleado</label>
                                <input type="text" name="num_empleado" id="num_empleado" value="{{ old('num_empleado') }}"
                                    placeholder="Ejemplo: 12345"
                                    class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    title="Ingresa el número del empleado">
                                @error('num_empleado')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Nombre -->
                            <div>
                                <label for="nombre" class="block text-base font-medium text-gray-700">Nombre</label>
                                <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}"
                                    placeholder="Ejemplo: Juan"
                                    class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    title="Ingresa el nombre o nombres">
                                @error('nombre')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Apellido Paterno -->
                            <div>
                                <label for="app" class="block text-base font-medium text-gray-700">Apellido Paterno</label>
                                <input type="text" name="app" id="app" value="{{ old('app') }}" placeholder="Ejemplo: Pérez"
                                    class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    title="Ingresa el apellido paterno">
                                @error('app')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Apellido Materno -->
                            <div>
                                <label for="apm" class="block text-base font-medium text-gray-700">Apellido Materno</label>
                                <input type="text" name="apm" id="apm" value="{{ old('apm') }}" placeholder="Ejemplo: López"
                                    class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    title="Ingresa el apellido materno">
                                @error('apm')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Selección de Empresa -->
                            <div>
                                <label for="empresa" class="block text-base font-medium text-gray-700">Selección de Empresa</label>
                                <select name="empresa" id="empresa"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    title="Selecciona una empresa">
                                    <option disabled selected>Selecciona una opción</option>
                                    <option value="GÄTSIMED">GÄTSIMED</option>
                                    <option value="DYDETEC">DYDETEC</option>
                                    <option value="Empresa 3">Empresa 3</option>
                                </select>
                                @error('empresa')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Fecha de Nacimiento -->
                            <div>
                                <label for="fn" class="block text-base font-medium text-gray-700">Fecha de Nacimiento</label>
                                <input type="date" name="fn" id="fn" value="{{ old('fn') }}"
                                    class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    title="Ingresa la fecha de nacimiento">
                                    @error('fn')
                                        <span class="text-sm text-red-600">{{ $message }}</span>
                                    @enderror
                            </div>

                            <!-- Selección de Sexo -->
                            <div>
                                <label for="gen" class="block text-base font-medium text-gray-700">Selección de Sexo</label>
                                <select name="gen" id="gen" value="{{ old('gen') }}"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    title="Selecciona el sexo">
                                    <option disabled selected>Selecciona una opción </option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Masculino">Masculino</option>
                                </select>
                                @error('gn')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Selección de Rol -->
                            <div>
                                <label for="rol" class="block text-base font-medium text-gray-700">Selección de Rol</label>
                                <select name="rol" id="rol"
                                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                                    title="Selecciona el rol del usuario" required>
                                    <option disabled selected>Selecciona una opción </option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Moderador">Moderador</option>
                                </select>
                                @error('rol')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- E-Mail -->
                            <div>
                                <label for="email" class="block text-base font-medium text-gray-700">E-Mail</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}"
                                    placeholder="Ejemplo: correo@dominio.com"
                                    class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    title="Ingresa una dirección de correo electrónico válida">
                                @error('email')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Usuario -->
                            <div>
                                <label for="usuario" class="block text-base font-medium text-gray-700">Usuario</label>
                                <input type="text" name="usuario" id="usuario" value="{{ old('usuario') }}"
                                    placeholder="Ejemplo: juan123"
                                    class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    title="Ingresa el nombre de usuario">
                                @error('usuario')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Contraseña -->
                            <div class="col-span-1 md:col-span-2">
                                <label for="pass" class="block text-base font-medium text-gray-700">Contraseña</label>
                                <input type="password" name="pass" id="pass" placeholder="Contraseña"
                                    class="w-full px-4 py-2 mt-2 text-base border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    title="Ingresa una contraseña segura">
                                @error('pass')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Selección de Imagen -->
                            <div class="flex flex-col items-center space-y-4">
                                <label for="foto" class="block text-base font-medium text-gray-700">Seleccionar Imagen</label>
                                <div class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] mt-4 p-6 text-center">
                                    <input type="file" name="foto" id="foto" accept="image/*"
                                        class="absolute inset-0 opacity-0 cursor-pointer" title="Selecciona una imagen de perfil">
                                        <label for="foto" class="cursor-pointer">
                                            <div class="flex flex-col items-center">
                                                <span title="Selecciona una fotografía frontal de la tarjeta"
                                                    class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                                        Buscar
                                                </span>

                                                <div id="file-info" class="mt-4">
                                                    <span id="file-count">0 archivos seleccionados..</span>
                                                    <ul id="file-names" class="pl-5 list-disc"></ul>
                                                </div>
                                            </div>
                                        </label>
                                </div>
                                <div class="mt-1 text-sm text-red-600">
                                    @error('foto')<i>{{ $message }}</i>@enderror
                                </div>
                            </div>
                            <script>
                                const fileInput = document.getElementById('foto');
                                const fileCountDisplay = document.getElementById('file-count');
                                const fileNamesDisplay = document.getElementById('file-names');

                                fileInput.addEventListener('change', function() {
                                    const files = fileInput.files;
                                    const fileCount = files.length;
                                    fileCountDisplay.textContent = `${fileCount} archivos seleccionados`;
                                    fileNamesDisplay.innerHTML = '';

                                    for (let i = 0; i < fileCount; i++) {
                                        const listItem = document.createElement('li');
                                        listItem.textContent = files[i].name;
                                        fileNamesDisplay.appendChild(listItem);
                                    }
                                });
                            </script>
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end mt-8 space-x-4">
                            
                            <a href="{{ route('usuarios.index') }}" title="Cancelar registro"
                                class="px-5 py-3 text-gray-700 bg-gray-200 rounded-md shadow-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</a>
                                <button type="submit"  title="Registrar usuario"
                                class="px-5 py-3 text-white bg-indigo-600 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Registrar</button>
                        </div>
                    </form>
                </div>
</div>
    @endsection
