class Modal {
    constructor(element) {
        this.modal = document.querySelector(element);
        this.initEvents();
    }

    initEvents() {
        // Abrir modal
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
            button.addEventListener('click', () => this.show());
        });

        if (this.modal != null) {
            // Cerrar modal
            this.modal.querySelector('[data-bs-dismiss="modal"]').addEventListener('click', () => this.hide());

            // Cerrar con click fuera del modal
            this.modal.addEventListener('click', (event) => {
                if (event.target === this.modal) {
                    this.hide();
                }
            });
        }
    }

    show() {
        if (this.modal != null) {
            this.modal.classList.add('show');
            document.querySelector(".modal-backdrop").classList.add('show');
            document.querySelector(".modal-backdrop").style.display = 'block';
            this.modal.style.display = 'block';
            document.body.classList.add('modal-open');
        }
    }

    hide() {
        if (this.modal != null) {
            this.modal.classList.remove('show');
            document.querySelector(".modal-backdrop").classList.remove('show');
            document.querySelector(".modal-backdrop").style.display = 'none';
            this.modal.style.display = 'none';
            document.body.classList.remove('modal-open');
        }
    }
}

// Inicializar el modal
document.addEventListener('DOMContentLoaded', () => {
    const modal = new Modal('#modalInicio');
    modal.show();
});
