<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php

    $error = "";
    if(isset($_GET["error"])){
        $error = $_GET["error"];
    }

    $rol = "";
    if(isset($_SESSION["rol"])){
        $rol = $_SESSION["rol"];
    }

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../perfil/perfil.css">
        <link rel="stylesheet" href="../index/index.css">
        <link rel="stylesheet" href="../migasPan/migasPan.css">
    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedorPerfil">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href=""> Registrar Usuario </a></li>
                </ul>
                <div class="carta-body">
                    <div class="carta">
                        <form id="form" action="../../backend/usuario/registrar.php" method="POST">
                            <h4>Crear Cuenta</h4>
                            <hr>
                            <div class="campos">
                                <div class="campo">
                                    <label for="nombre">Nombre</label>
                                    <input id="nombre" type="text" name="nombre" >
                                    <p id="errorNombre">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="apellidos">Apellidos</label>
                                    <input id="apellidos" type="text" name="apellidos" >
                                    <p id="errorApellidos">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="telefono">Telefono</label>
                                    <input id="telefono" type="text" name="telefono" >
                                    <p id="errorTelefono">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="dni">DNI</label>
                                    <input id="dni" type="text" name="dni" >
                                    <p id="errorDni">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="usuario">Usuario </label>
                                    <input id="usuario" type="text" name="usuario" >
                                    <p id="errorUsuario">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="correo">Correo Electrónico</label>
                                    <input id="correo" type="text" name="correo" >
                                    <p id="errorCorreo">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="password">Contraseña</label>
                                    <input id="password" type="text" name="password" >
                                    <p id="errorPassword">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="password2">Repita la contraseña</label>
                                    <input id="password2" type="text" name="password2" >
                                    <p id="errorPassword2">La contraseña no coincide</p>
                                </div>
                            </div>
                            <div class="botonRegistrar">
                                <?php if($rol != "admin"){?>
                                <div class="g-recaptcha" data-sitekey="6LcnV-UaAAAAACfyjVinzl95qNZ5eDPPysN61WnI"></div><br/>
                                <span class="errorCaptcha"><?php echo $error; ?></span>
                                <?php } ?>
                                <button class="botonForm" id="botonRegistrar">Registrar Usuario</button>
                                <?php if($rol != "admin"){?>
                                <a href="../login/login.php">¿Ya tienes una cuenta?</a>
                                <?php } ?>
                            </div>
                            <div class="error">
                                <p id="errorForm">Rellene bien los campos.</p>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>  
        <script src="registrar.js"></script>
    </body>
</html>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
