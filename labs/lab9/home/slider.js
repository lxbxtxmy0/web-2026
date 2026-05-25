function changeSlide(photoBlock, images, indicator, len, step, separator) {
    let idx = parseInt(photoBlock.getAttribute('data-current-index')) || 0;
    images[idx].classList.remove('active');
    idx = (idx + step + len) % len;
    images[idx].classList.add('active');
    photoBlock.setAttribute('data-current-index', idx);
    if (indicator) {
        indicator.innerHTML = "" + (idx + 1) + separator + len;
    }
}

function initSlider(photoBlock, separator) {
    const images = photoBlock.querySelector('.photos').children;
    let imageIndex = parseInt(photoBlock.getAttribute('data-current-index')) || 0;

    const len = images.length;
    if (len === 0) return;

    images[imageIndex].classList.add('active');

    const indicator = photoBlock.querySelector('.count_photos')
        || photoBlock.parentElement.querySelector('.modal_count_photos');

    const leftSlider = photoBlock.querySelector('.slider_left, .modal_slider_left');
    const rightSlider = photoBlock.querySelector('.slider_right, .modal_slider_right');

    if (indicator) {
        if (len > 1) {
            indicator.innerHTML = "" + (imageIndex + 1) + separator + len;
            indicator.classList.remove('hidden');
        } else {
            indicator.innerHTML = "";
            indicator.classList.add('hidden');
        }
    }

    if (len <= 1) {
        if (leftSlider) leftSlider.classList.add('hidden');
        if (rightSlider) rightSlider.classList.add('hidden');
        return;
    }

    if (leftSlider) leftSlider.classList.remove('hidden');
    if (rightSlider) rightSlider.classList.remove('hidden');

    if (leftSlider && !leftSlider.dataset.hasListener) {
        leftSlider.addEventListener("click", function () {
            changeSlide(photoBlock, images, indicator, len, -1, separator);
        });
        leftSlider.dataset.hasListener = "true";
    }

    if (rightSlider && !rightSlider.dataset.hasListener) {
        rightSlider.addEventListener("click", function () {
            changeSlide(photoBlock, images, indicator, len, 1, separator);
        });
        rightSlider.dataset.hasListener = "true";
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const posts = document.querySelectorAll('.post .photo');
    posts.forEach(photoBlock => initSlider(photoBlock, '/'));
});