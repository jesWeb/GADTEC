<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
        {{-- logo --}}
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">

            <a href="{{ route('dashboard') }}">
                {{-- <x-application-logo class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" /> --}}
                <svg class="w-12 h-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z" fill="#4C51BF" stroke="#4C51BF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z" fill="white"/>
                </svg>

            </a>
            <span class="mx-2 text-2xl font-semibold text-white">GADTEC</span>
        </div>
    </div>
    {{-- Nav --}}
    <nav class="mt-10">
        {{-- link --}}
        <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25" href="{{ route('dashboard') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
            </svg>

            <span class="mx-3">Dashboard</span>
        </a>
        {{-- link --}}
        <div class="relative group ">
            <button id="dropdown-button" class="flex items-center px-6 py-2 mt-4 {{ Route::currentRouteNamed('admin.users.index') || Route::currentRouteNamed('admin.roles.index') || Route::currentRouteNamed('admin.permissions.index') ? 'text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
</svg>
   
                <span class="mx-3 ">Catalogos</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div id="dropdown-menu" class="w-full dropdown_branding">
            
                <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.users.index') ? 'text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/usuarios">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 12c2.5 0 4.5 1 6 3.5m9-3.5c-2.5 0-4.5 1-6 3.5m-6-6a3 3 0 116 0 3 3 0 01-6 0zm0 0a7.5 7.5 0 0115 0M3 12a7.5 7.5 0 0115 0" />
</svg>

        
                    <span class="mx-3">Usuarios</span>
                </a>

                <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.roles.index') ? 'text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/tarjetas">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 01-2 2H7m12-2H5a2 2 0 100 4h12m-1 4H6a2 2 0 100 4h12a2 2 0 100-4zm0 0H5" />
                    </svg>
        
                    <span class="mx-3">Tarjeta de Circulacion</span>
                </a>
        
                <a class="flex items-center px-6 py-2 mt-4 ml-5 {{ Route::currentRouteNamed('admin.permissions.index') ? 'text-gray-100' : 'text-gray-500' }} hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/tenencias">
                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
        
                    <span class="mx-3">Tenencias / Refrendo</span>
                </a>

            </div>
        </div>
        

        {{-- link --}}
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/multas">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 13.5h7.5m-7.5 0a1.5 1.5 0 100-3h7.5a1.5 1.5 0 100 3m-7.5 0v3m7.5-3v3M6.75 21h10.5M4.5 4.5l3.75 3.75M16.5 4.5l-3.75 3.75M7.5 10.5L3 7.5M16.5 10.5L21 7.5" />
        </svg>

            <span class="mx-3">Multas </span>
        </a>

        {{-- link --}}
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/servicios">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 19.5h10.5M4.5 7.5l1.5-3h12l1.5 3M5.25 7.5h13.5v9.75H5.25V7.5zM8.25 16.5h7.5M9.75 16.5a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm4.5 0a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
            </svg>
            <span class="mx-3">Servicios </span>
        </a>

        
       

    </nav>
</div>


<script>
    // JavaScript to toggle the dropdown
    const dropdownButton = document.getElementById('dropdown-button');
    const dropdownMenu = document.getElementById('dropdown-menu');
    let isOpen = true; // Set to true to open the dropdown by default

    // Function to toggle the dropdown state
    function toggleDropdown() {
        isOpen = !isOpen;
        dropdownMenu.classList.toggle('hidden', !isOpen);
    }

    // Set initial state
    toggleDropdown();

    dropdownButton.addEventListener('click', () => {
        toggleDropdown();
    });
</script>