<header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
    <div class="flex items-center">
        <button @click="sidebarOpen = true; $refs.dropdownMenuOpen = false"
                class="text-gray-500 focus:outline-none lg:hidden">
            <!-- Icono del sidebar -->
            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
    </div>

    {{-- Opciones de usuario --}}
    <div x-data="{ dropdownOpen: false }" class="relative" @click.away="dropdownOpen = false">
        <!-- Mostrar nombre del usuario y la imagen -->
        <div class="flex items-center space-x-3">
            <div class="font-medium text-gray-900">{{ Auth::user()->nombre }} {{ Auth::user()->apm }}</div>
            <button @click="dropdownOpen = !dropdownOpen" x-ref="dropdownMenuOpen"
                    class="relative block w-8 h-8 ml-3 overflow-hidden rounded-full shadow focus:outline-none"
                    title="Cerrar sesión">
                <img class="object-cover w-full h-full"
                    src="{{ Auth::user()->foto ? asset('img/' . Auth::user()->foto) : 'shadow.png' }}"
                    alt="Your avatar">
            </button>
        </div>

        <!-- Menú desplegable -->
        <div x-cloak x-show="dropdownOpen"
             class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl">
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" title=" ¿Seguro que deseas salir?"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Cerrar sesión</a>
            </form>
        </div>
    </div>
</header>
