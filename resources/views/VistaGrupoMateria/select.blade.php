@extends('Panza')
@section('Panza')

<h1 class="font-bold text-2xl border-b pb-2 text-gray-700/90">Seleccionar Grupo</h1>

<div class="flex justify-center">
    <div class="container max-w-6xl">
        <div class="border p-8 mt-8">
            @php
                $x = 1;
            @endphp
            @foreach ($grupo_materias as $grupo_materia)
                <a href="{{route('GrupoMateria.prueba', $grupo_materia->id)}}" class="w-full block {{$x % 2 != 0 ? 'bg-gray-100': ''}}
                py-2 px-1 hover:bg-gray-200 transform duration-100">
                    {{$grupo_materia->materia}} {{$grupo_materia->grupo}}
                </a>
                @php
                    $x++;
                @endphp
            @endforeach
        </div>
    </div>

</div>

@endsection