@extends('Panza')
@section('Panza')
<div class="max-w-xl mx-auto bg-white rounded-lg shadow overflow-hidden">
    <div class="md:flex">
        <div class="w-full p-4">
            <div class="relative">
                <!-- Imagen de perfil mejorada -->
                <div class="flex justify-center">
                    <img class="rounded-full h-32 w-32 border-4 border-blue-300 shadow-lg" src="{{ Auth::user()->photo_url ?: 'https://via.placeholder.com/150' }}" alt="Avatar">
                    <div class="absolute top-0 right-0 bg-blue-500 text-white p-2 rounded-full hover:bg-blue-700 cursor-pointer">
                        <i class="fas fa-pencil-alt"></i>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <h2 class="text-lg font-semibold">{{ Auth::user()->name }}</h2>
                <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>
    <div class="bg-gray-100 p-4">
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Editar Perfil
            </button>
            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Cambiar Contraseña
            </button>
        </div>
    </div>
</div>

<div class="mt-6">
    <h3 class="text-center text-lg font-semibold mb-4">Materias Activas</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-4">
        <!-- Agregar aqui las materias del alumno con un foreach -->
        <div class="bg-white rounded-lg shadow p-4">
            <h4 class="font-semibold">TITULO</h4>
            <p>Descripcion</p> <!--agregar mas datos si es necesario-->
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <h4 class="font-semibold">TITULO</h4>
            <p>Descripcion</p> <!--agregar mas datos si es necesario-->
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <h4 class="font-semibold">TITULO</h4>
            <p>Descripcion</p> <!--agregar mas datos si es necesario-->
        </div>
        
    </div>
</div>

@endsection