<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php

    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../../backend/bd/DAOarticulo.php';

    //En caso de que el rol del usuario no sea admin, te redirijirá a inicio
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
        <link rel="stylesheet" href="css/panel.css">
        <link rel="stylesheet" href="../index/css/index.css">
        <link rel="stylesheet" href="../migasPan/css/migasPan.css">
    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedor">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href=""> Panel de Artículos </a></li>
                </ul>
                <div id="contenedorPrincipal">
                    <a href="../admin/crearArticulo.php"><i class="fas fa-plus"></i></a>
                    <?php
                        //Conectamos a la base de datos y mostramos por un while los valores de los articulos
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
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="https://kit.fontawesome.com/143eda576b.js" crossorigin="anonymous"></script>
