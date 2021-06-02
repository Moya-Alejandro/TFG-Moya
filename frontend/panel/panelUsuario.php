<?php require_once('../header/header.php') ?>
<?php require_once('../nav/nav.php') ?>
<?php 

    //Llamamos a los archivos que contienen funciones de la base de datos para poder utilizar sus funciones
    require '../../backend/bd/DAOusuario.php';

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
            <div class="contenedorPanelUsuario">
                <ul id="migasPan">
                    <li><a href="../index/index.php"> Inicio </a></li>
                    <li><a href=""> Panel de Usuarios </a></li>
                </ul>
                <div id="contenedorPrincipalUsuario">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>DNI</th>
                                <th class="botonIconoCrear" colspan="3"><a href="../registrar/registrar.php">Crear <i class="fas fa-plus"></i></a></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            //Conectamos a la base de datos y mostramos por un while los valores de los usuarios en una tabla
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
                                <td class="botonIconoEditar"><a href="../admin/editarUsuario.php?idUsuario=<?php echo $fila['id']?>">Editar <i class="fas fa-user-edit"></i></a></td>
                                <td class="botonIconoAdmin"><a href="../../backend/admin/darAdmin.php?idUsuario=<?php echo $fila['id']?>">Admin <i class="fas fa-user-shield"></i></a></td>
                                <td class="botonIconoBorrar"><a href="../../backend/usuario/borrarUsuario.php?id=<?php echo $fila['id']?>">Borrar <i class="fas fa-user-times"></i></a></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php require_once('../footer/footer.php') ?>  
    </body>
</html>
<script src="https://kit.fontawesome.com/143eda576b.js" crossorigin="anonymous"></script>