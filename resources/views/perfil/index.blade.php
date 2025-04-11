@extends('layouts.app')

@section('body')
    <script type="text/javascript" src="{{ url('js/jquery-3.7.1.min.js') }}"></script>

    <div class="w-full min-h-screen flex justify-center items-center p-6">
        <div class="w-full max-w-5xl bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Portada fija -->
            <div class="relative h-56 w-full bg-cover bg-center"
                style="background-image: url({{ asset('img/perfil.jpg') }});"></div>

            <!-- Avatar -->
            <form name="altaFoto" action="{{ route('perfil.update', $usuario->id_usuario) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="relative -mt-16 flex flex-col items-center">
                    <label class="cursor-pointer relative">
                        <input type="file" id="foto" name="foto" class="hidden" form="perfil-form"
                            onchange="previewImage(event)" />
                        <img id="avatar-preview" src="{{ asset('img/usuarios/' . ($usuario->foto ?? 'shadow.png')) }} "
                            class="w-32 h-32 rounded-full border-4 border-white shadow-lg" alt="Avatar" />
                        <span class="absolute bottom-2 right-2 bg-white p-2 rounded-full shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </span>
                    </label>

                    <div class="mt-2 flex gap-3">
                        <button type="submit" form="perfil-form"
                            class="inline-flex items-center justify-center w-8 h-8 text-green-600 border border-green-600 rounded hover:bg-green-600 hover:text-white"
                            title="Guardar">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 3V21H21V7L17 3H3ZM5 5H16V9H5V5ZM7 11H17V19H7V11ZM9 13V17H15V13H9Z"></path>
                            </svg>
                        </button>
            </form>
            <form name="borrarFoto" action="{{ route('perfil.eliminarFoto', $usuario->id_usuario) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center justify-center w-8 h-8 text-red-600 border border-red-600 rounded hover:bg-red-600 hover:text-white"
                    title="Borrar foto">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9 3V4H4V6H5V19C5 19.5523 5.44772 20 6 20H18C18.5523 20 19 19.5523 19 19V6H20V4H15V3H9ZM7 6H17V18H7V6ZM9 8V16H11V8H9ZM13 8V16H15V8H13Z">
                        </path>
                    </svg>
                </button>
            </form>
        </div>

    </div>

    <!-- Información del usuario -->
    <div class="text-center mt-4 p-4">
        <h2 class="text-2xl font-semibold">{{ $usuario->nombre }} {{ $usuario->app }} {{ $usuario->apm }}</h2>
        <p class="text-gray-500">{{ $usuario->rol }}</p>
        <p class="text-gray-400">{{ $usuario->email }}</p>

        <!-- Botón para abrir el modal -->
        <button id="btnEditarPerfil" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Editar Perfil
        </button>
    </div>

    <!-- Información Personal -->
    <div class="border-t p-6">
        <h3 class="text-lg font-semibold mb-4">Información Personal</h3>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 font-semibold">Número NSS:</p>
                <p class="text-gray-800">{{ $usuario->id_usuario }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Licencia de Conducir:</p>
                <p class="text-gray-800">{{ $usuario->num_licencia ?? 'No registrada' }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Empresa:</p>
                <p class="text-gray-800">{{ $usuario->empresa }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Fecha de Nacimiento:</p>
                <p class="text-gray-800">{{ date('d/m/Y', strtotime($usuario->fn)) }}</p>
            </div>
        </div>
    </div>
    </div>
    </div>

    <!-- Modal para editar perfil -->
    <div id="modalEditarPerfil"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden transition-opacity duration-300 ease-in-out">
        <div
            class="bg-white rounded-lg p-6 w-[90%] max-w-3xl shadow-xl transform transition-transform duration-300 ease-in-out">
            <h2 class="text-xl font-semibold mb-4 text-center">Editar Perfil</h2>
            <form id="perfil-form" name="datosForm" action="{{ route('perfil.update', $usuario->id_usuario) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-gray-600 font-semibold">Número NSS:</label>
                        <input type="text" name="num_empleado" value="{{ $usuario->num_empleado }}"
                            class="w-full p-2 border rounded-md bg-gray-100" readonly />

                        <label class="text-gray-600 font-semibold mt-2">Nombre:</label>
                        <input type="text" name="nombre" value="{{ $usuario->nombre }}"
                            class="w-full p-2 border rounded-md" required />

                        <label class="text-gray-600 font-semibold mt-2">Apellido Paterno:</label>
                        <input type="text" name="app" value="{{ $usuario->app }}"
                            class="w-full p-2 border rounded-md" required />

                        <label class="text-gray-600 font-semibold mt-2">Apellido Materno:</label>
                        <input type="text" name="apm" value="{{ $usuario->apm }}"
                            class="w-full p-2 border rounded-md" />

                        <label class="text-gray-600 font-semibold mt-2">Fecha de Nacimiento:</label>
                        <input type="date" name="fn" value="{{ $usuario->fn }}"
                            class="w-full p-2 border rounded-md" required />
                    </div>
                    <div>
                        <label class="text-gray-600 font-semibold">Género:</label>
                        <select name="sex" class="w-full p-2 border rounded-md" required>
                            <option value="Femenino" {{ $usuario->sex == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="Masculino" {{ $usuario->sex == 'Masculino' ? 'selected' : '' }}>Masculino
                            </option>
                        </select>

                        <label class="text-gray-600 font-semibold mt-2">Email:</label>
                        <input type="email" name="email" value="{{ $usuario->email }}"
                            class="w-full p-2 border rounded-md" required />

                        <label class="text-gray-600 font-semibold mt-2">Numero de licencia:</label>
                        <input type="text" name="num_licencia" value="{{ $usuario->num_licencia }}"
                            class="w-full p-2 border rounded-md" />
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <button type="button" id="btnCerrarModal"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Guardar Cambios
                    </button>
                </div>
            </form>


        </div>
    </div>


    <script>
        $(document).ready(function() {
            $("#btnEditarPerfil").click(() => $("#modalEditarPerfil").removeClass("hidden").fadeIn());
            $("#btnCerrarModal").click(() => $("#modalEditarPerfil").fadeOut());
        });

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('avatar-preview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
