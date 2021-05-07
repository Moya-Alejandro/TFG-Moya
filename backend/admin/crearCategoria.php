<?php 
    require '../bd/DAOcategoria.php';
    require '../bd/conectarBD.php';

    $nombre = $_POST["nombre"];
    $valores = $_POST["valor"];

    $conexion = conectarBD(true);

    $ultimaId =  crearCategoria($conexion,$nombre);
    
    $crearValores = crearValores($conexion,$valores,$ultimaId);

    if($crearValores){
        header("Location: ../../frontend/index/index.php");
    }
    else{
        header("Location: ../../frontend/registrar/registrar.php");
    }

?>