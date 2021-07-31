<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- estilos globales -->
    <link rel="stylesheet" href="/css/app.css">   
    <!-- estilos especificos del layout -->
    <link rel="stylesheet" href="/css/inicio.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- para agregar recursos css o javascript dsde otros blade template -->
    @yield('assets')

</head>
<body>
    <header class="container">
        <figure class="logo">
            <a href="/"><img src="/img/pics/logo.png" alt="Logo"></a>
        </figure>
        <nav class="navegation">
        @yield('menu')
        
            </nav>
        <nav>
        <ul>
            <li><a href="/logout" class="item-login">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <div class="center">
    @yield('content')
    </div>
    
</body>
</html>