<?php
    $error = "";
    if(isset($_GET["error"])){
        $error = $_GET["error"];
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
    </head>
    <body class="index">
        <?php require_once('../header/header.php') ?>
        <div class="carta-body">
            <div class="carta">
                <form id="form" action="../../backend/usuario/iniciarsesion.php" method="POST">
                    <h4>Iniciar Sesión</h4>
                    <hr>
                    <div class="campos">
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
                        <a href="../recuperar/recuperar.php">¿Contraseña Olvidada?</a>
                    </div>
                    <div class="error">
                        <p style="color:red;"><strong><?php echo $error?></strong></p>
                        <p id="errorForm">Rellene bien los campos.</p>
                    </div>
                </form>
            </div>
        </div>  
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>