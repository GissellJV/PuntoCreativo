<div
    class="cookie-consent"
    id="cookieConsent"
    role="dialog"
    aria-modal="false"
    aria-labelledby="cookieConsentTitle"
    aria-describedby="cookieConsentDescription"
    hidden
>
    <div class="cookie-consent__inner">

        <div class="cookie-consent__icon" aria-hidden="true">
            <i class="bi bi-shield-check"></i>
        </div>

        <div class="cookie-consent__content">

            <strong id="cookieConsentTitle">
                Tu privacidad es importante
            </strong>

            <p id="cookieConsentDescription">
                Punto Creativo utiliza almacenamiento local para conservar
                el carrito, el cupón y tu preferencia sobre este aviso.
                No utilizamos cookies publicitarias en este prototipo.

                <a href="{{ route('cookies') }}">
                    Leer política de cookies
                </a>
            </p>

        </div>

        <div class="cookie-consent__actions">

            <button
                type="button"
                class="cookie-consent__button cookie-consent__button--secondary"
                data-cookie-reject
            >
                <i class="bi bi-x-circle"></i>
                Rechazar
            </button>

            <button
                type="button"
                class="cookie-consent__button cookie-consent__button--primary"
                data-cookie-accept
            >
                <i class="bi bi-check-circle"></i>
                Aceptar
            </button>

        </div>

    </div>
</div>
