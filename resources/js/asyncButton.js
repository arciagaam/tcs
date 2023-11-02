const buttons = document.querySelectorAll('button.async');

buttons.forEach(btn => {
    btn.addEventListener('click', () => {

        setTimeout(() => {
            btn.disabled = true;
            btn.innerText = 'Please wait';
        }, 50)
    });
})