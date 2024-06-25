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

        <div class="mt-4 flex gap-x-2 text-sm">
            <div class="rounded-3xl p-2 bg-gray-200">
                <span class=""><strong>Desde:</strong> {{$ejecucion->hora_inicio}}</span>
            </div>
            <div class="rounded-3xl p-2 bg-gray-200">
                <span class=""><strong>Hasta:</strong> {{$ejecucion->hora_final}}</span>
            </div>
        </div>
        <div class="mt-4 bg-gray-200 text-sm">
            <div class="bg-gray-100 p-4">
                <p class="text-sm">{{$examen->descripcion}}</p>
            </div>
            <div class="shadow-inner shadow-gray-300">
                <div class="border-b border-gray-300 p-4">
                    <span><strong>Fecha:</strong> {{$ejecucion->fecha}}</span>
                </div>
                @php
                switch($ejecucion->estado_ejecucion_id){
                case 1:
                $text_content = 'En proceso';
                $color = 'text-yellow-500 font-bold';
                break;
                case 2:
                $text_content = 'Terminado';
                $color = 'text-red-500 font-bold';
                break;
                case 3:
                $text_content = 'Pendiente';
                $color = '';
                break;
                }
                @endphp

                <div class="border-b border-gray-300 p-4">
                    <strong>Estado del examen: </strong><span class="{{$color}} ">{{$text_content}}</span>
                </div>

                <div class="border-b border-gray-300 p-4">
                    <strong>Estado de la entrega: </strong><span class="{{!$calificacion || !$calificacion->finalizado  ? 'text-red-500' : 'text-green-500'}}">{{!$calificacion || !$calificacion->finalizado ?'No entregada':'Entregada'}}</span>
                </div>

                <div class="border-b border-gray-300 p-4">
                    <strong>Tiempo restante: </strong><span class="">{{$restante}}</span>
                </div>

                @if($calificacion && $calificacion->finalizado == '1')
                <div class="border-b border-gray-300 p-4">
                    <strong>Nota: </strong><span class="">{{$calificacion->nota }} / 100 pts.</span>
                </div>
                @endif

            </div>
        </div>

        <div class="mt-8">
            <button id="comenzar_btn" class="bg-blue-600 hover:bg-blue-500 text-white font-bold p-4 rounded-md "
            {{ $ejecucion->estado_ejecucion_id != 1 || ($calificacion && $calificacion->nota != 0) ? 'disabled' : '' }} >Realizar intento</button>
        </div>
    </div>

</div>


<div id="confirmar_intento_modal" class="fixed z-50 inset-0 hidden overflow-auto ">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 bg-opacity-75"></div>
    <div class="modal-container mx-auto mt-24 rounded-lg overflow-hidden shadow-lg
     animate-fade-down animate-duration-300 bg-white max-w-4xl">

        <div class="modal-content text-left relative">

            <div class="bg-blue-600 px-4 py-2 flex justify-between">
                <h2 class="text-white font-bold uppercase text-2xl">Confirmar intento</h2>
                <button class="text-white text-xl hover:text-red-500" id="close_intento_modal"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="p-4 bg-white">
                <h3 class="text-center">Estas seguro de comenzar el intento ahora?</h3>
                <div class="text-center mt-8 mb-4">
                    <a href="/examenes/running/{{$ejecucion->id}}" class="bg-blue-600 hover:bg-blue-500 text-white font-bold p-4 rounded-md ">Comenzar intento</a>

                </div>
            </div>


        </div>
    </div>
</div>


<script src="{{asset('js/examen_start.js')}}"></script>

@endsection