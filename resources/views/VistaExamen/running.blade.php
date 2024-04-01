@extends('Panza_min')
@section('Panza')
<div class="flex justify-center h-full items-center">
    <div class="container max-w-6xl">
        @php
            $x = 0;
        @endphp
        @foreach($preguntas_seleccionadas as $pregunta)

        <div id="container-{{$x}}" class="hidden">
            <div class="bg-gray-200 rounded-xl">
                <div class="bg-blue-600 shadow-lg rounded-xl p-6 text-white font-bold text-xl">
                    <h1 class="uppercase">{{$pregunta['descripcion']}}</h1>
                </div>

                <div class="p-6 pt-5">
                    <h2>{{$pregunta['comentario']}}</h2>
                </div>
            </div>

            <div class="rounded-xl p-6 bg-gray-200 mt-8 shadow-inner shadow-gray-400">
                @if($pregunta['tipo_pregunta_id'] == 1)
                    @foreach ($pregunta['respuestas'] as $respuesta)
                    <div class="">
                        <input name="{{$preguntas_seleccionadas[0]}}" type="radio" datax="{{$respuesta->id}}"></input>
                        <label for="">{{$respuesta->descripcion}}</label>
                    </div>
                    @endforeach
                @endif
            </div>

            <div class="w-full flex justify-end mt-12">
                <button class="bg-blue-600 text-white p-4 font-bold rounded-xl" id="next-{{$x}}" datax="{{$pregunta['id']}}">Siguiente</button>
            </div>
        </div>
        @php
            $x++;
        @endphp
        @endforeach
    </div>
</div>

<input type="hidden" value="{{ csrf_token() }}" id="csrfToken">
<input type="hidden" value="{{ $ejecucion->id }}" id="ejecucion_id">

<script src="{{asset('js/examen_run.js')}}"></script>
@endsection