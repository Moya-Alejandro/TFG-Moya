<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="perfil.css">
        <link rel="stylesheet" href="../index/index.css">
    </head>
    <body class="index">
        <div class="carta-body">
            <div class="carta">
                <form id="form" action="../../backend/usuario/editarPerfil.php" method="POST">
                    <h4>Editar Perfil</h4>
                    <hr>
                    <div class="campos">
                        <div class="campo">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" value="<?php echo $_SESSION['nombre'];?>" type="text" name="nombre" >
                            <p id="errorNombre">Algo ha salido mal</p>
                        </div>
                        <div class="campo">
                            <label for="apellidos">Apellidos</label>
                            <input id="apellidos" value="<?php echo $_SESSION['apellidos'];?>" type="text" name="apellidos" >
                            <p id="errorApellidos">Algo ha salido mal</p>
                        </div>
                        <div class="campo">
                            <label for="telefono">Telefono</label>
                            <input id="telefono" value="<?php echo $_SESSION['telefono'];?>" type="text" name="telefono" >
                            <p id="errorTelefono">Algo ha salido mal</p>
                        </div>
                        <div class="campo">
                            <label for="dni">DNI</label>
                            <input id="dni" value="<?php echo $_SESSION['dni'];?>" type="text" name="dni" >
                            <p id="errorDni">Algo ha salido mal</p>
                        </div>
                        <div class="campo">
                            <label for="usuario">Usuario </label>
                            <input id="usuario" value="<?php echo $_SESSION['nUsuario'];?>" type="text" name="usuario" >
                            <p id="errorUsuario">Algo ha salido mal</p>
                        </div>
                        <div class="campo">
                            <label for="correo">Correo Electrónico</label>
                            <input id="correo" value="<?php echo $_SESSION['correo'];?>" type="text" name="correo" >
                            <p id="errorCorreo">Algo ha salido mal</p>
                        </div>
                        <div class="campo">
                            <label for="password">Contraseña</label>
                            <input id="password" value="<?php echo $_SESSION['password'];?>" type="text" name="password" >
                            <p id="errorPassword">Algo ha salido mal</p>
                        </div>
                        <div class="campo">
                            <label for="password2">Repita la contraseña</label>
                            <input id="password2" value="<?php echo $_SESSION['password'];?>" type="text" name="password2" >
                            <p id="errorPassword2">Algo ha salido mal</p>
                        </div>
                    </div>
                    <div class="botonEditar">
                        <button class="botonForm">Editar Perfil</button>
                    </div>
                    <div class="error">
                        <p id="errorForm">Rellene bien los campos.</p>
                    </div>
                </form>
            </div>
        </div> 
        <?php require_once('../footer/footer.php') ?>    
    </body>
</html>