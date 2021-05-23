<?php 
    require '../bd/conectarBD.php';
	require '../bd/DAOcarrito.php';

    $conexion = conectarBD(true);
    $idCesta = $_GET["idCesta"];

    $vaciarCarrito = vaciarCarrito($conexion,$idCesta);

    header("Location: ../../frontend/carrito/verCarrito.php");

?>