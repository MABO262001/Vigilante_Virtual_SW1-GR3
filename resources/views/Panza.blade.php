<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Vigilante</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Styles -->
    @livewireStyles
</head>
<div class="flex flex-col min-h-screen h-auto bg-gray-300">
    <div class="bg-blue-900 text-white shadow w-full p-2 flex items-center justify-between">
        <div class="flex items-center">
            <span class="font-extrabold uppercase text-xl">Verificador</span><span
                class=" text-xl uppercase ml-1">online.com</span>
            <div class="md:hidden flex items-center">
                <button id="menuBtn">
                    <i class="fas fa-bars text-gray-500 text-lg"></i>
                </button>
            </div>
        </div>
        <div class="space-x-5">
            <button>
                <i class="fas fa-user text-white text-lg"></i>
                <span class="text-white hidden md:inline">{{ Auth::user()->name }}</span>
            </button>
        </div>
    </div>

    <div class="flex-1 flex flex-wrap">
        <div class="p-2 bg-white w-full md:w-60 flex flex-col md:flex hidden shadow-lg" id="sideNav">
            <nav>
                <a href="{{ route('Usuario.show') }}" class="block text-center">
                    <div id="profile" class="space-y-3 p-4 shadow">
                        <img
                            src="{{ Auth::user()->photo_url ?: 'https://img.freepik.com/premium-vector/user-profile-icon-flat-style-member-avatar-vector-illustration-isolated-background-human-permission-sign-business-concept_157943-15752.jpg' }}"
                            alt="Avatar de {{ Auth::user()->name }}"
                            class="w-16 h-16 md:w-24 md:h-24 rounded-full mx-auto"
                        />
                        <div>
                            <h2 class="font-medium text-sm md:text-lg text-blue-900">
                                {{ Auth::user()->name }}
                            </h2>
                            <p class="text-xs md:text-sm text-gray-500">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>
                </a>
                
                <a class="flex items-center text-gray-900 py-2 px-4 my-2 rounded transition duration-100 hover:bg-gradient-to-r from-blue-600 to-blue-600 hover:text-white shadow-sm"
                    href="{{ route('Dashboard') }}">
                    <i class="fa-solid fa-home text-lg mr-2"></i><span class="text-base">Inicio</span>
                </a>
                <a class="flex items-center text-gray-900 py-2 px-4 my-2 rounded transition duration-100 hover:bg-gradient-to-r from-blue-600 to-blue-600 hover:text-white shadow-sm"
                    href="{{ route('Usuario.index') }}">
                    <i class="fa-solid fa-user text-lg mr-2"></i><span class="text-base">Usuario</span>
                </a>
                <a class="flex items-center text-gray-900 py-2 px-4 my-2 rounded transition duration-100 hover:bg-gradient-to-r from-blue-600 to-blue-600 hover:text-white shadow-sm"
                    href="{{ route('Roles.index') }}">
                    <i class="fa-solid fa-lock text-lg mr-2"></i><span class="text-base">Roles y Permisos</span>
                </a>
                <a class="flex items-center text-gray-900 py-2 px-4 my-2 rounded transition duration-100 hover:bg-gradient-to-r from-blue-600 to-blue-600 hover:text-white shadow-sm"
                    href="{{ route('Examen.index') }}">
                    <i class="fa-solid fa-file-lines text-lg mr-2"></i><span class="text-base">Examenes</span>
                </a>
                <a class="flex items-center text-gray-900 py-2 px-4 my-2 rounded transition duration-300 hover:bg-gradient-to-r from-blue-600 to-blue-600 hover:text-white shadow-sm"
                    href="{{ route('Reconocimiento-Facial.index') }}">
                    <i class="fa-solid fa-user text-lg mr-2"></i><span class="text-base">Reconocimiento Facial</span>
                </a>
                <a class="flex items-center text-gray-900 py-2 px-4 my-2 rounded transition duration-300 hover:bg-gradient-to-r from-blue-600 to-blue-600 hover:text-white shadow-sm"
                    href="{{ route('Servicio.index') }}">
                    <i class="fas fa-store text-lg mr-2"></i><span class="text-base">Servicios</span>
                </a>
                <a class="flex items-center text-gray-900 py-2 px-4 my-2 rounded transition duration-300 hover:bg-gradient-to-r from-blue-600 to-blue-600 hover:text-white shadow-sm"
                    href="{{ route('GrupoMateria.index') }}">
                    <i class="fas fa-users text-lg mr-2"></i><span class="text-base">Grupos Y Materias</span>
                </a>
                {{--@if (auth()->user()->hasRole('Estudiante'))--}}
                <a class="flex items-center text-gray-900 py-2 px-4 my-2 rounded transition duration-300 hover:bg-gradient-to-r from-blue-600 to-blue-600 hover:text-white shadow-sm"
                    href="{{ route('Estudiante.index') }}">
                    <i class="fas fa-users text-lg mr-2"></i><span class="text-base">Perfil Estudiante</span>
                </a>
                {{--@endif--}}
                {{--@if (auth()->user()->hasRole('Estudiante'))--}}
                <a class="flex items-center text-gray-900 py-2 px-4 my-2 rounded transition duration-300 hover:bg-gradient-to-r from-blue-600 to-blue-600 hover:text-white shadow-sm"
                    href="{{ route('Docente.index') }}">
                    <i class="fas fa-users text-lg mr-2"></i><span class="text-base">Perfil Docente</span>
                </a>
                {{--@endif--}}

            </nav>
            <form method="POST" action="{{ route('logout') }}" class="mt-auto p-4">
                @csrf
                <button
                    class="w-full text-gray-900 py-2 px-4 rounded transition duration-300 hover:bg-gradient-to-r from-blue-600 to-blue-600 hover:text-white shadow"
                    type="submit">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i><span>Cerrar sesión</span>
                </button>
            </form>
            <div class="bg-gradient-to-r from-blue-300 to-blue-500 h-px mx-4 my-2"></div>
        </div>
        <div class="flex-1 p-4 w-full md:w-1/2">
            <div class="mt-1 min-h-full flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
                <div class="flex-1 bg-white p-4 shadow rounded-lg w-full">
                    @yield('Panza')
                </div>
            </div>
        </div>
    </div>
    
</div>
<script>
    const menuBtn = document.getElementById('menuBtn');
    const textosSidebar = document.getElementsByClassName('textoSidebar');
    const mediaQuery = window.matchMedia('(min-width: 768px)');


    menuBtn.addEventListener('click', () => {
        sideNav.classList.toggle('hidden');
    });
</script>


<html>