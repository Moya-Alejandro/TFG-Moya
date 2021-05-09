<?php 

    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }

    require '../bd/conectarBD.php';
    require '../bd/DAOcategoria.php';

    $id = $_GET['idCategoria'];
    $conexion = conectarBD(true);

    try{
        $borrar = borrarCategoria($conexion,$id);
        header("Location: ../../frontend/panel/panelCategoria.php");
    }
    catch(Exception $e){
        $error = "Un artículo depende de esta categoría. Elimine el artículo primero.";
        header("Location: ../../frontend/panel/panelCategoria.php?error=$error");
    }

?>