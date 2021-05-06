<?php
    require '../../backend/bd/DAOusuario.php';
    session_start();
    $rol = $_SESSION['rol'];
    if($rol != "admin"){
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
        <?php require_once('../header/header.php') ?>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th colspan="3"><a href="">Crear</a></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $conexion = conectarBd(true);
                    $result = ($conexion);
                    while ($fila = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $fila['']?></td>
                        <td><?php echo $fila['']?></td>
                        <td><?php echo $fila['']?></td>
                    </tr>
                </tbody>
            </table>
        <?php
            }
        ?>
    </body>
</html>