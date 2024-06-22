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
            @if (auth()->user()->hasRole('Administrativo Premium') || auth()->user()->hasRole('Administrativo'))
                <div class="bg-white p-4 rounded-xl shadow-md text-center">
                    <h3 id="ejecutados" class="font-extrabold text-4xl sm:text-5xl lg:text-6xl">{{ $usuarios_creables }}
                    </h3>
                    <i class="fa-solid fa-user-graduate text-2xl sm:text-3xl lg:text-4xl"></i>
                    <span class="mt-1 font-semibold text-lg sm:text-xl lg:text-2xl">Usuario Creables</span>
                </div>
            @endif
        </div>

        <div class="flex justify-center mt-8">
            <a href="{{ route('Usuario.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded shadow-md">Crear Usuario</a>
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
                        <select name="rol"
                            class="w-full bg-white border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
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
                    <button type="submit"
                        class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Buscar</button>
                </div>
            </form>
        </div>


        <div class="mt-8 overflow-x-auto">
            <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-500 to-teal-500 text-white uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">Usuario</th>
                        <th class="py-3 px-6 text-left">Nombre del Usuario</th>
                        <th class="py-3 px-6 text-center">Rol</th>
                        <th class="py-3 px-6 text-center">Usuarios Creables</th>
                        <th class="py-3 px-6 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                    @foreach ($usuarios as $usuario)
                        @if (auth()->user()->hasRole('Master') || !$usuario->hasRole('Master'))
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-200 ease-in-out">
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <div class="mr-4">
                                            <img class="w-12 h-12 rounded-full border-2 border-blue-500 shadow-lg"
                                                src="{{ asset('images/user/' . basename($usuario->profile_photo_path)) }}"
                                                alt="Profile Photo">
                                        </div>
                                        <div>
                                            <span class="font-semibold text-lg">{{ $usuario->name }}</span>
                                            <p class="text-gray-500 text-xs">{{ $usuario->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <span class="font-medium">{{ $usuario->nombre }} {{ $usuario->apellido_paterno }}
                                        {{ $usuario->apellido_materno }}</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        @if ($usuario->roles->isNotEmpty())
                                            @foreach ($usuario->roles as $rol)
                                                <span
                                                    class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs mr-2">{{ $rol->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="bg-yellow-200 text-yellow-700 py-1 px-3 rounded-full text-xs">Por
                                                designar</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span
                                        class="bg-blue-100 text-blue-700 py-1 px-3 rounded-full text-xs">{{ $usuario->usuarios_creables }}</span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <a href="{{ route('Usuario.edit', $usuario->id) }}"
                                            class="w-4 mr-2 transform hover:text-purple-500 hover:scale-125 transition duration-200 ease-in-out">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('Usuario.destroy', $usuario->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-4 mr-2 transform hover:text-red-500 hover:scale-125 transition duration-200 ease-in-out">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('Usuario.show', $usuario->id) }}"
                                            class="w-4 mr-2 transform hover:text-green-500 hover:scale-125 transition duration-200 ease-in-out">
                                            <i class="fas fa-user"></i>
                                        </a>
                                    </div>
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
