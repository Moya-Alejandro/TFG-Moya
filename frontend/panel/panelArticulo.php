<?php
    require_once('../header/header.php');
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
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Imagen</th>
                    <th>Nombre del artículo</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Detalles</th>
                    <th colspan="3"><a href="../admin/crearArticulo.php">Crear</a></th>
                </tr>
            </thead>
            <tbody>
            <?php
                $conexion = conectarBd(true);
                $result = mostrarArticulos($conexion);
                while ($fila = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $fila['id']?></td>
                    <td><img src="../<?php echo $fila['foto']?>" alt="imagenArticulo"></td>    
                    <td><?php echo $fila['nArticulo']?></td>
                    <td><?php echo $fila['precio']?></td>
                    <td><?php echo $fila['stock']?></td>
                    <td><?php echo $fila['detalles']?></td>
                    <td><button><a href="../admin/editarArticulo.php?idArticulo=<?php echo $fila['id']?>">editar</a></button></td>
                    <td><button><a href="../../backend/admin/borrarArticulo.php?idArticulo=<?php echo $fila['id']?>">borrar</a></button></td>
                </tr>
            <?php
               }
            ?>
            </tbody>
        </table>
    </body>
</html>