<?php 
    require '../bd/DAOcategoria.php';
    require '../bd/conectarBD.php';

    $nombre = $_POST["nombre"];
    $valores = $_POST["valor"];

    $conexion = conectarBD(true);


    try{
        crearCategoria($conexion,$nombre,$valores);
        header("Location: ../../frontend/panel/panelCategoria.php");
    }
    catch(Exception $e){
        $error = $e->getMessage();
        header("Location: ../../frontend/admin/crearCategoria.php?error=$error");
    }

?>