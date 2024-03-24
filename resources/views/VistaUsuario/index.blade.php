@extends('Panza')
@section('Panza')
    <h1 class="font-extrabold text-blue-900 text-3xl mt-2 uppercase">Administracion De Usuarios</h1>

    <div class="rounded-xl bg-gray-200 p-4 mt-4 grid md:grid-cols-3 mg:gap-x-2 shadow-md shadow-gray-400 text-gray-700">
        <div class="md:border-r-2 border-gray-700 p-2 text-center">
            <h3 id="creados" class="font-extrabold text-6xl">{{ $totalUsuarios }}</h3>
            <i class="fa-solid fa-user text-3xl"></i>
            <span class="mt-1 font-semibold text-2xl">Total De Usuarios</span>
        </div>
        <div class="md:border-r-2 border-gray-700 p-2 text-center">
            <h3 id="ejecutando" class="font-extrabold text-6xl">{{ $totalDocentes }}</h3>
            <i class="fa-solid fa-chalkboard-teacher text-3xl"></i>
            <span class="mt-1 ml-1 font-semibold text-2xl">Docentes</span>
        </div>
        <div class=" p-2 text-center">
            <h3 id="ejecutados" class="font-extrabold text-6xl">{{ $totalEstudiantes }}</h3>
            <i class="fa-solid fa-user-graduate text-3xl"></i>
            <span class="mt-1 ml-1 font-semibold text-2xl">Estudiantes</span>
        </div>
    </div>


    <div class="flex justify-center">
        <div class="container">
            <div class="w-full flex mt-8">
                <a href="{{ route('Usuario.create') }}"
                    class="ml-auto rounded-xl bg-blue-500 text-white p-3 font-bold shadow-md shadow-gray-400">Crear
                    Usuario</a>
            </div>
            <div class="flex justify-center mt-8">
                <form action="{{ route('usuarios.buscar') }}" method="GET" class="w-full max-w-lg mx-auto mt-4">
                    <div class="flex items-center border-b-2 border-teal-500 py-2">
                        <div class="relative flex-grow mr-3">
                            <select name="rol"
                                class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">Seleccionar</option>
                                <option value="Docente">Docente</option>
                                <option value="Estudiante">Estudiante</option>
                                @if (auth()->check())
                                    @if (auth()->user()->hasRole('Master'))
                                        <option value="Todos">Todos</option>
                                    @endif
                                    @if (auth()->check() && !auth()->user()->hasRole('Master'))
                                        <option value="TodosMenosMaster">Todos</option>
                                    @endif
                                @endif
                            </select>
                        </div>
                        <button type="submit"
                            class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline">Buscar</button>
                    </div>
                </form>
            </div>


            <div class="w-full mt-8">
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
                                        <a href="{{ route('Usuario.edit', $usuario->id) }}"
                                            class="rounded-xl bg-blue-500 text-white p-2 font-bold shadow-md shadow-gray-400">Editar</a>
                                        <form action="{{ route('Usuario.destroy', $usuario->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-xl bg-red-500 text-white p-2 font-bold shadow-md shadow-gray-400">Eliminar</button>
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
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('creados').textContent = "{{ $totalUsuarios }}";
            document.getElementById('ejecutando').textContent = "{{ $totalDocentes }}";
            document.getElementById('ejecutados').textContent = "{{ $totalEstudiantes }}";
        });
    </script>
@endsection
