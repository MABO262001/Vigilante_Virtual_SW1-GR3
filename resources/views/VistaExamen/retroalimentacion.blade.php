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

        <div class="mt-4">
            @php 
            $x = 1;
            $nota_total = 0;
            @endphp
            @foreach ($preguntas_respuestas as $pregunta_respuesta)
                @php
                    
                    $puntua = 0;
                    if($pregunta_respuesta['pregunta']['tipo_pregunta_id'] != '3'){

                        foreach ($pregunta_respuesta['respuestas'] as $respuesta) {
                            if ($respuesta['respondida'] == '1' && $respuesta['es_correcta'] == '1') {
                                $puntua = $pregunta_respuesta['pregunta']['ponderacion'];
                                break; 
                            }
                        }

                    }else{
                        if($pregunta_respuesta['respuestas'][0]['puntaje']){
                            $puntua = $pregunta_respuesta['respuestas'][0]['puntaje'];
                        }else{
                            $puntua = 'n/a';
                        }
                    }
                    $nota_total += $puntua;
                @endphp
                <div class="border p-8 mb-4">
                    <div class="flex flex-wrap md:flex-nowrap gap-8">
                        <div class="rounded p-4 bg-blue-500 w-full md:w-auto">
                            <h3 class="text-white font-bold text-xl">Pregunta {{$x}}</h3>
                            <span class="mt-2 text-white block">Puntúa como: {{$puntua != 'n/a' ? $puntua : '0'}}/{{$pregunta_respuesta['pregunta']['ponderacion']}} pts.</span>
                            <span class="font-bold text-white">{{$puntua == 'n/a' ? 'No revisado' : ''}}</span>
                        </div>
                        <div class="w-full">
                            <div class="bg-gray-200 rounded-xl">
                                <div class="bg-blue-600 shadow-lg rounded-xl p-6 text-white font-bold text-xl">
                                    <h1 class="uppercase">{{$pregunta_respuesta['pregunta']['descripcion']}}</h1>
                                    <h2 class="font-medium text-sm">{{$pregunta_respuesta['pregunta']['comentario']}}</h2>
                                </div>
                                <div class="p-6 pt-5">
                                    @if ($pregunta_respuesta['pregunta']['tipo_pregunta_id'] != '3')
                                        @foreach ($pregunta_respuesta['respuestas'] as $respuesta)
                                            <h4>{{$respuesta['descripcion']}} 
                                                @if ($respuesta['es_correcta'] == '1')
                                                    <i class="fa-solid fa-check text-green-500"></i>
                                                @endif
                                                @if ($respuesta['es_correcta'] == '0' && $respuesta['respondida'] == '1')
                                                <i class="fa-solid fa-x text-red-500"></i>
                                                @endif
                                            </h4>
                                        @endforeach
                                    @else 
                                        <textarea name="" id="" disabled class="w-full h-auto text-gray-500">{{$pregunta_respuesta['respuestas'][0]['contenido']}}
                                        </textarea>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php $x++; @endphp
            @endforeach

            <div class="wfull border p-8">
                <h4 class="text-2xl font-bold">Nota final: {{$nota_total}} pts.</h4>
            </div>
        </div>
    </div>
</div>
@endsection
