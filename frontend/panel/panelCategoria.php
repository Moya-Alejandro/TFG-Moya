<?php 
    require_once('../header/header.php');
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
    </head>
    <body class="index">
        <table>
            <thead>
                <tr>
                    <th>Id de la Categoría</th>
                    <th>Nombre de la Categoría</th>
                    <th colspan="3"><a href="../admin/crearCategoria.php">Crear</a></th>
                </tr>
            </thead>
            <tbody>
            <?php
                $conexion = conectarBd(true);
                $result = mostrarCategorias($conexion);
                while ($fila = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $fila['id']?></td>
                    <td><?php echo $fila['nombre']?></td>
                    <td><button><a href="../admin/editarCategoria.php?idCategoria=<?php echo $fila['id']?>">editar</a></button></td>
                    <td><button><a href="../../backend/admin/borrarCategoria.php?idCategoria=<?php echo $fila['id']?>">borrar</a></button></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        <p style="color:red;"><strong><?php echo $error?></strong></p>
    </body>
</html>