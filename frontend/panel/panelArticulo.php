<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php
    require '../../backend/bd/DAOarticulo.php';

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
            <a href="../admin/crearArticulo.php"><i class="fas fa-plus"></i></a>
            <?php
                $conexion = conectarBd(true);
                $result = mostrarArticulos($conexion);
                while ($fila = mysqli_fetch_assoc($result)) {
            ?>
            <div id="contenedor">
                <img src="../<?php echo $fila['foto']?>" alt="imagenArticulo">
                <?php echo $fila['nArticulo']?>
                <?php echo $fila['precio']?>
                <?php echo $fila['stock']?>
                <a href="../admin/editarArticulo.php?idArticulo=<?php echo $fila['id']?>"><i class="fas fa-edit"></i></a>
                <a href="../../backend/admin/borrarArticulo.php?idArticulo=<?php echo $fila['id']?>"><i class="fas fa-trash-alt"></i></a>
            </div>
            <?php
                }
            ?>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="https://kit.fontawesome.com/143eda576b.js" crossorigin="anonymous"></script>
