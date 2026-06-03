const userId = '1';

document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById('file_input');
    const blackBtn = document.getElementById('black_btn');
    const blueBtn = document.getElementById('blue_btn');
    const photoField = document.querySelector('.add_photo_field');
    const addBlock = document.querySelector('.add_photo_field .add_photo_block');
    const images = document.getElementsByClassName('preview_img');
    const leftSlider = document.querySelector('.slider_left');
    const rightSlider = document.querySelector('.slider_right');
    const textArea = document.getElementById('post-description');
    const shareBtn = document.getElementById('submit_btn');
    const form = document.querySelector('.create_post');
    const successBlock = document.querySelector('.success');
    const pageTitle = document.querySelector('.page_title');
    const errorMessage = document.querySelector('.error_message');

    shareBtn.disabled = true;
    let files = [];
    let existingImagesCount = 0;

    const urlParams = new URLSearchParams(window.location.search);
    const editPostId = urlParams.get('id');
    const isEditMode = editPostId !== null;

    async function loadPostData(id) {
        try {
            const response = await fetch(`apiGet.php?id=${id}`);
            if (!response.ok) throw new Error('Не удалось загрузить данные поста');

            const postData = await response.json();

            textArea.value = postData.description;

            if (postData.images && postData.images.length > 0) {
                if (addBlock) {
                    addBlock.remove();
                }

                postData.images.forEach(imgUrl => {
                    const newImg = document.createElement('img');
                    newImg.src = imgUrl;
                    newImg.alt = "Фото";
                    newImg.className = "preview_img";
                    photoField.append(newImg);
                    existingImagesCount++;
                });

                images[0].classList.add('active');
                if (images.length > 1) {
                    leftSlider.classList.add('active');
                    rightSlider.classList.add('active');
                }
            }
            validateForm();
        } catch (error) {
            showError(error.message);
        }
    }

    if (isEditMode) {
        pageTitle.textContent = 'Редактирование поста';
        shareBtn.textContent = 'Сохранить';
        loadPostData(editPostId);
    }

    function redirectClick() {
        fileInput.click();
    }

    if (blackBtn) blackBtn.addEventListener('click', redirectClick);
    if (blueBtn) blueBtn.addEventListener('click', redirectClick);

    function changeSlide(photoField, images, step) {
        const len = images.length;
        if (len === 0) return;
        let index = parseInt(photoField.getAttribute('data-current-index')) || 0;
        images[index].classList.remove('active');
        index = (index + step + len) % len;
        images[index].classList.add('active');
        photoField.setAttribute('data-current-index', index);
    }

    function validateForm() {
        const hasText = textArea.value.trim().length !== 0;
        const hasImages = (files.length + existingImagesCount) > 0;

        if (hasText && hasImages) {
            shareBtn.classList.add('active');
            shareBtn.disabled = false;
        } else {
            shareBtn.classList.remove('active');
            shareBtn.disabled = true;
        }
    }

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            files.push(file);
            const reader = new FileReader();
            reader.onload = function () {
                const imageUrl = this.result;
                const newImg = document.createElement('img');
                newImg.src = imageUrl;
                newImg.alt = "Фото";
                newImg.className = "preview_img";

                if (addBlock && photoField.contains(addBlock)) {
                    addBlock.remove();
                }
                photoField.append(newImg);

                for (let img of images) img.classList.remove('active');
                newImg.classList.add('active');
                photoField.setAttribute('data-current-index', images.length - 1);

                if (images.length > 1) {
                    leftSlider.classList.add('active');
                    rightSlider.classList.add('active');
                }
                validateForm();
            }
            reader.readAsDataURL(file);
        }
        this.value = '';
    });

    leftSlider.addEventListener('click', () => changeSlide(photoField, images, -1));
    rightSlider.addEventListener('click', () => changeSlide(photoField, images, 1));
    textArea.addEventListener('input', validateForm);

    function showError(text) {
        errorMessage.textContent = text;
        errorMessage.style.display = 'block';
    }

    form.addEventListener("submit", async function (event) {
        event.preventDefault();
        errorMessage.style.display = 'none';
        shareBtn.disabled = true;
        shareBtn.classList.remove('active');

        const formData = new FormData(form);
        formData.append('user_id', userId);

        if (isEditMode) {
            formData.append('edit_post_id', editPostId);
        }

        for (const file of files) {
            formData.append('images[]', file);
        }

        try {
            const response = await fetch('api.php', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                form.classList.add('hidden');
                successBlock.classList.add('active');
            } else {
                const errorData = await response.json();
                throw new Error(errorData.error);
            }
        } catch (error) {
            showError(error.message);
            shareBtn.disabled = false;
            shareBtn.classList.add('active');
        }
    });
});