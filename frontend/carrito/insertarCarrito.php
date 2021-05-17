<?php 

    require '../../backend/bd/conectarBD.php';
	require '../../backend/bd/DAOcarrito.php';
    session_start();
    $conexion = conectarBD(true);

    $idCesta = $_SESSION["id"];
    $idArticulo = $_POST["idArticulo"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];

    $insertar = insertarArticulo($conexion,$precio,$cantidad,$idCesta,$idArticulo);


?>