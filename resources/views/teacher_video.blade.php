@extends('Panza')
@section('Panza')

<div class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-4">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-4xl">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Teacher Video Call</h1>
        <div class="mb-4">
            <input type="hidden" id="room-id" value="{{ $ejecucion->id }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>
        <div id="remote-video" class="video-grid mt-6 bg-gray-200 rounded-lg p-2"></div>
    </div>
</div>

<script src="https://sdk.twilio.com/js/video/releases/2.14.0/twilio-video.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        joinRoom();
    });

    async function joinRoom() {
        const roomName = document.getElementById('room-id').value;
        if (!roomName) {
            alert('Room ID is missing');
            return;
        }

        const response = await fetch('/video/token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ identity: 'teacher-{{ uniqid() }}', room: roomName })
        });

        if (!response.ok) {
            const errorData = await response.json();
            alert('Error: ' + errorData.error);
            return;
        }

        const data = await response.json();
        const token = data.token;

        Twilio.Video.connect(token, { name: roomName }).then(room => {
            room.participants.forEach(participant => {
                participant.tracks.forEach(publication => {
                    if (publication.isSubscribed) {
                        const track = publication.track;
                        attachTrack(track, participant.identity);
                    }
                });

                participant.on('trackSubscribed', track => {
                    attachTrack(track, participant.identity);
                });
            });

            room.on('participantConnected', participant => {
                participant.tracks.forEach(publication => {
                    if (publication.isSubscribed) {
                        const track = publication.track;
                        attachTrack(track, participant.identity);
                    }
                });

                participant.on('trackSubscribed', track => {
                    attachTrack(track, participant.identity);
                });
            });

            room.on('participantDisconnected', participant => {
                removeTrack(participant.identity);
            });
        }).catch(error => {
            console.error('Error connecting to Twilio:', error);
        });
    }

    function attachTrack(track, identity) {
        // Eliminar los contenedores existentes para evitar duplicación
        removeTrack(identity);

        const videoContainer = document.createElement('div');
        videoContainer.classList.add('video-container');

        // Crear la superposición de nombre
        const nameOverlay = document.createElement('div');
        nameOverlay.classList.add('name-overlay');
        nameOverlay.textContent = identity;
        
        videoContainer.appendChild(track.attach());
        videoContainer.appendChild(nameOverlay);
        document.getElementById('remote-video').appendChild(videoContainer);
    }

    function removeTrack(identity) {
        const containers = document.querySelectorAll('.video-container');
        containers.forEach(container => {
            if (container.querySelector('.name-overlay').textContent === identity) {
                container.remove();
            }
        });
    }
</script>

<style>
    .video-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 10px;
    }
    .video-container {
        position: relative;
        width: 100%;
        padding-top: 56.25%;
        background-color: black;
    }
    .video-container video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .name-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        text-align: center;
        padding: 5px;
        font-size: 14px;
        font-weight: bold;
    }
</style>

@endsection
