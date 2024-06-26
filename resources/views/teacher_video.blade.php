<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Video Call</title>
    <script src="https://sdk.twilio.com/js/video/releases/2.14.0/twilio-video.min.js"></script>
</head>
<body>
    <h1>Teacher Video Call</h1>
    <input type="text" id="room-id" placeholder="Enter Room ID">
    <button onclick="joinRoom()">Join Room</button>
    <div id="remote-video" class="relative w-full h-full flex items-center justify-center"></div>

    <script>
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

            Twilio.Video.connect(token, {}).then(room => {
                room.participants.forEach(participant => {
                    participant.tracks.forEach(publication => {
                        if (publication.isSubscribed) {
                            const track = publication.track;
                            document.getElementById('remote-video').appendChild(track.attach());
                        }
                    });

                    participant.on('trackSubscribed', track => {
                        document.getElementById('remote-video').appendChild(track.attach());
                    });
                });

                room.on('participantConnected', participant => {
                    participant.tracks.forEach(publication => {
                        if (publication.isSubscribed) {
                            const track = publication.track;
                            document.getElementById('remote-video').appendChild(track.attach());
                        }
                    });

                    participant.on('trackSubscribed', track => {
                        document.getElementById('remote-video').appendChild(track.attach());
                    });
                });
            });
        }
    </script>
</body>
</html>
