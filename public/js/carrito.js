document.addEventListener('DOMContentLoaded', function () {
    const CLAVE_CARRITO = 'pcCart';
    const CLAVE_CUPON = 'pcCoupon';

    // 30 días expresados en milisegundos.
    const DURACION_CARRITO =
        30 * 24 * 60 * 60 * 1000;

    const lista =
        document.getElementById('cartList');

    const resumen =
        document.getElementById('cartSummary');

    /*
     * Si la vista no contiene estos elementos,
     * el código no continúa.
     */
    if (!lista || !resumen) {
        console.error(
            'No se encontraron cartList o cartSummary.'
        );

        return;
    }

    /**
     * Convierte valores antiguos del carrito
     * al formato que estamos utilizando actualmente.
     */
    function normalizarServicio(servicio) {
        return {
            id: String(
                servicio.id ??
                servicio.servicio_id ??
                ''
            ),

            nombre:
                servicio.nombre ??
                servicio.name ??
                'Servicio',

            precio: Number(
                servicio.precio ??
                servicio.price ??
                0
            ),

            imagen:
                servicio.imagen ??
                servicio.image ??
                servicio.imagen_principal ??
                '',

            cantidad: Math.max(
                1,
                Number(
                    servicio.cantidad ??
                    servicio.qty ??
                    servicio.quantity ??
                    1
                )
            ),

            agregadoEn: Number(
                servicio.agregadoEn ??
                servicio.addedAt ??
                Date.now()
            )
        };
    }

    /**
     * Lee el carrito guardado en localStorage.
     */
    function obtenerCarrito() {
        try {
            const contenido =
                localStorage.getItem(CLAVE_CARRITO);

            if (!contenido) {
                return [];
            }

            const datos =
                JSON.parse(contenido);

            if (!Array.isArray(datos)) {
                localStorage.removeItem(
                    CLAVE_CARRITO
                );

                return [];
            }

            const ahora = Date.now();

            /*
             * Normalizamos los servicios y eliminamos
             * los que tengan más de 30 días.
             */
            const carritoVigente = datos
                .map(normalizarServicio)
                .filter(function (servicio) {
                    if (!servicio.id) {
                        return false;
                    }

                    return (
                        ahora - servicio.agregadoEn
                    ) < DURACION_CARRITO;
                });

            localStorage.setItem(
                CLAVE_CARRITO,
                JSON.stringify(carritoVigente)
            );

            return carritoVigente;
        } catch (error) {
            console.error(
                'Error leyendo el carrito:',
                error
            );

            return [];
        }
    }

    /**
     * Guarda nuevamente el carrito.
     */
    function guardarCarrito(carrito) {
        localStorage.setItem(
            CLAVE_CARRITO,
            JSON.stringify(carrito)
        );

        renderizar();
    }

    /**
     * Evita colocar HTML no deseado
     * dentro de la vista.
     */
    function escaparHtml(valor) {
        return String(valor ?? '')
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    /**
     * Formato de moneda de Honduras.
     */
    function formatoMoneda(valor) {
        return new Intl.NumberFormat('es-HN', {
            style: 'currency',
            currency: 'HNL',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(Number(valor) || 0);
    }

    /**
     * Obtiene el cupón almacenado.
     */
    function obtenerCupon() {
        return (
            localStorage.getItem(CLAVE_CUPON) ||
            ''
        );
    }

    /**
     * Calcula subtotal, descuento,
     * impuesto y total.
     */
    function calcularTotales(carrito) {
        const subtotal = carrito.reduce(
            function (total, servicio) {
                return total +
                    servicio.precio *
                    servicio.cantidad;
            },
            0
        );

        const cuponValido =
            obtenerCupon()
                .trim()
                .toUpperCase() ===
            'CREATIVO10';

        const descuento = cuponValido
            ? subtotal * 0.10
            : 0;

        const subtotalConDescuento =
            subtotal - descuento;

        const impuesto =
            subtotalConDescuento * 0.15;

        const total =
            subtotalConDescuento + impuesto;

        return {
            subtotal,
            descuento,
            impuesto,
            total
        };
    }

    /**
     * Actualiza el número mostrado
     * junto al ícono del carrito.
     */
    function actualizarContador(carrito) {
        const cantidadTotal = carrito.reduce(
            function (total, servicio) {
                return total +
                    servicio.cantidad;
            },
            0
        );

        document
            .querySelectorAll('[data-cart-count]')
            .forEach(function (contador) {
                contador.textContent =
                    cantidadTotal;
            });
    }

    /**
     * Aumenta la cantidad de un servicio.
     */
    function aumentarCantidad(id) {
        const carrito = obtenerCarrito();

        const servicio = carrito.find(
            function (item) {
                return String(item.id) ===
                    String(id);
            }
        );

        if (!servicio) {
            return;
        }

        servicio.cantidad += 1;

        /*
         * Renovamos la fecha para conservar
         * el servicio durante otros 30 días.
         */
        servicio.agregadoEn = Date.now();

        guardarCarrito(carrito);
    }

    /**
     * Disminuye la cantidad de un servicio.
     */
    function disminuirCantidad(id) {
        const carrito = obtenerCarrito();

        const servicio = carrito.find(
            function (item) {
                return String(item.id) ===
                    String(id);
            }
        );

        if (!servicio) {
            return;
        }

        if (servicio.cantidad > 1) {
            servicio.cantidad -= 1;
            servicio.agregadoEn = Date.now();

            guardarCarrito(carrito);
        }
    }

    /**
     * Elimina completamente un servicio.
     */
    function eliminarServicio(id) {
        const carrito = obtenerCarrito().filter(
            function (servicio) {
                return String(servicio.id) !==
                    String(id);
            }
        );

        guardarCarrito(carrito);
    }

    /**
     * Muestra un mensaje temporal.
     */
    function mostrarAviso(mensaje) {
        let aviso =
            document.querySelector(
                '.carrito-aviso'
            );

        if (!aviso) {
            aviso =
                document.createElement('div');

            aviso.className =
                'carrito-aviso';

            aviso.style.position = 'fixed';
            aviso.style.right = '22px';
            aviso.style.bottom = '95px';
            aviso.style.zIndex = '9999';
            aviso.style.padding = '14px 18px';
            aviso.style.borderRadius = '12px';
            aviso.style.background = '#111526';
            aviso.style.color = '#ffffff';
            aviso.style.border =
                '1px solid rgba(255,255,255,.15)';
            aviso.style.boxShadow =
                '0 16px 40px rgba(0,0,0,.35)';

            document.body.appendChild(aviso);
        }

        aviso.textContent = mensaje;
        aviso.style.display = 'block';

        clearTimeout(
            window.temporizadorCarrito
        );

        window.temporizadorCarrito =
            setTimeout(function () {
                aviso.style.display = 'none';
            }, 2200);
    }

    /**
     * Aplica el cupón escrito por el usuario.
     */
    function aplicarCupon() {
        const entrada =
            document.getElementById(
                'couponInput'
            );

        if (!entrada) {
            return;
        }

        const codigo =
            entrada.value
                .trim()
                .toUpperCase();

        if (codigo === 'CREATIVO10') {
            localStorage.setItem(
                CLAVE_CUPON,
                codigo
            );

            mostrarAviso(
                'Cupón aplicado: 10% de descuento.'
            );
        } else {
            localStorage.removeItem(
                CLAVE_CUPON
            );

            mostrarAviso(
                'El código del cupón no es válido.'
            );
        }

        renderizar();
    }

    /**
     * Muestra la vista cuando no hay servicios.
     */
    function mostrarCarritoVacio() {
        lista.innerHTML = `
            <div class="empty-state">
                <h2>Tu carrito está vacío.</h2>

                <p>
                    Explora el catálogo y agrega el
                    servicio que necesitas.
                </p>

                <a
                    class="btn btn-primary"
                    style="margin-top:18px"
                    href="/catalogo"
                >
                    Ver catálogo
                </a>
            </div>
        `;

        resumen.innerHTML = `
            <h2>Resumen del pedido</h2>

            <div class="summary-row">
                <span>Subtotal</span>

                <strong>
                    ${formatoMoneda(0)}
                </strong>
            </div>

            <div class="summary-row">
                <span>Descuento</span>

                <strong>
                    − ${formatoMoneda(0)}
                </strong>
            </div>

            <div class="summary-row">
                <span>Impuesto ISV (15%)</span>

                <strong>
                    ${formatoMoneda(0)}
                </strong>
            </div>

            <div class="summary-row total">
                <span>Total</span>

                <strong>
                    ${formatoMoneda(0)}
                </strong>
            </div>
        `;
    }

    /**
     * Muestra los servicios guardados.
     */
    function mostrarServicios(carrito) {
        lista.innerHTML = carrito
            .map(function (servicio) {
                const id =
                    escaparHtml(servicio.id);

                const nombre =
                    escaparHtml(
                        servicio.nombre
                    );

                const imagen =
                    escaparHtml(
                        servicio.imagen
                    );

                const precio =
                    Number(servicio.precio);

                const cantidad =
                    Number(servicio.cantidad);

                const subtotal =
                    precio * cantidad;

                const contenidoImagen = imagen
                    ? `
                        <img
                            src="${imagen}"
                            alt="${nombre}"
                            loading="lazy"
                        >
                    `
                    : `
                        <div class="image-placeholder">
                            Sin imagen
                        </div>
                    `;

                return `
                    <article class="cart-item">
                        ${contenidoImagen}

                        <div class="cart-item-info">
                            <h3>${nombre}</h3>

                            <p class="cart-meta">
                                Precio:
                                ${formatoMoneda(precio)}
                            </p>

                            <div class="cart-actions-inline">
                                <div
                                    class="qty-control"
                                    style="
                                        width:140px;
                                        height:42px;
                                    "
                                >
                                    <button
                                        type="button"
                                        data-disminuir="${id}"
                                        aria-label="Disminuir cantidad"
                                    >
                                        −
                                    </button>

                                    <input
                                        type="text"
                                        value="${cantidad}"
                                        aria-label="Cantidad"
                                        readonly
                                    >

                                    <button
                                        type="button"
                                        data-aumentar="${id}"
                                        aria-label="Aumentar cantidad"
                                    >
                                        +
                                    </button>
                                </div>

                                <button
                                    type="button"
                                    class="remove-link"
                                    data-eliminar="${id}"
                                >
                                    Eliminar
                                </button>
                            </div>
                        </div>

                        <div class="item-total">
                            <small>Subtotal</small>

                            <strong>
                                ${formatoMoneda(subtotal)}
                            </strong>
                        </div>
                    </article>
                `;
            })
            .join('');
    }

    /**
     * Muestra los totales y el cupón.
     */
    function mostrarResumen(carrito) {
        const totales =
            calcularTotales(carrito);

        const cantidadTotal = carrito.reduce(
            function (total, servicio) {
                return total +
                    servicio.cantidad;
            },
            0
        );

        const palabraServicio =
            cantidadTotal === 1
                ? 'servicio'
                : 'servicios';

        resumen.innerHTML = `
            <h2>Resumen del pedido</h2>

            <div class="summary-row">
                <span>
                    Subtotal
                    (${cantidadTotal}
                    ${palabraServicio})
                </span>

                <strong>
                    ${formatoMoneda(
            totales.subtotal
        )}
                </strong>
            </div>

            <div class="summary-row">
                <span>Descuento</span>

                <strong>
                    − ${formatoMoneda(
            totales.descuento
        )}
                </strong>
            </div>

            <div class="summary-row">
                <span>Impuesto ISV (15%)</span>

                <strong>
                    ${formatoMoneda(
            totales.impuesto
        )}
                </strong>
            </div>

            <div class="summary-row total">
                <span>Total</span>

                <strong>
                    ${formatoMoneda(
            totales.total
        )}
                </strong>
            </div>

            <div class="coupon-row">
                <input
                    id="couponInput"
                    type="text"
                    placeholder="Código de cupón"
                    value="${escaparHtml(
            obtenerCupon()
        )}"
                >

                <button
                    type="button"
                    class="btn btn-secondary"
                    id="applyCoupon"
                >
                    Aplicar
                </button>
            </div>

            <p class="form-note">
                Puedes utilizar el cupón
                <strong>CREATIVO10</strong>.
            </p>

            <a
                class="btn btn-primary"
                style="
                    width:100%;
                    margin-top:18px;
                "
                href="/checkout"
            >
                Proceder al pago
            </a>

            <a
                class="btn btn-secondary"
                style="
                    width:100%;
                    margin-top:10px;
                "
                href="/catalogo"
            >
                Seguir comprando
            </a>
        `;
    }

    /**
     * Renderiza todo el carrito.
     */
    function renderizar() {
        const carrito = obtenerCarrito();

        actualizarContador(carrito);

        if (carrito.length === 0) {
            localStorage.removeItem(
                CLAVE_CUPON
            );

            mostrarCarritoVacio();

            return;
        }

        mostrarServicios(carrito);
        mostrarResumen(carrito);
    }

    /*
     * Eventos de los botones del listado.
     * Se utiliza delegación para que sigan
     * funcionando después de renderizar.
     */
    lista.addEventListener(
        'click',
        function (evento) {
            const botonAumentar =
                evento.target.closest(
                    '[data-aumentar]'
                );

            if (botonAumentar) {
                aumentarCantidad(
                    botonAumentar.dataset.aumentar
                );

                return;
            }

            const botonDisminuir =
                evento.target.closest(
                    '[data-disminuir]'
                );

            if (botonDisminuir) {
                disminuirCantidad(
                    botonDisminuir.dataset.disminuir
                );

                return;
            }

            const botonEliminar =
                evento.target.closest(
                    '[data-eliminar]'
                );

            if (botonEliminar) {
                eliminarServicio(
                    botonEliminar.dataset.eliminar
                );
            }
        }
    );

    /*
     * Evento del botón para aplicar el cupón.
     */
    resumen.addEventListener(
        'click',
        function (evento) {
            const botonCupon =
                evento.target.closest(
                    '#applyCoupon'
                );

            if (botonCupon) {
                aplicarCupon();
            }
        }
    );

    /*
     * Permite aplicar el cupón
     * presionando Enter.
     */
    resumen.addEventListener(
        'keydown',
        function (evento) {
            if (
                evento.target.id ===
                'couponInput' &&
                evento.key === 'Enter'
            ) {
                evento.preventDefault();
                aplicarCupon();
            }
        }
    );

    renderizar();
});
