<?php 

    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';

    $id = $_GET['id'];
    $conexion = conectarBD(true);

    eliminarIdUsuario($conexion,$id);

    header("Location: ../../frontend/panel/panelUsuario.php");

?>