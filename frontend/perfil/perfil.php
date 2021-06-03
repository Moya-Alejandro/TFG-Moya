<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/perfil.css">
        <link rel="stylesheet" href="../index/css/index.css">
        <link rel="stylesheet" href="../migasPan/css/migasPan.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedorPerfil">
                <ul id="migasPan">
                    <li><a  href="../index/index.php"> Inicio </a></li>
                    <li><a class="active" href=""> Perfil </a></li>
                </ul>
                <div class="carta-body">
                    <div class="carta">
                        <form id="formRegistrar" action="../../backend/usuario/editarPerfil.php" method="POST">
                            <h4>Perfil</h4>
                            <hr>
                            <!--Mostramos los valores del usuario por variables locales de $_SESSION-->
                            <div class="campos">
                                <div class="campo">
                                    <label for="nombre">Nombre</label>
                                    <input class="inputForm" id="nombre" value="<?php echo $_SESSION['nombre'];?>" type="text" name="nombre" >
                                    <p id="errorNombre">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="apellidos">Apellidos</label>
                                    <input class="inputForm" id="apellidos" value="<?php echo $_SESSION['apellidos'];?>" type="text" name="apellidos" >
                                    <p id="errorApellidos">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="telefono">Telefono</label>
                                    <input class="inputForm" id="telefono" value="<?php echo $_SESSION['telefono'];?>" type="text" name="telefono" >
                                    <p id="errorTelefono">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="dni">DNI</label>
                                    <input class="inputForm" id="dni" value="<?php echo $_SESSION['dni'];?>" type="text" name="dni" >
                                    <p id="errorDni">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="usuario">Usuario </label>
                                    <input class="inputForm" id="usuario" value="<?php echo $_SESSION['nUsuario'];?>" type="text" name="usuario" >
                                    <p id="errorUsuario">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="correo">Correo Electrónico</label>
                                    <input class="inputForm" id="correo" value="<?php echo $_SESSION['correo'];?>" type="text" name="correo" >
                                    <p id="errorCorreo">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="password">Contraseña</label>
                                    <input class="inputForm" id="password" value="<?php echo $_SESSION['password'];?>" type="password" name="password" >
                                    <p id="errorPassword">Algo ha salido mal</p>
                                </div>
                                <div class="campo">
                                    <label for="password2">Repita la contraseña</label>
                                    <input class="inputForm" id="password2" value="<?php echo $_SESSION['password'];?>" type="password" name="password2" >
                                    <p id="errorPassword2">La contraseña no coincide</p>
                                </div>
                            </div>
                            <div class="botonesPerfil">
                                <div class="botonEditar">
                                    <button class="botonForm">Editar Perfil</button>
                                </div>
                                <div class="botonBorrarPefill">
                                    <p onclick="confirmarBorrar(<?php echo $_SESSION['id']; ?>)" class="botonForm">Borrar Usuario</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>    
        <script src="../registrar/js/registrar.js"></script>
        <script src="js/perfil.js"></script>
    </body>
</html>
