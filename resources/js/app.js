import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const flashAlert = document.getElementById('eventra-flash-alert');

    if (!flashAlert) {
        return;
    }

    setTimeout(() => {
        flashAlert.classList.add('is-hidden');

        setTimeout(() => {
            flashAlert.remove();
        }, 260);
    }, 3000);
});