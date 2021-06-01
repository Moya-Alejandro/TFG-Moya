<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php 
    require '../../backend/bd/DAOusuario.php';
    require '../../backend/bd/DAOcategoria.php';
    $error = "";
    if(isset($_GET["error"])){
        $error = $_GET["error"];
    }
    
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
        <link rel="stylesheet" href="../migasPan/migasPan.css">
    </head>
    <body class="index">
        <div class="cuerpo">
            <div class="contenedor">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href=""> Panel de Categorías </a></li>
                </ul>
                <div id="contenedorPrincipal">
                    <a href="../admin/crearCategoria.php"><i class="fas fa-plus"></i></a>
                    <?php
                        $conexion = conectarBd(true);
                        $result = mostrarCategorias($conexion);
                        while ($fila = mysqli_fetch_assoc($result)) {
                    ?>
                    <div id="contenedor">
                        <?php echo $fila['nombre']?>
                        <a href="../admin/editarCategoria.php?idCategoria=<?php echo $fila['id']?>"><i class="fas fa-edit"></i></a>
                        <a href="../../backend/admin/borrarCategoria.php?idCategoria=<?php echo $fila['id']?>"><i class="fas fa-trash-alt"></i></a>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <p style="color:red;"><strong><?php echo $error?></strong></p>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>   
    </body>
</html>
<script src="https://kit.fontawesome.com/143eda576b.js" crossorigin="anonymous"></script>