"use strict";
document.addEventListener('DOMContentLoaded', () => {
    console.log('ts');
    let count_questions = 0;
    const initialContainer = document.getElementById('container-0');
    initialContainer.classList.remove('hidden');
    let nextBtn = document.getElementById('next-' + count_questions);
    nextBtn.addEventListener('click', (event) => {
        let dataxValue = event.target.getAttribute('datax');
        if (dataxValue !== null) {
            console.log(dataxValue);
        }
    });
});
