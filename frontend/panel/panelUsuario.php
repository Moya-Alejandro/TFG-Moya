<?php 
    require_once('../header/header.php');
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
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>DNI</th>
                        <th>Telefono</th>
                        <th colspan="3"><a href="../registrar/registrar.php"><i class="fas fa-plus"></i></a></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $conexion = conectarBd(true);
                    $result = mostrarUsuarios($conexion);
                    while ($fila = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $fila['nUsuario']?></td>
                        <td><?php echo $fila['correo']?></td>
                        <td><?php echo $fila['dni']?></td>
                        <td><?php echo $fila['telefono']?></td>
                        <td><a href="../admin/editarUsuario.php?idUsuario=<?php echo $fila['id']?>"><i class="fas fa-user-edit"></i></a></td>
                        <td><a href="../../backend/usuario/borrarUsuario.php?id=<?php echo $fila['id']?>"><i class="fas fa-user-minus"></i></a></td>
                        <td><a href="../../backend/admin/darAdmin.php?idUsuario=<?php echo $fila['id']?>"><i class="fas fa-user-shield"></i></a></td>
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