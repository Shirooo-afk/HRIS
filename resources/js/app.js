import './bootstrap';

window.addEventListener('DOMContentLoaded', () => {
    const shell = document.querySelector('.app-shell');
    const toggle = document.querySelector('.sidebar-toggle');
    const topbar = document.querySelector('.topbar');
    const sidebar = document.querySelector('.sidebar');

    if (toggle && shell) {
        toggle.addEventListener('click', () => {
            shell.classList.toggle('sidebar-open');
        });
    }

    document.addEventListener('click', (event) => {
        if (!sidebar || !toggle || !shell.classList.contains('sidebar-open')) {
            return;
        }
        if (!sidebar.contains(event.target) && !toggle.contains(event.target)) {
            shell.classList.remove('sidebar-open');
        }
    });

    if (topbar) {
        window.addEventListener('scroll', () => {
            topbar.classList.toggle('topbar-elevated', window.scrollY > 16);
        });
    }
});
