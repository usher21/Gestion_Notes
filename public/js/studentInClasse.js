const modalContainer = document.querySelector('#modal-container');
const btnAddStudent = document.querySelector('#add-new-student');
const closeModal = document.querySelector('#closeModal');

const registrationForm = document.querySelector('#registration-form');

const lastName = document.querySelector('#lastname');
const firstName = document.querySelector('#firstname');
const chooseImage = document.querySelector('#choose-image');
const studentImage = document.querySelector('#upload-file');
const imageContainer = document.querySelector('#image-container');

const lastNameError = document.querySelector('.lastname-error');
const firstNameError = document.querySelector('.firstname-error');
const sexError = document.querySelector('.sex-error');

btnAddStudent.addEventListener('click', () => {
    modalContainer.classList.remove('hidden');
    modalContainer.classList.add('flex');
})

closeModal.addEventListener('click', () => {
    modalContainer.classList.remove('flex');
    modalContainer.classList.add('hidden');
})

chooseImage.addEventListener('click', () => {
    studentImage.click();
})

registrationForm.addEventListener('submit', function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);

    if (formValidator()) {
        if (formData.get('sex') == null) {
            sexError.innerText = "Veuillez choisir le sexe de l'élève";
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
    } else {
        firstNameError.innerText = '';
        if (empty(firstName)) {
            firstNameError.innerText = "Veuillez saisir le prénom de l'élève";
            valid = false;
        }
    }

    return valid;
}

function empty(field) {
    return field.value === '';
}

function uploadFile(inputFile, imageContainer) {
    inputFile.addEventListener('change', () => {
        const file = inputFile.files[0]
        const reader = new FileReader()

        reader.readAsDataURL(file)
        
        reader.addEventListener('load', () => {
            const image = new Image()
            image.setAttribute('class', 'w-full h-full object-cover cursor-pointer rounded-full');
            image.src = reader.result

            const chooseImg = createElement('div', {
                class: `bg-black/50 absolute w-full h-full top-0 left-0 cursor-pointer
                        hover:opacity-80 rounded-full flex items-center justify-center
                        text-center text-white`,
                id: 'id="choose-image"'
            }, 'Choisir une image');
            
            imageContainer.innerHTML = '';
            imageContainer.appendChild(image);
            imageContainer.appendChild(chooseImg);
            chooseImg.addEventListener('click', () => {
                studentImage.click();
            })
        })
    })
}

uploadFile(studentImage, imageContainer);

function createElement(tagName, attributes = {}, content = '') {
    const element = document.createElement(tagName)
    for (const key in attributes) {
        element.setAttribute(key, attributes[key])
    }
    element.innerText = content
    return element
}