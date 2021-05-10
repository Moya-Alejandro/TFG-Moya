<?php 

    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }

    require '../bd/conectarBD.php';
    require '../bd/DAOarticulo.php';

    $id = $_GET['idArticulo'];
    $conexion = conectarBD(true);

    try{
        $borrar = borrarArticulo($conexion,$id);
        header("Location: ../../frontend/panel/panelArticulo.php");
    }
    catch(Exception $e){
        $error = "";
        header("Location: ../../frontend/panel/panelCategoria.php?error=$error");
    }

?>