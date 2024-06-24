@extends('Panza')
@section('Panza')

<div class="flex justify-center ">
    <div class="container">
        <div class="flex gap-4 flex-wrap md:flex-nowrap">
            <div class="border p-8 mt-8 w-full mb-auto">


                <h1 class="text-4xl font-semibold text-gray-500">{{$examen->tema}}</h1>
                <h2 class="text-gray-500">{{$examen->descripcion}}</h2>

            </div>

        </div>

        <div class="mt-4 border p-8 w-full">
            <h3 class="font-bold text-red-500">Examen finalizado</h3>

            <div class=" *:text-3xl *:font-bold mt-4 *:text-center">
                <h2 class="text-gray-400">Su nota final:</h2>
                <h4 class="text-gray-500">{{$calificacion->nota}} / 100</h4>
            </div>

            <div class="w-full flex justify-between *:px-4 *:py-2 mt-4 *:border *:border-blue-500 *:rounded *:font-bold">
                <a href="{{route('Examen.index')}}" class="text-blue-500"><i class="fa-solid fa-backward mr-2"></i>Volver a Curso</a>
                @if ($ejecucion->retroalimentacion)
                <a href="{{route('Examen.verIntento', $calificacion->id)}}" class="text-white bg-blue-500">Ver Examen</a>
                @endif
            </div>

        </div>
    </div>
</div>

@endsection