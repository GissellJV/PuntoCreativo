<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Proceso de pago de Punto Creativo."
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <title>Proceso de pago | Punto Creativo</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/base.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/store.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/checkout.css') }}?v={{ time() }}"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >
</head>

<body>

<div class="topbar">
    Diseño gráfico, edición audiovisual y contenido digital
    desde El Paraíso, Honduras.
</div>

<nav class="navbar">
    <div class="container nav-inner">

        <a
            href="{{ route('index') }}"
            class="brand"
            aria-label="Ir al inicio"
        >
            <span class="brand-mark">
                <span>PC</span>
            </span>

            <span>Punto Creativo</span>
        </a>

        <button
            class="menu-toggle"
            type="button"
            aria-label="Abrir menú"
            aria-expanded="false"
        >
            ☰
        </button>

        <div class="nav-links" id="navLinks">

            <a href="{{ route('index') }}">
                Inicio
            </a>

            <a href="{{ route('catalogo') }}">
                Tienda
            </a>

            <a href="{{ route('index') }}#portafolio">
                Portafolio
            </a>

            <a href="{{ route('index') }}#cotizar">
                Contacto
            </a>

            <form
                class="header-search"
                data-search-form
                role="search"
            >
                <div class="search-input">

                    <i class="bi bi-search"></i>

                    <input
                        type="search"
                        aria-label="Buscar servicios"
                        placeholder="Buscar servicios"
                    >

                </div>
            </form>

            <a
                class="nav-icon"
                href="{{ route('cuenta') }}"
                aria-label="Mi cuenta"
                title="Mi cuenta"
            >
                <i class="bi bi-person"></i>
            </a>

            <a
                class="nav-icon"
                href="{{ route('carrito') }}"
                aria-label="Carrito"
                title="Carrito"
            >
                <i class="bi bi-cart3"></i>

                <span
                    class="cart-badge"
                    data-cart-count
                >
                    0
                </span>
            </a>

        </div>
    </div>
</nav>

<main>

    <header class="checkout-header">
        <div class="container">

            <nav class="breadcrumbs">

                <a href="{{ route('index') }}">
                    Inicio
                </a>

                <span>›</span>

                <a href="{{ route('carrito') }}">
                    Carrito
                </a>

                <span>›</span>

                <span>Pago</span>

            </nav>

            <span class="eyebrow">
                Paso 2 de 3
            </span>

            <span class="eyebrow">
                Checkout seguro
            </span>

            <h1>
                Completa tu solicitud.
            </h1>

            <p>
                Ingresa tus datos, selecciona el método de pago
                y revisa el resumen antes de confirmar.
            </p>

        </div>
    </header>

    <section class="checkout-section">
        <div class="container">

            {{-- Barra de progreso --}}
            <div class="checkout-progress">

                <div class="checkout-progress-item active">

                    <span class="progress-number">
                        1
                    </span>

                    <span class="progress-label">
                        Información
                    </span>

                </div>

                <div class="progress-divider active"></div>

                <div class="checkout-progress-item">

                    <span class="progress-number">
                        2
                    </span>

                    <span class="progress-label">
                        Pago
                    </span>

                </div>

                <div class="progress-divider"></div>

                <div class="checkout-progress-item">

                    <span class="progress-number">
                        3
                    </span>

                    <span class="progress-label">
                        Revisión
                    </span>

                </div>

            </div>

            <div class="checkout-layout">

                {{-- Formulario --}}
                <form
                    class="checkout-form"
                    id="checkoutForm"
                    novalidate
                >

                    {{-- Datos del cliente --}}
                    <section class="checkout-panel">

                        <div class="panel-heading">

                            <div class="panel-icon">
                                <i class="bi bi-person-vcard"></i>
                            </div>

                            <div>
                                <span>Información</span>

                                <h2>
                                    Información del cliente
                                </h2>
                            </div>

                        </div>

                        <div class="checkout-fields">

                            <div class="field">

                                <label for="nombre">
                                    Nombre
                                    <span>*</span>
                                </label>

                                <div class="input-icon">

                                    <i class="bi bi-person-fill"></i>

                                    <input
                                        id="nombre"
                                        name="nombre"
                                        type="text"
                                        autocomplete="given-name"
                                        placeholder="Juan Carlos"
                                        required
                                    >

                                </div>

                                <small class="field-error"></small>

                            </div>

                            <div class="field">

                                <label for="apellido">
                                    Apellido
                                    <span>*</span>
                                </label>

                                <div class="input-icon">

                                    <i class="bi bi-person-badge-fill"></i>

                                    <input
                                        id="apellido"
                                        name="apellido"
                                        type="text"
                                        autocomplete="family-name"
                                        placeholder="Pérez López"
                                        required
                                    >

                                </div>

                                <small class="field-error"></small>

                            </div>

                            <div class="field">

                                <label for="correo">
                                    Correo electrónico
                                    <span>*</span>
                                </label>

                                <div class="input-icon">

                                    <i class="bi bi-envelope-fill"></i>

                                    <input
                                        id="correo"
                                        name="correo"
                                        type="email"
                                        autocomplete="email"
                                        placeholder="juan@empresa.hn"
                                        required
                                    >

                                </div>

                                <small class="field-error"></small>

                            </div>

                            <div class="field">

                                <label for="telefono">
                                    Teléfono o WhatsApp
                                    <span>*</span>
                                </label>

                                <div class="input-icon">

                                    <i class="bi bi-telephone-fill"></i>

                                    <input
                                        id="telefono"
                                        name="telefono"
                                        type="tel"
                                        autocomplete="tel"
                                        placeholder="+504 9999-0000"
                                        required
                                    >

                                </div>

                                <small class="field-error"></small>

                            </div>

                            <div class="field full">

                                <label for="empresa">
                                    Empresa o nombre de marca
                                </label>

                                <div class="input-icon">

                                    <i class="bi bi-building-fill"></i>

                                    <input
                                        id="empresa"
                                        name="empresa"
                                        type="text"
                                        autocomplete="organization"
                                        placeholder="Mi Empresa S.A."
                                    >

                                </div>

                            </div>

                            <div class="field full">

                                <label for="notas">
                                    Notas o instrucciones del pedido
                                </label>

                                <div class="textarea-icon">

                                    <i class="bi bi-chat-left-text-fill"></i>

                                    <textarea
                                        id="notas"
                                        name="notas"
                                        placeholder="Describe colores, formatos, medidas, referencias o cualquier detalle importante..."
                                    ></textarea>

                                </div>

                            </div>

                        </div>

                    </section>

                    {{-- Método de pago --}}
                    <section class="checkout-panel">

                        <div class="panel-heading">

                            <div class="panel-icon">
                                <i class="bi bi-wallet2"></i>
                            </div>

                            <div>
                                <span>Opciones disponibles</span>

                                <h2>
                                    Método de pago
                                </h2>
                            </div>

                        </div>

                        <div class="payment-options">

                            <label class="payment-option selected">

                                <input
                                    type="radio"
                                    name="metodo_pago"
                                    value="paypal"
                                    checked
                                    required
                                >

                                <span class="payment-radio"></span>

                                <span class="payment-main-icon paypal">
                                <i class="bi bi-paypal"></i>
                                 </span>

                                <span class="payment-information">

                                    <strong>
                                    PayPal
                                    </strong>

                                     <small>
                                    Pago seguro mediante PayPal Sandbox
                                    </small>

                                </span>

                                <span class="payment-check">
                                    <i class="bi bi-check-circle-fill"></i>
                                </span>

                            </label>

                            <label class="payment-option">

                                <input
                                    type="radio"
                                    name="metodo_pago"
                                    value="tarjeta"
                                >

                                <span class="payment-radio"></span>

                                <span class="payment-main-icon">
                                    <i class="bi bi-credit-card-2-front-fill"></i>
                                </span>

                                <span class="payment-information">

                                    <strong>
                                        Tarjeta de crédito o débito
                                    </strong>

                                    <small>
                                        Visa, Mastercard y otras tarjetas
                                    </small>

                                </span>

                                <span class="payment-check">
                                    <i class="bi bi-check-circle-fill"></i>
                                </span>

                            </label>

                            <label class="payment-option">

                                <input
                                    type="radio"
                                    name="metodo_pago"
                                    value="transferencia"
                                >

                                <span class="payment-radio"></span>

                                <span class="payment-main-icon">
                                    <i class="bi bi-bank2"></i>
                                </span>

                                <span class="payment-information">

                                    <strong>
                                        Transferencia bancaria
                                    </strong>

                                    <small>
                                        Pago manual mediante banco
                                    </small>

                                </span>

                                <span class="payment-check">
                                    <i class="bi bi-check-circle-fill"></i>
                                </span>

                            </label>

                        </div>
                        <!--<div
                            id="paypalButtonContainer"
                            class="paypal-button-container"
                        ></div>

                        <p
                            id="paypalMessage"
                            class="paypal-message"
                        ></p> -->

                        {{-- Campos de tarjeta --}}
                        <div
                            class="card-fields"
                            id="cardFields"
                            hidden
                        >

                            <div class="demo-warning">

                                <i class="bi bi-info-circle-fill"></i>

                                <div>
                                    <strong>Modo demostración</strong>

                                    <p>
                                        No introduzcas información bancaria real.
                                    </p>
                                </div>

                            </div>

                            <div class="checkout-fields">

                                <div class="field full">

                                    <label for="numeroTarjeta">
                                        Número de tarjeta
                                    </label>

                                    <div class="input-icon">

                                        <i class="bi bi-credit-card"></i>

                                        <input
                                            id="numeroTarjeta"
                                            name="numero_tarjeta"
                                            type="text"
                                            inputmode="numeric"
                                            maxlength="19"
                                            placeholder="4242 4242 4242 4242"
                                        >

                                    </div>

                                </div>

                                <div class="field">

                                    <label for="vencimiento">
                                        Vencimiento
                                    </label>

                                    <div class="input-icon">

                                        <i class="bi bi-calendar2-check-fill"></i>

                                        <input
                                            id="vencimiento"
                                            name="vencimiento"
                                            type="text"
                                            inputmode="numeric"
                                            maxlength="5"
                                            placeholder="12/30"
                                        >

                                    </div>

                                </div>

                                <div class="field">

                                    <label for="cvv">
                                        CVV
                                    </label>

                                    <div class="input-icon">

                                        <i class="bi bi-shield-lock-fill"></i>

                                        <input
                                            id="cvv"
                                            name="cvv"
                                            type="password"
                                            inputmode="numeric"
                                            maxlength="4"
                                            placeholder="123"
                                        >

                                    </div>

                                </div>

                            </div>

                        </div>

                    </section>

                </form>

                {{-- Resumen del pedido --}}
                <aside class="checkout-summary">

                    <div class="summary-heading">

                        <div class="summary-icon">
                            <i class="bi bi-cart-check-fill"></i>
                        </div>

                        <div>
                            <span>Tu compra</span>

                            <h2>
                                Resumen del pedido
                            </h2>
                        </div>

                    </div>

                    <div
                        class="checkout-items"
                        id="checkoutItems"
                    ></div>

                    <div class="summary-calculation">

                        <div class="summary-row">

                            <span>
                                Subtotal
                            </span>

                            <strong id="checkoutSubtotal">
                                L 0.00
                            </strong>

                        </div>

                        <div class="summary-row">

                            <span>
                                Descuento
                            </span>

                            <strong id="checkoutDiscount">
                                − L 0.00
                            </strong>

                        </div>

                        <div class="summary-row">

                            <span>
                                ISV (15%)
                            </span>

                            <strong id="checkoutTax">
                                L 0.00
                            </strong>

                        </div>

                        <div class="summary-row total">

                            <span>
                                Total
                            </span>

                            <strong id="checkoutTotal">
                                L 0.00
                            </strong>

                        </div>

                    </div>

                    <button
                        type="submit"
                        form="checkoutForm"
                        class="btn btn-primary confirm-button"
                        id="confirmOrderButton"
                    >
                        <i class="bi bi-check-circle-fill"></i>

                        Confirmar pedido
                    </button>

                    <a
                        href="{{ route('carrito') }}"
                        class="btn btn-secondary return-button"
                    >
                        <i class="bi bi-arrow-left"></i>

                        Volver al carrito
                    </a>

                    <div class="secure-message">

                        <i class="bi bi-shield-lock-fill"></i>

                        <div>
                            <strong>
                                Transacción segura
                            </strong>

                            <small>
                                Tus datos se utilizan únicamente
                                para procesar la solicitud.
                            </small>
                        </div>

                    </div>

                </aside>

            </div>

        </div>
    </section>

</main>

<footer>
    <div class="container">

        <div class="footer-grid">

            <div class="footer-brand">

                <a
                    href="{{ route('index') }}"
                    class="brand"
                >
                    <span class="brand-mark">
                        <span>PC</span>
                    </span>

                    <span>Punto Creativo</span>
                </a>

                <p>
                    Diseño gráfico, edición audiovisual
                    y contenido digital en Honduras.
                </p>

            </div>

            <div class="footer-col">

                <h4>
                    Contacto
                </h4>

                <p>
                    <i class="bi bi-envelope-fill"></i>
                    info@puntocreativo.hn
                </p>

                <p>
                    <i class="bi bi-telephone-fill"></i>
                    +504 9999-8888
                </p>

                <p>
                    <i class="bi bi-geo-alt-fill"></i>
                    Danlí, El Paraíso
                </p>

            </div>

            <div class="footer-col">

                <h4>
                    Redes sociales
                </h4>

                <div class="social-links">

                    <a href="#" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a href="#" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a href="#" aria-label="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>

                    <a href="#" aria-label="TikTok">
                        <i class="bi bi-tiktok"></i>
                    </a>

                </div>

                <div class="footer-links">

                    <a href="{{ route('terminos') }}">
                        Términos
                    </a>

                    <a href="{{ route('privacidad') }}">
                        Privacidad
                    </a>

                    <a href="{{ route('cookies') }}">
                        Cookies
                    </a>

                </div>

            </div>

        </div>

        <div class="footer-bottom">

            <span>
                © <span data-year></span>
                Punto Creativo. Todos los derechos reservados.
            </span>

        </div>

    </div>
</footer>

<a
    class="whatsapp-float"
    href="https://wa.me/50400000000"
    target="_blank"
    rel="noopener"
    aria-label="Contactar por WhatsApp"
    title="WhatsApp"
>
    <i class="bi bi-whatsapp"></i>
</a>

<script src="{{ asset('js/store.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
<!-- <script>
    window.PUNTO_CREATIVO = {
        paypalClientId:
        @json(config('services.paypal.client_id')),

        createPayPalOrderUrl:
        @json(route('paypal.orders.create')),

        capturePayPalOrderBaseUrl:
        @json(url('/paypal/orders')),

        confirmationUrl:
        @json(route('confirmacion'))
    };
</script>
<script
    src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&currency=USD&intent=capture">
</script> -->
<script src="{{ asset('js/checkout.js') }}?v={{ time() }}"></script>

</body>
</html>
