window.addEventListener('load', () => {
    const fileInput = document.querySelectorAll('input[type=file]');

    fileInput.forEach((element) => {
        element.addEventListener('change', (event) => {
            const parent = event.currentTarget.parentNode;
            const reader = new FileReader();

            if (parent.dataset.type === 'image') {
                const thumbnail = parent.querySelector('[data-file-part="thumbnail"]');
                const cta = parent.querySelector('[data-file-part="cta"]');

                reader.onloadend = () => {
                    if (thumbnail) {
                        thumbnail.src = reader.result;
                    } else {
                        const thumbnailElement = Object.assign(document.createElement('img'), {
                            src: reader.result,
                            className: ' object-cover p-10'
                            // tinanggal ko muna aspect-square
                        });
                        thumbnailElement.setAttribute('data-file-part', 'thumbnail');

                        parent.append(thumbnailElement);
                    }

                    cta.classList.add('hidden');
                }

                if (event.currentTarget.files[0]) {
                    reader.readAsDataURL(event.currentTarget.files[0]);
                }
            }
        });
    });
});