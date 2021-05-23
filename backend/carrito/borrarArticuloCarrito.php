<?php 
    require '../bd/conectarBD.php';
	require '../bd/DAOcarrito.php';
    session_start();
    $conexion = conectarBD(true);

    $idUsuario = $_SESSION["id"];
    $idArticulo = $_GET["idArticulo"];

    $borrarArticuloCarrito = borrarArticuloCarrito($conexion,$idUsuario,$idArticulo);

    header("Location: ../../frontend/carrito/verCarrito.php");

?>