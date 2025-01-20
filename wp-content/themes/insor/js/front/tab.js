document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');
    const tabContents = document.querySelectorAll('.tab-pane');

    tabs.forEach(tab => {
        tab.addEventListener('click', (event) => {
            event.preventDefault();

            // Eliminar las clases 'active' de todos los tabs y contenidos
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('show', 'active'));

            // Activar el tab y el contenido asociado
            const target = document.querySelector(tab.getAttribute('data-bs-target'));
            tab.classList.add('active');
            target.classList.add('show', 'active');
        });
    });
});