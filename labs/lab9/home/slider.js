function changeSlide(currentIndex, images, indicator, len, step, separator) {
    images[currentIndex].classList.remove('active');
    currentIndex = (currentIndex + step + len) % len;
    images[currentIndex].classList.add('active');
    if (indicator) {
        indicator.innerHTML = "" + (currentIndex + 1) + separator + len;
    }
    return currentIndex;
}
function initSlider(photoBlock, separator) {
    const images = photoBlock.querySelector('.photos').children;
    const len = images.length;
    let currentIndex = 0;
    images[currentIndex].classList.add('active');
    const indicator = photoBlock.querySelector('.count_photos') || photoBlock.parentElement.querySelector('.modal_count_photos');
    const leftSlider = photoBlock.querySelector('.slider_left, .modal_slider_left');
    const rightSlider = photoBlock.querySelector('.slider_right, .modal_slider_right');
    if (indicator) {
        if (len > 1) {
            indicator.innerHTML = "" + (currentIndex + 1) + separator + len;
            indicator.classList.remove('hidden');
        } else {
            indicator.innerHTML = "";
            indicator.classList.add('hidden');
        }
    }
    if (len <= 1) {
        if (leftSlider) {
            leftSlider.classList.add('hidden');
        }
        if (rightSlider) {
            rightSlider.classList.add('hidden');
        }
        return;
    }
    if (leftSlider) {
        leftSlider.classList.remove('hidden');
    }
    if (rightSlider) {
        rightSlider.classList.remove('hidden');
    }
    if (leftSlider && !leftSlider.dataset.hasListener) {
        leftSlider.addEventListener("click", function () {
            currentIndex = changeSlide(currentIndex, images, indicator, len, -1, separator);
        });
        leftSlider.dataset.hasListener = "true";
    }
    if (rightSlider && !rightSlider.dataset.hasListener) {
        rightSlider.addEventListener("click", function () {
            currentIndex = changeSlide(currentIndex, images, indicator, len, 1, separator);
        });
        rightSlider.dataset.hasListener = "true";
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const posts = document.querySelectorAll('.post .photo');
    posts.forEach((photoBlock) => {
        initSlider(photoBlock, '/');
    });
});