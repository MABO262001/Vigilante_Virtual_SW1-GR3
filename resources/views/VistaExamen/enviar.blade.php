@extends('Panza_min')
@section('Panza')

<style>
    .disabled-link {
        pointer-events: none;
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>
<div class="flex justify-center h-full items-center">
    <div class="container max-w-5xl   ">


        <div class="flex gap-x-2 ">
            <div class="bg-blue-600 rounded-lg px-3 py-2 text-4xl font-extrabold text-white">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <div class=" text-blue-600">
                <span class="text-md">Examen</span>
                <h1 class="text-xl font-bold uppercase">{{$examen->tema}}</h1>
            </div>
        </div>

        <div class="mt-8 w-full ">
            @for ($i = 0; $i < count($preguntas_seleccionadas); $i++)
                <div class="p-2 grid grid-cols-2 {{$i % 2 == 0? 'bg-gray-200' : 'bg-gray-100'}} border border-gray-300">
                    <div class="flex justify-center items-center ">
                        <span class="text-blue-500">{{$i + 1}}</span>
                    </div>

                    <div class="flex justify-center items-center">
                        <span>{{$preguntas_seleccionadas[$i]->hecha == 1? 'Respuesta guardada' : 'Sin respuesta'}}</span>
                    </div>
                </div>
            @endfor
        </div>

        <div class="mt-8 text-center">
            <button 
            class="bg-gradient-to-t from-gray-200 to-gray-100 py-1 px-2
            rounded border-gray-300 border text-gray-700">
            Enviar todo y terminar <i class="fa-solid fa-check"></i></button>
        </div>

    </div>
</div>
@endsection