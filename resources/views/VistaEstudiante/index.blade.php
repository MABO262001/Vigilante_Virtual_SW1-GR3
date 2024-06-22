<x-navbar />

<div>
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

@include('components.footer')
