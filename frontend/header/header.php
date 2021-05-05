<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Melilla Shooting</title>
    <link rel="stylesheet" href="header/header.css">
</head>
<body>
    <header class="header">
        <div class="contenedor-imagen">
            <img class="logo" src="img/LogoB.png">
        </div>
        <div class="campo">
            <input type="text" placeholder="Búsqueda..." />
            <button type="button">Buscar</button>
        </div>
        <ul class="lista">
            <li class="elemento usuario">
                <label class="label" for="usuario"><img class="elemento" src="img/user.png" alt="usuario"></label>
                <input type="checkbox" id="usuario" class="checkboxUsuario"/>
                <ul class="header-usuario">
                    <?php
                    if($rol=="usuario"){
                    ?>
                        <li><a href="">Perfil</a></li>  
                        <li><a href="">Desconectarse</a></li>
                    <?php
                    }
                    elseif($rol=="admin"){
                    ?>
                        <li><a href="">Perfil</a></li>
                        <li><a href="">Panel</a></li>
                        <li><a href="">Desconectarse</a></li>
                    <?php
                    }
                    else{
                    ?>
                        <li><a href="">Iniciar Sesión</a></li>
                        <li><a href="">Registrarse</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
            <li class="elemento">
                <img src="img/shopping-cart.png" alt="carrito">
            </li>
        </ul>
    </header>
</body>
</html>