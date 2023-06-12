const btnAddLevel = document.querySelector('#add-level');
const form = document.querySelector('#form');
const btnCloseModal = document.querySelector('#closeModal');
const alertLevel = document.querySelector('#alert-level');
const btnSave = document.querySelector('#save');
const inputLabel = document.querySelector('#level-label');

btnSave.disabled = true;

btnAddLevel.addEventListener('click', () => {
    form.classList.remove('opacity-0');
    form.classList.remove('-right-80');
    form.classList.add('opacity-100');
    form.classList.add('right-7');
})

btnCloseModal.addEventListener('click', () => {
    form.classList.remove('opacity-100');
    form.classList.remove('right-7');
    form.classList.add('-right-80');
    form.classList.add('opacity-0');
})

inputLabel.addEventListener('input', function() {
    alertLevel.classList.add('hidden');
    btnSave.disabled = false;

    if (this.value === '') {
        alertLevel.classList.remove('hidden');
        btnSave.disabled = true;
    }
})