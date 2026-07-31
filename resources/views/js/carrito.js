document.addEventListener('DOMContentLoaded', () => {
    const CLAVE_CARRITO = 'pcCart';
    const CLAVE_CUPON = 'pcCoupon';

    // Treinta días expresados en milisegundos.
    const DURACION_CARRITO = 30 * 24 * 60 * 60 * 1000;

    const lista = document.getElementById('cartList');
    const resumen = document.getElementById('cartSummary');

    if (!lista || !resumen) {
        console.error('No se encontraron cartList y cartSummary.');
        return;
    }

    const rutas = {
        catalogo: '/catalogo',
        checkout: '/checkout'
    };

    /**
     * Convierte los datos del carrito a una sola estructura.
     *
     * Esto permitirá recibir posteriormente servicios con nombres
     * de propiedades en español o en inglés.
     */
    function normalizarServicio(servicio) {
        return {
            id: String(servicio.id ?? ''),
            nombre: servicio.nombre ?? servicio.name ?? 'Servicio',
            precio: Number(servicio.precio ?? servicio.price ?? 0),
            imagen: servicio.imagen ?? servicio.image ?? '',
            cantidad: Number(
                servicio.cantidad ?? servicio.qty ?? 1
            ),
            agregadoEn: Number(
                servicio.agregadoEn ??
                servicio.addedAt ??
                Date.now()
            )
        };
    }

    /**
     * Obtiene el carrito y elimina servicios con más de 30 días.
     */
    function obtenerCarrito() {
        try {
            const guardado = JSON.parse(
                localStorage.getItem(CLAVE_CARRITO)
            ) || [];

            const ahora = Date.now();

            const carritoVigente = guardado
                .map(normalizarServicio)
                .filter(servicio => {
                    const tiempoGuardado =
                        ahora - servicio.agregadoEn;

                    return tiempoGuardado < DURACION_CARRITO;
                });

            guardarSinRenderizar(carritoVigente);

            return carritoVigente;
        } catch (error) {
            console.error('Error al leer el carrito:', error);

            localStorage.removeItem(CLAVE_CARRITO);

            return [];
        }
    }

    function guardarSinRenderizar(carrito) {
        localStorage.setItem(
            CLAVE_CARRITO,
            JSON.stringify(carrito)
        );
    }

    function guardarCarrito(carrito) {
        guardarSinRenderizar(carrito);
        actualizarContador(carrito);
        mostrarCarrito();
    }

    function obtenerCupon() {
        return localStorage.getItem(CLAVE_CUPON) || '';
    }

    function formatoMoneda(valor) {
        return new Intl.NumberFormat('es-HN', {
            style: 'currency',
            currency: 'HNL',
            minimumFractionDigits: 2
        }).format(Number(valor) || 0);
    }

    function calcularTotales(carrito) {
        const subtotal = carrito.reduce((total, servicio) => {
            return total +
                servicio.precio * servicio.cantidad;
        }, 0);

        const cuponValido =
            obtenerCupon().toUpperCase() === 'CREATIVO10';

        const descuento = cuponValido
            ? subtotal * 0.10
            : 0;

        const subtotalDescontado =
            subtotal - descuento;

        const impuesto =
            subtotalDescontado * 0.15;

        const total =
            subtotalDescontado + impuesto;

        return {
            subtotal,
            descuento,
            impuesto,
            total
        };
    }

    function actualizarContador(
        carrito = obtenerCarrito()
    ) {
        const cantidad = carrito.reduce(
            (total, servicio) => {
                return total + servicio.cantidad;
            },
            0
        );

        document
            .querySelectorAll('[data-cart-count]')
            .forEach(elemento => {
                elemento.textContent = cantidad;
            });
    }

    function aumentarCantidad(id) {
        const carrito = obtenerCarrito();

        const servicio = carrito.find(item => {
            return String(item.id) === String(id);
        });

        if (!servicio) {
            return;
        }

        servicio.cantidad += 1;

        guardarCarrito(carrito);
    }

    function disminuirCantidad(id) {
        const carrito = obtenerCarrito();

        const servicio = carrito.find(item => {
            return String(item.id) === String(id);
        });

        if (!servicio) {
            return;
        }

        if (servicio.cantidad > 1) {
            servicio.cantidad -= 1;
        }

        guardarCarrito(carrito);
    }

    function eliminarServicio(id) {
        const carrito = obtenerCarrito().filter(servicio => {
            return String(servicio.id) !== String(id);
        });

        guardarCarrito(carrito);
    }

    function aplicarCupon() {
        const entrada =
            document.getElementById('couponInput');

        if (!entrada) {
            return;
        }

        const codigo = entrada.value
            .trim()
            .toUpperCase();

        if (codigo === 'CREATIVO10') {
            localStorage.setItem(
                CLAVE_CUPON,
                codigo
            );

            mostrarMensaje(
                'Cupón aplicado: 10% de descuento.'
            );
        } else {
            localStorage.removeItem(CLAVE_CUPON);

            mostrarMensaje(
                'El código de cupón no es válido.'
            );
        }

        mostrarCarrito();
    }

    function mostrarMensaje(mensaje) {
        let aviso = document.querySelector('.toast');

        if (!aviso) {
            aviso = document.createElement('div');
            aviso.className = 'toast';
            document.body.appendChild(aviso);
        }

        aviso.textContent = mensaje;
        aviso.classList.add('show');

        clearTimeout(window.temporizadorCarrito);

        window.temporizadorCarrito = setTimeout(() => {
            aviso.classList.remove('show');
        }, 2200);
    }

    function mostrarCarritoVacio() {
        lista.innerHTML = `
            <div class="empty-state">
                <h2>Tu carrito está vacío.</h2>

                <p>
                    Cuando selecciones un servicio,
                    aparecerá guardado en este espacio.
                </p>

                <a
                    class="btn btn-primary"
                    style="margin-top:18px"
                    href="${rutas.catalogo}"
                >
                    Ver catálogo
                </a>
            </div>
        `;

        resumen.innerHTML = `
            <h2>Resumen del pedido</h2>

            <div class="summary-row">
                <span>Subtotal</span>
                <strong>${formatoMoneda(0)}</strong>
            </div>

            <div class="summary-row">
                <span>Descuento</span>
                <strong>− ${formatoMoneda(0)}</strong>
            </div>

            <div class="summary-row">
                <span>Impuesto ISV (15%)</span>
                <strong>${formatoMoneda(0)}</strong>
            </div>

            <div class="summary-row total">
                <span>Total</span>
                <strong>${formatoMoneda(0)}</strong>
            </div>
        `;
    }

    function mostrarServicios(carrito) {
        lista.innerHTML = `
            <div class="cart-products-header">
                <h2>Servicios seleccionados</h2>

                <span>
                    ${carrito.length}
                    ${
            carrito.length === 1
                ? 'servicio'
                : 'servicios'
        }
                </span>
            </div>

            ${carrito.map(servicio => {
            const subtotal =
                servicio.precio *
                servicio.cantidad;

            const imagen = servicio.imagen
                ? `
                        <img
                            src="${servicio.imagen}"
                            alt="${servicio.nombre}"
                        >
                    `
                : `
                        <div class="image-placeholder">
                            Sin imagen
                        </div>
                    `;

            return `
                    <article class="cart-item">
                        ${imagen}

                        <div>
                            <h3>${servicio.nombre}</h3>

                            <p class="cart-meta">
                                Precio:
                                ${formatoMoneda(servicio.precio)}
                            </p>

                            <div class="cart-actions-inline">
                                <div
                                    class="qty-control"
                                    style="width:140px;height:42px"
                                >
                                    <button
                                        type="button"
                                        data-disminuir="${servicio.id}"
                                        aria-label="Disminuir cantidad"
                                    >
                                        −
                                    </button>

                                    <input
                                        value="${servicio.cantidad}"
                                        aria-label="Cantidad"
                                        readonly
                                    >

                                    <button
                                        type="button"
                                        data-aumentar="${servicio.id}"
                                        aria-label="Aumentar cantidad"
                                    >
                                        +
                                    </button>
                                </div>

                                <button
                                    type="button"
                                    class="remove-link"
                                    data-eliminar="${servicio.id}"
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
        }).join('')}
        `;
    }

    function mostrarResumen(carrito) {
        const totales = calcularTotales(carrito);

        const cantidadServicios = carrito.reduce(
            (total, servicio) => {
                return total + servicio.cantidad;
            },
            0
        );

        resumen.innerHTML = `
            <h2>Resumen del pedido</h2>

            <div class="summary-row">
                <span>
                    Subtotal
                    (${cantidadServicios}
                    ${
            cantidadServicios === 1
                ? 'servicio'
                : 'servicios'
        })
                </span>

                <strong>
                    ${formatoMoneda(totales.subtotal)}
                </strong>
            </div>

            <div class="summary-row">
                <span>Descuento del cupón</span>

                <strong>
                    − ${formatoMoneda(totales.descuento)}
                </strong>
            </div>

            <div class="summary-row">
                <span>Impuesto ISV (15%)</span>

                <strong>
                    ${formatoMoneda(totales.impuesto)}
                </strong>
            </div>

            <div class="summary-row total">
                <span>Total</span>

                <strong>
                    ${formatoMoneda(totales.total)}
                </strong>
            </div>

            <div class="coupon-row">
                <input
                    id="couponInput"
                    type="text"
                    placeholder="Código de cupón"
                    value="${obtenerCupon()}"
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
                Prueba el cupón
                <strong>CREATIVO10</strong>.
            </p>

            <a
                class="btn btn-primary"
                style="width:100%;margin-top:18px"
                href="${rutas.checkout}"
            >
                Proceder al pago
            </a>

            <a
                class="btn btn-secondary"
                style="width:100%;margin-top:10px"
                href="${rutas.catalogo}"
            >
                Seguir comprando
            </a>
        `;
    }

    function conectarBotones() {
        document
            .querySelectorAll('[data-aumentar]')
            .forEach(boton => {
                boton.addEventListener('click', () => {
                    aumentarCantidad(
                        boton.dataset.aumentar
                    );
                });
            });

        document
            .querySelectorAll('[data-disminuir]')
            .forEach(boton => {
                boton.addEventListener('click', () => {
                    disminuirCantidad(
                        boton.dataset.disminuir
                    );
                });
            });

        document
            .querySelectorAll('[data-eliminar]')
            .forEach(boton => {
                boton.addEventListener('click', () => {
                    eliminarServicio(
                        boton.dataset.eliminar
                    );
                });
            });

        const botonCupon =
            document.getElementById('applyCoupon');

        if (botonCupon) {
            botonCupon.addEventListener(
                'click',
                aplicarCupon
            );
        }

        const entradaCupon =
            document.getElementById('couponInput');

        if (entradaCupon) {
            entradaCupon.addEventListener(
                'keydown',
                evento => {
                    if (evento.key === 'Enter') {
                        evento.preventDefault();
                        aplicarCupon();
                    }
                }
            );
        }
    }

    function mostrarCarrito() {
        const carrito = obtenerCarrito();

        actualizarContador(carrito);

        if (carrito.length === 0) {
            localStorage.removeItem(CLAVE_CUPON);
            mostrarCarritoVacio();
            return;
        }

        mostrarServicios(carrito);
        mostrarResumen(carrito);
        conectarBotones();
    }

    mostrarCarrito();
});
