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
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="../index/css/index.css">
        <link rel="stylesheet" href="../migasPan/css/migasPan.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedorLogin">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href=""> Inicio de Sesión </a></li>
                </ul>
                <div class="carta-body">
                    <div class="carta">
                        <form id="form" action="../../backend/usuario/iniciarsesion.php" method="POST">
                            <h4>Iniciar Sesión</h4>
                            <hr class="lineaInicioSesion">
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
                            </div>
                            <div class="error">
                                <?php //A la hora de recuperar contraseña, nos saldrá una alerta según la variable recibida por el backend, nos saldrá un error o un mensaje de que ha sido enviado
                                    if(isset($_GET['error']) && $_GET['error'] == "$error"){ 
                                    echo "<script>swal('Melilla Shooting', '$error', 'error');</script>";
                                    }
                                ?>
                                <?php
                                    if(isset($_GET['enviado']) && $_GET['enviado'] == "$enviado"){ 
                                    echo "<script>swal('Melilla Shooting', '$enviado', 'success');</script>";
                                    }
                                ?>
                                <p id="errorForm">Rellene bien los campos.</p>
                            </div>
                        </form>
                        <!--Mostramos una alerta para poder introducir el correo-->
                        <label for="recuperarPass" onclick="mostrarRecuperarContra()">¿Contraseña Olvidada?</label><input type="checkbox" id="recuperarPass" class="botonOlvidado"/>
                    </div>
                </div>
            </div>  
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="js/login.js"></script>