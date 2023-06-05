import { fetchData, createElement } from "./api.js";

import {
    clearTextElement, clearElementContainer,
    handleSubjectAdd, handleSubjectGet, handleSubjectGroupAdd,
    subjectValidator, getFormData
}
    from
    "./util.js";

const selectLevel = document.querySelector('#select-level');
const selectClasse = document.querySelector('#select-classe');
const selectSubjectGroup = document.querySelector('#select-subject-group');
const subjectGroupContainer = document.querySelector('#subject-group-container');
const subjectTitle = document.querySelector('#subject-title');
const otherGroup = document.querySelector('#other-group');
const deletedInfo = document.querySelector('#deleted-info');
const closeModal = document.querySelector('#closeModal');
const newSubjectGroup = document.querySelector('#new-subject-group');
const addNewSubject = document.querySelector('#add-new-subject');
const subjectInput = document.querySelector('#subject');
const btnUpdate = document.querySelector('#btn-update');

const subjectGroupForm = document.querySelector('#subject-group-form');
const subjectGroupFormContainer = document.querySelector('#subject-group-form-container');
const subjectGroupError = document.querySelector('#subject-group-error');
const classeError = document.querySelector('#classe-error');
const emptySubjectGroup = document.querySelector('#empty-subject-group');
const subjectError = document.querySelector('#subject-error');

const HOST = 'http://127.0.0.1:8000';
const GET_SUBJECT = '/classe/discipline/';
const ADD_SUBJECT = '/discipline/add';
const DEL_SUBJECT = '/discipline/delete/';

const CLASSE_IN_LEVEL = '/classe/get/';
const ADD_SUBJECT_GROUP = '/group-discipline/add';

btnUpdate.disabled = true;

selectLevel.addEventListener('change', async function () {
    const idLevel = this.selectedOptions[0].getAttribute('data-id');

    selectClasse.innerHTML = '<option class="w-full">Choisir une classe</option>';

    try {
        const classes = await fetchData(HOST + CLASSE_IN_LEVEL + idLevel, { method: 'GET' });
        for (const classe of classes.data) {
            const option = createElement(
                'option', { class: "w-full", 'data-id': classe.id_classe },
                classe.classe
            )
            selectClasse.appendChild(option);
        }
    } catch (error) {
        console.log('erreur -> ', error.message)
    }
})

selectClasse.addEventListener('change', async function () {
    const idClasse = this.selectedOptions[0].getAttribute('data-id');

    clearTextElement(classeError);
    clearElementContainer(subjectGroupContainer);
    subjectTitle.innerText = 'Les disciplines de la classe de ' + this.selectedOptions[0].innerText;

    const subjectGroups = await fetchData(HOST + GET_SUBJECT + idClasse, { method: 'GET' });

    handleSubjectGet(subjectGroups, subjectGroupContainer, deletedInfo, btnUpdate);
})

subjectGroupForm.addEventListener('submit', async function (event) {
    event.preventDefault();
    const formData = new FormData(this);

    clearTextElement(subjectGroupError);

    if (formData.get('subject-group') === '') {
        subjectGroupError.innerText = 'Veuillez entrer le libellé du groupe de discipline';
        return;
    }

    const response = await fetchData(HOST + ADD_SUBJECT_GROUP, { method: 'POST', body: formData });

    if (handleSubjectGroupAdd(response, { selectSubjectGroup, subjectGroupError }, otherGroup)) {
        closeModal.click();
    }
});

newSubjectGroup.addEventListener('click', () => {
    subjectGroupFormContainer.classList.remove('hidden');
})

selectSubjectGroup.addEventListener('change', function () {
    if (+this.selectedIndex != 0 && +this.selectedIndex != 1) {
        clearTextElement(emptySubjectGroup);
    }
});

closeModal.addEventListener('click', () => {
    subjectGroupFormContainer.classList.add('hidden');
    clearTextElement(subjectGroupError);
})

addNewSubject.addEventListener('click', async function () {

    clearTextElement(classeError, emptySubjectGroup, subjectError);

    if (!subjectValidator
        (
            { selectClasse, classeError },
            { selectSubjectGroup, emptySubjectGroup },
            { subjectInput, subjectError }
        )
    ) {
        return;
    }

    const idClasse = selectClasse.selectedOptions[0].getAttribute('data-id');
    const idGroup = selectSubjectGroup.selectedOptions[0].getAttribute('data-id');
    const formData = getFormData(idClasse, idGroup, subjectInput.value);
    const newSubject = await fetchData(HOST + ADD_SUBJECT, { method: 'POST', body: formData });

    handleSubjectAdd(newSubject, idClasse, subjectGroupContainer, subjectError, { HOST, GET_SUBJECT }, btnUpdate);
})

subjectInput.addEventListener('input', function () {
    subjectError.innerText = '';
    if (this.value === '') {
        subjectError.innerText = 'Veuillez saisir le libellé de la discpline';
    }
})

btnUpdate.addEventListener('click', async () => {
    const idClasse = selectClasse.selectedOptions[0].getAttribute("data-id");
    const uncheckedSubjects = Array
        .from(subjectGroupContainer.querySelectorAll('input[type="checkbox"]'))
        .filter(checkbox => !checkbox.checked);

    const idSubjects = [];
    uncheckedSubjects.forEach(uncheckedSubject => {
        const id = +uncheckedSubject.getAttribute("data-id");
        idSubjects.push(id);
    })
    
    const formData = new FormData;
    formData.append('idSubjects', idSubjects);

    const response = await fetchData(HOST + DEL_SUBJECT + idClasse, { method: 'POST', body: formData });
    console.log(response);
})
