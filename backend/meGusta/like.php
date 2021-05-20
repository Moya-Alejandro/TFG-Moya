<?php 
    require '../bd/conectarBD.php';
	require '../bd/DAOarticulo.php';

    session_start();
    $idUsuario = $_SESSION["id"];
    $conexion = conectarBD(true);
    $idArticulo = $_POST["idArticulo"];
    $valor = $_POST["valor"];

    $meGusta = meGustaArticulo($conexion,$idArticulo,$idUsuario,$valor);

?>