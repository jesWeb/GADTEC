@extends('layouts.app')

@section('body')
<div class="w-full min-h-screen flex justify-center items-center p-6">
    <div class="w-full max-w-5xl bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Portada -->
       <!-- Portada fija -->
       <div class="relative h-56 w-full bg-cover bg-center" style="background-image: url(img/perfil.jpg);">
        

       </div>
        
        <!-- Avatar -->
        <div class="relative -mt-16 flex flex-col items-center">
            <label class="cursor-pointer relative">
                <input type="file" class="hidden" />
                <img src="{{ url('img/usuarios/shadow.png') }}" class="w-32 h-32 rounded-full border-4 border-white shadow-lg" alt="Avatar" />
                <span class="absolute bottom-2 right-2 bg-white p-2 rounded-full shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </span>
            </label>
        </div>
        
        <!-- Información del usuario -->
        <div class="text-center mt-4 p-4">
            <h2 class="text-2xl font-semibold">Ana López Martínez</h2>
            <p class="text-gray-500">Usuario del Sistema</p>
            <p class="text-gray-400">ana.lopez@example.com</p>
            <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Editar Perfil</button>
        </div>
        
        <!-- Información Personal -->
        <div class="border-t p-6">
            <h3 class="text-lg font-semibold mb-4">Información Personal</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600 font-semibold">Número NSS:</p>
                    <p class="text-gray-800">123-45-6789</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Licencia de Conducir:</p>
                    <p class="text-gray-800">ABC-987654</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Email:</p>
                    <p class="text-gray-800">ana.lopez@example.com</p>
                </div>
                <div>
                    <p class="text-gray-600 font-semibold">Teléfono:</p>
                    <p class="text-gray-800">+52 55 1234 5678</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

