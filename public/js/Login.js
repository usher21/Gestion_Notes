const loginForm = document.querySelector('#login-form');
const emptyLogin = document.querySelector('#login-error');
const emptyPasswd = document.querySelector('#passwd-error');
const incorrect = document.querySelector('#incorrect');
const HOST = 'http://127.0.0.1:8000';

loginForm.addEventListener('submit', async function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    emptyLogin.innerText = '';
    emptyPasswd.innerText = '';

    if (formData.get('login') === '') {
        emptyLogin.innerText = 'Veuillez renseigner votre identifiant';
        return;
    }

    if (formData.get('passwd') === '') {
        emptyPasswd.innerText = 'Veuillez renseigner votre mot de passe';
        return;
    }

    const response = await verfiyUser(formData)
    console.log(response);
    if (response) {
        this.submit();
    }
})

async function verfiyUser(formData)
{
    const response = await fetch(HOST + '/login/verify', {
        method: 'POST',
        body: formData
    });

    console.log(response);

    incorrect.innerText = '';
    if (response.ok) {
        const user = await response.json();

        if (!user.ok) {
            incorrect.innerText = user.message;
            return false;
        }

        return user.ok;
    }
}
