<?php 

    require '../../backend/bd/conectarBD.php';
	require '../../backend/bd/DAOcarrito.php';
    session_start();
    $conexion = conectarBD(true);

    $idCesta = $_SESSION['id'];

    $numeroArticulos = numeroArticulos($conexion, $idCesta);
    $totalArticulos = mysqli_fetch_assoc($numeroArticulos);
    
    echo($totalArticulos['Count(idCesta)']);

?>