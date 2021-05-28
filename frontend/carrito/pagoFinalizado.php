<?php 

    require '../../backend/bd/conectarBD.php';
	require '../../backend/bd/DAOcarrito.php';

    session_start();
    $conexion = conectarBD(true);
    $idUsuario = $_SESSION["id"];

    $consulta = cogerStockCesta($conexion,$idUsuario);
    while($fila = mysqli_fetch_assoc($consulta)){
        $borrarStock = borrarStock($conexion,$fila["cantidad"],$fila["idArticulo"]);
    }
    
    $vaciarCarrito = vaciarCarrito($conexion,$idUsuario);
    
    header("Location: ../../frontend/index/index.php");

?>