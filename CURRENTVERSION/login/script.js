document.addEventListener('DOMContentLoaded', function() {
    const form = document. querySelector('.login');
    const errorField = document.querySelector('.error_field');
    const password = 'qwerty123';
    const email = 'qwerty123@gmail.com';
    const emailIn = document.getElementById('email-field');
    const example = document.querySelector('.example');
    const passwordIn = document.getElementById('password-field');

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        if (passwordIn.value === '' || emailIn.value === '') {
            errorField.innerHTML = '🤓 Поля обязательные';
            if (passwordIn.value === '') {
                passwordIn.classList.add('error');
            } else {
                passwordIn.classList.remove('error');
            }
            if (emailIn.value === '') {
                emailIn.classList.add('error');
                example.classList.add('error');
            } else {
                emailIn.classList.remove('error');
                example.classList.remove('error');
            }
            errorField.classList.add('active');
        } else {
            errorField.classList.remove('active');
            if (passwordIn.value !== password || emailIn.value !== email) {
                errorField.classList.add('active');
                emailIn.classList.add('error');
                example.classList.add('error');
                passwordIn.classList.add('error');
                errorField.innerHTML = '🤥 Не те логин или пароль...';
            } else {
                passwordIn.classList.remove('error');
                emailIn.classList.remove('error');
                example.classList.remove('error');
                errorField.innerHTML = '';
            }
        }
    })
});

// проверять регуляркой на емейл