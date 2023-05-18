const btnEdit = document.querySelectorAll('.btn-edit');
const modalContainer = document.querySelector('.modal-container');
const closeModal = document.querySelector('.cancel');
const addNewStudentBtn = document.querySelector('#add-new-student')
const addNewLevel = document.querySelector('#add-new-level');

console.log(closeModal);

for (const edit of btnEdit) {
    edit.addEventListener('click', () => {
        modalContainer.style.display = 'flex';
    })
}

addNewLevel.addEventListener('click', () => {
    modalContainer.classList.remove('hidden');
})

closeModal.addEventListener('click', () => {
    modalContainer.classList.add('hidden');
})