<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
    class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
    {{-- logo --}}
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <a href="{{ route('Gestion') }}" title="Logo GADTEC">
                {{-- <x-application-logo class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" /> --}}
                <svg class="w-12 h-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                        fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                        fill="white" />
                </svg>

            </a>
            <span class="mx-2 text-2xl font-semibold text-white">GADTEC</span>
        </div>
    </div>
    {{-- Nav --}}
    <nav class="mt-10">


        {{-- Enlaces solo para Administrador --}}
        @if(Auth::user()->rol === 'Administrador')

            {{-- link Gestion --}}
            <a  class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
            href="{{ route('Gestion') }}" title="Ir a la gestión general">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
            </svg>

            <span class="mx-3">Gestion</span>


            </a>
            {{-- link Solicitudes --}}
            <div
            class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
            </svg>

            <x-nav-link :href="route('asignacion.index')" :active="request()->routeIs('asignacion.index')" title="Ver todas las solicitudes">
                {{-- nombre del link --}}
                <span class="mx-4 text-center"> {{ __('Solicitudes') }}</span>
            </x-nav-link>
            </div>
            {{-- link catálogos --}}
            <div
            class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>

            <x-nav-link :href="route('catalogos.index')" :active="request()->routeIs('catalogos.index')" title="Ver todos los catálogos">
                {{-- nombre del link --}}
                <span class="mx-4"> {{ __('Catálogos') }}</span>
            </x-nav-link>
            </div>
            {{-- link Multas --}}
            <div
            class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 13.5h7.5m-7.5 0a1.5 1.5 0 100-3h7.5a1.5 1.5 0 100 3m-7.5 0v3m7.5-3v3M6.75 21h10.5M4.5 4.5l3.75 3.75M16.5 4.5l-3.75 3.75M7.5 10.5L3 7.5M16.5 10.5L21 7.5" />
            </svg>
            <x-nav-link :href="route('multas.index')" :active="request()->routeIs('multas.index')" title="Ver todos las multas">
                {{-- nombre del link --}}
                <span class="mx-4"> {{ __('Multas') }}</span>
            </x-nav-link>
            </div>
            {{-- link  Servicios --}}
            <div
            class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.75 19.5h10.5M4.5 7.5l1.5-3h12l1.5 3M5.25 7.5h13.5v9.75H5.25V7.5zM8.25 16.5h7.5M9.75 16.5a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm4.5 0a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
            </svg>
            <x-nav-link :href="route('servicios.index')" :active="request()->routeIs('servicios.index')" title="Ver todos los servicios">
                {{-- nombre del link --}}
                <span class="mx-4"> {{ __('Servicios') }}</span>
            </x-nav-link>
            </div>


            {{-- Enlace de Vigilante --}}
            <div class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 17.25h18M3 12h10.5M3 6.75h15" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 6.75V12M10.5 12V17.25M16.5 12V17.25" />
                </svg>

                <x-nav-link :href="route('vigilante.index')" :active="request()->routeIs('vigilante.index')" title="Ver módulo de vigilante">
                    {{-- nombre del link --}}
                    <span class="mx-4"> {{ __('Vigilante') }}</span>
                </x-nav-link>
            </div>

            <!-- {{-- Enlace de Autorizante --}}
            <div class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 17.25h18M3 12h10.5M3 6.75h15" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 6.75V12M10.5 12V17.25M16.5 12V17.25" />
                </svg>

                <x-nav-link :href="route('autorizante.index')" :active="request()->routeIs('autorizante.index')">
                    {{-- nombre del link --}}
                    <span class="mx-4"> {{ __('Autorizante') }}</span>
                </x-nav-link>
            </div> -->


            {{-- link Estadísticas --}}
            <div class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 17.25h18M3 12h10.5M3 6.75h15" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 6.75V12M10.5 12V17.25M16.5 12V17.25" />
                </svg>

                <x-nav-link :href="route('estadisticas')" :active="request()->routeIs('estadisticas')" title="Ver todas las estadísticas">
                    {{-- nombre del link --}}
                    <span class="mx-4"> {{ __('Estadísticas') }}</span>
                </x-nav-link>
            </div>
        @endif

        {{-- Moderador --}}
        @if(Auth::user()->rol === 'Moderador')

       {{-- link Gestion --}}
        <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
            href="{{ route('Gestion') }}" title="Ir a la gestión general">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                </svg>

                <span class="mx-3">Gestion</span>
            </a>

        {{-- Enlace de Vigilante --}}
        <div class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 17.25h18M3 12h10.5M3 6.75h15" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 6.75V12M10.5 12V17.25M16.5 12V17.25" />
            </svg>

            <x-nav-link :href="route('moderador.vigilante')" :active="request()->routeIs('moderador.vigilante')" title="Ver entradas y salidas de vehículos">
                {{-- nombre del link --}}
                <span class="mx-4"> {{ __('Vigilante') }}</span>
            </x-nav-link>
        </div>
        @endif


        {{-- Usuario --}}
        @if(Auth::user()->rol === 'Usuario')
        {{-- Enlace de Autorizante --}}
            <div class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 17.25h18M3 12h10.5M3 6.75h15" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 6.75V12M10.5 12V17.25M16.5 12V17.25" />
                </svg>

                <x-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                    {{-- nombre del link --}}
                    <span class="mx-4"> {{ __('Autorizante') }}</span>
                </x-nav-link>
            </div>
        @endif
    </nav>
</div>
