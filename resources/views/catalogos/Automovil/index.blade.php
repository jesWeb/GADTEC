@extends('layouts.app')


@section('body')
    <div class="container mt-5">
        {{-- btn --}}
        <a class="" href="{{ route('Automovil.create') }}" >Crear nuevo</a>
        <div class="mx-4 overflow-hidden rounded-lg shadow-lg md:mx-10">
            <table class="w-full table-fixed">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">Marca</th>
                        <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">placas</th>
                        <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">Nsi</th>
                        <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">Status</th>
                        <th class="w-1/4 px-6 py-4 font-bold text-left text-gray-600 uppercase">Aciiones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($autos as $auto)
                        <tr>
                            <td class="px-6 py-4 border-b border-gray-200">{{$auto->marca}}</td>
                            <td class="px-6 py-4 truncate border-b border-gray-200">{{$auto->placas}}</td>
                            <td class="px-6 py-4 border-b border-gray-200">{{$auto->NSI}}</td>
                            <td class="px-6 py-4 border-b border-gray-200">
                                <span class="px-2 py-1 text-xs text-white bg-green-500 rounded-full">Active</span>
                            </td>
                        </tr>
                        {{-- acciones --}}
                        <td>
                            <a href="{{ route('Automovil.edit', $auto->id) }}">Editar</a>
                            <a href="{{ route('Automovil.show', $auto->id) }}">Ver</a>
                        </td>
                    @endforeach


                    <!-- Add more rows here -->
                </tbody>
            </table>
        </div>
`  <!-- Navegación de paginación -->
{{ $autos->links() }}
    </div>


    {{-- <div class="mt-4">
    <h4 class="text-gray-600">Alerts</h4>

    <div class="mt-4">
        <div class="px-4 py-4 overflow-x-auto whitespace-no-wrap bg-white rounded-md">
            <div class="inline-flex w-full max-w-sm ml-3 overflow-hidden bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-center w-12 bg-green-500">
                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"/>
                    </svg>
                </div>

                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-green-500">Success</span>
                        <p class="text-sm text-gray-600">Your account was registered!</p>
                    </div>
                </div>
            </div>

            <div class="inline-flex w-full max-w-sm ml-3 overflow-hidden bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-center w-12 bg-blue-500">
                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"/>
                    </svg>
                </div>

                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-blue-500">Info</span>
                        <p class="text-sm text-gray-600">This channel archived by owner !</p>
                    </div>
                </div>
            </div>

            <div class="inline-flex w-full max-w-sm ml-3 overflow-hidden bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-center w-12 bg-yellow-500">
                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"/>
                    </svg>
                </div>

                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-yellow-500">Warning</span>
                        <p class="text-sm text-gray-600">Your image size is to large !</p>
                    </div>
                </div>
            </div>

            <div class="inline-flex w-full max-w-sm ml-3 overflow-hidden bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-center w-12 bg-red-500">
                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"/>
                    </svg>
                </div>

                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-red-500">Error</span>
                        <p class="text-sm text-gray-600">Your email is already used!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-8">
    <h4 class="text-gray-600">Radio Buttons</h4>

    <div class="mt-4">
        <div class="flex px-4 py-4 overflow-x-auto bg-white rounded-md">
            <label class="inline-flex items-center">
                <input type="radio" class="w-5 h-5 text-gray-600 form-radio" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="radio" class="w-5 h-5 text-red-600 form-radio" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="radio" class="w-5 h-5 text-orange-600 form-radio" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="radio" class="w-5 h-5 text-yellow-600 form-radio" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="radio" class="w-5 h-5 text-green-600 form-radio" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="radio" class="w-5 h-5 text-teal-600 form-radio" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="radio" class="w-5 h-5 text-blue-600 form-radio" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="radio" class="w-5 h-5 text-indigo-600 form-radio" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="radio" class="w-5 h-5 text-purple-600 form-radio" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="radio" class="w-5 h-5 text-pink-600 form-radio" checked><span class="ml-2 text-gray-700">label</span>
            </label>
        </div>
    </div>
</div>

<div class="mt-8">
    <h4 class="text-gray-600">Checkboxes</h4>

    <div class="mt-4">
        <div class="flex px-4 py-4 overflow-x-auto bg-white rounded-md">
            <label class="inline-flex items-center">
                <input type="checkbox" class="w-5 h-5 text-gray-600 form-checkbox" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="checkbox" class="w-5 h-5 text-red-600 form-checkbox" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="checkbox" class="w-5 h-5 text-orange-600 form-checkbox" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="checkbox" class="w-5 h-5 text-yellow-600 form-checkbox" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="checkbox" class="w-5 h-5 text-green-600 form-checkbox" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="checkbox" class="w-5 h-5 text-teal-600 form-checkbox" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="checkbox" class="w-5 h-5 text-blue-600 form-checkbox" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="checkbox" class="w-5 h-5 text-indigo-600 form-checkbox" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="checkbox" class="w-5 h-5 text-purple-600 form-checkbox" checked><span class="ml-2 text-gray-700">label</span>
            </label>

            <label class="inline-flex items-center ml-3">
                <input type="checkbox" class="w-5 h-5 text-pink-600 form-checkbox" checked><span class="ml-2 text-gray-700">label</span>
            </label>
        </div>
    </div>
</div>

<div class="mt-8">
    <h4 class="text-gray-600">Buttons</h4>

    <div class="mt-4">
        <div class="flex px-4 py-4 overflow-x-auto bg-white rounded-md">
            <button class="px-6 py-3 font-medium tracking-wide text-white bg-gray-600 rounded-md hover:bg-gray-500">Button</button>
            <button class="px-6 py-3 ml-3 font-medium tracking-wide text-white bg-red-600 rounded-md hover:bg-red-500">Button</button>
            <button class="px-6 py-3 ml-3 font-medium tracking-wide text-white bg-orange-600 rounded-md hover:bg-orange-500">Button</button>
            <button class="px-6 py-3 ml-3 font-medium tracking-wide text-white bg-yellow-600 rounded-md hover:bg-yellow-500">Button</button>
            <button class="px-6 py-3 ml-3 font-medium tracking-wide text-white bg-green-600 rounded-md hover:bg-green-500">Button</button>
            <button class="px-6 py-3 ml-3 font-medium tracking-wide text-white bg-teal-600 rounded-md hover:bg-teal-500">Button</button>
            <button class="px-6 py-3 ml-3 font-medium tracking-wide text-white bg-blue-600 rounded-md hover:bg-blue-500">Button</button>
            <button class="px-6 py-3 ml-3 font-medium tracking-wide text-white bg-indigo-600 rounded-md hover:bg-indigo-500">Button</button>
            <button class="px-6 py-3 ml-3 font-medium tracking-wide text-white bg-purple-600 rounded-md hover:bg-purple-500">Button</button>
            <button class="px-6 py-3 ml-3 font-medium tracking-wide text-white bg-pink-600 rounded-md hover:bg-pink-500">Button</button>
        </div>
    </div>
</div>

<div class="mt-8">
    <h4 class="text-gray-600">Pagnations</h4>

    <div class="mt-4">
        <div class="flex px-4 py-4 overflow-x-auto bg-white rounded-md">
            <div class="flex mr-4 rounded">
                <a href="#" class="px-3 py-2 ml-0 leading-tight text-blue-700 bg-white border border-r-0 border-gray-200 rounded-l hover:bg-indigo-500 hover:text-white"><span>Previous</a></a>
                <a href="#" class="px-3 py-2 leading-tight text-blue-700 bg-white border border-r-0 border-gray-200 hover:bg-indigo-500 hover:text-white"><span>1</span></a>
                <a href="#" class="px-3 py-2 leading-tight text-blue-700 bg-white border border-r-0 border-gray-200 hover:bg-indigo-500 hover:text-white"><span>2</span></a>
                <a href="#" class="px-3 py-2 leading-tight text-blue-700 bg-white border border-r-0 border-gray-200 hover:bg-indigo-500 hover:text-white"><span>3</span></a>
                <a href="#" class="px-3 py-2 leading-tight text-blue-700 bg-white border border-gray-200 rounded-r hover:bg-indigo-500 hover:text-white"><span>Next</span></a>
            </div>
        </div>
    </div>
</div>



<div class="mt-8">
    <h4 class="text-gray-600">Table with pagination</h4>

    <div class="mt-6">
        <h2 class="text-xl font-semibold leading-tight text-gray-700">Users</h2>

        <div class="flex flex-col mt-3 sm:flex-row">
            <div class="flex">
                <div class="relative">
                    <select class="block w-full h-full px-4 py-2 pr-8 leading-tight text-gray-700 bg-white border border-gray-400 rounded-l appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                        <option>5</option>
                        <option>10</option>
                        <option>20</option>
                    </select>

                    <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>

                <div class="relative">
                    <select class="block w-full h-full px-4 py-2 pr-8 leading-tight text-gray-700 bg-white border-t border-b border-r border-gray-400 rounded-r appearance-none sm:rounded-r-none sm:border-r-0 focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                        <option>All</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>

                    <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="relative block mt-2 sm:mt-0">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg viewBox="0 0 24 24" class="w-4 h-4 text-gray-500 fill-current">
                        <path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"></path>
                    </svg>
                </span>

                <input placeholder="Search" class="block w-full py-2 pl-8 pr-6 text-sm text-gray-700 placeholder-gray-400 bg-white border border-b border-gray-400 rounded-l rounded-r appearance-none sm:rounded-l-none focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
            </div>
        </div>

        <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
            <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">User</th>
                            <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">Rol</th>
                            <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">Created at</th>
                            <th class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-full h-full rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80" alt="" />
                                    </div>

                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">Vera Carpenter</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">Admin</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">Jan 21, 2020</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                    <span aria-hidden class="absolute inset-0 bg-green-200 rounded-full opacity-50"></span>
                                    <span class="relative">Activo</span>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-full h-full rounded-full" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80" alt="" />
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap"> Blake Bowman</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">Editor</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">Jan 01, 2020</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                    <span aria-hidden class="absolute inset-0 bg-green-200 rounded-full opacity-50"></span>
                                    <span class="relative">Activo</span>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-full h-full rounded-full" src="https://images.unsplash.com/photo-1540845511934-7721dd7adec3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80" alt="" />
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">Dana Moore</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">Editor</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <p class="text-gray-900 whitespace-no-wrap">Jan 10, 2020</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-orange-900">
                                    <span aria-hidden class="absolute inset-0 bg-orange-200 rounded-full opacity-50"></span>
                                    <span class="relative">Suspended</span>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-5 py-5 text-sm bg-white">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-full h-full rounded-full" src="https://images.unsplash.com/photo-1522609925277-66fea332c575?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&h=160&w=160&q=80" alt="" />
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap">Alonzo Cox</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white">
                                <p class="text-gray-900 whitespace-no-wrap">Admin</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white">
                                <p class="text-gray-900 whitespace-no-wrap">Jan 18, 2020</p>
                            </td>
                            <td class="px-5 py-5 text-sm bg-white">
                                <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-red-900">
                                    <span aria-hidden class="absolute inset-0 bg-red-200 rounded-full opacity-50"></span>
                                    <span class="relative">Inactive</span>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="flex flex-col items-center px-5 py-5 bg-white border-t xs:flex-row xs:justify-between">
                    <span class="text-xs text-gray-900 xs:text-sm">Showing 1 to 4 of 50 Entries</span>

                    <div class="inline-flex mt-2 xs:mt-0">
                        <button class="px-4 py-2 text-sm font-semibold text-gray-800 bg-gray-300 rounded-l hover:bg-gray-400">Prev</button>
                        <button class="px-4 py-2 text-sm font-semibold text-gray-800 bg-gray-300 rounded-r hover:bg-gray-400">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-8">
    <h4 class="text-gray-600">Wide Table</h4>

    <div class="flex flex-col mt-6">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">Name</th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">Title</th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">Status</th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase bg-gray-100 border-b border-gray-200">Role</th>
                            <th class="px-6 py-3 bg-gray-100 border-b border-gray-200"></th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">John Doe</div>
                                        <div class="text-sm leading-5 text-gray-500">john@example.com</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">Software Engineer</div>
                                <div class="text-sm leading-5 text-gray-500">Web dev</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                            </td>

                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">Owner</td>

                            <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">John Doe</div>
                                        <div class="text-sm leading-5 text-gray-500">john@example.com</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">Software Engineer</div>
                                <div class="text-sm leading-5 text-gray-500">Web dev</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                            </td>

                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">Owner</td>

                            <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">John Doe</div>
                                        <div class="text-sm leading-5 text-gray-500">john@example.com</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">Software Engineer</div>
                                <div class="text-sm leading-5 text-gray-500">Web dev</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                            </td>

                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">Owner</td>

                            <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">John Doe</div>
                                        <div class="text-sm leading-5 text-gray-500">john@example.com</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">Software Engineer</div>
                                <div class="text-sm leading-5 text-gray-500">Web dev</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                            </td>

                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">Owner</td>

                            <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">John Doe</div>
                                        <div class="text-sm leading-5 text-gray-500">john@example.com</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">Software Engineer</div>
                                <div class="text-sm leading-5 text-gray-500">Web dev</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                            </td>

                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">Owner</td>

                            <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">John Doe</div>
                                        <div class="text-sm leading-5 text-gray-500">john@example.com</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">Software Engineer</div>
                                <div class="text-sm leading-5 text-gray-500">Web dev</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                            </td>

                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">Owner</td>

                            <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">John Doe</div>
                                        <div class="text-sm leading-5 text-gray-500">john@example.com</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">Software Engineer</div>
                                <div class="text-sm leading-5 text-gray-500">Web dev</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                            </td>

                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">Owner</td>

                            <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                    </div>

                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">John Doe</div>
                                        <div class="text-sm leading-5 text-gray-500">john@example.com</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-sm leading-5 text-gray-900">Software Engineer</div>
                                <div class="text-sm leading-5 text-gray-500">Web dev</div>
                            </td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                            </td>

                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">Owner</td>

                            <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> --}}
@endsection
