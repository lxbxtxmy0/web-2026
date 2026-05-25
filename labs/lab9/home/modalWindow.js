document.addEventListener('DOMContentLoaded', () => {
    const pageContainer = document.querySelector('.page');
    if (!pageContainer) return;

    const modalWindow = document.querySelector('.modal_window');
    if (!modalWindow) return;

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

    pageContainer.addEventListener('click', function (event) {
        const clickedImg = event.target.closest('.post .photos img');
        if (!clickedImg) return;

        const postPhotos = clickedImg.closest('.photos');
        const photoBlock = clickedImg.closest('.photo');
        modalPhotoBlock.setAttribute('data-current-index', photoBlock.getAttribute('data-current-index'));
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

    if (closeButton) {
        closeButton.addEventListener('click', closeModal);
    }
});