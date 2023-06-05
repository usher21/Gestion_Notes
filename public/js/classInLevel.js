const addClasse = document.querySelector('#add-classe');
const closeModal = document.querySelector('#closeModal');
const btnSave = document.querySelector('#btn-save');
const alertClasse = document.querySelector('#alert-classe');
const inputLabel = document.querySelector('#classe-label');

btnSave.disabled = true;

addClasse.addEventListener('click', () => {
    form.classList.remove('opacity-0');
    form.classList.remove('-right-80');
    form.classList.add('opacity-100');
    form.classList.add('right-16');
})

closeModal.addEventListener('click', () => {
    form.classList.remove('opacity-100');
    form.classList.remove('right-16');
    form.classList.add('-right-80');
    form.classList.add('opacity-0');
})

inputLabel.addEventListener('input', function() {
    alertClasse.classList.add('hidden');
    btnSave.disabled = false;

    if (this.value === '') {
        alertClasse.classList.remove('hidden');
        btnSave.disabled = true;
    }
})

