@extends('Panza')

@section('Panza')
<main class="w-full max-w-md mx-auto px-4 py-8 md:px-6 md:py-12">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Datos del Estudiante</h2>
        <div class="space-y-4">
            @if($usuario->nombre || $usuario->apellido_paterno || $usuario->apellido_materno)
                <div>
                    <label class="block text-gray-700">Nombre Completo</label>
                    <p class="text-gray-900">
                        @if($usuario->nombre) {{ $usuario->nombre }} @endif
                        @if($usuario->apellido_paterno) {{ $usuario->apellido_paterno }} @endif
                        @if($usuario->apellido_materno) {{ $usuario->apellido_materno }} @endif
                    </p>
                </div>
            @else
            <div>
                <label class="block text-gray-700">Nombre</label>
                <p class="text-gray-900">
                    {{$usuario->name}}
                </p>
            </div>
            @endif
            @if($usuario->email)
                <div>
                    <label class="block text-gray-700">Correo Electrónico</label>
                    <p class="text-gray-900">{{ $usuario->email }}</p>
                </div>
            @endif

            @if($usuario->carnet_identidad)
                <div>
                    <label class="block text-gray-700">Carnet de Identidad</label>
                    <p class="text-gray-900">{{ $usuario->carnet_identidad }}</p>
                </div>
            @endif

            @if($usuario->telefono)
                <div>
                    <label class="block text-gray-700">Teléfono</label>
                    <p class="text-gray-900">{{ $usuario->telefono }}</p>
                </div>
            @endif

            @if($usuario->fecha_nacimiento)
                <div>
                    <label class="block text-gray-700">Fecha de Nacimiento</label>
                    <p class="text-gray-900">{{ $usuario->fecha_nacimiento }}</p>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
