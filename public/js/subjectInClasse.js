import { fetchData } from "./subject/api.js";

const ressourceInputs = document.querySelectorAll('input[data-type="ressource"]');
const examInputs = document.querySelectorAll('input[data-type="exam"]');
const btnUpdate = document.querySelector('#btn-update');
const deleteSubject = document.querySelectorAll('.delete-subject');
const subjectsContainer = document.querySelector('.subjects-container');

const HOST = 'http://127.0.0.1:8000';
const ADD_SUBJECT_COEF = '/classe/coef/add';
const DEL_SUBJECT = '/discipline/delete/';

btnUpdate.addEventListener('click', async () => {
    const tab = [];
    
    for (let i = 0; i < ressourceInputs.length; i++) {
        tab.push({
            "ressource": ressourceInputs[i],
            "exam" : examInputs[i],
            "id": ressourceInputs[i].parentElement.parentElement.getAttribute('data-id')
        });
    }
    
    const values = tab
        .filter(inputs => 
            inputs.exam.getAttribute('data-current') != inputs.exam.value ||
            inputs.ressource.getAttribute('data-current') != inputs.ressource.value
            )
        .map(changed => {
            return {
                "exam": changed.exam.value,
                "ressource": changed.ressource.value,
                "id": changed.id
            }
        });
    
    const response = await fetchData(HOST + ADD_SUBJECT_COEF, {method: 'POST', body: JSON.stringify(values)});
    console.log(response);
})

for (const btnDelete of deleteSubject) {
    btnDelete.addEventListener('click', async function() {
        const idSubjectClasse = this.getAttribute("data-id");
        const idClasse = this.getAttribute("data-classe");
        const formData = new FormData;
        formData.append('idSubjects', +idSubjectClasse);

        subjectsContainer.querySelector('div[data-selector="container-' + idSubjectClasse + '"]').remove();
        
        const response = await fetchData(HOST + DEL_SUBJECT + idClasse, { method: 'POST', body: formData });
        console.log(response);
    })
}

