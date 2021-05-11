<?php 

    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';

    $idUsuario = $_GET["idUsuario"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $telefono = $_POST["telefono"];
    $dni = $_POST["dni"];
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $password = $_POST["password"];
    $conexion = conectarBD(true);
    
    try{
        editarPerfil($conexion,$usuario,$password,$nombre,$apellidos,$telefono,$correo,$dni,$idUsuario);
        header("Location: ../../frontend/panel/panelUsuario.php");
    }
    catch(Exception $e){
        $error = $e->getMessage();
        header("Location: ../../frontend/admin/editarUsuario.php?idUsuario=$idUsuario&error=$error");
    }

?>