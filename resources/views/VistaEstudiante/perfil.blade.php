<x-navbar />

<main class="w-full max-w-4xl mx-auto px-4 py-8 md:px-6 md:py-12">
    <div class="bg-white shadow-lg rounded-lg p-8 flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
        <div class="flex-shrink-0">
            <img src="{{ $usuario->profile_photo_url }}" alt="Foto de Perfil" class="w-32 h-32 rounded-full object-cover shadow-md">
        </div>
        <div class="flex-grow">
            <h2 class="text-3xl font-bold mb-6 text-center md:text-left">Perfil del Estudiante</h2>
            <div class="space-y-6">
                <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                    <label class="block text-gray-700 font-semibold w-48">Nombre Completo</label>
                    <p class="text-gray-900 flex-grow">
                        @if($usuario->nombre) {{ $usuario->nombre }} @endif
                        @if($usuario->apellido_paterno) {{ $usuario->apellido_paterno }} @endif
                        @if($usuario->apellido_materno) {{ $usuario->apellido_materno }} @endif
                        @unless($usuario->nombre || $usuario->apellido_paterno || $usuario->apellido_materno)
                            {{ $usuario->name }}
                        @endunless
                    </p>
                </div>
                @if($usuario->email)
                <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                    <label class="block text-gray-700 font-semibold w-48">Correo Electrónico</label>
                    <p class="text-gray-900 flex-grow">{{ $usuario->email }}</p>
                </div>
                @endif

                @if($usuario->carnet_identidad)
                <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                    <label class="block text-gray-700 font-semibold w-48">Carnet de Identidad</label>
                    <p class="text-gray-900 flex-grow">{{ $usuario->carnet_identidad }}</p>
                </div>
                @endif

                @if($usuario->telefono)
                <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                    <label class="block text-gray-700 font-semibold w-48">Teléfono</label>
                    <p class="text-gray-900 flex-grow">{{ $usuario->telefono }}</p>
                </div>
                @endif

                @if($usuario->fecha_nacimiento)
                <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                    <label class="block text-gray-700 font-semibold w-48">Fecha de Nacimiento</label>
                    <p class="text-gray-900 flex-grow">{{ $usuario->fecha_nacimiento }}</p>
                </div>
                @endif
            </div>
            <div class="mt-8 text-center md:text-left">
                <a href="{{ route('Estudiante.editar', ['id' => $usuario->id]) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700 transition duration-300">Editar Perfil</a>
            </div>
        </div>
    </div>
</main>

@include('components.footer')
