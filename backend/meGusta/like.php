<?php 
    require '../bd/conectarBD.php';
	require '../bd/DAOarticulo.php';

    session_start();
    $idUsuario = $_SESSION["id"];
    $conexion = conectarBD(true);
    $idArticulo = $_POST["idArticulo"];
    $valor = $_POST["valor"];

    $fila = verLikeDeArticulo($conexion,$idArticulo,$idUsuario);
    
    if(mysqli_num_rows($fila)){
        $editarLike = editarLike($conexion,$valor,$idArticulo,$idUsuario);
    }
    else{
        $meGusta = meGustaArticulo($conexion,$idArticulo,$idUsuario,$valor);
    }
    

?>