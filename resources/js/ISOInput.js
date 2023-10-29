const fileUploads = document.querySelectorAll('input[type=file]');

fileUploads.forEach(fileUpload => {
    fileUpload.addEventListener('change', () => {
        fileUpload.closest('label').querySelector('p').innerText = fileUpload.files[0].name;
    });
})