<?php 

    require '../bd/conectarBD.php';
	require '../bd/DAOcarrito.php';

    session_start();
    $conexion = conectarBD(true);
    $idUsuario = $_SESSION["id"];
    $total = $_GET["total"];
    echo $total;

    // $vaciarCarrito = vaciarCarrito($conexion,$idUsuario);

    // header("Location: ../../frontend/index/index.php");

?>