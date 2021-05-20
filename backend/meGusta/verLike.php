<?php 
    require '../bd/conectarBD.php';
	require '../bd/DAOarticulo.php';

    session_start();
    $idUsuario = $_SESSION["id"];
    $idArticulo = $_GET["idArticulo"];
    $conexion = conectarBD(true);

    $valoracion = mysqli_fetch_assoc(verMeGustaArticulo($conexion,$idArticulo,$idUsuario));
    $valor = 0;

    if(isset($valoracion)){
        $valor = $valoracion["gusta"];
    }
    
    echo $valor;
?>