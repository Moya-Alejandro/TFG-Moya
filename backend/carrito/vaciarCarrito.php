<?php 
    require '../bd/conectarBD.php';
	require '../bd/DAOcarrito.php';

    $conexion = conectarBD(true);
    $idUsuario = $_GET["idUsuario"];

    $vaciarCarrito = vaciarCarrito($conexion,$idUsuario);

    header("Location: ../../frontend/carrito/verCarrito.php");

?>