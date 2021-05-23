<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php
    $error = "";
    if(isset($_GET["error"])){
        $error = $_GET["error"];
    }

    $enviado = "";
    if(isset($_GET["enviado"])){
        $enviado = $_GET["enviado"];
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="../index/index.css">
        <link rel="stylesheet" href="../migasPan/migasPan.css">
    </head>
    <body class="index">
        <ul id="migasPan">
            <li><a href="../index/index.php"> Inicio </a></li>
            <li><a href=""> Inicio de Sesión </a></li>
        </ul>
        <div class="carta-body">
            <div class="carta">
                <form id="form" action="../../backend/usuario/iniciarsesion.php" method="POST">
                    <h4>Iniciar Sesión</h4>
                    <hr>
                    <div class="campos">
                        <?php echo $enviado; ?>
                        <div class="campo">
                            <label for="usuario">Usuario </label>
                            <input id="usuario" type="text" name="usuario" required >
                            <p id="errorUsuario">Algo ha salido mal</p>
                        </div>
                        <div class="campo">
                            <label for="password">Contraseña</label>
                            <input id="password" type="text" name="password" required>
                            <p id="errorPassword">Algo ha salido mal</p>
                        </div>
                    </div>
                    <div class="botonIniciarsesion">
                        <button class="botonForm">Iniciar Sesión</button>
                        <a href="../registrar/registrar.php">Registrarse</a>
                    </div>
                    <div class="error">
                        <p style="color:red;"><strong><?php echo $error?></strong></p>
                        <p id="errorForm">Rellene bien los campos.</p>
                    </div>
                </form>
                <label for="recuperarPass">¿Contraseña Olvidada?</label><input type="checkbox" id="recuperarPass" class="botonOlvidado"/>
                <form class="recuperarForm" action="../../backend/usuario/recuperar.php" method="POST">
                    <div class="recuperarDiv">
                        <h4>Recuperar Contraseña</h4>
                        <label for="recuperarPass"><i class="fas fa-times"></i></label>
                        <span>Introduzca su correo</span>
                        <input name="correo" placeholder="ejemplo@gmail.com" type="text">
                        <button class ="botonRecuperar">Recuperar</button>
                    </div>
                </form>
            </div>
        </div>  
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>