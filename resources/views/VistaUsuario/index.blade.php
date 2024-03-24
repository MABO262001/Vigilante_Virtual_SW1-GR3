@extends('Panza')
@section('Panza')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="font-extrabold text-blue-900 text-3xl mt-2 uppercase">Administración De Usuarios</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
        <div class="bg-white p-4 rounded-xl shadow-md text-center">
            <h3 id="creados" class="font-extrabold text-4xl sm:text-5xl lg:text-6xl">{{ $totalUsuarios }}</h3>
            <i class="fa-solid fa-user text-2xl sm:text-3xl lg:text-4xl"></i>
            <span class="mt-1 font-semibold text-lg sm:text-xl lg:text-2xl">Total De Usuarios</span>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md text-center">
            <h3 id="ejecutando" class="font-extrabold text-4xl sm:text-5xl lg:text-6xl">{{ $totalDocentes }}</h3>
            <i class="fa-solid fa-chalkboard-teacher text-2xl sm:text-3xl lg:text-4xl"></i>
            <span class="mt-1 font-semibold text-lg sm:text-xl lg:text-2xl">Docentes</span>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-md text-center">
            <h3 id="ejecutados" class="font-extrabold text-4xl sm:text-5xl lg:text-6xl">{{ $totalEstudiantes }}</h3>
            <i class="fa-solid fa-user-graduate text-2xl sm:text-3xl lg:text-4xl"></i>
            <span class="mt-1 font-semibold text-lg sm:text-xl lg:text-2xl">Estudiantes</span>
        </div>
    </div>

    <div class="flex justify-center mt-8">
        <a href="{{ route('Usuario.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded shadow-md">Crear Usuario</a>
    </div>

    @if (session('success'))
        <div id="flash-message" class="my-4 bg-green-500 text-white p-4 rounded-md shadow-lg text-center text-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-8">
        <form action="{{ route('Usuario.buscar') }}" method="POST" class="w-full max-w-lg mx-auto">
            @csrf
            <input type="hidden" name="_method" value="GET">
            <div class="flex items-center border-b-2 border-teal-500 py-2">
                <div class="flex-grow mr-3">
                    <select name="rol" class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="{{ encrypt('') }}">Seleccionar</option>
                        <option value="{{ encrypt('Docente') }}">Docente</option>
                        <option value="{{ encrypt('Estudiante') }}">Estudiante</option>
                        @if (auth()->check())
                            @if (auth()->user()->hasRole('Master'))
                                <option value="{{ encrypt('Todos') }}">Todos</option>
                            @endif
                            @if (auth()->check() && !auth()->user()->hasRole('Master'))
                                <option value="{{ encrypt('TodosMenosMaster') }}">Todos</option>
                            @endif
                        @endif
                    </select>
                </div>
                <button type="submit" class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Buscar</button>
            </div>
        </form>
    </div>

    <div class="mt-8">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Usuario</th>
                    <th class="border px-4 py-2">Correo</th>
                    <th class="border px-4 py-2">Rol</th>
                    <th class="border px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 1;
                @endphp
                @foreach ($usuarios as $usuario)
                    @if (auth()->user()->hasRole('Master') || !$usuario->hasRole('Master'))
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $counter++ }}</td>
                            <td class="border px-4 py-2">{{ $usuario->name }}</td>
                            <td class="border px-4 py-2">{{ $usuario->email }}</td>
                            <td class="border px-4 py-2">
                                @if ($usuario->roles->isNotEmpty())
                                    @foreach ($usuario->roles as $rol)
                                        {{ $rol->name }}
                                    @endforeach
                                @else
                                    Por designar
                                @endif
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('Usuario.edit', $usuario->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-md">Editar</a>
                                <form action="{{ route('Usuario.destroy', $usuario->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded shadow-md">Eliminar</button>
                                </form>
                                <a href="{{ route('Usuario.show', $usuario->id) }}" class="inline-block">
                                    <i class="fas fa-user fa-2x"></i>
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('creados').textContent = "{{ $totalUsuarios }}";
        document.getElementById('ejecutando').textContent = "{{ $totalDocentes }}";
        document.getElementById('ejecutados').textContent = "{{ $totalEstudiantes }}";
    });
    setTimeout(function() {
        document.getElementById('flash-message').style.display = 'none';
    }, 3000);
</script>
@endsection
