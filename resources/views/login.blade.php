<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href ="css/login.css">
    <title>Inicio de Sesión</title>
</head>
<body>
    <div class="center">
        <h1>Iniciar Sesión</h1>
        <form  action="iniciar.html" method="POST" >
            <div class="campo">
                <input type="text" required>
                <span></span>
                <label >Usuario</label>
            </div>
            <div class="campo">
                <input type="password" required>
                <span></span>
                <label >Contraseña</label>
            </div>
            <div class="pass">Olvidé contraseña</div>
            <input type="submit" value="Iniciar Sesión"> 
            <div class="signup_link">
                <a href="/">Regresar</a>
            </div>
        </form>
    </div>
</body>
</html>