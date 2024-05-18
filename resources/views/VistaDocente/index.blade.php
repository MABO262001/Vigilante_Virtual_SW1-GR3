@extends('Panza')
@section('Panza')
<div>
    <div class="container mx-auto mt-8">
        <div class="max-w-xl mx-auto bg-white rounded-lg overflow-hidden shadow-lg mt-4 border border-gray-200">
            <div class="px-8 py-6">
                <h2 class="text-3xl text-center text-black">Bienvenido {{ Auth::user()->name }}👋</h2>

                <div class="flex items-center justify-center">
                    @if (Auth::user()->foto)
                        <img class="w-32 h-32 rounded-full mr-4" src="{{ Auth::user()->foto }}" alt="Foto de perfil">
                    @else
                        <div class="w-32 h-32 rounded-full bg-gray-300 mr-4"></div>
                    @endif
                    <div>
                        <p class="text-black"><strong>Correo:</strong> {{ Auth::user()->email }}</p>
                        <p class="text-black"><strong>Telefono:</strong> {{ Auth::user()->telefono }}</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <p class="text-black text-center py-4 text-xl"><strong>Mis Materias</p>
    <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- cursos activos del usuario (modificar despues)-->
        
        @foreach ($materias as $materia)
            <div class="bg-white overflow-hidden shadow-lg rounded-lg border-t-4 border-blue-900">
                <div class="px-6 py-4">
                    <h3 class="font-bold text-xl text-gray-800 mb-2">{{ $materia->sigla }} - {{ $materia->nombre }}</h3>    
                    <p class="text-gray-700 text-base">{{ $materia->descripcion }} </p>
                </div>
                <div class="px-4 py-2 bg-gray-100">
                    <a href="{{ route('Docente.materia', ['id' => $materia->sigla]) }}" class="text-blue-600 hover:underline">Ver detalles</a>
                </div>
            </div>
        @endforeach

        <!--Probando solo la vista-->



    </div>
</div>


@endsection
