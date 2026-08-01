document.addEventListener('DOMContentLoaded', function () {
    /*
     * Ocultar automáticamente las alertas
     * después de cinco segundos.
     */
    const alerts = document.querySelectorAll(
        '.alert-success, .alert-error, .auth-alert'
    );

    alerts.forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';

            setTimeout(function () {
                alert.remove();
            }, 500);
        }, 5000);
    });

    /*
     * Obtener el modal.
     * Algunas vistas podrían no incluirlo.
     */
    const modal = document.getElementById('authModal');

    if (!modal) {
        return;
    }

    const openButtons = document.querySelectorAll('[data-auth-open]');
    const closeButtons = document.querySelectorAll('[data-auth-close]');
    const panelLinks = document.querySelectorAll('[data-auth-tab]');
    const panels = document.querySelectorAll('[data-auth-panel]');

    /*
     * Mostrar el formulario seleccionado:
     * login o register.
     */
    function activatePanel(panelName) {
        panels.forEach(function (panel) {
            const isActive = panel.dataset.authPanel === panelName;

            panel.classList.toggle('active', isActive);
        });
    }

    /*
     * Abrir el modal.
     */
    function openModal(panelName = 'login') {
        const validPanel =
            panelName === 'register' ? 'register' : 'login';

        activatePanel(validPanel);

        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('auth-modal-visible');
    }

    /*
     * Cerrar el modal.
     */
    function closeModal() {
        modal.classList.remove('open');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('auth-modal-visible');
    }

    /*
     * Botones de Mi cuenta.
     */
    openButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            openModal('login');
        });
    });

    /*
     * Botón X y fondo oscuro.
     */
    closeButtons.forEach(function (button) {
        button.addEventListener('click', closeModal);
    });

    /*
     * Cambiar entre iniciar sesión y registrarse.
     */
    panelLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            activatePanel(link.dataset.authTab);
        });
    });

    /*
     * Cerrar al presionar Escape.
     */
    document.addEventListener('keydown', function (event) {
        if (
            event.key === 'Escape' &&
            modal.classList.contains('open')
        ) {
            closeModal();
        }
    });

    /*
     * Abrir automáticamente el formulario correcto
     * cuando Laravel devuelve errores.
     */
    const initialPanel = modal.dataset.initialPanel;

    if (initialPanel === 'login' || initialPanel === 'register') {
        openModal(initialPanel);
    }
});
