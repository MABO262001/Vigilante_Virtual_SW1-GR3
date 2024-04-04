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
        <div class="p-2 bg-yellow-50 w-full md:w-60 flex flex-col md:flex hidden " id="sideNav">
            <nav>
                <!-- ACA AÑADAN LOS A PARA REDIRIGIR, AOPAUS -->
                <a class="block text-gray-500 py-1 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-500 hover:text-white"
                    href="{{ route('Dashboard') }}">
                    <i class="fa-solid fa-home "></i><span class="textoSidebar ml-2">Inicio</span>
                </a>
                <a class="block text-gray-500 py-1 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-500 hover:text-white"
                    href="{{ route('Usuario.index') }}">
                    <i class="fa-solid fa-user"></i> <span class="textoSidebar ml-2">Usuario</span>
                </a>
                <a class="block text-gray-500 py-1 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-500 hover:text-white"
                    href="{{ route('Roles.index') }}">
                    <i class="fa-solid fa-lock"></i> <span class="textoSidebar ml-2">Roles y Permisos</span>
                </a>
                <a class="block text-gray-500 py-1 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-500 hover:text-white"
                    href="{{ route('Examen.index') }}">
                    <i class="fa-solid fa-file-lines"></i> <span class="textoSidebar ml-2">Examenes</span>
                </a>
                <a class="block text-gray-500 py-1 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-500 hover:text-white"
                    href="{{ route('Reconocimiento-Facial.index') }}">
                    <i class="fa-solid fa-user"></i> <span class="textoSidebar ml-2">Reconocimiento Facial</span>
                </a>
            </nav>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="block text-gray-500 py-1 px-4 my-2 rounded transition duration-200 hover:bg-gradient-to-r hover:from-blue-500 hover:to-blue-500 hover:text-white mt-auto"
                    type="submit">
                    <i class="fa-solid fa-right-from-bracket "></i><span class="textoSidebar ml-2">Cerrar sesión</span>
                </button>
            </form>
            <div class="bg-gradient-to-r from-blue-300 to-blue-500 h-px mt-2"></div>
        </div>
        <div class="flex-1 p-4 w-full md:w-1/2">
            <div class="mt-1 min-h-full flex flex-wrap space-x-0 space-y-2 md:space-x-4 md:space-y-0">
                <div class="flex-1  bg-white p-4 shadow rounded-lg w-full">
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
</body>

</html>
