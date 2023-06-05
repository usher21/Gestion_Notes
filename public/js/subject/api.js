/**
 * 
 * @param {string} url Le lien vers la ressource demandée
 * @param {Object} header Un objet contenant des informations sur les entêtes HTTP de la requête(méthode, corps de la requête)
 * @returns {string} Retourne une chaine contenant les données demandés. Ces données peuvent ensuite être parsée sous format json
 */

export async function fetchDataText(url, header) {
    const response = await fetch(url, header);

    if (response.ok) {
        const data = await response.text();
        return data
    }

    throw new Error('Impossible de contacter le serveur => ', { cause: response });
}

/*----------------------------------------------------------------------------------------------------*/

/**
 * 
 * @param {string} url Le lien vers la ressource demandée
 * @param {Object} header Un objet contenant des informations sur les entêtes HTTP de la requête(méthode, corps de la requête)
 * @returns {Object} Retourne un object contenant les données demandés.
 */

export async function fetchData(url, header) {
    const response = await fetch(url, header);

    if (response.ok) {
        const data = await response.json();
        return data
    }

    throw new Error('Impossible de contacter le serveur => ', { cause: response });
}

/*----------------------------------------------------------------------------------------------------*/

/**
 * 
 * @param {string} subjectGroupName Le libellé du groupe de discipline
 * @param {Array<Object>} subjects 
 * @returns 
 */

export function createSubjectContainer(subjectGroupName, subjects, {updateBtn, subjectGroupContainer}) {
    const container = createElement('div', {
        class: "subject-container max-h-96 relative pt-8 px-3 pb-4 mb-12 ml-12 w-80 bg-white rounded-xl"
    });

    const legend = createElement('legend', {
        class: "absolute -top-6 text-xl bg-slate-100 p-2 rounded-xl",
    }, subjectGroupName);

    container.appendChild(legend);

    for (const {subject_name, subject_id} of subjects) {
        const subjectItem = createSubjectItem(subject_name, subject_id, {updateBtn, subjectGroupContainer});
        container.appendChild(subjectItem);
    }

    return container;
}

/*----------------------------------------------------------------------------------------------------*/

export function createSubjectItem(subjectName, subjectId, {updateBtn, subjectGroupContainer}) {
    const itemContainer = createElement('div', { class: 'mb-2' });

    const checkbox = createElement('input', {
        type: 'checkbox',
        name: 'item-check' + subjectId,
        id: 'item-check' + subjectId,
        class: 'w-8',
        checked: true,
        'data-id': subjectId
    });

    const label = createElement('label', {
        for: 'item-check' + subjectId,
        class: 'text-lg'
    }, subjectName);

    itemContainer.appendChild(checkbox);
    itemContainer.appendChild(label);

    handleCheck(checkbox, label, {updateBtn, subjectGroupContainer});

    return itemContainer;
}

/*----------------------------------------------------------------------------------------------------*/

function handleCheck(checkbox, label, {updateBtn, subjectGroupContainer}) {
    checkbox.addEventListener('change', () => {
        label.classList.toggle('text-red-700');
        if (hasUncheckedBox(subjectGroupContainer)) {
            updateBtn.removeAttribute('disabled');
        } else {
            updateBtn.disabled = true;
        }
    })
}

/*----------------------------------------------------------------------------------------------------*/

function hasUncheckedBox(subjectGroupContainer) {
    const uncheckedSubjects = Array
                                .from(subjectGroupContainer.querySelectorAll('input[type="checkbox"]'))
                                .filter(checkbox => !checkbox.checked);
    return uncheckedSubjects.length != 0;
}

/*----------------------------------------------------------------------------------------------------*/

/**
 * Permet de créer un élément HTML et de le remplir avec ses attributs et son contenu texte
 * @param {String} tagName Nom de l'élément
 * @param {Object} attributes Les attributs de l'élément
 * @param {String} content Le contenu texte de l'élément
 * @returns {HTMLElement}
 */

export function createElement(tagName, attributes = {}, content = '') {
    const element = document.createElement(tagName)
    for (const key in attributes) {
        element.setAttribute(key, attributes[key])
    }
    element.innerText = content
    return element
}

/*----------------------------------------------------------------------------------------------------*/
