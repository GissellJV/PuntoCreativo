document.addEventListener('DOMContentLoaded', function () {
    const toggle =
        document.querySelector('.menu-toggle');

    const nav =
        document.getElementById('navLinks');

    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            const abierto =
                nav.classList.toggle('open');

            toggle.setAttribute(
                'aria-expanded',
                String(abierto)
            );

            toggle.textContent =
                abierto ? '×' : '☰';
        });

        nav.querySelectorAll('a').forEach(
            function (enlace) {
                enlace.addEventListener(
                    'click',
                    function () {
                        nav.classList.remove('open');

                        toggle.textContent = '☰';

                        toggle.setAttribute(
                            'aria-expanded',
                            'false'
                        );
                    }
                );
            }
        );
    }

    document
        .querySelectorAll('[data-year]')
        .forEach(function (elemento) {
            elemento.textContent =
                new Date().getFullYear();
        });

    /*
     * Actualizar el contador del carrito
     * en todas las vistas.
     */
    function actualizarContadorGeneral() {
        try {
            const carrito = JSON.parse(
                localStorage.getItem('pcCart')
            ) || [];

            const cantidadTotal =
                Array.isArray(carrito)
                    ? carrito.reduce(
                        function (total, servicio) {
                            return total + Number(
                                servicio.cantidad ??
                                servicio.qty ??
                                0
                            );
                        },
                        0
                    )
                    : 0;

            document
                .querySelectorAll(
                    '[data-cart-count]'
                )
                .forEach(function (contador) {
                    contador.textContent =
                        cantidadTotal;
                });
        } catch (error) {
            console.error(
                'No se pudo actualizar el contador:',
                error
            );

            document
                .querySelectorAll(
                    '[data-cart-count]'
                )
                .forEach(function (contador) {
                    contador.textContent = '0';
                });
        }
    }

    actualizarContadorGeneral();

    /*
     * Ejecutar funciones de PCStore
     * solamente cuando el objeto exista.
     */
    if (typeof PCStore !== 'undefined') {
        if (
            typeof PCStore.bindSearch ===
            'function'
        ) {
            PCStore.bindSearch();
        }

        if (
            typeof PCStore.initCookieBanner ===
            'function'
        ) {
            PCStore.initCookieBanner();
        }
    }

    if ('IntersectionObserver' in window) {
        const observador =
            new IntersectionObserver(
                function (entradas) {
                    entradas.forEach(
                        function (entrada) {
                            if (
                                entrada.isIntersecting
                            ) {
                                entrada.target
                                    .classList
                                    .add('visible');

                                observador.unobserve(
                                    entrada.target
                                );
                            }
                        }
                    );
                },
                {
                    threshold: 0.08
                }
            );

        document
            .querySelectorAll('.reveal')
            .forEach(function (elemento) {
                observador.observe(elemento);
            });
    } else {
        document
            .querySelectorAll('.reveal')
            .forEach(function (elemento) {
                elemento.classList.add(
                    'visible'
                );
            });
    }
});
