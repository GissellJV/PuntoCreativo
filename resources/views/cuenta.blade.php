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
        content="Cuenta e historial de pedidos de Punto Creativo."
    >

    <title>Mi cuenta | Punto Creativo</title>

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
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>
        /* =====================================
           CONTENEDORES
        ===================================== */

        .account-container {
            width: min(calc(100% - 40px), 1320px);
            margin-inline: auto;
        }

        .account-header {
            padding: 55px 0 42px;
        }

        .account-header .breadcrumbs {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 9px;
            margin-bottom: 22px;
            color: var(--muted);
            font-size: 0.88rem;
        }

        .account-header .breadcrumbs a {
            color: var(--muted);
        }

        .account-header .breadcrumbs a:hover {
            color: var(--cyan);
        }

        .account-header h1 {
            max-width: 850px;
            margin: 18px 0 16px;
            font-size: clamp(2.8rem, 6vw, 5.4rem);
            line-height: 1.03;
        }

        .account-header p {
            max-width: 760px;
            margin: 0;
            color: var(--muted);
            font-size: 1.04rem;
            line-height: 1.65;
        }

        .account-section {
            padding: 22px 0 90px;
        }

        .account-layout {
            display: grid;
            grid-template-columns: minmax(280px, 360px) minmax(0, 1fr);
            align-items: start;
            gap: 25px;
        }

        /* =====================================
           MENSAJES
        ===================================== */

        .account-message {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 22px;
            padding: 15px 18px;
            border-radius: 15px;
            font-weight: 750;
        }

        .account-message.success {
            border: 1px solid rgba(53, 208, 127, 0.3);
            color: #83efb1;
            background: rgba(53, 208, 127, 0.1);
        }

        .account-message.error {
            border: 1px solid rgba(255, 79, 112, 0.3);
            color: #ff9bb0;
            background: rgba(255, 79, 112, 0.09);
        }

        /* =====================================
           PANEL DEL PERFIL
        ===================================== */

        .account-panel,
        .orders-panel {
            border: 1px solid var(--border);
            border-radius: 24px;
            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, 0.075),
                    rgba(255, 255, 255, 0.03)
                );
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .account-panel {
            position: sticky;
            top: 100px;
            padding: 27px;
        }

        .account-panel-heading {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 25px;
        }

        .account-avatar {
            width: 54px;
            height: 54px;
            display: grid;
            place-items: center;
            flex: 0 0 auto;
            border: 1px solid rgba(35, 213, 232, 0.26);
            border-radius: 17px;
            color: var(--cyan);
            background: rgba(35, 213, 232, 0.09);
            font-size: 1.4rem;
        }

        .account-panel-heading span {
            display: block;
            margin-bottom: 3px;
            color: var(--muted);
            font-size: 0.72rem;
            font-weight: 850;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .account-panel-heading h2 {
            margin: 0;
            font-size: 1.45rem;
        }

        .account-form {
            display: grid;
            gap: 16px;
        }

        .account-form + .account-form {
            margin-top: 28px;
            padding-top: 26px;
            border-top: 1px solid rgba(255, 255, 255, 0.09);
        }

        .account-subtitle {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 2px;
            font-size: 1rem;
        }

        .account-subtitle i {
            color: var(--cyan);
        }

        .account-field {
            display: grid;
            gap: 8px;
        }

        .account-field label {
            color: var(--text);
            font-size: 0.86rem;
            font-weight: 800;
        }

        .account-input {
            position: relative;
        }

        .account-input > i {
            position: absolute;
            top: 50%;
            left: 15px;
            z-index: 2;
            color: var(--muted);
            transform: translateY(-50%);
            pointer-events: none;
        }

        .account-input input {
            width: 100%;
            min-height: 50px;
            padding: 0 15px 0 43px;
            border: 1px solid var(--border);
            border-radius: 14px;
            outline: none;
            color: var(--text);
            background: rgba(255, 255, 255, 0.045);
        }

        .account-input input:focus {
            border-color: var(--cyan);
            box-shadow: 0 0 0 4px rgba(35, 213, 232, 0.1);
        }

        .account-input input[readonly] {
            color: var(--muted);
            cursor: not-allowed;
        }

        .field-error {
            color: #ff9bb0;
            font-size: 0.78rem;
            line-height: 1.45;
        }

        .account-form .btn {
            width: 100%;
        }

        .logout-form {
            margin-top: 28px;
            padding-top: 26px;
            border-top: 1px solid rgba(255, 255, 255, 0.09);
        }

        .logout-btn {
            width: 100%;
            color: #fff;
            background: linear-gradient(135deg, #ff5151, #d62828);
            box-shadow: 0 14px 32px rgba(214, 40, 40, 0.22);
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #ff6b6b, #b71c1c);
        }

        .account-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 20px;
            color: var(--muted);
            font-size: 0.8rem;
            line-height: 1.55;
        }

        .account-note i {
            margin-top: 3px;
            color: var(--cyan);
        }

        /* =====================================
           HISTORIAL DE PEDIDOS
        ===================================== */

        .orders-panel {
            min-width: 0;
            padding: 30px;
        }

        .orders-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .orders-heading span {
            display: block;
            margin-bottom: 4px;
            color: var(--muted);
            font-size: 0.72rem;
            font-weight: 850;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .orders-heading h2 {
            margin: 0;
            font-size: 1.65rem;
        }

        .orders-count {
            min-width: 45px;
            height: 45px;
            display: grid;
            place-items: center;
            flex: 0 0 auto;
            border: 1px solid rgba(35, 213, 232, 0.25);
            border-radius: 14px;
            color: var(--cyan);
            background: rgba(35, 213, 232, 0.08);
            font-weight: 900;
        }

        .orders-history {
            display: grid;
            gap: 18px;
        }

        .order-card {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 19px;
            background: rgba(255, 255, 255, 0.035);
        }

        .order-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 19px 21px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .order-card-label {
            display: block;
            margin-bottom: 5px;
            color: var(--muted);
            font-size: 0.7rem;
            font-weight: 850;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .order-number {
            color: var(--text);
            overflow-wrap: anywhere;
        }

        .order-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border: 1px solid rgba(255, 190, 71, 0.3);
            border-radius: 999px;
            color: #ffd27d;
            background: rgba(255, 190, 71, 0.09);
            font-size: 0.72rem;
            font-weight: 850;
            text-transform: uppercase;
        }

        .order-status.completado,
        .order-status.completed,
        .order-status.pagado {
            border-color: rgba(53, 208, 127, 0.3);
            color: #82efaf;
            background: rgba(53, 208, 127, 0.09);
        }

        .order-information {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .order-information > div {
            min-width: 0;
            padding: 18px 21px;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        .order-information > div:last-child {
            border-right: 0;
        }

        .order-information strong {
            display: block;
            overflow-wrap: anywhere;
            color: var(--text);
            font-size: 0.88rem;
            line-height: 1.5;
        }

        .order-information strong i {
            margin-right: 5px;
            color: var(--cyan);
        }

        .order-total {
            color: var(--cyan) !important;
            font-size: 1rem !important;
        }

        .order-reference {
            color: var(--muted) !important;
            font-size: 0.76rem !important;
        }

        .order-products {
            display: grid;
            padding: 0 21px 20px;
        }

        .order-product {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            align-items: center;
            gap: 20px;
            padding: 14px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .order-product strong,
        .order-product small {
            display: block;
        }

        .order-product small {
            margin-top: 4px;
            color: var(--muted);
            font-size: 0.78rem;
        }

        .order-product > span {
            color: var(--cyan);
            font-weight: 850;
            white-space: nowrap;
        }

        .order-summary {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 10px;
            padding: 17px 21px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(255, 255, 255, 0.025);
        }

        .order-summary div {
            min-width: 0;
        }

        .order-summary span {
            display: block;
            margin-bottom: 3px;
            color: var(--muted);
            font-size: 0.7rem;
        }

        .order-summary strong {
            overflow-wrap: anywhere;
            font-size: 0.83rem;
        }

        .order-summary .final-total strong {
            color: var(--cyan);
            font-size: 0.96rem;
        }

        /* =====================================
           SIN PEDIDOS
        ===================================== */

        .orders-empty {
            min-height: 390px;
            display: grid;
            justify-items: center;
            align-content: center;
            padding: 40px 25px;
            border: 1px dashed var(--border);
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.025);
            text-align: center;
        }

        .orders-empty > i {
            margin-bottom: 15px;
            color: var(--cyan);
            font-size: 3rem;
        }

        .orders-empty h3 {
            margin-bottom: 10px;
            font-size: 1.5rem;
        }

        .orders-empty p {
            max-width: 460px;
            margin-bottom: 22px;
            color: var(--muted);
            line-height: 1.6;
        }

        /* =====================================
           BUSCADOR DEL NAVBAR
        ===================================== */

        .header-search {
            flex: 0 1 290px;
            margin: 0;
        }

        .header-search .search-input {
            position: relative;
            width: 100%;
        }

        .header-search .search-input i {
            position: absolute;
            top: 50%;
            left: 15px;
            z-index: 2;
            color: var(--muted);
            transform: translateY(-50%);
            pointer-events: none;
        }

        .header-search .search-input input {
            width: 100%;
            height: 44px;
            min-height: 44px;
            padding: 0 15px 0 43px;
            border: 1px solid var(--border);
            border-radius: 13px;
            color: var(--text);
            background: rgba(255, 255, 255, 0.045);
        }

        /* =====================================
           RESPONSIVE
        ===================================== */

        @media (max-width: 1050px) {
            .account-layout {
                grid-template-columns: 310px minmax(0, 1fr);
            }

            .order-information {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .order-information > div:nth-child(2n) {
                border-right: 0;
            }

            .order-information > div:nth-child(-n + 2) {
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            }

            .order-summary {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 850px) {
            .account-layout {
                grid-template-columns: 1fr;
            }

            .account-panel {
                position: static;
            }

            .header-search {
                flex: 0 1 220px;
            }
        }

        @media (max-width: 760px) {
            .header-search {
                width: 100%;
                flex: none;
            }
        }

        @media (max-width: 600px) {
            .account-container {
                width: calc(100% - 24px);
            }

            .account-header {
                padding: 38px 0 25px;
            }

            .account-header h1 {
                font-size: clamp(2.6rem, 14vw, 3.7rem);
            }

            .account-section {
                padding-top: 10px;
                padding-bottom: 65px;
            }

            .account-panel,
            .orders-panel {
                padding: 20px 17px;
                border-radius: 19px;
            }

            .orders-heading {
                align-items: flex-start;
            }

            .order-card-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .order-information {
                grid-template-columns: 1fr;
            }

            .order-information > div,
            .order-information > div:nth-child(2n),
            .order-information > div:nth-child(-n + 2) {
                border-right: 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            }

            .order-information > div:last-child {
                border-bottom: 0;
            }

            .order-product {
                grid-template-columns: 1fr;
                gap: 7px;
            }

            .order-product > span {
                white-space: normal;
            }

            .order-summary {
                grid-template-columns: 1fr;
            }
        }
        /* =====================================
   PAGINACIÓN DEL HISTORIAL
===================================== */

        .orders-pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;

            margin-top: 25px;
            padding-top: 22px;

            border-top:
                1px solid rgba(255, 255, 255, 0.09);
        }

        .pagination-button {
            min-height: 44px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            padding: 0 17px;

            border: 1px solid var(--border);
            border-radius: 13px;

            color: var(--text);
            background:
                rgba(255, 255, 255, 0.055);

            font-size: 0.86rem;
            font-weight: 850;

            transition:
                transform 0.2s ease,
                color 0.2s ease,
                border-color 0.2s ease,
                background 0.2s ease;
        }

        .pagination-button:hover {
            color: var(--cyan);

            border-color:
                rgba(35, 213, 232, 0.38);

            background:
                rgba(35, 213, 232, 0.08);

            transform: translateY(-2px);
        }

        .pagination-button.disabled {
            color: rgba(185, 191, 211, 0.45);
            background: rgba(255, 255, 255, 0.025);
            cursor: not-allowed;
            pointer-events: none;
        }

        .pagination-status {
            color: var(--muted);
            font-size: 0.87rem;
            text-align: center;
        }

        .pagination-status strong {
            color: var(--cyan);
        }
    </style>
</head>

<body>

<div class="topbar">
    Diseño gráfico, edición audiovisual y contenido digital desde El Paraíso, Honduras.
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
            type="button"
            class="menu-toggle"
            aria-label="Abrir menú"
            aria-expanded="false"
        >
            ☰
        </button>

        <div
            class="nav-links"
            id="navLinks"
        >
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

    <header class="account-header">
        <div class="account-container">

            <nav class="breadcrumbs">

                <a href="{{ route('index') }}">
                    Inicio
                </a>

                <span>›</span>

                <span>Mi cuenta</span>

            </nav>

            <span class="eyebrow">
                Mi cuenta
            </span>

            <h1>
                Pedidos y datos del cliente.
            </h1>

            <p>
                Consulta los pedidos asociados con tu cuenta,
                actualiza tu nombre o cambia tu contraseña.
            </p>

        </div>
    </header>

    <section class="account-section">
        <div class="account-container">

            @if(session('success'))
                <div class="account-message success">

                    <i class="bi bi-check-circle-fill"></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>
            @endif

            @if(
                $errors->perfil->any() ||
                $errors->password->any()
            )
                <div class="account-message error">

                    <i class="bi bi-exclamation-circle-fill"></i>

                    <span>
                        Revisa los datos ingresados en el formulario.
                    </span>

                </div>
            @endif

            <div class="account-layout">

                <aside class="account-panel">

                    <div class="account-panel-heading">

                        <div class="account-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>

                        <div>
                            <span>Información personal</span>

                            <h2>
                                Mi perfil
                            </h2>
                        </div>

                    </div>

                    {{-- Actualizar nombre --}}
                    <form
                        class="account-form"
                        action="{{ route('cuenta.perfil.actualizar') }}"
                        method="POST"
                    >
                        @csrf
                        @method('PUT')

                        <h3 class="account-subtitle">
                            <i class="bi bi-pencil-square"></i>
                            Datos de la cuenta
                        </h3>

                        <div class="account-field">

                            <label for="profileName">
                                Nombre completo
                            </label>

                            <div class="account-input">

                                <i class="bi bi-person"></i>

                                <input
                                    id="profileName"
                                    name="name"
                                    type="text"
                                    value="{{ old('name', auth()->user()->name) }}"
                                    required
                                >

                            </div>

                            @error('name', 'perfil')
                            <span class="field-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="account-field">

                            <label for="profileEmail">
                                Correo electrónico
                            </label>

                            <div class="account-input">

                                <i class="bi bi-envelope"></i>

                                <input
                                    id="profileEmail"
                                    type="email"
                                    value="{{ auth()->user()->email }}"
                                    readonly
                                >

                            </div>

                        </div>

                        <button
                            class="btn btn-primary"
                            type="submit"
                        >
                            <i class="bi bi-check-circle"></i>
                            Guardar nombre
                        </button>

                    </form>

                    {{-- Cambiar contraseña --}}
                    <form
                        class="account-form"
                        action="{{ route('cuenta.password.actualizar') }}"
                        method="POST"
                    >
                        @csrf
                        @method('PUT')

                        <h3 class="account-subtitle">
                            <i class="bi bi-shield-lock"></i>
                            Cambiar contraseña
                        </h3>

                        <div class="account-field">

                            <label for="currentPassword">
                                Contraseña actual
                            </label>

                            <div class="account-input">

                                <i class="bi bi-lock"></i>

                                <input
                                    id="currentPassword"
                                    name="current_password"
                                    type="password"
                                    autocomplete="current-password"
                                    required
                                >

                            </div>

                            @error('current_password', 'password')
                            <span class="field-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="account-field">

                            <label for="newPassword">
                                Nueva contraseña
                            </label>

                            <div class="account-input">

                                <i class="bi bi-key"></i>

                                <input
                                    id="newPassword"
                                    name="password"
                                    type="password"
                                    autocomplete="new-password"
                                    required
                                >

                            </div>

                            @error('password', 'password')
                            <span class="field-error">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>

                        <div class="account-field">

                            <label for="passwordConfirmation">
                                Confirmar nueva contraseña
                            </label>

                            <div class="account-input">

                                <i class="bi bi-key-fill"></i>

                                <input
                                    id="passwordConfirmation"
                                    name="password_confirmation"
                                    type="password"
                                    autocomplete="new-password"
                                    required
                                >

                            </div>

                        </div>

                        <button
                            class="btn btn-secondary"
                            type="submit"
                        >
                            <i class="bi bi-shield-check"></i>
                            Actualizar contraseña
                        </button>

                    </form>

                    {{-- Cerrar sesión --}}
                    <form
                        class="logout-form"
                        action="{{ route('usuario.logout') }}"
                        method="POST"
                    >
                        @csrf

                        <button
                            class="btn logout-btn"
                            type="submit"
                        >
                            <i class="bi bi-box-arrow-right"></i>
                            Cerrar sesión
                        </button>

                    </form>

                    <p class="account-note">

                        <i class="bi bi-info-circle-fill"></i>

                        <span>
                            Tus pedidos se muestran si tienes iniciada sesion con tu cuenta.
                        </span>

                    </p>

                </aside>

                {{-- Historial --}}
                <section class="orders-panel">

                    <div class="orders-heading">

                        <div>
                            <span>Compras realizadas</span>

                            <h2>
                                Historial de pedidos
                            </h2>
                        </div>

                        <div
                            class="orders-count"
                            title="Cantidad de pedidos"
                        >
                            {{ $pedidos->total() }}
                        </div>

                    </div>

                    <div class="orders-history">

                        @forelse($pedidos as $pedido)

                            @php
                                $estadoPedido = strtolower(
                                    $pedido->estado ?? 'pendiente'
                                );
                            @endphp

                            <article class="order-card">

                                <div class="order-card-header">

                                    <div>
                                        <span class="order-card-label">
                                            Número de pedido
                                        </span>

                                        <strong class="order-number">
                                            {{ $pedido->numero_pedido }}
                                        </strong>
                                    </div>

                                    <span
                                        class="order-status {{ $estadoPedido }}"
                                    >
                                        <i class="bi bi-clock-history"></i>

                                        {{ strtoupper($pedido->estado) }}
                                    </span>

                                </div>

                                <div class="order-information">

                                    <div>
                                        <span class="order-card-label">
                                            Fecha
                                        </span>

                                        <strong>
                                            <i class="bi bi-calendar-check"></i>

                                            {{ optional($pedido->created_at)->format('d/m/Y h:i a') }}
                                        </strong>
                                    </div>

                                    <div>
                                        <span class="order-card-label">
                                            Método de pago
                                        </span>

                                        <strong>
                                            <i class="bi bi-paypal"></i>

                                            {{ ucfirst($pedido->metodo_pago) }}
                                        </strong>
                                    </div>

                                    <div>
                                        <span class="order-card-label">
                                            Referencia
                                        </span>

                                        <strong class="order-reference">
                                            {{ $pedido->referencia_pago ?: 'Sin referencia' }}
                                        </strong>
                                    </div>

                                    <div>
                                        <span class="order-card-label">
                                            Total
                                        </span>

                                        <strong class="order-total">
                                            L {{ number_format($pedido->total, 2) }}
                                        </strong>
                                    </div>

                                </div>

                                @if($pedido->detalles->isNotEmpty())

                                    <div class="order-products">

                                        @foreach($pedido->detalles as $detalle)

                                            <div class="order-product">

                                                <div>
                                                    <strong>
                                                        {{ $detalle->nombre_servicio }}
                                                    </strong>

                                                    <small>
                                                        Cantidad:
                                                        {{ $detalle->cantidad }}

                                                        · Precio unitario:
                                                        L {{ number_format($detalle->precio_unitario, 2) }}
                                                    </small>
                                                </div>

                                                <span>
                                                    L {{ number_format($detalle->subtotal, 2) }}
                                                </span>

                                            </div>

                                        @endforeach

                                    </div>

                                @endif

                                <div class="order-summary">

                                    <div>
                                        <span>Subtotal</span>

                                        <strong>
                                            L {{ number_format($pedido->subtotal, 2) }}
                                        </strong>
                                    </div>

                                    <div>
                                        <span>Descuento</span>

                                        <strong>
                                            − L {{ number_format($pedido->descuento, 2) }}
                                        </strong>
                                    </div>

                                    <div>
                                        <span>ISV</span>

                                        <strong>
                                            L {{ number_format($pedido->impuesto, 2) }}
                                        </strong>
                                    </div>

                                    <div class="final-total">
                                        <span>Total pagado</span>

                                        <strong>
                                            L {{ number_format($pedido->total, 2) }}
                                        </strong>
                                    </div>

                                </div>

                            </article>

                        @empty

                            <div class="orders-empty">

                                <i class="bi bi-receipt-cutoff"></i>

                                <h3>
                                    Todavía no tienes pedidos
                                </h3>

                                <p>
                                    Cuando completes una compra mientras
                                    tengas iniciada esta sesión, el pedido
                                    aparecerá automáticamente aquí.
                                </p>

                                <a
                                    href="{{ route('catalogo') }}"
                                    class="btn btn-primary"
                                >
                                    <i class="bi bi-bag"></i>
                                    Ir a la tienda
                                </a>

                            </div>

                        @endforelse

                    </div>
                    @if($pedidos->hasPages())

                        <nav
                            class="orders-pagination"
                            aria-label="Paginación del historial de pedidos"
                        >

                            {{-- Página anterior --}}
                            @if($pedidos->onFirstPage())

                                <span
                                    class="pagination-button disabled"
                                    aria-disabled="true"
                                >
                <i class="bi bi-chevron-left"></i>
                Anterior
            </span>

                            @else

                                <a
                                    class="pagination-button"
                                    href="{{ $pedidos->previousPageUrl() }}"
                                    rel="prev"
                                >
                                    <i class="bi bi-chevron-left"></i>
                                    Anterior
                                </a>

                            @endif

                            {{-- Número de página --}}
                            <span class="pagination-status">

            Página

            <strong>
                {{ $pedidos->currentPage() }}
            </strong>

            de

            <strong>
                {{ $pedidos->lastPage() }}
            </strong>

        </span>

                            {{-- Página siguiente --}}
                            @if($pedidos->hasMorePages())

                                <a
                                    class="pagination-button"
                                    href="{{ $pedidos->nextPageUrl() }}"
                                    rel="next"
                                >
                                    Siguiente
                                    <i class="bi bi-chevron-right"></i>
                                </a>

                            @else

                                <span
                                    class="pagination-button disabled"
                                    aria-disabled="true"
                                >
                Siguiente
                <i class="bi bi-chevron-right"></i>
            </span>

                            @endif

                        </nav>

                    @endif

                </section>

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

                <h4>Contacto</h4>

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

                <h4>Redes sociales</h4>

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
    href="https://wa.me/50492336467"
    target="_blank"
    rel="noopener"
    aria-label="Contactar por WhatsApp"
    title="WhatsApp"
>
    <i class="bi bi-whatsapp"></i>
</a>

<script src="{{ asset('js/store.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/cart-count.js') }}?v={{ time() }}"></script>

</body>
</html>
