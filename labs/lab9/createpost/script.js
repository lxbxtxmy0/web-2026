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
    const shareBtn = document.querySelector('.share');
    const form = document.querySelector('.create_post');
    shareBtn.disabled = true;

    function redirectClick() {
        fileInput.click();
    }

    blackBtn.addEventListener('click', redirectClick);
    blueBtn.addEventListener('click', redirectClick);

    function changeSlide(photoField, images, step) {
        const len = images.length;
        let idx = parseInt(photoField.getAttribute('data-current-index')) || 0;
        images[idx].classList.remove('active');
        idx = (idx + step + len) % len;
        images[idx].classList.add('active');
        photoField.setAttribute('data-current-index', idx);
    }

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function () {
                const imageUrl = this.result;
                const newImg = document.createElement('img');
                newImg.src = imageUrl;
                newImg.alt = "Фото";
                newImg.className = "preview_img";

                if (addBlock) {
                    addBlock.remove();
                }
                photoField.append(newImg);
                if (images.length > 0 && textArea.value.trim().length !== 0) {
                    shareBtn.classList.add('active');
                    shareBtn.disabled = false;
                }
                let currentIndexAttr = photoField.getAttribute('data-current-index') || "0";
                let imageIndex = parseInt(currentIndexAttr);

                if (images[imageIndex]) {
                    images[imageIndex].classList.add('active');
                }

                const len = images.length;
                if (len > 1) {
                    leftSlider.classList.add('active');
                    rightSlider.classList.add('active');
                }
            }
            reader.readAsDataURL(file);
        }
    });
    leftSlider.addEventListener('click', function () {
        changeSlide(photoField, images, 1)
    });
    rightSlider.addEventListener('click', function () {
        changeSlide(photoField, images, -1)
    });

    textArea.addEventListener('input', function () {
        if (this.value.trim().length !== 0 && images.length > 0) {
            shareBtn.classList.add('active');
            shareBtn.disabled = false;
        } else {
            shareBtn.classList.remove('active');
            shareBtn.disabled = true;
        }
    });

    form.addEventListener("submit", function(event) {
        event.preventDefault();
        for (const image of images) {
            console.log(image.src);
        }
        console.log(textArea.value);
    });

});