(function () {
    'use strict';

    const CLAVE_CARRITO = 'pcCart';

    function obtenerCarrito() {
        try {
            const contenido =
                localStorage.getItem(CLAVE_CARRITO);

            if (!contenido) {
                return [];
            }

            const carrito =
                JSON.parse(contenido);

            return Array.isArray(carrito)
                ? carrito
                : [];
        } catch (error) {
            console.error(
                'No se pudo leer el carrito:',
                error
            );

            return [];
        }
    }

    function obtenerCantidad(producto) {
        const cantidad = Number(
            producto?.cantidad ??
            producto?.quantity ??
            producto?.qty ??
            1
        );

        /*
         * Evita que aparezca NaN, números negativos
         * o cantidades que no sean válidas.
         */
        if (
            !Number.isFinite(cantidad) ||
            cantidad <= 0
        ) {
            return 1;
        }

        return cantidad;
    }

    function calcularCantidadTotal() {
        return obtenerCarrito().reduce(
            function (total, producto) {
                return total +
                    obtenerCantidad(producto);
            },
            0
        );
    }

    function actualizarContadorCarrito() {
        const cantidadTotal =
            calcularCantidadTotal();

        document
            .querySelectorAll('[data-cart-count]')
            .forEach(function (contador) {
                contador.textContent =
                    String(cantidadTotal);

                contador.setAttribute(
                    'aria-label',
                    cantidadTotal +
                    ' servicios en el carrito'
                );

                contador.classList.toggle(
                    'cart-badge-empty',
                    cantidadTotal === 0
                );
            });

        return cantidadTotal;
    }

    /*
     * Disponible para utilizarlo desde producto.js,
     * carrito.js, checkout.js u otras vistas.
     */
    window.actualizarContadorCarrito =
        actualizarContadorCarrito;

    /*
     * Ejecutar al cargar cualquier vista.
     */
    if (
        document.readyState === 'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            actualizarContadorCarrito
        );
    } else {
        actualizarContadorCarrito();
    }

    /*
     * Actualizar cuando cambia localStorage
     * desde otra pestaña.
     */
    window.addEventListener(
        'storage',
        function (evento) {
            if (
                evento.key === CLAVE_CARRITO
            ) {
                actualizarContadorCarrito();
            }
        }
    );

    /*
     * Evento personalizado para actualizarlo
     * inmediatamente en la misma página.
     */
    window.addEventListener(
        'pc:cart-updated',
        actualizarContadorCarrito
    );
})();
