@extends('Panza')
@section('Panza')

    <div class="min-h-screen flex flex-col bg-white text-gray-800">
        <script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils@0.1/camera_utils.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@mediapipe/control_utils@0.1/control_utils.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@mediapipe/drawing_utils@0.1/drawing_utils.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@mediapipe/face_mesh@0.1/face_mesh.js" crossorigin="anonymous"></script>

        <!-- WEBCAM INPUT -->
        <video class="input_video2" hidden></video>

        <!-- MEDIAPIPE OUTPUT -->
        <canvas class="output2" width="512" height="512"></canvas>
        
        <div class="loading">
            <div class="spinner"></div>
        </div>
        <div class="control2" hidden></div>

        <script>
            const video2 = document.getElementsByClassName('input_video2')[0];
            const out2 = document.getElementsByClassName('output2')[0];
            const controlsElement2 = document.getElementsByClassName('control2')[0];
            const canvasCtx = out2.getContext('2d');
            let intervalId = null;
            let isChecking = true;

            const fpsControl = new FPS();
            const spinner = document.querySelector('.loading');
            spinner.ontransitionend = () => {
            spinner.style.display = 'none';
            };

            function onResultsFaceMesh(results) {
            document.body.classList.add('loaded');
            fpsControl.tick();

            canvasCtx.save();
            canvasCtx.clearRect(0, 0, out2.width, out2.height);
            canvasCtx.drawImage(
                results.image, 0, 0, out2.width, out2.height);
            if (results.multiFaceLandmarks) {
                checkForMultipleFaces(results);
                for (const landmarks of results.multiFaceLandmarks) {
                // drawConnectors(
                //     canvasCtx, landmarks, FACEMESH_TESSELATION,
                //     { color: '#C0C0C070', lineWidth: 1 });
                // drawConnectors(
                //     canvasCtx, landmarks, FACEMESH_RIGHT_EYE,
                //     { color: '#E0E0E0', lineWidth: 1 });
                // drawConnectors(
                //     canvasCtx, landmarks, FACEMESH_RIGHT_EYEBROW,
                //     { color: '#E0E0E0', lineWidth: 1 });
                // drawConnectors(
                //     canvasCtx, landmarks, FACEMESH_LEFT_EYE,
                //     { color: '#E0E0E0', lineWidth: 1 });
                // drawConnectors(
                //     canvasCtx, landmarks, FACEMESH_LEFT_EYEBROW,
                //     { color: '#E0E0E0', lineWidth: 1 });
                // drawConnectors(
                //     canvasCtx, landmarks, FACEMESH_FACE_OVAL,
                //     { color: '#E0E0E0', lineWidth: 1 });
                // drawConnectors(
                //     canvasCtx, landmarks, FACEMESH_LIPS,
                //     { color: '#E0E0E0', lineWidth: 1 });
                }
            }
            canvasCtx.restore();
            }

            function checkForMultipleFaces(results) {
            if (results.multiFaceLandmarks && results.multiFaceLandmarks.length > 1) {
                if (isChecking) {
                console.log("ANOMALÍA DETECTADA: Hay más de 1 rostro en la cámara del usuario");
                captureAndSaveScreenshot();
                stopFaceCheck();
                isChecking = false;
                }
            } else {
                if (!isChecking) {
                startFaceCheck();
                }
            }
            }

            function startFaceCheck() {
            isChecking = true;
            intervalId = setInterval(() => {
                faceMesh.send({ image: video2 });
            }, 1500);
            }

            function stopFaceCheck() {
            clearInterval(intervalId);
            }

            function captureAndSaveScreenshot() {
            // Captura la imagen del canvas
            const imageData = out2.toDataURL('image/jpeg');
            // Crea un elemento de enlace para descargar la imagen
            const link = document.createElement('a');
            link.href = imageData;
            // Genera un nombre de archivo único basado en la fecha y hora actual
            const fileName = `screenshot_${Date.now()}.jpg`;
            link.download = fileName;
            // Simula un clic en el enlace para iniciar la descarga
            link.click();
            }

            const faceMesh = new FaceMesh({
            locateFile: (file) => {
                return `https://cdn.jsdelivr.net/npm/@mediapipe/face_mesh@0.1/${file}`;
            }
            });
            faceMesh.onResults(onResultsFaceMesh);

            const camera = new Camera(video2, {
            onFrame: async () => {
                await faceMesh.send({ image: video2 });
            },
            width: 512,
            height: 512
            });
            camera.start();

            new ControlPanel(controlsElement2, {
            maxNumFaces: 5,
            minDetectionConfidence: 0.5,
            minTrackingConfidence: 0.5
            })
            .add([
                fpsControl
            ])
            .on(options => {
                faceMesh.setOptions(options);
            });

            startFaceCheck();
        </script>
        
    </div>

@endsection
