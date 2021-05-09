<?php

    if(!isset($_SERVER['HTTP_REFERER'])){
        header("Location: ../../frontend/index/index.php");
        exit;
    }
    
    require "../bd/conectarBD.php";
    require "../bd/DAOcategoria.php";

    $idOpcion = $_POST["idOpcion"];
    $nombre = $_POST["nombre"];
    $valores = $_POST["valor"];
    $idValores = $_POST["idValor"];
    $valoresJs = null;
    if(isset($_POST["valorJs"])){
        $valoresJs= $_POST["valorJs"];
    }

    $conexion = conectarBD(true);

    try{
        $editar = editarCategoria($conexion,$idOpcion,$nombre,$valores,$idValores,$valoresJs);
        header("Location: ../../frontend/panel/panelCategoria.php");
    }
    catch(Exception $e){
        $error = $e->getMessage();
        header("Location: ../../frontend/admin/editarCategoria.php?idCategoria=$idOpcion&error=$error");
    }

?>