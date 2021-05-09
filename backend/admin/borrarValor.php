<?php 

    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }

    require '../bd/conectarBD.php';
    require '../bd/DAOcategoria.php';

    $idValor = $_GET["idValor"];
    $idCategoria = $_GET["idCategoria"];
    $conexion = conectarBD(true);

    try{
        $borrar = borrarValor($conexion,$idValor);
        header("Location: ../../frontend/admin/editarCategoria.php?idCategoria=$idCategoria");
    }
    catch(Exception $e){
        $error = "Este valor está enlazado a un artículo, elimine el artículo.";
        header("Location: ../../frontend/admin/editarCategoria.php?idCategoria=$idCategoria&error=$error");
    }


?>