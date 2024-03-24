@extends('Panza')
@section('Panza')
<h1 class="text-gray-800 font-semibold uppercase text-xl border-b pb-1 ">Crear Examen</h1>

<div class="grid md:grid-cols-2 md:gap-x-2 mt-4 h-5/6">

    <div class="p-2 md:border-r pr-4 ">
        <div class="w-full ">
            <label for="tema" class="text-sm font-semibold block text-gray-700">Tema</label>
            <input type="text" name="tema" id="tema" class="border-x-transparent border-t-transparent border-b focus:outline-none focus:border-transparent w-full ">
        </div>

        <div class="mt-4">
            <label for="descripcion" class="text-sm font-semibold block text-gray-700">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" class="w-full h-[150px] rounded">
        </div>

        <div class="mt-6 overflow-hidden">
            <button id="ejecucion" class="font-semibold"><i id="arrow" class="fa-solid fa-caret-down"></i> Configurar ejecucion</button>

            <div class="grid md:grid-cols-2 gap-x-4 animate-fade-down animate-duration-[400ms] animate-ease-out hidden" id="contenedor">

                <div class="mt-4">
                    <label for="fecha_inicio" class="text-sm font-semibold block text-gray-700 translate-x-2">Fecha inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="rounded-xl w-full">
                </div>

                <div class="mt-4">
                    <label for="fecha_final" class="text-sm font-semibold block text-gray-700 translate-x-2">Fecha final</label>
                    <input type="date" name="fecha_final" id="fecha_final" class="rounded-xl w-full">
                </div>

                <div class="mt-4">
                    <label for="hora_inicio" class="text-sm font-semibold block text-gray-700 translate-x-2">Hora inicio</label>
                    <input type="time" name="hora_inicio" id="hora_inicio" class="rounded-xl w-full">
                </div>

                <div class="mt-4">
                    <label for="hora_final" class="text-sm font-semibold block text-gray-700 translate-x-2">Hora final</label>
                    <input type="time" name="hora_final" id="hora_final" class="rounded-xl w-full">
                </div>

                <div class="mt-4">
                    <label for="ponderacion" class="text-sm font-semibold block text-gray-700 translate-x-2">Ponderacion</label>
                    <input type="number" name="ponderacion" id="ponderacion" class="rounded-xl w-full" min="0" max="100">
                </div>
                <div>
                </div>
                <div class="mt-4">
                    <label for="contrasena" class="text-sm font-semibold block text-gray-700 translate-x-2">Contraseña</label>
                    <input type="text" name="contrasena" id="contrasena" class="rounded-xl w-full">
                </div>
                <div class="flex mt-4">
                    <button id="randomPassword" class="mt-auto justify-start"><i class="fa-solid fa-dice text-2xl mb-2 text-blue-600 hover:text-blue-500"></i></button>
                </div>
            </div>
        </div>
    </div>


    <div class="p-2">
        <span class="font-semibold text-sm text-gray-700">Preguntas</span>

        <div class="mt-4" id="contenedorPreguntas">

        </div>

        <div class="text-center mt-4">
            <button class="px-4 py-2 text-white bg-blue-600 rounded-xl shadow-md shadow-gray-300 hover:bg-blue-500" id=""><i class="fa-solid fa-circle-plus "></i> Agregar pregunta</button>
        </div>
    </div>

</div>

<div id="renovarModal" class="fixed z-50 inset-0  overflow-auto ">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 bg-opacity-75"></div>
    <div class="modal-container mx-auto mt-8 rounded-lg overflow-hidden shadow-lg animate-fadea-down animate-duration-300 bg-white max-w-4xl">
        <div class="modal-content text-left relative">

            <div class="bg-blue-600 px-4 py-2 flex justify-between">
                <h2 class="text-white font-bold uppercase text-2xl">Crear pregunta</h2>
                <button class="text-white text-xl hover:text-red-500" id="closeModalPregunta"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="p-4 bg-white">
                <div class="grid md:grid-cols-2">
                    <div class="border-r pr-4">

                        <div class="w-full">
                            <label for="descripcion_pregunta" class="text-sm font-semibold block text-gray-700">Descripcion</label>
                            <input type="text" name="descripcion_pregunta" id="descripcion_pregunta" class="border-x-transparent border-t-transparent border-b focus:outline-none focus:border-transparent w-full h-8">
                        </div>

                        <div class="mt-4">
                            <label for="comentario_pregunta" class="text-sm font-semibold block text-gray-700">Comentario</label>
                            <input type="text" name="comentario_pregunta" id="comentario_pregunta" class="border-x-transparent border-t-transparent border-b focus:outline-none focus:border-transparent w-full h-8">
                        </div>

                        <div class="mt-4">
                            <label for="ponderacion_pregunta" class="text-sm font-semibold block text-gray-700">Ponderacion</label>
                            <input type="number" name="ponderacion_pregunta" id="ponderacion_pregunta" class="border-x-transparent border-t-transparent border-b focus:outline-none focus:border-transparent w-full h-8" max="100" min="0">
                        </div>

                        <span class="font-semibold text-sm text-gray-700 mt-4 block">Tipo pregunta</span>

                        <div class=" flex gap-x-4 text-sm  text-gray-700 justify-center flex-wrap">
                            <div class="text-center">
                                <span class="block">V/F</span>
                                <input type="radio" name="tipo_pregunta" id="vf" value="1">
                            </div>

                            <div class="text-center">
                                <span class="block">Multiple</span>
                                <input type="radio" name="tipo_pregunta" id="multiple" value="2">
                            </div>

                            <div class="text-center">
                                <span class="block">Abierta</span>
                                <input type="radio" name="tipo_pregunta" id="abierta" value="3">
                            </div>
                        </div>

                    </div>

                    <div class="">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        const contenedor = document.getElementById('contenedor');
        const ejecucion = document.getElementById('ejecucion');

        ejecucion.addEventListener('click', () => {
            contenedor.classList.toggle('hidden');
        });

        const randomPassword = document.getElementById('randomPassword');
        const contrasena = document.getElementById('contrasena');
        randomPassword.addEventListener('click', () => {
            let password = '';
            for (let i = 0; i < 5; i++) {
                password += Math.floor(Math.random() * 10);
            }
            contrasena.value = password;
        });


        const ponderacion = document.getElementById('ponderacion');
        ponderacion.addEventListener('input', (event) => {
            if (event.target.value > 100) {
                event.target.value = 100;
            }
        });


        const vfRadio = document.getElementById('vf');
        const multipleRadio = document.getElementById('multiple');
        const abiertaRadio = document.getElementById('abierta');

        vfRadio.addEventListener('change', function() {
            // Instrucciones para el caso de V/F
            console.log('Seleccionaste V/F');
        });

        multipleRadio.addEventListener('change', function() {
            // Instrucciones para el caso de Multiple
            console.log('Seleccionaste Multiple');
        });

        abiertaRadio.addEventListener('change', function() {
            // Instrucciones para el caso de Abierta
            console.log('Seleccionaste Abierta');
        });

    });
</script>

@endsection