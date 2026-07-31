document.addEventListener('DOMContentLoaded', function () {
    const CLAVE_PEDIDO = 'pcUltimoPedido';
    const CLAVE_CARRITO = 'pcCart';
    const CLAVE_CUPON = 'pcCoupon';

    const contenedor =
        document.getElementById(
            'confirmationCard'
        );

    if (!contenedor) {
        return;
    }

    /*
     * Como el pedido ya fue confirmado,
     * dejamos el carrito vacío.
     */
    localStorage.removeItem(CLAVE_CARRITO);
    localStorage.removeItem(CLAVE_CUPON);

    /*
     * Mostrar cero en todos los contadores.
     */
    document
        .querySelectorAll('[data-cart-count]')
        .forEach(function (contador) {
            contador.textContent = '0';
        });

    function obtenerPedido() {
        try {
            return JSON.parse(
                localStorage.getItem(
                    CLAVE_PEDIDO
                )
            );
        } catch (error) {
            console.error(
                'No se pudo leer el pedido:',
                error
            );

            return null;
        }
    }

    function formatoMoneda(valor) {
        return new Intl.NumberFormat('es-HN', {
            style: 'currency',
            currency: 'HNL',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(Number(valor) || 0);
    }

    function escaparHtml(valor) {
        return String(valor ?? '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    function obtenerNombre(servicio) {
        return servicio.nombre ??
            servicio.name ??
            'Servicio';
    }

    function obtenerCantidad(servicio) {
        return Math.max(
            1,
            Number(
                servicio.cantidad ??
                servicio.qty ??
                1
            )
        );
    }

    function obtenerPrecio(servicio) {
        return Number(
            servicio.precio ??
            servicio.price ??
            0
        );
    }

    function obtenerImagen(servicio) {
        return servicio.imagen ??
            servicio.image ??
            '';
    }

    const pedido = obtenerPedido();

    if (!pedido) {
        contenedor.innerHTML = `
            <div class="confirmation-empty">

                <i class="bi bi-exclamation-circle"></i>

                <h2>
                    No encontramos una orden reciente
                </h2>

                <p>
                    Completa el proceso de compra para
                    visualizar aquí la confirmación.
                </p>

                <a
                    href="/catalogo"
                    class="btn btn-primary"
                >
                    <i class="bi bi-grid"></i>
                    Ir al catálogo
                </a>

            </div>
        `;

        return;
    }

    const fechaPedido = pedido.fecha
        ? new Date(pedido.fecha)
        : new Date();

    const fechaFormateada =
        new Intl.DateTimeFormat(
            'es-HN',
            {
                dateStyle: 'long',
                timeStyle: 'short'
            }
        ).format(fechaPedido);

    const servicios =
        Array.isArray(pedido.servicios)
            ? pedido.servicios
            : [];

    const metodoPago =
        pedido.metodoPago === 'paypal'
            ? 'PayPal'
            : pedido.metodoPago ||
            'Pago de demostración';

    const estado =
        pedido.estado || 'RECIBIDO';

    contenedor.innerHTML = `
        <section class="confirmation-success">

            <div class="confirmation-icon">
                <i class="bi bi-check-lg"></i>
            </div>

            <span class="confirmation-status">
                <i class="bi bi-check-circle-fill"></i>
                Pedido recibido
            </span>

            <h2>
                ¡Pedido confirmado!
            </h2>

            <p>
                Gracias,
                <strong>
                    ${escaparHtml(
        pedido.cliente?.nombre ||
        'cliente'
    )}
                </strong>.
                Hemos recibido correctamente
                tu solicitud.
            </p>

        </section>

        <section class="order-information">

            <div>
                <span>Número de pedido</span>

                <strong>
                    ${escaparHtml(
        pedido.numero || 'Sin número'
    )}
                </strong>
            </div>

            <div>
                <span>Fecha</span>

                <strong>
                    ${escaparHtml(fechaFormateada)}
                </strong>
            </div>

            <div>
                <span>Estado</span>

                <strong class="status-completed">
                    ${escaparHtml(estado)}
                </strong>
            </div>

            <div>
                <span>Método de pago</span>

                <strong>
                    <i class="bi bi-wallet2"></i>
                    ${escaparHtml(metodoPago)}
                </strong>
            </div>

        </section>

        <section class="confirmation-products">

            <div class="confirmation-section-title">

                <div>
                    <span>Detalles</span>

                    <h3>
                        Resumen de compra
                    </h3>
                </div>

                <i class="bi bi-receipt"></i>

            </div>

            <div class="confirmation-product-list">

                ${
        servicios.length
            ? servicios.map(
                function (servicio) {
                    const nombre =
                        escaparHtml(
                            obtenerNombre(
                                servicio
                            )
                        );

                    const cantidad =
                        obtenerCantidad(
                            servicio
                        );

                    const precio =
                        obtenerPrecio(
                            servicio
                        );

                    const imagen =
                        escaparHtml(
                            obtenerImagen(
                                servicio
                            )
                        );

                    const subtotal =
                        precio * cantidad;

                    const contenidoImagen =
                        imagen
                            ? `
                                            <img
                                                src="${imagen}"
                                                alt="${nombre}"
                                            >
                                        `
                            : `
                                            <i class="bi bi-image"></i>
                                        `;

                    return `
                                    <article
                                        class="confirmation-product"
                                    >

                                        <div
                                            class="confirmation-product-image"
                                        >
                                            ${contenidoImagen}
                                        </div>

                                        <div
                                            class="confirmation-product-content"
                                        >
                                            <strong>
                                                ${nombre}
                                            </strong>

                                            <small>
                                                Cantidad:
                                                ${cantidad}
                                            </small>
                                        </div>

                                        <span
                                            class="confirmation-product-price"
                                        >
                                            ${formatoMoneda(
                        subtotal
                    )}
                                        </span>

                                    </article>
                                `;
                }
            ).join('')
            : `
                            <p style="color:var(--muted)">
                                No hay servicios registrados
                                en este pedido.
                            </p>
                        `
    }

            </div>

            <div class="confirmation-total">

                <span>
                    Total pagado
                </span>

                <strong>
                    ${formatoMoneda(
        pedido.totales?.total
    )}
                </strong>

            </div>

        </section>

        <section class="confirmation-next">

            <div class="confirmation-section-title">

                <div>
                    <span>Información</span>

                    <h3>
                        Próximos pasos
                    </h3>
                </div>

                <i class="bi bi-list-check"></i>

            </div>

            <ol>
                <li>
                    Recibirás la confirmación en
                    <strong>
                        ${escaparHtml(
        pedido.cliente?.correo ||
        'el correo proporcionado'
    )}
                    </strong>.
                </li>

                <li>
                    Nuestro equipo revisará los
                    detalles de tu solicitud.
                </li>

                <li>
                    Te contactaremos para confirmar
                    la información del servicio.
                </li>

                <li>
                    El tiempo de entrega dependerá
                    del servicio contratado.
                </li>
            </ol>

            <div class="confirmation-actions">

                <a
                    href="/catalogo"
                    class="btn btn-primary"
                >
                    <i class="bi bi-bag-plus"></i>
                    Seguir comprando
                </a>

                <a
                    href="https://wa.me/50400000000"
                    target="_blank"
                    rel="noopener"
                    class="btn btn-secondary"
                >
                    <i class="bi bi-whatsapp"></i>
                    Soporte por WhatsApp
                </a>

            </div>

        </section>
    `;
});
