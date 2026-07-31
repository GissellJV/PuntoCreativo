<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Punto Creativo: diseño gráfico, edición audiovisual y contenido digital para emprendedores, empresas y creadores." />
    <title>Punto Creativo | Diseño que conecta</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

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
            --radius: 24px;
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
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 12% 8%, rgba(141, 92, 255, 0.25), transparent 32%),
                radial-gradient(circle at 88% 16%, rgba(35, 213, 232, 0.18), transparent 28%),
                radial-gradient(circle at 70% 84%, rgba(255, 79, 163, 0.16), transparent 34%),
                var(--bg);
            line-height: 1.65;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            opacity: 0.18;
            background-image:
                linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
            background-size: 42px 42px;
            mask-image: linear-gradient(to bottom, black, transparent 80%);
            z-index: -1;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        textarea,
        select {
            font: inherit;
        }

        img,
        svg {
            display: block;
            max-width: 100%;
        }

        .container {
            width: min(calc(100% - 40px), var(--container));
            margin-inline: auto;
        }

        .section {
            padding: 96px 0;
        }

        .section-title {
            max-width: 760px;
            margin-bottom: 44px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 7px 12px;
            border: 1px solid var(--border);
            border-radius: 999px;
            color: #dce1ff;
            background: rgba(255, 255, 255, 0.05);
            font-size: 0.82rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .eyebrow::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--cyan), var(--purple));
            box-shadow: 0 0 18px var(--cyan);
        }

        h1,
        h2,
        h3 {
            line-height: 1.08;
            letter-spacing: -0.035em;
        }

        h1 {
            font-size: clamp(3.2rem, 8vw, 7rem);
            max-width: 900px;
        }

        h2 {
            font-size: clamp(2.2rem, 5vw, 4.2rem);
            margin-bottom: 18px;
        }

        h3 {
            font-size: 1.35rem;
        }

        .gradient-text {
            background: linear-gradient(100deg, #ffffff 10%, var(--cyan) 44%, var(--purple) 70%, var(--pink));
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .lead,
        .section-title p {
            color: var(--muted);
            font-size: clamp(1rem, 2vw, 1.15rem);
        }

        .btn {
            min-height: 52px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0 20px;
            border: 1px solid transparent;
            border-radius: 14px;
            font-weight: 850;
            cursor: pointer;
            transition: transform .25s ease, border-color .25s ease, background .25s ease, box-shadow .25s ease;
        }

        .btn:hover {
            transform: translateY(-3px);
        }

        .btn-primary {
            color: #071018;
            background: linear-gradient(135deg, var(--cyan), #91eff7);
            box-shadow: 0 14px 36px rgba(35, 213, 232, 0.22);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.07);
            border-color: var(--border);
            color: var(--text);
        }

        .btn-whatsapp {
            background: linear-gradient(135deg, #25d366, #9bebba);
            color: #06150c;
        }

        .topbar {
            text-align: center;
            padding: 10px 20px;
            color: #dce2f5;
            font-size: 0.88rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
            background: rgba(255,255,255,.035);
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: rgba(8, 10, 19, 0.72);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .nav-inner {
            min-height: 76px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            font-weight: 950;
            letter-spacing: -0.03em;
            font-size: 1.12rem;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: conic-gradient(from 210deg, var(--purple), var(--cyan), var(--pink), var(--orange), var(--purple));
            box-shadow: 0 10px 32px rgba(141, 92, 255, .28);
            transform: rotate(-6deg);
        }

        .brand-mark span {
            width: 24px;
            height: 24px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            background: var(--bg);
            color: white;
            font-size: 0.85rem;
            transform: rotate(6deg);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 24px;
            color: #d9deef;
            font-weight: 700;
            font-size: 0.93rem;
        }

        .nav-links a {
            transition: color .2s ease;
        }

        .nav-links a:hover {
            color: var(--cyan);
        }

        .menu-toggle {
            display: none;
            border: 1px solid var(--border);
            background: rgba(255,255,255,.06);
            color: var(--text);
            width: 46px;
            height: 46px;
            border-radius: 14px;
            cursor: pointer;
            font-size: 1.4rem;
        }

        .hero {
            min-height: calc(100vh - 112px);
            display: grid;
            align-items: center;
            padding: 72px 0 58px;
            position: relative;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.12fr .88fr;
            align-items: center;
            gap: 62px;
        }

        .hero-copy .lead {
            max-width: 670px;
            margin: 24px 0 30px;
            font-size: 1.15rem;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
        }

        .hero-proof {
            display: flex;
            flex-wrap: wrap;
            gap: 22px;
            margin-top: 34px;
            color: var(--muted);
            font-size: .93rem;
        }

        .hero-proof span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .check {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: inline-grid;
            place-items: center;
            background: rgba(53, 208, 127, .14);
            color: #77efa9;
            font-size: .76rem;
            font-weight: 950;
        }

        .hero-visual {
            position: relative;
            min-height: 560px;
        }

        .orbit {
            position: absolute;
            inset: 20px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.11);
            animation: spin 22s linear infinite;
        }

        .orbit::before,
        .orbit::after {
            content: "";
            position: absolute;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        .orbit::before {
            left: -8px;
            background: var(--cyan);
            box-shadow: 0 0 28px var(--cyan);
        }

        .orbit::after {
            right: -8px;
            background: var(--pink);
            box-shadow: 0 0 28px var(--pink);
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .design-board {
            position: absolute;
            inset: 52px 12px 42px 52px;
            border: 1px solid rgba(255,255,255,.16);
            border-radius: 34px;
            padding: 22px;
            background:
                linear-gradient(145deg, rgba(255,255,255,.12), rgba(255,255,255,.035)),
                rgba(17,21,38,.82);
            box-shadow: var(--shadow);
            backdrop-filter: blur(16px);
            transform: rotate(3deg);
        }

        .window-bar {
            display: flex;
            gap: 8px;
            margin-bottom: 18px;
        }

        .window-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255,255,255,.18);
        }

        .artboard {
            height: calc(100% - 30px);
            border-radius: 24px;
            overflow: hidden;
            display: grid;
            grid-template-rows: 1.3fr .7fr;
            gap: 13px;
        }

        .poster {
            position: relative;
            overflow: hidden;
            border-radius: 22px;
            background:
                radial-gradient(circle at 70% 30%, rgba(255,255,255,.45), transparent 12%),
                linear-gradient(135deg, #4424a6 0%, #8d5cff 40%, #ff4fa3 100%);
            padding: 28px;
        }

        .poster::before {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            border-radius: 42% 58% 62% 38%;
            background: linear-gradient(135deg, var(--cyan), #b7f8ff);
            right: -48px;
            bottom: -58px;
            transform: rotate(-18deg);
            box-shadow: inset 0 0 0 14px rgba(255,255,255,.12);
        }

        .poster::after {
            content: "CREA";
            position: absolute;
            right: 14px;
            top: 4px;
            font-size: 5.8rem;
            font-weight: 1000;
            letter-spacing: -.08em;
            color: rgba(255,255,255,.11);
            transform: rotate(90deg) translateX(62%);
            transform-origin: top right;
        }

        .poster small {
            display: block;
            font-weight: 850;
            letter-spacing: .14em;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .poster strong {
            position: relative;
            z-index: 2;
            display: block;
            max-width: 240px;
            font-size: 2.7rem;
            line-height: .95;
            letter-spacing: -.06em;
        }

        .mini-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 13px;
        }

        .mini-card {
            border-radius: 20px;
            padding: 18px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 130px;
            overflow: hidden;
            position: relative;
        }

        .mini-card:first-child {
            background: linear-gradient(135deg, #082c33, #12a9b9);
        }

        .mini-card:last-child {
            background: linear-gradient(135deg, #39240c, #ff9f43);
        }

        .mini-card b {
            font-size: 1.06rem;
            max-width: 130px;
            z-index: 2;
        }

        .mini-card span {
            color: rgba(255,255,255,.72);
            font-size: .82rem;
            z-index: 2;
        }

        .floating-tag {
            position: absolute;
            border: 1px solid rgba(255,255,255,.17);
            border-radius: 16px;
            background: rgba(10,12,23,.82);
            backdrop-filter: blur(16px);
            box-shadow: 0 16px 40px rgba(0,0,0,.35);
            padding: 13px 16px;
            font-weight: 800;
            color: #eef1ff;
        }

        .tag-one {
            top: 28px;
            right: -12px;
            transform: rotate(-4deg);
        }

        .tag-two {
            bottom: 24px;
            left: 0;
            transform: rotate(3deg);
        }

        .stats {
            padding-top: 26px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .stat {
            padding: 26px 20px;
            border: 1px solid var(--border);
            border-radius: 20px;
            background: var(--card);
            text-align: center;
        }

        .stat strong {
            display: block;
            font-size: 1.85rem;
            line-height: 1;
            margin-bottom: 10px;
        }

        .stat span {
            color: var(--muted);
            font-size: .9rem;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .service-card {
            min-height: 300px;
            position: relative;
            overflow: hidden;
            padding: 28px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: linear-gradient(145deg, var(--card-strong), rgba(255,255,255,.035));
            transition: transform .3s ease, border-color .3s ease, background .3s ease;
        }

        .service-card:hover {
            transform: translateY(-8px);
            border-color: rgba(35, 213, 232, .46);
            background: linear-gradient(145deg, rgba(35,213,232,.12), rgba(141,92,255,.09));
        }

        .service-card::after {
            content: "";
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            right: -78px;
            bottom: -74px;
            background: var(--accent, var(--purple));
            filter: blur(6px);
            opacity: .17;
        }

        .service-icon {
            width: 52px;
            height: 52px;
            display: grid;
            place-items: center;
            border-radius: 16px;
            background: rgba(255,255,255,.09);
            margin-bottom: 54px;
            font-size: 1.45rem;
            border: 1px solid rgba(255,255,255,.12);
        }

        .service-card h3 {
            margin-bottom: 12px;
        }

        .service-card p {
            color: var(--muted);
            font-size: .96rem;
        }

        .portfolio-shell {
            border: 1px solid var(--border);
            border-radius: 30px;
            padding: 16px;
            background: rgba(255,255,255,.045);
        }

        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 8px 8px 22px;
        }

        .filter-btn {
            padding: 9px 14px;
            border: 1px solid var(--border);
            border-radius: 999px;
            background: rgba(255,255,255,.04);
            color: #dce2f5;
            font-weight: 750;
            cursor: pointer;
        }

        .filter-btn.active {
            background: linear-gradient(135deg, var(--purple), var(--pink));
            border-color: transparent;
            color: white;
        }

        .portfolio-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            grid-auto-rows: 190px;
            gap: 14px;
        }

        .work {
            position: relative;
            overflow: hidden;
            border-radius: 22px;
            min-height: 190px;
            isolation: isolate;
            transition: transform .28s ease, opacity .25s ease;
        }

        .work:hover {
            transform: scale(.985);
        }

        .work.hidden {
            display: none;
        }

        .work:nth-child(1) { grid-column: span 7; grid-row: span 2; }
        .work:nth-child(2) { grid-column: span 5; }
        .work:nth-child(3) { grid-column: span 5; }
        .work:nth-child(4) { grid-column: span 4; }
        .work:nth-child(5) { grid-column: span 4; }
        .work:nth-child(6) { grid-column: span 4; }

        .work-bg {
            position: absolute;
            inset: 0;
            z-index: -2;
        }

        .work:nth-child(1) .work-bg {
            background:
                radial-gradient(circle at 72% 25%, rgba(255,255,255,.35), transparent 12%),
                linear-gradient(125deg, #1f1452, #7d3cff 48%, #ff4fa3);
        }

        .work:nth-child(2) .work-bg {
            background: linear-gradient(135deg, #051e25, #087b8b 48%, #22d3e5);
        }

        .work:nth-child(3) .work-bg {
            background: linear-gradient(135deg, #3b1c05, #cc6415 52%, #ffae54);
        }

        .work:nth-child(4) .work-bg {
            background: linear-gradient(135deg, #1d234d, #3757c8 52%, #5fd6ff);
        }

        .work:nth-child(5) .work-bg {
            background: linear-gradient(135deg, #3d1230, #b42378 55%, #ff80bd);
        }

        .work:nth-child(6) .work-bg {
            background: linear-gradient(135deg, #123322, #187a44 55%, #66e795);
        }

        .work::before {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            border-radius: 44% 56% 35% 65%;
            right: -64px;
            top: -72px;
            border: 18px solid rgba(255,255,255,.12);
            transform: rotate(30deg);
            z-index: -1;
        }

        .work-content {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 24px;
            background: linear-gradient(to top, rgba(4,5,11,.78), transparent 64%);
        }

        .work small {
            color: rgba(255,255,255,.74);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .12em;
        }

        .work h3 {
            margin-top: 5px;
            font-size: clamp(1.25rem, 2vw, 2rem);
        }

        .process-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            counter-reset: step;
        }

        .step {
            counter-increment: step;
            min-height: 245px;
            padding: 26px;
            border-top: 1px solid var(--border);
            background: linear-gradient(to bottom, rgba(255,255,255,.045), transparent);
        }

        .step::before {
            content: "0" counter(step);
            display: block;
            color: var(--cyan);
            font-weight: 950;
            font-size: 1.1rem;
            letter-spacing: .08em;
            margin-bottom: 70px;
        }

        .step h3 {
            margin-bottom: 10px;
        }

        .step p {
            color: var(--muted);
            font-size: .95rem;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            align-items: stretch;
        }

        .price-card {
            position: relative;
            padding: 30px;
            border: 1px solid var(--border);
            border-radius: 26px;
            background: var(--card);
            display: flex;
            flex-direction: column;
        }

        .price-card.featured {
            background:
                radial-gradient(circle at 90% 10%, rgba(35,213,232,.18), transparent 28%),
                linear-gradient(145deg, rgba(141,92,255,.16), rgba(255,255,255,.06));
            border-color: rgba(35,213,232,.38);
            transform: translateY(-12px);
            box-shadow: var(--shadow);
        }

        .popular {
            position: absolute;
            top: 18px;
            right: 18px;
            padding: 6px 10px;
            border-radius: 999px;
            background: var(--cyan);
            color: #071018;
            font-size: .72rem;
            font-weight: 950;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .price-card p {
            color: var(--muted);
            margin: 12px 0 20px;
        }

        .price {
            font-size: 2.3rem;
            font-weight: 1000;
            letter-spacing: -.05em;
            margin-bottom: 22px;
        }

        .price small {
            font-size: .85rem;
            color: var(--muted);
            font-weight: 650;
            letter-spacing: 0;
        }

        .feature-list {
            list-style: none;
            display: grid;
            gap: 12px;
            margin-bottom: 28px;
        }

        .feature-list li {
            display: flex;
            gap: 10px;
            color: #e7eaff;
            font-size: .93rem;
        }

        .price-card .btn {
            width: 100%;
            margin-top: auto;
        }

        .about-grid {
            display: grid;
            grid-template-columns: .9fr 1.1fr;
            gap: 52px;
            align-items: center;
        }

        .about-card {
            position: relative;
            min-height: 490px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 34px;
            background:
                radial-gradient(circle at 30% 20%, rgba(35,213,232,.32), transparent 22%),
                radial-gradient(circle at 78% 76%, rgba(255,79,163,.28), transparent 25%),
                linear-gradient(145deg, #161a33, #0a0d18);
            box-shadow: var(--shadow);
        }

        .about-card::before {
            content: "PC";
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            font-size: 12rem;
            font-weight: 1000;
            color: rgba(255,255,255,.055);
            letter-spacing: -.1em;
        }

        .about-chip {
            position: absolute;
            padding: 14px 18px;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: rgba(8,10,19,.72);
            backdrop-filter: blur(18px);
            font-weight: 850;
            box-shadow: 0 14px 34px rgba(0,0,0,.32);
        }

        .about-chip:nth-child(1) { left: 30px; top: 48px; }
        .about-chip:nth-child(2) { right: 30px; top: 170px; }
        .about-chip:nth-child(3) { left: 56px; bottom: 46px; }

        .about-copy p {
            color: var(--muted);
            margin-bottom: 18px;
        }

        .about-list {
            display: grid;
            gap: 14px;
            margin-top: 28px;
        }

        .about-list div {
            padding: 16px 18px;
            border-left: 3px solid var(--cyan);
            background: rgba(255,255,255,.04);
            border-radius: 0 14px 14px 0;
        }

        .quote-shell {
            display: grid;
            grid-template-columns: .78fr 1.22fr;
            border: 1px solid var(--border);
            border-radius: 34px;
            overflow: hidden;
            background: rgba(255,255,255,.045);
            box-shadow: var(--shadow);
        }

        .quote-info {
            padding: 46px;
            background:
                radial-gradient(circle at 10% 10%, rgba(35,213,232,.23), transparent 24%),
                linear-gradient(145deg, #161b37, #0c0f1d);
        }

        .quote-info p {
            color: var(--muted);
            margin: 20px 0 32px;
        }

        .contact-list {
            display: grid;
            gap: 14px;
            color: #e9edff;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .contact-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.1);
        }

        .quote-form {
            padding: 46px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .field {
            display: grid;
            gap: 8px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            color: #e9edff;
            font-weight: 750;
            font-size: .9rem;
        }

        input,
        textarea,
        select {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 14px;
            background: rgba(255,255,255,.045);
            color: var(--text);
            padding: 14px 15px;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        select option {
            background: #111526;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: var(--cyan);
            box-shadow: 0 0 0 4px rgba(35,213,232,.11);
        }

        textarea {
            resize: vertical;
            min-height: 130px;
        }

        .form-note {
            grid-column: 1 / -1;
            color: var(--muted);
            font-size: .83rem;
        }

        .quote-form .btn {
            grid-column: 1 / -1;
            width: 100%;
        }

        .faq-grid {
            display: grid;
            gap: 12px;
            max-width: 900px;
            margin-inline: auto;
        }

        details {
            border: 1px solid var(--border);
            border-radius: 18px;
            background: rgba(255,255,255,.045);
            padding: 20px 22px;
        }

        summary {
            cursor: pointer;
            font-weight: 850;
            list-style: none;
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        summary::-webkit-details-marker {
            display: none;
        }

        summary::after {
            content: "+";
            color: var(--cyan);
            font-size: 1.4rem;
            line-height: 1;
        }

        details[open] summary::after {
            content: "−";
        }

        details p {
            color: var(--muted);
            padding-top: 14px;
        }

        footer {
            padding: 42px 0 28px;
            border-top: 1px solid rgba(255,255,255,.09);
            background: rgba(0,0,0,.14);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.4fr repeat(2, .7fr);
            gap: 38px;
            margin-bottom: 34px;
        }

        .footer-brand p {
            color: var(--muted);
            max-width: 470px;
            margin-top: 15px;
        }

        .footer-col h4 {
            margin-bottom: 14px;
        }

        .footer-col {
            display: grid;
            align-content: start;
            gap: 8px;
            color: var(--muted);
        }

        .footer-bottom {
            padding-top: 24px;
            border-top: 1px solid rgba(255,255,255,.08);
            display: flex;
            justify-content: space-between;
            gap: 20px;
            color: #8f97ae;
            font-size: .84rem;
        }

        .whatsapp-float {
            position: fixed;
            right: 22px;
            bottom: 22px;
            z-index: 1100;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: #25d366;
            color: #06150c;
            font-size: 1.6rem;
            box-shadow: 0 18px 45px rgba(37,211,102,.35);
            transition: transform .25s ease;
        }

        .whatsapp-float:hover {
            transform: translateY(-4px) scale(1.04);
        }

        .reveal {
            opacity: 0;
            transform: translateY(26px);
            transition: opacity .65s ease, transform .65s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
        }

        @media (max-width: 980px) {
            .hero-grid,
            .about-grid,
            .quote-shell {
                grid-template-columns: 1fr;
            }

            .hero-visual {
                min-height: 520px;
                max-width: 640px;
                width: 100%;
                margin-inline: auto;
            }

            .services-grid,
            .pricing-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .process-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .price-card.featured {
                transform: none;
            }

            .portfolio-grid {
                grid-template-columns: repeat(2, 1fr);
                grid-auto-rows: 240px;
            }

            .work,
            .work:nth-child(n) {
                grid-column: span 1;
                grid-row: span 1;
            }

            .work:nth-child(1) {
                grid-column: 1 / -1;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }

            .footer-brand {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 760px) {
            .section {
                padding: 74px 0;
            }

            .menu-toggle {
                display: grid;
                place-items: center;
            }

            .nav-links {
                position: absolute;
                top: 76px;
                left: 20px;
                right: 20px;
                display: none;
                padding: 18px;
                border: 1px solid var(--border);
                border-radius: 18px;
                background: rgba(10,12,23,.96);
                box-shadow: var(--shadow);
                flex-direction: column;
                align-items: stretch;
            }

            .nav-links.open {
                display: flex;
            }

            .nav-links .btn {
                width: 100%;
            }

            .hero {
                padding-top: 52px;
            }

            .hero-grid {
                gap: 36px;
            }

            .hero-visual {
                min-height: 430px;
            }

            .design-board {
                inset: 36px 4px 26px 24px;
            }

            .poster strong {
                font-size: 2.1rem;
            }

            .tag-one {
                right: 0;
            }

            .services-grid,
            .pricing-grid,
            .process-grid,
            .portfolio-grid,
            .quote-form,
            .footer-grid {
                grid-template-columns: 1fr;
            }

            .work,
            .work:nth-child(n),
            .work:nth-child(1) {
                grid-column: auto;
            }

            .quote-info,
            .quote-form {
                padding: 30px 24px;
            }

            .field.full,
            .quote-form .btn,
            .form-note {
                grid-column: auto;
            }

            .footer-brand {
                grid-column: auto;
            }

            .footer-bottom {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .container {
                width: min(calc(100% - 26px), var(--container));
            }

            h1 {
                font-size: 3rem;
            }

            .hero-actions .btn {
                width: 100%;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .hero-visual {
                min-height: 390px;
            }

            .poster {
                padding: 20px;
            }

            .poster strong {
                font-size: 1.72rem;
            }

            .mini-card {
                min-height: 112px;
                padding: 14px;
            }

            .floating-tag {
                font-size: .78rem;
                padding: 10px 12px;
            }
        }
        .service-card {
            display: block;
            color: inherit;
            text-decoration: none;
            cursor: pointer;
        }

        .search-input{
            position: relative;
            flex: 1;
        }

        .search-input i{
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 16px;
            pointer-events: none;
        }

        .search-input input{
            width: 100%;
            padding-left: 45px;
        }
    </style>
    <link rel="stylesheet" href="../../public/css/store.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
<div class="topbar">
    Diseño gráfico, edición audiovisual y contenido digital desde El Paraíso, Honduras.
</div>

<nav class="navbar">
    <div class="container nav-inner">
        <a href="#inicio" class="brand" aria-label="Ir al inicio">
            <span class="brand-mark"><span>PC</span></span>
            <span>Punto Creativo</span>
        </a>

        <button class="menu-toggle" aria-label="Abrir menú" aria-expanded="false">☰</button>

        <div class="nav-links" id="navLinks">
            <a href="#servicios">Servicios</a>
            <a href="#portafolio">Portafolio</a>
            <a href="{{route('catalogo')}}">Tienda</a>
            <a href="#cotizar">Contacto</a>
            <form class="header-search" data-search-form role="search">
                <div class="search-input">

                    <i class="bi bi-search"></i>

                    <input
                        type="search"
                        aria-label="Buscar servicios"
                        placeholder="Buscar servicios"
                    >
                </div>
            </form>
            <a class="nav-icon" href="{{route('cuenta')}}" aria-label="Mi cuenta" title="Mi cuenta">♙</a>
            <a class="nav-icon" href="{{route('carrito')}}" aria-label="Carrito" title="Carrito">🛒<span class="cart-badge" data-cart-count>0</span></a>
        </div>
    </div>
</nav>

<main>
    <header class="hero" id="inicio">
        <div class="container hero-grid">
            <div class="hero-copy reveal">
                <span class="eyebrow">Creatividad con propósito</span>
                <h1>Ideas que se vuelven <span class="gradient-text">contenido que conecta.</span></h1>
                <p class="lead">
                    Creamos diseños, videos y contenido digital para emprendedores, empresas,
                    medios, páginas deportivas y creadores que quieren destacar en internet.
                </p>

                <div class="hero-actions">
                    <a class="btn btn-primary" href="#cotizar">Quiero una cotización →</a>
                    <a class="btn btn-secondary" href="#portafolio">Ver portafolio</a>
                    <a class="btn btn-secondary" href="{{route('catalogo')}}">Comprar servicios</a>
                </div>

                <div class="hero-proof">
                    <span><i class="check">✓</i> Atención personalizada</span>
                    <span><i class="check">✓</i> Entrega digital</span>
                    <span><i class="check">✓</i> Diseños adaptados a cada plataforma</span>
                </div>
            </div>

            <div class="hero-visual reveal" aria-label="Muestra visual de trabajos creativos">
                <div class="orbit"></div>

                <div class="design-board">
                    <div class="window-bar">
                        <span class="window-dot"></span>
                        <span class="window-dot"></span>
                        <span class="window-dot"></span>
                    </div>

                    <div class="artboard">
                        <div class="poster">
                            <small>Punto Creativo</small>
                            <strong>Tu marca merece ser vista.</strong>
                        </div>

                        <div class="mini-grid">
                            <div class="mini-card">
                                <b>Videos para redes Sociales</b>
                                <span>Reels · TikTok · Shorts</span>
                            </div>
                            <div class="mini-card">
                                <b>Identidad visual</b>
                                <span>Logo · colores · estilo</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="floating-tag tag-one">✦ Diseño + estrategia</div>
                <div class="floating-tag tag-two">▶ Contenido audiovisual</div>
            </div>
        </div>

        <div class="container stats reveal">
            <div class="stats-grid">
                <div class="stat">
                    <strong>100%</strong>
                    <span>Servicio digital</span>
                </div>
                <div class="stat">
                    <strong>B2C + B2B</strong>
                    <span>Personas y empresas</span>
                </div>
                <div class="stat">
                    <strong>1 a 1</strong>
                    <span>Atención personalizada</span>
                </div>
                <div class="stat">
                    <strong>Honduras</strong>
                    <span>Alcance sin fronteras</span>
                </div>
            </div>
        </div>
    </header>

    <section class="section" id="servicios">
        <div class="container">
            <div class="section-title reveal">
                <span class="eyebrow">Lo que hacemos</span>
                <h2>Soluciones visuales para mover tu marca.</h2>
                <p>
                    Desde una publicación puntual hasta una campaña completa, adaptamos cada pieza
                    al objetivo, público y plataforma del cliente.
                </p>
            </div>

            <div class="services-grid">
                <a
                    href="{{ route('catalogo', ['categoria' => ['Diseño gráfico']]) }}"
                    class="service-card reveal"
                    style="--accent:#8d5cff"
                >
                    <div class="service-icon">✦</div>
                    <h3>Diseño gráfico</h3>
                    <p>Anuncios, promociones, pósters y piezas visuales para campañas digitales.</p>
                </a>

                <a
                    href="{{ route('catalogo', ['categoria' => ['Fotografía']]) }}"
                    class="service-card reveal"
                    style="--accent:#23d5e8"
                >
                    <div class="service-icon">◈</div>
                    <h3>Fotografía</h3>
                    <p>Capturamos imágenes profesionales para productos, eventos, marcas y contenido para redes sociales.</p>
                </a>

                <a
                    href="{{ route('catalogo', ['categoria' => ['Edición de videos']]) }}"
                    class="service-card reveal"
                    style="--accent:#ff4fa3"
                >
                    <div class="service-icon">▶</div>
                    <h3>Edición de video</h3>
                    <p>Videos cortos, anuncios, reels, contenido deportivo y material audiovisual para redes.</p>
                </a>

                <a
                    href="{{ route('catalogo', ['categoria' => ['Redes Sociales']]) }}"
                    class="service-card reveal"
                    style="--accent:#ff9f43"
                >
                    <div class="service-icon">▣</div>
                    <h3>Redes Sociales</h3>
                    <p>Publicaciones, carruseles, historias y piezas adaptadas a Facebook, Instagram, TikTok y YouTube.</p>
                </a>

                <a
                    href="{{ route('catalogo', ['categoria' => ['Flyers & Bounchers']]) }}"
                    class="service-card reveal"
                    style="--accent:#35d07f"
                >
                    <div class="service-icon">⌁</div>
                    <h3>Flyers & Bounchers</h3>
                    <p>Flyers, banners y piezas publicitarias para promociones, eventos y campañas digitales.</p>
                </a>

                <a
                    href="{{ route('catalogo', ['categoria' => ['Motion Graphics']]) }}"
                    class="service-card reveal"
                    style="--accent:#5a7dff"
                >
                    <div class="service-icon">◎</div>
                    <h3>Motion Graphics</h3>
                    <p>Animaciones creativas con textos y efectos visuales para contenido publicitario y redes sociales.</p>
                </a>
            </div>
        </div>
    </section>

    <section class="section" id="portafolio">
        <div class="container">
            <div class="section-title reveal">
                <span class="eyebrow">Portafolio</span>
                <h2>Una vitrina para ideas que ya cobraron forma.</h2>
                <p>
                    Estas piezas son muestras editables. Puedes sustituirlas luego por proyectos reales de Punto Creativo.
                </p>
            </div>

            <div class="portfolio-shell reveal">
                <div class="filter-row" aria-label="Filtros del portafolio">
                    <button class="filter-btn active" data-filter="all">Todo</button>
                    <button class="filter-btn" data-filter="diseno">Diseño</button>
                    <button class="filter-btn" data-filter="video">Video</button>
                    <button class="filter-btn" data-filter="marca">Marca</button>
                    <button class="filter-btn" data-filter="deportes">Deportes</button>
                </div>

                <div class="portfolio-grid">
                    <article class="work" data-category="diseno">
                        <div class="work-bg"></div>
                        <div class="work-content">
                            <small>Campaña digital</small>
                            <h3>Lanzamiento para emprendimiento</h3>
                        </div>
                    </article>

                    <article class="work" data-category="video">
                        <div class="work-bg"></div>
                        <div class="work-content">
                            <small>Contenido audiovisual</small>
                            <h3>Reel promocional</h3>
                        </div>
                    </article>

                    <article class="work" data-category="deportes">
                        <div class="work-bg"></div>
                        <div class="work-content">
                            <small>Diseño deportivo</small>
                            <h3>Jornada y resultados</h3>
                        </div>
                    </article>

                    <article class="work" data-category="marca">
                        <div class="work-bg"></div>
                        <div class="work-content">
                            <small>Identidad visual</small>
                            <h3>Marca local</h3>
                        </div>
                    </article>

                    <article class="work" data-category="diseno">
                        <div class="work-bg"></div>
                        <div class="work-content">
                            <small>Redes sociales</small>
                            <h3>Carrusel informativo</h3>
                        </div>
                    </article>

                    <article class="work" data-category="video">
                        <div class="work-bg"></div>
                        <div class="work-content">
                            <small>Edición</small>
                            <h3>Video corto vertical</h3>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="proceso">
        <div class="container">
            <div class="section-title reveal">
                <span class="eyebrow">Cómo trabajamos</span>
                <h2>Un proceso claro, sin laberintos de correos.</h2>
                <p>
                    La comunicación se mantiene directa para reducir errores y avanzar con mayor rapidez.
                </p>
            </div>

            <div class="process-grid">
                <article class="step reveal">
                    <h3>Cuéntanos tu idea</h3>
                    <p>Describe el servicio, objetivo, público, estilo y fecha en que necesitas el trabajo.</p>
                </article>

                <article class="step reveal">
                    <h3>Recibe tu propuesta</h3>
                    <p>Definimos alcance, precio referencial, tiempo de entrega y condiciones del proyecto.</p>
                </article>

                <article class="step reveal">
                    <h3>Diseño y revisión</h3>
                    <p>Preparamos la propuesta visual, enviamos avances y aplicamos los cambios acordados.</p>
                </article>

                <article class="step reveal">
                    <h3>Entrega digital</h3>
                    <p>Recibes los archivos finales listos para publicar, compartir o utilizar en tu negocio.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section" id="paquetes">
        <div class="container">
            <div class="section-title reveal">
                <span class="eyebrow">Paquetes sugeridos</span>
                <h2>Opciones simples para comenzar.</h2>
                <p>
                    Los valores son referenciales y pueden ajustarse según complejidad, cantidad de piezas y tiempo de entrega.
                </p>
            </div>

            <div class="pricing-grid">
                <article class="price-card reveal">
                    <h3>Diseño puntual</h3>
                    <p>Para una necesidad específica o una publicación rápida.</p>
                    <div class="price">Desde L 100 <small>/ proyecto</small></div>
                    <ul class="feature-list">
                        <li><i class="check">✓</i> 1 pieza gráfica</li>
                        <li><i class="check">✓</i> Adaptación a una plataforma</li>
                        <li><i class="check">✓</i> Cambios básicos</li>
                        <li><i class="check">✓</i> Entrega digital</li>
                    </ul>
                    <a class="btn btn-secondary" href="{{route('producto')}}?id=anuncio-publicitario">Ver servicio</a>
                </article>

                <article class="price-card featured reveal">
                    <span class="popular">Recomendado</span>
                    <h3>Impulso digital</h3>
                    <p>Para negocios que necesitan varias piezas coordinadas.</p>
                    <div class="price">Cotización <small>/ paquete</small></div>
                    <ul class="feature-list">
                        <li><i class="check">✓</i> Publicaciones para redes</li>
                        <li><i class="check">✓</i> Diseño adaptado a la marca</li>
                        <li><i class="check">✓</i> Una pieza de video corto</li>
                        <li><i class="check">✓</i> Atención prioritaria</li>
                    </ul>
                    <a class="btn btn-primary" href="{{route('producto')}}l?id=pack-publicaciones">Ver paquete</a>
                </article>

                <article class="price-card reveal">
                    <h3>Contenido mensual</h3>
                    <p>Para marcas, páginas o medios que publican constantemente.</p>
                    <div class="price">Personalizado <small>/ mes</small></div>
                    <ul class="feature-list">
                        <li><i class="check">✓</i> Calendario de contenido</li>
                        <li><i class="check">✓</i> Diseños recurrentes</li>
                        <li><i class="check">✓</i> Videos o miniaturas</li>
                        <li><i class="check">✓</i> Seguimiento continuo</li>
                    </ul>
                    <a class="btn btn-secondary" href="{{route('producto')}}?id=plan-mensual">Ver plan</a>
                </article>
            </div>
        </div>
    </section>

    <section class="section" id="nosotros">
        <div class="container about-grid">
            <div class="about-card reveal" aria-label="Valores de Punto Creativo">
                <div class="about-chip">⚡ Agilidad</div>
                <div class="about-chip">✦ Creatividad</div>
                <div class="about-chip">◎ Cercanía</div>
            </div>

            <div class="about-copy reveal">
                <span class="eyebrow">Sobre Punto Creativo</span>
                <h2>Diseño cercano, flexible y hecho para el entorno digital.</h2>
                <p>
                    Punto Creativo nació para ayudar a pequeños negocios, medios, páginas deportivas
                    y creadores a comunicar sus ideas mediante contenido visual atractivo.
                </p>
                <p>
                    La empresa combina diseño gráfico y edición audiovisual con atención directa,
                    precios accesibles y conocimiento del mercado local hondureño.
                </p>

                <div class="about-list">
                    <div><strong>Personalización real:</strong> cada diseño responde a la necesidad del cliente.</div>
                    <div><strong>Servicio integral:</strong> imagen, video y contenido dentro de una sola propuesta.</div>
                    <div><strong>Escalabilidad:</strong> preparada para incorporar automatización, IA y nuevos servicios digitales.</div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="cotizar">
        <div class="container">
            <div class="quote-shell reveal">
                <aside class="quote-info">
                    <span class="eyebrow">Hablemos</span>
                    <h2>Convierte tu idea en un proyecto.</h2>
                    <p>
                        Completa el formulario y se abrirá WhatsApp con el resumen de tu solicitud.
                    </p>

                    <div class="contact-list">
                        <div class="contact-item">
                            <span class="contact-icon">⌖</span>
                            <span>Guanacaste, El Paraíso, Honduras</span>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">◉</span>
                            <span>Atención digital por WhatsApp</span>
                        </div>
                        <div class="contact-item">
                            <span class="contact-icon">✉</span>
                            <span>Entrega mediante archivos o enlaces digitales</span>
                        </div>
                    </div>
                </aside>

                <form class="quote-form" id="quoteForm">
                    <div class="field">
                        <label for="name">Nombre</label>
                        <input id="name" name="name" type="text" placeholder="Tu nombre" required />
                    </div>

                    <div class="field">
                        <label for="business">Empresa o proyecto</label>
                        <input id="business" name="business" type="text" placeholder="Nombre de tu marca" />
                    </div>

                    <div class="field">
                        <label for="service">Servicio</label>
                        <select id="service" name="service" required>
                            <option value="">Seleccionar</option>
                            <option>Diseño publicitario</option>
                            <option>Logo e identidad visual</option>
                            <option>Edición de video</option>
                            <option>Contenido para redes</option>
                            <option>Miniaturas digitales</option>
                            <option>Paquete mensual</option>
                            <option>Otro servicio</option>
                        </select>
                    </div>

                    <div class="field">
                        <label for="deadline">Fecha estimada</label>
                        <input id="deadline" name="deadline" type="date" />
                    </div>

                    <div class="field full">
                        <label for="details">Cuéntanos qué necesitas</label>
                        <textarea id="details" name="details" placeholder="Objetivo, cantidad de piezas, estilo, plataforma y cualquier referencia..." required></textarea>
                    </div>

                    <p class="form-note">
                        Importante: cambia el número de WhatsApp dentro del código antes de publicar el sitio.
                    </p>

                    <button class="btn btn-whatsapp" type="submit">Enviar solicitud por WhatsApp</button>
                </form>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="section-title reveal" style="margin-inline:auto; text-align:center;">
                <span class="eyebrow">Preguntas frecuentes</span>
                <h2>Lo esencial antes de comenzar.</h2>
            </div>

            <div class="faq-grid reveal">
                <details>
                    <summary>¿Cómo se entrega el trabajo?</summary>
                    <p>La entrega se realiza digitalmente mediante WhatsApp, correo o enlace de descarga, según el tipo de archivo.</p>
                </details>

                <details>
                    <summary>¿Los precios siempre son los mismos?</summary>
                    <p>No. El precio depende de la complejidad, cantidad de piezas, urgencia y nivel de edición requerido.</p>
                </details>

                <details>
                    <summary>¿Pueden trabajar con clientes fuera de El Paraíso?</summary>
                    <p>Sí. Todo el proceso puede gestionarse en línea, por lo que Punto Creativo puede atender clientes de otras ciudades y países.</p>
                </details>

                <details>
                    <summary>¿Ofrecen contenido mensual?</summary>
                    <p>Sí. Se pueden crear paquetes recurrentes para negocios, páginas deportivas, medios y creadores de contenido.</p>
                </details>
            </div>
        </div>
    </section>
</main>

<footer>


    <div class="container">



        <div class="footer-grid">





            <div class="footer-brand">



                <a href="{{route('index')}}" class="brand">


<span class="brand-mark">

<span>
PC
</span>


</span>


                    <span>
Punto Creativo
</span>



                </a>





                <p>

                    Diseño gráfico, edición audiovisual en Honduras

                </p>




            </div>







            <div class="footer-col">



                <h4>
                    Contacto
                </h4>

                <h4>
                    <i class="fa-solid fa-envelope"></i> info@puntocreativo.hn <br>
                    <i class="fa-solid fa-phone"></i> +504 9999-8888 <br>
                    <i class="fa-solid fa-location-dot"></i> Danli, El Paraíso
                </h4>

            </div>





            <div class="footer-col">


                <h4>
                    Redes Sociales
                </h4>

                <div>
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-youtube"></i>
                    <i class="fa-brands fa-tiktok"></i>

                </div>

                <div>
                    <a href="{{route('terminos')}}">
                        Términos
                        <a href="{{route('privacidad')}}">
                            Privacidad
                        </a>
                        <a href="{{route('cookies')}}">
                            Cookies
                        </a>
                    </a>
                </div>










            </div>


        </div>

        <div class="footer-bottom">


<span>

    © <span data-year></span> Punto Creativo. Todos los derechos reservados.

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
>✆</a>

<script>
    // WhatsApp real de Punto Creativo.
    // Formato: código de país + número, sin espacios ni símbolos.
    const WHATSAPP_NUMBER = "50492336467";

    const menuToggle = document.querySelector(".menu-toggle");
    const navLinks = document.getElementById("navLinks");

    menuToggle.addEventListener("click", () => {
        const isOpen = navLinks.classList.toggle("open");
        menuToggle.setAttribute("aria-expanded", isOpen);
        menuToggle.textContent = isOpen ? "×" : "☰";
    });

    navLinks.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", () => {
            navLinks.classList.remove("open");
            menuToggle.setAttribute("aria-expanded", "false");
            menuToggle.textContent = "☰";
        });
    });

    const filterButtons = document.querySelectorAll(".filter-btn");
    const works = document.querySelectorAll(".work");

    filterButtons.forEach(button => {
        button.addEventListener("click", () => {
            filterButtons.forEach(btn => btn.classList.remove("active"));
            button.classList.add("active");

            const filter = button.dataset.filter;

            works.forEach(work => {
                const matches = filter === "all" || work.dataset.category === filter;
                work.classList.toggle("hidden", !matches);
            });
        });
    });

    const quoteForm = document.getElementById("quoteForm");

    quoteForm.addEventListener("submit", event => {
        event.preventDefault();

        const name = document.getElementById("name").value.trim();
        const business = document.getElementById("business").value.trim();
        const service = document.getElementById("service").value;
        const deadline = document.getElementById("deadline").value;
        const details = document.getElementById("details").value.trim();

        const message = [
            "Hola, Punto Creativo. Quiero solicitar una cotización.",
            "",
            `Nombre: ${name}`,
            `Empresa o proyecto: ${business || "No indicado"}`,
            `Servicio: ${service}`,
            `Fecha estimada: ${deadline || "No indicada"}`,
            "",
            "Detalles:",
            details
        ].join("\n");

        const url = `https://wa.me/${WHATSAPP_NUMBER}?text=${encodeURIComponent(message)}`;
        window.open(url, "_blank", "noopener");
    });

    if ("IntersectionObserver" in window) {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        document.querySelectorAll(".reveal").forEach(element => observer.observe(element));
    } else {
        document.querySelectorAll(".reveal").forEach(element => element.classList.add("visible"));
    }
    document.getElementById("year").textContent = new Date().getFullYear();
</script>
<script src="../../public/js/products.js"></script>
<script src="../../public/js/index-upgrade.js"></script>
<script src="{{ asset('js/store.js') }}"></script>
<script src="{{ asset('js/carrito.js') }}?v={{ time() }}"></script>
</body>
</html>

