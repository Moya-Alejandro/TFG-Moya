<?php 
    require '../bd/conectarBD.php';
	require '../bd/DAOcarrito.php';
    session_start();
    $conexion = conectarBD(true);

    $idCesta = $_SESSION["id"];
    $idArticulo = $_GET["idArticulo"];

    $borrarArticuloCarrito = borrarArticuloCarrito($conexion,$idCesta,$idArticulo);

    header("Location: ../../frontend/carrito/verCarrito.php");

?>