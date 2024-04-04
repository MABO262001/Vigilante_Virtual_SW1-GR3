@extends('Panza')
@section('Panza')
    <div class="min-h-screen flex flex-col bg-white text-gray-800">

        <header class="bg-blue-600 text-white p-4 shadow-lg">
            <h1 class="font-bold text-2xl">Detección de rostros</h1>
        </header>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div id="mensajeSuperposicion"
            class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 z-50 hidden animate-fadeIn">
            <div class="bg-red-600 text-white p-4 rounded shadow-lg">
                <p id="textoMensajeSuperposicion"></p>
            </div>
        </div>

        <div class="text-center mt-4">
            <div id="mensajeEmocion" class="inline-block bg-red-500 text-white p-2 rounded shadow-lg hidden"></div>
        </div>

        <main class="flex-1 p-4 flex flex-col items-center justify-center">
            <div class="relative mb-4">
                <video id="inputVideo" class="absolute z-10" style="transform: scaleX(-1);" autoplay muted
                    playsinline></video>
                <canvas id="overlay" class="relative z-20" style="transform: scaleX(-1);"></canvas>
            </div>
            <div class="flex gap-4">
                <button id="startButton"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg">Iniciar
                    cámara</button>
                <button id="stopButton"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-lg">Detener
                    cámara</button>
            </div>
        </main>

        <footer class="bg-gray-900 text-white p-4">
            <div id="results" class="mt-4 p-4 border rounded bg-gray-800"></div>
        </footer>
    </div>

    <script src="{{ asset('js/face-api.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

    <script>
        let camaraEncendida = false;

        const video = document.getElementById('inputVideo');
        const lienzo = document.getElementById('overlay');
        const botonIniciar = document.getElementById('startButton');
        const botonDetener = document.getElementById('stopButton');
        const resultadosDiv = document.getElementById('results');
        const mensajeEmocion = document.getElementById('mensajeEmocion');
        const mensajeSuperposicion = document.getElementById('mensajeSuperposicion');
        const textoMensajeSuperposicion = document.getElementById('textoMensajeSuperposicion');
        const tipoAnomalias = {!! json_encode($tipoAnomalias) !!};
        const nombreUsuario = {!! json_encode($nombreUsuario) !!};

        const traduccionesEmociones = {
            'neutral': 'neutral',
            'happy': 'feliz',
            'sad': 'triste',
            'angry': 'enojado',
            'fearful': 'temeroso',
            'disgusted': 'disgustado',
            'surprised': 'sorprendido'
        };

        botonIniciar.addEventListener('click', () => {
            navigator.mediaDevices.getUserMedia({
                    video: {}
                })
                .then(transmision => {
                    video.srcObject = transmision;
                    mensajeEmocion.classList.remove('hidden');
                    camaraEncendida = true;
                })
                .then(() => enReproduccion());
        });

        botonDetener.addEventListener('click', () => {
            video.srcObject.getTracks().forEach(pista => pista.stop());
            mensajeEmocion.classList.add('hidden');
            mensajeSuperposicion.classList.add('hidden');
            camaraEncendida = false;
        });

        async function guardarAnomalia(tipoAnomalia) {
            const fotogramaCapturado = lienzo.toDataURL('image/png');

            const response = await fetch('{{ route('guardar_anomalia') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    datos_anomalia: fotogramaCapturado,
                    tipo_anomalia: tipoAnomalia
                })
            });
            const data = await response.json();
            console.log(data);
        }

        async function enReproduccion() {
            const URL_MODELO = "{{ asset('models') }}";

            await faceapi.loadSsdMobilenetv1Model(URL_MODELO)
            await faceapi.loadFaceLandmarkModel(URL_MODELO)
            await faceapi.loadFaceRecognitionModel(URL_MODELO)
            await faceapi.loadFaceExpressionModel(URL_MODELO)

            let descripcionesRostros = await faceapi.detectAllFaces(video)
                .withFaceLandmarks()
                .withFaceDescriptors()
                .withFaceExpressions();

            if (descripcionesRostros.length > 1) {
                textoMensajeSuperposicion.innerText =
                    `Se detecto ${tipoAnomalias[0].nombre} en la cámara, por favor "${nombreUsuario}" elimine al resto de personas`;
                mensajeSuperposicion.classList.remove('hidden');
                setTimeout(() => guardarAnomalia(tipoAnomalias[0].id),
                    1);
            } else if (descripcionesRostros.length === 0 && camaraEncendida) {
                textoMensajeSuperposicion.innerText =
                    `${tipoAnomalias[1].nombre} "${nombreUsuario}", por favor, acérquese a la cámara`;
                mensajeSuperposicion.classList.remove('hidden');
                setTimeout(() => guardarAnomalia(tipoAnomalias[1].id),
                    1);
            } else {
                mensajeSuperposicion.classList.add('hidden');
            }

            const dimensiones = faceapi.matchDimensions(lienzo, video, true);
            const resultadosRedimensionados = faceapi.resizeResults(descripcionesRostros, dimensiones);

            if (resultadosRedimensionados && resultadosRedimensionados.length > 0) {
                const emociones = resultadosRedimensionados[0].expressions;
                const maxEmocion = Object.keys(emociones).reduce((a, b) => emociones[a] > emociones[b] ? a : b);
                const emocionTraducida = traduccionesEmociones[maxEmocion] || maxEmocion;
                mensajeEmocion.innerText = `Estado de ánimo detectado: ${emocionTraducida}`;
            } else {
                mensajeEmocion.innerText = '';
            }

            resultadosDiv.innerText = JSON.stringify(resultadosRedimensionados, null, 2);

            setTimeout(() => enReproduccion(), 100)
        }
    </script>
@endsection
