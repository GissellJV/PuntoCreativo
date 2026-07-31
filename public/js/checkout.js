document.addEventListener('DOMContentLoaded', function () {
    const CLAVE_CARRITO = 'pcCart';
    const CLAVE_CUPON = 'pcCoupon';
    const CLAVE_PEDIDO = 'pcUltimoPedido';

    const formulario =
        document.getElementById('checkoutForm');

    const contenedorServicios =
        document.getElementById('checkoutItems');

    const subtotalElemento =
        document.getElementById('checkoutSubtotal');

    const descuentoElemento =
        document.getElementById('checkoutDiscount');

    const impuestoElemento =
        document.getElementById('checkoutTax');

    const totalElemento =
        document.getElementById('checkoutTotal');

    function obtenerCarrito() {
        try {
            const carrito = JSON.parse(
                localStorage.getItem(CLAVE_CARRITO)
            ) || [];

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

    function obtenerNombre(servicio) {
        return servicio.nombre ??
            servicio.name ??
            'Servicio';
    }

    function obtenerPrecio(servicio) {
        return Number(
            servicio.precio ??
            servicio.price ??
            0
        );
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

    function obtenerImagen(servicio) {
        return servicio.imagen ??
            servicio.image ??
            '';
    }

    function formatoMoneda(valor) {
        return new Intl.NumberFormat('es-HN', {
            style: 'currency',
            currency: 'HNL',
            minimumFractionDigits: 2
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

    function calcularTotales(carrito) {
        const subtotal = carrito.reduce(
            function (total, servicio) {
                return total +
                    obtenerPrecio(servicio) *
                    obtenerCantidad(servicio);
            },
            0
        );

        const cupon = (
            localStorage.getItem(CLAVE_CUPON) || ''
        ).trim().toUpperCase();

        const descuento =
            cupon === 'CREATIVO10'
                ? subtotal * 0.10
                : 0;

        const baseImponible =
            subtotal - descuento;

        const impuesto =
            baseImponible * 0.15;

        return {
            subtotal,
            descuento,
            impuesto,
            total: baseImponible + impuesto
        };
    }

    function renderizarResumen() {
        const carrito = obtenerCarrito();
        const totales = calcularTotales(carrito);

        if (!contenedorServicios) {
            return;
        }

        if (carrito.length === 0) {
            contenedorServicios.innerHTML = `
                <div class="empty-checkout">
                    <i class="bi bi-cart-x"></i>
                    <p>No hay servicios en el carrito.</p>
                </div>
            `;
        } else {
            contenedorServicios.innerHTML =
                carrito.map(function (servicio) {
                    const nombre = escaparHtml(
                        obtenerNombre(servicio)
                    );

                    const imagen = escaparHtml(
                        obtenerImagen(servicio)
                    );

                    const cantidad =
                        obtenerCantidad(servicio);

                    const subtotal =
                        obtenerPrecio(servicio) *
                        cantidad;

                    return `
                        <article class="checkout-item">

                            <div class="checkout-item-image">
                                ${
                        imagen
                            ? `
                                            <img
                                                src="${imagen}"
                                                alt="${nombre}"
                                            >
                                        `
                            : `
                                            <i class="bi bi-image"></i>
                                        `
                    }
                            </div>

                            <div class="checkout-item-content">

                                <div class="checkout-item-name">
                                    ${nombre}
                                </div>

                                <div class="checkout-item-details">
                                    <span>
                                        Cantidad: ${cantidad}
                                    </span>

                                    <strong>
                                        ${formatoMoneda(subtotal)}
                                    </strong>
                                </div>

                            </div>

                        </article>
                    `;
                }).join('');
        }

        subtotalElemento.textContent =
            formatoMoneda(totales.subtotal);

        descuentoElemento.textContent =
            '− ' + formatoMoneda(
                totales.descuento
            );

        impuestoElemento.textContent =
            formatoMoneda(totales.impuesto);

        totalElemento.textContent =
            formatoMoneda(totales.total);
    }

    function obtenerDatosCliente() {
        return {
            nombre:
                document
                    .getElementById('nombre')
                    ?.value.trim() || '',

            apellido:
                document
                    .getElementById('apellido')
                    ?.value.trim() || '',

            correo:
                document
                    .getElementById('correo')
                    ?.value.trim() || '',

            telefono:
                document
                    .getElementById('telefono')
                    ?.value.trim() || '',

            empresa:
                document
                    .getElementById('empresa')
                    ?.value.trim() || '',

            notas:
                document
                    .getElementById('notas')
                    ?.value.trim() || ''
        };
    }

    function generarNumeroPedido() {
        const fecha = new Date();

        const fechaTexto =
            fecha.getFullYear().toString() +
            String(fecha.getMonth() + 1).padStart(2, '0') +
            String(fecha.getDate()).padStart(2, '0');

        const aleatorio =
            Math.floor(1000 + Math.random() * 9000);

        return `PC-${fechaTexto}-${aleatorio}`;
    }

    if (formulario) {
        formulario.addEventListener(
            'submit',
            function (evento) {
                evento.preventDefault();

                const carrito =
                    obtenerCarrito();

                if (carrito.length === 0) {
                    alert(
                        'Tu carrito está vacío.'
                    );

                    return;
                }

                if (!formulario.checkValidity()) {
                    formulario.reportValidity();

                    return;
                }

                const totales =
                    calcularTotales(carrito);

                const metodoPago =
                    document.querySelector(
                        'input[name="metodo_pago"]:checked'
                    )?.value || 'paypal';

                const pedido = {
                    numero:
                        generarNumeroPedido(),

                    estado:
                        'RECIBIDO',

                    fecha:
                        new Date().toISOString(),

                    cliente:
                        obtenerDatosCliente(),

                    metodoPago:
                    metodoPago,

                    servicios:
                    carrito,

                    totales:
                    totales
                };

                localStorage.setItem(
                    CLAVE_PEDIDO,
                    JSON.stringify(pedido)
                );

                localStorage.removeItem(
                    CLAVE_CARRITO
                );

                localStorage.removeItem(
                    CLAVE_CUPON
                );

                window.location.href =
                    '/confirmacion';
            }
        );
    }

    renderizarResumen();
});
