import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.querySelector('.sidebar');
    document.querySelector('[data-sidebar-toggle]')?.addEventListener('click', () => sidebar?.classList.toggle('show'));
    document.querySelector('.sidebar-backdrop')?.addEventListener('click', () => sidebar?.classList.remove('show'));
    document.querySelectorAll('[data-confirm]').forEach((button) => button.addEventListener('click', (event) => {
        if (!window.confirm(button.dataset.confirm || 'Are you sure?')) event.preventDefault();
    }));
});
