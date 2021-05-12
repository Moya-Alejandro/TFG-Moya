<?php 

    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }

    require '../bd/conectarBD.php';
    require '../bd/DAOusuario.php';

    $idUsuario = $_GET["idUsuario"];
    $conexion = conectarBD(true);

    try{
        $darAdmin = darAdmin($conexion,$idUsuario);
        header("Location: ../../frontend/panel/panelUsuario.php");
    }
    catch(Exception $e){
        $error = $e->getMessage();
        header("Location: ../../frontend/panel/panelUsuario.php?error=$error");
    }

?>