<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Residencia Uneista</title>
    <link rel="shortcut icon" href="img/pics/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <header class="container">
        <figure class="logo">
            <a href="/"><img src="img/pics/logo.png" alt="Logo"></a>
        </figure>
        <nav class="navegation">
            <ul class="menu">
                <li>
                    <a href="#" class="item-options">Inicio</a>
                </li>
                <li>
                    <a href="#nosotros" class="item-options">Sobre Nosotros</a>
                </li>
                <li>
                    <a href="#servicios" class="item-options">Nuestros Servicios</a>
                </li>
                <li>
                    <a href="#contacto" class="item-options">Contacto</a>
                </li>
            </ul>
        </nav>
        <nav>
            <ul>
                <li>
                    <a href="/login" class="item-login">Inicio Sesión</a>
                </li>
            </ul>
        </nav>
    </header>

    <!--header class="container">
        <figure class="logo">
            <img src="{{ asset('img/pics/logo.png') }}" alt="Logo">
        </figure>
        <nav>
            <a href="#" class="item-options">Inicio</a>
            <a href="#nosotros" class="item-options">Sobre Nosotros</a>
            <a href="#servicios" class="item-options">Nuestros Servicios</a>
            <a href="#contacto" class="item-options">Contacto</a>
        </nav>
        <nav class="nav-right">
        <a href="/login" class="item-options">Inicio Sesión</a>
        </nav>
    </header-->
    <header>
        <section class="textos-header">
            <h1>RES. UNEISTA</h1>
            <h2>Vivir con Tranquilidad</h2>
        </section>
        <div class="wave" style="height: 150px; overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                <path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path>
            </svg></div>
    </header>
    <main>
        <section class="contenedor sobre-nosotros" id="nosotros">
            <h2 class="titulo">Sobre Nosotros</h2>
            <div class="contenedor-sobre-nosotros">
                <img src="img/sobrenosotros.jpg" alt="" class="imagen-about-us">
                <div class="contenido-textos">
                    <h3><span>1</span>¿Quiénes somos?</h3>
                    <p>RES. Uneista es un software 100% en línea diseñado para la administración de la Residencia. Es la herramienta ideal para la gestión y administración del estado financiero.</p>
                    <h3><span>2</span>Propósito</h3>
                    <p>Vender un sistema de gestión de inmobiliarios a condominios en línea.</p>
                    <h3><span>3</span>Misión</h3>
                    <p>Ofrecer al condominio la posibilidad de automatizarse mediante un servicio de administración seguro que gestione las operaciones administrativas del inmueble, otorgando tranquilidad y satisfacción de los propietarios y así garantizar
                        una sana convivencia dentro de sus propiedades.</p>
                    <h3><span>4</span>Visión</h3>
                    <p>Ser la empresa líder en proporcionar un sistema que permita administrar de inmuebles.</p>
                </div>
            </div>
        </section>
        <section class="about-services" id="servicios">
            <div class="contenedor">
                <h2 class="titulo">Nuestros Servicios</h2>
                <div class="servicio-cont">
                    <div class="servicio-ind">
                        <img src="img/imagen1-administrar.jpg" alt="">
                        <h3>Servicio de administración seguro </h3>
                        <p>Ofrecer al condominio la posibilidad de automatizarse mediante un servicio de administración seguro.</p>
                    </div>
                    <div class="servicio-ind">
                        <img src="img/imagen2-finanzas.jpg" alt="">
                        <h3>Gestión de operaciones administrativas</h3>
                        <p>Gestione las operaciones administrativas del inmueble, resgistro de pagos y seguridad financiera</p>
                    </div>
                    <div class="servicio-ind">
                        <img src="img/imagen3.1.jpg" alt="">
                        <h3>Seguridad en sus operaciones administrativas</h3>
                        <p>Se otorga tranquilidad y satisfacción a los propietarios para garantizar una sana convivencia dentro de sus propiedades.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="contenedor-footer">
            <div class="content-foo">
                <h4>Teléfono</h4>
                <p>(0295)4174121</p>
            </div>
            <div class="content-foo">
                <h4>Email</h4>
                <p>Residenciauneista@gmail.com</p>
            </div>
            <div class="content-foo">
                <h4>Dirección</h4>
                <p>Los Naranjos</p>
            </div>
        </div>
        <div class="redes" id="contacto">
            <h4>Siguenos en:</h4>
            <ul class="social">
                <li>
                    <a href="https://www.facebook.com/" target="blank"><img src="img/facebook.png" width="45" height="45"></a>
                </li>
                <li>
                    <a href="https://www.twitter.com/" target="blank"><img src="img/twitter.png" width="45" height="45"></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/" target="blank"><img src="img/instagram.png" width="45" height="45"></a>
                </li>
            </ul>
        </div>
        <h2 class="titulo-final">&copy; ResidenciaUneista </h2>
    </footer>
</body>

</html>