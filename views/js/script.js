const btnEdit = document.querySelectorAll('.btn-edit');
const modalContainer = document.querySelector('.modal-container');
const closeModal = document.querySelector('.cancel');
const addNewStudentBtn = document.querySelector('#add-new-student')

for (const edit of btnEdit) {
    edit.addEventListener('click', () => {
        modalContainer.style.display = 'flex';
    })
}

closeModal.addEventListener('click', () => {
    modalContainer.style.display = 'none';
})