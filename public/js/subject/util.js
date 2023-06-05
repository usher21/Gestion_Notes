import { createSubjectContainer, fetchData, createElement } from "./api.js";

export function clearTextElement(...elements) {
    for (const element of elements) {
        element.innerText = '';
    }
}

export function clearElementContainer(...elements) {
    for (const element of elements) {
        element.innerHTML = '';
    }
}

export function getFormData(idClasse, idGroup, subjectLabel) {
    const formData = new FormData;
    formData.append('idClasse', idClasse);
    formData.append('subjectGroup', idGroup);
    formData.append('label', subjectLabel);
    return formData;
}

export function subjectValidator(classe, subjectGroup, subject) {
    if (classe.selectClasse.selectedIndex === 0) {
        classe.classeError.innerText = 'Veuillez choisir la classe pour ajouter cette discipline';
        return false;
    }

    if (subjectGroup.selectSubjectGroup.selectedIndex === 0 || subjectGroup.selectSubjectGroup.selectedIndex === 1) {
        subjectGroup.emptySubjectGroup.innerText = "Veuillez choisir un groupe ou choisir 'Autre' si la discpline n'appartient à aucun groupe";
        return false;
    }

    if (subject.subjectInput.value === '') {
        subject.subjectError.innerText = 'Veuillez saisir le libellé de la discpline';
        return false;
    }

    return true;
}

export function deleteSelectedOptions(select) {
    for (const option of select.children) {
        option.removeAttribute('selected');
    }
}

export function handleSubjectGroupAdd(response, {selectSubjectGroup, subjectGroupError}, otherGroup) {
    if (response.statusCode === 204) {
        subjectGroupError.innerText = response.message
        return false;
    }

    deleteSelectedOptions(selectSubjectGroup);

    const option = createElement('option', {
        class: 'w-full',
        "data-id": response.data.id,
        selected: true
    }, response.data.label);

    otherGroup.insertAdjacentElement('beforebegin', option);
    return true;
}

export async function handleSubjectAdd(newSubject, idClasse, subjectGroupContainer, subjectError, URL, updateBtn) {
    if (newSubject.statusCode == 200) {
        clearElementContainer(subjectGroupContainer);
        const subjectGroups = await fetchData(URL.HOST + URL.GET_SUBJECT + idClasse, {method: 'GET'});
        handleSubjectGet(subjectGroups, subjectGroupContainer, null, updateBtn);
    } else {
        subjectError.innerText = newSubject.message;
    }
}

export function handleSubjectGet(subjectGroups, subjectGroupContainer, deletedInfo, updateBtn) {
    if (subjectGroups.statusCode === 204) {
        deletedInfo.classList.add('hidden');
        const emptyMessage = createElement('div', {
            class: 'text-lg text-red-700 text-center w-full flex item-center justify-center'
        }, subjectGroups.message);
        subjectGroupContainer.appendChild(emptyMessage);
        return;
    }

    deletedInfo?.classList.remove('hidden');

    const { group_name, subjects_ids } = subjectGroups.data;

    for (let i = group_name.length - 1, j = subjects_ids.length - 1; i >= 0; i--, j--) {
        const subjectContainer = createSubjectContainer(group_name[i], subjects_ids[j], {updateBtn, subjectGroupContainer});
        subjectGroupContainer.appendChild(subjectContainer);
    }
}

