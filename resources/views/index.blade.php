<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <meta
        name="description"
        content="Punto Creativo: servicios de diseño gráfico, edición audiovisual y contenido digital en Honduras."
    >

    <title>Punto Creativo | Diseño gráfico y edición audiovisual</title>

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
        href="{{ asset('css/cookie-banner.css') }}?v={{ time() }}"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>
        :root {
            --bg: #080a13;
            --bg-soft: #111526;
            --card: rgba(255, 255, 255, 0.075);
            --card-strong: rgba(255, 255, 255, 0.11);
            --text: #f7f8ff;
            --muted: #b9bfd3;
            --purple: #8d5cff;
            --cyan: #23d5e8;
            --pink: #ff4fa3;
            --orange: #ff9f43;
            --green: #35d07f;
            --border: rgba(255, 255, 255, 0.14);
            --shadow: 0 22px 70px rgba(0, 0, 0, 0.38);
            --radius: 22px;
            --container: 1180px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            overflow-x: hidden;
            color: var(--text);
            background:
                radial-gradient(
                    circle at 12% 7%,
                    rgba(141, 92, 255, 0.24),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 90% 16%,
                    rgba(35, 213, 232, 0.16),
                    transparent 28%
                ),
                var(--bg);
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
            line-height: 1.6;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: -1;
            pointer-events: none;
            opacity: 0.17;
            background-image:
                linear-gradient(
                    rgba(255, 255, 255, 0.025) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(255, 255, 255, 0.025) 1px,
                    transparent 1px
                );
            background-size: 42px 42px;
            mask-image:
                linear-gradient(
                    to bottom,
                    black,
                    transparent 85%
                );
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font: inherit;
        }

        button {
            color: inherit;
        }

        img {
            display: block;
            max-width: 100%;
        }

        .container {
            width: min(
                calc(100% - 40px),
                var(--container)
            );
            margin-inline: auto;
        }

        .section {
            padding: 78px 0;
        }

        .section-soft {
            border-top:
                1px solid rgba(255, 255, 255, 0.07);
            border-bottom:
                1px solid rgba(255, 255, 255, 0.07);
            background:
                rgba(255, 255, 255, 0.018);
        }

        .section-heading {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 30px;
        }

        .section-heading > div {
            max-width: 720px;
        }

        .section-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 10px;
            color: var(--cyan);
            font-size: 0.77rem;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .section-kicker::before {
            content: "";
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background:
                linear-gradient(
                    135deg,
                    var(--cyan),
                    var(--purple)
                );
            box-shadow:
                0 0 18px rgba(35, 213, 232, 0.6);
        }

        .section-heading h2 {
            margin-bottom: 10px;
            font-size:
                clamp(2rem, 4vw, 3.3rem);
            line-height: 1.05;
            letter-spacing: -0.045em;
        }

        .section-heading p {
            color: var(--muted);
            font-size: 1rem;
        }

        .section-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex: 0 0 auto;
            color: var(--cyan);
            font-size: 0.9rem;
            font-weight: 850;
        }

        .section-link:hover {
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        .btn {
            min-height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 0 18px;
            border: 1px solid transparent;
            border-radius: 13px;
            font-weight: 850;
            cursor: pointer;
            transition:
                transform 0.22s ease,
                border-color 0.22s ease,
                background 0.22s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            color: #071018;
            background:
                linear-gradient(
                    135deg,
                    var(--cyan),
                    #91eff7
                );
            box-shadow:
                0 14px 34px rgba(35, 213, 232, 0.2);
        }

        .btn-secondary {
            border-color: var(--border);
            color: var(--text);
            background:
                rgba(255, 255, 255, 0.055);
        }

        /* =====================================
           ENCABEZADO
        ===================================== */

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom:
                1px solid rgba(255, 255, 255, 0.08);
            background:
                rgba(8, 10, 19, 0.9);
            box-shadow:
                0 10px 35px rgba(0, 0, 0, 0.16);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .nav-inner {
            min-height: 78px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            flex: 0 0 auto;
            font-size: 1.12rem;
            font-weight: 950;
            letter-spacing: -0.035em;
        }

        .brand-mark {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background:
                conic-gradient(
                    from 210deg,
                    var(--purple),
                    var(--cyan),
                    var(--pink),
                    var(--orange),
                    var(--purple)
                );
            box-shadow:
                0 10px 28px rgba(141, 92, 255, 0.28);
            transform: rotate(-6deg);
        }

        .brand-mark span {
            width: 25px;
            height: 25px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            color: #fff;
            background: var(--bg);
            font-size: 0.78rem;
            transform: rotate(6deg);
        }

        .menu-toggle {
            display: none;
            width: 46px;
            height: 46px;
            place-items: center;
            border: 1px solid var(--border);
            border-radius: 13px;
            color: var(--text);
            background:
                rgba(255, 255, 255, 0.055);
            cursor: pointer;
            font-size: 1.35rem;
        }

        .nav-links {
            min-width: 0;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 20px;
            color: #dfe3f4;
            font-size: 0.9rem;
            font-weight: 750;
        }

        .nav-links > a:not(.nav-icon) {
            transition: color 0.2s ease;
        }

        .nav-links > a:not(.nav-icon):hover {
            color: var(--cyan);
        }

        .header-search {
            width: 238px;
            flex: 0 1 238px;
            margin: 0;
        }

        .search-input {
            position: relative;
            width: 100%;
            height: 44px;
        }

        .search-input i {
            position: absolute;
            top: 50%;
            left: 15px;
            z-index: 2;
            color: var(--muted);
            font-size: 0.95rem;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .search-input input {
            width: 100%;
            height: 44px;
            padding: 0 14px 0 43px;
            border: 1px solid var(--border);
            border-radius: 13px;
            outline: none;
            color: var(--text);
            background:
                rgba(255, 255, 255, 0.045);
        }

        .search-input input::placeholder {
            color: var(--muted);
            opacity: 0.72;
        }

        .search-input input:focus {
            border-color: var(--cyan);
            box-shadow:
                0 0 0 4px rgba(35, 213, 232, 0.1);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-icon {
            position: relative;
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            border: 1px solid var(--border);
            border-radius: 13px;
            color: var(--text);
            background:
                rgba(255, 255, 255, 0.05);
            cursor: pointer;
            transition:
                transform 0.2s ease,
                color 0.2s ease,
                border-color 0.2s ease,
                background 0.2s ease;
        }

        .nav-icon:hover {
            color: var(--cyan);
            border-color:
                rgba(35, 213, 232, 0.4);
            background:
                rgba(35, 213, 232, 0.08);
            transform: translateY(-2px);
        }

        .nav-icon i {
            font-size: 1.08rem;
            line-height: 1;
        }

        .account-modal-open {
            padding: 0;
        }

        .cart-badge {
            position: absolute;
            top: -7px;
            right: -7px;
            z-index: 3;
            min-width: 21px;
            height: 21px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 5px;
            border: 2px solid var(--bg);
            border-radius: 999px;
            color: #fff;
            background: var(--pink);
            font-size: 0.69rem;
            font-weight: 900;
            line-height: 1;
        }

        /* =====================================
           HERO
        ===================================== */

        .hero {
            padding: 74px 0 62px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns:
                minmax(0, 1fr)
                minmax(360px, 0.9fr);
            align-items: stretch;
            gap: 34px;
        }

        .hero-content {
            min-height: 410px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 46px;
            border: 1px solid var(--border);
            border-radius: 26px;
            background:
                radial-gradient(
                    circle at 10% 0%,
                    rgba(141, 92, 255, 0.2),
                    transparent 34%
                ),
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, 0.085),
                    rgba(255, 255, 255, 0.035)
                );
            box-shadow: var(--shadow);
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            align-self: flex-start;
            margin-bottom: 18px;
            color: var(--cyan);
            font-size: 0.79rem;
            font-weight: 900;
            letter-spacing: 0.11em;
            text-transform: uppercase;
        }

        .hero-content h1 {
            max-width: 720px;
            margin-bottom: 20px;
            font-size:
                clamp(2.7rem, 6vw, 5.3rem);
            line-height: 0.99;
            letter-spacing: -0.06em;
        }

        .hero-content h1 span {
            background:
                linear-gradient(
                    100deg,
                    #fff 5%,
                    var(--cyan) 45%,
                    var(--purple) 73%,
                    var(--pink)
                );
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .hero-content p {
            max-width: 660px;
            margin-bottom: 28px;
            color: var(--muted);
            font-size: 1.07rem;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .hero-visual {
            position: relative;
            min-height: 410px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 26px;
            background:
                radial-gradient(
                    circle at 75% 25%,
                    rgba(35, 213, 232, 0.28),
                    transparent 25%
                ),
                radial-gradient(
                    circle at 25% 80%,
                    rgba(255, 79, 163, 0.22),
                    transparent 28%
                ),
                linear-gradient(
                    145deg,
                    #171c38,
                    #0c0f1d
                );
            box-shadow: var(--shadow);
        }

        .hero-visual::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            right: -90px;
            top: -90px;
            border: 28px solid rgba(255, 255, 255, 0.08);
            border-radius: 44% 56% 61% 39%;
            transform: rotate(28deg);
        }

        .hero-screen {
            position: absolute;
            inset: 54px 42px 42px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 24px;
            background:
                rgba(10, 13, 27, 0.88);
            box-shadow:
                0 24px 55px rgba(0, 0, 0, 0.35);
            transform: rotate(2.5deg);
        }

        .hero-screen-bar {
            height: 42px;
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 0 16px;
            border-bottom:
                1px solid rgba(255, 255, 255, 0.08);
        }

        .hero-screen-bar span {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background:
                rgba(255, 255, 255, 0.2);
        }

        .hero-screen-content {
            height: calc(100% - 42px);
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            gap: 12px;
            padding: 16px;
        }

        .visual-card {
            min-height: 0;
            overflow: hidden;
            border-radius: 17px;
        }

        .visual-card-main {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 22px;
            background:
                linear-gradient(
                    145deg,
                    #5c2fd5,
                    #b947d3 58%,
                    #ff5ca8
                );
        }

        .visual-card-main small {
            margin-bottom: 7px;
            font-weight: 900;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .visual-card-main strong {
            max-width: 180px;
            font-size: 1.8rem;
            line-height: 1;
            letter-spacing: -0.05em;
        }

        .visual-side {
            display: grid;
            grid-template-rows: 1fr 1fr;
            gap: 12px;
        }

        .visual-card-video,
        .visual-card-social {
            display: flex;
            align-items: end;
            padding: 18px;
            font-weight: 850;
        }

        .visual-card-video {
            background:
                linear-gradient(
                    135deg,
                    #08636f,
                    #21c8d7
                );
        }

        .visual-card-social {
            background:
                linear-gradient(
                    135deg,
                    #7c3c0c,
                    #ff9f43
                );
        }

        .floating-note {
            position: absolute;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 14px;
            border: 1px solid var(--border);
            border-radius: 14px;
            color: #eef1ff;
            background:
                rgba(8, 10, 19, 0.88);
            box-shadow:
                0 14px 35px rgba(0, 0, 0, 0.32);
            font-size: 0.83rem;
            font-weight: 850;
            backdrop-filter: blur(12px);
        }

        .floating-note.one {
            top: 23px;
            right: 18px;
            transform: rotate(-3deg);
        }

        .floating-note.two {
            bottom: 18px;
            left: 18px;
            transform: rotate(2deg);
        }

        /* =====================================
           CATEGORÍAS
        ===================================== */

        .category-grid {
            display: grid;
            grid-template-columns:
                repeat(4, minmax(0, 1fr));
            gap: 16px;
        }

        .category-card {
            min-height: 170px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 23px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, 0.075),
                    rgba(255, 255, 255, 0.03)
                );
            transition:
                transform 0.25s ease,
                border-color 0.25s ease,
                background 0.25s ease;
        }

        .category-card:hover {
            border-color:
                rgba(35, 213, 232, 0.4);
            background:
                linear-gradient(
                    145deg,
                    rgba(35, 213, 232, 0.11),
                    rgba(141, 92, 255, 0.08)
                );
            transform: translateY(-5px);
        }

        .category-icon {
            width: 51px;
            height: 51px;
            display: grid;
            place-items: center;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 15px;
            color: var(--cyan);
            background:
                rgba(255, 255, 255, 0.065);
            font-size: 1.35rem;
        }

        .category-card h3 {
            margin-bottom: 5px;
            font-size: 1.08rem;
        }

        .category-card p {
            color: var(--muted);
            font-size: 0.84rem;
        }

        /* =====================================
           SERVICIOS DESTACADOS
        ===================================== */

        .featured-grid {
            display: grid;
            grid-template-columns:
                repeat(4, minmax(0, 1fr));
            gap: 17px;
        }

        .service-card {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 21px;
            background:
                rgba(255, 255, 255, 0.045);
            transition:
                transform 0.25s ease,
                border-color 0.25s ease;
        }

        .service-card:hover {
            border-color:
                rgba(35, 213, 232, 0.4);
            transform: translateY(-5px);
        }

        .service-image {
            position: relative;
            aspect-ratio: 4 / 3;
            display: grid;
            place-items: center;
            overflow: hidden;
            color: rgba(255, 255, 255, 0.9);
            font-size: 3rem;
        }

        .service-image::before {
            content: "";
            position: absolute;
            width: 150px;
            height: 150px;
            right: -45px;
            top: -45px;
            border:
                18px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .service-image.logo {
            background:
                linear-gradient(
                    145deg,
                    #3c248e,
                    #8659ee
                );
        }

        .service-image.video {
            background:
                linear-gradient(
                    145deg,
                    #07505b,
                    #16a9b8
                );
        }

        .service-image.social {
            background:
                linear-gradient(
                    145deg,
                    #7e254f,
                    #e74997
                );
        }

        .service-image.motion {
            background:
                linear-gradient(
                    145deg,
                    #81410f,
                    #ef8f35
                );
        }

        .service-image i {
            position: relative;
            z-index: 1;
        }

        .service-card-body {
            padding: 18px;
        }

        .service-category {
            display: block;
            margin-bottom: 6px;
            color: var(--muted);
            font-size: 0.72rem;
            font-weight: 850;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .service-card h3 {
            min-height: 47px;
            margin-bottom: 13px;
            font-size: 1.06rem;
            line-height: 1.25;
        }

        .service-price {
            margin-bottom: 15px;
            color: var(--cyan);
            font-size: 1.08rem;
            font-weight: 950;
        }

        .service-card .btn {
            width: 100%;
            min-height: 43px;
            font-size: 0.83rem;
        }

        /* =====================================
           PORTAFOLIO
        ===================================== */

        .portfolio-grid {
            display: grid;
            grid-template-columns:
                repeat(12, minmax(0, 1fr));
            grid-auto-rows: 205px;
            gap: 15px;
        }

        .portfolio-item {
            position: relative;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 20px;
            isolation: isolate;
            transition:
                transform 0.25s ease,
                border-color 0.25s ease;
        }

        .portfolio-item:hover {
            border-color:
                rgba(35, 213, 232, 0.42);
            transform: scale(0.985);
        }

        .portfolio-item:nth-child(1) {
            grid-column: span 4;
        }

        .portfolio-item:nth-child(2) {
            grid-column: span 4;
        }

        .portfolio-item:nth-child(3) {
            grid-column: span 4;
        }

        .portfolio-item:nth-child(4) {
            grid-column: span 6;
        }

        .portfolio-item:nth-child(5) {
            grid-column: span 6;
        }

        .portfolio-item::before {
            content: "";
            position: absolute;
            width: 190px;
            height: 190px;
            right: -65px;
            top: -80px;
            border:
                20px solid rgba(255, 255, 255, 0.1);
            border-radius: 44% 56% 38% 62%;
            transform: rotate(25deg);
            z-index: -1;
        }

        .portfolio-item.one {
            background:
                linear-gradient(
                    135deg,
                    #362086,
                    #8d5cff
                );
        }

        .portfolio-item.two {
            background:
                linear-gradient(
                    135deg,
                    #07505e,
                    #23b9c9
                );
        }

        .portfolio-item.three {
            background:
                linear-gradient(
                    135deg,
                    #6d254c,
                    #e64c98
                );
        }

        .portfolio-item.four {
            background:
                linear-gradient(
                    135deg,
                    #78400f,
                    #ef983e
                );
        }

        .portfolio-item.five {
            background:
                linear-gradient(
                    135deg,
                    #173e72,
                    #4d8ee8
                );
        }

        .portfolio-content {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 22px;
            background:
                linear-gradient(
                    to top,
                    rgba(4, 5, 11, 0.82),
                    transparent 70%
                );
        }

        .portfolio-content i {
            position: absolute;
            top: 22px;
            left: 22px;
            font-size: 1.5rem;
        }

        .portfolio-content small {
            color: rgba(255, 255, 255, 0.74);
            font-weight: 850;
            letter-spacing: 0.09em;
            text-transform: uppercase;
        }

        .portfolio-content h3 {
            margin-top: 4px;
            font-size: 1.35rem;
        }

        /* =====================================
           NOSOTROS Y TESTIMONIOS
        ===================================== */

        .about-strip {
            display: grid;
            grid-template-columns:
                minmax(0, 0.8fr)
                minmax(0, 1.2fr);
            gap: 24px;
            align-items: stretch;
            margin-bottom: 52px;
        }

        .about-visual,
        .about-copy {
            padding: 32px;
            border: 1px solid var(--border);
            border-radius: 22px;
            background:
                rgba(255, 255, 255, 0.045);
        }

        .about-visual {
            display: grid;
            place-items: center;
            min-height: 230px;
            background:
                radial-gradient(
                    circle at 30% 20%,
                    rgba(35, 213, 232, 0.25),
                    transparent 24%
                ),
                radial-gradient(
                    circle at 75% 80%,
                    rgba(255, 79, 163, 0.22),
                    transparent 26%
                ),
                #111526;
        }

        .about-visual strong {
            font-size: 6rem;
            line-height: 1;
            letter-spacing: -0.1em;
            color:
                rgba(255, 255, 255, 0.13);
        }

        .about-copy h2 {
            margin-bottom: 14px;
            font-size:
                clamp(1.9rem, 4vw, 3rem);
            letter-spacing: -0.045em;
        }

        .about-copy p {
            color: var(--muted);
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns:
                repeat(3, minmax(0, 1fr));
            gap: 17px;
        }

        .testimonial {
            min-height: 215px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 25px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background:
                linear-gradient(
                    145deg,
                    rgba(255, 255, 255, 0.075),
                    rgba(255, 255, 255, 0.03)
                );
        }

        .quote-icon {
            color: var(--cyan);
            font-size: 1.45rem;
        }

        .testimonial blockquote {
            margin: 18px 0 22px;
            color: #eef1ff;
            font-size: 1rem;
            line-height: 1.65;
        }

        .testimonial footer {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0;
            border: 0;
            background: transparent;
        }

        .client-avatar {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            flex: 0 0 auto;
            border-radius: 50%;
            color: #071018;
            background:
                linear-gradient(
                    135deg,
                    var(--cyan),
                    #91eff7
                );
            font-weight: 950;
        }

        .client-data strong,
        .client-data small {
            display: block;
        }

        .client-data small {
            color: var(--muted);
            font-size: 0.77rem;
        }

        /* =====================================
           MENSAJES
        ===================================== */

        .alert-success,
        .alert-error {
            position: fixed;
            top: 95px;
            right: 22px;
            z-index: 5000;
            min-width: 300px;
            max-width: 420px;
            padding: 14px 17px;
            border-radius: 14px;
            color: #fff;
            box-shadow:
                0 18px 45px rgba(0, 0, 0, 0.3);
            font-size: 0.9rem;
            font-weight: 750;
        }

        .alert-success {
            background:
                linear-gradient(
                    135deg,
                    #19c37d,
                    #0f9d58
                );
        }

        .alert-error {
            background:
                linear-gradient(
                    135deg,
                    #ff4f4f,
                    #d62828
                );
        }

        /* =====================================
           PIE DE PÁGINA
        ===================================== */

        footer.site-footer {
            padding: 44px 0 25px;
            border-top:
                1px solid rgba(255, 255, 255, 0.09);
            background:
                rgba(0, 0, 0, 0.18);
        }

        .footer-grid {
            display: grid;
            grid-template-columns:
                1.2fr 0.8fr 0.8fr 0.8fr;
            gap: 34px;
            margin-bottom: 30px;
        }

        .footer-brand p {
            max-width: 330px;
            margin-top: 14px;
            color: var(--muted);
            font-size: 0.89rem;
        }

        .footer-column h4 {
            margin-bottom: 13px;
            font-size: 0.94rem;
        }

        .footer-column {
            color: var(--muted);
            font-size: 0.85rem;
        }

        .footer-column p,
        .footer-column a {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .footer-column a:hover {
            color: var(--cyan);
        }

        .footer-social {
            display: flex;
            gap: 9px;
        }

        .footer-social a {
            width: 37px;
            height: 37px;
            display: grid;
            place-items: center;
            margin: 0;
            border: 1px solid var(--border);
            border-radius: 11px;
            color: var(--text);
            background:
                rgba(255, 255, 255, 0.05);
        }

        .footer-social a:hover {
            color: var(--cyan);
            border-color:
                rgba(35, 213, 232, 0.38);
        }

        .footer-bottom {
            padding-top: 21px;
            border-top:
                1px solid rgba(255, 255, 255, 0.08);
            color: #8f97ae;
            font-size: 0.8rem;
        }

        .whatsapp-float {
            position: fixed;
            right: 22px;
            bottom: 22px;
            z-index: 1200;
            width: 58px;
            height: 58px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: #06150c;
            background: #25d366;
            box-shadow:
                0 18px 45px rgba(37, 211, 102, 0.35);
            font-size: 1.5rem;
            transition:
                transform 0.22s ease;
        }

        .whatsapp-float:hover {
            transform:
                translateY(-4px)
                scale(1.04);
        }

        .reveal {
            opacity: 0;
            transform: translateY(22px);
            transition:
                opacity 0.6s ease,
                transform 0.6s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
        }

        /* =====================================
           RESPONSIVE
        ===================================== */

        @media (max-width: 1100px) {
            .nav-links {
                gap: 14px;
            }

            .header-search {
                width: 200px;
                flex-basis: 200px;
            }

            .featured-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

            .footer-grid {
                grid-template-columns:
                    1fr 1fr;
            }
        }

        @media (max-width: 900px) {
            .menu-toggle {
                display: grid;
            }

            .nav-inner {
                position: relative;
            }

            .nav-links {
                position: absolute;
                top: calc(100% + 10px);
                right: 0;
                left: 0;
                display: none;
                align-items: stretch;
                flex-direction: column;
                padding: 18px;
                border: 1px solid var(--border);
                border-radius: 18px;
                background:
                    rgba(8, 10, 19, 0.98);
                box-shadow: var(--shadow);
            }

            .nav-links.open {
                display: flex;
            }

            .header-search {
                width: 100%;
                flex: none;
            }

            .nav-actions {
                width: 100%;
            }

            .nav-icon {
                flex: 1;
            }

            .hero-grid {
                grid-template-columns: 1fr;
            }

            .hero-visual {
                min-height: 390px;
            }

            .category-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

            .about-strip {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 720px) {
            .section {
                padding: 62px 0;
            }

            .section-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .portfolio-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
                grid-auto-rows: 190px;
            }

            .portfolio-item,
            .portfolio-item:nth-child(n) {
                grid-column: span 1;
            }

            .portfolio-item:nth-child(5) {
                grid-column: 1 / -1;
            }

            .testimonial-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .container {
                width:
                    min(
                        calc(100% - 24px),
                        var(--container)
                    );
            }

            .hero {
                padding-top: 46px;
            }

            .hero-content {
                min-height: 0;
                padding: 30px 22px;
            }

            .hero-content h1 {
                font-size:
                    clamp(2.6rem, 15vw, 4rem);
            }

            .hero-actions .btn {
                width: 100%;
            }

            .hero-visual {
                min-height: 330px;
            }

            .hero-screen {
                inset: 42px 20px 30px;
            }

            .hero-screen-content {
                grid-template-columns: 1fr;
            }

            .visual-side {
                display: none;
            }

            .floating-note.two {
                display: none;
            }

            .category-grid,
            .featured-grid,
            .portfolio-grid,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .portfolio-item,
            .portfolio-item:nth-child(n) {
                grid-column: auto;
            }

            .alert-success,
            .alert-error {
                right: 12px;
                left: 12px;
                min-width: 0;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            .reveal,
            .btn,
            .category-card,
            .service-card,
            .portfolio-item {
                transition: none;
            }
        }
    </style>
</head>

<body>

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
            <i class="bi bi-list"></i>
        </button>

        <div
            class="nav-links"
            id="navLinks"
        >
            <a href="#inicio">Inicio</a>
            <a href="#servicios">Servicios</a>
            <a href="#portafolio">Portafolio</a>
            <a href="#nosotros">Nosotros</a>
            <a href="#contacto">Contacto</a>

            <form
                class="header-search"
                id="headerSearch"
                role="search"
            >
                <div class="search-input">

                    <i class="bi bi-search"></i>

                    <input
                        id="headerSearchInput"
                        type="search"
                        aria-label="Buscar servicios"
                        placeholder="Buscar servicios"
                    >

                </div>
            </form>

            <div class="nav-actions">

                @auth
                    <a
                        class="nav-icon"
                        href="{{ route('cuenta') }}"
                        aria-label="Mi cuenta"
                        title="Mi cuenta"
                    >
                        <i class="bi bi-person"></i>
                    </a>
                @else
                    <button
                        type="button"
                        class="nav-icon account-modal-open"
                        data-auth-open
                        aria-label="Iniciar sesión"
                        title="Iniciar sesión"
                    >
                        <i class="bi bi-person"></i>
                    </button>
                @endauth

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

    </div>
</nav>

<main>

    @if(session('success'))
        <div
            class="alert-success"
            id="successAlert"
        >
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div
            class="alert-error"
            id="errorAlert"
        >
            <i class="bi bi-exclamation-circle-fill"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- =====================================
         HERO
    ====================================== --}}
    <header
        class="hero"
        id="inicio"
    >
        <div class="container hero-grid">

            <section class="hero-content reveal">

                <span class="hero-label">
                    <i class="bi bi-stars"></i>
                    Creatividad para tu marca
                </span>

                <h1>
                    Servicios de diseño gráfico y
                    <span>edición audiovisual</span>
                    en Honduras.
                </h1>

                <p>
                    Comunica tu marca con creatividad.
                    Creamos logos, videos, contenido para redes
                    sociales, flyers y piezas digitales adaptadas
                    a las necesidades de tu proyecto.
                </p>

                <div class="hero-actions">

                    <a
                        class="btn btn-primary"
                        href="https://wa.me/50492336467?text=Hola%2C%20Punto%20Creativo.%20Quiero%20solicitar%20un%20dise%C3%B1o."
                        target="_blank"
                        rel="noopener"
                    >
                        <i class="bi bi-pencil-square"></i>
                        Solicitar diseño
                    </a>

                    <a
                        class="btn btn-secondary"
                        href="{{ route('catalogo') }}"
                    >
                        <i class="bi bi-grid"></i>
                        Ver catálogo
                    </a>

                </div>

            </section>

            <section
                class="hero-visual reveal"
                aria-label="Muestra visual de los servicios de Punto Creativo"
            >
                <div class="hero-screen">

                    <div class="hero-screen-bar">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div class="hero-screen-content">

                        <div class="visual-card visual-card-main">
                            <small>Punto Creativo</small>
                            <strong>
                                Tu marca merece ser vista.
                            </strong>
                        </div>

                        <div class="visual-side">

                            <div class="visual-card visual-card-video">
                                <span>
                                    <i class="bi bi-camera-reels-fill"></i>
                                    Video y edición
                                </span>
                            </div>

                            <div class="visual-card visual-card-social">
                                <span>
                                    <i class="bi bi-share-fill"></i>
                                    Contenido para redes
                                </span>
                            </div>

                        </div>

                    </div>
                </div>

                <span class="floating-note one">
                    <i class="bi bi-palette-fill"></i>
                    Diseño personalizado
                </span>

                <span class="floating-note two">
                    <i class="bi bi-lightning-charge-fill"></i>
                    Entrega digital
                </span>

            </section>

        </div>
    </header>

    {{-- =====================================
         CATEGORÍAS
    ====================================== --}}
    <section
        class="section section-soft"
        id="servicios"
    >
        <div class="container">

            <div class="section-heading reveal">

                <div>
                    <span class="section-kicker">
                        Categorías
                    </span>

                    <h2>
                        Explora nuestros servicios.
                    </h2>

                    <p>
                        Encuentra la opción adecuada según el
                        tipo de contenido que necesita tu marca.
                    </p>
                </div>

                <a
                    class="section-link"
                    href="{{ route('catalogo') }}"
                >
                    Ver todas
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

            <div class="category-grid">

                <a
                    class="category-card reveal"
                    href="{{ route('catalogo', ['categoria' => ['Diseño gráfico']]) }}"
                >
                    <span class="category-icon">
                        <i class="bi bi-vector-pen"></i>
                    </span>

                    <div>
                        <h3>Diseño de logos</h3>
                        <p>
                            Identidad visual para negocios,
                            marcas y emprendimientos.
                        </p>
                    </div>
                </a>

                <a
                    class="category-card reveal"
                    href="{{ route('catalogo', ['categoria' => ['Flyers & Bounchers']]) }}"
                >
                    <span class="category-icon">
                        <i class="bi bi-file-earmark-image"></i>
                    </span>

                    <div>
                        <h3>Flyers y banners</h3>
                        <p>
                            Material publicitario para promociones,
                            eventos y campañas.
                        </p>
                    </div>
                </a>

                <a
                    class="category-card reveal"
                    href="{{ route('catalogo', ['categoria' => ['Edición de videos']]) }}"
                >
                    <span class="category-icon">
                        <i class="bi bi-camera-reels"></i>
                    </span>

                    <div>
                        <h3>Edición de video</h3>
                        <p>
                            Reels, anuncios, contenido corporativo
                            y videos para redes.
                        </p>
                    </div>
                </a>

                <a
                    class="category-card reveal"
                    href="{{ route('catalogo', ['categoria' => ['Redes Sociales']]) }}"
                >
                    <span class="category-icon">
                        <i class="bi bi-phone"></i>
                    </span>

                    <div>
                        <h3>Redes sociales</h3>
                        <p>
                            Publicaciones, historias, carruseles
                            y contenido recurrente.
                        </p>
                    </div>
                </a>

            </div>

        </div>
    </section>

    {{-- =====================================
         DESTACADOS
    ====================================== --}}
    <section class="section">
        <div class="container">

            <div class="section-heading reveal">

                <div>
                    <span class="section-kicker">
                        Más solicitados
                    </span>

                    <h2>
                        Servicios destacados.
                    </h2>

                    <p>
                        Opciones populares para comenzar a
                        mejorar la imagen digital de tu proyecto.
                    </p>
                </div>

                <a
                    class="section-link"
                    href="{{ route('catalogo') }}"
                >
                    Ver catálogo
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

            <div class="featured-grid">

                <article class="service-card reveal">

                    <div class="service-image logo">
                        <i class="bi bi-bezier2"></i>
                    </div>

                    <div class="service-card-body">

                        <span class="service-category">
                            Identidad visual
                        </span>

                        <h3>
                            Diseño de logotipo profesional
                        </h3>

                        <div class="service-price">
                            L 850.00
                        </div>

                        <a
                            class="btn btn-secondary"
                            href="{{ route('catalogo', ['categoria' => ['Diseño gráfico']]) }}"
                        >
                            Ver detalles
                        </a>

                    </div>
                </article>

                <article class="service-card reveal">

                    <div class="service-image video">
                        <i class="bi bi-film"></i>
                    </div>

                    <div class="service-card-body">

                        <span class="service-category">
                            Edición audiovisual
                        </span>

                        <h3>
                            Edición de video corporativo
                        </h3>

                        <div class="service-price">
                            L 1,200.00
                        </div>

                        <a
                            class="btn btn-secondary"
                            href="{{ route('catalogo', ['categoria' => ['Edición de videos']]) }}"
                        >
                            Ver detalles
                        </a>

                    </div>
                </article>

                <article class="service-card reveal">

                    <div class="service-image social">
                        <i class="bi bi-postcard-heart"></i>
                    </div>

                    <div class="service-card-body">

                        <span class="service-category">
                            Redes sociales
                        </span>

                        <h3>
                            Pack para redes sociales x10
                        </h3>

                        <div class="service-price">
                            L 650.00
                        </div>

                        <a
                            class="btn btn-secondary"
                            href="{{ route('catalogo', ['categoria' => ['Redes Sociales']]) }}"
                        >
                            Ver detalles
                        </a>

                    </div>
                </article>

                <article class="service-card reveal">

                    <div class="service-image motion">
                        <i class="bi bi-play-btn-fill"></i>
                    </div>

                    <div class="service-card-body">

                        <span class="service-category">
                            Motion graphics
                        </span>

                        <h3>
                            Intro animada para YouTube
                        </h3>

                        <div class="service-price">
                            L 950.00
                        </div>

                        <a
                            class="btn btn-secondary"
                            href="{{ route('catalogo', ['categoria' => ['Motion Graphics']]) }}"
                        >
                            Ver detalles
                        </a>

                    </div>
                </article>

            </div>

        </div>
    </section>

    {{-- =====================================
         PORTAFOLIO
    ====================================== --}}
    <section
        class="section section-soft"
        id="portafolio"
    >
        <div class="container">

            <div class="section-heading reveal">

                <div>
                    <span class="section-kicker">
                        Trabajos creativos
                    </span>

                    <h2>
                        Portafolio.
                    </h2>

                    <p>
                        Una muestra del tipo de soluciones visuales
                        que podemos desarrollar para diferentes marcas.
                    </p>
                </div>

                <a
                    class="section-link"
                    href="{{ route('catalogo') }}"
                >
                    Explorar servicios
                    <i class="bi bi-arrow-right"></i>
                </a>

            </div>

            <div class="portfolio-grid">

                <article class="portfolio-item one reveal">
                    <div class="portfolio-content">
                        <i class="bi bi-palette2"></i>
                        <small>Identidad visual</small>
                        <h3>Marca para emprendimiento</h3>
                    </div>
                </article>

                <article class="portfolio-item two reveal">
                    <div class="portfolio-content">
                        <i class="bi bi-camera-reels"></i>
                        <small>Video</small>
                        <h3>Reel promocional</h3>
                    </div>
                </article>

                <article class="portfolio-item three reveal">
                    <div class="portfolio-content">
                        <i class="bi bi-share"></i>
                        <small>Redes sociales</small>
                        <h3>Campaña digital</h3>
                    </div>
                </article>

                <article class="portfolio-item four reveal">
                    <div class="portfolio-content">
                        <i class="bi bi-trophy"></i>
                        <small>Diseño deportivo</small>
                        <h3>Jornada y resultados</h3>
                    </div>
                </article>

                <article class="portfolio-item five reveal">
                    <div class="portfolio-content">
                        <i class="bi bi-magic"></i>
                        <small>Motion graphics</small>
                        <h3>Animación de marca</h3>
                    </div>
                </article>

            </div>

        </div>
    </section>

    {{-- =====================================
         NOSOTROS Y TESTIMONIOS
    ====================================== --}}
    <section
        class="section"
        id="nosotros"
    >
        <div class="container">

            <div class="about-strip reveal">

                <div class="about-visual">
                    <strong>PC</strong>
                </div>

                <div class="about-copy">

                    <span class="section-kicker">
                        Sobre nosotros
                    </span>

                    <h2>
                        Creatividad cercana para marcas que quieren crecer.
                    </h2>

                    <p>
                        Punto Creativo combina diseño gráfico,
                        edición audiovisual y atención personalizada
                        para ayudar a emprendedores, empresas y creadores
                        a comunicar mejor sus ideas en medios digitales.
                    </p>

                </div>

            </div>

            <div class="section-heading reveal">

                <div>
                    <span class="section-kicker">
                        Opiniones
                    </span>

                    <h2>
                        Testimonios de clientes.
                    </h2>

                    <p>
                        La confianza se construye con comunicación clara,
                        cumplimiento y resultados visuales de calidad.
                    </p>
                </div>

            </div>

            <div class="testimonial-grid">

                <article class="testimonial reveal">

                    <i class="bi bi-quote quote-icon"></i>

                    <blockquote>
                        “El logo superó mis expectativas.
                        Entendieron la idea y el resultado quedó
                        profesional. Totalmente recomendado.”
                    </blockquote>

                    <footer>
                        <span class="client-avatar">
                            CM
                        </span>

                        <span class="client-data">
                            <strong>Carlos M.</strong>
                            <small>Emprendedor</small>
                        </span>
                    </footer>

                </article>

                <article class="testimonial reveal">

                    <i class="bi bi-quote quote-icon"></i>

                    <blockquote>
                        “El video para mi empresa quedó increíble
                        y fue entregado puntualmente. La comunicación
                        durante el proceso fue excelente.”
                    </blockquote>

                    <footer>
                        <span class="client-avatar">
                            MR
                        </span>

                        <span class="client-data">
                            <strong>María R.</strong>
                            <small>Propietaria de negocio</small>
                        </span>
                    </footer>

                </article>

                <article class="testimonial reveal">

                    <i class="bi bi-quote quote-icon"></i>

                    <blockquote>
                        “Excelente trabajo, comunicación clara
                        y mucha atención a los detalles.
                        El contenido quedó justo como lo necesitábamos.”
                    </blockquote>

                    <footer>
                        <span class="client-avatar">
                            AL
                        </span>

                        <span class="client-data">
                            <strong>Andrea L.</strong>
                            <small>Creadora de contenido</small>
                        </span>
                    </footer>

                </article>

            </div>

        </div>
    </section>

</main>

<footer
    class="site-footer"
    id="contacto"
>
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
                    y contenido digital desde El Paraíso,
                    Honduras.
                </p>

            </div>

            <div class="footer-column">

                <h4>Contacto</h4>

                <p>
                    <i class="bi bi-envelope-fill"></i>
                    info@puntocreativo.hn
                </p>

                <p>
                    <i class="bi bi-telephone-fill"></i>
                    +504 9233-6467
                </p>

                <p>
                    <i class="bi bi-geo-alt-fill"></i>
                    El Paraíso, Honduras
                </p>

            </div>

            <div class="footer-column">

                <h4>WhatsApp</h4>

                <p>
                    Atención digital para consultas,
                    cotizaciones y seguimiento.
                </p>

                <a
                    class="btn btn-secondary"
                    href="https://wa.me/50492336467"
                    target="_blank"
                    rel="noopener"
                >
                    <i class="bi bi-whatsapp"></i>
                    Escríbenos
                </a>

            </div>

            <div class="footer-column">

                <h4>Enlaces</h4>

                <a href="{{ route('terminos') }}">
                    Términos
                </a>

                <a href="{{ route('privacidad') }}">
                    Privacidad
                </a>

                <a href="{{ route('cookies') }}">
                    Cookies
                </a>

                <div class="footer-social">

                    <a
                        href="#"
                        aria-label="Facebook"
                    >
                        <i class="bi bi-facebook"></i>
                    </a>

                    <a
                        href="#"
                        aria-label="Instagram"
                    >
                        <i class="bi bi-instagram"></i>
                    </a>

                    <a
                        href="#"
                        aria-label="YouTube"
                    >
                        <i class="bi bi-youtube"></i>
                    </a>

                    <a
                        href="#"
                        aria-label="TikTok"
                    >
                        <i class="bi bi-tiktok"></i>
                    </a>

                </div>

            </div>

        </div>

        <div class="footer-bottom">
            © <span data-year></span>
            Punto Creativo. Todos los derechos reservados.
        </div>

    </div>
</footer>

@include('components.login-modal')
@include('components.cookie-banner')

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

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function () {
            const menuToggle =
                document.querySelector(
                    '.menu-toggle'
                );

            const navLinks =
                document.getElementById(
                    'navLinks'
                );

            const formularioBusqueda =
                document.getElementById(
                    'headerSearch'
                );

            const campoBusqueda =
                document.getElementById(
                    'headerSearchInput'
                );

            function actualizarIconoMenu() {
                if (!menuToggle || !navLinks) {
                    return;
                }

                const abierto =
                    navLinks.classList.contains(
                        'open'
                    );

                menuToggle.innerHTML = abierto
                    ? '<i class="bi bi-x-lg"></i>'
                    : '<i class="bi bi-list"></i>';

                menuToggle.setAttribute(
                    'aria-expanded',
                    String(abierto)
                );
            }

            if (menuToggle && navLinks) {
                menuToggle.addEventListener(
                    'click',
                    function () {
                        navLinks.classList.toggle(
                            'open'
                        );

                        actualizarIconoMenu();
                    }
                );

                navLinks
                    .querySelectorAll('a')
                    .forEach(function (enlace) {
                        enlace.addEventListener(
                            'click',
                            function () {
                                navLinks.classList.remove(
                                    'open'
                                );

                                actualizarIconoMenu();
                            }
                        );
                    });

                actualizarIconoMenu();
            }

            if (
                formularioBusqueda &&
                campoBusqueda
            ) {
                formularioBusqueda.addEventListener(
                    'submit',
                    function (evento) {
                        evento.preventDefault();

                        const busqueda =
                            campoBusqueda.value.trim();

                        const urlCatalogo =
                            @json(route('catalogo'));

                        if (!busqueda) {
                            window.location.href =
                                urlCatalogo;

                            return;
                        }

                        const parametros =
                            new URLSearchParams({
                                buscar: busqueda,
                                q: busqueda
                            });

                        window.location.href =
                            urlCatalogo +
                            '?' +
                            parametros.toString();
                    }
                );
            }

            document
                .querySelectorAll('[data-year]')
                .forEach(function (elemento) {
                    elemento.textContent =
                        new Date().getFullYear();
                });

            const alertas =
                document.querySelectorAll(
                    '.alert-success, .alert-error'
                );

            if (alertas.length > 0) {
                window.setTimeout(
                    function () {
                        alertas.forEach(
                            function (alerta) {
                                alerta.remove();
                            }
                        );
                    },
                    4000
                );
            }

            if (
                'IntersectionObserver' in window
            ) {
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
                            threshold: 0.1
                        }
                    );

                document
                    .querySelectorAll('.reveal')
                    .forEach(function (elemento) {
                        observador.observe(
                            elemento
                        );
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
        }
    );
</script>

<script src="{{ asset('js/auth-modal.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/cart-count.js') }}?v={{ time() }}"></script>
<script src="{{ asset('js/cookie-banner.js') }}?v={{ time() }}"></script>

</body>
</html>
