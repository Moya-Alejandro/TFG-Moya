<?php 
    require '../bd/conectarBD.php';
	require '../bd/DAOcarrito.php';

    $conexion = conectarBD(true);
    $cantidad = $_POST["cantidad"];
    $idArticulo = $_POST["idArticulo"];
    actualizarCantidad($conexion,$idArticulo,$cantidad);
    header("Location: ../../frontend/carrito/verCarrito.php")
?>