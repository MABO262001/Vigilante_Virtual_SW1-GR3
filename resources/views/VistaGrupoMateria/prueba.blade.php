@extends('Panza')
@section('Panza')

<main class="w-full max-w-4xl mx-auto px-4 py-8 md:px-6 md:py-12">
    <h1 class="text-3xl font-bold mb-4">Materia: {{ $materia->nombre }} - Grupo: {{ $grupo->nombre }}</h1>
    <div>
        <h2 class="text-xl font-semibold mb-2">Detalles de la materia</h2>
        <div class="space-y-2">
            <p>
                <span class="font-medium">Profesor:</span> {{ $docente->name }}
            </p>
        </div>
    </div>
    <div class="mt-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <a href="#" id="tabExamenes" class="border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Exámenes</a>
                <a href="#" id="tabEstudiantes" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Estudiantes Inscritos</a>
                @if($user->hasRole('Estudiante'))
                <a href="#" id="tabCalificaciones" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Mis Calificaciones</a>
                @endif
            </nav>
        </div>
        <div id="contentExamenes" class="mt-4">
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-xl font-semibold">Exámenes</h2>
                @if($user->hasRole('Docente'))
                <a href="{{ route('Examen.create', ['id' => $gp->id]) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Crear Examen</a>
                @endif
            </div>
            <div class="border rounded-lg overflow-hidden">
                <table class="w-full table-auto">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Examen</th>
                            <th class="px-4 py-2 text-left">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Agregar filas de exámenes aquí --}}
                    </tbody>
                </table>
            </div>
        </div>
        <div id="contentEstudiantes" class="mt-4 hidden">
            <h2 class="text-xl font-semibold mb-2">Estudiantes Inscritos</h2>
            <div class="border rounded-lg overflow-hidden">
                <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden mt-4">
                    <thead class="bg-gradient-to-r from-blue-700 to-black text-white uppercase text-sm leading-normal">
                        <tr>
                            <th class="py-3 px-6 text-left">Usuario</th>
                            <th class="py-3 px-6 text-left">Nombre</th>
                            <th class="py-3 px-6 text-center">Rol</th>
                        </tr>
                    </thead>
                    <tbody class="text-black text-sm font-light">
                        @foreach ($usuarios as $usuario)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-200 ease-in-out">
                                <td class="py-3 px-6 text-left">
                                    <a href="{{ route('Usuario.show', $usuario->id) }}" class="flex items-center text-blue-600 hover:text-blue-800">
                                        <div class="mr-4 flex justify-center items-center w-12 h-12 rounded-full border-2 border-blue-500 shadow-lg bg-blue-900 text-white">
                                            @if ($usuario->profile_photo_path)
                                                <img class="w-12 h-12 rounded-full" src="{{ asset('images/user/' . basename($usuario->profile_photo_path)) }}" alt="Profile Photo">
                                            @else
                                                <span class="text-xl">{{ strtoupper(substr($usuario->name, 0, 1)) }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="font-semibold text-lg">{{ $usuario->name }}</span>
                                            <p class="text-gray-500 text-xs">{{ $usuario->email }}</p>
                                        </div>
                                    </a>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <a href="{{ route('Usuario.show', $usuario->id) }}" class="font-medium text-blue-600 hover:text-blue-800">{{ $usuario->nombre }} {{ $usuario->apellido_paterno }} {{ $usuario->apellido_materno }}</a>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        @if ($usuario->roles->isNotEmpty())
                                            @foreach ($usuario->roles as $rol)
                                                <span class="bg-blue-300 text-black-700 py-1 px-3 rounded-full text-xs mr-2">{{ $rol->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="bg-yellow-200 text-yellow-700 py-1 px-3 rounded-full text-xs">Por designar</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="contentCalificaciones" class="mt-4 hidden">
            <h2 class="text-xl font-semibold mb-2">Mis Calificaciones</h2>
            <div class="border rounded-lg overflow-hidden">
                <table class="w-full table-auto">
                    <thead class="bg-gray-100 dark:bg-gray-800">
                        <tr>
                            <th class="px-4 py-2 text-left">Nro</th>
                            <th class="px-4 py-2 text-left">Examen</th>
                            <th class="px-4 py-2 text-left">Fecha</th>
                            <th class="px-4 py-2 text-left">Nota</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Agregar filas de calificaciones aquí --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('tabExamenes').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('contentExamenes').classList.remove('hidden');
        document.getElementById('contentEstudiantes').classList.add('hidden');
        document.getElementById('contentCalificaciones').classList.add('hidden');
        this.classList.add('border-blue-500', 'text-blue-600');
        this.classList.remove('border-transparent', 'text-gray-500');
        document.getElementById('tabEstudiantes').classList.remove('border-blue-500', 'text-blue-600');
        document.getElementById('tabEstudiantes').classList.add('border-transparent', 'text-gray-500');
        document.getElementById('tabCalificaciones').classList.remove('border-blue-500', 'text-blue-600');
        document.getElementById('tabCalificaciones').classList.add('border-transparent', 'text-gray-500');
    });

    document.getElementById('tabEstudiantes').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('contentEstudiantes').classList.remove('hidden');
        document.getElementById('contentExamenes').classList.add('hidden');
        document.getElementById('contentCalificaciones').classList.add('hidden');
        this.classList.add('border-blue-500', 'text-blue-600');
        this.classList.remove('border-transparent', 'text-gray-500');
        document.getElementById('tabExamenes').classList.remove('border-blue-500', 'text-blue-600');
        document.getElementById('tabExamenes').classList.add('border-transparent', 'text-gray-500');
        document.getElementById('tabCalificaciones').classList.remove('border-blue-500', 'text-blue-600');
        document.getElementById('tabCalificaciones').classList.add('border-transparent', 'text-gray-500');
    });

    document.getElementById('tabCalificaciones').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('contentCalificaciones').classList.remove('hidden');
        document.getElementById('contentExamenes').classList.add('hidden');
        document.getElementById('contentEstudiantes').classList.add('hidden');
        this.classList.add('border-blue-500', 'text-blue-600');
        this.classList.remove('border-transparent', 'text-gray-500');
        document.getElementById('tabExamenes').classList.remove('border-blue-500', 'text-blue-600');
        document.getElementById('tabExamenes').classList.add('border-transparent', 'text-gray-500');
        document.getElementById('tabEstudiantes').classList.remove('border-blue-500', 'text-blue-600');
        document.getElementById('tabEstudiantes').classList.add('border-transparent', 'text-gray-500');
    });

    // Mostrar inicialmente la tabla de estudiantes
    document.getElementById('tabEstudiantes').click();
</script>

@endsection
