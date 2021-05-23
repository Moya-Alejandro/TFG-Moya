<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php 
    require '../../backend/bd/DAOusuario.php';
    if($_SESSION["rol"] != "admin"){
        header('Location: ../index/index.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="panel.css">
        <link rel="stylesheet" href="../index/index.css">
    </head>
    <body class="index">
        <div id="contenedorPrincipal">
            <a href="../registrar/registrar.php"><i class="fas fa-plus"></i></a>
            <?php
                $conexion = conectarBd(true);
                $result = mostrarUsuarios($conexion);
                while ($fila = mysqli_fetch_assoc($result)) {
            ?>
            <div id="contenedor">
                <?php echo $fila['nUsuario']?>
                <?php echo $fila['correo']?>
                <?php echo $fila['dni']?>
                <?php echo $fila['telefono']?>
                <a href="../admin/editarUsuario.php?idUsuario=<?php echo $fila['id']?>"><i class="fas fa-user-edit"></i></a>
                <a href="../../backend/usuario/borrarUsuario.php?id=<?php echo $fila['id']?>"><i class="fas fa-user-minus"></i></a>
                <a href="../../backend/admin/darAdmin.php?idUsuario=<?php echo $fila['id']?>"><i class="fas fa-user-shield"></i></a>
            </div>
            <?php
                }
            ?>
        </div>
        <?php require_once('../footer/footer.php') ?>  
    </body>
</html>
<script src="https://kit.fontawesome.com/143eda576b.js" crossorigin="anonymous"></script>