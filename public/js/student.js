const modalContainer = document.querySelector('.modal-container');
const btnAddStudent = document.querySelector('#add-new-student');
const btnCloseModal = document.querySelector('#cancel');
const idClasse = document.querySelector('#id_classe');

const registrationForm = document.querySelector('#registration-form');

const lastName = document.querySelector('#lastname');
const firstName = document.querySelector('#firstname');
const selectLevel = document.querySelector('#select-level');
const selectClasse = document.querySelector('#select-classe');

const lastNameError = document.querySelector('.lastname-error');
const firstNameError = document.querySelector('.firstname-error');
const sexError = document.querySelector('.sex-error');
const levelError = document.querySelector('.level-error');
const classeError = document.querySelector('.classe-error');

btnAddStudent.addEventListener('click', () => {
    modalContainer.classList.remove('hidden');
    modalContainer.classList.add('flex');
})

btnCloseModal.addEventListener('click', () => {
    modalContainer.classList.remove('flex');
    modalContainer.classList.add('hidden');
})

selectLevel.addEventListener('change', function()
{
    const idLevel = this.selectedOptions[0].getAttribute('data-id');
    
    selectClasse.innerHTML = '<option class="w-full">Choisir une classe</option>';

    fetch(`http://localhost:8000/classe/get/${idLevel}`, { method: 'GET' })
        .then(response => response.json())
        .then(data => {
            for (const classe of data.data) {
                selectClasse.innerHTML += `<option class="w-full" data-id=${classe.id_classe}>${classe.classe}</option>`;
            }
        })
        .catch(error => console.log('erreur -> ', error.message));
})

selectClasse.addEventListener('change', function() {
    idClasse.value = this.selectedOptions[0].getAttribute('data-id');
})

registrationForm.addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);

    if (formValidator()) {
        if (formData.get('sex') == null) {
            sexError.innerText = "Veuillez choisir le sexe de l'élève";
            return;
        }
        
        if (selectLevel.selectedIndex == 0) {
            levelError.innerText = "Veuillez choisir la classe";
            return;
        }
        
        if (selectClasse.selectedIndex == 0) {
            classeError.innerText = "Veuillez choisir le niveau";
            return;
        }

        this.submit();
    }
})

function formValidator() {
    let valid = true;

    lastNameError.innerText = '';
    if (empty(lastName)) {
        lastNameError.innerText = "Veuillez saisir le nom de l'élève";
        valid = false;
        return;
    }

    firstNameError.innerText = '';
    if (empty(firstName)) {
        firstNameError.innerText = "Veuillez saisir le prénom de l'élève";
        valid = false;
    }

    return valid;
}

function empty(field) {
    return field.value == '';
}
