<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="Confirmación y número de pedido de Punto Creativo.">
    <title>Confirmación de orden | Punto Creativo</title>
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
        href="{{ asset('css/confirmacion.css') }}?v={{ time() }}"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


</head>

<body>

<div class="topbar">
    Diseño gráfico, edición audiovisual y contenido digital desde El Paraíso, Honduras.
</div>

<nav class="navbar">
    <div class="container nav-inner">

        <a href="{{route('index')}}" class="brand" aria-label="Ir al inicio">
<span class="brand-mark">
<span>PC</span>
</span>
            <span>Punto Creativo</span>
        </a>

        <button class="menu-toggle" aria-label="Abrir menú" aria-expanded="false">
            ☰
        </button>

        <div class="nav-links" id="navLinks">

            <a href="{{route('index')}}">Inicio</a>
            <a href="{{route('catalogo')}}">Tienda</a>
            <a href="{{route('index')}}#portafolio">Portafolio</a>
            <a href="{{route('index')}}#cotizar">Contacto</a>

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

            <a class="nav-icon" href="{{route('cuenta')}}" aria-label="Mi cuenta" title="Mi cuenta">
                ♙
            </a>

            <a class="nav-icon" href="{{route('carrito')}}" aria-label="Carrito" title="Carrito">
                🛒
                <span class="cart-badge" data-cart-count>0</span>
            </a>

        </div>
    </div>
</nav>

<main>

    <header class="confirmation-header">
        <div class="container confirmation-container">

            <nav class="breadcrumbs">

                <a href="{{ route('index') }}">
                    Inicio
                </a>

                <span>›</span>

                <span>Confirmación</span>

            </nav>

            <span class="eyebrow">
                Paso 3 de 3 completado
            </span>

            <h1>
                Confirmación de orden.
            </h1>

            <p>
                Consulta los detalles del pedido,
                los servicios contratados y los próximos pasos.
            </p>

        </div>
    </header>

    <section class="confirmation-section">
        <div class="container confirmation-container">

            <div
                class="success-card"
                id="confirmationCard"
            ></div>

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

<a class="whatsapp-float"
   href="https://wa.me/50400000000"
   target="_blank"
   rel="noopener"
   aria-label="Contactar por WhatsApp"
   title="WhatsApp">
    ✆
</a>

<script src="{{ asset('js/store.js') }}"></script>
<script src="{{ asset('js/common.js') }}"></script>
<script src="{{ asset('js/confirmacion.js') }}?v={{ time() }}"></script>

</body>
</html>
