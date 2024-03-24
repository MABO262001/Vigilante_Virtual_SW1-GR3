@extends('Panza')
@section('Panza')


<h1 class="text-gray-800 font-semibold uppercase text-xl border-b pb-1 ">Crear Examen</h1>

<div class="grid md:grid-cols-2 md:gap-x-2 mt-4 h-5/6">

    <div class="p-2 md:border-r pr-4 ">
        <div class="w-full ">
            <label for="tema" class="text-sm font-semibold block text-gray-700">Tema</label>
            <input type="text" name="tema" id="tema" class="border-x-transparent border-t-transparent 
            border-b focus:outline-none focus:border-transparent w-full ">
        </div>

        <div class="mt-4">
            <label for="descripcion" class="text-sm font-semibold block text-gray-700">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" class="w-full h-[150px] rounded">
        </div>

        <div class="mt-6 overflow-hidden">
            <button id="ejecucion" class="font-semibold"><i id="arrow" class="fa-solid fa-caret-down"></i> Configurar ejecucion</button>

            <div class="grid md:grid-cols-2 gap-x-4 animate-fade-down 
            animate-duration-[400ms] animate-ease-out hidden" id="contenedor">

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
                    <button id="randomPassword" class="mt-auto justify-start">
                        <i class="fa-solid fa-dice text-2xl mb-2 text-blue-600 hover:text-blue-500"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="p-2">
        <span class="font-semibold text-sm text-gray-700">Preguntas</span>

        <div class="mt-4" id="contenedorPreguntas">

        </div>

        <div class="text-center mt-4">
            <button class="px-4 py-2 text-white bg-blue-600 rounded-xl shadow-md shadow-gray-300 hover:bg-blue-500" id="btn_agregar_pregunta">
                <i class="fa-solid fa-circle-plus "></i> Agregar pregunta
            </button>
        </div>
    </div>

</div>

<div id="crear_pregunta_modal" class="fixed z-50 inset-0 hidden overflow-auto ">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 bg-opacity-75"></div>
    <div class="modal-container mx-auto mt-8 rounded-lg overflow-hidden shadow-lg
     animate-fade-down animate-duration-300 bg-white max-w-4xl">

        <div class="modal-content text-left relative">

            <div class="bg-blue-600 px-4 py-2 flex justify-between">
                <h2 class="text-white font-bold uppercase text-2xl">Crear pregunta</h2>
                <button class="text-white text-xl hover:text-red-500" id="close_pregunta_modal"><i class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="p-4 bg-white">
                <div class="grid md:grid-cols-2">
                    <div class="md:border-r md:pr-4">

                        <div class="w-full">
                            <label for="descripcion_pregunta" class="text-sm font-semibold block text-gray-700">Descripcion</label>
                            <input type="text" name="descripcion_pregunta" id="descripcion_pregunta" class="border-x-transparent border-t-transparent 
                            border-b focus:outline-none focus:border-transparent w-full h-8">
                        </div>

                        <div class="mt-4">
                            <label for="comentario_pregunta" class="text-sm font-semibold block text-gray-700">Comentario</label>
                            <input type="text" name="comentario_pregunta" id="comentario_pregunta" class="border-x-transparent border-t-transparent
                            border-b focus:outline-none focus:border-transparent w-full h-8">
                        </div>

                        <div class="mt-4">
                            <label for="ponderacion_pregunta" class="text-sm font-semibold block text-gray-700">Ponderacion</label>
                            <input type="number" name="ponderacion_pregunta" id="ponderacion_pregunta" class="border-x-transparent border-t-transparent
                             border-b focus:outline-none focus:border-transparent w-full h-8" max="100" min="0">
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

                    <div class="md:pl-4">

                        <div id="no_option_container">
                            <h2 class="text-sm font-semibold block text-gray-700">Selecciona una opcion de pregunta!</h2>
                        </div>

                        <div id="abierta_container" class="hidden">
                            <h2 class="text-sm font-semibold block text-gray-700">Respuesta abierta seleccionada!</h2>
                        </div>

                        <div class="text-center hidden" id="vf_container">
                            <h2 class="text-sm font-semibold block text-gray-700">Respuesta</h2>

                            <div class=" flex gap-x-4 text-sm  text-gray-700 justify-center flex-wrap mt-4">
                                <div class="text-center">
                                    <span class="block">Verdadero</span>
                                    <input type="radio" name="respuesta_vf" id="v">
                                </div>

                                <div class="text-center">
                                    <span class="block">Falso</span>
                                    <input type="radio" name="respuesta_vf" id="f">
                                </div>
                            </div>
                        </div>
                        <div class="text-center hidden" id="multiple_container">
                            <h2 class="text-sm font-semibold block text-gray-700 ">Respuesta</h2>
                            <span class="text-sm mb-4 block">(Seleccione las opciones correctas)</span>
                            <div class="mb-4" id="contenedor_opciones">

                            </div>
                            <button id="agregar_opcion" class="text-sm px-2 py-1 hover:bg-blue-500 
                            shadow-md shadow-gray-300 bg-blue-600 text-white rounded-xl">Agregar opcion</button>

                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <img src="{{asset('images/loading.gif')}}" id="loading_gif" class="h-10 hidden" alt="">

                    <button class="bg-blue-600 hover:bg-blue-500 py-2 px-4 
                    font-bold rounded-xl text-md text-white" id="add">
                        Agregar
                    </button>
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

        const crear_pregunta_modal = document.getElementById('crear_pregunta_modal');
        const btn_agregar_pregunta = document.getElementById('btn_agregar_pregunta');
        const close_pregunta_modal = document.getElementById('close_pregunta_modal');

        btn_agregar_pregunta.addEventListener('click', () => {
            crear_pregunta_modal.classList.remove('hidden');
        });

        close_pregunta_modal.addEventListener('click', () => {
            crear_pregunta_modal.classList.add('hidden');
        });

        const vfRadio = document.getElementById('vf');
        const multipleRadio = document.getElementById('multiple');
        const abiertaRadio = document.getElementById('abierta');

        const vf_container = document.getElementById('vf_container');
        const no_option_container = document.getElementById('no_option_container');
        const multiple_container = document.getElementById('multiple_container');
        const abierta_container = document.getElementById('abierta_container');

        var flag = 'n';


        vfRadio.addEventListener('change', function() {
            vf_container.classList.remove('hidden');
            no_option_container.classList.add('hidden');
            multiple_container.classList.add('hidden');
            abierta_container.classList.add('hidden');
            flag = 'vf';

        });

        multipleRadio.addEventListener('change', function() {
            vf_container.classList.add('hidden');
            no_option_container.classList.add('hidden');
            multiple_container.classList.remove('hidden');
            abierta_container.classList.add('hidden');
            flag = 'ml';

        });

        abiertaRadio.addEventListener('change', function() {
            vf_container.classList.add('hidden');
            no_option_container.classList.add('hidden');
            multiple_container.classList.add('hidden');
            abierta_container.classList.remove('hidden');
            flag = 'a';
        });

        const agregar_opcion = document.getElementById('agregar_opcion');
        const contenedor_opciones = document.getElementById('contenedor_opciones');
        var contador_opciones = 0;

        agregar_opcion.addEventListener('click', () => {

            contador_opciones++;
            var div = document.createElement('div');
            div.classList.add('flex', 'flex-wrap', 'gap-x-2', 'p-2',
                'justify-center', 'items-center', 'bg-blue-100', 'rounded-xl',
                'mb-2');
            div.id = "opcion" + contador_opciones;

            var check = document.createElement('input');
            check.type = 'checkbox';
            check.id = 'check' + contador_opciones;
            check.classList.add('bg-blue-100', 'border-2', 'rounded-full',
                'mr-2');

            var text = document.createElement('input');
            text.type = 'text';
            text.classList.add('border-x-transparent', 'border-t-transparent',
                'border-b-2', 'focus:outline-none', 'focus:border-transparent', 'h-8',
                'bg-blue-100', 'border-gray-400');

            text.id = 'text' + contador_opciones;

            var button = document.createElement('button');
            button.className = 'text-gray-300 hover:text-red-500 ml-2 text-xl';
            button.innerHTML = '<i class="fa-solid fa-trash"></i>';

            button.onclick = function() {
                borrarOpcion(div.id);
            };


            div.appendChild(check);
            div.appendChild(text);
            div.appendChild(button);

            contenedor_opciones.appendChild(div);
        });


        function deleteOption(id) {
            const div = document.getElementById(id);
            contenedor_opciones.removeChild(div)
        }

        var preguntas = [];

        const add = document.getElementById('add');
        const loading_gif = document.getElementById('loading_gif');

        const descripcion_pregunta = document.getElementById('descripcion_pregunta');
        const comentario_pregunta = document.getElementById('comentario_pregunta');
        const ponderacion_pregunta = document.getElementById('ponderacion_pregunta');

        var contador_preguntas = 0;

        add.addEventListener('click', () => {
            loading_gif.classList.remove('hidden');

            add.setAttribute('disabled', true);
            add.classList.remove('bg-blue-600', 'text-white');
            add.classList.add('bg-blue-700', 'text-gray-300');

            var respuestas = [];
            var tp = 0;
            switch (flag) {
                case 'vf':

                    var respuesta = {
                        'contenido': 'verdadero',
                        'es_correcta': document.getElementById('v').checked,
                    };
                    respuestas.push(respuesta);
                    respuesta = {
                        'contenido': 'falso',
                        'es_correcta': document.getElementById('f').checked,
                    };
                    respuestas.push(respuesta);
                    tp = 1;

                    break;
                case 'ml':
                    var opciones = contenedor_opciones.querySelectorAll('div');
                    opciones.forEach(function(opcion) {

                        respuesta = {
                            'contenido': opcion.querySelector('input[type="text"]').value,
                            'es_correcta': opcion.querySelector('input[type="checkbox"]').checked
                        }
                        respuestas.push(respuesta);
                    });
                    tp = 2;

                    break;
                case 'a':
                    tp = 3;

                    break;
            }

            contador_preguntas++;

            var pregunta = {
                'id': contador_preguntas,
                'descripcion_pregunta': descripcion_pregunta.value,
                'comentario_pregunta': comentario_pregunta.value,
                'ponderacion_pregunta': ponderacion_pregunta.value,
                'tipo_pregunta': tp,
                'respuestas': respuestas
            }

            preguntas.push(pregunta);

            descripcion_pregunta.value = '';
            comentario_pregunta.value = '';
            ponderacion_pregunta.value = '';

            contenedor_opciones.innerHTML = '';

            setTimeout(() => {

                add.setAttribute('disabled', false);
                add.classList.add('bg-blue-600', 'text-white');
                add.classList.remove('bg-blue-700', 'text-gray-300');

                crear_pregunta_modal.classList.add('hidden');
            }, 300);


            actualizarContenedorPreguntas();
        });

        function actualizarContenedorPreguntas() {
            preguntas.forEach(function(pregunta) {

                var div = document.createElement('div');
                div.id = pregunta['id'];
                div.classList.add('p-4', 'bg-blue-600', 'rounded-xl', 'w-full', 'flex', 'justify-between');

                var qc_container = document.createElement('div');

                var q = document.createElement('h3');
                q.classList.add('text-white', 'font-bold', 'text-xl');
                q.textContent = pregunta['descripcion_pregunta'];

                var c = document.createElement('h4');
                c.classList.add('text-white', 'font-semibold', 'text-lg');
                var comentario = pregunta['comentario_pregunta'];
                if (comentario.length > 40) {
                    comentario = comentario.substring(0, 40) + '...';
                }
                c.textContent = comentario;
                
            });
        }
    });
</script>

@endsection