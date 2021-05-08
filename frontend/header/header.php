<?php
	require '../../backend/bd/conectarBD.php';
    $rol = "invitado";
	if(session_start()&&isset($_SESSION["rol"])){
        $rol = $_SESSION['rol'];
    }
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Melilla Shooting</title>
    <link rel="stylesheet" href="../header/header.css">
</head>
<body>
    <header class="header">
        <div class="contenedor-imagen">
            <a href="../index/index.php">
                <img class="logo" src="../img/LogoB.png">
            </a>
        </div>
        <div class="campoBusqueda">
            <input type="text" placeholder="Búsqueda..." />
            <button type="button">Buscar</button>
        </div>
        <ul class="lista">
            <li class="elemento user">
                <label class="label" for="user"><img  class="elemento" src="../img/user.png" alt="Usuario"></label>
                <input type="checkbox" id="user" class="checkboxUsuario"/>
                <ul class="header-usuario">
                    <?php
                    if($rol=="usuario"){
                    ?>
                        <li><a href="">Perfil</a></li>  
                        <li><a href="../../backend/usuario/cerrarSesion.php">Desconectarse</a></li>
                    <?php
                    }
                    elseif($rol=="admin"){
                    ?>
                        <li><a href="">Perfil</a></li>
                        <li><a href="../panel/panelArticulo.php">Artículos</a></li>
                        <li><a href="../panel/panelCategoria.php">Categorías</a></li>
                        <li><a href="../../backend/usuario/cerrarSesion.php">Desconectarse</a></li>
                    <?php
                    }
                    elseif($rol=="invitado"){
                    ?>
                        <li><a href="../login/login.php">Iniciar Sesión</a></li>
                        <li><a href="../registrar/registrar.php">Registrarse</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
            <li class="elemento">
                <label class="label" for="carrito"><img class="elemento" src="../img/shopping-cart.png" alt="carrito"></label>
            </li>
        </ul>
    </header>   
</body>
</html>