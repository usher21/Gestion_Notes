const btnAddClasse = document.querySelector('#add-classe');
const modalContainer = document.querySelector('.modal-container');
const modalTitle = document.querySelector('#modal-title');
const btnCloseModal = document.querySelector('#cancel');
const classeLabel = document.querySelector('#classe-label');
const alertClasse = document.querySelector('#alert-classe');
const btnSave = document.querySelector('#save');
const idLevel = document.querySelector('#id_level');
const selectClasse = document.querySelector('#classe-select');
const btnEditClasses = document.querySelectorAll('.edit-classe');
const form = document.querySelector('#class-form');
const idInput = document.querySelector('#id');

btnSave.disabled = true;
idLevel.value = selectClasse.options[selectClasse.selectedIndex].getAttribute('data-id');

selectClasse.addEventListener('change', () => {
    idLevel.value = selectClasse.options[selectClasse.selectedIndex].getAttribute('data-id');
})

btnAddClasse.addEventListener('click', () => {
    modalTitle.innerText = 'Ajout de classe';
    modalContainer.classList.remove('hidden');
    modalContainer.classList.add('flex');
    form.setAttribute('action', 'http://localhost:8000/classe/add');
})

for (const btnEditClasse of btnEditClasses) {
    btnEditClasse.addEventListener('click', function () {
        modalTitle.innerText = "Modification de classe";
        modalContainer.classList.remove('hidden');
        modalContainer.classList.add('flex');
        form.setAttribute('action', 'http://localhost:8000/classe/edit');
        idInput.value = this.parentElement.getAttribute('data-id');
        classeLabel.value = this.parentElement
            .previousElementSibling
            .previousElementSibling
            .previousElementSibling
            .innerText;

        Array.from(selectClasse).forEach(option => option.removeAttribute('selected'));

        for (const option of selectClasse.children) {
            if (+option.getAttribute('data-id') == +this.parentElement.getAttribute('data-id-level')) {
                option.setAttribute('selected', true);
                return;
            }
        }
    })
}

btnCloseModal.addEventListener('click', () => {
    modalContainer.classList.remove('flex');
    modalContainer.classList.add('hidden');
})

classeLabel.addEventListener('input', function () {
    alertClasse.classList.add('hidden');
    btnSave.disabled = false;

    if (this.value === '') {
        alertClasse.classList.remove('hidden');
        btnSave.disabled = true;
    }
})

