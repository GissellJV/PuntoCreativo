(function () {
    'use strict';

    const CLAVE_CONSENTIMIENTO = 'pcCookieConsent';

    /**
     * Obtiene la preferencia guardada.
     *
     * Valores posibles:
     * accepted
     * rejected
     * null
     */
    function leerPreferencia() {
        try {
            return localStorage.getItem(
                CLAVE_CONSENTIMIENTO
            );
        } catch (error) {
            console.warn(
                'No se pudo leer la preferencia de cookies:',
                error
            );

            return null;
        }
    }

    /**
     * Guarda la preferencia del usuario.
     */
    function guardarPreferencia(valor) {
        try {
            localStorage.setItem(
                CLAVE_CONSENTIMIENTO,
                valor
            );
        } catch (error) {
            console.warn(
                'No se pudo guardar la preferencia de cookies:',
                error
            );
        }
    }

    /**
     * Inicializa el aviso de cookies.
     */
    function iniciarBannerCookies() {
        const banner = document.getElementById(
            'cookieConsent'
        );

        /*
         * Evita errores cuando una vista no contiene
         * el componente del aviso.
         */
        if (!banner) {
            return;
        }

        const botonAceptar = banner.querySelector(
            '[data-cookie-accept]'
        );

        const botonRechazar = banner.querySelector(
            '[data-cookie-reject]'
        );

        const botonesConfiguracion =
            document.querySelectorAll(
                '[data-cookie-settings]'
            );

        /**
         * Muestra el aviso en la parte inferior.
         */
        function mostrarBanner() {
            banner.hidden = false;

            document.body.classList.add(
                'cookie-banner-visible'
            );

            window.requestAnimationFrame(
                function () {
                    banner.classList.add(
                        'is-visible'
                    );
                }
            );
        }

        /**
         * Oculta el aviso con animación.
         */
        function ocultarBanner() {
            banner.classList.remove(
                'is-visible'
            );

            document.body.classList.remove(
                'cookie-banner-visible'
            );

            window.setTimeout(
                function () {
                    banner.hidden = true;
                },
                280
            );
        }

        /**
         * Guarda la decisión y cierra el aviso.
         */
        function establecerPreferencia(valor) {
            guardarPreferencia(valor);

            ocultarBanner();

            window.dispatchEvent(
                new CustomEvent(
                    'pc:cookies-changed',
                    {
                        detail: {
                            preference: valor
                        }
                    }
                )
            );
        }

        /*
         * Aceptar almacenamiento local.
         */
        if (botonAceptar) {
            botonAceptar.addEventListener(
                'click',
                function () {
                    establecerPreferencia(
                        'accepted'
                    );
                }
            );
        }

        /*
         * Rechazar almacenamiento opcional.
         */
        if (botonRechazar) {
            botonRechazar.addEventListener(
                'click',
                function () {
                    establecerPreferencia(
                        'rejected'
                    );
                }
            );
        }

        /*
         * Permite volver a abrir el aviso desde
         * el botón de configuración.
         */
        botonesConfiguracion.forEach(
            function (boton) {
                boton.addEventListener(
                    'click',
                    function () {
                        mostrarBanner();
                    }
                );
            }
        );

        /*
         * Solo aparece cuando el usuario todavía
         * no ha elegido aceptar o rechazar.
         */
        const preferencia = leerPreferencia();

        if (
            preferencia !== 'accepted' &&
            preferencia !== 'rejected'
        ) {
            mostrarBanner();
        }
    }

    /*
     * Ejecuta el código cuando el documento
     * ya esté disponible.
     */
    if (document.readyState === 'loading') {
        document.addEventListener(
            'DOMContentLoaded',
            iniciarBannerCookies
        );
    } else {
        iniciarBannerCookies();
    }
})();
