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
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedorPanelArticulo">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href=""> Panel de Artículos </a></li>
                </ul>
                <div id="articulosDerecha">
                    <?php
                        //Conectamos a la base de datos y mostramos por un while los valores de los articulos
                        $conexion = conectarBd(true);
                        $result = mostrarArticulos($conexion);
                        while ($fila = mysqli_fetch_assoc($result)) {
                    ?>
                    <div id="articulos">
                        <div class="contenedorImagen">
                            <img class="imgCarta" src="../<?php echo $fila['foto']?>" alt="imagenArticulo">
                        </div>
                        <div class="contenedorNombreArticulo">
                            <p class="nombreValue"><?php echo $fila['nArticulo']?></p>
                        </div>
                        <div class="botonesArticulo">
                            <a href="../admin/editarArticulo.php?idArticulo=<?php echo $fila['id']?>">
                                <div class="botonEditarArticulo">
                                    <button class="botonBlanco">Editar</button>&nbsp<i class="fas fa-edit"></i>
                                </div>
                            </a> 
                            <div  onclick="confirmarBorrar(<?php echo $fila['id']?>)" class="botonBorrarArticulo">
                                <button class="botonBlanco">Borrar</button>&nbsp<i class="fas fa-trash-alt"></i> 
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <?php 
                    if(isset($_GET['error']) && $_GET['error'] == "$error"){ 
                        echo "<script>swal('Melilla Shooting', '$error', 'error');</script>";
                    }
                ?>
                <a class="hrefBotonCrear" href="../admin/crearArticulo.php">
                    <div class="botonCrear">
                        <button class="botonBlanco">Crear Artículo</button>&nbsp<i class="fas fa-plus"></i>
                    </div>
                </a>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="https://kit.fontawesome.com/143eda576b.js" crossorigin="anonymous"></script>
<script src="js/panelArticulo.js"></script>
