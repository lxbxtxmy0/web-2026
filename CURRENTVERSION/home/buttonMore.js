document.addEventListener('DOMContentLoaded', function () {
    const descriptions = document.querySelectorAll('.description');
    for (const description of descriptions) {
        const button = description.parentNode.querySelector('.more');
        if (description.scrollHeight > description.clientHeight) {
            button.classList.add('active');
        } else {
            button.classList.remove('active');
        }
        button.addEventListener('click', function () {
            const text = button.innerHTML;
            if (text === 'еще') {
                button.innerHTML = 'свернуть';
            } else {
                button.innerHTML = 'еще';
            }
            description.classList.toggle('active');
        });
    }
});