<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Mejorado</title>
  @vite('resources/css/app.css')
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .bg-blue-gradient {
      background: linear-gradient(to right, #1E40AF, #2563EB);
    }
    .nav-link {
      transition: background-color 0.3s ease, color 0.3s ease;
      font-weight: 500;
    }
    .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.2);
      color: #fff;
    }
    .btn-primary {
      background-color: #2563EB;
      color: #fff;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #1E40AF;
    }
    .btn-secondary {
      background-color: #FBBF24;
      color: #fff;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }
    .btn-secondary:hover {
      background-color: #F59E0B;
    }
    .mobile-menu-button {
      background-color: #1E40AF;
      transition: background-color 0.3s ease;
    }
    .mobile-menu-button:hover {
      background-color: #2563EB;
    }
    .mobile-menu {
      display: none;
    }
    .mobile-menu.active {
      display: block;
    }
  </style>
  <!-- Import Inter Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100">

  <nav class="bg-blue-gradient shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow">
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
                <a href="/" class="text-white hover:text-blue-900 hover:bg-white px-3 py-2 rounded-md text-sm font-medium nav-link"><b>Inicio</b></a>
                <a href="{{ route('acerca') }}" class="text-white hover:text-blue-900 hover:bg-white px-3 py-2 rounded-md text-sm font-medium nav-link"><b>Acerca de</b></a>
                <a href="{{ route('contacto') }}" class="text-white hover:text-blue-900 hover:bg-white px-3 py-2 rounded-md text-sm font-medium nav-link"><b>Contacto</b></a>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            <a href="{{ route('login') }}" class="bg-white px-3 py-2 rounded-md text-sm font-medium ml-2"><b>Iniciar Sesión</b></a>
            <a href="{{ route('planes') }}" class="btn-secondary px-3 py-2 rounded-md text-sm font-medium ml-2"><b>Adquirir Plan</b></a>
          </div>
        </div>
        <div class="flex md:hidden">
          <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-800 focus:ring-white" aria-controls="mobile-menu" aria-expanded="false" id="mobile-menu-button">
            <span class="sr-only">Abrir menú principal</span>
            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <div class="mobile-menu md:hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
        <a href="/" class="text-white hover:text-gray-300 block px-3 py-2 rounded-md text-base font-medium nav-link">Inicio</a>
        <a href="{{ route('acerca') }}" class="text-white hover:text-gray-300 block px-3 py-2 rounded-md text-base font-medium nav-link">Acerca de</a>
        <a href="{{ route('contacto') }}" class="text-white hover:text-gray-300 block px-3 py-2 rounded-md text-base font-medium nav-link">Contacto</a>
        <a href="{{ route('login') }}" class="btn-primary block text-center px-3 py-2 rounded-md text-base font-medium">Iniciar Sesión</a>
        <a href="{{ route('planes') }}" class="btn-secondary block text-center px-3 py-2 rounded-md text-base font-medium">Adquirir Plan</a>
      </div>
    </div>
  </nav>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const mobileMenuButton = document.getElementById('mobile-menu-button');
      const mobileMenu = document.getElementById('mobile-menu');
      const menuIconOpen = mobileMenuButton.querySelector('svg:first-of-type');
      const menuIconClose = mobileMenuButton.querySelector('svg:last-of-type');
  
      mobileMenuButton.addEventListener('click', function() {
        const expanded = mobileMenuButton.getAttribute('aria-expanded') === 'true' || false;
        mobileMenuButton.setAttribute('aria-expanded', !expanded);
        mobileMenu.classList.toggle('active');
        menuIconOpen.classList.toggle('hidden');
        menuIconClose.classList.toggle('hidden');
      });
    });
  </script>

</body>
</html>
