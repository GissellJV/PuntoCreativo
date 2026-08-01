<style>
    .auth-field-error {
        margin-top: 6px;
        color: #ff6b6b;
        font-size: 0.85rem;
        line-height: 1.3;
    }
</style>

@php
    $panelInicial = session('open_auth_modal');

    if ($errors->getBag('registro')->any()) {
        $panelInicial = 'register';
    } elseif ($errors->getBag('inicioSesion')->any()) {
        $panelInicial = 'login';
    }

    if (!in_array($panelInicial, ['login', 'register'], true)) {
        $panelInicial = null;
    }
@endphp

@guest
    <div
        class="auth-modal"
        id="authModal"
        data-initial-panel="{{ $panelInicial }}"
        aria-hidden="true"
        role="dialog"
        aria-modal="true"
        aria-labelledby="authModalTitle"
    >
        {{-- Fondo oscuro del modal --}}
        <div
            class="auth-modal-overlay"
            data-auth-close
        ></div>

        <div class="auth-modal-card">

            {{-- Botón para cerrar --}}
            <button
                type="button"
                class="auth-modal-close"
                aria-label="Cerrar"
                data-auth-close
            >
                <i class="bi bi-x-lg"></i>
            </button>

            {{-- Encabezado --}}
            <div class="auth-modal-header">
                <span class="eyebrow">Mi cuenta</span>

                <h2 id="authModalTitle">
                    Bienvenido a
                    <span class="gradient-text">
                        Punto Creativo
                    </span>
                </h2>

                <p>
                    Inicia sesión o crea una cuenta para continuar.
                </p>
            </div>

            {{-- Formulario de inicio de sesión --}}
            <form
                action="{{ route('usuario.login') }}"
                method="POST"
                class="auth-form active"
                data-auth-panel="login"
            >
                @csrf

                {{-- Credenciales incorrectas --}}
                @error('credenciales', 'inicioSesion')
                <div class="auth-alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ $message }}
                </div>
                @enderror

                {{-- Correo --}}
                <div class="field full">
                    <label for="login_email">
                        Correo electrónico
                    </label>

                    <div class="auth-input">
                        <i class="bi bi-envelope-fill"></i>

                        <input
                            type="email"
                            id="login_email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="correo@ejemplo.com"
                            autocomplete="email"

                        >
                    </div>

                    @error('email', 'inicioSesion')
                    <div class="auth-field-error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="field full">
                    <label for="login_password">
                        Contraseña
                    </label>

                    <div class="auth-input">
                        <i class="bi bi-lock-fill"></i>

                        <input
                            type="password"
                            id="login_password"
                            name="password"
                            placeholder="Ingrese su contraseña"
                            autocomplete="current-password"

                        >
                    </div>

                    @error('password', 'inicioSesion')
                    <div class="auth-field-error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Recordar sesión --}}
                <label class="remember-option">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        @checked(old('remember'))
                    >

                    <span>Recordarme</span>
                </label>

                {{-- Botón de inicio de sesión --}}
                <button
                    type="submit"
                    class="btn btn-primary auth-submit"
                >
                    <i class="bi bi-box-arrow-in-right"></i>
                    Iniciar sesión
                </button>

                {{-- Cambiar al registro --}}
                <p class="auth-switch">
                    ¿No tienes una cuenta?

                    <button
                        type="button"
                        class="auth-link"
                        data-auth-tab="register"
                    >
                        Registrarse
                    </button>
                </p>
            </form>

            {{-- Formulario de registro --}}
            <form
                action="{{ route('usuario.registrarse') }}"
                method="POST"
                class="auth-form"
                data-auth-panel="register"
            >
                @csrf

                {{-- Nombre --}}
                <div class="field full">
                    <label for="register_name">
                        Nombre completo
                    </label>

                    <div class="auth-input">
                        <i class="bi bi-person-fill"></i>

                        <input
                            type="text"
                            id="register_name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Ingrese su nombre"
                            autocomplete="name"

                        >
                    </div>

                    @error('name', 'registro')
                    <div class="auth-field-error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Correo --}}
                <div class="field full">
                    <label for="register_email">
                        Correo electrónico
                    </label>

                    <div class="auth-input">
                        <i class="bi bi-envelope-fill"></i>

                        <input
                            type="email"
                            id="register_email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="correo@ejemplo.com"
                            autocomplete="email"

                        >
                    </div>

                    @error('email', 'registro')
                    <div class="auth-field-error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="field full">
                    <label for="register_password">
                        Contraseña
                    </label>

                    <div class="auth-input">
                        <i class="bi bi-lock-fill"></i>

                        <input
                            type="password"
                            id="register_password"
                            name="password"
                            placeholder="Mínimo 8 caracteres"
                            autocomplete="new-password"

                        >
                    </div>

                    @error('password', 'registro')
                    <div class="auth-field-error">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Confirmar contraseña --}}
                <div class="field full">
                    <label for="password_confirmation">
                        Confirmar contraseña
                    </label>

                    <div class="auth-input">
                        <i class="bi bi-shield-lock-fill"></i>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Repita su contraseña"
                            autocomplete="new-password"

                        >
                    </div>
                </div>

                {{-- Botón para crear cuenta --}}
                <button
                    type="submit"
                    class="btn btn-primary auth-submit"
                >
                    <i class="bi bi-person-plus-fill"></i>
                    Crear cuenta
                </button>

                {{-- Regresar al inicio de sesión --}}
                <p class="auth-switch">
                    ¿Ya tienes una cuenta?

                    <button
                        type="button"
                        class="auth-link"
                        data-auth-tab="login"
                    >
                        Iniciar sesión
                    </button>
                </p>
            </form>

        </div>
    </div>
@endguest
