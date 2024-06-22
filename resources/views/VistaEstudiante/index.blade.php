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
                    <a href="{{ route('Usuario.edit', ['id' => Auth::user()->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-md">Editar</a>

                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('Estudiante.calificaciones') }}" class="text-blue-600 hover:underline">Mis Calificaciones</a>
    </div>

    <div class="text-center mt-4">
        No tienes una clase? <a href="{{ route('Estudiante.unirse_curso') }}" class="text-blue-600 hover:underline">Únete a tu clase.</a>
    </div>

    <p class="text-black text-center py-4 text-xl"><strong>Mis Materias</p>
        <div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <!-- cursos activos del usuario (modificar despues)-->
            
            @foreach ($grupomaterias as $grupomateria)
                <div class="bg-white overflow-hidden shadow-lg rounded-lg border-t-4 border-blue-900">
                    <div class="px-6 py-4">
                        <h3 class="font-bold text-xl text-gray-800 mb-2">{{ $grupomateria['materia']->sigla }} - {{ $grupomateria['materia']->nombre }} Grupo: {{ $grupomateria['grupo']->nombre }}</h3>    
                        <p class="text-gray-700 text-base">{{ $grupomateria['materia']->descripcion}} </p>
                    </div>
                    <div class="px-4 py-2 bg-gray-100">
                        <a href="{{ route('Estudiante.materia', ['id' => $grupomateria['gp']->id]) }}" class="text-blue-600 hover:underline">Ver detalles</a>
                    </div>                
                </div>
            @endforeach
    
            <!--Probando solo la vista-->
    
    
    
        </div>
</div>


@endsection
