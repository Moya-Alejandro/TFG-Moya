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
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Usuario</th>
                    <th>Contraseña</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>DNI</th>
                    <th>Telefono</th>
                    <th>Rol</th>  
                    <th colspan="3"><a href="../registrar/registrar.php">Crear</a></th>
                </tr>
            </thead>
            <tbody>
            <?php
                $conexion = conectarBd(true);
                $result = mostrarUsuarios($conexion);
                while ($fila = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $fila['id']?></td>
                    <td><?php echo $fila['nUsuario']?></td>
                    <td><?php echo $fila['password']?></td>
                    <td><?php echo $fila['nombre']?></td>
                    <td><?php echo $fila['apellidos']?></td>
                    <td><?php echo $fila['telefono']?></td>
                    <td><?php echo $fila['correo']?></td>
                    <td><?php echo $fila['dni']?></td>
                    <td><?php echo $fila['telefono']?></td>
                    <td><?php echo $fila['rol']?></td>
                    <td><a href="../../backend/usuario/borrarUsuario.php?id=<?php echo $fila['id']?>">Borrar</a></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>