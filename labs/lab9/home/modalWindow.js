document.addEventListener('DOMContentLoaded', () => {
    const modalWindow = document.querySelector('.modal_window');
    const modalPhotoBlock = modalWindow.querySelector('.photo');
    const modalPhotosContainer = modalWindow.querySelector('.photo .photos');
    const closeButton = modalWindow.querySelector('.close_button');
    function closeModal() {
        modalWindow.classList.remove('active');
        modalPhotosContainer.innerHTML = '';
        document.body.classList.remove('no-scroll');
        document.removeEventListener('keydown', handleEscapeKey);
    }
    function handleEscapeKey(event) {
        if (event.key === 'Escape') {
            closeModal();
        }
    }
    const postImages = document.querySelectorAll('.post .photos img');
    postImages.forEach((img) => {
        img.addEventListener('click', function () {
            const postPhotos = img.closest('.photos');
            const originalImages = postPhotos.children;
            modalPhotosContainer.innerHTML = '';
            for (const image of originalImages) {
                const cloneImage = image.cloneNode(true);
                cloneImage.setAttribute('height', '636');
                cloneImage.setAttribute('width', '636');
                modalPhotosContainer.append(cloneImage);
            }
            initSlider(modalPhotoBlock, ' из ');
            document.body.classList.add('no-scroll');
            modalWindow.classList.add('active');
            document.addEventListener('keydown', handleEscapeKey);
        });
    });
    if (closeButton) {
        closeButton.addEventListener('click', closeModal);
    }
});