const editYears = document.querySelectorAll('#edit-year');
const editYearInputs = document.querySelectorAll('#edit-year-input');

for (const editYear of editYears) {
    editYear.addEventListener('click', function(e) {
        e.preventDefault();
        this.nextElementSibling.classList.remove('hidden');
        this.nextElementSibling.focus();
        this.nextElementSibling.value = this.parentElement.getAttribute('data-label');
    })
}

for (const editYearInput of editYearInputs) {
    editYearInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            if (validSchoolYear(this.value)) {
                this.classList.remove('border-2');
                this.classList.remove('border-red-600');
                const params = `?label=${this.value}&id=${this.parentElement.getAttribute('data-id')}`;
                console.log(editYearInput.previousElementSibling.getAttribute('href') + params);
                window.location.href = editYearInput.previousElementSibling.getAttribute('href') + params;
            } else {
                this.classList.add('border-2');
                this.classList.add('border-red-600');
            }
        }
    })

    editYearInput.addEventListener('blur', function() {
        this.classList.add('hidden');
    })
}

function validSchoolYear(schoolYear) {
    if (/^\d{4}-\d{4}$/.test(schoolYear)) {
        if (+(schoolYear.split('-')[1]) - +(schoolYear.split('-')[0]) === 1) {
            return true;
        }
    }
    return false;
}


