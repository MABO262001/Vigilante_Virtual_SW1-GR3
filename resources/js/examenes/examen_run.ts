document.addEventListener('DOMContentLoaded', () => {
    console.log('ts');

    let count_questions: number = 0;
    var actualContainer = document.getElementById('container-0') as HTMLElement;
    var csrfToken = document.getElementById('container-0') as HTMLInputElement;
    actualContainer.classList.remove('hidden');

    let nextBtn = document.getElementById('next-' + count_questions) as HTMLButtonElement;

    let respuestas = '{{$preguntas_seleccionadas}}';
    console.log(respuestas);
    
    nextBtn.addEventListener('click', (event) => {
        let dataxValue: string | null = (event.target as HTMLButtonElement).getAttribute('datax');
        if (dataxValue !== null) {
            console.log(dataxValue);
        }

        actualContainer.classList.add('hidden');

        let data : object = {
            'respuesta_id' : dataxValue,
        };

        fetch('/examenes/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.value
            },
            body: JSON.stringify(data)
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al enviar los datos');
                }
                return response.json();
            })
            .then(responseData => {
                if (responseData['msg'] == 'ok') {
                    window.location.href = '/examenes';
                }
                console.log(responseData);
            });

        count_questions++;
    });





});