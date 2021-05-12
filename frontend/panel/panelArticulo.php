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
        <div id="contenedorPrincipal">
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre del artículo</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th colspan="3"><a href="../admin/crearArticulo.php"><i class="fas fa-plus"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $conexion = conectarBd(true);
                    $result = mostrarArticulos($conexion);
                    while ($fila = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><img src="../<?php echo $fila['foto']?>" alt="imagenArticulo"></td>    
                        <td><?php echo $fila['nArticulo']?></td>
                        <td><?php echo $fila['precio']?></td>
                        <td><?php echo $fila['stock']?></td>
                        <td><a href="../admin/editarArticulo.php?idArticulo=<?php echo $fila['id']?>"><i class="fas fa-edit"></i></a></td>
                        <td><a href="../../backend/admin/borrarArticulo.php?idArticulo=<?php echo $fila['id']?>"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
<script src="https://kit.fontawesome.com/143eda576b.js" crossorigin="anonymous"></script>
