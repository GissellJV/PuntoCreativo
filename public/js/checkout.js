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

    const contenedorPayPal =
        document.getElementById(
            'paypalButtonContainer'
        );

    const mensajePayPal =
        document.getElementById(
            'paypalMessage'
        );

    const camposTarjeta =
        document.getElementById(
            'cardFields'
        );

    let botonesPayPalRenderizados = false;

    /**
     * Leer el carrito guardado.
     */
    function obtenerCarrito() {
        try {
            const contenido =
                localStorage.getItem(
                    CLAVE_CARRITO
                );

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

    function obtenerIdServicio(servicio) {
        return Number(
            servicio.servicio_id ??
            servicio.id ??
            0
        );
    }

    function obtenerNombre(servicio) {
        return (
            servicio.nombre ??
            servicio.name ??
            'Servicio'
        );
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
                servicio.quantity ??
                servicio.qty ??
                1
            )
        );
    }

    function obtenerImagen(servicio) {
        return (
            servicio.imagen ??
            servicio.image ??
            servicio.imagen_principal ??
            ''
        );
    }

    function escaparHtml(valor) {
        return String(valor ?? '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    function formatoMoneda(valor) {
        return new Intl.NumberFormat(
            'es-HN',
            {
                style: 'currency',
                currency: 'HNL',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }
        ).format(Number(valor) || 0);
    }

    /**
     * Calcular totales en lempiras.
     */
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
            localStorage.getItem(
                CLAVE_CUPON
            ) || ''
        )
            .trim()
            .toUpperCase();

        const descuento =
            cupon === 'CREATIVO10'
                ? subtotal * 0.10
                : 0;

        const baseImponible =
            subtotal - descuento;

        const impuesto =
            baseImponible * 0.15;

        const total =
            baseImponible + impuesto;

        return {
            subtotal,
            descuento,
            impuesto,
            total
        };
    }

    /**
     * Mostrar los servicios del carrito.
     */
    function renderizarResumen() {
        const carrito =
            obtenerCarrito();

        const totales =
            calcularTotales(carrito);

        if (!contenedorServicios) {
            console.error(
                'No se encontró checkoutItems.'
            );

            return;
        }

        if (carrito.length === 0) {
            contenedorServicios.innerHTML = `
                <div class="empty-checkout">
                    <i class="bi bi-cart-x"></i>

                    <p>
                        No hay servicios en el carrito.
                    </p>
                </div>
            `;

            if (contenedorPayPal) {
                contenedorPayPal.style.display =
                    'none';
            }
        } else {
            contenedorServicios.innerHTML =
                carrito.map(function (servicio) {
                    const nombre =
                        escaparHtml(
                            obtenerNombre(servicio)
                        );

                    const imagen =
                        escaparHtml(
                            obtenerImagen(servicio)
                        );

                    const cantidad =
                        obtenerCantidad(servicio);

                    const subtotal =
                        obtenerPrecio(servicio) *
                        cantidad;

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
                        <article class="checkout-item">

                            <div class="checkout-item-image">
                                ${contenidoImagen}
                            </div>

                            <div class="checkout-item-content">

                                <div class="checkout-item-name">
                                    ${nombre}
                                </div>

                                <div class="checkout-item-details">

                                    <span>
                                        Cantidad:
                                        ${cantidad}
                                    </span>

                                    <strong>
                                        ${formatoMoneda(
                        subtotal
                    )}
                                    </strong>

                                </div>

                            </div>

                        </article>
                    `;
                }).join('');
        }

        if (subtotalElemento) {
            subtotalElemento.textContent =
                formatoMoneda(
                    totales.subtotal
                );
        }

        if (descuentoElemento) {
            descuentoElemento.textContent =
                '− ' +
                formatoMoneda(
                    totales.descuento
                );
        }

        if (impuestoElemento) {
            impuestoElemento.textContent =
                formatoMoneda(
                    totales.impuesto
                );
        }

        if (totalElemento) {
            totalElemento.textContent =
                formatoMoneda(
                    totales.total
                );
        }
    }

    /**
     * Obtener los datos escritos por el cliente.
     */
    function obtenerDatosCliente() {
        return {
            nombre:
                document
                    .getElementById('nombre')
                    ?.value
                    .trim() || '',

            apellido:
                document
                    .getElementById('apellido')
                    ?.value
                    .trim() || '',

            correo:
                document
                    .getElementById('correo')
                    ?.value
                    .trim() || '',

            telefono:
                document
                    .getElementById('telefono')
                    ?.value
                    .trim() || '',

            empresa:
                document
                    .getElementById('empresa')
                    ?.value
                    .trim() || '',

            notas:
                document
                    .getElementById('notas')
                    ?.value
                    .trim() || ''
        };
    }

    function obtenerMetodoPago() {
        return document.querySelector(
            'input[name="metodo_pago"]:checked'
        )?.value || '';
    }

    function obtenerTokenCsrf() {
        return document
            .querySelector(
                'meta[name="csrf-token"]'
            )
            ?.getAttribute('content') || '';
    }

    function prepararItems(carrito) {
        return carrito.map(
            function (servicio) {
                return {
                    servicio_id:
                        obtenerIdServicio(
                            servicio
                        ),

                    cantidad:
                        obtenerCantidad(
                            servicio
                        )
                };
            }
        );
    }

    /**
     * Validar el formulario.
     */
    function validarFormulario() {
        if (!formulario) {
            mostrarMensaje(
                'No se encontró el formulario.',
                'error'
            );

            return false;
        }

        if (!formulario.checkValidity()) {
            formulario.reportValidity();

            mostrarMensaje(
                'Completa los campos obligatorios.',
                'error'
            );

            return false;
        }

        return true;
    }

    /**
     * Mostrar mensajes debajo de PayPal.
     */
    function mostrarMensaje(
        mensaje,
        tipo = ''
    ) {
        if (!mensajePayPal) {
            return;
        }

        mensajePayPal.textContent =
            mensaje;

        mensajePayPal.classList.remove(
            'error',
            'success'
        );

        if (tipo) {
            mensajePayPal.classList.add(
                tipo
            );
        }
    }

    /**
     * Enviar una petición JSON a Laravel.
     */
    async function enviarJson(
        url,
        datos = {}
    ) {
        if (!url) {
            throw new Error(
                'La dirección del servidor no está configurada.'
            );
        }

        const respuesta = await fetch(
            url,
            {
                method: 'POST',

                credentials: 'same-origin',

                headers: {
                    'Content-Type':
                        'application/json',

                    'Accept':
                        'application/json',

                    'X-Requested-With':
                        'XMLHttpRequest',

                    'X-CSRF-TOKEN':
                        obtenerTokenCsrf()
                },

                body:
                    JSON.stringify(datos)
            }
        );

        let resultado;

        try {
            resultado =
                await respuesta.json();
        } catch (error) {
            console.error(
                'Respuesta no JSON:',
                error
            );

            throw new Error(
                'El servidor devolvió una respuesta no válida.'
            );
        }

        if (!respuesta.ok) {
            const errores =
                resultado.errors
                    ? Object
                        .values(
                            resultado.errors
                        )
                        .flat()
                        .join('\n')
                    : resultado.message;

            throw new Error(
                errores ||
                'La solicitud no pudo completarse.'
            );
        }

        return resultado;
    }

    /**
     * Guardar el pedido en MySQL.
     *
     * Se ejecuta únicamente después de que
     * PayPal confirme el pago.
     */
    async function guardarPedido(
        carrito,
        datosPayPal
    ) {
        const cliente =
            obtenerDatosCliente();

        const items =
            prepararItems(carrito);

        const servicioInvalido =
            items.some(function (item) {
                return (
                    !Number.isInteger(
                        item.servicio_id
                    ) ||
                    item.servicio_id <= 0
                );
            });

        if (servicioInvalido) {
            throw new Error(
                'Uno de los servicios no tiene un ID válido.'
            );
        }

        const referenciaPago =
            datosPayPal.captureId ||
            datosPayPal.orderId;

        if (!referenciaPago) {
            throw new Error(
                'No se recibió la referencia del pago.'
            );
        }

        const cupon = (
            localStorage.getItem(
                CLAVE_CUPON
            ) || ''
        ).trim();

        const urlGuardar =
            window.PUNTO_CREATIVO
                ?.guardarPedidoUrl;

        const respuesta =
            await enviarJson(
                urlGuardar,
                {
                    nombre_cliente:
                    cliente.nombre,

                    email_cliente:
                    cliente.correo,

                    notas:
                        cliente.notas || null,

                    metodo_pago:
                        'paypal',

                    referencia_pago:
                    referenciaPago,

                    cupon:
                        cupon || null,

                    items:
                    items
                }
            );

        return {
            respuesta,
            cliente
        };
    }

    /**
     * Marcar visualmente el método seleccionado.
     */
    function actualizarMetodoPago() {
        const metodo =
            obtenerMetodoPago();

        document
            .querySelectorAll(
                '.payment-option'
            )
            .forEach(function (opcion) {
                const radio =
                    opcion.querySelector(
                        'input[type="radio"]'
                    );

                opcion.classList.toggle(
                    'selected',
                    Boolean(radio?.checked)
                );
            });

        if (camposTarjeta) {
            camposTarjeta.hidden =
                metodo !== 'tarjeta';
        }

        if (contenedorPayPal) {
            contenedorPayPal.style.display =
                metodo === 'paypal'
                    ? 'block'
                    : 'none';
        }

        if (mensajePayPal) {
            mensajePayPal.style.display =
                metodo === 'paypal'
                    ? 'block'
                    : 'none';
        }

        if (
            metodo === 'paypal' &&
            !botonesPayPalRenderizados
        ) {
            renderizarPayPal();
        }
    }

    document
        .querySelectorAll(
            'input[name="metodo_pago"]'
        )
        .forEach(function (radio) {
            radio.addEventListener(
                'change',
                actualizarMetodoPago
            );
        });

    /**
     * Crear los botones oficiales de PayPal.
     */
    function renderizarPayPal() {
        if (!contenedorPayPal) {
            console.error(
                'No se encontró paypalButtonContainer.'
            );

            return;
        }

        if (
            typeof window.paypal ===
            'undefined'
        ) {
            mostrarMensaje(
                'No se pudo cargar PayPal. Revisa el Client ID.',
                'error'
            );

            console.error(
                'El SDK de PayPal no está disponible.'
            );

            return;
        }

        botonesPayPalRenderizados = true;

        window.paypal.Buttons({
            style: {
                layout: 'vertical',
                shape: 'rect',
                label: 'paypal',
                height: 48
            },

            /**
             * Validar antes de abrir PayPal.
             */
            onClick: function (
                data,
                actions
            ) {
                const carrito =
                    obtenerCarrito();

                if (!validarFormulario()) {
                    return actions.reject();
                }

                if (carrito.length === 0) {
                    mostrarMensaje(
                        'Tu carrito está vacío.',
                        'error'
                    );

                    return actions.reject();
                }

                if (
                    obtenerMetodoPago() !==
                    'paypal'
                ) {
                    mostrarMensaje(
                        'Selecciona PayPal para continuar.',
                        'error'
                    );

                    return actions.reject();
                }

                mostrarMensaje('');

                return actions.resolve();
            },

            /**
             * Crear la orden en PayPal.
             */
            createOrder: async function () {
                try {
                    const carrito =
                        obtenerCarrito();

                    const totales =
                        calcularTotales(
                            carrito
                        );

                    mostrarMensaje(
                        'Preparando el pago...'
                    );

                    const resultado =
                        await enviarJson(
                            window
                                .PUNTO_CREATIVO
                                .createPayPalOrderUrl,
                            {
                                /*
                                 * Este total está expresado
                                 * originalmente en lempiras.
                                 *
                                 * El PayPalController debe
                                 * convertirlo a USD.
                                 */
                                total:
                                    Number(
                                        totales.total
                                            .toFixed(2)
                                    )
                            }
                        );

                    if (!resultado.id) {
                        throw new Error(
                            'PayPal no devolvió el ID de la orden.'
                        );
                    }

                    console.log(
                        'Orden PayPal creada:',
                        resultado.id
                    );

                    return resultado.id;
                } catch (error) {
                    console.error(
                        'Error creando la orden:',
                        error
                    );

                    mostrarMensaje(
                        error.message ||
                        'No se pudo crear la orden.',
                        'error'
                    );

                    throw error;
                }
            },

            /**
             * PayPal ya fue aprobado.
             * Ahora se captura y se guarda en MySQL.
             */
            onApprove: async function (data) {
                try {
                    mostrarMensaje(
                        'Confirmando el pago con PayPal...'
                    );

                    const urlCaptura =
                        window.PUNTO_CREATIVO
                            .capturePayPalOrderBaseUrl
                        + '/'
                        + encodeURIComponent(
                            data.orderID
                        )
                        + '/capture';

                    const captura =
                        await enviarJson(
                            urlCaptura
                        );

                    console.log(
                        'Captura recibida:',
                        captura
                    );

                    const estado =
                        captura.order?.status ??
                        captura.status ??
                        '';

                    if (
                        String(estado)
                            .toUpperCase() !==
                        'COMPLETED'
                    ) {
                        throw new Error(
                            'PayPal no confirmó el pago.'
                        );
                    }

                    const captureId =
                        captura.order
                            ?.purchase_units?.[0]
                            ?.payments
                            ?.captures?.[0]
                            ?.id ?? null;

                    const carrito =
                        obtenerCarrito();

                    if (carrito.length === 0) {
                        throw new Error(
                            'El carrito está vacío y no se puede guardar el pedido.'
                        );
                    }

                    /*
                     * Guardar el pedido en MySQL.
                     */
                    const {
                        respuesta,
                        cliente
                    } = await guardarPedido(
                        carrito,
                        {
                            orderId:
                            data.orderID,

                            captureId:
                            captureId
                        }
                    );

                    console.log(
                        'Pedido guardado:',
                        respuesta
                    );

                    const pedidoServidor =
                        respuesta.pedido || {};

                    const totales =
                        pedidoServidor.totales ??
                        calcularTotales(
                            carrito
                        );

                    const pedidoConfirmacion = {
                        numero:
                            pedidoServidor
                                .numero_pedido ??
                            data.orderID,

                        estado:
                            String(
                                pedidoServidor
                                    .estado ??
                                estado ??
                                'COMPLETED'
                            ).toUpperCase(),

                        fecha:
                            pedidoServidor.fecha ??
                            new Date()
                                .toISOString(),

                        cliente:
                        cliente,

                        metodoPago:
                            'paypal',

                        paypalOrderId:
                        data.orderID,

                        paypalCaptureId:
                        captureId,

                        referenciaPago:
                            captureId ||
                            data.orderID,

                        servicios:
                        carrito,

                        totales:
                        totales
                    };

                    /*
                     * Guardar datos para la vista
                     * de confirmación.
                     */
                    localStorage.setItem(
                        CLAVE_PEDIDO,
                        JSON.stringify(
                            pedidoConfirmacion
                        )
                    );

                    /*
                     * Vaciar el carrito únicamente después
                     * de guardar el pedido en MySQL.
                     */
                    localStorage.removeItem(
                        CLAVE_CARRITO
                    );

                    localStorage.removeItem(
                        CLAVE_CUPON
                    );

                    document
                        .querySelectorAll(
                            '[data-cart-count]'
                        )
                        .forEach(function (
                            contador
                        ) {
                            contador.textContent =
                                '0';
                        });

                    mostrarMensaje(
                        'Pago confirmado correctamente.',
                        'success'
                    );

                    const redireccion =
                        respuesta.redirect ||
                        window.PUNTO_CREATIVO
                            .confirmationUrl;

                    window.location.assign(
                        redireccion
                    );
                } catch (error) {
                    console.error(
                        'Error confirmando el pago:',
                        error
                    );

                    mostrarMensaje(
                        error.message ||
                        'No fue posible confirmar el pago.',
                        'error'
                    );
                }
            },

            onCancel: function () {
                mostrarMensaje(
                    'El pago fue cancelado. Puedes intentarlo nuevamente.',
                    'error'
                );
            },

            onError: function (error) {
                console.error(
                    'Error del botón PayPal:',
                    error
                );

                mostrarMensaje(
                    error?.message ||
                    'Ocurrió un error al procesar el pago con PayPal.',
                    'error'
                );
            }
        })
            .render(
                '#paypalButtonContainer'
            )
            .catch(function (error) {
                botonesPayPalRenderizados =
                    false;

                console.error(
                    'No se pudo renderizar PayPal:',
                    error
                );

                mostrarMensaje(
                    'No se pudo mostrar el botón de PayPal.',
                    'error'
                );
            });
    }

    /**
     * Evitar el envío normal del formulario.
     * El proceso debe comenzar desde PayPal.
     */
    if (formulario) {
        formulario.addEventListener(
            'submit',
            function (evento) {
                evento.preventDefault();

                mostrarMensaje(
                    'Utiliza el botón de PayPal para confirmar el pago.',
                    'error'
                );
            }
        );
    }

    renderizarResumen();
    actualizarMetodoPago();
});
